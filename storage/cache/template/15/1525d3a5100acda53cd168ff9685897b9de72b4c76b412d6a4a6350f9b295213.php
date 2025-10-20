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
class __TwigTemplate_1cf81ac54aafed4e053a9bcdac733b4b60c694b3699f742e1a9c9de806a0a44c extends \Twig\Template
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
        echo "<div class=\"widget blog-widget grid";
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
        // line 2
        if (($context["block_title"] ?? null)) {
            // line 3
            echo "    <div class=\"widget-title\">
        ";
            // line 4
            if (($context["title_preline"] ?? null)) {
                echo "<p class=\"pre-line\">";
                echo ($context["title_preline"] ?? null);
                echo "</p>";
            }
            // line 5
            echo "        ";
            if (($context["title"] ?? null)) {
                echo " 
            <p class=\"main-title\"><span>";
                // line 6
                echo ($context["title"] ?? null);
                echo "</span></p>
            <p class=\"widget-title-separator\"><i class=\"icon-line-cross\"></i></p>
        ";
            }
            // line 9
            echo "        ";
            if (($context["title_subline"] ?? null)) {
                // line 10
                echo "        <p class=\"sub-line\"><span>";
                echo ($context["title_subline"] ?? null);
                echo "</span></p>
        ";
            }
            // line 12
            echo "    </div>
";
        }
        // line 14
        echo "    ";
        if (($context["posts"] ?? null)) {
            // line 15
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
            // line 16
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["posts"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["blog"]) {
                // line 17
                echo "                <div class=\"item single-blog\">
                  ";
                // line 18
                if ((twig_get_attribute($this->env, $this->source, $context["blog"], "image", [], "any", false, false, false, 18) && ($context["thumb"] ?? null))) {
                    // line 19
                    echo "                    <div class=\"banner_wrap hover-zoom hover-darken\"";
                    if ((($context["columns"] ?? null) == "list")) {
                        echo " style=\"width:";
                        echo ($context["img_width"] ?? null);
                        echo "px\"";
                    }
                    echo ">
                    <img class=\"zoom_image\" src=\"";
                    // line 20
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "image", [], "any", false, false, false, 20);
                    echo "\" loading=\"lazy\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "title", [], "any", false, false, false, 20);
                    echo "\" title=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "title", [], "any", false, false, false, 20);
                    echo "\" />
                    <a href=\"";
                    // line 21
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "href", [], "any", false, false, false, 21);
                    echo "\" class=\"effect-holder\"  title=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "title", [], "any", false, false, false, 21);
                    echo "\"></a>
                    ";
                    // line 22
                    if (($context["date_added_status"] ?? null)) {
                        // line 23
                        echo "                 
                    ";
                    }
                    // line 25
                    echo "                    ";
                    if (twig_get_attribute($this->env, $this->source, $context["blog"], "tags", [], "any", false, false, false, 25)) {
                        // line 26
                        echo "                    <div class=\"tags-wrapper\">
                    <div class=\"tags primary-bg-color\">
                    ";
                        // line 28
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, twig_get_attribute($this->env, $this->source, $context["blog"], "tags", [], "any", false, false, false, 28), 0, 2));
                        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                            // line 29
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
                        // line 31
                        echo "                    </div>
                    </div>
                    ";
                    }
                    // line 34
                    echo "                    </div>
                  ";
                }
                // line 36
                echo "                <div class=\"summary\">
                <h3 class=\"blog-title\"><a href=\"";
                // line 37
                echo twig_get_attribute($this->env, $this->source, $context["blog"], "href", [], "any", false, false, false, 37);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["blog"], "title", [], "any", false, false, false, 37);
                echo "</a></h3>
            
                ";
                // line 39
                if (twig_get_attribute($this->env, $this->source, $context["blog"], "short_description", [], "any", false, false, false, 39)) {
                    // line 40
                    echo "                <div class=\"short-description\">";
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "short_description", [], "any", false, false, false, 40);
                    echo "</div>
                ";
                }
                // line 42
                echo "                </div>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['blog'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 45
            echo "        </div> <!-- .grid-holder ends -->
        ";
            // line 46
            if (($context["use_button"] ?? null)) {
                // line 47
                echo "        <div class=\"widget_bottom_btn";
                if ((($context["carousel"] ?? null) && ($context["carousel_b"] ?? null))) {
                    echo " has-dots";
                }
                echo "\">
        <a class=\"btn btn-outline\" href=\"";
                // line 48
                echo ($context["blog_show_all"] ?? null);
                echo "\">";
                echo ($context["text_show_all"] ?? null);
                echo "</a>
        </div>
        ";
            }
            // line 51
            echo "    ";
        }
        // line 52
        echo "    <div class=\"clearfix\"></div>
