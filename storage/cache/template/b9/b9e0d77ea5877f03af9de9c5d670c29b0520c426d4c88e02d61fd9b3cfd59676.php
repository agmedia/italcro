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

/* basel/template/product/category.twig */
class __TwigTemplate_d795505d9d573a2820925b33912e45fc5850db51334be8db600de3d6bc58d3ca extends \Twig\Template
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
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 6
            echo "            <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 6);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 6);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 8
        echo "    </ul>

    ";
        // line 10
        if (($context["short_description"] ?? null)) {
            // line 11
            echo "
        <div class=\"row short-description\">
            <div class=\"col-md-12 mb-3\">
                ";
            // line 14
            echo ($context["short_description"] ?? null);
            echo "
            </div>
        </div>

    ";
        }
        // line 19
        echo "
    <div class=\"row\">



        ";
        // line 24
        echo ($context["column_left"] ?? null);
        echo "

        ";
        // line 26
        if ((($context["column_left"] ?? null) && ($context["column_right"] ?? null))) {
            // line 27
            echo "            ";
            $context["class"] = "col-sm-6";
            // line 28
            echo "        ";
        } elseif ((($context["column_left"] ?? null) || ($context["column_right"] ?? null))) {
            // line 29
            echo "            ";
            $context["class"] = "col-md-9 col-sm-8";
            // line 30
            echo "        ";
        } else {
            // line 31
            echo "            ";
            $context["class"] = "col-sm-12";
            // line 32
            echo "        ";
        }
        // line 33
        echo "
        <div id=\"content\" class=\"";
        // line 34
        echo ($context["class"] ?? null);
        echo "\">


            ";
        // line 37
        echo ($context["content_top"] ?? null);
        echo "
            <h1 id=\"page-title\">";
        // line 38
        echo ($context["heading_title"] ?? null);
        echo "</h1>



            ";
        // line 42
        if ((($context["categories"] ?? null) && ($context["category_subs_status"] ?? null))) {
            // line 43
            echo "                <h3 class=\"lined-title hidden-xs\"><span>";
            echo ($context["text_refine"] ?? null);
            echo "</span></h3>
                <div class=\"grid-holder categories carousel grid-holder grid6 prod_module0 carousel mb-3\">
                    ";
            // line 45
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                // line 46
                echo "                        <div class=\"item single-product\">
                            <a href=\"";
                // line 47
                echo twig_get_attribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 47);
                echo "\"><img src=\"";
                echo twig_get_attribute($this->env, $this->source, $context["category"], "thumb", [], "any", false, false, false, 47);
                echo "\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 47);
                echo "\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 47);
                echo "\" /></a>
                            <a href=\"";
                // line 48
                echo twig_get_attribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 48);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 48);
                echo "</a></div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 50
            echo "                </div>

                <script>
                    \$('.grid-holder.prod_module0').slick({
                        prevArrow: false,
                        nextArrow: false,
                        dots:true,
                        respondTo:'min',
                        rows:1,
                        slidesToShow:6,slidesToScroll:2,responsive:[{breakpoint:1280,settings:{slidesToShow:6,slidesToScroll:2}},{breakpoint:960,settings:{slidesToShow:5,slidesToScroll:2}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:1}},
                        ]
                    });
                    \$('.product-style2 .single-product .icon').attr('data-placement', 'top');
                    \$('[data-toggle=\\'tooltip\\']').tooltip({container: 'body'});
                </script>
            ";
        }
        // line 66
        echo "
            ";
        // line 67
        if (($context["products"] ?? null)) {
            // line 68
            echo "                <div id=\"product-view\" class=\"grid\">

                    <div class=\"table filter\">

                        <div class=\"table-cell nowrap hidden-sm hidden-md hidden-lg\"><a class=\"filter-trigger-btn\"></a></div>


                        <div class=\"table-cell nowrap hidden-xs\">
                            <span>";
            // line 76
            echo ($context["text_limit"] ?? null);
            echo "</span>
                            <select id=\"input-limit\" class=\"form-control input-sm inline\" onchange=\"location = this.value;\">
                                ";
            // line 78
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["limits"]);
            foreach ($context['_seq'] as $context["_key"] => $context["limits"]) {
                // line 79
                echo "                                    ";
                if ((twig_get_attribute($this->env, $this->source, $context["limits"], "value", [], "any", false, false, false, 79) == ($context["limit"] ?? null))) {
                    // line 80
                    echo "                                        <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["limits"], "href", [], "any", false, false, false, 80);
                    echo "\" selected=\"selected\">";
                    echo twig_get_attribute($this->env, $this->source, $context["limits"], "text", [], "any", false, false, false, 80);
                    echo "</option>
                                    ";
                } else {
                    // line 82
                    echo "                                        <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["limits"], "href", [], "any", false, false, false, 82);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["limits"], "text", [], "any", false, false, false, 82);
                    echo "</option>
                                    ";
                }
                // line 84
                echo "                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['limits'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 85
            echo "                            </select>
                        </div>

                        <div class=\"table-cell w100\">
                            <a href=\"";
            // line 89
            echo ($context["compare"] ?? null);
            echo "\" id=\"compare-total\" class=\"hidden-xs\">";
            echo ($context["text_compare"] ?? null);
            echo "</a>
                        </div>

                        <div class=\"table-cell nowrap text-right \">
                            <div class=\"sort-select\">
                                <span class=\"hidden-xs\">";
            // line 94
            echo ($context["text_sort"] ?? null);
            echo "</span>


                                <select id=\"input-sort\" class=\"form-control input-sm inline\" onchange=\"location = this.value;\">
                                    ";
            // line 98
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["sorts"]);
            foreach ($context['_seq'] as $context["_key"] => $context["sorts"]) {
                // line 99
                echo "                                        ";
                if ((twig_get_attribute($this->env, $this->source, $context["sorts"], "value", [], "any", false, false, false, 99) == twig_sprintf("%s-%s", ($context["sort"] ?? null), ($context["order"] ?? null)))) {
                    // line 100
                    echo "                                            <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["sorts"], "href", [], "any", false, false, false, 100);
                    echo "\" selected=\"selected\"> ";
                    echo twig_get_attribute($this->env, $this->source, $context["sorts"], "text", [], "any", false, false, false, 100);
                    echo "</option>
                                        ";
                } else {
                    // line 102
                    echo "                                            <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["sorts"], "href", [], "any", false, false, false, 102);
                    echo "\" >";
                    echo twig_get_attribute($this->env, $this->source, $context["sorts"], "text", [], "any", false, false, false, 102);
                    echo "</option>
                                        ";
                }
                // line 104
                echo "                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sorts'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 105
            echo "                                </select>
                            </div>
                        </div>



                    </div>

                    <div class=\"grid-holder product-holder grid";
            // line 113
            echo ($context["basel_prod_grid"] ?? null);
            echo "\">
                        ";
            // line 114
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["products"] ?? null));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
                // line 115
                echo "                            ";
                $this->loadTemplate("basel/template/product/single_product.twig", "basel/template/product/category.twig", 115)->display($context);
                // line 116
                echo "                        ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 117
            echo "                    </div>
                </div> <!-- #product-view ends -->

                <div class=\"row pagination-holder\">
                    <div class=\"col-sm-6 xs-text-center pagination-navigation\">";
            // line 121
            echo ($context["pagination"] ?? null);
            echo "</div>
                    <div class=\"col-sm-6 text-right xs-text-center\"><span class=\"pagination-text\">";
            // line 122
            echo ($context["results"] ?? null);
            echo "</span></div>
                </div>

            ";
        }
        // line 126
        echo "
            ";
        // line 127
        if ( !($context["products"] ?? null)) {
            // line 128
            echo "                <p>";
            echo ($context["text_empty"] ?? null);
            echo "</p>
            ";
        }
        // line 130
        echo "



            ";
        // line 134
        echo ($context["content_bottom"] ?? null);
        echo "</div>


        ";
        // line 137
        echo ($context["column_right"] ?? null);
        echo "</div>

