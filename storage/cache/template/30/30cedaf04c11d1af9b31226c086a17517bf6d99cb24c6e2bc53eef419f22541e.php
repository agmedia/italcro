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

/* basel/template/extension/module/basel_content.twig */
class __TwigTemplate_997ec89fca9f2ea1cf00322739528fc3d4bf2513514992669f91f8d007a8dce4 extends \Twig\Template
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
        if (($context["block_full_width"] ?? null)) {
            // line 2
            echo "</div>
";
        }
        // line 4
        echo "<div class=\"widget cm_module\" style=\"";
        echo ($context["module_margins"] ?? null);
        echo "\">
";
        // line 5
        if (($context["block_title"] ?? null)) {
            // line 6
            echo "<!-- Block Title -->
<div class=\"widget-title\">
";
            // line 8
            if (($context["title_preline"] ?? null)) {
                echo "<p class=\"pre-line\">";
                echo ($context["title_preline"] ?? null);
                echo "</p>";
            }
            // line 9
            if (($context["title"] ?? null)) {
                // line 10
                echo "<p class=\"main-title\"><span>";
                echo ($context["title"] ?? null);
                echo "</span></p>
<p class=\"widget-title-separator\"><i class=\"icon-line-cross\"></i></p>
";
            }
            // line 13
            if (($context["title_subline"] ?? null)) {
                // line 14
                echo "<p class=\"sub-line\"><span>";
                echo ($context["title_subline"] ?? null);
                echo "</span></p>
";
            }
            // line 16
            echo "</div>
";
        }
        // line 18
        echo "<div class=\"cm_block_wrapper\">
";
        // line 19
        if (($context["bg_video"] ?? null)) {
            echo "<div class=\"vid-holder\"></div>";
        }
        // line 20
        echo "<div class=\"cm_block ";
        echo ($context["module"] ?? null);
        echo "\" style=\"";
        echo ($context["block_style"] ?? null);
        echo ";\">
<div class=\"";
        // line 21
        if (( !($context["content_full_width"] ?? null) && ($context["block_full_width"] ?? null))) {
            echo "container";
        }
        echo "\">
