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

/* extension/module/msmart_search/_header.twig */
class __TwigTemplate_7a41ec841692b078786366bac2346956c5de5aae4dad2ed14297bea32fa421e4 extends \Twig\Template
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
        echo ($context["column_left"] ?? null);
        echo " 

<div id=\"content\">
\t<link type=\"text/css\" href=\"";
        // line 4
        echo ($context["HTTP_URL"] ?? null);
        echo "view/stylesheet/mss/css/bootstrap.css\" rel=\"stylesheet\" />
\t<link type=\"text/css\" href=\"";
        // line 5
        echo ($context["HTTP_URL"] ?? null);
        echo "view/stylesheet/mss/css/jquery-ui.min.css\" rel=\"stylesheet\" />
\t<link type=\"text/css\" href=\"";
        // line 6
        echo ($context["HTTP_URL"] ?? null);
        echo "view/stylesheet/mss/css/style.css\" rel=\"stylesheet\" />
\t
\t<script type=\"text/javascript\">
\t\t\$().ready(function(){
\t\t\t\$('[data-toggle=\"dropdown\"]').dropdown();
\t\t});
\t</script>

\t<div class=\"page-header\">
\t\t<div class=\"container-fluid\">
\t\t\t<div class=\"pull-right\">
\t\t\t\t";
        // line 17
        if ( !twig_test_empty(($context["action_save"] ?? null))) {
            echo " 
\t\t\t\t\t<button id=\"smf-save-form\" type=\"button\" data-toggle=\"tooltip\" title=\"";
            // line 18
            echo ($context["button_save"] ?? null);
            echo "\" class=\"btn btn-primary\"><i class=\"fa fa-save\"></i></button>
\t\t\t\t";
        }
        // line 19
        echo " 
\t\t\t\t";
        // line 20
        if ( !twig_test_empty(($context["action_add"] ?? null))) {
            echo " 
\t\t\t\t\t<a href=\"";
            // line 21
            echo ($context["action_add"] ?? null);
            echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus\"></i></a>
\t\t\t\t";
        }
        // line 22
        echo " 
\t\t\t\t<a href=\"";
        // line 23
        echo ($context["action_back"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_back"] ?? null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-reply\"></i></a>
\t\t\t</div>
\t\t\t
\t\t\t<script type=\"text/javascript\">
\t\t\t\tjQuery('#smf-save-form').click(function(){
\t\t\t\t\tjQuery('#smf-form').submit();
\t\t\t\t\t\t
\t\t\t\t\treturn false;
\t\t\t\t});
\t\t\t</script>
\t\t\t
\t\t\t<h1>";
        // line 34
        echo ($context["heading_title"] ?? null);
        echo "</h1>
\t\t\t<ul class=\"breadcrumb\">
\t\t\t\t";
        // line 36
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            echo " 
\t\t\t\t\t<li><a href=\"";
            // line 37
            echo (($__internal_compile_0 = $context["breadcrumb"]) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["href"] ?? null) : null);
            echo "\">";
            echo (($__internal_compile_1 = $context["breadcrumb"]) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["text"] ?? null) : null);
            echo "</a></li>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 38
        echo " 
