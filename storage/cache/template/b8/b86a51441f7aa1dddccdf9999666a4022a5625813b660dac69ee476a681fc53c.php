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

/* extension/basel/panel_tabs/category-pages.twig */
class __TwigTemplate_2f71782e6a96ace4a13a00cf08391fde38e73d0b26ad22d3182a8257df011a50 extends \Twig\Template
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
        echo "<legend>Category Pages</legend>

<legend class=\"sub\">Category Description</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Enable/Disable to include the category thumb in the category description.\">Category thumb</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][category_thumb_status]\" value=\"0\" ";
        // line 7
        if ((($context["category_thumb_status"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][category_thumb_status]\" value=\"1\" ";
        // line 8
        if ((($context["category_thumb_status"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<legend class=\"sub\">Sub Categories On Category Pages</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Show sub categories</label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][category_subs_status]\" value=\"0\" ";
        // line 16
        if ((($context["category_subs_status"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][category_subs_status]\" value=\"1\" ";
        // line 17
        if ((($context["category_subs_status"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\">Sub categories per row</label>
<div class=\"col-sm-10\">
    <select name=\"settings[basel][basel_subs_grid]\" class=\"form-control\">
        <option value=\"2\"";
        // line 25
        if ((($context["basel_subs_grid"] ?? null) == "2")) {
            echo " selected=\"selected\"";
        }
        echo ">2</option>
        <option value=\"3\"";
        // line 26
        if ((($context["basel_subs_grid"] ?? null) == "3")) {
            echo " selected=\"selected\"";
        }
        echo ">3</option>
        <option value=\"4\"";
        // line 27
        if ((($context["basel_subs_grid"] ?? null) == "4")) {
            echo " selected=\"selected\"";
        }
        echo ">4</option>
        <option value=\"5\"";
        // line 28
        if ((($context["basel_subs_grid"] ?? null) == "5")) {
            echo " selected=\"selected\"";
        }
        echo ">5</option>
        <option value=\"6\"";
        // line 29
        if ((($context["basel_subs_grid"] ?? null) == "6")) {
            echo " selected=\"selected\"";
        }
        echo ">6</option>
    </select>
</div>
</div>

<legend class=\"sub\">Product Listings</legend>
<div class=\"form-group\">
<label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Number of products per row will also apply on search result pages, specials page and manufacturer pages\">Products per row</span></label>
<div class=\"col-sm-10\">
    <select name=\"settings[basel][basel_prod_grid]\" class=\"form-control\">
        <option value=\"2\"";
        // line 39
        if ((($context["basel_prod_grid"] ?? null) == "2")) {
            echo " selected=\"selected\"";
        }
        echo ">2</option>
        <option value=\"3\"";
        // line 40
        if ((($context["basel_prod_grid"] ?? null) == "3")) {
            echo " selected=\"selected\"";
        }
        echo ">3</option>
        <option value=\"4\"";
        // line 41
        if ((($context["basel_prod_grid"] ?? null) == "4")) {
            echo " selected=\"selected\"";
        }
        echo ">4</option>
        <option value=\"5\"";
        // line 42
        if ((($context["basel_prod_grid"] ?? null) == "5")) {
            echo " selected=\"selected\"";
        }
        echo ">5</option>
    </select>
</div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Products per page</label>
    <div class=\"col-sm-10\">
    <input class=\"form-control\" name=\"settings[theme_default][theme_default_product_limit]\" value=\"";
        // line 50
        echo ((($context["theme_default_product_limit"] ?? null)) ? (($context["theme_default_product_limit"] ?? null)) : ("12"));
        echo "\" />
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"In the list view, short description character limit (categories, special etc)\">List Description Limit</span></label>
    <div class=\"col-sm-10\">
    <input class=\"form-control\" name=\"settings[theme_default][theme_default_product_description_length]\" value=\"";
        // line 57
        echo ((($context["theme_default_product_description_length"] ?? null)) ? (($context["theme_default_product_description_length"] ?? null)) : ("190"));
        echo "\" />
    </div>                   
</div>";
    }

    public function getTemplateName()
    {
        return "extension/basel/panel_tabs/category-pages.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  163 => 57,  153 => 50,  140 => 42,  134 => 41,  128 => 40,  122 => 39,  107 => 29,  101 => 28,  95 => 27,  89 => 26,  83 => 25,  70 => 17,  64 => 16,  51 => 8,  45 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/basel/panel_tabs/category-pages.twig", "/Users/tomek/Herd/reprograv/upload/admin/view/template/extension/basel/panel_tabs/category-pages.twig");
    }
}
