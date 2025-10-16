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

/* catalog/category_list.twig */
class __TwigTemplate_56d191ecaa47743e8dac12d2b941c6af2dadbc06a50c4debb8206199492d2e5a extends \Twig\Template
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
      <div class=\"pull-right\"><a href=\"";
        // line 5
        echo ($context["add"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_add"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus\"></i></a> <a href=\"";
        echo ($context["repair"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_rebuild"] ?? null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-refresh\"></i></a>
        <button type=\"button\" data-toggle=\"tooltip\" title=\"";
        // line 6
        echo ($context["button_delete"] ?? null);
        echo "\" class=\"btn btn-danger\" onclick=\"confirm('";
        echo ($context["text_confirm"] ?? null);
        echo "') ? \$('#form-category').submit() : false;\"><i class=\"fa fa-trash-o\"></i></button>
      </div>
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
        echo "    ";
        if (($context["success"] ?? null)) {
            // line 23
            echo "    <div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 27
        echo "    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-list\"></i> ";
        // line 29
        echo ($context["text_list"] ?? null);
        echo "</h3>

\t\t\t\t<div style=\"margin-top:10px; width:30%;\"><input value=\"";
        // line 31
        echo ($context["search"] ?? null);
        echo "\" class=\"form-control\" name=\"search\" type=\"text\" placeholder=\"Enter category name\"/> <br>
\t\t\t\t<button type=\"button\" id=\"button-filter\" class=\"btn btn-default\"><i class=\"fa fa-filter\"></i> Filter</button>
\t\t\t</div>
      </div>
      <div class=\"panel-body\">
        <form action=\"";
        // line 36
        echo ($context["delete"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-category\">
          <div class=\"table-responsive\">
            <table class=\"table table-bordered table-hover\">
              <thead>
                <tr>
                  <td style=\"width: 1px;\" class=\"text-center\"><input type=\"checkbox\" onclick=\"\$('input[name*=\\'selected\\']').prop('checked', this.checked);\" /></td>
                  <td class=\"text-left\">";
        // line 42
        if ((($context["sort"] ?? null) == "name")) {
            // line 43
            echo "                    <a href=\"";
            echo ($context["sort_name"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_name"] ?? null);
            echo "</a>
                    ";
        } else {
            // line 45
            echo "                    <a href=\"";
            echo ($context["sort_name"] ?? null);
            echo "\">";
            echo ($context["column_name"] ?? null);
            echo "</a>
                    ";
        }
        // line 46
        echo "</td>
                  <td class=\"text-right\">";
        // line 47
        if ((($context["sort"] ?? null) == "sort_order")) {
            // line 48
            echo "                    <a href=\"";
            echo ($context["sort_sort_order"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_sort_order"] ?? null);
            echo "</a>
                    ";
        } else {
            // line 50
            echo "                    <a href=\"";
            echo ($context["sort_sort_order"] ?? null);
            echo "\">";
            echo ($context["column_sort_order"] ?? null);
            echo "</a>
                    ";
        }
        // line 51
        echo "</td>
                  <td class=\"text-right\">";
        // line 52
        echo ($context["column_action"] ?? null);
        echo "</td>
                </tr>
              </thead>
              <tbody>
                ";
        // line 56
        if (($context["categories"] ?? null)) {
            // line 57
            echo "                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                // line 58
                echo "                <tr>
                  <td class=\"text-center\">";
                // line 59
                if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["category"], "category_id", [], "any", false, false, false, 59), ($context["selected"] ?? null))) {
                    // line 60
                    echo "                    <input type=\"checkbox\" name=\"selected[]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "category_id", [], "any", false, false, false, 60);
                    echo "\" checked=\"checked\" />
                    ";
                } else {
                    // line 62
                    echo "                    <input type=\"checkbox\" name=\"selected[]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "category_id", [], "any", false, false, false, 62);
                    echo "\" />
                    ";
                }
                // line 63
                echo "</td>
                  <td class=\"text-left\">";
                // line 64
                echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 64);
                echo "</td>
                  <td class=\"text-right\">";
                // line 65
                echo twig_get_attribute($this->env, $this->source, $context["category"], "sort_order", [], "any", false, false, false, 65);
                echo "</td>
                  <td class=\"text-right\"><a href=\"";
                // line 66
                echo twig_get_attribute($this->env, $this->source, $context["category"], "edit", [], "any", false, false, false, 66);
                echo "\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_edit"] ?? null);
                echo "\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i></a></td>
                </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 69
            echo "                ";
        } else {
            // line 70
            echo "                <tr>
                  <td class=\"text-center\" colspan=\"4\">";
            // line 71
            echo ($context["text_no_results"] ?? null);
            echo "</td>
                </tr>
                ";
        }
        // line 74
        echo "              </tbody>
            </table>
          </div>
        </form>
        <div class=\"row\">
          <div class=\"col-sm-6 text-left\">";
        // line 79
        echo ($context["pagination"] ?? null);
        echo "</div>
          <div class=\"col-sm-6 text-right\">";
        // line 80
        echo ($context["results"] ?? null);
        echo "</div>
        </div>
      </div>
    </div>
  </div>
</div>

\t\t\t";
        // line 87
        if (((($context["hb_onpage_auto"] ?? null) == 1) && (($context["pagination_detected"] ?? null) == false))) {
            // line 88
            echo "\t\t\t<script type=\"text/javascript\">
\t\t\t\$(document).ready( function () {
\t\t\t  \$.ajax({
\t\t\t\t\t  url: '";
            // line 91
            echo ($context["onpagetags"] ?? null);
            echo "'
\t\t\t\t });
\t\t\t});
\t\t\t</script>
\t\t\t";
        }
        // line 96
        echo "\t\t\t
";
        // line 97
        echo ($context["footer"] ?? null);
        echo "
<script>
\t\t\t\t\$('#button-filter').on('click', function() {
\t\t\t\tvar url = '';

\t\t\t\tvar search = \$('input[name=\\'search\\']').val();

\t\t\t\tif (search) {
\t\t\t\turl += '&search=' + encodeURIComponent(search);
\t\t\t\t} location = 'index.php?route=catalog/category&user_token=";
        // line 106
        echo ($context["user_token"] ?? null);
        echo "' + url;
\t\t\t\t}); </script>
\t\t\t";
    }

    public function getTemplateName()
    {
        return "catalog/category_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  297 => 106,  285 => 97,  282 => 96,  274 => 91,  269 => 88,  267 => 87,  257 => 80,  253 => 79,  246 => 74,  240 => 71,  237 => 70,  234 => 69,  223 => 66,  219 => 65,  215 => 64,  212 => 63,  206 => 62,  200 => 60,  198 => 59,  195 => 58,  190 => 57,  188 => 56,  181 => 52,  178 => 51,  170 => 50,  160 => 48,  158 => 47,  155 => 46,  147 => 45,  137 => 43,  135 => 42,  126 => 36,  118 => 31,  113 => 29,  109 => 27,  101 => 23,  98 => 22,  90 => 18,  88 => 17,  82 => 13,  71 => 11,  67 => 10,  62 => 8,  55 => 6,  45 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "catalog/category_list.twig", "");
    }
}
