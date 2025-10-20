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

/* extension/blog/blog_setting.twig */
class __TwigTemplate_b34798c29d87a1cea345e2db4b6b10dbd026c723e0ffe508f087a28dfa8b828f extends \Twig\Template
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
        <button type=\"submit\" form=\"form-settings\" data-toggle=\"tooltip\" title=\"";
        // line 7
        echo ($context["button_save"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-save\"></i></button>
        </div>
      <h1>";
        // line 9
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      <ul class=\"breadcrumb\">
        ";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            echo " 
        <li><a href=\"";
            // line 12
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 12);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 12);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo " 
      </ul>
    </div>
  </div>
  <div class=\"container-fluid\">
      
    ";
        // line 19
        if (($context["error_warning"] ?? null)) {
            echo " 
    <div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            // line 20
            echo ($context["error_warning"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 23
        echo " 
    ";
        // line 24
        if (($context["success"] ?? null)) {
            echo " 
    <div class=\"alert alert-success\"><i class=\"fa fa-check-circle\"></i> ";
            // line 25
            echo ($context["success"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 28
        echo " 
    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-pencil\"></i> ";
        // line 31
        echo ($context["heading_title"] ?? null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
      
      <form action=\"";
        // line 35
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-settings\" class=\"form-horizontal\">

        <div class=\"row\">
        <div class=\"col-sm-2\"></div>
        <div class=\"col-sm-10\"><legend><h3 style=\"margin-top:20px;\">";
        // line 39
        echo ($context["heading_blog_home"] ?? null);
        echo "</h3></legend></div>
        </div>
        
        <div class=\"row\">
        <div class=\"col-sm-2\"></div>
        <div class=\"col-sm-10\">
        <ul class=\"nav nav-tabs\" id=\"language\">
        ";
        // line 46
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            echo " 
        <li><a href=\"#language";
            // line 47
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 47);
            echo "\" data-toggle=\"tab\"><img src=\"language/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 47);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 47);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 47);
            echo "\" /> </a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 49
        echo "        </ul>
        </div>
        </div>
        
        <div class=\"tab-content\">
\t\t";
        // line 54
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            echo " 
        <div class=\"tab-pane\" id=\"language";
            // line 55
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 55);
            echo "\">
        <!-- Multilingual start -->
        
        <div class=\"form-group\">
        <label class=\"col-sm-2 control-label\">";
            // line 59
            echo ($context["entry_blogsetting_home_title"] ?? null);
            echo "</label>
        <div class=\"col-sm-10\">
         <input type=\"text\" class=\"form-control\" value=\"";
            // line 61
            echo (($__internal_compile_0 = ($context["blogsetting_home_title"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 61)] ?? null) : null);
            echo "\" name=\"blogsetting_home_title[";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 61);
            echo "]\" />
        </div>
        </div>
        
        <div class=\"form-group\">
        <label class=\"col-sm-2 control-label\">";
            // line 66
            echo ($context["entry_blogsetting_home_page_title"] ?? null);
            echo "</label>
        <div class=\"col-sm-10\">
         <input type=\"text\" class=\"form-control\" value=\"";
            // line 68
            echo (($__internal_compile_1 = ($context["blogsetting_home_page_title"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 68)] ?? null) : null);
            echo "\" name=\"blogsetting_home_page_title[";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 68);
            echo "]\" />
        </div>
        </div>
        
        <div class=\"form-group\">
        <label class=\"col-sm-2 control-label\">";
            // line 73
            echo ($context["entry_blogsetting_home_description"] ?? null);
            echo "</label>
        <div class=\"col-sm-10\">         
         <textarea name=\"blogsetting_home_description[";
            // line 75
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 75);
            echo "]\" id=\"block";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 75);
            echo "\" data-toggle=\"summernote\" class=\"form-control summernote\">";
            echo (((($__internal_compile_2 = ($context["blogsetting_home_description"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 75)] ?? null) : null)) ? ((($__internal_compile_3 = ($context["blogsetting_home_description"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 75)] ?? null) : null)) : (""));
            echo "</textarea>
        </div>
        </div>
        
        <div class=\"form-group\">
        <label class=\"col-sm-2 control-label\">";
            // line 80
            echo ($context["entry_blogsetting_home_meta_description"] ?? null);
            echo "</label>
        <div class=\"col-sm-10\">         
         <textarea name=\"blogsetting_home_meta_description[";
            // line 82
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 82);
            echo "]\" id=\"block";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 82);
            echo "\" class=\"form-control\">";
            echo (((($__internal_compile_4 = ($context["blogsetting_home_meta_description"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 82)] ?? null) : null)) ? ((($__internal_compile_5 = ($context["blogsetting_home_meta_description"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 82)] ?? null) : null)) : (""));
            echo "</textarea>
        </div>
        </div>
        
        <div class=\"form-group\">
        <label class=\"col-sm-2 control-label\">";
            // line 87
            echo ($context["entry_blogsetting_home_meta_keyword"] ?? null);
            echo "</label>
        <div class=\"col-sm-10\">
         <input type=\"text\" class=\"form-control\" value=\"";
            // line 89
            echo (($__internal_compile_6 = ($context["blogsetting_home_meta_keyword"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 89)] ?? null) : null);
            echo "\" name=\"blogsetting_home_meta_keyword[";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 89);
            echo "]\" />
        </div>
        </div>

        <!-- multilingual ends -->
        </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 96
        echo "\t\t
