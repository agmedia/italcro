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

/* extension/basel/panel_tabs/header.twig */
class __TwigTemplate_c5258c457f9ae92644a73fd8c75b455ea97078ba8ae936e4febd148f4e04475b extends \Twig\Template
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
        echo "<legend>Header Styling</legend>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\">Header Alternative</label>
<div class=\"col-sm-10\">
    <select id=\"header-select\" name=\"settings[basel][basel_header]\" class=\"form-control\">
        <option value=\"header1\"";
        // line 7
        if ((($context["basel_header"] ?? null) == "header1")) {
            echo " selected=\"selected\"";
        }
        echo ">Header 1</option>
        <option value=\"header2\"";
        // line 8
        if ((($context["basel_header"] ?? null) == "header2")) {
            echo " selected=\"selected\"";
        }
        echo ">Header 2</option>
        <option value=\"header3\"";
        // line 9
        if ((($context["basel_header"] ?? null) == "header3")) {
            echo " selected=\"selected\"";
        }
        echo ">Header 3</option>
        <option value=\"header4\"";
        // line 10
        if ((($context["basel_header"] ?? null) == "header4")) {
            echo " selected=\"selected\"";
        }
        echo ">Header 4</option>
        <option value=\"header5\"";
        // line 11
        if ((($context["basel_header"] ?? null) == "header5")) {
            echo " selected=\"selected\"";
        }
        echo ">Header 5</option>
        <option value=\"header6\"";
        // line 12
        if ((($context["basel_header"] ?? null) == "header6")) {
            echo " selected=\"selected\"";
        }
        echo ">Header 6</option>
    </select>
    <div id=\"header-preview\" class=\"preview-holder\">
    <img src=\"view/javascript/basel/img/theme-panel/headers/";
        // line 15
        echo ($context["basel_header"] ?? null);
        echo ".png\" />
    </div>
</div>
</div>

