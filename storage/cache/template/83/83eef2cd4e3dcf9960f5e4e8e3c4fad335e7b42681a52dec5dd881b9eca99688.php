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

/* extension/faq_list.twig */
class __TwigTemplate_e205d174e1e2ddf4a7b76d9d43f8d05671ea9d82c204313db14a2badccc5abc3 extends \Twig\Template
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
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus\"></i></a>
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
      </div>
      <div class=\"panel-body\">
\t\t  <div class=\"well\">
\t\t\t  <div class=\"row\">
\t\t\t\t<div class=\"col-sm-4\">
\t\t\t\t  <div class=\"form-group\">
\t\t\t\t\t<label class=\"control-label\" for=\"input-name\">";
        // line 36
        echo ($context["entry_name"] ?? null);
        echo "</label>
\t\t\t\t\t<input type=\"text\" name=\"filter_name\" value=\"";
        // line 37
        echo ($context["filter_name"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_name"] ?? null);
        echo "\" id=\"input-name\" class=\"form-control\" />
\t\t\t\t  </div>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-sm-4\">
\t\t\t\t  <div class=\"form-group\">
  \t\t\t\t\t<label class=\"control-label\" for=\"input-model\">";
        // line 42
        echo ($context["entry_category"] ?? null);
        echo "</label>
            <select class=\"form-control\" name=\"filter_category\">
              <option value=\"\"></option>
              ";
        // line 45
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["fcategories"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 46
            echo "              ";
            if ((twig_get_attribute($this->env, $this->source, $context["category"], "fcategory_id", [], "any", false, false, false, 46) == ($context["filter_category"] ?? null))) {
                // line 47
                echo "              <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["category"], "fcategory_id", [], "any", false, false, false, 47);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 47);
                echo "</option>
              ";
            } else {
                // line 49
                echo "              <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["category"], "fcategory_id", [], "any", false, false, false, 49);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 49);
                echo "</option>
              ";
            }
            // line 51
            echo "              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 52
        echo "            </select>
\t\t\t\t  </div>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-sm-4\">
\t\t\t\t  <div class=\"form-group\">
\t\t\t\t\t<label class=\"control-label\" for=\"input-status\">";
        // line 57
        echo ($context["entry_status"] ?? null);
        echo "</label>


          <select name=\"filter_status\" id=\"input-status\" class=\"form-control\">
            <option value=\"*\"></option>
            ";
        // line 62
        if ((($context["filter_status"] ?? null) == "1")) {
            // line 63
            echo "            <option value=\"1\" selected=\"selected\">";
            echo ($context["text_enabled"] ?? null);
            echo "</option>
            ";
        } else {
            // line 65
            echo "            <option value=\"1\">";
            echo ($context["text_enabled"] ?? null);
            echo "</option>
            ";
        }
        // line 67
        echo "            ";
        if ((($context["filter_status"] ?? null) == "0")) {
            // line 68
            echo "            <option value=\"0\" selected=\"selected\">";
            echo ($context["text_disabled"] ?? null);
            echo "</option>
            ";
        } else {
            // line 70
            echo "            <option value=\"0\">";
            echo ($context["text_disabled"] ?? null);
            echo "</option>
          ";
        }
        // line 72
        echo "          </select>
\t\t\t\t  </div>
\t\t\t\t  <button type=\"button\" id=\"button-filter\" class=\"btn btn-primary pull-right\"><i class=\"fa fa-search\"></i> ";
        // line 74
        echo ($context["button_filter"] ?? null);
        echo "</button>
\t\t\t\t</div>
\t\t\t  </div>
\t\t\t</div>
        <form action=\"";
        // line 78
        echo ($context["delete"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-category\">
          <div class=\"table-responsive\">
            <table class=\"table table-bordered table-hover\">
              <thead>
                <tr>
                  <td style=\"width: 1px;\" class=\"text-center\"><input type=\"checkbox\" onclick=\"\$('input[name*=\\'selected\\']').prop('checked', this.checked);\" /></td>
                  <td class=\"text-left\">";
        // line 84
        if ((($context["sort"] ?? null) == "name")) {
            // line 85
            echo "                    <a href=\"";
            echo ($context["sort_name"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_name"] ?? null);
            echo "</a>
                    ";
        } else {
            // line 87
            echo "                    <a href=\"";
            echo ($context["sort_name"] ?? null);
            echo "\">";
            echo ($context["column_name"] ?? null);
            echo "</a>
                    ";
        }
        // line 88
        echo "</td>
        \t\t\t\t  <td>";
        // line 89
        echo ($context["entry_category"] ?? null);
        echo "</td>
        \t\t\t\t  <td>";
        // line 90
        echo ($context["entry_status"] ?? null);
        echo "</td>
                  <td class=\"text-right\">";
        // line 91
        if ((($context["sort"] ?? null) == "sort_order")) {
            // line 92
            echo "                    <a href=\"";
            echo ($context["sort_sort_order"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_sort_order"] ?? null);
            echo "</a>
                    ";
        } else {
            // line 94
            echo "                    <a href=\"";
            echo ($context["sort_sort_order"] ?? null);
            echo "\">";
            echo ($context["column_sort_order"] ?? null);
            echo "</a>
                    ";
        }
        // line 95
        echo "</td>
                  <td class=\"text-right\">";
        // line 96
        echo ($context["column_action"] ?? null);
        echo "</td>
                </tr>
              </thead>
              <tbody>
                ";
        // line 100
        if (($context["faqs"] ?? null)) {
            // line 101
            echo "                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["faqs"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["faq"]) {
                // line 102
                echo "                <tr>
                  <td class=\"text-center\">";
                // line 103
                if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["faq"], "faq_id", [], "any", false, false, false, 103), ($context["selected"] ?? null))) {
                    // line 104
                    echo "                    <input type=\"checkbox\" name=\"selected[]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["faq"], "faq_id", [], "any", false, false, false, 104);
                    echo "\" checked=\"checked\" />
                    ";
                } else {
                    // line 106
                    echo "                    <input type=\"checkbox\" name=\"selected[]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["faq"], "faq_id", [], "any", false, false, false, 106);
                    echo "\" />
                    ";
                }
                // line 107
                echo "</td>
                  <td class=\"text-left\">";
                // line 108
                echo twig_get_attribute($this->env, $this->source, $context["faq"], "name", [], "any", false, false, false, 108);
                echo "</td>
                  <td class=\"text-left\">";
                // line 109
                echo twig_get_attribute($this->env, $this->source, $context["faq"], "categorienames", [], "any", false, false, false, 109);
                echo "</td>
                  <td class=\"text-left\">";
                // line 110
                echo twig_get_attribute($this->env, $this->source, $context["faq"], "status", [], "any", false, false, false, 110);
                echo "</td>
                  <td class=\"text-right\">";
                // line 111
                echo twig_get_attribute($this->env, $this->source, $context["faq"], "sort_order", [], "any", false, false, false, 111);
                echo "</td>
                  <td class=\"text-right\"><a href=\"";
                // line 112
                echo twig_get_attribute($this->env, $this->source, $context["faq"], "edit", [], "any", false, false, false, 112);
                echo "\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_edit"] ?? null);
                echo "\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i></a></td>
                </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['faq'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 115
            echo "                ";
        } else {
            // line 116
            echo "                <tr>
                  <td class=\"text-center\" colspan=\"6\">";
            // line 117
            echo ($context["text_no_results"] ?? null);
            echo "</td>
                </tr>
                ";
        }
        // line 120
        echo "              </tbody>
            </table>
          </div>
        </form>
        <div class=\"row\">
          <div class=\"col-sm-6 text-left\">";
        // line 125
        echo ($context["pagination"] ?? null);
        echo "</div>
          <div class=\"col-sm-6 text-right\">";
        // line 126
        echo ($context["results"] ?? null);
        echo "</div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type=\"text/javascript\"><!--
\$('#button-filter').on('click', function() {
\tvar url = 'index.php?route=extension/faq&user_token=";
        // line 134
        echo ($context["user_token"] ?? null);
        echo "';

\tvar filter_name = \$('input[name=\\'filter_name\\']').val();

\tif (filter_name){
\t\turl += '&filter_name=' + encodeURIComponent(filter_name);
\t}

\tvar filter_category = \$('select[name=\\'filter_category\\']').val();

\tif (filter_category) {
\t\turl += '&filter_category=' + encodeURIComponent(filter_category);
\t}

\tvar filter_status = \$('select[name=\\'filter_status\\']').val();

\tif (filter_status != '*') {
\t\turl += '&filter_status=' + encodeURIComponent(filter_status);
\t}

\tlocation = url;
});
//--></script>
";
        // line 157
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "extension/faq_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  407 => 157,  381 => 134,  370 => 126,  366 => 125,  359 => 120,  353 => 117,  350 => 116,  347 => 115,  336 => 112,  332 => 111,  328 => 110,  324 => 109,  320 => 108,  317 => 107,  311 => 106,  305 => 104,  303 => 103,  300 => 102,  295 => 101,  293 => 100,  286 => 96,  283 => 95,  275 => 94,  265 => 92,  263 => 91,  259 => 90,  255 => 89,  252 => 88,  244 => 87,  234 => 85,  232 => 84,  223 => 78,  216 => 74,  212 => 72,  206 => 70,  200 => 68,  197 => 67,  191 => 65,  185 => 63,  183 => 62,  175 => 57,  168 => 52,  162 => 51,  154 => 49,  146 => 47,  143 => 46,  139 => 45,  133 => 42,  123 => 37,  119 => 36,  109 => 29,  105 => 27,  97 => 23,  94 => 22,  86 => 18,  84 => 17,  78 => 13,  67 => 11,  63 => 10,  58 => 8,  51 => 6,  45 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/faq_list.twig", "");
    }
}
