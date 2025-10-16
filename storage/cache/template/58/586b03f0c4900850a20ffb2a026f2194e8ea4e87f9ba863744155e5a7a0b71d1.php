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

/* extension/module/mmos_attachmanager_include.twig */
class __TwigTemplate_a10118333eda8278eec292ea278c0ce0f2467352f3590e80771b75d7792dc037 extends \Twig\Template
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
        echo "<div class=\"tab-pane\" id=\"tab-attach-document\">
    <ul class=\"nav nav-tabs\" id=\"attach-document\">  
        <li><a href=\"#internal\" data-toggle=\"tab\">";
        // line 3
        echo ($context["tab_attach_internal"] ?? null);
        echo "</a></li>
        ";
        // line 4
        if ((twig_get_attribute($this->env, $this->source, ($context["attach_info_config"] ?? null), "extendlink", [], "any", false, false, false, 4) == "1")) {
            echo "  <li><a href=\"#external\" data-toggle=\"tab\">";
            echo ($context["tab_attach_external"] ?? null);
            echo "</a></li> ";
        }
        echo " 

        <div class=\"pull-right\">
            <a class=\"btn btn-success btn-xs\" href=\"index.php?route=extension/module/mmos_attachmanager&user_token=";
        // line 7
        echo ($context["user_token"] ?? null);
        echo "\" target=\"_blank\">";
        echo ($context["button_config_attachments"] ?? null);
        echo "</a>
        </div>
    </ul>
    <div class=\"tab-content\"> 
        <div class=\"tab-pane\" id=\"internal\">  
            <div class=\"table-responsive\">
                <table id=\"attach-internal\" class=\"table table-striped table-bordered table-hover\">
                    <thead>
                        <tr>
                            <td class=\"col-sm-2 col-md-1 text-center\">";
        // line 16
        echo ($context["text_attach_file_product_thumb"] ?? null);
        echo "</td>
                            <td class=\"text-left col-sm-6 col-md-9\">";
        // line 17
        echo ($context["text_attach_file_product_name"] ?? null);
        echo "</td>
                            <td class=\"text-left col-sm-2 col-md-1 text-center\"><i class=\"fa fa-lock\" title=\"";
        // line 18
        echo ($context["text_attach_file_product_login"] ?? null);
        echo "\"></i> </td>
                            <td class=\"text-left col-sm-2 col-md-1 text-center\">";
        // line 19
        echo ($context["text_attach_file_product_count"] ?? null);
        echo "</td>
\t\t\t\t\t\t\t<td class=\"text-left col-sm-2 col-md-1 text-center\">";
        // line 20
        echo "Sort Order";
        echo "</td>
                            <td></td>
                        </tr>            
                    </thead>  
                    <tbody>
                        ";
        // line 25
        $context["attach_row"] = 0;
        // line 26
        echo "                        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["product_attachs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["product_attach"]) {
            echo " 
                        <tr id=\"attach-row";
            // line 27
            echo ($context["attach_row"] ?? null);
            echo "\">
                            <td class=\"text-center\">
\t\t\t\t\t\t\t<input type=\"hidden\" name=\"product_attach[";
            // line 29
            echo ($context["attach_row"] ?? null);
            echo "][filename]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product_attach"], "filename", [], "any", false, false, false, 29);
            echo "\" id=\"input-attach";
            echo ($context["attach_row"] ?? null);
            echo "\"/>
\t\t\t\t\t\t\t<input type=\"hidden\" name=\"product_attach[";
            // line 30
            echo ($context["attach_row"] ?? null);
            echo "][product_attach_file_id]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product_attach"], "product_attach_file_id", [], "any", false, false, false, 30);
            echo "\"  >
\t\t\t\t\t\t\t<a href=\"\" id=\"thumb-acctach";
            // line 31
            echo ($context["attach_row"] ?? null);
            echo "\" data-toggle=\"attachmanager\" class=\"img-thumbnail\"><img src=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product_attach"], "thumb", [], "any", false, false, false, 31);
            echo "\" alt=\"\" title=\"\" data-placeholder=\"";
            echo ($context["no_image"] ?? null);
            echo "\" /></a>
\t\t\t\t\t\t\t</td>
                            <td class=\"text-center\"><div class=\"input-group\">
                                    <input type=\"text\" name=\"product_attach[";
            // line 34
            echo ($context["attach_row"] ?? null);
            echo "][mask]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product_attach"], "mask", [], "any", false, false, false, 34);
            echo "\" placeholder=\"";
            echo ($context["text_attach_file_product_name"] ?? null);
            echo "\" class=\"form-control mask\" />
                                    <span class=\"input-group-btn\"><button class=\"btn btn-default\" type=\"button\" disabled>";
            // line 35
            echo twig_get_attribute($this->env, $this->source, $context["product_attach"], "ext", [], "any", false, false, false, 35);
            echo "</button></span></div></td>
                            <td class=\"text-center\"><input type=\"checkbox\" name=\"product_attach[";
            // line 36
            echo ($context["attach_row"] ?? null);
            echo "][login_required]\" value=\"1\" class=\"form-control\"";
            echo (((twig_get_attribute($this->env, $this->source, $context["product_attach"], "login_required", [], "any", false, false, false, 36) == 1)) ? ("checked") : (""));
            echo "/></td>
                            <td class=\"text-center\">";
            // line 37
            echo twig_get_attribute($this->env, $this->source, $context["product_attach"], "download", [], "any", false, false, false, 37);
            echo "
