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

/* extension/basel/panel_tabs/shop.twig */
class __TwigTemplate_4bc773e53bdd431c2999e4c791bd3ddcdede6902f19439b1626573d894b2d217 extends \Twig\Template
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
        echo "<legend>Shop</legend>

<legend class=\"sub\">Catalog Mode</legend>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Disable the product purchase options globally\">Catlog Mode</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][catalog_mode]\" value=\"0\" ";
        // line 8
        if ((($context["catalog_mode"] ?? null) == "0")) {
            echo "checked=\"checked\"";
        }
        echo " /><span>Off</span></label>
    <label><input type=\"radio\" name=\"settings[basel][catalog_mode]\" value=\"1\" ";
        // line 9
        if ((($context["catalog_mode"] ?? null) == "1")) {
            echo "checked=\"checked\"";
        }
        echo " /><span>On</span></label>
    </div>                   
</div>

<legend class=\"sub\">Product Quickview</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Enable/Disable the product quickview feature globally\">Product quickview Status</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][quickview_status]\" value=\"0\" ";
        // line 17
        if ((($context["quickview_status"] ?? null) == "0")) {
            echo "checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][quickview_status]\" value=\"1\" ";
        // line 18
        if ((($context["quickview_status"] ?? null) == "1")) {
            echo "checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<legend class=\"sub\">Product Labels</legend>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Sale label</label>
    <div class=\"col-sm-10\">
    <select name=\"settings[basel][salebadge_status]\" class=\"form-control\">
        <option value=\"0\"";
        // line 28
        if ((($context["salebadge_status"] ?? null) == "0")) {
            echo " selected=\"selected\"";
        }
        echo ">Disabled</option>
        <option value=\"1\"";
        // line 29
        if ((($context["salebadge_status"] ?? null) == "1")) {
            echo " selected=\"selected\"";
        }
        echo ">Enabled - Sale Text</option>
\t\t<option value=\"2\"";
        // line 30
        if ((($context["salebadge_status"] ?? null) == "2")) {
            echo " selected=\"selected\"";
        }
        echo ">Enabled - Discount Percentage</option>
    </select>
    </div>                   
</div>


<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Set how many days to show the new-label on new products. Set it as 0 to disable\">New label period</span></label>
    <div class=\"col-sm-10\">
    <input class=\"form-control\" name=\"settings[basel][newlabel_status]\" value=\"";
        // line 39
        echo ((($context["newlabel_status"] ?? null)) ? (($context["newlabel_status"] ?? null)) : ("0"));
        echo "\" />
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Out of stock label</label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][stock_badge_status]\" value=\"0\" ";
        // line 46
        if ((($context["stock_badge_status"] ?? null) == "0")) {
            echo "checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][stock_badge_status]\" value=\"1\" ";
        // line 47
        if ((($context["stock_badge_status"] ?? null) == "1")) {
            echo "checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                     
</div>

<legend class=\"sub\">Specials Countdown</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"View time left on (time limited) special prices. Please note tat the Product groups module has its own setting for this.\">Specials countdown status</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][countdown_status]\" value=\"0\" ";
        // line 55
        if ((($context["countdown_status"] ?? null) == "0")) {
            echo "checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][countdown_status]\" value=\"1\" ";
        // line 56
        if ((($context["countdown_status"] ?? null) == "1")) {
            echo "checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<legend class=\"sub\">Add To Cart</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Action when an item is successfully added to cart\">Add to cart action</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <select name=\"settings[basel][basel_cart_action]\" class=\"form-control\">
        <option value=\"0\"";
        // line 65
        if ((($context["basel_cart_action"] ?? null) == "0")) {
            echo " selected=\"selected\"";
        }
        echo ">Stay - Notification message</option>
        <option value=\"redirect_cart\"";
        // line 66
        if ((($context["basel_cart_action"] ?? null) == "redirect_cart")) {
            echo " selected=\"selected\"";
        }
        echo ">Redirect - Shopping cart</option>
        <option value=\"redirect_checkout\"";
        // line 67
        if ((($context["basel_cart_action"] ?? null) == "redirect_checkout")) {
            echo " selected=\"selected\"";
        }
        echo ">Redirect - Checkout</option>
    </select>
    </div>                   
</div>

<legend class=\"sub\">Wish List</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Enable/Disable the wishlist feature globally\">Wish List Status</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][wishlist_status]\" value=\"0\" ";
        // line 76
        if ((($context["wishlist_status"] ?? null) == "0")) {
            echo "checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][wishlist_status]\" value=\"1\" ";
        // line 77
        if ((($context["wishlist_status"] ?? null) == "1")) {
            echo "checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Action when an item is successfully added to wish list\">Add to wish list action</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <select name=\"settings[basel][basel_wishlist_action]\" class=\"form-control\">
        <option value=\"0\"";
        // line 85
        if ((($context["basel_wishlist_action"] ?? null) == "0")) {
            echo " selected=\"selected\"";
        }
        echo ">Stay - Notification message</option>
        <option value=\"redirect\"";
        // line 86
        if ((($context["basel_wishlist_action"] ?? null) == "redirect")) {
            echo " selected=\"selected\"";
        }
        echo ">Redirect - Wish List Page</option>
    </select>
    </div>                   
</div>

<legend class=\"sub\">Product Comparison</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Enable/Disable the product comparison feature globally\">Comparison Status</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][compare_status]\" value=\"0\" ";
        // line 95
        if ((($context["compare_status"] ?? null) == "0")) {
            echo "checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][compare_status]\" value=\"1\" ";
        // line 96
        if ((($context["compare_status"] ?? null) == "1")) {
            echo "checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Action when an item is successfully added to wish list\">Add to compare action</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <select name=\"settings[basel][basel_compare_action]\" class=\"form-control\">
        <option value=\"0\"";
        // line 104
        if ((($context["basel_compare_action"] ?? null) == "0")) {
            echo " selected=\"selected\"";
        }
        echo ">Stay - Notification message</option>
        <option value=\"redirect\"";
        // line 105
        if ((($context["basel_compare_action"] ?? null) == "redirect")) {
            echo " selected=\"selected\"";
        }
        echo ">Redirect - Product Comparison Page</option>
    </select>
    </div>                   
</div>";
    }

    public function getTemplateName()
    {
        return "extension/basel/panel_tabs/shop.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  251 => 105,  245 => 104,  232 => 96,  226 => 95,  212 => 86,  206 => 85,  193 => 77,  187 => 76,  173 => 67,  167 => 66,  161 => 65,  147 => 56,  141 => 55,  128 => 47,  122 => 46,  112 => 39,  98 => 30,  92 => 29,  86 => 28,  71 => 18,  65 => 17,  52 => 9,  46 => 8,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/basel/panel_tabs/shop.twig", "/Users/tomek/Herd/reprograv/upload/admin/view/template/extension/basel/panel_tabs/shop.twig");
    }
}
