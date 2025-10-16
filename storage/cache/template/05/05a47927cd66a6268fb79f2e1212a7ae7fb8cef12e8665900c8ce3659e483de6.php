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

/* basel/template/common/headers/header6.twig */
class __TwigTemplate_727193de58e9b6baca04a9152195bcf3f66f60d70141cfdbc0e46f301f67b903 extends \Twig\Template
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
        echo "<div class=\"header-wrapper header6\">

";
        // line 3
        if (($context["top_line_style"] ?? null)) {
            // line 4
            echo "<div class=\"top_line\">
  <div class=\"container ";
            // line 5
            echo ($context["top_line_width"] ?? null);
            echo "\">
    <div class=\"table\">
        <div class=\"table-cell left \">
            <div class=\"promo-message\">";
            // line 8
            echo ($context["promo_message"] ?? null);
            echo "</div>
        </div>
        <div class=\"table-cell text-right \">
            <div class=\"links\">
            <ul>
            ";
            // line 13
            $this->loadTemplate("basel/template/common/static_links.twig", "basel/template/common/headers/header6.twig", 13)->display($context);
            // line 14
            echo "            </ul>
            ";
            // line 15
            if (($context["lang_curr_title"] ?? null)) {
                // line 16
                echo "            <div class=\"setting-ul\">
            <div class=\"setting-li dropdown-wrapper from-left lang-curr-trigger nowrap\"><a>
            <span><img src=\"image/";
                // line 18
                echo ($context["lang"] ?? null);
                echo ".png\" alt=\"";
                echo ($context["lang_curr_title"] ?? null);
                echo "\" title=\"";
                echo ($context["lang_curr_title"] ?? null);
                echo "\"> ";
                echo ($context["lang_curr_title"] ?? null);
                echo "</span>
            </a>
            <div class=\"dropdown-content dropdown-right lang-curr-wrapper\">
            ";
                // line 21
                echo ($context["language"] ?? null);
                echo "
            ";
                // line 22
                echo ($context["currency"] ?? null);
                echo "
            </div>
            </div>
            </div>
            ";
            }
            // line 27
            echo "            </div>
        </div>
    </div> <!-- .table ends -->
  </div> <!-- .container ends -->
</div> <!-- .top_line ends -->
";
        }
        // line 33
        echo "
<span class=\"table header-main sticky-header-placeholder slidedown \">&nbsp;</span>
<div class=\" outer-container header-style sticky-header\">
  <div class=\"container ";
        // line 36
        echo ($context["main_header_width"] ?? null);
        echo "\">
    <div class=\"table header-main ";
        // line 37
        echo ($context["main_menu_align"] ?? null);
        echo "\">

    
    
    <div class=\"table-cell text-left  w25 logo\">

        <div id=\"logo\">
         
        <a href=\"";
        // line 45
        echo ($context["home"] ?? null);
        echo "\"><img src=\"image/italcro-logo-front.svg\" title=\"";
        echo ($context["name"] ?? null);
        echo "\" alt=\"";
        echo ($context["name"] ?? null);
        echo "\" /></a>
        </div>

    </div>
    
    ";
        // line 50
        if (($context["primary_menu"] ?? null)) {
            // line 51
            echo "    <div class=\"table-cell text-center w60 menu-cell hidden-xs hidden-sm\">
        <div class=\"main-menu\">
            <ul class=\"categories\">
              ";
            // line 54
            if ((($context["primary_menu"] ?? null) == "oc")) {
                // line 55
                echo "                <!-- Default menu -->
                ";
                // line 56
                echo ($context["default_menu"] ?? null);
                echo "
              ";
            } elseif (            // line 57
array_key_exists("primary_menu", $context)) {
                echo " 
                <!-- Mega menu -->
                ";
                // line 59
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["primary_menu_desktop"] ?? null));
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
                    // line 60
                    echo "                ";
                    $this->loadTemplate("basel/template/common/menus/mega_menu.twig", "basel/template/common/headers/header6.twig", 60)->display($context);
                    // line 61
                    echo "                ";
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
                // line 62
                echo "              ";
            }
            // line 63
            echo "            </ul>
        </div>
    </div>
    ";
        }
        // line 67
        echo "  
    <div class=\"table-cell w15 btns shortcuts text-right\">
       
       <div class=\"font-zero\">
           <div class=\"icon-element is_wishlist\">

               ";
        // line 73
        if (($context["logged"] ?? null)) {
            // line 74
            echo "                   <a class=\"shortcut-wrapper wishlist \" title=\"Moj račun\" href=\"";
            echo ($context["login"] ?? null);
            echo "\"><i class=\"icon-user icon\"></i></a><a class=\"shortcut-wrapper wishlist hidden-xs\"  title=\"Odjava\" href=\"";
            echo ($context["logout"] ?? null);
            echo "\"> Odjava<div class=\"wishlist-hover\"></div>
               </a>
               ";
        } else {
            // line 77
            echo "                   <a class=\"shortcut-wrapper wishlist\" title=\"Moj račun\" href=\"";
            echo ($context["login"] ?? null);
            echo "\">
                       <div class=\"wishlist-hover\"><i class=\"icon-user icon\"></i></div>
                   </a>
               ";
        }
        // line 81
        echo "           </div>


           <div class=\"icon-element is_wishlist hidden-xs\">
        <a class=\"shortcut-wrapper wishlist\" href=\"";
        // line 85
        echo ($context["wishlist"] ?? null);
        echo "\">
        <div class=\"wishlist-hover\"><i class=\"icon-heart icon\"></i><span class=\"counter wishlist-counter\">";
        // line 86
        echo ($context["wishlist_counter"] ?? null);
        echo "</span></div>
        </a>
        </div>
        
        <div class=\"icon-element catalog_hide\">
        <div id=\"cart\" class=\"dropdown-wrapper from-top\">
        <a href=\"";
        // line 92
        echo ($context["shopping_cart"] ?? null);
        echo "\" class=\"shortcut-wrapper cart\">
        <i id=\"cart-icon\" class=\"global-cart icon\"></i> <span id=\"cart-total\" class=\"nowrap\">
        <span class=\"counter cart-total-items\">";
        // line 94
        echo ($context["cart_items"] ?? null);
        echo "</span>
        </a>
        <div class=\"dropdown-content dropdown-right hidden-sm hidden-xs\">
        ";
        // line 97
        echo ($context["cart"] ?? null);
        echo "
        </div>
        </div>
        </div>
        
        <div class=\"icon-element\">
        <a class=\"shortcut-wrapper menu-trigger hidden-md hidden-lg\">
        <i class=\"icon-line-menu icon\"></i>
        </a>
        </div>
        
       </div>
        
    </div>
    
    </div> <!-- .table.header_main ends -->
  </div> <!-- .container ends -->
