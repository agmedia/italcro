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

/* basel/template/extension/module/content_widgets/contact_form.twig */
class __TwigTemplate_49d81ccae8c8686a6ecc4e6fa8cba1fe5056e23d0b649ee65195abe676332918 extends \Twig\Template
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
        echo "<div class=\"contact_form\">
<form class=\"form-horizontal\" id=\"mail_form";
        // line 2
        echo ($context["module"] ?? null);
        echo "\">
<div class=\"form-group\">
  <div class=\"col-sm-12\">
  <label>";
        // line 5
        echo ($context["basel_text_name"] ?? null);
        echo "</label>
    <input type=\"text\" name=\"name\" value=\"\" class=\"form-control\" />
  </div>
</div>
<div class=\"form-group required\">
  <div class=\"col-sm-12\">
  <label>";
        // line 11
        echo ($context["basel_text_email"] ?? null);
        echo "</label>
    <input type=\"text\" name=\"email\" value=\"\" class=\"form-control\" />
  </div>
</div>
<div class=\"form-group required\">
  <div class=\"col-sm-12\">
  <label>";
        // line 17
        echo ($context["basel_text_message"] ?? null);
        echo "</label>
    <textarea name=\"text\" rows=\"4\" class=\"form-control\"></textarea>
  </div>
</div>
  <div class=\"form-group required\">
  <div class=\"col-sm-12\">
  <label>";
        // line 23
        echo ($context["basel_text_captcha"] ?? null);
        echo "</label>
    <div class=\"input-group\">
    <span class=\"input-group-addon captcha_addon\"><img src=\"index.php?route=extension/basel/basel_features/basel_captcha\" alt=\"\" class=\"captchaimg\" /></span>
    <input type=\"text\" name=\"captcha\" value=\"\" class=\"form-control\" />
    </div>
  </div>
</div>
<div class=\"form-group\">
<div class=\"col-sm-12\">
  <button type=\"button\" class=\"btn btn-contrast\" onclick=\"contact_form_send(";
        // line 32
        echo ($context["module"] ?? null);
        echo ");\">";
        echo ($context["basel_text_submit"] ?? null);
        echo "</button>
  </div>
</div>
<div class=\"respond\"></div>
</form>
</div>";
    }

    public function getTemplateName()
    {
        return "basel/template/extension/module/content_widgets/contact_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  85 => 32,  73 => 23,  64 => 17,  55 => 11,  46 => 5,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/extension/module/content_widgets/contact_form.twig", "");
    }
}
