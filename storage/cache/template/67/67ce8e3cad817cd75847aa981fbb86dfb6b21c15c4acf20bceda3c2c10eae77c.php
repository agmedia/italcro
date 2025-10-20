<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* basel/template/extension/module/basel_products.twig */
class __TwigTemplate_99e373a06c62b1a46249a6476629cc01ea88ddd4ff9444dffcb6fb9e4b06cdb1 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div class=\"widget module";
        echo ($context["module"] ?? null);
        echo " ";
        if ((($context["columns"] ?? null) != "list")) {
            echo " grid";
        }
        if (($context["contrast"] ?? null)) {
            echo " contrast-bg";
        }
        if ((($context["carousel"] ?? null) && (($context["rows"] ?? null) > 1))) {
            echo "  multiple-rows";
        }
        echo "\" ";
        if (($context["use_margin"] ?? null)) {
            echo "style=\"margin-bottom: ";
            echo ($context["margin"] ?? null);
            echo "\"";
        }
        echo "> 
";
        // line 2
        if (($context["block_title"] ?? null)) {
            // line 3
            echo "<!-- Block Title -->
<div class=\"widget-title\">
";
            // line 5
            if (($context["title_preline"] ?? null)) {
                echo "<p class=\"pre-line\">";
                echo ($context["title_preline"] ?? null);
                echo "</p>";
            }
            // line 6
            if (($context["title"] ?? null)) {
                echo " 
<h2 class=\"main-title\"><span>";
                // line 7
                echo ($context["title"] ?? null);
                echo "</span></h2>
<p class=\"widget-title-separator\"></p>
";
            }
            // line 10
            if (($context["title_subline"] ?? null)) {
                // line 11
                echo "<p class=\"sub-line\"><span>";
                echo ($context["title_subline"] ?? null);
                echo "</span></p>
";
            }
            // line 13
            echo "</div>
";
        }
        // line 15
        if ((twig_length_filter($this->env, ($context["tabs"] ?? null)) > 1)) {
            // line 16
            echo "<!-- Tabs -->
<ul id=\"tabs-";
            // line 17
            echo ($context["module"] ?? null);
            echo "\" class=\"nav nav-tabs ";
            echo ($context["tabstyle"] ?? null);
            echo "\" data-tabs=\"tabs\" style=\"\">
    ";
            // line 18
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["tabs"] ?? null));
            foreach ($context['_seq'] as $context["keyTab"] => $context["tab"]) {
                // line 19
                echo "        ";
                if (($context["keyTab"] == 0)) {
                    // line 20
                    echo "        <li class=\"active\"><a href=\"#tab";
                    echo ($context["module"] ?? null);
                    echo $context["keyTab"];
                    echo "\" data-toggle=\"tab\">";
                    echo twig_get_attribute($this->env, $this->source, $context["tab"], "title", [], "any", false, false, false, 20);
                    echo "</a></li>
        ";
                } else {
                    // line 22
                    echo "        <li><a href=\"#tab";
                    echo ($context["module"] ?? null);
                    echo $context["keyTab"];
                    echo "\" data-toggle=\"tab\">";
                    echo twig_get_attribute($this->env, $this->source, $context["tab"], "title", [], "any", false, false, false, 22);
                    echo "</a></li>
        ";
                }
                // line 24
                echo "    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['keyTab'], $context['tab'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 25
            echo "</ul>
";
        }
        // line 27
        echo "<div class=\"tab-content has-carousel ";
        if ( !($context["carousel"] ?? null)) {
            echo "overflow-hidden";
        }
        echo "\">
