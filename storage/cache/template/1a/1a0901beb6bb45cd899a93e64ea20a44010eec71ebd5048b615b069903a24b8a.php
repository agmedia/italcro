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

/* basel/template/extension/module/blog_latest.twig */
class __TwigTemplate_e9bfc1f9aa78c4f1a4a3acc1c9cc27ee636df8a0d77539e2d50fd064eec2dcb5 extends \Twig\Template
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
        echo "
</div>
<div class=\"container-fluid\">
<div class=\"widget blog-widget grid";
        // line 4
        if (($context["contrast"] ?? null)) {
            echo " contrast-bg";
        }
        echo "\" ";
        if (($context["use_margin"] ?? null)) {
            echo " style=\"margin-bottom:";
            echo ($context["margin"] ?? null);
            echo "\"";
        }
        echo ">
";
        // line 5
        if (($context["block_title"] ?? null)) {
            // line 6
            echo "    <div class=\"widget-title\">
        ";
            // line 7
            if (($context["title_preline"] ?? null)) {
                echo "<p class=\"pre-line\">";
                echo ($context["title_preline"] ?? null);
                echo "</p>";
            }
            // line 8
            echo "        ";
            if (($context["title"] ?? null)) {
                echo " 
            <p class=\"main-title\"><span>";
                // line 9
                echo ($context["title"] ?? null);
                echo "</span></p>
            <p class=\"widget-title-separator\"><i class=\"icon-line-cross\"></i></p>
        ";
            }
            // line 12
            echo "        ";
            if (($context["title_subline"] ?? null)) {
                // line 13
                echo "        <p class=\"sub-line\"><span>";
                echo ($context["title_subline"] ?? null);
                echo "</span></p>
        ";
            }
            // line 15
            echo "    </div>
";
        }
        // line 17
        echo "    ";
        if (($context["posts"] ?? null)) {
            // line 18
            echo "    <div class=\"grid-holder blog grid";
            echo ($context["columns"] ?? null);
            if (($context["carousel"] ?? null)) {
                echo " carousel";
            }
            echo " module";
            echo ($context["module"] ?? null);
            if ((($context["carousel_a"] ?? null) && (($context["rows"] ?? null) > 1))) {
                echo " sticky-arrows";
            }
            echo "\">
            ";
            // line 19
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["posts"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["blog"]) {
                // line 20
                echo "                <div class=\"item single-blog\">
                  ";
                // line 21
                if ((twig_get_attribute($this->env, $this->source, $context["blog"], "image", [], "any", false, false, false, 21) && ($context["thumb"] ?? null))) {
                    // line 22
                    echo "                    <div class=\"banner_wrap hover-zoom hover-darken\"";
                    if ((($context["columns"] ?? null) == "list")) {
                        echo " style=\"width:";
                        echo ($context["img_width"] ?? null);
                        echo "px\"";
                    }
                    echo ">
                    <img class=\"zoom_image\" src=\"";
                    // line 23
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "image", [], "any", false, false, false, 23);
                    echo "\" loading=\"lazy\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "title", [], "any", false, false, false, 23);
                    echo "\" title=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "title", [], "any", false, false, false, 23);
                    echo "\" />
                    <a href=\"";
                    // line 24
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "href", [], "any", false, false, false, 24);
                    echo "\" class=\"effect-holder\"  title=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "title", [], "any", false, false, false, 24);
                    echo "\"></a>
                    ";
                    // line 25
                    if (($context["date_added_status"] ?? null)) {
                        // line 26
                        echo "                 
                    ";
                    }
                    // line 28
                    echo "                    ";
                    if (twig_get_attribute($this->env, $this->source, $context["blog"], "tags", [], "any", false, false, false, 28)) {
                        // line 29
                        echo "                    <div class=\"tags-wrapper\">
                    <div class=\"tags primary-bg-color\">
                    ";
                        // line 31
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, twig_get_attribute($this->env, $this->source, $context["blog"], "tags", [], "any", false, false, false, 31), 0, 2));
                        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                            // line 32
                            echo "                    <a href=\"index.php?route=extension/blog/home&tag=";
                            echo twig_trim_filter($context["tag"]);
                            echo "\"  title=\"";
                            echo twig_trim_filter($context["tag"]);
                            echo "\">";
                            echo twig_trim_filter($context["tag"]);
                            echo "</a>
                    ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 34
                        echo "                    </div>
                    </div>
                    ";
                    }
                    // line 37
                    echo "                    </div>
                  ";
                }
                // line 39
                echo "                <div class=\"summary\">
                <h3 class=\"blog-title\"><a href=\"";
                // line 40
                echo twig_get_attribute($this->env, $this->source, $context["blog"], "href", [], "any", false, false, false, 40);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["blog"], "title", [], "any", false, false, false, 40);
                echo "</a></h3>
            
                ";
                // line 42
                if (twig_get_attribute($this->env, $this->source, $context["blog"], "short_description", [], "any", false, false, false, 42)) {
                    // line 43
                    echo "                <div class=\"short-description\">";
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "short_description", [], "any", false, false, false, 43);
                    echo "</div>
                ";
                }
                // line 45
                echo "                </div>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['blog'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 48
            echo "        </div> <!-- .grid-holder ends -->
        ";
            // line 49
            if (($context["use_button"] ?? null)) {
                // line 50
                echo "        <div class=\"widget_bottom_btn";
                if ((($context["carousel"] ?? null) && ($context["carousel_b"] ?? null))) {
                    echo " has-dots";
                }
                echo "\">
        <a class=\"btn btn-outline\" href=\"";
                // line 51
                echo ($context["blog_show_all"] ?? null);
                echo "\">";
                echo ($context["text_show_all"] ?? null);
                echo "</a>
        </div>
        ";
            }
            // line 54
            echo "    ";
        }
        // line 55
        echo "    <div class=\"clearfix\"></div>
