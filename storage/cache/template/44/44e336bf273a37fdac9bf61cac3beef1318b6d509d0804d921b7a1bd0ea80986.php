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

/* extension/basel/panel_tabs/styles.twig */
class __TwigTemplate_820d43c9158cfb8d07d26b9fed2b0633e868fee1c175d2d1bbcf505bb426f681 extends \Twig\Template
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
        echo "<legend>Styles & Colors</legend>

<legend class=\"sub\">General</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Shopping cart icon</label>
    <div class=\"col-sm-10 image-btn\">
    <label><input type=\"radio\" name=\"settings[basel][basel_cart_icon]\" value=\"global-cart-bag\" ";
        // line 7
        if ((($context["basel_cart_icon"] ?? null) == "global-cart-bag")) {
            echo " checked=\"checked\"";
        }
        echo " /><span><i class=\"icon-bag\"></i></span></label>
    
    <label><input type=\"radio\" name=\"settings[basel][basel_cart_icon]\" value=\"global-cart-basket\" ";
        // line 9
        if ((($context["basel_cart_icon"] ?? null) == "global-cart-basket")) {
            echo " checked=\"checked\"";
        }
        echo " /><span><i class=\"icon-basket\"></i></span></label>
    
    <label><input type=\"radio\" name=\"settings[basel][basel_cart_icon]\" value=\"global-cart-handbag\" ";
        // line 11
        if ((($context["basel_cart_icon"] ?? null) == "global-cart-handbag")) {
            echo " checked=\"checked\"";
        }
        echo " /><span><i class=\"icon-handbag\"></i></span></label>
    
    <label><input type=\"radio\" name=\"settings[basel][basel_cart_icon]\" value=\"global-cart-briefcase\" ";
        // line 13
        if ((($context["basel_cart_icon"] ?? null) == "global-cart-briefcase")) {
            echo " checked=\"checked\"";
        }
        echo " /><span><i class=\"icon-briefcase\"></i></span></label>
    
    <label><input type=\"radio\" name=\"settings[basel][basel_cart_icon]\" value=\"global-cart-shoppingbag\" ";
        // line 15
        if ((($context["basel_cart_icon"] ?? null) == "global-cart-shoppingbag")) {
            echo " checked=\"checked\"";
        }
        echo " /><span><i class=\"icon-shopping-bag\"></i></span></label>
    
    <label><input type=\"radio\" name=\"settings[basel][basel_cart_icon]\" value=\"global-cart-shoppingbasket\" ";
        // line 17
        if ((($context["basel_cart_icon"] ?? null) == "global-cart-shoppingbasket")) {
            echo " checked=\"checked\"";
        }
        echo " /><span><i class=\"icon-shopping-basket\"></i></span></label>
    </div>                   
</div>