<!-- Product Group(s) -->
";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["tabs"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["tab"]) {
            // line 30
            echo "<div class=\"tab-pane";
            if (($context["key"] == 0)) {
                echo " active in";
            }
            echo " fade\" id=\"tab";
            echo ($context["module"] ?? null);
            echo $context["key"];
            echo "\">
    <div class=\"grid-holder grid";
            // line 31
            echo ($context["columns"] ?? null);
            echo " prod_module";
            echo ($context["module"] ?? null);
            if (($context["carousel"] ?? null)) {
                echo " carousel";
            }
            if ((($context["carousel_a"] ?? null) && (($context["rows"] ?? null) > 1))) {
                echo " sticky-arrows";
            }
            echo "\">
        ";
            // line 32
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["tab"], "products", [], "any", false, false, false, 32));
            foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
                // line 33
                echo "            <div class=\"item single-product\">
                  <div class=\"edge\">
            <div class=\"image\"";
                // line 35
                if ((($context["columns"] ?? null) == "list")) {
                    echo " style=\"width:";
                    echo ($context["img_width"] ?? null);
                    echo "px\"";
                }
                echo ">
                <a href=\"";
                // line 36
                echo twig_get_attribute($this->env, $this->source, $context["product"], "href", [], "any", false, false, false, 36);
                echo "\">
                <img src=\"";
                // line 37
                echo twig_get_attribute($this->env, $this->source, $context["product"], "thumb", [], "any", false, false, false, 37);
                echo "\" data-poip-product-id=\"";
                echo (($__internal_compile_0 = $context["product"]) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["product_id"] ?? null) : null);
                echo "\" ";
                if ((((twig_get_attribute($this->env, $this->source, $context["product"], "poip_images", [], "any", true, true, false, 37) &&  !(null === twig_get_attribute($this->env, $this->source, $context["product"], "poip_images", [], "any", false, false, false, 37)))) ? (twig_get_attribute($this->env, $this->source, $context["product"], "poip_images", [], "any", false, false, false, 37)) : (false))) {
                    echo " data-poip-images=\"";
                    echo twig_escape_filter($this->env, json_encode(twig_get_attribute($this->env, $this->source, $context["product"], "poip_images", [], "any", false, false, false, 37)));
                    echo "\" ";
                }
                echo " alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 37);
                echo "\" loading=\"lazy\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 37);
                echo "\" />
                ";
                // line 38
                if (twig_get_attribute($this->env, $this->source, $context["product"], "thumb2", [], "any", false, false, false, 38)) {
                    // line 39
                    echo "                <img class=\"thumb2\" src=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "thumb2", [], "any", false, false, false, 39);
                    echo "\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 39);
                    echo "\" loading=\"lazy\" title=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 39);
                    echo "\" />
                ";
                }
                // line 41
                echo "                </a>
            ";
                // line 42
                if (((twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 42) && twig_get_attribute($this->env, $this->source, $context["product"], "special", [], "any", false, false, false, 42)) && twig_get_attribute($this->env, $this->source, $context["product"], "sale_badge", [], "any", false, false, false, 42))) {
                    // line 43
                    echo "                <div class=\"sale-counter id";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 43);
                    echo "\"></div>
\t\t\t\t<span class=\"badge sale_badge\"><i>";
                    // line 44
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "sale_badge", [], "any", false, false, false, 44);
                    echo "</i></span>
            ";
                }
                // line 46
                echo "            ";
                if (twig_get_attribute($this->env, $this->source, $context["product"], "new_label", [], "any", false, false, false, 46)) {
                    // line 47
                    echo "                <span class=\"badge new_badge\"><i>";
                    echo ($context["basel_text_new"] ?? null);
                    echo "</i></span>
            ";
                }
                // line 49
                echo "
                            

         
\t\t\t
\t\t\t\t";
                // line 54
                $context["button_cart"] = ($context["default_button_cart"] ?? null);
                // line 55
                echo "\t\t\t
          
            <div class=\"btn-center catalog_hide\"><a class=\"btn btn-light-outline btn-thin\" onclick=\"cart.add('";
                // line 57
                echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 57);
                echo "', '";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "minimum", [], "any", false, false, false, 57);
                echo "');\">";
                echo ($context["button_cart"] ?? null);
                echo "</a></div>
            <div class=\"icons-wrapper\">
           
       <a class=\"icon is_wishlist\" data-toggle=\"tooltip\" data-placement=\"";
                // line 60
                echo ($context["tooltip_align"] ?? null);
                echo "\"  data-title=\"";
                echo ($context["button_wishlist"] ?? null);
                echo "\" onclick=\"wishlist.add('";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 60);
                echo "');\"><span class=\"icon-heart\"></span></a>
