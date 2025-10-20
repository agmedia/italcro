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

/* basel/template/product/single_product.twig */
class __TwigTemplate_8140767cb269471e5edcb57aaddce97a9f55b48d1f263dc900717a0d6a9ce77e extends \Twig\Template
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
        echo "<div class=\"item single-product\">
    <div class=\"edge\">
<div class=\"image\" ";
        // line 3
        if ((($context["columns"] ?? null) == "list")) {
            echo "style=\"width:";
            echo ($context["img_width"] ?? null);
            echo "px\"";
        }
        echo ">
    <a href=\"";
        // line 4
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "href", [], "any", false, false, false, 4);
        echo "\">
    <img src=\"";
        // line 5
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "thumb", [], "any", false, false, false, 5);
        echo "\" alt=\"";
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "name", [], "any", false, false, false, 5);
        echo "\" loading=\"lazy\" title=\"";
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "name", [], "any", false, false, false, 5);
        echo "\" />
    ";
        // line 6
        if (twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "thumb2", [], "any", false, false, false, 6)) {
            // line 7
            echo "    <img class=\"thumb2\" src=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "thumb2", [], "any", false, false, false, 7);
            echo "\" loading=\"lazy\" alt=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "name", [], "any", false, false, false, 7);
            echo "\" title=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "name", [], "any", false, false, false, 7);
            echo "\" />
    ";
        }
        // line 9
        echo "    </a>
";
        // line 10
        if (((twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "price", [], "any", false, false, false, 10) && twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "special", [], "any", false, false, false, 10)) && ($context["salebadge_status"] ?? null))) {
            // line 11
            echo "    <div class=\"sale-counter id";
            echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "product_id", [], "any", false, false, false, 11);
            echo "\"></div>
    <span class=\"badge sale_badge\"><i>";
            // line 12
            echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "sale_badge", [], "any", false, false, false, 12);
            echo "</i></span>
";
        }
        // line 14
        if (twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "new_label", [], "any", false, false, false, 14)) {
            // line 15
            echo "    <span class=\"badge new_badge\"><i>";
            echo ($context["basel_text_new"] ?? null);
            echo "</i></span>
";
        }
        // line 17
        echo "
                 


    ";
        // line 21
        $context["button_cart"] = ($context["default_button_cart"] ?? null);
        // line 22
        echo "
<a class=\"img-overlay\" title=\"";
        // line 23
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "name", [], "any", false, false, false, 23);
        echo "\" href=\"";
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "href", [], "any", false, false, false, 23);
        echo "\"></a>

<div class=\"icons-wrapper\">
<a class=\"icon is_wishlist\" data-toggle=\"tooltip\" data-placement=\"";
        // line 26
        echo ($context["tooltip_align"] ?? null);
        echo "\"  data-title=\"";
        echo ($context["button_wishlist"] ?? null);
        echo "\" onclick=\"wishlist.add('";
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "product_id", [], "any", false, false, false, 26);
        echo "');\"><span class=\"icon-heart\"></span></a>
<a class=\"icon is_compare\" onclick=\"compare.add('";
        // line 27
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "product_id", [], "any", false, false, false, 27);
        echo "');\" data-toggle=\"tooltip\" data-placement=\"";
        echo ($context["tooltip_align"] ?? null);
        echo "\" data-title=\"";
        echo ($context["button_compare"] ?? null);
        echo "\"><span class=\"icon-refresh\"></span></a>
<a class=\"icon is_quickview hidden-xs\" onclick=\"quickview('";
        // line 28
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "product_id", [], "any", false, false, false, 28);
        echo "');\" data-toggle=\"tooltip\" data-placement=\"";
        echo ($context["tooltip_align"] ?? null);
        echo "\" data-title=\"";
        echo ($context["basel_button_quickview"] ?? null);
        echo "\"><span class=\"icon-magnifier-add\"></span></a>
</div> <!-- .icons-wrapper -->
</div><!-- .image ends -->
<div class=\"caption\">
<h3 class=\"product-name\"><a href=\"";
        // line 32
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "href", [], "any", false, false, false, 32);
        echo "\">";
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "name", [], "any", false, false, false, 32);
        echo "</a></h3>
";
        // line 33
        if (twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "rating", [], "any", false, false, false, 33)) {
            echo "      
    <div class=\"rating\">
    <span class=\"rating_stars rating r";
            // line 35
            echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "rating", [], "any", false, false, false, 35);
            echo "\">
    <i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i>
    </span>
    </div>
";
        }
        // line 40
        echo "

<div class=\"price-wrapper\">
    ";
        // line 43
        if ((twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "attention", [], "any", false, false, false, 43) == "")) {
            // line 44
            echo "        ";
            if (twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "price", [], "any", false, false, false, 44)) {
                // line 45
                echo "                <div class=\"pwrap\">
                      <div class=\"price\">
                                            ";
                // line 47
                if ( !twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "special", [], "any", false, false, false, 47)) {
                    // line 48
                    echo "                                                <span>";
                    echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "price", [], "any", false, false, false, 48);
                    echo "</span>
                                            ";
                } else {
                    // line 50
                    echo "                                                <span class=\"price-old\">";
                    echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "price", [], "any", false, false, false, 50);
                    echo "</span><span class=\"price-new\">";
                    echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "special", [], "any", false, false, false, 50);
                    echo "</span>
                                            ";
                }
                // line 52
                echo "                                            ";
                if (twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "tax", [], "any", false, false, false, 52)) {
                    // line 53
                    echo "                                                <span class=\"price-tax\">";
                    echo ($context["text_tax"] ?? null);
                    echo " ";
                    echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "tax", [], "any", false, false, false, 53);
                    echo "</span>
                                            ";
                }
                // line 55
                echo "                  </div><!-- .price -->


                </div>