\t\t <div class=\"form-group\">
        <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 98
        echo ($context["entry_blogsetting_home_url_h"] ?? null);
        echo "\">";
        echo ($context["entry_keyword"] ?? null);
        echo "</span></label>
        <div class=\"col-sm-10\">
        
              <div class=\"table-responsive\">
                <table class=\"table table-bordered table-hover\">
                  <thead>
                    <tr>
                      <td class=\"text-left\">";
        // line 105
        echo ($context["entry_store"] ?? null);
        echo "</td>
                      <td class=\"text-left\">";
        // line 106
        echo ($context["entry_keyword"] ?? null);
        echo "</td>
                    </tr>
                  </thead>
                  <tbody>
                  ";
        // line 110
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 111
            echo "                  <tr>
                    <td class=\"text-left\">";
            // line 112
            echo twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 112);
            echo "</td>
                    <td class=\"text-left\">";
            // line 113
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 114
                echo "                      <div class=\"input-group\"><span class=\"input-group-addon\"><img src=\"language/";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 114);
                echo "/";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 114);
                echo ".png\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 114);
                echo "\" /></span>
                        <input type=\"text\" name=\"blog_home_seo_url[";
                // line 115
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 115);
                echo "][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 115);
                echo "]\" value=\"";
                if ((($__internal_compile_7 = (($__internal_compile_8 = ($context["blog_home_seo_url"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 115)] ?? null) : null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 115)] ?? null) : null)) {
                    echo (($__internal_compile_9 = (($__internal_compile_10 = ($context["blog_home_seo_url"] ?? null)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 115)] ?? null) : null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 115)] ?? null) : null);
                }
                echo "\" placeholder=\"";
                echo ($context["entry_keyword"] ?? null);
                echo "\" class=\"form-control\" />
                      </div> 
                     ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 117
            echo "</td>
                  </tr>
                  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 120
        echo "                  </tbody>
                </table>
\t\t\t\t<div class=\"alert alert-info\"><i class=\"fa fa-info-circle\"></i> ";
        // line 122
        echo ($context["text_keyword"] ?? null);
        echo "</div>
              </div>
        </div>
        </div>
\t\t
\t\t 
        
        
        <div class=\"row\">
        <div class=\"col-sm-2\"></div>
        <div class=\"col-sm-10\"><legend><h3 style=\"margin-top:20px;\">";
        // line 132
        echo ($context["heading_blog_listing"] ?? null);
        echo "</h3></legend>
        ";
        // line 133
        echo ($context["heading_blog_listing_h"] ?? null);
        echo "<br /><br />

        </div>
