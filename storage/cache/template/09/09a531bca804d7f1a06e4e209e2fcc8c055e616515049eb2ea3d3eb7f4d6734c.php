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

/* extension/module/msmart_search/live_filter.twig */
class __TwigTemplate_6138c9fbf40b4dc686e54a1b83b5a0b72a38ca2fcdd29df842dba9b64c9500a9 extends \Twig\Template
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
        $this->loadTemplate("extension/module/msmart_search/_header.twig", "extension/module/msmart_search/live_filter.twig", 1)->display($context);
        // line 2
        echo "<br />

<ul class=\"nav nav-tabs\">
\t<li class=\"active\"><a href=\"#lf-general\" data-toggle=\"tab\"><i class=\"fa fa-cog\" aria-hidden=\"true\"></i> ";
        // line 5
        echo ($context["text_general"] ?? null);
        echo "</a></li>
\t<li><a href=\"#lf-products\" data-toggle=\"tab\"><i class=\"fa fa-cube\" aria-hidden=\"true\"></i> ";
        // line 6
        echo ($context["text_products"] ?? null);
        echo "</a></li>
\t<li><a href=\"#lf-categories\" data-toggle=\"tab\"><i class=\"fa fa-list-ul\" aria-hidden=\"true\"></i> ";
        // line 7
        echo ($context["text_categories"] ?? null);
        echo "</a></li>
\t<li><a href=\"#lf-styles\" data-toggle=\"tab\"><i class=\"fa fa-adjust\" aria-hidden=\"true\"></i> ";
        // line 8
        echo ($context["tab_styles"] ?? null);
        echo "</a></li>
</ul>

<div class=\"tab-content\">
\t<br />
\t<div class=\"tab-pane active\" id=\"lf-general\">
\t\t<table class=\"table table-tbody\">
\t\t\t<tbody>
\t\t\t\t<tr>
\t\t\t\t\t<td width=\"300\">";
        // line 17
        echo ($context["entry_mode"] ?? null);
        echo "</td>
\t\t\t\t\t<td>
\t\t\t\t\t\t<table>
\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t<label class=\"text-center\">
\t\t\t\t\t\t\t\t\t\t<img src=\"";
        // line 23
        echo ($context["HTTP_URL"] ?? null);
        echo "view/stylesheet/mss/images/view-standard.png\" />
