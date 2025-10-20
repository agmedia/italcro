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

/* extension/module/basel_content.twig */
class __TwigTemplate_b3b691d6822ccc7ab190eeedc9df6fc39d2cb6580e94dd4236c2fbca507d4700 extends \Twig\Template
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
  <div class=\"page-header\">
    <div class=\"container-fluid\">
      <div class=\"pull-right\"\">
      ";
        // line 6
        if (($context["save_and_stay"] ?? null)) {
            // line 7
            echo "      <a class=\"btn btn-success\" onclick=\"\$('#save').val('stay');\$('#form_basel_content').submit();\" data-toggle=\"tooltip\" title=\"";
            echo ($context["button_save_stay"] ?? null);
            echo "\"><i class=\"fa fa-check\"></i></a>
      ";
        }
        // line 9
        echo "    <button type=\"submit\" form=\"form_basel_content\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_save"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-save\"></i></button>
    <a href=\"";
        // line 10
        echo ($context["cancel"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_cancel"] ?? null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-reply\"></i></a>
        </div>
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
            // line 15
            echo "        <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 15);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 15);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        echo "      </ul>
    </div>
  </div>
  <div class=\"container-fluid\">
  
    ";
        // line 22
        if (($context["error_warning"] ?? null)) {
            // line 23
            echo "    <div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 27
        echo "    
    ";
        // line 28
        if (($context["success"] ?? null)) {
            // line 29
            echo "    <div class=\"alert alert-success\"><i class=\"fa fa-check\"></i> ";
            echo ($context["success"] ?? null);
            echo "
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 33
        echo "    
    <div class=\"panel-wrapper\">
    <form action=\"";
        // line 35
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form_basel_content\" class=\"form-horizontal\">
    <input type=\"hidden\" name=\"save\" id=\"save\" value=\"0\">
    <div class=\"panel-header\">
    <ul class=\"main-tabs list-unstyled\">
    <li class=\"active\"><a href=\"#tab-content\" data-toggle=\"tab\"><i class=\"fa fa-pencil\"></i> ";
        // line 39
        echo ($context["text_tab_content"] ?? null);
        echo "</a></li><!--
    --><li><a href=\"#tab-templates\" data-toggle=\"tab\"><i class=\"fa fa-download\"></i> ";
        // line 40
        echo ($context["text_tab_template"] ?? null);
        echo "</a></li>
    </ul>
    </div>
    
    <div class=\"tab-content\">
    
    <div class=\"tab-pane active\" id=\"tab-content\">
    <div class=\"main-content\" style=\"background:#ffffff;\">
    
    <div class=\"left-side\">
    <legend>";
        // line 50
        echo ($context["text_module_settings"] ?? null);
        echo "</legend>
    
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\" for=\"input-name\">";
        // line 53
        echo ($context["entry_name"] ?? null);
        echo "</label>
    <div class=\"col-sm-9\">
    <input type=\"text\" name=\"name\" value=\"";
        // line 55
        echo ($context["name"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_name"] ?? null);
        echo "\" id=\"input-name\" class=\"form-control\" />
    ";
        // line 56
        if (($context["error_name"] ?? null)) {
            // line 57
            echo "    <div class=\"text-danger\">";
            echo ($context["error_name"] ?? null);
            echo "</div>
    ";
        }
        // line 59
        echo "    </div>
    </div>
    
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
        // line 63
        echo ($context["entry_status"] ?? null);
        echo "</label>
    <div class=\"col-sm-9 toggle-btn\">
    ";
        // line 65
        if (($context["status"] ?? null)) {
            // line 66
            echo "    <label><input type=\"radio\" name=\"status\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" name=\"status\" value=\"1\" checked=\"checked\" /><span>";
            // line 67
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        } else {
            // line 69
            echo "    <label><input type=\"radio\" name=\"status\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" name=\"status\" value=\"1\" /><span>";
            // line 70
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        }
        // line 72
        echo "    </div>                   
    </div>
    
    <div class=\"sample\">
    <h4 class=\"sample-heading\">";
        // line 76
        echo ($context["text_layout_example"] ?? null);
        echo "</h4>
    
    <div class=\"page\"><small class=\"browser\">";
        // line 78
        echo ($context["text_page"] ?? null);
        echo "</small>
    \t<div class=\"block\"><small>";
        // line 79
        echo ($context["text_block"] ?? null);
        echo "</small>
        \t<div class=\"content\">
    \t\t\t<div class=\"column left\"><small>";
        // line 81
        echo ($context["text_column"] ?? null);
        echo "</small></div>
                <div class=\"column right\"><small>";
        // line 82
        echo ($context["text_column"] ?? null);
        echo "</small></div>
                <small>";
        // line 83
        echo ($context["text_content"] ?? null);
        echo "</small>
    \t\t</div>
    \t</div>
    </div>
    
    </div>
    
    <legend>";
        // line 90
        echo ($context["text_block_settings"] ?? null);
        echo "</legend>
    
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
        // line 93
        echo ($context["text_use_block_title"] ?? null);
        echo "</label>
    <div class=\"col-sm-9 toggle-btn\">
    ";
        // line 95
        if (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "title", [], "any", false, false, false, 95)) {
            // line 96
            echo "    <label><input type=\"radio\" class=\"title_select\" name=\"b_setting[title]\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" class=\"title_select\" name=\"b_setting[title]\" value=\"1\" checked=\"checked\" /><span>";
            // line 97
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        } else {
            // line 99
            echo "    <label><input type=\"radio\" class=\"title_select\" name=\"b_setting[title]\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" class=\"title_select\" name=\"b_setting[title]\" value=\"1\" /><span>";
            // line 100
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        }
        // line 102
        echo "    </div>                   
    </div>
    
    <div class=\"form-group title_field\" style=\"display:";
        // line 105
        if (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "title", [], "any", false, false, false, 105)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
    <label class=\"col-sm-3 control-label\">";
        // line 106
        echo ($context["text_block_pre_line"] ?? null);
        echo "</label>
    <div class=\"col-sm-9\">
    ";
        // line 108
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 109
            echo "    <div class=\"input-group\">
    <span class=\"input-group-addon\"><img src=\"language/";
            // line 110
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 110);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 110);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 110);
            echo "\" /></span>
    <input type=\"text\" name=\"b_setting[title_pl][";
            // line 111
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 111);
            echo "]\" value=\"";
            echo (((($__internal_compile_0 = twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "title_pl", [], "any", false, false, false, 111)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 111)] ?? null) : null)) ? ((($__internal_compile_1 = twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "title_pl", [], "any", false, false, false, 111)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 111)] ?? null) : null)) : (""));
            echo "\" class=\"form-control\" />
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 114
        echo "    </div>
    </div>
    
    <div class=\"form-group title_field\" style=\"display:";
        // line 117
        if (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "title", [], "any", false, false, false, 117)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
    <label class=\"col-sm-3 control-label\">";
        // line 118
        echo ($context["text_block_title"] ?? null);
        echo "</label>
    <div class=\"col-sm-9\">
    ";
        // line 120
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 121
            echo "    <div class=\"input-group\">
    <span class=\"input-group-addon\"><img src=\"language/";
            // line 122
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 122);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 122);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 122);
            echo "\" /></span>
    <input type=\"text\" name=\"b_setting[title_m][";
            // line 123
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 123);
            echo "]\" value=\"";
            echo (((($__internal_compile_2 = twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "title_m", [], "any", false, false, false, 123)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 123)] ?? null) : null)) ? ((($__internal_compile_3 = twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "title_m", [], "any", false, false, false, 123)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 123)] ?? null) : null)) : (""));
            echo "\" class=\"form-control\" />
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 126
        echo "    </div>
    </div>
    
    <div class=\"form-group title_field\" style=\"display:";
        // line 129
        if (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "title", [], "any", false, false, false, 129)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
    <label class=\"col-sm-3 control-label\">";
        // line 130
        echo ($context["text_block_sub_line"] ?? null);
        echo "</label>
    <div class=\"col-sm-9\">
    ";
        // line 132
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 133
            echo "    <div class=\"input-group\">
    <span class=\"input-group-addon\"><img src=\"language/";
            // line 134
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 134);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 134);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 134);
            echo "\" /></span>
    <textarea type=\"text\" name=\"b_setting[title_b][";
            // line 135
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 135);
            echo "]\" class=\"form-control\">";
            echo (((($__internal_compile_4 = twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "title_b", [], "any", false, false, false, 135)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 135)] ?? null) : null)) ? ((($__internal_compile_5 = twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "title_b", [], "any", false, false, false, 135)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 135)] ?? null) : null)) : (""));
            echo "</textarea>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 138
        echo "    </div>
    </div>
    
    
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
        // line 143
        echo ($context["text_block_margin"] ?? null);
        echo "</label>
    <div class=\"col-sm-9 toggle-btn\">
    ";
        // line 145
        if (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "custom_m", [], "any", false, false, false, 145)) {
            // line 146
            echo "    <label><input type=\"radio\" class=\"margin_select\" name=\"b_setting[custom_m]\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" class=\"margin_select\" name=\"b_setting[custom_m]\" value=\"1\" checked=\"checked\" /><span>";
            // line 147
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        } else {
            // line 149
            echo "    <label><input type=\"radio\" class=\"margin_select\" name=\"b_setting[custom_m]\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" class=\"margin_select\" name=\"b_setting[custom_m]\" value=\"1\" /><span>";
            // line 150
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        }
        // line 152
        echo "    </div>                   
    </div>
    
    <div class=\"form-group\" id=\"custom_margin_field\" style=\"display:";
        // line 155
        if (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "custom_m", [], "any", false, false, false, 155)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
    <label class=\"col-sm-3 control-label\">";
        // line 156
        echo ($context["text_margin"] ?? null);
        echo "</label>
    <div class=\"col-sm-9\">
    <input type=\"text\" name=\"b_setting[mt]\" value=\"";
        // line 158
        echo ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "mt", [], "any", false, false, false, 158)) ? (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "mt", [], "any", false, false, false, 158)) : (""));
        echo "\" placeholder=\"";
        echo ($context["text_top"] ?? null);
        echo "\" class=\"form-control inline\" /> px&nbsp;&nbsp;&nbsp;
    <input type=\"text\" name=\"b_setting[mr]\" value=\"";
        // line 159
        echo ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "mr", [], "any", false, false, false, 159)) ? (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "mr", [], "any", false, false, false, 159)) : (""));
        echo "\" placeholder=\"";
        echo ($context["text_right"] ?? null);
        echo "\" class=\"form-control inline\" /> px&nbsp;&nbsp;&nbsp;
    <input type=\"text\" name=\"b_setting[mb]\" value=\"";
        // line 160
        echo ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "mb", [], "any", false, false, false, 160)) ? (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "mb", [], "any", false, false, false, 160)) : (""));
        echo "\" placeholder=\"";
        echo ($context["text_bottom"] ?? null);
        echo "\" class=\"form-control inline\" /> px&nbsp;&nbsp;&nbsp;
    <input type=\"text\" name=\"b_setting[ml]\" value=\"";
        // line 161
        echo ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "ml", [], "any", false, false, false, 161)) ? (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "ml", [], "any", false, false, false, 161)) : (""));
        echo "\" placeholder=\"";
        echo ($context["text_left"] ?? null);
        echo "\" class=\"form-control inline\" /> px&nbsp;&nbsp;&nbsp;
    </div>
    </div>
    
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
        // line 166
        echo ($context["text_full_width_background"] ?? null);
        echo "</label>
    <div class=\"col-sm-9 toggle-btn\">
    ";
        // line 168
        if (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "fw", [], "any", false, false, false, 168)) {
            // line 169
            echo "    <label><input type=\"radio\" name=\"b_setting[fw]\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" name=\"b_setting[fw]\" value=\"1\" checked=\"checked\" /><span>";
            // line 170
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        } else {
            // line 172
            echo "    <label><input type=\"radio\" name=\"b_setting[fw]\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" name=\"b_setting[fw]\" value=\"1\" /><span>";
            // line 173
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        }
        // line 175
        echo "    </div>                   
    </div>
    
    
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
        // line 180
        echo ($context["text_use_background_color"] ?? null);
        echo "</label>
    <div class=\"col-sm-9 toggle-btn\">
    ";
        // line 182
        if (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "block_bg", [], "any", false, false, false, 182)) {
            // line 183
            echo "    <label><input type=\"radio\" class=\"bg_color_select\" name=\"b_setting[block_bg]\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" class=\"bg_color_select\" name=\"b_setting[block_bg]\" value=\"1\" checked=\"checked\" /><span>";
            // line 184
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        } else {
            // line 186
            echo "    <label><input type=\"radio\" class=\"bg_color_select\" name=\"b_setting[block_bg]\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" class=\"bg_color_select\" name=\"b_setting[block_bg]\" value=\"1\" /><span>";
            // line 187
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        }
        // line 189
        echo "    </div>                   
    </div>
    
    <div class=\"form-group\" id=\"background_color_field\" style=\"display:";
        // line 192
        if (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "block_bg", [], "any", false, false, false, 192)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
    <label class=\"col-sm-3 control-label\">";
        // line 193
        echo ($context["text_background_color"] ?? null);
        echo "</label>
    <div class=\"col-sm-9\">
    <div class=\"input-group color_field\">
    <span class=\"input-group-addon\"><i></i></span><input type=\"text\" name=\"b_setting[bg_color]\" value=\"";
        // line 196
        echo ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_color", [], "any", false, false, false, 196)) ? (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_color", [], "any", false, false, false, 196)) : (""));
        echo "\" class=\"form-control\" />
    </div>
    </div>
    </div>
    
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
        // line 202
        echo ($context["text_use_background_image"] ?? null);
        echo "</label>
    <div class=\"col-sm-9 toggle-btn\">
    ";
        // line 204
        if (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "block_bgi", [], "any", false, false, false, 204)) {
            // line 205
            echo "    <label><input type=\"radio\" class=\"bg_image_select\" name=\"b_setting[block_bgi]\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" class=\"bg_image_select\" name=\"b_setting[block_bgi]\" value=\"1\" checked=\"checked\" /><span>";
            // line 206
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        } else {
            // line 208
            echo "    <label><input type=\"radio\" class=\"bg_image_select\" name=\"b_setting[block_bgi]\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" class=\"bg_image_select\" name=\"b_setting[block_bgi]\" value=\"1\" /><span>";
            // line 209
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        }
        // line 211
        echo "    </div>                   
    </div>
    
    <div class=\"form-group background_image_field\" style=\"display:";
        // line 214
        if (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "block_bgi", [], "any", false, false, false, 214)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
    <label class=\"col-sm-3 control-label\">";
        // line 215
        echo ($context["text_background_image"] ?? null);
        echo "</label>
    <div class=\"col-sm-9\"><a href=\"\" id=\"thumb-image\" data-toggle=\"image\" class=\"img-thumbnail\"><img src=\"";
        // line 216
        echo ($context["image"] ?? null);
        echo "\" alt=\"\" title=\"\" data-placeholder=\"";
        echo ($context["placeholder"] ?? null);
        echo "\" /></a>
    <input type=\"hidden\" name=\"bg_image\" value=\"";
        // line 217
        echo ((($context["bg_image"] ?? null)) ? (($context["bg_image"] ?? null)) : (""));
        echo "\" id=\"input-image\" />
    </div>
    </div>
    
    <div class=\"form-group background_image_field\" id=\"background_color_field\" style=\"display:";
        // line 221
        if (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "block_bgi", [], "any", false, false, false, 221)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
    <label class=\"col-sm-3 control-label\">";
        // line 222
        echo ($context["text_background_parallax"] ?? null);
        echo "</label>
    <div class=\"col-sm-9\">
    <select name=\"b_setting[bg_par]\" class=\"form-control\">
    ";
        // line 225
        if ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_par", [], "any", false, false, false, 225) == "0")) {
            // line 226
            echo "    <option value=\"0\" selected=\"selected\">";
            echo ($context["text_disabled"] ?? null);
            echo "</option>
    ";
        } else {
            // line 228
            echo "    <option value=\"0\">";
            echo ($context["text_disabled"] ?? null);
            echo "</option>
    ";
        }
        // line 230
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_par", [], "any", false, false, false, 230) == "1")) {
            // line 231
            echo "    <option value=\"1\" selected=\"selected\">1</option>
    ";
        } else {
            // line 233
            echo "    <option value=\"1\">1</option>
    ";
        }
        // line 235
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_par", [], "any", false, false, false, 235) == "2")) {
            // line 236
            echo "    <option value=\"2\" selected=\"selected\">2</option>
    ";
        } else {
            // line 238
            echo "    <option value=\"2\">2</option>
    ";
        }
        // line 240
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_par", [], "any", false, false, false, 240) == "3")) {
            // line 241
            echo "    <option value=\"3\" selected=\"selected\">3</option>
    ";
        } else {
            // line 243
            echo "    <option value=\"3\">3</option>
    ";
        }
        // line 245
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_par", [], "any", false, false, false, 245) == "4")) {
            // line 246
            echo "    <option value=\"4\" selected=\"selected\">4</option>
    ";
        } else {
            // line 248
            echo "    <option value=\"4\">4</option>
    ";
        }
        // line 250
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_par", [], "any", false, false, false, 250) == "5")) {
            // line 251
            echo "    <option value=\"5\" selected=\"selected\">5</option>
    ";
        } else {
            // line 253
            echo "    <option value=\"5\">5</option>
    ";
        }
        // line 255
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_par", [], "any", false, false, false, 255) == "6")) {
            // line 256
            echo "    <option value=\"6\" selected=\"selected\">6</option>
    ";
        } else {
            // line 258
            echo "    <option value=\"6\">6</option>
    ";
        }
        // line 260
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_par", [], "any", false, false, false, 260) == "7")) {
            // line 261
            echo "    <option value=\"7\" selected=\"selected\">7</option>
    ";
        } else {
            // line 263
            echo "    <option value=\"7\">7</option>
    ";
        }
        // line 265
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_par", [], "any", false, false, false, 265) == "8")) {
            // line 266
            echo "    <option value=\"8\" selected=\"selected\">8</option>
    ";
        } else {
            // line 268
            echo "    <option value=\"8\">8</option>
    ";
        }
        // line 270
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_par", [], "any", false, false, false, 270) == "9")) {
            // line 271
            echo "    <option value=\"9\" selected=\"selected\">9</option>
    ";
        } else {
            // line 273
            echo "    <option value=\"9\">9</option>
    ";
        }
        // line 275
        echo "    </select>
    </div>
    </div>
    
    <div class=\"form-group background_image_field\" style=\"display:";
        // line 279
        if (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "block_bgi", [], "any", false, false, false, 279)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
    <label class=\"col-sm-3 control-label\">";
        // line 280
        echo ($context["text_background_position"] ?? null);
        echo "</label>
    <div class=\"col-sm-9\">
    <select name=\"b_setting[bg_pos]\" class=\"form-control\">
    ";
        // line 283
        if ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_pos", [], "any", false, false, false, 283) == "top left")) {
            // line 284
            echo "    <option value=\"left top\" selected=\"selected\">left top</option>
    ";
        } else {
            // line 286
            echo "    <option value=\"left top\">left top</option>
    ";
        }
        // line 288
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_pos", [], "any", false, false, false, 288) == "top center")) {
            // line 289
            echo "    <option value=\"left center\" selected=\"selected\">left center</option>
    ";
        } else {
            // line 291
            echo "    <option value=\"left center\">left center</option>
    ";
        }
        // line 293
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_pos", [], "any", false, false, false, 293) == "left bottom")) {
            // line 294
            echo "    <option value=\"left bottom\" selected=\"selected\">left bottom</option>
    ";
        } else {
            // line 296
            echo "    <option value=\"left bottom\">left bottom</option>
    ";
        }
        // line 298
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_pos", [], "any", false, false, false, 298) == "right top")) {
            // line 299
            echo "    <option value=\"right top\" selected=\"selected\">right top</option>
    ";
        } else {
            // line 301
            echo "    <option value=\"right top\">right top</option>
    ";
        }
        // line 303
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_pos", [], "any", false, false, false, 303) == "right center")) {
            // line 304
            echo "    <option value=\"right center\" selected=\"selected\">right center</option>
    ";
        } else {
            // line 306
            echo "    <option value=\"right center\">right center</option>
    ";
        }
        // line 308
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_pos", [], "any", false, false, false, 308) == "right bottom")) {
            // line 309
            echo "    <option value=\"right bottom\" selected=\"selected\">right bottom</option>
    ";
        } else {
            // line 311
            echo "    <option value=\"right bottom\">right bottom</option>
    ";
        }
        // line 313
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_pos", [], "any", false, false, false, 313) == "center top")) {
            // line 314
            echo "    <option value=\"center top\" selected=\"selected\">center top</option>
    ";
        } else {
            // line 316
            echo "    <option value=\"center top\">center top</option>
    ";
        }
        // line 318
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_pos", [], "any", false, false, false, 318) == "center center")) {
            // line 319
            echo "    <option value=\"center center\" selected=\"selected\">center center</option>
    ";
        } else {
            // line 321
            echo "    <option value=\"center center\">center center</option>
    ";
        }
        // line 323
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_pos", [], "any", false, false, false, 323) == "center bottom")) {
            // line 324
            echo "    <option value=\"center bottom\" selected=\"selected\">center bottom</option>
    ";
        } else {
            // line 326
            echo "    <option value=\"center bottom\">center bottom</option>
    ";
        }
        // line 328
        echo "    </select>
    </div>
    </div>
    
    <div class=\"form-group background_image_field\" style=\"display:";
        // line 332
        if (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "block_bgi", [], "any", false, false, false, 332)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
    <label class=\"col-sm-3 control-label\">";
        // line 333
        echo ($context["text_background_repeat"] ?? null);
        echo "</label>
    <div class=\"col-sm-9\">
    <select name=\"b_setting[bg_repeat]\" class=\"form-control\">
    ";
        // line 336
        if ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_repeat", [], "any", false, false, false, 336) == "no-repeat")) {
            // line 337
            echo "    <option value=\"no-repeat\" selected=\"selected\">no-repeat</option>
    ";
        } else {
            // line 339
            echo "    <option value=\"no-repeat\">no-repeat</option>
    ";
        }
        // line 341
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_repeat", [], "any", false, false, false, 341) == "repeat")) {
            // line 342
            echo "    <option value=\"repeat\" selected=\"selected\">repeat</option>
    ";
        } else {
            // line 344
            echo "    <option value=\"repeat\">repeat</option>
    ";
        }
        // line 346
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_repeat", [], "any", false, false, false, 346) == "repeat-x")) {
            // line 347
            echo "    <option value=\"repeat-x\" selected=\"selected\">repeat-x</option>
    ";
        } else {
            // line 349
            echo "    <option value=\"repeat-x\">repeat-x</option>
    ";
        }
        // line 351
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_repeat", [], "any", false, false, false, 351) == "repeat-y")) {
            // line 352
            echo "    <option value=\"repeat-y\" selected=\"selected\">repeat-y</option>
    ";
        } else {
            // line 354
            echo "    <option value=\"repeat-y\">repeat-y</option>
    ";
        }
        // line 356
        echo "    </select>
    </div>
    </div>
    
    
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
        // line 362
        echo ($context["text_use_background_video"] ?? null);
        echo "</label>
    <div class=\"col-sm-9 toggle-btn\">
    ";
        // line 364
        if (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "block_bgv", [], "any", false, false, false, 364)) {
            // line 365
            echo "    <label><input type=\"radio\" class=\"bg_video_select\" name=\"b_setting[block_bgv]\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" class=\"bg_video_select\" name=\"b_setting[block_bgv]\" value=\"1\" checked=\"checked\" /><span>";
            // line 366
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        } else {
            // line 368
            echo "    <label><input type=\"radio\" class=\"bg_video_select\" name=\"b_setting[block_bgv]\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" class=\"bg_video_select\" name=\"b_setting[block_bgv]\" value=\"1\" /><span>";
            // line 369
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        }
        // line 371
        echo "    </div>                   
    </div>
    
    <div class=\"form-group\" id=\"background_video_field\" style=\"display:";
        // line 374
        if (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "block_bgv", [], "any", false, false, false, 374)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
    <label class=\"col-sm-3 control-label\">";
        // line 375
        echo ($context["text_background_video"] ?? null);
        echo "</label>
    <div class=\"col-sm-9\">
    <input type=\"text\" name=\"b_setting[bg_video]\" value=\"";
        // line 377
        echo ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_video", [], "any", false, false, false, 377)) ? (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "bg_video", [], "any", false, false, false, 377)) : (""));
        echo "\" class=\"form-control\" />
    </div>
    </div>
    
    
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
        // line 383
        echo ($context["text_use_css"] ?? null);
        echo "</label>
    <div class=\"col-sm-9 toggle-btn\">
    ";
        // line 385
        if (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "block_css", [], "any", false, false, false, 385)) {
            // line 386
            echo "    <label><input type=\"radio\" class=\"b_css_select\" name=\"b_setting[block_css]\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" class=\"b_css_select\" name=\"b_setting[block_css]\" value=\"1\" checked=\"checked\" /><span>";
            // line 387
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        } else {
            // line 389
            echo "    <label><input type=\"radio\" class=\"b_css_select\" name=\"b_setting[block_css]\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" class=\"b_css_select\" name=\"b_setting[block_css]\" value=\"1\" /><span>";
            // line 390
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        }
        // line 392
        echo "    </div>                   
    </div>
    
    <div class=\"form-group\" id=\"block_css_field\" style=\"display:";
        // line 395
        if (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "block_css", [], "any", false, false, false, 395)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
    <label class=\"col-sm-3 control-label\">";
        // line 396
        echo ($context["text_css"] ?? null);
        echo "</label>
    <div class=\"col-sm-9\">
    <textarea name=\"b_setting[css]\" class=\"form-control\" style=\"height:105px;\">";
        // line 398
        echo ((twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "css", [], "any", false, false, false, 398)) ? (twig_get_attribute($this->env, $this->source, ($context["b_setting"] ?? null), "css", [], "any", false, false, false, 398)) : (""));
        echo "</textarea>
    </div>
    </div>
    
    
    
    <legend>";
        // line 404
        echo ($context["text_content_settings"] ?? null);
        echo "</legend>
    
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
        // line 407
        echo ($context["text_full_width_content"] ?? null);
        echo "</label>
    <div class=\"col-sm-9 toggle-btn\">
    ";
        // line 409
        if (twig_get_attribute($this->env, $this->source, ($context["c_setting"] ?? null), "fw", [], "any", false, false, false, 409)) {
            // line 410
            echo "    <label><input type=\"radio\" name=\"c_setting[fw]\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" name=\"c_setting[fw]\" value=\"1\" checked=\"checked\" /><span>";
            // line 411
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        } else {
            // line 413
            echo "    <label><input type=\"radio\" name=\"c_setting[fw]\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" name=\"c_setting[fw]\" value=\"1\" /><span>";
            // line 414
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        }
        // line 416
        echo "    </div>                   
    </div>
    
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
        // line 420
        echo ($context["text_use_css"] ?? null);
        echo "</label>
    <div class=\"col-sm-9 toggle-btn\">
    ";
        // line 422
        if (twig_get_attribute($this->env, $this->source, ($context["c_setting"] ?? null), "block_css", [], "any", false, false, false, 422)) {
            // line 423
            echo "    <label><input type=\"radio\" class=\"c_css_select\" name=\"c_setting[block_css]\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" class=\"c_css_select\" name=\"c_setting[block_css]\" value=\"1\" checked=\"checked\" /><span>";
            // line 424
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        } else {
            // line 426
            echo "    <label><input type=\"radio\" class=\"c_css_select\" name=\"c_setting[block_css]\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" class=\"c_css_select\" name=\"c_setting[block_css]\" value=\"1\" /><span>";
            // line 427
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        }
        // line 429
        echo "    </div>                   
    </div>
    
    <div class=\"form-group\" id=\"content_css_field\" style=\"display:";
        // line 432
        if (twig_get_attribute($this->env, $this->source, ($context["c_setting"] ?? null), "block_css", [], "any", false, false, false, 432)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
    <label class=\"col-sm-3 control-label\">";
        // line 433
        echo ($context["text_css"] ?? null);
        echo "</label>
    <div class=\"col-sm-9\">
    <textarea name=\"c_setting[css]\" class=\"form-control\" style=\"height:105px;\">";
        // line 435
        echo ((twig_get_attribute($this->env, $this->source, ($context["c_setting"] ?? null), "css", [], "any", false, false, false, 435)) ? (twig_get_attribute($this->env, $this->source, ($context["c_setting"] ?? null), "css", [], "any", false, false, false, 435)) : (""));
        echo "</textarea>
    </div>
    </div>
    
    <legend>";
        // line 439
        echo ($context["text_columns_settings"] ?? null);
        echo "</legend>
    
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
        // line 442
        echo ($context["text_zero_margin"] ?? null);
        echo "</label>
    <div class=\"col-sm-9 toggle-btn\">
    ";
        // line 444
        if (twig_get_attribute($this->env, $this->source, ($context["c_setting"] ?? null), "nm", [], "any", false, false, false, 444)) {
            // line 445
            echo "    <label><input type=\"radio\" name=\"c_setting[nm]\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" name=\"c_setting[nm]\" value=\"1\" checked=\"checked\" /><span>";
            // line 446
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        } else {
            // line 448
            echo "    <label><input type=\"radio\" name=\"c_setting[nm]\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" name=\"c_setting[nm]\" value=\"1\" /><span>";
            // line 449
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        }
        // line 451
        echo "    </div>                   
    </div>
    
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
        // line 455
        echo ($context["text_equal_height"] ?? null);
        echo "</label>
    <div class=\"col-sm-9 toggle-btn\">
    ";
        // line 457
        if (twig_get_attribute($this->env, $this->source, ($context["c_setting"] ?? null), "eh", [], "any", false, false, false, 457)) {
            // line 458
            echo "    <label><input type=\"radio\" name=\"c_setting[eh]\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" name=\"c_setting[eh]\" value=\"1\" checked=\"checked\" /><span>";
            // line 459
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        } else {
            // line 461
            echo "    <label><input type=\"radio\" name=\"c_setting[eh]\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
    <label><input type=\"radio\" name=\"c_setting[eh]\" value=\"1\" /><span>";
            // line 462
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
    ";
        }
        // line 464
        echo "    </div>                   
    </div>
    
    </div> <!-- .left-side -->
    
    
    <div class=\"right-side\">
    <legend>";
        // line 471
        echo ($context["text_content_columns"] ?? null);
        echo "</legend>
    
    
    
    <ul class=\"list-unstyled\" id=\"column_tabs\">
    ";
        // line 476
        $context["column_row"] = 1;
        // line 477
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["columns"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["column"]) {
            // line 478
            echo "    <li><a href=\"#tab-column-";
            echo ($context["column_row"] ?? null);
            echo "\" data-toggle=\"tab\">";
            echo ($context["text_column"] ?? null);
            echo " ";
            echo ($context["column_row"] ?? null);
            echo " <i class=\"fa fa-minus-circle\" onclick=\"\$('a[href=\\'#tab-column-";
            echo ($context["column_row"] ?? null);
            echo "\\']').parent().remove(); \$('#tab-column-";
            echo ($context["column_row"] ?? null);
            echo "').remove(); \$('#column_tabs a:first').tab('show');\"></i></a></li>
    ";
            // line 479
            $context["column_row"] = (($context["column_row"] ?? null) + 1);
            // line 480
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['column'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 481
        echo "    <li id=\"column-add\" style=\"cursor:pointer\"><a onclick=\"addColumn();\"><i class=\"fa fa-plus-circle\"></i> ";
        echo ($context["text_add_column"] ?? null);
        echo "</a></li> 
    </ul>
    

    <div class=\"tab-content column-holder\">
    
    ";
        // line 487
        $context["column_row"] = 1;
        // line 488
        echo "    
    ";
        // line 489
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["columns"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["column"]) {
            // line 490
            echo "    <div class=\"tab-pane\" id=\"tab-column-";
            echo ($context["column_row"] ?? null);
            echo "\">
    
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
            // line 493
            echo ($context["text_column_width"] ?? null);
            echo "</label>
    <div class=\"col-sm-9\">
    <select name=\"columns[";
            // line 495
            echo ($context["column_row"] ?? null);
            echo "][w]\" class=\"form-control\" onchange=\"set_width(\$(this).val(),'";
            echo ($context["column_row"] ?? null);
            echo "')\">
    ";
            // line 496
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["column_widths"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["column_width"]) {
                // line 497
                echo "    <option value=\"";
                echo $context["key"];
                echo "\"";
                if ((twig_get_attribute($this->env, $this->source, $context["column"], "w", [], "any", false, false, false, 497) == $context["key"])) {
                    echo " selected=\"selected\"";
                }
                echo ">";
                echo $context["column_width"];
                echo "</option>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['column_width'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 499
            echo "    </select>
    </div>
    </div> <!-- form-group ends -->
    
    
    <div class=\"form-group\" id=\"custom-width-";
            // line 504
            echo ($context["column_row"] ?? null);
            echo "\" style=\"display:";
            if ((twig_get_attribute($this->env, $this->source, $context["column"], "w", [], "any", false, false, false, 504) == "custom")) {
                echo "block";
            } else {
                echo "none";
            }
            echo "\">
    <label class=\"col-sm-3 control-label\">";
            // line 505
            echo ($context["text_width_per_device"] ?? null);
            echo "</label>
    <div class=\"col-sm-9\">
    <i class=\"fa fa-2x fa-mobile\"></i>&nbsp;
    <select name=\"columns[";
            // line 508
            echo ($context["column_row"] ?? null);
            echo "][w_sm]\" class=\"form-control inline\">
    ";
            // line 509
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["sm_widths"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["sm_width"]) {
                // line 510
                echo "    <option value=\"";
                echo $context["key"];
                echo "\"";
                if ((twig_get_attribute($this->env, $this->source, $context["column"], "w_sm", [], "any", false, false, false, 510) == $context["key"])) {
                    echo " selected=\"selected\"";
                }
                echo ">";
                echo $context["sm_width"];
                echo "</option>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['sm_width'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 512
            echo "    </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
    <i class=\"fa fa-2x fa-tablet\"></i>&nbsp;
    <select name=\"columns[";
            // line 515
            echo ($context["column_row"] ?? null);
            echo "][w_md]\" class=\"form-control inline\">
    ";
            // line 516
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["md_widths"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["md_width"]) {
                // line 517
                echo "    <option value=\"";
                echo $context["key"];
                echo "\"";
                if ((twig_get_attribute($this->env, $this->source, $context["column"], "w_md", [], "any", false, false, false, 517) == $context["key"])) {
                    echo " selected=\"selected\"";
                }
                echo ">";
                echo $context["md_width"];
                echo "</option>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['md_width'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 519
            echo "    </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
    <i class=\"fa fa-2x fa-desktop\"></i>&nbsp;
    <select name=\"columns[";
            // line 522
            echo ($context["column_row"] ?? null);
            echo "][w_lg]\" class=\"form-control inline\">
    ";
            // line 523
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["lg_widths"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["lg_width"]) {
                // line 524
                echo "    <option value=\"";
                echo $context["key"];
                echo "\"";
                if ((twig_get_attribute($this->env, $this->source, $context["column"], "w_lg", [], "any", false, false, false, 524) == $context["key"])) {
                    echo " selected=\"selected\"";
                }
                echo ">";
                echo $context["lg_width"];
                echo "</option>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['lg_width'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 526
            echo "    </select>      
    </div>
    </div> <!-- form-group ends -->
    
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
            // line 531
            echo ($context["text_type"] ?? null);
            echo "</label>
    <div class=\"col-sm-9\">
    <select name=\"columns[";
            // line 533
            echo ($context["column_row"] ?? null);
            echo "][type]\" class=\"form-control\" onchange=\"set_type(\$(this).val(),'";
            echo ($context["column_row"] ?? null);
            echo "')\" id=\"type-select-";
            echo ($context["column_row"] ?? null);
            echo "\">
    ";
            // line 534
            if ((twig_get_attribute($this->env, $this->source, $context["column"], "type", [], "any", false, false, false, 534) == "html")) {
                // line 535
                echo "    <option value=\"html\" selected=\"selected\">";
                echo ($context["text_html"] ?? null);
                echo "</option>
    ";
            } else {
                // line 537
                echo "    <option value=\"html\">";
                echo ($context["text_html"] ?? null);
                echo "</option>
    ";
            }
            // line 539
            echo "    ";
            if ((twig_get_attribute($this->env, $this->source, $context["column"], "type", [], "any", false, false, false, 539) == "img")) {
                // line 540
                echo "    <option value=\"img\" selected=\"selected\">";
                echo ($context["text_banner"] ?? null);
                echo "</option>
    ";
            } else {
                // line 542
                echo "    <option value=\"img\">";
                echo ($context["text_banner"] ?? null);
                echo "</option>
    ";
            }
            // line 544
            echo "    ";
            if ((twig_get_attribute($this->env, $this->source, $context["column"], "type", [], "any", false, false, false, 544) == "tm")) {
                // line 545
                echo "    <option value=\"tm\" selected=\"selected\">";
                echo ($context["text_testimonial"] ?? null);
                echo "</option>
    ";
            } else {
                // line 547
                echo "    <option value=\"tm\">";
                echo ($context["text_testimonial"] ?? null);
                echo "</option>
    ";
            }
            // line 549
            echo "    </select>
    </div>
    </div> <!-- form-group ends -->
    
    <div id=\"data-holder-";
            // line 553
            echo ($context["column_row"] ?? null);
            echo "\">
    
    ";
            // line 555
            if ((twig_get_attribute($this->env, $this->source, $context["column"], "type", [], "any", false, false, false, 555) == "html")) {
                // line 556
                echo "    <legend>";
                echo ($context["text_title_htm"] ?? null);
                echo "</legend>
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
                // line 558
                echo ($context["text_position"] ?? null);
                echo "</label>
    <div class=\"col-sm-9\"> 
    <select name=\"columns[";
                // line 560
                echo ($context["column_row"] ?? null);
                echo "][data7]\" class=\"form-control\">
    ";
                // line 561
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["overlay_positions"] ?? null));
                foreach ($context['_seq'] as $context["key"] => $context["overlay_position"]) {
                    // line 562
                    echo "    <option value=\"";
                    echo $context["key"];
                    echo "\"";
                    if ((twig_get_attribute($this->env, $this->source, $context["column"], "data7", [], "any", false, false, false, 562) == $context["key"])) {
                        echo "selected=\"selected\"";
                    }
                    echo ">";
                    echo $context["overlay_position"];
                    echo "</option>
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['overlay_position'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 564
                echo "    </select>
    </div>
    </div> <!-- form-group ends -->
    
    <div class=\"tab-pane\">
    <div class=\"col-sm-offset-3 language-tabs-holder\">
    <ul class=\"nav nav-tabs\" id=\"tabs-";
                // line 570
                echo ($context["column_row"] ?? null);
                echo "\">
    ";
                // line 571
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                    // line 572
                    echo "    <li><a href=\"#tab-";
                    echo ($context["column_row"] ?? null);
                    echo "-";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 572);
                    echo "\" data-toggle=\"tab\"><img src=\"language/";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 572);
                    echo "/";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 572);
                    echo ".png\" title=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 572);
                    echo "\" /> ";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 572);
                    echo "</a></li>
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 574
                echo "    </ul>
    </div>
    <div class=\"tab-content\">
    ";
                // line 577
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                    // line 578
                    echo "    <div class=\"tab-pane\" id=\"tab-";
                    echo ($context["column_row"] ?? null);
                    echo "-";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 578);
                    echo "\">
    <div class=\"form-group\">
      <label class=\"col-sm-3 control-label\">";
                    // line 580
                    echo ($context["text_html_content"] ?? null);
                    echo "<br />
      <a id=\"enable_editor-";
                    // line 581
                    echo ($context["column_row"] ?? null);
                    echo "-";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 581);
                    echo "-1\" class=\"editor-link-";
                    echo ($context["column_row"] ?? null);
                    echo "-1\" onclick=\"enable_editor('";
                    echo ($context["column_row"] ?? null);
                    echo "', '";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 581);
                    echo "', '1')\"><small>";
                    echo ($context["text_enable_editor"] ?? null);
                    echo "</small></a><br />
      <a class=\"icon_list\"><small>";
                    // line 582
                    echo ($context["text_view_icons"] ?? null);
                    echo "</small></a><br />
      <a class=\"shortcode_list\"><small>";
                    // line 583
                    echo ($context["text_view_shortcodes"] ?? null);
                    echo "</small></a></label>
      <div class=\"col-sm-9\">
        <textarea name=\"columns[";
                    // line 585
                    echo ($context["column_row"] ?? null);
                    echo "][data1][";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 585);
                    echo "]\" class=\"form-control content-block template-reciever-";
                    echo ($context["column_row"] ?? null);
                    echo "-1\" id=\"textarea-";
                    echo ($context["column_row"] ?? null);
                    echo "-";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 585);
                    echo "-1\">";
                    echo (((($__internal_compile_6 = twig_get_attribute($this->env, $this->source, $context["column"], "data1", [], "any", false, false, false, 585)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 585)] ?? null) : null)) ? ((($__internal_compile_7 = twig_get_attribute($this->env, $this->source, $context["column"], "data1", [], "any", false, false, false, 585)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 585)] ?? null) : null)) : (""));
                    echo "</textarea>
      </div>
    </div>
    </div>
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 590
                echo "    </div>
    </div>
    ";
            }
            // line 593
            echo "    
    
    ";
            // line 595
            if ((twig_get_attribute($this->env, $this->source, $context["column"], "type", [], "any", false, false, false, 595) == "tm")) {
                // line 596
                echo "    <legend>";
                echo ($context["text_title_testimonial"] ?? null);
                echo "</legend>
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
                // line 598
                echo ($context["text_limit"] ?? null);
                echo "</label>
    <div class=\"col-sm-9\"> 
    <input type=\"text\" class=\"form-control\" name=\"columns[";
                // line 600
                echo ($context["column_row"] ?? null);
                echo "][data1]\" value=\"";
                echo ((twig_get_attribute($this->env, $this->source, $context["column"], "data1", [], "any", false, false, false, 600)) ? (twig_get_attribute($this->env, $this->source, $context["column"], "data1", [], "any", false, false, false, 600)) : ("3"));
                echo "\" />
    </div>
    </div> <!-- form-group ends -->
    
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
                // line 605
                echo ($context["text_tm_columns"] ?? null);
                echo "</label>
    <div class=\"col-sm-9\"> 
    <select name=\"columns[";
                // line 607
                echo ($context["column_row"] ?? null);
                echo "][data7]\" class=\"form-control\">
    ";
                // line 608
                if ((twig_get_attribute($this->env, $this->source, $context["column"], "data7", [], "any", false, false, false, 608) == "1")) {
                    // line 609
                    echo "    <option value=\"1\" selected=\"selected\">1</option>
    ";
                } else {
                    // line 611
                    echo "    <option value=\"1\">1</option>
    ";
                }
                // line 613
                echo "    ";
                if ((twig_get_attribute($this->env, $this->source, $context["column"], "data7", [], "any", false, false, false, 613) == "2")) {
                    // line 614
                    echo "    <option value=\"2\" selected=\"selected\">2</option>
    ";
                } else {
                    // line 616
                    echo "    <option value=\"2\">2</option>
    ";
                }
                // line 618
                echo "    ";
                if ((twig_get_attribute($this->env, $this->source, $context["column"], "data7", [], "any", false, false, false, 618) == "3")) {
                    // line 619
                    echo "    <option value=\"3\" selected=\"selected\">3</option>
    ";
                } else {
                    // line 621
                    echo "    <option value=\"3\">3</option>
    ";
                }
                // line 623
                echo "    </select>
    </div>
    </div> <!-- form-group ends -->
    
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
                // line 628
                echo ($context["text_tm_style"] ?? null);
                echo "</label>
    <div class=\"col-sm-9\"> 
    <select name=\"columns[";
                // line 630
                echo ($context["column_row"] ?? null);
                echo "][data8]\" class=\"form-control\">
    ";
                // line 631
                if ((twig_get_attribute($this->env, $this->source, $context["column"], "data8", [], "any", false, false, false, 631) == "plain")) {
                    // line 632
                    echo "    <option value=\"plain\" selected=\"selected\">";
                    echo ($context["text_tm_style_plain"] ?? null);
                    echo "</option>
    ";
                } else {
                    // line 634
                    echo "    <option value=\"plain\">";
                    echo ($context["text_tm_style_plain"] ?? null);
                    echo "</option>
    ";
                }
                // line 636
                echo "    ";
                if ((twig_get_attribute($this->env, $this->source, $context["column"], "data8", [], "any", false, false, false, 636) == "light plain")) {
                    // line 637
                    echo "    <option value=\"light plain\" selected=\"selected\">";
                    echo ($context["text_tm_style_plain_light"] ?? null);
                    echo "</option>
    ";
                } else {
                    // line 639
                    echo "    <option value=\"light plain\">";
                    echo ($context["text_tm_style_plain_light"] ?? null);
                    echo "</option>
    ";
                }
                // line 641
                echo "    ";
                if ((twig_get_attribute($this->env, $this->source, $context["column"], "data8", [], "any", false, false, false, 641) == "block")) {
                    // line 642
                    echo "    <option value=\"block\" selected=\"selected\">";
                    echo ($context["text_tm_style_block"] ?? null);
                    echo "</option>
    ";
                } else {
                    // line 644
                    echo "    <option value=\"block\">";
                    echo ($context["text_tm_style_block"] ?? null);
                    echo "</option>
    ";
                }
                // line 646
                echo "    </select>
    </div>
    </div> <!-- form-group ends -->
    
    ";
            }
            // line 651
            echo "    
    
    
    ";
            // line 654
            if ((twig_get_attribute($this->env, $this->source, $context["column"], "type", [], "any", false, false, false, 654) == "img")) {
                // line 655
                echo "    <legend>";
                echo ($context["text_title_banner"] ?? null);
                echo "</legend>

    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
                // line 658
                echo ($context["text_banner"] ?? null);
                echo "</label>
    <div class=\"col-sm-9\"> 
    <a id=\"thumb-image";
                // line 660
                echo ($context["column_row"] ?? null);
                echo "\" data-toggle=\"image\" class=\"img-thumbnail\">
    <img src=\"";
                // line 661
                echo ((twig_get_attribute($this->env, $this->source, $context["column"], "image", [], "any", false, false, false, 661)) ? (twig_get_attribute($this->env, $this->source, $context["column"], "image", [], "any", false, false, false, 661)) : (($context["placeholder"] ?? null)));
                echo "\" data-placeholder=\"";
                echo ($context["placeholder"] ?? null);
                echo "\" /></a>
    <input type=\"hidden\" name=\"columns[";
                // line 662
                echo ($context["column_row"] ?? null);
                echo "][data2]\" value=\"";
                echo ((twig_get_attribute($this->env, $this->source, $context["column"], "data2", [], "any", false, false, false, 662)) ? (twig_get_attribute($this->env, $this->source, $context["column"], "data2", [], "any", false, false, false, 662)) : (""));
                echo "\" id=\"input-image";
                echo ($context["column_row"] ?? null);
                echo "\" />
    </div>
    </div> <!-- form-group ends -->
    
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
                // line 667
                echo ($context["text_link_target"] ?? null);
                echo "</label>
    <div class=\"col-sm-9\"> 
    <input type=\"text\" class=\"form-control\" name=\"columns[";
                // line 669
                echo ($context["column_row"] ?? null);
                echo "][data5]\" value=\"";
                echo ((twig_get_attribute($this->env, $this->source, $context["column"], "data5", [], "any", false, false, false, 669)) ? (twig_get_attribute($this->env, $this->source, $context["column"], "data5", [], "any", false, false, false, 669)) : (""));
                echo "\" />
    </div>
    </div> <!-- form-group ends -->
    
    <legend class=\"sub\">";
                // line 673
                echo ($context["text_banner_overlay"] ?? null);
                echo "</legend>
    
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
                // line 676
                echo ($context["text_position_banner"] ?? null);
                echo "</label>
    <div class=\"col-sm-9\"> 
    <select name=\"columns[";
                // line 678
                echo ($context["column_row"] ?? null);
                echo "][data7]\" class=\"form-control\">
    ";
                // line 679
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["overlay_positions"] ?? null));
                foreach ($context['_seq'] as $context["key"] => $context["overlay_position"]) {
                    // line 680
                    echo "    <option value=\"";
                    echo $context["key"];
                    echo "\"";
                    if ((twig_get_attribute($this->env, $this->source, $context["column"], "data7", [], "any", false, false, false, 680) == $context["key"])) {
                        echo "selected=\"selected\"";
                    }
                    echo ">";
                    echo $context["overlay_position"];
                    echo "</option>
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['overlay_position'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 682
                echo "    </select>
    </div>
    </div> <!-- form-group ends -->
    
    <div class=\"tab-pane\">
    <div class=\"col-sm-offset-3 language-tabs-holder\">
    <ul class=\"nav nav-tabs\" id=\"tabs-";
                // line 688
                echo ($context["column_row"] ?? null);
                echo "\">
    ";
                // line 689
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                    // line 690
                    echo "    <li><a href=\"#tab-";
                    echo ($context["column_row"] ?? null);
                    echo "-";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 690);
                    echo "\" data-toggle=\"tab\"><img src=\"language/";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 690);
                    echo "/";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 690);
                    echo ".png\" title=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 690);
                    echo "\" /> ";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 690);
                    echo "</a></li>
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 692
                echo "    </ul>
    </div>
    <div class=\"tab-content\">
    ";
                // line 695
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                    // line 696
                    echo "    <div class=\"tab-pane\" id=\"tab-";
                    echo ($context["column_row"] ?? null);
                    echo "-";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 696);
                    echo "\">
    <div class=\"form-group\">
      <label class=\"col-sm-3 control-label\">";
                    // line 698
                    echo ($context["text_banner_overlay"] ?? null);
                    echo "<br /><a class=\"overlay_list\"><small>";
                    echo ($context["text_view_overlays"] ?? null);
                    echo "</small></a></label>
      <div class=\"col-sm-9\">
        <textarea name=\"columns[";
                    // line 700
                    echo ($context["column_row"] ?? null);
                    echo "][data1][";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 700);
                    echo "]\" class=\"form-control content-block template-reciever-";
                    echo ($context["column_row"] ?? null);
                    echo "-1\">";
                    echo (((($__internal_compile_8 = twig_get_attribute($this->env, $this->source, $context["column"], "data1", [], "any", false, false, false, 700)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 700)] ?? null) : null)) ? ((($__internal_compile_9 = twig_get_attribute($this->env, $this->source, $context["column"], "data1", [], "any", false, false, false, 700)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 700)] ?? null) : null)) : (""));
                    echo "</textarea>
      </div>
    </div>
    </div>
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 705
                echo "    
    </div>
    </div>
    
    <a class=\"btn btn-primary btn-block banner-btn-";
                // line 709
                echo ($context["column_row"] ?? null);
                echo "\" style=\"margin:20px 20px 10px 20px;display:";
                if (twig_get_attribute($this->env, $this->source, $context["column"], "data4", [], "any", false, false, false, 709)) {
                    echo "none";
                } else {
                    echo "block";
                }
                echo "\" onclick=\"add_second_banner('";
                echo ($context["column_row"] ?? null);
                echo "');\">";
                echo ($context["text_btn_add_banner"] ?? null);
                echo "</a>
  
    
    <div class=\"banner2-holder-";
                // line 712
                echo ($context["column_row"] ?? null);
                echo "\">
    ";
                // line 713
                if (twig_get_attribute($this->env, $this->source, $context["column"], "data4", [], "any", false, false, false, 713)) {
                    // line 714
                    echo "    <legend>";
                    echo ($context["text_title_banner2"] ?? null);
                    echo " <a class=\"remove_second_banner\" onclick=\"remove_second_banner('";
                    echo ($context["column_row"] ?? null);
                    echo "');\">[";
                    echo ($context["text_remove_banner"] ?? null);
                    echo "]</a></legend>
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
                    // line 716
                    echo ($context["text_banner"] ?? null);
                    echo "</label>
    <div class=\"col-sm-9\"> 
    <a id=\"thumb-image2";
                    // line 718
                    echo ($context["column_row"] ?? null);
                    echo "\" data-toggle=\"image\" class=\"img-thumbnail\">
    <img src=\"";
                    // line 719
                    echo ((twig_get_attribute($this->env, $this->source, $context["column"], "image2", [], "any", false, false, false, 719)) ? (twig_get_attribute($this->env, $this->source, $context["column"], "image2", [], "any", false, false, false, 719)) : (($context["placeholder"] ?? null)));
                    echo "\" data-placeholder=\"";
                    echo ($context["placeholder"] ?? null);
                    echo "\" /></a>
    <input type=\"hidden\" name=\"columns[";
                    // line 720
                    echo ($context["column_row"] ?? null);
                    echo "][data4]\" value=\"";
                    echo ((twig_get_attribute($this->env, $this->source, $context["column"], "data4", [], "any", false, false, false, 720)) ? (twig_get_attribute($this->env, $this->source, $context["column"], "data4", [], "any", false, false, false, 720)) : (""));
                    echo "\" id=\"input-image2";
                    echo ($context["column_row"] ?? null);
                    echo "\" />
    </div>
    </div> <!-- form-group ends -->
    
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
                    // line 725
                    echo ($context["text_link_target"] ?? null);
                    echo "</label>
    <div class=\"col-sm-9\"> 
    <input type=\"text\" class=\"form-control\" name=\"columns[";
                    // line 727
                    echo ($context["column_row"] ?? null);
                    echo "][data6]\" value=\"";
                    echo ((twig_get_attribute($this->env, $this->source, $context["column"], "data6", [], "any", false, false, false, 727)) ? (twig_get_attribute($this->env, $this->source, $context["column"], "data6", [], "any", false, false, false, 727)) : (""));
                    echo "\" />
    </div>
    </div> <!-- form-group ends -->
    
    <legend class=\"sub\">";
                    // line 731
                    echo ($context["text_banner_overlay"] ?? null);
                    echo "</legend>
    
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
                    // line 734
                    echo ($context["text_position_banner"] ?? null);
                    echo "</label>
    <div class=\"col-sm-9\"> 
    <select name=\"columns[";
                    // line 736
                    echo ($context["column_row"] ?? null);
                    echo "][data8]\" class=\"form-control\">
    ";
                    // line 737
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(($context["overlay_positions"] ?? null));
                    foreach ($context['_seq'] as $context["key"] => $context["overlay_position"]) {
                        // line 738
                        echo "    <option value=\"";
                        echo $context["key"];
                        echo "\"";
                        if ((twig_get_attribute($this->env, $this->source, $context["column"], "data8", [], "any", false, false, false, 738) == $context["key"])) {
                            echo "selected=\"selected\"";
                        }
                        echo ">";
                        echo $context["overlay_position"];
                        echo "</option>
    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['key'], $context['overlay_position'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 740
                    echo "    </select>
    </div>
    </div> <!-- form-group ends -->
    
    <div class=\"tab-pane\">
    <div class=\"col-sm-offset-3 language-tabs-holder\">
    <ul class=\"nav nav-tabs\" id=\"tabs2-";
                    // line 746
                    echo ($context["column_row"] ?? null);
                    echo "\">
    ";
                    // line 747
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                    foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                        // line 748
                        echo "    <li><a href=\"#tab2-";
                        echo ($context["column_row"] ?? null);
                        echo "-";
                        echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 748);
                        echo "\" data-toggle=\"tab\"><img src=\"language/";
                        echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 748);
                        echo "/";
                        echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 748);
                        echo ".png\" title=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 748);
                        echo "\" /> ";
                        echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 748);
                        echo "</a></li>
    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 750
                    echo "    </ul>
    </div>
    <div class=\"tab-content\">
    ";
                    // line 753
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                    foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                        // line 754
                        echo "    <div class=\"tab-pane\" id=\"tab2-";
                        echo ($context["column_row"] ?? null);
                        echo "-";
                        echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 754);
                        echo "\">
    <div class=\"form-group\">
    <label class=\"col-sm-3 control-label\">";
                        // line 756
                        echo ($context["text_banner_overlay"] ?? null);
                        echo "<br /><a class=\"overlay_list\"><small>";
                        echo ($context["text_view_overlays"] ?? null);
                        echo "</small></a></label>
    <div class=\"col-sm-9\">
    <textarea name=\"columns[";
                        // line 758
                        echo ($context["column_row"] ?? null);
                        echo "][data3][";
                        echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 758);
                        echo "]\" class=\"form-control content-block template-reciever-";
                        echo ($context["column_row"] ?? null);
                        echo "-2\">";
                        echo (((($__internal_compile_10 = twig_get_attribute($this->env, $this->source, $context["column"], "data3", [], "any", false, false, false, 758)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 758)] ?? null) : null)) ? ((($__internal_compile_11 = twig_get_attribute($this->env, $this->source, $context["column"], "data3", [], "any", false, false, false, 758)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 758)] ?? null) : null)) : (""));
                        echo "</textarea>
    </div>
    </div>
    </div>
    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 763
                    echo "    </div>
    </div>
    ";
                }
                // line 766
                echo "    </div>
    ";
            }
            // line 768
            echo "    
    

    </div>
    </div> <!-- tab-pane ends -->
    ";
            // line 773
            $context["column_row"] = (($context["column_row"] ?? null) + 1);
            // line 774
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['column'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo " <!-- foreach columns ends -->
    </div> <!-- columns holder ends -->
    </div> <!-- .right-side -->
    </div> <!-- .main-content -->
    </div> <!-- #tab-content -->
    
    <div class=\"tab-pane\" id=\"tab-templates\">
    <div class=\"template-content\">
    
    <table class=\"table table-bordered table-hover\">
    
    <thead>
    <td style=\"width:100%\">";
        // line 786
        echo ($context["text_template"] ?? null);
        echo "</td>
    <td class=\"text-right\">";
        // line 787
        echo ($context["text_action"] ?? null);
        echo "</td>
    </thead>
    
    ";
        // line 790
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["templates"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["template"]) {
            // line 791
            echo "    <tr>
    <td class=\"name\" style=\"width:100%\">";
            // line 792
            echo twig_get_attribute($this->env, $this->source, $context["template"], "name", [], "any", false, false, false, 792);
            echo "</td>
    <td style=\"white-space:nowrap;\">
    <a class=\"btn btn-primary\" data-toggle=\"tooltip\" title=\"";
            // line 794
            echo ($context["text_preview"] ?? null);
            echo "\" onclick=\"template_preview(";
            echo twig_get_attribute($this->env, $this->source, $context["template"], "template_id", [], "any", false, false, false, 794);
            echo ", '";
            echo twig_get_attribute($this->env, $this->source, $context["template"], "name", [], "any", false, false, false, 794);
            echo "');\"><i class=\"fa fa-eye\"></i></a>
    <a class=\"btn btn-success\" data-toggle=\"tooltip\" title=\"";
            // line 795
            echo ($context["text_import"] ?? null);
            echo "\" onclick=\"confirm('";
            echo ($context["text_confirm"] ?? null);
            echo "') ? location.href='";
            echo twig_get_attribute($this->env, $this->source, $context["template"], "import_url", [], "any", false, false, false, 795);
            echo "' : false;\"><i class=\"fa fa-download\"></i></a>
    </td>
    </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['template'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 799
        echo " 
    </table>
    
    </div> <!-- .template-content -->
    </div> <!-- #tab-templates -->
    
    </div>

    </form>
    </div> <!-- .panel-wrapper -->

   </div>



<script type=\"text/javascript\"><!--
// Add Column
var column_row = ";
        // line 816
        echo ($context["column_row"] ?? null);
        echo ";
function addColumn() {\t
html  = '<div class=\"tab-pane\" id=\"tab-column-' + column_row + '\">';
html += '<div class=\"form-group\">';
html += '<label class=\"col-sm-3 control-label\">";
        // line 820
        echo ($context["text_column_width"] ?? null);
        echo "</label>';
html += '<div class=\"col-sm-9\">';
html += '<select name=\"columns[' + column_row + '][w]\" onchange=\"set_width(\$(this).val(),' + column_row + ');\" class=\"form-control\">';
";
        // line 823
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["column_widths"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["column_width"]) {
            // line 824
            echo "html += '<option value=\"";
            echo $context["key"];
            echo "\">";
            echo $context["column_width"];
            echo "</option>';
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['column_width'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 826
        echo "html += '</select>';
html += '</div>';
html += '</div>';

html += '<div class=\"form-group\" id=\"custom-width-' + column_row + '\" style=\"display:none;\">';
html += '<label class=\"col-sm-3 control-label\">";
        // line 831
        echo ($context["text_width_per_device"] ?? null);
        echo "</label>';
html += '<div class=\"col-sm-9\">';
html += '<i class=\"fa fa-2x fa-mobile\"></i>&nbsp;';
html += '<select name=\"columns[' + column_row + '][w_sm]\" class=\"form-control inline\">';
";
        // line 835
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["sm_widths"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["sm_width"]) {
            // line 836
            echo "html += '<option value=\"";
            echo $context["key"];
            echo "\">";
            echo $context["sm_width"];
            echo "</option>';
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['sm_width'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 838
        echo "html += '</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
html += '<i class=\"fa fa-2x fa-tablet\"></i>&nbsp;';
html += '<select name=\"columns[' + column_row + '][w_md]\" class=\"form-control inline\">';
";
        // line 841
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["md_widths"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["md_width"]) {
            // line 842
            echo "html += '<option value=\"";
            echo $context["key"];
            echo "\">";
            echo $context["md_width"];
            echo "</option>';
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['md_width'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 844
        echo "html += '</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
html += '<i class=\"fa fa-2x fa-desktop\"></i>&nbsp;';
html += '<select name=\"columns[' + column_row + '][w_lg]\" class=\"form-control inline\">';
";
        // line 847
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["lg_widths"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["lg_width"]) {
            // line 848
            echo "html += '<option value=\"";
            echo $context["key"];
            echo "\">";
            echo $context["lg_width"];
            echo "</option>';
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['lg_width'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 850
        echo "html += '</select>';
html += '</div>';
html += '</div>';

html += '<div class=\"form-group\">';
html += '<label class=\"col-sm-3 control-label\">";
        // line 855
        echo ($context["text_type"] ?? null);
        echo "</label>';
html += '<div class=\"col-sm-9\">';
html += '<select name=\"columns[' + column_row + '][type]\" onchange=\"set_type(\$(this).val(),' + column_row + ');\" id=\"type-select-' + column_row + '\" class=\"form-control\">';
html += '<option>";
        // line 858
        echo ($context["text_select_type"] ?? null);
        echo "</option>';
html += '<option value=\"html\">";
        // line 859
        echo ($context["text_html"] ?? null);
        echo "</option>';
html += '<option value=\"img\">";
        // line 860
        echo ($context["text_banner"] ?? null);
        echo "</option>';
html += '<option value=\"tm\">";
        // line 861
        echo ($context["text_testimonial"] ?? null);
        echo "</option>';
html += '</select>';
html += '</div>';
html += '</div>';

html += '<div id=\"data-holder-' + column_row + '\">';
html += '</div>';

html += '</div>';        

\$('.tab-content.column-holder').append(html);
\t
\$('#column-add').before('<li><a href=\"#tab-column-' + column_row + '\" data-toggle=\"tab\"> ";
        // line 873
        echo ($context["text_column"] ?? null);
        echo " ' + column_row + ' <i class=\"fa fa-minus-circle\" onclick=\"\$(\\'a[href=\\\\\\'#tab-column-' + column_row + '\\\\\\']\\').parent().remove(); \$(\\'#tab-column-' + column_row + '\\').remove(); \$(\\'#column_tabs a:first\\').tab(\\'show\\');\"></i></a></li>');

\$('#column_tabs a[href=\\'#tab-column-' + column_row + '\\']').tab('show');
// Fix Bootstrap Tooltip
\$('[data-toggle=\\'tooltip\\']').tooltip({container: 'body'});
column_row++;
}
//--></script>

<script type=\"text/javascript\"><!--
// Set content type
var set_type = function(type, column_row) {

if( type == 'html' ) {
html = '<legend>";
        // line 887
        echo ($context["text_title_htm"] ?? null);
        echo "</legend>';
html += '<div class=\"form-group\">';
html += '<label class=\"col-sm-3 control-label\">";
        // line 889
        echo ($context["text_overlay_position"] ?? null);
        echo "</label>';
html += '<div class=\"col-sm-9\">';
html += '<select name=\"columns[' + column_row + '][data7]\" class=\"form-control\">';
";
        // line 892
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["overlay_positions"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["overlay_position"]) {
            // line 893
            echo "html += '<option value=\"";
            echo $context["key"];
            echo "\">";
            echo $context["overlay_position"];
            echo "</option>';
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['overlay_position'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 895
        echo "html += '</select>';
html += '</div>';
html += '</div>';
html += '<div class=\"tab-pane\">';
html += '<div class=\"col-sm-offset-3 language-tabs-holder\">';
html += '<ul class=\"nav nav-tabs\" id=\"tabs-' + column_row + '\">';
";
        // line 901
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 902
            echo "html += '<li><a href=\"#tab-' + column_row + '";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 902);
            echo "\" data-toggle=\"tab\"><img src=\"language/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 902);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 902);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 902);
            echo "\" /> ";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 902);
            echo "</a></li>';
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 904
        echo "html += '</ul>';
html += '</div>';
html += '<div class=\"tab-content\">';
";
        // line 907
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 908
            echo "html += '<div class=\"tab-pane\" id=\"tab-' + column_row + '";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 908);
            echo "\">';
html += '<div class=\"form-group\">';
html += '<label class=\"col-sm-3 control-label\">";
            // line 910
            echo ($context["text_html_content"] ?? null);
            echo "<br /><a id=\"enable_editor-' + column_row + '-";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 910);
            echo "-1\"  class=\"editor-link-' + column_row + '-1\" onclick=\"enable_editor(' + column_row + ', ";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 910);
            echo ",1);\"><small>";
            echo ($context["text_enable_editor"] ?? null);
            echo "</small></a><br /><a class=\"icon_list\"><small>";
            echo ($context["text_view_icons"] ?? null);
            echo "</small></a><br><a class=\"shortcode_list\"><small>";
            echo ($context["text_view_shortcodes"] ?? null);
            echo "</small></a></label>';
html += '<div class=\"col-sm-9\">';
html += '<textarea name=\"columns[' + column_row + '][data1][";
            // line 912
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 912);
            echo "]\" id=\"textarea-' + column_row + '-";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 912);
            echo "-1\" class=\"form-control content-block template-reciever-' + column_row + '-1\"></textarea>';
html += '</div>';
html += '</div>';
html += '</div>';
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 917
        echo "html += '</div>';
html += '</div>';
}

if( type == 'img' ) {
html = '<legend>";
        // line 922
        echo ($context["text_title_banner"] ?? null);
        echo "</legend>';
html += '<div class=\"form-group\">';
html += '<label class=\"col-sm-3 control-label\">";
        // line 924
        echo ($context["text_banner"] ?? null);
        echo "</label>';
html += '<div class=\"col-sm-9\">';
html += '<a href=\"\" id=\"thumb-image' + column_row + '\" data-toggle=\"image\" class=\"img-thumbnail\"><img src=\"";
        // line 926
        echo ($context["placeholder"] ?? null);
        echo "\" data-placeholder=\"";
        echo ($context["placeholder"] ?? null);
        echo "\" /></a>';
html += '<input type=\"hidden\" name=\"columns[' + column_row + '][data2]\" value=\"\" id=\"input-image' + column_row + '\" />';
html += '</div>';
html += '</div>';

html += '<div class=\"form-group\">';
html += '<label class=\"col-sm-3 control-label\">";
        // line 932
        echo ($context["text_link_target"] ?? null);
        echo "</label>';
html += '<div class=\"col-sm-9\">';
html += '<input type=\"text\" class=\"form-control\" name=\"columns[' + column_row + '][data5]\"/>';
html += '</div>';
html += '</div>';

html += '<legend class=\"sub\">";
        // line 938
        echo ($context["text_banner_overlay"] ?? null);
        echo "</legend>';

html += '<div class=\"form-group\">';
html += '<label class=\"col-sm-3 control-label\">";
        // line 941
        echo ($context["text_position_banner"] ?? null);
        echo "</label>';
html += '<div class=\"col-sm-9\">';
html += '<select name=\"columns[' + column_row + '][data7]\" class=\"form-control\">';
";
        // line 944
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["overlay_positions"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["overlay_position"]) {
            // line 945
            echo "html += '<option value=\"";
            echo $context["key"];
            echo "\">";
            echo $context["overlay_position"];
            echo "</option>';
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['overlay_position'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 947
        echo "html += '</select>';
html += '</div>';
html += '</div>';
\t\t\t
html += '<div class=\"tab-pane\">';
html += '<div class=\"col-sm-offset-3 language-tabs-holder\">';
html += '<ul class=\"nav nav-tabs\" id=\"tabs-' + column_row + '\">';
";
        // line 954
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 955
            echo "html += '<li><a href=\"#tab-' + column_row + '";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 955);
            echo "\" data-toggle=\"tab\"><img src=\"language/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 955);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 955);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 955);
            echo "\" /> ";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 955);
            echo "</a></li>';
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 957
        echo "html += '</ul>';
html += '</div>';
html += '<div class=\"tab-content\">';
";
        // line 960
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 961
            echo "html += '<div class=\"tab-pane\" id=\"tab-' + column_row + '";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 961);
            echo "\">';
html += '<div class=\"form-group\">';
html += '<label class=\"col-sm-3 control-label\">";
            // line 963
            echo ($context["text_banner_overlay"] ?? null);
            echo "<br /><a class=\"overlay_list\"><small>";
            echo ($context["text_view_overlays"] ?? null);
            echo "</small></a></label>';
html += '<div class=\"col-sm-9\">';
html += '<textarea name=\"columns[' + column_row + '][data1][";
            // line 965
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 965);
            echo "]\" id=\"textarea-' + column_row + '-";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 965);
            echo "-1\" class=\"form-control content-block template-reciever-' + column_row + '-1\"></textarea>';
html += '</div>';
html += '</div>';
html += '</div>';
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 970
        echo "html += '</div>';
html += '</div>';

html += '<a style=\"margin:20px 20px 10px 20px\" class=\"btn btn-primary btn-block banner-btn-' + column_row + '\" onclick=\"add_second_banner(' + column_row + ');\">";
        // line 973
        echo ($context["text_btn_add_banner"] ?? null);
        echo "</a>';

html += '<div class=\"banner2-holder-' + column_row + '\"';
html += '</div>';
}

if( type == 'tm' ) {
html = '<legend>";
        // line 980
        echo ($context["text_title_testimonial"] ?? null);
        echo "</legend>';
html += '<div class=\"form-group\">';
html += '<label class=\"col-sm-3 control-label\">";
        // line 982
        echo ($context["text_limit"] ?? null);
        echo "</label>';
html += '<div class=\"col-sm-9\">';
html += '<input type=\"text\" class=\"form-control\" name=\"columns[' + column_row + '][data1]\" value=\"3\"/>';
html += '</div>';
html += '</div>';

html += '<div class=\"form-group\">';
html += '<label class=\"col-sm-3 control-label\">";
        // line 989
        echo ($context["text_tm_columns"] ?? null);
        echo "</label>';
html += '<div class=\"col-sm-9\">';
html += '<select name=\"columns[' + column_row + '][data7]\" class=\"form-control\">';
html += '<option value=\"1\">1</option>';
html += '<option value=\"2\">2</option>';
html += '<option value=\"3\">3</option>';
html += '</select>';
html += '</div>';
html += '</div>';

html += '<div class=\"form-group\">';
html += '<label class=\"col-sm-3 control-label\">";
        // line 1000
        echo ($context["text_tm_style"] ?? null);
        echo "</label>';
html += '<div class=\"col-sm-9\">';
html += '<select name=\"columns[' + column_row + '][data8]\" class=\"form-control\">';
html += '<option value=\"plain\">";
        // line 1003
        echo ($context["text_tm_style_plain"] ?? null);
        echo "</option>';
html += '<option value=\"light plain\">";
        // line 1004
        echo ($context["text_tm_style_plain_light"] ?? null);
        echo "</option>';
html += '<option value=\"block\">";
        // line 1005
        echo ($context["text_tm_style_block"] ?? null);
        echo "</option>';
html += '</select>';
html += '</div>';
html += '</div>';
}

\$('#data-holder-' + column_row + '').html(html);
\$('#tabs-' + column_row + ' a:first').tab('show');
// Fix Bootstrap Tooltip
\$('[data-toggle=\\'tooltip\\']').tooltip({container: 'body'});
}
//--></script>
<script type=\"text/javascript\"><!--
// Set content type
var set_template = function(template, column_row, number) {
\t\t";
        // line 1020
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 1021
            echo "\t\t\$('#textarea-' + column_row + '-";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1021);
            echo "-' + number + '').summernote('destroy');
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1023
        echo "\t\t\$('.editor-link-' + column_row + '-' + number + '').text('";
        echo ($context["text_enable_editor"] ?? null);
        echo "').removeClass('active');
\t\t\$('.template-reciever-' + column_row + '-' + number + '').val(template);
\t
}
// Set column width
var set_width = function(width,column_row) {
\tif (width == 'custom') {
\t\t\$('#custom-width-' + column_row + '').css('display', 'block');
\t} else {
\t\t\$('#custom-width-' + column_row + '').css('display', 'none');
\t}
}
var enable_editor = function(column_row, lang_id, number) {
\tif ( \$('#enable_editor-' + column_row + '-' + lang_id + '-' + number + '').hasClass('active') ) {
\t\t\$('#enable_editor-' + column_row + '-' + lang_id + '-' + number + '').text('";
        // line 1037
        echo ($context["text_enable_editor"] ?? null);
        echo "').removeClass('active');
\t\t\$('#textarea-' + column_row + '-' + lang_id + '-' + number + '').summernote('destroy');
\t\t
\t} else {
\t\t\$('#enable_editor-' + column_row + '-' + lang_id + '-' + number + '').text('";
        // line 1041
        echo ($context["text_disable_editor"] ?? null);
        echo "').addClass('active');

\t\t\$('#textarea-' + column_row + '-' + lang_id + '-' + number + '').summernote({
\t\t\tdisableDragAndDrop: true,
\t\t\tstyleWithSpan: false,
\t\t\theight: 300,
\t\t\temptyPara: '',
\t\t\tcodemirror: { // codemirror options
\t\t\t\tmode: 'text/html',
\t\t\t\thtmlMode: true,
\t\t\t\tlineNumbers: true,
\t\t\t\ttheme: 'monokai'
\t\t\t},\t\t\t
\t\t\tfontsize: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '24', '30', '36', '48' , '64'],
\t\t\ttoolbar: [
\t\t\t\t['style', ['style']],
\t\t\t\t['font', ['bold', 'underline', 'clear']],
\t\t\t\t['fontname', ['fontname']],
\t\t\t\t['fontsize', ['fontsize']],
\t\t\t\t['color', ['color']],
\t\t\t\t['para', ['ul', 'ol', 'paragraph']],
\t\t\t\t['table', ['table']],
\t\t\t\t['insert', ['link', 'image', 'video']],
\t\t\t\t['view', ['fullscreen', 'codeview', 'help']]
\t\t\t],
\t\t\tcallbacks: {
\t\t\t\t\tonPaste: function (e) {
\t\t\t\t\tvar bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
\t\t\t\t\te.preventDefault();
\t\t\t\t\tdocument.execCommand('insertText', false, bufferText);
\t\t\t\t\t}
            },
\t\t\tpopover: {
           \t\timage: [
\t\t\t\t\t['custom', ['imageAttributes']],
\t\t\t\t\t['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
\t\t\t\t\t['float', ['floatLeft', 'floatRight', 'floatNone']],
\t\t\t\t\t['remove', ['removeMedia']]
\t\t\t\t],
\t\t\t},
\t\t\tbuttons: {
    \t\t\timage: function() {
\t\t\t\t\tvar ui = \$.summernote.ui;
\t\t\t\t\t// create button
\t\t\t\t\tvar button = ui.button({
\t\t\t\t\t\tcontents: '<i class=\"fa fa-image\" />',
\t\t\t\t\t\ttooltip: \$.summernote.lang[\$.summernote.options.lang].image.image,
\t\t\t\t\t\tclick: function () {
\t\t\t\t\t\t\t\$('#modal-image').remove();
\t\t\t\t\t\t\t\$.ajax({
\t\t\t\t\t\t\t\turl: 'index.php?route=common/filemanager&user_token=' + getURLVar('user_token'),
\t\t\t\t\t\t\t\tdataType: 'html',
\t\t\t\t\t\t\t\tbeforeSend: function() {
\t\t\t\t\t\t\t\t\t\$('#button-image i').replaceWith('<i class=\"fa fa-circle-o-notch fa-spin\"></i>');
\t\t\t\t\t\t\t\t\t\$('#button-image').prop('disabled', true);
\t\t\t\t\t\t\t\t},
\t\t\t\t\t\t\t\tcomplete: function() {
\t\t\t\t\t\t\t\t\t\$('#button-image i').replaceWith('<i class=\"fa fa-upload\"></i>');
\t\t\t\t\t\t\t\t\t\$('#button-image').prop('disabled', false);
\t\t\t\t\t\t\t\t},
\t\t\t\t\t\t\t\tsuccess: function(html) {
\t\t\t\t\t\t\t\t\t\$('body').append('<div id=\"modal-image\" class=\"modal\">' + html + '</div>');
\t\t\t\t\t\t\t\t\t\$('#modal-image').modal('show');
\t\t\t\t\t\t\t\t\t//\$('#modal-image a.thumbnail').on('click', function(e) {
\t\t\t\t\t\t\t\t\t\$('#modal-image').on('click', 'a.thumbnail', function(e) {
\t\t\t\t\t\t\t\t\t\te.preventDefault();
\t\t\t\t\t\t\t\t\t\t\$(textarea).summernote('insertImage', \$(this).attr('href'));
\t\t\t\t\t\t\t\t\t\t\$('#modal-image').modal('hide');
\t\t\t\t\t\t\t\t});}});}});
\t\t\t\treturn button.render();
\t\t}}});
\t}
}
var add_second_banner = function(column_row) {
html = \t'<legend>";
        // line 1115
        echo ($context["text_title_banner2"] ?? null);
        echo "'; 
html += '<a class=\"remove_second_banner\" onclick=\"remove_second_banner(' + column_row + ');\">[";
        // line 1116
        echo ($context["text_remove_banner"] ?? null);
        echo "]</a>';
html += '</legend>';

html += '<div class=\"form-group\">';
html += '<label class=\"col-sm-3 control-label\">";
        // line 1120
        echo ($context["text_banner"] ?? null);
        echo "</label>';
html += '<div class=\"col-sm-9\">';
html += '<a href=\"\" id=\"thumb-image2' + column_row + '\" data-toggle=\"image\" class=\"img-thumbnail\"><img src=\"";
        // line 1122
        echo ($context["placeholder"] ?? null);
        echo "\" data-placeholder=\"";
        echo ($context["placeholder"] ?? null);
        echo "\" /></a>';
html += '<input type=\"hidden\" name=\"columns[' + column_row + '][data4]\" value=\"\" id=\"input-image2' + column_row + '\" />';
html += '</div>';
html += '</div>';

html += '<div class=\"form-group\">';
html += '<label class=\"col-sm-3 control-label\">";
        // line 1128
        echo ($context["text_link_target"] ?? null);
        echo "</label>';
html += '<div class=\"col-sm-9\">';
html += '<input type=\"text\" class=\"form-control\" name=\"columns[' + column_row + '][data6]\"/>';
html += '</div>';
html += '</div>';

html += '<legend class=\"sub\">";
        // line 1134
        echo ($context["text_banner_overlay"] ?? null);
        echo "</legend>';

html += '<div class=\"form-group\">';
html += '<label class=\"col-sm-3 control-label\">";
        // line 1137
        echo ($context["text_position_banner"] ?? null);
        echo "</label>';
html += '<div class=\"col-sm-9\">';
html += '<select name=\"columns[' + column_row + '][data8]\" class=\"form-control\">';
";
        // line 1140
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["overlay_positions"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["overlay_position"]) {
            // line 1141
            echo "html += '<option value=\"";
            echo $context["key"];
            echo "\">";
            echo $context["overlay_position"];
            echo "</option>';
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['overlay_position'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1143
        echo "html += '</select>';
html += '</div>';
html += '</div>';

html += '<div class=\"tab-pane\">';
html += '<div class=\"col-sm-offset-3 language-tabs-holder\">';
html += '<ul class=\"nav nav-tabs\" id=\"tabs2-' + column_row + '\">';
";
        // line 1150
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 1151
            echo "html += '<li><a href=\"#tab2-' + column_row + '";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1151);
            echo "\" data-toggle=\"tab\"><img src=\"language/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 1151);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 1151);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 1151);
            echo "\" /> ";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 1151);
            echo "</a></li>';
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1153
        echo "html += '</ul>';
html += '</div>';
html += '<div class=\"tab-content\">';
";
        // line 1156
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 1157
            echo "html += '<div class=\"tab-pane\" id=\"tab2-' + column_row + '";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1157);
            echo "\">';
html += '<div class=\"form-group\">';
html += '<label class=\"col-sm-3 control-label\">";
            // line 1159
            echo ($context["text_banner_overlay"] ?? null);
            echo "<br /><a class=\"overlay_list\"><small>";
            echo ($context["text_view_overlays"] ?? null);
            echo "</small></a></label>';
html += '<div class=\"col-sm-9\">';
html += '<textarea name=\"columns[' + column_row + '][data3][";
            // line 1161
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1161);
            echo "]\" id=\"textarea-' + column_row + '-";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 1161);
            echo "-2\" class=\"form-control content-block template-reciever-' + column_row + '-2\"></textarea>';
html += '</div>';
html += '</div>';
html += '</div>';
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1166
        echo "html += '</div>';
html += '</div>';

\$('.banner2-holder-' + column_row + '').html(html);
\$('#tabs2-' + column_row + ' a:first').tab('show');
\$('.banner-btn-' + column_row + '').css('display', 'none');
// Fix Bootstrap Tooltip
\$('[data-toggle=\\'tooltip\\']').tooltip({container: 'body'});
}
var remove_second_banner = function(column_row) {
\$('.banner2-holder-' + column_row + '').html('');
\$('.banner-btn-' + column_row + '').css('display', 'block');
}
//--></script>
<script type=\"text/javascript\">
/* HTML templates popup */
var template_preview = function(template, name) {
\t\$.ajax({
\t\ttype: 'get',
\t\tdataType: 'html',
\t\tsuccess: function(data) {
\t\t\thtml  = '<div id=\"modal-' + template + '\" class=\"modal content\">';
\t\t\thtml += '  <div class=\"modal-dialog\">';
\t\t\thtml += '    <div class=\"modal-content\">';
\t\t\thtml += '      <div class=\"modal-header\">';
\t\t\thtml += '        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>';
\t\t\thtml += '        <h4 class=\"modal-title\">";
        // line 1192
        echo ($context["text_preview_template"] ?? null);
        echo ": ' + name + '</h4>';
\t\t\thtml += '      </div>';
\t\t\thtml += '      <div class=\"modal-body\"><img src=\"view/javascript/basel/content_templates/' + template + '/preview.png\"</div>';
\t\t\thtml += '    </div';
\t\t\thtml += '  </div>';
\t\t\thtml += '</div>';
\t\t\t\$('body').append(html);
\t\t\t\$('#modal-' + template + '').modal('show');
\t\t}
\t});
}
\$(document).delegate('.icon_list', 'click', function(e) {
\te.preventDefault();
\t\$.ajax({
\t\ttype: 'get',
\t\tdataType: 'html',
\t\tsuccess: function(data) {
\t\t\thtml  = '<div id=\"modal-icons\" class=\"modal content\">';
\t\t\thtml += '  <div class=\"modal-dialog\">';
\t\t\thtml += '    <div class=\"modal-content\">';
\t\t\thtml += '      <div class=\"modal-header\">';
\t\t\thtml += '        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>';
\t\t\thtml += '        <h4 class=\"modal-title\">";
        // line 1214
        echo ($context["text_icons_list"] ?? null);
        echo "</h4>';
\t\t\thtml += '      </div>';
\t\t\thtml += '      <div class=\"modal-body\" style=\"padding:30px 0;\"><iframe src=\"view/javascript/basel/icons_list/icon_list.html\" width=\"1240\" height=\"560\" frameborder=\"0\" allowtransparency=\"true\"></iframe></div>';
\t\t\thtml += '    </div';
\t\t\thtml += '  </div>';
\t\t\thtml += '</div>';
\t\t\t\$('body').append(html);
\t\t\t\$('#modal-icons').modal('show');
\t\t}
\t});
});
\$(document).delegate('.shortcode_list', 'click', function(e) {
\te.preventDefault();
\t\$.ajax({
\t\ttype: 'get',
\t\tdataType: 'html',
\t\tsuccess: function(data) {
\t\t\thtml  = '<div id=\"modal-shortcode\" class=\"modal content\">';
\t\t\thtml += '  <div class=\"modal-dialog\">';
\t\t\thtml += '    <div class=\"modal-content\">';
\t\t\thtml += '      <div class=\"modal-header\">';
\t\t\thtml += '        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>';
\t\t\thtml += '        <h4 class=\"modal-title\">Shortcodes</h4>';
\t\t\thtml += '      </div>';
\t\t\thtml += '      <div class=\"modal-body\"><iframe src=\"view/javascript/basel/shortcode_list/shortcode_list.html\" width=\"1240\" height=\"560\" frameborder=\"0\" allowtransparency=\"true\"></iframe></div>';
\t\t\thtml += '    </div';
\t\t\thtml += '  </div>';
\t\t\thtml += '</div>';
\t\t\t\$('body').append(html);
\t\t\t\$('#modal-shortcode').modal('show');
\t\t}
\t});
});
\$(document).delegate('.overlay_list', 'click', function(e) {
\te.preventDefault();
\t\$.ajax({
\t\ttype: 'get',
\t\tdataType: 'html',
\t\tsuccess: function(data) {
\t\t\thtml  = '<div id=\"modal-overlay\" class=\"modal content\">';
\t\t\thtml += '  <div class=\"modal-dialog\">';
\t\t\thtml += '    <div class=\"modal-content\">';
\t\t\thtml += '      <div class=\"modal-header\">';
\t\t\thtml += '        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>';
\t\t\thtml += '        <h4 class=\"modal-title\">Banner overlay examples</h4>';
\t\t\thtml += '      </div>';
\t\t\thtml += '      <div class=\"modal-body\"><iframe src=\"view/javascript/basel/overlay_list/overlay_list.html\" width=\"1240\" height=\"560\" frameborder=\"0\" allowtransparency=\"true\"></iframe></div>';
\t\t\thtml += '    </div';
\t\t\thtml += '  </div>';
\t\t\thtml += '</div>';
\t\t\t\$('body').append(html);
\t\t\t\$('#modal-overlay').modal('show');
\t\t}
\t});
});
//--></script>
<script type=\"text/javascript\"><!--
// Import ready made templates
\$('.margin_select').on('change', function() {
  \tif (\$(this).val() == '1') {
\t\t\$('#custom_margin_field').css('display', 'block');
\t} else {
\t\t\$('#custom_margin_field').css('display', 'none');
\t}
});
\$('.bg_color_select').on('change', function() {
  \tif (\$(this).val() == '1') {
\t\t\$('#background_color_field').css('display', 'block');
\t} else {
\t\t\$('#background_color_field').css('display', 'none');
\t}
});
\$('.color_field').colorpicker({
sliders: {
saturation: {
\tmaxLeft: 150,
\tmaxTop: 150},
\thue: { maxTop: 150},
\talpha: { maxTop: 150}
\t}
});

\$('.bg_image_select').on('change', function() {
  \tif (\$(this).val() == '1') {
\t\t\$('.background_image_field').css('display', 'block');
\t} else {
\t\t\$('.background_image_field').css('display', 'none');
\t}
});
\$('.bg_video_select').on('change', function() {
  \tif (\$(this).val() == '1') {
\t\t\$('#background_video_field').css('display', 'block');
\t} else {
\t\t\$('#background_video_field').css('display', 'none');
\t}
});
\$('.title_select').on('change', function() {
  \tif (\$(this).val() == '1') {
\t\t\$('.title_field').css('display', 'block');
\t} else {
\t\t\$('.title_field').css('display', 'none');
\t}
});
\$('.c_css_select').on('change', function() {
  \tif (\$(this).val() == '1') {
\t\t\$('#content_css_field').css('display', 'block');
\t} else {
\t\t\$('#content_css_field').css('display', 'none');
\t}
});
\$('.b_css_select').on('change', function() {
  \tif (\$(this).val() == '1') {
\t\t\$('#block_css_field').css('display', 'block');
\t} else {
\t\t\$('#block_css_field').css('display', 'none');
\t}
});
//--></script>
<script type=\"text/javascript\"><!--
\$('#column_tabs li:first-child a').tab('show');
var column_row = 1;
";
        // line 1335
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["columns"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["column"]) {
            // line 1336
            echo "\$('#tabs-' + column_row + ' li:first-child a').tab('show');
\$('#tabs2-' + column_row + ' li:first-child a').tab('show');
column_row++;
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['column'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1340
        echo "//--></script> 
</div>
<link href=\"view/javascript/codemirror/lib/codemirror.css\" rel=\"stylesheet\" />
<link href=\"view/javascript/codemirror/theme/monokai.css\" rel=\"stylesheet\" />
<script type=\"text/javascript\" src=\"view/javascript/codemirror/lib/codemirror.js\"></script> 
<script type=\"text/javascript\" src=\"view/javascript/codemirror/lib/xml.js\"></script> 
<script type=\"text/javascript\" src=\"view/javascript/codemirror/lib/formatting.js\"></script> 
<script type=\"text/javascript\" src=\"view/javascript/summernote/summernote.js\"></script>
<link href=\"view/javascript/summernote/summernote.css\" rel=\"stylesheet\" />
<script type=\"text/javascript\" src=\"view/javascript/summernote/summernote-image-attributes.js\"></script>
<script type=\"text/javascript\" src=\"view/javascript/summernote/opencart.js\"></script>
";
        // line 1351
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "extension/module/basel_content.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  3123 => 1351,  3110 => 1340,  3101 => 1336,  3097 => 1335,  2973 => 1214,  2948 => 1192,  2920 => 1166,  2907 => 1161,  2900 => 1159,  2894 => 1157,  2890 => 1156,  2885 => 1153,  2868 => 1151,  2864 => 1150,  2855 => 1143,  2844 => 1141,  2840 => 1140,  2834 => 1137,  2828 => 1134,  2819 => 1128,  2808 => 1122,  2803 => 1120,  2796 => 1116,  2792 => 1115,  2715 => 1041,  2708 => 1037,  2690 => 1023,  2681 => 1021,  2677 => 1020,  2659 => 1005,  2655 => 1004,  2651 => 1003,  2645 => 1000,  2631 => 989,  2621 => 982,  2616 => 980,  2606 => 973,  2601 => 970,  2588 => 965,  2581 => 963,  2575 => 961,  2571 => 960,  2566 => 957,  2549 => 955,  2545 => 954,  2536 => 947,  2525 => 945,  2521 => 944,  2515 => 941,  2509 => 938,  2500 => 932,  2489 => 926,  2484 => 924,  2479 => 922,  2472 => 917,  2459 => 912,  2444 => 910,  2438 => 908,  2434 => 907,  2429 => 904,  2412 => 902,  2408 => 901,  2400 => 895,  2389 => 893,  2385 => 892,  2379 => 889,  2374 => 887,  2357 => 873,  2342 => 861,  2338 => 860,  2334 => 859,  2330 => 858,  2324 => 855,  2317 => 850,  2306 => 848,  2302 => 847,  2297 => 844,  2286 => 842,  2282 => 841,  2277 => 838,  2266 => 836,  2262 => 835,  2255 => 831,  2248 => 826,  2237 => 824,  2233 => 823,  2227 => 820,  2220 => 816,  2201 => 799,  2187 => 795,  2179 => 794,  2174 => 792,  2171 => 791,  2167 => 790,  2161 => 787,  2157 => 786,  2138 => 774,  2136 => 773,  2129 => 768,  2125 => 766,  2120 => 763,  2103 => 758,  2096 => 756,  2088 => 754,  2084 => 753,  2079 => 750,  2060 => 748,  2056 => 747,  2052 => 746,  2044 => 740,  2029 => 738,  2025 => 737,  2021 => 736,  2016 => 734,  2010 => 731,  2001 => 727,  1996 => 725,  1984 => 720,  1978 => 719,  1974 => 718,  1969 => 716,  1959 => 714,  1957 => 713,  1953 => 712,  1937 => 709,  1931 => 705,  1914 => 700,  1907 => 698,  1899 => 696,  1895 => 695,  1890 => 692,  1871 => 690,  1867 => 689,  1863 => 688,  1855 => 682,  1840 => 680,  1836 => 679,  1832 => 678,  1827 => 676,  1821 => 673,  1812 => 669,  1807 => 667,  1795 => 662,  1789 => 661,  1785 => 660,  1780 => 658,  1773 => 655,  1771 => 654,  1766 => 651,  1759 => 646,  1753 => 644,  1747 => 642,  1744 => 641,  1738 => 639,  1732 => 637,  1729 => 636,  1723 => 634,  1717 => 632,  1715 => 631,  1711 => 630,  1706 => 628,  1699 => 623,  1695 => 621,  1691 => 619,  1688 => 618,  1684 => 616,  1680 => 614,  1677 => 613,  1673 => 611,  1669 => 609,  1667 => 608,  1663 => 607,  1658 => 605,  1648 => 600,  1643 => 598,  1637 => 596,  1635 => 595,  1631 => 593,  1626 => 590,  1605 => 585,  1600 => 583,  1596 => 582,  1582 => 581,  1578 => 580,  1570 => 578,  1566 => 577,  1561 => 574,  1542 => 572,  1538 => 571,  1534 => 570,  1526 => 564,  1511 => 562,  1507 => 561,  1503 => 560,  1498 => 558,  1492 => 556,  1490 => 555,  1485 => 553,  1479 => 549,  1473 => 547,  1467 => 545,  1464 => 544,  1458 => 542,  1452 => 540,  1449 => 539,  1443 => 537,  1437 => 535,  1435 => 534,  1427 => 533,  1422 => 531,  1415 => 526,  1400 => 524,  1396 => 523,  1392 => 522,  1387 => 519,  1372 => 517,  1368 => 516,  1364 => 515,  1359 => 512,  1344 => 510,  1340 => 509,  1336 => 508,  1330 => 505,  1320 => 504,  1313 => 499,  1298 => 497,  1294 => 496,  1288 => 495,  1283 => 493,  1276 => 490,  1272 => 489,  1269 => 488,  1267 => 487,  1257 => 481,  1251 => 480,  1249 => 479,  1236 => 478,  1231 => 477,  1229 => 476,  1221 => 471,  1212 => 464,  1207 => 462,  1202 => 461,  1197 => 459,  1192 => 458,  1190 => 457,  1185 => 455,  1179 => 451,  1174 => 449,  1169 => 448,  1164 => 446,  1159 => 445,  1157 => 444,  1152 => 442,  1146 => 439,  1139 => 435,  1134 => 433,  1126 => 432,  1121 => 429,  1116 => 427,  1111 => 426,  1106 => 424,  1101 => 423,  1099 => 422,  1094 => 420,  1088 => 416,  1083 => 414,  1078 => 413,  1073 => 411,  1068 => 410,  1066 => 409,  1061 => 407,  1055 => 404,  1046 => 398,  1041 => 396,  1033 => 395,  1028 => 392,  1023 => 390,  1018 => 389,  1013 => 387,  1008 => 386,  1006 => 385,  1001 => 383,  992 => 377,  987 => 375,  979 => 374,  974 => 371,  969 => 369,  964 => 368,  959 => 366,  954 => 365,  952 => 364,  947 => 362,  939 => 356,  935 => 354,  931 => 352,  928 => 351,  924 => 349,  920 => 347,  917 => 346,  913 => 344,  909 => 342,  906 => 341,  902 => 339,  898 => 337,  896 => 336,  890 => 333,  882 => 332,  876 => 328,  872 => 326,  868 => 324,  865 => 323,  861 => 321,  857 => 319,  854 => 318,  850 => 316,  846 => 314,  843 => 313,  839 => 311,  835 => 309,  832 => 308,  828 => 306,  824 => 304,  821 => 303,  817 => 301,  813 => 299,  810 => 298,  806 => 296,  802 => 294,  799 => 293,  795 => 291,  791 => 289,  788 => 288,  784 => 286,  780 => 284,  778 => 283,  772 => 280,  764 => 279,  758 => 275,  754 => 273,  750 => 271,  747 => 270,  743 => 268,  739 => 266,  736 => 265,  732 => 263,  728 => 261,  725 => 260,  721 => 258,  717 => 256,  714 => 255,  710 => 253,  706 => 251,  703 => 250,  699 => 248,  695 => 246,  692 => 245,  688 => 243,  684 => 241,  681 => 240,  677 => 238,  673 => 236,  670 => 235,  666 => 233,  662 => 231,  659 => 230,  653 => 228,  647 => 226,  645 => 225,  639 => 222,  631 => 221,  624 => 217,  618 => 216,  614 => 215,  606 => 214,  601 => 211,  596 => 209,  591 => 208,  586 => 206,  581 => 205,  579 => 204,  574 => 202,  565 => 196,  559 => 193,  551 => 192,  546 => 189,  541 => 187,  536 => 186,  531 => 184,  526 => 183,  524 => 182,  519 => 180,  512 => 175,  507 => 173,  502 => 172,  497 => 170,  492 => 169,  490 => 168,  485 => 166,  475 => 161,  469 => 160,  463 => 159,  457 => 158,  452 => 156,  444 => 155,  439 => 152,  434 => 150,  429 => 149,  424 => 147,  419 => 146,  417 => 145,  412 => 143,  405 => 138,  394 => 135,  386 => 134,  383 => 133,  379 => 132,  374 => 130,  366 => 129,  361 => 126,  350 => 123,  342 => 122,  339 => 121,  335 => 120,  330 => 118,  322 => 117,  317 => 114,  306 => 111,  298 => 110,  295 => 109,  291 => 108,  286 => 106,  278 => 105,  273 => 102,  268 => 100,  263 => 99,  258 => 97,  253 => 96,  251 => 95,  246 => 93,  240 => 90,  230 => 83,  226 => 82,  222 => 81,  217 => 79,  213 => 78,  208 => 76,  202 => 72,  197 => 70,  192 => 69,  187 => 67,  182 => 66,  180 => 65,  175 => 63,  169 => 59,  163 => 57,  161 => 56,  155 => 55,  150 => 53,  144 => 50,  131 => 40,  127 => 39,  120 => 35,  116 => 33,  108 => 29,  106 => 28,  103 => 27,  95 => 23,  93 => 22,  86 => 17,  75 => 15,  71 => 14,  66 => 12,  59 => 10,  54 => 9,  48 => 7,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/module/basel_content.twig", "");
    }
}
