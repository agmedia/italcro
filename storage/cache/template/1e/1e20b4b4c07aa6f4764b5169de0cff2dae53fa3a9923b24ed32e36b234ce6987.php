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

/* basel/template/common/static_links.twig */
class __TwigTemplate_e78bb7847162ae33b7f631e5e7c9ecdcb3f6d38a5abf01de798084928d37e10d extends \Twig\Template
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
        if (($context["use_custom_links"] ?? null)) {
            // line 2
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["basel_links"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["basel_link"]) {
                // line 3
                echo "<li class=\"static-link\"><a class=\"anim-underline\" aria-label=\"External link\" href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["basel_link"], "target", [], "any", false, false, false, 3);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["basel_link"], "text", [], "any", false, false, false, 3);
                echo "</a></li>
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['basel_link'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 6
            echo "<li class=\"static-link\"><a class=\"anim-underline\"  href=\"";
            echo ($context["account"] ?? null);
            echo "\" title=\"";
            echo ($context["text_account"] ?? null);
            echo "\">";
            echo ($context["text_account"] ?? null);
            echo "</a></li>
<li class=\"static-link is_wishlist\"><a class=\"anim-underline wishlist-total\" href=\"";
            // line 7
            echo ($context["wishlist"] ?? null);
            echo "\" title=\"";
            echo ($context["text_wishlist"] ?? null);
            echo "\"><span>";
            echo ($context["text_wishlist"] ?? null);
            echo "</span></a></li>
<li class=\"static-link\"><a class=\"anim-underline\"  href=\"";
            // line 8
            echo ($context["shopping_cart"] ?? null);
            echo "\" title=\"";
            echo ($context["text_shopping_cart"] ?? null);
            echo "\">";
            echo ($context["text_shopping_cart"] ?? null);
            echo "</a></li>
<li class=\"static-link\"><a class=\"anim-underline\"  href=\"";
            // line 9
            echo ($context["checkout"] ?? null);
            echo "\" title=\"";
            echo ($context["text_checkout"] ?? null);
            echo "\">";
            echo ($context["text_checkout"] ?? null);
            echo "</a></li>
";
        }
    }

    public function getTemplateName()
    {
        return "basel/template/common/static_links.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  80 => 9,  72 => 8,  64 => 7,  55 => 6,  43 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/common/static_links.twig", "/Users/tomek/Herd/reprograv/upload/catalog/view/theme/basel/template/common/static_links.twig");
    }
}
