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

/* extension/basel/panel_tabs/notifications.twig */
class __TwigTemplate_5808ee3e0d6433fcdf6400b74fa400a2f50985155113aba2a6dbab8eeeeeda27 extends \Twig\Template
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
        echo "<legend>Notifications</legend>

<legend class=\"sub\">Top Line Promotion Message</legend>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"The top line notification can be used to put a text message to the top of the header\">Status</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][basel_top_promo_status]\" value=\"0\" ";
        // line 8
        if ((($context["basel_top_promo_status"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][basel_top_promo_status]\" value=\"1\" ";
        // line 9
        if ((($context["basel_top_promo_status"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Width</label>
    <div class=\"col-sm-10 toggle-btn both-blue\">
    <label><input type=\"radio\" name=\"settings[basel][basel_top_promo_width]\" value=\"\" ";
        // line 16
        if ((($context["basel_top_promo_width"] ?? null) == "")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Boxed</span></label>
    <label><input type=\"radio\" name=\"settings[basel][basel_top_promo_width]\" value=\"full-width\" ";
        // line 17
        if ((($context["basel_top_promo_width"] ?? null) == "full-width")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Full Width</span></label>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"If enabled, a close button will be added to the message, and if clicked, a cookie will  block the message for that user the next 30 days\">Close button</span></label>
    <div class=\"col-sm-10 toggle-btn both-blue\">
    <label><input type=\"radio\" name=\"settings[basel][basel_top_promo_close]\" value=\"0\" ";
        // line 24
        if ((($context["basel_top_promo_close"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][basel_top_promo_close]\" value=\"1\" ";
        // line 25
        if ((($context["basel_top_promo_close"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Text alignment</label>
    <div class=\"col-sm-10 toggle-btn both-blue\">
    <label><input type=\"radio\" name=\"settings[basel][basel_top_promo_align]\" value=\"\" ";
        // line 32
        if ((($context["basel_top_promo_align"] ?? null) == "")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Left</span></label>
    <label><input type=\"radio\" name=\"settings[basel][basel_top_promo_align]\" value=\"text-center\" ";
        // line 33
        if ((($context["basel_top_promo_align"] ?? null) == "text-center")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Center</span></label>
    </div>                   
</div>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\">Promo text</label>
    <div class=\"col-sm-10\">
    ";
        // line 40
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 41
            echo "    <div class=\"input-group\">
    <span class=\"input-group-addon\">
    <img src=\"language/";
            // line 43
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 43);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 43);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 43);
            echo "\" /></span>
    <input class=\"form-control\" name=\"settings[basel][basel_top_promo_text][";
            // line 44
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 44);
            echo "]\" value=\"";
            echo (((($__internal_compile_0 = ($context["basel_top_promo_text"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 44)] ?? null) : null)) ? ((($__internal_compile_1 = ($context["basel_top_promo_text"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 44)] ?? null) : null)) : (""));
            echo "\" />
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 47
        echo "    </div>
</div>

<legend class=\"sub\">Cookie Information Bar</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Cookie bar status</label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][basel_cookie_bar_status]\" value=\"0\" ";
        // line 54
        if ((($context["basel_cookie_bar_status"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][basel_cookie_bar_status]\" value=\"1\" ";
        // line 55
        if ((($context["basel_cookie_bar_status"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"The link target for the Read more link. Leave empty to disable the link\">Read more link target</span></label>
    <div class=\"col-sm-10\">
    <input class=\"form-control\" name=\"settings[basel][basel_cookie_bar_url]\" value=\"";
        // line 62
        echo ((($context["basel_cookie_bar_url"] ?? null)) ? (($context["basel_cookie_bar_url"] ?? null)) : (""));
        echo "\" />
    </div>                   
</div>


<legend class=\"sub\">Popup Notification</legend>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Popup notification status</label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][basel_popup_note_status]\" value=\"0\" ";
        // line 72
        if ((($context["basel_popup_note_status"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][basel_popup_note_status]\" value=\"1\" ";
        // line 73
        if ((($context["basel_popup_note_status"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"If enabled, a cookie will be set for 30 days to prevent the popup for being shown more than one time per visitor\">Show only once</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][basel_popup_note_once]\" value=\"0\" ";
        // line 80
        if ((($context["basel_popup_note_once"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][basel_popup_note_once]\" value=\"1\" ";
        // line 81
        if ((($context["basel_popup_note_once"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\">Apply to home page only</label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][basel_popup_note_home]\" value=\"0\" ";
        // line 88
        if ((($context["basel_popup_note_home"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][basel_popup_note_home]\" value=\"1\" ";
        // line 89
        if ((($context["basel_popup_note_home"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Delay in milliseconds until the popup opens. For example, 5000 will open the popup after 5 seconds. Enter 0 to show the popup immediately on page load.\">Popup delay</span></label>
    <div class=\"col-sm-10 form-inline\">
    <input class=\"form-control\" style=\"width:120px\" name=\"settings[basel][basel_popup_note_delay]\" value=\"";
        // line 96
        echo ((($context["basel_popup_note_delay"] ?? null)) ? (($context["basel_popup_note_delay"] ?? null)) : ("5000"));
        echo "\" /> ms
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Width * Height\">Popup size</span></label>
    <div class=\"col-sm-10 form-inline\">
    <input class=\"form-control\" style=\"width:120px\" name=\"settings[basel][basel_popup_note_w]\" value=\"";
        // line 103
        echo ((($context["basel_popup_note_w"] ?? null)) ? (($context["basel_popup_note_w"] ?? null)) : ("860"));
        echo "\" /> px &nbsp;
    <input class=\"form-control\" style=\"width:120px\" name=\"settings[basel][basel_popup_note_h]\" value=\"";
        // line 104
        echo ((($context["basel_popup_note_h"] ?? null)) ? (($context["basel_popup_note_h"] ?? null)) : ("500"));
        echo "\" /> px 
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Enable or disable the popup to visitors using a mobile device\">Mobile status</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][basel_popup_note_m]\" value=\"767\" ";
        // line 111
        if ((($context["basel_popup_note_m"] ?? null) == "767")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][basel_popup_note_m]\" value=\"10\" ";
        // line 112
        if ((($context["basel_popup_note_m"] ?? null) == "10")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"If an image is chosen, it will take place at the left side of the popup window\">Image</span></label>
    <div class=\"col-sm-10\">
    <a href=\"\" id=\"thumb-popup-img\" data-toggle=\"image\" class=\"img-thumbnail\"><img src=\"";
        // line 119
        echo ($context["popup_thumb"] ?? null);
        echo "\" alt=\"\" title=\"\" data-placeholder=\"";
        echo ($context["placeholder"] ?? null);
        echo "\" /></a>
    <input type=\"hidden\" name=\"settings[basel][basel_popup_note_img]\" value=\"";
        // line 120
        echo ($context["basel_popup_note_img"] ?? null);
        echo "\" id=\"input-popup-img\" />
    </div>                   
</div>

<ul class=\"nav nav-tabs language-tabs\">
";
        // line 125
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 126
            echo "<li><a href=\"#basel_popup_note_block";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 126);
            echo "\" data-toggle=\"tab\"><img src=\"language/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 126);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 126);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 126);
            echo "\" /> ";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 126);
            echo "</a></li>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 128
        echo "</ul>
<div class=\"tab-content\">
";
        // line 130
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 131
            echo "<div class=\"tab-pane\" id=\"basel_popup_note_block";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 131);
            echo "\">
<div class=\"form-group\">
<label class=\"col-sm-2 control-label\">Heading</label>
<div class=\"col-sm-10\">
  <input class=\"form-control\" name=\"settings[basel][basel_popup_note_title][";
            // line 135
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 135);
            echo "]\" value=\"";
            echo (((($__internal_compile_2 = ($context["basel_popup_note_title"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 135)] ?? null) : null)) ? ((($__internal_compile_3 = ($context["basel_popup_note_title"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 135)] ?? null) : null)) : (""));
            echo "\" />
</div>
</div>

  <div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Use shortcode {signup} to add a newsletter signup field\">Popup content</span>
    <br /><a class=\"editor-toggle\" id=\"enable-editor-popup-1\" onclick=\"enable_editor('popup','1')\">Enable HTML editor</a></label>
    <div class=\"col-sm-10\">
      <textarea id=\"editor-textarea-popup-1\" name=\"settings[basel][basel_popup_note_block][";
            // line 143
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 143);
            echo "]\" class=\"form-control code\">";
            echo (((($__internal_compile_4 = ($context["basel_popup_note_block"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 143)] ?? null) : null)) ? ((($__internal_compile_5 = ($context["basel_popup_note_block"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 143)] ?? null) : null)) : (""));
            echo "</textarea>
    </div>
  </div>
  
 </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 149
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "extension/basel/panel_tabs/notifications.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  359 => 149,  345 => 143,  332 => 135,  324 => 131,  320 => 130,  316 => 128,  299 => 126,  295 => 125,  287 => 120,  281 => 119,  269 => 112,  263 => 111,  253 => 104,  249 => 103,  239 => 96,  227 => 89,  221 => 88,  209 => 81,  203 => 80,  191 => 73,  185 => 72,  172 => 62,  160 => 55,  154 => 54,  145 => 47,  134 => 44,  126 => 43,  122 => 41,  118 => 40,  106 => 33,  100 => 32,  88 => 25,  82 => 24,  70 => 17,  64 => 16,  52 => 9,  46 => 8,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/basel/panel_tabs/notifications.twig", "/Users/tomek/Herd/reprograv/upload/admin/view/template/extension/basel/panel_tabs/notifications.twig");
    }
}