<a class=\"icon is_compare\" onclick=\"compare.add('";
                // line 61
                echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 61);
                echo "');\" data-toggle=\"tooltip\" data-placement=\"";
                echo ($context["tooltip_align"] ?? null);
                echo "\" data-title=\"";
                echo ($context["button_compare"] ?? null);
                echo "\"><span class=\"icon-refresh\"></span></a>

            </div> <!-- .icons-wrapper -->
            </div><!-- .image ends -->
            <div class=\"caption\">
            <h3 class=\"product-name\"><a href=\"";
                // line 66
                echo twig_get_attribute($this->env, $this->source, $context["product"], "href", [], "any", false, false, false, 66);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 66);
                echo "</a></h3>
            ";
                // line 67
                if (twig_get_attribute($this->env, $this->source, $context["product"], "rating", [], "any", false, false, false, 67)) {
                    echo "      
                <div class=\"rating\">
                <span class=\"rating_stars rating r";
                    // line 69
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "rating", [], "any", false, false, false, 69);
                    echo "\">
                <i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i>
                </span>
                </div>
            ";
                }
                // line 74
                echo "       
        
            <div class=\"price-wrapper\">
            ";
                // line 77
                if ((twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 77) && (twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 77) != "0,00€"))) {
                    // line 78
                    echo "            <div class=\"pwrap\">
               <div class=\"price\">
                                            ";
                    // line 80
                    if ( !twig_get_attribute($this->env, $this->source, $context["product"], "special", [], "any", false, false, false, 80)) {
                        // line 81
                        echo "                                                <span>";
                        echo twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 81);
                        echo "</span>
                                            ";
                    } else {
                        // line 83
                        echo "                                                <span class=\"price-old\">";
                        echo twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 83);
                        echo "</span><span class=\"price-new\">";
                        echo twig_get_attribute($this->env, $this->source, $context["product"], "special", [], "any", false, false, false, 83);
                        echo "</span>
                                            ";
                    }
                    // line 85
                    echo "                                            ";
                    if (twig_get_attribute($this->env, $this->source, $context["product"], "tax", [], "any", false, false, false, 85)) {
                        // line 86
                        echo "                                                <span class=\"price-tax\">";
                        echo ($context["text_tax"] ?? null);
                        echo " ";
                        echo twig_get_attribute($this->env, $this->source, $context["product"], "tax", [], "any", false, false, false, 86);
                        echo "</span>
                                            ";
                    }
                    // line 88
                    echo "                                        </div><!-- .price -->
            </div>
            ";
                }
                // line 91
                echo "            <p class=\"description\">";
                if (twig_get_attribute($this->env, $this->source, $context["product"], "description", [], "any", false, false, false, 91)) {
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "description", [], "any", false, false, false, 91);
                }
                echo "</p>


               ";
                // line 94
                if ((twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 94) == "0,00€")) {
                    // line 95
                    echo "
<a class=\"btn  ";
                    // line 96
                    if ((($context["basel_list_style"] ?? null) == "6")) {
                        echo "btn-contrast";
                    } else {
                        echo "btn-outline";
                    }
                    echo "\" title=\"";
                    echo ($context["button_cart"] ?? null);
                    echo "\" ><span class=\"global-cart\"></span> ";
                    echo ($context["basel_cijena"] ?? null);
                    echo "</a>
   ";
                } else {
                    // line 98
                    echo "            
";
                    // line 99
                    if (((twig_get_attribute($this->env, $this->source, $context["product"], "quantity", [], "any", false, false, false, 99) < 1) && ($context["stock_badge_status"] ?? null))) {
                        // line 100
                        echo " <a class=\"btn  ";
                        if ((($context["basel_list_style"] ?? null) == "6")) {
                            echo "btn-contrast";
                        } else {
                            echo "btn-outline";
                        }
                        echo "\" href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["product"], "href", [], "any", false, false, false, 100);
                        echo "\" title=\"";
                        echo ($context["button_cart"] ?? null);
                        echo "\"><span class=\"global-cart\"></span> ";
                        echo ($context["button_cart"] ?? null);
                        echo "</a>
    ";
                        // line 101
                        $context["button_cart"] = ($context["basel_text_out_of_stock"] ?? null);
                    } else {
                        // line 103
                        echo " <a class=\"btn  ";
                        if ((($context["basel_list_style"] ?? null) == "6")) {
                            echo "btn-contrast";
                        } else {
                            echo "btn-outline";
                        }
                        echo "\" href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["product"], "href", [], "any", false, false, false, 103);
                        echo "\" title=\"";
                        echo ($context["button_cart"] ?? null);
                        echo "\"><span class=\"global-cart\"></span> ";
                        echo ($context["button_cart"] ?? null);
                        echo "</a>
";
                    }
                    // line 105
                    echo "
";
                }
                // line 107
                echo "
            </div><!-- .price-wrapper -->

             

            
            <div class=\"plain-links\">
        
            </div><!-- .plain-links-->
            </div><!-- .caption-->
            ";
                // line 117
                if ((twig_get_attribute($this->env, $this->source, $context["product"], "sale_end_date", [], "any", false, false, false, 117) && ($context["countdown_status"] ?? null))) {
                    // line 118
                    echo "            <script>
\t\t\t  \$(function() {
\t\t\t\t\$(\".module";
                    // line 120
                    echo ($context["module"] ?? null);
                    echo " .sale-counter.id";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 120);
                    echo "\").countdown(\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "sale_end_date", [], "any", false, false, false, 120);
                    echo "\").on('update.countdown', function(event) {
\t\t\t  var \$this = \$(this).html(event.strftime(''
\t\t\t\t+ '<div>'
\t\t\t\t+ '%D<i>";
                    // line 123
                    echo ($context["basel_text_days"] ?? null);
                    echo "</i></div><div>'
\t\t\t\t+ '%H <i>";
                    // line 124
                    echo ($context["basel_text_hours"] ?? null);
                    echo "</i></div><div>'
\t\t\t\t+ '%M <i>";
                    // line 125
                    echo ($context["basel_text_mins"] ?? null);
                    echo "</i></div><div>'
\t\t\t\t+ '%S <i>";
                    // line 126
                    echo ($context["basel_text_secs"] ?? null);
                    echo "</i></div></div>'));
\t\t\t});
\t\t\t  });
\t\t\t</script>
            ";
                }
                // line 131
                echo "            </div>
            </div><!-- .single-product ends -->
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 134
            echo "    </div>