\t\t
        </div>
       
        <div class=\"form-group required\">
        <label class=\"col-sm-2 control-label\">";
        // line 140
        echo ($context["entry_blogsetting_blogs_per_page"] ?? null);
        echo "</label>
        <div class=\"col-sm-10\">
        <input name=\"blogsetting_blogs_per_page\" class=\"form-control\" value=\"";
        // line 142
        echo ($context["blogsetting_blogs_per_page"] ?? null);
        echo "\" />
        </div>
        </div>
        
        <div class=\"form-group\">
        <label class=\"col-sm-2 control-label\">";
        // line 147
        echo ($context["entry_blogsetting_layout"] ?? null);
        echo "</label>
        <div class=\"col-sm-10\">
        <select name=\"blogsetting_layout\" class=\"form-control\">
\t\t";
        // line 150
        if ((($context["blogsetting_layout"] ?? null) == "1")) {
            echo " 
\t\t<option value=\"1\" selected=\"selected\">1</option>
        ";
        } else {
            // line 152
            echo "   
\t\t<option value=\"1\">1</option>
\t\t";
        }
        // line 155
        echo "        
        ";
        // line 156
        if ((($context["blogsetting_layout"] ?? null) == "2")) {
            echo " 
\t\t<option value=\"2\" selected=\"selected\">2</option>
        ";
        } else {
            // line 158
            echo "   
\t\t<option value=\"2\">2</option>
\t\t";
        }
        // line 160
        echo " 
        
        ";
        // line 162
        if ((($context["blogsetting_layout"] ?? null) == "3")) {
            echo " 
\t\t<option value=\"3\" selected=\"selected\">3</option>
        ";
        } else {
            // line 164
            echo "   
\t\t<option value=\"3\">3</option>
\t\t";
        }
        // line 167
        echo "        
        ";
        // line 168
        if ((($context["blogsetting_layout"] ?? null) == "4")) {
            echo " 
\t\t<option value=\"4\" selected=\"selected\">4</option>
        ";
        } else {
            // line 170
            echo "   
\t\t<option value=\"4\">4</option>
\t\t";
        }
        // line 173
        echo "\t\t</select>
        </div>
        </div>
        
        <div class=\"form-group required\">
        <label class=\"col-sm-2 control-label\">";
        // line 178
        echo ($context["entry_blogsetting_thumb_size"] ?? null);
        echo "</label>
        <div class=\"col-sm-5\">
        <input name=\"blogsetting_thumbs_w\" class=\"form-control\" value=\"";
        // line 180
        echo ($context["blogsetting_thumbs_w"] ?? null);
        echo "\" />
        </div>
        <div class=\"col-sm-5\">
        <input name=\"blogsetting_thumbs_h\" class=\"form-control\" value=\"";
        // line 183
        echo ($context["blogsetting_thumbs_h"] ?? null);
        echo "\" />
        </div>
        </div>
        
        <div class=\"form-group\">
        <label class=\"col-sm-2 control-label\">";
        // line 188
        echo ($context["entry_blogsetting_date_added"] ?? null);
        echo "</label>
        <div class=\"col-sm-10\">
        <select name=\"blogsetting_date_added\" class=\"form-control\">
\t\t";
        // line 191
        if (($context["blogsetting_date_added"] ?? null)) {
            echo " 
\t\t<option value=\"1\" selected=\"selected\">";
            // line 192
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\">";
            // line 193
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        } else {
            // line 194
            echo "   
        <option value=\"1\">";
            // line 195
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\" selected=\"selected\">";
            // line 196
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        }
        // line 198
        echo "\t\t</select>
        </div>
        </div>
        
        <div class=\"form-group\">
        <label class=\"col-sm-2 control-label\">";
        // line 203
        echo ($context["entry_blogsetting_comments_count"] ?? null);
        echo "</label>
        <div class=\"col-sm-10\">
        <select name=\"blogsetting_comments_count\" class=\"form-control\">
\t\t";
        // line 206
        if (($context["blogsetting_comments_count"] ?? null)) {
            echo " 
\t\t<option value=\"1\" selected=\"selected\">";
            // line 207
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\">";
            // line 208
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        } else {
            // line 209
            echo "   
        <option value=\"1\">";
            // line 210
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\" selected=\"selected\">";
            // line 211
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        }
        // line 213
        echo "        