<legend class=\"sub\">Top Line</legend>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Top Line Status</label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][top_line_style]\" value=\"0\" ";
        // line 25
        if ((($context["top_line_style"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][top_line_style]\" value=\"1\" ";
        // line 26
        if ((($context["top_line_style"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\">Top Line Width</label>
<div class=\"col-sm-10\">
    <select name=\"settings[basel][top_line_width]\" class=\"form-control\">
        <option value=\"full-width\"";
        // line 34
        if ((($context["top_line_width"] ?? null) == "full-width")) {
            echo " selected=\"selected\"";
        }
        echo ">Full Width</option>
        <option value=\"boxed\"";
        // line 35
        if ((($context["top_line_width"] ?? null) == "boxed")) {
            echo " selected=\"selected\"";
        }
        echo ">Boxed</option>
    </select>
</div>                   
</div>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Enter value in pixels, eg. 41\">Top Line Height</span></label>
<div class=\"col-sm-10\">
    <input class=\"form-control\" name=\"settings[basel][top_line_height]\" value=\"";
        // line 43
        echo ((($context["top_line_height"] ?? null)) ? (($context["top_line_height"] ?? null)) : ("41"));
        echo "\" />
</div>                   
</div>

<legend class=\"sub\">Main Header Area</legend>
<div class=\"form-group\">
<label class=\"col-sm-2 control-label\">Main Area Width</label>
<div class=\"col-sm-10\">
    <select name=\"settings[basel][main_header_width]\" class=\"form-control\">
        <option value=\"full-width\"";
        // line 52
        if ((($context["main_header_width"] ?? null) == "full-width")) {
            echo " selected=\"selected\"";
        }
        echo ">Full Width</option>
        <option value=\"boxed\"";
        // line 53
        if ((($context["main_header_width"] ?? null) == "boxed")) {
            echo " selected=\"selected\"";
        }
        echo ">Boxed</option>
    </select>
</div>                   
</div>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><br /><span data-toggle=\"tooltip\" title=\"Enter values in pixels, eg. 100\">Main Header Area Height</span></label>
    <div class=\"col-sm-10\">
    
    <div class=\"row\">
    <div class=\"col-sm-4\">
    <label>Desktop View</label>
    <input class=\"form-control\" name=\"settings[basel][main_header_height]\" value=\"";
        // line 64
        echo ((($context["main_header_height"] ?? null)) ? (($context["main_header_height"] ?? null)) : ("104"));
        echo "\" />
    </div>
    
    <div class=\"col-sm-4\">
    <label>Mobile View</label>
    <input class=\"form-control\" name=\"settings[basel][main_header_height_mobile]\" value=\"";
        // line 69
        echo ((($context["main_header_height_mobile"] ?? null)) ? (($context["main_header_height_mobile"] ?? null)) : ("70"));
        echo "\" />
    </div>
    
    <div class=\"col-sm-4\">
    <label>Sticky Header</label>
    <input class=\"form-control\" name=\"settings[basel][main_header_height_sticky]\" value=\"";
        // line 74
        echo ((($context["main_header_height_sticky"] ?? null)) ? (($context["main_header_height_sticky"] ?? null)) : ("70"));
        echo "\" />
    </div>
        
    </div>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Keep the header fixed on top of the page when scrolling\">Sticky Header</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][basel_sticky_header]\" value=\"0\" ";
        // line 84
        if ((($context["basel_sticky_header"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][basel_sticky_header]\" value=\"1\" ";
        // line 85
        if ((($context["basel_sticky_header"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<legend class=\"sub\">Logo</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Enter value in pixels, eg. 100\">Logo Max Width</span></label>
    <div class=\"col-sm-10\">
    <input class=\"form-control\" name=\"settings[basel][logo_maxwidth]\" value=\"";
        // line 93
        echo ((($context["logo_maxwidth"] ?? null)) ? (($context["logo_maxwidth"] ?? null)) : ("250"));
        echo "\" />        
    </div>
</div>

<legend class=\"sub\">Menu Area</legend>
<div class=\"form-group\">
<label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Only available on header alternative 2 & 6\">Menu Alignment</span></label>
<div class=\"col-sm-10\">
    <select name=\"settings[basel][main_menu_align]\" class=\"form-control\">
    \t<option value=\"menu-aligned-left\"";
        // line 102
        if ((($context["main_menu_align"] ?? null) == "menu-aligned-left")) {
            echo " selected=\"selected\"";
        }
        echo ">Left</option>
        <option value=\"menu-aligned-center\"";
        // line 103
        if ((($context["main_menu_align"] ?? null) == "menu-aligned-center")) {
            echo " selected=\"selected\"";
        }
        echo ">Center</option>
        <option value=\"menu-aligned-right\"";
        // line 104
        if ((($context["main_menu_align"] ?? null) == "menu-aligned-right")) {
            echo " selected=\"selected\"";
        }
        echo ">Right</option>
    </select>
</div>                   
</div>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><br /><span data-toggle=\"tooltip\" title=\"Enter values in pixels, eg. 100\">Menu Area Height</span></label>
    <div class=\"col-sm-10\">
    
    <div class=\"row\">
    <div class=\"col-sm-4\">
    <label>Default</label>
    <input class=\"form-control\" name=\"settings[basel][menu_height_normal]\" value=\"";
        // line 115
        echo ((($context["menu_height_normal"] ?? null)) ? (($context["menu_height_normal"] ?? null)) : ("50"));
        echo "\" />
    </div>
    
    <div class=\"col-sm-4\">
    <label>Sticky Header</label>
    <input class=\"form-control\" name=\"settings[basel][menu_height_sticky]\" value=\"";
        // line 120
        echo ((($context["menu_height_sticky"] ?? null)) ? (($context["menu_height_sticky"] ?? null)) : ("70"));
        echo "\" />
    </div>
        
    </div>
    </div>                   
</div>


<legend class=\"sub\">Header Promo Messages</legend>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\">Primary Promo Message</label>
    <div class=\"col-sm-10\">
    ";
        // line 133
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 134
            echo "    <div class=\"input-group\">
    <span class=\"input-group-addon\">
    <img src=\"language/";
            // line 136
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 136);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 136);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 136);
            echo "\" /></span>
    <input class=\"form-control\" name=\"settings[basel][basel_promo][";
            // line 137
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 137);
            echo "]\" value=\"";
            echo (((($__internal_compile_0 = ($context["basel_promo"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 137)] ?? null) : null)) ? ((($__internal_compile_1 = ($context["basel_promo"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 137)] ?? null) : null)) : (""));
            echo "\" />
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 140
        echo "    </div>
</div>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"If available in your header alternative\">Secondary Promo Message</span></label>
    <div class=\"col-sm-10\">
    ";
        // line 146
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 147
            echo "    <div class=\"input-group\">
    <span class=\"input-group-addon\">
    <img src=\"language/";
            // line 149
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 149);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 149);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 149);
            echo "\" /></span>
    <input class=\"form-control\" name=\"settings[basel][basel_promo2][";
            // line 150
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 150);
            echo "]\" value=\"";
            echo (((($__internal_compile_2 = ($context["basel_promo2"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 150)] ?? null) : null)) ? ((($__internal_compile_3 = ($context["basel_promo2"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 150)] ?? null) : null)) : (""));
            echo "\" />
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 153
        echo "    </div>
</div>


<legend class=\"sub\">General</legend>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Enable to keep the header floating on your home page, with a transparent background\">Homepage Overlay Header</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][basel_home_overlay_header]\" value=\"0\" ";
        // line 162
        if ((($context["basel_home_overlay_header"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][basel_home_overlay_header]\" value=\"1\" ";
        // line 163
        if ((($context["basel_home_overlay_header"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Login / Register Status</label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][header_login]\"  value=\"0\" ";
        // line 170
        if ((($context["header_login"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][header_login]\"  value=\"1\" ";
        // line 171
        if ((($context["header_login"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Header Search Status</label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][header_search]\"  value=\"0\" ";
        // line 178
        if ((($context["header_search"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][header_search]\"  value=\"1\" ";
        // line 179
        if ((($context["header_search"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>
</div>

<legend>Menu Management</legend>
<div class=\"col-sm-offset-2\">
<div class=\"bs-callout bs-callout-info bs-callout-sm\">
<h4>How to manage menus?</h4>
<p>Please see the sketch at the header selection to see where menus are located.</p>
<p>As <b>Primary Menu</b> and <b>Secondary Menu</b> you can attach either the <i>Default menu from Opencart</i>, or a menu created using the <i>Basel Megamenu Module.</i></p>
<p>Default menu from Opencart = <i>All categories from Catalog > Categories where the \"Top\" checkbox is checked</i><br />
Mega Menu Module = <i>Menus created from the module Basel Megamenu under Extensions > Extensions -> Modules.</i></p>
<p><b>On mobile devices</b>, links from <i>Primary Menu</i>, <i>Secondary Menu</i> and <i>Static links</i> will be listed</p>
</div>
</div>
<legend class=\"sub\">Main Menus</legend>
<!-- PRIMARY MENU -->
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Select which menu to be used as the primary menu\">Primary Menu</span></label>
    <div class=\"col-sm-10\">
        <select name=\"settings[basel][primary_menu]\" class=\"form-control\">
        \t";
        // line 200
        if ((($context["primary_menu"] ?? null) == "0")) {
            // line 201
            echo "            <option value=\"0\" selected=\"selected\">None</option>
            ";
        } else {
            // line 203
            echo "            <option value=\"0\">None</option>
            ";
        }
        // line 205
        echo "            ";
        if ((($context["primary_menu"] ?? null) == "oc")) {
            // line 206
            echo "            <option value=\"oc\" selected=\"selected\">Default Opencart Category Menu</option>
            ";
        } else {
            // line 208
            echo "            <option value=\"oc\">Default Opencart Category Menu</option>
            ";
        }
        // line 210
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["menu_modules"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["menu_module"]) {
            // line 211
            echo "            ";
            if ((($context["primary_menu"] ?? null) == twig_get_attribute($this->env, $this->source, $context["menu_module"], "module_id", [], "any", false, false, false, 211))) {
                // line 212
                echo "            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["menu_module"], "module_id", [], "any", false, false, false, 212);
                echo "\" selected=\"selected\">Basel Megamenu: ";
                echo twig_get_attribute($this->env, $this->source, $context["menu_module"], "name", [], "any", false, false, false, 212);
                echo "</option>
            ";
            } else {
                // line 214
                echo "            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["menu_module"], "module_id", [], "any", false, false, false, 214);
                echo "\">Basel Megamenu: ";
                echo twig_get_attribute($this->env, $this->source, $context["menu_module"], "name", [], "any", false, false, false, 214);
                echo "</option>
            ";
            }
            // line 216
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['menu_module'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 217
        echo "        </select>
    </div>                   
</div>

<!-- SECONDARY MENU -->
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Select which menu to be used as the secondary menu. (Only available on some header alternatives)\">Seconday Menu</span></label>
    <div class=\"col-sm-10\">
        <select name=\"settings[basel][secondary_menu]\" class=\"form-control\">
        \t";
        // line 226
        if ((($context["secondary_menu"] ?? null) == "0")) {
            // line 227
            echo "            <option value=\"0\" selected=\"selected\">None</option>
            ";
        } else {
            // line 229
            echo "            <option value=\"0\">None</option>
            ";
        }
        // line 231
        echo "            ";
        if ((($context["secondary_menu"] ?? null) == "oc")) {
            // line 232
            echo "            <option value=\"oc\" selected=\"selected\">Default Opencart Category Menu</option>
            ";
        } else {
            // line 234
            echo "            <option value=\"oc\">Default Opencart Category Menu</option>
            ";
        }
        // line 236
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["menu_modules"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["menu_module"]) {
            // line 237
            echo "            ";
            if ((($context["secondary_menu"] ?? null) == twig_get_attribute($this->env, $this->source, $context["menu_module"], "module_id", [], "any", false, false, false, 237))) {
                // line 238
                echo "            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["menu_module"], "module_id", [], "any", false, false, false, 238);
                echo "\" selected=\"selected\">Basel Megamenu: ";
                echo twig_get_attribute($this->env, $this->source, $context["menu_module"], "name", [], "any", false, false, false, 238);
                echo "</option>
            ";
            } else {
                // line 240
                echo "            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["menu_module"], "module_id", [], "any", false, false, false, 240);
                echo "\">Basel Megamenu: ";
                echo twig_get_attribute($this->env, $this->source, $context["menu_module"], "name", [], "any", false, false, false, 240);
                echo "</option>
            ";
            }
            // line 242
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['menu_module'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 243
        echo "        </select>
    </div>                   
</div>

<legend class=\"sub\">Header Static Links</legend>
<!-- STATIC LINKS -->
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"If disabled, the default links from opencart will be used\">Override Static Links</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][use_custom_links]\" class=\"links-select\" value=\"0\" ";
        // line 252
        if ((($context["use_custom_links"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][use_custom_links]\" class=\"links-select\" value=\"1\" ";
        // line 253
        if ((($context["use_custom_links"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div class=\"row\" id=\"custom_links_holder\"";
        // line 257
        if (($context["use_custom_links"] ?? null)) {
            echo " style=\"display:block\"";
        } else {
            echo " style=\"display:none\"";
        }
        echo ">
<div class=\"col-sm-2\"></div>
<div class=\"col-sm-10\">
 <table id=\"links\" class=\"table table-clean\">
    <thead>
      <tr>
        <td width=\"48%\">Text</td>
        <td width=\"48%\"><span data-toggle=\"tooltip\" title=\"Include http:// when linking to external targets\">Link Target</span></td>
        <td width=\"4%\">Sort Order</td>
      </tr>
    </thead>
    <tbody>
     ";
        // line 269
        $context["link_row"] = 1;
        // line 270
        echo "     ";
        if (array_key_exists("link_row", $context)) {
            // line 271
            echo "\t  ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["basel_links"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["basel_link"]) {
                // line 272
                echo "      <tr id=\"link-row";
                echo ($context["link_row"] ?? null);
                echo "\">
        <td class=\"first\">
        ";
                // line 274
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                    // line 275
                    echo "        <div class=\"input-group\">
        <span class=\"input-group-addon\"><img src=\"language/";
                    // line 276
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 276);
                    echo "/";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 276);
                    echo ".png\" title=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 276);
                    echo "\" /></span>
        <input type=\"text\" class=\"form-control\" name=\"settings[basel][basel_links][";
                    // line 277
                    echo ($context["link_row"] ?? null);
                    echo "][text][";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 277);
                    echo "]\" value=\"";
                    echo (((($__internal_compile_4 = twig_get_attribute($this->env, $this->source, $context["basel_link"], "text", [], "any", false, false, false, 277)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 277)] ?? null) : null)) ? ((($__internal_compile_5 = twig_get_attribute($this->env, $this->source, $context["basel_link"], "text", [], "any", false, false, false, 277)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 277)] ?? null) : null)) : (""));
                    echo "\" size=\"40\" />
        </div>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 280
                echo "        </td>
        <td class=\"first\">
        <input type=\"text\" class=\"form-control\" name=\"settings[basel][basel_links][";
                // line 282
                echo ($context["link_row"] ?? null);
                echo "][target]\" value=\"";
                echo ((twig_get_attribute($this->env, $this->source, $context["basel_link"], "target", [], "any", false, false, false, 282)) ? (twig_get_attribute($this->env, $this->source, $context["basel_link"], "target", [], "any", false, false, false, 282)) : (""));
                echo "\" />
        </td>
        <td class=\"first\">
        <input type=\"text\" class=\"form-control\" style=\"width:60px\" name=\"settings[basel][basel_links][";
                // line 285
                echo ($context["link_row"] ?? null);
                echo "][sort]\" value=\"";
                echo ((twig_get_attribute($this->env, $this->source, $context["basel_link"], "sort", [], "any", false, false, false, 285)) ? (twig_get_attribute($this->env, $this->source, $context["basel_link"], "sort", [], "any", false, false, false, 285)) : ("0"));
                echo "\" />
        </td>
        <td class=\"text-right\">
        <button type=\"button\" onclick=\"\$('#link-row";
                // line 288
                echo ($context["link_row"] ?? null);
                echo "').remove();\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_remove"] ?? null);
                echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button>
        </td>
      </tr>
      ";
                // line 291
                $context["link_row"] = (($context["link_row"] ?? null) + 1);
                // line 292
                echo "    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['basel_link'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 293
            echo "    ";
        }
        // line 294
        echo "    </tbody>
    <tfoot>
      <tr>
        <td colspan=\"3\"></td>
        <td class=\"text-right\"><button type=\"button\" onclick=\"addLinkRow();\" data-toggle=\"tooltip\" title=\"";
        // line 298
        echo ($context["button_add"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus-circle\"></i></button></td>
      </tr>
    </tfoot>
  </table>
 </div>
</div> <!-- row ends -->
          

<script type=\"text/javascript\"><!--
var link_row = ";
        // line 307
        echo ($context["link_row"] ?? null);
        echo ";
function addLinkRow() {
\thtml  = '<tr id=\"link-row' + link_row + '\">';
\thtml += '<td class=\"first\">';
\t";
        // line 311
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 312
            echo "\thtml += '<div class=\"input-group\">';
\thtml += '<span class=\"input-group-addon\"><img src=\"language/";
            // line 313
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 313);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 313);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 313);
            echo "\" /></span>';
\thtml += '<input type=\"text\" class=\"form-control\" name=\"settings[basel][basel_links][' + link_row + '][text][";
            // line 314
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 314);
            echo "]\" />';
\thtml += '</div>';
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 317
        echo "\thtml += '</td>';
\thtml += '<td class=\"first\">';
\thtml += '<input type=\"text\" class=\"form-control\" name=\"settings[basel][basel_links][' + link_row + '][target]\" />';
\thtml += '</td>';
\thtml += '<td class=\"first\">';
\thtml += '<input type=\"text\" class=\"form-control\" style=\"width:60px\" value=\"0\" name=\"settings[basel][basel_links][' + link_row + '][sort]\" />';
\thtml += '</td>';
\thtml += '<td class=\"text-right\"><button type=\"button\" onclick=\"\$(\\'#link-row' + link_row  + '\\').remove();\" data-toggle=\"tooltip\" title=\"";
        // line 324
        echo ($context["button_remove"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>';
\thtml += '</tr>';
\t\$('#links tbody').append(html);
\tlink_row++;
}
//--></script>";
    }

    public function getTemplateName()
    {
        return "extension/basel/panel_tabs/header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  720 => 324,  711 => 317,  702 => 314,  694 => 313,  691 => 312,  687 => 311,  680 => 307,  668 => 298,  662 => 294,  659 => 293,  653 => 292,  651 => 291,  643 => 288,  635 => 285,  627 => 282,  623 => 280,  610 => 277,  602 => 276,  599 => 275,  595 => 274,  589 => 272,  584 => 271,  581 => 270,  579 => 269,  560 => 257,  551 => 253,  545 => 252,  534 => 243,  528 => 242,  520 => 240,  512 => 238,  509 => 237,  504 => 236,  500 => 234,  496 => 232,  493 => 231,  489 => 229,  485 => 227,  483 => 226,  472 => 217,  466 => 216,  458 => 214,  450 => 212,  447 => 211,  442 => 210,  438 => 208,  434 => 206,  431 => 205,  427 => 203,  423 => 201,  421 => 200,  395 => 179,  389 => 178,  377 => 171,  371 => 170,  359 => 163,  353 => 162,  342 => 153,  331 => 150,  323 => 149,  319 => 147,  315 => 146,  307 => 140,  296 => 137,  288 => 136,  284 => 134,  280 => 133,  264 => 120,  256 => 115,  240 => 104,  234 => 103,  228 => 102,  216 => 93,  203 => 85,  197 => 84,  184 => 74,  176 => 69,  168 => 64,  152 => 53,  146 => 52,  134 => 43,  121 => 35,  115 => 34,  102 => 26,  96 => 25,  83 => 15,  75 => 12,  69 => 11,  63 => 10,  57 => 9,  51 => 8,  45 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/basel/panel_tabs/header.twig", "/Users/tomek/Herd/reprograv/upload/admin/view/template/extension/basel/panel_tabs/header.twig");
    }
}
