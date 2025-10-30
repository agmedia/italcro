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

/* extension/hbseo/oc3/hb_aigen.twig */
class __TwigTemplate_d5e95968a522e5c8ed421b4e7a452704670a386efbf624657406ff550d1b5b74 extends \Twig\Template
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
<!--Main Content block start-->

<div id=\"content\">
\t<!--Header Start-->
\t<div class=\"page-header\">
\t\t<div class=\"container-fluid\">
\t\t\t<div class=\"pull-right\">
\t\t\t\t<button form=\"form-aigen\" data-toggle=\"tooltip\" title=\"";
        // line 9
        echo ($context["button_save"] ?? null);
        echo "\" id=\"button-save\" class=\"btn btn-primary\"><i class=\"fa fa-save\"></i>&nbsp;";
        echo ($context["button_save"] ?? null);
        echo "</button>
\t\t\t\t<a id=\"button-generate-selected\" class=\"btn btn-success generate\"><i class=\"fa fa-play-circle\"></i>&nbsp;";
        // line 10
        echo ($context["button_generate_selected"] ?? null);
        echo "</a>
\t\t\t\t<a href=\"";
        // line 11
        echo ($context["doc_link"] ?? null);
        echo "\" target=\"_blank\" class=\"btn btn-default\"><i class=\"fa fa-book\"></i>&nbsp;";
        echo ($context["button_doc"] ?? null);
        echo "</a>
\t\t\t\t<a href=\"";
        // line 12
        echo ($context["cancel"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_cancel"] ?? null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-reply\"></i></a>
\t\t\t</div>
\t\t\t<h1>";
        // line 14
        echo ($context["heading_title"] ?? null);
        echo "</h1>
\t\t\t<ul class=\"breadcrumb\">
\t\t\t\t";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 17
            echo "\t\t\t\t<li><a href=\"";
            echo (($__internal_compile_0 = $context["breadcrumb"]) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["href"] ?? null) : null);
            echo "\">";
            echo (($__internal_compile_1 = $context["breadcrumb"]) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["text"] ?? null) : null);
            echo "</a></li>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        echo "\t\t\t</ul>
\t\t</div>
\t</div>
\t<!--Header End-->
<!--Container 1 start -->
<div class=\"container-fluid\">
\t<!--Start - Error / Success Message if any -->
\t";
        // line 26
        if (($context["error_warning"] ?? null)) {
            // line 27
            echo "\t<div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
\t\t<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
\t</div>
\t";
        }
        // line 31
        echo "\t";
        if (($context["success"] ?? null)) {
            // line 32
            echo "\t<div class=\"alert alert-success\"><i class=\"fa fa-check-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "
\t\t<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
\t</div>
\t";
        }
        // line 36
        echo "\t<!--End - Error / Success Message if any -->
\t<div id=\"msgoutput\"></div>
\t<!--Panel Content Start-->
\t<div class=\"panel panel-default\">
\t\t<div class=\"panel-heading\">
\t\t\t<h3 class=\"panel-title\"><i class=\"fa fa-android\"></i> ";
        // line 41
        echo ($context["heading_title"] ?? null);
        echo "</h3>
\t\t</div>
\t\t<div class=\"panel-body\">

\t\t\t<!--Tabs UL Starts-->
\t\t\t<ul class=\"nav nav-tabs\" id=\"tabs\">
\t\t\t\t<li class=\"active\"><a href=\"#tab-product\" onclick=\"loadBlock('product');\" data-toggle=\"tab\"><i class=\"fa fa-bars\"></i> ";
        // line 47
        echo ($context["tab_product"] ?? null);
        echo "</a></li>
\t\t\t\t<li><a href=\"#tab-category\" onclick=\"loadBlock('category');\" data-toggle=\"tab\"><i class=\"fa fa-bars\"></i> ";
        // line 48
        echo ($context["tab_category"] ?? null);
        echo "</a></li>
\t\t\t\t";
        // line 49
        if (($context["onpage_extension"] ?? null)) {
            echo "<li><a href=\"#tab-manufacturer\" onclick=\"loadBlock('manufacturer');\" data-toggle=\"tab\"><i class=\"fa fa-bars\"></i> ";
            echo ($context["tab_manufacturer"] ?? null);
            echo "</a></li>";
        }
        // line 50
        echo "\t\t\t\t<li><a href=\"#tab-information\" onclick=\"loadBlock('information');\" data-toggle=\"tab\"><i class=\"fa fa-bars\"></i> ";
        echo ($context["tab_information"] ?? null);
        echo "</a></li>
\t\t\t\t<li><a href=\"#tab-setting\" data-toggle=\"tab\"><i class=\"fa fa-cogs\"></i> ";
        // line 51
        echo ($context["tab_setting"] ?? null);
        echo "</a></li>
\t\t\t\t<li><a href=\"#tab-items\" onclick=\"loadBlock('items');\" data-toggle=\"tab\"><i class=\"fa fa-globe\"></i> ";
        // line 52
        echo ($context["tab_items"] ?? null);
        echo "</a></li>
