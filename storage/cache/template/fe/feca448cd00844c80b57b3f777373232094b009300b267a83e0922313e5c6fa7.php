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

/* extension/blog/blog_form.twig */
class __TwigTemplate_43be8c96a022fe4ecd051d897472405678d92df86dbc9592c22e80bad3642add extends \Twig\Template
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
        <button type=\"submit\" form=\"form-blog\" data-toggle=\"tooltip\" title=\"";
        // line 6
        echo ($context["button_save"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-save\"></i></button>
        <a href=\"";
        // line 7
        echo ($context["cancel"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_cancel"] ?? null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-reply\"></i></a>
\t  </div>
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
        // line 18
        if (($context["error_warning"] ?? null)) {
            echo " 
    <div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            // line 19
            echo ($context["error_warning"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 22
        echo " 
    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-pencil\"></i> ";
        // line 25
        echo ($context["heading_form"] ?? null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
        <form action=\"";
        // line 28
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-blog\" class=\"form-horizontal\">
          <ul class=\"nav nav-tabs\">
            <li class=\"active\"><a href=\"#tab-general\" data-toggle=\"tab\">";
        // line 30
        echo ($context["tab_general"] ?? null);
        echo "</a></li>
            <li><a href=\"#tab-data\" data-toggle=\"tab\">";
        // line 31
        echo ($context["tab_data"] ?? null);
        echo "</a></li>
\t\t\t<li><a href=\"#tab-seo\" data-toggle=\"tab\">";
        // line 32
        echo ($context["tab_seo"] ?? null);
        echo "</a></li>
            <li><a href=\"#tab-links\" data-toggle=\"tab\">";
        // line 33
        echo ($context["tab_links"] ?? null);
        echo "</a></li>
            <li><a href=\"#tab-design\" data-toggle=\"tab\">";
        // line 34
        echo ($context["tab_design"] ?? null);
        echo "</a></li>
          </ul>
          <div class=\"tab-content\">
            
            <div class=\"tab-pane active\" id=\"tab-general\">
            <ul class=\"nav nav-tabs\" id=\"language\">
                ";
        // line 40
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            echo " 
                <li><a href=\"#language";
            // line 41
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 41);
            echo "\" data-toggle=\"tab\"><img src=\"language/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 41);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 41);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 41);
            echo "\" />  ";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 41);
            echo "</a></li>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 42
        echo " 
              </ul>
              
              <div class=\"tab-content\">
                ";
        // line 46
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            echo " 
                <div class=\"tab-pane\" id=\"language";
            // line 47
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 47);
            echo "\">
                <!-- multilingual start -->
                
                <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
            // line 51
            echo ($context["entry_title"] ?? null);
            echo "</label>
                <div class=\"col-sm-10\">
                <input type=\"text\" name=\"blog_description[";
            // line 53
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 53);
            echo "][title]\" value=\"";
            echo (((($__internal_compile_0 = ($context["blog_description"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 53)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_1 = ($context["blog_description"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 53)] ?? null) : null), "title", [], "any", false, false, false, 53)) : (""));
            echo "\" placeholder=\"";
            echo ($context["entry_title"] ?? null);
            echo "\" class=\"form-control\" />
                ";
            // line 54
            if ((($__internal_compile_2 = ($context["error_title"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 54)] ?? null) : null)) {
                // line 55
                echo "                <span class=\"error\">";
                echo (($__internal_compile_3 = ($context["error_title"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 55)] ?? null) : null);
                echo "</span>
                ";
            }
            // line 56
            echo " 
                </div>
                </div>
                
                <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
            // line 61
            echo ($context["entry_page_title"] ?? null);
            echo "</label>
                <div class=\"col-sm-10\">
                <input name=\"blog_description[";
            // line 63
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 63);
            echo "][page_title]\" value=\"";
            echo (((($__internal_compile_4 = ($context["blog_description"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 63)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_5 = ($context["blog_description"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 63)] ?? null) : null), "page_title", [], "any", false, false, false, 63)) : (""));
            echo "\" placeholder=\"";
            echo ($context["entry_page_title"] ?? null);
            echo "\" type=\"text\"  class=\"form-control\" />
                </div>
                </div>
                
                <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
            // line 68
            echo ($context["entry_description"] ?? null);
            echo "</label>
                <div class=\"col-sm-10\">
                <textarea name=\"blog_description[";
            // line 70
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 70);
            echo "][description]\" data-toggle=\"summernote\" data-lang=\"";
            echo ($context["summernote"] ?? null);
            echo "\" id=\"description";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 70);
            echo "\" class=\"form-control\">";
            echo (((($__internal_compile_6 = ($context["blog_description"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 70)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_7 = ($context["blog_description"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 70)] ?? null) : null), "description", [], "any", false, false, false, 70)) : (""));
            echo "</textarea>
                </div>
                </div>
                
                <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
            // line 75
            echo ($context["entry_short_description_h"] ?? null);
            echo "\">";
            echo ($context["entry_short_description"] ?? null);
            echo "</span></label>
                <div class=\"col-sm-10\">
                <textarea name=\"blog_description[";
            // line 77
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 77);
            echo "][short_description]\" data-toggle=\"summernote\" data-lang=\"";
            echo ($context["summernote"] ?? null);
            echo "\" id=\"short_description";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 77);
            echo "\" class=\"form-control\">";
            echo (((($__internal_compile_8 = ($context["blog_description"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 77)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_9 = ($context["blog_description"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 77)] ?? null) : null), "short_description", [], "any", false, false, false, 77)) : (""));
            echo "</textarea>
                ";
            // line 78
            if ((($__internal_compile_10 = ($context["error_short_description"] ?? null)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 78)] ?? null) : null)) {
                echo " 
                <span class=\"error\">";
                // line 79
                echo (($__internal_compile_11 = ($context["error_short_description"] ?? null)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 79)] ?? null) : null);
                echo "</span>
                ";
            }
            // line 80
            echo " 
                </div>
                </div>
                
                <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
            // line 85
            echo ($context["entry_meta_description"] ?? null);
            echo "</label>
                <div class=\"col-sm-10\">
                <textarea name=\"blog_description[";
            // line 87
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 87);
            echo "][meta_description]\" class=\"form-control\">";
            echo (((($__internal_compile_12 = ($context["blog_description"] ?? null)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 87)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_13 = ($context["blog_description"] ?? null)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 87)] ?? null) : null), "meta_description", [], "any", false, false, false, 87)) : (""));
            echo "</textarea>
                </div>
                </div>
                
                <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
            // line 92
            echo ($context["entry_meta_keyword"] ?? null);
            echo "</label>
                <div class=\"col-sm-10\">
                <input name=\"blog_description[";
            // line 94
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 94);
            echo "][meta_keyword]\" class=\"form-control\" value=\"";
            echo (((($__internal_compile_14 = ($context["blog_description"] ?? null)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 94)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_15 = ($context["blog_description"] ?? null)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 94)] ?? null) : null), "meta_keyword", [], "any", false, false, false, 94)) : (""));
            echo "\" />
                </div>
                </div>
                
                <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
            // line 99
            echo ($context["entry_tags"] ?? null);
            echo "</label>
                <div class=\"col-sm-10\">
                <input name=\"blog_description[";
            // line 101
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 101);
            echo "][tags]\" class=\"form-control\" value=\"";
            echo (((($__internal_compile_16 = ($context["blog_description"] ?? null)) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 101)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_17 = ($context["blog_description"] ?? null)) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 101)] ?? null) : null), "tags", [], "any", false, false, false, 101)) : (""));
            echo "\" />
                </div>
                </div>
                