</div>

";
        // line 55
        if (($context["carousel"] ?? null)) {
            // line 56
            echo "<script><!--
\$('.grid-holder.blog.module";
            // line 57
            echo ($context["module"] ?? null);
            echo "').slick({
    accessibility: false,
";
            // line 59
            if (($context["carousel_a"] ?? null)) {
                // line 60
                echo "prevArrow: \"<a class=\\\"arrow-left icon-arrow-left\\\"></a>\",
nextArrow: \"<a class=\\\"arrow-right icon-arrow-right\\\"></a>\",
";
            } else {
                // line 63
                echo "arrows: false,
";
            }
            // line 65
            if ((($context["direction"] ?? null) == "rtl")) {
                // line 66
                echo "rtl: true,
";
            }
            // line 68
            if (($context["carousel_b"] ?? null)) {
                // line 69
                echo "dots:true,
";
            }
            // line 71
            echo "respondTo:'min',
rows:";
            // line 72
            echo ($context["rows"] ?? null);
            echo ",
";
            // line 73
            if ((($context["columns"] ?? null) == "4")) {
                // line 74
                echo "slidesToShow:4,slidesToScroll:4,responsive:[{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
";
            } elseif ((            // line 75
($context["columns"] ?? null) == "3")) {
                // line 76
                echo "slidesToShow:3,slidesToScroll:3,responsive:[{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
";
            } elseif ((            // line 77
($context["columns"] ?? null) == "2")) {
                // line 78
                echo "slidesToShow:2,slidesToScroll:2,responsive:[
";
            } elseif (((            // line 79
($context["columns"] ?? null) == "1") || (($context["columns"] ?? null) == "list"))) {
                // line 80
                echo "adaptiveHeight:true,slidesToShow:1,slidesToScroll:1,responsive:[
";
            }
            // line 82
            echo "{breakpoint:420,settings:{slidesToShow:1,slidesToScroll:1}}
]
});
\$(\"[data-toggle='tooltip\").tooltip();
";
            // line 86
            if ((($context["carousel_a"] ?? null) && (($context["rows"] ?? null) > 1))) {
                // line 87
                echo "\$(document).ready(function() {
var c_o = \$('.module";
                // line 88
                echo ($context["module"] ?? null);
                echo "').offset().top;
var c_o_b = \$('.module";
                // line 89
                echo ($context["module"] ?? null);
                echo "').offset().top + \$('.module";
                echo ($context["module"] ?? null);
                echo "').outerHeight(true) - 100;
var sticky_arrows = function(){
var m_o = \$(window).scrollTop() + (\$(window).height()/2);
if (m_o > c_o && m_o < c_o_b) {
\$('.grid-holder.blog.module";
                // line 93
                echo ($context["module"] ?? null);
                echo " .slick-arrow').addClass('visible').css('top', m_o - c_o + 'px');
} else {
\$('.grid-holder.blog.module";
                // line 95
                echo ($context["module"] ?? null);
                echo " .slick-arrow').removeClass('visible');
}
};
\$(window).scroll(function() {sticky_arrows();});
});
";
            }
            // line 101
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
        return array (  325 => 101,  316 => 95,  311 => 93,  302 => 89,  298 => 88,  295 => 87,  293 => 86,  287 => 82,  283 => 80,  281 => 79,  278 => 78,  276 => 77,  273 => 76,  271 => 75,  268 => 74,  266 => 73,  262 => 72,  259 => 71,  255 => 69,  253 => 68,  249 => 66,  247 => 65,  243 => 63,  238 => 60,  236 => 59,  231 => 57,  228 => 56,  226 => 55,  221 => 52,  218 => 51,  210 => 48,  203 => 47,  201 => 46,  198 => 45,  190 => 42,  184 => 40,  182 => 39,  175 => 37,  172 => 36,  168 => 34,  163 => 31,  150 => 29,  146 => 28,  142 => 26,  139 => 25,  135 => 23,  133 => 22,  127 => 21,  119 => 20,  110 => 19,  108 => 18,  105 => 17,  101 => 16,  88 => 15,  85 => 14,  81 => 12,  75 => 10,  72 => 9,  66 => 6,  61 => 5,  55 => 4,  52 => 3,  50 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/extension/module/blog_latest.twig", "");
    }
}
