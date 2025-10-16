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

/* basel/template/extension/module/basel_categories.twig */
class __TwigTemplate_8959ab19c0f56d4ab2338ac830e2c4dfd262f9f90a9918a8bc9a70c8e2924b84 extends \Twig\Template
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
        echo "</div>

<div class=\"widget category-widget grid";
        // line 3
        if (($context["contrast"] ?? null)) {
            echo " contrast-bg";
        }
        echo "\" ";
        if (($context["use_margin"] ?? null)) {
            echo "style=\"margin-bottom:";
            echo ($context["margin"] ?? null);
            echo "\"";
        }
        echo ">
    ";
        // line 4
        if (($context["block_title"] ?? null)) {
            // line 5
            echo "        <div class=\"container\">
        <div class=\"widget-title\">
            ";
            // line 7
            if (($context["title_preline"] ?? null)) {
                echo "<p class=\"pre-line\">";
                echo ($context["title_preline"] ?? null);
                echo "</p>";
            }
            // line 8
            echo "            ";
            if (($context["title"] ?? null)) {
                // line 9
                echo "                <p class=\"main-title\"><span>";
                echo ($context["title"] ?? null);
                echo "</span></p>
                <p class=\"widget-title-separator\"><i class=\"icon-line-cross\"></i></p>
            ";
            }
            // line 12
            echo "            ";
            if (($context["title_subline"] ?? null)) {
                // line 13
                echo "                <p class=\"sub-line\"><span>";
                echo ($context["title_subline"] ?? null);
                echo "</span></p>
            ";
            }
            // line 15
            echo "        </div>
        </div>
    ";
        }
        // line 18
        echo "
    ";
        // line 19
        if (($context["categories"] ?? null)) {
            // line 20
            echo "    <div class=\"container-fluid full\">
        <div class=\"grid-holder category grid";
            // line 21
            echo ($context["columns"] ?? null);
            echo " ";
            if (($context["carousel"] ?? null)) {
                echo "carousel";
            }
            echo " module";
            echo ($context["module"] ?? null);
            echo "\">

            ";
            // line 23
            if (($context["view_subs"] ?? null)) {
                // line 24
                echo "
                ";
                // line 25
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                    // line 26
                    echo "
                    <div class=\"item single-category has-subs\">
                        <div class=\"table\">
                            <div class=\"table-cell v-top img-cell\"><img src=\"";
                    // line 29
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "thumb", [], "any", false, false, false, 29);
                    echo "\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 29);
                    echo "\" /></div>

                            <div class=\"table-cell w100 v-top\">
                                <h5><b><a href=\"";
                    // line 32
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 32);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 32);
                    echo "</a></b></h5>
                                ";
                    // line 33
                    if (twig_get_attribute($this->env, $this->source, $context["category"], "children", [], "any", false, false, false, 33)) {
                        // line 34
                        echo "                                    <ul class=\"list-unstyled\">
                                        ";
                        // line 35
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["category"], "children", [], "any", false, false, false, 35));
                        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                            // line 36
                            echo "                                            <li><a class=\"hover_uline\" href=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["child"], "href", [], "any", false, false, false, 36);
                            echo "\">";
                            echo twig_get_attribute($this->env, $this->source, $context["child"], "name", [], "any", false, false, false, 36);
                            echo "</a></li>
                                        ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 38
                        echo "                                    </ul>
                                ";
                    }
                    // line 40
                    echo "                            </div>
                        </div>
                    </div><!-- .single-category ends -->
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 44
                echo "
            ";
            } else {
                // line 46
                echo "
                ";
                // line 47
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                    // line 48
                    echo "                    <div class=\"item single-category no-subs\">
                        <div class=\"banner_wrap hover-zoom\">
                            <a href=\"";
                    // line 50
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 50);
                    echo "\"><img class=\"zoom_image\" src=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "thumb", [], "any", false, false, false, 50);
                    echo "\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "alt", [], "any", false, false, false, 50);
                    echo "\" title=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "title", [], "any", false, false, false, 50);
                    echo "\" /></a>
                            ";
                    // line 51
                    if (($context["count"] ?? null)) {
                        // line 52
                        echo "                                <div class=\"overlay\">
                                    <a class=\"table w100 h100\" href=\"";
                        // line 53
                        echo twig_get_attribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 53);
                        echo "\">
                                        <b class=\"table-cell text-center\">";
                        // line 54
                        echo twig_get_attribute($this->env, $this->source, $context["category"], "products", [], "any", false, false, false, 54);
                        echo "</b>
                                    </a>
                                </div>
                            ";
                    }
                    // line 58
                    echo "                        </div>
                        <h3 class=\"name contrast-heading\">";
                    // line 59
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 59);
                    echo "</h3>
                        <a class=\"u-lined\" href=\"";
                    // line 60
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 60);
                    echo "\">";
                    echo ($context["basel_text_view_products"] ?? null);
                    echo "</a>
                    </div><!-- .single-category ends -->
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 63
                echo "
            ";
            }
            // line 65
            echo "
        </div> <!-- .grid-holder ends -->
    ";
        }
        // line 68
        echo "    </div>
    <div class=\"clearfix\"></div>