\t\t\t\t<!-- multilingual ends -->
                </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 108
        echo "              </div> <!-- language tab ends -->
            </div> <!-- tab-general ends -->
\t\t\t
            <div class=\"tab-pane\" id=\"tab-data\">
            ";
        // line 112
        if (($context["allow_author_change"] ?? null)) {
            echo " 
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
            // line 114
            echo ($context["entry_author"] ?? null);
            echo "</label>
                <div class=\"col-sm-10\">
                <input type=\"text\" name=\"author\" class=\"form-control\" value=\"";
            // line 116
            echo ($context["author"] ?? null);
            echo "\" />
              </div>
              </div>
              ";
        } else {
            // line 119
            echo "   
              <input type=\"hidden\" name=\"author\" class=\"form-control\" value=\"";
            // line 120
            echo ($context["author"] ?? null);
            echo "\" />
              ";
        }
        // line 122
        echo "             
             <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-image\">";
        // line 124
        echo ($context["entry_image"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <a href=\"\" id=\"thumb-image\" data-toggle=\"image\" class=\"img-thumbnail\"><img src=\"";
        // line 126
        echo ($context["thumb"] ?? null);
        echo "\" alt=\"\" title=\"\" data-placeholder=\"";
        echo ($context["placeholder"] ?? null);
        echo "\" /></a>
                  <input type=\"hidden\" name=\"image\" value=\"";
        // line 127
        echo ($context["image"] ?? null);
        echo "\" id=\"input-image\" />
                </div>
              </div>
              
            <div class=\"form-group\">
              <label class=\"col-sm-2 control-label\">";
        // line 132
        echo ($context["entry_allow_comment"] ?? null);
        echo "</label>
              <div class=\"col-sm-10\">
              <select name=\"allow_comment\" class=\"form-control\">
                ";
        // line 135
        if (($context["allow_comment"] ?? null)) {
            echo " 
                <option value=\"1\" selected=\"selected\">";
            // line 136
            echo ($context["text_yes"] ?? null);
            echo "</option>
                <option value=\"0\">";
            // line 137
            echo ($context["text_no"] ?? null);
            echo "</option>
                ";
        } else {
            // line 139
            echo "                <option value=\"1\">";
            echo ($context["text_yes"] ?? null);
            echo "</option>
                <option value=\"0\" selected=\"selected\">";
            // line 140
            echo ($context["text_no"] ?? null);
            echo "</option>
                ";
        }
        // line 142
        echo "              </select>
              </div>
              </div>
              
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
        // line 147
        echo ($context["entry_status"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                <select name=\"status\" class=\"form-control\">
                ";
        // line 150
        if (($context["status"] ?? null)) {
            echo " 
                <option value=\"1\" selected=\"selected\">";
            // line 151
            echo ($context["text_enabled"] ?? null);
            echo "</option>
                <option value=\"0\">";
            // line 152
            echo ($context["text_disabled"] ?? null);
            echo "</option>
                ";
        } else {
            // line 153
            echo "   
                <option value=\"1\">";
            // line 154
            echo ($context["text_enabled"] ?? null);
            echo "</option>
                <option value=\"0\" selected=\"selected\">";
            // line 155
            echo ($context["text_disabled"] ?? null);
            echo "</option>
                ";
        }
        // line 157
        echo "              </select>
              </div>
              </div>
              
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
        // line 162
        echo ($context["entry_sort_order"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                <input name=\"sort_order\" value=\"";
        // line 164
        echo ($context["sort_order"] ?? null);
        echo "\" class=\"form-control\" />
              </div>
              </div>
            </div> <!-- tab-data ends -->
            
            <div class=\"tab-pane\" id=\"tab-seo\">
            <div class=\"alert alert-info\"><i class=\"fa fa-info-circle\"></i> ";
        // line 170
        echo ($context["text_keyword"] ?? null);
        echo "</div>
              <div class=\"table-responsive\">
                <table class=\"table table-bordered table-hover\">
                  <thead>
                    <tr>
                      <td class=\"text-left\">";
        // line 175
        echo ($context["entry_store"] ?? null);
        echo "</td>
                      <td class=\"text-left\">";
        // line 176
        echo ($context["entry_keyword"] ?? null);
        echo "</td>
                    </tr>
                  </thead>
                  <tbody>
                  ";
        // line 180
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 181
            echo "                  <tr>
                    <td class=\"text-left\">";
            // line 182
            echo twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 182);
            echo "</td>
                    <td class=\"text-left\">";
            // line 183
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 184
                echo "                      <div class=\"input-group\"><span class=\"input-group-addon\"><img src=\"language/";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 184);
                echo "/";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 184);
                echo ".png\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 184);
                echo "\" /></span>
                        <input type=\"text\" name=\"blog_seo_url[";
                // line 185
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 185);
                echo "][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 185);
                echo "]\" value=\"";
                if ((($__internal_compile_18 = (($__internal_compile_19 = ($context["blog_seo_url"] ?? null)) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 185)] ?? null) : null)) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 185)] ?? null) : null)) {
                    echo (($__internal_compile_20 = (($__internal_compile_21 = ($context["blog_seo_url"] ?? null)) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 185)] ?? null) : null)) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 185)] ?? null) : null);
                }
                echo "\" placeholder=\"";
                echo ($context["entry_keyword"] ?? null);
                echo "\" class=\"form-control\" />
                      </div>
                      ";
                // line 187
                if ((($__internal_compile_22 = (($__internal_compile_23 = ($context["error_keyword"] ?? null)) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 187)] ?? null) : null)) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 187)] ?? null) : null)) {
                    // line 188
                    echo "                      <div class=\"text-danger\">";
                    echo (($__internal_compile_24 = (($__internal_compile_25 = ($context["error_keyword"] ?? null)) && is_array($__internal_compile_25) || $__internal_compile_25 instanceof ArrayAccess ? ($__internal_compile_25[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 188)] ?? null) : null)) && is_array($__internal_compile_24) || $__internal_compile_24 instanceof ArrayAccess ? ($__internal_compile_24[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 188)] ?? null) : null);
                    echo "</div>
                      ";
                }
                // line 189
                echo " 
                     ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 190
            echo "</td>
                  </tr>
                  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 193
        echo "                  </tbody>
                </table>
              </div>