\t\t\t\t<li><a href=\"#tab-logs\" onclick=\"loadBlock('logs');\" data-toggle=\"tab\"><i class=\"fa fa-calendar-plus-o\"></i> ";
        // line 53
        echo ($context["tab_logs"] ?? null);
        echo "</a></li>
\t\t\t</ul>
\t\t\t<!--Tabs UL Ends-->
\t\t\t<div class=\"tab-content\">

\t\t\t\t<div class=\"tab-pane active\" id=\"tab-product\">
\t\t\t\t\t<div class=\"row\" style=\"margin-bottom:10px;\">
\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t<input type=\"text\" id=\"search-product-value\" class=\"form-control\" placeholder=\"";
        // line 62
        echo ($context["text_search_product"] ?? null);
        echo "\">
\t\t\t\t\t\t\t\t<span class=\"input-group-addon btn\" id=\"search-product-button\" onclick=\"searchRecord('product');\"><i class=\"fa fa-search\"></i></span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<div id=\"product-block\" class=\"ajax-block\"></div>
\t\t\t\t</div>

\t\t\t\t<div class=\"tab-pane\" id=\"tab-category\">
\t\t\t\t\t<div class=\"row\" style=\"margin-bottom:10px;\">
\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t<input type=\"text\" id=\"search-category-value\" class=\"form-control\" placeholder=\"";
        // line 75
        echo ($context["text_search_category"] ?? null);
        echo "\">
\t\t\t\t\t\t\t\t<span class=\"input-group-addon btn\" id=\"search-category-button\" onclick=\"searchRecord('category');\"><i class=\"fa fa-search\"></i></span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<div id=\"category-block\" class=\"ajax-block\"></div>
\t\t\t\t</div>
\t\t\t\t
\t\t\t\t";
        // line 84
        if (($context["onpage_extension"] ?? null)) {
            // line 85
            echo "\t\t\t\t<div class=\"tab-pane\" id=\"tab-manufacturer\">
\t\t\t\t\t<div class=\"row\" style=\"margin-bottom:10px;\">
\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t<input type=\"text\" id=\"search-manufacturer-value\" class=\"form-control\" placeholder=\"";
            // line 89
            echo ($context["text_search_manufacturer"] ?? null);
            echo "\">
\t\t\t\t\t\t\t\t<span class=\"input-group-addon btn\" id=\"search-manufacturer-button\" onclick=\"searchRecord('manufacturer');\"><i class=\"fa fa-search\"></i></span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<div id=\"manufacturer-block\" class=\"ajax-block\"></div>
\t\t\t\t</div>
\t\t\t\t";
        }
        // line 98
        echo "
\t\t\t\t<div class=\"tab-pane\" id=\"tab-information\">
\t\t\t\t\t<div class=\"row\" style=\"margin-bottom:10px;\">
\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t<input type=\"text\" id=\"search-information-value\" class=\"form-control\" placeholder=\"";
        // line 103
        echo ($context["text_search_information"] ?? null);
        echo "\">
\t\t\t\t\t\t\t\t<span class=\"input-group-addon btn\" id=\"search-information-button\" onclick=\"searchRecord('information');\"><i class=\"fa fa-search\"></i></span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t
\t\t\t\t\t</div>

\t\t\t\t\t<div id=\"information-block\" class=\"ajax-block\"></div>
\t\t\t\t</div>

\t\t\t\t<div class=\"tab-pane\" id=\"tab-items\">
\t\t\t\t\t<div class=\"row\" style=\"margin-bottom:10px;\">
\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t<input type=\"text\" id=\"search-items-value\" class=\"form-control\" placeholder=\"";
        // line 117
        echo ($context["text_search_items"] ?? null);
        echo "\">
\t\t\t\t\t\t\t\t<span class=\"input-group-addon btn\" id=\"search-items-button\" onclick=\"searchRecord('items');\"><i class=\"fa fa-search\"></i></span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"col-sm-3\">
\t\t\t\t\t\t\t<div class=\"pull-right\">
\t\t\t\t\t\t\t<div class=\"btn-group\">
\t\t\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-success dropdown-toggle\" id=\"btn-group-accept\" data-toggle=\"dropdown\">
\t\t\t\t\t\t\t\t\t<i class=\"fa fa-thumbs-up\"></i>&nbsp;";
        // line 125
        echo ($context["button_accept"] ?? null);
        echo "&nbsp;<span class=\"caret\"></span>
\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t\t<ul class=\"dropdown-menu dropdown-menu-right\" role=\"menu\">
\t\t\t\t\t\t\t\t\t<li><a onclick=\"confirm('";
        // line 128
        echo ($context["text_confirm"] ?? null);
        echo "') ? acceptItems('selected') : false;\"><i class=\"fa fa-thumbs-up\"></i>&nbsp;";
        echo ($context["button_accept_selected"] ?? null);
        echo "</a></li>
\t\t\t\t\t\t\t\t\t<li><a onclick=\"confirm('";
        // line 129
        echo ($context["text_confirm"] ?? null);
        echo "') ? acceptItems('all') : false;\"><i class=\"fa fa-thumbs-up\"></i>&nbsp;";
        echo ($context["button_accept_all"] ?? null);
        echo "</a></li>