\t\t\t\t\t\t\t<input type=\"hidden\" name=\"product_attach[";
            // line 38
            echo ($context["attach_row"] ?? null);
            echo "][download]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product_attach"], "download", [], "any", false, false, false, 38);
            echo "\"/>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td class=\"text-center\"><input type=\"text\" name=\"product_attach[";
            // line 40
            echo ($context["attach_row"] ?? null);
            echo "][sort_order]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product_attach"], "sort_order", [], "any", false, false, false, 40);
            echo "\" class=\"form-control\"/></td>
                            <td class=\"text-center\"><button type=\"button\" onclick=\"\$('#attach-row";
            // line 41
            echo ($context["attach_row"] ?? null);
            echo "').remove();\" data-toggle=\"tooltip\" title=\"";
            echo ($context["button_remove"] ?? null);
            echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>
                        </tr>
                        ";
            // line 43
            $context["attach_row"] = (($context["attach_row"] ?? null) + 1);
            echo " 
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product_attach'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        echo " 
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan=\"6\" class=\"text-center\">";
        // line 48
        echo ($context["drapdrop"] ?? null);
        echo "</td>
                        </tr>
                        <tr>
                            <td colspan=\"5\"></td>
                            <td class=\"text-left\"><button type=\"button\" onclick=\"addattachfile();\" data-toggle=\"tooltip\" title=\"";
        // line 52
        echo ($context["button_add_attach_file_product"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus-circle\"></i></button></td>
                        </tr>
                    </tfoot>



                </table>
            </div> 
        </div>
        <div class=\"tab-pane\" id=\"external\">  
            <div class=\"table-responsive\">
                <table id=\"attach-external\" class=\"table table-striped table-bordered table-hover\">
                    <thead>
                        <tr>
                            <td class=\"text-left\">";
        // line 66
        echo ($context["text_attach_extend_link_name"] ?? null);
        echo "</td>
                            <td class=\"text-left\">";
        // line 67
        echo ($context["text_attach_extend_link_download"] ?? null);
        echo "</td>
                            <td class=\"text-left\">";
        // line 68
        echo ($context["text_attach_file_product_login"] ?? null);
        echo "</td>
                            <td></td>
                        </tr>            
                    </thead>  
                    <tbody>
                        ";
        // line 73
        $context["attach_exten_link"] = 0;
        // line 74
        echo "                        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["exten_links"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["exten_link"]) {
            echo " 
                        <tr id=\"attach-exten-row";
            // line 75
            echo ($context["attach_exten_link"] ?? null);
            echo "\">
                            <td class=\"text-left\"><input type=\"text\" name=\"exten_link[";
            // line 76
            echo ($context["attach_exten_link"] ?? null);
            echo "][link_name]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["exten_link"], "link_name", [], "any", false, false, false, 76);
            echo "\" placeholder=\"";
            echo ($context["text_attach_extend_link_name"] ?? null);
            echo "\" class=\"form-control\" /></td>
                            <td class=\"text-left\"><input type=\"text\" name=\"exten_link[";
            // line 77
            echo ($context["attach_exten_link"] ?? null);
            echo "][link_download]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["exten_link"], "link_download", [], "any", false, false, false, 77);
            echo "\" placeholder=\"";
            echo ($context["text_attach_extend_link_download"] ?? null);
            echo "\" class=\"form-control\" /></td>
                            <td class=\"text-center\"><input type=\"checkbox\" name=\"exten_link[";
            // line 78
            echo ($context["attach_exten_link"] ?? null);
            echo "][login_required]\" value=\"1\" class=\"form-control\"";
            echo (((twig_get_attribute($this->env, $this->source, $context["exten_link"], "login_required", [], "any", false, false, false, 78) && (twig_get_attribute($this->env, $this->source, $context["exten_link"], "login_required", [], "any", false, false, false, 78) == 1))) ? ("checked") : (""));
            echo "/></td>
                            <td class=\"text-left\"><button type=\"button\" onclick=\"\$('#attach-exten-row";
            // line 79
            echo ($context["attach_exten_link"] ?? null);
            echo "').remove();\" data-toggle=\"tooltip\" title=\"";
            echo ($context["button_remove"] ?? null);
            echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>
                        </tr>
                        ";
            // line 81
            $context["attach_exten_link"] = (($context["attach_exten_link"] ?? null) + 1);
            echo " 
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['exten_link'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 82
        echo " 
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan=\"3\"></td>
                            <td class=\"text-left\"><button type=\"button\" onclick=\"addattachlink();\" data-toggle=\"tooltip\" title=\"";
        // line 87
        echo ($context["button_add_attach_exten_link"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus-circle\"></i></button></td>
                        </tr>
                    </tfoot>
                </table>
            </div> 
        </div>
    </div> 
</div> 
<script type=\"text/javascript\">
    \$('#attach-document a:first').tab('show');
    var attach_row = '";
        // line 97
        echo ($context["attach_row"] ?? null);
        echo "';

    function addattachfile() {
        html = '<tr id=\"attach-row' + attach_row + '\">';
        html += '<td class=\"text-left\"><a href=\"\" id=\"thumb-acctach' + attach_row + '\" data-toggle=\"attachmanager\" class=\"img-thumbnail\"><img src=\"";
        // line 101
        echo ($context["no_image"] ?? null);
        echo "\" alt=\"\" title=\"\" data-placeholder=\"";
        echo ($context["no_image"] ?? null);
        echo "\" /></a><input type=\"hidden\" name=\"product_attach[' + attach_row + '][filename]\" value=\"\"id=\"input-attach' + attach_row + '\"/></td>';
        html += '<td class=\"text-left\"><div class=\"input-group\"><input type=\"text\" name=\"product_attach[' + attach_row + '][mask]\" value=\"\" placeholder=\"";
        // line 102
        echo ($context["text_attach_file_product_name"] ?? null);
        echo "\" class=\"form-control mask\" /><span class=\"input-group-btn\"><button class=\"btn btn-default\" type=\"button\" disabled>ext</button></span></div></td>';
        html += '<td class=\"text-center\"><input type=\"checkbox\" name=\"product_attach[' + attach_row + '][login_required]\" value=\"1\" class=\"form-control\"/></td>';
        html += '<td class=\"text-left\"></td>';
\t\thtml += '<td class=\"text-center\"><input type=\"text\" name=\"product_attach[' + attach_row + '][sort_order]\" value=\"0\" class=\"form-control\"/></td>';
        html += '<td class=\"text-left\"><button type=\"button\" onclick=\"\$(\\'#attach-row' + attach_row + '\\').remove();\" data-toggle=\"tooltip\" title=\"";
        // line 106
        echo ($context["button_remove"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>';
        html += '</tr>';
        \$('#attach-internal tbody').append(html);

        \$(\"#thumb-acctach\" + attach_row + \"\").trigger(\"click\");

        \$(\"#attach-row\" + attach_row + \" td div #button-object\").trigger(\"click\");

        attach_row++;
    }
  

    var attach_exten_link = '";
        // line 118
        echo ($context["attach_exten_link"] ?? null);
        echo "';
    function addattachlink() {
        html = '<tr id=\"attach-exten-row' + attach_exten_link + '\">';
        html += '<td class=\"text-left\"><input type=\"text\" name=\"exten_link[' + attach_exten_link + '][link_name]\" value=\"\" placeholder=\"";
        // line 121
        echo ($context["text_attach_extend_link_name"] ?? null);
        echo "\" class=\"form-control\" /></td>';
        html += '<td class=\"text-left\"><input type=\"text\" name=\"exten_link[' + attach_exten_link + '][link_download]\" value=\"\" placeholder=\"";
        // line 122
        echo ($context["text_attach_extend_link_download"] ?? null);
        echo "\" class=\"form-control\" /></td>';
        html += '<td class=\"text-center\"><input type=\"checkbox\" name=\"exten_link[' + attach_exten_link + '][login_required]\" value=\"1\" class=\"form-control\" /></td>';
        html += '<td class=\"text-left\"><button type=\"button\" onclick=\"\$(\\'#attach-exten-row' + attach_exten_link + '\\').remove();\" data-toggle=\"tooltip\" title=\"";
        // line 124
        echo ($context["button_remove"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>';
        html += '</tr>';
        \$('#attach-external tbody').append(html);
        attach_exten_link++;
    }
</script>";
    }

    public function getTemplateName()
    {
        return "extension/module/mmos_attachmanager_include.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  347 => 124,  342 => 122,  338 => 121,  332 => 118,  317 => 106,  310 => 102,  304 => 101,  297 => 97,  284 => 87,  277 => 82,  269 => 81,  262 => 79,  256 => 78,  248 => 77,  240 => 76,  236 => 75,  229 => 74,  227 => 73,  219 => 68,  215 => 67,  211 => 66,  194 => 52,  187 => 48,  181 => 44,  173 => 43,  166 => 41,  160 => 40,  153 => 38,  149 => 37,  143 => 36,  139 => 35,  131 => 34,  121 => 31,  115 => 30,  107 => 29,  102 => 27,  95 => 26,  93 => 25,  85 => 20,  81 => 19,  77 => 18,  73 => 17,  69 => 16,  55 => 7,  45 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/module/mmos_attachmanager_include.twig", "");
    }
}
