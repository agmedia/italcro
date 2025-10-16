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

/* extension/blog/blog_list.twig */
class __TwigTemplate_54800de9914ad5f13b8b0379ca1d1281bd6d8202131a0e8fb00a840981a66513 extends \Twig\Template
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
        echo "') ? \$('#form').submit() : false;\"><i class=\"fa fa-trash-o\"></i></button>
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
            echo " 
        <li><a href=\"";
            // line 11
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 11);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 11);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 12
        echo " 
      </ul>
    </div>
  </div>
  <div class=\"container-fluid\">
    ";
        // line 17
        if (($context["error_warning"] ?? null)) {
            echo " 
    <div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            // line 18
            echo ($context["error_warning"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 21
        echo " 
    ";
        // line 22
        if (($context["success"] ?? null)) {
            echo " 
    <div class=\"alert alert-success\"><i class=\"fa fa-check-circle\"></i> ";
            // line 23
            echo ($context["success"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 26
        echo " 
    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-list\"></i> ";
        // line 29
        echo ($context["heading_title"] ?? null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
      <form action=\"";
        // line 32
        echo ($context["delete"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form\">

      <div class=\"table-responsive\">
         <table class=\"table table-bordered table-hover\">
        <thead>
          <tr>
            <td width=\"1\"><input type=\"checkbox\" onclick=\"\$('input[name*=\\'selected\\']').attr('checked', this.checked);\" /></td>
            <td>";
        // line 39
        if ((($context["sort"] ?? null) == "id.title")) {
            echo " 
              <a href=\"";
            // line 40
            echo ($context["sort_title"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_title"] ?? null);
            echo "</a>
               ";
        } else {
            // line 41
            echo "   
              <a href=\"";
            // line 42
            echo ($context["sort_title"] ?? null);
            echo "\">";
            echo ($context["column_title"] ?? null);
            echo "</a>
              ";
        }
        // line 43
        echo " 
              </td>
            <td>
            ";
        // line 46
        if ((($context["sort"] ?? null) == "i.date_added")) {
            echo " 
              <a href=\"";
            // line 47
            echo ($context["sort_date_added"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_date_added"] ?? null);
            echo "</a>
              ";
        } else {
            // line 48
            echo "   
              <a href=\"";
            // line 49
            echo ($context["sort_date_added"] ?? null);
            echo "\">";
            echo ($context["column_date_added"] ?? null);
            echo "</a>
              ";
        }
        // line 50
        echo "</td>
            <td class=\"text-right\">";
        // line 51
        echo ($context["column_comments"] ?? null);
        echo "</td>
            <td class=\"text-right\">";
        // line 52
        echo ($context["column_count_read"] ?? null);
        echo "</td>
\t\t\t<td class=\"text-right\">";
        // line 53
        if ((($context["sort"] ?? null) == "i.sort_order")) {
            echo " 
              <a href=\"";
            // line 54
            echo ($context["sort_sort_order"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_sort_order"] ?? null);
            echo "</a>
               ";
        } else {
            // line 55
            echo "   
              <a href=\"";
            // line 56
            echo ($context["sort_sort_order"] ?? null);
            echo "\">";
            echo ($context["column_sort_order"] ?? null);
            echo "</a>
               ";
        }
        // line 58
        echo "               </td>
              <td class=\"text-right\">";
        // line 59
        echo ($context["column_status"] ?? null);
        echo "</td>
            <td width=\"1\">";
        // line 60
        echo ($context["column_action"] ?? null);
        echo "</td>
          </tr>
        </thead>
        <tbody>
          ";
        // line 64
        if (($context["blogs"] ?? null)) {
            echo " 
          ";
            // line 65
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["blogs"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["blog"]) {
                echo " 
          <tr>
            <td style=\"text-align: center;\">";
                // line 67
                if (twig_get_attribute($this->env, $this->source, $context["blog"], "selected", [], "any", false, false, false, 67)) {
                    echo " 
              <input type=\"checkbox\" name=\"selected[]\" value=\"";
                    // line 68
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "blog_id", [], "any", false, false, false, 68);
                    echo "\" checked=\"checked\" />
              ";
                } else {
                    // line 69
                    echo "   
              <input type=\"checkbox\" name=\"selected[]\" value=\"";
                    // line 70
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "blog_id", [], "any", false, false, false, 70);
                    echo "\" />
              ";
                }
                // line 71
                echo " </td>
            <td>";
                // line 72
                echo twig_get_attribute($this->env, $this->source, $context["blog"], "title", [], "any", false, false, false, 72);
                echo "</td>
            <td>";
                // line 73
                echo twig_get_attribute($this->env, $this->source, $context["blog"], "date_added", [], "any", false, false, false, 73);
                echo "</td>

            <td class=\"text-right\">";
                // line 75
                echo twig_get_attribute($this->env, $this->source, $context["blog"], "comment_total", [], "any", false, false, false, 75);
                echo "</td>
            <td class=\"text-right\">";
                // line 76
                echo twig_get_attribute($this->env, $this->source, $context["blog"], "count_read", [], "any", false, false, false, 76);
                echo "</td>
            <td class=\"text-right\">";
                // line 77
                echo twig_get_attribute($this->env, $this->source, $context["blog"], "sort_order", [], "any", false, false, false, 77);
                echo "</td>
            <td class=\"text-right\">
            ";
                // line 79
                if (twig_get_attribute($this->env, $this->source, $context["blog"], "status", [], "any", false, false, false, 79)) {
                    echo " 
            <span class=\"label label-success\" style=\"font-size:100%;\">";
                    // line 80
                    echo ($context["text_enabled"] ?? null);
                    echo "</span>
            ";
                } else {
                    // line 81
                    echo "  
            <span class=\"label label-danger\" style=\"font-size:100%;\">";
                    // line 82
                    echo ($context["text_disabled"] ?? null);
                    echo "</span>
            ";
                }
                // line 83
                echo " 
            </td>
            <td class=\"text-right\"><a href=\"";
                // line 85
                echo twig_get_attribute($this->env, $this->source, $context["blog"], "edit", [], "any", false, false, false, 85);
                echo "\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_edit"] ?? null);
                echo "\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i></a></td>
          </tr>
           ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['blog'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 88
            echo "           ";
        } else {
            echo "   
          <tr>
            <td class=\"text-center\" colspan=\"6\">";
            // line 90
            echo ($context["text_no_results"] ?? null);
            echo "</td>
          </tr>
           ";
        }
        // line 93
        echo "        </tbody>
      </table>
      </div>
\t\t
    </form>
    <div class=\"row\">
     <div class=\"col-sm-6 text-left\">";
        // line 99
        echo ($context["pagination"] ?? null);
        echo "</div>
     <div class=\"col-sm-6 text-right\">";
        // line 100
        echo ($context["results"] ?? null);
        echo "</div>
    </div>
    </div>
    </div>
  </div>
</div>
";
        // line 106
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "extension/blog/blog_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  349 => 106,  340 => 100,  336 => 99,  328 => 93,  322 => 90,  316 => 88,  305 => 85,  301 => 83,  296 => 82,  293 => 81,  288 => 80,  284 => 79,  279 => 77,  275 => 76,  271 => 75,  266 => 73,  262 => 72,  259 => 71,  254 => 70,  251 => 69,  246 => 68,  242 => 67,  235 => 65,  231 => 64,  224 => 60,  220 => 59,  217 => 58,  210 => 56,  207 => 55,  198 => 54,  194 => 53,  190 => 52,  186 => 51,  183 => 50,  176 => 49,  173 => 48,  164 => 47,  160 => 46,  155 => 43,  148 => 42,  145 => 41,  136 => 40,  132 => 39,  122 => 32,  116 => 29,  111 => 26,  104 => 23,  100 => 22,  97 => 21,  90 => 18,  86 => 17,  79 => 12,  69 => 11,  63 => 10,  58 => 8,  51 => 6,  45 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/blog/blog_list.twig", "");
    }
}