\t\t\t\t\t\t\t\t\t\t<br />
\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"";
        // line 25
        echo ($context["_name"] ?? null);
        echo "[mode]\" value=\"standard\" ";
        echo (((twig_test_empty((($__internal_compile_0 = ($context["settings"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["mode"] ?? null) : null)) || ((($__internal_compile_1 = ($context["settings"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["mode"] ?? null) : null) == "standard"))) ? ("checked=\"checked\"") : (""));
        echo " />
\t\t\t\t\t\t\t\t\t\t";
        // line 26
        echo ($context["text_standard"] ?? null);
        echo " 
\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t<label class=\"text-center\">
\t\t\t\t\t\t\t\t\t\t<img src=\"";
        // line 31
        echo ($context["HTTP_URL"] ?? null);
        echo "view/stylesheet/mss/images/view-tabs.png\" />
\t\t\t\t\t\t\t\t\t\t<br />
\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"";
        // line 33
        echo ($context["_name"] ?? null);
        echo "[mode]\" value=\"tabs\" ";
        echo ((( !twig_test_empty((($__internal_compile_2 = ($context["settings"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["mode"] ?? null) : null)) && ((($__internal_compile_3 = ($context["settings"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["mode"] ?? null) : null) == "tabs"))) ? ("checked=\"checked\"") : (""));
        echo " />
\t\t\t\t\t\t\t\t\t\t";
        // line 34
        echo ($context["text_tabs"] ?? null);
        echo " 
\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t</table>
\t\t\t\t\t\t<span class=\"help help-block\">
\t\t\t\t\t\t\t";
        // line 40
        echo ($context["text_tabs_help"] ?? null);
        echo " 
\t\t\t\t\t\t</span>
\t\t\t\t\t</td>
\t\t\t\t</tr>
\t\t\t\t<tr>
\t\t\t\t\t<td width=\"300\">";
        // line 45
        echo ($context["entry_search_input_selector"] ?? null);
        echo "</td>
\t\t\t\t\t<td>
\t\t\t\t\t\t<input type=\"text\" name=\"";
        // line 47
        echo ($context["_name"] ?? null);
        echo "[input_selector]\" class=\"form-control\" value=\"";
        echo ((twig_test_empty((($__internal_compile_4 = ($context["settings"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["input_selector"] ?? null) : null))) ? ("#search input[type=text]:first") : ((($__internal_compile_5 = ($context["settings"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["input_selector"] ?? null) : null)));
        echo "\"/>
\t\t\t\t\t</td>
\t\t\t\t</tr>
\t\t\t\t<tr>
\t\t\t\t\t<td>";
        // line 51
        echo ($context["text_standard_mode"] ?? null);
        echo " / ";
        echo ($context["entry_max_height"] ?? null);
        echo "</td>
\t\t\t\t\t<td>
\t\t\t\t\t\t<div class=\"input-group col-lg-2\">
\t\t\t\t\t\t\t<input type=\"text\" name=\"";
        // line 54
        echo ($context["_name"] ?? null);
        echo "[max_height]\" class=\"form-control\" value=\"";
        echo ((twig_test_empty((($__internal_compile_6 = ($context["settings"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["max_height"] ?? null) : null))) ? ("250") : ((($__internal_compile_7 = ($context["settings"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["max_height"] ?? null) : null)));
        echo "\"/>
\t\t\t\t\t\t\t<div class=\"input-group-addon\">
\t\t\t\t\t\t\t\tpx
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</td>
\t\t\t\t</tr>
\t\t\t\t<tr>
\t\t\t\t\t<td>";
        // line 62
        echo ($context["text_tabs_mode"] ?? null);
        echo " / ";
        echo ($context["entry_max_height"] ?? null);
        echo "</td>
\t\t\t\t\t<td>
\t\t\t\t\t\t<div class=\"input-group col-lg-2\">
\t\t\t\t\t\t\t<input type=\"text\" name=\"";
        // line 65
        echo ($context["_name"] ?? null);
        echo "[max_height_tabs]\" class=\"form-control\" value=\"";
        echo ((twig_test_empty((($__internal_compile_8 = ($context["settings"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["max_height_tabs"] ?? null) : null))) ? ("430") : ((($__internal_compile_9 = ($context["settings"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["max_height_tabs"] ?? null) : null)));
        echo "\"/>
\t\t\t\t\t\t\t<div class=\"input-group-addon\">
\t\t\t\t\t\t\t\tpx
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</td>
\t\t\t\t</tr>
\t\t\t\t<tr>
\t\t\t\t\t<td>";
        // line 73
        echo ($context["entry_show_loading_icon"] ?? null);
        echo "</td>
\t\t\t\t\t<td>
\t\t\t\t\t\t<input type=\"checkbox\" name=\"";
        // line 75
        echo ($context["_name"] ?? null);
        echo "[show_loading_icon]\" value=\"1\" ";
        echo (( !twig_test_empty((($__internal_compile_10 = ($context["settings"] ?? null)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["show_loading_icon"] ?? null) : null))) ? (" checked=\"checked\"") : (""));
        echo "/>
\t\t\t\t\t</td>
\t\t\t\t</tr>
\t\t\t\t<tr>
\t\t\t\t\t<td>
\t\t\t\t\t\t";
        // line 80
        echo ($context["entry_show_button_view_all"] ?? null);
        echo "
\t\t\t\t\t\t<span class=\"help help-block\">";
        // line 81
        echo ($context["text_only_for_standard_mode"] ?? null);
        echo "</span>
\t\t\t\t\t</td>
\t\t\t\t\t<td>
\t\t\t\t\t\t<input type=\"checkbox\" name=\"";
        // line 84
        echo ($context["_name"] ?? null);
        echo "[show_button_view_all]\" value=\"1\" ";
        echo (( !twig_test_empty((($__internal_compile_11 = ($context["settings"] ?? null)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["show_button_view_all"] ?? null) : null))) ? (" checked=\"checked\"") : (""));
        echo "/>
\t\t\t\t\t</td>
\t\t\t\t</tr>
\t\t\t\t<tr>
\t\t\t\t\t<td>
\t\t\t\t\t\t";
        // line 89
        echo ($context["entry_search_in_product_descriptions"] ?? null);
        echo "
\t\t\t\t\t\t<span class=\"help help-block\">";
        // line 90
        echo ($context["text_only_for_standard_mode"] ?? null);
        echo "</span>
\t\t\t\t\t</td>
\t\t\t\t\t<td>
\t\t\t\t\t\t<input type=\"checkbox\" name=\"";
        // line 93
        echo ($context["_name"] ?? null);
        echo "[search_in_product_descriptions]\" value=\"1\" ";
        echo (( !twig_test_empty((($__internal_compile_12 = ($context["settings"] ?? null)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["search_in_product_descriptions"] ?? null) : null))) ? (" checked=\"checked\"") : (""));
        echo "/>
\t\t\t\t\t</td>
\t\t\t\t</tr>
\t\t\t\t<tr>
\t\t\t\t\t<td>";
        // line 97
        echo ($context["entry_limit"] ?? null);
        echo "</td>
\t\t\t\t\t<td>
\t\t\t\t\t\t<div class=\"input-group col-lg-2\">
\t\t\t\t\t\t\t<input type=\"text\" name=\"";
        // line 100
        echo ($context["_name"] ?? null);
        echo "[limit]\" class=\"form-control\" value=\"";
        echo ((twig_test_empty((($__internal_compile_13 = ($context["settings"] ?? null)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["limit"] ?? null) : null))) ? ("10") : ((($__internal_compile_14 = ($context["settings"] ?? null)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["limit"] ?? null) : null)));
        echo "\"/>
\t\t\t\t\t\t</div>
\t\t\t\t\t</td>
\t\t\t\t</tr>
\t\t\t\t<tr>
\t\t\t\t\t<td>
\t\t\t\t\t\t";
        // line 106
        echo ($context["entry_limit_similar_phrases"] ?? null);
        echo " 
\t\t\t\t\t\t<span class=\"help help-block\">";
        // line 107
        echo ($context["text_only_for_tabs_mode"] ?? null);
        echo "</span>
\t\t\t\t\t</td>
\t\t\t\t\t<td>
\t\t\t\t\t\t<div class=\"input-group col-lg-2\">
\t\t\t\t\t\t\t<input type=\"text\" name=\"";
        // line 111
        echo ($context["_name"] ?? null);
        echo "[limit_similar_phrases]\" class=\"form-control\" value=\"";
        echo ((twig_test_empty((($__internal_compile_15 = ($context["settings"] ?? null)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["limit_similar_phrases"] ?? null) : null))) ? ("10") : ((($__internal_compile_16 = ($context["settings"] ?? null)) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16["limit_similar_phrases"] ?? null) : null)));
        echo "\"/>
\t\t\t\t\t\t</div>
\t\t\t\t\t</td>
\t\t\t\t</tr>
\t\t\t\t<tr>
\t\t\t\t\t<td>";
        // line 116
        echo ($context["entry_min_length"] ?? null);
        echo "</td>
\t\t\t\t\t<td>
\t\t\t\t\t\t<div class=\"input-group col-lg-2\">
\t\t\t\t\t\t\t<input type=\"text\" name=\"";
        // line 119
        echo ($context["_name"] ?? null);
        echo "[min_length]\" class=\"form-control\" value=\"";
        echo ((twig_test_empty((($__internal_compile_17 = ($context["settings"] ?? null)) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["min_length"] ?? null) : null))) ? ("1") : ((($__internal_compile_18 = ($context["settings"] ?? null)) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18["min_length"] ?? null) : null)));
        echo "\"/>
\t\t\t\t\t\t</div>
\t\t\t\t\t</td>
\t\t\t\t</tr>
\t\t\t</tbody>
\t\t</table>
\t</div>
\t<div class=\"tab-pane\" id=\"lf-products\">
\t\t<table class=\"table table-tbody\">
\t\t\t<tr>
\t\t\t\t<td width=\"200\">";
        // line 129
        echo ($context["entry_enabled"] ?? null);
        echo "</td>
\t\t\t\t<td>
\t\t\t\t\t<input type=\"checkbox\" name=\"";
        // line 131
        echo ($context["_name"] ?? null);
        echo "[enabled]\" value=\"1\" ";
        echo ((twig_test_empty((($__internal_compile_19 = ($context["settings"] ?? null)) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19["enabled"] ?? null) : null))) ? ("") : (" checked=\"checked\""));
        echo "/>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td>
\t\t\t\t\t";
        // line 136
        echo ($context["entry_show_image"] ?? null);
        echo " 
\t\t\t\t\t<span class=\"help help-block\">";
        // line 137
        echo ($context["text_only_for_standard_mode"] ?? null);
        echo "</span>
\t\t\t\t</td>
\t\t\t\t<td>
\t\t\t\t\t<input type=\"checkbox\" name=\"";
        // line 140
        echo ($context["_name"] ?? null);
        echo "[show_image]\" value=\"1\" ";
        echo ((twig_test_empty((($__internal_compile_20 = ($context["settings"] ?? null)) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20["show_image"] ?? null) : null))) ? ("") : (" checked=\"checked\""));
        echo "/>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td>";
        // line 144
        echo ($context["text_standard_mode"] ?? null);
        echo " / ";
        echo ($context["entry_image_size"] ?? null);
        echo "</td>
\t\t\t\t<td>
\t\t\t\t\t<div class=\"input-group col-lg-2\">
\t\t\t\t\t\t<input type=\"text\" name=\"";
        // line 147
        echo ($context["_name"] ?? null);
        echo "[img_width]\" class=\"form-control\" value=\"";
        echo ((twig_test_empty((($__internal_compile_21 = ($context["settings"] ?? null)) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21["img_width"] ?? null) : null))) ? ("40") : ((($__internal_compile_22 = ($context["settings"] ?? null)) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22["img_width"] ?? null) : null)));
        echo "\"/>
\t\t\t\t\t\t<div class=\"input-group-addon\">x</div>
\t\t\t\t\t\t<input type=\"text\" name=\"";
        // line 149
        echo ($context["_name"] ?? null);
        echo "[img_height]\" class=\"form-control\" value=\"";
        echo ((twig_test_empty((($__internal_compile_23 = ($context["settings"] ?? null)) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23["img_height"] ?? null) : null))) ? ("40") : ((($__internal_compile_24 = ($context["settings"] ?? null)) && is_array($__internal_compile_24) || $__internal_compile_24 instanceof ArrayAccess ? ($__internal_compile_24["img_height"] ?? null) : null)));
        echo "\"/>
\t\t\t\t\t\t<div class=\"input-group-addon\">px</div>
\t\t\t\t\t</div>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td>";
        // line 155
        echo ($context["text_tabs_mode"] ?? null);
        echo " / ";
        echo ($context["entry_image_size"] ?? null);
        echo "</td>
\t\t\t\t<td>
\t\t\t\t\t<div class=\"input-group col-lg-2\">
\t\t\t\t\t\t<input type=\"text\" name=\"";
        // line 158
        echo ($context["_name"] ?? null);
        echo "[img_width_tabs]\" class=\"form-control\" value=\"";
        echo ((twig_test_empty((($__internal_compile_25 = ($context["settings"] ?? null)) && is_array($__internal_compile_25) || $__internal_compile_25 instanceof ArrayAccess ? ($__internal_compile_25["img_width_tabs"] ?? null) : null))) ? ("122") : ((($__internal_compile_26 = ($context["settings"] ?? null)) && is_array($__internal_compile_26) || $__internal_compile_26 instanceof ArrayAccess ? ($__internal_compile_26["img_width_tabs"] ?? null) : null)));
        echo "\"/>
\t\t\t\t\t\t<div class=\"input-group-addon\">x</div>
\t\t\t\t\t\t<input type=\"text\" name=\"";
        // line 160
        echo ($context["_name"] ?? null);
        echo "[img_height_tabs]\" class=\"form-control\" value=\"";
        echo ((twig_test_empty((($__internal_compile_27 = ($context["settings"] ?? null)) && is_array($__internal_compile_27) || $__internal_compile_27 instanceof ArrayAccess ? ($__internal_compile_27["img_height_tabs"] ?? null) : null))) ? ("122") : ((($__internal_compile_28 = ($context["settings"] ?? null)) && is_array($__internal_compile_28) || $__internal_compile_28 instanceof ArrayAccess ? ($__internal_compile_28["img_height_tabs"] ?? null) : null)));
        echo "\"/>
\t\t\t\t\t\t<div class=\"input-group-addon\">px</div>
\t\t\t\t\t</div>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td>
\t\t\t\t\t";
        // line 167
        echo ($context["entry_product_columns"] ?? null);
        echo " 
\t\t\t\t<span class=\"help help-block\">";
        // line 168
        echo ($context["text_only_for_tabs_mode"] ?? null);
        echo "</span>
\t\t\t\t</td>
\t\t\t\t<td>
\t\t\t\t\t<div class=\"input-group col-lg-2\">
\t\t\t\t\t\t<input type=\"text\" name=\"";
        // line 172
        echo ($context["_name"] ?? null);
        echo "[product_columns]\" class=\"form-control\" value=\"";
        echo ((twig_test_empty((($__internal_compile_29 = ($context["settings"] ?? null)) && is_array($__internal_compile_29) || $__internal_compile_29 instanceof ArrayAccess ? ($__internal_compile_29["product_columns"] ?? null) : null))) ? ("3") : ((($__internal_compile_30 = ($context["settings"] ?? null)) && is_array($__internal_compile_30) || $__internal_compile_30 instanceof ArrayAccess ? ($__internal_compile_30["product_columns"] ?? null) : null)));
        echo "\"/>
\t\t\t\t\t</div>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td>";
        // line 177
        echo ($context["entry_show_price"] ?? null);
        echo "</td>
\t\t\t\t<td>
\t\t\t\t\t<input type=\"checkbox\" name=\"";
        // line 179
        echo ($context["_name"] ?? null);
        echo "[show_price]\" value=\"1\" ";
        echo ((twig_test_empty((($__internal_compile_31 = ($context["settings"] ?? null)) && is_array($__internal_compile_31) || $__internal_compile_31 instanceof ArrayAccess ? ($__internal_compile_31["show_price"] ?? null) : null))) ? ("") : (" checked=\"checked\""));
        echo "/>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td>
\t\t\t\t\t";
        // line 184
        echo ($context["entry_show_manufacturer"] ?? null);
        echo " 
\t\t\t\t\t<span class=\"help help-block\">";
        // line 185
        echo ($context["text_only_for_standard_mode"] ?? null);
        echo "</span>
\t\t\t\t</td>
\t\t\t\t<td>
\t\t\t\t\t<input type=\"checkbox\" name=\"";
        // line 188
        echo ($context["_name"] ?? null);
        echo "[show_manufacturer]\" value=\"1\" ";
        echo ((twig_test_empty((($__internal_compile_32 = ($context["settings"] ?? null)) && is_array($__internal_compile_32) || $__internal_compile_32 instanceof ArrayAccess ? ($__internal_compile_32["show_manufacturer"] ?? null) : null))) ? ("") : (" checked=\"checked\""));
        echo "/>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td>
\t\t\t\t\t";
        // line 193
        echo ($context["entry_show_model"] ?? null);
        echo " 
\t\t\t\t\t<span class=\"help help-block\">";
        // line 194
        echo ($context["text_only_for_standard_mode"] ?? null);
        echo "</span>
\t\t\t\t</td>
\t\t\t\t<td>
\t\t\t\t\t<input type=\"checkbox\" name=\"";
        // line 197
        echo ($context["_name"] ?? null);
        echo "[show_model]\" value=\"1\" ";
        echo ((twig_test_empty((($__internal_compile_33 = ($context["settings"] ?? null)) && is_array($__internal_compile_33) || $__internal_compile_33 instanceof ArrayAccess ? ($__internal_compile_33["show_model"] ?? null) : null))) ? ("") : (" checked=\"checked\""));
        echo "/>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td>
\t\t\t\t\t";
        // line 202
        echo ($context["entry_show_header_products"] ?? null);
        echo " 
\t\t\t\t</td>
\t\t\t\t<td>
\t\t\t\t\t<input type=\"checkbox\" name=\"";
        // line 205
        echo ($context["_name"] ?? null);
        echo "[show_header]\" value=\"1\" ";
        echo ((twig_test_empty((($__internal_compile_34 = ($context["settings"] ?? null)) && is_array($__internal_compile_34) || $__internal_compile_34 instanceof ArrayAccess ? ($__internal_compile_34["show_header"] ?? null) : null))) ? ("") : (" checked=\"checked\""));
        echo "/>
\t\t\t\t</td>
\t\t\t</tr>
\t\t</table>
\t</div>
\t<div class=\"tab-pane\" id=\"lf-categories\">
\t\t<center><strong>";
        // line 211
        echo ($context["text_works_only_in_standard_mode"] ?? null);
        echo "</strong></center>
\t\t<table class=\"table table-tbody\">
\t\t\t<tr>
\t\t\t\t<td width=\"200\">";
        // line 214
        echo ($context["entry_enabled"] ?? null);
        echo "</td>
\t\t\t\t<td>
\t\t\t\t\t<input type=\"checkbox\" name=\"";
        // line 216
        echo ($context["_name"] ?? null);
        echo "[enabled_categories]\" value=\"1\" ";
        echo ((twig_test_empty((($__internal_compile_35 = ($context["settings"] ?? null)) && is_array($__internal_compile_35) || $__internal_compile_35 instanceof ArrayAccess ? ($__internal_compile_35["enabled_categories"] ?? null) : null))) ? ("") : (" checked=\"checked\""));
        echo "/>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td>";
        // line 220
        echo ($context["entry_show_image"] ?? null);
        echo "</td>
\t\t\t\t<td>
\t\t\t\t\t<input type=\"checkbox\" name=\"";
        // line 222
        echo ($context["_name"] ?? null);
        echo "[show_image_categories]\" value=\"1\" ";
        echo ((twig_test_empty((($__internal_compile_36 = ($context["settings"] ?? null)) && is_array($__internal_compile_36) || $__internal_compile_36 instanceof ArrayAccess ? ($__internal_compile_36["show_image_categories"] ?? null) : null))) ? ("") : (" checked=\"checked\""));
        echo "/>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td>";
        // line 226
        echo ($context["entry_image_size"] ?? null);
        echo "</td>
\t\t\t\t<td>
\t\t\t\t\t<div class=\"input-group col-lg-2\">
\t\t\t\t\t\t<input type=\"text\" name=\"";
        // line 229
        echo ($context["_name"] ?? null);
        echo "[img_width_categories]\" class=\"form-control\" value=\"";
        echo ((twig_test_empty((($__internal_compile_37 = ($context["settings"] ?? null)) && is_array($__internal_compile_37) || $__internal_compile_37 instanceof ArrayAccess ? ($__internal_compile_37["img_width_categories"] ?? null) : null))) ? ("40") : ((($__internal_compile_38 = ($context["settings"] ?? null)) && is_array($__internal_compile_38) || $__internal_compile_38 instanceof ArrayAccess ? ($__internal_compile_38["img_width_categories"] ?? null) : null)));
        echo "\"/>
\t\t\t\t\t\t<div class=\"input-group-addon\">x</div>
\t\t\t\t\t\t<input type=\"text\" name=\"";
        // line 231
        echo ($context["_name"] ?? null);
        echo "[img_height_categories]\" class=\"form-control\" value=\"";
        echo ((twig_test_empty((($__internal_compile_39 = ($context["settings"] ?? null)) && is_array($__internal_compile_39) || $__internal_compile_39 instanceof ArrayAccess ? ($__internal_compile_39["img_height_categories"] ?? null) : null))) ? ("40") : ((($__internal_compile_40 = ($context["settings"] ?? null)) && is_array($__internal_compile_40) || $__internal_compile_40 instanceof ArrayAccess ? ($__internal_compile_40["img_height_categories"] ?? null) : null)));
        echo "\"/>
\t\t\t\t\t\t<div class=\"input-group-addon\">px</div>
\t\t\t\t\t</div>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td>";
        // line 237
        echo ($context["entry_show_header_categories"] ?? null);
        echo "</td>
\t\t\t\t<td>
\t\t\t\t\t<input type=\"checkbox\" name=\"";
        // line 239
        echo ($context["_name"] ?? null);
        echo "[show_header_categories]\" value=\"1\" ";
        echo ((twig_test_empty((($__internal_compile_41 = ($context["settings"] ?? null)) && is_array($__internal_compile_41) || $__internal_compile_41 instanceof ArrayAccess ? ($__internal_compile_41["show_header_categories"] ?? null) : null))) ? ("") : (" checked=\"checked\""));
        echo "/>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td>";
        // line 243
        echo ($context["entry_show_description"] ?? null);
        echo "</td>
\t\t\t\t<td>
\t\t\t\t\t<input type=\"checkbox\" name=\"";
        // line 245
        echo ($context["_name"] ?? null);
        echo "[show_description_categories]\" value=\"1\" ";
        echo ((twig_test_empty((($__internal_compile_42 = ($context["settings"] ?? null)) && is_array($__internal_compile_42) || $__internal_compile_42 instanceof ArrayAccess ? ($__internal_compile_42["show_description_categories"] ?? null) : null))) ? ("") : (" checked=\"checked\""));
        echo "/>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td>";
        // line 249
        echo ($context["entry_description_max_length"] ?? null);
        echo "</td>
\t\t\t\t<td>
\t\t\t\t\t<div class=\"input-group col-lg-2\">
\t\t\t\t\t\t<input type=\"text\" name=\"";
        // line 252
        echo ($context["_name"] ?? null);
        echo "[description_max_length_categories]\" class=\"form-control\" value=\"";
        echo ((twig_test_empty((($__internal_compile_43 = ($context["settings"] ?? null)) && is_array($__internal_compile_43) || $__internal_compile_43 instanceof ArrayAccess ? ($__internal_compile_43["description_max_length_categories"] ?? null) : null))) ? ("100") : ((($__internal_compile_44 = ($context["settings"] ?? null)) && is_array($__internal_compile_44) || $__internal_compile_44 instanceof ArrayAccess ? ($__internal_compile_44["description_max_length_categories"] ?? null) : null)));
        echo "\"/>
\t\t\t\t\t</div>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td>
\t\t\t\t\t";
        // line 258
        echo ($context["entry_display_categories_first"] ?? null);
        echo " 
\t\t\t\t</td>
\t\t\t\t<td>
\t\t\t\t\t<input type=\"checkbox\" name=\"";
        // line 261
        echo ($context["_name"] ?? null);
        echo "[display_categories_first]\" value=\"1\" ";
        echo ((twig_test_empty((($__internal_compile_45 = ($context["settings"] ?? null)) && is_array($__internal_compile_45) || $__internal_compile_45 instanceof ArrayAccess ? ($__internal_compile_45["display_categories_first"] ?? null) : null))) ? ("") : (" checked=\"checked\""));
        echo "/>
\t\t\t\t\t<span class=\"help help-block\">";
        // line 262
        echo ($context["text_display_categories_first_guide"] ?? null);
        echo "</span>
\t\t\t\t</td>
\t\t\t</tr>
\t\t</table>
\t</div>
\t<div class=\"tab-pane\" id=\"lf-styles\">
\t\t<table class=\"table table-tbody\">
\t\t\t<tr>
\t\t\t\t<td width='25%'>";
        // line 270
        echo ($context["entry_custom_css"] ?? null);
        echo "</td>
\t\t\t\t<td>
\t\t\t\t\t<textarea name=\"";
        // line 272
        echo ($context["_name"] ?? null);
        echo "[custom_css]\" rows=\"10\" class=\"form-control\">";
        echo ((twig_test_empty((($__internal_compile_46 = ($context["settings"] ?? null)) && is_array($__internal_compile_46) || $__internal_compile_46 instanceof ArrayAccess ? ($__internal_compile_46["custom_css"] ?? null) : null))) ? ("") : ((($__internal_compile_47 = ($context["settings"] ?? null)) && is_array($__internal_compile_47) || $__internal_compile_47 instanceof ArrayAccess ? ($__internal_compile_47["custom_css"] ?? null) : null)));
        echo "</textarea>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td style='border-top: none'>
\t\t\t\t\t<i class=\"fa fa-adjust\" style=\"font-size: 18px; margin-bottom: 20px;\"></i>&nbsp; <b>";
        // line 277
        echo ($context["entry_custom_colors"] ?? null);
        echo "</b>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td style='border-top: none'><i class=\"fa fa-header\" style=\"font-size: 18px\"></i>&nbsp; ";
        // line 281
        echo ($context["entry_products_header_color"] ?? null);
        echo "</td>
\t\t\t\t<td style='border-top: none'>
\t\t\t\t\t<div class=\"input-group\" style='width: 300px'>
\t\t\t\t\t\t<span class=\"input-group-addon\">";
        // line 284
        echo ($context["entry_css_color"] ?? null);
        echo "</span>
\t\t\t\t\t\t<input type=\"text\" name=\"";
        // line 285
        echo ($context["_name"] ?? null);
        echo "[custom_color_css][product_header]\" value=\"";
        echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["settings"] ?? null), "custom_color_css", [], "array", false, true, false, 285), "product_header", [], "array", true, true, false, 285)) ? ((($__internal_compile_48 = (($__internal_compile_49 = ($context["settings"] ?? null)) && is_array($__internal_compile_49) || $__internal_compile_49 instanceof ArrayAccess ? ($__internal_compile_49["custom_color_css"] ?? null) : null)) && is_array($__internal_compile_48) || $__internal_compile_48 instanceof ArrayAccess ? ($__internal_compile_48["product_header"] ?? null) : null)) : (""));
        echo "\" class=\"form-control mss-colorPicker\" />
\t\t\t\t\t\t<span class=\"input-group-addon\" style='background-color: ";
        // line 286
        echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["settings"] ?? null), "custom_color_css", [], "array", false, true, false, 286), "product_header", [], "array", true, true, false, 286)) ? ((($__internal_compile_50 = (($__internal_compile_51 = ($context["settings"] ?? null)) && is_array($__internal_compile_51) || $__internal_compile_51 instanceof ArrayAccess ? ($__internal_compile_51["custom_color_css"] ?? null) : null)) && is_array($__internal_compile_50) || $__internal_compile_50 instanceof ArrayAccess ? ($__internal_compile_50["product_header"] ?? null) : null)) : (""));
        echo ";'></span>
\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td><i class=\"fa fa-header\" style=\"font-size: 18px\"></i>&nbsp; ";
        // line 291
        echo ($context["entry_categories_header_color"] ?? null);
        echo "</td>
\t\t\t\t<td>
\t\t\t\t\t<div class=\"input-group\" style='width: 300px'>
\t\t\t\t\t\t<span class=\"input-group-addon\">";
        // line 294
        echo ($context["entry_css_color"] ?? null);
        echo "</span>
\t\t\t\t\t\t<input type=\"text\" name=\"";
        // line 295
        echo ($context["_name"] ?? null);
        echo "[custom_color_css][categories_header]\" value=\"";
        echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["settings"] ?? null), "custom_color_css", [], "array", false, true, false, 295), "product_header", [], "array", true, true, false, 295)) ? ((($__internal_compile_52 = (($__internal_compile_53 = ($context["settings"] ?? null)) && is_array($__internal_compile_53) || $__internal_compile_53 instanceof ArrayAccess ? ($__internal_compile_53["custom_color_css"] ?? null) : null)) && is_array($__internal_compile_52) || $__internal_compile_52 instanceof ArrayAccess ? ($__internal_compile_52["categories_header"] ?? null) : null)) : (""));
        echo "\" class=\"form-control mss-colorPicker\" />
