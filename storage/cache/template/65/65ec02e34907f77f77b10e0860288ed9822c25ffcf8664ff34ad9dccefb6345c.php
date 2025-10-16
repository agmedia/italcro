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

/* extension/basel/panel_tabs/custom-javascript.twig */
class __TwigTemplate_8f5391df3fd7b18cf47aecc410000d742865523854d580bb02b7c5478420869c extends \Twig\Template
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
        echo "<legend>Custom Javascript</legend>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Custom Javascript Status</label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][basel_custom_js_status]\" class=\"custom-js-select\" value=\"0\" ";
        // line 6
        if ((($context["basel_custom_js_status"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][basel_custom_js_status]\" class=\"custom-js-select\" value=\"1\" ";
        // line 7
        if ((($context["basel_custom_js_status"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div id=\"custom_js_holder\"";
        // line 11
        if (($context["basel_custom_js_status"] ?? null)) {
            echo " style=\"display:block\"";
        } else {
            echo " style=\"display:none\"";
        }
        echo ">
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Javascript</label>
    <div class=\"col-sm-10\">
    <textarea name=\"settings[basel][basel_custom_js]\" class=\"form-control code\">";
        // line 15
        echo ((($context["basel_custom_js"] ?? null)) ? (($context["basel_custom_js"] ?? null)) : (""));
        echo "</textarea>
    </div>                   
</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "extension/basel/panel_tabs/custom-javascript.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  70 => 15,  59 => 11,  50 => 7,  44 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/basel/panel_tabs/custom-javascript.twig", "/Users/tomek/Herd/reprograv/upload/admin/view/template/extension/basel/panel_tabs/custom-javascript.twig");
    }
}
