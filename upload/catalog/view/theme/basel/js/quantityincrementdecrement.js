function increment(quantity){
  UpdateQuantity(quantity.find('.input-number'),!0);
}
function descrement(quantity){
	UpdateQuantity(quantity.find('.input-number'),!1);
}
function UpdateQuantity(t,n){var i=getQuantity(t),s=getStep(t),m=getMin(t);i+=s*(n?1:-1),m>i&&(i=m),t.attr("value",i.toString()).val(i.toString())}
function getQuantity(t){var n=parseInt(t.val(),10),m=getMin(t);return(isNaN(n)||m>n)&&(n=m),n}
function getStep(t){var n=parseInt(t.attr("min-step")||t.attr("step")||"1",10);return(isNaN(n)||1>n)&&(n=1),n}
function getMin(t){var n=parseInt(t.attr("min")||"1",10);return(isNaN(n)||1>n)&&(n=1),n}
function quantity_increment(t){UpdateQuantity(t.find(".product-quantity"),!0)}
function quantity_decrement(t){UpdateQuantity(t.find(".product-quantity"),!1)}
