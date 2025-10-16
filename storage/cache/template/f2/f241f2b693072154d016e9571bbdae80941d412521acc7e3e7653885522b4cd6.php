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

/* default/template/extension/faqcategorypro.twig */
class __TwigTemplate_27f82529e8fe118003560f95c77f90d91ee98e47eb0fb105c4c0fe73e27b91d2 extends \Twig\Template
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
        if (($context["results"] ?? null)) {
            // line 2
            echo "<div itemscope itemtype=\"https://schema.org/FAQPage\" class=\"row\" style=\"margin:1%; \">

  \t";
            // line 4
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["results"] ?? null));
            foreach ($context['_seq'] as $context["keys"] => $context["result"]) {
                // line 5
                echo "  \t";
                if ((($context["displaycategory"] ?? null) == "yes")) {
                    // line 6
                    echo "\t<h3 class=\"faq_title\">";
                    echo twig_get_attribute($this->env, $this->source, $context["result"], "name", [], "any", false, false, false, 6);
                    echo "</h3>
\t";
                }
                // line 8
                echo "\t\t<div class=\"panel-group accordion\">
\t\t";
                // line 9
                if (twig_get_attribute($this->env, $this->source, $context["result"], "subfaqs", [], "any", false, false, false, 9)) {
                    // line 10
                    echo "\t\t \t";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["result"], "subfaqs", [], "any", false, false, false, 10));
                    foreach ($context['_seq'] as $context["key"] => $context["sub"]) {
                        // line 11
                        echo "\t\t\t<div itemscope itemprop=\"mainEntity\" itemtype=\"https://schema.org/Question\"  class=\"panel panel-default\">
\t\t\t\t<div itemprop=\"name\" class=\"panel-heading\">
\t\t\t\t  <h4 class=\"panel-title\">
\t\t\t\t\t<!-- New -->
\t\t\t\t\t<a class=\"accordion-toggle autoswtich";
                        // line 15
                        echo twig_get_attribute($this->env, $this->source, $context["sub"], "faq_id", [], "any", false, false, false, 15);
                        echo "\" data-toggle=\"collapse\" data-parent=\".accordion\" href=\"#collapse";
                        echo $context["key"];
                        echo "-";
                        echo twig_get_attribute($this->env, $this->source, $context["result"], "fcategory_id", [], "any", false, false, false, 15);
                        echo "\">
\t\t\t\t\t<!-- New -->
\t\t\t\t\t";
                        // line 17
                        if ((($context["keys"] == 0) && ($context["key"] == 0))) {
                            // line 18
                            echo "\t\t\t\t\t  <span class=\"glyphicon glyphicon-minus\"></span>
\t\t\t\t\t";
                        } else {
                            // line 20
                            echo "\t\t\t\t\t <span class=\"glyphicon glyphicon-plus\"></span>
\t\t\t\t\t";
                        }
                        // line 22
                        echo "\t\t\t\t\t  ";
                        echo twig_get_attribute($this->env, $this->source, $context["sub"], "name", [], "any", false, false, false, 22);
                        echo "
\t\t\t\t\t</a>
\t\t\t\t  </h4>
\t\t\t\t</div>
\t\t\t\t<div itemscope itemprop=\"acceptedAnswer\" itemtype=\"https://schema.org/Answer\"  id=\"collapse";
                        // line 26
                        echo $context["key"];
                        echo "-";
                        echo twig_get_attribute($this->env, $this->source, $context["result"], "fcategory_id", [], "any", false, false, false, 26);
                        echo "\" class=\"panel-collapse collapse ";
                        if ((($context["keys"] == 0) && ($context["key"] == 0))) {
                            echo " ";
                            echo "in";
                            echo " ";
                        }
                        echo " \">
\t\t\t\t  <div itemprop=\"text\" class=\"panel-body\">
\t\t\t\t\t";
                        // line 28
                        echo twig_get_attribute($this->env, $this->source, $context["sub"], "description", [], "any", false, false, false, 28);
                        echo "
\t\t\t\t  </div>
\t\t\t\t</div>
\t\t\t  </div>
\t\t  ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['key'], $context['sub'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 33
                    echo "\t\t  ";
                }
                // line 34
                echo "\t\t</div>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['keys'], $context['result'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 36
            echo "</div>

<script>
\t\$('.collapse').on('shown.bs.collapse', function(){
\$(this).parent().find(\".glyphicon-plus\").removeClass(\"glyphicon-plus\").addClass(\"glyphicon-minus\");
}).on('hidden.bs.collapse', function(){
\$(this).parent().find(\".glyphicon-minus\").removeClass(\"glyphicon-minus\").addClass(\"glyphicon-plus\");
});
</script>
 ";
        }
    }

    public function getTemplateName()
    {
        return "default/template/extension/faqcategorypro.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  133 => 36,  126 => 34,  123 => 33,  112 => 28,  99 => 26,  91 => 22,  87 => 20,  83 => 18,  81 => 17,  72 => 15,  66 => 11,  61 => 10,  59 => 9,  56 => 8,  50 => 6,  47 => 5,  43 => 4,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/extension/faqcategorypro.twig", "");
    }
}