\t\t</select>
        </div>
        </div>
        
        <div class=\"form-group\">
        <label class=\"col-sm-2 control-label\">";
        // line 219
        echo ($context["entry_blogsetting_page_view"] ?? null);
        echo "</label>
        <div class=\"col-sm-10\">
        <select name=\"blogsetting_page_view\" class=\"form-control\">
\t\t";
        // line 222
        if (($context["blogsetting_page_view"] ?? null)) {
            echo " 
\t\t<option value=\"1\" selected=\"selected\">";
            // line 223
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\">";
            // line 224
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        } else {
            // line 225
            echo "   
        <option value=\"1\">";
            // line 226
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\" selected=\"selected\">";
            // line 227
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        }
        // line 228
        echo " 
\t\t</select>
        </div>
        </div>
        
        <div class=\"form-group\">
        <label class=\"col-sm-2 control-label\">";
        // line 234
        echo ($context["entry_blogsetting_author"] ?? null);
        echo "</label>
        <div class=\"col-sm-10\">
        <select name=\"blogsetting_author\" class=\"form-control\">
\t\t";
        // line 237
        if (($context["blogsetting_author"] ?? null)) {
            echo " 
\t\t<option value=\"1\" selected=\"selected\">";
            // line 238
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\">";
            // line 239
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        } else {
            // line 240
            echo "   
        <option value=\"1\">";
            // line 241
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\" selected=\"selected\">";
            // line 242
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        }
        // line 243
        echo " 
\t\t</select>
        </div>
        </div>
        
        
        
        <div class=\"row\">
        <div class=\"col-sm-2\"></div>
        <div class=\"col-sm-10\"><legend><h3 style=\"margin-top:20px;\">";
        // line 252
        echo ($context["heading_blog_post"] ?? null);
        echo "</h3></legend></div>
        </div>
        
        <div class=\"form-group\">
        <label class=\"col-sm-2 control-label\">";
        // line 256
        echo ($context["entry_blogsetting_post_date_added"] ?? null);
        echo "</label>
        <div class=\"col-sm-10\">
        <select name=\"blogsetting_post_date_added\" class=\"form-control\">
\t\t";
        // line 259
        if (($context["blogsetting_post_date_added"] ?? null)) {
            echo " 
\t\t<option value=\"1\" selected=\"selected\">";
            // line 260
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\">";
            // line 261
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        } else {
            // line 262
            echo "   
        <option value=\"1\">";
            // line 263
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\" selected=\"selected\">";
            // line 264
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        }
        // line 265
        echo " 
\t\t</select>
        </div>
        </div>
        
        <div class=\"form-group\">
        <label class=\"col-sm-2 control-label\">";
        // line 271
        echo ($context["entry_blogsetting_post_comments_count"] ?? null);
        echo "</label>
        <div class=\"col-sm-10\">
        <select name=\"blogsetting_post_comments_count\" class=\"form-control\">
\t\t";
        // line 274
        if (($context["blogsetting_post_comments_count"] ?? null)) {
            echo " 
\t\t<option value=\"1\" selected=\"selected\">";
            // line 275
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\">";
            // line 276
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        } else {
            // line 277
            echo "   
        <option value=\"1\">";
            // line 278
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\" selected=\"selected\">";
            // line 279
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        }
        // line 280
        echo " 
\t\t</select>
        </div>
        </div>
        
        <div class=\"form-group\">
        <label class=\"col-sm-2 control-label\">";
        // line 286
        echo ($context["entry_blogsetting_post_page_view"] ?? null);
        echo "</label>
        <div class=\"col-sm-10\">
        <select name=\"blogsetting_post_page_view\" class=\"form-control\">
\t\t";
        // line 289
        if (($context["blogsetting_post_page_view"] ?? null)) {
            echo " 
\t\t<option value=\"1\" selected=\"selected\">";
            // line 290
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\">";
            // line 291
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        } else {
            // line 292
            echo "   
        <option value=\"1\">";
            // line 293
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\" selected=\"selected\">";
            // line 294
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        }
        // line 295
        echo " 
\t\t</select>
        </div>
        </div>
        
        <div class=\"form-group\">
        <label class=\"col-sm-2 control-label\">";
        // line 301
        echo ($context["entry_blogsetting_post_author"] ?? null);
        echo "</label>
        <div class=\"col-sm-10\">
        <select name=\"blogsetting_post_author\" class=\"form-control\">
