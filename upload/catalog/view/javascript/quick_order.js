(function($){
  $(function(){
    var $list  = $('#qo-suggestions');
    var $table = $('#qo-table tbody');
    var timer  = null;
    var LS_KEY = 'qo_items';
    var ADD_LOCK = {}; // spriječi dupli fastAdd

    /* ===================== localStorage ===================== */
    function loadLS(){ try { return JSON.parse(localStorage.getItem(LS_KEY)) || []; } catch(e){ return []; } }
    function saveLS(arr){ try { localStorage.setItem(LS_KEY, JSON.stringify(arr || [])); } catch(e){} }
    function upsertLS(item){
      var arr = loadLS();
      var i = arr.findIndex(function(x){ return String(x.product_id) === String(item.product_id); });
      if(i >= 0){ arr[i] = Object.assign({}, arr[i], item); } else { arr.push(item); }
      saveLS(arr);
    }
    function removeFromLS(pid){
      var arr = loadLS().filter(function(x){ return String(x.product_id) !== String(pid); });
      saveLS(arr);
    }
    function clearLS(){ saveLS([]); }

    /* ===================== Basel helpers ===================== */
    function baselSetCounters(count, totalTxt){
      $('.cart-total-items, #cart-total .counter.cart-total-items').text(count);
      $('.cart-total-amount, .header-cart-total, .cart-total, .top-cart .total').text(totalTxt);
      $(document).trigger('cart:update', {count: count, total: totalTxt});
      $(document).trigger('basel:cart:updated', {count: count, total: totalTxt});
    }
    function baselRefreshMiniCart(){
      var url = 'index.php?route=common/cart/info&_=' + Date.now();
      var $mini = $('#cart-content');
      if($mini.length){ $mini.load(url + ' #cart-content > *'); }
      else if($('#cart').length){ $('#cart > ul').load(url + ' ul > *'); }
    }
    function recomputeFromStateAndApply(){
      $.get('index.php?route=extension/module/quick_order/cartState&_=' + Date.now(), function(res){
        if(!res || !res.items){ baselSetCounters(0, '0'); return; }
        var count=0,total=0;
        res.items.forEach(function(it){
          count += (it.quantity||0);
          total += (it.price_raw||0) * (it.quantity||0);
        });
        $.post('index.php?route=extension/module/quick_order/format', { amount: total }, function(fmt){
          baselSetCounters(count, (fmt && fmt.formatted) ? fmt.formatted : total.toFixed(2));
        }, 'json');
      }, 'json');
    }
    function baselHeaderRefreshDebounced(){ setTimeout(function(){ baselRefreshMiniCart(); recomputeFromStateAndApply(); }, 150); }

    /* ===================== UI helpers ===================== */
    function toast(type, msg){
      var $t = $('#qo-toast');
      $t.removeClass('alert-danger alert-success')
          .addClass(type === 'ok' ? 'alert-success' : 'alert-danger')
          .text(msg).fadeIn(150);
      setTimeout(function(){ $t.fadeOut(300); }, 2500);
    }
    function formatCurrency(amount, cb){
      $.post('index.php?route=extension/module/quick_order/format', { amount: amount }, function(res){
        cb(res && res.formatted ? res.formatted : amount);
      }, 'json');
    }

    /* ===================== Table rendering ===================== */
    function rowHtml(item, added){
      var qty = item.quantity || 1;
      var subtotal = (item.price_raw || 0) * qty;
      var subtotalCell = '<span class="qo-subtotal" data-sub="'+subtotal+'">...</span>';
      var actions = added
          ? '<a class=" qo-remove product-remove" title="Ukloni"><i class="fa fa-times"></i></a> <span class="label label-success" style="margin-left:6px;">✓ Dodano</span>'
          : '<button class="btn btn-primary qo-add" title="Dodaj"><span class="global-cart"></span></button>';

      return '\
        <tr data-id="'+item.product_id+'" data-price="'+(item.price_raw || 0)+'" '+(added?'data-added="1"':'')+'>\
          <td>'+(item.thumb ? '<img src="'+item.thumb+'" style="width:60px;height:60px;object-fit:cover">' : '')+'</td>\n\
          <td>'+(item.name || '')+'</td>\n\
          <td>'+(item.sku || '')+'</td>\n\
          <td>'+(item.price || '')+'</td>\n\
          <td>'+subtotalCell+'</td>\n\
          <td><input type="number" class="form-control qo-qty" min="1" value="'+qty+'" style="max-width:90px;text-align:right;"></td>\n\
          <td class="qo-actions">'+actions+'</td>\n\
        </tr>';
    }
    function recomputeRow($tr){
      var price = parseFloat($tr.attr('data-price') || '0');
      var qty = parseInt($tr.find('.qo-qty').val() || '1', 10);
      if(isNaN(qty) || qty < 1){ qty = 1; $tr.find('.qo-qty').val(1); }
      var subtotal = price * qty;
      var $cell = $tr.find('.qo-subtotal');
      $cell.attr('data-sub', subtotal);
      formatCurrency(subtotal, function(txt){ $cell.text(txt); });
    }
    function recomputeTotal(){
      var total = 0;
      $table.find('.qo-subtotal').each(function(){
        total += parseFloat($(this).attr('data-sub') || '0');
      });
      formatCurrency(total, function(txt){ $('#qo-total').text(txt); });
    }
    function ensureRow(item, added){
      var $existing = $table.find('tr[data-id="'+item.product_id+'"]');
      if($existing.length){
        if(item.quantity){ $existing.find('.qo-qty').val(item.quantity); }
        if(added){
          $existing.attr('data-added','1').addClass('success')
              .find('.qo-actions').html('<a class=" qo-remove product-remove" title="Ukloni"><i class="fa fa-times"></i></a> <span class="label label-success" style="margin-left:6px;">✓ Dodano</span>');
        }
        if(item.sku){ $existing.find('td').eq(2).text(item.sku); }
        recomputeRow($existing);
        return $existing;
      } else {
        var $row = $(rowHtml(item, added));
        $table.append($row);
        recomputeRow($row);
        return $row;
      }
    }
    function getRowData($tr){
      var pid  = String($tr.data('id'));
      var qty  = parseInt($tr.find('.qo-qty').val() || '1', 10);
      var pRaw = parseFloat($tr.attr('data-price') || '0');
      var tds  = $tr.find('td');
      return {
        product_id: pid,
        name: tds.eq(1).text().trim(),
        sku:  tds.eq(2).text().trim(),
        price: tds.eq(3).text().trim(),
        price_raw: isNaN(pRaw) ? 0 : pRaw,
        quantity: isNaN(qty) ? 1 : qty,
        thumb: (function(){ var img=$tr.find('td:first img'); return img.length ? img.attr('src') : ''; })()
      };
    }

    /* ===================== Autocomplete rendering ===================== */
    function esc(s){ return String(s==null?'':s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;'); }

    function suggestionHtml(it){
      var img = it.thumb
          ? `<img src="${esc(it.thumb)}" alt="${esc(it.name)}" class="qo-thumb">`
          : `<div class="qo-thumb placeholder"><i class="fa fa-box"></i></div>`;
      return `
        <div class="list-group-item qo-suggest"
             tabindex="0"
             data-pid="${esc(it.product_id)}"
             data-name="${esc(it.name||'')}"
             data-sku="${esc(it.sku||'')}"
             data-price="${esc(it.price||'')}"
             data-priceraw="${Number(it.price_raw||0)}"
             data-thumb="${esc(it.thumb||'')}">
          <div class="qo-suggest-inner">
            ${img}
            <div class="qo-info">
              <div class="name">${esc(it.name || '')}</div>
              <div class="meta">
                ${(it.sku ? `<span>Šifra: ${esc(it.sku)}</span>` : '')}
                ${(it.price ? `<span class="price">${esc(it.price)}</span>` : '')}
              </div>
            </div>
            <input type="number" class="qo-suggest-qty" min="1" value="${it.quantity || 1}" tabindex="0" aria-label="Količina">
            <button class="qo-add-btn" tabindex="0" title="Dodaj"><span class="global-cart"></span></button>
          </div>
        </div>`;
    }

    function itemFromSuggest($s){
      if(!$s || !$s.length) return null;
      var pid = $s.attr('data-pid');
      if(!pid) return null;
      var q = parseInt($s.find('.qo-suggest-qty').val() || '1', 10);
      if(isNaN(q) || q < 1) q = 1;
      return {
        product_id: pid,
        name: $s.attr('data-name') || '',
        sku: $s.attr('data-sku') || '',
        price: $s.attr('data-price') || '',
        price_raw: parseFloat($s.attr('data-priceraw') || '0') || 0,
        thumb: $s.attr('data-thumb') || '',
        quantity: q
      };
    }

    // openQtyMode: ako focusQty=true, fokusira input; inače samo otvori bez promjene fokusa
    function openQtyMode($s, focusQty){
      $list.find('.qo-suggest.qty-mode').removeClass('qty-mode');
      $s.addClass('qty-mode');
      if(focusQty){
        var $qty = $s.find('.qo-suggest-qty');
        if($qty.length){ $qty.focus().select(); }
      }
    }

    // promjena količine ↑/↓
    function bumpQty($s, delta){
      if(!$s || !$s.length) return;
      openQtyMode($s, true);
      var $qty = $s.find('.qo-suggest-qty');
      var v = parseInt($qty.val() || '1', 10);
      if(isNaN(v) || v < 1) v = 1;
      v += delta;
      if(v < 1) v = 1;
      $qty.val(v);
    }

    /* ===================== Add u košaricu ===================== */
    function addToCartAndRender(item, qty){
      if(!item || !item.product_id){
        toast('err', 'Nije odabran valjan artikl.');
        return $.Deferred().resolve().promise();
      }
      qty = parseInt(qty || item.quantity || 1, 10);
      if(isNaN(qty) || qty < 1) qty = 1;

      var key = String(item.product_id) + '::' + String(qty);
      if(ADD_LOCK[key]){ return $.Deferred().resolve().promise(); }
      ADD_LOCK[key] = true;

      return $.post('index.php?route=extension/module/quick_order/fastAdd', {
        product_id: item.product_id, quantity: qty
      }, function(res){
        if(res && res.success){
          item.quantity = qty;
          item.added = true;
          var $tr = ensureRow(item, true);

          var data = getRowData($tr);
          data.added = true;
          data.quantity = qty;
          upsertLS(data);

          recomputeTotal();
          baselHeaderRefreshDebounced();
          toast('ok', 'Dodano u košaricu');
        } else {
          toast('err', (res && res.message) || 'Greška pri dodavanju');
        }
      }, 'json').fail(function(){
        toast('err', 'Greška pri dodavanju');
      }).always(function(){ delete ADD_LOCK[key]; });
    }

    /* ===================== Init flow ===================== */
    loadLS().forEach(function(it){ ensureRow(it, !!it.added); });
    recomputeTotal();

    $.get('index.php?route=extension/module/quick_order/cartState&_=' + Date.now(), function(res){
      if(res && res.items){
        var map = {}; loadLS().forEach(function(x){ map[String(x.product_id)] = x; });
        res.items.forEach(function(it){
          var merged = Object.assign({}, it, map[String(it.product_id)] || {}, { added: true });
          ensureRow(merged, true);
          upsertLS(merged);
        });
        recomputeTotal();
        baselHeaderRefreshDebounced();
      }
    }, 'json');

    /* ===================== Search / autocomplete ===================== */
    function search(term){
      return $.get('index.php?route=extension/module/quick_order/autocomplete', { term: term })
          .then(function(items){
            $list.empty();
            if(!items || !items.length){ $list.hide(); return items || []; }
            items.forEach(function(it){ $list.append(suggestionHtml(it)); });
            $list.show();
            return items;
          }, function(){
            $list.hide();
            return [];
          });
    }

    // reset qty-mode pri svakom novom unosu
    $(document).on('input', '#qo-search', function(){
      clearTimeout(timer);
      var term = $(this).val().trim();
      $list.find('.qo-suggest.qty-mode').removeClass('qty-mode');
      if(term.length < 1){ $list.hide(); return; }
      timer = setTimeout(function(){ search(term); }, 200);
    });

    /* ===================== Navigacija po prijedlozima ===================== */
    function getSuggestItems(){ return $list.find('.qo-suggest'); }

    function focusSuggest($it){
      if(!$it || !$it.length) return;
      // fokus ostaje na .qo-suggest (ne na qty input) – Tab neće preskakati
      $it.focus();
      var el = $it.get(0);
      if(el && el.scrollIntoView){ el.scrollIntoView({ block: 'nearest' }); }
    }

    function moveSuggest(delta){
      var $items = getSuggestItems();
      if(!$items.length) return;
      var $focused = $(document.activeElement).closest('.qo-suggest');
      var idx = $focused.length ? $items.index($focused) : -1;
      var next = idx + delta;
      if(next < 0) next = 0;
      if(next >= $items.length) next = $items.length - 1;
      openQtyMode($items.eq(next), false); // samo otvori, ne fokusiraj qty
      focusSuggest($items.eq(next));
    }

    /* ===================== Tipke u search polju ===================== */
    $(document).on('keydown', '#qo-search', function(e){
      var key = e.key;

      // ESC iz searcha -> zatvori listu
      if (key === 'Escape') {
        $list.hide();
        $list.find('.qo-suggest.qty-mode').removeClass('qty-mode');
        return;
      }

      // ArrowUp/Down u searchu više NE navigiraju (ništa ne radimo)
      if(key === 'ArrowDown' || key === 'ArrowUp'){ return; }

      // Tab iz searcha → fokusiraj prvi prijedlog
      if(key === 'Tab'){
        if(!$list.is(':visible')) return;
        var $itemsT = getSuggestItems();
        if($itemsT.length){
          e.preventDefault(); e.stopPropagation();
          openQtyMode($itemsT.eq(0), false);
          focusSuggest($itemsT.eq(0));
        }
        return;
      }

      // Enter dvokorak samo kad je točno 1 rezultat
      if(key !== 'Enter') return;
      var proceed = function(){
        var $items = getSuggestItems();
        if($items.length !== 1) return;
        var $only = $items.eq(0);
        e.preventDefault(); e.stopPropagation();
        if(!$only.hasClass('qty-mode')){
          openQtyMode($only, true); // otvori i fokusiraj qty
        } else {
          var item = itemFromSuggest($only);
          if(!item){ toast('err','Ne mogu očitati artikl.'); return; }
          addToCartAndRender(item, item.quantity).always(function(){
            $list.hide(); $('#qo-search').val('');
          });
        }
      };

      if(!$list.is(':visible')){
        var term = $(this).val().trim();
        if(term.length < 1) return;
        search(term).then(function(items){
          if(items.length === 1){ proceed(); }
        });
      } else {
        proceed();
      }
    });

    /* ===================== Tipke unutar autosuggest liste ===================== */
    $(document).on('keydown', '#qo-suggestions .qo-suggest, #qo-suggestions .qo-suggest-qty, #qo-suggestions .qo-add-btn', function(e){
      var key = e.key;

      // ESC unutar liste -> zatvori listu i vrati fokus na search
      if (key === 'Escape') {
        e.preventDefault();
        e.stopPropagation();
        $list.hide();
        $list.find('.qo-suggest.qty-mode').removeClass('qty-mode');
        $('#qo-search').focus();
        return;
      }

      // Tab / Shift+Tab: sljedeći / prethodni prijedlog
      if(key === 'Tab'){
        e.preventDefault(); e.stopPropagation();
        moveSuggest(e.shiftKey ? -1 : 1);
        return;
      }

      // Strelice: NE navigiraju – mijenjaju količinu na selektiranom
      if(key === 'ArrowDown'){
        e.preventDefault(); e.stopPropagation();
        var $sD = $(this).closest('.qo-suggest');
        bumpQty($sD, -1); // ↓ smanji
        return;
      }
      if(key === 'ArrowUp'){
        e.preventDefault(); e.stopPropagation();
        var $sU = $(this).closest('.qo-suggest');
        bumpQty($sU, +1); // ↑ povećaj
        return;
      }

      // Enter: ako nije qty-mode → otvori + fokusiraj qty; inače → dodaj
      if(key === 'Enter'){
        e.preventDefault(); e.stopPropagation();
        var $s = $(this).closest('.qo-suggest');
        if(!$s.hasClass('qty-mode')){
          openQtyMode($s, true);
          return;
        }
        if($s.data('busy')) return;
        $s.data('busy', true);
        var item = itemFromSuggest($s);
        if(!item){ $s.data('busy', false); toast('err','Ne mogu očitati artikl.'); return; }
        addToCartAndRender(item, item.quantity).always(function(){
          $s.data('busy', false);
          $list.hide(); $('#qo-search').val('').focus();
        });
      }
    });

    // Fokus na red (Tab ili programatski focus) -> otvori qty-mode (bez promjene fokusa)
    $(document).on('focusin', '.qo-suggest', function(){
      openQtyMode($(this), false);
    });

    // Klik na gumb Dodaj
    $(document).on('click', '.qo-add-btn', function(e){
      e.preventDefault(); e.stopPropagation();
      var $s = $(this).closest('.qo-suggest');
      if(!$s.hasClass('qty-mode')){ openQtyMode($s, true); return; }
      if($s.data('busy')) return;
      $s.data('busy', true);
      var item = itemFromSuggest($s);
      if(!item){ $s.data('busy', false); toast('err','Ne mogu očitati artikl.'); return; }
      addToCartAndRender(item, item.quantity).always(function(){
        $s.data('busy', false);
        $list.hide(); $('#qo-search').val('').focus();
      });
    });

    // Klik na cijeli prijedlog: otvori qty-mode i fokusiraj qty
    $(document).on('click', '.qo-suggest', function(e){
      if($(e.target).closest('.qo-suggest-qty, .qo-add-btn').length) return;
      openQtyMode($(this), true);
    });

    /* ===================== Tablica: add/qty/remove/clear ===================== */
    $(document).on('click', '.qo-add', function(){
      var $tr = $(this).closest('tr');
      var pid = $tr.data('id');
      var qty = parseInt($tr.find('.qo-qty').val() || '1', 10);
      if(qty < 1) qty = 1;

      $.post('index.php?route=extension/module/quick_order/fastAdd', { product_id: pid, quantity: qty }, function(res){
        if(res && res.success){
          $tr.attr('data-added','1').addClass('success')
              .find('.qo-actions').html('<a class=" qo-remove product-remove" title="Ukloni"><i class="fa fa-times"></i></a> <span class="label label-success" style="margin-left:6px;">✓ Dodano</span>');
          toast('ok', 'Dodano u košaricu');
          var data = getRowData($tr);
          data.added = true; data.quantity = qty; upsertLS(data);
          baselHeaderRefreshDebounced();
        } else {
          toast('err', (res && res.message) || 'Greška pri dodavanju');
        }
      }, 'json').fail(function(){ toast('err', 'Greška pri dodavanju'); });
    });

    $(document).on('change input', '.qo-qty', function(){
      var $tr = $(this).closest('tr');
      var pid = $tr.data('id');
      var qty = parseInt($(this).val() || '1', 10);
      if(qty < 1) qty = 1;

      recomputeRow($tr);
      recomputeTotal();

      var data = getRowData($tr);
      if($tr.attr('data-added')) data.added = true;
      upsertLS(data);

      if($tr.attr('data-added')){
        $.post('index.php?route=extension/module/quick_order/updateQty', { product_id: pid, quantity: qty }, function(){
          baselHeaderRefreshDebounced();
        });
      }
    });

    $(document).on('click', '.qo-remove', function(){
      var $tr = $(this).closest('tr');
      var pid = $tr.data('id');
      $.post('index.php?route=extension/module/quick_order/removeItem', { product_id: pid }, function(){
        $tr.remove();
        removeFromLS(String(pid));
        recomputeTotal();
        baselHeaderRefreshDebounced();
      }, 'json').fail(function(){
        $tr.remove();
        removeFromLS(String(pid));
        recomputeTotal();
        baselHeaderRefreshDebounced();
      });
    });

    $(document).on('click', '#qo-clear-all', function(){
      $.post('index.php?route=extension/module/quick_order/clearAll', {}, function(){
        $table.empty();
        clearLS();
        recomputeTotal();
        baselHeaderRefreshDebounced();
      }, 'json').fail(function(){
        $table.empty();
        clearLS();
        recomputeTotal();
        baselHeaderRefreshDebounced();
      });
    });

    // Sakrij sugestije na klik izvan
    $(document).on('click', function(e){
      if(!$(e.target).closest('#qo-search, #qo-suggestions').length){ $list.hide(); }
    });
  });
})(jQuery);
