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

/* catalog/product_form.twig */
class __TwigTemplate_cfa52e615d2edf5f57395f4db859f4ef2bd5cf9c659458c649a3b77093f56ac2 extends \Twig\Template
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

\t\t\t\t<!-- Product Option Image PRO module << -->
\t\t\t\t";
        // line 5
        if ((($context["poip_installed"]) ?? (false))) {
            // line 6
            echo "\t\t\t\t";
            // line 7
            echo "\t\t\t\t\t
\t\t\t\t\t<script type=\"text/javascript\"><!--
\t\t\t\t\t\t(function(\$){
\t\t\t\t\t\t\t\$().ready(function(){
\t\t\t\t\t\t\t\tpoip.init({
\t\t\t\t\t\t\t\t\tproduct_options \t\t\t\t: ";
            // line 12
            echo json_encode((($context["poip_product_options"]) ?? (false)));
            echo ",
\t\t\t\t\t\t\t\t\toption_values \t\t\t\t\t: ";
            // line 13
            echo json_encode((($context["poip_option_values"]) ?? (false)));
            echo ",
\t\t\t\t\t\t\t\t\ttexts \t\t\t\t\t\t\t: ";
            // line 14
            echo json_encode((($context["poip_texts"]) ?? (false)));
            echo ",
\t\t\t\t\t\t\t\t\tfinal_settings \t\t\t\t\t: ";
            // line 15
            echo json_encode((($context["poip_final_settings"]) ?? (false)));
            echo ",
\t\t\t\t\t\t\t\t\tsettings_details \t\t\t\t: ";
            // line 16
            echo json_encode((($context["poip_settings_details"]) ?? (false)));
            echo ",
\t\t\t\t\t\t\t\t\tsettings_enable_disable_options : ";
            // line 17
            echo json_encode((($context["poip_settings_enable_disable_options"]) ?? (false)));
            echo ",
\t\t\t\t\t\t\t\t\tsaved_settings\t\t\t\t\t: ";
            // line 18
            echo json_encode(($context["poip_saved_settings"] ?? null));
            echo ",
\t\t\t\t\t\t\t\t\tglobal_settings\t\t\t\t\t: ";
            // line 19
            echo json_encode(($context["poip_global_settings"] ?? null));
            echo ",
\t\t\t\t\t\t\t\t\timage_placeholder \t\t\t\t: \"";
            // line 20
            echo ($context["placeholder"] ?? null);
            echo "\",
\t\t\t\t\t\t\t\t\tpoip_main_image_options \t\t: ";
            // line 21
            echo json_encode(($context["poip_main_image_options"] ?? null));
            echo ",
\t\t\t\t\t\t\t\t});
\t\t\t\t\t\t\t});
\t\t\t\t\t\t})(jQuery);\t
\t\t\t\t\t//--></script>
\t\t\t\t\t\t
\t\t\t\t";
        }
        // line 28
        echo "\t\t\t\t<!-- >> Product Option Image PRO module -->
\t\t\t
  <div class=\"page-header\">
    <div class=\"container-fluid\">
      <div class=\"pull-right\">
        <button type=\"submit\" form=\"form-product\" data-toggle=\"tooltip\" title=\"";
        // line 33
        echo ($context["button_save"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-save\"></i></button>
        <a href=\"";
        // line 34
        echo ($context["cancel"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_cancel"] ?? null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-reply\"></i></a></div>
      <h1>";
        // line 35
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      <ul class=\"breadcrumb\">
        ";
        // line 37
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 38
            echo "          <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 38);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 38);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 40
        echo "      </ul>
    </div>
  </div>
  <div class=\"container-fluid\"> ";
        // line 43
        if (($context["error_warning"] ?? null)) {
            // line 44
            echo "      <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
      </div>
    ";
        }
        // line 48
        echo "    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-pencil\"></i> ";
        // line 50
        echo ($context["text_form"] ?? null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
        <form action=\"";
        // line 53
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-product\" class=\"form-horizontal\">
          <ul class=\"nav nav-tabs\">
            <li class=\"active\"><a href=\"#tab-general\" data-toggle=\"tab\">";
        // line 55
        echo ($context["tab_general"] ?? null);
        echo "</a></li>
            <li><a href=\"#tab-data\" data-toggle=\"tab\">";
        // line 56
        echo ($context["tab_data"] ?? null);
        echo "</a></li>
            <li><a href=\"#tab-links\" data-toggle=\"tab\">";
        // line 57
        echo ($context["tab_links"] ?? null);
        echo "</a></li>
         <li><a href=\"#tab-attribute\" data-toggle=\"tab\">";
        // line 58
        echo ($context["tab_attribute"] ?? null);
        echo "</a></li>
            <li><a href=\"#tab-option\" data-toggle=\"tab\">";
        // line 59
        echo ($context["tab_option"] ?? null);
        echo "</a></li>
             <!--   <li><a href=\"#tab-recurring\" data-toggle=\"tab\">";
        // line 60
        echo ($context["tab_recurring"] ?? null);
        echo "</a></li>-->
           
            <li><a href=\"#tab-discount\" data-toggle=\"tab\">";
        // line 62
        echo ($context["tab_discount"] ?? null);
        echo "</a></li>
            <li><a href=\"#tab-special\" data-toggle=\"tab\">";
        // line 63
        echo ($context["tab_special"] ?? null);
        echo "</a></li>
            <li><a href=\"#tab-image\" data-toggle=\"tab\">";
        // line 64
        echo ($context["tab_image"] ?? null);
        echo "</a></li>

               ";
        // line 66
        if (twig_get_attribute($this->env, $this->source, ($context["attachfile"] ?? null), "tab_title", [], "any", false, false, false, 66)) {
            // line 67
            echo "\t\t\t\t    <li><a href=\"#tab-attach-document\" data-toggle=\"tab\">";
            echo twig_get_attribute($this->env, $this->source, ($context["attachfile"] ?? null), "tab_title", [], "any", false, false, false, 67);
            echo "</a></li>
\t\t\t   ";
        }
        // line 69
        echo "              
             <!--   <li><a href=\"#tab-reward\" data-toggle=\"tab\">";
        // line 70
        echo ($context["tab_reward"] ?? null);
        echo "</a></li>-->
          
            <li><a href=\"#tab-seo\" data-toggle=\"tab\">";
        // line 72
        echo ($context["tab_seo"] ?? null);
        echo "</a></li>
            <li><a href=\"#tab-design\" data-toggle=\"tab\">";
        // line 73
        echo ($context["tab_design"] ?? null);
        echo "</a></li>
          </ul>
          <div class=\"tab-content\">
            <div class=\"tab-pane active\" id=\"tab-general\">
              <ul class=\"nav nav-tabs\" id=\"language\">
                ";
        // line 78
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 79
            echo "                  <li><a href=\"#language";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 79);
            echo "\" data-toggle=\"tab\"><img src=\"language/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 79);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 79);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 79);
            echo "\"/> ";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 79);
            echo "</a></li>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 81
        echo "              </ul>
              <div class=\"tab-content\">";
        // line 82
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 83
            echo "                  <div class=\"tab-pane\" id=\"language";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 83);
            echo "\">
                    <div class=\"form-group required\">
                      <label class=\"col-sm-2 control-label\" for=\"input-name";
            // line 85
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 85);
            echo "\">";
            echo ($context["entry_name"] ?? null);
            echo "</label>
                      <div class=\"col-sm-10\">
                        <input type=\"text\" name=\"product_description[";
            // line 87
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 87);
            echo "][name]\" value=\"";
            echo (((($__internal_compile_0 = ($context["product_description"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 87)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_1 = ($context["product_description"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 87)] ?? null) : null), "name", [], "any", false, false, false, 87)) : (""));
            echo "\" placeholder=\"";
            echo ($context["entry_name"] ?? null);
            echo "\" id=\"input-name";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 87);
            echo "\" class=\"form-control\"/>
                        ";
            // line 88
            if ((($__internal_compile_2 = ($context["error_name"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 88)] ?? null) : null)) {
                // line 89
                echo "                          <div class=\"text-danger\">";
                echo (($__internal_compile_3 = ($context["error_name"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 89)] ?? null) : null);
                echo "</div>
                        ";
            }
            // line 90
            echo " </div>
                    </div>
                    <div class=\"form-group\">
                      <label class=\"col-sm-2 control-label\" for=\"input-description";
            // line 93
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 93);
            echo "\">";
            echo ($context["entry_description"] ?? null);
            echo "</label>
                      <div class=\"col-sm-10\">
                        <textarea name=\"product_description[";
            // line 95
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 95);
            echo "][description]\" placeholder=\"";
            echo ($context["entry_description"] ?? null);
            echo "\" id=\"input-description";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 95);
            echo "\" data-toggle=\"summernote\" data-lang=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "locale", [], "any", false, false, false, 95);
            echo "\" class=\"form-control\">";
            echo (((($__internal_compile_4 = ($context["product_description"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 95)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_5 = ($context["product_description"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 95)] ?? null) : null), "description", [], "any", false, false, false, 95)) : (""));
            echo "</textarea>
                      </div>
                    </div>
                    <div class=\"form-group required\">
                      <label class=\"col-sm-2 control-label\" for=\"input-meta-title";
            // line 99
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 99);
            echo "\">";
            echo ($context["entry_meta_title"] ?? null);
            echo "</label>
                      <div class=\"col-sm-10\">
                        <input type=\"text\" name=\"product_description[";
            // line 101
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 101);
            echo "][meta_title]\" value=\"";
            echo (((($__internal_compile_6 = ($context["product_description"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 101)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_7 = ($context["product_description"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 101)] ?? null) : null), "meta_title", [], "any", false, false, false, 101)) : (""));
            echo "\" placeholder=\"";
            echo ($context["entry_meta_title"] ?? null);
            echo "\" id=\"input-meta-title";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 101);
            echo "\" class=\"form-control\"/>
                        ";
            // line 102
            if ((($__internal_compile_8 = ($context["error_meta_title"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 102)] ?? null) : null)) {
                // line 103
                echo "                          <div class=\"text-danger\">";
                echo (($__internal_compile_9 = ($context["error_meta_title"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 103)] ?? null) : null);
                echo "</div>
                        ";
            }
            // line 104
            echo " </div>
                    </div>
                    <div class=\"form-group\">
                      <label class=\"col-sm-2 control-label\" for=\"input-meta-description";
            // line 107
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 107);
            echo "\">";
            echo ($context["entry_meta_description"] ?? null);
            echo "</label>
                      <div class=\"col-sm-10\">
                        <textarea name=\"product_description[";
            // line 109
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 109);
            echo "][meta_description]\" rows=\"5\" placeholder=\"";
            echo ($context["entry_meta_description"] ?? null);
            echo "\" id=\"input-meta-description";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 109);
            echo "\" class=\"form-control\">";
            echo (((($__internal_compile_10 = ($context["product_description"] ?? null)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 109)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_11 = ($context["product_description"] ?? null)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 109)] ?? null) : null), "meta_description", [], "any", false, false, false, 109)) : (""));
            echo "</textarea>
                      </div>
                    </div>
                    <div class=\"form-group\">
                      <label class=\"col-sm-2 control-label\" for=\"input-meta-keyword";
            // line 113
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 113);
            echo "\">";
            echo ($context["entry_meta_keyword"] ?? null);
            echo "</label>
                      <div class=\"col-sm-10\">
                        <textarea name=\"product_description[";
            // line 115
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 115);
            echo "][meta_keyword]\" rows=\"5\" placeholder=\"";
            echo ($context["entry_meta_keyword"] ?? null);
            echo "\" id=\"input-meta-keyword";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 115);
            echo "\" class=\"form-control\">";
            echo (((($__internal_compile_12 = ($context["product_description"] ?? null)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 115)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_13 = ($context["product_description"] ?? null)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 115)] ?? null) : null), "meta_keyword", [], "any", false, false, false, 115)) : (""));
            echo "</textarea>
                      </div>
                    </div>
                    <div class=\"form-group\">

\t\t\t    <label class=\"col-sm-2 control-label\">";
            // line 120
            echo ($context["text_h1"] ?? null);
            echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"product_description[";
            // line 122
            echo (($__internal_compile_14 = $context["language"]) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["language_id"] ?? null) : null);
            echo "][h1]\" value=\"";
            echo ((twig_get_attribute($this->env, $this->source, ($context["product_description"] ?? null), (($__internal_compile_15 = $context["language"]) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["language_id"] ?? null) : null), [], "array", true, true, false, 122)) ? ((($__internal_compile_16 = (($__internal_compile_17 = ($context["product_description"] ?? null)) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17[(($__internal_compile_18 = $context["language"]) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18["language_id"] ?? null) : null)] ?? null) : null)) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16["h1"] ?? null) : null)) : (""));
            echo "\"  class=\"form-control\" />
                </div>
            </div>
\t\t\t  
\t\t    <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
            // line 127
            echo ($context["text_h2"] ?? null);
            echo "</label>
                <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"product_description[";
            // line 129
            echo (($__internal_compile_19 = $context["language"]) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19["language_id"] ?? null) : null);
            echo "][h2]\" value=\"";
            echo ((twig_get_attribute($this->env, $this->source, ($context["product_description"] ?? null), (($__internal_compile_20 = $context["language"]) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20["language_id"] ?? null) : null), [], "array", true, true, false, 129)) ? ((($__internal_compile_21 = (($__internal_compile_22 = ($context["product_description"] ?? null)) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22[(($__internal_compile_23 = $context["language"]) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23["language_id"] ?? null) : null)] ?? null) : null)) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21["h2"] ?? null) : null)) : (""));
            echo "\"  class=\"form-control\" />
                </div>
            </div>
\t\t\t  
\t\t\t<div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
            // line 134
            echo ($context["text_image_alt"] ?? null);
            echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"product_description[";
            // line 136
            echo (($__internal_compile_24 = $context["language"]) && is_array($__internal_compile_24) || $__internal_compile_24 instanceof ArrayAccess ? ($__internal_compile_24["language_id"] ?? null) : null);
            echo "][image_alt]\" value=\"";
            echo ((twig_get_attribute($this->env, $this->source, ($context["product_description"] ?? null), (($__internal_compile_25 = $context["language"]) && is_array($__internal_compile_25) || $__internal_compile_25 instanceof ArrayAccess ? ($__internal_compile_25["language_id"] ?? null) : null), [], "array", true, true, false, 136)) ? ((($__internal_compile_26 = (($__internal_compile_27 = ($context["product_description"] ?? null)) && is_array($__internal_compile_27) || $__internal_compile_27 instanceof ArrayAccess ? ($__internal_compile_27[(($__internal_compile_28 = $context["language"]) && is_array($__internal_compile_28) || $__internal_compile_28 instanceof ArrayAccess ? ($__internal_compile_28["language_id"] ?? null) : null)] ?? null) : null)) && is_array($__internal_compile_26) || $__internal_compile_26 instanceof ArrayAccess ? ($__internal_compile_26["image_alt"] ?? null) : null)) : (""));
            echo "\"  class=\"form-control\" />
                </div>
            </div>
            
            <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
            // line 141
            echo ($context["text_image_title"] ?? null);
            echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"product_description[";
            // line 143
            echo (($__internal_compile_29 = $context["language"]) && is_array($__internal_compile_29) || $__internal_compile_29 instanceof ArrayAccess ? ($__internal_compile_29["language_id"] ?? null) : null);
            echo "][image_title]\" value=\"";
            echo ((twig_get_attribute($this->env, $this->source, ($context["product_description"] ?? null), (($__internal_compile_30 = $context["language"]) && is_array($__internal_compile_30) || $__internal_compile_30 instanceof ArrayAccess ? ($__internal_compile_30["language_id"] ?? null) : null), [], "array", true, true, false, 143)) ? ((($__internal_compile_31 = (($__internal_compile_32 = ($context["product_description"] ?? null)) && is_array($__internal_compile_32) || $__internal_compile_32 instanceof ArrayAccess ? ($__internal_compile_32[(($__internal_compile_33 = $context["language"]) && is_array($__internal_compile_33) || $__internal_compile_33 instanceof ArrayAccess ? ($__internal_compile_33["language_id"] ?? null) : null)] ?? null) : null)) && is_array($__internal_compile_31) || $__internal_compile_31 instanceof ArrayAccess ? ($__internal_compile_31["image_title"] ?? null) : null)) : (""));
            echo "\"  class=\"form-control\" />
                </div>
            </div>
