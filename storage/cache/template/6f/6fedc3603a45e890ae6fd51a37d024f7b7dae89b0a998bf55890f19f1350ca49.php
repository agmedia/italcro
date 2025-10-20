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

/* basel/template/checkout/cart.twig */
class __TwigTemplate_e32c677c098e0aa1e4b7f6f8b044c98fbcfaf693076d2404dc319ccfcfedf8be extends \Twig\Template
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
        echo ($context["header"] ?? null);
        echo "
<div class=\"container\">
  <ul class=\"breadcrumb\">
    ";
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 5
            echo "    <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 5);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 5);
            echo "</a></li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 7
        echo "  </ul>
  
  ";
        // line 9
        if (($context["attention"] ?? null)) {
            // line 10
            echo "  <div class=\"alert alert-info\"><i class=\"fa fa-info-circle\"></i> ";
            echo ($context["attention"] ?? null);
            echo "
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
  </div>
  ";
        }
        // line 14
        echo "  ";
        if (($context["success"] ?? null)) {
            // line 15
            echo "  <div class=\"alert alert-success\"><i class=\"fa fa-check\"></i> ";
            echo ($context["success"] ?? null);
            echo "
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
  </div>
  ";
        }
        // line 19
        echo "  ";
        if (($context["error_warning"] ?? null)) {
            // line 20
            echo "  <div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
  </div>
  ";
        }
        // line 24
        echo "  
  <div class=\"row\">
  
  ";
        // line 27
        echo ($context["column_left"] ?? null);
        echo "
    
    ";
        // line 29
        if ((($context["column_left"] ?? null) && ($context["column_right"] ?? null))) {
            // line 30
            echo "    ";
            $context["class"] = "col-sm-6";
            // line 31
            echo "    ";
        } elseif ((($context["column_left"] ?? null) || ($context["column_right"] ?? null))) {
            // line 32
            echo "    ";
            $context["class"] = "col-md-9 col-sm-8";
            // line 33
            echo "    ";
        } else {
            // line 34
            echo "    ";
            $context["class"] = "col-sm-12";
            // line 35
            echo "    ";
        }
        // line 36
        echo "    
    <div id=\"content\" class=\"";
        // line 37
        echo ($context["class"] ?? null);
        echo "\">
    ";
        // line 38
        echo ($context["content_top"] ?? null);
        echo "
      <h1 id=\"page-title\">";
        // line 39
        echo ($context["heading_title"] ?? null);
        if (($context["weight"] ?? null)) {
            echo " (";
            echo ($context["weight"] ?? null);
            echo ")";
        }
        echo "</h1>
      <form action=\"";
        // line 40
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\">
        
          <table class=\"table table-bordered border-bottom\">
            <thead>
              <tr>
                <td class=\"hidden-xs hidden-sm\"></td>
                <td colspan=\"2\">";
        // line 46
        echo ($context["column_name"] ?? null);
        echo "</td>
              
                <td>";
        // line 48
        echo ($context["column_quantity"] ?? null);
        echo "</td>
                <td class=\"text-right hidden-xs hidden-sm\">";
        // line 49
        echo ($context["column_price"] ?? null);
        echo "</td>
                <td class=\"text-right\">";
        // line 50
        echo ($context["column_total"] ?? null);
        echo "</td>
              </tr>
            </thead>
            
            <tbody>
              ";
        // line 55
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["products"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 56
            echo "              <tr>
              <td class=\"remove-cell hidden-xs hidden-sm text-center\">
\t\t\t  <a onclick=\"cart.remove('";
            // line 58
            echo twig_get_attribute($this->env, $this->source, $context["product"], "cart_id", [], "any", false, false, false, 58);
            echo "');\" data-toggle=\"tooltip\" title=\"";
            echo ($context["button_remove"] ?? null);
            echo "\" class=\"product-remove\"><i class=\"fa fa-times\"></i></a>
\t\t\t  </td>
                <td class=\"image\">
                ";
            // line 61
            if (twig_get_attribute($this->env, $this->source, $context["product"], "thumb", [], "any", false, false, false, 61)) {
                // line 62
                echo "                  <a href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "href", [], "any", false, false, false, 62);
                echo "\"><img src=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "thumb", [], "any", false, false, false, 62);
                echo "\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 62);
                echo "\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 62);
                echo "\" /></a>
                  ";
            }
            // line 64
            echo "                  </td>
                <td class=\"name\"><a class=\"hover_uline\" href=\"";
            // line 65
            echo twig_get_attribute($this->env, $this->source, $context["product"], "href", [], "any", false, false, false, 65);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 65);
            echo "</a>
                  ";
            // line 66
            if ( !twig_get_attribute($this->env, $this->source, $context["product"], "stock", [], "any", false, false, false, 66)) {
                // line 67
                echo "                  <span class=\"text-danger\">***</span>
                  ";
            }
            // line 69
            echo "
                     ";
            // line 70
            if ((twig_get_attribute($this->env, $this->source, $context["product"], "quantity", [], "any", false, false, false, 70) > twig_get_attribute($this->env, $this->source, $context["product"], "stock_available", [], "any", false, false, false, 70))) {
                // line 71
                echo "                <div class=\"text-danger\">";
                echo ($context["text_stock"] ?? null);
                echo "  ";
                if ((twig_get_attribute($this->env, $this->source, $context["product"], "stock_available", [], "any", false, false, false, 71) > 0)) {
                    echo " ";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "stock_available", [], "any", false, false, false, 71);
                    echo " ";
                } else {
                    echo " Po narudžbi ";
                }
                echo "</div>
            ";
            }
            // line 73
            echo "                  ";
            if (twig_get_attribute($this->env, $this->source, $context["product"], "option", [], "any", false, false, false, 73)) {
                // line 74
                echo "                  ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["product"], "option", [], "any", false, false, false, 74));
                foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                    // line 75
                    echo "                  <br />
                  <small>";
                    // line 76
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 76);
                    echo ": ";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "value", [], "any", false, false, false, 76);
                    echo "</small>
                  ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 78
                echo "                  ";
            }
            // line 79
            echo "                  ";
            if (twig_get_attribute($this->env, $this->source, $context["product"], "reward", [], "any", false, false, false, 79)) {
                // line 80
                echo "                  <br />
                  <small>";
                // line 81
                echo twig_get_attribute($this->env, $this->source, $context["product"], "reward", [], "any", false, false, false, 81);
                echo "</small>
                  ";
            }
            // line 83
            echo "                  ";
            if (twig_get_attribute($this->env, $this->source, $context["product"], "recurring", [], "any", false, false, false, 83)) {
                // line 84
                echo "                  <br />
                  <span class=\"label label-info\">";
                // line 85
                echo ($context["text_recurring_item"] ?? null);
                echo "</span> <small>";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "recurring", [], "any", false, false, false, 85);
                echo "</small>
                  ";
            }
            // line 87
            echo "                  <small class=\"hidden-md hidden-lg\"><br />";
            echo ($context["column_model"] ?? null);
            echo ": ";
            echo twig_get_attribute($this->env, $this->source, $context["product"], "model", [], "any", false, false, false, 87);
            echo "</small>
                  <small class=\"hidden-md hidden-lg\"><br />";
            // line 88
            echo ($context["column_price"] ?? null);
            echo ": ";
            echo twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 88);
            echo "</small><br />