\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t<div class=\"btn-group\">
\t\t\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-warning dropdown-toggle\" id=\"btn-group-restore\" data-toggle=\"dropdown\">
\t\t\t\t\t\t\t\t\t<i class=\"fa fa-reply\"></i>&nbsp;";
        // line 135
        echo ($context["button_restore"] ?? null);
        echo "&nbsp;<span class=\"caret\"></span>
\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t\t<ul class=\"dropdown-menu dropdown-menu-right\" role=\"menu\">
\t\t\t\t\t\t\t\t\t<li><a onclick=\"confirm('";
        // line 138
        echo ($context["text_restore_confirm"] ?? null);
        echo "') ? restoreItems('selected') : false;\"><i class=\"fa fa-reply\"></i>&nbsp;";
        echo ($context["button_restore_selected"] ?? null);
        echo "</a></li>
\t\t\t\t\t\t\t\t\t<li><a onclick=\"confirm('";
        // line 139
        echo ($context["text_restore_confirm"] ?? null);
        echo "') ? restoreItems('all') : false;\"><i class=\"fa fa-reply-all\"></i>&nbsp;";
        echo ($context["button_restore_all"] ?? null);
        echo "</a></li>
\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t<div class=\"btn-group\">
\t\t\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-danger dropdown-toggle\" id=\"btn-group-delete\" data-toggle=\"dropdown\">
\t\t\t\t\t\t\t\t\t<i class=\"fa fa-trash\"></i>&nbsp;";
        // line 145
        echo ($context["button_delete"] ?? null);
        echo "&nbsp;<span class=\"caret\"></span>
\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t\t<ul class=\"dropdown-menu dropdown-menu-right\" role=\"menu\">
\t\t\t\t\t\t\t\t\t<li><a onclick=\"confirm('";
        // line 148
        echo ($context["text_confirm_delete"] ?? null);
        echo "') ? deleteItems('selected') : false;\"><i class=\"fa fa-trash\"></i>&nbsp;";
        echo ($context["button_delete_selected"] ?? null);
        echo "</a></li>
\t\t\t\t\t\t\t\t\t<li><a onclick=\"confirm('";
        // line 149
        echo ($context["text_confirm_delete"] ?? null);
        echo "') ? deleteItems('all') : false;\"><i class=\"fa fa-trash\"></i>&nbsp;";
        echo ($context["button_delete_all"] ?? null);
        echo "</a></li>
\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t
\t\t\t\t\t</div>

\t\t\t\t\t<div id=\"items-block\" class=\"ajax-block\"></div>
\t\t\t\t</div>

