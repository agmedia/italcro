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

/* extension/basel/panel_tabs/one-click-installer.twig */
class __TwigTemplate_e7c068aecdb3d4775c582ade81c5673229b3ec05026b81b0d5e8e778b42ae827 extends \Twig\Template
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
        echo "<legend>One Click Installer</legend>
";
        // line 2
        if (((($context["theme_default_directory"] ?? null) == "basel") && (twig_length_filter($this->env, ($context["stores"] ?? null)) <= 1))) {
            // line 3
            echo "    ";
            if (array_key_exists("demos", $context)) {
                // line 4
                echo "    <div class=\"form-group\">
        <label class=\"col-sm-2 control-label\">Select Store</label>
        <div class=\"col-sm-10\">
            <select class=\"form-control\" id=\"demo-store-selector\">
\t\t\t<option value=\"0\">---- Select Store To Import ----</option>
            ";
                // line 9
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["demos"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["demo"]) {
                    // line 10
                    echo "                <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["demo"], "demo_id", [], "any", false, false, false, 10);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["demo"], "name", [], "any", false, false, false, 10);
                    echo "</option>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['demo'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 12
                echo "            </select>
                        
            <div class=\"demo-preview\" style=\"display:none;\"><br />
            <img id=\"demo-preview-img\" src=\"model/extension/basel/demo_stores/1/preview.jpg\" /><br /><br />
            
<div class=\"one-click-info\" style=\"margin-bottom:20px;\">
<p>By using the One click installer tool, you can easily configure your modules and layouts as our demo stores.</p>
<p>Please note that your existing layouts and module configurations will be lost when importing a demo store.</p>
<p>Sample products, categories and blog posts will be added. Existing products, categories and blog posts will not be affected.</p>
<p>* Stores in the list marked with * will add rules to the Thame Panel's Custom CSS</p>
</div>
\t\t\t<a id=\"demo-preview-btn\" class=\"btn btn-primary\" onclick=\"importDemo(1);\">Install this demo store</a>
            </div>
        </div>                   
    </div>
    ";
            }
        }
        // line 29
        echo "
";
        // line 30
        if ((($context["theme_default_directory"] ?? null) != "basel")) {
            // line 31
            echo "<p>Please enable the theme before using the one click installer</p>
";
        }
        // line 33
        echo "
";
        // line 34
        if ((twig_length_filter($this->env, ($context["stores"] ?? null)) > 1)) {
            // line 35
            echo "<p>Since the One click installer changes layouts and modules, its not multi-store ready</p>
";
        }
        // line 37
        echo "
<script type=\"text/javascript\">
\$('select[id=\\'demo-store-selector\\']').on('change', function () {
\t
\tif (\$(this).val() == '0') {
\t\t\$('.demo-preview').css('display', 'none');
\t} else {
\t\t\$('.demo-preview').css('display', 'block');
\t}
\t
    \$('#demo-preview-img').attr('src','model/extension/basel/demo_stores/' + \$(this).val() + '/preview.jpg');
\t\$('#demo-preview-btn').attr('onclick','importDemo(' + \$(this).val() + ')');
});
var importDemo = function(store_id) {
\timporturl = '";
        // line 51
        echo ($context["demo_import_url"] ?? null);
        echo "'.replace(/\\&amp;/g,'&');
\tconfirm('";
        // line 52
        echo ($context["text_confirm"] ?? null);
        echo "') ? location.href=importurl + store_id : false;
}
</script>";
    }

    public function getTemplateName()
    {
        return "extension/basel/panel_tabs/one-click-installer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  124 => 52,  120 => 51,  104 => 37,  100 => 35,  98 => 34,  95 => 33,  91 => 31,  89 => 30,  86 => 29,  67 => 12,  56 => 10,  52 => 9,  45 => 4,  42 => 3,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/basel/panel_tabs/one-click-installer.twig", "/Users/tomek/Herd/reprograv/upload/admin/view/template/extension/basel/panel_tabs/one-click-installer.twig");
    }
}