\t\t\t\t  <a class=\"btn btn-default btn-tiny hidden-md hidden-lg\" style=\"margin-top:5px;\" onclick=\"cart.remove('";
            // line 89
            echo twig_get_attribute($this->env, $this->source, $context["product"], "cart_id", [], "any", false, false, false, 89);
            echo "');\">";
            echo ($context["button_remove"] ?? null);
            echo "</a>
                  </td>
              
                <td>
                <input type=\"number\" min=\"1\" step=\"1\" id=\"widgetFieldInput";
            // line 93
            echo twig_get_attribute($this->env, $this->source, $context["product"], "cart_id", [], "any", false, false, false, 93);
            echo "\" name=\"quantity[";
            echo twig_get_attribute($this->env, $this->source, $context["product"], "cart_id", [], "any", false, false, false, 93);
            echo "]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product"], "quantity", [], "any", false, false, false, 93);
            echo "\" class=\"form-control qty-form\" />

                    </td>

                     <script>


                                \$(\"#widgetFieldInput";
            // line 100
            echo twig_get_attribute($this->env, $this->source, $context["product"], "cart_id", [], "any", false, false, false, 100);
            echo "\").change(function() {
                                    this.form.submit();
                                });


                                </script>
                <td class=\"text-right price-cell hidden-xs hidden-sm\">";
            // line 106
            echo twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 106);
            echo "</td>
                <td class=\"text-right total-cell\">";
            // line 107
            echo twig_get_attribute($this->env, $this->source, $context["product"], "total", [], "any", false, false, false, 107);
            echo "</td>
              </tr>
              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 110
        echo "              ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["vouchers"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["voucher"]) {
            // line 111
            echo "              <tr>
                <td class=\"text-center hidden-xs hidden-sm\">
\t\t\t\t<a onclick=\"voucher.remove('";
            // line 113
            echo twig_get_attribute($this->env, $this->source, $context["voucher"], "key", [], "any", false, false, false, 113);
            echo "');\" data-toggle=\"tooltip\" title=\"";
            echo ($context["button_remove"] ?? null);
            echo "\" class=\"product-remove\"><i class=\"fa fa-times\"></i></a>