\t\t\t  
\t\t\t<div class=\"form-group\">
\t\t\t
                      <label class=\"col-sm-2 control-label\" for=\"input-tag";
            // line 149
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 149);
            echo "\"><span data-toggle=\"tooltip\" title=\"";
            echo ($context["help_tag"] ?? null);
            echo "\">";
            echo ($context["entry_tag"] ?? null);
            echo "</span></label>
                      <div class=\"col-sm-10\">
                        <input type=\"text\" name=\"product_description[";
            // line 151
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 151);
            echo "][tag]\" value=\"";
            echo (((($__internal_compile_34 = ($context["product_description"] ?? null)) && is_array($__internal_compile_34) || $__internal_compile_34 instanceof ArrayAccess ? ($__internal_compile_34[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 151)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_35 = ($context["product_description"] ?? null)) && is_array($__internal_compile_35) || $__internal_compile_35 instanceof ArrayAccess ? ($__internal_compile_35[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 151)] ?? null) : null), "tag", [], "any", false, false, false, 151)) : (""));
            echo "\" placeholder=\"";
            echo ($context["entry_tag"] ?? null);
            echo "\" id=\"input-tag";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 151);
            echo "\" class=\"form-control\"/>
                      </div>
                    </div>
                  </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 155
        echo "</div>
            </div>
            <div class=\"tab-pane\" id=\"tab-data\">
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-model\">";
        // line 159
        echo ($context["entry_model"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"model\" value=\"";
        // line 161
        echo ($context["model"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_model"] ?? null);
        echo "\" id=\"input-model\" class=\"form-control\"/>
                  ";
        // line 162
        if (($context["error_model"] ?? null)) {
            // line 163
            echo "                    <div class=\"text-danger\">";
            echo ($context["error_model"] ?? null);
            echo "</div>
                  ";
        }
        // line 164
        echo "</div>
              </div>
              <div class=\"form-group\" style=\"display:none\">
                <label class=\"col-sm-2 control-label\" for=\"input-sku\"><span data-toggle=\"tooltip\" title=\"";
        // line 167
        echo ($context["help_sku"] ?? null);
        echo "\">";
        echo ($context["entry_sku"] ?? null);
        echo "</span></label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"sku\" value=\"";
        // line 169
        echo ($context["sku"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_sku"] ?? null);
        echo "\" id=\"input-sku\" class=\"form-control\"/>
                </div>
              </div>
              <div class=\"form-group\" style=\"display:none\">
                <label class=\"col-sm-2 control-label\" for=\"input-upc\"><span data-toggle=\"tooltip\" title=\"";
        // line 173
        echo ($context["help_upc"] ?? null);
        echo "\">";
        echo ($context["entry_upc"] ?? null);
        echo "</span></label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"upc\" value=\"";
        // line 175
        echo ($context["upc"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_upc"] ?? null);
        echo "\" id=\"input-upc\" class=\"form-control\"/>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-ean\"><span data-toggle=\"tooltip\" title=\"";
        // line 179
        echo ($context["help_ean"] ?? null);
        echo "\">";
        echo ($context["entry_ean"] ?? null);
        echo "</span></label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"ean\" value=\"";
        // line 181
        echo ($context["ean"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_ean"] ?? null);
        echo "\" id=\"input-ean\" class=\"form-control\"/>
                </div>
              </div>
              <div class=\"form-group\" style=\"display:none\">
                <label class=\"col-sm-2 control-label\" for=\"input-jan\"><span data-toggle=\"tooltip\" title=\"";
        // line 185
        echo ($context["help_jan"] ?? null);
        echo "\">";
        echo ($context["entry_jan"] ?? null);
        echo "</span></label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"jan\" value=\"";
        // line 187
        echo ($context["jan"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_jan"] ?? null);
        echo "\" id=\"input-jan\" class=\"form-control\"/>
                </div>
              </div>
              <div class=\"form-group\" style=\"display:none\">
                <label class=\"col-sm-2 control-label\" for=\"input-isbn\"><span data-toggle=\"tooltip\" title=\"";
        // line 191
        echo ($context["help_isbn"] ?? null);
        echo "\">";
        echo ($context["entry_isbn"] ?? null);
        echo "</span></label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"isbn\" value=\"";
        // line 193
        echo ($context["isbn"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_isbn"] ?? null);
        echo "\" id=\"input-isbn\" class=\"form-control\"/>
                </div>
              </div>
              <div class=\"form-group\" style=\"display:none\">
                <label class=\"col-sm-2 control-label\" for=\"input-mpn\"><span data-toggle=\"tooltip\" title=\"";
        // line 197
        echo ($context["help_mpn"] ?? null);
        echo "\">";
        echo ($context["entry_mpn"] ?? null);
        echo "</span></label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"mpn\" value=\"";
        // line 199
        echo ($context["mpn"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_mpn"] ?? null);
        echo "\" id=\"input-mpn\" class=\"form-control\"/>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-location\">";
        // line 203
        echo ($context["entry_location"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"location\" value=\"";
        // line 205
        echo ($context["location"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_location"] ?? null);
        echo "\" id=\"input-location\" class=\"form-control\"/>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-price\">";
        // line 209
        echo ($context["entry_price"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"price\" value=\"";
        // line 211
        echo ($context["price"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_price"] ?? null);
        echo "\" id=\"input-price\" class=\"form-control\"/>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-tax-class\">";
        // line 215
        echo ($context["entry_tax_class"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"tax_class_id\" id=\"input-tax-class\" class=\"form-control\">
                    <option value=\"0\">";
        // line 218
        echo ($context["text_none"] ?? null);
        echo "</option>


                    ";
        // line 221
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["tax_classes"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["tax_class"]) {
            // line 222
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["tax_class"], "tax_class_id", [], "any", false, false, false, 222) == ($context["tax_class_id"] ?? null))) {
                // line 223
                echo "

                        <option value=\"";
                // line 225
                echo twig_get_attribute($this->env, $this->source, $context["tax_class"], "tax_class_id", [], "any", false, false, false, 225);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["tax_class"], "title", [], "any", false, false, false, 225);
                echo "</option>


                      ";
            } else {
                // line 229
                echo "

                        <option value=\"";
                // line 231
                echo twig_get_attribute($this->env, $this->source, $context["tax_class"], "tax_class_id", [], "any", false, false, false, 231);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["tax_class"], "title", [], "any", false, false, false, 231);
                echo "</option>


                      ";
            }
            // line 235
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tax_class'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 236
        echo "

                  </select>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-quantity\">";
        // line 242
        echo ($context["entry_quantity"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"quantity\" value=\"";
        // line 244
        echo ($context["quantity"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_quantity"] ?? null);
        echo "\" id=\"input-quantity\" class=\"form-control\"/>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-minimum\"><span data-toggle=\"tooltip\" title=\"";
        // line 248
        echo ($context["help_minimum"] ?? null);
        echo "\">";
        echo ($context["entry_minimum"] ?? null);
        echo "</span></label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"minimum\" value=\"";
        // line 250
        echo ($context["minimum"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_minimum"] ?? null);
        echo "\" id=\"input-minimum\" class=\"form-control\"/>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-subtract\">";
        // line 254
        echo ($context["entry_subtract"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"subtract\" id=\"input-subtract\" class=\"form-control\">


                    ";
        // line 259
        if (($context["subtract"] ?? null)) {
            // line 260
            echo "

                      <option value=\"1\" selected=\"selected\">";
            // line 262
            echo ($context["text_yes"] ?? null);
            echo "</option>
                      <option value=\"0\">";
            // line 263
            echo ($context["text_no"] ?? null);
            echo "</option>


                    ";
        } else {
            // line 267
            echo "

                      <option value=\"1\">";
            // line 269
            echo ($context["text_yes"] ?? null);
            echo "</option>
                      <option value=\"0\" selected=\"selected\">";
            // line 270
            echo ($context["text_no"] ?? null);
            echo "</option>


                    ";
        }
        // line 274
        echo "

                  </select>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-stock-status\"><span data-toggle=\"tooltip\" title=\"";
        // line 280
        echo ($context["help_stock_status"] ?? null);
        echo "\">";
        echo ($context["entry_stock_status"] ?? null);
        echo "</span></label>
                <div class=\"col-sm-10\">
                  <select name=\"stock_status_id\" id=\"input-stock-status\" class=\"form-control\">


                    ";
        // line 285
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stock_statuses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["stock_status"]) {
            // line 286
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["stock_status"], "stock_status_id", [], "any", false, false, false, 286) == ($context["stock_status_id"] ?? null))) {
                // line 287
                echo "

                        <option value=\"";
                // line 289
                echo twig_get_attribute($this->env, $this->source, $context["stock_status"], "stock_status_id", [], "any", false, false, false, 289);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["stock_status"], "name", [], "any", false, false, false, 289);
                echo "</option>


                      ";
            } else {
                // line 293
                echo "

                        <option value=\"";
                // line 295
                echo twig_get_attribute($this->env, $this->source, $context["stock_status"], "stock_status_id", [], "any", false, false, false, 295);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["stock_status"], "name", [], "any", false, false, false, 295);
                echo "</option>


                      ";
            }
            // line 299
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['stock_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 300
        echo "

                  </select>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
        // line 306
        echo ($context["entry_shipping"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <label class=\"radio-inline\"> ";
        // line 308
        if (($context["shipping"] ?? null)) {
            // line 309
            echo "                      <input type=\"radio\" name=\"shipping\" value=\"1\" checked=\"checked\"/>
                      ";
            // line 310
            echo ($context["text_yes"] ?? null);
            echo "
                    ";
        } else {
            // line 312
            echo "                      <input type=\"radio\" name=\"shipping\" value=\"1\"/>
                      ";
            // line 313
            echo ($context["text_yes"] ?? null);
            echo "
                    ";
        }
        // line 314
        echo " </label> <label class=\"radio-inline\"> ";
        if ( !($context["shipping"] ?? null)) {
            // line 315
            echo "                      <input type=\"radio\" name=\"shipping\" value=\"0\" checked=\"checked\"/>
                      ";
            // line 316
            echo ($context["text_no"] ?? null);
            echo "
                    ";
        } else {
            // line 318
            echo "                      <input type=\"radio\" name=\"shipping\" value=\"0\"/>
                      ";
            // line 319
            echo ($context["text_no"] ?? null);
            echo "
                    ";
        }
        // line 320
        echo " </label>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-date-available\">";
        // line 324
        echo ($context["entry_date_available"] ?? null);
        echo "</label>
                <div class=\"col-sm-3\">
                  <div class=\"input-group date\">
                    <input type=\"text\" name=\"date_available\" value=\"";
        // line 327
        echo ($context["date_available"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_date_available"] ?? null);
        echo "\" data-date-format=\"YYYY-MM-DD\" id=\"input-date-available\" class=\"form-control\"/> <span class=\"input-group-btn\">
                    <button class=\"btn btn-default\" type=\"button\"><i class=\"fa fa-calendar\"></i></button>
                    </span></div>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-length\">";
        // line 333
        echo ($context["entry_dimension"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <div class=\"row\">
                    <div class=\"col-sm-4\">
                      <input type=\"text\" name=\"length\" value=\"";
        // line 337
        echo ($context["length"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_length"] ?? null);
        echo "\" id=\"input-length\" class=\"form-control\"/>
                    </div>
                    <div class=\"col-sm-4\">
                      <input type=\"text\" name=\"width\" value=\"";
        // line 340
        echo ($context["width"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_width"] ?? null);
        echo "\" id=\"input-width\" class=\"form-control\"/>
                    </div>
                    <div class=\"col-sm-4\">
                      <input type=\"text\" name=\"height\" value=\"";
        // line 343
        echo ($context["height"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_height"] ?? null);
        echo "\" id=\"input-height\" class=\"form-control\"/>
                    </div>
                  </div>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-length-class\">";
        // line 349
        echo ($context["entry_length_class"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"length_class_id\" id=\"input-length-class\" class=\"form-control\">


                    ";
        // line 354
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["length_classes"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["length_class"]) {
            // line 355
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["length_class"], "length_class_id", [], "any", false, false, false, 355) == ($context["length_class_id"] ?? null))) {
                // line 356
                echo "

                        <option value=\"";
                // line 358
                echo twig_get_attribute($this->env, $this->source, $context["length_class"], "length_class_id", [], "any", false, false, false, 358);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["length_class"], "title", [], "any", false, false, false, 358);
                echo "</option>


                      ";
            } else {
                // line 362
                echo "

                        <option value=\"";
                // line 364
                echo twig_get_attribute($this->env, $this->source, $context["length_class"], "length_class_id", [], "any", false, false, false, 364);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["length_class"], "title", [], "any", false, false, false, 364);
                echo "</option>


                      ";
            }
            // line 368
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['length_class'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 369
        echo "

                  </select>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-weight\">";
        // line 375
        echo ($context["entry_weight"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"weight\" value=\"";
        // line 377
        echo ($context["weight"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_weight"] ?? null);
        echo "\" id=\"input-weight\" class=\"form-control\"/>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-weight-class\">";
        // line 381
        echo ($context["entry_weight_class"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"weight_class_id\" id=\"input-weight-class\" class=\"form-control\">


                    ";
        // line 386
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["weight_classes"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["weight_class"]) {
            // line 387
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["weight_class"], "weight_class_id", [], "any", false, false, false, 387) == ($context["weight_class_id"] ?? null))) {
                // line 388
                echo "

                        <option value=\"";
                // line 390
                echo twig_get_attribute($this->env, $this->source, $context["weight_class"], "weight_class_id", [], "any", false, false, false, 390);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["weight_class"], "title", [], "any", false, false, false, 390);
                echo "</option>


                      ";
            } else {
                // line 394
                echo "

                        <option value=\"";
                // line 396
                echo twig_get_attribute($this->env, $this->source, $context["weight_class"], "weight_class_id", [], "any", false, false, false, 396);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["weight_class"], "title", [], "any", false, false, false, 396);
                echo "</option>


                      ";
            }
            // line 400
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['weight_class'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 401
        echo "

                  </select>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-status\">";
        // line 407
        echo ($context["entry_status"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"status\" id=\"input-status\" class=\"form-control\">


                    ";
        // line 412
        if (($context["status"] ?? null)) {
            // line 413
            echo "

                      <option value=\"1\" selected=\"selected\">";
            // line 415
            echo ($context["text_enabled"] ?? null);
            echo "</option>
                      <option value=\"0\">";
            // line 416
            echo ($context["text_disabled"] ?? null);
            echo "</option>


                    ";
        } else {
            // line 420
            echo "

                      <option value=\"1\">";
            // line 422
            echo ($context["text_enabled"] ?? null);
            echo "</option>
                      <option value=\"0\" selected=\"selected\">";
            // line 423
            echo ($context["text_disabled"] ?? null);
            echo "</option>


                    ";
        }
        // line 427
        echo "

                  </select>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-sort-order\">";
        // line 433
        echo ($context["entry_sort_order"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"sort_order\" value=\"";
        // line 435
        echo ($context["sort_order"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_sort_order"] ?? null);
        echo "\" id=\"input-sort-order\" class=\"form-control\"/>
                </div>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-links\">
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-manufacturer\"><span data-toggle=\"tooltip\" title=\"";
        // line 441
        echo ($context["help_manufacturer"] ?? null);
        echo "\">";
        echo ($context["entry_manufacturer"] ?? null);
        echo "</span></label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"manufacturer\" value=\"";
        // line 443
        echo ($context["manufacturer"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_manufacturer"] ?? null);
        echo "\" id=\"input-manufacturer\" class=\"form-control\"/> <input type=\"hidden\" name=\"manufacturer_id\" value=\"";
        echo ($context["manufacturer_id"] ?? null);
        echo "\"/>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-category\"><span data-toggle=\"tooltip\" title=\"";
        // line 447
        echo ($context["help_category"] ?? null);
        echo "\">";
        echo ($context["entry_category"] ?? null);
        echo "</span></label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"category\" value=\"\" placeholder=\"";
        // line 449
        echo ($context["entry_category"] ?? null);
        echo "\" id=\"input-category\" class=\"form-control\"/>
                  <div id=\"product-category\" class=\"well well-sm\" style=\"height: 150px; overflow: auto;\"> ";
        // line 450
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["product_categories"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["product_category"]) {
            // line 451
            echo "                      <div id=\"product-category";
            echo twig_get_attribute($this->env, $this->source, $context["product_category"], "category_id", [], "any", false, false, false, 451);
            echo "\"><i class=\"fa fa-minus-circle\"></i> ";
            echo twig_get_attribute($this->env, $this->source, $context["product_category"], "name", [], "any", false, false, false, 451);
            echo "
                        <input type=\"hidden\" name=\"product_category[]\" value=\"";
            // line 452
            echo twig_get_attribute($this->env, $this->source, $context["product_category"], "category_id", [], "any", false, false, false, 452);
            echo "\"/>
                      </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product_category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 454
        echo "</div>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-filter\"><span data-toggle=\"tooltip\" title=\"";
        // line 458
        echo ($context["help_filter"] ?? null);
        echo "\">";
        echo ($context["entry_filter"] ?? null);
        echo "</span></label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"filter\" value=\"\" placeholder=\"";
        // line 460
        echo ($context["entry_filter"] ?? null);
        echo "\" id=\"input-filter\" class=\"form-control\"/>
                  <div id=\"product-filter\" class=\"well well-sm\" style=\"height: 150px; overflow: auto;\"> ";
        // line 461
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["product_filters"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["product_filter"]) {
            // line 462
            echo "                      <div id=\"product-filter";
            echo twig_get_attribute($this->env, $this->source, $context["product_filter"], "filter_id", [], "any", false, false, false, 462);
            echo "\"><i class=\"fa fa-minus-circle\"></i> ";
            echo twig_get_attribute($this->env, $this->source, $context["product_filter"], "name", [], "any", false, false, false, 462);
            echo "
                        <input type=\"hidden\" name=\"product_filter[]\" value=\"";
            // line 463
            echo twig_get_attribute($this->env, $this->source, $context["product_filter"], "filter_id", [], "any", false, false, false, 463);
            echo "\"/>
                      </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product_filter'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 465
        echo "</div>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
        // line 469
        echo ($context["entry_store"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <div class=\"well well-sm\" style=\"height: 150px; overflow: auto;\"> ";
        // line 471
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 472
            echo "                      <div class=\"checkbox\">
                        <label> ";
            // line 473
            if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 473), ($context["product_store"] ?? null))) {
                // line 474
                echo "                            <input type=\"checkbox\" name=\"product_store[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 474);
                echo "\" checked=\"checked\"/>
                            ";
                // line 475
                echo twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 475);
                echo "
                          ";
            } else {
                // line 477
                echo "                            <input type=\"checkbox\" name=\"product_store[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 477);
                echo "\"/>
                            ";
                // line 478
                echo twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 478);
                echo "
                          ";
            }
            // line 479
            echo " </label>
                      </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 481
        echo "</div>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-download\"><span data-toggle=\"tooltip\" title=\"";
        // line 485
        echo ($context["help_download"] ?? null);
        echo "\">";
        echo ($context["entry_download"] ?? null);
        echo "</span></label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"download\" value=\"\" placeholder=\"";
        // line 487
        echo ($context["entry_download"] ?? null);
        echo "\" id=\"input-download\" class=\"form-control\"/>
                  <div id=\"product-download\" class=\"well well-sm\" style=\"height: 150px; overflow: auto;\"> ";
        // line 488
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["product_downloads"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["product_download"]) {
            // line 489
            echo "                      <div id=\"product-download";
            echo twig_get_attribute($this->env, $this->source, $context["product_download"], "download_id", [], "any", false, false, false, 489);
            echo "\"><i class=\"fa fa-minus-circle\"></i> ";
            echo twig_get_attribute($this->env, $this->source, $context["product_download"], "name", [], "any", false, false, false, 489);
            echo "
                        <input type=\"hidden\" name=\"product_download[]\" value=\"";
            // line 490
            echo twig_get_attribute($this->env, $this->source, $context["product_download"], "download_id", [], "any", false, false, false, 490);
            echo "\"/>
                      </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product_download'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 492
        echo "</div>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-related\"><span data-toggle=\"tooltip\" title=\"";
        // line 496
        echo ($context["help_related"] ?? null);
        echo "\">";
        echo ($context["entry_related"] ?? null);
        echo "</span></label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"related\" value=\"\" placeholder=\"";
        // line 498
        echo ($context["entry_related"] ?? null);
        echo "\" id=\"input-related\" class=\"form-control\"/>
                  <div id=\"product-related\" class=\"well well-sm\" style=\"height: 150px; overflow: auto;\"> ";
        // line 499
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["product_relateds"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["product_related"]) {
            // line 500
            echo "                      <div id=\"product-related";
            echo twig_get_attribute($this->env, $this->source, $context["product_related"], "product_id", [], "any", false, false, false, 500);
            echo "\"><i class=\"fa fa-minus-circle\"></i> ";
            echo twig_get_attribute($this->env, $this->source, $context["product_related"], "name", [], "any", false, false, false, 500);
            echo "
                        <input type=\"hidden\" name=\"product_related[]\" value=\"";
            // line 501
            echo twig_get_attribute($this->env, $this->source, $context["product_related"], "product_id", [], "any", false, false, false, 501);
            echo "\"/>
                      </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product_related'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 503
        echo "</div>
                </div>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-attribute\">
\t\t
\t\t\t";
        // line 509
        if ((($context["module_atpresets_installed"] ?? null) == 1)) {
            // line 510
            echo "\t\t\t\t<div class=\"form-group\">
\t\t\t\t<div class=\"col-sm-3\">
\t\t\t\t\t<select name=\"attemplate\" id=\"attemplate\" class=\"form-control\" onchange=\"if (\$(this).find(':selected').val()<0) {\$('#attemmplate_button_add').prop('disabled','disabled');\$('#attemmplate_button_replace').prop('disabled','disabled');} else {\$('#attemmplate_button_add').removeAttr('disabled');\$('#attemmplate_button_replace').removeAttr('disabled');}\">
\t\t\t\t\t<option value=\"-1\"></option>\t\t\t\t\t\t\t\t
\t\t\t\t\t";
            // line 514
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["attemplates"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["attemplate"]) {
                echo "\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t<option value=\"";
                // line 515
                echo twig_get_attribute($this->env, $this->source, $context["attemplate"], "attemplate_id", [], "any", false, false, false, 515);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["attemplate"], "name", [], "any", false, false, false, 515);
                echo "</option>
\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attemplate'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 517
            echo "\t\t\t\t  </select>
\t\t\t\t\t<script>

\t\t\t\t\t</script>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-sm-3\">
\t\t\t\t\t<button id=\"attemmplate_button_add\" disabled=\"disabled\" data-loading-text=\"";
            // line 523
            echo ($context["text_loading"] ?? null);
            echo "\" type=\"button\" onclick=\"update_attributes(\$('#attemplate').val(),1);\" data-toggle=\"tooltip\" title=\"";
            echo ($context["help_attemplate_add"] ?? null);
            echo "\" class=\"btn btn-primary\">";
            echo ($context["text_attemplate_add"] ?? null);
            echo "</button>
\t\t\t\t\t<button id=\"attemmplate_button_replace\" disabled=\"disabled\" data-loading-text=\"";
            // line 524
            echo ($context["text_loading"] ?? null);
            echo "\" type=\"button\" onclick=\"update_attributes(\$('#attemplate').val(),2);\" data-toggle=\"tooltip\" title=\"";
            echo ($context["help_attemplate_replace"] ?? null);
            echo "\" class=\"btn btn-primary\">";
            echo ($context["text_attemplate_replace"] ?? null);
            echo "</button>
\t\t\t\t\t<button id=\"attemmplate_button_default\" data-loading-text=\"";
            // line 525
            echo ($context["text_loading"] ?? null);
            echo "\" type=\"button\" onclick=\"update_attributes(\$('#attemplate').val(),0);\" data-toggle=\"tooltip\" title=\"";
            echo ($context["help_attemplate_default"] ?? null);
            echo "\" class=\"btn btn-primary\">";
            echo ($context["text_attemplate_default"] ?? null);
            echo "</button>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-sm-2\">
\t\t\t\t\t<select name=\"attribute_group_id\" id=\"attgroup\" class=\"form-control\" onchange=\"if (\$(this).find(':selected').val()>0) {update_attributes(\$('#attgroup').val(),3);}\">
\t\t\t\t\t<option value=\"-1\">";
            // line 529
            echo ($context["text_add_group"] ?? null);
            echo "</option>\t\t\t\t\t\t\t\t
\t\t\t\t\t";
            // line 530
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["attgroups"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["attgroup"]) {
                echo "\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t<option value=\"";
                // line 531
                echo twig_get_attribute($this->env, $this->source, $context["attgroup"], "attribute_group_id", [], "any", false, false, false, 531);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["attgroup"], "name", [], "any", false, false, false, 531);
                echo "</option>
\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attgroup'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 533
            echo "\t\t\t\t  </select>
\t\t\t\t</div>\t\t\t\t\t
\t\t\t\t<div class=\"col-sm-2\" id=\"new_attemplate_name\">
\t\t\t\t\t<input type=\"text\" name=\"new_attemplate_name\" value=\"\" placeholder=\"";
            // line 536
            echo ($context["text_new_attemplate_name"] ?? null);
            echo "\" class=\"form-control\"/>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-sm-2\">
\t\t\t\t\t<button id=\"attemmplate_button_save\" data-loading-text=\"";
            // line 539
            echo ($context["text_loading"] ?? null);
            echo "\" type=\"button\" onclick=\"save_attemplate();\" data-toggle=\"tooltip\" title=\"";
            echo ($context["help_save_attemplate"] ?? null);
            echo "\" class=\"btn btn-primary\">";
            echo ($context["text_save_attemplate"] ?? null);
            echo "</button>
\t\t\t\t</div>\t\t\t\t\t
\t\t\t\t</div>
\t\t\t";
        }
        // line 543
        echo "\t\t\t
              <div class=\"table-responsive\">
                <table id=\"attribute\" class=\"table table-striped table-bordered table-hover\">
                  <thead>
                    <tr>
                      <td class=\"text-left\">";
        // line 548
        echo ($context["entry_attribute"] ?? null);
        echo "</td>
                      <td class=\"text-left\">";
        // line 549
        echo ($context["entry_text"] ?? null);
        echo "</td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>

                    ";
        // line 555
        $context["attribute_row"] = 0;
        // line 556
        echo "                    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["product_attributes"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["product_attribute"]) {
            // line 557
            echo "                      <tr id=\"attribute-row";
            echo ($context["attribute_row"] ?? null);
            echo "\">
                        
\t\t\t\t\t<td class=\"text-left\" style=\"width: 40%;\"><input type=\"text\" name=\"product_attribute[";
            // line 559
            echo ($context["attribute_row"] ?? null);
            echo "][name]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product_attribute"], "name", [], "any", false, false, false, 559);
            echo "\" placeholder=\"";
            echo ($context["entry_attribute"] ?? null);
            echo "\" class=\"form-control\"/> 
\t\t\t\t\t\t<input type=\"hidden\" name=\"product_attribute[";
            // line 560
            echo ($context["attribute_row"] ?? null);
            echo "][attribute_id]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product_attribute"], "attribute_id", [], "any", false, false, false, 560);
            echo "\" />\t\t\t
\t\t\t\t\t\t";
            // line 561
            if ((($context["module_atpresets_installed"] ?? null) == 1)) {
                // line 562
                echo "\t\t\t\t\t\t\t";
                if ((($context["module_atpresets_selecttype"] ?? null) == 0)) {
                    // line 563
                    echo "\t\t\t\t\t\t\t\t<br><div class=\"test\"><input type=\"text\" name=\"product_attribute[";
                    echo ($context["attribute_row"] ?? null);
                    echo "][preset]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product_attribute"], "preset_esc", [], "any", false, false, false, 563);
                    echo "\" placeholder=\"";
                    echo ($context["text_preset_value"] ?? null);
                    echo "\" class=\"form-control\" />
\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"product_attribute[";
                    // line 564
                    echo ($context["attribute_row"] ?? null);
                    echo "][preset_id][]\" value=\"";
                    if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["product_attribute"], "preset_id", [], "any", false, false, false, 564)) == 1)) {
                        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["product_attribute"], "preset_id", [], "any", false, false, false, 564), 0, [], "any", false, false, false, 564);
                    }
                    echo "\" /></div>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t";
                } else {
                    // line 567
                    echo "\t\t\t\t\t\t\t\t<br><div>
\t\t\t\t\t\t\t\t\t";
                    // line 568
                    if ((($context["module_atpresets_allow_multiple"] ?? null) == 1)) {
                        // line 569
                        echo "\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"allow_multiple";
                        // line 570
                        echo ($context["attribute_row"] ?? null);
                        echo "\" name=\"product_attribute[";
                        echo ($context["attribute_row"] ?? null);
                        echo "][allow_multiple]\"
\t\t\t\t\t\t\t\t\t\t\t";
                        // line 571
                        if ((($__internal_compile_36 = $context["product_attribute"]) && is_array($__internal_compile_36) || $__internal_compile_36 instanceof ArrayAccess ? ($__internal_compile_36["allow_multiple"] ?? null) : null)) {
                            echo "checked=\"checked\"";
                        }
                        // line 572
                        echo "\t\t\t\t\t\t\t\t\t\t\tonchange=\"changeSelectionMode(";
                        echo ($context["attribute_row"] ?? null);
                        echo ");\"/>
\t\t\t\t\t\t\t\t\t\t<label for=\"allow_multiple";
                        // line 573
                        echo ($context["attribute_row"] ?? null);
                        echo "\">";
                        echo ($context["text_allow_multiple"] ?? null);
                        echo "</label>
\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t";
                    }
                    // line 576
                    echo "\t\t\t\t\t\t\t\t\t<select ";
                    if (twig_get_attribute($this->env, $this->source, $context["product_attribute"], "allow_multiple", [], "any", false, false, false, 576)) {
                        echo "multiple style=\"height:200px\"";
                    }
                    echo " alt=\"";
                    echo ($context["attribute_row"] ?? null);
                    echo "\" name=\"product_attribute[";
                    echo ($context["attribute_row"] ?? null);
                    echo "][preset_id][]\" id=\"input-preset";
                    echo ($context["attribute_row"] ?? null);
                    echo "\" class=\"form-control\" onchange=\"select_preset(this);\" onfocus=\"check_attribute(this);\">\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t<option value=\"-1\"></option>\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t";
                    // line 578
                    $context["current_att"] = 0;
                    // line 579
                    echo "\t\t\t\t\t\t\t\t\t";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(($context["all_presets"] ?? null));
                    foreach ($context['_seq'] as $context["_key"] => $context["preset"]) {
                        echo "\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t";
                        // line 580
                        if ((($context["current_att"] ?? null) != twig_get_attribute($this->env, $this->source, $context["preset"], "attribute_id", [], "any", false, false, false, 580))) {
                            $context["current_att"] = twig_get_attribute($this->env, $this->source, $context["preset"], "attribute_id", [], "any", false, false, false, 580);
                            // line 581
                            echo "\t\t\t\t\t\t\t\t\t\t<option color=\"red\" class=\"att";
                            echo ($context["attribute_row"] ?? null);
                            echo " att";
                            echo ($context["attribute_row"] ?? null);
                            echo "-";
                            echo (($__internal_compile_37 = $context["preset"]) && is_array($__internal_compile_37) || $__internal_compile_37 instanceof ArrayAccess ? ($__internal_compile_37["attribute_id"] ?? null) : null);
                            echo "\" value=\"0\" disabled=\"disabled\" style=\"color:red\">";
                            echo twig_get_attribute($this->env, $this->source, $context["preset"], "attribute_name", [], "any", false, false, false, 581);
                            echo "</option>
\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 582
                        echo "\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t";
                        // line 583
                        if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["preset"], "preset_id", [], "any", false, false, false, 583), twig_get_attribute($this->env, $this->source, $context["product_attribute"], "preset_id", [], "any", false, false, false, 583))) {
                            // line 584
                            echo "\t\t\t\t\t\t\t\t\t\t<option alt=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["preset"], "attribute_id", [], "any", false, false, false, 584);
                            echo "\" class=\"pre";
                            echo ($context["attribute_row"] ?? null);
                            echo " pre";
                            echo ($context["attribute_row"] ?? null);
                            echo "-";
                            echo twig_get_attribute($this->env, $this->source, $context["preset"], "attribute_id", [], "any", false, false, false, 584);
                            echo "\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["preset"], "preset_id", [], "any", false, false, false, 584);
                            echo "\" selected=\"selected\">";
                            echo twig_get_attribute($this->env, $this->source, $context["preset"], "text_esc", [], "any", false, false, false, 584);
                            echo "</option>
\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 586
                            echo "\t\t\t\t\t\t\t\t\t\t<option alt=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["preset"], "attribute_id", [], "any", false, false, false, 586);
                            echo "\" class=\"pre";
                            echo ($context["attribute_row"] ?? null);
                            echo " pre";
                            echo ($context["attribute_row"] ?? null);
                            echo "-";
                            echo twig_get_attribute($this->env, $this->source, $context["preset"], "attribute_id", [], "any", false, false, false, 586);
                            echo "\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["preset"], "preset_id", [], "any", false, false, false, 586);
                            echo "\">";
                            echo twig_get_attribute($this->env, $this->source, $context["preset"], "text_esc", [], "any", false, false, false, 586);
                            echo "</option>
\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 588
                        echo "\t\t\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['preset'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 589
                    echo "\t\t\t\t\t\t\t\t  </select>
\t\t\t\t\t\t\t\t<script>

\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\$('.att";
                    // line 593
                    echo ($context["attribute_row"] ?? null);
                    echo "').hide();
\t\t\t\t\t\t\t\t\t\$('.pre";
                    // line 594
                    echo ($context["attribute_row"] ?? null);
                    echo "').hide();
\t\t\t\t\t\t\t\t\t\$('.pre";
                    // line 595
                    echo ($context["attribute_row"] ?? null);
                    echo "-";
                    echo twig_get_attribute($this->env, $this->source, $context["product_attribute"], "attribute_id", [], "any", false, false, false, 595);
                    echo "').show();
\t\t\t\t\t\t\t\t</script>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
                }
                // line 598
                echo "\t\t\t\t\t\t\t
\t\t\t\t\t\t";
            }
            // line 599
            echo "\t\t\t\t\t\t\t
\t\t\t\t\t\t</td>
\t\t\t\t\t
\t\t\t
                        <td class=\"text-left\">";
            // line 603
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 604
                echo "                            <div class=\"input-group\"><span class=\"input-group-addon\"><img src=\"language/";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 604);
                echo "/";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 604);
                echo ".png\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 604);
                echo "\"/></span> <textarea name=\"product_attribute[";
                echo ($context["attribute_row"] ?? null);
                echo "][product_attribute_description][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 604);
                echo "][text]\" rows=\"5\" placeholder=\"";
                echo ($context["entry_text"] ?? null);
                echo "\" class=\"form-control\">";
                echo (((($__internal_compile_38 = twig_get_attribute($this->env, $this->source, $context["product_attribute"], "product_attribute_description", [], "any", false, false, false, 604)) && is_array($__internal_compile_38) || $__internal_compile_38 instanceof ArrayAccess ? ($__internal_compile_38[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 604)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_39 = twig_get_attribute($this->env, $this->source, $context["product_attribute"], "product_attribute_description", [], "any", false, false, false, 604)) && is_array($__internal_compile_39) || $__internal_compile_39 instanceof ArrayAccess ? ($__internal_compile_39[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 604)] ?? null) : null), "text", [], "any", false, false, false, 604)) : (""));
                echo "</textarea>

\t\t\t\t";
                // line 606
                if (((twig_length_filter($this->env, ($context["languages"] ?? null)) > 1) && (($context["module_atpresets_installed"] ?? null) == 1))) {
                    // line 607
                    echo "\t\t\t\t<span onclick=\"copy_values(";
                    echo ($context["attribute_row"] ?? null);
                    echo ",";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 607);
                    echo ");\" class=\"input-group-addon\" style=\"cursor:pointer;cursor:hand;\" title=\"";
                    echo ($context["text_copy_value"] ?? null);
                    echo "\">
\t\t\t\t\t\t<i class=\"fa fa-ellipsis-v\" style=\"font-size: large;\"></i>
\t\t\t\t</span>
\t\t\t\t";
                }
                // line 611
                echo "\t\t\t
                            </div>
                          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 613
            echo "</td>
                        
\t\t\t\t\t\t<td class=\"text-right\">
\t\t\t\t\t\t\t<button type=\"button\" onclick=\"\$('#attribute-row";
            // line 616
            echo ($context["attribute_row"] ?? null);
            echo "').remove();\" data-toggle=\"tooltip\" title=\"";
            echo ($context["button_remove"] ?? null);
            echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button><br>
\t\t\t\t\t\t\t";
            // line 617
            if ((($context["module_atpresets_installed"] ?? null) == 1)) {
                // line 618
                echo "\t\t\t\t\t\t\t<button type=\"button\" onclick=\"add_preset(";
                echo ($context["attribute_row"] ?? null);
                echo ")\" data-toggle=\"tooltip\" title=\"";
                echo ($context["text_new_preset"] ?? null);
                echo "\" class=\"btn btn-primary\" style=\"margin-top:20px;\"><i class=\"fa fa-save\"></i></button>
\t\t\t\t\t\t\t";
            }
            // line 620
            echo "\t\t\t\t\t\t</td>
\t\t\t
                      </tr>
                      ";
            // line 623
            $context["attribute_row"] = (($context["attribute_row"] ?? null) + 1);
            // line 624
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product_attribute'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 625
        echo "                  </tbody>

                  <tfoot>
                    <tr>
                      <td colspan=\"2\"></td>
                      <td class=\"text-right\"><button type=\"button\" onclick=\"addAttribute();\" data-toggle=\"tooltip\" title=\"";
        // line 630
        echo ($context["button_attribute_add"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus-circle\"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-option\">
              <div class=\"row\">
                <div class=\"col-sm-2\">
                  <ul class=\"nav nav-pills nav-stacked\" id=\"option\">
                    ";
        // line 640
        $context["option_row"] = 0;
        // line 641
        echo "                    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["product_options"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["product_option"]) {
            // line 642
            echo "                      <li><a href=\"#tab-option";
            echo ($context["option_row"] ?? null);
            echo "\" data-toggle=\"tab\"><i class=\"fa fa-minus-circle\" onclick=\"\$('a[href=\\'#tab-option";
            echo ($context["option_row"] ?? null);
            echo "\\']').parent().remove(); \$('#tab-option";
            echo ($context["option_row"] ?? null);
            echo "').remove(); \$('#option a:first').tab('show');\"></i> ";
            echo twig_get_attribute($this->env, $this->source, $context["product_option"], "name", [], "any", false, false, false, 642);
            echo "</a></li>
                      ";
            // line 643
            $context["option_row"] = (($context["option_row"] ?? null) + 1);
            // line 644
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product_option'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 645
        echo "                    <li>
                      <input type=\"text\" name=\"option\" value=\"\" placeholder=\"";
        // line 646
        echo ($context["entry_option"] ?? null);
        echo "\" id=\"input-option\" class=\"form-control\"/>
                    </li>
                  </ul>
                </div>
                <div class=\"col-sm-10\">
                  <div class=\"tab-content\"> ";
        // line 651
        $context["option_row"] = 0;
        // line 652
        echo "                    ";
        $context["option_value_row"] = 0;
        // line 653
        echo "                    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["product_options"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["product_option"]) {
            // line 654
            echo "                      <div class=\"tab-pane\" id=\"tab-option";
            echo ($context["option_row"] ?? null);
            echo "\">

\t\t\t\t<!-- // << Product Option Image PRO module -->
\t\t\t\t";
            // line 657
            if ((($context["poip_installed"]) ?? (false))) {
                // line 658
                echo "\t\t\t\t\t<script type=\"text/javascript\"><!--
\t\t\t\t\t\t\$().ready(function(){
\t\t\t\t\t\t\tpoip.displayProductOptionSettings( ";
                // line 660
                echo ($context["option_row"] ?? null);
                echo ", '";
                echo twig_get_attribute($this->env, $this->source, $context["product_option"], "type", [], "any", false, false, false, 660);
                echo "', ";
                echo twig_get_attribute($this->env, $this->source, $context["product_option"], "product_option_id", [], "any", false, false, false, 660);
                echo " );
\t\t\t\t\t\t});
\t\t\t\t\t//--></script>
\t\t\t\t";
            }
            // line 664
            echo "\t\t\t\t<!-- // >> Product Option Image PRO module -->
\t\t\t
                        <input type=\"hidden\" name=\"product_option[";
            // line 666
            echo ($context["option_row"] ?? null);
            echo "][product_option_id]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product_option"], "product_option_id", [], "any", false, false, false, 666);
            echo "\"/> <input type=\"hidden\" name=\"product_option[";
            echo ($context["option_row"] ?? null);
            echo "][name]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product_option"], "name", [], "any", false, false, false, 666);
            echo "\"/> <input type=\"hidden\" name=\"product_option[";
            echo ($context["option_row"] ?? null);
            echo "][option_id]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product_option"], "option_id", [], "any", false, false, false, 666);
            echo "\"/> <input type=\"hidden\" name=\"product_option[";
            echo ($context["option_row"] ?? null);
            echo "][type]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product_option"], "type", [], "any", false, false, false, 666);
            echo "\"/>
                        <div class=\"form-group\">
                          <label class=\"col-sm-2 control-label\" for=\"input-required";
            // line 668
            echo ($context["option_row"] ?? null);
            echo "\">";
            echo ($context["entry_required"] ?? null);
            echo "</label>
                          <div class=\"col-sm-10\">
                            <select name=\"product_option[";
            // line 670
            echo ($context["option_row"] ?? null);
            echo "][required]\" id=\"input-required";
            echo ($context["option_row"] ?? null);
            echo "\" class=\"form-control\">


                              ";
            // line 673
            if (twig_get_attribute($this->env, $this->source, $context["product_option"], "required", [], "any", false, false, false, 673)) {
                // line 674
                echo "

                                <option value=\"1\" selected=\"selected\">";
                // line 676
                echo ($context["text_yes"] ?? null);
                echo "</option>
                                <option value=\"0\">";
                // line 677
                echo ($context["text_no"] ?? null);
                echo "</option>


                              ";
            } else {
                // line 681
                echo "

                                <option value=\"1\">";
                // line 683
                echo ($context["text_yes"] ?? null);
                echo "</option>
                                <option value=\"0\" selected=\"selected\">";
                // line 684
                echo ($context["text_no"] ?? null);
                echo "</option>


                              ";
            }
            // line 688
            echo "

                            </select>
                          </div>
                        </div>
                        ";
            // line 693
            if ((twig_get_attribute($this->env, $this->source, $context["product_option"], "type", [], "any", false, false, false, 693) == "text")) {
                // line 694
                echo "                          <div class=\"form-group\">
                            <label class=\"col-sm-2 control-label\" for=\"input-value";
                // line 695
                echo ($context["option_row"] ?? null);
                echo "\">";
                echo ($context["entry_option_value"] ?? null);
                echo "</label>
                            <div class=\"col-sm-10\">
                              <input type=\"text\" name=\"product_option[";
                // line 697
                echo ($context["option_row"] ?? null);
                echo "][value]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product_option"], "value", [], "any", false, false, false, 697);
                echo "\" placeholder=\"";
                echo ($context["entry_option_value"] ?? null);
                echo "\" id=\"input-value";
                echo ($context["option_row"] ?? null);
                echo "\" class=\"form-control\"/>
                            </div>
                          </div>
                        ";
            }
            // line 701
            echo "                        ";
            if ((twig_get_attribute($this->env, $this->source, $context["product_option"], "type", [], "any", false, false, false, 701) == "textarea")) {
                // line 702
                echo "                          <div class=\"form-group\">
                            <label class=\"col-sm-2 control-label\" for=\"input-value";
                // line 703
                echo ($context["option_row"] ?? null);
                echo "\">";
                echo ($context["entry_option_value"] ?? null);
                echo "</label>
                            <div class=\"col-sm-10\">
                              <textarea name=\"product_option[";
                // line 705
                echo ($context["option_row"] ?? null);
                echo "][value]\" rows=\"5\" placeholder=\"";
                echo ($context["entry_option_value"] ?? null);
                echo "\" id=\"input-value";
                echo ($context["option_row"] ?? null);
                echo "\" class=\"form-control\">";
                echo twig_get_attribute($this->env, $this->source, $context["product_option"], "value", [], "any", false, false, false, 705);
                echo "</textarea>
                            </div>
                          </div>
                        ";
            }
            // line 709
            echo "                        ";
            if ((twig_get_attribute($this->env, $this->source, $context["product_option"], "type", [], "any", false, false, false, 709) == "file")) {
                // line 710
                echo "                          <div class=\"form-group\" style=\"display: none;\">
                            <label class=\"col-sm-2 control-label\" for=\"input-value";
                // line 711
                echo ($context["option_row"] ?? null);
                echo "\">";
                echo ($context["entry_option_value"] ?? null);
                echo "</label>
                            <div class=\"col-sm-10\">
                              <input type=\"text\" name=\"product_option[";
                // line 713
                echo ($context["option_row"] ?? null);
                echo "][value]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product_option"], "value", [], "any", false, false, false, 713);
                echo "\" placeholder=\"";
                echo ($context["entry_option_value"] ?? null);
                echo "\" id=\"input-value";
                echo ($context["option_row"] ?? null);
                echo "\" class=\"form-control\"/>
                            </div>
                          </div>
                        ";
            }
            // line 717
            echo "                        ";
            if ((twig_get_attribute($this->env, $this->source, $context["product_option"], "type", [], "any", false, false, false, 717) == "date")) {
                // line 718
                echo "                          <div class=\"form-group\">
                            <label class=\"col-sm-2 control-label\" for=\"input-value";
                // line 719
                echo ($context["option_row"] ?? null);
                echo "\">";
                echo ($context["entry_option_value"] ?? null);
                echo "</label>
                            <div class=\"col-sm-3\">
                              <div class=\"input-group date\">
                                <input type=\"text\" name=\"product_option[";
                // line 722
                echo ($context["option_row"] ?? null);
                echo "][value]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product_option"], "value", [], "any", false, false, false, 722);
                echo "\" placeholder=\"";
                echo ($context["entry_option_value"] ?? null);
                echo "\" data-date-format=\"YYYY-MM-DD\" id=\"input-value";
                echo ($context["option_row"] ?? null);
                echo "\" class=\"form-control\"/> <span class=\"input-group-btn\">
                            <button class=\"btn btn-default\" type=\"button\"><i class=\"fa fa-calendar\"></i></button>
                            </span></div>
                            </div>
                          </div>
                        ";
            }
            // line 728
            echo "                        ";
            if ((twig_get_attribute($this->env, $this->source, $context["product_option"], "type", [], "any", false, false, false, 728) == "time")) {
                // line 729
                echo "                          <div class=\"form-group\">
                            <label class=\"col-sm-2 control-label\" for=\"input-value";
                // line 730
                echo ($context["option_row"] ?? null);
                echo "\">";
                echo ($context["entry_option_value"] ?? null);
                echo "</label>
                            <div class=\"col-sm-10\">
                              <div class=\"input-group time\">
                                <input type=\"text\" name=\"product_option[";
                // line 733
                echo ($context["option_row"] ?? null);
                echo "][value]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product_option"], "value", [], "any", false, false, false, 733);
                echo "\" placeholder=\"";
                echo ($context["entry_option_value"] ?? null);
                echo "\" data-date-format=\"HH:mm\" id=\"input-value";
                echo ($context["option_row"] ?? null);
                echo "\" class=\"form-control\"/> <span class=\"input-group-btn\">
                            <button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button>
                            </span></div>
                            </div>
                          </div>
                        ";
            }
            // line 739
            echo "                        ";
            if ((twig_get_attribute($this->env, $this->source, $context["product_option"], "type", [], "any", false, false, false, 739) == "datetime")) {
                // line 740
                echo "                          <div class=\"form-group\">
                            <label class=\"col-sm-2 control-label\" for=\"input-value";
                // line 741
                echo ($context["option_row"] ?? null);
                echo "\">";
                echo ($context["entry_option_value"] ?? null);
                echo "</label>
                            <div class=\"col-sm-10\">
                              <div class=\"input-group datetime\">
                                <input type=\"text\" name=\"product_option[";
                // line 744
                echo ($context["option_row"] ?? null);
                echo "][value]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product_option"], "value", [], "any", false, false, false, 744);
                echo "\" placeholder=\"";
                echo ($context["entry_option_value"] ?? null);
                echo "\" data-date-format=\"YYYY-MM-DD HH:mm\" id=\"input-value";
                echo ($context["option_row"] ?? null);
                echo "\" class=\"form-control\"/> <span class=\"input-group-btn\">
                            <button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button>
                            </span></div>
                            </div>
                          </div>
                        ";
            }
            // line 750
            echo "                        ";
            if (((((twig_get_attribute($this->env, $this->source, $context["product_option"], "type", [], "any", false, false, false, 750) == "select") || (twig_get_attribute($this->env, $this->source, $context["product_option"], "type", [], "any", false, false, false, 750) == "radio")) || (twig_get_attribute($this->env, $this->source, $context["product_option"], "type", [], "any", false, false, false, 750) == "checkbox")) || (twig_get_attribute($this->env, $this->source, $context["product_option"], "type", [], "any", false, false, false, 750) == "image"))) {
                // line 751
                echo "                          <div class=\"table-responsive\">
                            <table id=\"option-value";
                // line 752
                echo ($context["option_row"] ?? null);
                echo "\" class=\"table table-striped table-bordered table-hover\">
                              <thead>
                                <tr>
                                  <td class=\"text-left\">";
                // line 755
                echo ($context["entry_option_value"] ?? null);
                echo "</td>
                                  <td class=\"text-right\">";
                // line 756
                echo ($context["entry_quantity"] ?? null);
                echo "</td>
                                  <td class=\"text-left\">";
                // line 757
                echo ($context["entry_subtract"] ?? null);
                echo "</td>
                                  <td class=\"text-right\">";
                // line 758
                echo ($context["entry_price"] ?? null);
                echo "</td>
                                  <td class=\"text-right\">";
                // line 759
                echo ($context["entry_option_points"] ?? null);
                echo "</td>
                                  <td class=\"text-right\">";
                // line 760
                echo ($context["entry_weight"] ?? null);
                echo "</td> ";
                if (((($context["poip_installed"]) ?? (false)) &&  !(($__internal_compile_40 = ($context["poip_global_settings"] ?? null)) && is_array($__internal_compile_40) || $__internal_compile_40 instanceof ArrayAccess ? ($__internal_compile_40["options_images_edit"] ?? null) : null))) {
                    echo " <td class=\"text-left poip-container-option-images\" >";
                    echo ($context["entry_image"] ?? null);
                    echo "</td>";
                }
                // line 761
                echo "                                  <td></td>
                                </tr>
                              </thead>
                              <tbody>

                                ";
                // line 766
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["product_option"], "product_option_value", [], "any", false, false, false, 766));
                foreach ($context['_seq'] as $context["_key"] => $context["product_option_value"]) {
                    // line 767
                    echo "                                  <tr id=\"option-value-row";
                    echo ($context["option_value_row"] ?? null);
                    echo "\">
                                    <td class=\"text-left\"><select name=\"product_option[";
                    // line 768
                    echo ($context["option_row"] ?? null);
                    echo "][product_option_value][";
                    echo ($context["option_value_row"] ?? null);
                    echo "][option_value_id]\" class=\"form-control\">


                                        ";
                    // line 771
                    if ((($__internal_compile_41 = ($context["option_values"] ?? null)) && is_array($__internal_compile_41) || $__internal_compile_41 instanceof ArrayAccess ? ($__internal_compile_41[twig_get_attribute($this->env, $this->source, $context["product_option"], "option_id", [], "any", false, false, false, 771)] ?? null) : null)) {
                        // line 772
                        echo "
                                          ";
                        // line 773
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable((($__internal_compile_42 = ($context["option_values"] ?? null)) && is_array($__internal_compile_42) || $__internal_compile_42 instanceof ArrayAccess ? ($__internal_compile_42[twig_get_attribute($this->env, $this->source, $context["product_option"], "option_id", [], "any", false, false, false, 773)] ?? null) : null));
                        foreach ($context['_seq'] as $context["_key"] => $context["option_value"]) {
                            // line 774
                            echo "
                                            ";
                            // line 775
                            if ((twig_get_attribute($this->env, $this->source, $context["option_value"], "option_value_id", [], "any", false, false, false, 775) == twig_get_attribute($this->env, $this->source, $context["product_option_value"], "option_value_id", [], "any", false, false, false, 775))) {
                                // line 776
                                echo "

                                              <option value=\"";
                                // line 778
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "option_value_id", [], "any", false, false, false, 778);
                                echo "\" selected=\"selected\">";
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 778);
                                echo "</option>


                                            ";
                            } else {
                                // line 782
                                echo "

                                              <option value=\"";
                                // line 784
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "option_value_id", [], "any", false, false, false, 784);
                                echo "\">";
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 784);
                                echo "</option>


                                            ";
                            }
                            // line 788
                            echo "                                          ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option_value'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 789
                        echo "                                        ";
                    }
                    // line 790
                    echo "

                                      </select> <input type=\"hidden\" name=\"product_option[";
                    // line 792
                    echo ($context["option_row"] ?? null);
                    echo "][product_option_value][";
                    echo ($context["option_value_row"] ?? null);
                    echo "][product_option_value_id]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product_option_value"], "product_option_value_id", [], "any", false, false, false, 792);
                    echo "\"/></td>
                                    <td class=\"text-right\"><input type=\"text\" name=\"product_option[";
                    // line 793
                    echo ($context["option_row"] ?? null);
                    echo "][product_option_value][";
                    echo ($context["option_value_row"] ?? null);
                    echo "][quantity]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product_option_value"], "quantity", [], "any", false, false, false, 793);
                    echo "\" placeholder=\"";
                    echo ($context["entry_quantity"] ?? null);
                    echo "\" class=\"form-control\"/></td>
                                    <td class=\"text-left\"><select name=\"product_option[";
                    // line 794
                    echo ($context["option_row"] ?? null);
                    echo "][product_option_value][";
                    echo ($context["option_value_row"] ?? null);
                    echo "][subtract]\" class=\"form-control\">


                                        ";
                    // line 797
                    if (twig_get_attribute($this->env, $this->source, $context["product_option_value"], "subtract", [], "any", false, false, false, 797)) {
                        // line 798
                        echo "

                                          <option value=\"1\" selected=\"selected\">";
                        // line 800
                        echo ($context["text_yes"] ?? null);
                        echo "</option>
                                          <option value=\"0\">";
                        // line 801
                        echo ($context["text_no"] ?? null);
                        echo "</option>


                                        ";
                    } else {
                        // line 805
                        echo "

                                          <option value=\"1\">";
                        // line 807
                        echo ($context["text_yes"] ?? null);
                        echo "</option>
                                          <option value=\"0\" selected=\"selected\">";
                        // line 808
                        echo ($context["text_no"] ?? null);
                        echo "</option>


                                        ";
                    }
                    // line 812
                    echo "

                                      </select></td>
                                    <td class=\"text-right\"><select name=\"product_option[";
                    // line 815
                    echo ($context["option_row"] ?? null);
                    echo "][product_option_value][";
                    echo ($context["option_value_row"] ?? null);
                    echo "][price_prefix]\" class=\"form-control\">


                                        ";
                    // line 818
                    if ((twig_get_attribute($this->env, $this->source, $context["product_option_value"], "price_prefix", [], "any", false, false, false, 818) == "+")) {
                        // line 819
                        echo "

                                          <option value=\"+\" selected=\"selected\">+</option>


                                        ";
                    } else {
                        // line 825
                        echo "

                                          <option value=\"+\">+</option>


                                        ";
                    }
                    // line 831
                    echo "                                        ";
                    if ((twig_get_attribute($this->env, $this->source, $context["product_option_value"], "price_prefix", [], "any", false, false, false, 831) == "-")) {
                        // line 832
                        echo "

                                          <option value=\"-\" selected=\"selected\">-</option>


                                        ";
                    } else {
                        // line 838
                        echo "

                                          <option value=\"-\">-</option>


                                        ";
                    }
                    // line 844
                    echo "

                                      </select> <input type=\"text\" name=\"product_option[";
                    // line 846
                    echo ($context["option_row"] ?? null);
                    echo "][product_option_value][";
                    echo ($context["option_value_row"] ?? null);
                    echo "][price]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product_option_value"], "price", [], "any", false, false, false, 846);
                    echo "\" placeholder=\"";
                    echo ($context["entry_price"] ?? null);
                    echo "\" class=\"form-control\"/></td>
                                    <td class=\"text-right\"><select name=\"product_option[";
                    // line 847
                    echo ($context["option_row"] ?? null);
                    echo "][product_option_value][";
                    echo ($context["option_value_row"] ?? null);
                    echo "][points_prefix]\" class=\"form-control\">


                                        ";
                    // line 850
                    if ((twig_get_attribute($this->env, $this->source, $context["product_option_value"], "points_prefix", [], "any", false, false, false, 850) == "+")) {
                        // line 851
                        echo "

                                          <option value=\"+\" selected=\"selected\">+</option>


                                        ";
                    } else {
                        // line 857
                        echo "

                                          <option value=\"+\">+</option>


                                        ";
                    }
                    // line 863
                    echo "                                        ";
                    if ((twig_get_attribute($this->env, $this->source, $context["product_option_value"], "points_prefix", [], "any", false, false, false, 863) == "-")) {
                        // line 864
                        echo "

                                          <option value=\"-\" selected=\"selected\">-</option>


                                        ";
                    } else {
                        // line 870
                        echo "

                                          <option value=\"-\">-</option>


                                        ";
                    }
                    // line 876
                    echo "

                                      </select> <input type=\"text\" name=\"product_option[";
                    // line 878
                    echo ($context["option_row"] ?? null);
                    echo "][product_option_value][";
                    echo ($context["option_value_row"] ?? null);
                    echo "][points]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product_option_value"], "points", [], "any", false, false, false, 878);
                    echo "\" placeholder=\"";
                    echo ($context["entry_points"] ?? null);
                    echo "\" class=\"form-control\"/></td>
                                    <td class=\"text-right\"><select name=\"product_option[";
                    // line 879
                    echo ($context["option_row"] ?? null);
                    echo "][product_option_value][";
                    echo ($context["option_value_row"] ?? null);
                    echo "][weight_prefix]\" class=\"form-control\">


                                        ";
                    // line 882
                    if ((twig_get_attribute($this->env, $this->source, $context["product_option_value"], "weight_prefix", [], "any", false, false, false, 882) == "+")) {
                        // line 883
                        echo "

                                          <option value=\"+\" selected=\"selected\">+</option>


                                        ";
                    } else {
                        // line 889
                        echo "

                                          <option value=\"+\">+</option>


                                        ";
                    }
                    // line 895
                    echo "                                        ";
                    if ((twig_get_attribute($this->env, $this->source, $context["product_option_value"], "weight_prefix", [], "any", false, false, false, 895) == "-")) {
                        // line 896
                        echo "

                                          <option value=\"-\" selected=\"selected\">-</option>


                                        ";
                    } else {
                        // line 902
                        echo "

                                          <option value=\"-\">-</option>


                                        ";
                    }
                    // line 908
                    echo "

                                      </select> <input type=\"text\" name=\"product_option[";
                    // line 910
                    echo ($context["option_row"] ?? null);
                    echo "][product_option_value][";
                    echo ($context["option_value_row"] ?? null);
                    echo "][weight]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product_option_value"], "weight", [], "any", false, false, false, 910);
                    echo "\" placeholder=\"";
                    echo ($context["entry_weight"] ?? null);
                    echo "\" class=\"form-control\"/></td>

\t\t\t\t<!-- << Product Option Image PRO module -->
\t\t\t\t";
                    // line 913
                    if (((($context["poip_installed"]) ?? (false)) &&  !(($__internal_compile_43 = ($context["poip_global_settings"] ?? null)) && is_array($__internal_compile_43) || $__internal_compile_43 instanceof ArrayAccess ? ($__internal_compile_43["options_images_edit"] ?? null) : null))) {
                        // line 914
                        echo "\t\t\t\t\t";
                        if ((((twig_get_attribute($this->env, $this->source, $context["product_option_value"], "images", [], "array", true, true, false, 914) &&  !(null === (($__internal_compile_44 = $context["product_option_value"]) && is_array($__internal_compile_44) || $__internal_compile_44 instanceof ArrayAccess ? ($__internal_compile_44["images"] ?? null) : null)))) ? ((($__internal_compile_45 = $context["product_option_value"]) && is_array($__internal_compile_45) || $__internal_compile_45 instanceof ArrayAccess ? ($__internal_compile_45["images"] ?? null) : null)) : (false))) {
                            // line 915
                            echo "\t\t\t\t\t\t<script type=\"text/javascript\"><!--
\t\t\t\t\t\t\t";
                            // line 916
                            $context['_parent'] = $context;
                            $context['_seq'] = twig_ensure_traversable((($__internal_compile_46 = $context["product_option_value"]) && is_array($__internal_compile_46) || $__internal_compile_46 instanceof ArrayAccess ? ($__internal_compile_46["images"] ?? null) : null));
                            foreach ($context['_seq'] as $context["_key"] => $context["pov_image"]) {
                                // line 917
                                echo "\t\t\t\t\t\t\t\tpoip.addProductOptionImage( ";
                                echo ($context["option_row"] ?? null);
                                echo ", ";
                                echo ($context["option_value_row"] ?? null);
                                echo ", '";
                                echo (($__internal_compile_47 = $context["pov_image"]) && is_array($__internal_compile_47) || $__internal_compile_47 instanceof ArrayAccess ? ($__internal_compile_47["thumb"] ?? null) : null);
                                echo "', '";
                                echo (($__internal_compile_48 = $context["pov_image"]) && is_array($__internal_compile_48) || $__internal_compile_48 instanceof ArrayAccess ? ($__internal_compile_48["image"] ?? null) : null);
                                echo "', ";
                                echo (($__internal_compile_49 = $context["pov_image"]) && is_array($__internal_compile_49) || $__internal_compile_49 instanceof ArrayAccess ? ($__internal_compile_49["srt"] ?? null) : null);
                                echo " );
\t\t\t\t\t\t\t";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pov_image'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 919
                            echo "\t\t\t\t\t\t//--></script>
\t\t\t\t\t";
                        }
                        // line 921
                        echo "\t\t\t\t\t<td>
\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-default\" onclick=\"poip.addProductOptionImage(";
                        // line 922
                        echo ($context["option_row"] ?? null);
                        echo ", ";
                        echo ($context["option_value_row"] ?? null);
                        echo " )\" title=\"";
                        echo ($context["button_image_add"] ?? null);
                        echo "\">
\t\t\t\t\t\t\t<i class=\"fa fa-plus-circle\"></i>
\t\t\t\t\t\t</button>
\t\t\t\t\t\t";
                        // line 925
                        if ((($context["poip_version_ultimate"]) ?? (false))) {
                            // line 926
                            echo "\t\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-default\" onclick=\"poiu.openImageFilemanager(\$(this), 'option_images";
                            echo ($context["option_row"] ?? null);
                            echo "_";
                            echo ($context["option_value_row"] ?? null);
                            echo "', '')\" title=\"";
                            echo ($context["button_add_images"] ?? null);
                            echo "\">
\t\t\t\t\t\t\t\t<i class=\"fa fa-plus-circle\"></i><i class=\"fa fa-plus-circle\"></i>
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t";
                        }
                        // line 930
                        echo "\t\t\t\t\t\t<div id=\"option_images";
                        echo ($context["option_row"] ?? null);
                        echo "_";
                        echo ($context["option_value_row"] ?? null);
                        echo "\" data-poip-option-row=\"";
                        echo ($context["option_row"] ?? null);
                        echo "\" data-poip-option-value-row=\"";
                        echo ($context["option_value_row"] ?? null);
                        echo "\" class=\"poip-option-images-grid\"></div>
\t\t\t\t\t</td>
\t\t\t\t";
                    }
                    // line 933
                    echo "\t\t\t\t<!-- >> Product Option Image PRO module -->
\t\t\t
                                    <td class=\"text-right\"><button type=\"button\" onclick=\"\$(this).tooltip('destroy');\$('#option-value-row";
                    // line 935
                    echo ($context["option_value_row"] ?? null);
                    echo "').remove();\" data-toggle=\"tooltip\" title=\"";
                    echo ($context["button_remove"] ?? null);
                    echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>
                                  </tr>
                                  ";
                    // line 937
                    $context["option_value_row"] = (($context["option_value_row"] ?? null) + 1);
                    // line 938
                    echo "                                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product_option_value'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 939
                echo "                              </tbody>

                              <tfoot>
                                <tr>
                                  <td colspan=\"6\"></td>
                                  ";
                // line 944
                if (((($context["poip_installed"]) ?? (false)) &&  !(($__internal_compile_50 = ($context["poip_global_settings"] ?? null)) && is_array($__internal_compile_50) || $__internal_compile_50 instanceof ArrayAccess ? ($__internal_compile_50["options_images_edit"] ?? null) : null))) {
                    echo "<td></td>";
                }
                echo "<td class=\"text-left\"><button type=\"button\" onclick=\"addOptionValue('";
                echo ($context["option_row"] ?? null);
                echo "');\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_option_value_add"] ?? null);
                echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus-circle\"></i></button></td>
                                </tr>
                              </tfoot>
                            </table>
                          </div>
                          <select id=\"option-values";
                // line 949
                echo ($context["option_row"] ?? null);
                echo "\" style=\"display: none;\">


                            ";
                // line 952
                if ((($__internal_compile_51 = ($context["option_values"] ?? null)) && is_array($__internal_compile_51) || $__internal_compile_51 instanceof ArrayAccess ? ($__internal_compile_51[twig_get_attribute($this->env, $this->source, $context["product_option"], "option_id", [], "any", false, false, false, 952)] ?? null) : null)) {
                    // line 953
                    echo "                              ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable((($__internal_compile_52 = ($context["option_values"] ?? null)) && is_array($__internal_compile_52) || $__internal_compile_52 instanceof ArrayAccess ? ($__internal_compile_52[twig_get_attribute($this->env, $this->source, $context["product_option"], "option_id", [], "any", false, false, false, 953)] ?? null) : null));
                    foreach ($context['_seq'] as $context["_key"] => $context["option_value"]) {
                        // line 954
                        echo "

                                <option value=\"";
                        // line 956
                        echo twig_get_attribute($this->env, $this->source, $context["option_value"], "option_value_id", [], "any", false, false, false, 956);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 956);
                        echo "</option>


                              ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 960
                    echo "                            ";
                }
                // line 961
                echo "

                          </select>
                        ";
            }
            // line 964
            echo " </div>
                      ";
            // line 965
            $context["option_row"] = (($context["option_row"] ?? null) + 1);
            // line 966
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product_option'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo " </div>
                </div>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-recurring\">
              <div class=\"table-responsive\">
                <table class=\"table table-striped table-bordered table-hover\">
                  <thead>
                    <tr>
                      <td class=\"text-left\">";
        // line 975
        echo ($context["entry_recurring"] ?? null);
        echo "</td>
                      <td class=\"text-left\">";
        // line 976
        echo ($context["entry_customer_group"] ?? null);
        echo "</td>
                      <td class=\"text-left\"></td>
                    </tr>
                  </thead>
                  <tbody>

                    ";
        // line 982
        $context["recurring_row"] = 0;
        // line 983
        echo "                    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["product_recurrings"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["product_recurring"]) {
            // line 984
            echo "                      <tr id=\"recurring-row";
            echo ($context["recurring_row"] ?? null);
            echo "\">
                        <td class=\"text-left\"><select name=\"product_recurring[";
            // line 985
            echo ($context["recurring_row"] ?? null);
            echo "][recurring_id]\" class=\"form-control\">


                            ";
            // line 988
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["recurrings"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["recurring"]) {
                // line 989
                echo "                              ";
                if ((twig_get_attribute($this->env, $this->source, $context["recurring"], "recurring_id", [], "any", false, false, false, 989) == twig_get_attribute($this->env, $this->source, $context["product_recurring"], "recurring_id", [], "any", false, false, false, 989))) {
                    // line 990
                    echo "

                                <option value=\"";
                    // line 992
                    echo twig_get_attribute($this->env, $this->source, $context["recurring"], "recurring_id", [], "any", false, false, false, 992);
                    echo "\" selected=\"selected\">";
                    echo twig_get_attribute($this->env, $this->source, $context["recurring"], "name", [], "any", false, false, false, 992);
                    echo "</option>


                              ";
                } else {
                    // line 996
                    echo "

                                <option value=\"";
                    // line 998
                    echo twig_get_attribute($this->env, $this->source, $context["recurring"], "recurring_id", [], "any", false, false, false, 998);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["recurring"], "name", [], "any", false, false, false, 998);
                    echo "</option>


                              ";
                }
                // line 1002
                echo "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['recurring'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 1003
            echo "

                          </select></td>
                        <td class=\"text-left\"><select name=\"product_recurring[";
            // line 1006
            echo ($context["recurring_row"] ?? null);
            echo "][customer_group_id]\" class=\"form-control\">


                            ";
            // line 1009
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["customer_groups"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["customer_group"]) {
                // line 1010
                echo "                              ";
                if ((twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 1010) == twig_get_attribute($this->env, $this->source, $context["product_recurring"], "customer_group_id", [], "any", false, false, false, 1010))) {
                    // line 1011
                    echo "

                                <option value=\"";
                    // line 1013
                    echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 1013);
                    echo "\" selected=\"selected\">";
                    echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 1013);
                    echo "</option>


                              ";
                } else {
                    // line 1017
                    echo "

                                <option value=\"";
                    // line 1019
                    echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 1019);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 1019);
                    echo "</option>


                              ";
                }
                // line 1023
                echo "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['customer_group'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 1024
            echo "

                          </select></td>
                        <td class=\"text-left\"><button type=\"button\" onclick=\"\$('#recurring-row";
            // line 1027
            echo ($context["recurring_row"] ?? null);
            echo "').remove()\" data-toggle=\"tooltip\" title=\"";
            echo ($context["button_remove"] ?? null);
            echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>
                      </tr>
                      ";
            // line 1029
            $context["recurring_row"] = (($context["recurring_row"] ?? null) + 1);
            // line 1030
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product_recurring'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1031
        echo "                  </tbody>

                  <tfoot>
                    <tr>
                      <td colspan=\"2\"></td>
                      <td class=\"text-left\"><button type=\"button\" onclick=\"addRecurring()\" data-toggle=\"tooltip\" title=\"";
        // line 1036
        echo ($context["button_recurring_add"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus-circle\"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-discount\">
              <div class=\"table-responsive\">
                <table id=\"discount\" class=\"table table-striped table-bordered table-hover\">
                  <thead>
                    <tr>
                      <td class=\"text-left\">";
        // line 1047
        echo ($context["entry_customer_group"] ?? null);
        echo "</td>
                      <td class=\"text-right\">";
        // line 1048
        echo ($context["entry_quantity"] ?? null);
        echo "</td>
                      <td class=\"text-right\">";
        // line 1049
        echo ($context["entry_priority"] ?? null);
        echo "</td>
                      <td class=\"text-right\">";
        // line 1050
        echo ($context["entry_price"] ?? null);
        echo "</td>
                      <td class=\"text-left\">";
        // line 1051
        echo ($context["entry_date_start"] ?? null);
        echo "</td>
                      <td class=\"text-left\">";
        // line 1052
        echo ($context["entry_date_end"] ?? null);
        echo "</td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>

                    ";
        // line 1058
        $context["discount_row"] = 0;
        // line 1059
        echo "                    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["product_discounts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["product_discount"]) {
            // line 1060
            echo "                      <tr id=\"discount-row";
            echo ($context["discount_row"] ?? null);
            echo "\">
                        <td class=\"text-left\"><select name=\"product_discount[";
            // line 1061
            echo ($context["discount_row"] ?? null);
            echo "][customer_group_id]\" class=\"form-control\">
                            ";
            // line 1062
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["customer_groups"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["customer_group"]) {
                // line 1063
                echo "                              ";
                if ((twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 1063) == twig_get_attribute($this->env, $this->source, $context["product_discount"], "customer_group_id", [], "any", false, false, false, 1063))) {
                    // line 1064
                    echo "                                <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 1064);
                    echo "\" selected=\"selected\">";
                    echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 1064);
                    echo "</option>
                              ";
                } else {
                    // line 1066
                    echo "                                <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 1066);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 1066);
                    echo "</option>
                              ";
                }
                // line 1068
                echo "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['customer_group'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 1069
            echo "                          </select></td>
                        <td class=\"text-right\"><input type=\"text\" name=\"product_discount[";
            // line 1070
            echo ($context["discount_row"] ?? null);
            echo "][quantity]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product_discount"], "quantity", [], "any", false, false, false, 1070);
            echo "\" placeholder=\"";
            echo ($context["entry_quantity"] ?? null);
            echo "\" class=\"form-control\"/></td>
                        <td class=\"text-right\"><input type=\"text\" name=\"product_discount[";
            // line 1071
            echo ($context["discount_row"] ?? null);
            echo "][priority]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product_discount"], "priority", [], "any", false, false, false, 1071);
            echo "\" placeholder=\"";
            echo ($context["entry_priority"] ?? null);
            echo "\" class=\"form-control\"/></td>
                        <td class=\"text-right\"><input type=\"text\" name=\"product_discount[";
            // line 1072
            echo ($context["discount_row"] ?? null);
            echo "][price]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product_discount"], "price", [], "any", false, false, false, 1072);
            echo "\" placeholder=\"";
            echo ($context["entry_price"] ?? null);
            echo "\" class=\"form-control\"/></td>
                        <td class=\"text-left\" style=\"width: 20%;\">
                          <div class=\"input-group date\">
                            <input type=\"text\" name=\"product_discount[";
            // line 1075
            echo ($context["discount_row"] ?? null);
            echo "][date_start]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product_discount"], "date_start", [], "any", false, false, false, 1075);
            echo "\" placeholder=\"";
            echo ($context["entry_date_start"] ?? null);
            echo "\" data-date-format=\"YYYY-MM-DD\" class=\"form-control\"/> <span class=\"input-group-btn\">
                        <button class=\"btn btn-default\" type=\"button\"><i class=\"fa fa-calendar\"></i></button>
                        </span></div>
                        </td>
                        <td class=\"text-left\" style=\"width: 20%;\">
                          <div class=\"input-group date\">
                            <input type=\"text\" name=\"product_discount[";
            // line 1081
            echo ($context["discount_row"] ?? null);
            echo "][date_end]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product_discount"], "date_end", [], "any", false, false, false, 1081);
            echo "\" placeholder=\"";
            echo ($context["entry_date_end"] ?? null);
            echo "\" data-date-format=\"YYYY-MM-DD\" class=\"form-control\"/> <span class=\"input-group-btn\">
                        <button class=\"btn btn-default\" type=\"button\"><i class=\"fa fa-calendar\"></i></button>
                        </span></div>
                        </td>
                        <td class=\"text-left\"><button type=\"button\" onclick=\"\$('#discount-row";
            // line 1085
            echo ($context["discount_row"] ?? null);
            echo "').remove();\" data-toggle=\"tooltip\" title=\"";
            echo ($context["button_remove"] ?? null);
            echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>
                      </tr>
                      ";
            // line 1087
            $context["discount_row"] = (($context["discount_row"] ?? null) + 1);
            // line 1088
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product_discount'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1089
        echo "                  </tbody>

                  <tfoot>
                    <tr>
                      <td colspan=\"6\"></td>
                      <td class=\"text-left\"><button type=\"button\" onclick=\"addDiscount();\" data-toggle=\"tooltip\" title=\"";
        // line 1094
        echo ($context["button_discount_add"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus-circle\"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-special\">
              <div class=\"table-responsive\">
                <table id=\"special\" class=\"table table-striped table-bordered table-hover\">
                  <thead>
                    <tr>
                      <td class=\"text-left\">";
        // line 1105
        echo ($context["entry_customer_group"] ?? null);
        echo "</td>
                      <td class=\"text-right\">";
        // line 1106
        echo ($context["entry_priority"] ?? null);
        echo "</td>
                      <td class=\"text-right\">";
        // line 1107
        echo ($context["entry_price"] ?? null);
        echo "</td>
                      <td class=\"text-left\">";
        // line 1108
        echo ($context["entry_date_start"] ?? null);
        echo "</td>
                      <td class=\"text-left\">";
        // line 1109
        echo ($context["entry_date_end"] ?? null);
        echo "</td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>

                    ";
        // line 1115
        $context["special_row"] = 0;
        // line 1116
        echo "                    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["product_specials"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["product_special"]) {
            // line 1117
            echo "                      <tr id=\"special-row";
            echo ($context["special_row"] ?? null);
            echo "\">
                        <td class=\"text-left\"><select name=\"product_special[";
            // line 1118
            echo ($context["special_row"] ?? null);
            echo "][customer_group_id]\" class=\"form-control\">


                            ";
            // line 1121
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["customer_groups"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["customer_group"]) {
                // line 1122
                echo "                              ";
                if ((twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 1122) == twig_get_attribute($this->env, $this->source, $context["product_special"], "customer_group_id", [], "any", false, false, false, 1122))) {
                    // line 1123
                    echo "

                                <option value=\"";
                    // line 1125
                    echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 1125);
                    echo "\" selected=\"selected\">";
                    echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 1125);
                    echo "</option>


                              ";
                } else {
                    // line 1129
                    echo "

                                <option value=\"";
                    // line 1131
                    echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 1131);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 1131);
                    echo "</option>


                              ";
                }
                // line 1135
                echo "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['customer_group'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 1136
            echo "

                          </select></td>
                        <td class=\"text-right\"><input type=\"text\" name=\"product_special[";
            // line 1139
            echo ($context["special_row"] ?? null);
            echo "][priority]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product_special"], "priority", [], "any", false, false, false, 1139);
            echo "\" placeholder=\"";
            echo ($context["entry_priority"] ?? null);
            echo "\" class=\"form-control\"/></td>
                        <td class=\"text-right\"><input type=\"text\" name=\"product_special[";
            // line 1140
            echo ($context["special_row"] ?? null);
            echo "][price]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product_special"], "price", [], "any", false, false, false, 1140);
            echo "\" placeholder=\"";
            echo ($context["entry_price"] ?? null);
            echo "\" class=\"form-control\"/></td>
                        <td class=\"text-left\" style=\"width: 20%;\">
                          <div class=\"input-group date\">
                            <input type=\"text\" name=\"product_special[";
            // line 1143
            echo ($context["special_row"] ?? null);
            echo "][date_start]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product_special"], "date_start", [], "any", false, false, false, 1143);
            echo "\" placeholder=\"";
            echo ($context["entry_date_start"] ?? null);
            echo "\" data-date-format=\"YYYY-MM-DD\" class=\"form-control\"/> <span class=\"input-group-btn\">
                        <button class=\"btn btn-default\" type=\"button\"><i class=\"fa fa-calendar\"></i></button>
                        </span></div>
                        </td>
                        <td class=\"text-left\" style=\"width: 20%;\">
                          <div class=\"input-group date\">
                            <input type=\"text\" name=\"product_special[";
            // line 1149
            echo ($context["special_row"] ?? null);
            echo "][date_end]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product_special"], "date_end", [], "any", false, false, false, 1149);
            echo "\" placeholder=\"";
            echo ($context["entry_date_end"] ?? null);
            echo "\" data-date-format=\"YYYY-MM-DD\" class=\"form-control\"/> <span class=\"input-group-btn\">
                        <button class=\"btn btn-default\" type=\"button\"><i class=\"fa fa-calendar\"></i></button>
                        </span></div>
                        </td>
                        <td class=\"text-left\"><button type=\"button\" onclick=\"\$('#special-row";
            // line 1153
            echo ($context["special_row"] ?? null);
            echo "').remove();\" data-toggle=\"tooltip\" title=\"";
            echo ($context["button_remove"] ?? null);
            echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>
                      </tr>
                      ";
            // line 1155
            $context["special_row"] = (($context["special_row"] ?? null) + 1);
            // line 1156
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product_special'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1157
        echo "                  </tbody>

                  <tfoot>
                    <tr>
                      <td colspan=\"5\"></td>
                      <td class=\"text-left\"><button type=\"button\" onclick=\"addSpecial();\" data-toggle=\"tooltip\" title=\"";
        // line 1162
        echo ($context["button_special_add"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus-circle\"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-image\">
                <div class=\"table-responsive\">
                <!--SF PRODUCTS IMAGE MANAGER-->
                  <!-- Drop zone -->
                  <div id=\"drop-files\" >
                    <p style=\"\">";
        // line 1173
        echo (($__internal_compile_53 = (($__internal_compile_54 = ($context["pim_data"] ?? null)) && is_array($__internal_compile_54) || $__internal_compile_54 instanceof ArrayAccess ? ($__internal_compile_54["lang"] ?? null) : null)) && is_array($__internal_compile_53) || $__internal_compile_53 instanceof ArrayAccess ? ($__internal_compile_53["dad_an_image"] ?? null) : null);
        echo "</p>
                    <i>";
        // line 1174
        echo (($__internal_compile_55 = (($__internal_compile_56 = ($context["pim_data"] ?? null)) && is_array($__internal_compile_56) || $__internal_compile_56 instanceof ArrayAccess ? ($__internal_compile_56["lang"] ?? null) : null)) && is_array($__internal_compile_55) || $__internal_compile_55 instanceof ArrayAccess ? ($__internal_compile_55["select_below"] ?? null) : null);
        echo "</i>
                    <div id=\"frm\" >
                      <input type=\"file\" id=\"file-input\" multiple=\"multiple\" accept=\"image/jpeg,image/png,image/gif,image/bmp\">
                      <label id=\"byPc\" for=\"file-input\" style=\"\">
                        <i class=\"fa fa-cloud-upload\" aria-hidden=\"true\"></i><br>
                        ";
        // line 1179
        echo (($__internal_compile_57 = (($__internal_compile_58 = ($context["pim_data"] ?? null)) && is_array($__internal_compile_58) || $__internal_compile_58 instanceof ArrayAccess ? ($__internal_compile_58["lang"] ?? null) : null)) && is_array($__internal_compile_57) || $__internal_compile_57 instanceof ArrayAccess ? ($__internal_compile_57["upload"] ?? null) : null);
        echo "
                      </label><button type=\"button\" id=\"bySer\">
                        <label>
                          <i class=\"fa fa-cloud\" aria-hidden=\"true\"></i><br>
                          ";
        // line 1183
        echo (($__internal_compile_59 = (($__internal_compile_60 = ($context["pim_data"] ?? null)) && is_array($__internal_compile_60) || $__internal_compile_60 instanceof ArrayAccess ? ($__internal_compile_60["lang"] ?? null) : null)) && is_array($__internal_compile_59) || $__internal_compile_59 instanceof ArrayAccess ? ($__internal_compile_59["server"] ?? null) : null);
        echo "
                        </label>
                      </button><label id=\"byUrl\" for=\"url-input\" >
                        <i class=\"fa fa-external-link-square\" aria-hidden=\"true\"></i><br>
                        ";
        // line 1187
        echo (($__internal_compile_61 = (($__internal_compile_62 = ($context["pim_data"] ?? null)) && is_array($__internal_compile_62) || $__internal_compile_62 instanceof ArrayAccess ? ($__internal_compile_62["lang"] ?? null) : null)) && is_array($__internal_compile_61) || $__internal_compile_61 instanceof ArrayAccess ? ($__internal_compile_61["link"] ?? null) : null);
        echo "
                      </label>
                      <div id=\"url-input\">
                        <span>
                          <input type=\"text\" placeholder =\"http://sonfil.com/image.jpg\">
                          <button class=\"btn btn-info\" type=\"button\"  >Ok</button>
                        </span>
                      </div>
                    </div>
                    ";
        // line 1196
        if ((($__internal_compile_63 = ($context["pim_data"] ?? null)) && is_array($__internal_compile_63) || $__internal_compile_63 instanceof ArrayAccess ? ($__internal_compile_63["permission"] ?? null) : null)) {
            // line 1197
            echo "                    <!-- settings button -->
                    <button id=\"pim_settings\" type=\"button\" class=\"pim-settings btn btn-default\"><i class=\"fa fa-cog\" aria-hidden=\"true\"></i></button>
                    ";
        }
        // line 1200
        echo "                  </div>
                  <!-- View zone -->
                  <div id=\"images\" >
                    <div  id=\"list-view\">
                      ";
        // line 1204
        $context["image_row"] = 0;
        // line 1205
        echo "                      ";
        $context["product_images"] = twig_array_merge([0 => ["image" => ($context["image"] ?? null), "thumb" => ($context["thumb"] ?? null), "sort_order" => 0]], ($context["product_images"] ?? null));
        // line 1206
        echo "                      ";
        if (($context["image"] ?? null)) {
            // line 1207
            echo "                      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["product_images"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["product_image"]) {
                // line 1208
                echo "                      <div class=\"image old\" ";
                if (((($context["poip_installed"]) ?? (false)) && ((((twig_get_attribute($this->env, $this->source, ($context["poip_global_settings"] ?? null), "options_images_edit", [], "array", true, true, false, 1208) &&  !(null === (($__internal_compile_64 = ($context["poip_global_settings"] ?? null)) && is_array($__internal_compile_64) || $__internal_compile_64 instanceof ArrayAccess ? ($__internal_compile_64["options_images_edit"] ?? null) : null)))) ? ((($__internal_compile_65 = ($context["poip_global_settings"] ?? null)) && is_array($__internal_compile_65) || $__internal_compile_65 instanceof ArrayAccess ? ($__internal_compile_65["options_images_edit"] ?? null) : null)) : (0)) == 1))) {
                    echo " data-poip = ";
                    echo json_encode($context["product_image"]);
                    echo " ";
                }
                echo " >
                        <span class='previewImg'><img src ='";
                // line 1209
                echo twig_get_attribute($this->env, $this->source, $context["product_image"], "thumb", [], "any", false, false, false, 1209);
                echo "' /></span>
                        <span class=\"btm_img\">
                          <i class=\"fa fa-search-plus\" data-toggle=\"tooltip\" title=\"";
                // line 1211
                echo (($__internal_compile_66 = (($__internal_compile_67 = ($context["pim_data"] ?? null)) && is_array($__internal_compile_67) || $__internal_compile_67 instanceof ArrayAccess ? ($__internal_compile_67["lang"] ?? null) : null)) && is_array($__internal_compile_66) || $__internal_compile_66 instanceof ArrayAccess ? ($__internal_compile_66["zoom"] ?? null) : null);
                echo "\" aria-hidden=\"true\"></i><i class=\"fa fa-times\" data-toggle=\"tooltip\" title=\"";
                echo (($__internal_compile_68 = (($__internal_compile_69 = ($context["pim_data"] ?? null)) && is_array($__internal_compile_69) || $__internal_compile_69 instanceof ArrayAccess ? ($__internal_compile_69["lang"] ?? null) : null)) && is_array($__internal_compile_68) || $__internal_compile_68 instanceof ArrayAccess ? ($__internal_compile_68["delete"] ?? null) : null);
                echo "\" aria-hidden=\"true\" ></i>
                          <i class=\"fa fa-del-all fa-flip-horizontal\" data-toggle=\"tooltip\" data-original-title=\"";
                // line 1212
                echo (($__internal_compile_70 = (($__internal_compile_71 = ($context["pim_data"] ?? null)) && is_array($__internal_compile_71) || $__internal_compile_71 instanceof ArrayAccess ? ($__internal_compile_71["lang"] ?? null) : null)) && is_array($__internal_compile_70) || $__internal_compile_70 instanceof ArrayAccess ? ($__internal_compile_70["delete_all"] ?? null) : null);
                echo "\" aria-hidden=\"true\" ></i>
                        </span>
                        <input  ";
                // line 1214
                if ((($context["image_row"] ?? null) == 0)) {
                    echo " id=\"input-image\" ";
                }
                echo " class = \"img-input\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product_image"], "image", [], "any", false, false, false, 1214);
                echo "\"  type=\"hidden\" >
                      </div>
                      ";
                // line 1216
                $context["image_row"] = ($context["key"] + 1);
                // line 1217
                echo "                      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['product_image'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 1218
            echo "                      ";
        }
        // line 1219
        echo "                    </div >
                  </div>
                <!--/SF PRODUCTS IMAGE MANAGER-->
                </div>
              </div>
              <div class=\"tab-pane\" id=\"tab-reward\">
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-points\"><span data-toggle=\"tooltip\" title=\"";
        // line 1226
        echo ($context["help_points"] ?? null);
        echo "\">";
        echo ($context["entry_points"] ?? null);
        echo "</span></label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"points\" value=\"";
        // line 1228
        echo ($context["points"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_points"] ?? null);
        echo "\" id=\"input-points\" class=\"form-control\"/>
                </div>
              </div>
              <div class=\"table-responsive\">
                <table class=\"table table-bordered table-hover\">
                  <thead>
                    <tr>
                      <td class=\"text-left\">";
        // line 1235
        echo ($context["entry_customer_group"] ?? null);
        echo "</td>
                      <td class=\"text-right\">";
        // line 1236
        echo ($context["entry_reward"] ?? null);
        echo "</td>
                    </tr>
                  </thead>
                  <tbody>

                    ";
        // line 1241
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["customer_groups"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["customer_group"]) {
            // line 1242
            echo "                      <tr>
                        <td class=\"text-left\">";
            // line 1243
            echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 1243);
            echo "</td>
                        <td class=\"text-right\"><input type=\"text\" name=\"product_reward[";
            // line 1244
            echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 1244);
            echo "][points]\" value=\"";
            echo (((($__internal_compile_72 = ($context["product_reward"] ?? null)) && is_array($__internal_compile_72) || $__internal_compile_72 instanceof ArrayAccess ? ($__internal_compile_72[twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 1244)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_73 = ($context["product_reward"] ?? null)) && is_array($__internal_compile_73) || $__internal_compile_73 instanceof ArrayAccess ? ($__internal_compile_73[twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 1244)] ?? null) : null), "points", [], "any", false, false, false, 1244)) : (""));
            echo "\" class=\"form-control\"/></td>
                      </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['customer_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1247
        echo "                  </tbody>

                </table>
              </div>
            </div>

                 ";
        // line 1253
        if (twig_get_attribute($this->env, $this->source, ($context["attachfile"] ?? null), "tab_content", [], "any", false, false, false, 1253)) {
            // line 1254
            echo "\t\t\t\t\t ";
            echo twig_get_attribute($this->env, $this->source, ($context["attachfile"] ?? null), "tab_content", [], "any", false, false, false, 1254);
            echo "
\t\t\t\t ";
        }
        // line 1256
        echo "            
            <div class=\"tab-pane\" id=\"tab-seo\">
              <div class=\"alert alert-info\"><i class=\"fa fa-info-circle\"></i> ";
        // line 1258
        echo ($context["text_keyword"] ?? null);
        echo "</div>
              <div class=\"table-responsive\">
                <table class=\"table table-bordered table-hover\">
                  <thead>
                    <tr>
                      <td class=\"text-left\">";
        // line 1263
        echo ($context["entry_store"] ?? null);
        echo "</td>
                      <td class=\"text-left\">";
        // line 1264
        echo ($context["entry_keyword"] ?? null);
        echo "</td>
                    </tr>
                  </thead>
                  <tbody>
                    ";
        // line 1268
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 1269
            echo "                      <tr>
                        <td class=\"text-left\">";
            // line 1270
            echo twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 1270);
            echo "</td>
                        <td class=\"text-left\">";
            // line 1271
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 1272
                echo "                            <div class=\"input-group\"><span class=\"input-group-addon\"><img src=\"language/";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 1272);
                echo "/";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 1272);
                echo ".png\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 1272);
                echo "\"/></span> <input type=\"text\" name=\"product_seo_url[";
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 1272);
                echo "][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1272);
                echo "]\" value=\"";
                if ((($__internal_compile_74 = (($__internal_compile_75 = ($context["product_seo_url"] ?? null)) && is_array($__internal_compile_75) || $__internal_compile_75 instanceof ArrayAccess ? ($__internal_compile_75[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 1272)] ?? null) : null)) && is_array($__internal_compile_74) || $__internal_compile_74 instanceof ArrayAccess ? ($__internal_compile_74[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1272)] ?? null) : null)) {
                    echo (($__internal_compile_76 = (($__internal_compile_77 = ($context["product_seo_url"] ?? null)) && is_array($__internal_compile_77) || $__internal_compile_77 instanceof ArrayAccess ? ($__internal_compile_77[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 1272)] ?? null) : null)) && is_array($__internal_compile_76) || $__internal_compile_76 instanceof ArrayAccess ? ($__internal_compile_76[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1272)] ?? null) : null);
                }
                echo "\" placeholder=\"";
                echo ($context["entry_keyword"] ?? null);
                echo "\" class=\"form-control\"/>
                            </div>
                            ";
                // line 1274
                if ((($__internal_compile_78 = (($__internal_compile_79 = ($context["error_keyword"] ?? null)) && is_array($__internal_compile_79) || $__internal_compile_79 instanceof ArrayAccess ? ($__internal_compile_79[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 1274)] ?? null) : null)) && is_array($__internal_compile_78) || $__internal_compile_78 instanceof ArrayAccess ? ($__internal_compile_78[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1274)] ?? null) : null)) {
                    // line 1275
                    echo "                              <div class=\"text-danger\">";
                    echo (($__internal_compile_80 = (($__internal_compile_81 = ($context["error_keyword"] ?? null)) && is_array($__internal_compile_81) || $__internal_compile_81 instanceof ArrayAccess ? ($__internal_compile_81[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 1275)] ?? null) : null)) && is_array($__internal_compile_80) || $__internal_compile_80 instanceof ArrayAccess ? ($__internal_compile_80[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1275)] ?? null) : null);
                    echo "</div>
                            ";
                }
                // line 1277
                echo "                          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo "</td>
                      </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1280
        echo "                  </tbody>

                </table>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-design\">
              <div class=\"table-responsive\">
                <table class=\"table table-bordered table-hover\">
                  <thead>
                    <tr>
                      <td class=\"text-left\">";
        // line 1290
        echo ($context["entry_store"] ?? null);
        echo "</td>
                      <td class=\"text-left\">";
        // line 1291
        echo ($context["entry_layout"] ?? null);
        echo "</td>
                    </tr>
                  </thead>
                  <tbody>
                    ";
        // line 1295
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 1296
            echo "                      <tr>
                        <td class=\"text-left\">";
            // line 1297
            echo twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 1297);
            echo "</td>
                        <td class=\"text-left\"><select name=\"product_layout[";
            // line 1298
            echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 1298);
            echo "]\" class=\"form-control\">
                            <option value=\"\"></option>


                            ";
            // line 1302
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["layouts"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["layout"]) {
                // line 1303
                echo "                              ";
                if (((($__internal_compile_82 = ($context["product_layout"] ?? null)) && is_array($__internal_compile_82) || $__internal_compile_82 instanceof ArrayAccess ? ($__internal_compile_82[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 1303)] ?? null) : null) && ((($__internal_compile_83 = ($context["product_layout"] ?? null)) && is_array($__internal_compile_83) || $__internal_compile_83 instanceof ArrayAccess ? ($__internal_compile_83[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 1303)] ?? null) : null) == twig_get_attribute($this->env, $this->source, $context["layout"], "layout_id", [], "any", false, false, false, 1303)))) {
                    // line 1304
                    echo "

                                <option value=\"";
                    // line 1306
                    echo twig_get_attribute($this->env, $this->source, $context["layout"], "layout_id", [], "any", false, false, false, 1306);
                    echo "\" selected=\"selected\">";
                    echo twig_get_attribute($this->env, $this->source, $context["layout"], "name", [], "any", false, false, false, 1306);
                    echo "</option>


                              ";
                } else {
                    // line 1310
                    echo "

                                <option value=\"";
                    // line 1312
                    echo twig_get_attribute($this->env, $this->source, $context["layout"], "layout_id", [], "any", false, false, false, 1312);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["layout"], "name", [], "any", false, false, false, 1312);
                    echo "</option>


                              ";
                }
                // line 1316
                echo "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['layout'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 1317
            echo "

                          </select></td>
                      </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1322
        echo "                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <link href=\"view/javascript/codemirror/lib/codemirror.css\" rel=\"stylesheet\"/>
  <link href=\"view/javascript/codemirror/theme/monokai.css\" rel=\"stylesheet\"/>
  <script type=\"text/javascript\" src=\"view/javascript/codemirror/lib/codemirror.js\"></script>
  <script type=\"text/javascript\" src=\"view/javascript/codemirror/lib/xml.js\"></script>
  <script type=\"text/javascript\" src=\"view/javascript/codemirror/lib/formatting.js\"></script>
  <script type=\"text/javascript\" src=\"view/javascript/summernote/summernote.min.js\"></script>
  <link href=\"view/javascript/summernote/summernote.min.css\" rel=\"stylesheet\"/>
  <script type=\"text/javascript\" src=\"view/javascript/summernote/summernote-image-attributes.js\"></script>
  <script type=\"text/javascript\" src=\"view/javascript/summernote/opencart.js\"></script>