\t\t\t\t\t\t<span class=\"input-group-addon\" style='background-color: ";
        // line 296
        echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["settings"] ?? null), "custom_color_css", [], "array", false, true, false, 296), "categories_header", [], "array", true, true, false, 296)) ? ((($__internal_compile_54 = (($__internal_compile_55 = ($context["settings"] ?? null)) && is_array($__internal_compile_55) || $__internal_compile_55 instanceof ArrayAccess ? ($__internal_compile_55["custom_color_css"] ?? null) : null)) && is_array($__internal_compile_54) || $__internal_compile_54 instanceof ArrayAccess ? ($__internal_compile_54["categories_header"] ?? null) : null)) : (""));
        echo ";'></span>
\t\t\t\t\t</div>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td><i class=\"fa fa-square-o\" style=\"font-size: 18px\"></i>&nbsp; ";
        // line 301
        echo ($context["entry_button_more_color"] ?? null);
        echo "</td>
\t\t\t\t<td>
\t\t\t\t\t<div class=\"input-group\" style='width: 300px'>
\t\t\t\t\t\t<span class=\"input-group-addon\">";
        // line 304
        echo ($context["entry_css_color"] ?? null);
        echo "</span>
\t\t\t\t\t\t<input type=\"text\" name=\"";
        // line 305
        echo ($context["_name"] ?? null);
        echo "[custom_color_css][view_all]\" value=\"";
        echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["settings"] ?? null), "custom_color_css", [], "array", false, true, false, 305), "view_all", [], "array", true, true, false, 305)) ? ((($__internal_compile_56 = (($__internal_compile_57 = ($context["settings"] ?? null)) && is_array($__internal_compile_57) || $__internal_compile_57 instanceof ArrayAccess ? ($__internal_compile_57["custom_color_css"] ?? null) : null)) && is_array($__internal_compile_56) || $__internal_compile_56 instanceof ArrayAccess ? ($__internal_compile_56["view_all"] ?? null) : null)) : (""));
        echo "\" class=\"form-control mss-colorPicker\" />
