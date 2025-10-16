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

/* extension/module/msmart_search/_footer.twig */
class __TwigTemplate_cc04bea236929cf6bb3d6593ada4465521e765eab20ebc0e4f44103517f4fee8 extends \Twig\Template
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
        echo "\t\t\t\t";
        if ( !twig_test_empty(($context["action_save"] ?? null))) {
            echo " 
\t\t\t\t\t</form>
\t\t\t\t";
        }
        // line 3
        echo " 
\t\t\t</div>
\t\t</div>
\t</div>
</div>

";
        // line 9
        echo ($context["footer"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "extension/module/msmart_search/_footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 9,  44 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/module/msmart_search/_footer.twig", "/Users/tomek/Herd/reprograv/upload/admin/view/template/extension/module/msmart_search/_footer.twig");
    }
}