\t\t\t\t  <script type=\"text/javascript\"><!--
\t\t\t\t\t  ";
        // line 1342
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 1343
            echo "\t\t\t\t\t      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 1344
                echo "\t\t\t\t\t          \$(document).ready(function() {
\t\t\t\t\t               \$('input[name=\"product_description[";
                // line 1345
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1345);
                echo "][name]\"]').stringToSlug({
\t\t\t\t\t                 setEvents: 'keyup keydown blur',
\t\t\t\t\t                 getPut: 'input[name=\"product_seo_url[";
                // line 1347
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 1347);
                echo "][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1347);
                echo "]\"]',
\t\t\t\t\t                 space: '-',
\t\t\t\t\t                 replace: '/\\s?\\([^\\)]*\\)/gi',
\t\t\t\t\t                 AND: 'e'
\t\t\t\t\t               });
\t\t\t\t\t          });
\t\t\t\t\t        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 1354
            echo "\t\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1355
        echo "\t\t\t\t\t  //--></script>
\t\t\t
  <script type=\"text/javascript\"><!--
  // Manufacturer
  \$('input[name=\\'manufacturer\\']').autocomplete({
\t  'source': function(request, response) {
\t\t  \$.ajax({
\t\t\t  url: 'index.php?route=catalog/manufacturer/autocomplete&user_token=";
        // line 1362
        echo ($context["user_token"] ?? null);
        echo "&filter_name=' + encodeURIComponent(request),
\t\t\t  dataType: 'json',
\t\t\t  success: function(json) {
\t\t\t\t  json.unshift({
\t\t\t\t\t  manufacturer_id: 0,
\t\t\t\t\t  name: '";
        // line 1367
        echo ($context["text_none"] ?? null);
        echo "'
\t\t\t\t  });

\t\t\t\t  response(\$.map(json, function(item) {
\t\t\t\t\t  return {
\t\t\t\t\t\t  label: item['name'],
\t\t\t\t\t\t  value: item['manufacturer_id']
\t\t\t\t\t  }
\t\t\t\t  }));
\t\t\t  }
\t\t  });
\t  },
\t  'select': function(item) {
\t\t  \$('input[name=\\'manufacturer\\']').val(item['label']);
\t\t  \$('input[name=\\'manufacturer_id\\']').val(item['value']);
\t  }
  });

  // Category
  \$('input[name=\\'category\\']').autocomplete({
\t  'source': function(request, response) {
\t\t  \$.ajax({
\t\t\t  url: 'index.php?route=catalog/category/autocomplete&user_token=";
        // line 1389
        echo ($context["user_token"] ?? null);
        echo "&filter_name=' + encodeURIComponent(request),
\t\t\t  dataType: 'json',
\t\t\t  success: function(json) {
\t\t\t\t  response(\$.map(json, function(item) {
\t\t\t\t\t  return {
\t\t\t\t\t\t  label: item['name'],
\t\t\t\t\t\t  value: item['category_id']
\t\t\t\t\t  }
\t\t\t\t  }));
\t\t\t  }
\t\t  });
\t  },
\t  'select': function(item) {
\t\t  \$('input[name=\\'category\\']').val('');

\t\t  \$('#product-category' + item['value']).remove();

\t\t  \$('#product-category').append('<div id=\"product-category' + item['value'] + '\"><i class=\"fa fa-minus-circle\"></i> ' + item['label'] + '<input type=\"hidden\" name=\"product_category[]\" value=\"' + item['value'] + '\" /></div>');
\t  }
  });

  \$('#product-category').delegate('.fa-minus-circle', 'click', function() {
\t  \$(this).parent().remove();
  });

  // Filter
  \$('input[name=\\'filter\\']').autocomplete({
\t  'source': function(request, response) {
\t\t  \$.ajax({
\t\t\t  url: 'index.php?route=catalog/filter/autocomplete&user_token=";
        // line 1418
        echo ($context["user_token"] ?? null);
        echo "&filter_name=' + encodeURIComponent(request),
\t\t\t  dataType: 'json',
\t\t\t  success: function(json) {
\t\t\t\t  response(\$.map(json, function(item) {
\t\t\t\t\t  return {
\t\t\t\t\t\t  label: item['name'],
\t\t\t\t\t\t  value: item['filter_id']
\t\t\t\t\t  }
\t\t\t\t  }));
\t\t\t  }
\t\t  });
\t  },
\t  'select': function(item) {
\t\t  \$('input[name=\\'filter\\']').val('');

\t\t  \$('#product-filter' + item['value']).remove();

\t\t  \$('#product-filter').append('<div id=\"product-filter' + item['value'] + '\"><i class=\"fa fa-minus-circle\"></i> ' + item['label'] + '<input type=\"hidden\" name=\"product_filter[]\" value=\"' + item['value'] + '\" /></div>');
\t  }
  });

  \$('#product-filter').delegate('.fa-minus-circle', 'click', function() {
\t  \$(this).parent().remove();
  });

  // Downloads
  \$('input[name=\\'download\\']').autocomplete({
\t  'source': function(request, response) {
\t\t  \$.ajax({
\t\t\t  url: 'index.php?route=catalog/download/autocomplete&user_token=";
        // line 1447
        echo ($context["user_token"] ?? null);
        echo "&filter_name=' + encodeURIComponent(request),
\t\t\t  dataType: 'json',
\t\t\t  success: function(json) {
\t\t\t\t  response(\$.map(json, function(item) {
\t\t\t\t\t  return {
\t\t\t\t\t\t  label: item['name'],
\t\t\t\t\t\t  value: item['download_id']
\t\t\t\t\t  }
\t\t\t\t  }));
\t\t\t  }
\t\t  });
\t  },
\t  'select': function(item) {
\t\t  \$('input[name=\\'download\\']').val('');

\t\t  \$('#product-download' + item['value']).remove();

\t\t  \$('#product-download').append('<div id=\"product-download' + item['value'] + '\"><i class=\"fa fa-minus-circle\"></i> ' + item['label'] + '<input type=\"hidden\" name=\"product_download[]\" value=\"' + item['value'] + '\" /></div>');
\t  }
  });

  \$('#product-download').delegate('.fa-minus-circle', 'click', function() {
\t  \$(this).parent().remove();
  });

  // Related
  \$('input[name=\\'related\\']').autocomplete({
\t  'source': function(request, response) {
\t\t  \$.ajax({
\t\t\t  url: 'index.php?route=catalog/product/autocomplete&user_token=";
        // line 1476
        echo ($context["user_token"] ?? null);
        echo "&filter_name=' + encodeURIComponent(request),
\t\t\t  dataType: 'json',
\t\t\t  success: function(json) {
\t\t\t\t  response(\$.map(json, function(item) {
\t\t\t\t\t  return {
\t\t\t\t\t\t  label: item['name'],
\t\t\t\t\t\t  value: item['product_id']
\t\t\t\t\t  }
\t\t\t\t  }));
\t\t\t  }
\t\t  });
\t  },
\t  'select': function(item) {
\t\t  \$('input[name=\\'related\\']').val('');

\t\t  \$('#product-related' + item['value']).remove();

\t\t  \$('#product-related').append('<div id=\"product-related' + item['value'] + '\"><i class=\"fa fa-minus-circle\"></i> ' + item['label'] + '<input type=\"hidden\" name=\"product_related[]\" value=\"' + item['value'] + '\" /></div>');
\t  }
  });

  \$('#product-related').delegate('.fa-minus-circle', 'click', function() {
\t  \$(this).parent().remove();
  });
  //--></script>