\t\t\t\t\t\t<span class=\"input-group-addon\" style='background-color: ";
        // line 306
        echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["settings"] ?? null), "custom_color_css", [], "array", false, true, false, 306), "view_all", [], "array", true, true, false, 306)) ? ((($__internal_compile_58 = (($__internal_compile_59 = ($context["settings"] ?? null)) && is_array($__internal_compile_59) || $__internal_compile_59 instanceof ArrayAccess ? ($__internal_compile_59["custom_color_css"] ?? null) : null)) && is_array($__internal_compile_58) || $__internal_compile_58 instanceof ArrayAccess ? ($__internal_compile_58["view_all"] ?? null) : null)) : (""));
        echo ";'></span>
\t\t\t\t\t</div>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td><i class=\"fa fa-header\" style=\"font-size: 18px\"></i>&nbsp; ";
        // line 311
        echo ($context["entry_header_text_color"] ?? null);
        echo "</td>
\t\t\t\t<td>
\t\t\t\t\t<div class=\"input-group\" style='width: 300px'>
\t\t\t\t\t\t<span class=\"input-group-addon\">";
        // line 314
        echo ($context["entry_css_color"] ?? null);
        echo "</span>
\t\t\t\t\t\t<input type=\"text\" name=\"";
        // line 315
        echo ($context["_name"] ?? null);
        echo "[custom_color_css][header_text]\" value=\"";
        echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["settings"] ?? null), "custom_color_css", [], "array", false, true, false, 315), "header_text", [], "array", true, true, false, 315)) ? ((($__internal_compile_60 = (($__internal_compile_61 = ($context["settings"] ?? null)) && is_array($__internal_compile_61) || $__internal_compile_61 instanceof ArrayAccess ? ($__internal_compile_61["custom_color_css"] ?? null) : null)) && is_array($__internal_compile_60) || $__internal_compile_60 instanceof ArrayAccess ? ($__internal_compile_60["header_text"] ?? null) : null)) : (""));
        echo "\" class=\"form-control mss-colorPicker\" />