";
        // line 22
        if (($context["columns"] ?? null)) {
            // line 23
            echo "<div class=\"cm_content\" style=\"";
            echo ($context["content_style"] ?? null);
            echo ";\">
<div class=\"row ";
            // line 24
            if (($context["content_no_margin"] ?? null)) {
                echo "marginless";
            }
            echo "\">
";
            // line 25
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["columns"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["column"]) {
                // line 26
                echo "<div class=\"";
                echo twig_get_attribute($this->env, $this->source, $context["column"], "column_class", [], "any", false, false, false, 26);
                echo " type-";
                echo twig_get_attribute($this->env, $this->source, $context["column"], "type", [], "any", false, false, false, 26);
                echo " cm_column ";
                if (($context["equal_height"] ?? null)) {
                    echo "eq_height";
                }
                echo "\">    
";
                // line 27
                if ((twig_get_attribute($this->env, $this->source, $context["column"], "type", [], "any", false, false, false, 27) == "img")) {
                    // line 28
                    echo "    ";
                    if (twig_get_attribute($this->env, $this->source, $context["column"], "data2", [], "any", false, false, false, 28)) {
                        // line 29
                        echo "    <!-- Banner type -->
    <div class=\"banner_wrap notbck\">
    <div class=\"zoom_image_wrap\"><img class=\"zoom_image\" src=\"";
                        // line 31
                        echo twig_get_attribute($this->env, $this->source, $context["column"], "data2", [], "any", false, false, false, 31);
                        echo "\" alt=\"\" /></div>
    <div class=\"effect-holder\"></div>
    <div class=\"banner_overlay\">
        <div class=\"cm_item_wrapper ";
                        // line 34
                        if (twig_get_attribute($this->env, $this->source, $context["column"], "data5", [], "any", false, false, false, 34)) {
                            echo "pointer\" onclick=\"location.href='";
                            echo twig_get_attribute($this->env, $this->source, $context["column"], "data5", [], "any", false, false, false, 34);
                            echo "';";
                        }
                        echo "\">
            <div class=\"cm_item ";
                        // line 35
                        echo twig_get_attribute($this->env, $this->source, $context["column"], "data7", [], "any", false, false, false, 35);
                        echo "\">
                ";
                        // line 36
                        echo twig_get_attribute($this->env, $this->source, $context["column"], "data1", [], "any", false, false, false, 36);
                        echo "
            </div>
        </div>
    </div>
    </div>
    ";
                    }
                    // line 42
                    echo "    ";
                    if (twig_get_attribute($this->env, $this->source, $context["column"], "data4", [], "any", false, false, false, 42)) {
                        // line 43
                        echo "    <div class=\"banner_wrap notbck\">
    <div class=\"zoom_image_wrap\"><img class=\"zoom_image\" src=\"";
                        // line 44
                        echo twig_get_attribute($this->env, $this->source, $context["column"], "data4", [], "any", false, false, false, 44);
                        echo "\" alt=\"\" /></div>
    <div class=\"effect-holder\"></div>
    <div class=\"banner_overlay\">
        <div class=\"cm_item_wrapper ";
                        // line 47
                        if (twig_get_attribute($this->env, $this->source, $context["column"], "data6", [], "any", false, false, false, 47)) {
                            echo "pointer\" onclick=\"location.href='";
                            echo twig_get_attribute($this->env, $this->source, $context["column"], "data6", [], "any", false, false, false, 47);
                            echo "';";
                        }
                        echo "\">
            <div class=\"cm_item ";
                        // line 48
                        echo twig_get_attribute($this->env, $this->source, $context["column"], "data8", [], "any", false, false, false, 48);
                        echo "\">
                ";
                        // line 49
                        echo twig_get_attribute($this->env, $this->source, $context["column"], "data3", [], "any", false, false, false, 49);
                        echo "
            </div>
        </div>
    </div>
    </div>
    ";
                    }
                } elseif ((twig_get_attribute($this->env, $this->source,                 // line 55
$context["column"], "type", [], "any", false, false, false, 55) == "tm")) {
                    // line 56
                    echo "    <!-- Testimonial type -->
    ";
                    // line 57
                    if (($context["testimonials"] ?? null)) {
                        // line 58
                        echo "    <div class=\"grid-holder ";
                        echo twig_get_attribute($this->env, $this->source, $context["column"], "data8", [], "any", false, false, false, 58);
                        echo " tm_module grid";
                        echo twig_get_attribute($this->env, $this->source, $context["column"], "data7", [], "any", false, false, false, 58);
                        echo "\">
    ";
                        // line 59
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(($context["testimonials"] ?? null));
                        foreach ($context['_seq'] as $context["_key"] => $context["testimonial"]) {
                            // line 60
                            echo "    <div class=\"item single-testimonial\">
        <div class=\"testimonial-wrap\">
        ";
                            // line 62
                            if (twig_get_attribute($this->env, $this->source, $context["testimonial"], "image", [], "any", false, false, false, 62)) {
                                // line 63
                                echo "        <p><img src=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["testimonial"], "image", [], "any", false, false, false, 63);
                                echo "\" alt=\"\"/></p>
        ";
                            }
                            // line 65
                            echo "        <p>";
                            echo twig_get_attribute($this->env, $this->source, $context["testimonial"], "description", [], "any", false, false, false, 65);
                            echo "</p>
        <p><b>";
                            // line 66
                            echo twig_get_attribute($this->env, $this->source, $context["testimonial"], "name", [], "any", false, false, false, 66);
                            echo "</b>";
                            if (twig_get_attribute($this->env, $this->source, $context["testimonial"], "org", [], "any", false, false, false, 66)) {
                                echo " - ";
                                echo twig_get_attribute($this->env, $this->source, $context["testimonial"], "org", [], "any", false, false, false, 66);
                            }
                            echo "</p> 
        </div>    
    </div>
    ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['testimonial'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 70
                        echo "    </div>
    ";
                    } else {
                        // line 72
                        echo "    No testimonials found
    ";
                    }
                } else {
                    // line 75
                    echo "    <!-- HTML/Newsletter type -->
    <div class=\"cm_item_wrapper\">
        <div class=\"cm_item ";
                    // line 77
                    echo twig_get_attribute($this->env, $this->source, $context["column"], "data7", [], "any", false, false, false, 77);
                    echo "\">
            ";
                    // line 78
                    echo twig_get_attribute($this->env, $this->source, $context["column"], "data1", [], "any", false, false, false, 78);
                    echo "
        </div>
    </div>
";
                }
                // line 82
                echo "</div>    
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['column'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 84
            echo "</div>
</div>
";
        }
        // line 87
        echo "</div>
</div>
</div>
</div>
";
        // line 91
        if (($context["block_full_width"] ?? null)) {
            // line 92
            echo "<div class=\"container\">
";
        }
        // line 94
        if ((($context["para_status"] ?? null) && ($context["bg_img"] ?? null))) {
            // line 95
            echo "<script>
\$(window).load(function(){
\$('.cm_block.";
            // line 97
            echo ($context["module"] ?? null);
            echo "').parallax(\"50%\", 0.";
            echo ($context["para_status"] ?? null);
            echo ");
})
</script>
";
        }
        // line 101
        if (($context["bg_video"] ?? null)) {
            // line 102
            echo "<script>
\$('.vid-holder').tuber({
videoId: '";
            // line 104
            echo ($context["video_id"] ?? null);
            echo "',
isBackground: false
});
</script>
";
        }
        // line 109
        echo "
";
        // line 110
        if (($context["columns"] ?? null)) {
            // line 111
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["columns"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["column"]) {
                // line 112
                if ((twig_get_attribute($this->env, $this->source, $context["column"], "type", [], "any", false, false, false, 112) == "tm")) {
                    // line 113
                    echo "<script><!--
\$('.grid-holder.tm_module').slick({
adaptiveHeight:true,
dots:true,
";
                    // line 117
                    if ((($context["direction"] ?? null) == "rtl")) {
                        // line 118
                        echo "rtl: true,
";
                    }
                    // line 120
                    echo "arrows: false,
respondTo:'min',
";
                    // line 122
                    if ((twig_get_attribute($this->env, $this->source, $context["column"], "data7", [], "any", false, false, false, 122) == "3")) {
                        // line 123
                        echo "slidesToShow:3,slidesToScroll:3,responsive:[{breakpoint:960,settings:{slidesToShow:1,slidesToScroll:1}}],
";
                    } elseif ((twig_get_attribute($this->env, $this->source,                     // line 124
$context["column"], "data7", [], "any", false, false, false, 124) == "2")) {
                        // line 125
                        echo "slidesToShow:2,slidesToScroll:2,responsive:[{breakpoint:960,settings:{slidesToShow:1,slidesToScroll:1}}]
";
                    } elseif ((twig_get_attribute($this->env, $this->source,                     // line 126
$context["column"], "data7", [], "any", false, false, false, 126) == "1")) {
                        // line 127
                        echo "slidesToShow:1,slidesToScroll:1,responsive:[]
";
                    }
                    // line 129
                    echo "}).parents('.cm_block_wrapper').addClass('has-testimonials');
//--></script>
";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['column'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
    }

    public function getTemplateName()
    {
        return "basel/template/extension/module/basel_content.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  368 => 129,  364 => 127,  362 => 126,  359 => 125,  357 => 124,  354 => 123,  352 => 122,  348 => 120,  344 => 118,  342 => 117,  336 => 113,  334 => 112,  330 => 111,  328 => 110,  325 => 109,  317 => 104,  313 => 102,  311 => 101,  302 => 97,  298 => 95,  296 => 94,  292 => 92,  290 => 91,  284 => 87,  279 => 84,  272 => 82,  265 => 78,  261 => 77,  257 => 75,  252 => 72,  248 => 70,  233 => 66,  228 => 65,  222 => 63,  220 => 62,  216 => 60,  212 => 59,  205 => 58,  203 => 57,  200 => 56,  198 => 55,  189 => 49,  185 => 48,  177 => 47,  171 => 44,  168 => 43,  165 => 42,  156 => 36,  152 => 35,  144 => 34,  138 => 31,  134 => 29,  131 => 28,  129 => 27,  118 => 26,  114 => 25,  108 => 24,  103 => 23,  101 => 22,  95 => 21,  88 => 20,  84 => 19,  81 => 18,  77 => 16,  71 => 14,  69 => 13,  62 => 10,  60 => 9,  54 => 8,  50 => 6,  48 => 5,  43 => 4,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/extension/module/basel_content.twig", "");
    }
}