\t\t\t\t<!--SETUP-->
\t\t\t\t<div class=\"tab-pane\" id=\"tab-setting\">
\t\t\t\t\t<form action=\"";
        // line 162
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-aigen\" class=\"form-horizontal\">
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 164
        echo ($context["text_status"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<input type=\"checkbox\" data-toggle=\"toggle\" data-onstyle=\"success\" name=\"hb_aigen_status\" class=\"form-control\" value=\"1\" ";
        // line 166
        echo (((($context["hb_aigen_status"] ?? null) == "1")) ? ("checked") : (""));
        echo " />
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 171
        echo ($context["text_api"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_aigen_api\" value=\"";
        // line 173
        echo ($context["hb_aigen_api"] ?? null);
        echo "\" class=\"form-control\" />
\t\t\t\t\t\t\t\t<span class=\"help-block\">";
        // line 174
        echo ($context["text_api_help"] ?? null);
        echo "</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 179
        echo ($context["text_gpt_model"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_aigen_gpt_model\" value=\"";
        // line 181
        echo ($context["hb_aigen_gpt_model"] ?? null);
        echo "\" class=\"form-control\" />\t
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 186
        echo ($context["text_language"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<select name=\"hb_aigen_language_id\" class=\"form-control\">
\t\t\t\t\t\t\t\t\t";
        // line 189
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 190
            echo "\t\t\t\t\t\t\t\t\t<option value=\"";
            echo (($__internal_compile_2 = $context["language"]) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["language_id"] ?? null) : null);
            echo "\" ";
            if (((($__internal_compile_3 = $context["language"]) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["language_id"] ?? null) : null) == ($context["hb_aigen_language_id"] ?? null))) {
                echo " selected ";
            }
            echo ">";
            echo (($__internal_compile_4 = $context["language"]) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["name"] ?? null) : null);
            echo "</option>
\t\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 192
        echo "\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 197
        echo ($context["text_enable_logs"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<input type=\"checkbox\" data-toggle=\"toggle\" data-onstyle=\"success\" name=\"hb_aigen_logs\" class=\"form-control\" value=\"1\" ";
        // line 199
        echo (((($context["hb_aigen_logs"] ?? null) == "1")) ? ("checked") : (""));
        echo " />
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div> 

\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 204
        echo ($context["text_product_prompt_template"] ?? null);
        echo "<br><div class=\"text text-info\">";
        echo ($context["text_product_prompt_template_help"] ?? null);
        echo "</div></label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t";
        // line 206
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 207
            echo "\t\t\t\t\t\t\t\t<div class=\"col-sm-12\" style=\"margin-bottom:10px;\">
\t\t\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t\t\t<span class=\"input-group-addon\"><img src=\"language/";
            // line 209
            echo (($__internal_compile_5 = $context["language"]) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["code"] ?? null) : null);
            echo "/";
            echo (($__internal_compile_6 = $context["language"]) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["code"] ?? null) : null);
            echo ".png\" alt=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 209);
            echo "\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 209);
            echo "\"/></span>
\t\t\t\t\t\t\t\t\t\t<textarea name=\"hb_aigen_product_template";
            // line 210
            echo (($__internal_compile_7 = $context["language"]) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["language_id"] ?? null) : null);
            echo "\" rows=\"5\" class=\"form-control\">";
            echo (($__internal_compile_8 = ($context["hb_aigen_product_template"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8[(($__internal_compile_9 = $context["language"]) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["language_id"] ?? null) : null)] ?? null) : null);
            echo "</textarea>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 213
        echo "\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 218
        echo ($context["text_category_prompt_template"] ?? null);
        echo "<br><div class=\"text text-info\">";
        echo ($context["text_category_prompt_template_help"] ?? null);
        echo "</div></label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t";
        // line 220
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 221
            echo "\t\t\t\t\t\t\t\t<div class=\"col-sm-12\" style=\"margin-bottom:10px;\">
\t\t\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t\t\t<span class=\"input-group-addon\"><img src=\"language/";
            // line 223
            echo (($__internal_compile_10 = $context["language"]) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["code"] ?? null) : null);
            echo "/";
            echo (($__internal_compile_11 = $context["language"]) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["code"] ?? null) : null);
            echo ".png\" alt=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 223);
            echo "\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 223);
            echo "\"/></span>
\t\t\t\t\t\t\t\t\t\t<textarea name=\"hb_aigen_category_template";
            // line 224
            echo (($__internal_compile_12 = $context["language"]) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["language_id"] ?? null) : null);
            echo "\" rows=\"5\" class=\"form-control\">";
            echo (($__internal_compile_13 = ($context["hb_aigen_category_template"] ?? null)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13[(($__internal_compile_14 = $context["language"]) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["language_id"] ?? null) : null)] ?? null) : null);
            echo "</textarea>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 227
        echo "\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 232
        echo ($context["text_manufacturer_prompt_template"] ?? null);
        echo "<br><div class=\"text text-info\">";
        echo ($context["text_manufacturer_prompt_template_help"] ?? null);
        echo "</div></label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t";
        // line 234
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 235
            echo "\t\t\t\t\t\t\t\t<div class=\"col-sm-12\" style=\"margin-bottom:10px;\">
\t\t\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t\t\t<span class=\"input-group-addon\"><img src=\"language/";
            // line 237
            echo (($__internal_compile_15 = $context["language"]) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["code"] ?? null) : null);
            echo "/";
            echo (($__internal_compile_16 = $context["language"]) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16["code"] ?? null) : null);
            echo ".png\" alt=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 237);
            echo "\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 237);
            echo "\"/></span>
\t\t\t\t\t\t\t\t\t\t<textarea name=\"hb_aigen_manufacturer_template";
            // line 238
            echo (($__internal_compile_17 = $context["language"]) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["language_id"] ?? null) : null);
            echo "\" rows=\"5\" class=\"form-control\">";
            echo (($__internal_compile_18 = ($context["hb_aigen_manufacturer_template"] ?? null)) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18[(($__internal_compile_19 = $context["language"]) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19["language_id"] ?? null) : null)] ?? null) : null);
            echo "</textarea>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 241
        echo "\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 246
        echo ($context["text_information_prompt_template"] ?? null);
        echo "<br><div class=\"text text-info\">";
        echo ($context["text_information_prompt_template_help"] ?? null);
        echo "</div></label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t";
        // line 248
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 249
            echo "\t\t\t\t\t\t\t\t<div class=\"col-sm-12\" style=\"margin-bottom:10px;\">
\t\t\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t\t\t<span class=\"input-group-addon\"><img src=\"language/";
            // line 251
            echo (($__internal_compile_20 = $context["language"]) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20["code"] ?? null) : null);
            echo "/";
            echo (($__internal_compile_21 = $context["language"]) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21["code"] ?? null) : null);
            echo ".png\" alt=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 251);
            echo "\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 251);
            echo "\"/></span>