\t\t";
        // line 304
        if (($context["blogsetting_post_author"] ?? null)) {
            echo " 
\t\t<option value=\"1\" selected=\"selected\">";
            // line 305
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\">";
            // line 306
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        } else {
            // line 307
            echo "   
        <option value=\"1\">";
            // line 308
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\" selected=\"selected\">";
            // line 309
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        }
        // line 310
        echo " 
\t\t</select>
        </div>
        </div>
        
        <div class=\"form-group\">
        <label class=\"col-sm-2 control-label\">";
        // line 316
        echo ($context["entry_blogsetting_share"] ?? null);
        echo "</label>
        <div class=\"col-sm-10\">
        <select name=\"blogsetting_share\" class=\"form-control\">
\t\t";
        // line 319
        if (($context["blogsetting_share"] ?? null)) {
            echo " 
\t\t<option value=\"1\" selected=\"selected\">";
            // line 320
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\">";
            // line 321
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        } else {
            // line 322
            echo "   
        <option value=\"1\">";
            // line 323
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\" selected=\"selected\">";
            // line 324
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        }
        // line 325
        echo " 
\t\t</select>
        </div>
        </div>
        
        <div class=\"form-group\">
        <label class=\"col-sm-2 control-label\">";
        // line 331
        echo ($context["entry_blogsetting_post_thumb"] ?? null);
        echo "</label>
        <div class=\"col-sm-10\">
        <select name=\"blogsetting_post_thumb\" class=\"form-control\">
\t\t";
        // line 334
        if (($context["blogsetting_post_thumb"] ?? null)) {
            echo " 
\t\t<option value=\"1\" selected=\"selected\">";
            // line 335
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\">";
            // line 336
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        } else {
            // line 337
            echo "   
        <option value=\"1\">";
            // line 338
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\" selected=\"selected\">";
            // line 339
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        }
        // line 340
        echo " 
\t\t</select>
        </div>
        </div>
        
        <div class=\"form-group required\">
        <label class=\"col-sm-2 control-label\">";
        // line 346
        echo ($context["entry_blogsetting_thumb_size"] ?? null);
        echo "</label>
        <div class=\"col-sm-5\">
        <input name=\"blogsetting_post_thumbs_w\" class=\"form-control\" value=\"";
        // line 348
        echo ($context["blogsetting_post_thumbs_w"] ?? null);
        echo "\" />
        </div>
        <div class=\"col-sm-5\">
        <input name=\"blogsetting_post_thumbs_h\" class=\"form-control\" value=\"";
        // line 351
        echo ($context["blogsetting_post_thumbs_h"] ?? null);
        echo "\" />
        </div>
        </div>
        
        
\t\t
        <div class=\"row\">
        <div class=\"col-sm-2\"></div>
        <div class=\"col-sm-10\"><legend><h4 style=\"margin-top:20px;\">";
        // line 359
        echo ($context["heading_related"] ?? null);
        echo "</h4></legend></div>
        </div>
\t\t
        <div class=\"form-group\">
        <label class=\"col-sm-2 control-label\">";
        // line 363
        echo ($context["entry_blogsetting_rel_blog_per_row"] ?? null);
        echo "</label>
        <div class=\"col-sm-10\">        
        <select name=\"blogsetting_rel_blog_per_row\" class=\"form-control\">
\t\t";
        // line 366
        if ((($context["blogsetting_rel_blog_per_row"] ?? null) == "1")) {
            echo " 
\t\t<option value=\"1\" selected=\"selected\">1</option>
        ";
        } else {
            // line 368
            echo "   
\t\t<option value=\"1\">1</option>
\t\t";
        }
        // line 370
        echo " 
        
        ";
        // line 372
        if ((($context["blogsetting_rel_blog_per_row"] ?? null) == "2")) {
            echo " 
\t\t<option value=\"2\" selected=\"selected\">2</option>
        ";
        } else {
            // line 374
            echo "   
\t\t<option value=\"2\">2</option>
\t\t";
        }
        // line 376
        echo " 
        
        ";
        // line 378
        if ((($context["blogsetting_rel_blog_per_row"] ?? null) == "3")) {
            echo " 
\t\t<option value=\"3\" selected=\"selected\">3</option>
        ";
        } else {
            // line 380
            echo "   
\t\t<option value=\"3\">3</option>
\t\t";
        }
        // line 382
        echo " 