";
        // line 1502
        if ((($context["module_atpresets_installed"] ?? null) == 1)) {
            // line 1503
            echo "
\t\t\t\t  <script type=\"text/javascript\"><!--
\t\t\t\t\t  ";
            // line 1505
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
                // line 1506
                echo "\t\t\t\t\t      ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                    // line 1507
                    echo "\t\t\t\t\t          \$(document).ready(function() {
\t\t\t\t\t               \$('input[name=\"product_description[";
                    // line 1508
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1508);
                    echo "][name]\"]').stringToSlug({
\t\t\t\t\t                 setEvents: 'keyup keydown blur',
\t\t\t\t\t                 getPut: 'input[name=\"product_seo_url[";
                    // line 1510
                    echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 1510);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1510);
                    echo "]\"]',
\t\t\t\t\t                 space: '-',
\t\t\t\t\t                 replace: '/\\s?\\([^\\)]*\\)/gi',
\t\t\t\t\t                 AND: 'e'
\t\t\t\t\t               });
\t\t\t\t\t          });
\t\t\t\t\t        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 1517
                echo "\t\t\t\t\t  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 1518
            echo "\t\t\t\t\t  //--></script>
\t\t\t
<script type=\"text/javascript\"><!--
function addPresetField(attribute_row) {

\t";
            // line 1523
            if ((($context["module_atpresets_selecttype"] ?? null) == 0)) {
                // line 1524
                echo "\t\thtml  = '<br><div class=\"test\"><input type=\"text\" name=\"product_attribute[' + attribute_row + '][preset]\" value=\"\" placeholder=\"";
                echo ($context["text_preset_value"] ?? null);
                echo "\" class=\"form-control\" />';
\t\thtml += '<input type=\"hidden\" name=\"product_attribute[' + attribute_row + '][preset_id][]\" value=\"\" /></div>';
\t";
            } else {
                // line 1527
                echo "\t\thtml = '<br><div>';
\t\t";
                // line 1528
                if ((($context["module_atpresets_allow_multiple"] ?? null) == 1)) {
                    // line 1529
                    echo "\t\t
\t\thtml += '\t<input type=\"checkbox\" id=\"allow_multiple' + attribute_row + '\" name=\"product_attribute[' + attribute_row + '][allow_multiple]\"';
\t\thtml += '\t\tonchange=\"changeSelectionMode('+attribute_row+')\"/>';
\t\thtml += '\t<label for=\"allow_multiple' + attribute_row + '\">";
                    // line 1532
                    echo ($context["text_allow_multiple"] ?? null);
                    echo "</label>'; 
\t\t\t
\t\t";
                }
                // line 1534
                echo "\t
\t\thtml += '<br><select alt=\"' + attribute_row + '\" name=\"product_attribute[' + attribute_row + '][preset_id][]\" id=\"input-preset' + attribute_row + '\" class=\"form-control\" onchange=\"select_preset(this);\"  onfocus=\"check_attribute(this);\">';
\t\thtml += '<option value=\"-1\"></option>';
\t\t\t";
                // line 1537
                $context["current_att"] = 0;
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["all_presets"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["preset"]) {
                    // line 1538
                    echo "\t\t\t\t
\t\t\t\t";
                    // line 1539
                    if ((($context["current_att"] ?? null) != twig_get_attribute($this->env, $this->source, $context["preset"], "attribute_id", [], "any", false, false, false, 1539))) {
                        $context["current_att"] = twig_get_attribute($this->env, $this->source, $context["preset"], "attribute_id", [], "any", false, false, false, 1539);
                        // line 1540
                        echo "\t\t\t\thtml += '<option class=\"att' + attribute_row + ' att' + attribute_row + '-";
                        echo twig_get_attribute($this->env, $this->source, $context["preset"], "attribute_id", [], "any", false, false, false, 1540);
                        echo "\" value=\"0\" disabled=\"disabled\" style=\"color:red\">";
                        echo twig_get_attribute($this->env, $this->source, $context["preset"], "attribute_name_esc", [], "any", false, false, false, 1540);
                        echo "</option>';
\t\t\t\t";
                    }
                    // line 1542
                    echo "\t\t\t\thtml += '<option alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["preset"], "attribute_id", [], "any", false, false, false, 1542);
                    echo "\" class=\"pre' + attribute_row + ' pre' + attribute_row + '-";
                    echo twig_get_attribute($this->env, $this->source, $context["preset"], "attribute_id", [], "any", false, false, false, 1542);
                    echo "\" value=\"";
                    echo (($__internal_compile_84 = $context["preset"]) && is_array($__internal_compile_84) || $__internal_compile_84 instanceof ArrayAccess ? ($__internal_compile_84["preset_id"] ?? null) : null);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["preset"], "text_esc2", [], "any", false, false, false, 1542);
                    echo "</option>';
\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['preset'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 1544
                echo "\t\thtml  += '  </select></div>';
\t\t\t\t\t\t\t\t
\t";
            }
            // line 1546
            echo "\t
\t\$('input[name=\\'product_attribute[' + attribute_row + '][name]\\']').parent().append(html);

\t";
            // line 1549
            if ((($context["module_atpresets_allow_multiple"] ?? null) == 1)) {
                echo "\t
\t\taddMultiSelectFunctionality(attribute_row);
\t";
            }
            // line 1552
            echo "\t
\t";
            // line 1553
            if ((twig_length_filter($this->env, ($context["languages"] ?? null)) > 1)) {
                // line 1554
                echo "\t\t";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                    // line 1555
                    echo "\t\thtml  = '\t<span onclick=\"copy_values(' + attribute_row + ',";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1555);
                    echo ")\" class=\"input-group-addon\" style=\"cursor:pointer;cursor:hand;\" title=\"";
                    echo ($context["text_copy_value"] ?? null);
                    echo "\">';
\t\thtml += '\t\t<i class=\"fa fa-ellipsis-v\" style=\"font-size: large;\"></i>';
\t\thtml += '\t</span>';
\t\t
\t\t\$('textarea[name=\\'product_attribute[' + attribute_row + '][product_attribute_description][";
                    // line 1559
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1559);
                    echo "][text]\\']').before(html);
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 1561
                echo "\t";
            }
            // line 1562
            echo "\t
\t";
            // line 1563
            if ((($context["module_atpresets_selecttype"] ?? null) == 0)) {
                // line 1564
                echo "\t\tpresetautocomplete(attribute_row);
\t";
            }
            // line 1566
            echo "}
//--></script>

\t\t\t\t  <script type=\"text/javascript\"><!--
\t\t\t\t\t  ";
            // line 1570
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
                // line 1571
                echo "\t\t\t\t\t      ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                    // line 1572
                    echo "\t\t\t\t\t          \$(document).ready(function() {
\t\t\t\t\t               \$('input[name=\"product_description[";
                    // line 1573
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1573);
                    echo "][name]\"]').stringToSlug({
\t\t\t\t\t                 setEvents: 'keyup keydown blur',
\t\t\t\t\t                 getPut: 'input[name=\"product_seo_url[";
                    // line 1575
                    echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 1575);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1575);
                    echo "]\"]',