</div>

";
        // line 72
        if (($context["carousel"] ?? null)) {
            // line 73
            echo "    <script>
        \$('.grid-holder.category.module";
            // line 74
            echo ($context["module"] ?? null);
            echo "').slick({
            ";
            // line 75
            if (($context["carousel_a"] ?? null)) {
                // line 76
                echo "            prevArrow: \"<a class=\\\"arrow-left icon-arrow-left\\\"></a>\",
            nextArrow: \"<a class=\\\"arrow-right icon-arrow-right\\\"></a>\",
            ";
            } else {
                // line 79
                echo "            arrows: false,
            ";
            }
            // line 81
            echo "            ";
            if ((($context["direction"] ?? null) == "rtl")) {
                // line 82
                echo "            rtl: true,
            ";
            }
            // line 84
            echo "            ";
            if (($context["carousel_b"] ?? null)) {
                // line 85
                echo "            dots:true,
            ";
            }
            // line 87
            echo "            respondTo:'min',
            rows:";
            // line 88
            echo ($context["rows"] ?? null);
            echo ",
            ";
            // line 89
            if ((($context["columns"] ?? null) == "6")) {
                // line 90
                echo "            slidesToShow:6,slidesToScroll:6,responsive:[{breakpoint:1100,settings:{slidesToShow:5,slidesToScroll:5}},{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
                ";
            } elseif ((            // line 91
($context["columns"] ?? null) == "5")) {
                // line 92
                echo "                slidesToShow:5,slidesToScroll:5,responsive:[{breakpoint:1100,settings:{slidesToShow:4,slidesToScroll:4}},{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
            ";
            } elseif ((            // line 93
($context["columns"] ?? null) == "4")) {
                // line 94
                echo "            slidesToShow:4,slidesToScroll:4,responsive:[{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
            ";
            } elseif ((            // line 95
($context["columns"] ?? null) == "3")) {
                // line 96
                echo "            slidesToShow:3,slidesToScroll:3,responsive:[{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
            ";
            } elseif ((            // line 97
($context["columns"] ?? null) == "2")) {
                // line 98
                echo "            slidesToShow:2,slidesToScroll:2,responsive:[
            ";
            } elseif (((            // line 99
($context["columns"] ?? null) == "1") || (($context["columns"] ?? null) == "list"))) {
                // line 100
                echo "            adaptiveHeight:true,slidesToShow:1,slidesToScroll:1,responsive:[
            ";
            }
            // line 102
            echo "            {breakpoint:420,settings:{slidesToShow:1,slidesToScroll:1}}
        ]
        });
    </script>
";
        }
    }

    public function getTemplateName()
    {
        return "basel/template/extension/module/basel_categories.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  315 => 102,  311 => 100,  309 => 99,  306 => 98,  304 => 97,  301 => 96,  299 => 95,  296 => 94,  294 => 93,  291 => 92,  289 => 91,  286 => 90,  284 => 89,  280 => 88,  277 => 87,  273 => 85,  270 => 84,  266 => 82,  263 => 81,  259 => 79,  254 => 76,  252 => 75,  248 => 74,  245 => 73,  243 => 72,  237 => 68,  232 => 65,  228 => 63,  217 => 60,  213 => 59,  210 => 58,  203 => 54,  199 => 53,  196 => 52,  194 => 51,  184 => 50,  180 => 48,  176 => 47,  173 => 46,  169 => 44,  160 => 40,  156 => 38,  145 => 36,  141 => 35,  138 => 34,  136 => 33,  130 => 32,  122 => 29,  117 => 26,  113 => 25,  110 => 24,  108 => 23,  97 => 21,  94 => 20,  92 => 19,  89 => 18,  84 => 15,  78 => 13,  75 => 12,  68 => 9,  65 => 8,  59 => 7,  55 => 5,  53 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/extension/module/basel_categories.twig", "");
    }
}
