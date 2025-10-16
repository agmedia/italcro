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
class __TwigTemplate_fd70430aee23fd5f2551104c8f882b1a0d8a70c4154548eeab0a014915c33744 extends \Twig\Template
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
<div class=\"container-fluid widget contrast-bg\">
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

    <div class=\"container\">
";
        // line 7
        if (($context["block_title"] ?? null)) {
            // line 8
            echo "    <div class=\"widget-title\">
        ";
            // line 9
            if (($context["title_preline"] ?? null)) {
                echo "<p class=\"pre-line\">";
                echo ($context["title_preline"] ?? null);
                echo "</p>";
            }
            // line 10
            echo "        ";
            if (($context["title"] ?? null)) {
                echo " 
            <p class=\"main-title\"><span>";
                // line 11
                echo ($context["title"] ?? null);
                echo "</span></p>
            <p class=\"widget-title-separator\"><i class=\"icon-line-cross\"></i></p>
        ";
            }
            // line 14
            echo "        ";
            if (($context["title_subline"] ?? null)) {
                // line 15
                echo "        <p class=\"sub-line\"><span>";
                echo ($context["title_subline"] ?? null);
                echo "</span></p>
        ";
            }
            // line 17
            echo "    </div>
";
        }
        // line 19
        echo "    ";
        if (($context["posts"] ?? null)) {
            // line 20
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
            // line 21
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["posts"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["blog"]) {
                // line 22
                echo "                <div class=\"item single-blog\">
                  ";
                // line 23
                if ((twig_get_attribute($this->env, $this->source, $context["blog"], "image", [], "any", false, false, false, 23) && ($context["thumb"] ?? null))) {
                    // line 24
                    echo "                    <div class=\"banner_wrap notbck hover-zoom hover-darken\"";
                    if ((($context["columns"] ?? null) == "list")) {
                        echo " style=\"width:";
                        echo ($context["img_width"] ?? null);
                        echo "px\"";
                    }
                    echo ">
                    <img class=\"zoom_image\" src=\"";
                    // line 25
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "image", [], "any", false, false, false, 25);
                    echo "\" loading=\"lazy\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "title", [], "any", false, false, false, 25);
                    echo "\" title=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "title", [], "any", false, false, false, 25);
                    echo "\" />
                    <a href=\"";
                    // line 26
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "href", [], "any", false, false, false, 26);
                    echo "\" class=\"effect-holder\"  title=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "title", [], "any", false, false, false, 26);
                    echo "\"></a>
                    ";
                    // line 27
                    if (($context["date_added_status"] ?? null)) {
                        // line 28
                        echo "                 
                    ";
                    }
                    // line 30
                    echo "                    ";
                    if (twig_get_attribute($this->env, $this->source, $context["blog"], "tags", [], "any", false, false, false, 30)) {
                        // line 31
                        echo "                    <div class=\"tags-wrapper\">
                    <div class=\"tags primary-bg-color\">
                    ";
                        // line 33
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, twig_get_attribute($this->env, $this->source, $context["blog"], "tags", [], "any", false, false, false, 33), 0, 2));
                        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                            // line 34
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
                        // line 36
                        echo "                    </div>
                    </div>
                    ";
                    }
                    // line 39
                    echo "                    </div>
                  ";
                }
                // line 41
                echo "                <div class=\"summary\">
                <h3 class=\"blog-title\"><a href=\"";
                // line 42
                echo twig_get_attribute($this->env, $this->source, $context["blog"], "href", [], "any", false, false, false, 42);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["blog"], "title", [], "any", false, false, false, 42);
                echo "</a></h3>
            
                ";
                // line 44
                if (twig_get_attribute($this->env, $this->source, $context["blog"], "short_description", [], "any", false, false, false, 44)) {
                    // line 45
                    echo "                <div class=\"short-description\">";
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "short_description", [], "any", false, false, false, 45);
                    echo "</div>
                ";
                }
                // line 47
                echo "                </div>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['blog'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 50
            echo "        </div> <!-- .grid-holder ends -->
        ";
            // line 51
            if (($context["use_button"] ?? null)) {
                // line 52
                echo "        <div class=\"widget_bottom_btn";
                if ((($context["carousel"] ?? null) && ($context["carousel_b"] ?? null))) {
                    echo " has-dots";
                }
                echo "\">
        <a class=\"btn btn-outline\" href=\"";
                // line 53
                echo ($context["blog_show_all"] ?? null);
                echo "\">";
                echo ($context["text_show_all"] ?? null);
                echo "</a>
        </div>
        ";
            }
            // line 56
            echo "    ";
        }
        // line 57
        echo "    <div class=\"clearfix\"></div>
