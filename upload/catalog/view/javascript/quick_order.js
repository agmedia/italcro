(function($){
  $(function(){
    var $list  = $('#qo-suggestions');
    var $table = $('#qo-table tbody');
    var timer  = null;
    var LS_KEY = 'qo_items'; // spremamo i nedodane i dodane redove (sa SKU)

    /* ===================== localStorage ===================== */
    function loadLS(){
      try { return JSON.parse(localStorage.getItem(LS_KEY)) || []; } catch(e){ return []; }
    }
    function saveLS(arr){
      try { localStorage.setItem(LS_KEY, JSON.stringify(arr || [])); } catch(e){}
    }
    function upsertLS(item){
      var arr = loadLS();
      var i = arr.findIndex(function(x){ return String(x.product_id) === String(item.product_id); });
      if(i >= 0){ arr[i] = Object.assign({}, arr[i], item); }
      else { arr.push(item); }
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
      if($mini.length){
        $mini.load(url + ' #cart-content > *');
      } else if($('#cart').length){
        $('#cart > ul').load(url + ' ul > *');
      }
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
    function baselHeaderRefreshDebounced(){
      setTimeout(function(){
        baselRefreshMiniCart();
        recomputeFromStateAndApply();
      }, 150);
    }

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
          ? '<button class="btn btn-default qo-remove" title="Ukloni">✕</button> <span class="label label-success" style="margin-left:6px;">✓ Dodano</span>'
          : '<button class="btn btn-primary qo-add">+ Dodaj</button>';

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
      formatCurrency(total, function(txt){
        $('#qo-total').text(txt);
      });
    }
    function ensureRow(item, added){
      var $existing = $table.find('tr[data-id="'+item.product_id+'"]');
      if($existing.length){
        if(item.quantity){ $existing.find('.qo-qty').val(item.quantity); }
        if(added){
          $existing.attr('data-added','1').addClass('success')
              .find('.qo-actions').html('<button class="btn btn-default qo-remove" title="Ukloni">✕</button> <span class="label label-success" style="margin-left:6px;">✓ Dodano</span>');
        }
        // osvježi SKU celiju čak i ako cartState ne šalje sku
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

    /* ===================== Helper: pročitaj red iz DOM-a (sku, name, thumb...) ===================== */
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

    /* ===================== Init flow ===================== */
    // 1) prikaži prvo iz localStorage (da ostanu i nedodani nakon refresh-a)
    loadLS().forEach(function(it){ ensureRow(it, !!it.added); });
    recomputeTotal();

    // 2) merge s cartState — zadrži LS vrijednosti (SKU!) gdje cartState nema
    $.get('index.php?route=extension/module/quick_order/cartState&_=' + Date.now(), function(res){
      if(res && res.items){
        var map = {}; loadLS().forEach(function(x){ map[String(x.product_id)] = x; });
        res.items.forEach(function(it){
          // redoslijed: prvo cartState, onda LS (LS nadjača prazne vrijednosti cartState-a), pa added:true
          var merged = Object.assign({}, it, map[String(it.product_id)] || {}, { added: true });
          ensureRow(merged, true);
          upsertLS(merged); // sinkaj LS (zadrži SKU)
        });
        recomputeTotal();
        baselHeaderRefreshDebounced();
      }
    }, 'json');

    /* ===================== Search / autocomplete ===================== */
    function search(term){
      $.get('index.php?route=extension/module/quick_order/autocomplete', { term: term }, function(items){
        $list.empty();
        if(!items || !items.length){ $list.hide(); return; }
        items.forEach(function(it){
          var html = '<a class="list-group-item qo-suggest" href="#" data-item=\''+JSON.stringify(it)+'\'>' +
              it.name +
              (it.sku ? ' — <small>' + it.sku + '</small>' : '') +
              (it.price ? '&nbsp; <b>' + it.price + '</b>' : '') +
              '</a>';
          $list.append(html);
        });
        $list.show();
      }, 'json');
    }
    $(document).on('input', '#qo-search', function(){
      clearTimeout(timer);
      var term = $(this).val().trim();
      if(term.length < 2){ $list.hide(); return; }
      timer = setTimeout(function(){ search(term); }, 220);
    });
    $(document).on('click', '.qo-suggest', function(e){
      e.preventDefault();
      var item = $(this).data('item');
      $list.hide();
      $('#qo-search').val('');
      item.quantity = item.quantity || 1;
      item.added = false;
      ensureRow(item, false);
      // odmah upiši kompletne podatke iz DOM-a (uklj. SKU) u LS
      var $tr = $table.find('tr[data-id="'+item.product_id+'"]');
      upsertLS(getRowData($tr));
      recomputeTotal();
    });

    /* ===================== Events ===================== */
    // Qty change → LS + (ako je dodano) sync na server + Basel refresh
    $(document).on('change input', '.qo-qty', function(){
      var $tr = $(this).closest('tr');
      var pid = $tr.data('id');
      var qty = parseInt($(this).val() || '1', 10);
      if(qty < 1) qty = 1;

      recomputeRow($tr);
      recomputeTotal();

      // spremi cijeli objekt (da SKU ostane)
      var data = getRowData($tr);
      if($tr.attr('data-added')) data.added = true;
      upsertLS(data);

      if($tr.attr('data-added')){
        $.post('index.php?route=extension/module/quick_order/updateQty', { product_id: pid, quantity: qty }, function(){
          baselHeaderRefreshDebounced();
        });
      }
    });

    // Add single
    $(document).on('click', '.qo-add', function(){
      var $tr = $(this).closest('tr');
      var pid = $tr.data('id');
      var qty = parseInt($tr.find('.qo-qty').val() || '1', 10);
      if(qty < 1) qty = 1;

      $.post('index.php?route=extension/module/quick_order/fastAdd', { product_id: pid, quantity: qty }, function(res){
        if(res && res.success){
          $tr.attr('data-added','1').addClass('success')
              .find('.qo-actions').html('<button class="btn btn-default qo-remove" title="Ukloni">✕</button> <span class="label label-success" style="margin-left:6px;">✓ Dodano</span>');
          toast('ok', 'Dodano u košaricu');
          // upiši cijeli red (sa SKU) u LS
          var data = getRowData($tr);
          data.added = true;
          data.quantity = qty;
          upsertLS(data);
          baselHeaderRefreshDebounced();
        } else {
          toast('err', (res && res.message) || 'Greška pri dodavanju');
        }
      }, 'json').fail(function(){
        toast('err', 'Greška pri dodavanju');
      });
    });

    // Add all
    $(document).on('click', '#qo-add-all', function(){
      var rows = $table.find('tr').filter(function(){ return !$(this).attr('data-added'); });
      if(!rows.length){ toast('err', 'Nema stavki za dodati'); return; }

      var items = [];
      rows.each(function(){
        var pid = $(this).data('id');
        var qty = parseInt($(this).find('.qo-qty').val() || '1', 10);
        if(pid && qty > 0){ items.push({ product_id: pid, quantity: qty }); }
      });

      $.ajax({
        url: 'index.php?route=extension/module/quick_order/fastAddAll',
        type: 'POST',
        dataType: 'json',
        data: { items: JSON.stringify(items) },
        success: function(res){
          if(res && res.added){
            res.added.forEach(function(a){
              var $tr = $table.find('tr[data-id="'+a.product_id+'"]');
              $tr.attr('data-added','1').addClass('success')
                  .find('.qo-actions')
                  .html('<button class="btn btn-default qo-remove" title="Ukloni">✕</button> <span class="label label-success" style="margin-left:6px;">✓ Dodano</span>');
              // spremi cijeli red (sa SKU) u LS
              var data = getRowData($tr);
              data.added = true;
              data.quantity = a.quantity || data.quantity;
              upsertLS(data);
            });

            // osvježi Basel header i mini-cart odmah
            baselHeaderRefreshDebounced();

            toast('ok', 'Sve stavke dodane u košaricu');
          } else {
            toast('err', (res && res.message) || 'Greška pri dodavanju');
          }
        },
        error: function(){
          toast('err', 'Greška pri komunikaciji sa serverom');
        }
      });
    });

    // Remove single
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

    // Clear all
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

    // Hide suggestions on outside click
    $(document).on('click', function(e){
      if(!$(e.target).closest('#qo-search, #qo-suggestions').length){ $list.hide(); }
    });
  });
})(jQuery);
