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

/* extension/basel/panel_tabs/contact-page.twig */
class __TwigTemplate_7a8021919fc7bf4767cc5af28431587337d835755c2214f716a65b16ce3e6d43 extends \Twig\Template
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
        echo "<legend>Contact Page</legend>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Map layout</label>
    <div class=\"col-sm-10\">
    <select name=\"settings[basel][basel_map_style]\" class=\"form-control\">
    <option value=\"0\"";
        // line 7
        if ((($context["basel_map_style"] ?? null) == "0")) {
            echo " selected=\"selected\"";
        }
        echo ">Disabled</option>
    <option value=\"full_width\"";
        // line 8
        if ((($context["basel_map_style"] ?? null) == "full_width")) {
            echo " selected=\"selected\"";
        }
        echo ">Full width</option>
    <option value=\"inline\"";
        // line 9
        if ((($context["basel_map_style"] ?? null) == "inline")) {
            echo " selected=\"selected\"";
        }
        echo ">Boxed</option>
\t</select>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Location Latitude</label>
    <div class=\"col-sm-10\">
    <input class=\"form-control\" name=\"settings[basel][basel_map_lat]\" value=\"";
        // line 17
        echo ((($context["basel_map_lat"] ?? null)) ? (($context["basel_map_lat"] ?? null)) : (""));
        echo "\" />
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Location Longitude</label>
    <div class=\"col-sm-10\">
    <input class=\"form-control\" name=\"settings[basel][basel_map_lon]\" value=\"";
        // line 24
        echo ((($context["basel_map_lon"] ?? null)) ? (($context["basel_map_lon"] ?? null)) : (""));
        echo "\" />
    </div>                   
</div>


<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Map API key</label>
    <div class=\"col-sm-10\">
    <input class=\"form-control\" name=\"settings[basel][basel_map_api]\" value=\"";
        // line 32
        echo ((($context["basel_map_api"] ?? null)) ? (($context["basel_map_api"] ?? null)) : (""));
        echo "\" />
    </div>                   
</div>

<div class=\"col-sm-offset-2\">
<div class=\"bs-callout bs-callout-info bs-callout-sm\">
<h4>How to find your Latitude & Longitude</h4>
<p>1. Navigate to your location at <a href=\"http://maps.google.com/\" target=\"_blank\">http://maps.google.com/</a></p>
<p>2. Right click on your location, and select What's Here?</p>
<p style=\"margin-bottom:20px;\">3. You will see a box at the bottom of the map with your address along with it's latitude/longitudeb</p>

<h4>How to get the Map API key?</h4>
<p>Please follow the instructions here <a href=\"https://developers.google.com/maps/documentation/javascript/get-api-key\" target=\"_blank\">https://developers.google.com/maps/documentation/javascript/get-api-key</a></p>
</div>
</div>";
    }

    public function getTemplateName()
    {
        return "extension/basel/panel_tabs/contact-page.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 32,  80 => 24,  70 => 17,  57 => 9,  51 => 8,  45 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/basel/panel_tabs/contact-page.twig", "/Users/tomek/Herd/reprograv/upload/admin/view/template/extension/basel/panel_tabs/contact-page.twig");
    }
}