\t\t\t\t\t                 space: '-',
\t\t\t\t\t                 replace: '/\\s?\\([^\\)]*\\)/gi',
\t\t\t\t\t                 AND: 'e'
\t\t\t\t\t               });
\t\t\t\t\t          });
\t\t\t\t\t        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 1582
                echo "\t\t\t\t\t  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 1583
            echo "\t\t\t\t\t  //--></script>
\t\t\t
<script type=\"text/javascript\"><!--
function update_attributes(attemplate_id, option) {

\t\$.ajax({ 
\t\turl: 'index.php?route=extension/module/attemplate/update_attributes&user_token=";
            // line 1589
            echo ($context["user_token"] ?? null);
            echo "&attemplate_id=' + attemplate_id + '&option=' + option + '&product_id=' + ";
            echo ($context["product_id"] ?? null);
            echo ",
\t\ttype: 'post',
\t\tdata: \$('#tab-attribute select, #tab-attribute input, #tab-attribute textarea').serialize(),\t\t
\t\tdataType: 'json',
\t\tbeforeSend: function() {
\t\t\tif (option == 1)
\t\t\t\t\$('#attemmplate_button_add').button('loading');
\t\t\telse if (option == 2)
\t\t\t\t\$('#attemmplate_button_replace').button('loading');
\t\t\telse if (option == 0)
\t\t\t\t\$('#attemmplate_button_default').button('loading');
\t\t\telse {
\t\t\t\t\$('#attgroup option[value=\"-1\"]').prop('selected', true);
\t\t\t\t\$('#attgroup option[value=\"-1\"]').text('";
            // line 1602
            echo ($context["text_loading"] ?? null);
            echo "');
\t\t\t}
\t\t},
\t\tcomplete: function() {
\t\t\t\$('#attemmplate_button_add').button('reset');
\t\t\t\$('#attemmplate_button_replace').button('reset');
\t\t\t\$('#attemmplate_button_default').button('reset');\t\t

\t\t},\t\t\t\t
\t\tsuccess: function(json) {
\t\t\t\$('tr[id^=\\'attribute-row\\']').remove();
\t\t\tif (option == 3) {
\t\t\t\t\$('#attgroup option[value=\"-1\"]').html('";
            // line 1614
            echo ($context["text_add_group"] ?? null);
            echo "');
\t\t\t}\t\t\t\t
\t\t\tattribute_row = 0;
\t\t\tfor (var key in json['product_attributes']) {
\t\t\t\taddAttribute();
\t\t\t\tattribute_row = attribute_row -1;
\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][name]\\']').val(json['product_attributes'][key]['name']);
\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][attribute_id]\\']').val(json['product_attributes'][key]['attribute_id']);
\t\t\t\t
\t\t\t\t";
            // line 1623
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 1624
                echo "\t\t\t\t\tif (json['product_attributes'][key]['product_attribute_description'][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1624);
                echo "] !== undefined) {
\t\t\t\t\t\t\$('textarea[name=\\'product_attribute[' + attribute_row + '][product_attribute_description][";
                // line 1625
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1625);
                echo "][text]\\']').val(json['product_attributes'][key]['product_attribute_description'][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1625);
                echo "]['text']);
\t\t\t\t\t}
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 1628
            echo "\t\t\t\t
\t\t\t\tif (json['product_attributes'][key]['allow_multiple']) {
\t\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][allow_multiple]\\']').prop('checked','checked');
\t\t\t\t\tchangeSelectionMode(attribute_row);
\t\t\t\t}
\t\t\t\tif ('1' in json['product_attributes'][key]['preset_id']) {
\t\t\t\t\tfor (var preset_key in json['product_attributes'][key]['preset_id']) {
\t\t\t\t\t\tif (json['product_attributes'][key]['preset_id'][preset_key] > 0)
\t\t\t\t\t\t\t\$('select[name=\\'product_attribute[' + attribute_row + '][preset_id][]\\'] option[value=\"'+json['product_attributes'][key]['preset_id'][preset_key]+'\"]').prop('selected', true);
\t\t\t\t\t}\t\t\t
\t\t\t\t} else {\t
\t\t\t\t\tif (json['product_attributes'][key]['preset_id'][0] >0) {
\t\t\t\t\t\t\$('select[name=\\'product_attribute[' + attribute_row + '][preset_id][]\\'] option[value=\"'+json['product_attributes'][key]['preset_id'][0]+'\"]').prop('selected', true);
\t\t\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][preset_id][]\\']').val(json['product_attributes'][key]['preset_id'][0]);\t\t
\t\t\t\t\t}
\t\t\t\t}
\t\t\t\t\$('.att' + attribute_row).hide();
\t\t\t\t\$('.pre' + attribute_row).hide();
\t\t\t\t\$('.pre' + attribute_row + '-' + json['product_attributes'][key]['attribute_id']).show();\t\t\t\t\t\t

\t\t\t\t";
            // line 1648
            if ((($context["module_atpresets_selecttype"] ?? null) == 0)) {
                // line 1649
                echo "\t\t\t\t\tpresetautocomplete(attribute_row);
\t\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][preset]\\']').val(json['product_attributes'][key]['preset']);
\t\t\t\t";
            }
            // line 1651
            echo "\t\t\t\t
\t\t\t\t

\t\t\t\tattribute_row = attribute_row +1;
\t\t\t}
\t\t}\t\t\t\t\t\t
\t});\t
}