\t\t\t\t\t\t<span class=\"input-group-addon\" style='background-color: ";
        // line 316
        echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["settings"] ?? null), "custom_color_css", [], "array", false, true, false, 316), "header_text", [], "array", true, true, false, 316)) ? ((($__internal_compile_62 = (($__internal_compile_63 = ($context["settings"] ?? null)) && is_array($__internal_compile_63) || $__internal_compile_63 instanceof ArrayAccess ? ($__internal_compile_63["custom_color_css"] ?? null) : null)) && is_array($__internal_compile_62) || $__internal_compile_62 instanceof ArrayAccess ? ($__internal_compile_62["header_text"] ?? null) : null)) : (""));
        echo ";'></span>
\t\t\t\t\t</div>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td><i class=\"fa fa-cube\" style=\"font-size: 18px\"></i>&nbsp; ";
        // line 321
        echo ($context["entry_results_background"] ?? null);
        echo "</td>
\t\t\t\t<td>
\t\t\t\t\t<div class=\"input-group\" style='width: 300px'>
\t\t\t\t\t\t<span class=\"input-group-addon\">";
        // line 324
        echo ($context["entry_css_color"] ?? null);
        echo "</span>
\t\t\t\t\t\t<input type=\"text\" name=\"";
        // line 325
        echo ($context["_name"] ?? null);
        echo "[custom_color_css][results_background]\" value=\"";
        echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["settings"] ?? null), "custom_color_css", [], "array", false, true, false, 325), "results_background", [], "array", true, true, false, 325)) ? ((($__internal_compile_64 = (($__internal_compile_65 = ($context["settings"] ?? null)) && is_array($__internal_compile_65) || $__internal_compile_65 instanceof ArrayAccess ? ($__internal_compile_65["custom_color_css"] ?? null) : null)) && is_array($__internal_compile_64) || $__internal_compile_64 instanceof ArrayAccess ? ($__internal_compile_64["results_background"] ?? null) : null)) : (""));
        echo "\" class=\"form-control mss-colorPicker\" />
