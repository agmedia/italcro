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

/* basel/template/common/mobile-nav.twig */
class __TwigTemplate_708b891651d322e5b63660561088c356e1775c2f67db2d28e6fadddfbb643fa2 extends \Twig\Template
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
        echo "<div class=\"main-menu-wrapper hidden-md hidden-lg\">


    <div class=\"closemenu\">
        <div class=\"icon-element mnu\">

            <a class=\"shortcut-wrapper menu-closer hidden-md hidden-lg\" title=\"Navigacija\">
                <i class=\"icon-line-cross icon\"></i>
            </a>

        </div>
    </div>

<ul class=\"mobile-top lang\">
     <li class=\"mobile-lang-curr \"></li>
    </ul>

";
        // line 18
        if (($context["secondary_menu"] ?? null)) {
            // line 19
            echo "<ul class=\"categories\">
    ";
            // line 20
            if ((($context["secondary_menu"] ?? null) == "oc")) {
                // line 21
                echo "        <!-- Default menu -->
        ";
                // line 22
                echo ($context["default_menu"] ?? null);
                echo "
    ";
            } elseif (            // line 23
array_key_exists("secondary_menu", $context)) {
                // line 24
                echo "        <!-- Mega menu -->
        ";
                // line 25
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["secondary_menu_mobile"] ?? null));
                $context['loop'] = [
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                ];
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["key"] => $context["row"]) {
                    // line 26
                    echo "            ";
                    $this->loadTemplate("basel/template/common/menus/mega_menu.twig", "basel/template/common/mobile-nav.twig", 26)->display($context);
                    // line 27
                    echo "        ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['row'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 28
                echo "    ";
            }
            // line 29
            echo "</ul>
";
        }
        // line 31
        echo "<ul class=\"categories\">
    ";
        // line 32
        $this->loadTemplate("basel/template/common/static_links.twig", "basel/template/common/mobile-nav.twig", 32)->display($context);
        // line 33
        echo "</ul>

";
        // line 35
        if (($context["primary_menu"] ?? null)) {
            // line 36
            echo "<ul class=\"categories\">
";
            // line 37
            if ((($context["primary_menu"] ?? null) == "oc")) {
                // line 38
                echo "<!-- Default menu -->
";
                // line 39
                echo ($context["default_menu"] ?? null);
                echo "
";
            } elseif (            // line 40
array_key_exists("primary_menu", $context)) {
                // line 41
                echo "<!-- Mega menu -->
";
                // line 42
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["primary_menu_mobile"] ?? null));
                $context['loop'] = [
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                ];
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["key"] => $context["row"]) {
                    // line 43
                    $this->loadTemplate("basel/template/common/menus/mega_menu.twig", "basel/template/common/mobile-nav.twig", 43)->display($context);
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['row'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
            }
            // line 46
            echo "</ul>
";
        }
        // line 48
        echo "</div>
<span class=\"body-cover menu-closer\"></span>";
    }

    public function getTemplateName()
    {
        return "basel/template/common/mobile-nav.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  180 => 48,  176 => 46,  161 => 43,  144 => 42,  141 => 41,  139 => 40,  135 => 39,  132 => 38,  130 => 37,  127 => 36,  125 => 35,  121 => 33,  119 => 32,  116 => 31,  112 => 29,  109 => 28,  95 => 27,  92 => 26,  75 => 25,  72 => 24,  70 => 23,  66 => 22,  63 => 21,  61 => 20,  58 => 19,  56 => 18,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/common/mobile-nav.twig", "/Users/tomek/Herd/reprograv/upload/catalog/view/theme/basel/template/common/mobile-nav.twig");
    }
}