function save_attemplate() {

\t\$.ajax({ 
\t\turl: 'index.php?route=extension/module/attemplate/save_attemplate&user_token=";
            // line 1664
            echo ($context["user_token"] ?? null);
            echo "',
\t\ttype: 'post',
\t\tdata: \$('#tab-attribute select, #tab-attribute input, #tab-attribute textarea, input[name=\"new_attemplate_name\"]').serialize(),\t\t
\t\tdataType: 'json',
\t\tbeforeSend: function() {
\t\t\t\$('#attemmplate_button_save').button('loading');
\t\t\t\$('.alert').remove();
\t\t\t\$('#new_attemplate_name .text-danger').remove();\t\t\t
\t\t},
\t\tcomplete: function() {
\t\t\t\$('#attemmplate_button_save').button('reset');
\t\t},\t\t
\t\tsuccess: function(json) {
\t\t\tif (json['error']) {
\t\t\t\tvar html = '<div class=\"text-danger\">' + json['error'] + '</div>';
\t\t\t\t\$('input[name=\"new_attemplate_name\"]').after(html);
\t\t\t}

\t\t\tif (json['success']) {
\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-success\"><i class=\"fa fa-check-circle\"></i> ' + json['success'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');
\t\t\t}
\t\t}\t\t\t\t\t\t
\t});\t
}
//--></script>

\t\t\t\t  <script type=\"text/javascript\"><!--
\t\t\t\t\t  ";
            // line 1691
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
                // line 1692
                echo "\t\t\t\t\t      ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                    // line 1693
                    echo "\t\t\t\t\t          \$(document).ready(function() {
\t\t\t\t\t               \$('input[name=\"product_description[";
                    // line 1694
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1694);
                    echo "][name]\"]').stringToSlug({
\t\t\t\t\t                 setEvents: 'keyup keydown blur',
\t\t\t\t\t                 getPut: 'input[name=\"product_seo_url[";
                    // line 1696
                    echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 1696);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1696);
                    echo "]\"]',
\t\t\t\t\t                 space: '-',
\t\t\t\t\t                 replace: '/\\s?\\([^\\)]*\\)/gi',
\t\t\t\t\t                 AND: 'e'
\t\t\t\t\t               });
\t\t\t\t\t          });
\t\t\t\t\t        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 1703
                echo "\t\t\t\t\t  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 1704
            echo "\t\t\t\t\t  //--></script>
\t\t\t
<script type=\"text/javascript\"><!--
function copy_values(attribute_row, language_id){
\tvar new_value = \$('textarea[name=\\'product_attribute[' + attribute_row + '][product_attribute_description][' + language_id + '][text]\\']').val();
\t\$('textarea[name^=\\'product_attribute[' + attribute_row + '][product_attribute_description]\\']').val(new_value);
}

function add_preset(attribute_row) {
\tvar attribute_id = \$('input[name=\\'product_attribute[' + attribute_row + '][attribute_id]\\']').val();
\tvar texts = {
\t\t";
            // line 1715
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 1716
                echo "\t\t";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1716);
                echo ":\$('textarea[name=\\'product_attribute[' + attribute_row + '][product_attribute_description][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1716);
                echo "][text]\\']').val(),
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 1717
            echo "\t
\t};
\t\$.ajax({
\t\turl: 'index.php?route=extension/module/atpresets/insert&user_token=";
            // line 1720
            echo ($context["user_token"] ?? null);
            echo "',
\t\ttype: 'post',
\t\tdata: {attribute_id,texts},
\t\tdataType: 'json',
\t\tsuccess: function(json) {
\t\t\tif (json['preset_id']!=0) {
\t\t\t\t";
            // line 1726
            if ((($context["module_atpresets_selecttype"] ?? null) == 0)) {
                // line 1727
                echo "\t\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][preset_id][]\\']').val(json['preset_id']);
\t\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][preset]\\']').val(json['preset_decoded']);
\t\t\t\t";
            } else {
                // line 1730
                echo "\t\t\t\t\tif (json['new_added']==1) {
\t\t\t\t\t\tif (!\$('.att' + attribute_row + '-' + attribute_id).length)
\t\t\t\t\t\t\t\$('select[name=\\'product_attribute[' + attribute_row + '][preset_id][]\\']').append('<option color=\"red\" class=\"att' + attribute_row + ' att' + attribute_row + '-' + attribute_id + '\" value=\"0\" disabled=\"disabled\" style=\"color:red;display:none;\">'+\$('input[name=\\'product_attribute[' + attribute_row + '][name]\\']').val()+'</option>');
\t\t\t\t\t\t
\t\t\t\t\t\t\$('.att' + attribute_row + '-' + attribute_id).after('<option alt=\"'+attribute_id+'\" class=\"pre' + attribute_row + ' pre' + attribute_row + '-' + attribute_id + '\" value=\"'+json['preset_id']+'\">'+json['preset']+'</option>');
\t\t\t\t\t}
\t\t\t\t\t\$('select[name=\\'product_attribute[' + attribute_row + '][preset_id][]\\']').val(json['preset_id']);
\t\t\t\t\t";
                // line 1737
                if ((($context["module_atpresets_allow_multiple"] ?? null) == 1)) {
                    echo "\t
\t\t\t\t\t\taddMultiSelectFunctionality(attribute_row);
\t\t\t\t\t";
                }
                // line 1739
                echo "\t\t\t\t\t
\t\t\t\t";
            }
            // line 1741
            echo "\t\t\t}\t\t
\t\t\talert(json['message']);
\t\t},
\t\terror: function(json) {
\t\t\talert('";
            // line 1745
            echo ($context["text_new_preset_error"] ?? null);
            echo "');
\t\t}
\t});
}
//--></script>

\t\t\t\t  <script type=\"text/javascript\"><!--
\t\t\t\t\t  ";
            // line 1752
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
                // line 1753
                echo "\t\t\t\t\t      ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                    // line 1754
                    echo "\t\t\t\t\t          \$(document).ready(function() {
\t\t\t\t\t               \$('input[name=\"product_description[";
                    // line 1755
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1755);
                    echo "][name]\"]').stringToSlug({
\t\t\t\t\t                 setEvents: 'keyup keydown blur',
\t\t\t\t\t                 getPut: 'input[name=\"product_seo_url[";
                    // line 1757
                    echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 1757);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1757);
                    echo "]\"]',
\t\t\t\t\t                 space: '-',
\t\t\t\t\t                 replace: '/\\s?\\([^\\)]*\\)/gi',
\t\t\t\t\t                 AND: 'e'
\t\t\t\t\t               });
\t\t\t\t\t          });
\t\t\t\t\t        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 1764
                echo "\t\t\t\t\t  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 1765
            echo "\t\t\t\t\t  //--></script>
\t\t\t
<script type=\"text/javascript\"><!--
";
            // line 1768
            if ((($context["module_atpresets_selecttype"] ?? null) == 0)) {
                // line 1769
                echo "function presetautocomplete(attribute_row) {

\tvar attribute_id = \$('input[name=\\'product_attribute[' + attribute_row + '][attribute_id]\\']').val();
\t\$('#attribute-row'+attribute_row+' .test ul').remove();
\tif (attribute_id != '') {
\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][preset]\\']').autocomplete({
\t\t\t'source': function(request, response) {
\t\t\t\t\$.ajax({
\t\t\t\t\turl: 'index.php?route=extension/module/atpresets/autocomplete&user_token=";
                // line 1777
                echo ($context["user_token"] ?? null);
                echo "&filter_name=' +  encodeURIComponent(request) + '&attribute_id=' + attribute_id,
\t\t\t\t\tdataType: 'json',\t\t\t
\t\t\t\t\tsuccess: function(json) {
\t\t\t\t\t\tresponse(\$.map(json, function(item) {
\t\t\t\t\t\t\treturn {
\t\t\t\t\t\t\t\tlabel: item.not_decoded_text,
\t\t\t\t\t\t\t\tlabel_decoded: item.text,\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\tvalues: item.texts,
\t\t\t\t\t\t\t\tvalue: item.preset_id\t
\t\t\t\t\t\t\t}
\t\t\t\t\t\t}));
\t\t\t\t\t}
\t\t\t\t});
\t\t\t},
\t\t\t'select': function(item) {
\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][preset]\\']').val(item['label_decoded']);
\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][preset_id][]\\']').val(item['value']);
\t\t\t\tvar key;
\t\t\t\tfor (key in item['values']) {
\t\t\t\t\t\$('textarea[name=\\'product_attribute[' + attribute_row + '][product_attribute_description][' + key + '][text]\\']').val(item['values'][key]); 
\t\t\t\t}
\t\t\t}
\t\t});
\t
\t} else {
\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][preset]\\']').autocomplete({
\t\t\t'source': function(request, response) {
\t\t\t\t\$.ajax({
\t\t\t\t\turl: 'index.php?route=extension/module/atpresets/autocomplete&user_token=";
                // line 1805
                echo ($context["user_token"] ?? null);
                echo "&filter_name=' +  encodeURIComponent(request) + '&attribute_id=' + attribute_id,
\t\t\t\t\tdataType: 'json',\t\t\t
\t\t\t\t\tsuccess: function(json) {
\t\t\t\t\t\tresponse(\$.map(json, function(item) {
\t\t\t\t\t\t\treturn {
\t\t\t\t\t\t\t\tcategory: item.attribute_name,
\t\t\t\t\t\t\t\tattribute_id: item.attribute_id,
\t\t\t\t\t\t\t\tlabel: item.not_decoded_text,
\t\t\t\t\t\t\t\tlabel_decoded: item.text,
\t\t\t\t\t\t\t\tvalues: item.texts,
\t\t\t\t\t\t\t\tvalue: item.preset_id\t\t\t\t\t
\t\t\t\t\t\t\t}
\t\t\t\t\t\t}));
\t\t\t\t\t}
\t\t\t\t});
\t\t\t},
\t\t\tselect: function(item) {
\t\t\t\t
\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][preset]\\']').val(item['label_decoded']);
\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][preset_id][]\\']').val(item['value']);
\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][name]\\']').val(item['category']);
\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][attribute_id]\\']').val(item['attribute_id']);\t\t\t\t
\t\t\t\tvar key;
\t\t\t\tfor (key in item['values']) {
\t\t\t\t\t\$('textarea[name=\\'product_attribute[' + attribute_row + '][product_attribute_description][' + key + '][text]\\']').val(item['values'][key]); 
\t\t\t\t}
\t\t\t\tpresetautocomplete(attribute_row);
\t\t\t}
\t\t});\t
\t}
}

\$('#attribute tbody tr').each(function(index, element) {
\tpresetautocomplete(index);
});
";
            } else {
                // line 1841
                echo "function select_preset(select_node) {
\tvar att_row = \$(select_node).attr('alt');
\tvar preset_id = \$(select_node).find(\":selected\").val();
\tvar attribute_id = \$(select_node).find(\":selected\").attr('alt');
\t
\t\$.ajax({
\t\turl: 'index.php?route=extension/module/atpresets/getPresetTexts&user_token=";
                // line 1847
                echo ($context["user_token"] ?? null);
                echo "&preset_id=' + preset_id,
\t\tdataType: 'json',\t\t\t
\t\tsuccess: function(json) {
\t\t\t\$('input[name=\\'product_attribute[' + att_row + '][name]\\']').val(\$('.att' + att_row + '-' + attribute_id).text());
\t\t\t\$('input[name=\\'product_attribute[' + att_row + '][attribute_id]\\']').val(attribute_id);\t
\t\t\t\t
\t\t\t";
                // line 1853
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                    // line 1854
                    echo "\t\t\t\t\$('textarea[name=\\'product_attribute[' + att_row + '][product_attribute_description][";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1854);
                    echo "][text]\\']').val(json['texts'][";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1854);
                    echo "]); 
\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 1856
                echo "\t\t\tif (preset_id != -1) {
\t\t\t\t\$('.att' + att_row).hide();
\t\t\t\t\$('.pre' + att_row).hide();
\t\t\t\t\$('.pre' + att_row + '-' + attribute_id).show();\t\t\t
\t\t\t} else {
\t\t\t\t\$('.att' + att_row).show();
\t\t\t\t\$('.pre' + att_row).show();\t\t\t
\t\t\t}
\t\t\t\t
\t\t}
\t});\t

}

function check_attribute(select_node) {
\tvar att_row = \$(select_node).attr('alt');
\tvar att_text = \$('input[name=\\'product_attribute[' + att_row + '][name]\\']').val();
\t
\tif (att_text=='') {
\t\t\$('.att' + att_row).show();
\t\t\$('.pre' + att_row).show();\t
\t\t\$('input[name=\\'product_attribute[' + att_row + '][attribute_id]\\']').val('');
\t\t\$('select[name=\\'product_attribute[' + att_row + '][preset_id][]\\']').val(-1);
\t}
}

function changeSelectionMode(attribute_row) {
\tif (!\$('#allow_multiple' + attribute_row ).is(':checked')) {
\t\t\$('#input-preset' + attribute_row).css('height','auto');
\t\t\$('#input-preset' + attribute_row).removeAttr('multiple');
\t\t\$('#attribute-row'+attribute_row+' textarea').attr('readonly', false);\t\t
\t\t
\t\t";
                // line 1888
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                    // line 1889
                    echo "\t\t\t\$('textarea[name=\\'product_attribute[' + attribute_row + '][product_attribute_description][";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1889);
                    echo "][text]\\']').val(''); 
\t\t\tvar new_value";
                    // line 1890
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1890);
                    echo " = ''; 
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 1892
                echo "\t\t
\t\tvar ids = '';
\t\t\$('#input-preset' + attribute_row + ' option').each(function(index) {
\t\t\tif (\$(this).prop('selected')) {
\t\t\t\tids += '_'+\$(this).val();\t\t
\t\t\t}
\t\t\tif (\$(this).val() == -1) {
\t\t\t\t\$(this).prop('selected', false);\t\t
\t\t\t}\t\t\t
\t\t});
\t\t\$.ajax({
\t\t\turl: 'index.php?route=extension/module/atpresets/getManyPresetsTexts&user_token=";
                // line 1903
                echo ($context["user_token"] ?? null);
                echo "&preset_id=' + ids,
\t\t\tdataType: 'json',\t\t\t
\t\t\tsuccess: function(json) {
\t\t\t\tif (json) {
\t\t\t\t\t";
                // line 1907
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                    // line 1908
                    echo "
\t\t\t\t\t\t\$('textarea[name=\\'product_attribute[' + attribute_row + '][product_attribute_description][";
                    // line 1909
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1909);
                    echo "][text]\\']').val(json[";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1909);
                    echo "]);
\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 1910
                echo "\t
\t\t\t\t} else {
\t\t\t\t\t";
                // line 1912
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                    // line 1913
                    echo "\t\t\t\t\t\t\$('textarea[name=\\'product_attribute[' + attribute_row + '][product_attribute_description][";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1913);
                    echo "][text]\\']').val('');
\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 1914
                echo "\t\t\t
\t\t\t\t}
\t\t\t}
\t\t});\t\t\t
\t} else  {
\t\t\$('#input-preset' + attribute_row).attr('multiple','multiple');
\t\t\$('#input-preset' + attribute_row).css('height','200px');
\t\t\$('#attribute-row'+attribute_row+' textarea').attr('readonly', true);
\t\t\$('select[name=\\'product_attribute[' + attribute_row + '][preset_id][]\\'] option[value=\"-1\"]').prop('selected', false);
\t}
}

function addMultiSelectFunctionality(attribute_row) {
\$('#input-preset' + attribute_row + ' option').unbind( \"mousedown\");
\$('#input-preset' + attribute_row + ' option').mousedown(function(e) {
if (\$('input[name=\"product_attribute[' + attribute_row + '][allow_multiple]\"]').is(':checked')) {
    e.preventDefault();
\tif (\$(this).val() != -1) {
\t\t\$(this).prop('selected', !\$(this).prop('selected'));

\t\tif (\$(this).prop('selected')) {
\t\t\tvar attribute_id = \$(this).attr('alt');
\t\t\tif (\$('input[name=\\'product_attribute[' + attribute_row + '][attribute_id]\\']').val() != attribute_id) {
\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][name]\\']').val(\$('.att' + attribute_row + '-' + attribute_id).text());
\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][attribute_id]\\']').val(attribute_id);\t
\t\t\t\t\$('.att' + attribute_row).hide();
\t\t\t\t\$('.pre' + attribute_row).hide();
\t\t\t\t\$('.pre' + attribute_row + '-' + attribute_id).show();\t\t\t\t\t
\t\t\t}
\t\t}
\t\t";
                // line 1944
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                    // line 1945
                    echo "\t\t\t\$('textarea[name=\\'product_attribute[' + attribute_row + '][product_attribute_description][";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1945);
                    echo "][text]\\']').val(''); 
\t\t\tvar new_value";
                    // line 1946
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1946);
                    echo " = ''; 
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 1947
                echo "\t\t\t
\t\tvar ids = '';
\t\t\$('#input-preset' + attribute_row + ' option').each(function(index) {
\t\t\tif (\$(this).prop('selected')) {
\t\t\t\tids += '_'+\$(this).val();\t\t
\t\t\t}
\t\t});
\t\t\$.ajax({
\t\t\turl: 'index.php?route=extension/module/atpresets/getManyPresetsTexts&user_token=";
                // line 1955
                echo ($context["user_token"] ?? null);
                echo "&preset_id=' + ids,
\t\t\tdataType: 'json',\t\t\t
\t\t\tsuccess: function(json) {
\t\t\t\tif (json) {
\t\t\t\t\t";
                // line 1959
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                    // line 1960
                    echo "
\t\t\t\t\t\t\$('textarea[name=\\'product_attribute[' + attribute_row + '][product_attribute_description][";
                    // line 1961
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1961);
                    echo "][text]\\']').val(json[";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1961);
                    echo "]);
\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 1962
                echo "\t
\t\t\t\t} else {
\t\t\t\t\t";
                // line 1964
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                    // line 1965
                    echo "\t\t\t\t\t\t\$('textarea[name=\\'product_attribute[' + attribute_row + '][product_attribute_description][";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1965);
                    echo "][text]\\']').val('');
\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 1966
                echo "\t\t\t
\t\t\t\t}
\t\t\t}
\t\t});\t\t\t\t
\t} else {
\t\t\$(this).prop('selected', false);
\t}
}
\treturn false;
});\t
}

";
                // line 1978
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(0, (($context["attribute_row"] ?? null) - 1)));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 1979
                    echo "addMultiSelectFunctionality(";
                    echo $context["i"];
                    echo ");
if (\$('#allow_multiple";
                    // line 1980
                    echo $context["i"];
                    echo "').attr(\"checked\"))
\t\$('#attribute-row";
                    // line 1981
                    echo $context["i"];
                    echo " textarea').attr('readonly', true);
";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
            }
            // line 1984
            echo "//--></script>
";
        }
        // line 1986
        echo "
\t\t\t

\t\t\t\t  <script type=\"text/javascript\"><!--
\t\t\t\t\t  ";
        // line 1990
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 1991
            echo "\t\t\t\t\t      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 1992
                echo "\t\t\t\t\t          \$(document).ready(function() {
\t\t\t\t\t               \$('input[name=\"product_description[";
                // line 1993
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1993);
                echo "][name]\"]').stringToSlug({
\t\t\t\t\t                 setEvents: 'keyup keydown blur',
\t\t\t\t\t                 getPut: 'input[name=\"product_seo_url[";
                // line 1995
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 1995);
                echo "][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1995);
                echo "]\"]',
\t\t\t\t\t                 space: '-',
\t\t\t\t\t                 replace: '/\\s?\\([^\\)]*\\)/gi',
\t\t\t\t\t                 AND: 'e'
\t\t\t\t\t               });
\t\t\t\t\t          });
\t\t\t\t\t        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 2002
            echo "\t\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 2003
        echo "\t\t\t\t\t  //--></script>
\t\t\t
  <script type=\"text/javascript\"><!--
  var attribute_row = ";
        // line 2006
        echo ($context["attribute_row"] ?? null);
        echo ";

  function addAttribute() {
\t  html = '<tr id=\"attribute-row' + attribute_row + '\">';
\t  html += '  <td class=\"text-left\" style=\"width: 20%;\"><input type=\"text\" name=\"product_attribute[' + attribute_row + '][name]\" value=\"\" placeholder=\"";
        // line 2010
        echo ($context["entry_attribute"] ?? null);
        echo "\" class=\"form-control\" /><input type=\"hidden\" name=\"product_attribute[' + attribute_row + '][attribute_id]\" value=\"\" /></td>';
\t  html += '  <td class=\"text-left\">';
    ";
        // line 2012
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 2013
            echo "\t  html += '<div class=\"input-group\"><span class=\"input-group-addon\"><img src=\"language/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 2013);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 2013);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 2013);
            echo "\" /></span><textarea name=\"product_attribute[' + attribute_row + '][product_attribute_description][";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 2013);
            echo "][text]\" rows=\"5\" placeholder=\"";
            echo ($context["entry_text"] ?? null);
            echo "\" class=\"form-control\"></textarea></div>';
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 2015
        echo "\t  html += '  </td>';
\t  
\t\t\t";
        // line 2017
        if ((($context["module_atpresets_installed"] ?? null) == 1)) {
            // line 2018
            echo "\t\t\t\thtml += '  <td class=\"text-right\"><button type=\"button\" onclick=\"\$(\\'#attribute-row' + attribute_row + '\\').remove();\" data-toggle=\"tooltip\" title=\"";
            echo ($context["button_remove"] ?? null);
            echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button><br><button type=\"button\" onclick=\"add_preset(' + attribute_row + ')\" data-toggle=\"tooltip\" title=\"";
            echo ($context["text_new_preset"] ?? null);
            echo "\" class=\"btn btn-primary\" style=\"margin-top:20px;\"><i class=\"fa fa-save\"></i></button></td>';
\t\t\t";
        } else {
            // line 2020
            echo "\t\t\t\thtml += '  <td class=\"text-right\"><button type=\"button\" onclick=\"\$(\\'#attribute-row' + attribute_row + '\\').remove();\" data-toggle=\"tooltip\" title=\"";
            echo ($context["button_remove"] ?? null);
            echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>';
\t\t\t";
        }
        // line 2022
        echo "\t\t\t
\t  html += '</tr>';

\t  \$('#attribute tbody').append(html);


\t\t\t\t";
        // line 2028
        if ((($context["module_atpresets_installed"] ?? null) == 1)) {
            // line 2029
            echo "\t\t\t\t\taddPresetField(attribute_row);
\t\t\t\t";
        }
        // line 2031
        echo "\t\t\t
\t  attributeautocomplete(attribute_row);

\t  attribute_row++;
  }

  function attributeautocomplete(attribute_row) {
\t  \$('input[name=\\'product_attribute[' + attribute_row + '][name]\\']').autocomplete({
\t\t  'source': function(request, response) {
\t\t\t  \$.ajax({
\t\t\t\t  url: 'index.php?route=catalog/attribute/autocomplete&user_token=";
        // line 2041
        echo ($context["user_token"] ?? null);
        echo "&filter_name=' + encodeURIComponent(request),
\t\t\t\t  dataType: 'json',
\t\t\t\t  success: function(json) {

\t\t\t\t";
        // line 2045
        if ((($context["module_atpresets_installed"] ?? null) == 1)) {
            // line 2046
            echo "\t\t\t\t\t";
            if ((($context["module_atpresets_selecttype"] ?? null) == 0)) {
                // line 2047
                echo "\t\t\t\t\t\tif (encodeURIComponent(request)=='') {
\t\t\t\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][attribute_id]\\']').val('');
\t\t\t\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][preset]\\']').unbind(\"blur\");
\t\t\t\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][preset]\\']').unbind(\"focus\");
\t\t\t\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][preset]\\']').unbind(\"keydown\");\t\t\t\t\t
\t\t\t\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][preset]\\']').val('');
\t\t\t\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][preset_id][]\\']').val(0);\t\t\t
\t\t\t\t\t\t\tpresetautocomplete(attribute_row);\t\t\t\t\t\t\t
\t\t\t\t\t\t}
\t\t\t\t\t";
            } else {
                // line 2057
                echo "\t\t\t\t\t\tif (encodeURIComponent(request)=='') {
\t\t\t\t\t\t\t\$('.att' + attribute_row).show();
\t\t\t\t\t\t\t\$('.pre' + attribute_row).show();
\t\t\t\t\t\t\t\$('select[name=\\'product_attribute[' + attribute_row + '][preset_id][]\\']').val(-1);\t\t\t\t\t\t\t
\t\t\t\t\t\t}\t\t\t\t\t\t
\t\t\t\t\t";
            }
            // line 2063
            echo "\t\t\t\t";
        }
        // line 2064
        echo "\t\t\t
\t\t\t\t\t  response(\$.map(json, function(item) {
\t\t\t\t\t\t  return {
\t\t\t\t\t\t\t  category: item.attribute_group,
\t\t\t\t\t\t\t  label: item.name,
\t\t\t\t\t\t\t  value: item.attribute_id
\t\t\t\t\t\t  }
\t\t\t\t\t  }));
\t\t\t\t  }
\t\t\t  });
\t\t  },
\t\t  'select': function(item) {
\t\t\t  \$('input[name=\\'product_attribute[' + attribute_row + '][name]\\']').val(item['label']);
\t\t\t  \t\t\t
\t\t\tif (item['value'] != \$('input[name=\\'product_attribute[' + attribute_row + '][attribute_id]\\']').val()) {\t\t\t\t
\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][attribute_id]\\']').val(item['value']);\t\t\t
\t\t\t\t";
        // line 2080
        if ((($context["module_atpresets_installed"] ?? null) == 1)) {
            // line 2081
            echo "\t\t\t\t\t";
            if ((($context["module_atpresets_selecttype"] ?? null) == 0)) {
                // line 2082
                echo "\t\t\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][preset]\\']').unbind(\"blur\");
\t\t\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][preset]\\']').unbind(\"focus\");
\t\t\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][preset]\\']').unbind(\"keydown\");\t\t\t\t\t
\t\t\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][preset]\\']').val('');
\t\t\t\t\t\t\$('input[name=\\'product_attribute[' + attribute_row + '][preset_id]\\']').val(0);\t\t\t
\t\t\t\t\t\tpresetautocomplete(attribute_row);
\t\t\t\t\t";
            } else {
                // line 2089
                echo "\t\t\t\t\t\t\$('.att' + attribute_row).hide();
\t\t\t\t\t\t\$('.pre' + attribute_row).hide();
\t\t\t\t\t\t\$('.pre' + attribute_row + '-' + item['value']).show();\t
\t\t\t\t\t\t\$('select[name=\\'product_attribute[' + attribute_row + '][preset_id][]\\']').val(-1);\t\t\t\t\t\t
\t\t\t\t\t";
            }
            // line 2094
            echo "\t\t\t\t";
        }
        // line 2095
        echo "\t\t\t}
\t\t\t
\t\t  }
\t  });
  }

  \$('#attribute tbody tr').each(function(index, element) {
\t  attributeautocomplete(index);
  });
  //--></script>

\t\t\t\t  <script type=\"text/javascript\"><!--
\t\t\t\t\t  ";
        // line 2107
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 2108
            echo "\t\t\t\t\t      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 2109
                echo "\t\t\t\t\t          \$(document).ready(function() {
\t\t\t\t\t               \$('input[name=\"product_description[";
                // line 2110
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 2110);
                echo "][name]\"]').stringToSlug({