\t\t\t</ul>
\t\t</div>
\t</div>
\t<div class=\"container-fluid\">
\t\t";
        // line 43
        if ( !twig_test_empty(($context["notification_new_version_is_available"] ?? null))) {
            echo " 
\t\t\t<div class=\"alert alert-info\"><i class=\"fa fa-exclamation-circle\"></i> ";
            // line 44
            echo ($context["notification_new_version_is_available"] ?? null);
            echo " 
\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"alert\" id=\"close-notification-new-version\">&times;</button>
\t\t\t</div>
\t\t
\t\t\t<script>
\t\t\t\t\$('#close-notification-new-version').click(function(){
\t\t\t\t\t\$.get( mf_fix_url( '";
            // line 50
            echo ($context["action_close_notification_new_version"] ?? null);
            echo "' ) );
\t\t\t\t});
\t\t\t</script>
\t\t";
        }
        // line 53
        echo " 
\t\t";
        // line 54
        if ( !twig_test_empty(($context["_error_warning"] ?? null))) {
            echo " 
\t\t\t<div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            // line 55
            echo ($context["_error_warning"] ?? null);
            echo " 
\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
\t\t\t</div>
\t\t";
        }
        // line 58
        echo "  
\t\t";
        // line 59
        if ( !twig_test_empty(($context["_error_warning2"] ?? null))) {
            echo " 
\t\t\t<div class=\"alert alert-warning\"><i class=\"fa fa-exclamation-circle\"></i> ";
            // line 60
            echo ($context["_error_warning2"] ?? null);
            echo " 
\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
\t\t\t</div>
\t\t";
        }
        // line 63
        echo " 
\t\t";
        // line 64
        if ( !twig_test_empty(($context["_success"] ?? null))) {
            echo " 
\t\t\t<div class=\"alert alert-success\"><i class=\"fa fa-exclamation-circle\"></i> ";
            // line 65
            echo ($context["_success"] ?? null);
            echo " 
\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
\t\t\t</div>
\t\t";
        }
        // line 68
        echo " 
\t\t";
        // line 69
        if ( !twig_test_empty(($context["refresh_ocmod_cache"] ?? null))) {
            echo " 
\t\t\t<div class=\"alert alert-info\" id=\"mss-refresh_ocmod_cache\"><i class=\"fa fa-exclamation-circle\"></i> <span>Refreshing cache of OCMod, please wait...</span>
\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
\t\t\t</div>
\t\t
\t\t\t<script type=\"text/javascript\">
\t\t\t\t(function(){
\t\t\t\t\tvar urls = ";
            // line 76
            echo ($context["refresh_ocmod_cache"] ?? null);
            echo ";
\t\t\t\t\t
\t\t\t\t\tfunction next() {
\t\t\t\t\t\tvar url = urls.shift();
\t\t\t\t\t\t
\t\t\t\t\t\t\$.get( url.replace( /&amp;/, '&' ), {}, function(){
\t\t\t\t\t\t\tif( urls.length ) {
\t\t\t\t\t\t\t\tnext();
\t\t\t\t\t\t\t} else {
\t\t\t\t\t\t\t\t\$('#mss-refresh_ocmod_cache').removeClass('alert-info').addClass('alert-success').find('span').text('OCMod cache has been refreshed');
\t\t\t\t\t\t\t}
\t\t\t\t\t\t});
\t\t\t\t\t}
\t\t\t\t\t
\t\t\t\t\tnext();
\t\t\t\t})();
\t\t\t</script>
\t\t";
        }
        // line 93
        echo " 
\t\t<div class=\"panel panel-default\">
\t\t\t<div class=\"panel-heading\">
\t\t\t\t<h3 class=\"panel-title\"><i class=\"fa fa-pencil\"></i> ";
        // line 96
        echo ($context["heading_panel_title"] ?? null);
        echo "</h3>
\t\t\t</div>
\t\t\t<div class=\"panel-body mega-smart-filter\" id=\"sm-mafin-content\">
\t\t\t\t";
        // line 99
        if ( !twig_test_empty(($context["action_save"] ?? null))) {
            echo " 
\t\t\t\t\t<form action=\"";
            // line 100
            echo ($context["action_save"] ?? null);
            echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"smf-form\" class=\"form-horizontal\">
\t\t\t\t";
        }
        // line 101
        echo " 
\t\t\t\t\t";
        // line 102
        if ((((((((((($context["tab_active"] ?? null) == "index") || (($context["tab_active"] ?? null) == "about")) || (($context["tab_active"] ?? null) == "settings")) || (($context["tab_active"] ?? null) == "search_history")) || (($context["tab_active"] ?? null) == "live_filter")) || (($context["tab_active"] ?? null) == "replace_phrase")) || (($context["tab_active"] ?? null) == "recommended_products")) || (($context["tab_active"] ?? null) == "extra_fields")) || (($context["tab_active"] ?? null) == "add_extra_field"))) {
            // line 103
            echo "\t\t\t\t\t\t<ul class=\"nav nav-tabs\">
\t\t\t\t\t\t\t<li";
            // line 104
            if ((($context["tab_active"] ?? null) == "index")) {
                echo " class=\"active\"";
            }
            echo "><a href=\"";
            echo ($context["tab_config_link"] ?? null);
            echo "\"><i class=\"fa fa-cog\"></i> ";
            echo ($context["tab_config"] ?? null);
            echo "</a></li>
\t\t\t\t\t\t\t<li";
            // line 105
            if ((($context["tab_active"] ?? null) == "live_filter")) {
                echo " class=\"active\"";
            }
            echo "><a href=\"";
            echo ($context["tab_live_filter_link"] ?? null);
            echo "\"><i class=\"fa fa-search\"></i> ";
            echo ($context["tab_live_filter"] ?? null);
            echo "</a></li>
\t\t\t\t\t\t\t<li";
            // line 106
            if ((($context["tab_active"] ?? null) == "settings")) {
                echo " class=\"active\"";
            }
            echo "><a href=\"";
            echo ($context["tab_settings_link"] ?? null);
            echo "\"><i class=\"fa fa-wrench\"></i> ";
            echo ($context["tab_settings"] ?? null);
            echo "</a></li>
\t\t\t\t\t\t\t<li";
            // line 107
            if ((($context["tab_active"] ?? null) == "search_history")) {
                echo " class=\"active\"";
            }
            echo "><a style=\"display: block\" href=\"";
            echo ($context["tab_search_history_link"] ?? null);
            echo "\"><i class=\"fa fa-history\" aria-hidden=\"true\"></i> ";
            echo ($context["tab_search_history"] ?? null);
            echo "</a></li>
\t\t\t\t\t\t\t<li";
            // line 108
            if ((($context["tab_active"] ?? null) == "replace_phrase")) {
                echo " class=\"active\"";
            }
            echo "><a style=\"display: block\" href=\"";
            echo ($context["tab_replace_phrase_link"] ?? null);
            echo "\"><i class=\"fa fa-search\" aria-hidden=\"true\"></i> ";
            echo ($context["tab_replace_phrase"] ?? null);
            echo "</a></li>
\t\t\t\t\t\t\t<li";
            // line 109
            if ((($context["tab_active"] ?? null) == "recommended_products")) {
                echo " class=\"active\"";
            }
            echo "><a style=\"display: block\" href=\"";
            echo ($context["tab_recommended_link"] ?? null);
            echo "\"><i class=\"fa fa-star\" aria-hidden=\"true\"></i> ";
            echo ($context["tab_recommended"] ?? null);
            echo "</a></li>
\t\t\t\t\t\t\t<li";
            // line 110
            if (((($context["tab_active"] ?? null) == "extra_fields") || (($context["tab_active"] ?? null) == "add_extra_field"))) {
                echo " class=\"active\"";
            }
            echo "><a style=\"display: block\" href=\"";
            echo ($context["tab_extra_fields_link"] ?? null);
            echo "\"><i class=\"fa fa-star\" aria-hidden=\"true\"></i> ";
            echo ($context["tab_extra_fields"] ?? null);
            echo "</a></li>
\t\t\t\t\t\t\t<li";
            // line 111
            if ((($context["tab_active"] ?? null) == "about")) {
                echo " class=\"active\"";
            }
            echo "><a style=\"display: block\" href=\"";
            echo ($context["tab_about_link"] ?? null);
            echo "\"><i class=\"glyphicon glyphicon-question-sign\"></i> ";
            echo ($context["tab_about"] ?? null);
            echo "</a></li>
\t\t\t\t\t\t</ul>
\t\t\t\t\t";
        }
    }

    public function getTemplateName()
    {
        return "extension/module/msmart_search/_header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  328 => 111,  318 => 110,  308 => 109,  298 => 108,  288 => 107,  278 => 106,  268 => 105,  258 => 104,  255 => 103,  253 => 102,  250 => 101,  245 => 100,  241 => 99,  235 => 96,  230 => 93,  209 => 76,  199 => 69,  196 => 68,  189 => 65,  185 => 64,  182 => 63,  175 => 60,  171 => 59,  168 => 58,  161 => 55,  157 => 54,  154 => 53,  147 => 50,  138 => 44,  134 => 43,  127 => 38,  117 => 37,  111 => 36,  106 => 34,  90 => 23,  87 => 22,  82 => 21,  78 => 20,  75 => 19,  70 => 18,  66 => 17,  52 => 6,  48 => 5,  44 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/module/msmart_search/_header.twig", "/Users/tomek/Herd/reprograv/upload/admin/view/template/extension/module/msmart_search/_header.twig");
    }
}