\t\t\t</div> <!-- tab-seo ends -->
            
            <div class=\"tab-pane\" id=\"tab-links\">
\t\t\t
            <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 201
        echo ($context["entry_category"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
            <input type=\"text\" name=\"category\" value=\"\" placeholder=\"";
        // line 203
        echo ($context["entry_category"] ?? null);
        echo "\" id=\"input-category\" class=\"form-control\" />
            <div id=\"blog-category\" class=\"well well-sm\" style=\"height: 150px; overflow: auto;\">
            ";
        // line 205
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["blog_categories"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["blog_category"]) {
            echo " 
            ";
            // line 206
            if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["blog_category"], "blog_category_id", [], "any", false, false, false, 206), ($context["this_blog_category"] ?? null))) {
                // line 207
                echo "            <div id=\"blog-category";
                echo twig_get_attribute($this->env, $this->source, $context["blog_category"], "blog_category_id", [], "any", false, false, false, 207);
                echo "\"><i class=\"fa fa-minus-circle\"></i> ";
                echo twig_get_attribute($this->env, $this->source, $context["blog_category"], "name", [], "any", false, false, false, 207);
                echo "
            <input type=\"hidden\" name=\"this_blog_category[]\" value=\"";
                // line 208
                echo twig_get_attribute($this->env, $this->source, $context["blog_category"], "blog_category_id", [], "any", false, false, false, 208);
                echo "\" />
            </div>
            ";
            }
            // line 211
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['blog_category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 212
        echo "            </div>
            </div>
            </div>

            <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
        // line 217
        echo ($context["entry_related"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"related\" value=\"\" placeholder=\"";
        // line 219
        echo ($context["entry_related"] ?? null);
        echo "\" id=\"input-related\" class=\"form-control\" />
                  <div id=\"blog-related\" class=\"well well-sm\" style=\"height: 150px; overflow: auto;\"> 
                    ";
        // line 221
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["blogs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["blog"]) {
            // line 222
            echo "                    ";
            if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["blog"], "blog_id", [], "any", false, false, false, 222), ($context["related_blog"] ?? null))) {
                // line 223
                echo "                    <div id=\"blog-related";
                echo twig_get_attribute($this->env, $this->source, $context["blog"], "blog_id", [], "any", false, false, false, 223);
                echo "\"><i class=\"fa fa-minus-circle\"></i> ";
                echo twig_get_attribute($this->env, $this->source, $context["blog"], "title", [], "any", false, false, false, 223);
                echo "
                    <input type=\"hidden\" name=\"related_blog[]\" value=\"";
                // line 224
                echo twig_get_attribute($this->env, $this->source, $context["blog"], "blog_id", [], "any", false, false, false, 224);
                echo "\" />
                    </div>
                    ";
            }
            // line 227
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['blog'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 228
        echo "                 </div>
               </div>
            </div>
            
            <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 233
        echo ($context["entry_related_products"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
            <input type=\"text\" name=\"related-products\" value=\"\" placeholder=\"";
        // line 235
        echo ($context["entry_related_products"] ?? null);
        echo "\" id=\"input-related-products\" class=\"form-control\" />
            <div id=\"product-related\" class=\"well well-sm\" style=\"height: 150px; overflow: auto;\">
            ";
        // line 237
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["product_relateds"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["product_related"]) {
            echo " 
            <div id=\"product-related";
            // line 238
            echo twig_get_attribute($this->env, $this->source, $context["product_related"], "product_id", [], "any", false, false, false, 238);
            echo "\"><i class=\"fa fa-minus-circle\"></i> ";
            echo twig_get_attribute($this->env, $this->source, $context["product_related"], "name", [], "any", false, false, false, 238);
            echo "
            <input type=\"hidden\" name=\"product_related[]\" value=\"";
            // line 239
            echo twig_get_attribute($this->env, $this->source, $context["product_related"], "product_id", [], "any", false, false, false, 239);
            echo "\" />
            </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product_related'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 241
        echo " 
            </div>
            </div>
            </div>
              
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
        // line 247
        echo ($context["entry_store"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
\t\t\t\t<div class=\"well well-sm\" style=\"height: 150px; overflow: auto;\"> 
\t\t\t\t  ";
        // line 250
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 251
            echo "                    <div class=\"checkbox\">
                      <label> 
                      \t";
            // line 253
            if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 253), ($context["blog_store"] ?? null))) {
                // line 254
                echo "                        <input type=\"checkbox\" name=\"blog_store[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 254);
                echo "\" checked=\"checked\" />";
                echo twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 254);
                echo "
                        ";
            } else {
                // line 256
                echo "                        <input type=\"checkbox\" name=\"blog_store[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 256);
                echo "\" />";
                echo twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 256);
                echo "
                        ";
            }
            // line 258
            echo "\t\t\t\t\t </label>
                    </div>
                  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 261
        echo "\t\t\t\t</div>
                </div>
              </div>
              
            </div> <!-- tab-links ends -->
            
            <div class=\"tab-pane\" id=\"tab-design\">
            <div class=\"table-responsive\">
                <table class=\"table table-bordered table-hover\">
                  <thead>
                    <tr>
                      <td class=\"text-left\">";
        // line 272
        echo ($context["entry_store"] ?? null);
        echo "</td>
                      <td class=\"text-left\">";
        // line 273
        echo ($context["entry_layout"] ?? null);
        echo "</td>
                    </tr>
                  </thead>
                  <tbody>
\t\t\t\t  ";
        // line 277
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 278
            echo "                  <tr>
                    <td class=\"text-left\">";
            // line 279
            echo twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 279);
            echo "</td>
                    <td class=\"text-left\"><select name=\"blog_layout[";
            // line 280
            echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 280);
            echo "]\" class=\"form-control\">
                        <option value=\"\"></option>
                        ";
            // line 282
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["layouts"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["layout"]) {
                // line 283
                echo "                            ";
                if (((($__internal_compile_26 = ($context["blog_layout"] ?? null)) && is_array($__internal_compile_26) || $__internal_compile_26 instanceof ArrayAccess ? ($__internal_compile_26[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 283)] ?? null) : null) && ((($__internal_compile_27 = ($context["blog_layout"] ?? null)) && is_array($__internal_compile_27) || $__internal_compile_27 instanceof ArrayAccess ? ($__internal_compile_27[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 283)] ?? null) : null) == twig_get_attribute($this->env, $this->source, $context["layout"], "layout_id", [], "any", false, false, false, 283)))) {
                    // line 284
                    echo "                            <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["layout"], "layout_id", [], "any", false, false, false, 284);
                    echo "\" selected=\"selected\">";
                    echo twig_get_attribute($this->env, $this->source, $context["layout"], "name", [], "any", false, false, false, 284);
                    echo "</option>
                            ";
                } else {
                    // line 286
                    echo "                            <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["layout"], "layout_id", [], "any", false, false, false, 286);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["layout"], "name", [], "any", false, false, false, 286);
                    echo "</option>
                            ";
                }
                // line 288
                echo "                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['layout'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 289
            echo "                      </select></td>
                  </tr>
                  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 292
        echo "                  </tbody>
                </table>
            </div>
          \t</div> <!-- tab-design ends -->
        </div>
      </form>
    </div>
  </div>