\t\t\t\t\t                 setEvents: 'keyup keydown blur',
\t\t\t\t\t                 getPut: 'input[name=\"product_seo_url[";
                // line 2112
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 2112);
                echo "][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 2112);
                echo "]\"]',
\t\t\t\t\t                 space: '-',
\t\t\t\t\t                 replace: '/\\s?\\([^\\)]*\\)/gi',
\t\t\t\t\t                 AND: 'e'
\t\t\t\t\t               });
\t\t\t\t\t          });
\t\t\t\t\t        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 2119
            echo "\t\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 2120
        echo "\t\t\t\t\t  //--></script>
\t\t\t
  <script type=\"text/javascript\"><!--
  var option_row = ";
        // line 2123
        echo ($context["option_row"] ?? null);
        echo ";

  \$('input[name=\\'option\\']').autocomplete({
\t  'source': function(request, response) {
\t\t  \$.ajax({
\t\t\t  url: 'index.php?route=catalog/option/autocomplete&user_token=";
        // line 2128
        echo ($context["user_token"] ?? null);
        echo "&filter_name=' + encodeURIComponent(request),
\t\t\t  dataType: 'json',
\t\t\t  success: function(json) {
\t\t\t\t  response(\$.map(json, function(item) {
\t\t\t\t\t  return {
\t\t\t\t\t\t  category: item['category'],
\t\t\t\t\t\t  label: item['name'],
\t\t\t\t\t\t  value: item['option_id'],
\t\t\t\t\t\t  type: item['type'],
\t\t\t\t\t\t  option_value: item['option_value']
\t\t\t\t\t  }
\t\t\t\t  }));
\t\t\t  }
\t\t  });
\t  },
\t  'select': function(item) {
\t\t  html = '<div class=\"tab-pane\" id=\"tab-option' + option_row + '\">';
\t\t  html += '\t<input type=\"hidden\" name=\"product_option[' + option_row + '][product_option_id]\" value=\"\" />';
\t\t  html += '\t<input type=\"hidden\" name=\"product_option[' + option_row + '][name]\" value=\"' + item['label'] + '\" />';
\t\t  html += '\t<input type=\"hidden\" name=\"product_option[' + option_row + '][option_id]\" value=\"' + item['value'] + '\" />';
\t\t  html += '\t<input type=\"hidden\" name=\"product_option[' + option_row + '][type]\" value=\"' + item['type'] + '\" />';

\t\t  html += '\t<div class=\"form-group\">';
\t\t  html += '\t  <label class=\"col-sm-2 control-label\" for=\"input-required' + option_row + '\">";
        // line 2151
        echo ($context["entry_required"] ?? null);
        echo "</label>';
\t\t  html += '\t  <div class=\"col-sm-10\"><select name=\"product_option[' + option_row + '][required]\" id=\"input-required' + option_row + '\" class=\"form-control\">';
\t\t  html += '\t      <option value=\"1\">";
        // line 2153
        echo ($context["text_yes"] ?? null);
        echo "</option>';
\t\t  html += '\t      <option value=\"0\">";
        // line 2154
        echo ($context["text_no"] ?? null);
        echo "</option>';
\t\t  html += '\t  </select></div>';
\t\t  html += '\t</div>';

\t\t  if (item['type'] == 'text') {
\t\t\t  html += '\t<div class=\"form-group\">';
\t\t\t  html += '\t  <label class=\"col-sm-2 control-label\" for=\"input-value' + option_row + '\">";
        // line 2160
        echo ($context["entry_option_value"] ?? null);
        echo "</label>';
\t\t\t  html += '\t  <div class=\"col-sm-10\"><input type=\"text\" name=\"product_option[' + option_row + '][value]\" value=\"\" placeholder=\"";
        // line 2161
        echo ($context["entry_option_value"] ?? null);
        echo "\" id=\"input-value' + option_row + '\" class=\"form-control\" /></div>';
\t\t\t  html += '\t</div>';
\t\t  }

\t\t  if (item['type'] == 'textarea') {
\t\t\t  html += '\t<div class=\"form-group\">';
\t\t\t  html += '\t  <label class=\"col-sm-2 control-label\" for=\"input-value' + option_row + '\">";
        // line 2167
        echo ($context["entry_option_value"] ?? null);
        echo "</label>';
\t\t\t  html += '\t  <div class=\"col-sm-10\"><textarea name=\"product_option[' + option_row + '][value]\" rows=\"5\" placeholder=\"";
        // line 2168
        echo ($context["entry_option_value"] ?? null);
        echo "\" id=\"input-value' + option_row + '\" class=\"form-control\"></textarea></div>';
\t\t\t  html += '\t</div>';
\t\t  }

\t\t  if (item['type'] == 'file') {
\t\t\t  html += '\t<div class=\"form-group\" style=\"display: none;\">';
\t\t\t  html += '\t  <label class=\"col-sm-2 control-label\" for=\"input-value' + option_row + '\">";
        // line 2174
        echo ($context["entry_option_value"] ?? null);
        echo "</label>';
\t\t\t  html += '\t  <div class=\"col-sm-10\"><input type=\"text\" name=\"product_option[' + option_row + '][value]\" value=\"\" placeholder=\"";
        // line 2175
        echo ($context["entry_option_value"] ?? null);
        echo "\" id=\"input-value' + option_row + '\" class=\"form-control\" /></div>';
\t\t\t  html += '\t</div>';
\t\t  }

\t\t  if (item['type'] == 'date') {
\t\t\t  html += '\t<div class=\"form-group\">';
\t\t\t  html += '\t  <label class=\"col-sm-2 control-label\" for=\"input-value' + option_row + '\">";
        // line 2181
        echo ($context["entry_option_value"] ?? null);
        echo "</label>';
\t\t\t  html += '\t  <div class=\"col-sm-3\"><div class=\"input-group date\"><input type=\"text\" name=\"product_option[' + option_row + '][value]\" value=\"\" placeholder=\"";
        // line 2182
        echo ($context["entry_option_value"] ?? null);
        echo "\" data-date-format=\"YYYY-MM-DD\" id=\"input-value' + option_row + '\" class=\"form-control\" /><span class=\"input-group-btn\"><button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button></span></div></div>';
\t\t\t  html += '\t</div>';
\t\t  }

\t\t  if (item['type'] == 'time') {
\t\t\t  html += '\t<div class=\"form-group\">';
\t\t\t  html += '\t  <label class=\"col-sm-2 control-label\" for=\"input-value' + option_row + '\">";
        // line 2188
        echo ($context["entry_option_value"] ?? null);
        echo "</label>';
\t\t\t  html += '\t  <div class=\"col-sm-10\"><div class=\"input-group time\"><input type=\"text\" name=\"product_option[' + option_row + '][value]\" value=\"\" placeholder=\"";
        // line 2189
        echo ($context["entry_option_value"] ?? null);
        echo "\" data-date-format=\"HH:mm\" id=\"input-value' + option_row + '\" class=\"form-control\" /><span class=\"input-group-btn\"><button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button></span></div></div>';
\t\t\t  html += '\t</div>';
\t\t  }

\t\t  if (item['type'] == 'datetime') {
\t\t\t  html += '\t<div class=\"form-group\">';
\t\t\t  html += '\t  <label class=\"col-sm-2 control-label\" for=\"input-value' + option_row + '\">";
        // line 2195
        echo ($context["entry_option_value"] ?? null);
        echo "</label>';
\t\t\t  html += '\t  <div class=\"col-sm-10\"><div class=\"input-group datetime\"><input type=\"text\" name=\"product_option[' + option_row + '][value]\" value=\"\" placeholder=\"";
        // line 2196
        echo ($context["entry_option_value"] ?? null);
        echo "\" data-date-format=\"YYYY-MM-DD HH:mm\" id=\"input-value' + option_row + '\" class=\"form-control\" /><span class=\"input-group-btn\"><button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button></span></div></div>';
\t\t\t  html += '\t</div>';
\t\t  }

\t\t  if (item['type'] == 'select' || item['type'] == 'radio' || item['type'] == 'checkbox' || item['type'] == 'image') {
\t\t\t  html += '<div class=\"table-responsive\">';
\t\t\t  html += '  <table id=\"option-value' + option_row + '\" class=\"table table-striped table-bordered table-hover\">';
\t\t\t  html += '  \t <thead>';
\t\t\t  html += '      <tr>';
\t\t\t  html += '        <td class=\"text-left\">";
        // line 2205
        echo ($context["entry_option_value"] ?? null);
        echo "</td>';
\t\t\t  html += '        <td class=\"text-right\">";
        // line 2206
        echo ($context["entry_quantity"] ?? null);
        echo "</td>';
\t\t\t  html += '        <td class=\"text-left\">";
        // line 2207
        echo ($context["entry_subtract"] ?? null);
        echo "</td>';
\t\t\t  html += '        <td class=\"text-right\">";
        // line 2208
        echo ($context["entry_price"] ?? null);
        echo "</td>';
\t\t\t  html += '        <td class=\"text-right\">";
        // line 2209
        echo ($context["entry_option_points"] ?? null);
        echo "</td>';
\t\t\t  html += '        <td class=\"text-right\">";
        // line 2210
        echo ($context["entry_weight"] ?? null);
        echo "</td> ";
        if (((($context["poip_installed"]) ?? (false)) &&  !(($__internal_compile_85 = ($context["poip_global_settings"] ?? null)) && is_array($__internal_compile_85) || $__internal_compile_85 instanceof ArrayAccess ? ($__internal_compile_85["options_images_edit"] ?? null) : null))) {
            echo " <td class=\"text-left poip-container-option-images\" >";
            echo ($context["entry_image"] ?? null);
            echo "</td>";
        }
        echo "';
\t\t\t  html += '        <td></td>';
\t\t\t  html += '      </tr>';
\t\t\t  html += '  \t </thead>';
\t\t\t  html += '  \t <tbody>';
\t\t\t  html += '    </tbody>';
\t\t\t  html += '    <tfoot>';
\t\t\t  html += '      <tr>';
\t\t\t  html += '        <td colspan=\"6\"></td>';
\t\t\t  html += '        ";
        // line 2219
        if (((($context["poip_installed"]) ?? (false)) &&  !(($__internal_compile_86 = ($context["poip_global_settings"] ?? null)) && is_array($__internal_compile_86) || $__internal_compile_86 instanceof ArrayAccess ? ($__internal_compile_86["options_images_edit"] ?? null) : null))) {
            echo "<td></td>";
        }
        echo "<td class=\"text-left\"><button type=\"button\" onclick=\"addOptionValue(' + option_row + ');\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_option_value_add"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus-circle\"></i></button></td>';
\t\t\t  html += '      </tr>';
\t\t\t  html += '    </tfoot>';
\t\t\t  html += '  </table>';
\t\t\t  html += '</div>';

\t\t\t  html += '  <select id=\"option-values' + option_row + '\" style=\"display: none;\">';

\t\t\t  for (i = 0; i < item['option_value'].length; i++) {
\t\t\t\t  html += '  <option value=\"' + item['option_value'][i]['option_value_id'] + '\">' + item['option_value'][i]['name'] + '</option>';
\t\t\t  }

\t\t\t  html += '  </select>';
\t\t\t  html += '</div>';
\t\t  }

\t\t  \$('#tab-option .tab-content').append(html);

\t\t\t\t// << Product Option Image PRO module 
\t\t\t\t";
        // line 2238
        if ((($context["poip_installed"]) ?? (false))) {
            // line 2239
            echo "\t\t\t\t\tpoip.displayProductOptionSettings( option_row, item['type'] );
\t\t\t\t";
        }
        // line 2241
        echo "\t\t\t\t// >> Product Option Image PRO module 
\t\t\t

\t\t  \$('#option > li:last-child').before('<li><a href=\"#tab-option' + option_row + '\" data-toggle=\"tab\"><i class=\"fa fa-minus-circle\" onclick=\" \$(\\'#option a:first\\').tab(\\'show\\');\$(\\'a[href=\\\\\\'#tab-option' + option_row + '\\\\\\']\\').parent().remove(); \$(\\'#tab-option' + option_row + '\\').remove();\"></i>' + item['label'] + '</li>');

\t\t  \$('#option a[href=\\'#tab-option' + option_row + '\\']').tab('show');

\t\t  \$('[data-toggle=\\'tooltip\\']').tooltip({
\t\t\t  container: 'body',
\t\t\t  html: true
\t\t  });

\t\t  \$('.date').datetimepicker({
\t\t\t  language: '";
        // line 2254
        echo ($context["datepicker"] ?? null);
        echo "',
\t\t\t  pickTime: false
\t\t  });

\t\t  \$('.time').datetimepicker({
\t\t\t  language: '";
        // line 2259
        echo ($context["datepicker"] ?? null);
        echo "',
\t\t\t  pickDate: false
\t\t  });

\t\t  \$('.datetime').datetimepicker({
\t\t\t  language: '";
        // line 2264
        echo ($context["datepicker"] ?? null);
        echo "',
\t\t\t  pickDate: true,
\t\t\t  pickTime: true
\t\t  });

\t\t  option_row++;
\t  }
  });
  //--></script>

\t\t\t\t  <script type=\"text/javascript\"><!--
\t\t\t\t\t  ";
        // line 2275
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 2276
            echo "\t\t\t\t\t      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 2277
                echo "\t\t\t\t\t          \$(document).ready(function() {
\t\t\t\t\t               \$('input[name=\"product_description[";
                // line 2278
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 2278);
                echo "][name]\"]').stringToSlug({
\t\t\t\t\t                 setEvents: 'keyup keydown blur',
\t\t\t\t\t                 getPut: 'input[name=\"product_seo_url[";
                // line 2280
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 2280);
                echo "][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 2280);
                echo "]\"]',
\t\t\t\t\t                 space: '-',
\t\t\t\t\t                 replace: '/\\s?\\([^\\)]*\\)/gi',
\t\t\t\t\t                 AND: 'e'
\t\t\t\t\t               });
\t\t\t\t\t          });
\t\t\t\t\t        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 2287
            echo "\t\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 2288
        echo "\t\t\t\t\t  //--></script>
\t\t\t
  <script type=\"text/javascript\"><!--
  var option_value_row = ";
        // line 2291
        echo ($context["option_value_row"] ?? null);
        echo ";

  function addOptionValue(option_row) {
\t  html = '<tr id=\"option-value-row' + option_value_row + '\">';
\t  html += '  <td class=\"text-left\"><select name=\"product_option[' + option_row + '][product_option_value][' + option_value_row + '][option_value_id]\" class=\"form-control\">';
\t  html += \$('#option-values' + option_row).html();
\t  html += '  </select><input type=\"hidden\" name=\"product_option[' + option_row + '][product_option_value][' + option_value_row + '][product_option_value_id]\" value=\"\" /></td>';
\t  html += '  <td class=\"text-right\"><input type=\"text\" name=\"product_option[' + option_row + '][product_option_value][' + option_value_row + '][quantity]\" value=\"\" placeholder=\"";
        // line 2298
        echo ($context["entry_quantity"] ?? null);
        echo "\" class=\"form-control\" /></td>';
\t  html += '  <td class=\"text-left\"><select name=\"product_option[' + option_row + '][product_option_value][' + option_value_row + '][subtract]\" class=\"form-control\">';
\t  html += '    <option value=\"1\">";
        // line 2300
        echo ($context["text_yes"] ?? null);
        echo "</option>';
\t  html += '    <option value=\"0\">";
        // line 2301
        echo ($context["text_no"] ?? null);
        echo "</option>';
\t  html += '  </select></td>';
\t  html += '  <td class=\"text-right\"><select name=\"product_option[' + option_row + '][product_option_value][' + option_value_row + '][price_prefix]\" class=\"form-control\">';
\t  html += '    <option value=\"+\">+</option>';
\t  html += '    <option value=\"-\">-</option>';
\t  html += '  </select>';
\t  html += '  <input type=\"text\" name=\"product_option[' + option_row + '][product_option_value][' + option_value_row + '][price]\" value=\"\" placeholder=\"";
        // line 2307
        echo ($context["entry_price"] ?? null);
        echo "\" class=\"form-control\" /></td>';
\t  html += '  <td class=\"text-right\"><select name=\"product_option[' + option_row + '][product_option_value][' + option_value_row + '][points_prefix]\" class=\"form-control\">';
\t  html += '    <option value=\"+\">+</option>';
\t  html += '    <option value=\"-\">-</option>';
\t  html += '  </select>';
\t  html += '  <input type=\"text\" name=\"product_option[' + option_row + '][product_option_value][' + option_value_row + '][points]\" value=\"\" placeholder=\"";
        // line 2312
        echo ($context["entry_points"] ?? null);
        echo "\" class=\"form-control\" /></td>';
\t  html += '  <td class=\"text-right\"><select name=\"product_option[' + option_row + '][product_option_value][' + option_value_row + '][weight_prefix]\" class=\"form-control\">';
\t  html += '    <option value=\"+\">+</option>';
\t  html += '    <option value=\"-\">-</option>';
\t  html += '  </select>';
\t  html += '  <input type=\"text\" name=\"product_option[' + option_row + '][product_option_value][' + option_value_row + '][weight]\" value=\"\" placeholder=\"";
        // line 2317
        echo ($context["entry_weight"] ?? null);
        echo "\" class=\"form-control\" /></td>';

\t\t\t\t// << Product Option Image PRO module
\t\t\t\t";
        // line 2320
        if (((($context["poip_installed"]) ?? (false)) &&  !(($__internal_compile_87 = ($context["poip_global_settings"] ?? null)) && is_array($__internal_compile_87) || $__internal_compile_87 instanceof ArrayAccess ? ($__internal_compile_87["options_images_edit"] ?? null) : null))) {
            // line 2321
            echo "\t\t\t\t\thtml += '<td><button type=\"button\" class=\"btn btn-default\" onclick=\"poip.addProductOptionImage('+option_row+', '+option_value_row+');\" title=\"";
            echo twig_escape_filter($this->env, ($context["button_image_add"] ?? null));
            echo "\"><i class=\"fa fa-plus-circle\"></i></button>';
\t\t\t\t\t";
            // line 2322
            if ((($context["poip_version_ultimate"]) ?? (false))) {
                // line 2323
                echo "\t\t\t\t\t\t\thtml += ' <button type=\"button\" class=\"btn btn-default\" onclick=\"poiu.openImageFilemanager(\$(this), \\'option_images'+option_row+'_'+option_value_row+'\\', \\'\\')\" title=\"";
                echo twig_escape_filter($this->env, ($context["button_add_images"] ?? null));
                echo "\">';
\t\t\t\t\t\t\thtml += '<i class=\"fa fa-plus-circle\"></i><i class=\"fa fa-plus-circle\"></i>';
\t\t\t\t\t\t\thtml += '</button> ';
\t\t\t\t\t";
            }
            // line 2327
            echo "\t\t\t\t\thtml += '<div id=\"option_images'+option_row+'_'+option_value_row+'\" data-poip-option-row=\"'+option_row+'\" data-poip-option-value-row=\"'+option_value_row+'\" class=\"poip-option-images-grid\"></div></td>';
\t\t\t\t";
        }
        // line 2329
        echo "\t\t\t\t// >> Product Option Image PRO module
\t\t\t
\t  html += '  <td class=\"text-left\"><button type=\"button\" onclick=\"\$(this).tooltip(\\'destroy\\');\$(\\'#option-value-row' + option_value_row + '\\').remove();\" data-toggle=\"tooltip\" rel=\"tooltip\" title=\"";
        // line 2331
        echo ($context["button_remove"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>';
\t  html += '</tr>';

\t  \$('#option-value' + option_row + ' tbody').append(html);
\t  \$('[rel=tooltip]').tooltip();

\t  option_value_row++;
  }

  //--></script>

\t\t\t\t  <script type=\"text/javascript\"><!--
\t\t\t\t\t  ";
        // line 2343
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 2344
            echo "\t\t\t\t\t      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 2345
                echo "\t\t\t\t\t          \$(document).ready(function() {
\t\t\t\t\t               \$('input[name=\"product_description[";
                // line 2346
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 2346);
                echo "][name]\"]').stringToSlug({
\t\t\t\t\t                 setEvents: 'keyup keydown blur',
\t\t\t\t\t                 getPut: 'input[name=\"product_seo_url[";
                // line 2348
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 2348);
                echo "][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 2348);
                echo "]\"]',
\t\t\t\t\t                 space: '-',
\t\t\t\t\t                 replace: '/\\s?\\([^\\)]*\\)/gi',
\t\t\t\t\t                 AND: 'e'
\t\t\t\t\t               });
\t\t\t\t\t          });
\t\t\t\t\t        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 2355
            echo "\t\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 2356
        echo "\t\t\t\t\t  //--></script>
\t\t\t
  <script type=\"text/javascript\"><!--
  var discount_row = ";
        // line 2359
        echo ($context["discount_row"] ?? null);
        echo ";

  function addDiscount() {
\t  html = '<tr id=\"discount-row' + discount_row + '\">';
\t  html += '  <td class=\"text-left\"><select name=\"product_discount[' + discount_row + '][customer_group_id]\" class=\"form-control\">';
    ";
        // line 2364
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["customer_groups"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["customer_group"]) {
            // line 2365
            echo "\t  html += '    <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 2365);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 2365), "js");
            echo "</option>';
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['customer_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 2367
        echo "\t  html += '  </select></td>';
\t  html += '  <td class=\"text-right\"><input type=\"text\" name=\"product_discount[' + discount_row + '][quantity]\" value=\"\" placeholder=\"";
        // line 2368
        echo ($context["entry_quantity"] ?? null);
        echo "\" class=\"form-control\" /></td>';
\t  html += '  <td class=\"text-right\"><input type=\"text\" name=\"product_discount[' + discount_row + '][priority]\" value=\"\" placeholder=\"";
        // line 2369
        echo ($context["entry_priority"] ?? null);
        echo "\" class=\"form-control\" /></td>';
\t  html += '  <td class=\"text-right\"><input type=\"text\" name=\"product_discount[' + discount_row + '][price]\" value=\"\" placeholder=\"";
        // line 2370
        echo ($context["entry_price"] ?? null);
        echo "\" class=\"form-control\" /></td>';
\t  html += '  <td class=\"text-left\" style=\"width: 20%;\"><div class=\"input-group date\"><input type=\"text\" name=\"product_discount[' + discount_row + '][date_start]\" value=\"\" placeholder=\"";
        // line 2371
        echo ($context["entry_date_start"] ?? null);
        echo "\" data-date-format=\"YYYY-MM-DD\" class=\"form-control\" /><span class=\"input-group-btn\"><button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button></span></div></td>';
\t  html += '  <td class=\"text-left\" style=\"width: 20%;\"><div class=\"input-group date\"><input type=\"text\" name=\"product_discount[' + discount_row + '][date_end]\" value=\"\" placeholder=\"";
        // line 2372
        echo ($context["entry_date_end"] ?? null);
        echo "\" data-date-format=\"YYYY-MM-DD\" class=\"form-control\" /><span class=\"input-group-btn\"><button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button></span></div></td>';
\t  html += '  <td class=\"text-left\"><button type=\"button\" onclick=\"\$(\\'#discount-row' + discount_row + '\\').remove();\" data-toggle=\"tooltip\" title=\"";
        // line 2373
        echo ($context["button_remove"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>';
\t  html += '</tr>';

\t  \$('#discount tbody').append(html);

\t  \$('.date').datetimepicker({
\t\t  pickTime: false
\t  });

\t  discount_row++;
  }

  //--></script>

\t\t\t\t  <script type=\"text/javascript\"><!--
\t\t\t\t\t  ";
        // line 2388
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 2389
            echo "\t\t\t\t\t      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 2390
                echo "\t\t\t\t\t          \$(document).ready(function() {
\t\t\t\t\t               \$('input[name=\"product_description[";
                // line 2391
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 2391);
                echo "][name]\"]').stringToSlug({
\t\t\t\t\t                 setEvents: 'keyup keydown blur',
\t\t\t\t\t                 getPut: 'input[name=\"product_seo_url[";
                // line 2393
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 2393);
                echo "][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 2393);
                echo "]\"]',
\t\t\t\t\t                 space: '-',
\t\t\t\t\t                 replace: '/\\s?\\([^\\)]*\\)/gi',
\t\t\t\t\t                 AND: 'e'
\t\t\t\t\t               });
\t\t\t\t\t          });
\t\t\t\t\t        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 2400
            echo "\t\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 2401
        echo "\t\t\t\t\t  //--></script>
\t\t\t
  <script type=\"text/javascript\"><!--
  var special_row = ";
        // line 2404
        echo ($context["special_row"] ?? null);
        echo ";

  function addSpecial() {
\t  html = '<tr id=\"special-row' + special_row + '\">';
\t  html += '  <td class=\"text-left\"><select name=\"product_special[' + special_row + '][customer_group_id]\" class=\"form-control\">';
    ";
        // line 2409
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["customer_groups"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["customer_group"]) {
            // line 2410
            echo "\t  html += '      <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 2410);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 2410), "js");
            echo "</option>';
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['customer_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 2412
        echo "\t  html += '  </select></td>';
\t  html += '  <td class=\"text-right\"><input type=\"text\" name=\"product_special[' + special_row + '][priority]\" value=\"\" placeholder=\"";
        // line 2413
        echo ($context["entry_priority"] ?? null);
        echo "\" class=\"form-control\" /></td>';
\t  html += '  <td class=\"text-right\"><input type=\"text\" name=\"product_special[' + special_row + '][price]\" value=\"\" placeholder=\"";
        // line 2414
        echo ($context["entry_price"] ?? null);
        echo "\" class=\"form-control\" /></td>';
\t  html += '  <td class=\"text-left\" style=\"width: 20%;\"><div class=\"input-group date\"><input type=\"text\" name=\"product_special[' + special_row + '][date_start]\" value=\"\" placeholder=\"";
        // line 2415
        echo ($context["entry_date_start"] ?? null);
        echo "\" data-date-format=\"YYYY-MM-DD\" class=\"form-control\" /><span class=\"input-group-btn\"><button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button></span></div></td>';
\t  html += '  <td class=\"text-left\" style=\"width: 20%;\"><div class=\"input-group date\"><input type=\"text\" name=\"product_special[' + special_row + '][date_end]\" value=\"\" placeholder=\"";
        // line 2416
        echo ($context["entry_date_end"] ?? null);
        echo "\" data-date-format=\"YYYY-MM-DD\" class=\"form-control\" /><span class=\"input-group-btn\"><button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button></span></div></td>';
\t  html += '  <td class=\"text-left\"><button type=\"button\" onclick=\"\$(\\'#special-row' + special_row + '\\').remove();\" data-toggle=\"tooltip\" title=\"";
        // line 2417
        echo ($context["button_remove"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>';
\t  html += '</tr>';

\t  \$('#special tbody').append(html);

\t  \$('.date').datetimepicker({
\t\t  language: '";
        // line 2423
        echo ($context["datepicker"] ?? null);
        echo "',
\t\t  pickTime: false
\t  });

\t  special_row++;
  }

  //--></script>

\t\t\t\t  <script type=\"text/javascript\"><!--
\t\t\t\t\t  ";
        // line 2433
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 2434
            echo "\t\t\t\t\t      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 2435
                echo "\t\t\t\t\t          \$(document).ready(function() {
\t\t\t\t\t               \$('input[name=\"product_description[";
                // line 2436
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 2436);
                echo "][name]\"]').stringToSlug({
\t\t\t\t\t                 setEvents: 'keyup keydown blur',
\t\t\t\t\t                 getPut: 'input[name=\"product_seo_url[";
                // line 2438
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 2438);
                echo "][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 2438);
                echo "]\"]',
\t\t\t\t\t                 space: '-',
\t\t\t\t\t                 replace: '/\\s?\\([^\\)]*\\)/gi',
\t\t\t\t\t                 AND: 'e'
\t\t\t\t\t               });
\t\t\t\t\t          });
\t\t\t\t\t        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 2445
            echo "\t\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 2446
        echo "\t\t\t\t\t  //--></script>