\t\t\t\t\t\t<span class=\"input-group-addon\" style='background-color: ";
        // line 326
        echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["settings"] ?? null), "custom_color_css", [], "array", false, true, false, 326), "results_background", [], "array", true, true, false, 326)) ? ((($__internal_compile_66 = (($__internal_compile_67 = ($context["settings"] ?? null)) && is_array($__internal_compile_67) || $__internal_compile_67 instanceof ArrayAccess ? ($__internal_compile_67["custom_color_css"] ?? null) : null)) && is_array($__internal_compile_66) || $__internal_compile_66 instanceof ArrayAccess ? ($__internal_compile_66["results_background"] ?? null) : null)) : (""));
        echo ";'></span>
\t\t\t\t\t</div>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td><i class=\"fa fa-cube\" style=\"font-size: 18px\"></i>&nbsp; ";
        // line 331
        echo ($context["entry_results_hover"] ?? null);
        echo "</td>
\t\t\t\t<td>
\t\t\t\t\t<div class=\"input-group\" style='width: 300px'>
\t\t\t\t\t\t<span class=\"input-group-addon\">";
        // line 334
        echo ($context["entry_css_color"] ?? null);
        echo "</span>
\t\t\t\t\t\t<input type=\"text\" name=\"";
        // line 335
        echo ($context["_name"] ?? null);
        echo "[custom_color_css][results_hover]\" value=\"";
        echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["settings"] ?? null), "custom_color_css", [], "array", false, true, false, 335), "results_hover", [], "array", true, true, false, 335)) ? ((($__internal_compile_68 = (($__internal_compile_69 = ($context["settings"] ?? null)) && is_array($__internal_compile_69) || $__internal_compile_69 instanceof ArrayAccess ? ($__internal_compile_69["custom_color_css"] ?? null) : null)) && is_array($__internal_compile_68) || $__internal_compile_68 instanceof ArrayAccess ? ($__internal_compile_68["results_hover"] ?? null) : null)) : (""));
        echo "\" class=\"form-control mss-colorPicker\" />
