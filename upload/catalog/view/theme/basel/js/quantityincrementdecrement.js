function increment(quantity){
  UpdateQuantity(quantity.find('.input-number'),!0);
}
function descrement(quantity){
	UpdateQuantity(quantity.find('.input-number'),!1);
}
function qiqoParseQty(n){n=String(null==n?"":n).replace(/\s|\u00a0/g,"");-1!==n.indexOf(",")&&(n=n.replace(/\./g,"").replace(",","."));n=parseFloat(n);return isNaN(n)?0:n}
function qiqoDecimalQty(t){return"1"===String(t.attr("data-decimal-quantity")||t.attr("data-decimal")||"0")}
function qiqoFormatQty(n,t){n=Math.round(qiqoParseQty(n)*1e4)/1e4;if(!t)return String(Math.ceil(n-1e-7));return Math.abs(n-Math.round(n))<1e-5?String(Math.round(n)):n.toFixed(4).replace(/\.?0+$/,"").replace(".",",")}
function UpdateQuantity(t,n){var d=qiqoDecimalQty(t),i=getQuantity(t),s=getStep(t),m=getMin(t);i+=s*(n?1:-1),m>i&&(i=m),t.attr("value",qiqoFormatQty(i,d)).val(qiqoFormatQty(i,d))}
function getQuantity(t){var d=qiqoDecimalQty(t),n=qiqoParseQty(t.val()),m=getMin(t);return(isNaN(n)||m>n)&&(n=m),d?n:Math.ceil(n-1e-7)}
function getStep(t){var n=qiqoParseQty(t.attr("min-step")||t.attr("step")||"1");return(isNaN(n)||0>=n)&&(n=1),n}
function getMin(t){var n=qiqoParseQty(t.attr("min")||"1");return(isNaN(n)||0>=n)&&(n=1),n}
function quantity_increment(t){UpdateQuantity(t.find(".product-quantity"),!0)}
function quantity_decrement(t){UpdateQuantity(t.find(".product-quantity"),!1)}