\t\t\t
  <script type=\"text/javascript\"><!--
  var image_row = ";
        // line 2449
        echo ($context["image_row"] ?? null);
        echo ";

  function addImage() {
\t  html = '<tr id=\"image-row' + image_row + '\">';
\t  html += '  <td class=\"text-left\"><a href=\"\" id=\"thumb-image' + image_row + '\"data-toggle=\"image\" class=\"img-thumbnail\"><img src=\"";
        // line 2453
        echo ($context["placeholder"] ?? null);
        echo "\" alt=\"\" title=\"\" data-placeholder=\"";
        echo ($context["placeholder"] ?? null);
        echo "\" /></a><input type=\"hidden\" name=\"product_image[' + image_row + '][image]\" value=\"\" id=\"input-image' + image_row + '\" /></td>';
\t  html += '  <td class=\"text-right\"><input type=\"text\" name=\"product_image[' + image_row + '][sort_order]\" value=\"\" placeholder=\"";
        // line 2454
        echo ($context["entry_sort_order"] ?? null);
        echo "\" class=\"form-control\" /></td>';
\t  html += '  <td class=\"text-left\"><button type=\"button\" onclick=\"\$(\\'#image-row' + image_row + '\\').remove();\" data-toggle=\"tooltip\" title=\"";
        // line 2455
        echo ($context["button_remove"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>';
\t  html += '</tr>';

\t  \$('#images tbody').append(html);

\t\t\t\t<!-- Product Option Image PRO module << -->
\t\t\t\t";
        // line 2461
        if ((($context["poip_installed"]) ?? (false))) {
            // line 2462
            echo "\t\t\t\t\tpoip.triggerEvent('addImage_after');
\t\t\t\t";
        }
        // line 2464
        echo "\t\t\t\t
\t\t\t\t<!-- >> Product Option Image PRO module -->
\t\t\t

\t  image_row++;
  }

  //--></script>

\t\t\t\t  <script type=\"text/javascript\"><!--
\t\t\t\t\t  ";
        // line 2474
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 2475
            echo "\t\t\t\t\t      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 2476
                echo "\t\t\t\t\t          \$(document).ready(function() {
\t\t\t\t\t               \$('input[name=\"product_description[";
                // line 2477
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 2477);
                echo "][name]\"]').stringToSlug({
\t\t\t\t\t                 setEvents: 'keyup keydown blur',
\t\t\t\t\t                 getPut: 'input[name=\"product_seo_url[";
                // line 2479
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 2479);
                echo "][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 2479);
                echo "]\"]',
\t\t\t\t\t                 space: '-',
\t\t\t\t\t                 replace: '/\\s?\\([^\\)]*\\)/gi',
\t\t\t\t\t                 AND: 'e'
\t\t\t\t\t               });
\t\t\t\t\t          });
\t\t\t\t\t        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 2486
            echo "\t\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 2487
        echo "\t\t\t\t\t  //--></script>
\t\t\t
  <script type=\"text/javascript\"><!--
  var recurring_row = ";
        // line 2490
        echo ($context["recurring_row"] ?? null);
        echo ";

  function addRecurring() {
\t  html = '<tr id=\"recurring-row' + recurring_row + '\">';
\t  html += '  <td class=\"left\">';
\t  html += '    <select name=\"product_recurring[' + recurring_row + '][recurring_id]\" class=\"form-control\">>';
    ";
        // line 2496
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["recurrings"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["recurring"]) {
            // line 2497
            echo "\t  html += '      <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["recurring"], "recurring_id", [], "any", false, false, false, 2497);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["recurring"], "name", [], "any", false, false, false, 2497);
            echo "</option>';
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['recurring'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 2499
        echo "\t  html += '    </select>';
\t  html += '  </td>';
\t  html += '  <td class=\"left\">';
\t  html += '    <select name=\"product_recurring[' + recurring_row + '][customer_group_id]\" class=\"form-control\">>';
    ";
        // line 2503
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["customer_groups"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["customer_group"]) {
            // line 2504
            echo "\t  html += '      <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 2504);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 2504);
            echo "</option>';
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['customer_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 2506
        echo "\t  html += '    <select>';
\t  html += '  </td>';
\t  html += '  <td class=\"left\">';
\t  html += '    <a onclick=\"\$(\\'#recurring-row' + recurring_row + '\\').remove()\" data-toggle=\"tooltip\" title=\"";
        // line 2509
        echo ($context["button_remove"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></a>';
\t  html += '  </td>';
\t  html += '</tr>';

\t  \$('#tab-recurring table tbody').append(html);

\t  recurring_row++;
  }

  //--></script>

\t\t\t\t  <script type=\"text/javascript\"><!--
\t\t\t\t\t  ";
        // line 2521
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 2522
            echo "\t\t\t\t\t      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 2523
                echo "\t\t\t\t\t          \$(document).ready(function() {
\t\t\t\t\t               \$('input[name=\"product_description[";
                // line 2524
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 2524);
                echo "][name]\"]').stringToSlug({
\t\t\t\t\t                 setEvents: 'keyup keydown blur',
\t\t\t\t\t                 getPut: 'input[name=\"product_seo_url[";
                // line 2526
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 2526);
                echo "][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 2526);
                echo "]\"]',
\t\t\t\t\t                 space: '-',
\t\t\t\t\t                 replace: '/\\s?\\([^\\)]*\\)/gi',
\t\t\t\t\t                 AND: 'e'
\t\t\t\t\t               });
\t\t\t\t\t          });
\t\t\t\t\t        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 2533
            echo "\t\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 2534
        echo "\t\t\t\t\t  //--></script>
\t\t\t
  <script type=\"text/javascript\"><!--
  \$('.date').datetimepicker({
\t  language: '";
        // line 2538
        echo ($context["datepicker"] ?? null);
        echo "',
\t  pickTime: false
  });

  \$('.time').datetimepicker({
\t  language: '";
        // line 2543
        echo ($context["datepicker"] ?? null);
        echo "',
\t  pickDate: false
  });

  \$('.datetime').datetimepicker({
\t  language: '";
        // line 2548
        echo ($context["datepicker"] ?? null);
        echo "',
\t  pickDate: true,
\t  pickTime: true
  });
  //--></script>

\t\t\t\t  <script type=\"text/javascript\"><!--
\t\t\t\t\t  ";
        // line 2555
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 2556
            echo "\t\t\t\t\t      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 2557
                echo "\t\t\t\t\t          \$(document).ready(function() {
\t\t\t\t\t               \$('input[name=\"product_description[";
                // line 2558
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 2558);
                echo "][name]\"]').stringToSlug({
\t\t\t\t\t                 setEvents: 'keyup keydown blur',
\t\t\t\t\t                 getPut: 'input[name=\"product_seo_url[";
                // line 2560
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 2560);
                echo "][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 2560);
                echo "]\"]',
\t\t\t\t\t                 space: '-',
\t\t\t\t\t                 replace: '/\\s?\\([^\\)]*\\)/gi',
\t\t\t\t\t                 AND: 'e'
\t\t\t\t\t               });
\t\t\t\t\t          });
\t\t\t\t\t        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 2567
            echo "\t\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 2568
        echo "\t\t\t\t\t  //--></script>
\t\t\t
  <script type=\"text/javascript\"><!--
  \$('#language a:first').tab('show');
  \$('#option a:first').tab('show');
  //--></script>
</div>

   <!--SF PRODUCTS IMAGE MANAGER-->
  ";
        // line 2577
        if ((($context["poip_global_settings"] ?? null) && (($__internal_compile_88 = ($context["poip_global_settings"] ?? null)) && is_array($__internal_compile_88) || $__internal_compile_88 instanceof ArrayAccess ? ($__internal_compile_88["options_images_edit"] ?? null) : null))) {
            // line 2578
            echo "  \t<script type=\"text/javascript\" src=\"view/template/extension/sf_products_image_manager/js/poip-support.js\"></script>
  ";
        }
        // line 2580
        echo "  <script type=\"text/javascript\">pimJson = ";
        echo json_encode(($context["pim_data"] ?? null));
        echo "</script>
  <script type=\"text/javascript\" src=\"view/template/extension/sf_products_image_manager/js/jquery-ui.js\"></script>
  <script type=\"text/javascript\" src=\"view/template/extension/sf_products_image_manager/js/pim.js?v=3.0.8\"></script>
   <!--/SF PRODUCTS IMAGE MANAGER-->
  
";
        // line 2585
        echo ($context["footer"] ?? null);
        echo " 
";
    }

    public function getTemplateName()
    {
        return "catalog/product_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  5732 => 2585,  5723 => 2580,  5719 => 2578,  5717 => 2577,  5706 => 2568,  5700 => 2567,  5685 => 2560,  5680 => 2558,  5677 => 2557,  5672 => 2556,  5668 => 2555,  5658 => 2548,  5650 => 2543,  5642 => 2538,  5636 => 2534,  5630 => 2533,  5615 => 2526,  5610 => 2524,  5607 => 2523,  5602 => 2522,  5598 => 2521,  5583 => 2509,  5578 => 2506,  5567 => 2504,  5563 => 2503,  5557 => 2499,  5546 => 2497,  5542 => 2496,  5533 => 2490,  5528 => 2487,  5522 => 2486,  5507 => 2479,  5502 => 2477,  5499 => 2476,  5494 => 2475,  5490 => 2474,  5478 => 2464,  5474 => 2462,  5472 => 2461,  5463 => 2455,  5459 => 2454,  5453 => 2453,  5446 => 2449,  5441 => 2446,  5435 => 2445,  5420 => 2438,  5415 => 2436,  5412 => 2435,  5407 => 2434,  5403 => 2433,  5390 => 2423,  5381 => 2417,  5377 => 2416,  5373 => 2415,  5369 => 2414,  5365 => 2413,  5362 => 2412,  5351 => 2410,  5347 => 2409,  5339 => 2404,  5334 => 2401,  5328 => 2400,  5313 => 2393,  5308 => 2391,  5305 => 2390,  5300 => 2389,  5296 => 2388,  5278 => 2373,  5274 => 2372,  5270 => 2371,  5266 => 2370,  5262 => 2369,  5258 => 2368,  5255 => 2367,  5244 => 2365,  5240 => 2364,  5232 => 2359,  5227 => 2356,  5221 => 2355,  5206 => 2348,  5201 => 2346,  5198 => 2345,  5193 => 2344,  5189 => 2343,  5174 => 2331,  5170 => 2329,  5166 => 2327,  5158 => 2323,  5156 => 2322,  5151 => 2321,  5149 => 2320,  5143 => 2317,  5135 => 2312,  5127 => 2307,  5118 => 2301,  5114 => 2300,  5109 => 2298,  5099 => 2291,  5094 => 2288,  5088 => 2287,  5073 => 2280,  5068 => 2278,  5065 => 2277,  5060 => 2276,  5056 => 2275,  5042 => 2264,  5034 => 2259,  5026 => 2254,  5011 => 2241,  5007 => 2239,  5005 => 2238,  4979 => 2219,  4961 => 2210,  4957 => 2209,  4953 => 2208,  4949 => 2207,  4945 => 2206,  4941 => 2205,  4929 => 2196,  4925 => 2195,  4916 => 2189,  4912 => 2188,  4903 => 2182,  4899 => 2181,  4890 => 2175,  4886 => 2174,  4877 => 2168,  4873 => 2167,  4864 => 2161,  4860 => 2160,  4851 => 2154,  4847 => 2153,  4842 => 2151,  4816 => 2128,  4808 => 2123,  4803 => 2120,  4797 => 2119,  4782 => 2112,  4777 => 2110,  4774 => 2109,  4769 => 2108,  4765 => 2107,  4751 => 2095,  4748 => 2094,  4741 => 2089,  4732 => 2082,  4729 => 2081,  4727 => 2080,  4709 => 2064,  4706 => 2063,  4698 => 2057,  4686 => 2047,  4683 => 2046,  4681 => 2045,  4674 => 2041,  4662 => 2031,  4658 => 2029,  4656 => 2028,  4648 => 2022,  4642 => 2020,  4634 => 2018,  4632 => 2017,  4628 => 2015,  4611 => 2013,  4607 => 2012,  4602 => 2010,  4595 => 2006,  4590 => 2003,  4584 => 2002,  4569 => 1995,  4564 => 1993,  4561 => 1992,  4556 => 1991,  4552 => 1990,  4546 => 1986,  4542 => 1984,  4533 => 1981,  4529 => 1980,  4524 => 1979,  4520 => 1978,  4506 => 1966,  4497 => 1965,  4493 => 1964,  4489 => 1962,  4479 => 1961,  4476 => 1960,  4472 => 1959,  4465 => 1955,  4455 => 1947,  4447 => 1946,  4442 => 1945,  4438 => 1944,  4406 => 1914,  4397 => 1913,  4393 => 1912,  4389 => 1910,  4379 => 1909,  4376 => 1908,  4372 => 1907,  4365 => 1903,  4352 => 1892,  4344 => 1890,  4339 => 1889,  4335 => 1888,  4301 => 1856,  4290 => 1854,  4286 => 1853,  4277 => 1847,  4269 => 1841,  4230 => 1805,  4199 => 1777,  4189 => 1769,  4187 => 1768,  4182 => 1765,  4176 => 1764,  4161 => 1757,  4156 => 1755,  4153 => 1754,  4148 => 1753,  4144 => 1752,  4134 => 1745,  4128 => 1741,  4124 => 1739,  4118 => 1737,  4109 => 1730,  4104 => 1727,  4102 => 1726,  4093 => 1720,  4088 => 1717,  4077 => 1716,  4073 => 1715,  4060 => 1704,  4054 => 1703,  4039 => 1696,  4034 => 1694,  4031 => 1693,  4026 => 1692,  4022 => 1691,  3992 => 1664,  3977 => 1651,  3972 => 1649,  3970 => 1648,  3948 => 1628,  3937 => 1625,  3932 => 1624,  3928 => 1623,  3916 => 1614,  3901 => 1602,  3883 => 1589,  3875 => 1583,  3869 => 1582,  3854 => 1575,  3849 => 1573,  3846 => 1572,  3841 => 1571,  3837 => 1570,  3831 => 1566,  3827 => 1564,  3825 => 1563,  3822 => 1562,  3819 => 1561,  3811 => 1559,  3801 => 1555,  3796 => 1554,  3794 => 1553,  3791 => 1552,  3785 => 1549,  3780 => 1546,  3775 => 1544,  3760 => 1542,  3752 => 1540,  3749 => 1539,  3746 => 1538,  3741 => 1537,  3736 => 1534,  3730 => 1532,  3725 => 1529,  3723 => 1528,  3720 => 1527,  3713 => 1524,  3711 => 1523,  3704 => 1518,  3698 => 1517,  3683 => 1510,  3678 => 1508,  3675 => 1507,  3670 => 1506,  3666 => 1505,  3662 => 1503,  3660 => 1502,  3631 => 1476,  3599 => 1447,  3567 => 1418,  3535 => 1389,  3510 => 1367,  3502 => 1362,  3493 => 1355,  3487 => 1354,  3472 => 1347,  3467 => 1345,  3464 => 1344,  3459 => 1343,  3455 => 1342,  3433 => 1322,  3423 => 1317,  3417 => 1316,  3408 => 1312,  3404 => 1310,  3395 => 1306,  3391 => 1304,  3388 => 1303,  3384 => 1302,  3377 => 1298,  3373 => 1297,  3370 => 1296,  3366 => 1295,  3359 => 1291,  3355 => 1290,  3343 => 1280,  3330 => 1277,  3324 => 1275,  3322 => 1274,  3302 => 1272,  3298 => 1271,  3294 => 1270,  3291 => 1269,  3287 => 1268,  3280 => 1264,  3276 => 1263,  3268 => 1258,  3264 => 1256,  3258 => 1254,  3256 => 1253,  3248 => 1247,  3237 => 1244,  3233 => 1243,  3230 => 1242,  3226 => 1241,  3218 => 1236,  3214 => 1235,  3202 => 1228,  3195 => 1226,  3186 => 1219,  3183 => 1218,  3177 => 1217,  3175 => 1216,  3166 => 1214,  3161 => 1212,  3155 => 1211,  3150 => 1209,  3141 => 1208,  3136 => 1207,  3133 => 1206,  3130 => 1205,  3128 => 1204,  3122 => 1200,  3117 => 1197,  3115 => 1196,  3103 => 1187,  3096 => 1183,  3089 => 1179,  3081 => 1174,  3077 => 1173,  3063 => 1162,  3056 => 1157,  3050 => 1156,  3048 => 1155,  3041 => 1153,  3030 => 1149,  3017 => 1143,  3007 => 1140,  2999 => 1139,  2994 => 1136,  2988 => 1135,  2979 => 1131,  2975 => 1129,  2966 => 1125,  2962 => 1123,  2959 => 1122,  2955 => 1121,  2949 => 1118,  2944 => 1117,  2939 => 1116,  2937 => 1115,  2928 => 1109,  2924 => 1108,  2920 => 1107,  2916 => 1106,  2912 => 1105,  2898 => 1094,  2891 => 1089,  2885 => 1088,  2883 => 1087,  2876 => 1085,  2865 => 1081,  2852 => 1075,  2842 => 1072,  2834 => 1071,  2826 => 1070,  2823 => 1069,  2817 => 1068,  2809 => 1066,  2801 => 1064,  2798 => 1063,  2794 => 1062,  2790 => 1061,  2785 => 1060,  2780 => 1059,  2778 => 1058,  2769 => 1052,  2765 => 1051,  2761 => 1050,  2757 => 1049,  2753 => 1048,  2749 => 1047,  2735 => 1036,  2728 => 1031,  2722 => 1030,  2720 => 1029,  2713 => 1027,  2708 => 1024,  2702 => 1023,  2693 => 1019,  2689 => 1017,  2680 => 1013,  2676 => 1011,  2673 => 1010,  2669 => 1009,  2663 => 1006,  2658 => 1003,  2652 => 1002,  2643 => 998,  2639 => 996,  2630 => 992,  2626 => 990,  2623 => 989,  2619 => 988,  2613 => 985,  2608 => 984,  2603 => 983,  2601 => 982,  2592 => 976,  2588 => 975,  2572 => 966,  2570 => 965,  2567 => 964,  2561 => 961,  2558 => 960,  2546 => 956,  2542 => 954,  2537 => 953,  2535 => 952,  2529 => 949,  2515 => 944,  2508 => 939,  2502 => 938,  2500 => 937,  2493 => 935,  2489 => 933,  2476 => 930,  2464 => 926,  2462 => 925,  2452 => 922,  2449 => 921,  2445 => 919,  2428 => 917,  2424 => 916,  2421 => 915,  2418 => 914,  2416 => 913,  2404 => 910,  2400 => 908,  2392 => 902,  2384 => 896,  2381 => 895,  2373 => 889,  2365 => 883,  2363 => 882,  2355 => 879,  2345 => 878,  2341 => 876,  2333 => 870,  2325 => 864,  2322 => 863,  2314 => 857,  2306 => 851,  2304 => 850,  2296 => 847,  2286 => 846,  2282 => 844,  2274 => 838,  2266 => 832,  2263 => 831,  2255 => 825,  2247 => 819,  2245 => 818,  2237 => 815,  2232 => 812,  2225 => 808,  2221 => 807,  2217 => 805,  2210 => 801,  2206 => 800,  2202 => 798,  2200 => 797,  2192 => 794,  2182 => 793,  2174 => 792,  2170 => 790,  2167 => 789,  2161 => 788,  2152 => 784,  2148 => 782,  2139 => 778,  2135 => 776,  2133 => 775,  2130 => 774,  2126 => 773,  2123 => 772,  2121 => 771,  2113 => 768,  2108 => 767,  2104 => 766,  2097 => 761,  2089 => 760,  2085 => 759,  2081 => 758,  2077 => 757,  2073 => 756,  2069 => 755,  2063 => 752,  2060 => 751,  2057 => 750,  2042 => 744,  2034 => 741,  2031 => 740,  2028 => 739,  2013 => 733,  2005 => 730,  2002 => 729,  1999 => 728,  1984 => 722,  1976 => 719,  1973 => 718,  1970 => 717,  1957 => 713,  1950 => 711,  1947 => 710,  1944 => 709,  1931 => 705,  1924 => 703,  1921 => 702,  1918 => 701,  1905 => 697,  1898 => 695,  1895 => 694,  1893 => 693,  1886 => 688,  1879 => 684,  1875 => 683,  1871 => 681,  1864 => 677,  1860 => 676,  1856 => 674,  1854 => 673,  1846 => 670,  1839 => 668,  1820 => 666,  1816 => 664,  1805 => 660,  1801 => 658,  1799 => 657,  1792 => 654,  1787 => 653,  1784 => 652,  1782 => 651,  1774 => 646,  1771 => 645,  1765 => 644,  1763 => 643,  1752 => 642,  1747 => 641,  1745 => 640,  1732 => 630,  1725 => 625,  1719 => 624,  1717 => 623,  1712 => 620,  1704 => 618,  1702 => 617,  1696 => 616,  1691 => 613,  1683 => 611,  1671 => 607,  1669 => 606,  1651 => 604,  1647 => 603,  1641 => 599,  1637 => 598,  1628 => 595,  1624 => 594,  1620 => 593,  1614 => 589,  1608 => 588,  1592 => 586,  1576 => 584,  1574 => 583,  1571 => 582,  1559 => 581,  1556 => 580,  1549 => 579,  1547 => 578,  1533 => 576,  1525 => 573,  1520 => 572,  1516 => 571,  1510 => 570,  1507 => 569,  1505 => 568,  1502 => 567,  1492 => 564,  1483 => 563,  1480 => 562,  1478 => 561,  1472 => 560,  1464 => 559,  1458 => 557,  1453 => 556,  1451 => 555,  1442 => 549,  1438 => 548,  1431 => 543,  1420 => 539,  1414 => 536,  1409 => 533,  1399 => 531,  1393 => 530,  1389 => 529,  1378 => 525,  1370 => 524,  1362 => 523,  1354 => 517,  1344 => 515,  1338 => 514,  1332 => 510,  1330 => 509,  1322 => 503,  1313 => 501,  1306 => 500,  1302 => 499,  1298 => 498,  1291 => 496,  1285 => 492,  1276 => 490,  1269 => 489,  1265 => 488,  1261 => 487,  1254 => 485,  1248 => 481,  1240 => 479,  1235 => 478,  1230 => 477,  1225 => 475,  1220 => 474,  1218 => 473,  1215 => 472,  1211 => 471,  1206 => 469,  1200 => 465,  1191 => 463,  1184 => 462,  1180 => 461,  1176 => 460,  1169 => 458,  1163 => 454,  1154 => 452,  1147 => 451,  1143 => 450,  1139 => 449,  1132 => 447,  1121 => 443,  1114 => 441,  1103 => 435,  1098 => 433,  1090 => 427,  1083 => 423,  1079 => 422,  1075 => 420,  1068 => 416,  1064 => 415,  1060 => 413,  1058 => 412,  1050 => 407,  1042 => 401,  1036 => 400,  1027 => 396,  1023 => 394,  1014 => 390,  1010 => 388,  1007 => 387,  1003 => 386,  995 => 381,  986 => 377,  981 => 375,  973 => 369,  967 => 368,  958 => 364,  954 => 362,  945 => 358,  941 => 356,  938 => 355,  934 => 354,  926 => 349,  915 => 343,  907 => 340,  899 => 337,  892 => 333,  881 => 327,  875 => 324,  869 => 320,  864 => 319,  861 => 318,  856 => 316,  853 => 315,  850 => 314,  845 => 313,  842 => 312,  837 => 310,  834 => 309,  832 => 308,  827 => 306,  819 => 300,  813 => 299,  804 => 295,  800 => 293,  791 => 289,  787 => 287,  784 => 286,  780 => 285,  770 => 280,  762 => 274,  755 => 270,  751 => 269,  747 => 267,  740 => 263,  736 => 262,  732 => 260,  730 => 259,  722 => 254,  713 => 250,  706 => 248,  697 => 244,  692 => 242,  684 => 236,  678 => 235,  669 => 231,  665 => 229,  656 => 225,  652 => 223,  649 => 222,  645 => 221,  639 => 218,  633 => 215,  624 => 211,  619 => 209,  610 => 205,  605 => 203,  596 => 199,  589 => 197,  580 => 193,  573 => 191,  564 => 187,  557 => 185,  548 => 181,  541 => 179,  532 => 175,  525 => 173,  516 => 169,  509 => 167,  504 => 164,  498 => 163,  496 => 162,  490 => 161,  485 => 159,  479 => 155,  462 => 151,  453 => 149,  442 => 143,  437 => 141,  427 => 136,  422 => 134,  412 => 129,  407 => 127,  397 => 122,  392 => 120,  378 => 115,  371 => 113,  358 => 109,  351 => 107,  346 => 104,  340 => 103,  338 => 102,  328 => 101,  321 => 99,  306 => 95,  299 => 93,  294 => 90,  288 => 89,  286 => 88,  276 => 87,  269 => 85,  263 => 83,  259 => 82,  256 => 81,  239 => 79,  235 => 78,  227 => 73,  223 => 72,  218 => 70,  215 => 69,  209 => 67,  207 => 66,  202 => 64,  198 => 63,  194 => 62,  189 => 60,  185 => 59,  181 => 58,  177 => 57,  173 => 56,  169 => 55,  164 => 53,  158 => 50,  154 => 48,  146 => 44,  144 => 43,  139 => 40,  128 => 38,  124 => 37,  119 => 35,  113 => 34,  109 => 33,  102 => 28,  92 => 21,  88 => 20,  84 => 19,  80 => 18,  76 => 17,  72 => 16,  68 => 15,  64 => 14,  60 => 13,  56 => 12,  49 => 7,  47 => 6,  45 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "catalog/product_form.twig", "");
    }
}
