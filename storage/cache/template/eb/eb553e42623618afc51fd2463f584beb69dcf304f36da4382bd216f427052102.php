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

/* catalog/category_form.twig */
class __TwigTemplate_2c6657b2591a0dfc4713ed53add23f4699968ce25585a8f21db3572275dc4618 extends \Twig\Template
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
        <button type=\"submit\" form=\"form-category\" data-toggle=\"tooltip\" title=\"";
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
            echo "    <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
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
        echo ($context["text_form"] ?? null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
        <form action=\"";
        // line 27
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-category\" class=\"form-horizontal\">
          <ul class=\"nav nav-tabs\">
            <li class=\"active\"><a href=\"#tab-general\" data-toggle=\"tab\">";
        // line 29
        echo ($context["tab_general"] ?? null);
        echo "</a></li>
            <li><a href=\"#tab-data\" data-toggle=\"tab\">";
        // line 30
        echo ($context["tab_data"] ?? null);
        echo "</a></li>
            <li><a href=\"#tab-seo\" data-toggle=\"tab\">";
        // line 31
        echo ($context["tab_seo"] ?? null);
        echo "</a></li>
            <li><a href=\"#tab-design\" data-toggle=\"tab\">";
        // line 32
        echo ($context["tab_design"] ?? null);
        echo "</a></li>
          </ul>
          <div class=\"tab-content\">
            <div class=\"tab-pane active\" id=\"tab-general\">
              <ul class=\"nav nav-tabs\" id=\"language\">
                ";
        // line 37
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 38
            echo "                <li><a href=\"#language";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 38);
            echo "\" data-toggle=\"tab\"><img src=\"language/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 38);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 38);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 38);
            echo "\" /> ";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 38);
            echo "</a></li>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 40
        echo "              </ul>
              <div class=\"tab-content\">
                ";
        // line 42
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 43
            echo "                <div class=\"tab-pane\" id=\"language";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 43);
            echo "\">
                  <div class=\"form-group required\">
                    <label class=\"col-sm-2 control-label\" for=\"input-name";
            // line 45
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 45);
            echo "\">";
            echo ($context["entry_name"] ?? null);
            echo "</label>
                    <div class=\"col-sm-10\">
                      <input type=\"text\" name=\"category_description[";
            // line 47
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 47);
            echo "][name]\" value=\"";
            echo (((($__internal_compile_0 = ($context["category_description"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 47)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_1 = ($context["category_description"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 47)] ?? null) : null), "name", [], "any", false, false, false, 47)) : (""));
            echo "\" placeholder=\"";
            echo ($context["entry_name"] ?? null);
            echo "\" id=\"input-name";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 47);
            echo "\" class=\"form-control\" />
                      ";
            // line 48
            if ((($__internal_compile_2 = ($context["error_name"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 48)] ?? null) : null)) {
                // line 49
                echo "                      <div class=\"text-danger\">";
                echo (($__internal_compile_3 = ($context["error_name"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 49)] ?? null) : null);
                echo "</div>
                      ";
            }
            // line 51
            echo "                    </div>
                  </div>
                



                  <div class=\"form-group\">
                    <label class=\"col-sm-2 control-label\" for=\"input-description";
            // line 58
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 58);
            echo "\">";
            echo ($context["entry_description"] ?? null);
            echo "</label>
                    <div class=\"col-sm-10\">
                      <textarea name=\"category_description[";
            // line 60
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 60);
            echo "][description]\" placeholder=\"";
            echo ($context["entry_description"] ?? null);
            echo "\" id=\"input-description";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 60);
            echo "\" data-toggle=\"summernote\" data-lang=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "locale", [], "any", false, false, false, 60);
            echo "\" class=\"form-control\">";
            echo (((($__internal_compile_4 = ($context["category_description"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 60)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_5 = ($context["category_description"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 60)] ?? null) : null), "description", [], "any", false, false, false, 60)) : (""));
            echo "</textarea>
                    </div>
                  </div>
   
    <div class=\"form-group\">
      <label class=\"col-sm-2 control-label\" for=\"input-description";
            // line 65
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 65);
            echo "\">";
            echo ($context["entry_short_description"] ?? null);
            echo "</label>
      <div class=\"col-sm-10\">
        <textarea name=\"category_description[";
            // line 67
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 67);
            echo "][short_description]\" placeholder=\"";
            echo ($context["entry_short_description"] ?? null);
            echo "\" id=\"input-description";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 67);
            echo "\" data-toggle=\"summernote\" data-lang=\"";
            echo ($context["summernote"] ?? null);
            echo "\" class=\"form-control\">";
            echo (((($__internal_compile_6 = ($context["category_description"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 67)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_7 = ($context["category_description"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 67)] ?? null) : null), "short_description", [], "any", false, false, false, 67)) : (""));
            echo "</textarea>
      </div>
    </div>
    
                  <div class=\"form-group required\">
                    <label class=\"col-sm-2 control-label\" for=\"input-meta-title";
            // line 72
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 72);
            echo "\">";
            echo ($context["entry_meta_title"] ?? null);
            echo "</label>
                    <div class=\"col-sm-10\">
                      <input type=\"text\" name=\"category_description[";
            // line 74
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 74);
            echo "][meta_title]\" value=\"";
            echo (((($__internal_compile_8 = ($context["category_description"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 74)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_9 = ($context["category_description"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 74)] ?? null) : null), "meta_title", [], "any", false, false, false, 74)) : (""));
            echo "\" placeholder=\"";
            echo ($context["entry_meta_title"] ?? null);
            echo "\" id=\"input-meta-title";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 74);
            echo "\" class=\"form-control\" />
                      ";
            // line 75
            if ((($__internal_compile_10 = ($context["error_meta_title"] ?? null)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 75)] ?? null) : null)) {
                // line 76
                echo "                      <div class=\"text-danger\">";
                echo (($__internal_compile_11 = ($context["error_meta_title"] ?? null)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 76)] ?? null) : null);
                echo "</div>
                      ";
            }
            // line 78
            echo "                    </div>
                  </div>
                  <div class=\"form-group\">

