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

/* basel/template/common/cart.twig */
class __TwigTemplate_587415e095ec21b4ff5cd563859b91495950eabd8cbe98664d43e299c1d7f105 extends \Twig\Template
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
        echo "  <ul id=\"cart-content\">
    ";
        // line 2
        if ((($context["products"] ?? null) || ($context["vouchers"] ?? null))) {
            // line 3
            echo "    <li>
      <table class=\"table products\">
        ";
            // line 5
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["products"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
                // line 6
                echo "        <tr>
          <td class=\"image\">
          ";
                // line 8
                if (twig_get_attribute($this->env, $this->source, $context["product"], "thumb", [], "any", false, false, false, 8)) {
                    // line 9
                    echo "            <a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "href", [], "any", false, false, false, 9);
                    echo "\"><img src=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "thumb", [], "any", false, false, false, 9);
                    echo "\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 9);
                    echo "\" title=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 9);
                    echo "\" /></a>
            ";
                }
                // line 11
                echo "            </td>
          <td class=\"main\"><a class=\"product-name main-font\" href=\"";
                // line 12
                echo twig_get_attribute($this->env, $this->source, $context["product"], "href", [], "any", false, false, false, 12);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 12);
                echo "</a>
            ";
                // line 13
                echo twig_get_attribute($this->env, $this->source, $context["product"], "quantity", [], "any", false, false, false, 13);
                echo " x <span class=\"price\">";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 13);
                echo "</span>
            ";
                // line 14
                if (twig_get_attribute($this->env, $this->source, $context["product"], "option", [], "any", false, false, false, 14)) {
                    // line 15
                    echo "            ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["product"], "option", [], "any", false, false, false, 15));
                    foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                        // line 16
                        echo "            <br />
            - <small>";
                        // line 17
                        echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 17);
                        echo " ";
                        echo twig_get_attribute($this->env, $this->source, $context["option"], "value", [], "any", false, false, false, 17);
                        echo "</small>
            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 19
                    echo "            ";
                }
                // line 20
                echo "            ";
                if (twig_get_attribute($this->env, $this->source, $context["product"], "recurring", [], "any", false, false, false, 20)) {
                    // line 21
                    echo "            <br />
            - <small>";
                    // line 22
                    echo ($context["text_recurring"] ?? null);
                    echo " ";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "recurring", [], "any", false, false, false, 22);
                    echo "</small>
            ";
                }
                // line 24
                echo "          </td>
          <td class=\"remove\"><a onclick=\"cart.remove('";
                // line 25
                echo twig_get_attribute($this->env, $this->source, $context["product"], "cart_id", [], "any", false, false, false, 25);
                echo "');\" title=\"";
                echo ($context["button_remove"] ?? null);
                echo "\" class=\"remove\">&times;</a></td>
        </tr>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 28
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["vouchers"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["voucher"]) {
                // line 29
                echo "        <tr>
          <td colspan=\"2\" class=\"text-left\"><span class=\"product-name main-font\">";
                // line 30
                echo twig_get_attribute($this->env, $this->source, $context["voucher"], "description", [], "any", false, false, false, 30);
                echo "</span>
          1 x <span class=\"price\">";
                // line 31
                echo twig_get_attribute($this->env, $this->source, $context["voucher"], "amount", [], "any", false, false, false, 31);
                echo "</span></td>
          <td class=\"text-right\"><a onclick=\"voucher.remove('";
                // line 32
                echo twig_get_attribute($this->env, $this->source, $context["voucher"], "key", [], "any", false, false, false, 32);
                echo "');\" title=\"";
                echo ($context["button_remove"] ?? null);
                echo "\" class=\"remove\">&times;</a></td>
        </tr>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['voucher'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 35
            echo "      </table>
    </li>
    <li>
      <div>
        <table class=\"table totals\">
          ";
            // line 40
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["totals"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["total"]) {
                // line 41
                echo "          <tr>
            <td class=\"text-left\">";
                // line 42
                echo twig_get_attribute($this->env, $this->source, $context["total"], "title", [], "any", false, false, false, 42);
                echo "</td>
            <td class=\"text-right\">";
                // line 43
                echo twig_get_attribute($this->env, $this->source, $context["total"], "text", [], "any", false, false, false, 43);
                echo "</td>
          </tr>
          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['total'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 46
            echo "        </table>
        <a class=\"btn btn-default btn-block\" href=\"";
            // line 47
            echo ($context["cart"] ?? null);
            echo "\">";
            echo ($context["text_cart"] ?? null);
            echo "</a>
        <a class=\"btn btn-contrast btn-block\" href=\"";
            // line 48
            echo ($context["checkout"] ?? null);
            echo "\">";
            echo ($context["text_checkout"] ?? null);
            echo "</a>
      </div>
    </li>
    ";
        } else {
            // line 52
            echo "    <li>
      <div class=\"table empty\">
      <div class=\"table-cell\"><i class=\"global-cart\"></i></div>
      <div class=\"table-cell\">";
            // line 55
            echo ($context["text_empty"] ?? null);
            echo "</div>
      </div>
    </li>
    ";
        }
        // line 59
        echo "  </ul>";
    }

    public function getTemplateName()
    {
        return "basel/template/common/cart.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  217 => 59,  210 => 55,  205 => 52,  196 => 48,  190 => 47,  187 => 46,  178 => 43,  174 => 42,  171 => 41,  167 => 40,  160 => 35,  149 => 32,  145 => 31,  141 => 30,  138 => 29,  133 => 28,  122 => 25,  119 => 24,  112 => 22,  109 => 21,  106 => 20,  103 => 19,  93 => 17,  90 => 16,  85 => 15,  83 => 14,  77 => 13,  71 => 12,  68 => 11,  56 => 9,  54 => 8,  50 => 6,  46 => 5,  42 => 3,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/common/cart.twig", "");
    }
}
