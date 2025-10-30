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

/* extension/hbseo/oc3/hb_snippets.twig */
class __TwigTemplate_a3c267a70ac570e9e2e1bff2412e7e6c3c7d4c99643f547ca29b8c48be96f5b9 extends \Twig\Template
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
<!--Header Start-->
  <div class=\"page-header\">
    <div class=\"container-fluid\">
      <div class=\"pull-right\">
        <button type=\"submit\" form=\"form-hb-snippets\" data-toggle=\"tooltip\" title=\"";
        // line 8
        echo ($context["button_save"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-save\"></i> ";
        echo ($context["button_save"] ?? null);
        echo "</button>
\t\t<a href=\"";
        // line 9
        echo ($context["doc_link"] ?? null);
        echo "\" target=\"_blank\" class=\"btn btn-default\"><i class=\"fa fa-book\"></i>&nbsp;";
        echo ($context["button_docs"] ?? null);
        echo "</a>
        <a href=\"";
        // line 10
        echo ($context["cancel"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_cancel"] ?? null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-reply\"></i></a>
\t  </div>
      <h1>";
        // line 12
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      <ul class=\"breadcrumb\">
        ";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            echo " 
        <li><a href=\"";
            // line 15
            echo (($__internal_compile_0 = $context["breadcrumb"]) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["href"] ?? null) : null);
            echo "\">";
            echo (($__internal_compile_1 = $context["breadcrumb"]) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["text"] ?? null) : null);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 16
        echo " 
      </ul>
    </div>
  </div>
 <!--Header End--> 
 
  <div class=\"container-fluid\">
    <!--Start - Error / Success Message if any -->
\t";
        // line 24
        if (($context["error_warning"] ?? null)) {
            echo " 
    <div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            // line 25
            echo ($context["error_warning"] ?? null);
            echo " 
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 28
        echo " 
    ";
        // line 29
        if (($context["success"] ?? null)) {
            echo " 
    <div class=\"alert alert-success\"><i class=\"fa fa-check-circle\"></i> ";
            // line 30
            echo ($context["success"] ?? null);
            echo " 
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 33
        echo " 
\t<!--End - Error / Success Message if any -->
    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-pencil\"></i> ";
        // line 37
        echo ($context["heading_title"] ?? null);
        echo "</h3>
\t\t\t";
        // line 38
        if (($context["stores"] ?? null)) {
            echo " 
\t\t\t<div class=\"pull-right\">
\t\t\t<select id=\"store\">
\t\t\t\t<option value=\"0\" ";
            // line 41
            echo (((($context["store_id"] ?? null) == 0)) ? ("selected") : (""));
            echo ">Default Store</option>
\t\t\t\t";
            // line 42
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
                echo " 
\t\t\t\t\t<option value=\"";
                // line 43
                echo (($__internal_compile_2 = $context["store"]) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["store_id"] ?? null) : null);
                echo "\" ";
                echo (((($context["store_id"] ?? null) == (($__internal_compile_3 = $context["store"]) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["store_id"] ?? null) : null))) ? ("selected") : (""));
                echo ">";
                echo (($__internal_compile_4 = $context["store"]) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["name"] ?? null) : null);
                echo "</option>
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 44
            echo " 
\t\t\t</select>
\t\t\t</div>
\t\t\t";
        }
        // line 47
        echo " 
      </div>
      <div class=\"panel-body\">
\t\t  <div id=\"result-console\"></div>
          <form action=\"";
        // line 51
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-hb-snippets\" class=\"form-horizontal\">
\t\t     <ul class=\"nav nav-tabs\">
                <li class=\"active\"><a href=\"#tab-structured-data\" data-toggle=\"tab\"><i class=\"fa fa-google\"></i> ";
        // line 53
        echo ($context["tab_sd"] ?? null);
        echo "</a></li>
\t\t\t\t<li><a href=\"#tab-opengraph\" data-toggle=\"tab\"><i class=\"fa fa-facebook\"></i> ";
        // line 54
        echo ($context["tab_og"] ?? null);
        echo "</a></li>
\t\t\t\t<li><a href=\"#tab-twittercards\" data-toggle=\"tab\"><i class=\"fa fa-twitter\"></i> ";
        // line 55
        echo ($context["tab_tc"] ?? null);
        echo "</a></li>
\t          </ul>
\t\t\t  <div class=\"tab-content\">
\t\t\t  
\t\t\t\t\t<div class=\"tab-pane active\" id=\"tab-structured-data\">
\t\t\t\t\t \t<!-- Product Structured Data -->
\t\t\t\t\t\t<div class=\"panel panel-default\">
\t\t\t\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t\t\t\t<h4 class=\"panel-title\">
\t\t\t\t\t\t\t\t\t<a class=\"collapsed\" data-toggle=\"collapse\" data-parent=\"#accordion-option\" href=\"#collapse-product\">
\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-list\"></i>&nbsp;";
        // line 65
        echo ($context["acc_product"] ?? null);
        echo "
\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-caret-down pull-right\"></i>
\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t</h4>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div id=\"collapse-product\" class=\"panel-collapse collapse\">
\t\t\t\t\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 73
        echo ($context["text_product_structured_data"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"checkbox\">
\t\t\t\t\t\t\t\t\t\t\t\t<label>
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" data-toggle=\"toggle\" data-onstyle=\"success\" name=\"hb_snippets_prod_enable\" value=\"1\" id=\"hb_snippets_prod_enable\" ";
        // line 77
        if (($context["hb_snippets_prod_enable"] ?? null)) {
            echo "checked";
        }
        echo ">
\t\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 84
        echo ($context["text_display_tax"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"checkbox\">
\t\t\t\t\t\t\t\t\t\t\t\t<label>
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" data-toggle=\"toggle\" data-onstyle=\"success\" name=\"hb_snippets_incl_tax\" value=\"1\" id=\"hb_snippets_incl_tax\" ";
        // line 88
        if (($context["hb_snippets_incl_tax"] ?? null)) {
            echo "checked";
        }
        echo ">
\t\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 95
        echo ($context["text_priceValidUntil"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-3\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"checkbox\">
\t\t\t\t\t\t\t\t\t\t\t\t<label>
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" data-toggle=\"toggle\" data-onstyle=\"success\" name=\"hb_snippets_pricevalid\" value=\"1\" id=\"hb_snippets_pricevalid\" ";
        // line 99
        if (($context["hb_snippets_pricevalid"] ?? null)) {
            echo "checked";
        }
        echo ">
\t\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 104
        echo ($context["text_priceValidUntil_default"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-3\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" id=\"hb_snippets_pricevaliddate\" name=\"hb_snippets_pricevaliddate\" data-date-format=\"YYYY-MM-DD\" value=\"";
        // line 107
        echo ($context["hb_snippets_pricevaliddate"] ?? null);
        echo "\" class=\"form-control date\" />
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"input-group-addon\"><i class=\"fa fa-calendar\"></i></span>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 114
        echo ($context["text_default_brand"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_snippets_brand\" class=\"form-control\" value=\"";
        // line 116
        echo ($context["hb_snippets_brand"] ?? null);
        echo "\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 121
        echo ($context["text_product_description_type"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t\t\t<select name=\"hb_snippets_description\" class=\"form-control\">
\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"meta_description\" ";
        // line 124
        echo (((($context["hb_snippets_description"] ?? null) == "meta_description")) ? ("selected") : (""));
        echo ">Meta Description</option>
\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"description\" ";
        // line 125
        echo (((($context["hb_snippets_description"] ?? null) == "description")) ? ("selected") : (""));
        echo ">Description</option>
\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 131
        echo ($context["text_availability"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t\t\t";
        // line 133
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stock_statuses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["stock_status"]) {
            // line 134
            echo "\t\t\t\t\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"input-group-addon\">";
            // line 135
            echo (($__internal_compile_5 = $context["stock_status"]) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["name"] ?? null) : null);
            echo "</span>
\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"hb_snippets_stock[";
            // line 136
            echo (($__internal_compile_6 = $context["stock_status"]) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["stock_status_id"] ?? null) : null);
            echo "]\" class=\"form-control\">
\t\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 137
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["availability"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["avail"]) {
                // line 138
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"";
                echo $context["avail"];
                echo "\" ";
                echo (((twig_get_attribute($this->env, $this->source, ($context["hb_snippets_stock"] ?? null), (($__internal_compile_7 = $context["stock_status"]) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["stock_status_id"] ?? null) : null), [], "array", true, true, false, 138) && ((($__internal_compile_8 = ($context["hb_snippets_stock"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8[(($__internal_compile_9 = $context["stock_status"]) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["stock_status_id"] ?? null) : null)] ?? null) : null) == $context["avail"]))) ? ("selected") : (""));
                echo ">";
                echo $context["avail"];
                echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['avail'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 140
            echo "\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t</div><br />
\t\t\t\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['stock_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 143
        echo "\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 147
        echo ($context["text_shipping"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"checkbox\">
\t\t\t\t\t\t\t\t\t\t\t\t<label>
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" data-toggle=\"toggle\" data-onstyle=\"success\" name=\"hb_snippets_shipping\" value=\"1\" ";
        // line 151
        if (($context["hb_snippets_shipping"] ?? null)) {
            echo "checked";
        }
        echo ">
\t\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 158
        echo ($context["text_shipping_rule"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"alert alert-info\">";
        // line 160
        echo ($context["text_shipping_rule_help"] ?? null);
        echo "</div>
\t\t\t\t\t\t\t\t\t\t\t<a onclick=\"addShipping();\" class=\"btn btn-sm btn-primary\">
\t\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-plus\"></i>&nbsp;";
        // line 162
        echo ($context["btn_add_shipping"] ?? null);
        echo "
\t\t\t\t\t\t\t\t\t\t\t</a> <br /><br />
\t\t\t\t\t\t\t\t\t\t\t<div id=\"shipping\">
\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 165
        $context["shipping_row"] = 0;
        echo " 
\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 166
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["hb_snippets_shipping_rules"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["rule"]) {
            echo "\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t\t<div id=\"shipping-row";
            // line 167
            echo ($context["shipping_row"] ?? null);
            echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\"><input type=\"text\" placeholder=\"0-100:US-NY:5:USD:0-1:1-7\" name=\"hb_snippets_shipping_rules[";
            // line 168
            echo ($context["shipping_row"] ?? null);
            echo "]\" class=\"form-control\" value=\"";
            echo $context["rule"];
            echo "\"></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-3\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" onclick=\"\$('#shipping-row";
            // line 170
            echo ($context["shipping_row"] ?? null);
            echo "').remove();\" data-toggle=\"tooltip\" title=\"";
            echo ($context["button_remove"] ?? null);
            echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i> ";
            echo ($context["button_remove"] ?? null);
            echo "</button></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t</div><br><br><br>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 172
            $context["shipping_row"] = (($context["shipping_row"] ?? null) + 1);
            echo " 
\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rule'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 174
        echo "\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 179
        echo ($context["text_return"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"checkbox\">
\t\t\t\t\t\t\t\t\t\t\t\t<label>
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" data-toggle=\"toggle\" data-onstyle=\"success\" name=\"hb_snippets_return\" value=\"1\" ";
        // line 183
        if (($context["hb_snippets_return"] ?? null)) {
            echo "checked";
        }
        echo ">
\t\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 190
        echo ($context["text_return_rule"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"alert alert-info\">";
        // line 192
        echo ($context["text_return_rule_help"] ?? null);
        echo "</div>
\t\t\t\t\t\t\t\t\t\t\t<a onclick=\"addReturn();\" class=\"btn btn-sm btn-primary\">
\t\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-plus\"></i>&nbsp;";
        // line 194
        echo ($context["btn_add_return"] ?? null);
        echo "
\t\t\t\t\t\t\t\t\t\t\t</a> <br /><br />
\t\t\t\t\t\t\t\t\t\t\t<div id=\"return\">
\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 197
        $context["return_row"] = 0;
        echo " 
\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 198
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["hb_snippets_return_rules"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["rule"]) {
            echo "\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t\t<div id=\"return-row";
            // line 199
            echo ($context["return_row"] ?? null);
            echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\"><input type=\"text\" placeholder=\"US:MRFRW:60:RBM:RFCR:10:USD\" name=\"hb_snippets_return_rules[";
            // line 200
            echo ($context["return_row"] ?? null);
            echo "]\" class=\"form-control\" value=\"";
            echo $context["rule"];
            echo "\"></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-3\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" onclick=\"\$('#return-row";
            // line 202
            echo ($context["return_row"] ?? null);
            echo "').remove();\" data-toggle=\"tooltip\" title=\"";
            echo ($context["button_remove"] ?? null);
            echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i> ";
            echo ($context["button_remove"] ?? null);
            echo "</button></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t</div><br><br><br>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 204
            $context["return_row"] = (($context["return_row"] ?? null) + 1);
            echo " 
\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rule'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 206
        echo "\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<!-- Product Structured Data End -->

\t\t\t\t\t\t<!--breadcrumb structured data-->
\t\t\t\t\t\t<div class=\"panel panel-default\">
\t\t\t\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t\t\t\t<h4 class=\"panel-title\">
\t\t\t\t\t\t\t\t<a data-toggle=\"collapse\" data-parent=\"#accordion-option\" href=\"#collapse-breadcrumb\" class=\"collapsed\" aria-expanded=\"false\">
\t\t\t\t\t\t\t\t\t<i class=\"fa fa-arrow-right\"></i>&nbsp;";
        // line 220
        echo ($context["acc_breadcrumb"] ?? null);
        echo "
\t\t\t\t\t\t\t\t\t<i class=\"fa fa-caret-down pull-right\"></i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t</h4>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t<div id=\"collapse-breadcrumb\" class=\"panel-collapse collapse\" aria-expanded=\"false\">
\t\t\t\t\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 230
        echo ($context["text_breadcrumblist_enable"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t<div class=\"checkbox\">
\t\t\t\t\t\t\t\t\t\t<label>
\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" data-toggle=\"toggle\" data-onstyle=\"success\" name=\"hb_snippets_bc_enable\" value=\"1\" id=\"hb_snippets_bc_enable\" ";
        // line 234
        if (($context["hb_snippets_bc_enable"] ?? null)) {
            echo " checked";
        }
        echo "/>
\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 241
        echo ($context["text_breadcrumblist_type"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t<select name=\"hb_snippets_bc_type\" class=\"form-control\">
\t\t\t\t\t\t\t\t\t\t<option value=\"smart\" ";
        // line 244
        echo (((($context["hb_snippets_bc_type"] ?? null) == "smart")) ? ("selected") : (""));
        echo ">";
        echo ($context["text_breadcrumblist_type_smart"] ?? null);
        echo "</option>
\t\t\t\t\t\t\t\t\t\t<option value=\"original\" ";
        // line 245
        echo (((($context["hb_snippets_bc_type"] ?? null) == "original")) ? ("selected") : (""));
        echo ">";
        echo ($context["text_breadcrumblist_type_original"] ?? null);
        echo "</option>
\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<!--image metadata structured data-->
\t\t\t\t\t\t<div class=\"panel panel-default\">
\t\t\t\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t\t\t\t<h4 class=\"panel-title\">
\t\t\t\t\t\t\t\t<a data-toggle=\"collapse\" data-parent=\"#accordion-option\" href=\"#collapse-image\" class=\"collapsed\" aria-expanded=\"false\">
\t\t\t\t\t\t\t\t\t<i class=\"fa fa-picture-o\"></i>&nbsp;";
        // line 259
        echo ($context["acc_image_metadata"] ?? null);
        echo "
\t\t\t\t\t\t\t\t\t<i class=\"fa fa-caret-down pull-right\"></i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t</h4>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t<div id=\"collapse-image\" class=\"panel-collapse collapse\" aria-expanded=\"false\">
\t\t\t\t\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 269
        echo ($context["text_image_enable"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t\t<div class=\"checkbox\">
\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" data-toggle=\"toggle\" data-onstyle=\"success\" name=\"hb_snippets_img_enable\" value=\"1\" ";
        // line 272
        if (($context["hb_snippets_img_enable"] ?? null)) {
            echo " checked";
        }
        echo "/>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"help-block\">";
        // line 274
        echo ($context["text_image_enable_help"] ?? null);
        echo "</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 279
        echo ($context["text_image_license"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_snippets_img_license\" class=\"form-control\" value=\"";
        // line 281
        echo ($context["hb_snippets_img_license"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["text_image_license_placeholder"] ?? null);
        echo "\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 286
        echo ($context["text_image_acquire_license"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_snippets_img_acquire\" class=\"form-control\" value=\"";
        // line 288
        echo ($context["hb_snippets_img_acquire"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["text_image_acquire_license_placeholder"] ?? null);
        echo "\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 293
        echo ($context["text_image_credittext"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_snippets_img_credit\" class=\"form-control\" value=\"";
        // line 295
        echo ($context["hb_snippets_img_credit"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["text_image_credittext_placeholder"] ?? null);
        echo "\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 300
        echo ($context["text_image_creator"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_snippets_img_creator\" class=\"form-control\" value=\"";
        // line 302
        echo ($context["hb_snippets_img_creator"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["text_image_creator_placeholder"] ?? null);
        echo "\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 307
        echo ($context["text_image_copyright"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_snippets_img_copyright\" class=\"form-control\" value=\"";
        // line 309
        echo ($context["hb_snippets_img_copyright"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["text_image_copyright_placeholder"] ?? null);
        echo "\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<!-- home structured data -->
\t\t\t\t\t\t<div class=\"panel panel-default\">
\t\t\t\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t\t\t\t<h4 class=\"panel-title\">
\t\t\t\t\t\t\t\t<a data-toggle=\"collapse\" data-parent=\"#accordion-option\" href=\"#collapse-home\" class=\"collapsed\" aria-expanded=\"false\">
\t\t\t\t\t\t\t\t\t<i class=\"fa fa-home\"></i>&nbsp;";
        // line 322
        echo ($context["acc_home"] ?? null);
        echo "
\t\t\t\t\t\t\t\t\t<i class=\"fa fa-caret-down pull-right\"></i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t</h4>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t<div id=\"collapse-home\" class=\"panel-collapse collapse\" aria-expanded=\"false\">
\t\t\t\t\t\t\t\t<div class=\"panel-body\">\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 331
        echo ($context["text_home_enable"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"checkbox\">
\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" data-toggle=\"toggle\" data-onstyle=\"success\" name=\"hb_snippets_kg_enable\" value=\"1\" id=\"hb_snippets_kg_enable\" ";
        // line 334
        if (($context["hb_snippets_kg_enable"] ?? null)) {
            echo " checked";
        }
        echo "/>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 340
        echo ($context["text_vat"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_snippets_vat\" class=\"form-control\" value=\"";
        // line 342
        echo ($context["hb_snippets_vat"] ?? null);
        echo "\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 347
        echo ($context["text_logo"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t\t\t<a href=\"\" id=\"thumb-image\" data-toggle=\"image\" class=\"img-thumbnail\"><img src=\"";
        // line 349
        echo ($context["logo_thumb"] ?? null);
        echo "\" alt=\"\" title=\"\" data-placeholder=\"";
        echo ($context["placeholder"] ?? null);
        echo "\" /></a>
\t\t\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"hb_snippets_logo\" value=\"";
        // line 350
        echo ($context["hb_snippets_logo"] ?? null);
        echo "\" id=\"input-image\" />
\t\t\t\t\t\t\t\t\t\t\t";
        // line 351
        if (($context["error_logo"] ?? null)) {
            echo " 
\t\t\t\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
            // line 352
            echo ($context["error_logo"] ?? null);
            echo "</div>
\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 353
        echo " 
\t\t\t\t\t\t\t\t\t\t\t<div class=\"help-block\">";
        // line 354
        echo ($context["text_logo_help"] ?? null);
        echo "</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 359
        echo ($context["text_search_enable"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t\t<div class=\"checkbox\">
\t\t\t\t\t\t\t\t\t\t\t<label>
\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" data-toggle=\"toggle\" data-onstyle=\"success\" name=\"hb_snippets_search_enable\" value=\"1\" id=\"hb_snippets_search_enable\" ";
        // line 363
        if (($context["hb_snippets_search_enable"] ?? null)) {
            echo " checked";
        }
        echo "/>
\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 370
        echo ($context["text_contacts"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t\t<a onclick=\"addContact();\" class=\"btn btn-sm btn-primary\">
\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-plus\"></i>&nbsp;";
        // line 373
        echo ($context["btn_contact_number"] ?? null);
        echo "
\t\t\t\t\t\t\t\t\t\t</a> <br /><br />
\t\t\t\t\t\t\t\t\t\t<div id=\"corp_contact\">
\t\t\t\t\t\t\t\t\t\t\t";
        // line 376
        $context["contact_row"] = 0;
        echo " 
\t\t\t\t\t\t\t\t\t\t\t";
        // line 377
        if (($context["hb_snippets_contact"] ?? null)) {
            echo " 
\t\t\t\t\t\t\t\t\t\t\t";
            // line 378
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["hb_snippets_contact"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["contact"]) {
                echo "\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t<div id=\"contact-row";
                // line 379
                echo ($context["contact_row"] ?? null);
                echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-4\"><input type=\"text\" placeholder=\"+1-401-555-1212\" name=\"hb_snippets_contact[";
                // line 380
                echo ($context["contact_row"] ?? null);
                echo "][n]\" class=\"form-control\" value=\"";
                echo (($__internal_compile_10 = $context["contact"]) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["n"] ?? null) : null);
                echo "\"></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-4\"><select name=\"hb_snippets_contact[";
                // line 381
                echo ($context["contact_row"] ?? null);
                echo "][t]\" class=\"form-control\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
                // line 382
                echo (((twig_get_attribute($this->env, $this->source, $context["contact"], "t", [], "any", false, false, false, 382) == "Customer Service")) ? ("selected") : (""));
                echo " >Customer Service</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
                // line 383
                echo (((twig_get_attribute($this->env, $this->source, $context["contact"], "t", [], "any", false, false, false, 383) == "Customer Support")) ? ("selected") : (""));
                echo " >Customer Support</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
                // line 384
                echo (((twig_get_attribute($this->env, $this->source, $context["contact"], "t", [], "any", false, false, false, 384) == "Technical Support")) ? ("selected") : (""));
                echo " >Technical Support</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
                // line 385
                echo (((twig_get_attribute($this->env, $this->source, $context["contact"], "t", [], "any", false, false, false, 385) == "Billing Support")) ? ("selected") : (""));
                echo " >Billing Support</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
                // line 386
                echo (((twig_get_attribute($this->env, $this->source, $context["contact"], "t", [], "any", false, false, false, 386) == "Bill Payment")) ? ("selected") : (""));
                echo " >Bill Payment</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
                // line 387
                echo (((twig_get_attribute($this->env, $this->source, $context["contact"], "t", [], "any", false, false, false, 387) == "Sales")) ? ("selected") : (""));
                echo " >Sales</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
                // line 388
                echo (((twig_get_attribute($this->env, $this->source, $context["contact"], "t", [], "any", false, false, false, 388) == "Reservations")) ? ("selected") : (""));
                echo " >Reservations</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
                // line 389
                echo (((twig_get_attribute($this->env, $this->source, $context["contact"], "t", [], "any", false, false, false, 389) == "Credit Card Support")) ? ("selected") : (""));
                echo " >Credit Card Support</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
                // line 390
                echo (((twig_get_attribute($this->env, $this->source, $context["contact"], "t", [], "any", false, false, false, 390) == "Emergency")) ? ("selected") : (""));
                echo " >Emergency</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
                // line 391
                echo (((twig_get_attribute($this->env, $this->source, $context["contact"], "t", [], "any", false, false, false, 391) == "Baggage Tracking")) ? ("selected") : (""));
                echo " >Baggage Tracking</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
                // line 392
                echo (((twig_get_attribute($this->env, $this->source, $context["contact"], "t", [], "any", false, false, false, 392) == "Roadside Assistance")) ? ("selected") : (""));
                echo " >Roadside Assistance</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
                // line 393
                echo (((twig_get_attribute($this->env, $this->source, $context["contact"], "t", [], "any", false, false, false, 393) == "Package Tracking")) ? ("selected") : (""));
                echo " >Package Tracking</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-4\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" onclick=\"\$('#contact-row";
                // line 397
                echo ($context["contact_row"] ?? null);
                echo "').remove();\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_remove"] ?? null);
                echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i> ";
                echo ($context["button_remove"] ?? null);
                echo "</button></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<br /><br /><br />
\t\t\t\t\t\t\t\t\t\t\t\t";
                // line 400
                $context["contact_row"] = (($context["contact_row"] ?? null) + 1);
                echo " 
\t\t\t\t\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['contact'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 401
            echo "\t
\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 402
        echo "\t
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"help-block\">";
        // line 404
        echo ($context["text_contacts_help"] ?? null);
        echo "</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 409
        echo ($context["text_emails"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t\t\t<a onclick=\"addEmail();\" class=\"btn btn-sm btn-primary\"><i class=\"fa fa-plus\"></i>&nbsp;";
        // line 411
        echo ($context["btn_add_email"] ?? null);
        echo "</a> <br /><br />
\t\t\t\t\t\t\t\t\t\t\t<div id=\"corp_email\">
\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 413
        $context["email_row"] = 0;
        echo " 
\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 414
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["hb_snippets_emails"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["email"]) {
            echo "\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t\t<div id=\"email-row";
            // line 415
            echo ($context["email_row"] ?? null);
            echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-4\"><input type=\"text\" placeholder=\"support@exampleonlinestore.com\" name=\"hb_snippets_emails[";
            // line 416
            echo ($context["email_row"] ?? null);
            echo "][email]\" class=\"form-control\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["email"], "email", [], "any", false, false, false, 416);
            echo "\"></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-4\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"hb_snippets_emails[";
            // line 418
            echo ($context["email_row"] ?? null);
            echo "][type]\" class=\"form-control\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
            // line 419
            echo (((twig_get_attribute($this->env, $this->source, $context["email"], "type", [], "any", false, false, false, 419) == "customer service")) ? ("selected") : (""));
            echo ">customer service</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
            // line 420
            echo (((twig_get_attribute($this->env, $this->source, $context["email"], "type", [], "any", false, false, false, 420) == "support")) ? ("selected") : (""));
            echo ">support</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
            // line 421
            echo (((twig_get_attribute($this->env, $this->source, $context["email"], "type", [], "any", false, false, false, 421) == "sales")) ? ("selected") : (""));
            echo ">sales</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
            // line 422
            echo (((twig_get_attribute($this->env, $this->source, $context["email"], "type", [], "any", false, false, false, 422) == "billing")) ? ("selected") : (""));
            echo ">billing</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
            // line 423
            echo (((twig_get_attribute($this->env, $this->source, $context["email"], "type", [], "any", false, false, false, 423) == "technical support")) ? ("selected") : (""));
            echo ">technical support</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
            // line 424
            echo (((twig_get_attribute($this->env, $this->source, $context["email"], "type", [], "any", false, false, false, 424) == "reservation")) ? ("selected") : (""));
            echo ">reservation</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
            // line 425
            echo (((twig_get_attribute($this->env, $this->source, $context["email"], "type", [], "any", false, false, false, 425) == "returns")) ? ("selected") : (""));
            echo ">returns</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
            // line 426
            echo (((twig_get_attribute($this->env, $this->source, $context["email"], "type", [], "any", false, false, false, 426) == "complaints")) ? ("selected") : (""));
            echo ">complaints</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
            // line 427
            echo (((twig_get_attribute($this->env, $this->source, $context["email"], "type", [], "any", false, false, false, 427) == "press")) ? ("selected") : (""));
            echo ">press</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
            // line 428
            echo (((twig_get_attribute($this->env, $this->source, $context["email"], "type", [], "any", false, false, false, 428) == "general")) ? ("selected") : (""));
            echo ">general</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-4\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" onclick=\"\$('#email-row";
            // line 432
            echo ($context["email_row"] ?? null);
            echo "').remove();\" data-toggle=\"tooltip\" title=\"";
            echo ($context["button_remove"] ?? null);
            echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i> ";
            echo ($context["button_remove"] ?? null);
            echo "</button></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<br /><br /><br />
\t\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 435
            $context["email_row"] = (($context["email_row"] ?? null) + 1);
            echo " 
\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['email'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 436
        echo "\t
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 442
        echo ($context["text_social"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t\t\t<a onclick=\"addSocial();\" class=\"btn btn-sm btn-primary\"><i class=\"fa fa-plus\"></i>&nbsp;";
        // line 444
        echo ($context["btn_add_social"] ?? null);
        echo "</a> <br /><br />
\t\t\t\t\t\t\t\t\t\t\t<div id=\"corp_social\">
\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 446
        $context["social_row"] = 0;
        echo " 
\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 447
        if (($context["hb_snippets_socials"] ?? null)) {
            echo " 
\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 448
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["hb_snippets_socials"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["social"]) {
                echo "\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t\t<div id=\"social-row";
                // line 449
                echo ($context["social_row"] ?? null);
                echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\"><input type=\"text\" placeholder=\"https://www.facebook.com/your-profile\" name=\"hb_snippets_socials[";
                // line 450
                echo ($context["social_row"] ?? null);
                echo "]\" class=\"form-control\" value=\"";
                echo $context["social"];
                echo "\"></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-3\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" onclick=\"\$('#social-row";
                // line 452
                echo ($context["social_row"] ?? null);
                echo "').remove();\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_remove"] ?? null);
                echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i> ";
                echo ($context["button_remove"] ?? null);
                echo "</button></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t</div><br><br><br>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
                // line 454
                $context["social_row"] = (($context["social_row"] ?? null) + 1);
                echo " 
\t\t\t\t\t\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['social'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 455
            echo "\t
\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 456
        echo "\t
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 462
        echo ($context["text_payment"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t\t\t<a onclick=\"addPayment();\" class=\"btn btn-sm btn-primary\"><i class=\"fa fa-plus\"></i>&nbsp;";
        // line 464
        echo ($context["btn_add_payment"] ?? null);
        echo "</a> <br /><br />
\t\t\t\t\t\t\t\t\t\t\t<div id=\"payment\">
\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 466
        $context["payment_row"] = 0;
        echo " 
\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 467
        if (($context["hb_snippets_payment"] ?? null)) {
            echo " 
\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 468
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["hb_snippets_payment"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["payment"]) {
                echo "\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t\t<div id=\"payment-row";
                // line 469
                echo ($context["payment_row"] ?? null);
                echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\"><input type=\"text\" placeholder=\"Visa, MasterCard, Discover, American Express\" name=\"hb_snippets_payment[";
                // line 470
                echo ($context["payment_row"] ?? null);
                echo "]\" class=\"form-control\" value=\"";
                echo $context["payment"];
                echo "\"></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-3\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" onclick=\"\$('#payment-row";
                // line 472
                echo ($context["payment_row"] ?? null);
                echo "').remove();\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_remove"] ?? null);
                echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i> ";
                echo ($context["button_remove"] ?? null);
                echo "</button></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t</div><br><br><br>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
                // line 474
                $context["payment_row"] = (($context["payment_row"] ?? null) + 1);
                echo " 
\t\t\t\t\t\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['payment'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 475
            echo "\t
\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 476
        echo "\t
\t\t\t\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<!-- category structured data -->
\t\t\t\t\t\t<div class=\"panel panel-default\">
\t\t\t\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t\t\t\t<h4 class=\"panel-title\">
\t\t\t\t\t\t\t\t<a data-toggle=\"collapse\" data-parent=\"#accordion-option\" href=\"#collapse-category\" class=\"collapsed\" aria-expanded=\"false\">
\t\t\t\t\t\t\t\t\t<i class=\"fa fa-bars\"></i>&nbsp;";
        // line 489
        echo ($context["acc_category"] ?? null);
        echo "
\t\t\t\t\t\t\t\t\t<i class=\"fa fa-caret-down pull-right\"></i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t</h4>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t<div id=\"collapse-category\" class=\"panel-collapse collapse\" aria-expanded=\"false\">
\t\t\t\t\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 499
        echo ($context["text_category_enable"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t<div class=\"checkbox\">
\t\t\t\t\t\t\t\t\t\t<label>
\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" data-toggle=\"toggle\" data-onstyle=\"success\" name=\"hb_snippets_list_enable\" value=\"1\" id=\"hb_snippets_list_enable\" ";
        // line 503
        if (($context["hb_snippets_list_enable"] ?? null)) {
            echo " checked";
        }
        echo "/>
\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<!-- Local business structured data -->
\t\t\t\t\t\t<div class=\"panel panel-default\">
\t\t\t\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t\t\t\t<h4 class=\"panel-title\">
\t\t\t\t\t\t\t\t<a data-toggle=\"collapse\" data-parent=\"#accordion-option\" href=\"#collapse-local\" class=\"collapsed\" aria-expanded=\"false\">
\t\t\t\t\t\t\t\t\t<i class=\"fa fa-google-plus-square\"></i>&nbsp;";
        // line 518
        echo ($context["acc_local"] ?? null);
        echo "
\t\t\t\t\t\t\t\t\t<i class=\"fa fa-caret-down pull-right\"></i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t</h4>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t<div id=\"collapse-local\" class=\"panel-collapse collapse\" aria-expanded=\"false\">
\t\t\t\t\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<!-- Enable local business -->
\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 529
        echo ($context["text_local_enable"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t<div class=\"checkbox\">
\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" data-toggle=\"toggle\" data-onstyle=\"success\" name=\"hb_snippets_local_enable\" value=\"1\" id=\"hb_snippets_local_enable\" ";
        // line 532
        if (($context["hb_snippets_local_enable"] ?? null)) {
            echo " checked";
        }
        echo "/>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<!-- Store Name -->
\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 539
        echo ($context["text_storename"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_snippets_local_name\" id=\"hb_snippets_local_name\" class=\"form-control\" value=\"";
        // line 541
        echo ($context["hb_snippets_local_name"] ?? null);
        echo "\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<!-- Street Address -->
\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 547
        echo ($context["text_street"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_snippets_local_st\" id=\"hb_snippets_local_st\" class=\"form-control\" value=\"";
        // line 549
        echo ($context["hb_snippets_local_st"] ?? null);
        echo "\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<!-- Locality -->
\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 555
        echo ($context["text_locality"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_snippets_local_location\" id=\"hb_snippets_local_location\" class=\"form-control\" value=\"";
        // line 557
        echo ($context["hb_snippets_local_location"] ?? null);
        echo "\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<!-- Region -->
\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 563
        echo ($context["text_region"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_snippets_local_state\" id=\"hb_snippets_local_state\" class=\"form-control\" value=\"";
        // line 565
        echo ($context["hb_snippets_local_state"] ?? null);
        echo "\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<!-- Postal Code -->
\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 571
        echo ($context["text_postal"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_snippets_local_postal\" id=\"hb_snippets_local_postal\" class=\"form-control\" value=\"";
        // line 573
        echo ($context["hb_snippets_local_postal"] ?? null);
        echo "\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<!-- Country -->
\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 579
        echo ($context["text_country"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_snippets_local_country\" id=\"hb_snippets_local_country\" class=\"form-control\" value=\"";
        // line 581
        echo ($context["hb_snippets_local_country"] ?? null);
        echo "\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<!-- Store Image -->
\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 587
        echo ($context["text_store_image"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_snippets_store_image\" id=\"hb_snippets_store_image\" class=\"form-control\" value=\"";
        // line 589
        echo ($context["hb_snippets_store_image"] ?? null);
        echo "\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<!-- Price Range -->
\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 595
        echo ($context["text_price_range"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_snippets_price_range\" id=\"hb_snippets_price_range\" class=\"form-control\" value=\"";
        // line 597
        echo ($context["hb_snippets_price_range"] ?? null);
        echo "\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<!-- Generate Local Snippet Button -->
\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\"></label>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t<a class=\"btn btn-sm btn-primary\" onclick=\"generatelocalsnippet();\" id=\"btn_generate_local\"><i class=\"fa fa-bolt\"></i>&nbsp;";
        // line 605
        echo ($context["btn_generate_local"] ?? null);
        echo "</a>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<!-- Local Snippet -->
\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t<label class=\"col-sm-3 control-label\">";
        // line 611
        echo ($context["text_local_snippet"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-9\">
\t\t\t\t\t\t\t\t\t<textarea name=\"hb_snippets_local_snippet\" id=\"hb_snippets_local_snippet\" rows=\"10\" class=\"form-control\">";
        // line 613
        echo ($context["hb_snippets_local_snippet"] ?? null);
        echo "</textarea>
\t\t\t\t\t\t\t\t\t<span class=\"help-block\">";
        // line 614
        echo ($context["text_local_snippet_help"] ?? null);
        echo "</span>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<!--testing tool-->
\t\t\t\t\t\t<div class=\"panel panel-default\">
\t\t\t\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t\t\t\t<h4 class=\"panel-title\">
\t\t\t\t\t\t\t\t<a data-toggle=\"collapse\" data-parent=\"#accordion-option\" href=\"#collapse-testing\" class=\"collapsed\" aria-expanded=\"false\">
\t\t\t\t\t\t\t\t\t<i class=\"fa fa-google\"></i>&nbsp;";
        // line 627
        echo ($context["acc_testing"] ?? null);
        echo "
\t\t\t\t\t\t\t\t\t<i class=\"fa fa-caret-down pull-right\"></i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t</h4>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t<div id=\"collapse-testing\" class=\"panel-collapse collapse\" aria-expanded=\"false\">
\t\t\t\t\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t\t\t\t<a class=\"btn btn-sm btn-success\" href=\"https://search.google.com/test/rich-results\" target=\"_blank\">";
        // line 635
        echo ($context["btn_google_testing"] ?? null);
        echo "</a>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t</div><!--tab-structured-data-->
\t\t\t\t    
\t\t\t\t    <div class=\"tab-pane\" id=\"tab-opengraph\">
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 644
        echo ($context["text_og_enable"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<input type=\"checkbox\" data-toggle=\"toggle\" data-onstyle=\"success\" name=\"hb_snippets_og_enable\" class=\"form-control\" value=\"1\" ";
        // line 646
        echo (((($context["hb_snippets_og_enable"] ?? null) == 1)) ? ("checked") : (""));
        echo " />
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 650
        echo ($context["text_og_appid"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_snippets_og_id\" class=\"form-control\" value=\"";
        // line 652
        echo ($context["hb_snippets_og_id"] ?? null);
        echo "\">
\t\t\t\t\t\t\t\t<div class=\"form-text\">";
        // line 653
        echo ($context["text_og_appid_help"] ?? null);
        echo "</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 657
        echo ($context["text_og_product_pattern"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_snippets_ogp\" class=\"form-control\" value=\"";
        // line 659
        echo ($context["hb_snippets_ogp"] ?? null);
        echo "\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 663
        echo ($context["text_og_category_pattern"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_snippets_ogc\" class=\"form-control\" value=\"";
        // line 665
        echo ($context["hb_snippets_ogc"] ?? null);
        echo "\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t  <label class=\"col-sm-4 control-label\">";
        // line 669
        echo ($context["text_og_cover_image"] ?? null);
        echo "</label>
\t\t\t\t\t\t  <div class=\"col-sm-8\">
\t\t\t\t\t\t\t<a href=\"\" id=\"thumb-ogimg\" data-toggle=\"image\" class=\"img-thumbnail\"><img src=\"";
        // line 671
        echo ($context["ogimg"] ?? null);
        echo "\" alt=\"\" title=\"\" data-placeholder=\"";
        echo ($context["placeholder"] ?? null);
        echo "\" /></a>
\t\t\t\t\t\t\t<input type=\"hidden\" name=\"hb_snippets_og_img\" id=\"hb_snippets_og_img\" value=\"";
        // line 672
        echo ($context["hb_snippets_og_img"] ?? null);
        echo "\" />
\t\t\t\t\t\t  </div>
\t\t\t\t\t  \t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 676
        echo ($context["text_og_cover_image_size"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-4\">
\t\t\t\t\t\t\t\t<input type=\"number\" name=\"hb_snippets_og_diw\" class=\"form-control\" value=\"";
        // line 678
        echo ($context["hb_snippets_og_diw"] ?? null);
        echo "\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-sm-4\">
\t\t\t\t\t\t\t\t<input type=\"number\" name=\"hb_snippets_og_dih\" class=\"form-control\" value=\"";
        // line 681
        echo ($context["hb_snippets_og_dih"] ?? null);
        echo "\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 685
        echo ($context["text_og_product_image"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-4\">
\t\t\t\t\t\t\t\t<input type=\"number\" name=\"hb_snippets_og_piw\" class=\"form-control\" value=\"";
        // line 687
        echo ($context["hb_snippets_og_piw"] ?? null);
        echo "\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-sm-4\">
\t\t\t\t\t\t\t\t<input type=\"number\" name=\"hb_snippets_og_pih\" class=\"form-control\" value=\"";
        // line 690
        echo ($context["hb_snippets_og_pih"] ?? null);
        echo "\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 694
        echo ($context["text_og_category_image"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-4\">
\t\t\t\t\t\t\t\t<input type=\"number\" name=\"hb_snippets_og_ciw\" class=\"form-control\" value=\"";
        // line 696
        echo ($context["hb_snippets_og_ciw"] ?? null);
        echo "\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-sm-4\">
\t\t\t\t\t\t\t\t<input type=\"number\" name=\"hb_snippets_og_cih\" class=\"form-control\" value=\"";
        // line 699
        echo ($context["hb_snippets_og_cih"] ?? null);
        echo "\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\"></label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<a class=\"btn btn-sm btn-success\" href=\"https://developers.facebook.com/tools/debug/\" target=\"_blank\">";
        // line 706
        echo ($context["btn_og_testing"] ?? null);
        echo "</a>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t
\t\t\t\t   </div>
\t\t\t\t   
\t\t\t\t   <div class=\"tab-pane\" id=\"tab-twittercards\">
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 714
        echo ($context["text_twitter_enable"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<input type=\"checkbox\" data-toggle=\"toggle\" data-onstyle=\"success\" name=\"hb_snippets_tc_enable\" class=\"form-control\" value=\"1\" ";
        // line 716
        echo (((($context["hb_snippets_tc_enable"] ?? null) == 1)) ? ("checked") : (""));
        echo " />
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 720
        echo ($context["text_twitter_username"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_snippets_tc_username\" class=\"form-control\" value=\"";
        // line 722
        echo ($context["hb_snippets_tc_username"] ?? null);
        echo "\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 726
        echo ($context["text_twitter_product_pattern"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_snippets_tcp\" class=\"form-control\" value=\"";
        // line 728
        echo ($context["hb_snippets_tcp"] ?? null);
        echo "\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\">";
        // line 732
        echo ($context["text_twitter_category_pattern"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<input type=\"text\" name=\"hb_snippets_tcc\" class=\"form-control\" value=\"";
        // line 734
        echo ($context["hb_snippets_tcc"] ?? null);
        echo "\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\"></label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<a class=\"btn btn-sm btn-success\" href=\"https://cards-dev.x.com/validator\" target=\"_blank\">";
        // line 740
        echo ($context["btn_twitter_testing"] ?? null);
        echo "</a>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t   </div> <!--tab-twittercards-->
\t\t\t\t   
\t\t\t\t</div>
          </form>
    \t
      </div>
    </div>
  </div>
  <!--Huntbee copyrights-->
    <div class=\"container-fluid\">
      <center>
        <span class=\"help\">";
        // line 754
        echo ($context["heading_title"] ?? null);
        echo " - ";
        echo ($context["extension_version"] ?? null);
        echo " &copy; <a href=\"https://www.huntbee.com/\">WWW.HUNTBEE.COM</a> | <a href=\"https://www.huntbee.com/get-support\">SUPPORT</a></span>
      </center>
    </div>
    <!--Huntbee copyrights end-->
</div>

<link href=\"https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css\" rel=\"stylesheet\">
<script src=\"https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js\"></script>

<script type=\"text/javascript\">
\$('.date').datetimepicker({
\tpickTime: false
});
\$(document).ready(function () {
\t\$('.panel-heading a').click(function () {
\t\tvar \$this = \$(this);
\t\tif (\$this.hasClass('collapsed')) {
\t\t\t\$this.find('.fa-caret-down').removeClass('fa-caret-down').addClass('fa-caret-up');
\t\t} else {
\t\t\t\$this.find('.fa-caret-up').removeClass('fa-caret-up').addClass('fa-caret-down');
\t\t}
\t});
});

function generatelocalsnippet(){
\t\$('#localmu-block').html('<i class=\"fa fa-refresh fa-spin fa-fw\"></i>');
\t\$.ajax({
\t\t  type: 'post',
\t\t  url: 'index.php?route=";
        // line 782
        echo ($context["base_route"] ?? null);
        echo "/hb_snippets/generatelocalsnippet&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&store_id=";
        echo ($context["store_id"] ?? null);
        echo "',
\t\t  data: {\tname: \$('#hb_snippets_local_name').val(),
\t\t  \t\t\tstreet: \$('#hb_snippets_local_st').val(),
\t\t\t\t\tlocation: \$('#hb_snippets_local_location').val(),
\t\t\t\t\tpostal:\$('#hb_snippets_local_postal').val(),
\t\t   \t\t\tstate:\$('#hb_snippets_local_state').val(),
\t\t\t\t\tcountry:\$('#hb_snippets_local_country').val(),
\t\t\t\t\tstore_image:\$('#hb_snippets_store_image').val(),
\t\t\t\t\tprice_range:\$('#hb_snippets_price_range').val() 
\t\t\t\t},
\t\t  dataType: 'json',
\t\t  success: function(json) {
\t\t\t\tif (json['success']) {
\t\t\t\t\t\tvar ss = json['success'];
\t\t\t\t\t  \t\$('#hb_snippets_local_snippet').val(ss);
\t\t\t\t\t\t\$('#localmu-block').html('');
\t\t\t\t}

\t\t\t\tif (json['error']) {
\t\t\t\t\talert(json['error']);
\t\t\t\t\t\$('#localmu-block').html('');
\t\t\t\t}
\t\t  },\t\t\t
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t });
}
</script>
<script type=\"text/javascript\">
var contact_row = ";
        // line 812
        echo ($context["contact_row"] ?? null);
        echo ";
function addContact(){
\thtml  = '<div id=\"contact-row' + contact_row + '\">';
\thtml += '<div class=\"col-sm-4\"><input type=\"text\" placeholder=\"+1-401-555-1212\" name=\"hb_snippets_contact[' + contact_row + '][n]\" class=\"form-control\"></div>';
\thtml += '<div class=\"col-sm-4\"><select name=\"hb_snippets_contact[' + contact_row + '][t]\" class=\"form-control\">';
\thtml += '<option>Customer Service</option>';
\thtml += '<option>Customer Support</option>';
\thtml += '<option>Technical Support</option>';
\thtml += '<option>Billing Support</option>';
\thtml += '<option>Bill Payment</option>';
\thtml += '<option>Sales</option>';
\thtml += '<option>Reservations</option>';
\thtml += '<option>Credit Card Support</option>';
\thtml += '<option>Emergency</option>';
\thtml += '<option>Baggage Tracking</option>';
\thtml += '<option>Roadside Assistance</option>';
\thtml += '<option>Package Tracking</option>';
\thtml += '</select></div>';
\thtml += '<div class=\"col-sm-4\"><button type=\"button\" onclick=\"\$(\\'#contact-row' + contact_row + '\\').remove();\" data-toggle=\"tooltip\" title=\"";
        // line 830
        echo ($context["button_remove"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i> ";
        echo ($context["button_remove"] ?? null);
        echo "</button></div>';
\thtml += '</div><br><br><br>';
\t\$('#corp_contact').append(html);
\tcontact_row++;
}

var email_row = ";
        // line 836
        echo ($context["email_row"] ?? null);
        echo ";
function addEmail(){
\thtml  = '<div id=\"email-row' + email_row + '\">';
\thtml += '<div class=\"col-sm-4\"><input type=\"text\" placeholder=\"support@exampleonlinestore.com\" name=\"hb_snippets_emails[' + email_row + '][email]\" class=\"form-control\"></div>';
\thtml += '<div class=\"col-sm-4\"><select name=\"hb_snippets_emails[' + email_row + '][type]\" class=\"form-control\">';
\thtml += '<option>customer service</option>';
\thtml += '<option>support</option>';
\thtml += '<option>sales</option>';
\thtml += '<option>billing</option>';
\thtml += '<option>technical support</option>';
\thtml += '<option>reservation</option>';
\thtml += '<option>returns</option>';
\thtml += '<option>complaints</option>';
\thtml += '<option>press</option>';
\thtml += '<option>general</option>';
\thtml += '</select></div>';
\thtml += '<div class=\"col-sm-4\"><button type=\"button\" onclick=\"\$(\\'#email-row' + email_row + '\\').remove();\" data-toggle=\"tooltip\" title=\"";
        // line 852
        echo ($context["button_remove"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i> ";
        echo ($context["button_remove"] ?? null);
        echo "</button></div>';
\thtml += '</div><br><br><br>';
\t\$('#corp_email').append(html);
\temail_row++;
}

var social_row = ";
        // line 858
        echo ($context["social_row"] ?? null);
        echo ";
function addSocial(){
\thtml  = '<div id=\"social-row' + social_row + '\">';
\thtml += '<div class=\"col-sm-9\"><input type=\"text\" placeholder=\"https://www.facebook.com/your-profile\" name=\"hb_snippets_socials[' + social_row + ']\" class=\"form-control\"></div>';
\thtml += '<div class=\"col-sm-3\"><button type=\"button\" onclick=\"\$(\\'#social-row' + social_row + '\\').remove();\" data-toggle=\"tooltip\" title=\"";
        // line 862
        echo ($context["button_remove"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i> ";
        echo ($context["button_remove"] ?? null);
        echo "</button></div>';
\thtml += '</div><br><br><br>';
\t\$('#corp_social').append(html);
\tsocial_row++;
}

var payment_row = ";
        // line 868
        echo ($context["payment_row"] ?? null);
        echo ";
function addPayment() {
\thtml  = '<div id=\"payment-row' + payment_row + '\">';
\thtml += '<div class=\"col-sm-9\"><input type=\"text\" placeholder=\"Visa, MasterCard, Discover, American Express\" name=\"hb_snippets_payment[' + payment_row + ']\" class=\"form-control\"></div>';
\thtml += '<div class=\"col-sm-3\"><button type=\"button\" onclick=\"\$(\\'#payment-row' + payment_row + '\\').remove();\" data-toggle=\"tooltip\" title=\"";
        // line 872
        echo ($context["button_remove"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i> ";
        echo ($context["button_remove"] ?? null);
        echo "</button></div>';
\thtml += '</div><br><br><br>';
\t\$('#payment').append(html);
\tpayment_row++;
}

var shipping_row = ";
        // line 878
        echo ($context["shipping_row"] ?? null);
        echo ";
function addShipping() {
\thtml  = '<div id=\"shipping-row' + shipping_row + '\">';
\thtml += '<div class=\"col-sm-9\"><input type=\"text\" placeholder=\"0-100:US-NY:5:USD:0-1:1-7\" name=\"hb_snippets_shipping_rules[' + shipping_row + ']\" class=\"form-control\"></div>';
\thtml += '<div class=\"col-sm-3\"><button type=\"button\" onclick=\"\$(\\'#shipping-row' + shipping_row + '\\').remove();\" data-toggle=\"tooltip\" title=\"";
        // line 882
        echo ($context["button_remove"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i> ";
        echo ($context["button_remove"] ?? null);
        echo "</button></div>';
\thtml += '</div><br><br><br>';
\t\$('#shipping').append(html);
\tshipping_row++;
}

var return_row = ";
        // line 888
        echo ($context["return_row"] ?? null);
        echo ";
function addReturn() {
\thtml  = '<div id=\"return-row' + return_row + '\">';
\thtml += '<div class=\"col-sm-9\"><input type=\"text\" placeholder=\"US:MRFRW:60:RBM:RFCR:10:USD\" name=\"hb_snippets_return_rules[' + return_row + ']\" class=\"form-control\"></div>';
\thtml += '<div class=\"col-sm-3\"><button type=\"button\" onclick=\"\$(\\'#return-row' + return_row + '\\').remove();\" data-toggle=\"tooltip\" title=\"";
        // line 892
        echo ($context["button_remove"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i> ";
        echo ($context["button_remove"] ?? null);
        echo "</button></div>';
\thtml += '</div><br><br><br>';
\t\$('#return').append(html);
\treturn_row++;
}
</script>

<script type=\"text/javascript\">
\$('#store').on('change', function() {
\twindow.location.href = 'index.php?route=";
        // line 901
        echo ($context["base_route"] ?? null);
        echo "/hb_snippets&user_token=";
        echo ($context["user_token"] ?? null);
        echo "&store_id='+\$('#store').val();
});
</script>
";
        // line 904
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "extension/hbseo/oc3/hb_snippets.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1836 => 904,  1828 => 901,  1814 => 892,  1807 => 888,  1796 => 882,  1789 => 878,  1778 => 872,  1771 => 868,  1760 => 862,  1753 => 858,  1742 => 852,  1723 => 836,  1712 => 830,  1691 => 812,  1654 => 782,  1621 => 754,  1604 => 740,  1595 => 734,  1590 => 732,  1583 => 728,  1578 => 726,  1571 => 722,  1566 => 720,  1559 => 716,  1554 => 714,  1543 => 706,  1533 => 699,  1527 => 696,  1522 => 694,  1515 => 690,  1509 => 687,  1504 => 685,  1497 => 681,  1491 => 678,  1486 => 676,  1479 => 672,  1473 => 671,  1468 => 669,  1461 => 665,  1456 => 663,  1449 => 659,  1444 => 657,  1437 => 653,  1433 => 652,  1428 => 650,  1421 => 646,  1416 => 644,  1404 => 635,  1393 => 627,  1377 => 614,  1373 => 613,  1368 => 611,  1359 => 605,  1348 => 597,  1343 => 595,  1334 => 589,  1329 => 587,  1320 => 581,  1315 => 579,  1306 => 573,  1301 => 571,  1292 => 565,  1287 => 563,  1278 => 557,  1273 => 555,  1264 => 549,  1259 => 547,  1250 => 541,  1245 => 539,  1233 => 532,  1227 => 529,  1213 => 518,  1193 => 503,  1186 => 499,  1173 => 489,  1158 => 476,  1154 => 475,  1146 => 474,  1137 => 472,  1130 => 470,  1126 => 469,  1120 => 468,  1116 => 467,  1112 => 466,  1107 => 464,  1102 => 462,  1094 => 456,  1090 => 455,  1082 => 454,  1073 => 452,  1066 => 450,  1062 => 449,  1056 => 448,  1052 => 447,  1048 => 446,  1043 => 444,  1038 => 442,  1030 => 436,  1022 => 435,  1012 => 432,  1005 => 428,  1001 => 427,  997 => 426,  993 => 425,  989 => 424,  985 => 423,  981 => 422,  977 => 421,  973 => 420,  969 => 419,  965 => 418,  958 => 416,  954 => 415,  948 => 414,  944 => 413,  939 => 411,  934 => 409,  926 => 404,  922 => 402,  918 => 401,  910 => 400,  900 => 397,  893 => 393,  889 => 392,  885 => 391,  881 => 390,  877 => 389,  873 => 388,  869 => 387,  865 => 386,  861 => 385,  857 => 384,  853 => 383,  849 => 382,  845 => 381,  839 => 380,  835 => 379,  829 => 378,  825 => 377,  821 => 376,  815 => 373,  809 => 370,  797 => 363,  790 => 359,  782 => 354,  779 => 353,  774 => 352,  770 => 351,  766 => 350,  760 => 349,  755 => 347,  747 => 342,  742 => 340,  731 => 334,  725 => 331,  713 => 322,  695 => 309,  690 => 307,  680 => 302,  675 => 300,  665 => 295,  660 => 293,  650 => 288,  645 => 286,  635 => 281,  630 => 279,  622 => 274,  615 => 272,  609 => 269,  596 => 259,  577 => 245,  571 => 244,  565 => 241,  553 => 234,  546 => 230,  533 => 220,  517 => 206,  509 => 204,  500 => 202,  493 => 200,  489 => 199,  483 => 198,  479 => 197,  473 => 194,  468 => 192,  463 => 190,  451 => 183,  444 => 179,  437 => 174,  429 => 172,  420 => 170,  413 => 168,  409 => 167,  403 => 166,  399 => 165,  393 => 162,  388 => 160,  383 => 158,  371 => 151,  364 => 147,  358 => 143,  350 => 140,  337 => 138,  333 => 137,  329 => 136,  325 => 135,  322 => 134,  318 => 133,  313 => 131,  304 => 125,  300 => 124,  294 => 121,  286 => 116,  281 => 114,  271 => 107,  265 => 104,  255 => 99,  248 => 95,  236 => 88,  229 => 84,  217 => 77,  210 => 73,  199 => 65,  186 => 55,  182 => 54,  178 => 53,  173 => 51,  167 => 47,  161 => 44,  149 => 43,  143 => 42,  139 => 41,  133 => 38,  129 => 37,  123 => 33,  116 => 30,  112 => 29,  109 => 28,  102 => 25,  98 => 24,  88 => 16,  78 => 15,  72 => 14,  67 => 12,  60 => 10,  54 => 9,  48 => 8,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/hbseo/oc3/hb_snippets.twig", "");
    }
}