\t\t\t    <label class=\"col-sm-2 control-label\">";
            // line 82
            echo ($context["text_h1"] ?? null);
            echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"category_description[";
            // line 84
            echo (($__internal_compile_12 = $context["language"]) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["language_id"] ?? null) : null);
            echo "][h1]\" value=\"";
            echo ((twig_get_attribute($this->env, $this->source, ($context["category_description"] ?? null), (($__internal_compile_13 = $context["language"]) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["language_id"] ?? null) : null), [], "array", true, true, false, 84)) ? ((($__internal_compile_14 = (($__internal_compile_15 = ($context["category_description"] ?? null)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15[(($__internal_compile_16 = $context["language"]) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16["language_id"] ?? null) : null)] ?? null) : null)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["h1"] ?? null) : null)) : (""));
            echo "\"  class=\"form-control\" />
                </div>
            </div>
\t\t\t  
\t\t\t<div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
            // line 89
            echo ($context["text_h2"] ?? null);
            echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"category_description[";
            // line 91
            echo (($__internal_compile_17 = $context["language"]) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["language_id"] ?? null) : null);
            echo "][h2]\" value=\"";
            echo ((twig_get_attribute($this->env, $this->source, ($context["category_description"] ?? null), (($__internal_compile_18 = $context["language"]) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18["language_id"] ?? null) : null), [], "array", true, true, false, 91)) ? ((($__internal_compile_19 = (($__internal_compile_20 = ($context["category_description"] ?? null)) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20[(($__internal_compile_21 = $context["language"]) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21["language_id"] ?? null) : null)] ?? null) : null)) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19["h2"] ?? null) : null)) : (""));
            echo "\"  class=\"form-control\" />
                </div>
            </div>