\t\t\t\t\t\t<span class=\"input-group-addon\" style='background-color: ";
        // line 336
        echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["settings"] ?? null), "custom_color_css", [], "array", false, true, false, 336), "results_hover", [], "array", true, true, false, 336)) ? ((($__internal_compile_70 = (($__internal_compile_71 = ($context["settings"] ?? null)) && is_array($__internal_compile_71) || $__internal_compile_71 instanceof ArrayAccess ? ($__internal_compile_71["custom_color_css"] ?? null) : null)) && is_array($__internal_compile_70) || $__internal_compile_70 instanceof ArrayAccess ? ($__internal_compile_70["results_hover"] ?? null) : null)) : (""));
        echo ";'></span>
\t\t\t\t\t</div>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td><i class=\"fa fa-info\" style=\"font-size: 18px\"></i>&nbsp; ";
        // line 341
        echo ($context["entry_results_text"] ?? null);
        echo "</td>
\t\t\t\t<td>
\t\t\t\t\t<div class=\"input-group\" style='width: 300px'>
\t\t\t\t\t\t<span class=\"input-group-addon\">";
        // line 344
        echo ($context["entry_css_color"] ?? null);
        echo "</span>
\t\t\t\t\t\t<input type=\"text\" name=\"";
        // line 345
        echo ($context["_name"] ?? null);
        echo "[custom_color_css][results_text]\" value=\"";
        echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["settings"] ?? null), "custom_color_css", [], "array", false, true, false, 345), "results_text", [], "array", true, true, false, 345)) ? ((($__internal_compile_72 = (($__internal_compile_73 = ($context["settings"] ?? null)) && is_array($__internal_compile_73) || $__internal_compile_73 instanceof ArrayAccess ? ($__internal_compile_73["custom_color_css"] ?? null) : null)) && is_array($__internal_compile_72) || $__internal_compile_72 instanceof ArrayAccess ? ($__internal_compile_72["results_text"] ?? null) : null)) : (""));
        echo "\" class=\"form-control mss-colorPicker\" />
\t\t\t\t\t\t<span class=\"input-group-addon\" style='background-color: ";
        // line 346
        echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["settings"] ?? null), "custom_color_css", [], "array", false, true, false, 346), "results_text", [], "array", true, true, false, 346)) ? ((($__internal_compile_74 = (($__internal_compile_75 = ($context["settings"] ?? null)) && is_array($__internal_compile_75) || $__internal_compile_75 instanceof ArrayAccess ? ($__internal_compile_75["custom_color_css"] ?? null) : null)) && is_array($__internal_compile_74) || $__internal_compile_74 instanceof ArrayAccess ? ($__internal_compile_74["results_text"] ?? null) : null)) : (""));
        echo ";'></span>
\t\t\t\t\t</div>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td><i class=\"fa fa-cubes\" style=\"font-size: 18px\"></i>&nbsp; ";
        // line 351
        echo ($context["entry_border_results"] ?? null);
        echo "</td>
\t\t\t\t<td>
\t\t\t\t\t<div class=\"input-group\" style='width: 300px'>
\t\t\t\t\t\t<span class=\"input-group-addon\">";
        // line 354
        echo ($context["entry_css_color"] ?? null);
        echo "</span>
\t\t\t\t\t\t<input type=\"text\" name=\"";
        // line 355
        echo ($context["_name"] ?? null);
        echo "[custom_color_css][border_results]\" value=\"";
        echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["settings"] ?? null), "custom_color_css", [], "array", false, true, false, 355), "border_results", [], "array", true, true, false, 355)) ? ((($__internal_compile_76 = (($__internal_compile_77 = ($context["settings"] ?? null)) && is_array($__internal_compile_77) || $__internal_compile_77 instanceof ArrayAccess ? ($__internal_compile_77["custom_color_css"] ?? null) : null)) && is_array($__internal_compile_76) || $__internal_compile_76 instanceof ArrayAccess ? ($__internal_compile_76["border_results"] ?? null) : null)) : (""));
        echo "\" class=\"form-control mss-colorPicker\" />
