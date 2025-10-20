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

/* basel/template/common/header.twig */
class __TwigTemplate_3c14c21a1fa4306baf8e51f41a5efa407df84b458ab7fa9722393af0f9a9f088 extends \Twig\Template
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
        echo "<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir=\"";
        // line 3
        echo ($context["direction"] ?? null);
        echo "\" lang=\"";
        echo ($context["lang"] ?? null);
        echo "\" class=\"ie8\"><![endif]-->
<!--[if IE 9 ]><html dir=\"";
        // line 4
        echo ($context["direction"] ?? null);
        echo "\" lang=\"";
        echo ($context["lang"] ?? null);
        echo "\" class=\"ie9\"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir=\"";
        // line 6
        echo ($context["direction"] ?? null);
        echo "\" lang=\"";
        echo ($context["lang"] ?? null);
        echo "\">
<!--<![endif]-->
<head>
<meta charset=\"UTF-8\" />
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
<title>";
        // line 12
        echo ($context["title"] ?? null);
        echo "</title>
<base href=\"";
        // line 13
        echo ($context["base"] ?? null);
        echo "\" />
  <link rel=\"icon\" type=\"image/png\" href=\"favicon-96x96.png\" sizes=\"96x96\" />
  <link rel=\"icon\" type=\"image/svg+xml\" href=\"favicon.svg\" />
  <link rel=\"shortcut icon\" href=\"favicon.ico\" />
  <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"apple-touch-icon.png\" />
  <meta name=\"apple-mobile-web-app-title\" content=\"Repro-grav\" />
  <link rel=\"manifest\" href=\"site.webmanifest\" />


<!-- Analytic tools -->
";
        // line 23
        if (($context["description"] ?? null)) {
            echo "<meta name=\"description\" content=\"";
            echo ($context["description"] ?? null);
            echo "\" />";
        }
        // line 24
        if (($context["keywords"] ?? null)) {
            echo "<meta name=\"keywords\" content= \"";
            echo ($context["keywords"] ?? null);
            echo "\" />";
        }
        // line 25
        echo "<!-- Load essential resources -->
<script src=\"catalog/view/javascript/jquery/jquery-2.1.1.min.js\"></script>
<link href=\"catalog/view/javascript/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\" media=\"screen\" />
<script src=\"catalog/view/javascript/bootstrap/js/bootstrap.min.js\"></script>
<script src=\"catalog/view/javascript/slick/slick.min.js\"></script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"catalog/view/javascript/slick/slick.css\"/>
<link rel=\"stylesheet\" type=\"text/css\" href=\"catalog/view/javascript/slick/slick-theme.css\"/>
<script src=\"catalog/view/theme/basel/js/basel_common.js\"></script>

<!-- Main stylesheet -->
<link href=\"catalog/view/theme/basel/stylesheet/stylesheet.css?v=2.6\" rel=\"stylesheet\">

<!-- Mandatory Theme Settings CSS -->
<style id=\"basel-mandatory-css\">";
        // line 38
        echo ($context["basel_mandatory_css"] ?? null);
        echo "</style>