\t\t\t\t</td>
\t\t\t\t<td colspan=\"2\" class=\"text-left\">
\t\t\t\t";
            // line 116
            echo twig_get_attribute($this->env, $this->source, $context["voucher"], "description", [], "any", false, false, false, 116);
            echo "<br>
\t\t\t\t<a class=\"btn btn-default btn-tiny hidden-md hidden-lg\" style=\"margin-top:5px;\" onclick=\"voucher.remove('";
            // line 117
            echo twig_get_attribute($this->env, $this->source, $context["voucher"], "key", [], "any", false, false, false, 117);
            echo "');\">";
            echo ($context["button_remove"] ?? null);
            echo "</a>
\t\t\t\t</td>               
\t\t\t\t<td class=\"hidden-xs hidden-sm\"></td>
\t\t\t\t<td class=\"text-left\"><div class=\"input-group btn-block\" style=\"max-width: 200px;\">
\t\t\t\t\t<input type=\"number\" value=\"1\" disabled=\"disabled\" class=\"form-control qty-form\" />
                    </td>
\t\t\t\t<td class=\"hidden-xs hidden-sm\"></td>
                
                <td class=\"text-right total-cell\">";
            // line 125
            echo twig_get_attribute($this->env, $this->source, $context["voucher"], "amount", [], "any", false, false, false, 125);
            echo "</td>
              </tr>
              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['voucher'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 128
        echo "              
            </tbody>
            
          </table>

      
          
          
        </form>
        
        <div class=\"row\">
        
        <div class=\"col-sm-7\">
            <div class=\"row cart-modules\">
                ";
        // line 142
        if (($context["modules"] ?? null)) {
            // line 143
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["modules"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                // line 144
                echo "                        <div class=\"col-sm-6 margin-b30\">
                        \t";
                // line 145
                echo $context["module"];
                echo "
                        </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 148
            echo "                ";
        }
        // line 149
        echo "            </div>
        </div>
        
        <div class=\"col-sm-5\">
            <div class=\"totals-slip\">
            \t<div class=\"table-holder margin-b25\">
                <table class=\"table table-bordered total-list margin-b0\">
                ";
        // line 156
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["totals"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["total"]) {
            // line 157
            echo "                <tr>
                <td><b>";
            // line 158
            echo twig_get_attribute($this->env, $this->source, $context["total"], "title", [], "any", false, false, false, 158);
            echo ":</b></td>
                <td class=\"text-right\">";
            // line 159
            echo twig_get_attribute($this->env, $this->source, $context["total"], "text", [], "any", false, false, false, 159);
            echo "</td>
                </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['total'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 162
        echo "                </table>
                </div>
                <a href=\"";
        // line 164
        echo ($context["checkout"] ?? null);
        echo "\" class=\"btn btn-lg btn-contrast btn-block\">";
        echo ($context["button_checkout"] ?? null);
        echo "</a>
            </div>
        </div>
        
        </div>
      
      ";
        // line 170
        echo ($context["content_bottom"] ?? null);
        echo "</div>
    ";
        // line 171
        echo ($context["column_right"] ?? null);
        echo "</div>
</div>
";
        // line 173
        echo ($context["footer"] ?? null);
        echo " ";
    }

    public function getTemplateName()
    {
        return "basel/template/checkout/cart.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  478 => 173,  473 => 171,  469 => 170,  458 => 164,  454 => 162,  445 => 159,  441 => 158,  438 => 157,  434 => 156,  425 => 149,  422 => 148,  413 => 145,  410 => 144,  405 => 143,  403 => 142,  387 => 128,  378 => 125,  365 => 117,  361 => 116,  353 => 113,  349 => 111,  344 => 110,  335 => 107,  331 => 106,  322 => 100,  308 => 93,  299 => 89,  293 => 88,  286 => 87,  279 => 85,  276 => 84,  273 => 83,  268 => 81,  265 => 80,  262 => 79,  259 => 78,  249 => 76,  246 => 75,  241 => 74,  238 => 73,  224 => 71,  222 => 70,  219 => 69,  215 => 67,  213 => 66,  207 => 65,  204 => 64,  192 => 62,  190 => 61,  182 => 58,  178 => 56,  174 => 55,  166 => 50,  162 => 49,  158 => 48,  153 => 46,  144 => 40,  135 => 39,  131 => 38,  127 => 37,  124 => 36,  121 => 35,  118 => 34,  115 => 33,  112 => 32,  109 => 31,  106 => 30,  104 => 29,  99 => 27,  94 => 24,  86 => 20,  83 => 19,  75 => 15,  72 => 14,  64 => 10,  62 => 9,  58 => 7,  47 => 5,  43 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/checkout/cart.twig", "");
    }
}