</div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['tab'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 137
        if (($context["use_button"] ?? null)) {
            // line 138
            echo "<!-- Button -->
<div class=\"widget_bottom_btn ";
            // line 139
            if ((($context["carousel"] ?? null) && ($context["carousel_b"] ?? null))) {
                echo "has-dots";
            }
            echo "\">
<a class=\"btn btn-contrast\" href=\"";
            // line 140
            echo ((($context["link_href"] ?? null)) ? (($context["link_href"] ?? null)) : (""));
            echo "\">";
            echo ($context["link_title"] ?? null);
            echo "</a>
</div>
";
        }
        // line 143
        echo "</div>
<div class=\"clearfix\"></div>
</div>
";
        // line 146
        if (($context["carousel"] ?? null)) {
            // line 147
            echo "<script>
\$('.grid-holder.prod_module";
            // line 148
            echo ($context["module"] ?? null);
            echo "').slick({
    accessibility: false,
";
            // line 150
            if (($context["carousel_a"] ?? null)) {
                // line 151
                echo "prevArrow: \"<a class=\\\"arrow-left icon-arrow-left\\\"></a>\",
nextArrow: \"<a class=\\\"arrow-right icon-arrow-right\\\"></a>\",
";
            } else {
                // line 154
                echo "arrows: false,
";
            }
            // line 156
            if ((($context["direction"] ?? null) == "rtl")) {
                // line 157
                echo "rtl: true,
";
            }
            // line 159
            if (($context["carousel_b"] ?? null)) {
                // line 160
                echo "dots:true,
";
            }
            // line 162
            echo "respondTo:'min',
rows:";
            // line 163
            echo ($context["rows"] ?? null);
            echo ",
";
            // line 164
            if ((($context["columns"] ?? null) == "5")) {
                // line 165
                echo "slidesToShow:5,slidesToScroll:5,responsive:[{breakpoint:1100,settings:{slidesToShow:4,slidesToScroll:4}},{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
";
            } elseif ((            // line 166
($context["columns"] ?? null) == "4")) {
                // line 167
                echo "slidesToShow:4,slidesToScroll:4,responsive:[{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
";
            } elseif ((            // line 168
($context["columns"] ?? null) == "3")) {
                // line 169
                echo "slidesToShow:3,slidesToScroll:3,responsive:[{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
";
            } elseif ((            // line 170
($context["columns"] ?? null) == "2")) {
                // line 171
                echo "slidesToShow:2,slidesToScroll:2,responsive:[
";
            } elseif (((            // line 172
($context["columns"] ?? null) == "1") || (($context["columns"] ?? null) == "list"))) {
                // line 173
                echo "adaptiveHeight:true,slidesToShow:1,slidesToScroll:1,responsive:[
";
            }
            // line 175
            if (($context["items_mobile_fw"] ?? null)) {
                // line 176
                echo "{breakpoint:420,settings:{slidesToShow:1,slidesToScroll:1}}
";
            }
            // line 178
            echo "]
});
\$('.product-style2 .single-product .icon').attr('data-placement', 'top');
\$('[data-toggle=\\'tooltip\\']').tooltip({container: 'body'});
";
            // line 182
            if ((($context["carousel_a"] ?? null) && (($context["rows"] ?? null) > 1))) {
                // line 183
                echo "\$(window).load(function() {
var p_c_o = \$('.prod_module";
                // line 184
                echo ($context["module"] ?? null);
                echo "').offset().top;
var p_c_o_b = \$('.prod_module";
                // line 185
                echo ($context["module"] ?? null);
                echo "').offset().top + \$('.prod_module";
                echo ($context["module"] ?? null);
                echo "').outerHeight(true) - 100;
var p_sticky_arrows = function(){
var p_m_o = \$(window).scrollTop() + (\$(window).height()/2);
if (p_m_o > p_c_o && p_m_o < p_c_o_b) {
\$('.prod_module";
                // line 189
                echo ($context["module"] ?? null);
                echo " .slick-arrow').addClass('visible').css('top', p_m_o - p_c_o + 'px');
} else {
\$('.prod_module";
                // line 191
                echo ($context["module"] ?? null);
                echo " .slick-arrow').removeClass('visible');
}
};
\$(window).scroll(function() {p_sticky_arrows();});
});
";
            }
            // line 197
            echo "</script>
";
        }
    }

    public function getTemplateName()
    {
        return "basel/template/extension/module/basel_products.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  617 => 197,  608 => 191,  603 => 189,  594 => 185,  590 => 184,  587 => 183,  585 => 182,  579 => 178,  575 => 176,  573 => 175,  569 => 173,  567 => 172,  564 => 171,  562 => 170,  559 => 169,  557 => 168,  554 => 167,  552 => 166,  549 => 165,  547 => 164,  543 => 163,  540 => 162,  536 => 160,  534 => 159,  530 => 157,  528 => 156,  524 => 154,  519 => 151,  517 => 150,  512 => 148,  509 => 147,  507 => 146,  502 => 143,  494 => 140,  488 => 139,  485 => 138,  483 => 137,  475 => 134,  467 => 131,  459 => 126,  455 => 125,  451 => 124,  447 => 123,  437 => 120,  433 => 118,  431 => 117,  419 => 107,  415 => 105,  399 => 103,  396 => 101,  381 => 100,  379 => 99,  376 => 98,  363 => 96,  360 => 95,  358 => 94,  349 => 91,  344 => 88,  336 => 86,  333 => 85,  325 => 83,  319 => 81,  317 => 80,  313 => 78,  311 => 77,  306 => 74,  298 => 69,  293 => 67,  287 => 66,  275 => 61,  267 => 60,  257 => 57,  253 => 55,  251 => 54,  244 => 49,  238 => 47,  235 => 46,  230 => 44,  225 => 43,  223 => 42,  220 => 41,  210 => 39,  208 => 38,  192 => 37,  188 => 36,  180 => 35,  176 => 33,  172 => 32,  160 => 31,  150 => 30,  146 => 29,  138 => 27,  134 => 25,  128 => 24,  119 => 22,  110 => 20,  107 => 19,  103 => 18,  97 => 17,  94 => 16,  92 => 15,  88 => 13,  82 => 11,  80 => 10,  74 => 7,  70 => 6,  64 => 5,  60 => 3,  58 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/extension/module/basel_products.twig", "");
    }
}