\t\t</select>
        </div>
        </div>
        
        <div class=\"form-group\">
        <label class=\"col-sm-2 control-label\">";
        // line 388
        echo ($context["entry_blogsetting_rel_thumb"] ?? null);
        echo "</label>
        <div class=\"col-sm-10\">
        <select name=\"blogsetting_rel_thumb\" class=\"form-control\">
\t\t";
        // line 391
        if (($context["blogsetting_rel_thumb"] ?? null)) {
            echo " 
\t\t<option value=\"1\" selected=\"selected\">";
            // line 392
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\">";
            // line 393
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        } else {
            // line 394
            echo "   
        <option value=\"1\">";
            // line 395
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\" selected=\"selected\">";
            // line 396
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        }
        // line 397
        echo " 
\t\t</select>
        </div>
        </div>
        
        <div class=\"form-group required\">
        <label class=\"col-sm-2 control-label\">";
        // line 403
        echo ($context["entry_blogsetting_rel_thumbs"] ?? null);
        echo "</label>
        <div class=\"col-sm-5\">
        <input name=\"blogsetting_rel_thumbs_w\" class=\"form-control\" value=\"";
        // line 405
        echo ($context["blogsetting_rel_thumbs_w"] ?? null);
        echo "\" />
        </div>
        <div class=\"col-sm-5\">
        <input name=\"blogsetting_rel_thumbs_h\" class=\"form-control\" value=\"";
        // line 408
        echo ($context["blogsetting_rel_thumbs_h"] ?? null);
        echo "\" />
        </div>
        </div>
        
        <div class=\"form-group required\">
        <label class=\"col-sm-2 control-label\">";
        // line 413
        echo ($context["entry_blogsetting_rel_characters"] ?? null);
        echo "</label>
        <div class=\"col-sm-10\">         
        <input name=\"blogsetting_rel_characters\" class=\"form-control\" value=\"";
        // line 415
        echo ($context["blogsetting_rel_characters"] ?? null);
        echo "\" />
        </div>
        </div>
        
        
        
        
        <div class=\"row\">
        <div class=\"col-sm-2\"></div>
        <div class=\"col-sm-10\"><legend><h4 style=\"margin-top:20px;\">";
        // line 424
        echo ($context["heading_related_products"] ?? null);
        echo "</h4></legend></div>
        </div>
        
        
\t\t
        <div class=\"form-group\">
        <label class=\"col-sm-2 control-label\">";
        // line 430
        echo ($context["entry_blogsetting_rel_prod_per_row"] ?? null);
        echo "</label>
        <div class=\"col-sm-10\">        
        <select name=\"blogsetting_rel_prod_per_row\" class=\"form-control\">
        ";
        // line 433
        if ((($context["blogsetting_rel_prod_per_row"] ?? null) == "2")) {
            echo " 
\t\t<option value=\"2\" selected=\"selected\">2</option>
        ";
        } else {
            // line 435
            echo "   
\t\t<option value=\"2\">2</option>
\t\t";
        }
        // line 437
        echo " 
        
        ";
        // line 439
        if ((($context["blogsetting_rel_prod_per_row"] ?? null) == "3")) {
            echo " 
\t\t<option value=\"3\" selected=\"selected\">3</option>
        ";
        } else {
            // line 441
            echo "   
\t\t<option value=\"3\">3</option>
\t\t";
        }
        // line 444
        echo "        
        ";
        // line 445
        if ((($context["blogsetting_rel_prod_per_row"] ?? null) == "4")) {
            echo " 
\t\t<option value=\"4\" selected=\"selected\">4</option>
        ";
        } else {
            // line 447
            echo "   
\t\t<option value=\"4\">4</option>
\t\t";
        }
        // line 449
        echo " 
