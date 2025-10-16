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

/* extension/module/basel_categories.twig */
class __TwigTemplate_0c06e95ec50f9eaee80df8c11f852da3b467e14d285158ab7c00c658ff2d0e09 extends \Twig\Template
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
        <button type=\"submit\" form=\"form-categories\" data-toggle=\"tooltip\" title=\"";
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
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-categories\" class=\"form-horizontal\">
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
            <label class=\"col-sm-2 control-label\">";
        // line 114
        echo ($context["entry_category"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"category\" value=\"\" id=\"input-category\" class=\"form-control\" />
              <div id=\"featured_categories-category\" class=\"well well-sm\" style=\"height: 150px; overflow: auto;\">
                ";
        // line 118
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 119
            echo "                <div id=\"featured_categories-category";
            echo twig_get_attribute($this->env, $this->source, $context["category"], "category_id", [], "any", false, false, false, 119);
            echo "\"><i class=\"fa fa-minus-circle\"></i> ";
            echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 119);
            echo "
                  <input type=\"hidden\" name=\"category[]\" value=\"";
            // line 120
            echo twig_get_attribute($this->env, $this->source, $context["category"], "category_id", [], "any", false, false, false, 120);
            echo "\" />
                </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 123
        echo "              </div>
            </div>
          </div>
    
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-image_width\">";
        // line 128
        echo ($context["entry_width"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"image_width\" value=\"";
        // line 130
        echo ($context["image_width"] ?? null);
        echo "\" id=\"input-image_width\" class=\"form-control\" />
            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-image_height\">";
        // line 134
        echo ($context["entry_height"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"image_height\" value=\"";
        // line 136
        echo ($context["image_height"] ?? null);
        echo "\" id=\"input-image_height\" class=\"form-control\" />
            </div>
          </div>
          
          

          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 143
        echo ($context["entry_subs"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 145
        if (($context["subs"] ?? null)) {
            // line 146
            echo "            <label><input type=\"radio\" class=\"subs_select\" name=\"subs\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"subs_select\" name=\"subs\" value=\"1\" checked=\"checked\" /><span>";
            // line 147
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 149
            echo "            <label><input type=\"radio\" class=\"subs_select\" name=\"subs\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"subs_select\" name=\"subs\" value=\"1\" /><span>";
            // line 150
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 152
        echo "            </div>                   
            </div>
          
           <div class=\"form-group subs_field\" style=\"display:";
        // line 155
        if (($context["subs"] ?? null)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
            <label class=\"col-sm-2 control-label\" for=\"input-limit\"><span data-toggle=\"tooltip\" title=\"";
        // line 156
        echo ($context["entry_limit_help"] ?? null);
        echo "\">";
        echo ($context["entry_limit"] ?? null);
        echo "</span></label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"limit\" value=\"";
        // line 158
        echo ($context["limit"] ?? null);
        echo "\"  id=\"input-limit\" class=\"form-control\" />
            </div>
\t\t\t</div>
          
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 163
        echo ($context["entry_count"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 165
        if (($context["count"] ?? null)) {
            // line 166
            echo "            <label><input type=\"radio\" name=\"count\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"count\" value=\"1\" checked=\"checked\" /><span>";
            // line 167
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 169
            echo "            <label><input type=\"radio\" name=\"count\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"count\" value=\"1\" /><span>";
            // line 170
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 172
        echo "            </div>                   
            </div>
          
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-columns\">";
        // line 176
        echo ($context["entry_columns"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <select name=\"columns\" id=\"input-columns\" class=\"form-control\">
               
                ";
        // line 180
        if ((($context["columns"] ?? null) == "6")) {
            // line 181
            echo "                <option value=\"6\" selected=\"selected\">";
            echo ($context["text_grid6"] ?? null);
            echo "</option>
                ";
        } else {
            // line 183
            echo "                <option value=\"6\">";
            echo ($context["text_grid6"] ?? null);
            echo "</option>
                ";
        }
        // line 185
        echo "                
                ";
        // line 186
        if ((($context["columns"] ?? null) == "5")) {
            // line 187
            echo "                <option value=\"5\" selected=\"selected\">";
            echo ($context["text_grid5"] ?? null);
            echo "</option>
                ";
        } else {
            // line 189
            echo "                <option value=\"5\">";
            echo ($context["text_grid5"] ?? null);
            echo "</option>
                ";
        }
        // line 191
        echo "                
                ";
        // line 192
        if ((($context["columns"] ?? null) == "4")) {
            // line 193
            echo "                <option value=\"4\" selected=\"selected\">";
            echo ($context["text_grid4"] ?? null);
            echo "</option>
                ";
        } else {
            // line 195
            echo "                <option value=\"4\">";
            echo ($context["text_grid4"] ?? null);
            echo "</option>
                ";
        }
        // line 197
        echo "                
                ";
        // line 198
        if ((($context["columns"] ?? null) == "3")) {
            // line 199
            echo "                <option value=\"3\" selected=\"selected\">";
            echo ($context["text_grid3"] ?? null);
            echo "</option>
                ";
        } else {
            // line 201
            echo "                <option value=\"3\">";
            echo ($context["text_grid3"] ?? null);
            echo "</option>
                ";
        }
        // line 203
        echo "                
                ";
        // line 204
        if ((($context["columns"] ?? null) == "2")) {
            // line 205
            echo "                <option value=\"2\" selected=\"selected\">";
            echo ($context["text_grid2"] ?? null);
            echo "</option>
                ";
        } else {
            // line 207
            echo "                <option value=\"2\">";
            echo ($context["text_grid2"] ?? null);
            echo "</option>
                ";
        }
        // line 209
        echo "                
                ";
        // line 210
        if ((($context["columns"] ?? null) == "1")) {
            // line 211
            echo "                <option value=\"1\" selected=\"selected\">";
            echo ($context["text_grid1"] ?? null);
            echo "</option>
                ";
        } else {
            // line 213
            echo "                <option value=\"1\">";
            echo ($context["text_grid1"] ?? null);
            echo "</option>
\t\t\t\t";
        }
        // line 215
        echo "                
              </select>
            </div>
          </div>
          
          
          \t<div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 222
        echo ($context["entry_carousel"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 224
        if (($context["carousel"] ?? null)) {
            // line 225
            echo "            <label><input type=\"radio\" class=\"carousel_select\" name=\"carousel\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"carousel_select\" name=\"carousel\" value=\"1\" checked=\"checked\" /><span>";
            // line 226
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 228
            echo "            <label><input type=\"radio\" class=\"carousel_select\" name=\"carousel\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"carousel_select\" name=\"carousel\" value=\"1\" /><span>";
            // line 229
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 231
        echo "            </div>                   
            </div>
          
           <div class=\"form-group carousel_field\" style=\"display:";
        // line 234
        if (($context["carousel"] ?? null)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
            <label class=\"col-sm-2 control-label\" for=\"input-carousel\">";
        // line 235
        echo ($context["entry_rows"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"rows\" value=\"";
        // line 237
        echo ($context["rows"] ?? null);
        echo "\"  id=\"input-rows\" class=\"form-control\" />
            </div>
          </div>
          
          \t<div class=\"form-group carousel_field\" style=\"display:";
        // line 241
        if (($context["carousel"] ?? null)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
            <label class=\"col-sm-2 control-label\">";
        // line 242
        echo ($context["entry_carousel_a"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 244
        if (($context["carousel_a"] ?? null)) {
            // line 245
            echo "            <label><input type=\"radio\" name=\"carousel_a\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"carousel_a\" value=\"1\" checked=\"checked\" /><span>";
            // line 246
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 248
            echo "            <label><input type=\"radio\" name=\"carousel_a\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"carousel_a\" value=\"1\" /><span>";
            // line 249
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 251
        echo "            </div>                   
            </div>
          
            <div class=\"form-group carousel_field\" style=\"display:";
        // line 254
        if (($context["carousel"] ?? null)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
            <label class=\"col-sm-2 control-label\">";
        // line 255
        echo ($context["entry_carousel_b"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 257
        if (($context["carousel_b"] ?? null)) {
            // line 258
            echo "            <label><input type=\"radio\" name=\"carousel_b\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"carousel_b\" value=\"1\" checked=\"checked\" /><span>";
            // line 259
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 261
            echo "            <label><input type=\"radio\" name=\"carousel_b\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"carousel_b\" value=\"1\" /><span>";
            // line 262
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 264
        echo "            </div>                   
            </div>

          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 268
        echo ($context["text_use_margin"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 270
        if (($context["use_margin"] ?? null)) {
            // line 271
            echo "            <label><input type=\"radio\" class=\"margin_select\" name=\"use_margin\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"margin_select\" name=\"use_margin\" value=\"1\" checked=\"checked\" /><span>";
            // line 272
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 274
            echo "            <label><input type=\"radio\" class=\"margin_select\" name=\"use_margin\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"margin_select\" name=\"use_margin\" value=\"1\" /><span>";
            // line 275
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 277
        echo "            </div>                   
            </div>
          
          <div class=\"form-group margin_field\" style=\"display:";
        // line 280
        if (($context["use_margin"] ?? null)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
            <label class=\"col-sm-2 control-label\">";
        // line 281
        echo ($context["text_margin"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"margin\" value=\"";
        // line 283
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
\$('.margin_select').on('change', function() {
  \tif (\$(this).val() == '1') {
\t\t\$('.margin_field').css('display', 'block');
\t} else {
\t\t\$('.margin_field').css('display', 'none');
\t}
});
\$('.subs_select').on('change', function() {
  \tif (\$(this).val() == '1') {
\t\t\$('.subs_field').css('display', 'block');
\t} else {
\t\t\$('.subs_field').css('display', 'none');
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
        // line 375
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
\t\t\$('#featured_categories-category' + item['value']).remove();
\t\t
\t\t\$('#featured_categories-category').append('<div id=\"featured_categories-category' + item['value'] + '\"><i class=\"fa fa-minus-circle\"></i> ' + item['label'] + '<input type=\"hidden\" name=\"category[]\" value=\"' + item['value'] + '\" /></div>');\t
\t}
});
\t
\$('#featured_categories-category').delegate('.fa-minus-circle', 'click', function() {
\t\$(this).parent().remove();
});
//--></script>
</div>
";
        // line 401
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "extension/module/basel_categories.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  929 => 401,  900 => 375,  805 => 283,  800 => 281,  792 => 280,  787 => 277,  782 => 275,  777 => 274,  772 => 272,  767 => 271,  765 => 270,  760 => 268,  754 => 264,  749 => 262,  744 => 261,  739 => 259,  734 => 258,  732 => 257,  727 => 255,  719 => 254,  714 => 251,  709 => 249,  704 => 248,  699 => 246,  694 => 245,  692 => 244,  687 => 242,  679 => 241,  672 => 237,  667 => 235,  659 => 234,  654 => 231,  649 => 229,  644 => 228,  639 => 226,  634 => 225,  632 => 224,  627 => 222,  618 => 215,  612 => 213,  606 => 211,  604 => 210,  601 => 209,  595 => 207,  589 => 205,  587 => 204,  584 => 203,  578 => 201,  572 => 199,  570 => 198,  567 => 197,  561 => 195,  555 => 193,  553 => 192,  550 => 191,  544 => 189,  538 => 187,  536 => 186,  533 => 185,  527 => 183,  521 => 181,  519 => 180,  512 => 176,  506 => 172,  501 => 170,  496 => 169,  491 => 167,  486 => 166,  484 => 165,  479 => 163,  471 => 158,  464 => 156,  456 => 155,  451 => 152,  446 => 150,  441 => 149,  436 => 147,  431 => 146,  429 => 145,  424 => 143,  414 => 136,  409 => 134,  402 => 130,  397 => 128,  390 => 123,  381 => 120,  374 => 119,  370 => 118,  363 => 114,  357 => 110,  346 => 107,  338 => 106,  335 => 105,  331 => 104,  326 => 102,  318 => 101,  313 => 98,  302 => 95,  294 => 94,  291 => 93,  287 => 92,  282 => 90,  274 => 89,  269 => 86,  258 => 83,  250 => 82,  247 => 81,  243 => 80,  238 => 78,  230 => 77,  225 => 74,  220 => 72,  215 => 71,  210 => 69,  205 => 68,  203 => 67,  198 => 65,  192 => 61,  187 => 59,  182 => 58,  177 => 56,  172 => 55,  170 => 54,  165 => 52,  159 => 48,  154 => 46,  149 => 45,  144 => 43,  139 => 42,  137 => 41,  132 => 39,  126 => 35,  120 => 33,  118 => 32,  112 => 31,  107 => 29,  102 => 27,  96 => 24,  92 => 22,  84 => 18,  82 => 17,  76 => 13,  65 => 11,  61 => 10,  56 => 8,  50 => 7,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/module/basel_categories.twig", "");
    }
}
