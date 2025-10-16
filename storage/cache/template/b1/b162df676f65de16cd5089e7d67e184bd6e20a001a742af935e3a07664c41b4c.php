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

/* basel/template/extension/module/basel_carousel.twig */
class __TwigTemplate_824e0fe97f6e36f532d60b2df1b26a516f404afac7a7cb22af2adae125031332 extends \Twig\Template
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
        echo "<div class=\"widget carousel-widget grid";
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
            echo "<!-- Block Title -->
<div class=\"widget-title\">
    ";
            // line 5
            if (($context["title_preline"] ?? null)) {
                echo "<p class=\"pre-line\">";
                echo ($context["title_preline"] ?? null);
                echo "</p>";
            }
            // line 6
            echo "    ";
            if (($context["title"] ?? null)) {
                // line 7
                echo "        <p class=\"main-title\"><span>";
                echo ($context["title"] ?? null);
                echo "</span></p>
        <p class=\"widget-title-separator\"><i class=\"icon-line-cross\"></i></p>
    ";
            }
            // line 10
            echo "    ";
            if (($context["title_subline"] ?? null)) {
                // line 11
                echo "    <p class=\"sub-line\"><span>";
                echo ($context["title_subline"] ?? null);
                echo "</span></p>
    ";
            }
            // line 13
            echo "</div>