\t\t</select>
        </div>
        </div>
        
        <div class=\"form-group required\">
        <label class=\"col-sm-2 control-label\">";
        // line 455
        echo ($context["entry_blogsetting_rel_prod_thumbs_size"] ?? null);
        echo "</label>
        <div class=\"col-sm-5\">
        <input name=\"blogsetting_rel_prod_width\" class=\"form-control\" value=\"";
        // line 457
        echo ($context["blogsetting_rel_prod_width"] ?? null);
        echo "\" />
        </div>
        <div class=\"col-sm-5\">
        <input name=\"blogsetting_rel_prod_height\" class=\"form-control\" value=\"";
        // line 460
        echo ($context["blogsetting_rel_prod_height"] ?? null);
        echo "\" />
        </div>
        </div>

     \t<div class=\"row\">
        <div class=\"col-sm-2\"></div>
        <div class=\"col-sm-10\"><legend><h3 style=\"margin-top:20px;\">";
        // line 466
        echo ($context["heading_comments"] ?? null);
        echo "</h3></legend></div>
        </div>
 
 \t\t<div class=\"form-group required\">
        <label class=\"col-sm-2 control-label\">";
        // line 470
        echo ($context["entry_blogsetting_comment_per_page"] ?? null);
        echo "</label>
        <div class=\"col-sm-10\"> 
        <input name=\"blogsetting_comment_per_page\" class=\"form-control\" value=\"";
        // line 472
        echo ($context["blogsetting_comment_per_page"] ?? null);
        echo "\" />        
        </div>
        </div>

\t\t<div class=\"form-group\">
        <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 477
        echo ($context["entry_blogsetting_comment_approve_h"] ?? null);
        echo "\">";
        echo ($context["entry_blogsetting_comment_approve"] ?? null);
        echo "</span></label>
        <div class=\"col-sm-10\">
        <select name=\"blogsetting_comment_approve\" class=\"form-control\">
\t\t";
        // line 480
        if (($context["blogsetting_comment_approve"] ?? null)) {
            echo " 
\t\t<option value=\"1\" selected=\"selected\">";
            // line 481
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\">";
            // line 482
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        } else {
            // line 483
            echo "   
        <option value=\"1\">";
            // line 484
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\" selected=\"selected\">";
            // line 485
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        }
        // line 486
        echo " 
\t\t</select>
        </div>
        </div>
        
        <div class=\"form-group\">
        <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 492
        echo ($context["entry_blogsetting_comment_notification_h"] ?? null);
        echo "\">";
        echo ($context["entry_blogsetting_comment_notification"] ?? null);
        echo "</span></label>
        <div class=\"col-sm-10\">
        <select name=\"blogsetting_comment_notification\" class=\"form-control\">
\t\t";
        // line 495
        if (($context["blogsetting_comment_notification"] ?? null)) {
            echo " 
\t\t<option value=\"1\" selected=\"selected\">";
            // line 496
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\">";
            // line 497
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        } else {
            // line 498
            echo "   
        <option value=\"1\">";
            // line 499
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\" selected=\"selected\">";
            // line 500
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        }
        // line 501
        echo " 
\t\t</select>
        </div>
        </div>
        
        
        
        
        <div class=\"row\">
        <div class=\"col-sm-2\"></div>
        <div class=\"col-sm-10\"><legend><h3 style=\"margin-top:20px;\">";
        // line 511
        echo ($context["heading_author"] ?? null);
        echo "</h3></legend></div>
        </div>
        
        <div class=\"form-group\">
        <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 515
        echo ($context["entry_blogsetting_author_change_h"] ?? null);
        echo "\">";
        echo ($context["entry_blogsetting_author_change"] ?? null);
        echo "</span></label>
        <div class=\"col-sm-10\">
        <select name=\"blogsetting_author_change\" class=\"form-control\">
\t\t";
        // line 518
        if (($context["blogsetting_author_change"] ?? null)) {
            echo " 
\t\t<option value=\"1\" selected=\"selected\">";
            // line 519
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\">";
            // line 520
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        } else {
            // line 521
            echo "   
        <option value=\"1\">";
            // line 522
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t<option value=\"0\" selected=\"selected\">";
            // line 523
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t";
        }
        // line 524
        echo " 