\t\t\t  
\t\t\t<div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
            // line 96
            echo ($context["text_image_alt"] ?? null);
            echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"category_description[";
            // line 98
            echo (($__internal_compile_22 = $context["language"]) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22["language_id"] ?? null) : null);
            echo "][image_alt]\" value=\"";
            echo ((twig_get_attribute($this->env, $this->source, ($context["category_description"] ?? null), (($__internal_compile_23 = $context["language"]) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23["language_id"] ?? null) : null), [], "array", true, true, false, 98)) ? ((($__internal_compile_24 = (($__internal_compile_25 = ($context["category_description"] ?? null)) && is_array($__internal_compile_25) || $__internal_compile_25 instanceof ArrayAccess ? ($__internal_compile_25[(($__internal_compile_26 = $context["language"]) && is_array($__internal_compile_26) || $__internal_compile_26 instanceof ArrayAccess ? ($__internal_compile_26["language_id"] ?? null) : null)] ?? null) : null)) && is_array($__internal_compile_24) || $__internal_compile_24 instanceof ArrayAccess ? ($__internal_compile_24["image_alt"] ?? null) : null)) : (""));
            echo "\"  class=\"form-control\" />
                </div>
            </div>
\t\t\t  
\t\t\t<div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
            // line 103
            echo ($context["text_image_title"] ?? null);
            echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"category_description[";
            // line 105
            echo (($__internal_compile_27 = $context["language"]) && is_array($__internal_compile_27) || $__internal_compile_27 instanceof ArrayAccess ? ($__internal_compile_27["language_id"] ?? null) : null);
            echo "][image_title]\" value=\"";
            echo ((twig_get_attribute($this->env, $this->source, ($context["category_description"] ?? null), (($__internal_compile_28 = $context["language"]) && is_array($__internal_compile_28) || $__internal_compile_28 instanceof ArrayAccess ? ($__internal_compile_28["language_id"] ?? null) : null), [], "array", true, true, false, 105)) ? ((($__internal_compile_29 = (($__internal_compile_30 = ($context["category_description"] ?? null)) && is_array($__internal_compile_30) || $__internal_compile_30 instanceof ArrayAccess ? ($__internal_compile_30[(($__internal_compile_31 = $context["language"]) && is_array($__internal_compile_31) || $__internal_compile_31 instanceof ArrayAccess ? ($__internal_compile_31["language_id"] ?? null) : null)] ?? null) : null)) && is_array($__internal_compile_29) || $__internal_compile_29 instanceof ArrayAccess ? ($__internal_compile_29["image_title"] ?? null) : null)) : (""));
            echo "\"  class=\"form-control\" />
                </div>
            </div>
