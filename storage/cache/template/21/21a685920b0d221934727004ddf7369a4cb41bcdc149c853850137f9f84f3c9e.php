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

/* extension/module/basel_carousel.twig */
class __TwigTemplate_9c5d49cac5bb9f8b5feca209dddafaafe0f484cc6d4741412a9a4efa2749a368 extends \Twig\Template
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
        <button type=\"submit\" form=\"form-carousel\" data-toggle=\"tooltip\" title=\"";
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
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-carousel\" class=\"form-horizontal\">
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
          
         \t<div class=\"form-group\">
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
            <label class=\"col-sm-2 control-label\" for=\"input-banner\">";
        // line 114
        echo ($context["entry_banner"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <select name=\"banner_id\" id=\"input-banner\" class=\"form-control\">
                ";
        // line 117
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["banners"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["banner"]) {
            // line 118
            echo "                ";
            if ((twig_get_attribute($this->env, $this->source, $context["banner"], "banner_id", [], "any", false, false, false, 118) == ($context["banner_id"] ?? null))) {
                // line 119
                echo "                <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["banner"], "banner_id", [], "any", false, false, false, 119);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["banner"], "name", [], "any", false, false, false, 119);
                echo "</option>
                ";
            } else {
                // line 121
                echo "                <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["banner"], "banner_id", [], "any", false, false, false, 121);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["banner"], "name", [], "any", false, false, false, 121);
                echo "</option>
                ";
            }
            // line 123
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['banner'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 124
        echo "              </select>
            </div>
          </div>
            
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-image_width\">";
        // line 129
        echo ($context["entry_width"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"image_width\" value=\"";
        // line 131
        echo ($context["image_width"] ?? null);
        echo "\" id=\"input-image_width\" class=\"form-control\" />
            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-image_height\">";
        // line 135
        echo ($context["entry_height"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"image_height\" value=\"";
        // line 137
        echo ($context["image_height"] ?? null);
        echo "\" id=\"input-image_height\" class=\"form-control\" />
            </div>
          </div>
          
          

          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-columns\">";
        // line 144
        echo ($context["entry_columns"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <select name=\"columns\" id=\"input-columns\" class=\"form-control\">
               
                ";
        // line 148
        if ((($context["columns"] ?? null) == "6")) {
            // line 149
            echo "                <option value=\"6\" selected=\"selected\">";
            echo ($context["text_grid6"] ?? null);
            echo "</option>
                ";
        } else {
            // line 151
            echo "                <option value=\"6\">";
            echo ($context["text_grid6"] ?? null);
            echo "</option>
                ";
        }
        // line 153
        echo "                
                ";
        // line 154
        if ((($context["columns"] ?? null) == "5")) {
            // line 155
            echo "                <option value=\"5\" selected=\"selected\">";
            echo ($context["text_grid5"] ?? null);
            echo "</option>
                ";
        } else {
            // line 157
            echo "                <option value=\"5\">";
            echo ($context["text_grid5"] ?? null);
            echo "</option>
                ";
        }
        // line 159
        echo "                
                ";
        // line 160
        if ((($context["columns"] ?? null) == "4")) {
            // line 161
            echo "                <option value=\"4\" selected=\"selected\">";
            echo ($context["text_grid4"] ?? null);
            echo "</option>
                ";
        } else {
            // line 163
            echo "                <option value=\"4\">";
            echo ($context["text_grid4"] ?? null);
            echo "</option>
                ";
        }
        // line 165
        echo "                
                ";
        // line 166
        if ((($context["columns"] ?? null) == "3")) {
            // line 167
            echo "                <option value=\"3\" selected=\"selected\">";
            echo ($context["text_grid3"] ?? null);
            echo "</option>
                ";
        } else {
            // line 169
            echo "                <option value=\"3\">";
            echo ($context["text_grid3"] ?? null);
            echo "</option>
                ";
        }
        // line 171
        echo "                
                ";
        // line 172
        if ((($context["columns"] ?? null) == "2")) {
            // line 173
            echo "                <option value=\"2\" selected=\"selected\">";
            echo ($context["text_grid2"] ?? null);
            echo "</option>
                ";
        } else {
            // line 175
            echo "                <option value=\"2\">";
            echo ($context["text_grid2"] ?? null);
            echo "</option>
                ";
        }
        // line 177
        echo "                
                ";
        // line 178
        if ((($context["columns"] ?? null) == "1")) {
            // line 179
            echo "                <option value=\"1\" selected=\"selected\">";
            echo ($context["text_grid1"] ?? null);
            echo "</option>
                ";
        } else {
            // line 181
            echo "                <option value=\"1\">";
            echo ($context["text_grid1"] ?? null);
            echo "</option>
\t\t\t\t";
        }
        // line 183
        echo "                
              </select>
            </div>
          </div>
          
          \t
          
           <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-carousel\">";
        // line 191
        echo ($context["entry_rows"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"rows\" value=\"";
        // line 193
        echo ($context["rows"] ?? null);
        echo "\"  id=\"input-rows\" class=\"form-control\" />
            </div>
          </div>
          
          \t<div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 198
        echo ($context["entry_carousel_a"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 200
        if (($context["carousel_a"] ?? null)) {
            // line 201
            echo "            <label><input type=\"radio\" name=\"carousel_a\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"carousel_a\" value=\"1\" checked=\"checked\" /><span>";
            // line 202
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 204
            echo "            <label><input type=\"radio\" name=\"carousel_a\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"carousel_a\" value=\"1\" /><span>";
            // line 205
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 207
        echo "            </div>                   
            </div>
          
            <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 211
        echo ($context["entry_carousel_b"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 213
        if (($context["carousel_b"] ?? null)) {
            // line 214
            echo "            <label><input type=\"radio\" name=\"carousel_b\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"carousel_b\" value=\"1\" checked=\"checked\" /><span>";
            // line 215
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 217
            echo "            <label><input type=\"radio\" name=\"carousel_b\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"carousel_b\" value=\"1\" /><span>";
            // line 218
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 220
        echo "            </div>                   
            </div>
\t\t\t
\t\t\t<div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 224
        echo ($context["entry_autoplay"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"autoplay\" value=\"";
        // line 226
        echo ($context["autoplay"] ?? null);
        echo "\" class=\"form-control\" />
            </div>
          </div>

          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 231
        echo ($context["text_use_margin"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 233
        if (($context["use_margin"] ?? null)) {
            // line 234
            echo "            <label><input type=\"radio\" class=\"margin_select\" name=\"use_margin\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"margin_select\" name=\"use_margin\" value=\"1\" checked=\"checked\" /><span>";
            // line 235
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 237
            echo "            <label><input type=\"radio\" class=\"margin_select\" name=\"use_margin\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"margin_select\" name=\"use_margin\" value=\"1\" /><span>";
            // line 238
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 240
        echo "            </div>                   
            </div>
          
          <div class=\"form-group margin_field\" style=\"display:";
        // line 243
        if (($context["use_margin"] ?? null)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
            <label class=\"col-sm-2 control-label\">";
        // line 244
        echo ($context["text_margin"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"margin\" value=\"";
        // line 246
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
\$('.margin_select').on('change', function() {
  \tif (\$(this).val() == '1') {
\t\t\$('.margin_field').css('display', 'block');
\t} else {
\t\t\$('.margin_field').css('display', 'none');
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
.title_field, .carousel_field, .button_field, .margin_field, .subs_field {
\tbackground:#fafafa;
}
</style>
<script type=\"text/javascript\"><!--
\$('input[name=\\'category\\']').autocomplete({
\tsource: function(request, response) {
\t\t\$.ajax({
\t\t\turl: 'index.php?route=catalog/category/autocomplete&user_token=";
        // line 324
        echo ($context["token"] ?? null);
        echo "&filter_name=' +  encodeURIComponent(request),
\t\t\tdataType: 'json',
\t\t\tsuccess: function(json) {
\t\t\t\tresponse(\$.map(json, function(item) {
\t\t\t\t\treturn {
\t\t\t\t\t\tlabel: item['name'],
\t\t\t\t\t\tvalue: item['category_id']
\t\t\t\t\t}
\t\t\t\t}));
\t\t\t}
\t\t});
\t},
\tselect: function(item) {
\t\t\$('input[name=\\'category\\']').val('');
\t\t
\t\t\$('#featured_carousel-category' + item['value']).remove();
\t\t
\t\t\$('#featured_carousel-category').append('<div id=\"featured_carousel-category' + item['value'] + '\"><i class=\"fa fa-minus-circle\"></i> ' + item['label'] + '<input type=\"hidden\" name=\"category[]\" value=\"' + item['value'] + '\" /></div>');\t
\t}
});
\t
\$('#featured_carousel-category').delegate('.fa-minus-circle', 'click', function() {
\t\$(this).parent().remove();
});
//--></script>
</div>
";
        // line 350
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "extension/module/basel_carousel.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  795 => 350,  766 => 324,  685 => 246,  680 => 244,  672 => 243,  667 => 240,  662 => 238,  657 => 237,  652 => 235,  647 => 234,  645 => 233,  640 => 231,  632 => 226,  627 => 224,  621 => 220,  616 => 218,  611 => 217,  606 => 215,  601 => 214,  599 => 213,  594 => 211,  588 => 207,  583 => 205,  578 => 204,  573 => 202,  568 => 201,  566 => 200,  561 => 198,  553 => 193,  548 => 191,  538 => 183,  532 => 181,  526 => 179,  524 => 178,  521 => 177,  515 => 175,  509 => 173,  507 => 172,  504 => 171,  498 => 169,  492 => 167,  490 => 166,  487 => 165,  481 => 163,  475 => 161,  473 => 160,  470 => 159,  464 => 157,  458 => 155,  456 => 154,  453 => 153,  447 => 151,  441 => 149,  439 => 148,  432 => 144,  422 => 137,  417 => 135,  410 => 131,  405 => 129,  398 => 124,  392 => 123,  384 => 121,  376 => 119,  373 => 118,  369 => 117,  363 => 114,  357 => 110,  346 => 107,  338 => 106,  335 => 105,  331 => 104,  326 => 102,  318 => 101,  313 => 98,  302 => 95,  294 => 94,  291 => 93,  287 => 92,  282 => 90,  274 => 89,  269 => 86,  258 => 83,  250 => 82,  247 => 81,  243 => 80,  238 => 78,  230 => 77,  225 => 74,  220 => 72,  215 => 71,  210 => 69,  205 => 68,  203 => 67,  198 => 65,  192 => 61,  187 => 59,  182 => 58,  177 => 56,  172 => 55,  170 => 54,  165 => 52,  159 => 48,  154 => 46,  149 => 45,  144 => 43,  139 => 42,  137 => 41,  132 => 39,  126 => 35,  120 => 33,  118 => 32,  112 => 31,  107 => 29,  102 => 27,  96 => 24,  92 => 22,  84 => 18,  82 => 17,  76 => 13,  65 => 11,  61 => 10,  56 => 8,  50 => 7,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/module/basel_carousel.twig", "");
    }
}
