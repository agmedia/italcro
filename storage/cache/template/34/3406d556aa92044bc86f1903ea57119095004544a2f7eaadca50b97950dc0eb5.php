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

/* extension/basel/panel_tabs/typography.twig */
class __TwigTemplate_aa6c72b76c497622db738748bf623fa5275ec5afc65aa93b3eb386287a93935e extends \Twig\Template
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
        echo "<legend>Typography</legend>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Use custom fonts instead of the default ones\">Override default font styles</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][basel_typo_status]\" class=\"typo-select\" value=\"0\" ";
        // line 6
        if ((($context["basel_typo_status"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][basel_typo_status]\" class=\"typo-select\" value=\"1\" ";
        // line 7
        if ((($context["basel_typo_status"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div id=\"basel_typo_holder\"";
        // line 11
        if (($context["basel_typo_status"] ?? null)) {
            echo " style=\"display:block\"";
        } else {
            echo " style=\"display:none\"";
        }
        echo ">
<legend class=\"sub\">Google Font List</legend>


<div class=\"col-sm-offset-2\" style=\"margin-bottom:10px;\">
<div class=\"bs-callout bs-callout-info bs-callout-sm\">
When you add new fonts to the list, please save the module before you can start using them in the font settings
</div>
</div>
<div class=\"row\">
<div class=\"col-sm-2\"></div>
<div class=\"col-sm-10\">
 <table id=\"fonts\" class=\"table table-clean\">
    <thead>
      <tr>
        <td width=\"49%\"><span data-toggle=\"tooltip\" title=\"For example: Roboto:400,600\">Font Import</span></td>
        <td width=\"49%\"><span data-toggle=\"tooltip\" title=\"For example: 'Roboto', sans-serif\">Font Name</span></td>
        <td width=\"2%\"></td>
      </tr>
    </thead>
    <tbody>
     ";
        // line 32
        $context["font_row"] = 1;
        // line 33
        echo "     ";
        if (array_key_exists("basel_fonts", $context)) {
            // line 34
            echo "      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["basel_fonts"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["basel_font"]) {
                // line 35
                echo "      <tr id=\"font-row";
                echo ($context["font_row"] ?? null);
                echo "\">
        <td class=\"first\">
        <div style=\"margin-bottom:5px;\">
        <input type=\"text\" class=\"form-control\" name=\"settings[basel][basel_fonts][";
                // line 38
                echo ($context["font_row"] ?? null);
                echo "][import]\" value=\"";
                echo ((twig_get_attribute($this->env, $this->source, $context["basel_font"], "import", [], "any", false, false, false, 38)) ? (twig_get_attribute($this->env, $this->source, $context["basel_font"], "import", [], "any", false, false, false, 38)) : (""));
                echo "\" />
        </div>
        </td>
        <td class=\"first\">
        <input type=\"text\" class=\"form-control\" name=\"settings[basel][basel_fonts][";
                // line 42
                echo ($context["font_row"] ?? null);
                echo "][name]\" value=\"";
                echo ((twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 42)) ? (twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 42)) : (""));
                echo "\" />
        </td>
        <td class=\"text-right\">
        <button type=\"button\" onclick=\"\$('#font-row";
                // line 45
                echo ($context["font_row"] ?? null);
                echo "').remove();\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_remove"] ?? null);
                echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button>
        </td>
      </tr>
      ";
                // line 48
                $context["font_row"] = (($context["font_row"] ?? null) + 1);
                // line 49
                echo "    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['basel_font'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 50
            echo "   ";
        }
        // line 51
        echo "    </tbody>
    <tfoot>
      <tr>
        <td colspan=\"2\"></td>
        <td class=\"text-right\"><button type=\"button\" onclick=\"addFontRow();\" data-toggle=\"tooltip\" title=\"";
        // line 55
        echo ($context["button_add"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus-circle\"></i></button></td>
      </tr>
    </tfoot>
  </table>
 </div>
 </div>
 
<legend>Font settings</legend>
<legend class=\"sub\">General</legend>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\">Body font</label>
<div class=\"col-sm-10\">
    <select name=\"settings[basel][body_font_fam]\" class=\"form-control\">
    <option disabled style=\"font-weight:bold\">System Fonts</option>
    ";
        // line 70
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["system_fonts"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["system_font"]) {
            // line 71
            echo "    <option value=\"";
            echo $context["key"];
            echo "\"";
            if ((($context["body_font_fam"] ?? null) == $context["key"])) {
                echo "selected=\"selected\"";
            }
            echo ">
    ";
            // line 72
            echo $context["system_font"];
            echo "</option>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['system_font'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 74
        echo "    <option disabled style=\"font-weight:bold\">Google Webfonts</option>
    ";
        // line 75
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["basel_fonts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["basel_font"]) {
            // line 76
            echo "    <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 76);
            echo "\" ";
            if ((($context["body_font_fam"] ?? null) == twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 76))) {
                echo "selected=\"selected\"";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 76);
            echo "</option>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['basel_font'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 78
        echo "    </select>
</div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Disable if your custom font dont support, or looks bad in italic\">Keep italics</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][body_font_italic_status]\" value=\"0\" ";
        // line 85
        if ((($context["body_font_italic_status"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][body_font_italic_status]\"  value=\"1\" ";
        // line 86
        if ((($context["body_font_italic_status"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Select default font weight for bold text\">Bold font weight</span></label>
    <div class=\"col-sm-10 form-inline\">
    <input class=\"form-control\" style=\"width:160px\" name=\"settings[basel][body_font_bold_weight]\" value=\"";
        // line 93
        echo ((($context["body_font_bold_weight"] ?? null)) ? (($context["body_font_bold_weight"] ?? null)) : ("600"));
        echo "\" />
    </div>                   
</div>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Contrast font is used on item names, in some widgets etc.\">Contrast font</span></label>
<div class=\"col-sm-10\">
    <select name=\"settings[basel][contrast_font_fam]\" class=\"form-control\">
    <option disabled style=\"font-weight:bold\">System Fonts</option>
    ";
        // line 102
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["system_fonts"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["system_font"]) {
            // line 103
            echo "    <option value=\"";
            echo $context["key"];
            echo "\" ";
            if ((($context["contrast_font_fam"] ?? null) == $context["key"])) {
                echo "selected=\"selected\"";
            }
            echo ">
    ";
            // line 104
            echo $context["system_font"];
            echo "</option>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['system_font'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 106
        echo "    <option disabled style=\"font-weight:bold\">Google Webfonts</option>
    ";
        // line 107
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["basel_fonts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["basel_font"]) {
            // line 108
            echo "    <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 108);
            echo "\" ";
            if ((($context["contrast_font_fam"] ?? null) == twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 108))) {
                echo "selected=\"selected\"";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 108);
            echo "</option>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['basel_font'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 110
        echo "    </select>
</div>                   
</div>

<legend class=\"sub\">Font size adjustment</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Use this to adjust if your font looks bigger or smaller than desirably\">Larger font size (16px)</span></label>
    <div class=\"col-sm-10 form-inline\">
    <input class=\"form-control\" style=\"width:160px\" name=\"settings[basel][body_font_size_16]\" value=\"";
        // line 118
        echo ((($context["body_font_size_16"] ?? null)) ? (($context["body_font_size_16"] ?? null)) : ("16px"));
        echo "\" />
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Use this to adjust if your font looks bigger or smaller than desirably\">Large font size (15px)</span></label>
    <div class=\"col-sm-10 form-inline\">
    <input class=\"form-control\" style=\"width:160px\" name=\"settings[basel][body_font_size_15]\" value=\"";
        // line 125
        echo ((($context["body_font_size_15"] ?? null)) ? (($context["body_font_size_15"] ?? null)) : ("15px"));
        echo "\" />
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Use this to adjust if your font looks bigger or smaller than desirably\">Normal font size (14px)</span></label>
    <div class=\"col-sm-10 form-inline\">
    <input class=\"form-control\" style=\"width:160px\" name=\"settings[basel][body_font_size_14]\" value=\"";
        // line 132
        echo ((($context["body_font_size_14"] ?? null)) ? (($context["body_font_size_14"] ?? null)) : ("14px"));
        echo "\" />
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Use this to adjust if your font looks bigger or smaller than desirably\">Small font size (13px)</span></label>
    <div class=\"col-sm-10 form-inline\">
    <input class=\"form-control\" style=\"width:160px\" name=\"settings[basel][body_font_size_13]\" value=\"";
        // line 139
        echo ((($context["body_font_size_13"] ?? null)) ? (($context["body_font_size_13"] ?? null)) : ("13px"));
        echo "\" />
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Use this to adjust if your font looks bigger or smaller than desirably\">Tiny font size (12px)</span></label>
    <div class=\"col-sm-10 form-inline\">
    <input class=\"form-control\" style=\"width:160px\" name=\"settings[basel][body_font_size_12]\" value=\"";
        // line 146
        echo ((($context["body_font_size_12"] ?? null)) ? (($context["body_font_size_12"] ?? null)) : ("12px"));
        echo "\" />
    </div>                   
</div>

<legend class=\"sub\">Headings</legend>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\">Headings font</label>
<div class=\"col-sm-10\">
    <select name=\"settings[basel][headings_fam]\" class=\"form-control\">
    <option disabled style=\"font-weight:bold\">System Fonts</option>
    ";
        // line 157
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["system_fonts"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["system_font"]) {
            // line 158
            echo "    <option value=\"";
            echo $context["key"];
            echo "\" 
    ";
            // line 159
            if ((($context["headings_fam"] ?? null) == $context["key"])) {
                echo "selected=\"selected\"";
            }
            echo ">
    ";
            // line 160
            echo $context["system_font"];
            echo "</option>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['system_font'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 162
        echo "    <option disabled style=\"font-weight:bold\">Google Webfonts</option>
    ";
        // line 163
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["basel_fonts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["basel_font"]) {
            // line 164
            echo "    <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 164);
            echo "\" ";
            if ((($context["headings_fam"] ?? null) == twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 164))) {
                echo "selected=\"selected\"";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 164);
            echo "</option>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['basel_font'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 166
        echo "    </select>
</div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Headings font weight</label>
    <div class=\"col-sm-10 form-inline\">
    <input class=\"form-control\" style=\"width:160px\" name=\"settings[basel][headings_weight]\" value=\"";
        // line 173
        echo ((($context["headings_weight"] ?? null)) ? (($context["headings_weight"] ?? null)) : ("600"));
        echo "\" />
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Smaller headings size</label>
    <div class=\"col-sm-10 form-inline\">
    <input class=\"form-control\" style=\"width:160px\" name=\"settings[basel][headings_size_sm]\" value=\"";
        // line 180
        echo ((($context["headings_size_sm"] ?? null)) ? (($context["headings_size_sm"] ?? null)) : ("20px"));
        echo "\" />
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Largeer headings size</label>
    <div class=\"col-sm-10 form-inline\">
    <input class=\"form-control\" style=\"width:160px\" name=\"settings[basel][headings_size_lg]\" value=\"";
        // line 187
        echo ((($context["headings_size_lg"] ?? null)) ? (($context["headings_size_lg"] ?? null)) : ("28px"));
        echo "\" />
    </div>                   
</div>

<legend class=\"sub\">Page titles / H1</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><br /><span data-toggle=\"tooltip\" title=\"Inline titles are page titles that are not moved to the breadcrumb\">Inline titles</span></label>
    <div class=\"col-sm-10\">
    <div class=\"row\">
        <div class=\"col-sm-4\">
        <label>Font family</label>
        <select name=\"settings[basel][h1_inline_fam]\" class=\"form-control\">
        <option disabled style=\"font-weight:bold\">System Fonts</option>
        ";
        // line 200
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["system_fonts"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["system_font"]) {
            // line 201
            echo "        <option value=\"";
            echo $context["key"];
            echo "\" 
        ";
            // line 202
            if ((($context["h1_inline_fam"] ?? null) == $context["key"])) {
                echo "selected=\"selected\"";
            }
            echo ">
        ";
            // line 203
            echo $context["system_font"];
            echo "</option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['system_font'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 205
        echo "        <option disabled style=\"font-weight:bold\">Google Webfonts</option>
        ";
        // line 206
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["basel_fonts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["basel_font"]) {
            // line 207
            echo "        <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 207);
            echo "\" ";
            if ((($context["h1_inline_fam"] ?? null) == twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 207))) {
                echo "selected=\"selected\"";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 207);
            echo "</option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['basel_font'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 209
        echo "        </select>
        </div>
        <div class=\"col-sm-2\">
        <label>Font size</label>
        <input class=\"form-control\" name=\"settings[basel][h1_inline_size]\" value=\"";
        // line 213
        echo ((($context["h1_inline_size"] ?? null)) ? (($context["h1_inline_size"] ?? null)) : ("34px"));
        echo "\" />
        </div>
        <div class=\"col-sm-2\">
        <label>Font weight</label>
        <input class=\"form-control\" name=\"settings[basel][h1_inline_weight]\" value=\"";
        // line 217
        echo ((($context["h1_inline_weight"] ?? null)) ? (($context["h1_inline_weight"] ?? null)) : ("600"));
        echo "\" />
        </div>
        <div class=\"col-sm-2\">
        <label>Text transform</label>
        <select name=\"settings[basel][h1_inline_trans]\" class=\"form-control\">
        <option value=\"none\"";
        // line 222
        if ((($context["h1_inline_trans"] ?? null) == "none")) {
            echo " selected=\"selected\"";
        }
        echo ">None</option>
        <option value=\"uppercase\"";
        // line 223
        if ((($context["h1_inline_trans"] ?? null) == "uppercase")) {
            echo " selected=\"selected\"";
        }
        echo ">Uppercase</option>
        <option value=\"lowercase\"";
        // line 224
        if ((($context["h1_inline_trans"] ?? null) == "lowercase")) {
            echo " selected=\"selected\"";
        }
        echo ">Lowercase</option>
        <option value=\"capitalize\"";
        // line 225
        if ((($context["h1_inline_trans"] ?? null) == "capitalize")) {
            echo " selected=\"selected\"";
        }
        echo ">Capitalize</option>
        </select>
        </div>
        <div class=\"col-sm-2\">
        <label>Letter spcaing</label>
        <input class=\"form-control\" name=\"settings[basel][h1_inline_ls]\" value=\"";
        // line 230
        echo ((($context["h1_inline_ls"] ?? null)) ? (($context["h1_inline_ls"] ?? null)) : ("0px"));
        echo "\" />
        </div>
    </div>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><br />Titles inside breadcrumb</label>
    <div class=\"col-sm-10\">
    <div class=\"row\">
        <div class=\"col-sm-4\">
        <label>Font family</label>
        <select name=\"settings[basel][h1_breadcrumb_fam]\" class=\"form-control\">
        <option disabled style=\"font-weight:bold\">System Fonts</option>
        ";
        // line 244
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["system_fonts"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["system_font"]) {
            // line 245
            echo "        <option value=\"";
            echo $context["key"];
            echo "\" 
        ";
            // line 246
            if ((($context["h1_breadcrumb_fam"] ?? null) == $context["key"])) {
                echo "selected=\"selected\"";
            }
            echo ">
        ";
            // line 247
            echo $context["system_font"];
            echo "</option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['system_font'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 249
        echo "        <option disabled style=\"font-weight:bold\">Google Webfonts</option>
        ";
        // line 250
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["basel_fonts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["basel_font"]) {
            // line 251
            echo "        <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 251);
            echo "\" ";
            if ((($context["h1_breadcrumb_fam"] ?? null) == twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 251))) {
                echo "selected=\"selected\"";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 251);
            echo "</option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['basel_font'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 253
        echo "        </select>
        </div>
        <div class=\"col-sm-2\">
        <label>Font size</label>
        <input class=\"form-control\" name=\"settings[basel][h1_breadcrumb_size]\" value=\"";
        // line 257
        echo ((($context["h1_breadcrumb_size"] ?? null)) ? (($context["h1_breadcrumb_size"] ?? null)) : ("34px"));
        echo "\" />
        </div>
        <div class=\"col-sm-2\">
        <label>Font weight</label>
        <input class=\"form-control\" name=\"settings[basel][h1_breadcrumb_weight]\" value=\"";
        // line 261
        echo ((($context["h1_breadcrumb_weight"] ?? null)) ? (($context["h1_breadcrumb_weight"] ?? null)) : ("600"));
        echo "\" />
        </div>
        <div class=\"col-sm-2\">
        <label>Text transform</label>
        <select name=\"settings[basel][h1_breadcrumb_trans]\" class=\"form-control\">
        <option value=\"none\"";
        // line 266
        if ((($context["h1_breadcrumb_trans"] ?? null) == "none")) {
            echo " selected=\"selected\"";
        }
        echo ">None</option>
        <option value=\"uppercase\"";
        // line 267
        if ((($context["h1_breadcrumb_trans"] ?? null) == "uppercase")) {
            echo " selected=\"selected\"";
        }
        echo ">Uppercase</option>
        <option value=\"lowercase\"";
        // line 268
        if ((($context["h1_breadcrumb_trans"] ?? null) == "lowercase")) {
            echo " selected=\"selected\"";
        }
        echo ">Lowercase</option>
        <option value=\"capitalize\"";
        // line 269
        if ((($context["h1_breadcrumb_trans"] ?? null) == "capitalize")) {
            echo " selected=\"selected\"";
        }
        echo ">Capitalize</option>
        </select>
        </div>
        <div class=\"col-sm-2\">
        <label>Letter spcaing</label>
        <input class=\"form-control\" name=\"settings[basel][h1_breadcrumb_ls]\" value=\"";
        // line 274
        echo ((($context["h1_breadcrumb_ls"] ?? null)) ? (($context["h1_breadcrumb_ls"] ?? null)) : ("0px"));
        echo "\" />
        </div>
    </div>
    </div>                   
</div>

<legend class=\"sub\">Widgets Titles / Module Titles</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><br /><span data-toggle=\"tooltip\" title=\"Widgets not positioned in column areas\">Widgets in content</span></label>
    <div class=\"col-sm-10\">
    <div class=\"row\">
        <div class=\"col-sm-4\">
        <label>Font family</label>
        <select name=\"settings[basel][widget_lg_fam]\" class=\"form-control\">
        <option disabled style=\"font-weight:bold\">System Fonts</option>
        ";
        // line 289
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["system_fonts"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["system_font"]) {
            // line 290
            echo "        <option value=\"";
            echo $context["key"];
            echo "\" 
        ";
            // line 291
            if ((($context["widget_lg_fam"] ?? null) == $context["key"])) {
                echo "selected=\"selected\"";
            }
            echo ">
        ";
            // line 292
            echo $context["system_font"];
            echo "</option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['system_font'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 294
        echo "        <option disabled style=\"font-weight:bold\">Google Webfonts</option>
        ";
        // line 295
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["basel_fonts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["basel_font"]) {
            // line 296
            echo "        <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 296);
            echo "\" ";
            if ((($context["widget_lg_fam"] ?? null) == twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 296))) {
                echo "selected=\"selected\"";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 296);
            echo "</option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['basel_font'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 298
        echo "        </select>
        </div>
        <div class=\"col-sm-2\">
        <label>Font size</label>
        <input class=\"form-control\" name=\"settings[basel][widget_lg_size]\" value=\"";
        // line 302
        echo ((($context["widget_lg_size"] ?? null)) ? (($context["widget_lg_size"] ?? null)) : ("26px"));
        echo "\" />
        </div>
        <div class=\"col-sm-2\">
        <label>Font weight</label>
        <input class=\"form-control\" name=\"settings[basel][widget_lg_weight]\" value=\"";
        // line 306
        echo ((($context["widget_lg_weight"] ?? null)) ? (($context["widget_lg_weight"] ?? null)) : ("600"));
        echo "\" />
        </div>
        <div class=\"col-sm-2\">
        <label>Text transform</label>
        <select name=\"settings[basel][widget_lg_trans]\" class=\"form-control\">
        <option value=\"none\"";
        // line 311
        if ((($context["widget_lg_trans"] ?? null) == "none")) {
            echo " selected=\"selected\"";
        }
        echo ">None</option>
        <option value=\"uppercase\"";
        // line 312
        if ((($context["widget_lg_trans"] ?? null) == "uppercase")) {
            echo " selected=\"selected\"";
        }
        echo ">Uppercase</option>
        <option value=\"lowercase\"";
        // line 313
        if ((($context["widget_lg_trans"] ?? null) == "lowercase")) {
            echo " selected=\"selected\"";
        }
        echo ">Lowercase</option>
        <option value=\"capitalize\"";
        // line 314
        if ((($context["widget_lg_trans"] ?? null) == "capitalize")) {
            echo " selected=\"selected\"";
        }
        echo ">Capitalize</option>
        </select>
        </div>
        <div class=\"col-sm-2\">
        <label>Letter spcaing</label>
        <input class=\"form-control\" name=\"settings[basel][widget_lg_ls]\" value=\"";
        // line 319
        echo ((($context["widget_lg_ls"] ?? null)) ? (($context["widget_lg_ls"] ?? null)) : ("0px"));
        echo "\" />
        </div>
    </div>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><br />Widgets in column</label>
    <div class=\"col-sm-10\">
    <div class=\"row\">
        <div class=\"col-sm-4\">
        <label>Font family</label>
        <select name=\"settings[basel][widget_sm_fam]\" class=\"form-control\">
        <option disabled style=\"font-weight:bold\">System Fonts</option>
        ";
        // line 333
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["system_fonts"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["system_font"]) {
            // line 334
            echo "        <option value=\"";
            echo $context["key"];
            echo "\" 
        ";
            // line 335
            if ((($context["widget_sm_fam"] ?? null) == $context["key"])) {
                echo "selected=\"selected\"";
            }
            echo ">
        ";
            // line 336
            echo $context["system_font"];
            echo "</option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['system_font'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 338
        echo "        <option disabled style=\"font-weight:bold\">Google Webfonts</option>
        ";
        // line 339
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["basel_fonts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["basel_font"]) {
            // line 340
            echo "        <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 340);
            echo "\" ";
            if ((($context["widget_sm_fam"] ?? null) == twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 340))) {
                echo "selected=\"selected\"";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 340);
            echo "</option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['basel_font'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 342
        echo "        </select>
        </div>
        <div class=\"col-sm-2\">
        <label>Font size</label>
        <input class=\"form-control\" name=\"settings[basel][widget_sm_size]\" value=\"";
        // line 346
        echo ((($context["widget_sm_size"] ?? null)) ? (($context["widget_sm_size"] ?? null)) : ("16px"));
        echo "\" />
        </div>
        <div class=\"col-sm-2\">
        <label>Font weight</label>
        <input class=\"form-control\" name=\"settings[basel][widget_sm_weight]\" value=\"";
        // line 350
        echo ((($context["widget_sm_weight"] ?? null)) ? (($context["widget_sm_weight"] ?? null)) : ("600"));
        echo "\" />
        </div>
        <div class=\"col-sm-2\">
        <label>Text transform</label>
        <select name=\"settings[basel][widget_sm_trans]\" class=\"form-control\">
        <option value=\"none\"";
        // line 355
        if ((($context["widget_sm_trans"] ?? null) == "none")) {
            echo " selected=\"selected\"";
        }
        echo ">None</option>
        <option value=\"uppercase\"";
        // line 356
        if ((($context["widget_sm_trans"] ?? null) == "uppercase")) {
            echo " selected=\"selected\"";
        }
        echo ">Uppercase</option>
        <option value=\"lowercase\"";
        // line 357
        if ((($context["widget_sm_trans"] ?? null) == "lowercase")) {
            echo " selected=\"selected\"";
        }
        echo ">Lowercase</option>
        <option value=\"capitalize\"";
        // line 358
        if ((($context["widget_sm_trans"] ?? null) == "capitalize")) {
            echo " selected=\"selected\"";
        }
        echo ">Capitalize</option>
        </select>
        </div>
        <div class=\"col-sm-2\">
        <label>Letter spcaing</label>
        <input class=\"form-control\" name=\"settings[basel][widget_sm_ls]\" value=\"";
        // line 363
        echo ((($context["widget_sm_ls"] ?? null)) ? (($context["widget_sm_ls"] ?? null)) : ("0.75px"));
        echo "\" />
        </div>
    </div>
    </div>                   
</div>

<legend class=\"sub\">Main Menu In Header</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><br />Main menu</label>
    <div class=\"col-sm-10\">
    <div class=\"row\">
        <div class=\"col-sm-4\">
        <label>Font family</label>
        <select name=\"settings[basel][menu_font_fam]\" class=\"form-control\">
        <option disabled style=\"font-weight:bold\">System Fonts</option>
        ";
        // line 378
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["system_fonts"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["system_font"]) {
            // line 379
            echo "        <option value=\"";
            echo $context["key"];
            echo "\" 
        ";
            // line 380
            if ((($context["menu_font_fam"] ?? null) == $context["key"])) {
                echo "selected=\"selected\"";
            }
            echo ">
        ";
            // line 381
            echo $context["system_font"];
            echo "</option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['system_font'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 383
        echo "        <option disabled style=\"font-weight:bold\">Google Webfonts</option>
        ";
        // line 384
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["basel_fonts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["basel_font"]) {
            // line 385
            echo "        <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 385);
            echo "\" ";
            if ((($context["menu_font_fam"] ?? null) == twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 385))) {
                echo "selected=\"selected\"";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["basel_font"], "name", [], "any", false, false, false, 385);
            echo "</option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['basel_font'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 387
        echo "        </select>
        </div>
        <div class=\"col-sm-2\">
        <label>Font size</label>
        <input class=\"form-control\" name=\"settings[basel][menu_font_size]\" value=\"";
        // line 391
        echo ((($context["menu_font_size"] ?? null)) ? (($context["menu_font_size"] ?? null)) : ("14px"));
        echo "\" />
        </div>
        <div class=\"col-sm-2\">
        <label>Font weight</label>
        <input class=\"form-control\" name=\"settings[basel][menu_font_weight]\" value=\"";
        // line 395
        echo ((($context["menu_font_weight"] ?? null)) ? (($context["menu_font_weight"] ?? null)) : ("400"));
        echo "\" />
        </div>
        <div class=\"col-sm-2\">
        <label>Text transform</label>
        <select name=\"settings[basel][menu_font_trans]\" class=\"form-control\">
        <option value=\"none\"";
        // line 400
        if ((($context["menu_font_trans"] ?? null) == "none")) {
            echo " selected=\"selected\"";
        }
        echo ">None</option>
        <option value=\"uppercase\"";
        // line 401
        if ((($context["menu_font_trans"] ?? null) == "uppercase")) {
            echo " selected=\"selected\"";
        }
        echo ">Uppercase</option>
        <option value=\"lowercase\"";
        // line 402
        if ((($context["menu_font_trans"] ?? null) == "lowercase")) {
            echo " selected=\"selected\"";
        }
        echo ">Lowercase</option>
        <option value=\"capitalize\"";
        // line 403
        if ((($context["menu_font_trans"] ?? null) == "capitalize")) {
            echo " selected=\"selected\"";
        }
        echo ">Capitalize</option>
        </select>
        </div>
        <div class=\"col-sm-2\">
        <label>Letter spcaing</label>
        <input class=\"form-control\" name=\"settings[basel][menu_font_ls]\" value=\"";
        // line 408
        echo ((($context["menu_font_ls"] ?? null)) ? (($context["menu_font_ls"] ?? null)) : ("0.5px"));
        echo "\" />
        </div>
    </div>
    </div>                   
</div> 

</div><!-- #basel_typo_holder ends -->


<script type=\"text/javascript\"><!--
var font_row = ";
        // line 418
        echo ($context["font_row"] ?? null);
        echo ";
function addFontRow() {
\thtml  = '<tr id=\"font-row' + font_row + '\">';
\thtml += '<td class=\"first\">';
\thtml += '<input type=\"text\" class=\"form-control\" name=\"settings[basel][basel_fonts][' + font_row + '][import]\" />';
\thtml += '</td>';
\thtml += '<td class=\"first\">';
\thtml += '<input type=\"text\" class=\"form-control\" name=\"settings[basel][basel_fonts][' + font_row + '][name]\" />';
\thtml += '</td>';
\thtml += '<td class=\"text-right\"><button type=\"button\" onclick=\"\$(\\'#font-row' + font_row  + '\\').remove();\" data-toggle=\"tooltip\" title=\"";
        // line 427
        echo ($context["button_remove"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>';
\thtml += '</tr>';
\t\$('#fonts tbody').append(html);
\tfont_row++;
}
//--></script>";
    }

    public function getTemplateName()
    {
        return "extension/basel/panel_tabs/typography.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1008 => 427,  996 => 418,  983 => 408,  973 => 403,  967 => 402,  961 => 401,  955 => 400,  947 => 395,  940 => 391,  934 => 387,  919 => 385,  915 => 384,  912 => 383,  904 => 381,  898 => 380,  893 => 379,  889 => 378,  871 => 363,  861 => 358,  855 => 357,  849 => 356,  843 => 355,  835 => 350,  828 => 346,  822 => 342,  807 => 340,  803 => 339,  800 => 338,  792 => 336,  786 => 335,  781 => 334,  777 => 333,  760 => 319,  750 => 314,  744 => 313,  738 => 312,  732 => 311,  724 => 306,  717 => 302,  711 => 298,  696 => 296,  692 => 295,  689 => 294,  681 => 292,  675 => 291,  670 => 290,  666 => 289,  648 => 274,  638 => 269,  632 => 268,  626 => 267,  620 => 266,  612 => 261,  605 => 257,  599 => 253,  584 => 251,  580 => 250,  577 => 249,  569 => 247,  563 => 246,  558 => 245,  554 => 244,  537 => 230,  527 => 225,  521 => 224,  515 => 223,  509 => 222,  501 => 217,  494 => 213,  488 => 209,  473 => 207,  469 => 206,  466 => 205,  458 => 203,  452 => 202,  447 => 201,  443 => 200,  427 => 187,  417 => 180,  407 => 173,  398 => 166,  383 => 164,  379 => 163,  376 => 162,  368 => 160,  362 => 159,  357 => 158,  353 => 157,  339 => 146,  329 => 139,  319 => 132,  309 => 125,  299 => 118,  289 => 110,  274 => 108,  270 => 107,  267 => 106,  259 => 104,  250 => 103,  246 => 102,  234 => 93,  222 => 86,  216 => 85,  207 => 78,  192 => 76,  188 => 75,  185 => 74,  177 => 72,  168 => 71,  164 => 70,  146 => 55,  140 => 51,  137 => 50,  131 => 49,  129 => 48,  121 => 45,  113 => 42,  104 => 38,  97 => 35,  92 => 34,  89 => 33,  87 => 32,  59 => 11,  50 => 7,  44 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/basel/panel_tabs/typography.twig", "/Users/tomek/Herd/reprograv/upload/admin/view/template/extension/basel/panel_tabs/typography.twig");
    }
}
