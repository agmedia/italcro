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

/* extension/basel/panel_tabs/custom-css.twig */
class __TwigTemplate_990cffb9d39cf9a890f856fe93fc2413a2e2b6a4f4ecb9eda1b9f70fb487fbed extends \Twig\Template
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
        echo "<legend>Custom CSS</legend>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Custom CSS Status</label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][basel_custom_css_status]\" class=\"custom-css-select\" value=\"0\" ";
        // line 6
        if ((($context["basel_custom_css_status"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][basel_custom_css_status]\" class=\"custom-css-select\" value=\"1\" ";
        // line 7
        if ((($context["basel_custom_css_status"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div id=\"custom_css_holder\"";
        // line 11
        if (($context["basel_custom_css_status"] ?? null)) {
            echo " style=\"display:block\"";
        } else {
            echo " style=\"display:none\"";
        }
        echo ">
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">CSS</label>
    <div class=\"col-sm-10\">
    <textarea name=\"settings[basel][basel_custom_css]\" class=\"form-control code\">";
        // line 15
        echo ((($context["basel_custom_css"] ?? null)) ? (($context["basel_custom_css"] ?? null)) : (""));
        echo "</textarea>
    </div>                   
</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "extension/basel/panel_tabs/custom-css.twig";
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
        return new Source("", "extension/basel/panel_tabs/custom-css.twig", "/Users/tomek/Herd/reprograv/upload/admin/view/template/extension/basel/panel_tabs/custom-css.twig");
    }
}