<legend class=\"sub\">Layout</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Layout Style</label>
    <div class=\"col-sm-10 toggle-btn both-blue\">
    <label><input type=\"radio\" name=\"settings[basel][basel_main_layout]\" value=\"0\" ";
        // line 25
        if ((($context["basel_main_layout"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Full width</span></label>
    <label><input type=\"radio\" name=\"settings[basel][basel_main_layout]\" value=\"1\" ";
        // line 26
        if ((($context["basel_main_layout"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Boxed width</span></label>
    </div>                   
</div>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\">Content width</label>
<div class=\"col-sm-10\">
    <select name=\"settings[basel][basel_content_width]\" class=\"form-control\">
        <option value=\"narrow_container\"";
        // line 34
        if ((($context["basel_content_width"] ?? null) == "narrow_container")) {
            echo " selected=\"selected\"";
        }
        echo ">Narrow (1060px)</option>
        <option value=\"\"";
        // line 35
        if ((($context["basel_content_width"] ?? null) == "")) {
            echo " selected=\"selected\"";
        }
        echo ">Normal (1170px)</option>
        <option value=\"wide_container\"";
        // line 36
        if ((($context["basel_content_width"] ?? null) == "wide_container")) {
            echo " selected=\"selected\"";
        }
        echo ">Wide (1280px)</option>
    </select>
</div>                   
</div>

<legend class=\"sub\">Sticky Columns</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Sticky columns stays within the viewport when scrolling down\">Sticky Columns</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][basel_sticky_columns]\" value=\"0\" ";
        // line 45
        if ((($context["basel_sticky_columns"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][basel_sticky_columns]\" value=\"1\" ";
        // line 46
        if ((($context["basel_sticky_columns"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Use offset if sticky header is enabled to avoid overlapping columns/header. Enter a value in pixels, for example 100\">Sticky Offset Top</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <input class=\"form-control\" style=\"width:120px\" name=\"settings[basel][basel_sticky_columns_offset]\" value=\"";
        // line 53
        echo ((($context["basel_sticky_columns_offset"] ?? null)) ? (($context["basel_sticky_columns_offset"] ?? null)) : ("100"));
        echo "\" />
    </div>                   
</div>

<legend class=\"sub\">Widget Titles</legend>
<div class=\"form-group\">
<label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Select heading style on modules\">Widget heading style</span></label>
<div class=\"col-sm-10\">
    <select name=\"settings[basel][basel_widget_title_style]\" class=\"form-control\">
        <option value=\"0\"";
        // line 62
        if ((($context["basel_widget_title_style"] ?? null) == "0")) {
            echo " selected=\"selected\"";
        }
        echo ">Style 1 - (Cross Separator)</option>
        <option value=\"2\"";
        // line 63
        if ((($context["basel_widget_title_style"] ?? null) == "2")) {
            echo " selected=\"selected\"";
        }
        echo ">Style 2 - (Line Separator)</option>
        <option value=\"3\"";
        // line 64
        if ((($context["basel_widget_title_style"] ?? null) == "3")) {
            echo " selected=\"selected\"";
        }
        echo ">Style 3 - (Bordered Title, No Separator)</option>
    </select>
</div>                   
</div>

<legend class=\"sub\">Product Listing Style</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Select how to show products in product listings, like category pages, related products etc.\">Product listing style</span></label>
    <div class=\"col-sm-10\">
    <select name=\"settings[basel][basel_list_style]\" class=\"form-control\">
        <option value=\"1\"";
        // line 74
        if ((($context["basel_list_style"] ?? null) == "1")) {
            echo " selected=\"selected\"";
        }
        echo ">Style 1 - Default style</option>
        <option value=\"2\"";
        // line 75
        if ((($context["basel_list_style"] ?? null) == "2")) {
            echo " selected=\"selected\"";
        }
        echo ">Style 2 - Action buttons slide up on hover</option>
        <option value=\"3\"";
        // line 76
        if ((($context["basel_list_style"] ?? null) == "3")) {
            echo " selected=\"selected\"";
        }
        echo ">Style 3 - Dark image overlay on hover</option>
        <option value=\"4\"";
        // line 77
        if ((($context["basel_list_style"] ?? null) == "4")) {
            echo " selected=\"selected\"";
        }
        echo ">Style 4 - Dark image overlay on hover alt 2</option>
        <option value=\"1 names-c\"";
        // line 78
        if ((($context["basel_list_style"] ?? null) == "1 names-c")) {
            echo " selected=\"selected\"";
        }
        echo ">Style 5 - Center aligned</option>
        <option value=\"6\"";
        // line 79
        if ((($context["basel_list_style"] ?? null) == "6")) {
            echo " selected=\"selected\"";
        }
        echo ">Style 6 - Center aligned with button</option>
    </select>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Show the first additional image when hovering a product\">Swap image on hover</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][basel_thumb_swap]\" value=\"0\" ";
        // line 87
        if ((($context["basel_thumb_swap"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][basel_thumb_swap]\" value=\"1\" ";
        // line 88
        if ((($context["basel_thumb_swap"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Keep the product names in listings within one line (using only CSS)\">Cut product names</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][basel_cut_names]\" value=\"0\" ";
        // line 95
        if ((($context["basel_cut_names"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][basel_cut_names]\" value=\"1\" ";
        // line 96
        if ((($context["basel_cut_names"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"On smaller mobile devices, select to view 1 or 2 items per row\">Minimum items per row</span></label>
    <div class=\"col-sm-10 toggle-btn both-blue\">
    <label><input type=\"radio\" name=\"settings[basel][items_mobile_fw]\" value=\"1\" ";
        // line 103
        if ((($context["items_mobile_fw"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>1 item</span></label>
    <label><input type=\"radio\" name=\"settings[basel][items_mobile_fw]\" value=\"0\" ";
        // line 104
        if ((($context["items_mobile_fw"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>2 items</span></label>
    </div>                   
</div>

<legend>Custom Color Scheme</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Override default colors</label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][basel_design_status]\" class=\"design-select\" value=\"0\" ";
        // line 112
        if ((($context["basel_design_status"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][basel_design_status]\" class=\"design-select\" value=\"1\" ";
        // line 113
        if ((($context["basel_design_status"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div id=\"custom_design_holder\"";
        // line 117
        if (($context["basel_design_status"] ?? null)) {
            echo " style=\"display:block\"";
        } else {
            echo " style=\"display:none\"";
        }
        echo ">

<legend class=\"third\">Body Background (when using boxed layout)</legend>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Background</label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 125
        echo ((($context["basel_body_bg_color"] ?? null)) ? (($context["basel_body_bg_color"] ?? null)) : ("#ececec"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_body_bg_color]\" value=\"";
        // line 126
        echo ((($context["basel_body_bg_color"] ?? null)) ? (($context["basel_body_bg_color"] ?? null)) : ("#ececec"));
        echo "\" />
    </div> 
    </div>                  
</div>


<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Background Image</label>
    <div class=\"col-sm-10\">
    <div class=\"row\">
        <div class=\"col-sm-2\">
        <a href=\"\" id=\"thumb-bc-img\" data-toggle=\"image\" class=\"img-thumbnail\"><img src=\"";
        // line 137
        echo ($context["body_thumb"] ?? null);
        echo "\" alt=\"\" title=\"\" data-placeholder=\"";
        echo ($context["placeholder"] ?? null);
        echo "\" /></a>
    <input type=\"hidden\" name=\"settings[basel][basel_body_bg_img]\" value=\"";
        // line 138
        echo ($context["basel_body_bg_img"] ?? null);
        echo "\" id=\"input-body-img\" />
        </div>
        <div class=\"col-sm-2\">
        <label>Background Position</label>
        <select name=\"settings[basel][basel_body_bg_img_pos]\" class=\"form-control\">
        <option value=\"top left\"";
        // line 143
        if ((($context["basel_body_bg_img_pos"] ?? null) == "top left")) {
            echo " selected=\"selected\"";
        }
        echo ">top left</option>
        <option value=\"top center\"";
        // line 144
        if ((($context["basel_body_bg_img_pos"] ?? null) == "top center")) {
            echo " selected=\"selected\"";
        }
        echo ">top center</option>
        <option value=\"top right\"";
        // line 145
        if ((($context["basel_body_bg_img_pos"] ?? null) == "top right")) {
            echo " selected=\"selected\"";
        }
        echo ">top right</option>
        <option value=\"center left\"";
        // line 146
        if ((($context["basel_body_bg_img_pos"] ?? null) == "center left")) {
            echo " selected=\"selected\"";
        }
        echo ">middle left</option>
        <option value=\"center center\"";
        // line 147
        if ((($context["basel_body_bg_img_pos"] ?? null) == "center center")) {
            echo " selected=\"selected\"";
        }
        echo ">middle center</option>
        <option value=\"center right\"";
        // line 148
        if ((($context["basel_body_bg_img_pos"] ?? null) == "center right")) {
            echo " selected=\"selected\"";
        }
        echo ">middle right</option>
        <option value=\"bottom left\"";
        // line 149
        if ((($context["basel_body_bg_img_pos"] ?? null) == "bottom left")) {
            echo " selected=\"selected\"";
        }
        echo ">bottom left</option>
        <option value=\"bottom center\"";
        // line 150
        if ((($context["basel_body_bg_img_pos"] ?? null) == "bottom center")) {
            echo " selected=\"selected\"";
        }
        echo ">bottom center</option>
        <option value=\"bottom right\"";
        // line 151
        if ((($context["basel_body_bg_img_pos"] ?? null) == "bottom right")) {
            echo " selected=\"selected\"";
        }
        echo ">bottom right</option>
        </select>
        </div>
        <div class=\"col-sm-2\">
        <label>Background Size</label>
        <select name=\"settings[basel][basel_body_bg_img_size]\" class=\"form-control\">
        <option value=\"auto\"";
        // line 157
        if ((($context["basel_body_bg_img_size"] ?? null) == "auto")) {
            echo " selected=\"selected\"";
        }
        echo ">auto</option>
        <option value=\"contain\"";
        // line 158
        if ((($context["basel_body_bg_img_size"] ?? null) == "contain")) {
            echo " selected=\"selected\"";
        }
        echo ">contain</option>
        <option value=\"cover\"";
        // line 159
        if ((($context["basel_body_bg_img_size"] ?? null) == "cover")) {
            echo " selected=\"selected\"";
        }
        echo ">cover</option>
        </select>
        </div>
        <div class=\"col-sm-2\">
        <label>Background Size</label>
        <select name=\"settings[basel][basel_body_bg_img_repeat]\" class=\"form-control\">
        <option value=\"no-repeat\"";
        // line 165
        if ((($context["basel_body_bg_img_repeat"] ?? null) == "no-repeat")) {
            echo " selected=\"selected\"";
        }
        echo ">no-repeat</option>
        <option value=\"repeat-x\"";
        // line 166
        if ((($context["basel_body_bg_img_repeat"] ?? null) == "repeat-x")) {
            echo " selected=\"selected\"";
        }
        echo ">repeat-x (-)</option>
        <option value=\"repeat-y\"";
        // line 167
        if ((($context["basel_body_bg_img_repeat"] ?? null) == "repeat-y")) {
            echo " selected=\"selected\"";
        }
        echo ">repeat-y (|)</option>
        <option value=\"repeat\"";
        // line 168
        if ((($context["basel_body_bg_img_repeat"] ?? null) == "repeat")) {
            echo " selected=\"selected\"";
        }
        echo ">repeat</option>
        </select>
        </div>
        <div class=\"col-sm-2\">
        <label>Background Attachment</label>
        <select name=\"settings[basel][basel_body_bg_img_att]\" class=\"form-control\">
        <option value=\"scroll\"";
        // line 174
        if ((($context["basel_body_bg_img_att"] ?? null) == "scroll")) {
            echo " selected=\"selected\"";
        }
        echo ">scroll</option>
        <option value=\"local\"";
        // line 175
        if ((($context["basel_body_bg_img_att"] ?? null) == "local")) {
            echo " selected=\"selected\"";
        }
        echo ">local</option>
        <option value=\"fixed\"";
        // line 176
        if ((($context["basel_body_bg_img_att"] ?? null) == "fixed")) {
            echo " selected=\"selected\"";
        }
        echo ">fixed</option>
        </select>
        </div>        
            
    </div>
    </div>                   
</div>


<legend class=\"third\">Top Line Promo Message</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Background</label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 190
        echo ((($context["basel_top_note_bg"] ?? null)) ? (($context["basel_top_note_bg"] ?? null)) : ("#000000"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_top_note_bg]\" value=\"";
        // line 191
        echo ((($context["basel_top_note_bg"] ?? null)) ? (($context["basel_top_note_bg"] ?? null)) : ("#000000"));
        echo "\" />
    </div> 
    </div>                  
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Color</label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 200
        echo ((($context["basel_top_note_color"] ?? null)) ? (($context["basel_top_note_color"] ?? null)) : ("#eeeeee"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_top_note_color]\" value=\"";
        // line 201
        echo ((($context["basel_top_note_color"] ?? null)) ? (($context["basel_top_note_color"] ?? null)) : ("#eeeeee"));
        echo "\" />
    </div> 
    </div>                 
</div>

<legend class=\"third\">Top Line</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Background</label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 211
        echo ((($context["basel_top_line_bg"] ?? null)) ? (($context["basel_top_line_bg"] ?? null)) : ("#1daaa3"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_top_line_bg]\" value=\"";
        // line 212
        echo ((($context["basel_top_line_bg"] ?? null)) ? (($context["basel_top_line_bg"] ?? null)) : ("#1daaa3"));
        echo "\" />
    </div> 
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Color</label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 221
        echo ((($context["basel_top_line_color"] ?? null)) ? (($context["basel_top_line_color"] ?? null)) : ("#ffffff"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_top_line_color]\" value=\"";
        // line 222
        echo ((($context["basel_top_line_color"] ?? null)) ? (($context["basel_top_line_color"] ?? null)) : ("#ffffff"));
        echo "\" />
    </div> 
    </div>                   
</div>

<legend class=\"third\">Header Area</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Background</label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 232
        echo ((($context["basel_header_bg"] ?? null)) ? (($context["basel_header_bg"] ?? null)) : ("#ffffff"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_header_bg]\" value=\"";
        // line 233
        echo ((($context["basel_header_bg"] ?? null)) ? (($context["basel_header_bg"] ?? null)) : ("#ffffff"));
        echo "\" />
    </div> 
    </div>                  
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Color</label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 242
        echo ((($context["basel_header_color"] ?? null)) ? (($context["basel_header_color"] ?? null)) : ("#000000"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_header_color]\" value=\"";
        // line 243
        echo ((($context["basel_header_color"] ?? null)) ? (($context["basel_header_color"] ?? null)) : ("#000000"));
        echo "\" />
    </div> 
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Color on details in header, for example product counters\">Header accent color</span></label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 252
        echo ((($context["basel_header_accent"] ?? null)) ? (($context["basel_header_accent"] ?? null)) : ("#1daaa3"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_header_accent]\" value=\"";
        // line 253
        echo ((($context["basel_header_accent"] ?? null)) ? (($context["basel_header_accent"] ?? null)) : ("#1daaa3"));
        echo "\" />
    </div> 
    </div>                  
</div>

<legend class=\"third\">Menu</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Background</label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 263
        echo ((($context["basel_header_menu_bg"] ?? null)) ? (($context["basel_header_menu_bg"] ?? null)) : ("#111111"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_header_menu_bg]\" value=\"";
        // line 264
        echo ((($context["basel_header_menu_bg"] ?? null)) ? (($context["basel_header_menu_bg"] ?? null)) : ("#111111"));
        echo "\" />
    </div> 
    </div>                  
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Color</label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 273
        echo ((($context["basel_header_menu_color"] ?? null)) ? (($context["basel_header_menu_color"] ?? null)) : ("#eeeeee"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_header_menu_color]\" value=\"";
        // line 274
        echo ((($context["basel_header_menu_color"] ?? null)) ? (($context["basel_header_menu_color"] ?? null)) : ("#eeeeee"));
        echo "\" />
    </div> 
    </div>                 
</div>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"(When using header 6)\">Search field color scheme</span></label>
<div class=\"col-sm-10\">
    <select name=\"settings[basel][basel_search_scheme]\" class=\"form-control\">
        <option value=\"dark-search\"";
        // line 283
        if ((($context["basel_search_scheme"] ?? null) == "dark-search")) {
            echo " selected=\"selected\"";
        }
        echo ">Dark</option>
        <option value=\"light-search\"";
        // line 284
        if ((($context["basel_search_scheme"] ?? null) == "light-search")) {
            echo " selected=\"selected\"";
        }
        echo ">Light</option>
    </select>
</div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Menu sale label</label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 293
        echo ((($context["basel_menutag_sale_bg"] ?? null)) ? (($context["basel_menutag_sale_bg"] ?? null)) : ("#D41212"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_menutag_sale_bg]\" value=\"";
        // line 294
        echo ((($context["basel_menutag_sale_bg"] ?? null)) ? (($context["basel_menutag_sale_bg"] ?? null)) : ("#D41212"));
        echo "\" />
    </div> 
    </div>                  
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Menu new label</label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 303
        echo ((($context["basel_menutag_new_bg"] ?? null)) ? (($context["basel_menutag_new_bg"] ?? null)) : ("#1daaa3"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_menutag_new_bg]\" value=\"";
        // line 304
        echo ((($context["basel_menutag_new_bg"] ?? null)) ? (($context["basel_menutag_new_bg"] ?? null)) : ("#1daaa3"));
        echo "\" />
    </div> 
    </div>                  
</div>

<legend class=\"third\">Breadcrumbs (When Holding Titles)</legend>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Background</label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 315
        echo ((($context["basel_bc_bg_color"] ?? null)) ? (($context["basel_bc_bg_color"] ?? null)) : ("#000000"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_bc_bg_color]\" value=\"";
        // line 316
        echo ((($context["basel_bc_bg_color"] ?? null)) ? (($context["basel_bc_bg_color"] ?? null)) : ("#000000"));
        echo "\" />
    </div> 
    </div>                  
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><br /><span data-toggle=\"tooltip\" title=\"Inline titles helper\">Background image</span></label>
    <div class=\"col-sm-10\">
    <div class=\"row\">
        <div class=\"col-sm-2\">
        <a href=\"\" id=\"thumb-bc-img\" data-toggle=\"image\" class=\"img-thumbnail\"><img src=\"";
        // line 326
        echo ($context["bc_thumb"] ?? null);
        echo "\" alt=\"\" title=\"\" data-placeholder=\"";
        echo ($context["placeholder"] ?? null);
        echo "\" /></a>
    <input type=\"hidden\" name=\"settings[basel][basel_bc_bg_img]\" value=\"";
        // line 327
        echo ($context["basel_bc_bg_img"] ?? null);
        echo "\" id=\"input-bc-img\" />
        </div>
        <div class=\"col-sm-2\">
        <label>Background Position</label>
        <select name=\"settings[basel][basel_bc_bg_img_pos]\" class=\"form-control\">
        <option value=\"top left\"";
        // line 332
        if ((($context["basel_bc_bg_img_pos"] ?? null) == "top left")) {
            echo " selected=\"selected\"";
        }
        echo ">top left</option>
        <option value=\"top center\"";
        // line 333
        if ((($context["basel_bc_bg_img_pos"] ?? null) == "top center")) {
            echo " selected=\"selected\"";
        }
        echo ">top center</option>
        <option value=\"top right\"";
        // line 334
        if ((($context["basel_bc_bg_img_pos"] ?? null) == "top right")) {
            echo " selected=\"selected\"";
        }
        echo ">top right</option>
        <option value=\"center left\"";
        // line 335
        if ((($context["basel_bc_bg_img_pos"] ?? null) == "center left")) {
            echo " selected=\"selected\"";
        }
        echo ">middle left</option>
        <option value=\"center center\"";
        // line 336
        if ((($context["basel_bc_bg_img_pos"] ?? null) == "center center")) {
            echo " selected=\"selected\"";
        }
        echo ">middle center</option>
        <option value=\"center right\"";
        // line 337
        if ((($context["basel_bc_bg_img_pos"] ?? null) == "center right")) {
            echo " selected=\"selected\"";
        }
        echo ">middle right</option>
        <option value=\"bottom left\"";
        // line 338
        if ((($context["basel_bc_bg_img_pos"] ?? null) == "bottom left")) {
            echo " selected=\"selected\"";
        }
        echo ">bottom left</option>
        <option value=\"bottom center\"";
        // line 339
        if ((($context["basel_bc_bg_img_pos"] ?? null) == "bottom center")) {
            echo " selected=\"selected\"";
        }
        echo ">bottom center</option>
        <option value=\"bottom right\"";
        // line 340
        if ((($context["basel_bc_bg_img_pos"] ?? null) == "bottom right")) {
            echo " selected=\"selected\"";
        }
        echo ">bottom right</option>
        </select>
        </div>
        <div class=\"col-sm-2\">
        <label>Background Size</label>
        <select name=\"settings[basel][basel_bc_bg_img_size]\" class=\"form-control\">
        <option value=\"auto\"";
        // line 346
        if ((($context["basel_bc_bg_img_size"] ?? null) == "auto")) {
            echo " selected=\"selected\"";
        }
        echo ">auto</option>
        <option value=\"contain\"";
        // line 347
        if ((($context["basel_bc_bg_img_size"] ?? null) == "contain")) {
            echo " selected=\"selected\"";
        }
        echo ">contain</option>
        <option value=\"cover\"";
        // line 348
        if ((($context["basel_bc_bg_img_size"] ?? null) == "cover")) {
            echo " selected=\"selected\"";
        }
        echo ">cover</option>
        </select>
        </div>
        <div class=\"col-sm-2\">
        <label>Background Size</label>
        <select name=\"settings[basel][basel_bc_bg_img_repeat]\" class=\"form-control\">
        <option value=\"no-repeat\"";
        // line 354
        if ((($context["basel_bc_bg_img_repeat"] ?? null) == "no-repeat")) {
            echo " selected=\"selected\"";
        }
        echo ">no-repeat</option>
        <option value=\"repeat-x\"";
        // line 355
        if ((($context["basel_bc_bg_img_repeat"] ?? null) == "repeat-x")) {
            echo " selected=\"selected\"";
        }
        echo ">repeat-x (-)</option>
        <option value=\"repeat-y\"";
        // line 356
        if ((($context["basel_bc_bg_img_repeat"] ?? null) == "repeat-y")) {
            echo " selected=\"selected\"";
        }
        echo ">repeat-y (|)</option>
        <option value=\"repeat\"";
        // line 357
        if ((($context["basel_bc_bg_img_repeat"] ?? null) == "repeat")) {
            echo " selected=\"selected\"";
        }
        echo ">repeat</option>
        </select>
        </div>
        <div class=\"col-sm-2\">
        <label>Background Attachment</label>
        <select name=\"settings[basel][basel_bc_bg_img_att]\" class=\"form-control\">
        <option value=\"scroll\"";
        // line 363
        if ((($context["basel_bc_bg_img_att"] ?? null) == "scroll")) {
            echo " selected=\"selected\"";
        }
        echo ">scroll</option>
        <option value=\"local\"";
        // line 364
        if ((($context["basel_bc_bg_img_att"] ?? null) == "local")) {
            echo " selected=\"selected\"";
        }
        echo ">local</option>
        <option value=\"fixed\"";
        // line 365
        if ((($context["basel_bc_bg_img_att"] ?? null) == "fixed")) {
            echo " selected=\"selected\"";
        }
        echo ">fixed</option>
        </select>
        </div>        
            
    </div>
    </div>                   
</div>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Color</label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 376
        echo ((($context["basel_bc_color"] ?? null)) ? (($context["basel_bc_color"] ?? null)) : ("#ffffff"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_bc_color]\" value=\"";
        // line 377
        echo ((($context["basel_bc_color"] ?? null)) ? (($context["basel_bc_color"] ?? null)) : ("#ffffff"));
        echo "\" />
    </div> 
    </div>                  
</div>



<legend class=\"third\">Content Area</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Color when hovering links etc\">Primary accent color</span></label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 389
        echo ((($context["basel_primary_accent_color"] ?? null)) ? (($context["basel_primary_accent_color"] ?? null)) : ("#1daaa3"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_primary_accent_color]\" value=\"";
        // line 390
        echo ((($context["basel_primary_accent_color"] ?? null)) ? (($context["basel_primary_accent_color"] ?? null)) : ("#1daaa3"));
        echo "\" />
    </div> 
    </div>                  
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"On produts in product listings and product pages\">Sale badge background</span></label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 399
        echo ((($context["basel_salebadge_bg"] ?? null)) ? (($context["basel_salebadge_bg"] ?? null)) : ("#1daaa3"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_salebadge_bg]\" value=\"";
        // line 400
        echo ((($context["basel_salebadge_bg"] ?? null)) ? (($context["basel_salebadge_bg"] ?? null)) : ("#1daaa3"));
        echo "\" />
    </div> 
    </div>                  
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"On produts in product listings and product pages\">Sale badge color</span></label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 409
        echo ((($context["basel_salebadge_color"] ?? null)) ? (($context["basel_salebadge_color"] ?? null)) : ("#ffffff"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_salebadge_color]\" value=\"";
        // line 410
        echo ((($context["basel_salebadge_color"] ?? null)) ? (($context["basel_salebadge_color"] ?? null)) : ("#ffffff"));
        echo "\" />
    </div> 
    </div>                 
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"On produts in product listings and product pages\">New badge background</span></label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 419
        echo ((($context["basel_newbadge_bg"] ?? null)) ? (($context["basel_newbadge_bg"] ?? null)) : ("#ffffff"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_newbadge_bg]\" value=\"";
        // line 420
        echo ((($context["basel_newbadge_bg"] ?? null)) ? (($context["basel_newbadge_bg"] ?? null)) : ("#ffffff"));
        echo "\" />
    </div> 
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"On produts in product listings and product pages\">New badge color</span></label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 429
        echo ((($context["basel_newbadge_color"] ?? null)) ? (($context["basel_newbadge_color"] ?? null)) : ("#111111"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_newbadge_color]\" value=\"";
        // line 430
        echo ((($context["basel_newbadge_color"] ?? null)) ? (($context["basel_newbadge_color"] ?? null)) : ("#111111"));
        echo "\" />
    </div> 
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Price color</label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 439
        echo ((($context["basel_price_color"] ?? null)) ? (($context["basel_price_color"] ?? null)) : ("#1daaa3"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_price_color]\" value=\"";
        // line 440
        echo ((($context["basel_price_color"] ?? null)) ? (($context["basel_price_color"] ?? null)) : ("#1daaa3"));
        echo "\" />
    </div> 
    </div>                  
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"When using vertical mega menu modules, or when using header alternative 5\">Vertical menu background</span></label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 449
        echo ((($context["basel_vertical_menu_bg"] ?? null)) ? (($context["basel_vertical_menu_bg"] ?? null)) : ("#212121"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_vertical_menu_bg]\" value=\"";
        // line 450
        echo ((($context["basel_vertical_menu_bg"] ?? null)) ? (($context["basel_vertical_menu_bg"] ?? null)) : ("#212121"));
        echo "\" />
    </div> 
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"When using vertical mega menu modules, or when using header alternative 5\">Vertical menu background on hover</span></label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 459
        echo ((($context["basel_vertical_menu_bg_hover"] ?? null)) ? (($context["basel_vertical_menu_bg_hover"] ?? null)) : ("#fbbc34"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_vertical_menu_bg_hover]\" value=\"";
        // line 460
        echo ((($context["basel_vertical_menu_bg_hover"] ?? null)) ? (($context["basel_vertical_menu_bg_hover"] ?? null)) : ("#fbbc34"));
        echo "\" />
    </div> 
    </div>                  
</div>


<legend class=\"third\">Buttons</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Default buttons: Background</label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 471
        echo ((($context["basel_default_btn_bg"] ?? null)) ? (($context["basel_default_btn_bg"] ?? null)) : ("#000000"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_default_btn_bg]\" value=\"";
        // line 472
        echo ((($context["basel_default_btn_bg"] ?? null)) ? (($context["basel_default_btn_bg"] ?? null)) : ("#000000"));
        echo "\" />
    </div> 
    </div>                  
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Default buttons: Color</label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 481
        echo ((($context["basel_default_btn_color"] ?? null)) ? (($context["basel_default_btn_color"] ?? null)) : ("#ffffff"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_default_btn_color]\" value=\"";
        // line 482
        echo ((($context["basel_default_btn_color"] ?? null)) ? (($context["basel_default_btn_color"] ?? null)) : ("#ffffff"));
        echo "\" />
    </div> 
    </div>                  
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Default buttons: Hover background</label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 491
        echo ((($context["basel_default_btn_bg_hover"] ?? null)) ? (($context["basel_default_btn_bg_hover"] ?? null)) : ("#3e3e3e"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_default_btn_bg_hover]\" value=\"";
        // line 492
        echo ((($context["basel_default_btn_bg_hover"] ?? null)) ? (($context["basel_default_btn_bg_hover"] ?? null)) : ("#3e3e3e"));
        echo "\" />
    </div> 
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Default buttons: Hover color</label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 501
        echo ((($context["basel_default_btn_color_hover"] ?? null)) ? (($context["basel_default_btn_color_hover"] ?? null)) : ("#ffffff"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_default_btn_color_hover]\" value=\"";
        // line 502
        echo ((($context["basel_default_btn_color_hover"] ?? null)) ? (($context["basel_default_btn_color_hover"] ?? null)) : ("#ffffff"));
        echo "\" />
    </div> 
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Action buttons: Background</label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 511
        echo ((($context["basel_contrast_btn_bg"] ?? null)) ? (($context["basel_contrast_btn_bg"] ?? null)) : ("#1daaa3"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_contrast_btn_bg]\" value=\"";
        // line 512
        echo ((($context["basel_contrast_btn_bg"] ?? null)) ? (($context["basel_contrast_btn_bg"] ?? null)) : ("#1daaa3"));
        echo "\" />
    </div> 
    </div>                   
</div>


<legend class=\"third\">Footer</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Background</label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 523
        echo ((($context["basel_footer_bg"] ?? null)) ? (($context["basel_footer_bg"] ?? null)) : ("#000000"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_footer_bg]\" value=\"";
        // line 524
        echo ((($context["basel_footer_bg"] ?? null)) ? (($context["basel_footer_bg"] ?? null)) : ("#000000"));
        echo "\" />
    </div> 
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Color</label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 533
        echo ((($context["basel_footer_color"] ?? null)) ? (($context["basel_footer_color"] ?? null)) : ("#ffffff"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_footer_color]\" value=\"";
        // line 534
        echo ((($context["basel_footer_color"] ?? null)) ? (($context["basel_footer_color"] ?? null)) : ("#ffffff"));
        echo "\" />
    </div> 
    </div>               
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Heading / Links separator color</label>
    <div class=\"col-sm-10\">
    <div class=\"input-group form-inline colorfield\">
    <span class=\"input-group-addon\"><i style=\"background:";
        // line 543
        echo ((($context["basel_footer_h5_sep"] ?? null)) ? (($context["basel_footer_h5_sep"] ?? null)) : ("#cccccc"));
        echo "\"></i></span>
    <input class=\"form-control\" name=\"settings[basel][basel_footer_h5_sep]\" value=\"";
        // line 544
        echo ((($context["basel_footer_h5_sep"] ?? null)) ? (($context["basel_footer_h5_sep"] ?? null)) : ("#cccccc"));
        echo "\" />
    </div> 
    </div>                
</div>
</div><!-- #custom_design_holder -->
";
    }

    public function getTemplateName()
    {
        return "extension/basel/panel_tabs/styles.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1135 => 544,  1131 => 543,  1119 => 534,  1115 => 533,  1103 => 524,  1099 => 523,  1085 => 512,  1081 => 511,  1069 => 502,  1065 => 501,  1053 => 492,  1049 => 491,  1037 => 482,  1033 => 481,  1021 => 472,  1017 => 471,  1003 => 460,  999 => 459,  987 => 450,  983 => 449,  971 => 440,  967 => 439,  955 => 430,  951 => 429,  939 => 420,  935 => 419,  923 => 410,  919 => 409,  907 => 400,  903 => 399,  891 => 390,  887 => 389,  872 => 377,  868 => 376,  852 => 365,  846 => 364,  840 => 363,  829 => 357,  823 => 356,  817 => 355,  811 => 354,  800 => 348,  794 => 347,  788 => 346,  777 => 340,  771 => 339,  765 => 338,  759 => 337,  753 => 336,  747 => 335,  741 => 334,  735 => 333,  729 => 332,  721 => 327,  715 => 326,  702 => 316,  698 => 315,  684 => 304,  680 => 303,  668 => 294,  664 => 293,  650 => 284,  644 => 283,  632 => 274,  628 => 273,  616 => 264,  612 => 263,  599 => 253,  595 => 252,  583 => 243,  579 => 242,  567 => 233,  563 => 232,  550 => 222,  546 => 221,  534 => 212,  530 => 211,  517 => 201,  513 => 200,  501 => 191,  497 => 190,  478 => 176,  472 => 175,  466 => 174,  455 => 168,  449 => 167,  443 => 166,  437 => 165,  426 => 159,  420 => 158,  414 => 157,  403 => 151,  397 => 150,  391 => 149,  385 => 148,  379 => 147,  373 => 146,  367 => 145,  361 => 144,  355 => 143,  347 => 138,  341 => 137,  327 => 126,  323 => 125,  308 => 117,  299 => 113,  293 => 112,  280 => 104,  274 => 103,  262 => 96,  256 => 95,  244 => 88,  238 => 87,  225 => 79,  219 => 78,  213 => 77,  207 => 76,  201 => 75,  195 => 74,  180 => 64,  174 => 63,  168 => 62,  156 => 53,  144 => 46,  138 => 45,  124 => 36,  118 => 35,  112 => 34,  99 => 26,  93 => 25,  80 => 17,  73 => 15,  66 => 13,  59 => 11,  52 => 9,  45 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/basel/panel_tabs/styles.twig", "/Users/tomek/Herd/reprograv/upload/admin/view/template/extension/basel/panel_tabs/styles.twig");
    }
}
