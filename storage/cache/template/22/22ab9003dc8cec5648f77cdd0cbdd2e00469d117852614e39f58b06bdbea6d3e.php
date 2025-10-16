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

/* extension/module/blog_latest.twig */
class __TwigTemplate_9d5e19c5e186e0a848eb10a17903cacb87dd042612c102f4a10da82c8596a8c7 extends \Twig\Template
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
      <div class=\"pull-right\">
        <button type=\"submit\" form=\"form-blog_latest\" data-toggle=\"tooltip\" title=\"";
        // line 6
        echo ($context["button_save"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-save\"></i></button>
        <a href=\"";
        // line 7
        echo ($context["cancel"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_cancel"] ?? null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-reply\"></i></a></div>
      <h1>";
        // line 8
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      <ul class=\"breadcrumb\">
        ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 11
            echo "        <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 11);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 11);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "      </ul>
    </div>
  </div>
  <div class=\"container-fluid\">
    ";
        // line 17
        if (($context["error_warning"] ?? null)) {
            // line 18
            echo "    <div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 22
        echo "    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-pencil\"></i> ";
        // line 24
        echo ($context["text_edit"] ?? null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
        <form action=\"";
        // line 27
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-blog_latest\" class=\"form-horizontal\">
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-name\">";
        // line 29
        echo ($context["entry_name"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"name\" value=\"";
        // line 31
        echo ($context["name"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_name"] ?? null);
        echo "\" id=\"input-name\" class=\"form-control\" />
              ";
        // line 32
        if (($context["error_name"] ?? null)) {
            // line 33
            echo "              <div class=\"text-danger\">";
            echo ($context["error_name"] ?? null);
            echo "</div>
              ";
        }
        // line 35
        echo "            </div>
          </div>
          
            <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 39
        echo ($context["entry_status"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 41
        if (($context["status"] ?? null)) {
            // line 42
            echo "            <label><input type=\"radio\" name=\"status\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"status\" value=\"1\" checked=\"checked\" /><span>";
            // line 43
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 45
            echo "            <label><input type=\"radio\" name=\"status\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"status\" value=\"1\" /><span>";
            // line 46
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 48
        echo "            </div>                   
            </div>
            
            <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 52
        echo ($context["entry_contrast"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 54
        if (($context["contrast"] ?? null)) {
            // line 55
            echo "            <label><input type=\"radio\" name=\"contrast\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"contrast\" value=\"1\" checked=\"checked\" /><span>";
            // line 56
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 58
            echo "            <label><input type=\"radio\" name=\"contrast\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"contrast\" value=\"1\" /><span>";
            // line 59
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 61
        echo "            </div>                   
            </div>
            
            <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 65
        echo ($context["text_use_block_title"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 67
        if (($context["use_title"] ?? null)) {
            // line 68
            echo "            <label><input type=\"radio\" class=\"title_select\" name=\"use_title\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"title_select\" name=\"use_title\" value=\"1\" checked=\"checked\" /><span>";
            // line 69
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 71
            echo "            <label><input type=\"radio\" class=\"title_select\" name=\"use_title\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"title_select\" name=\"use_title\" value=\"1\" /><span>";
            // line 72
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 74
        echo "            </div>                   
            </div>
            
            <div class=\"form-group title_field\" style=\"display:";
        // line 77
        if (($context["use_title"] ?? null)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
            <label class=\"col-sm-2 control-label\">";
        // line 78
        echo ($context["text_block_pre_line"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
            ";
        // line 80
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 81
            echo "            <div class=\"input-group\">
            <span class=\"input-group-addon\"><img src=\"language/";
            // line 82
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 82);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 82);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 82);
            echo "\" /></span>
            <input type=\"text\" name=\"title_pl[";
            // line 83
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 83);
            echo "]\" value=\"";
            echo (((($__internal_compile_0 = ($context["title_pl"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 83)] ?? null) : null)) ? ((($__internal_compile_1 = ($context["title_pl"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 83)] ?? null) : null)) : (""));
            echo "\" class=\"form-control\" />
            </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 86
        echo "            </div>
            </div>
            
            <div class=\"form-group title_field\" style=\"display:";
        // line 89
        if (($context["use_title"] ?? null)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
            <label class=\"col-sm-2 control-label\">";
        // line 90
        echo ($context["text_block_title"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
            ";
        // line 92
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 93
            echo "            <div class=\"input-group\">
            <span class=\"input-group-addon\"><img src=\"language/";
            // line 94
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 94);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 94);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 94);
            echo "\" /></span>
            <input type=\"text\" name=\"title_m[";
            // line 95
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 95);
            echo "]\" value=\"";
            echo (((($__internal_compile_2 = ($context["title_m"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 95)] ?? null) : null)) ? ((($__internal_compile_3 = ($context["title_m"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 95)] ?? null) : null)) : (""));
            echo "\" class=\"form-control\" />
            </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 98
        echo "            </div>
            </div>
            
            <div class=\"form-group title_field\" style=\"display:";
        // line 101
        if (($context["use_title"] ?? null)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
            <label class=\"col-sm-2 control-label\">";
        // line 102
        echo ($context["text_block_sub_line"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
            ";
        // line 104
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 105
            echo "            <div class=\"input-group\">
            <span class=\"input-group-addon\"><img src=\"language/";
            // line 106
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 106);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 106);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 106);
            echo "\" /></span>
            <textarea type=\"text\" name=\"title_b[";
            // line 107
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 107);
            echo "]\" class=\"form-control\">";
            echo (((($__internal_compile_4 = ($context["title_b"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 107)] ?? null) : null)) ? ((($__internal_compile_5 = ($context["title_b"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 107)] ?? null) : null)) : (""));
            echo "</textarea>
            </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 110
        echo "            </div>
            </div>
            
            <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">
            <span data-toggle=\"tooltip\" title=\"";
        // line 115
        echo ($context["entry_characters_h"] ?? null);
        echo "\">";
        echo ($context["entry_characters"] ?? null);
        echo "</span></label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"characters\" value=\"";
        // line 117
        echo ($context["characters"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_characters"] ?? null);
        echo "\" id=\"input-limit\" class=\"form-control\" />
            </div>
          </div>
          
          
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 123
        echo ($context["entry_thumb"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 125
        if (($context["use_thumb"] ?? null)) {
            // line 126
            echo "            <label><input type=\"radio\" class=\"thumb_select\" name=\"use_thumb\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"thumb_select\" name=\"use_thumb\" value=\"1\" checked=\"checked\" /><span>";
            // line 127
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 129
            echo "            <label><input type=\"radio\" class=\"thumb_select\" name=\"use_thumb\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"thumb_select\" name=\"use_thumb\" value=\"1\" /><span>";
            // line 130
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 132
        echo "            </div>                   
            </div>
          
          
          <div class=\"form-group thumb_field\" style=\"display:";
        // line 136
        if (($context["use_thumb"] ?? null)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
            <label class=\"col-sm-2 control-label\" for=\"input-height\">";
        // line 137
        echo ($context["entry_thumb_size"] ?? null);
        echo "</label>
            <div class=\"col-sm-5\">
            <input type=\"text\" name=\"width\" value=\"";
        // line 139
        echo ($context["width"] ?? null);
        echo "\" id=\"input-width\" class=\"form-control\" />
            </div>
            <div class=\"col-sm-5\">
            <input type=\"text\" name=\"height\" value=\"";
        // line 142
        echo ($context["height"] ?? null);
        echo "\" id=\"input-height\" class=\"form-control\" />
            </div>
          </div>
            
            
           <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 148
        echo ($context["entry_limit"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"limit\" value=\"";
        // line 150
        echo ($context["limit"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_limit"] ?? null);
        echo "\" id=\"input-limit\" class=\"form-control\" />
            </div>
          </div>
            

          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-width\">";
        // line 156
        echo ($context["entry_columns"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
            <select name=\"columns\" id=\"input-columns\" class=\"form-control\">
            ";
        // line 159
        if ((($context["columns"] ?? null) == "4")) {
            // line 160
            echo "            <option value=\"4\" selected=\"selected\">";
            echo ($context["text_4"] ?? null);
            echo "</option>
            ";
        } else {
            // line 162
            echo "            <option value=\"4\">";
            echo ($context["text_4"] ?? null);
            echo "</option>
            ";
        }
        // line 164
        echo "            ";
        if ((($context["columns"] ?? null) == "3")) {
            // line 165
            echo "            <option value=\"3\" selected=\"selected\">";
            echo ($context["text_3"] ?? null);
            echo "</option>
            ";
        } else {
            // line 167
            echo "            <option value=\"3\">";
            echo ($context["text_3"] ?? null);
            echo "</option>
            ";
        }
        // line 169
        echo "            ";
        if ((($context["columns"] ?? null) == "2")) {
            // line 170
            echo "            <option value=\"2\" selected=\"selected\">";
            echo ($context["text_2"] ?? null);
            echo "</option>
            ";
        } else {
            // line 172
            echo "            <option value=\"2\">";
            echo ($context["text_2"] ?? null);
            echo "</option>
            ";
        }
        // line 174
        echo "            ";
        if ((($context["columns"] ?? null) == "1")) {
            // line 175
            echo "            <option value=\"1\" selected=\"selected\">";
            echo ($context["text_1"] ?? null);
            echo "</option>
            ";
        } else {
            // line 177
            echo "            <option value=\"1\">";
            echo ($context["text_1"] ?? null);
            echo "</option>
            ";
        }
        // line 179
        echo "            ";
        if ((($context["columns"] ?? null) == "list")) {
            // line 180
            echo "            <option value=\"list\" selected=\"selected\">";
            echo ($context["text_list"] ?? null);
            echo "</option>
            ";
        } else {
            // line 182
            echo "            <option value=\"list\">";
            echo ($context["text_list"] ?? null);
            echo "</option>
            ";
        }
        // line 184
        echo "             </select>
            </div>
          </div>
          
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 189
        echo ($context["entry_carousel"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 191
        if (($context["carousel"] ?? null)) {
            // line 192
            echo "            <label><input type=\"radio\" class=\"carousel_select\" name=\"carousel\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"carousel_select\" name=\"carousel\" value=\"1\" checked=\"checked\" /><span>";
            // line 193
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 195
            echo "            <label><input type=\"radio\" class=\"carousel_select\" name=\"carousel\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"carousel_select\" name=\"carousel\" value=\"1\" /><span>";
            // line 196
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 198
        echo "            </div>                   
            </div>
          
           <div class=\"form-group carousel_field\" style=\"display:";
        // line 201
        if (($context["carousel"] ?? null)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
            <label class=\"col-sm-2 control-label\" for=\"input-carousel\">";
        // line 202
        echo ($context["entry_rows"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"rows\" value=\"";
        // line 204
        echo ($context["rows"] ?? null);
        echo "\"  id=\"input-rows\" class=\"form-control\" />
            </div>
          </div>
          
          
          \t<div class=\"form-group carousel_field\" style=\"display:";
        // line 209
        if (($context["carousel"] ?? null)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
            <label class=\"col-sm-2 control-label\">";
        // line 210
        echo ($context["entry_carousel_a"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 212
        if (($context["carousel_a"] ?? null)) {
            // line 213
            echo "            <label><input type=\"radio\" name=\"carousel_a\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"carousel_a\" value=\"1\" checked=\"checked\" /><span>";
            // line 214
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 216
            echo "            <label><input type=\"radio\" name=\"carousel_a\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"carousel_a\" value=\"1\" /><span>";
            // line 217
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 219
        echo "            </div>                   
            </div>
          
            <div class=\"form-group carousel_field\" style=\"display:";
        // line 222
        if (($context["carousel"] ?? null)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
            <label class=\"col-sm-2 control-label\">";
        // line 223
        echo ($context["entry_carousel_b"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 225
        if (($context["carousel_b"] ?? null)) {
            // line 226
            echo "            <label><input type=\"radio\" name=\"carousel_b\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"carousel_b\" value=\"1\" checked=\"checked\" /><span>";
            // line 227
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 229
            echo "            <label><input type=\"radio\" name=\"carousel_b\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"carousel_b\" value=\"1\" /><span>";
            // line 230
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 232
        echo "            </div>                   
            </div>
          
          
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 237
        echo ($context["text_use_button"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 239
        if (($context["use_button"] ?? null)) {
            // line 240
            echo "            <label><input type=\"radio\" class=\"button_select\" name=\"use_button\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"button_select\" name=\"use_button\" value=\"1\" checked=\"checked\" /><span>";
            // line 241
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 243
            echo "            <label><input type=\"radio\" class=\"button_select\" name=\"use_button\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"button_select\" name=\"use_button\" value=\"1\" /><span>";
            // line 244
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 246
        echo "            </div>                   
            </div>
            
            <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 250
        echo ($context["text_use_margin"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 252
        if (($context["use_margin"] ?? null)) {
            // line 253
            echo "            <label><input type=\"radio\" class=\"margin_select\" name=\"use_margin\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"margin_select\" name=\"use_margin\" value=\"1\" checked=\"checked\" /><span>";
            // line 254
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 256
            echo "            <label><input type=\"radio\" class=\"margin_select\" name=\"use_margin\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"margin_select\" name=\"use_margin\" value=\"1\" /><span>";
            // line 257
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 259
        echo "            </div>                   
            </div>
          
          <div class=\"form-group margin_field\" style=\"display:";
        // line 262
        if (($context["use_margin"] ?? null)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
            <label class=\"col-sm-2 control-label\">";
        // line 263
        echo ($context["text_margin"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"margin\" value=\"";
        // line 265
        echo ($context["margin"] ?? null);
        echo "\" class=\"form-control\" />
            </div>
          </div>
                    
        </form>
      </div>
    </div>
  </div>
<script type=\"text/javascript\">
\$('.title_select').on('change', function() {
  \tif (\$(this).val() == '1') {
\t\t\$('.title_field').css('display', 'block');
\t} else {
\t\t\$('.title_field').css('display', 'none');
\t}
});
\$('.carousel_select').on('change', function() {
  \tif (\$(this).val() == '1') {
\t\t\$('.carousel_field').css('display', 'block');
\t} else {
\t\t\$('.carousel_field').css('display', 'none');
\t}
});
\$('.button_select').on('change', function() {
  \tif (\$(this).val() == '1') {
\t\t\$('.button_field').css('display', 'block');
\t} else {
\t\t\$('.button_field').css('display', 'none');
\t}
});
\$('.margin_select').on('change', function() {
  \tif (\$(this).val() == '1') {
\t\t\$('.margin_field').css('display', 'block');
\t} else {
\t\t\$('.margin_field').css('display', 'none');
\t}
});
\$('.thumb_select').on('change', function() {
  \tif (\$(this).val() == '1') {
\t\t\$('.thumb_field').css('display', 'block');
\t} else {
\t\t\$('.thumb_field').css('display', 'none');
\t}
});
</script>
<style>
.toggle-btn {
\tfont-size:0;
}
.toggle-btn label {
\tmargin-bottom:0px;
}
.toggle-btn input[type=\"radio\"] {
\tdisplay:none;
}
.toggle-btn span {
\tfont-size:12px;
\tbackground:#f5f5f5;
\tfont-weight:normal;
\tcursor:pointer;
\tpadding:8px 12px;
\tdisplay:inline-block;
\tbackground:#fafafa;
   color:#666666;
    -webkit-box-shadow: inset 0 1px 4px rgba(41, 41, 41, 0.15);
    -moz-box-shadow: inset 0 1px 4px 0 rgba(41, 41, 41, 0.15);
    box-shadow: inset 0 1px 4px rgba(41, 41, 41, 0.15);
\t-webkit-text-shadow:1px 1px 0 #ffffff;
\t-moz-text-shadow:1px 1px 0 #ffffff;
\ttext-shadow:1px 1px 0 #ffffff;
}
.toggle-btn label:first-child span {
\tborder-radius:3px 0 0 3px
}
.toggle-btn label:last-child span {
\tborder-radius:0 3px 3px 0;
}
.toggle-btn input[type=\"radio\"]:checked + span {
   background:#1e91cf;
   color:#ffffff;
    -webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.15);
    -moz-box-shadow: 0 1px 2px rgba(0,0,0,0.15);
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
\t-webkit-text-shadow:1px 1px 0 rgba(0, 0, 0, 0.3);
\t-moz-text-shadow:1px 1px 0 rgba(0, 0, 0, 0.3);
\ttext-shadow:1px 1px 0 rgba(0, 0, 0, 0.3);
}
.toggle-btn label:first-child input[type=\"radio\"]:checked + span {
   background:#9f9f9f;
}
.title_field, .carousel_field, .button_field, .margin_field, .thumb_field {
\tbackground:#fafafa;
}
</style>
</div>
";
        // line 360
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "extension/module/blog_latest.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  857 => 360,  759 => 265,  754 => 263,  746 => 262,  741 => 259,  736 => 257,  731 => 256,  726 => 254,  721 => 253,  719 => 252,  714 => 250,  708 => 246,  703 => 244,  698 => 243,  693 => 241,  688 => 240,  686 => 239,  681 => 237,  674 => 232,  669 => 230,  664 => 229,  659 => 227,  654 => 226,  652 => 225,  647 => 223,  639 => 222,  634 => 219,  629 => 217,  624 => 216,  619 => 214,  614 => 213,  612 => 212,  607 => 210,  599 => 209,  591 => 204,  586 => 202,  578 => 201,  573 => 198,  568 => 196,  563 => 195,  558 => 193,  553 => 192,  551 => 191,  546 => 189,  539 => 184,  533 => 182,  527 => 180,  524 => 179,  518 => 177,  512 => 175,  509 => 174,  503 => 172,  497 => 170,  494 => 169,  488 => 167,  482 => 165,  479 => 164,  473 => 162,  467 => 160,  465 => 159,  459 => 156,  448 => 150,  443 => 148,  434 => 142,  428 => 139,  423 => 137,  415 => 136,  409 => 132,  404 => 130,  399 => 129,  394 => 127,  389 => 126,  387 => 125,  382 => 123,  371 => 117,  364 => 115,  357 => 110,  346 => 107,  338 => 106,  335 => 105,  331 => 104,  326 => 102,  318 => 101,  313 => 98,  302 => 95,  294 => 94,  291 => 93,  287 => 92,  282 => 90,  274 => 89,  269 => 86,  258 => 83,  250 => 82,  247 => 81,  243 => 80,  238 => 78,  230 => 77,  225 => 74,  220 => 72,  215 => 71,  210 => 69,  205 => 68,  203 => 67,  198 => 65,  192 => 61,  187 => 59,  182 => 58,  177 => 56,  172 => 55,  170 => 54,  165 => 52,  159 => 48,  154 => 46,  149 => 45,  144 => 43,  139 => 42,  137 => 41,  132 => 39,  126 => 35,  120 => 33,  118 => 32,  112 => 31,  107 => 29,  102 => 27,  96 => 24,  92 => 22,  84 => 18,  82 => 17,  76 => 13,  65 => 11,  61 => 10,  56 => 8,  50 => 7,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/module/blog_latest.twig", "");
    }
}
