(function($){
  $(function(){
    if (window.qiqoQuickOrderInitialized) return;
    window.qiqoQuickOrderInitialized = true;

    var $list  = $('#qo-suggestions');
    var $table = $('#qo-table tbody');
    var timer  = null;
    var toastTimer = null;
    var LS_KEY = 'qo_items_v2';
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
        var count=res.items.length,total=0;
        res.items.forEach(function(it){
          total += lineTotalRaw(it.price_raw || 0, it.quantity || 0, it.cent || '');
        });
        $.post('index.php?route=extension/module/quick_order/format', { amount: total }, function(fmt){
          baselSetCounters(count, (fmt && fmt.formatted) ? fmt.formatted : total.toFixed(2));
        }, 'json');
      }, 'json');
    }
    function baselHeaderRefreshDebounced(){ setTimeout(function(){ baselRefreshMiniCart(); recomputeFromStateAndApply(); }, 150); }

    /* ===================== UI helpers ===================== */
    function toast(type, msg, options){
      options = options || {};
      var $t = $('#qo-toast');
      var alertClass = type === 'ok' ? 'alert-success' : (type === 'warn' ? 'alert-warning' : 'alert-danger');
      var delay = options.delay == null ? (type === 'ok' ? 5000 : 9000) : options.delay;

      clearTimeout(toastTimer);

      var $close = $('<button type="button" class="close" aria-label="Zatvori">&times;</button>');
      $close.on('click', function(){
        clearTimeout(toastTimer);
        $t.stop(true, true).fadeOut(150);
      });

      $t.stop(true, true)
          .removeClass('alert-danger alert-success alert-warning alert-dismissible')
          .addClass(alertClass + ' alert-dismissible')
          .empty()
          .append($close)
          .append($('<span class="qo-toast-text"></span>').text(msg || ''))
          .fadeIn(150);

      if (delay > 0) {
        toastTimer = setTimeout(function(){ $t.fadeOut(300); }, delay);
      }
    }
    function formatCurrency(amount, cb){
      $.post('index.php?route=extension/module/quick_order/format', { amount: amount }, function(res){
        cb(res && res.formatted ? res.formatted : amount);
      }, 'json');
    }
    function parseQty(value){
      if (typeof value === 'number') {
        return isNaN(value) ? 0 : value;
      }
      value = String(value == null ? '' : value).replace(/\s|\u00a0/g, '');
      if (value.indexOf(',') !== -1) {
        value = value.replace(/\./g, '').replace(',', '.');
      }
      var parsed = parseFloat(value);
      return isNaN(parsed) ? 0 : parsed;
    }
    function roundQty(value){
      value = parseQty(value);
      return Math.round(value * 10000) / 10000;
    }
    function formatQty(value, allowDecimal){
      value = roundQty(value);
      if (!allowDecimal) {
        return String(Math.ceil(value - 0.0000001));
      }
      if (Math.abs(value - Math.round(value)) < 0.00001) {
        return String(Math.round(value));
      }
      return value.toFixed(4).replace(/\.?0+$/, '').replace('.', ',');
    }
    function allowsDecimalQty(item){
      if (!item) return false;
      if (item.decimal_quantity === true || String(item.decimal_quantity || '0') === '1') {
        return true;
      }
      var step = parseQty(item.minimumifc100 || item.minimum || item.min || 0);
      return step > 0 && Math.abs(step - Math.round(step)) > 0.00001;
    }
    function allowsDecimalStep(flag, step){
      step = parseQty(step || 0);
      return String(flag || '0') === '1' || (step > 0 && Math.abs(step - Math.round(step)) > 0.00001);
    }
    function normalizeQtyInfo(value, item, stepOverride){
      var original = roundQty(value);
      var qty = roundQty(value);
      var step = parseQty(stepOverride || (item && (item.minimumifc100 || item.minimum || item.min)) || 1);
      if (isNaN(step) || step <= 0) step = 1;

      if (isNaN(qty) || qty <= 0 || qty < step) {
        qty = step;
      }

      qty = Math.ceil((qty / step) - 0.0000001) * step;

      if (!allowsDecimalQty(item)) {
        qty = Math.ceil(qty - 0.0000001);
      }

      qty = roundQty(qty);

      return {
        qty: qty,
        adjusted: isNaN(original) || Math.abs(qty - original) > 0.00001
      };
    }
    function normalizeQty(value, item, stepOverride){
      return normalizeQtyInfo(value, item, stepOverride).qty;
    }
    function adjustedQtyMessage(qty, allowDecimal, originalQty, minStep){
      var formattedQty = formatQty(qty, allowDecimal);
      var original = parseQty(originalQty);
      var step = parseQty(minStep);

      if (!isNaN(step) && step > 0 && (isNaN(original) || original <= 0 || original < step)) {
        return 'Minimalna količina za ovaj artikl je ' + formatQty(step, allowDecimal) + '. Količina je postavljena na ' + formattedQty + '.';
      }

      return 'Količina je zaokružena na ' + formattedQty + ' prema dozvoljenom koraku pakiranja.';
    }
    function notifyRoundedQty(qty, allowDecimal, originalQty, minStep){
      toast('warn', adjustedQtyMessage(qty, allowDecimal, originalQty, minStep), { delay: 9000 });
    }
    function hasQtyNotice(res, item){
      return !!((res && res.notice) || (item && item.quantity_adjusted));
    }
    function cartResultMessage(res, fallback, item){
      var notice = (res && res.notice) ? res.notice : '';
      if (!notice && item && item.quantity_adjusted) {
        notice = adjustedQtyMessage(item.quantity, allowsDecimalQty(item), item.quantity_original, item.minimumifc100 || getMinStep(item));
      }

      return notice ? (fallback + ' ' + notice) : fallback;
    }
    function cartResultType(res, item){
      return hasQtyNotice(res, item) ? 'warn' : 'ok';
    }
    function cartResultDelay(res, item){
      return hasQtyNotice(res, item) ? 9000 : 5000;
    }

    function normCent(v){
      return String(v || '').toUpperCase().replace(/\s+/g,'').replace(/-/g,'');
    }
    function isC100(obj){
      return normCent(obj && obj.cent) === 'C100';
    }
    function getMinStep(item){
      var configured = parseQty(item && item.minimumifc100 || 0);
      if (!isNaN(configured) && configured > 0) {
        return configured;
      }

      if (isC100(item) || parseInt(item && item.pak || 0, 10) === 1) {
        var pack = parseQty(item && item.minimum || 0);
        if (isNaN(pack) || pack <= 0) pack = 1;
        return pack;
      }
      return 1;
    }
    function round5(value){
      value = parseFloat(value || 0);
      if(isNaN(value)) value = 0;
      return Math.round(value * 100000) / 100000;
    }
    function lineTotalRaw(priceRaw, qty, cent){
      var total = round5(priceRaw) * (parseFloat(qty || 0) || 0);
      if(normCent(cent) === 'C100'){
        total = total / 100;
      }
      return round5(total);
    }
    function displayPriceHtml(item){
      var current = item && item.price ? String(item.price) : '';
      var cls = 'qo-price-current';
      if(parseFloat(item && item.qiqo_action_net_price_raw || 0) > 0){
        cls += ' qo-price-net';
      }
      return '<span class="' + cls + '">' + esc(current) + '</span>';
    }
    function displayVpcHtml(item){
      return '<span class="qo-vpc-current">' + esc(item && item.vpc ? String(item.vpc) : '') + '</span>';
    }
    function displayPercent(value, prefix, item){
      if(parseFloat(item && item.qiqo_action_net_price_raw || 0) > 0){
        return '-';
      }
      var n = parseFloat(value || 0);
      if(isNaN(n) || n <= 0){
        return '-';
      }
      return (prefix || '') + Math.round(n) + '%';
    }
    function discountClass(item){
      if(item && item.qiqo_action && parseFloat(item.qiqo_action_discount || 0) > 0){
        return ' qo-discount-action';
      }
      return '';
    }
    function actionButtonHtml(item){
      if(!item || !item.qiqo_action){
        return '';
      }
      var title = 'Uvjeti akcijskog cjenika';
      if(item.qiqo_action_conditions && item.qiqo_action_conditions.length){
        title += ': ' + item.qiqo_action_conditions.join(' | ');
      }
      return '<button type="button" class="qiqo-action-button" data-conditions="' + esc((item.qiqo_action_conditions || []).join(' | ')) + '" title="' + esc(title) + '" aria-label="' + esc(title) + '">A</button>';
    }

    function showActionConditions($button){
      var conditions = String($button.attr('data-conditions') || '').trim();
      var title = 'Uvjeti akcijskog cjenika';
      var body = conditions ? conditions.replace(/\s*\|\s*/g, '<br>') : 'Artikl je u akcijskom cjeniku.';
      var $modal = $('#qo-action-modal');

      if (!$modal.length) {
        $modal = $('<div class="modal fade" id="qo-action-modal" tabindex="-1" role="dialog" aria-hidden="true">' +
          '<div class="modal-dialog" role="document"><div class="modal-content">' +
          '<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Zatvori"><span aria-hidden="true">&times;</span></button><h4 class="modal-title"></h4></div>' +
          '<div class="modal-body"></div>' +
          '</div></div></div>');
        $('body').append($modal);
      }

      $modal.find('.modal-title').text(title);
      $modal.find('.modal-body').html(body);
      $modal.modal('show');
    }

    /* ===================== Table rendering ===================== */
    function rowHtml(item, added){
      var pack = item.packaging || (item.minimum && item.minimum > 0 ? item.minimum : 1);
      var minStep = getMinStep(item);
      var decimalQty = allowsDecimalQty(item);
      var qty = normalizeQty(item.quantity || minStep, item, minStep);
      if (qty < minStep) qty = minStep;

      var subtotal = lineTotalRaw(item.price_raw || 0, qty, item.cent || '');
      var subtotalCell = '<span class="qo-subtotal" data-sub="'+subtotal+'">...</span>';

      var qtyHtml =
          '<div class="input-group addtocart qo-qty-group" style="width:160px; max-width:160px; margin-left:auto;">' +
          '  <span class="input-group-btn">' +
          '    <button type="button" class="btn btn-default btn-number qo-qty-minus" data-type="minus">' +
          '      <span class="glyphicon glyphicon-minus"></span>' +
          '    </button>' +
          '  </span>' +
          '  <input type="text"' +
          '         class="form-control input-number qo-qty"' +
          '         value="'+formatQty(qty, decimalQty)+'"' +
          '         min="'+minStep+'"' +
          '         data-minstep="'+minStep+'"' +
          '         data-decimal="'+(decimalQty ? 1 : 0)+'"' +
          '         inputmode="'+(decimalQty ? 'decimal' : 'numeric')+'"' +
          '         style="text-align:right;">' +
          '  <span class="input-group-btn">' +
          '    <button type="button" class="btn btn-default btn-number qo-qty-plus" data-type="plus">' +
          '      <span class="glyphicon glyphicon-plus"></span>' +
          '    </button>' +
          '  </span>' +
          '</div>';

      return '\
        <tr data-id="'+esc(item.product_id)+'" data-price="'+(item.price_raw || 0)+'" data-vpc="'+(item.vpc_raw || 0)+'" data-cent="'+esc(item.cent || '')+'" data-pak="'+(item.pak || 0)+'" data-decimal="'+(decimalQty ? 1 : 0)+'" data-action-net="'+(item.qiqo_action_net_price_raw || 0)+'" '+(added?'data-added="1"':'')+'>\
          <td class="qo-action-cell">'+actionButtonHtml(item)+'</td>\n\
          <td>'+(item.thumb ? '<img src="'+esc(item.thumb)+'" style="width:60px;height:60px;object-fit:cover">' : '')+'</td>\n\
          <td>'+esc(item.sku || '')+'</td>\n\
          <td>'+esc(item.name || '')+'</td>\n\
          <td>'+esc(item.name_add || '')+'</td>\n\
          <td>'+esc(pack || '-')+'</td>\n\
          <td>'+esc(item.cent || '-')+'</td>\n\
          <td>'+qtyHtml+'</td>\n\
          <td class="qo-price">'+displayVpcHtml(item)+'</td>\n\
          <td class="qo-discount-cell'+discountClass(item)+'">'+displayPercent(item.qiqo_discount_percent, '-', item)+'</td>\n\
          <td class="qo-price">'+displayPriceHtml(item)+'</td>\n\
          <td class="qo-total-cell">'+subtotalCell+'</td>\n\
          <td class="qo-remove-cell"><button type="button" class="qo-remove" aria-label="Ukloni">&times;</button></td>\n\
        </tr>';
    }

    function recomputeRow($tr){
      var price = parseFloat($tr.attr('data-price') || '0');
      var $input = $tr.find('.qo-qty');
      var step = parseQty($input.attr('data-minstep') || $input.attr('min') || '1');
      if (isNaN(step) || step <= 0) step = 1;
      var decimalQty = allowsDecimalStep($tr.attr('data-decimal') || $input.attr('data-decimal'), step);
      var itemRule = { decimal_quantity: decimalQty, minimumifc100: step };

      var qty = normalizeQty($input.val() || step, itemRule, step);
      if(isNaN(qty) || qty < step){
        qty = step;
        $input.val(formatQty(step, decimalQty));
      }
      var subtotal = lineTotalRaw(price, qty, $tr.attr('data-cent') || '');
      var $cell = $tr.find('.qo-subtotal');
      $cell.attr('data-sub', subtotal);
      formatCurrency(subtotal, function(txt){ $cell.text(txt).addClass('qo-line-total'); });
    }
    function recomputeTotal(){
      var total = 0;
      $table.find('.qo-subtotal').each(function(){
        total += parseFloat($(this).attr('data-sub') || '0');
      });
      formatCurrency(total, function(txt){ $('#qo-total').text(txt); });
    }
    function refreshRowFromCartState(pid){
      return $.get('index.php?route=extension/module/quick_order/cartState&_=' + Date.now(), function(res){
        if(!res || !res.items) return;
        res.items.forEach(function(it){
          if(String(it.product_id) === String(pid)){
            var $tr = ensureRow(Object.assign({}, it, { added: true }), true);
            var data = getRowData($tr);
            data.added = true;
            upsertLS(Object.assign({}, it, data, { added: true }));
          }
        });
        recomputeTotal();
      }, 'json');
    }

    function ensureRow(item, added){
      var $existing = $table.find('tr[data-id="'+item.product_id+'"]');
      if($existing.length){
        var min = getMinStep(item);
        var decimalQty = allowsDecimalQty(item);
        if(item.quantity){
          item.quantity = normalizeQty(item.quantity, item, min);
          if (item.quantity < min) item.quantity = min;
          $existing.find('.qo-qty')
              .val(formatQty(item.quantity, decimalQty))
              .attr('data-minstep', min)
              .attr('min', min)
              .attr('data-decimal', decimalQty ? 1 : 0)
              .attr('inputmode', decimalQty ? 'decimal' : 'numeric')
              .prop('readonly', false);
        }
        if (item.price_raw != null) {
          $existing.attr('data-price', item.price_raw);
        }
        if (item.vpc_raw != null) {
          $existing.attr('data-vpc', item.vpc_raw);
        }
        if (item.cent != null) {
          $existing.attr('data-cent', item.cent);
        }
        if (item.pak != null) {
          $existing.attr('data-pak', item.pak);
        }
        if (item.decimal_quantity != null) {
          $existing.attr('data-decimal', decimalQty ? 1 : 0);
        }
        if (item.qiqo_action_net_price_raw != null) {
          $existing.attr('data-action-net', item.qiqo_action_net_price_raw);
        }
        if(added){
          $existing.attr('data-added','1').addClass('success');
        }
        var $td = $existing.find('td');
        if (item.qiqo_action != null) {
          $td.eq(0).html(actionButtonHtml(item));
        }
        if (item.sku) {
          $td.eq(2).text(item.sku);
        }
        if (item.name != null) {
          $td.eq(3).text(item.name);
        }
        if (item.name_add != null) {
          $td.eq(4).text(item.name_add);
        }
        if (item.packaging != null || item.minimum) {
          $td.eq(5).text(item.packaging || item.minimum);
        }
        if (item.cent != null) {
          $td.eq(6).text(item.cent || '-');
        }

        if(item.vpc_raw != null || item.vpc != null){
          $td.eq(8).html(displayVpcHtml({
            vpc: item.vpc != null ? item.vpc : $td.eq(8).text()
          }));
        }
        if (item.qiqo_discount_percent != null || item.qiqo_action_net_price_raw != null) {
          $td.eq(9)
              .toggleClass('qo-discount-action', discountClass(item) !== '')
              .text(displayPercent(item.qiqo_discount_percent, '-', item));
        }
        if(item.price_raw != null || item.price != null){
          $td.eq(10).html(displayPriceHtml({
            price: item.price != null ? item.price : $td.eq(10).text(),
            qiqo_action_net_price_raw: item.qiqo_action_net_price_raw != null ? item.qiqo_action_net_price_raw : parseFloat($existing.attr('data-action-net') || '0')
          }));
        }
        recomputeRow($existing);
        return $existing;
      } else {
        var $row = $(rowHtml(item, added));
        $table.prepend($row);
        recomputeRow($row);
        return $row;
      }
    }

    function getRowData($tr){
      var pid  = String($tr.data('id'));
      var $input = $tr.find('.qo-qty');
      var minStep = parseQty($input.attr('data-minstep') || $input.attr('min') || '1');
      if (isNaN(minStep) || minStep <= 0) minStep = 1;
      var decimalQty = allowsDecimalStep($tr.attr('data-decimal') || $input.attr('data-decimal'), minStep);

      var qty  = normalizeQty($input.val() || minStep, { decimal_quantity: decimalQty, minimumifc100: minStep }, minStep);
      if (isNaN(qty) || qty < minStep) qty = minStep;

      var pRaw = parseFloat($tr.attr('data-price') || '0');
      var vpcRaw = parseFloat($tr.attr('data-vpc') || '0');
      var tds  = $tr.find('td');

      var minimumText = tds.eq(5).text().trim().replace(/[^\d.,-]/g, '').replace(',', '.');
      var minimumVal = parseQty(minimumText || minStep);
      if (isNaN(minimumVal) || minimumVal <= 0) minimumVal = minStep;

      return {
        product_id: pid,
        name: tds.eq(3).text().trim(),
        name_add: tds.eq(4).text().trim(),
        packaging: tds.eq(5).text().trim(),
        cent: $tr.attr('data-cent') || tds.eq(6).text().trim(),
        sku:  tds.eq(2).text().trim(),
        qiqo_discount_percent: Math.abs(parseFloat(String(tds.eq(9).text() || '').replace(/[^\d.-]/g, ''))) || 0,
        qiqo_action: !!tds.eq(0).find('.qiqo-action-button').length,
        qiqo_action_net_price_raw: parseFloat($tr.attr('data-action-net') || '0') || 0,
        vpc: tds.eq(8).text().trim(),
        vpc_raw: isNaN(vpcRaw) ? 0 : vpcRaw,
        price: tds.eq(10).text().trim(),
        price_raw: isNaN(pRaw) ? 0 : pRaw,
        quantity: qty,
        minimum: minimumVal,
        minimumifc100: minStep,
        decimal_quantity: decimalQty,
        pak: parseInt($tr.attr('data-pak') || '0', 10) || 0,
        line_total_raw: lineTotalRaw(isNaN(pRaw) ? 0 : pRaw, qty, $tr.attr('data-cent') || ''),
        thumb: (function(){
          var img = tds.eq(1).find('img');
          return img.length ? img.attr('src') : '';
        })()
      };

    }

    /* ===================== Autocomplete rendering ===================== */
    function esc(s){ return String(s==null?'':s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;'); }

    function suggestionHtml(it){
      var pack = it.minimum && it.minimum > 0 ? it.minimum : 1;
      var packaging = it.packaging || pack;
      var minStep = getMinStep(it);
      var decimalQty = allowsDecimalQty(it);
      var qtyVal = normalizeQty(it.quantity && it.quantity >= minStep ? it.quantity : minStep, it, minStep);

      var img = it.thumb
          ? `<img src="${esc(it.thumb)}" alt="${esc(it.name)}" class="qo-thumb">`
          : `<div class="qo-thumb placeholder"><i class="fa fa-box"></i></div>`;

      return `
<div class="list-group-item qo-suggest"
     tabindex="0"
     data-pid="${esc(it.product_id)}"
     data-name="${esc(it.name||'')}"
     data-name_add="${esc(it.name_add||'')}"
     data-minimum="${minStep}"
     data-pack="${pack}"
     data-packaging="${esc(packaging)}"
     data-pak="${Number(it.pak||0)}"
     data-decimal="${decimalQty ? 1 : 0}"
     data-sku="${esc(it.sku||'')}"
     data-price="${esc(it.price||'')}"
     data-priceraw="${Number(it.price_raw||0)}"
     data-vpc="${esc(it.vpc||'')}"
     data-vpcraw="${Number(it.vpc_raw||0)}"
     data-discount="${Number(it.qiqo_discount_percent||0)}"
     data-action="${it.qiqo_action ? 1 : 0}"
     data-action-discount="${Number(it.qiqo_action_discount||0)}"
     data-action-net="${Number(it.qiqo_action_net_price_raw||0)}"
     data-action-conditions="${esc((it.qiqo_action_conditions||[]).join(' | '))}"
     data-thumb="${esc(it.thumb||'')}"
     data-cent="${esc(it.cent||'')}">
      <div class="qo-suggest-inner">
        ${img}
        <div class="qo-info">
          <div class="name">
            ${esc(it.name || '')}
            <small style="color:#777; margin-left:6px;">${esc(it.name_add || '')}</small>
          </div>
          <div class="meta">
            ${(it.sku ? `<span>Šifra: ${esc(it.sku)}</span>` : '')}
            ${(packaging ? `<span>Pakiranje: ${esc(packaging)}</span>` : '')}
            ${(it.vpc ? `<span>VPC: ${esc(it.vpc)}</span>` : '')}
            ${(displayPercent(it.qiqo_discount_percent, '-', it) !== '-' ? `<span>Rabat: ${esc(displayPercent(it.qiqo_discount_percent, '-', it))}</span>` : '')}
            ${(it.price ? `<span class="price">Cijena: ${esc(it.price)}</span>` : '')}
          </div>
        </div>

        <div class="qo-suggest-qty-wrap">
          <button type="button"
                  class="btn btn-default btn-number qo-suggest-btn qo-suggest-minus"
                  data-type="minus"
                  tabindex="0"
                  aria-label="Smanji količinu">
            <span class="glyphicon glyphicon-minus"></span>
          </button>

          <input type="text"
                 class="qo-suggest-qty input-number"
                 min="${minStep}"
                 data-minstep="${minStep}"
                 data-decimal="${decimalQty ? 1 : 0}"
                 value="${formatQty(qtyVal, decimalQty)}"
                 tabindex="0"
                 aria-label="Količina"
                 inputmode="${decimalQty ? 'decimal' : 'numeric'}">

          <button type="button"
                  class="btn btn-default btn-number qo-suggest-btn qo-suggest-plus"
                  data-type="plus"
                  tabindex="0"
                  aria-label="Povećaj količinu">
            <span class="glyphicon glyphicon-plus"></span>
          </button>

          <button class="qo-add-btn btn btn-neutral"
                  tabindex="0"
                  title="Dodaj">
            <span class="global-cart"></span>
          </button>
        </div>
      </div>
    </div>`;
    }


    function itemFromSuggest($s){
      if(!$s || !$s.length) return null;
      var pid = $s.attr('data-pid');
      if(!pid) return null;
      var $qty = $s.find('.qo-suggest-qty');
      var min = parseQty($s.attr('data-minimum') || $qty.attr('data-minstep') || $qty.attr('min') || '1');
      if(isNaN(min) || min <= 0) min = 1;
      var decimalQty = allowsDecimalStep($s.attr('data-decimal') || $qty.attr('data-decimal'), min);
      var pack = parseQty($s.attr('data-pack') || '0');
      if(isNaN(pack) || pack <= 0) pack = min;
      var rawQty = $qty.val() || min;
      var qtyInfo = normalizeQtyInfo(rawQty, { decimal_quantity: decimalQty, minimumifc100: min }, min);
      var q = qtyInfo.qty;
      if(isNaN(q) || q < min) q = min;
      if(qtyInfo.adjusted){
        $qty.val(formatQty(q, decimalQty));
      }

      return {
        product_id: pid,
        name: $s.attr('data-name') || '',
        name_add: $s.attr('data-name_add') || '',
        sku: $s.attr('data-sku') || '',
        price: $s.attr('data-price') || '',
        qiqo_discount_percent: parseFloat($s.attr('data-discount') || '0') || 0,
        qiqo_action: String($s.attr('data-action') || '0') === '1',
        qiqo_action_discount: parseFloat($s.attr('data-action-discount') || '0') || 0,
        qiqo_action_net_price_raw: parseFloat($s.attr('data-action-net') || '0') || 0,
        qiqo_action_conditions: ($s.attr('data-action-conditions') || '').split(' | ').filter(Boolean),
        vpc: $s.attr('data-vpc') || '',
        vpc_raw: parseFloat($s.attr('data-vpcraw') || '0') || 0,
        price_raw: parseFloat($s.attr('data-priceraw') || '0') || 0,
        thumb: $s.attr('data-thumb') || '',
        quantity: q,
        quantity_original: rawQty,
        quantity_adjusted: qtyInfo.adjusted,
        minimum: pack,
        minimumifc100: min,
        decimal_quantity: decimalQty,
        pak: parseInt($s.attr('data-pak') || '0', 10) || 0,
        packaging: $s.attr('data-packaging') || '',
        cent: $s.attr('data-cent') || ''
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

    // promjena količine ↑/↓ u autosuggestu – po koraku minimuma
    function bumpQty($s, delta){
      if(!$s || !$s.length) return;
      openQtyMode($s, true);
      var $qty = $s.find('.qo-suggest-qty');
      var step = parseQty($qty.attr('data-minstep') || $qty.attr('min') || '1');
      if(isNaN(step) || step <= 0) step = 1;
      var decimalQty = allowsDecimalStep($s.attr('data-decimal') || $qty.attr('data-decimal'), step);

      var v = normalizeQty($qty.val() || step, { decimal_quantity: decimalQty, minimumifc100: step }, step);
      if(isNaN(v) || v < step) v = step;

      v += delta * step;
      if(v < step) v = step;
      $qty.val(formatQty(v, decimalQty));
    }

    /* ===================== Tablica qty plus/minus ===================== */
    function changeQtyByStep($input, direction){
      var step = parseQty($input.attr('data-minstep') || $input.attr('min') || '1');
      if (isNaN(step) || step <= 0) step = 1;
      var decimalQty = allowsDecimalStep($input.attr('data-decimal') || $input.closest('tr').attr('data-decimal'), step);

      var v = normalizeQty($input.val() || step, { decimal_quantity: decimalQty, minimumifc100: step }, step);
      if (isNaN(v) || v < step) v = step;

      if (direction === 'up') {
        v += step;
      } else if (direction === 'down') {
        v -= step;
        if (v < step) v = step;
      }

      $input.val(formatQty(v, decimalQty)).trigger('change');
    }

    $(document).on('click', '.qo-qty-plus', function(){
      var $input = $(this).closest('.qo-qty-group').find('.qo-qty');
      changeQtyByStep($input, 'up');
    });

    $(document).on('click', '.qo-qty-minus', function(){
      var $input = $(this).closest('.qo-qty-group').find('.qo-qty');
      changeQtyByStep($input, 'down');
    });

    $(document).on('click', '.quick-order .qiqo-action-button', function(e){
      e.preventDefault();
      e.stopPropagation();
      showActionConditions($(this));
    });

    /* ===== Plus/minus u AUTOSUGGESTU ===== */
    $(document).on('click', '.qo-suggest-plus', function(e){
      e.preventDefault();
      e.stopPropagation();
      var $s = $(this).closest('.qo-suggest');
      bumpQty($s, +1);
    });

    $(document).on('click', '.qo-suggest-minus', function(e){
      e.preventDefault();
      e.stopPropagation();
      var $s = $(this).closest('.qo-suggest');
      bumpQty($s, -1);
    });

    /* ===================== Add u košaricu ===================== */
    function addToCartAndRender(item, qty){
      if(!item || !item.product_id){
        toast('err', 'Nije odabran valjan artikl.');
        return $.Deferred().resolve().promise();
      }
      var min = getMinStep(item);
      qty = normalizeQty(qty || item.quantity || min, item, min);
      if(isNaN(qty) || qty < min) qty = min;

      // ako red već postoji i već je dodan, povećaj količinu (updateQty)
      var $rowExisting = $table.find('tr[data-id="'+item.product_id+'"]');
      var alreadyAdded = $rowExisting.length && $rowExisting.is('[data-added]');
      if (alreadyAdded) {
        var $input = $rowExisting.find('.qo-qty');
        var step = parseQty($input.attr('data-minstep') || $input.attr('min') || '1');
        if(isNaN(step) || step <= 0) step = 1;
        var decimalQty = allowsDecimalStep($rowExisting.attr('data-decimal') || $input.attr('data-decimal'), step);

        var current = normalizeQty($input.val() || step, { decimal_quantity: decimalQty, minimumifc100: step }, step);
        if (isNaN(current) || current < step) current = step;
        var newQty = current + qty;
        if(newQty < step) newQty = step;
        newQty = normalizeQty(newQty, { decimal_quantity: decimalQty, minimumifc100: step }, step);

        if (!window.confirm('Pozor - artikl već postoji u narudžbi s količinom ' + formatQty(current, decimalQty) + '. Želite li nadodati novo unesenu količinu?')) {
          return $.Deferred().resolve().promise();
        }

        var lockKey = String(item.product_id) + '::update';
        if (ADD_LOCK[lockKey]){ return $.Deferred().resolve().promise(); }
        ADD_LOCK[lockKey] = true;

        return $.post('index.php?route=extension/module/quick_order/updateQty', {
          product_id: item.product_id, quantity: newQty
        }, function(res){
          $input.val(formatQty(newQty, decimalQty));
          recomputeRow($rowExisting);
          recomputeTotal();
          var data = getRowData($rowExisting);
          data.added = true;
          data.quantity = newQty;
          upsertLS(data);
          refreshRowFromCartState(item.product_id).always(function(){
            baselHeaderRefreshDebounced();
            toast(cartResultType(res, item), cartResultMessage(res, 'Količina ažurirana.', item), { delay: cartResultDelay(res, item) });
          });
        }, 'json').fail(function(){
          toast('err', 'Greška pri ažuriranju količine');
        }).always(function(){
          delete ADD_LOCK[lockKey];
        });
      }

      // inače – prvi put dodaj (fastAdd)
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
          refreshRowFromCartState(item.product_id).always(function(){
            baselHeaderRefreshDebounced();
            toast(cartResultType(res, item), cartResultMessage(res, 'Dodano u košaricu.', item), { delay: cartResultDelay(res, item) });
          });
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
        var storedItems = loadLS();
        var hasAddedItems = storedItems.some(function(x){ return x && x.added; });
        if(!res.items.length && hasAddedItems){
          clearLS();
          $table.empty();
          recomputeTotal();
          baselHeaderRefreshDebounced();
          return;
        }

        var map = {}; storedItems.forEach(function(x){ map[String(x.product_id)] = x; });
        res.items.forEach(function(it){
          var merged = Object.assign({}, map[String(it.product_id)] || {}, it, { added: true });
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
            items.forEach(function(it){
              if(it && it.minimumifc100 != null){
                var ms = parseQty(it.minimumifc100 || 1);
                if(isNaN(ms) || ms <= 0) ms = 1;
                it.minimumifc100 = ms;
              }
            });
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
      openQtyMode($items.eq(next), false);
      focusSuggest($items.eq(next));
    }

    /* ===================== Tipke u search polju ===================== */
    $(document).on('keydown', '#qo-search', function(e){
      var key = e.key;

      if (key === 'Escape') {
        $list.hide();
        $list.find('.qo-suggest.qty-mode').removeClass('qty-mode');
        return;
      }

      if(key === 'ArrowDown' || key === 'ArrowUp'){ return; }

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

      if(key !== 'Enter') return;
      var proceed = function(){
        var $items = getSuggestItems();
        if($items.length !== 1) return;
        var $only = $items.eq(0);
        e.preventDefault(); e.stopPropagation();
        if(!$only.hasClass('qty-mode')){
          openQtyMode($only, true);
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

      if (key === 'Escape') {
        e.preventDefault();
        e.stopPropagation();
        $list.hide();
        $list.find('.qo-suggest.qty-mode').removeClass('qty-mode');
        $('#qo-search').focus();
        return;
      }

      if(key === 'Tab'){
        e.preventDefault(); e.stopPropagation();
        moveSuggest(e.shiftKey ? -1 : 1);
        return;
      }

      if(key === 'ArrowDown'){
        e.preventDefault(); e.stopPropagation();
        var $sD = $(this).closest('.qo-suggest');
        bumpQty($sD, -1); // po step-u
        return;
      }
      if(key === 'ArrowUp'){
        e.preventDefault(); e.stopPropagation();
        var $sU = $(this).closest('.qo-suggest');
        bumpQty($sU, +1); // po step-u
        return;
      }

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
      if($(e.target).closest('.qo-suggest-qty, .qo-add-btn, .qo-suggest-plus, .qo-suggest-minus').length) return;
      openQtyMode($(this), true);
    });

    /* ===================== Tablica: qty/remove/clear ===================== */
    $(document).on('change', '.qo-qty', function(){
      var $tr = $(this).closest('tr');
      var pid = $tr.data('id');

      var $input = $(this);
      var step = parseQty($input.attr('data-minstep') || $input.attr('min') || '1');
      if(isNaN(step) || step <= 0) step = 1;
      var decimalQty = allowsDecimalStep($tr.attr('data-decimal') || $input.attr('data-decimal'), step);

      var rawQty = $input.val();
      var qtyInfo = normalizeQtyInfo(rawQty || step, { decimal_quantity: decimalQty, minimumifc100: step }, step);
      var qty = qtyInfo.qty;
      if(qty < step) qty = step;
      $input.val(formatQty(qty, decimalQty));
      if(qtyInfo.adjusted){
        notifyRoundedQty(qty, decimalQty, rawQty, step);
      }

      recomputeRow($tr);
      recomputeTotal();

      var data = getRowData($tr);
      if($tr.attr('data-added')) data.added = true;
      upsertLS(data);

      if($tr.attr('data-added')){
        $.post('index.php?route=extension/module/quick_order/updateQty', { product_id: pid, quantity: qty }, function(res){
          if(res && res.notice && !qtyInfo.adjusted){
            toast('warn', res.notice, { delay: 9000 });
          }
          refreshRowFromCartState(pid).always(function(){
            baselHeaderRefreshDebounced();
          });
        }, 'json');
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
