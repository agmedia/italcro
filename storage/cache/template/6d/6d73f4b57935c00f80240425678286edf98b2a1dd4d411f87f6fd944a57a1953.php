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

/* extension/module/product_option_image_pro/option_settings.twig */
class __TwigTemplate_904c2e18c5f6d148ac8bb4ff75a2d269087b8329d0dbae7e9388b084e8280601 extends \Twig\Template
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
        if ((($context["poip_installed"]) ?? (false))) {
            // line 2
            echo "\t\t\t\t
\t<div class=\"form-group\">
\t\t<div class=\"col-sm-2\">
\t\t\t<div class=\"row\">
\t\t\t\t<label class=\"col-sm-12 control-label\" for=\"input-sort-order\">";
            // line 6
            echo ($context["poip_module_name"] ?? null);
            echo ":</label>
\t\t\t</div>
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-sm-12\" style=\"padding-top:10px;\">
\t\t\t\t\t<button type=\"button\" id=\"poip-button-hide-settings\" style=\"display:none;\" onclick=\"poip.hideSettings();\" class=\"btn btn-default pull-right\">";
            // line 10
            echo ($context["entry_hide_settings"] ?? null);
            echo "</button>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-sm-10\">
\t\t\t";
            // line 15
            $context["poip_custom_settings_cnt"] = 0;
            // line 16
            echo "\t\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["poip_settings_details"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["poip_setting"]) {
                // line 17
                echo "\t\t\t\t";
                if (((((twig_get_attribute($this->env, $this->source, ($context["poip_saved_settings"] ?? null), twig_get_attribute($this->env, $this->source, $context["poip_setting"], "name", [], "any", false, false, false, 17), [], "array", true, true, false, 17) &&  !(null === (($__internal_compile_0 = ($context["poip_saved_settings"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[twig_get_attribute($this->env, $this->source, $context["poip_setting"], "name", [], "any", false, false, false, 17)] ?? null) : null)))) ? ((($__internal_compile_1 = ($context["poip_saved_settings"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[twig_get_attribute($this->env, $this->source, $context["poip_setting"], "name", [], "any", false, false, false, 17)] ?? null) : null)) : (0)) == (($context["val_id"] ?? null) + 1))) {
                    // line 18
                    echo "\t\t\t\t\t";
                    $context["poip_custom_settings_cnt"] = (($context["poip_custom_settings_cnt"] ?? null) + 1);
                    // line 19
                    echo "\t\t\t\t";
                }
                // line 20
                echo "\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['poip_setting'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 21
            echo "\t\t\t";
            if ((($context["poip_custom_settings_cnt"] ?? null) != 0)) {
                // line 22
                echo "\t\t\t\t";
                $context["poip_custom_settings_cnt"] = ((" (" . ($context["poip_custom_settings_cnt"] ?? null)) . ")");
                // line 23
                echo "\t\t\t";
            } else {
                // line 24
                echo "\t\t\t\t";
                $context["poip_custom_settings_cnt"] = "";
                // line 25
                echo "\t\t\t";
            }
            // line 26
            echo "\t\t\t<button type=\"button\" id=\"poip-button-show-settings\" class=\"btn btn-default\" onclick=\"poip.showSettings();\">";
            echo ($context["entry_show_settings"] ?? null);
            echo "<span id=\"poip-custom-settings-cnt\"></span></button>
\t\t\t<div class=\"row\" id=\"poip-settings\" style=\"display:none;\">
\t\t
\t\t\t\t";
            // line 29
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["poip_settings_details"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["poip_setting"]) {
                // line 30
                echo "\t\t\t\t\t<div class=\"col-sm-4\">
\t\t\t\t\t";
                // line 31
                echo twig_get_attribute($this->env, $this->source, $context["poip_setting"], "title", [], "any", false, false, false, 31);
                echo ":
\t\t\t\t\t<select name=\"poip_settings[";
                // line 32
                echo twig_get_attribute($this->env, $this->source, $context["poip_setting"], "name", [], "any", false, false, false, 32);
                echo "]\" class=\"form-control\">
\t\t\t\t\t\t";
                // line 33
                if (twig_get_attribute($this->env, $this->source, $context["poip_setting"], "values", [], "any", false, false, false, 33)) {
                    // line 34
                    echo "\t\t\t\t\t\t\t<option value=\"0\">";
                    echo (($__internal_compile_2 = ($context["poip_settings_enable_disable_options"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[0] ?? null) : null);
                    echo "</option>
\t\t\t\t\t\t\t";
                    // line 35
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["poip_setting"], "values", [], "any", false, false, false, 35));
                    foreach ($context['_seq'] as $context["val_id"] => $context["val_text"]) {
                        // line 36
                        echo "\t\t\t\t\t\t\t\t<option value=\"";
                        echo (1 + $context["val_id"]);
                        echo "\" 
\t\t\t\t\t\t\t\t\t";
                        // line 37
                        if (((((twig_get_attribute($this->env, $this->source, ($context["poip_saved_settings"] ?? null), twig_get_attribute($this->env, $this->source, $context["poip_setting"], "name", [], "any", false, false, false, 37), [], "array", true, true, false, 37) &&  !(null === (($__internal_compile_3 = ($context["poip_saved_settings"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[twig_get_attribute($this->env, $this->source, $context["poip_setting"], "name", [], "any", false, false, false, 37)] ?? null) : null)))) ? ((($__internal_compile_4 = ($context["poip_saved_settings"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4[twig_get_attribute($this->env, $this->source, $context["poip_setting"], "name", [], "any", false, false, false, 37)] ?? null) : null)) : (0)) == ($context["val_id"] + 1))) {
                            // line 38
                            echo "\t\t\t\t\t\t\t\t\t\tselected
\t\t\t\t\t\t\t\t\t";
                        }
                        // line 40
                        echo "\t\t\t\t\t\t\t\t>";
                        echo $context["val_text"];
                        echo "</option>
\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['val_id'], $context['val_text'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 42
                    echo "\t\t\t\t\t\t";
                } else {
                    // line 43
                    echo "\t\t\t\t\t\t\t";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(($context["poip_settings_enable_disable_options"] ?? null));
                    foreach ($context['_seq'] as $context["poip_settings_enable_disable_option_value"] => $context["poip_settings_enable_disable_option_name"]) {
                        // line 44
                        echo "\t\t\t\t\t\t\t\t<option value=\"";
                        echo $context["poip_settings_enable_disable_option_value"];
                        echo "\"
\t\t\t\t\t\t\t\t\t";
                        // line 45
                        if (((((twig_get_attribute($this->env, $this->source, ($context["poip_saved_settings"] ?? null), twig_get_attribute($this->env, $this->source, $context["poip_setting"], "name", [], "any", false, false, false, 45), [], "array", true, true, false, 45) &&  !(null === (($__internal_compile_5 = ($context["poip_saved_settings"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5[twig_get_attribute($this->env, $this->source, $context["poip_setting"], "name", [], "any", false, false, false, 45)] ?? null) : null)))) ? ((($__internal_compile_6 = ($context["poip_saved_settings"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6[twig_get_attribute($this->env, $this->source, $context["poip_setting"], "name", [], "any", false, false, false, 45)] ?? null) : null)) : (0)) == $context["poip_settings_enable_disable_option_value"])) {
                            // line 46
                            echo "\t\t\t\t\t\t\t\t\t\tselected
\t\t\t\t\t\t\t\t\t";
                        }
                        // line 48
                        echo "\t\t\t\t\t\t\t\t>";
                        echo $context["poip_settings_enable_disable_option_name"];
                        echo "</option>
\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['poip_settings_enable_disable_option_value'], $context['poip_settings_enable_disable_option_name'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 50
                    echo "\t\t\t\t\t\t";
                }
                // line 51
                echo "\t\t\t\t\t</select>
\t\t\t\t\t</div>
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['poip_setting'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 54
            echo "\t\t
\t\t\t</div>\t
\t\t</div>
\t\t
\t</div>
\t
\t<script>
\t\tpoip = {
\t\t\tshowSettings: function() {
\t\t\t\t\$('#poip-button-hide-settings').show();
\t\t\t\t\$('#poip-button-show-settings').hide();
\t\t\t\t\$('#poip-settings').show();
\t\t\t},
\t\t\thideSettings: function() {
\t\t\t\t\$('#poip-button-hide-settings').hide();
\t\t\t\t\$('#poip-button-show-settings').show();
\t\t\t\t\$('#poip-settings').hide();
\t\t\t\tpoip.updateNumberOfCustomSettings();
\t\t\t},
\t\t\tupdateNumberOfCustomSettings: function(){
\t\t\t\tlet cnt = 0;
\t\t\t\t\$('select[name^=\"poip_settings[\"]').each(function(){
\t\t\t\t\tif ( \$(this).val() && \$(this).val() != '0' ) {
\t\t\t\t\t\tcnt++;
\t\t\t\t\t}
\t\t\t\t});
\t\t\t\tlet cnt_view = cnt ? ' ('+cnt+')' : '';
\t\t\t\t\$('#poip-custom-settings-cnt').html(cnt_view);
\t\t\t},
\t\t};
\t\tpoip.updateNumberOfCustomSettings();
\t</script>

";
        }
    }

    public function getTemplateName()
    {
        return "extension/module/product_option_image_pro/option_settings.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  189 => 54,  181 => 51,  178 => 50,  169 => 48,  165 => 46,  163 => 45,  158 => 44,  153 => 43,  150 => 42,  141 => 40,  137 => 38,  135 => 37,  130 => 36,  126 => 35,  121 => 34,  119 => 33,  115 => 32,  111 => 31,  108 => 30,  104 => 29,  97 => 26,  94 => 25,  91 => 24,  88 => 23,  85 => 22,  82 => 21,  76 => 20,  73 => 19,  70 => 18,  67 => 17,  62 => 16,  60 => 15,  52 => 10,  45 => 6,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/module/product_option_image_pro/option_settings.twig", "");
    }
}
