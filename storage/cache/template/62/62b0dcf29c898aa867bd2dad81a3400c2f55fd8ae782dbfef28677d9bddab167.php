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

/* extension/basel/panel_tabs/product-pages.twig */
class __TwigTemplate_e4a04083cb5f1b319a89036213b3f2ed5709bc5645ee64345da1d17c3db36a0f extends \Twig\Template
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
        echo "<legend>Product Pages</legend>

<legend class=\"sub\">Product Images</legend>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\">Images layout</label>
<div class=\"col-sm-10\">
    <select name=\"settings[basel][product_layout]\" class=\"form-control\">
        <option value=\"images-left\"";
        // line 9
        if ((($context["product_layout"] ?? null) == "images-left")) {
            echo " selected=\"selected\"";
        }
        echo ">Additional images left of main image</option>
        <option value=\"images-bottom\"";
        // line 10
        if ((($context["product_layout"] ?? null) == "images-bottom")) {
            echo " selected=\"selected\"";
        }
        echo ">Additional images below main image</option>
        <option value=\"full-width\"";
        // line 11
        if ((($context["product_layout"] ?? null) == "full-width")) {
            echo " selected=\"selected\"";
        }
        echo ">Stacked images - (Full width layout)</option>
    </select>
</div>                   
</div>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Zoom main image on hover</label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][basel_hover_zoom]\" value=\"0\" ";
        // line 18
        if ((($context["basel_hover_zoom"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][basel_hover_zoom]\" value=\"1\" ";
        // line 19
        if ((($context["basel_hover_zoom"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<legend class=\"sub\">Product Details</legend>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Show the product meta description among the product details\">View meta description</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][meta_description_status]\" value=\"0\" ";
        // line 28
        if ((($context["meta_description_status"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][meta_description_status]\" value=\"1\" ";
        // line 29
        if ((($context["meta_description_status"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Show a countdown until special prices expires. Please note that there is a separate setting to show countdown on product listings in the Shop tab\">Specials countdown</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][product_page_countdown]\" value=\"0\" ";
        // line 36
        if ((($context["product_page_countdown"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][product_page_countdown]\" value=\"1\" ";
        // line 37
        if ((($context["product_page_countdown"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\">Share buttons</label>
<div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][basel_share_btn]\" value=\"0\" ";
        // line 44
        if ((($context["basel_share_btn"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][basel_share_btn]\" value=\"1\" ";
        // line 45
        if ((($context["basel_share_btn"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                    
</div>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\">Sharing buttons style</label>
<div class=\"col-sm-10\">
    <select name=\"settings[basel][basel_sharing_style]\" class=\"form-control\">
        <option value=\"small\"";
        // line 53
        if ((($context["basel_sharing_style"] ?? null) == "small")) {
            echo " selected=\"selected\"";
        }
        echo ">Default (small)</option>
        <option value=\"large\"";
        // line 54
        if ((($context["basel_sharing_style"] ?? null) == "large")) {
            echo " selected=\"selected\"";
        }
        echo ">Large</option>
    </select>
</div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Enable/Disable price excluding tax on product pages and in list view\">View ex tax price</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][ex_tax_status]\" value=\"0\" ";
        // line 62
        if ((($context["ex_tax_status"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][ex_tax_status]\" value=\"1\" ";
        // line 63
        if ((($context["ex_tax_status"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Enable/Disable the price to be updated after selecting options and quantities\">Live price update</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][basel_price_update]\" value=\"0\" ";
        // line 70
        if ((($context["basel_price_update"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][basel_price_update]\" value=\"1\" ";
        // line 71
        if ((($context["basel_price_update"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<legend class=\"sub\">Product Information Tabs</legend>
<div class=\"form-group\">
<label class=\"col-sm-2 control-label\">Tabs layout</label>
<div class=\"col-sm-10\">
    <select name=\"settings[basel][full_width_tabs]\" class=\"form-control\">
        <option value=\"1\"";
        // line 80
        if ((($context["full_width_tabs"] ?? null) == "1")) {
            echo " selected=\"selected\"";
        }
        echo ">Full width with contrast background</option>
        <option value=\"0\"";
        // line 81
        if ((($context["full_width_tabs"] ?? null) == "0")) {
            echo " selected=\"selected\"";
        }
        echo ">Inline</option>
    </select>
</div>                   
</div>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\">Tabs Style</label>
<div class=\"col-sm-10\">
    <select name=\"settings[basel][product_tabs_style]\" class=\"form-control\">
    \t<option value=\"\"";
        // line 90
        if ((($context["product_tabs_style"] ?? null) == "")) {
            echo " selected=\"selected\"";
        }
        echo ">Default Style</option>
        <option value=\"nav-tabs-lg text-center\"";
        // line 91
        if ((($context["product_tabs_style"] ?? null) == "nav-tabs-lg text-center")) {
            echo " selected=\"selected\"";
        }
        echo ">Centered (Large)</option>
        <option value=\"nav-tabs-sm text-center\"";
        // line 92
        if ((($context["product_tabs_style"] ?? null) == "nav-tabs-sm text-center")) {
            echo " selected=\"selected\"";
        }
        echo ">Centered (Small)</option>
    </select>
</div>                   
</div>




<legend class=\"sub\">Product Questions &amp; Answers</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Allow customers to ask questions/see previously asked questions about products directly on product pages\">Product Questions Status</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][product_question_status]\" value=\"0\" ";
        // line 104
        if ((($context["product_question_status"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][product_question_status]\" value=\"1\" ";
        // line 105
        if ((($context["product_question_status"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Questions Per Page</label>
    <div class=\"col-sm-10\">
    <input class=\"form-control\" name=\"settings[basel][questions_per_page]\" value=\"";
        // line 112
        echo ((($context["questions_per_page"] ?? null)) ? (($context["questions_per_page"] ?? null)) : ("5"));
        echo "\" />
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Set the status on new questions asked. If set to published, not yet answered questions will be visible\">Status On New Questions</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][questions_new_status]\" value=\"0\" ";
        // line 119
        if ((($context["questions_new_status"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Not Published</span></label>
    <label><input type=\"radio\" name=\"settings[basel][questions_new_status]\" value=\"1\" ";
        // line 120
        if ((($context["questions_new_status"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Published</span></label>
    </div>                  
</div>

<legend class=\"sub\">Related Products</legend>
<div class=\"form-group\">
<label class=\"col-sm-2 control-label\">Products per row</label>
<div class=\"col-sm-10\">
    <select name=\"settings[basel][basel_rel_prod_grid]\" class=\"form-control\">
        <option value=\"2\"";
        // line 129
        if ((($context["basel_rel_prod_grid"] ?? null) == "2")) {
            echo " selected=\"selected\"";
        }
        echo ">2</option>
        <option value=\"3\"";
        // line 130
        if ((($context["basel_rel_prod_grid"] ?? null) == "3")) {
            echo " selected=\"selected\"";
        }
        echo ">3</option>
        <option value=\"4\"";
        // line 131
        if ((($context["basel_rel_prod_grid"] ?? null) == "4")) {
            echo " selected=\"selected\"";
        }
        echo ">4</option>
        <option value=\"5\"";
        // line 132
        if ((($context["basel_rel_prod_grid"] ?? null) == "5")) {
            echo " selected=\"selected\"";
        }
        echo ">5</option>
    </select>
</div>                   
</div>";
    }

    public function getTemplateName()
    {
        return "extension/basel/panel_tabs/product-pages.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  318 => 132,  312 => 131,  306 => 130,  300 => 129,  286 => 120,  280 => 119,  270 => 112,  258 => 105,  252 => 104,  235 => 92,  229 => 91,  223 => 90,  209 => 81,  203 => 80,  189 => 71,  183 => 70,  171 => 63,  165 => 62,  152 => 54,  146 => 53,  133 => 45,  127 => 44,  115 => 37,  109 => 36,  97 => 29,  91 => 28,  77 => 19,  71 => 18,  59 => 11,  53 => 10,  47 => 9,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/basel/panel_tabs/product-pages.twig", "/Users/tomek/Herd/reprograv/upload/admin/view/template/extension/basel/panel_tabs/product-pages.twig");
    }
}