</div>

";
        // line 141
        if (($context["description"] ?? null)) {
            // line 142
            echo "
    <div class=\"container-fluid catdesc\">
        <div class=\"container\">
            <div class=\"row short-description\">
                <div class=\"col-md-12 mb-5\">
                    ";
            // line 147
            echo ($context["description"] ?? null);
            echo "
                </div>
            </div>
        </div>

    </div>
";
        }
        // line 154
        echo ($context["footer"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "basel/template/product/category.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  398 => 154,  388 => 147,  381 => 142,  379 => 141,  372 => 137,  366 => 134,  360 => 130,  354 => 128,  352 => 127,  349 => 126,  342 => 122,  338 => 121,  332 => 117,  318 => 116,  315 => 115,  298 => 114,  294 => 113,  284 => 105,  278 => 104,  270 => 102,  262 => 100,  259 => 99,  255 => 98,  248 => 94,  238 => 89,  232 => 85,  226 => 84,  218 => 82,  210 => 80,  207 => 79,  203 => 78,  198 => 76,  188 => 68,  186 => 67,  183 => 66,  165 => 50,  155 => 48,  145 => 47,  142 => 46,  138 => 45,  132 => 43,  130 => 42,  123 => 38,  119 => 37,  113 => 34,  110 => 33,  107 => 32,  104 => 31,  101 => 30,  98 => 29,  95 => 28,  92 => 27,  90 => 26,  85 => 24,  78 => 19,  70 => 14,  65 => 11,  63 => 10,  59 => 8,  48 => 6,  44 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/product/category.twig", "");
    }
}