\t\t</select>
        </div>
        </div>

    </form>
      </div>
    </div>
  </div>
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

<script type=\"text/javascript\"><!--
\$('#language a:first').tab('show');
//--></script>
";
        // line 548
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "extension/blog/blog_setting.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1278 => 548,  1252 => 524,  1247 => 523,  1243 => 522,  1240 => 521,  1235 => 520,  1231 => 519,  1227 => 518,  1219 => 515,  1212 => 511,  1200 => 501,  1195 => 500,  1191 => 499,  1188 => 498,  1183 => 497,  1179 => 496,  1175 => 495,  1167 => 492,  1159 => 486,  1154 => 485,  1150 => 484,  1147 => 483,  1142 => 482,  1138 => 481,  1134 => 480,  1126 => 477,  1118 => 472,  1113 => 470,  1106 => 466,  1097 => 460,  1091 => 457,  1086 => 455,  1078 => 449,  1073 => 447,  1067 => 445,  1064 => 444,  1059 => 441,  1053 => 439,  1049 => 437,  1044 => 435,  1038 => 433,  1032 => 430,  1023 => 424,  1011 => 415,  1006 => 413,  998 => 408,  992 => 405,  987 => 403,  979 => 397,  974 => 396,  970 => 395,  967 => 394,  962 => 393,  958 => 392,  954 => 391,  948 => 388,  940 => 382,  935 => 380,  929 => 378,  925 => 376,  920 => 374,  914 => 372,  910 => 370,  905 => 368,  899 => 366,  893 => 363,  886 => 359,  875 => 351,  869 => 348,  864 => 346,  856 => 340,  851 => 339,  847 => 338,  844 => 337,  839 => 336,  835 => 335,  831 => 334,  825 => 331,  817 => 325,  812 => 324,  808 => 323,  805 => 322,  800 => 321,  796 => 320,  792 => 319,  786 => 316,  778 => 310,  773 => 309,  769 => 308,  766 => 307,  761 => 306,  757 => 305,  753 => 304,  747 => 301,  739 => 295,  734 => 294,  730 => 293,  727 => 292,  722 => 291,  718 => 290,  714 => 289,  708 => 286,  700 => 280,  695 => 279,  691 => 278,  688 => 277,  683 => 276,  679 => 275,  675 => 274,  669 => 271,  661 => 265,  656 => 264,  652 => 263,  649 => 262,  644 => 261,  640 => 260,  636 => 259,  630 => 256,  623 => 252,  612 => 243,  607 => 242,  603 => 241,  600 => 240,  595 => 239,  591 => 238,  587 => 237,  581 => 234,  573 => 228,  568 => 227,  564 => 226,  561 => 225,  556 => 224,  552 => 223,  548 => 222,  542 => 219,  534 => 213,  529 => 211,  525 => 210,  522 => 209,  517 => 208,  513 => 207,  509 => 206,  503 => 203,  496 => 198,  491 => 196,  487 => 195,  484 => 194,  479 => 193,  475 => 192,  471 => 191,  465 => 188,  457 => 183,  451 => 180,  446 => 178,  439 => 173,  434 => 170,  428 => 168,  425 => 167,  420 => 164,  414 => 162,  410 => 160,  405 => 158,  399 => 156,  396 => 155,  391 => 152,  385 => 150,  379 => 147,  371 => 142,  366 => 140,  356 => 133,  352 => 132,  339 => 122,  335 => 120,  327 => 117,  310 => 115,  301 => 114,  297 => 113,  293 => 112,  290 => 111,  286 => 110,  279 => 106,  275 => 105,  263 => 98,  259 => 96,  244 => 89,  239 => 87,  227 => 82,  222 => 80,  210 => 75,  205 => 73,  195 => 68,  190 => 66,  180 => 61,  175 => 59,  168 => 55,  162 => 54,  155 => 49,  141 => 47,  135 => 46,  125 => 39,  118 => 35,  111 => 31,  106 => 28,  99 => 25,  95 => 24,  92 => 23,  85 => 20,  81 => 19,  73 => 13,  63 => 12,  57 => 11,  52 => 9,  47 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/blog/blog_setting.twig", "");
    }
}
