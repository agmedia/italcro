(function(window, $) {
	var qiqoToastTimer = null;

	function qiqoParseQty(value) {
		value = String(value == null ? '' : value).replace(/\s|\u00a0/g, '');

		if (value.indexOf(',') !== -1 && value.indexOf('.') !== -1) {
			if (value.lastIndexOf(',') > value.lastIndexOf('.')) {
				value = value.replace(/\./g, '').replace(',', '.');
			} else {
				value = value.replace(/,/g, '');
			}
		} else if (value.indexOf(',') !== -1) {
			value = value.replace(',', '.');
		}

		value = parseFloat(value);
		return isNaN(value) ? 0 : value;
	}

	function qiqoRoundQty(value) {
		return Math.round(qiqoParseQty(value) * 10000) / 10000;
	}

	function qiqoHasDecimal(value) {
		value = qiqoParseQty(value);
		return Math.abs(value - Math.round(value)) > 0.00001;
	}

	function getStep($input) {
		var step = qiqoParseQty($input.attr('min-step') || $input.attr('data-minstep') || $input.attr('step') || $input.attr('min') || '1');
		return step > 0 ? step : 1;
	}

	function getMin($input) {
		var min = qiqoParseQty($input.attr('min') || $input.attr('data-minstep') || $input.attr('min-step') || '1');
		return min > 0 ? min : getStep($input);
	}

	function qiqoDecimalQty($input) {
		return String($input.attr('data-decimal-quantity') || $input.attr('data-decimal') || '0') === '1'
			|| qiqoHasDecimal(getStep($input))
			|| qiqoHasDecimal(getMin($input));
	}

	function qiqoFormatQty(value, allowDecimal) {
		value = qiqoRoundQty(value);

		if (!allowDecimal) {
			return String(Math.ceil(value - 0.0000001));
		}

		if (Math.abs(value - Math.round(value)) < 0.00001) {
			return String(Math.round(value));
		}

		return value.toFixed(4).replace(/\.?0+$/, '').replace('.', ',');
	}

	function qiqoCartQtyValue(value) {
		value = qiqoRoundQty(value);
		return value.toFixed(4).replace(/\.?0+$/, '');
	}

	function qiqoNormalizeQuantityInput(input) {
		var $input = $(input);
		var step = getStep($input);
		var min = getMin($input);
		var allowDecimal = qiqoDecimalQty($input);
		var originalText = String($input.val() == null ? '' : $input.val());
		var original = qiqoParseQty(originalText);
		var quantity = original;

		if (!originalText.trim() || quantity <= 0 || quantity < min) {
			quantity = min;
		}

		if (step > 0) {
			quantity = Math.ceil((quantity / step) - 0.0000001) * step;
		}

		if (quantity < min) {
			quantity = Math.ceil((min / step) - 0.0000001) * step;
		}

		if (!allowDecimal) {
			quantity = Math.ceil(quantity - 0.0000001);
		}

		quantity = qiqoRoundQty(quantity);

		return {
			quantity: quantity,
			value: qiqoCartQtyValue(quantity),
			display: qiqoFormatQty(quantity, allowDecimal),
			changed: !originalText.trim() || Math.abs(quantity - original) > 0.00001
		};
	}

	function qiqoShowQuantityNotice(displayValue) {
		var message = 'Količina je zaokružena na ' + displayValue + ' prema dozvoljenom koraku pakiranja.';

		if ($('#qo-toast').length) {
			var $toast = $('#qo-toast');
			var $close = $('<button type="button" class="close" aria-label="Zatvori">&times;</button>');

			clearTimeout(qiqoToastTimer);
			$close.on('click', function() {
				clearTimeout(qiqoToastTimer);
				$toast.stop(true, true).fadeOut(150);
			});

			$toast
				.stop(true, true)
				.removeClass('alert-danger alert-success alert-warning alert-dismissible')
				.addClass('alert-warning alert-dismissible')
				.empty()
				.append($close)
				.append($('<span class="qo-toast-text"></span>').text(message))
				.fadeIn(150);
			qiqoToastTimer = setTimeout(function() { $toast.fadeOut(300); }, 9000);
			return;
		}

		$('.qiqo-qty-notice').remove();
		var $target = $('#content').parent();
		if (!$target.length) {
			$target = $('.container').first();
		}

		$target.before('<div class="alert alert-info alert-dismissible qiqo-qty-notice"><i class="fa fa-info-circle"></i> ' + message + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
		setTimeout(function() { $('.qiqo-qty-notice').fadeOut(300, function() { $(this).remove(); }); }, 4000);
	}

	function qiqoPrepareQuantityInput(input, notify) {
		var $input = $(input);
		var normalized = qiqoNormalizeQuantityInput($input);
		$input.val(normalized.display).attr('value', normalized.display);

		if (notify && normalized.changed) {
			qiqoShowQuantityNotice(normalized.display);
		}

		return normalized.value;
	}

	function UpdateQuantity(input, up) {
		var $input = $(input);
		var normalized = qiqoNormalizeQuantityInput($input);
		var step = getStep($input);
		var next = normalized.quantity + (up ? step : -step);
		var min = getMin($input);

		if (next < min) {
			next = min;
		}

		$input.val(qiqoFormatQty(next, qiqoDecimalQty($input))).attr('value', qiqoFormatQty(next, qiqoDecimalQty($input)));
	}

	function increment(quantity) {
		UpdateQuantity($(quantity).find('.input-number'), true);
	}

	function descrement(quantity) {
		UpdateQuantity($(quantity).find('.input-number'), false);
	}

	function quantity_increment(quantity) {
		UpdateQuantity($(quantity).find('.product-quantity'), true);
	}

	function quantity_decrement(quantity) {
		UpdateQuantity($(quantity).find('.product-quantity'), false);
	}

	window.qiqoParseQty = qiqoParseQty;
	window.qiqoFormatQty = qiqoFormatQty;
	window.qiqoPrepareQuantityInput = qiqoPrepareQuantityInput;
	window.qiqoNormalizeQuantityInput = qiqoNormalizeQuantityInput;
	window.qiqoShowQuantityNotice = qiqoShowQuantityNotice;
	window.UpdateQuantity = UpdateQuantity;
	window.increment = increment;
	window.descrement = descrement;
	window.quantity_increment = quantity_increment;
	window.quantity_decrement = quantity_decrement;

	$(document).on('change blur', '.mpn-qty-input, .single-product .input-number, #input-quantity', function() {
		qiqoPrepareQuantityInput(this, true);
	});
})(window, jQuery);