<!-- .price -->




            ";
                // line 65
                if (((twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "quantity", [], "any", false, false, false, 65) < 1) && ($context["stock_badge_status"] ?? null))) {
                    // line 66
                    echo "              <a class=\"btn  ";
                    if ((($context["basel_list_style"] ?? null) == "6")) {
                        echo "btn-contrast";
                    } else {
                        echo "btn-outline";
                    }
                    echo "\" title=\"";
                    echo ($context["button_cart"] ?? null);
                    echo "\" ><span class=\"global-cart\"></span> ";
                    echo ($context["button_cart"] ?? null);
                    echo "</a>
                ";
                    // line 67
                    $context["button_cart"] = ($context["basel_text_out_of_stock"] ?? null);
                    // line 68
                    echo "            ";
                } else {
                    // line 69
                    echo "             <a class=\"btn  ";
                    if ((($context["basel_list_style"] ?? null) == "6")) {
                        echo "btn-contrast";
                    } else {
                        echo "btn-outline";
                    }
                    echo "\" onclick=\"cart.add('";
                    echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "product_id", [], "any", false, false, false, 69);
                    echo "', '";
                    echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "minimum", [], "any", false, false, false, 69);
                    echo "');\"><span class=\"global-cart\"></span> ";
                    echo ($context["button_cart"] ?? null);
                    echo "</a>
            ";
                }
                // line 71
                echo "





<!-- .price-wrapper -->

        ";
            }
            // line 80
            echo "
        ";
        } else {
            // line 82
            echo "            <a href=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "href", [], "any", false, false, false, 82);
            echo "\" class=\"btn  ";
            if ((($context["basel_list_style"] ?? null) == "6")) {
                echo "btn-contrast";
            } else {
                echo "btn-outline";
            }
            echo "\" title=\"";
            echo ($context["button_cart"] ?? null);
            echo "\" ><span class=\"global-cart\"></span> Opširnije</a>
    ";
        }
        // line 84
        echo "</div>


<div class=\"plain-links\">
<a class=\"icon is_wishlist link-hover-color\" onclick=\"wishlist.add('";
        // line 88
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "product_id", [], "any", false, false, false, 88);
        echo "');\" title=\"";
        echo ($context["button_wishlist"] ?? null);
        echo "\"><span class=\"icon-heart\"></span> ";
        echo ($context["button_wishlist"] ?? null);
        echo "</a>
<a class=\"icon is_compare link-hover-color\" onclick=\"compare.add('";
        // line 89
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "product_id", [], "any", false, false, false, 89);
        echo "');\" title=\"";
        echo ($context["button_compare"] ?? null);
        echo "\"><span class=\"icon-refresh\"></span> ";
        echo ($context["button_compare"] ?? null);
        echo "</a>
<a class=\"icon is_quickview link-hover-color\" onclick=\"quickview('";
        // line 90
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "product_id", [], "any", false, false, false, 90);
        echo "');\"><span class=\"icon-magnifier-add\"></span> ";
        echo ($context["basel_button_quickview"] ?? null);
        echo "</a>
</div><!-- .plain-links-->
</div><!-- .caption-->
";
        // line 93
        if ((twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "sale_end_date", [], "any", false, false, false, 93) && ($context["countdown_status"] ?? null))) {
            // line 94
            echo "<script>
  \$(function() {
    \$(\".sale-counter.id";
            // line 96
            echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "product_id", [], "any", false, false, false, 96);
            echo "\").countdown(\"";
            echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "sale_end_date", [], "any", false, false, false, 96);
            echo "\").on('update.countdown', function(event) {
  var \$this = \$(this).html(event.strftime(''
    + '<div>'
    + '%D<i>";
            // line 99
            echo ($context["basel_text_days"] ?? null);
            echo "</i></div><div>'
    + '%H <i>";
            // line 100
            echo ($context["basel_text_hours"] ?? null);
            echo "</i></div><div>'
    + '%M <i>";
            // line 101
            echo ($context["basel_text_mins"] ?? null);
            echo "</i></div><div>'
    + '%S <i>";
            // line 102
            echo ($context["basel_text_secs"] ?? null);
            echo "</i></div></div>'));
});
});
</script>
";
        }
        // line 107
        echo "
   </div>
</div><!-- .single-product ends -->";
    }

    public function getTemplateName()
    {
        return "basel/template/product/single_product.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  343 => 107,  335 => 102,  331 => 101,  327 => 100,  323 => 99,  315 => 96,  311 => 94,  309 => 93,  301 => 90,  293 => 89,  285 => 88,  279 => 84,  265 => 82,  261 => 80,  250 => 71,  234 => 69,  231 => 68,  229 => 67,  216 => 66,  214 => 65,  202 => 55,  194 => 53,  191 => 52,  183 => 50,  177 => 48,  175 => 47,  171 => 45,  168 => 44,  166 => 43,  161 => 40,  153 => 35,  148 => 33,  142 => 32,  131 => 28,  123 => 27,  115 => 26,  107 => 23,  104 => 22,  102 => 21,  96 => 17,  90 => 15,  88 => 14,  83 => 12,  78 => 11,  76 => 10,  73 => 9,  63 => 7,  61 => 6,  53 => 5,  49 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/product/single_product.twig", "/Users/tomek/Herd/reprograv/upload/catalog/view/theme/basel/template/product/single_product.twig");
    }
}