</div> <!-- .sticky ends -->

<div class=\" sticky-header slidedown outer-container header-bottom  \">
<div class=\"container ";
        // line 117
        echo ($context["main_header_width"] ?? null);
        echo "\">
    <div class=\"table\">
        ";
        // line 119
        if (($context["secondary_menu"] ?? null)) {
            // line 120
            echo "        <div class=\"table-cell w235 hidden-xs hidden-sm\">
        <div class=\"main-menu vertical vertical-menu-bg dropdown-wrapper from-bottom\">
        <p class=\"menu-heading\">";
            // line 122
            echo ($context["basel_text_category"] ?? null);
            echo "<i class=\"fa fa-angle-down\"></i></p>
            <ul class=\"categories vertical-menu-bg dropdown-content\">
              ";
            // line 124
            if ((($context["secondary_menu"] ?? null) == "oc")) {
                // line 125
                echo "                <!-- Default menu -->
                ";
                // line 126
                echo ($context["default_menu"] ?? null);
                echo "
              ";
            } elseif (            // line 127
array_key_exists("secondary_menu", $context)) {
                echo " 
                <!-- Mega menu -->
                ";
                // line 129
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["secondary_menu_desktop"] ?? null));
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
                    // line 130
                    echo "                ";
                    $this->loadTemplate("basel/template/common/menus/mega_menu.twig", "basel/template/common/headers/header6.twig", 130)->display($context);
                    // line 131
                    echo "                ";
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
                // line 132
                echo "              ";
            }
            // line 133
            echo "            </ul>
        </div>
        </div>
        ";
        }
        // line 137
        echo "        
            <div class=\"table-cell w100 search-cell ";
        // line 138
        echo ($context["basel_search_scheme"] ?? null);
        echo "\">
         ";
        // line 139
        echo ($context["basel_search"] ?? null);
        echo "
        </div>



    </div>
</div><!-- .container ends -->
</div>

</div> <!-- .header_wrapper ends -->";
    }

    public function getTemplateName()
    {
        return "basel/template/common/headers/header6.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  359 => 139,  355 => 138,  352 => 137,  346 => 133,  343 => 132,  329 => 131,  326 => 130,  309 => 129,  304 => 127,  300 => 126,  297 => 125,  295 => 124,  290 => 122,  286 => 120,  284 => 119,  279 => 117,  256 => 97,  250 => 94,  245 => 92,  236 => 86,  232 => 85,  226 => 81,  218 => 77,  209 => 74,  207 => 73,  199 => 67,  193 => 63,  190 => 62,  176 => 61,  173 => 60,  156 => 59,  151 => 57,  147 => 56,  144 => 55,  142 => 54,  137 => 51,  135 => 50,  123 => 45,  112 => 37,  108 => 36,  103 => 33,  95 => 27,  87 => 22,  83 => 21,  71 => 18,  67 => 16,  65 => 15,  62 => 14,  60 => 13,  52 => 8,  46 => 5,  43 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/common/headers/header6.twig", "/Users/tomek/Herd/italcro/upload/catalog/view/theme/basel/template/common/headers/header6.twig");
    }
}
