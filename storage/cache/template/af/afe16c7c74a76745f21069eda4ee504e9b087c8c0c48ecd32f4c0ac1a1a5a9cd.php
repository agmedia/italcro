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

/* extension/basel/panel_tabs/page-titles.twig */
class __TwigTemplate_6b625ac025be3f895a889a6adb27f118c2b985386b1abdc2da0317b40c243f1e extends \Twig\Template
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
        echo "<legend>Breadcrumbs / Page Titles</legend>
<div class=\"form-group\">
<label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Select page title style on product listing pages, like category pages, search result page etc\">Product listing pages</span></label>
<div class=\"col-sm-10\">
    <select name=\"settings[basel][basel_titles_listings]\" class=\"form-control\">
        <option value=\"default_bc\"
        ";
        // line 7
        if ((($context["basel_titles_listings"] ?? null) == "default_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style + Short Height + Boxed Width
        </option>
        <option value=\"default_bc full_width_bc\"
        ";
        // line 11
        if ((($context["basel_titles_listings"] ?? null) == "default_bc full_width_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style + Short Height + Full Width
        </option>
        <option value=\"default_bc normal_height_bc\"
        ";
        // line 15
        if ((($context["basel_titles_listings"] ?? null) == "default_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style / Normal Height + Boxed Width
        </option>
        <option value=\"default_bc full_width_bc normal_height_bc\"
        ";
        // line 19
        if ((($context["basel_titles_listings"] ?? null) == "default_bc full_width_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style / Normal Height + Full Width
        </option>
        <option value=\"minimal_bc\"
        ";
        // line 23
        if ((($context["basel_titles_listings"] ?? null) == "minimal_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Short Height + Boxed Width
        </option>
        <option value=\"minimal_bc full_width_bc\"
        ";
        // line 27
        if ((($context["basel_titles_listings"] ?? null) == "minimal_bc full_width_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Short Height + Full Width
        </option>
        <option value=\"minimal_bc normal_height_bc\"
        ";
        // line 31
        if ((($context["basel_titles_listings"] ?? null) == "minimal_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Normal Height + Boxed Width
        </option>
        <option value=\"minimal_bc full_width_bc normal_height_bc\"
        ";
        // line 35
        if ((($context["basel_titles_listings"] ?? null) == "minimal_bc full_width_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Normal Height + Full Width
        </option>
        <option value=\"minimal_inline_bc\"
        ";
        // line 39
        if ((($context["basel_titles_listings"] ?? null) == "minimal_inline_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal Inline + Short Height
        </option>
        <option value=\"minimal_inline_bc normal_height_bc\"
        ";
        // line 43
        if ((($context["basel_titles_listings"] ?? null) == "minimal_inline_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal Inline + Normal Height
        </option>
        <option value=\"title_in_bc\"";
        // line 46
        if ((($context["basel_titles_listings"] ?? null) == "title_in_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Short Height
        </option>
        <option value=\"title_in_bc normal_height_bc\"";
        // line 49
        if ((($context["basel_titles_listings"] ?? null) == "title_in_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Normal Height
        </option>
        <option value=\"title_in_bc tall_height_bc\"";
        // line 52
        if ((($context["basel_titles_listings"] ?? null) == "title_in_bc tall_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Tall Height
        </option>
        <option value=\"title_in_bc extra_tall_height_bc\"";
        // line 55
        if ((($context["basel_titles_listings"] ?? null) == "title_in_bc extra_tall_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Extra Tall Height
        </option>
    </select>
</div>                   
</div>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\">Product pages</label>
<div class=\"col-sm-10\">
    <select name=\"settings[basel][basel_titles_product]\" class=\"form-control\">
        <option value=\"default_bc\"
        ";
        // line 67
        if ((($context["basel_titles_product"] ?? null) == "default_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style + Short Height + Boxed Width
        </option>
        <option value=\"default_bc full_width_bc\"
        ";
        // line 71
        if ((($context["basel_titles_product"] ?? null) == "default_bc full_width_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style + Short Height + Full Width
        </option>
        <option value=\"default_bc normal_height_bc\"
        ";
        // line 75
        if ((($context["basel_titles_product"] ?? null) == "default_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style / Normal Height + Boxed Width
        </option>
        <option value=\"default_bc full_width_bc normal_height_bc\"
        ";
        // line 79
        if ((($context["basel_titles_product"] ?? null) == "default_bc full_width_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style / Normal Height + Full Width
        </option>
        <option value=\"minimal_bc\"
        ";
        // line 83
        if ((($context["basel_titles_product"] ?? null) == "minimal_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Short Height + Boxed Width
        </option>
        <option value=\"minimal_bc full_width_bc\"
        ";
        // line 87
        if ((($context["basel_titles_product"] ?? null) == "minimal_bc full_width_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Short Height + Full Width
        </option>
        <option value=\"minimal_bc normal_height_bc\"
        ";
        // line 91
        if ((($context["basel_titles_product"] ?? null) == "minimal_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Normal Height + Boxed Width
        </option>
        <option value=\"minimal_bc full_width_bc normal_height_bc\"
        ";
        // line 95
        if ((($context["basel_titles_product"] ?? null) == "minimal_bc full_width_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Normal Height + Full Width
        </option>
        <option value=\"minimal_inline_bc\"
        ";
        // line 99
        if ((($context["basel_titles_product"] ?? null) == "minimal_inline_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal Inline + Short Height
        </option>
        <option value=\"minimal_inline_bc normal_height_bc\"
        ";
        // line 103
        if ((($context["basel_titles_product"] ?? null) == "minimal_inline_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal Inline + Normal Height
        </option>
        <option value=\"title_in_bc\"";
        // line 106
        if ((($context["basel_titles_product"] ?? null) == "title_in_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Short Height
        </option>
        <option value=\"title_in_bc normal_height_bc\"";
        // line 109
        if ((($context["basel_titles_product"] ?? null) == "title_in_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Normal Height
        </option>
        <option value=\"title_in_bc tall_height_bc\"";
        // line 112
        if ((($context["basel_titles_product"] ?? null) == "title_in_bc tall_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Tall Height
        </option>
        <option value=\"title_in_bc extra_tall_height_bc\"";
        // line 115
        if ((($context["basel_titles_product"] ?? null) == "title_in_bc extra_tall_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Extra Tall Height
        </option>
    </select>
</div>                   
</div>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Select page title style on account and affiliate pages\">Account pages</span></label>
<div class=\"col-sm-10\">
    <select name=\"settings[basel][basel_titles_account]\" class=\"form-control\">
        <option value=\"default_bc\"
        ";
        // line 127
        if ((($context["basel_titles_account"] ?? null) == "default_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style + Short Height + Boxed Width
        </option>
        <option value=\"default_bc full_width_bc\"
        ";
        // line 131
        if ((($context["basel_titles_account"] ?? null) == "default_bc full_width_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style + Short Height + Full Width
        </option>
        <option value=\"default_bc normal_height_bc\"
        ";
        // line 135
        if ((($context["basel_titles_account"] ?? null) == "default_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style / Normal Height + Boxed Width
        </option>
        <option value=\"default_bc full_width_bc normal_height_bc\"
        ";
        // line 139
        if ((($context["basel_titles_account"] ?? null) == "default_bc full_width_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style / Normal Height + Full Width
        </option>
        <option value=\"minimal_bc\"
        ";
        // line 143
        if ((($context["basel_titles_account"] ?? null) == "minimal_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Short Height + Boxed Width
        </option>
        <option value=\"minimal_bc full_width_bc\"
        ";
        // line 147
        if ((($context["basel_titles_account"] ?? null) == "minimal_bc full_width_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Short Height + Full Width
        </option>
        <option value=\"minimal_bc normal_height_bc\"
        ";
        // line 151
        if ((($context["basel_titles_account"] ?? null) == "minimal_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Normal Height + Boxed Width
        </option>
        <option value=\"minimal_bc full_width_bc normal_height_bc\"
        ";
        // line 155
        if ((($context["basel_titles_account"] ?? null) == "minimal_bc full_width_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Normal Height + Full Width
        </option>
        <option value=\"minimal_inline_bc\"
        ";
        // line 159
        if ((($context["basel_titles_account"] ?? null) == "minimal_inline_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal Inline + Short Height
        </option>
        <option value=\"minimal_inline_bc normal_height_bc\"
        ";
        // line 163
        if ((($context["basel_titles_account"] ?? null) == "minimal_inline_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal Inline + Normal Height
        </option>
        <option value=\"title_in_bc\"";
        // line 166
        if ((($context["basel_titles_account"] ?? null) == "title_in_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Short Height
        </option>
        <option value=\"title_in_bc normal_height_bc\"";
        // line 169
        if ((($context["basel_titles_account"] ?? null) == "title_in_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Normal Height
        </option>
        <option value=\"title_in_bc tall_height_bc\"";
        // line 172
        if ((($context["basel_titles_account"] ?? null) == "title_in_bc tall_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Tall Height
        </option>
        <option value=\"title_in_bc extra_tall_height_bc\"";
        // line 175
        if ((($context["basel_titles_account"] ?? null) == "title_in_bc extra_tall_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Extra Tall Height
        </option>
    </select>
</div>                   
</div>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Select page title style on shopping cart and checkout pages\">Checkout</span></label>
<div class=\"col-sm-10\">
    <select name=\"settings[basel][basel_titles_checkout]\" class=\"form-control\">
        <option value=\"default_bc\"
        ";
        // line 187
        if ((($context["basel_titles_checkout"] ?? null) == "default_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style + Short Height + Boxed Width
        </option>
        <option value=\"default_bc full_width_bc\"
        ";
        // line 191
        if ((($context["basel_titles_checkout"] ?? null) == "default_bc full_width_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style + Short Height + Full Width
        </option>
        <option value=\"default_bc normal_height_bc\"
        ";
        // line 195
        if ((($context["basel_titles_checkout"] ?? null) == "default_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style / Normal Height + Boxed Width
        </option>
        <option value=\"default_bc full_width_bc normal_height_bc\"
        ";
        // line 199
        if ((($context["basel_titles_checkout"] ?? null) == "default_bc full_width_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style / Normal Height + Full Width
        </option>
        <option value=\"minimal_bc\"
        ";
        // line 203
        if ((($context["basel_titles_checkout"] ?? null) == "minimal_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Short Height + Boxed Width
        </option>
        <option value=\"minimal_bc full_width_bc\"
        ";
        // line 207
        if ((($context["basel_titles_checkout"] ?? null) == "minimal_bc full_width_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Short Height + Full Width
        </option>
        <option value=\"minimal_bc normal_height_bc\"
        ";
        // line 211
        if ((($context["basel_titles_checkout"] ?? null) == "minimal_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Normal Height + Boxed Width
        </option>
        <option value=\"minimal_bc full_width_bc normal_height_bc\"
        ";
        // line 215
        if ((($context["basel_titles_checkout"] ?? null) == "minimal_bc full_width_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Normal Height + Full Width
        </option>
        <option value=\"minimal_inline_bc\"
        ";
        // line 219
        if ((($context["basel_titles_checkout"] ?? null) == "minimal_inline_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal Inline + Short Height
        </option>
        <option value=\"minimal_inline_bc normal_height_bc\"
        ";
        // line 223
        if ((($context["basel_titles_checkout"] ?? null) == "minimal_inline_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal Inline + Normal Height
        </option>
        <option value=\"title_in_bc\"";
        // line 226
        if ((($context["basel_titles_checkout"] ?? null) == "title_in_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Short Height
        </option>
        <option value=\"title_in_bc normal_height_bc\"";
        // line 229
        if ((($context["basel_titles_checkout"] ?? null) == "title_in_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Normal Height
        </option>
        <option value=\"title_in_bc tall_height_bc\"";
        // line 232
        if ((($context["basel_titles_checkout"] ?? null) == "title_in_bc tall_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Tall Height
        </option>
        <option value=\"title_in_bc extra_tall_height_bc\"";
        // line 235
        if ((($context["basel_titles_checkout"] ?? null) == "title_in_bc extra_tall_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Extra Tall Height
        </option>
    </select>
</div>                   
</div>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\">Contact page</label>
<div class=\"col-sm-10\">
    <select name=\"settings[basel][basel_titles_contact]\" class=\"form-control\">
        <option value=\"default_bc\"
        ";
        // line 247
        if ((($context["basel_titles_contact"] ?? null) == "default_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style + Short Height + Boxed Width
        </option>
        <option value=\"default_bc full_width_bc\"
        ";
        // line 251
        if ((($context["basel_titles_contact"] ?? null) == "default_bc full_width_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style + Short Height + Full Width
        </option>
        <option value=\"default_bc normal_height_bc\"
        ";
        // line 255
        if ((($context["basel_titles_contact"] ?? null) == "default_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style / Normal Height + Boxed Width
        </option>
        <option value=\"default_bc full_width_bc normal_height_bc\"
        ";
        // line 259
        if ((($context["basel_titles_contact"] ?? null) == "default_bc full_width_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style / Normal Height + Full Width
        </option>
        <option value=\"minimal_bc\"
        ";
        // line 263
        if ((($context["basel_titles_contact"] ?? null) == "minimal_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Short Height + Boxed Width
        </option>
        <option value=\"minimal_bc full_width_bc\"
        ";
        // line 267
        if ((($context["basel_titles_contact"] ?? null) == "minimal_bc full_width_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Short Height + Full Width
        </option>
        <option value=\"minimal_bc normal_height_bc\"
        ";
        // line 271
        if ((($context["basel_titles_contact"] ?? null) == "minimal_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Normal Height + Boxed Width
        </option>
        <option value=\"minimal_bc full_width_bc normal_height_bc\"
        ";
        // line 275
        if ((($context["basel_titles_contact"] ?? null) == "minimal_bc full_width_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Normal Height + Full Width
        </option>
        <option value=\"minimal_inline_bc\"
        ";
        // line 279
        if ((($context["basel_titles_contact"] ?? null) == "minimal_inline_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal Inline + Short Height
        </option>
        <option value=\"minimal_inline_bc normal_height_bc\"
        ";
        // line 283
        if ((($context["basel_titles_contact"] ?? null) == "minimal_inline_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal Inline + Normal Height
        </option>
        <option value=\"title_in_bc\"";
        // line 286
        if ((($context["basel_titles_contact"] ?? null) == "title_in_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Short Height
        </option>
        <option value=\"title_in_bc normal_height_bc\"";
        // line 289
        if ((($context["basel_titles_contact"] ?? null) == "title_in_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Normal Height
        </option>
        <option value=\"title_in_bc tall_height_bc\"";
        // line 292
        if ((($context["basel_titles_contact"] ?? null) == "title_in_bc tall_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Tall Height
        </option>
        <option value=\"title_in_bc extra_tall_height_bc\"";
        // line 295
        if ((($context["basel_titles_contact"] ?? null) == "title_in_bc extra_tall_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Extra Tall Height
        </option>
    </select>
</div>                   
</div>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\">Blog pages</label>
<div class=\"col-sm-10\">
    <select name=\"settings[basel][basel_titles_blog]\" class=\"form-control\">
        <option value=\"default_bc\"
        ";
        // line 307
        if ((($context["basel_titles_blog"] ?? null) == "default_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style + Short Height + Boxed Width
        </option>
        <option value=\"default_bc full_width_bc\"
        ";
        // line 311
        if ((($context["basel_titles_blog"] ?? null) == "default_bc full_width_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style + Short Height + Full Width
        </option>
        <option value=\"default_bc normal_height_bc\"
        ";
        // line 315
        if ((($context["basel_titles_blog"] ?? null) == "default_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style / Normal Height + Boxed Width
        </option>
        <option value=\"default_bc full_width_bc normal_height_bc\"
        ";
        // line 319
        if ((($context["basel_titles_blog"] ?? null) == "default_bc full_width_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style / Normal Height + Full Width
        </option>
        <option value=\"minimal_bc\"
        ";
        // line 323
        if ((($context["basel_titles_blog"] ?? null) == "minimal_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Short Height + Boxed Width
        </option>
        <option value=\"minimal_bc full_width_bc\"
        ";
        // line 327
        if ((($context["basel_titles_blog"] ?? null) == "minimal_bc full_width_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Short Height + Full Width
        </option>
        <option value=\"minimal_bc normal_height_bc\"
        ";
        // line 331
        if ((($context["basel_titles_blog"] ?? null) == "minimal_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Normal Height + Boxed Width
        </option>
        <option value=\"minimal_bc full_width_bc normal_height_bc\"
        ";
        // line 335
        if ((($context["basel_titles_blog"] ?? null) == "minimal_bc full_width_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Normal Height + Full Width
        </option>
        <option value=\"minimal_inline_bc\"
        ";
        // line 339
        if ((($context["basel_titles_blog"] ?? null) == "minimal_inline_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal Inline + Short Height
        </option>
        <option value=\"minimal_inline_bc normal_height_bc\"
        ";
        // line 343
        if ((($context["basel_titles_blog"] ?? null) == "minimal_inline_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal Inline + Normal Height
        </option>
        <option value=\"title_in_bc\"";
        // line 346
        if ((($context["basel_titles_blog"] ?? null) == "title_in_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Short Height
        </option>
        <option value=\"title_in_bc normal_height_bc\"";
        // line 349
        if ((($context["basel_titles_blog"] ?? null) == "title_in_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Normal Height
        </option>
        <option value=\"title_in_bc tall_height_bc\"";
        // line 352
        if ((($context["basel_titles_blog"] ?? null) == "title_in_bc tall_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Tall Height
        </option>
        <option value=\"title_in_bc extra_tall_height_bc\"";
        // line 355
        if ((($context["basel_titles_blog"] ?? null) == "title_in_bc extra_tall_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Extra Tall Height
        </option>
    </select>
</div>                   
</div>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Select page title style on information pages. This style will also work as default fall back style\">Catalog pages</span></label>
<div class=\"col-sm-10\">
    <select name=\"settings[basel][basel_titles_default]\" class=\"form-control\">
        <option value=\"default_bc\"
        ";
        // line 367
        if ((($context["basel_titles_default"] ?? null) == "default_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style + Short Height + Boxed Width
        </option>
        <option value=\"default_bc full_width_bc\"
        ";
        // line 371
        if ((($context["basel_titles_default"] ?? null) == "default_bc full_width_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style + Short Height + Full Width
        </option>
        <option value=\"default_bc normal_height_bc\"
        ";
        // line 375
        if ((($context["basel_titles_default"] ?? null) == "default_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style / Normal Height + Boxed Width
        </option>
        <option value=\"default_bc full_width_bc normal_height_bc\"
        ";
        // line 379
        if ((($context["basel_titles_default"] ?? null) == "default_bc full_width_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Default Style / Normal Height + Full Width
        </option>
        <option value=\"minimal_bc\"
        ";
        // line 383
        if ((($context["basel_titles_default"] ?? null) == "minimal_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Short Height + Boxed Width
        </option>
        <option value=\"minimal_bc full_width_bc\"
        ";
        // line 387
        if ((($context["basel_titles_default"] ?? null) == "minimal_bc full_width_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Short Height + Full Width
        </option>
        <option value=\"minimal_bc normal_height_bc\"
        ";
        // line 391
        if ((($context["basel_titles_default"] ?? null) == "minimal_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Normal Height + Boxed Width
        </option>
        <option value=\"minimal_bc full_width_bc normal_height_bc\"
        ";
        // line 395
        if ((($context["basel_titles_default"] ?? null) == "minimal_bc full_width_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal + Normal Height + Full Width
        </option>
        <option value=\"minimal_inline_bc\"
        ";
        // line 399
        if ((($context["basel_titles_default"] ?? null) == "minimal_inline_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal Inline + Short Height
        </option>
        <option value=\"minimal_inline_bc normal_height_bc\"
        ";
        // line 403
        if ((($context["basel_titles_default"] ?? null) == "minimal_inline_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Minimal Inline + Normal Height
        </option>
        <option value=\"title_in_bc\"";
        // line 406
        if ((($context["basel_titles_default"] ?? null) == "title_in_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Short Height
        </option>
        <option value=\"title_in_bc normal_height_bc\"";
        // line 409
        if ((($context["basel_titles_default"] ?? null) == "title_in_bc normal_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Normal Height
        </option>
        <option value=\"title_in_bc tall_height_bc\"";
        // line 412
        if ((($context["basel_titles_default"] ?? null) == "title_in_bc tall_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Tall Height
        </option>
        <option value=\"title_in_bc extra_tall_height_bc\"";
        // line 415
        if ((($context["basel_titles_default"] ?? null) == "title_in_bc extra_tall_height_bc")) {
            echo " selected=\"selected\"";
        }
        echo ">
        Page Title Inside Breadcrumb + Extra Tall Height
        </option>
    </select>
</div>                   
</div>

<legend>Back button</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Adds a back button in the breadcrumbs\">Back button</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][basel_back_btn]\" value=\"0\" ";
        // line 426
        if ((($context["basel_back_btn"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][basel_back_btn]\" value=\"1\" ";
        // line 427
        if ((($context["basel_back_btn"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>


";
    }

    public function getTemplateName()
    {
        return "extension/basel/panel_tabs/page-titles.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  960 => 427,  954 => 426,  938 => 415,  930 => 412,  922 => 409,  914 => 406,  906 => 403,  897 => 399,  888 => 395,  879 => 391,  870 => 387,  861 => 383,  852 => 379,  843 => 375,  834 => 371,  825 => 367,  808 => 355,  800 => 352,  792 => 349,  784 => 346,  776 => 343,  767 => 339,  758 => 335,  749 => 331,  740 => 327,  731 => 323,  722 => 319,  713 => 315,  704 => 311,  695 => 307,  678 => 295,  670 => 292,  662 => 289,  654 => 286,  646 => 283,  637 => 279,  628 => 275,  619 => 271,  610 => 267,  601 => 263,  592 => 259,  583 => 255,  574 => 251,  565 => 247,  548 => 235,  540 => 232,  532 => 229,  524 => 226,  516 => 223,  507 => 219,  498 => 215,  489 => 211,  480 => 207,  471 => 203,  462 => 199,  453 => 195,  444 => 191,  435 => 187,  418 => 175,  410 => 172,  402 => 169,  394 => 166,  386 => 163,  377 => 159,  368 => 155,  359 => 151,  350 => 147,  341 => 143,  332 => 139,  323 => 135,  314 => 131,  305 => 127,  288 => 115,  280 => 112,  272 => 109,  264 => 106,  256 => 103,  247 => 99,  238 => 95,  229 => 91,  220 => 87,  211 => 83,  202 => 79,  193 => 75,  184 => 71,  175 => 67,  158 => 55,  150 => 52,  142 => 49,  134 => 46,  126 => 43,  117 => 39,  108 => 35,  99 => 31,  90 => 27,  81 => 23,  72 => 19,  63 => 15,  54 => 11,  45 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/basel/panel_tabs/page-titles.twig", "/Users/tomek/Herd/reprograv/upload/admin/view/template/extension/basel/panel_tabs/page-titles.twig");
    }
}