<!-- Plugin Stylesheet(s) -->
";
        // line 40
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["styles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["style"]) {
            // line 41
            echo "<link href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["style"], "href", [], "any", false, false, false, 41);
            echo "\" rel=\"";
            echo twig_get_attribute($this->env, $this->source, $context["style"], "rel", [], "any", false, false, false, 41);
            echo "\" media=\"";
            echo twig_get_attribute($this->env, $this->source, $context["style"], "media", [], "any", false, false, false, 41);
            echo "\" />
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['style'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 43
        if ((($context["direction"] ?? null) == "rtl")) {
            // line 44
            echo "<link href=\"catalog/view/theme/basel/stylesheet/rtl.css\" rel=\"stylesheet\">
";
        }
        // line 46
        echo "<!-- Pluing scripts(s) -->
";
        // line 47
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["scripts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["script"]) {
            // line 48
            echo "<script src=\"";
            echo $context["script"];
            echo "\"></script>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['script'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 50
        echo "<!-- Page specific meta information -->
";
        // line 51
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["links"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["link"]) {
            // line 52
            if ((twig_get_attribute($this->env, $this->source, $context["link"], "rel", [], "any", false, false, false, 52) == "image")) {
            } else {
                // line 54
                echo "<link href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["link"], "href", [], "any", false, false, false, 54);
                echo "\" rel=\"";
                echo twig_get_attribute($this->env, $this->source, $context["link"], "rel", [], "any", false, false, false, 54);
                echo "\" />
";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['link'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 57
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["analytics"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["analytic"]) {
            // line 58
            echo $context["analytic"];
            echo "
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['analytic'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 60
        if (($context["basel_styles_status"] ?? null)) {
            // line 61
            echo "<!-- Custom Color Scheme -->
<style id=\"basel-color-scheme\">";
            // line 62
            echo ($context["basel_styles_cache"] ?? null);
            echo ";</style>
";
        }
        // line 64
        if (($context["basel_typo_status"] ?? null)) {
            // line 65
            echo "<!-- Custom Fonts -->
<style id=\"basel-fonts\">";
            // line 66
            echo ($context["basel_fonts_cache"] ?? null);
            echo "</style>
";
        }
        // line 68
        if (($context["basel_custom_css_status"] ?? null)) {
            // line 69
            echo "<!-- Custom CSS -->
<style id=\"basel-custom-css\">
";
            // line 71
            echo ($context["basel_custom_css"] ?? null);
            echo "
</style>
";
        }
        // line 74
        if (($context["basel_custom_js_status"] ?? null)) {
            // line 75
            echo "<!-- Custom Javascript -->
<script>
";
            // line 77
            echo ($context["basel_custom_js"] ?? null);
            echo "
</script>
";
        }
        // line 80
        echo "

<script>";
        // line 82
        if ((($context["mss_lang_direction"] ?? null) && (($context["mss_lang_direction"] ?? null) != "ltr"))) {
            echo "var MSS_LANG_DIRECTION = '";
            echo ($context["mss_lang_direction"] ?? null);
            echo "';";
        }
        if (($context["mss_mode"] ?? null)) {
            echo "var MSS_MODE = '";
            echo ($context["mss_mode"] ?? null);
            echo "';";
        }
        echo "</script>

\t\t\t";
        // line 84
        if (($context["mpgdpr_cbstatus"] ?? null)) {
            // line 85
            echo "\t\t\t<!-- /*start gdpr 28-07-2018*/ -->
\t\t\t<!-- /*mpgdpr starts*/ -->
\t\t\t<link href=\"catalog/view/javascript/mpgdpr/cookieconsent/cookieconsent.min.css\" rel=\"stylesheet\">
\t\t\t<script type=\"text/javascript\" src=\"catalog/view/javascript/mpgdpr/cookieconsent/cookieconsent.js\"></script>
\t\t\t<script type=\"text/javascript\">
\t\t\t  \$(document).ready(function() {
\t\t\t    // remove cookie using js
\t\t\t    /*cookieconsent_status, mpcookie_preferencesdisable*/

\t\t\t    \$.get('index.php?route=mpgdpr/preferenceshtml/getPreferencesHtml', function(json) {
\t\t\t      if(json) {
\t\t\t        \$('body').append(json);
\t\t\t        mpgdpr.handle_cookie();
\t\t\t        mpgdpr.maintainance_cookies();
\t\t\t        mpgdpr.cookieconsent();
\t\t\t        setTimeout(function() {
\t\t\t        \t//console.log(mpgdpr.instance)
\t\t\t        },500);
\t\t\t      }
\t\t\t    })
\t\t\t  });
\t\t\t</script>
\t\t\t<!-- /*mpgdpr ends*/ -->
\t\t\t<!-- /*end gdpr 28-07-2018*/ -->
\t\t\t";
        }
        // line 110
        echo "\t\t\t

                ";
        // line 112
        if (twig_test_iterable(($context["opengraphs"] ?? null))) {
            // line 113
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["opengraphs"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["opengraph"]) {
                echo " 
                    <meta property=\"";
                // line 114
                echo (($__internal_compile_0 = $context["opengraph"]) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["meta"] ?? null) : null);
                echo "\" content=\"";
                echo (($__internal_compile_1 = $context["opengraph"]) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["content"] ?? null) : null);
                echo "\" />
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['opengraph'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 115
            echo " 
                ";
        }
        // line 116
        echo " 
                
                ";
        // line 118
        if (twig_test_iterable(($context["twittercards"] ?? null))) {
            // line 119
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["twittercards"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["twittercard"]) {
                echo " 
                    <meta name=\"";
                // line 120
                echo (($__internal_compile_2 = $context["twittercard"]) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["name"] ?? null) : null);
                echo "\" content=\"";
                echo (($__internal_compile_3 = $context["twittercard"]) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["content"] ?? null) : null);
                echo "\" />
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['twittercard'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 121
            echo " 
                ";
        }
        // line 122
        echo " 
                
                ";
        // line 124
        if (twig_test_iterable(($context["jsonld_data"] ?? null))) {
            // line 125
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["jsonld_data"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["jsonld"]) {
                echo " 
                    ";
                // line 126
                echo (($__internal_compile_4 = $context["jsonld"]) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["content"] ?? null) : null);
                echo " 
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['jsonld'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 127
            echo " 
                ";
        }
        // line 129
        echo "\t\t\t\t

\t\t\t\t";
        // line 132
        echo "\t\t\t\t
\t\t\t\t";
        // line 133
        if (((($context["poip_installed"]) ?? (false)) && (($context["poip_settings"]) ?? (false)))) {
            // line 134
            echo "\t\t\t\t\t<script type=\"text/javascript\">
\t\t\t\t\t\tvar poip_settings = ";
            // line 135
            echo json_encode(($context["poip_settings"] ?? null));
            echo ";
\t\t\t\t\t</script>
\t\t\t\t";
        }
        // line 138
        echo "\t\t\t\t
\t\t\t\t";
        // line 140
        echo "\t\t\t

\t\t\t\t\t <link href=\"catalog/view/theme/default/stylesheet/faq.css\" rel=\"stylesheet\">
\t\t\t 
</head>
<body class=\"";
        // line 145
        echo ($context["class"] ?? null);
        echo ($context["basel_body_class"] ?? null);
        echo " ";
        echo ($context["lang"] ?? null);
        echo "\">
    <!-- Google Tag Manager (noscript) -->
";
        // line 147
        $this->loadTemplate("basel/template/common/mobile-nav.twig", "basel/template/common/header.twig", 147)->display($context);
        // line 148
        echo "<div class=\"outer-container main-wrapper\">
";
        // line 149
        if (($context["notification_status"] ?? null)) {
            // line 150
            echo "<div class=\"top_notificaiton\">
  <div class=\"container";
            // line 151
            if (($context["top_promo_close"] ?? null)) {
                echo " has-close";
            }
            echo " ";
            echo ($context["top_promo_width"] ?? null);
            echo " ";
            echo ($context["top_promo_align"] ?? null);
            echo "\">
    <div class=\"table\">
    <div class=\"table-cell w100\"><div class=\"ellipsis-wrap\">";
            // line 153
            echo ($context["top_promo_text"] ?? null);
            echo "</div></div>
    ";
            // line 154
            if (($context["top_promo_close"] ?? null)) {
                // line 155
                echo "    <div class=\"table-cell text-right\">
    <a onClick=\"addCookie('basel_top_promo', 1, 30);\$(this).closest('.top_notificaiton').slideUp();\" class=\"top_promo_close\">&times;</a>
    </div>
    ";
            }
            // line 159
            echo "    </div>
  </div>
</div>
";
        }
        // line 163
        $this->loadTemplate((("basel/template/common/headers/" . ($context["basel_header"] ?? null)) . ".twig"), "basel/template/common/header.twig", 163)->display($context);
        // line 164
        echo "<!-- breadcrumb -->
<div class=\"breadcrumb-holder\">
<div class=\"container\">
<span id=\"title-holder\">&nbsp;</span>
<div class=\"links-holder\">
<a class=\"basel-back-btn\" onClick=\"history.go(-1); return false;\"><i></i></a><span>&nbsp;</span>
</div>
</div>
</div>
<div class=\"container\">
";
        // line 174
        echo ($context["position_top"] ?? null);
        echo "
</div>";
    }

    public function getTemplateName()
    {
        return "basel/template/common/header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  446 => 174,  434 => 164,  432 => 163,  426 => 159,  420 => 155,  418 => 154,  414 => 153,  403 => 151,  400 => 150,  398 => 149,  395 => 148,  393 => 147,  385 => 145,  378 => 140,  375 => 138,  369 => 135,  366 => 134,  364 => 133,  361 => 132,  357 => 129,  353 => 127,  345 => 126,  338 => 125,  336 => 124,  332 => 122,  328 => 121,  318 => 120,  311 => 119,  309 => 118,  305 => 116,  301 => 115,  291 => 114,  284 => 113,  282 => 112,  278 => 110,  251 => 85,  249 => 84,  235 => 82,  231 => 80,  225 => 77,  221 => 75,  219 => 74,  213 => 71,  209 => 69,  207 => 68,  202 => 66,  199 => 65,  197 => 64,  192 => 62,  189 => 61,  187 => 60,  179 => 58,  175 => 57,  163 => 54,  160 => 52,  156 => 51,  153 => 50,  144 => 48,  140 => 47,  137 => 46,  133 => 44,  131 => 43,  118 => 41,  114 => 40,  109 => 38,  94 => 25,  88 => 24,  82 => 23,  69 => 13,  65 => 12,  54 => 6,  47 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/common/header.twig", "");
    }
}
