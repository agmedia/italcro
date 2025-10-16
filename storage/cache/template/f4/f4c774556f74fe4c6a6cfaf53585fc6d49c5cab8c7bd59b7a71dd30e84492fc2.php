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

/* default/template/extension/captcha/google.twig */
class __TwigTemplate_201dd651b638cdbe062dff2fc3752acce100731033cc4c3c52f9b01b3264356b extends \Twig\Template
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
        echo "
            
\t\t\t<div id=\"recaptcha-badge\"></div>
\t\t\t<input type=\"hidden\" name=\"recaptcha_response\">
\t\t\t
\t\t\t<script async src=\"https://www.google.com/recaptcha/api.js?render=explicit&onload=getRecaptcha\" type=\"text/javascript\"></script>\t\t\t
            <script type=\"text/javascript\">
\t\t\t\t
\t\t\tfunction getRecaptcha()
\t\t\t{
\t\t\t\tvar grecaptchaID = grecaptcha.render(\"recaptcha-badge\", {
\t\t\t\t\t\"sitekey\": \"";
        // line 12
        echo ($context["site_key"] ?? null);
        echo "\",
\t\t\t\t\t\"badge\": \"bottomright\",
\t\t\t\t\t\"size\": \"invisible\"
\t\t\t\t});
\t\t\t\t\t\t\t
\t\t\t\tgrecaptcha.ready(function() {
\t\t\t\t\tgrecaptcha.execute(grecaptchaID, {
\t\t\t\t\t\taction: \"";
        // line 19
        echo ($context["recaptcha_action"] ?? null);
        echo "\"
\t\t\t\t\t}).then(function(token) {
\t\t\t\t\t\tdocument.querySelector(\"input[name='recaptcha_response']\").value = token;
\t\t\t\t\t});
\t\t\t\t}); 
\t\t\t}
                
\t\t\t</script>
\t\t\t
\t\t\t";
    }

    public function getTemplateName()
    {
        return "default/template/extension/captcha/google.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 19,  50 => 12,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/extension/captcha/google.twig", "");
    }
}
