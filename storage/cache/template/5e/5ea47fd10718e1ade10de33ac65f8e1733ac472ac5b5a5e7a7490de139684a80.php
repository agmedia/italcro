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

/* basel/template/common/menu.twig */
class __TwigTemplate_8f744bdc0c20031b98a8516b8c0ea9eefd567deec844c48b0fc07c0cd38828c8 extends \Twig\Template
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
        if (($context["categories"] ?? null)) {
            // line 2
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                // line 3
                echo "    ";
                if (twig_get_attribute($this->env, $this->source, $context["category"], "children", [], "any", false, false, false, 3)) {
                    // line 4
                    echo "        <li class=\"has-sub dropdown-wrapper from-bottom\">
        <a href=\"";
                    // line 5
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 5);
                    echo "\"><span class=\"top\">";
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 5);
                    echo "</span><i class=\"fa fa-angle-down\"></i></a>
        <div class=\"sub-holder dropdown-content dropdown-left\">
            <div class=\"dropdown-inner\"><div class=\"menu-item\">
\t\t\t\t";
                    // line 8
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_array_batch(twig_get_attribute($this->env, $this->source, $context["category"], "children", [], "any", false, false, false, 8), (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "children", [], "any", false, false, false, 8)) / twig_round(twig_get_attribute($this->env, $this->source, $context["category"], "column", [], "any", false, false, false, 8), 1, "ceil"))));
                    foreach ($context['_seq'] as $context["_key"] => $context["children"]) {
                        // line 9
                        echo "                  <ul class=\"default-menu-ul hover-menu\">
                    ";
                        // line 10
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($context["children"]);
                        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                            // line 11
                            echo "                    
\t\t\t\t\t\t";
                            // line 12
                            if (twig_get_attribute($this->env, $this->source, $context["child"], "grandchildren", [], "any", false, false, false, 12)) {
                                // line 13
                                echo "\t\t\t\t\t<li class=\"default-menu-li has-sub dropdown-wrapper from-bottom\"><a href=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["child"], "href", [], "any", false, false, false, 13);
                                echo "\">";
                                echo twig_get_attribute($this->env, $this->source, $context["child"], "name", [], "any", false, false, false, 13);
                                echo "<i class=\"fa fa-angle-right\"></i></a>
\t\t\t\t\t\t\t<ul class=\"dropdown-content sub-holder dropdown-left\">
\t\t\t\t\t\t\t\t";
                                // line 15
                                $context['_parent'] = $context;
                                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["child"], "grandchildren", [], "any", false, false, false, 15));
                                foreach ($context['_seq'] as $context["_key"] => $context["grandchild"]) {
                                    // line 16
                                    echo "\t\t\t\t\t\t\t\t\t<li class=\"default-menu-li\"><a href=\"";
                                    echo twig_get_attribute($this->env, $this->source, $context["grandchild"], "href", [], "any", false, false, false, 16);
                                    echo "\">";
                                    echo twig_get_attribute($this->env, $this->source, $context["grandchild"], "name", [], "any", false, false, false, 16);
                                    echo "</a></li>
\t\t\t\t\t\t\t\t";
                                }
                                $_parent = $context['_parent'];
                                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['grandchild'], $context['_parent'], $context['loop']);
                                $context = array_intersect_key($context, $_parent) + $_parent;
                                // line 18
                                echo "\t\t\t\t\t\t\t</ul>
\t\t\t\t\t</li>
\t\t\t\t\t\t";
                            } else {
                                // line 21
                                echo "\t\t\t\t\t<li class=\"default-menu-li\"><a href=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["child"], "href", [], "any", false, false, false, 21);
                                echo "\">";
                                echo twig_get_attribute($this->env, $this->source, $context["child"], "name", [], "any", false, false, false, 21);
                                echo "</a></li>
\t\t\t\t\t\t";
                            }
                            // line 23
                            echo "\t\t\t\t\t
                    ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 25
                        echo "                  </ul>
                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['children'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 27
                    echo "            </div>
        </div>
        </div>
        </li>
    ";
                } else {
                    // line 32
                    echo "        <li><a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 32);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 32);
                    echo "</a></li>
    ";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
    }

    public function getTemplateName()
    {
        return "basel/template/common/menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  130 => 32,  123 => 27,  116 => 25,  109 => 23,  101 => 21,  96 => 18,  85 => 16,  81 => 15,  73 => 13,  71 => 12,  68 => 11,  64 => 10,  61 => 9,  57 => 8,  49 => 5,  46 => 4,  43 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/common/menu.twig", "");
    }
}