\t\t\t\t\t\t<span class=\"input-group-addon\" style='background-color: ";
        // line 356
        echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["settings"] ?? null), "custom_color_css", [], "array", false, true, false, 356), "border_results", [], "array", true, true, false, 356)) ? ((($__internal_compile_78 = (($__internal_compile_79 = ($context["settings"] ?? null)) && is_array($__internal_compile_79) || $__internal_compile_79 instanceof ArrayAccess ? ($__internal_compile_79["custom_color_css"] ?? null) : null)) && is_array($__internal_compile_78) || $__internal_compile_78 instanceof ArrayAccess ? ($__internal_compile_78["border_results"] ?? null) : null)) : (""));
        echo ";'></span>
\t\t\t\t\t</div>
\t\t\t\t</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t\t<td><i class=\"fa fa-money\" style=\"font-size: 18px\"></i>&nbsp; ";
        // line 361
        echo ($context["entry_price_results"] ?? null);
        echo "</td>
\t\t\t\t<td>
\t\t\t\t\t<div class=\"input-group\" style='width: 300px'>
\t\t\t\t\t\t<span class=\"input-group-addon\">";
        // line 364
        echo ($context["entry_css_color"] ?? null);
        echo "</span>
\t\t\t\t\t\t<input type=\"text\" name=\"";
        // line 365
        echo ($context["_name"] ?? null);
        echo "[custom_color_css][price_results]\" value=\"";
        echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["settings"] ?? null), "custom_color_css", [], "array", false, true, false, 365), "price_results", [], "array", true, true, false, 365)) ? ((($__internal_compile_80 = (($__internal_compile_81 = ($context["settings"] ?? null)) && is_array($__internal_compile_81) || $__internal_compile_81 instanceof ArrayAccess ? ($__internal_compile_81["custom_color_css"] ?? null) : null)) && is_array($__internal_compile_80) || $__internal_compile_80 instanceof ArrayAccess ? ($__internal_compile_80["price_results"] ?? null) : null)) : (""));
        echo "\" class=\"form-control mss-colorPicker\" />
\t\t\t\t\t\t<span class=\"input-group-addon\" style='background-color: ";
        // line 366
        echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["settings"] ?? null), "custom_color_css", [], "array", false, true, false, 366), "price_results", [], "array", true, true, false, 366)) ? ((($__internal_compile_82 = (($__internal_compile_83 = ($context["settings"] ?? null)) && is_array($__internal_compile_83) || $__internal_compile_83 instanceof ArrayAccess ? ($__internal_compile_83["custom_color_css"] ?? null) : null)) && is_array($__internal_compile_82) || $__internal_compile_82 instanceof ArrayAccess ? ($__internal_compile_82["price_results"] ?? null) : null)) : (""));
        echo ";'></span>
\t\t\t\t\t</div>
\t\t\t\t</td>
\t\t\t</tr>
\t\t</table>
\t</div>
</div>
<style>
\t.colorpicker{
\t\tz-index: 999;
\t}
</style>
<script>
\t(function(){
\t\t\$('input[type=radio][name*=mode]').change(function(){
\t\t\tvar val = \$(this).val();
\t\t\t
\t\t\t\$('#product-rows')[val == 'tabs' ? 'removeClass':'addClass']('hide');
\t\t}).filter(':checked').trigger('change');
\t\t
\t\t\t//Color Pickers
\tjQuery(\"input.mss-colorPicker\").each(function(){
\t\tvar tis = jQuery(this);

\t\tif( tis.ColorPicker ) {
\t\t\ttis.ColorPicker({
\t\t\t\tonSubmit: function(hsb, hex, rgb, el) {
\t\t\t\t\tjQuery(el).val(\"#\"+hex).next().css(\"background-color\",\"#\"+hex);
\t\t\t\t\tjQuery(el).ColorPickerHide();
\t\t\t\t},
\t\t\t\tonChange: function(hsb, hex, rgb) {
\t\t\t\t\ttis.val(\"#\"+hex).next().css(\"background-color\",\"#\"+hex);
\t\t\t\t},
\t\t\t\tonBeforeShow: function() {
\t\t\t\t\ttis.ColorPickerSetColor(tis.val());
\t\t\t\t}
\t\t\t}).bind('keyup', function(){
\t\t\t\ttis.ColorPickerSetColor(\"#\"+tis.val());
\t\t\t});
\t\t}
\t});
\t\t
\t})();
</script>

";
        // line 411
        $this->loadTemplate("extension/module/msmart_search/_footer.twig", "extension/module/msmart_search/live_filter.twig", 411)->display($context);
    }

    public function getTemplateName()
    {
        return "extension/module/msmart_search/live_filter.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  877 => 411,  829 => 366,  823 => 365,  819 => 364,  813 => 361,  805 => 356,  799 => 355,  795 => 354,  789 => 351,  781 => 346,  775 => 345,  771 => 344,  765 => 341,  757 => 336,  751 => 335,  747 => 334,  741 => 331,  733 => 326,  727 => 325,  723 => 324,  717 => 321,  709 => 316,  703 => 315,  699 => 314,  693 => 311,  685 => 306,  679 => 305,  675 => 304,  669 => 301,  661 => 296,  655 => 295,  651 => 294,  645 => 291,  637 => 286,  631 => 285,  627 => 284,  621 => 281,  614 => 277,  604 => 272,  599 => 270,  588 => 262,  582 => 261,  576 => 258,  565 => 252,  559 => 249,  550 => 245,  545 => 243,  536 => 239,  531 => 237,  520 => 231,  513 => 229,  507 => 226,  498 => 222,  493 => 220,  484 => 216,  479 => 214,  473 => 211,  462 => 205,  456 => 202,  446 => 197,  440 => 194,  436 => 193,  426 => 188,  420 => 185,  416 => 184,  406 => 179,  401 => 177,  391 => 172,  384 => 168,  380 => 167,  368 => 160,  361 => 158,  353 => 155,  342 => 149,  335 => 147,  327 => 144,  318 => 140,  312 => 137,  308 => 136,  298 => 131,  293 => 129,  278 => 119,  272 => 116,  262 => 111,  255 => 107,  251 => 106,  240 => 100,  234 => 97,  225 => 93,  219 => 90,  215 => 89,  205 => 84,  199 => 81,  195 => 80,  185 => 75,  180 => 73,  167 => 65,  159 => 62,  146 => 54,  138 => 51,  129 => 47,  124 => 45,  116 => 40,  107 => 34,  101 => 33,  96 => 31,  88 => 26,  82 => 25,  77 => 23,  68 => 17,  56 => 8,  52 => 7,  48 => 6,  44 => 5,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/module/msmart_search/live_filter.twig", "");
    }
}
