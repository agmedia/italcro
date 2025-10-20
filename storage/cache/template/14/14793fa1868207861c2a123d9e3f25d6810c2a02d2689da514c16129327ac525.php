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

/* catalog/manufacturer_form.twig */
class __TwigTemplate_57132ab0fcc221421a4ea8b9a970c889d8701c441ea594212091ed2d2781d4d7 extends \Twig\Template
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
        <button type=\"submit\" form=\"form-manufacturer\" data-toggle=\"tooltip\" title=\"";
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
  <div class=\"container-fluid\"> ";
        // line 16
        if (($context["error_warning"] ?? null)) {
            // line 17
            echo "    <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 21
        echo "    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-pencil\"></i> ";
        // line 23
        echo ($context["text_form"] ?? null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
        <form action=\"";
        // line 26
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-manufacturer\" class=\"form-horizontal\">
          <ul class=\"nav nav-tabs\">
            <li class=\"active\"><a href=\"#tab-general\" data-toggle=\"tab\">";
        // line 28
        echo ($context["tab_general"] ?? null);
        echo "</a></li>
            <li><a href=\"#tab-seo\" data-toggle=\"tab\">";
        // line 29
        echo ($context["tab_seo"] ?? null);
        echo "</a></li>
          </ul>
          <div class=\"tab-content\">
            <div class=\"tab-pane active\" id=\"tab-general\">
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-name\">";
        // line 34
        echo ($context["entry_name"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"name\" value=\"";
        // line 36
        echo ($context["name"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_name"] ?? null);
        echo "\" id=\"input-name\" class=\"form-control\" />
                  ";
        // line 37
        if (($context["error_name"] ?? null)) {
            // line 38
            echo "                  <div class=\"text-danger\">";
            echo ($context["error_name"] ?? null);
            echo "</div>
                  ";
        }
        // line 39
        echo "</div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
        // line 42
        echo ($context["entry_store"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <div class=\"well well-sm\" style=\"height: 150px; overflow: auto;\"> ";
        // line 44
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 45
            echo "                    <div class=\"checkbox\">
                      <label>";
            // line 46
            if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 46), ($context["manufacturer_store"] ?? null))) {
                // line 47
                echo "                        <input type=\"checkbox\" name=\"manufacturer_store[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 47);
                echo "\" checked=\"checked\" />
                        ";
                // line 48
                echo twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 48);
                echo "
                        ";
            } else {
                // line 50
                echo "                        <input type=\"checkbox\" name=\"manufacturer_store[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 50);
                echo "\" />
                        ";
                // line 51
                echo twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 51);
                echo "
                        ";
            }
            // line 52
            echo "</label>
                    </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 54
        echo "</div>
                </div>
              </div>
              <div class=\"form-group\">

\t\t\t    <label class=\"col-sm-2 control-label\">";
        // line 59
        echo ($context["text_meta_title"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"meta_title\" value=\"";
        // line 61
        echo ($context["meta_title"] ?? null);
        echo "\"  class=\"form-control\" />
                </div>
            </div>
\t\t\t  
\t\t\t<div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
        // line 66
        echo ($context["text_meta_description"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <textarea name=\"meta_description\" rows=\"5\" class=\"form-control\">";
        // line 68
        echo ($context["meta_description"] ?? null);
        echo "</textarea>
                </div>
            </div>
\t\t\t  
\t\t\t<div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
        // line 73
        echo ($context["text_meta_keyword"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <textarea name=\"meta_keyword\" rows=\"5\" class=\"form-control\">";
        // line 75
        echo ($context["meta_keyword"] ?? null);
        echo "</textarea>
                </div>
            </div>
\t\t\t  
\t\t\t<div class=\"form-group\">
\t\t\t    <label class=\"col-sm-2 control-label\">";
        // line 80
        echo ($context["text_h1"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"h1\" value=\"";
        // line 82
        echo ($context["h1"] ?? null);
        echo "\"  class=\"form-control\" />
                </div>
            </div>
\t\t\t  
\t\t\t<div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
        // line 87
        echo ($context["text_h2"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"h2\" value=\"";
        // line 89
        echo ($context["h2"] ?? null);
        echo "\"  class=\"form-control\" />
                </div>
            </div>
\t\t\t  
\t\t\t<div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
        // line 94
        echo ($context["text_image_alt"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"image_alt\" value=\"";
        // line 96
        echo ($context["image_alt"] ?? null);
        echo "\"  class=\"form-control\" />
                </div>
            </div>
\t\t\t  
\t\t\t<div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
        // line 101
        echo ($context["text_image_title"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"image_title\" value=\"";
        // line 103
        echo ($context["image_title"] ?? null);
        echo "\"  class=\"form-control\" />
                </div>
            </div>
\t\t\t  
\t\t    <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\">";
        // line 108
        echo ($context["text_description"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <textarea name=\"description\" id=\"description\" class=\"form-control\">";
        // line 110
        echo ($context["description"] ?? null);
        echo "</textarea>
                </div>
            </div>
\t\t\t  
\t\t\t<div class=\"form-group\">
\t\t\t
                <label class=\"col-sm-2 control-label\" for=\"input-image\">";
        // line 116
        echo ($context["entry_image"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\"><a href=\"\" id=\"thumb-image\" data-toggle=\"image\" class=\"img-thumbnail\"><img src=\"";
        // line 117
        echo ($context["thumb"] ?? null);
        echo "\" alt=\"\" title=\"\" data-placeholder=\"";
        echo ($context["placeholder"] ?? null);
        echo "\" /></a>
                  <input type=\"hidden\" name=\"image\" value=\"";
        // line 118
        echo ($context["image"] ?? null);
        echo "\" id=\"input-image\" />
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-sort-order\">";
        // line 122
        echo ($context["entry_sort_order"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"sort_order\" value=\"";
        // line 124
        echo ($context["sort_order"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_sort_order"] ?? null);
        echo "\" id=\"input-sort-order\" class=\"form-control\" />
                </div>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-seo\">
              <div class=\"alert alert-info\"><i class=\"fa fa-info-circle\"></i> ";
        // line 129
        echo ($context["text_keyword"] ?? null);
        echo "</div>
              <div class=\"table-responsive\">
                <table class=\"table table-bordered table-hover\">
                  <thead>
                    <tr>
                      <td class=\"text-left\">";
        // line 134
        echo ($context["entry_store"] ?? null);
        echo "</td>
                      <td class=\"text-left\">";
        // line 135
        echo ($context["entry_keyword"] ?? null);
        echo "</td>
                    </tr>
                  </thead>
                  <tbody>
                  ";
        // line 139
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 140
            echo "                  <tr>
                    <td class=\"text-left\">";
            // line 141
            echo twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 141);
            echo "</td>
                    <td class=\"text-left\">";
            // line 142
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 143
                echo "                      <div class=\"input-group\"><span class=\"input-group-addon\"><img src=\"language/";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 143);
                echo "/";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 143);
                echo ".png\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 143);
                echo "\" /></span>
                        <input type=\"text\" name=\"manufacturer_seo_url[";
                // line 144
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 144);
                echo "][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 144);
                echo "]\" value=\"";
                if ((($__internal_compile_0 = (($__internal_compile_1 = ($context["manufacturer_seo_url"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 144)] ?? null) : null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 144)] ?? null) : null)) {
                    echo (($__internal_compile_2 = (($__internal_compile_3 = ($context["manufacturer_seo_url"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 144)] ?? null) : null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 144)] ?? null) : null);
                }
                echo "\" placeholder=\"";
                echo ($context["entry_keyword"] ?? null);
                echo "\" class=\"form-control\" />
                      </div>
                      ";
                // line 146
                if ((($__internal_compile_4 = (($__internal_compile_5 = ($context["error_keyword"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 146)] ?? null) : null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 146)] ?? null) : null)) {
                    // line 147
                    echo "                      <div class=\"text-danger\">";
                    echo (($__internal_compile_6 = (($__internal_compile_7 = ($context["error_keyword"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7[twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 147)] ?? null) : null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 147)] ?? null) : null);
                    echo "</div>
                      ";
                }
                // line 148
                echo " 
                      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 149
            echo "</td>
                  </tr>
                  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 152
        echo "                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

\t\t\t  <link href=\"view/javascript/codemirror/lib/codemirror.css\" rel=\"stylesheet\" />
\t\t\t  <link href=\"view/javascript/codemirror/theme/monokai.css\" rel=\"stylesheet\" />
\t\t\t  <script type=\"text/javascript\" src=\"view/javascript/codemirror/lib/codemirror.js\"></script> 
\t\t\t  <script type=\"text/javascript\" src=\"view/javascript/codemirror/lib/xml.js\"></script> 
\t\t\t  <script type=\"text/javascript\" src=\"view/javascript/codemirror/lib/formatting.js\"></script> 
\t\t\t  <script type=\"text/javascript\" src=\"view/javascript/summernote/summernote.js\"></script>
\t\t\t  <link href=\"view/javascript/summernote/summernote.css\" rel=\"stylesheet\" />
\t\t\t  <script type=\"text/javascript\" src=\"view/javascript/summernote/summernote-image-attributes.js\"></script> 
\t\t\t  <script type=\"text/javascript\" src=\"view/javascript/summernote/opencart.js\"></script>

\t\t\t<script type=\"text/javascript\">
\t\t\t\$('#description').summernote({
\t\t\t\theight: 300
\t\t\t});</script>
\t\t\t
";
        // line 178
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "catalog/manufacturer_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  435 => 178,  407 => 152,  399 => 149,  392 => 148,  386 => 147,  384 => 146,  371 => 144,  362 => 143,  358 => 142,  354 => 141,  351 => 140,  347 => 139,  340 => 135,  336 => 134,  328 => 129,  318 => 124,  313 => 122,  306 => 118,  300 => 117,  296 => 116,  287 => 110,  282 => 108,  274 => 103,  269 => 101,  261 => 96,  256 => 94,  248 => 89,  243 => 87,  235 => 82,  230 => 80,  222 => 75,  217 => 73,  209 => 68,  204 => 66,  196 => 61,  191 => 59,  184 => 54,  176 => 52,  171 => 51,  166 => 50,  161 => 48,  156 => 47,  154 => 46,  151 => 45,  147 => 44,  142 => 42,  137 => 39,  131 => 38,  129 => 37,  123 => 36,  118 => 34,  110 => 29,  106 => 28,  101 => 26,  95 => 23,  91 => 21,  83 => 17,  81 => 16,  76 => 13,  65 => 11,  61 => 10,  56 => 8,  50 => 7,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "catalog/manufacturer_form.twig", "");
    }
}
