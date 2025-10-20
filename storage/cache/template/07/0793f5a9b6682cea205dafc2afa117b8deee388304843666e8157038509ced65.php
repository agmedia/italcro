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

/* default/template/mmosolution/mmos_attachmanager.twig */
class __TwigTemplate_cda3a3eac6e6ff2bfdd142541fd459a2122cddc2f9ced6ee5a25b303543ada00 extends \Twig\Template
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
        if ((($context["product_attachs"] ?? null) || ($context["exten_links"] ?? null))) {
            // line 2
            echo "<style>
    #tab-attach-document .table>tbody>tr>td, #tab-attach-document  .table>tbody>tr>th, .table>tfoot>tr>td,  #tab-attach-document  .table>tfoot>tr>th,  #tab-attach-document  .table>thead>tr>td,  #tab-attach-document  .table>thead>tr>th {

        vertical-align:  middle !important;


    }
    #tab-attach-document .img-responsive {
        margin: 0 auto;
    }
    #tab-attach-document small {
       color: #CAC7C7;
       vertical-align: bottom;
    }
</style>
<div class=\"";
            // line 17
            echo ($context["class_panel"] ?? null);
            echo "\" id=\"tab-attach-document\">
    ";
            // line 18
            if (($context["product_attachs"] ?? null)) {
                // line 19
                echo "    <table class=\"table table-striped table-bordered\">
       
        <tbody>
            ";
                // line 22
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["product_attachs"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["product_attach"]) {
                    // line 23
                    echo "            <tr>
                <td class=\"text-center col-md-1 col-sm-2\"><img class=\"img-rounded img-responsive\" src=\"";
                    // line 24
                    echo twig_get_attribute($this->env, $this->source, $context["product_attach"], "thumb", [], "any", false, false, false, 24);
                    echo "\" /></td>
                <td class=\"text-left col-md-11 col-sm-10\">
                    <a ";
                    // line 26
                    if ((twig_get_attribute($this->env, $this->source, $context["product_attach"], "href", [], "any", false, false, false, 26) != "")) {
                        echo " href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["product_attach"], "href", [], "any", false, false, false, 26);
                        echo "\" ";
                    } else {
                        echo " class=\"btn-link\" onclick=\"alert('";
                        echo ($context["attach_error_login"] ?? null);
                        echo "')\" ";
                    }
                    echo " title=\"";
                    echo ($context["attach_button_download"] ?? null);
                    echo "\" target=\"_blank\"><i class=\"fa fa-cloud-download\"></i> ";
                    echo twig_get_attribute($this->env, $this->source, $context["product_attach"], "name", [], "any", false, false, false, 26);
                    echo "</a>
                    <span class=\"clearfix\">
                    <small><i class=\"fa fa-info-circle\"></i> <span class=\"hidden-xs\">";
                    // line 28
                    echo ($context["attach_filesize"] ?? null);
                    echo "</span> ";
                    echo twig_get_attribute($this->env, $this->source, $context["product_attach"], "size", [], "any", false, false, false, 28);
                    echo "</small>
                   ";
                    // line 29
                    if (($context["show_download"] ?? null)) {
                        // line 30
                        echo "\t\t\t\t\t\t<small><i class=\"fa fa-hdd-o\"></i> <span class=\"hidden-xs\">";
                        echo ($context["attach_downloaded"] ?? null);
                        echo ": ";
                        echo "</span> ";
                        echo twig_get_attribute($this->env, $this->source, $context["product_attach"], "download", [], "any", false, false, false, 30);
                        echo "</small>
\t\t\t\t\t";
                    }
                    // line 32
                    echo "                   </span>
                    </td>
            </tr>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product_attach'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 36
                echo "        </tbody>
    </table>
    ";
            }
            // line 39
            echo "    ";
            if (($context["exten_links"] ?? null)) {
                // line 40
                echo "    <span><strong>";
                echo ($context["external_link"] ?? null);
                echo "</strong></span>
    <table class=\"table table-striped table-bordered\">
        
        <tbody>
            ";
                // line 44
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["exten_links"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["exten_link"]) {
                    // line 45
                    echo "            <tr>
                <td class=\"text-center col-md-1 col-sm-2\"><img class=\"img-rounded img-responsive\" src=\"";
                    // line 46
                    echo twig_get_attribute($this->env, $this->source, $context["exten_link"], "thumb", [], "any", false, false, false, 46);
                    echo "\" /></td>
                <td class=\"text-left col-md-11 col-sm-10\" style=\"vertical-align: middle;\"><a ";
                    // line 47
                    if ((twig_get_attribute($this->env, $this->source, $context["exten_link"], "href", [], "any", false, false, false, 47) != "")) {
                        echo " href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["exten_link"], "href", [], "any", false, false, false, 47);
                        echo "\" target=\"_blank\" ";
                    } else {
                        echo " onclick=\"alert('";
                        echo ($context["attach_error_login"] ?? null);
                        echo "')\" ";
                    }
                    echo " title=\"";
                    echo ($context["attach_button_download"] ?? null);
                    echo "\"><i class=\"fa fa-cloud-download\"></i> ";
                    echo twig_get_attribute($this->env, $this->source, $context["exten_link"], "name", [], "any", false, false, false, 47);
                    echo "</a></td>
            </tr>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['exten_link'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 50
                echo "        </tbody>
    </table>
    ";
            }
            // line 53
            echo "</div>
";
        }
    }

    public function getTemplateName()
    {
        return "default/template/mmosolution/mmos_attachmanager.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  175 => 53,  170 => 50,  149 => 47,  145 => 46,  142 => 45,  138 => 44,  130 => 40,  127 => 39,  122 => 36,  113 => 32,  104 => 30,  102 => 29,  96 => 28,  79 => 26,  74 => 24,  71 => 23,  67 => 22,  62 => 19,  60 => 18,  56 => 17,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/mmosolution/mmos_attachmanager.twig", "");
    }
}