\t\t\t\t\t\t\t\t\t\t<textarea name=\"hb_aigen_information_template";
            // line 252
            echo (($__internal_compile_22 = $context["language"]) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22["language_id"] ?? null) : null);
            echo "\" rows=\"5\" class=\"form-control\">";
            echo (($__internal_compile_23 = ($context["hb_aigen_information_template"] ?? null)) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23[(($__internal_compile_24 = $context["language"]) && is_array($__internal_compile_24) || $__internal_compile_24 instanceof ArrayAccess ? ($__internal_compile_24["language_id"] ?? null) : null)] ?? null) : null);
            echo "</textarea>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 255
        echo "\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 260
        echo ($context["text_sections"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t";
        // line 262
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["sections"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["language_text"]) {
            // line 263
            echo "\t\t\t\t\t\t\t\t\t<div class=\"checkbox\">
\t\t\t\t\t\t\t\t\t\t<label>
\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" data-toggle=\"toggle\" data-onstyle=\"success\" name=\"hb_aigen_sections[]\" class=\"form-control\" value=\"";
            // line 265
            echo $context["key"];
            echo "\" ";
            if (twig_in_filter($context["key"], ($context["hb_aigen_sections"] ?? null))) {
                echo " checked ";
            }
            echo " />
\t\t\t\t\t\t\t\t\t\t\t";
            // line 266
            echo $context["language_text"];
            echo "
\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['language_text'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 270
        echo "\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 274
        echo ($context["text_description_max_length"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<input type=\"number\" name=\"hb_aigen_description_max_length\" value=\"";
        // line 276
        echo ($context["hb_aigen_description_max_length"] ?? null);
        echo "\" class=\"form-control\" />
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 281
        echo ($context["text_one_language"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<input type=\"checkbox\" data-toggle=\"toggle\" data-onstyle=\"success\" name=\"hb_aigen_one_language\" class=\"form-control\" value=\"1\" ";
        // line 283
        echo (((($context["hb_aigen_one_language"] ?? null) == "1")) ? ("checked") : (""));
        echo " />
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 288
        echo ($context["text_overwrite"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<input type=\"checkbox\" data-toggle=\"toggle\" data-onstyle=\"success\" name=\"hb_aigen_overwrite\" class=\"form-control\" value=\"1\" ";
        // line 290
        echo (((($context["hb_aigen_overwrite"] ?? null) == "1")) ? ("checked") : (""));
        echo " />
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 295
        echo ($context["text_simulate"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<input type=\"checkbox\" data-toggle=\"toggle\" data-onstyle=\"success\" name=\"hb_aigen_simulate\" class=\"form-control\" value=\"1\" ";
        // line 297
        echo (((($context["hb_aigen_simulate"] ?? null) == "1")) ? ("checked") : (""));
        echo " />
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 302
        echo ($context["text_cron_key"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_aigen_cron_key\" value=\"";
        // line 304
        echo ($context["hb_aigen_cron_key"] ?? null);
        echo "\" class=\"form-control\" />
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 309
        echo ($context["text_cron_limit"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<input type=\"number\" name=\"hb_aigen_cron_limit\" value=\"";
        // line 311
        echo ($context["hb_aigen_cron_limit"] ?? null);
        echo "\" class=\"form-control\" />
\t\t\t\t\t\t\t\t<div class=\"alert alert-info\">";
        // line 312
        echo ($context["text_cron_limit_help"] ?? null);
        echo "</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 317
        echo ($context["text_cron_command"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<div class=\"well\">";
        // line 319
        echo ($context["hb_aigen_cron"] ?? null);
        echo "</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t   </form>
\t\t\t\t</div>
\t\t\t\t
\t\t\t\t<!--TOOLS-->
\t\t\t\t<div class=\"tab-pane\" id=\"tab-tools\">
\t\t\t\t\t<div id=\"tools-block\"></div>
\t\t\t\t</div>
\t\t\t\t
\t\t\t\t<div id=\"tab-logs\" class=\"tab-pane\">
\t\t\t\t\t<div id=\"logs-block\"></div>

\t\t\t\t\t<div class=\"pull-right\" style=\"margin-top:10px;\">
\t\t\t\t\t<a onclick=\"confirm('";
        // line 334
        echo ($context["text_confirm"] ?? null);
        echo "') ? location.href='";
        echo ($context["clear"] ?? null);
        echo "' : false;\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_clear"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-trash\"></i>&nbsp;";
        echo ($context["button_clear_logs"] ?? null);
        echo "</a>
\t\t\t\t\t</div>
\t\t\t\t</div><!--tab-logs-->
\t\t\t\t
\t\t\t</div><!--tab-content block end-->\t\t

\t\t\t<!--PREVIEW TEMPLATE MODAL START-->
\t\t\t<div class=\"modal fade\" id=\"preview-modal\" tabindex=\"-1\" role=\"dialog\">
\t\t\t\t<div class=\"modal-dialog modal-md\" role=\"document\">
\t\t\t\t<div class=\"modal-content\">
\t\t\t\t\t<div class=\"modal-header\">
\t\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span>&times;</span></button>
\t\t\t\t\t<h4 class=\"modal-title\"><i class=\"fa fa-microphone\"></i>&nbsp;";
        // line 346
        echo ($context["text_preview"] ?? null);
        echo "</h4>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"modal-body\">
\t\t\t\t\t\t<div id=\"preview-block\"></div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<!--PREVIEW TEMPLATE MODAL END-->
\t\t\t
      </div>
    </div>
    <!--Panel Content End-->
    <!--Huntbee copyrights-->
    <div class=\"container-fluid\">
      <center>
        <span class=\"help\">";
        // line 362
        echo ($context["heading_title"] ?? null);
        echo " - ";
        echo ($context["extension_version"] ?? null);
        echo " &copy; <a href=\"https://www.huntbee.com/\">WWW.HUNTBEE.COM</a> | <a href=\"https://www.huntbee.com/get-support\">SUPPORT</a></span>
      </center>
    </div>
    <!--Huntbee copyrights end-->
  </div>
  <!--Container 1 start -->
</div>
<!--Main Content block end-->

<style type=\"text/css\"> 
\ta {cursor:pointer;}
\t.loaddiv{margin:100px;color:#0099CC;}
\tbody{font-family: sans-serif; }
</style>

<link href=\"https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css\" rel=\"stylesheet\">
<script src=\"https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js\"></script>\t 

<script type=\"text/javascript\" src=\"view/javascript/bootstrap-notify.min.js\"></script>

<script type=\"text/javascript\">
\$(document).ready(function() {
    loadBlock('product');
\ttoggleGenerateButtons();
});

\$('#tabs li a').on('click', function () {
    setTimeout(toggleGenerateButtons, 10); // Ensure active tab is updated before running
});

function toggleGenerateButtons() {
    const type = \$('#tabs .active a').attr('href').substring(1).replace('tab-', '');
\tif (type === 'items') {
\t\t\$(\".generate\").hide();
\t} else {
\t\t\$(\".generate\").show();
\t}    
}

function loadBlock(name) {
    \$('body').prepend('<div id=\"loader\" class=\"text-center\" style=\"position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;\"><i class=\"fa fa-spinner fa-pulse fa-5x fa-fw\"></i></div>');
    \$('#loader').show();
    \$('#' + name + '-block').load('index.php?route=extension/hbseo/hb_aigen/' + name + '&user_token=";
        // line 404
        echo ($context["user_token"] ?? null);
        echo "&store_id=";
        echo ($context["store_id"] ?? null);
        echo "', function() {
        \$('#loader').fadeOut(function() {
            \$(this).remove();
        });
    });
}

\$('#product-block').delegate('.pagination a', 'click', function(e) {
\te.preventDefault();
\t\$('#product-block').load(this.href);
});

\$('#category-block').delegate('.pagination a', 'click', function(e) {
\te.preventDefault();
\t\$('#category-block').load(this.href);
});

\$('#information-block').delegate('.pagination a', 'click', function(e) {
\te.preventDefault();
\t\$('#information-block').load(this.href);
});

\$('#manufacturer-block').delegate('.pagination a', 'click', function(e) {
\te.preventDefault();
\t\$('#manufacturer-block').load(this.href);
});

\$('#items-block').delegate('.pagination a', 'click', function(e) {
\te.preventDefault();
\t\$('#items-block').load(this.href);
});

function searchRecord(item) {
\tvar search_value = \$('#search-'+item+'-value').val();
\t\$('#'+item+'-block').fadeOut().load('index.php?route=extension/hbseo/hb_aigen/'+item+'&user_token=";
        // line 438
        echo ($context["user_token"] ?? null);
        echo "&search='+encodeURIComponent(search_value)).fadeIn('slow');
}
</script>

<script type=\"text/javascript\">
function promptPreview(type, item_id, language_id) {
\t\$('#preview-block').html('<div class=\"text-center\"><i class=\"fa fa-spinner fa-pulse fa-3x fa-fw\"></i></div>');
\t\$.ajax({
\t\ttype: 'post',
\t\turl: '../index.php?route=extension/module/hb_aigen/prompt_preview',
\t\tdata: {type: type, item_id: item_id, language_id: language_id, authkey : '";
        // line 448
        echo ($context["hb_aigen_cron_key"] ?? null);
        echo "'},
\t\tdataType: 'json',
\t\tsuccess: function(json) {
\t\t\tif (json['success']) {
\t\t\t\t\$('#preview-block').html(json['success']);
\t\t\t}
\t\t\tif (json['error']) {
\t\t\t\t\$('#preview-block').html(\"<div class='alert alert-danger'><i class='fa fa-warning'></i> \"+json['error']+\"</div>\");
\t\t\t}
\t\t}
\t});
\t\$('#preview-modal').modal('show');
}

function generateItem(type, item_id, language_id){
\t\$('#btn_generate_item_'+type+'_'+item_id+'_'+language_id).html('<i class=\"fa fa-spinner fa-pulse\"></i>');
\t\$.ajax({
\t\ttype: 'post',
\t\turl: '../index.php?route=extension/module/hb_aigen/generate_item',
\t\tdata: {type: type, item_id: item_id, language_id: language_id, authkey : '";
        // line 467
        echo ($context["hb_aigen_cron_key"] ?? null);
        echo "'},
\t\tdataType: 'json',
\t\tsuccess: function(json) {
\t\t\tif (json.success) {
\t\t\t\t\$.notify({ icon: \"fa fa-check\", message: json.success }, { type: \"success\" });
\t\t\t} else if (json.error) {
\t\t\t\t\$.notify({ icon: \"fa fa-exclamation\", message: json.error }, { type: \"danger\" });
\t\t\t}
\t\t\t\$('#btn_generate_item_'+type+'_'+item_id+'_'+language_id).html('<i class=\"fa fa-play-circle\"></i>');
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\t\$.notify({ icon: \"fa fa-exclamation\", message: thrownError }, { type: \"danger\" });
\t\t\tconsole.log(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t\t\$('#btn_generate_item_'+type+'_'+item_id+'_'+language_id).html('<i class=\"fa fa-play-circle\"></i>');
\t\t}
\t});
}

function acceptItems(mode){
\tif (mode == 'selected') {
\t\tvar arraydata = \$('input[name=\"selected[]\"]:checked').map(function(){
\t\t\treturn this.value;
\t\t}).get();
\t} else {
\t\tvar arraydata = 'all';
\t}

\t\$('#btn-group-accept').html('<i class=\"fa fa-spinner fa-pulse\"></i>&nbsp;";
        // line 494
        echo ($context["button_accept"] ?? null);
        echo "&nbsp;<span class=\"caret\"></span>');

\t\$.ajax({
\t\ttype: 'post',
\t\turl: 'index.php?route=extension/hbseo/hb_aigen/accept_items&user_token=";
        // line 498
        echo ($context["user_token"] ?? null);
        echo "&mode='+mode,
\t\tdata: {selected: arraydata},
\t\tdataType: 'json',
\t\tsuccess: function(json) {
\t\t\tif (json.success) {
\t\t\t\t\$.notify({ icon: \"fa fa-check\", message: json.success }, { type: \"success\" });
\t\t\t\tloadBlock('items');
\t\t\t} else if (json.error) {
\t\t\t\t\$.notify({ icon: \"fa fa-exclamation\", message: json.error }, { type: \"danger\" });
\t\t\t}

\t\t\t\$('#btn-group-accept').html('<i class=\"fa fa-thumbs-up\"></i>&nbsp;";
        // line 509
        echo ($context["button_accept"] ?? null);
        echo "&nbsp;<span class=\"caret\"></span>');
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\t\$.notify({ icon: \"fa fa-exclamation\", message: thrownError }, { type: \"danger\" });
\t\t\tconsole.log(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t\t\$('#btn-group-accept').html('<i class=\"fa fa-thumbs-up\"></i>&nbsp;";
        // line 514
        echo ($context["button_accept"] ?? null);
        echo "&nbsp;<span class=\"caret\"></span>');
\t\t}
\t});
}

function restoreItems(mode){
\tif (mode == 'selected') {
\t\tvar arraydata = \$('input[name=\"selected[]\"]:checked').map(function(){
\t\t\treturn this.value;
\t\t}).get();
\t} else {
\t\tvar arraydata = 'all';
\t}

\t\$('#btn-group-restore').html('<i class=\"fa fa-spinner fa-pulse\"></i>&nbsp;";
        // line 528
        echo ($context["button_restore"] ?? null);
        echo "&nbsp;<span class=\"caret\"></span>');

\t\$.ajax({
\t\ttype: 'post',
\t\turl: 'index.php?route=extension/hbseo/hb_aigen/restore_items&user_token=";
        // line 532
        echo ($context["user_token"] ?? null);
        echo "&mode='+mode,
\t\tdata: {selected: arraydata},
\t\tdataType: 'json',
\t\tsuccess: function(json) {
\t\t\tif (json.success) {
\t\t\t\t\$.notify({ icon: \"fa fa-check\", message: json.success }, { type: \"success\" });
\t\t\t\tloadBlock('items');
\t\t\t} else if (json.error) {
\t\t\t\t\$.notify({ icon: \"fa fa-exclamation\", message: json.error }, { type: \"danger\" });
\t\t\t}

\t\t\t\$('#btn-group-restore').html('<i class=\"fa fa-reply\"></i>&nbsp;";
        // line 543
        echo ($context["button_restore"] ?? null);
        echo "&nbsp;<span class=\"caret\"></span>');
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\t\$.notify({ icon: \"fa fa-exclamation\", message: thrownError }, { type: \"danger\" });
\t\t\tconsole.log(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t\t\$('#btn-group-restore').html('<i class=\"fa fa-reply\"></i>&nbsp;";
        // line 548
        echo ($context["button_restore"] ?? null);
        echo "&nbsp;<span class=\"caret\"></span>');
\t\t}
\t});
}

function deleteItems(mode){
\tif (mode == 'selected') {
\t\tvar arraydata = \$('input[name=\"selected[]\"]:checked').map(function(){
\t\t\treturn this.value;
\t\t}).get();
\t} else {
\t\tvar arraydata = 'all';
\t}

\t\$('#btn-group-delete').html('<i class=\"fa fa-spinner fa-pulse\"></i>&nbsp;";
        // line 562
        echo ($context["button_delete"] ?? null);
        echo "&nbsp;<span class=\"caret\"></span>');

\t\$.ajax({
\t\ttype: 'post',
\t\turl: 'index.php?route=extension/hbseo/hb_aigen/delete_items&user_token=";
        // line 566
        echo ($context["user_token"] ?? null);
        echo "&mode='+mode,
\t\tdata: {selected: arraydata},
\t\tdataType: 'json',
\t\tsuccess: function(json) {
\t\t\tif (json.success) {
\t\t\t\t\$.notify({ icon: \"fa fa-check\", message: json.success }, { type: \"success\" });
\t\t\t\tloadBlock('items');
\t\t\t} else if (json.error) {
\t\t\t\t\$.notify({ icon: \"fa fa-exclamation\", message: json.error }, { type: \"danger\" });
\t\t\t}

\t\t\t\$('#btn-group-delete').html('<i class=\"fa fa-trash\"></i>&nbsp;";
        // line 577
        echo ($context["button_delete"] ?? null);
        echo "&nbsp;<span class=\"caret\"></span>');
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\t\$.notify({ icon: \"fa fa-exclamation\", message: thrownError }, { type: \"danger\" });
\t\t\tconsole.log(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t\t\$('#btn-group-delete').html('<i class=\"fa fa-trash\"></i>&nbsp;";
        // line 582
        echo ($context["button_delete"] ?? null);
        echo "&nbsp;<span class=\"caret\"></span>');
\t\t}
\t});
}

\$('#button-generate-selected').on('click', function() {
\tif (!confirm('";
        // line 588
        echo ($context["text_confirm_generate"] ?? null);
        echo "')) {
\t\treturn false;
\t}

\tvar type = \$('#tabs .active a').attr('href').substring(1).replace('tab-', '');

\tconsole.log(type);

\t\$('#button-generate-selected').html('<i class=\"fa fa-spinner fa-pulse\"></i>');

\tvar arraydata = \$('input[name=\"selected[]\"]:checked').map(function(){
        return this.value;
    }).get()

\t\$('#msgoutput').html('');
\t\$.ajax({
\t\ttype: 'post',
\t\turl: '../index.php?route=extension/module/hb_aigen/generate_selected',
\t\tdataType: 'json',
\t\tdata: {type: type, selected: arraydata, authkey : '";
        // line 607
        echo ($context["hb_aigen_cron_key"] ?? null);
        echo "'},
\t\tsuccess: function(json) {
\t\t\tif (json.success) {
\t\t\t\t\$.notify({ icon: \"fa fa-check\", message: json.success }, { type: \"success\" });
\t\t\t\tloadBlock(type);
\t\t\t} else if (json.error) {
\t\t\t\t\$.notify({ icon: \"fa fa-exclamation\", message: json.error }, { type: \"danger\" });
\t\t\t}

\t\t\t\$('#button-generate-selected').html('<i class=\"fa fa-bolt\"></i>&nbsp;";
        // line 616
        echo ($context["button_generate"] ?? null);
        echo "');
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\t\$.notify({ icon: \"fa fa-exclamation\", message: thrownError }, { type: \"danger\" });
\t\t\tconsole.log(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t\t\$('#button-generate-selected').html('<i class=\"fa fa-bolt\"></i>&nbsp;";
        // line 621
        echo ($context["button_generate"] ?? null);
        echo "');
\t\t}
\t});\t
});
</script>

";
        // line 627
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "extension/hbseo/oc3/hb_aigen.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1119 => 627,  1110 => 621,  1102 => 616,  1090 => 607,  1068 => 588,  1059 => 582,  1051 => 577,  1037 => 566,  1030 => 562,  1013 => 548,  1005 => 543,  991 => 532,  984 => 528,  967 => 514,  959 => 509,  945 => 498,  938 => 494,  908 => 467,  886 => 448,  873 => 438,  834 => 404,  787 => 362,  768 => 346,  747 => 334,  729 => 319,  724 => 317,  716 => 312,  712 => 311,  707 => 309,  699 => 304,  694 => 302,  686 => 297,  681 => 295,  673 => 290,  668 => 288,  660 => 283,  655 => 281,  647 => 276,  642 => 274,  636 => 270,  626 => 266,  618 => 265,  614 => 263,  610 => 262,  605 => 260,  598 => 255,  586 => 252,  576 => 251,  572 => 249,  568 => 248,  561 => 246,  554 => 241,  542 => 238,  532 => 237,  528 => 235,  524 => 234,  517 => 232,  510 => 227,  498 => 224,  488 => 223,  484 => 221,  480 => 220,  473 => 218,  466 => 213,  454 => 210,  444 => 209,  440 => 207,  436 => 206,  429 => 204,  421 => 199,  416 => 197,  409 => 192,  394 => 190,  390 => 189,  384 => 186,  376 => 181,  371 => 179,  363 => 174,  359 => 173,  354 => 171,  346 => 166,  341 => 164,  336 => 162,  318 => 149,  312 => 148,  306 => 145,  295 => 139,  289 => 138,  283 => 135,  272 => 129,  266 => 128,  260 => 125,  249 => 117,  232 => 103,  225 => 98,  213 => 89,  207 => 85,  205 => 84,  193 => 75,  177 => 62,  165 => 53,  161 => 52,  157 => 51,  152 => 50,  146 => 49,  142 => 48,  138 => 47,  129 => 41,  122 => 36,  114 => 32,  111 => 31,  103 => 27,  101 => 26,  92 => 19,  81 => 17,  77 => 16,  72 => 14,  65 => 12,  59 => 11,  55 => 10,  49 => 9,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/hbseo/oc3/hb_aigen.twig", "");
    }
}