\t\t\t  
\t\t\t<div class=\"form-group\">
\t\t\t
                    <label class=\"col-sm-2 control-label\" for=\"input-meta-description";
            // line 111
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 111);
            echo "\">";
            echo ($context["entry_meta_description"] ?? null);
            echo "</label>
                    <div class=\"col-sm-10\">
                      <textarea name=\"category_description[";
            // line 113
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 113);
            echo "][meta_description]\" rows=\"5\" placeholder=\"";
            echo ($context["entry_meta_description"] ?? null);
            echo "\" id=\"input-meta-description";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 113);
            echo "\" class=\"form-control\">";
            echo (((($__internal_compile_32 = ($context["category_description"] ?? null)) && is_array($__internal_compile_32) || $__internal_compile_32 instanceof ArrayAccess ? ($__internal_compile_32[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 113)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_33 = ($context["category_description"] ?? null)) && is_array($__internal_compile_33) || $__internal_compile_33 instanceof ArrayAccess ? ($__internal_compile_33[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 113)] ?? null) : null), "meta_description", [], "any", false, false, false, 113)) : (""));
            echo "</textarea>
                    </div>
                  </div>
                  <div class=\"form-group\">
                    <label class=\"col-sm-2 control-label\" for=\"input-meta-keyword";
            // line 117
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 117);
            echo "\">";
            echo ($context["entry_meta_keyword"] ?? null);
            echo "</label>
                    <div class=\"col-sm-10\">
                      <textarea name=\"category_description[";
            // line 119
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 119);
            echo "][meta_keyword]\" rows=\"5\" placeholder=\"";
            echo ($context["entry_meta_keyword"] ?? null);
            echo "\" id=\"input-meta-keyword";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 119);
            echo "\" class=\"form-control\">";
            echo (((($__internal_compile_34 = ($context["category_description"] ?? null)) && is_array($__internal_compile_34) || $__internal_compile_34 instanceof ArrayAccess ? ($__internal_compile_34[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 119)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_35 = ($context["category_description"] ?? null)) && is_array($__internal_compile_35) || $__internal_compile_35 instanceof ArrayAccess ? ($__internal_compile_35[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 119)] ?? null) : null), "meta_keyword", [], "any", false, false, false, 119)) : (""));
            echo "</textarea>
                    </div>
                  </div>
                </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 124
        echo "              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-data\">
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-parent\">";
        // line 128
        echo ($context["entry_parent"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"path\" value=\"";
        // line 130
        echo ($context["path"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_parent"] ?? null);
        echo "\" id=\"input-parent\" class=\"form-control\" />
                  <input type=\"hidden\" name=\"parent_id\" value=\"";
        // line 131
        echo ($context["parent_id"] ?? null);
        echo "\" />
                  ";
        // line 132
        if (($context["error_parent"] ?? null)) {
            // line 133
            echo "                  <div class=\"text-danger\">";
            echo ($context["error_parent"] ?? null);
            echo "</div>
                  ";
        }
        // line 135
        echo "                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-filter\"><span data-toggle=\"tooltip\" title=\"";
        // line 138
        echo ($context["help_filter"] ?? null);
        echo "\">";
        echo ($context["entry_filter"] ?? null);
        echo "</span></label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"filter\" value=\"\" placeholder=\"";
        // line 140
        echo ($context["entry_filter"] ?? null);
        echo "\" id=\"input-filter\" class=\"form-control\" />
                  <div id=\"category-filter\" class=\"well well-sm\" style=\"height: 150px; overflow: auto;\">
                    ";
        // line 142
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["category_filters"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["category_filter"]) {
            // line 143
            echo "                    <div id=\"category-filter";
            echo twig_get_attribute($this->env, $this->source, $context["category_filter"], "filter_id", [], "any", false, false, false, 143);
            echo "\"><i class=\"fa fa-minus-circle\"></i> ";
            echo twig_get_attribute($this->env, $this->source, $context["category_filter"], "name", [], "any", false, false, false, 143);
            echo "
                      <input type=\"hidden\" name=\"category_filter[]\" value=\"";
            // line 144
            echo twig_get_attribute($this->env, $this->source, $context["category_filter"], "filter_id", [], "any", false, false, false, 144);
            echo "\" />
                    </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category_filter'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 147
        echo "                  </div>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
        // line 151
        echo ($context["entry_store"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <div class=\"well well-sm\" style=\"height: 150px; overflow: auto;\">
                    ";
        // line 154
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 155
            echo "                    <div class=\"checkbox\">
                      <label>
                        ";
            // line 157
            if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 157), ($context["category_store"] ?? null))) {
                // line 158
                echo "                        <input type=\"checkbox\" name=\"category_store[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 158);
                echo "\" checked=\"checked\" />
                        ";
                // line 159
                echo twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 159);
                echo "
                        ";
            } else {
                // line 161
                echo "                        <input type=\"checkbox\" name=\"category_store[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 161);
                echo "\" />
                        ";
                // line 162
                echo twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 162);
                echo "
                        ";
            }
            // line 164
            echo "                      </label>
                    </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 167
        echo "                  </div>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
        // line 171
        echo ($context["entry_image"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\"><a href=\"\" id=\"thumb-image\" data-toggle=\"image\" class=\"img-thumbnail\"><img src=\"";
        // line 172
        echo ($context["thumb"] ?? null);
        echo "\" alt=\"\" title=\"\" data-placeholder=\"";
        echo ($context["placeholder"] ?? null);
        echo "\" /></a>
                  <input type=\"hidden\" name=\"image\" value=\"";
        // line 173
        echo ($context["image"] ?? null);
        echo "\" id=\"input-image\" />
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-top\"><span data-toggle=\"tooltip\" title=\"";
        // line 177
        echo ($context["help_top"] ?? null);
        echo "\">";
        echo ($context["entry_top"] ?? null);
        echo "</span></label>
                <div class=\"col-sm-10\">
                  <div class=\"checkbox\">
                    <label>
                      ";
        // line 181
        if (($context["top"] ?? null)) {
            // line 182
            echo "                      <input type=\"checkbox\" name=\"top\" value=\"1\" checked=\"checked\" id=\"input-top\" />
                      ";
        } else {
            // line 184
            echo "                      <input type=\"checkbox\" name=\"top\" value=\"1\" id=\"input-top\" />
                      ";
        }
        // line 186
        echo "                      &nbsp; </label>
                  </div>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-column\"><span data-toggle=\"tooltip\" title=\"";
        // line 191
        echo ($context["help_column"] ?? null);
        echo "\">";
        echo ($context["entry_column"] ?? null);
        echo "</span></label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"column\" value=\"";
        // line 193
        echo ($context["column"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_column"] ?? null);
        echo "\" id=\"input-column\" class=\"form-control\" />
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-sort-order\">";
        // line 197
        echo ($context["entry_sort_order"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"sort_order\" value=\"";
        // line 199
        echo ($context["sort_order"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_sort_order"] ?? null);
        echo "\" id=\"input-sort-order\" class=\"form-control\" />
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-status\">";
        // line 203
        echo ($context["entry_status"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"status\" id=\"input-status\" class=\"form-control\">
                    ";
        // line 206
        if (($context["status"] ?? null)) {
            // line 207
            echo "                    <option value=\"1\" selected=\"selected\">";
            echo ($context["text_enabled"] ?? null);
            echo "</option>
                    <option value=\"0\">";
            // line 208
            echo ($context["text_disabled"] ?? null);
            echo "</option>
                    ";
        } else {
            // line 210
            echo "                    <option value=\"1\">";
            echo ($context["text_enabled"] ?? null);
            echo "</option>
                    <option value=\"0\" selected=\"selected\">";
            // line 211
            echo ($context["text_disabled"] ?? null);
            echo "</option>
                    ";
        }
        // line 213
        echo "                  </select>
                </div>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-seo\">
              <div class=\"alert alert-info\"><i class=\"fa fa-info-circle\"></i> ";
        // line 218
        echo ($context["text_keyword"] ?? null);
        echo "</div>
              <div class=\"table-responsive\">
                <table class=\"table table-bordered table-hover\">
                  <thead>
                    <tr>
                      <td class=\"text-left\">";
        // line 223
        echo ($context["entry_store"] ?? null);
        echo "</td>
                      <td class=\"text-left\">";
        // line 224
        echo ($context["entry_keyword"] ?? null);
        echo "</td>
                    </tr>
                  </thead>
                  <tbody>
                  ";
        // line 228
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 229
            echo "                  <tr>
                    <td class=\"text-left\">";
            // line 230
            echo twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 230);
            echo "</td>
                    <td class=\"text-left\">";
            // line 231
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 232
                echo "                      <div class=\"input-group\"><span class=\"input-group-addon\"><img src=\"language/";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 232);
                echo "/";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 232);
                echo ".png\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 232);
                echo "\" /></span>
                        <input type=\"text\" name=\"category_seo_url[";
                // line 233
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 233);
                echo "][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 233);
                echo "]\" value=\"";
                if ((($__internal_compile_36 = (($__internal_compile_37 = ($context["category_seo_url"] ?? null)) && is_array($__internal_compile_37) || $__internal_compile_37 instanceof ArrayAccess ? ($__internal_compile_37[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 233)] ?? null) : null)) && is_array($__internal_compile_36) || $__internal_compile_36 instanceof ArrayAccess ? ($__internal_compile_36[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 233)] ?? null) : null)) {
                    echo (($__internal_compile_38 = (($__internal_compile_39 = ($context["category_seo_url"] ?? null)) && is_array($__internal_compile_39) || $__internal_compile_39 instanceof ArrayAccess ? ($__internal_compile_39[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 233)] ?? null) : null)) && is_array($__internal_compile_38) || $__internal_compile_38 instanceof ArrayAccess ? ($__internal_compile_38[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 233)] ?? null) : null);
                }
                echo "\" placeholder=\"";
                echo ($context["entry_keyword"] ?? null);
                echo "\" class=\"form-control\" />
                      </div>
                      ";
                // line 235
                if ((($__internal_compile_40 = (($__internal_compile_41 = ($context["error_keyword"] ?? null)) && is_array($__internal_compile_41) || $__internal_compile_41 instanceof ArrayAccess ? ($__internal_compile_41[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 235)] ?? null) : null)) && is_array($__internal_compile_40) || $__internal_compile_40 instanceof ArrayAccess ? ($__internal_compile_40[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 235)] ?? null) : null)) {
                    // line 236
                    echo "                      <div class=\"text-danger\">";
                    echo (($__internal_compile_42 = (($__internal_compile_43 = ($context["error_keyword"] ?? null)) && is_array($__internal_compile_43) || $__internal_compile_43 instanceof ArrayAccess ? ($__internal_compile_43[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 236)] ?? null) : null)) && is_array($__internal_compile_42) || $__internal_compile_42 instanceof ArrayAccess ? ($__internal_compile_42[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 236)] ?? null) : null);
                    echo "</div>
                      ";
                }
                // line 238
                echo "                      ";
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
        // line 241
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
        // line 251
        echo ($context["entry_store"] ?? null);
        echo "</td>
                      <td class=\"text-left\">";
        // line 252
        echo ($context["entry_layout"] ?? null);
        echo "</td>
                    </tr>
                  </thead>
                  <tbody>

                    ";
        // line 257
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 258
            echo "                    <tr>
                      <td class=\"text-left\">";
            // line 259
            echo twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 259);
            echo "</td>
                      <td class=\"text-left\"><select name=\"category_layout[";
            // line 260
            echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 260);
            echo "]\" class=\"form-control\">
                          <option value=\"\"></option>
                          ";
            // line 262
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["layouts"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["layout"]) {
                // line 263
                echo "                          ";
                if (((($__internal_compile_44 = ($context["category_layout"] ?? null)) && is_array($__internal_compile_44) || $__internal_compile_44 instanceof ArrayAccess ? ($__internal_compile_44[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 263)] ?? null) : null) && ((($__internal_compile_45 = ($context["category_layout"] ?? null)) && is_array($__internal_compile_45) || $__internal_compile_45 instanceof ArrayAccess ? ($__internal_compile_45[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 263)] ?? null) : null) == twig_get_attribute($this->env, $this->source, $context["layout"], "layout_id", [], "any", false, false, false, 263)))) {
                    // line 264
                    echo "                          <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["layout"], "layout_id", [], "any", false, false, false, 264);
                    echo "\" selected=\"selected\">";
                    echo twig_get_attribute($this->env, $this->source, $context["layout"], "name", [], "any", false, false, false, 264);
                    echo "</option>
                          ";
                } else {
                    // line 266
                    echo "                          <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["layout"], "layout_id", [], "any", false, false, false, 266);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["layout"], "name", [], "any", false, false, false, 266);
                    echo "</option>
                          ";
                }
                // line 268
                echo "                          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['layout'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 269
            echo "                        </select></td>
                    </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 272
        echo "                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <link href=\"view/javascript/codemirror/lib/codemirror.css\" rel=\"stylesheet\" />
  <link href=\"view/javascript/codemirror/theme/monokai.css\" rel=\"stylesheet\" />
  <script type=\"text/javascript\" src=\"view/javascript/codemirror/lib/codemirror.js\"></script> 
  <script type=\"text/javascript\" src=\"view/javascript/codemirror/lib/xml.js\"></script> 
  <script type=\"text/javascript\" src=\"view/javascript/codemirror/lib/formatting.js\"></script> 
  
  <script type=\"text/javascript\" src=\"view/javascript/summernote/summernote.min.js\"></script>
  <link href=\"view/javascript/summernote/summernote.min.css\" rel=\"stylesheet\" />
  <script type=\"text/javascript\" src=\"view/javascript/summernote/summernote-image-attributes.js\"></script>
  <script type=\"text/javascript\" src=\"view/javascript/summernote/opencart.js\"></script>
  

