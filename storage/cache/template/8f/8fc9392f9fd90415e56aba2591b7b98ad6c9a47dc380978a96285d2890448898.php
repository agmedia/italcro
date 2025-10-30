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

/* extension/hbseo/oc3/hb_aigen_items.twig */
class __TwigTemplate_f5b07b39e44cd3246356f62d16569cdd23026f59e4eed7aff10bb7f7680969a6 extends \Twig\Template
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
        echo "<div class=\"table-responsive\">
    <table class=\"table table-bordered table-condensed table-hover table-striped\">
        <thead>
            <tr>
                <td width=\"1\" style=\"text-align: center;\"><input type=\"checkbox\" onclick=\"\$('input[name*=\\'selected\\']').prop('checked', this.checked);\" /></td>
                <td class=\"text-center\">";
        // line 6
        echo ($context["column_id"] ?? null);
        echo "</td>
                <td class=\"text-left\">";
        // line 7
        echo ($context["column_name"] ?? null);
        echo "</td>
                ";
        // line 8
        if ((($context["type"] ?? null) == "product")) {
            echo "<td class=\"text-left\">";
            echo ($context["column_model"] ?? null);
            echo "</td>";
        }
        // line 9
        echo "                <td class=\"text-left\">";
        echo ($context["column_meta_title"] ?? null);
        echo "</td>
                <td class=\"text-left\">";
        // line 10
        echo ($context["column_meta_description"] ?? null);
        echo "</td>
                <td class=\"text-left\">";
        // line 11
        echo ($context["column_meta_keyword"] ?? null);
        echo "</td>
                <td class=\"text-right col-sm-2\">";
        // line 12
        echo ($context["column_action"] ?? null);
        echo "</td>                
            </tr>
        </thead>
        <tbody>
            ";
        // line 16
        if (($context["records"] ?? null)) {
            // line 17
            echo "                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["records"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["record"]) {
                // line 18
                echo "                    <tr>
                        <td style=\"text-align: center;\">
                            <input type=\"checkbox\" name=\"selected[]\" value=\"";
                // line 20
                echo twig_get_attribute($this->env, $this->source, $context["record"], "item_id", [], "any", false, false, false, 20);
                echo "\" />
                        </td>
                        <td class=\"text-center\"><a href=\"";
                // line 22
                echo twig_get_attribute($this->env, $this->source, $context["record"], "href", [], "any", false, false, false, 22);
                echo "\" target=\"_blank\">";
                echo twig_get_attribute($this->env, $this->source, $context["record"], "item_id", [], "any", false, false, false, 22);
                echo "</a></td>
                        <td class=\"text-left\">";
                // line 23
                echo twig_get_attribute($this->env, $this->source, $context["record"], "name", [], "any", false, false, false, 23);
                echo "</td>
                        ";
                // line 24
                if ((($context["type"] ?? null) == "product")) {
                    echo "<td class=\"text-left\">";
                    echo twig_get_attribute($this->env, $this->source, $context["record"], "model", [], "any", false, false, false, 24);
                    echo "</td>";
                }
                // line 25
                echo "                        <td class=\"text-left\">";
                echo twig_get_attribute($this->env, $this->source, $context["record"], "meta_title", [], "any", false, false, false, 25);
                echo "</td>
                        <td class=\"text-left\">";
                // line 26
                echo twig_get_attribute($this->env, $this->source, $context["record"], "meta_description", [], "any", false, false, false, 26);
                echo "</td>
                        <td class=\"text-left\">";
                // line 27
                echo twig_get_attribute($this->env, $this->source, $context["record"], "meta_keyword", [], "any", false, false, false, 27);
                echo "</td>
                        <td class=\"text-right\">
                            <a onclick=\"promptPreview('";
                // line 29
                echo ($context["type"] ?? null);
                echo "', '";
                echo twig_get_attribute($this->env, $this->source, $context["record"], "item_id", [], "any", false, false, false, 29);
                echo "', '";
                echo twig_get_attribute($this->env, $this->source, $context["record"], "language_id", [], "any", false, false, false, 29);
                echo "')\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_prompt_preview"] ?? null);
                echo "\" class=\"btn btn-primary\"><i class=\"fa fa-microphone\"></i></a>
                            <a href=\"";
                // line 30
                echo twig_get_attribute($this->env, $this->source, $context["record"], "edit", [], "any", false, false, false, 30);
                echo "\" target=\"_blank\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_edit"] ?? null);
                echo "\" class=\"btn btn-warning\"><i class=\"fa fa-pencil\"></i></a>
                            <a id=\"btn_generate_item_";
                // line 31
                echo ($context["type"] ?? null);
                echo "_";
                echo twig_get_attribute($this->env, $this->source, $context["record"], "item_id", [], "any", false, false, false, 31);
                echo "_";
                echo twig_get_attribute($this->env, $this->source, $context["record"], "language_id", [], "any", false, false, false, 31);
                echo "\" onclick=\"generateItem('";
                echo ($context["type"] ?? null);
                echo "', '";
                echo twig_get_attribute($this->env, $this->source, $context["record"], "item_id", [], "any", false, false, false, 31);
                echo "', '";
                echo twig_get_attribute($this->env, $this->source, $context["record"], "language_id", [], "any", false, false, false, 31);
                echo "')\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_generate"] ?? null);
                echo "\" class=\"btn btn-success\"><i class=\"fa fa-play-circle\"></i></a>
                        </td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['record'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 35
            echo "            ";
        } else {
            // line 36
            echo "                <tr>
                    <td class=\"text-center\" colspan=\"8\">";
            // line 37
            echo ($context["text_no_records"] ?? null);
            echo "</td>
                </tr>
            ";
        }
        // line 40
        echo "        </tbody>
    </table>
</div>

<div class=\"row\">
\t<div class=\"col-sm-6 text-left\">";
        // line 45
        echo ($context["pagination"] ?? null);
        echo "</div>
\t<div class=\"col-sm-6 text-right\">";
        // line 46
        echo ($context["results"] ?? null);
        echo "</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "extension/hbseo/oc3/hb_aigen_items.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  185 => 46,  181 => 45,  174 => 40,  168 => 37,  165 => 36,  162 => 35,  140 => 31,  134 => 30,  124 => 29,  119 => 27,  115 => 26,  110 => 25,  104 => 24,  100 => 23,  94 => 22,  89 => 20,  85 => 18,  80 => 17,  78 => 16,  71 => 12,  67 => 11,  63 => 10,  58 => 9,  52 => 8,  48 => 7,  44 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/hbseo/oc3/hb_aigen_items.twig", "");
    }
}