";
        }
        // line 15
        echo "<div id=\"gallery\" class=\"grid-holder carousel carousel_module cm_content module";
        echo ($context["module"] ?? null);
        echo "\">

    ";
        // line 17
        if ((($context["module"] ?? null) == 1)) {
            // line 18
            echo "  ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["banners"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["banner"]) {
                // line 19
                echo "  
<div class=\"item type-img cm_column eq_height\">
    <a class=\"link\" href=\"";
                // line 21
                echo twig_get_attribute($this->env, $this->source, $context["banner"], "image", [], "any", false, false, false, 21);
                echo "\">
         <div class=\"banner_wrap  \">
    <div class=\"zoom_image_wrap\"> <img  src=\"";
                // line 23
                echo twig_get_attribute($this->env, $this->source, $context["banner"], "image", [], "any", false, false, false, 23);
                echo "\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["banner"], "title", [], "any", false, false, false, 23);
                echo "\" /></div>
    <div class=\"effect-holder\"></div>
    <div class=\"banner_overlay\">
        <div class=\"cm_item_wrapper pointer\" >
            <div class=\"cm_item \" style=\"padding: 10px 20px;position: absolute;bottom: 10px; left: 50%;transform: translate(-50%, -50%); background-color: rgba(0,0,0,.5)\">
               ";
                // line 28
                echo twig_get_attribute($this->env, $this->source, $context["banner"], "title", [], "any", false, false, false, 28);
                echo "
            </div>
        </div>
    </div>
    </div>
    </a>
      </div>
  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['banner'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 36
            echo "

  ";
        } else {
            // line 39
            echo "
    ";
            // line 40
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["banners"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["banner"]) {
                // line 41
                echo "    <div class=\"item text-center\">
    ";
                // line 42
                if (twig_get_attribute($this->env, $this->source, $context["banner"], "link", [], "any", false, false, false, 42)) {
                    // line 43
                    echo "        <a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["banner"], "link", [], "any", false, false, false, 43);
                    echo "\"><img src=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["banner"], "image", [], "any", false, false, false, 43);
                    echo "\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["banner"], "title", [], "any", false, false, false, 43);
                    echo "\" class=\"display-inline-block bw\" /></a>
    ";
                } else {
                    // line 45
                    echo "        <img src=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["banner"], "image", [], "any", false, false, false, 45);
                    echo "\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["banner"], "title", [], "any", false, false, false, 45);
                    echo "\" class=\"display-inline-block bw\" />
    ";
                }
                // line 47
                echo "    </div>
  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['banner'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 49
            echo "

  ";
        }
        // line 52
        echo "


</div> <!-- .grid-holder ends -->
<div class=\"clearfix\"></div>
</div>




<script><!--
\$('.grid-holder.carousel_module.module";
        // line 63
        echo ($context["module"] ?? null);
        echo "').slick({
";
        // line 64
        if (($context["carousel_a"] ?? null)) {
            // line 65
            echo "prevArrow: \"<a class=\\\"arrow-left icon-arrow-left\\\"></a>\",
nextArrow: \"<a class=\\\"arrow-right icon-arrow-right\\\"></a>\",
";
        } else {
            // line 68
            echo "arrows: false,
";
        }
        // line 70
        if (($context["carousel_b"] ?? null)) {
            // line 71
            echo "dots:true,
";
        }
        // line 73
        if ((($context["direction"] ?? null) == "rtl")) {
            // line 74
            echo "rtl: true,
";
        }
        // line 76
        if (($context["autoplay"] ?? null)) {
            // line 77
            echo "autoplay:true,
autoplaySpeed:";
            // line 78
            echo ($context["autoplay"] ?? null);
            echo ",
";
        }
        // line 80
        echo "respondTo:'min',
slidesToScroll:1,
rows:";
        // line 82
        echo ($context["rows"] ?? null);
        echo ",
";
        // line 83
        if ((($context["columns"] ?? null) == "6")) {
            // line 84
            echo "slidesToShow:6,responsive:[{breakpoint:1100,settings:{slidesToShow:5,slidesToScroll:5}},{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
";
        } elseif ((        // line 85
($context["columns"] ?? null) == "5")) {
            // line 86
            echo "slidesToShow:5,responsive:[{breakpoint:1100,settings:{slidesToShow:4,slidesToScroll:4}},{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
";
        } elseif ((        // line 87
($context["columns"] ?? null) == "4")) {
            // line 88
            echo "slidesToShow:4,responsive:[{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
";
        } elseif ((        // line 89
($context["columns"] ?? null) == "3")) {
            // line 90
            echo "slidesToShow:3,responsive:[{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
";
        } elseif ((        // line 91
($context["columns"] ?? null) == "2")) {
            // line 92
            echo "slidesToShow:2,responsive:[
";
        } elseif (((        // line 93
($context["columns"] ?? null) == "1") || (($context["columns"] ?? null) == "list"))) {
            // line 94
            echo "
adaptiveHeight:true,slidesToShow:1,slidesToScroll:1,responsive:[
   
";
        }
        // line 98
        echo " ";
        if ((($context["module"] ?? null) == 1)) {
            // line 99
            echo "{breakpoint:420,settings:{slidesToShow:1}}
   ";
        } else {
            // line 101
            echo "    {breakpoint:420,settings:{slidesToShow:2}}  
      ";
        }
        // line 103
        echo "]
});
//--></script>




<script>
\$(document).ready(function() {
// Image Gallery
\$(\".slick-slider\").lightGallery({
  selector: '.link',
  download:false,
  hideBarsDelay:99999
});
});
//--></script>";
    }

    public function getTemplateName()
    {
        return "basel/template/extension/module/basel_carousel.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  280 => 103,  276 => 101,  272 => 99,  269 => 98,  263 => 94,  261 => 93,  258 => 92,  256 => 91,  253 => 90,  251 => 89,  248 => 88,  246 => 87,  243 => 86,  241 => 85,  238 => 84,  236 => 83,  232 => 82,  228 => 80,  223 => 78,  220 => 77,  218 => 76,  214 => 74,  212 => 73,  208 => 71,  206 => 70,  202 => 68,  197 => 65,  195 => 64,  191 => 63,  178 => 52,  173 => 49,  166 => 47,  158 => 45,  148 => 43,  146 => 42,  143 => 41,  139 => 40,  136 => 39,  131 => 36,  117 => 28,  107 => 23,  102 => 21,  98 => 19,  93 => 18,  91 => 17,  85 => 15,  81 => 13,  75 => 11,  72 => 10,  65 => 7,  62 => 6,  56 => 5,  52 => 3,  50 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/extension/module/basel_carousel.twig", "");
    }
}