</div>
</div>
";
        // line 58
        if (($context["carousel"] ?? null)) {
            // line 59
            echo "<script><!--
\$('.grid-holder.blog.module";
            // line 60
            echo ($context["module"] ?? null);
            echo "').slick({
    accessibility: false,
";
            // line 62
            if (($context["carousel_a"] ?? null)) {
                // line 63
                echo "prevArrow: \"<a class=\\\"arrow-left icon-arrow-left\\\"></a>\",
nextArrow: \"<a class=\\\"arrow-right icon-arrow-right\\\"></a>\",
";
            } else {
                // line 66
                echo "arrows: false,
";
            }
            // line 68
            if ((($context["direction"] ?? null) == "rtl")) {
                // line 69
                echo "rtl: true,
";
            }
            // line 71
            if (($context["carousel_b"] ?? null)) {
                // line 72
                echo "dots:true,
";
            }
            // line 74
            echo "respondTo:'min',
rows:";
            // line 75
            echo ($context["rows"] ?? null);
            echo ",
";
            // line 76
            if ((($context["columns"] ?? null) == "4")) {
                // line 77
                echo "slidesToShow:4,slidesToScroll:4,responsive:[{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
";
            } elseif ((            // line 78
($context["columns"] ?? null) == "3")) {
                // line 79
                echo "slidesToShow:3,slidesToScroll:3,responsive:[{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
";
            } elseif ((            // line 80
($context["columns"] ?? null) == "2")) {
                // line 81
                echo "slidesToShow:2,slidesToScroll:2,responsive:[
";
            } elseif (((            // line 82
($context["columns"] ?? null) == "1") || (($context["columns"] ?? null) == "list"))) {
                // line 83
                echo "adaptiveHeight:true,slidesToShow:1,slidesToScroll:1,responsive:[
";
            }
            // line 85
            echo "{breakpoint:420,settings:{slidesToShow:1,slidesToScroll:1}}
]
});
\$(\"[data-toggle='tooltip\").tooltip();
";
            // line 89
            if ((($context["carousel_a"] ?? null) && (($context["rows"] ?? null) > 1))) {
                // line 90
                echo "\$(document).ready(function() {
var c_o = \$('.module";
                // line 91
                echo ($context["module"] ?? null);
                echo "').offset().top;
var c_o_b = \$('.module";
                // line 92
                echo ($context["module"] ?? null);
                echo "').offset().top + \$('.module";
                echo ($context["module"] ?? null);
                echo "').outerHeight(true) - 100;
var sticky_arrows = function(){
var m_o = \$(window).scrollTop() + (\$(window).height()/2);
if (m_o > c_o && m_o < c_o_b) {
\$('.grid-holder.blog.module";
                // line 96
                echo ($context["module"] ?? null);
                echo " .slick-arrow').addClass('visible').css('top', m_o - c_o + 'px');
} else {
\$('.grid-holder.blog.module";
                // line 98
                echo ($context["module"] ?? null);
                echo " .slick-arrow').removeClass('visible');
}
};
\$(window).scroll(function() {sticky_arrows();});
});
";
            }
            // line 104
            echo "//--></script>
";
        }
    }

    public function getTemplateName()
    {
        return "basel/template/extension/module/blog_latest.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  329 => 104,  320 => 98,  315 => 96,  306 => 92,  302 => 91,  299 => 90,  297 => 89,  291 => 85,  287 => 83,  285 => 82,  282 => 81,  280 => 80,  277 => 79,  275 => 78,  272 => 77,  270 => 76,  266 => 75,  263 => 74,  259 => 72,  257 => 71,  253 => 69,  251 => 68,  247 => 66,  242 => 63,  240 => 62,  235 => 60,  232 => 59,  230 => 58,  225 => 55,  222 => 54,  214 => 51,  207 => 50,  205 => 49,  202 => 48,  194 => 45,  188 => 43,  186 => 42,  179 => 40,  176 => 39,  172 => 37,  167 => 34,  154 => 32,  150 => 31,  146 => 29,  143 => 28,  139 => 26,  137 => 25,  131 => 24,  123 => 23,  114 => 22,  112 => 21,  109 => 20,  105 => 19,  92 => 18,  89 => 17,  85 => 15,  79 => 13,  76 => 12,  70 => 9,  65 => 8,  59 => 7,  56 => 6,  54 => 5,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/extension/module/blog_latest.twig", "");
    }
}