</div>
</div>
</div>
";
        // line 61
        if (($context["carousel"] ?? null)) {
            // line 62
            echo "<script><!--
\$('.grid-holder.blog.module";
            // line 63
            echo ($context["module"] ?? null);
            echo "').slick({
    accessibility: false,
";
            // line 65
            if (($context["carousel_a"] ?? null)) {
                // line 66
                echo "prevArrow: \"<a class=\\\"arrow-left icon-arrow-left\\\"></a>\",
nextArrow: \"<a class=\\\"arrow-right icon-arrow-right\\\"></a>\",
";
            } else {
                // line 69
                echo "arrows: false,
";
            }
            // line 71
            if ((($context["direction"] ?? null) == "rtl")) {
                // line 72
                echo "rtl: true,
";
            }
            // line 74
            if (($context["carousel_b"] ?? null)) {
                // line 75
                echo "dots:true,
";
            }
            // line 77
            echo "respondTo:'min',
rows:";
            // line 78
            echo ($context["rows"] ?? null);
            echo ",
";
            // line 79
            if ((($context["columns"] ?? null) == "4")) {
                // line 80
                echo "slidesToShow:4,slidesToScroll:4,responsive:[{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
";
            } elseif ((            // line 81
($context["columns"] ?? null) == "3")) {
                // line 82
                echo "slidesToShow:3,slidesToScroll:3,responsive:[{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
";
            } elseif ((            // line 83
($context["columns"] ?? null) == "2")) {
                // line 84
                echo "slidesToShow:2,slidesToScroll:2,responsive:[
";
            } elseif (((            // line 85
($context["columns"] ?? null) == "1") || (($context["columns"] ?? null) == "list"))) {
                // line 86
                echo "adaptiveHeight:true,slidesToShow:1,slidesToScroll:1,responsive:[
";
            }
            // line 88
            echo "{breakpoint:420,settings:{slidesToShow:1,slidesToScroll:1}}
]
});
\$(\"[data-toggle='tooltip\").tooltip();
";
            // line 92
            if ((($context["carousel_a"] ?? null) && (($context["rows"] ?? null) > 1))) {
                // line 93
                echo "\$(document).ready(function() {
var c_o = \$('.module";
                // line 94
                echo ($context["module"] ?? null);
                echo "').offset().top;
var c_o_b = \$('.module";
                // line 95
                echo ($context["module"] ?? null);
                echo "').offset().top + \$('.module";
                echo ($context["module"] ?? null);
                echo "').outerHeight(true) - 100;
var sticky_arrows = function(){
var m_o = \$(window).scrollTop() + (\$(window).height()/2);
if (m_o > c_o && m_o < c_o_b) {
\$('.grid-holder.blog.module";
                // line 99
                echo ($context["module"] ?? null);
                echo " .slick-arrow').addClass('visible').css('top', m_o - c_o + 'px');
} else {
\$('.grid-holder.blog.module";
                // line 101
                echo ($context["module"] ?? null);
                echo " .slick-arrow').removeClass('visible');
}
};
\$(window).scroll(function() {sticky_arrows();});
});
";
            }
            // line 107
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
        return array (  332 => 107,  323 => 101,  318 => 99,  309 => 95,  305 => 94,  302 => 93,  300 => 92,  294 => 88,  290 => 86,  288 => 85,  285 => 84,  283 => 83,  280 => 82,  278 => 81,  275 => 80,  273 => 79,  269 => 78,  266 => 77,  262 => 75,  260 => 74,  256 => 72,  254 => 71,  250 => 69,  245 => 66,  243 => 65,  238 => 63,  235 => 62,  233 => 61,  227 => 57,  224 => 56,  216 => 53,  209 => 52,  207 => 51,  204 => 50,  196 => 47,  190 => 45,  188 => 44,  181 => 42,  178 => 41,  174 => 39,  169 => 36,  156 => 34,  152 => 33,  148 => 31,  145 => 30,  141 => 28,  139 => 27,  133 => 26,  125 => 25,  116 => 24,  114 => 23,  111 => 22,  107 => 21,  94 => 20,  91 => 19,  87 => 17,  81 => 15,  78 => 14,  72 => 11,  67 => 10,  61 => 9,  58 => 8,  56 => 7,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/extension/module/blog_latest.twig", "");
    }
}