\t\t\t\t  <script type=\"text/javascript\"><!--
\t\t\t\t\t  ";
        // line 294
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 295
            echo "\t\t\t\t\t      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 296
                echo "\t\t\t\t\t          \$(document).ready(function() {
\t\t\t\t\t               \$('input[name=\"category_description[";
                // line 297
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 297);
                echo "][name]\"]').stringToSlug({
\t\t\t\t\t                 setEvents: 'keyup keydown blur',
\t\t\t\t\t                 getPut: 'input[name=\"category_seo_url[";
                // line 299
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 299);
                echo "][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 299);
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
            // line 306
            echo "\t\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 307
        echo "\t\t\t\t\t  //--></script>
\t\t\t
  <script type=\"text/javascript\"><!--
\$('input[name=\\'path\\']').autocomplete({
\t'source': function(request, response) {
\t\t\$.ajax({
\t\t\turl: 'index.php?route=catalog/category/autocomplete&user_token=";
        // line 313
        echo ($context["user_token"] ?? null);
        echo "&filter_name=' +  encodeURIComponent(request),
\t\t\tdataType: 'json',
\t\t\tsuccess: function(json) {
\t\t\t\tjson.unshift({
\t\t\t\t\tcategory_id: 0,
\t\t\t\t\tname: '";
        // line 318
        echo ($context["text_none"] ?? null);
        echo "'
\t\t\t\t});

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
\t\t\$('input[name=\\'path\\']').val(item['label']);
\t\t\$('input[name=\\'parent_id\\']').val(item['value']);
\t}
});
//--></script>

\t\t\t\t  <script type=\"text/javascript\"><!--
\t\t\t\t\t  ";
        // line 338
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 339
            echo "\t\t\t\t\t      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 340
                echo "\t\t\t\t\t          \$(document).ready(function() {
\t\t\t\t\t               \$('input[name=\"category_description[";
                // line 341
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 341);
                echo "][name]\"]').stringToSlug({
\t\t\t\t\t                 setEvents: 'keyup keydown blur',
\t\t\t\t\t                 getPut: 'input[name=\"category_seo_url[";
                // line 343
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 343);
                echo "][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 343);
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
            // line 350
            echo "\t\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 351
        echo "\t\t\t\t\t  //--></script>
\t\t\t
  <script type=\"text/javascript\"><!--
\$('input[name=\\'filter\\']').autocomplete({
\t'source': function(request, response) {
\t\t\$.ajax({
\t\t\turl: 'index.php?route=catalog/filter/autocomplete&user_token=";
        // line 357
        echo ($context["user_token"] ?? null);
        echo "&filter_name=' +  encodeURIComponent(request),
\t\t\tdataType: 'json',
\t\t\tsuccess: function(json) {
\t\t\t\tresponse(\$.map(json, function(item) {
\t\t\t\t\treturn {
\t\t\t\t\t\tlabel: item['name'],
\t\t\t\t\t\tvalue: item['filter_id']
\t\t\t\t\t}
\t\t\t\t}));
\t\t\t}
\t\t});
\t},
\t'select': function(item) {
\t\t\$('input[name=\\'filter\\']').val('');

\t\t\$('#category-filter' + item['value']).remove();

\t\t\$('#category-filter').append('<div id=\"category-filter' + item['value'] + '\"><i class=\"fa fa-minus-circle\"></i> ' + item['label'] + '<input type=\"hidden\" name=\"category_filter[]\" value=\"' + item['value'] + '\" /></div>');
\t}
});

\$('#category-filter').delegate('.fa-minus-circle', 'click', function() {
\t\$(this).parent().remove();
});
//--></script>

\t\t\t\t  <script type=\"text/javascript\"><!--
\t\t\t\t\t  ";
        // line 384
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 385
            echo "\t\t\t\t\t      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 386
                echo "\t\t\t\t\t          \$(document).ready(function() {
\t\t\t\t\t               \$('input[name=\"category_description[";
                // line 387
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 387);
                echo "][name]\"]').stringToSlug({
\t\t\t\t\t                 setEvents: 'keyup keydown blur',
\t\t\t\t\t                 getPut: 'input[name=\"category_seo_url[";
                // line 389
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 389);
                echo "][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 389);
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
            // line 396
            echo "\t\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 397
        echo "\t\t\t\t\t  //--></script>
\t\t\t
  <script type=\"text/javascript\"><!--
\$('#language a:first').tab('show');
//--></script></div>
";
        // line 402
        echo ($context["footer"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "catalog/category_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  984 => 402,  977 => 397,  971 => 396,  956 => 389,  951 => 387,  948 => 386,  943 => 385,  939 => 384,  909 => 357,  901 => 351,  895 => 350,  880 => 343,  875 => 341,  872 => 340,  867 => 339,  863 => 338,  840 => 318,  832 => 313,  824 => 307,  818 => 306,  803 => 299,  798 => 297,  795 => 296,  790 => 295,  786 => 294,  762 => 272,  754 => 269,  748 => 268,  740 => 266,  732 => 264,  729 => 263,  725 => 262,  720 => 260,  716 => 259,  713 => 258,  709 => 257,  701 => 252,  697 => 251,  685 => 241,  672 => 238,  666 => 236,  664 => 235,  651 => 233,  642 => 232,  638 => 231,  634 => 230,  631 => 229,  627 => 228,  620 => 224,  616 => 223,  608 => 218,  601 => 213,  596 => 211,  591 => 210,  586 => 208,  581 => 207,  579 => 206,  573 => 203,  564 => 199,  559 => 197,  550 => 193,  543 => 191,  536 => 186,  532 => 184,  528 => 182,  526 => 181,  517 => 177,  510 => 173,  504 => 172,  500 => 171,  494 => 167,  486 => 164,  481 => 162,  476 => 161,  471 => 159,  466 => 158,  464 => 157,  460 => 155,  456 => 154,  450 => 151,  444 => 147,  435 => 144,  428 => 143,  424 => 142,  419 => 140,  412 => 138,  407 => 135,  401 => 133,  399 => 132,  395 => 131,  389 => 130,  384 => 128,  378 => 124,  361 => 119,  354 => 117,  341 => 113,  334 => 111,  323 => 105,  318 => 103,  308 => 98,  303 => 96,  293 => 91,  288 => 89,  278 => 84,  273 => 82,  267 => 78,  261 => 76,  259 => 75,  249 => 74,  242 => 72,  226 => 67,  219 => 65,  203 => 60,  196 => 58,  187 => 51,  181 => 49,  179 => 48,  169 => 47,  162 => 45,  156 => 43,  152 => 42,  148 => 40,  131 => 38,  127 => 37,  119 => 32,  115 => 31,  111 => 30,  107 => 29,  102 => 27,  96 => 24,  92 => 22,  84 => 18,  82 => 17,  76 => 13,  65 => 11,  61 => 10,  56 => 8,  50 => 7,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "catalog/category_form.twig", "");
    }
}