<script type=\"text/javascript\"><!--
// Category
\$('input[name=\\'category\\']').autocomplete({
\t'source': function(request, response) {
\t\t\$.ajax({
\t\t\turl: 'index.php?route=extension/blog/blog_category/autocomplete&user_token=";
        // line 305
        echo ($context["token"] ?? null);
        echo "&filter_name=' +  encodeURIComponent(request),
\t\t\tdataType: 'json',\t\t\t
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
\t'select': function(item) {
\t\t\$('input[name=\\'category\\']').val('');
\t\t
\t\t\$('#blog-category' + item['value']).remove();
\t\t
\t\t\$('#blog-category').append('<div id=\"blog-category' + item['value'] + '\"><i class=\"fa fa-minus-circle\"></i> ' + item['label'] + '<input type=\"hidden\" name=\"this_blog_category[]\" value=\"' + item['value'] + '\" /></div>');\t
\t}
});

\$('#blog-category').delegate('.fa-minus-circle', 'click', function() {
\t\$(this).parent().remove();
});

//Related blog posts
\$('input[name=\\'related\\']').autocomplete({
\t'source': function(request, response) {
\t\t\$.ajax({
\t\t\turl: 'index.php?route=extension/blog/blog/autocomplete&user_token=";
        // line 334
        echo ($context["token"] ?? null);
        echo "&filter_name=' +  encodeURIComponent(request),
\t\t\tdataType: 'json',\t\t\t
\t\t\tsuccess: function(json) {
\t\t\t\tresponse(\$.map(json, function(item) {
\t\t\t\t\treturn {
\t\t\t\t\t\tlabel: item['title'],
\t\t\t\t\t\tvalue: item['blog_id']
\t\t\t\t\t}
\t\t\t\t}));
\t\t\t}
\t\t});
\t},
\t'select': function(item) {
\t\t\$('input[name=\\'related\\']').val('');
\t\t
\t\t\$('#blog-related' + item['value']).remove();
\t\t
\t\t\$('#blog-related').append('<div id=\"blog-related' + item['value'] + '\"><i class=\"fa fa-minus-circle\"></i> ' + item['label'] + '<input type=\"hidden\" name=\"related_blog[]\" value=\"' + item['value'] + '\" /></div>');
\t}
});

\$('#blog-related').delegate('.fa-minus-circle', 'click', function() {
\t\$(this).parent().remove();
});


// Related products
// Related
\$('input[name=\\'related-products\\']').autocomplete({
\t'source': function(request, response) {
\t\t\$.ajax({
\t\t\turl: 'index.php?route=catalog/product/autocomplete&user_token=";
        // line 365
        echo ($context["token"] ?? null);
        echo "&filter_name=' +  encodeURIComponent(request),
\t\t\tdataType: 'json',
\t\t\tsuccess: function(json) {
\t\t\t\tresponse(\$.map(json, function(item) {
\t\t\t\t\treturn {
\t\t\t\t\t\tlabel: item['name'],
\t\t\t\t\t\tvalue: item['product_id']
\t\t\t\t\t}
\t\t\t\t}));
\t\t\t}
\t\t});
\t},
\t'select': function(item) {
\t\t\$('input[name=\\'related-products\\']').val('');

\t\t\$('#product-related' + item['value']).remove();

\t\t\$('#product-related').append('<div id=\"product-related' + item['value'] + '\"><i class=\"fa fa-minus-circle\"></i> ' + item['label'] + '<input type=\"hidden\" name=\"product_related[]\" value=\"' + item['value'] + '\" /></div>');
\t}
});

\$('#product-related').delegate('.fa-minus-circle', 'click', function() {
\t\$(this).parent().remove();
});
//--></script>
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
//--></script></div>
</div>
";
        // line 403
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "extension/blog/blog_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  921 => 403,  880 => 365,  846 => 334,  814 => 305,  799 => 292,  791 => 289,  785 => 288,  777 => 286,  769 => 284,  766 => 283,  762 => 282,  757 => 280,  753 => 279,  750 => 278,  746 => 277,  739 => 273,  735 => 272,  722 => 261,  714 => 258,  706 => 256,  698 => 254,  696 => 253,  692 => 251,  688 => 250,  682 => 247,  674 => 241,  665 => 239,  659 => 238,  653 => 237,  648 => 235,  643 => 233,  636 => 228,  630 => 227,  624 => 224,  617 => 223,  614 => 222,  610 => 221,  605 => 219,  600 => 217,  593 => 212,  587 => 211,  581 => 208,  574 => 207,  572 => 206,  566 => 205,  561 => 203,  556 => 201,  546 => 193,  538 => 190,  531 => 189,  525 => 188,  523 => 187,  510 => 185,  501 => 184,  497 => 183,  493 => 182,  490 => 181,  486 => 180,  479 => 176,  475 => 175,  467 => 170,  458 => 164,  453 => 162,  446 => 157,  441 => 155,  437 => 154,  434 => 153,  429 => 152,  425 => 151,  421 => 150,  415 => 147,  408 => 142,  403 => 140,  398 => 139,  393 => 137,  389 => 136,  385 => 135,  379 => 132,  371 => 127,  365 => 126,  360 => 124,  356 => 122,  351 => 120,  348 => 119,  341 => 116,  336 => 114,  331 => 112,  325 => 108,  310 => 101,  305 => 99,  295 => 94,  290 => 92,  280 => 87,  275 => 85,  268 => 80,  263 => 79,  259 => 78,  249 => 77,  242 => 75,  228 => 70,  223 => 68,  211 => 63,  206 => 61,  199 => 56,  193 => 55,  191 => 54,  183 => 53,  178 => 51,  171 => 47,  165 => 46,  159 => 42,  143 => 41,  137 => 40,  128 => 34,  124 => 33,  120 => 32,  116 => 31,  112 => 30,  107 => 28,  101 => 25,  96 => 22,  89 => 19,  85 => 18,  78 => 13,  68 => 12,  62 => 11,  57 => 9,  50 => 7,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/blog/blog_form.twig", "");
    }
}
