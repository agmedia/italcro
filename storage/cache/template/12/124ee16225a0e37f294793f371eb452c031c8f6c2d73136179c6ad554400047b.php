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

/* basel/template/common/footer.twig */
class __TwigTemplate_e4e9bdac8d9eac31dd31ac7f9926ec47d503d33e390e1ca01d870b7a2abb6c65 extends \Twig\Template
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
        echo "<div class=\"container\">
    ";
        // line 2
        echo ($context["position_bottom_half"] ?? null);
        echo "
</div>
<div class=\"container\">
    ";
        // line 5
        echo ($context["position_bottom"] ?? null);
        echo "
</div>
<div id=\"footer\">

    <div class=\"logo-footer\"> <img src=\"image/footer-logo.svg\"></div>
    <div class=\"container\">
        ";
        // line 11
        if ((($context["footer_block_1"] ?? null) && (($context["footer_block_1"] ?? null) != "<p><br></p>"))) {
            // line 12
            echo "            <div class=\"footer-top-block\">
                ";
            // line 13
            echo ($context["footer_block_1"] ?? null);
            echo "
            </div>
        ";
        }
        // line 16
        echo "        <div class=\"row links-holder\">
            <div class=\"col-xs-12 col-sm-12\">
                <div class=\"row\">
                    ";
        // line 19
        if (($context["custom_links"] ?? null)) {
            // line 20
            echo "                        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["basel_footer_columns"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["column"]) {
                // line 21
                echo "                            <div class=\"footer-column col-xs-12 col-sm-3 eq_height\">
                                ";
                // line 22
                if (twig_get_attribute($this->env, $this->source, $context["column"], "title", [], "any", false, false, false, 22)) {
                    // line 23
                    echo "                                    <p class=\"h5\">
                                        <a  role=\"button\" data-toggle=\"collapse\" href=\"#collapse";
                    // line 24
                    echo twig_get_attribute($this->env, $this->source, $context["column"], "sort", [], "any", false, false, false, 24);
                    echo "9\" aria-expanded=\"false\" aria-controls=\"collapse";
                    echo twig_get_attribute($this->env, $this->source, $context["column"], "sort", [], "any", false, false, false, 24);
                    echo "9\">
                                            ";
                    // line 25
                    echo twig_get_attribute($this->env, $this->source, $context["column"], "title", [], "any", false, false, false, 25);
                    echo "  <b class=\"pull-right visible-xs\">+</b>
                                        </a>
                                    </p>
                                ";
                }
                // line 29
                echo "
                                <div class=\"collapse in\" id=\"collapse";
                // line 30
                echo twig_get_attribute($this->env, $this->source, $context["column"], "sort", [], "any", false, false, false, 30);
                echo "9\">
                                    ";
                // line 31
                if (twig_get_attribute($this->env, $this->source, $context["column"], "links", [], "any", true, true, false, 31)) {
                    // line 32
                    echo "                                        <ul class=\"list-unstyled\">
                                            ";
                    // line 33
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["column"], "links", [], "any", false, false, false, 33));
                    foreach ($context['_seq'] as $context["_key"] => $context["link"]) {
                        // line 34
                        echo "                                                <li><a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["link"], "target", [], "any", false, false, false, 34);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["link"], "title", [], "any", false, false, false, 34);
                        echo "</a></li>
                                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['link'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 36
                    echo "                                        </ul>
                                    ";
                }
                // line 38
                echo "
                                </div>

                                <script>
                                    \$(document).ready(function(){
                                        if (\$(window).width() <= 768) {
                                            \$(\"#collapse19\").removeClass(\"in\");
                                            \$(\"#collapse49\").removeClass(\"in\");
                                            \$(\"#collapse39\").removeClass(\"in\");
                                        }
                                    });
                                </script>



                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['column'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 55
            echo "                    ";
        } else {
            // line 56
            echo "                        ";
            if (($context["informations"] ?? null)) {
                // line 57
                echo "                            <div class=\"footer-column col-xs-6 col-sm-3 eq_height\">
                                <h5>";
                // line 58
                echo ($context["text_information"] ?? null);
                echo "</h5>
                                <ul class=\"list-unstyled\">
                                    ";
                // line 60
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["informations"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["information"]) {
                    // line 61
                    echo "                                        <li><a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["information"], "href", [], "any", false, false, false, 61);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["information"], "title", [], "any", false, false, false, 61);
                    echo "</a></li>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['information'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 63
                echo "                                    <li><a href=\"";
                echo ($context["contact"] ?? null);
                echo "\">";
                echo ($context["text_contact"] ?? null);
                echo "</a></li>
                                </ul>
                            </div>
                        ";
            }
            // line 67
            echo "                        <div class=\"footer-column col-xs-6 col-sm-3 eq_height\">
                            <h5>";
            // line 68
            echo ($context["text_extra"] ?? null);
            echo "</h5>
                            <ul class=\"list-unstyled\">
                                <li><a href=\"";
            // line 70
            echo ($context["manufacturer"] ?? null);
            echo "\">";
            echo ($context["text_manufacturer"] ?? null);
            echo "</a></li>
                                <li><a href=\"";
            // line 71
            echo ($context["voucher"] ?? null);
            echo "\">";
            echo ($context["text_voucher"] ?? null);
            echo "</a></li>
                                <li><a href=\"";
            // line 72
            echo ($context["affiliate"] ?? null);
            echo "\">";
            echo ($context["text_affiliate"] ?? null);
            echo "</a></li>
                                <li><a href=\"";
            // line 73
            echo ($context["special"] ?? null);
            echo "\">";
            echo ($context["text_special"] ?? null);
            echo "</a></li>
                                <li><a href=\"";
            // line 74
            echo ($context["sitemap"] ?? null);
            echo "\">";
            echo ($context["text_sitemap"] ?? null);
            echo "</a></li>
                            </ul>
                        </div>
                        <div class=\"footer-column col-xs-6 col-sm-3 eq_height\">
                            <h5>";
            // line 78
            echo ($context["text_account"] ?? null);
            echo "</h5>
                            <ul class=\"list-unstyled\">
                                <li><a href=\"";
            // line 80
            echo ($context["account"] ?? null);
            echo "\">";
            echo ($context["text_account"] ?? null);
            echo "</a></li>
                                <li><a href=\"";
            // line 81
            echo ($context["order"] ?? null);
            echo "\">";
            echo ($context["text_order"] ?? null);
            echo "</a></li>
                                <li><a href=\"";
            // line 82
            echo ($context["return"] ?? null);
            echo "\">";
            echo ($context["text_return"] ?? null);
            echo "</a></li>
                                <li class=\"is_wishlist\"><a href=\"";
            // line 83
            echo ($context["wishlist"] ?? null);
            echo "\">";
            echo ($context["text_wishlist"] ?? null);
            echo "</a></li>
                                <li><a href=\"";
            // line 84
            echo ($context["newsletter"] ?? null);
            echo "\">";
            echo ($context["text_newsletter"] ?? null);
            echo "</a></li>
                            </ul>
                        </div>
                    ";
        }
        // line 88
        echo "                    <div class=\"footer-column col-xs-12 col-sm-3 eq_height\">
                        <img class=\"skare-footer visible-xs\" src=\"image/divider-footer.svg\" alt=\"Balidoo divider\">
                        <div class=\"footer-custom-wrapper\">
                            ";
        // line 91
        if (array_key_exists("footer_block_title", $context)) {
            // line 92
            echo "                                <p class=\"h5\">";
            echo ($context["footer_block_title"] ?? null);
            echo "</p>
                            ";
        }
        // line 94
        echo "                            ";
        if ((($context["footer_block_2"] ?? null) && (($context["footer_block_2"] ?? null) != "<p><br></p>"))) {
            // line 95
            echo "                                <div class=\"custom_block\">";
            echo ($context["footer_block_2"] ?? null);
            echo "</div>
                            ";
        }
        // line 97
        echo "                            ";
        if (array_key_exists("footer_infoline_1", $context)) {
            // line 98
            echo "                                <p class=\"infoline\">";
            echo ($context["footer_infoline_1"] ?? null);
            echo "</p>
                            ";
        }
        // line 100
        echo "                            ";
        if (array_key_exists("footer_infoline_2", $context)) {
            // line 101
            echo "                                <p class=\"infoline\">";
            echo ($context["footer_infoline_2"] ?? null);
            echo "</p>
                            ";
        }
        // line 103
        echo "                            ";
        if (array_key_exists("footer_infoline_3", $context)) {
            // line 104
            echo "                                <p class=\"infoline\">";
            echo ($context["footer_infoline_3"] ?? null);
            echo "</p>
                            ";
        }
        // line 106
        echo "                            ";
        if (($context["payment_img"] ?? null)) {
            // line 107
            echo "                                <img class=\"payment_img\" src=\"";
            echo ($context["payment_img"] ?? null);
            echo "\" alt=\"\" />
                            ";
        }
        // line 109
        echo "                        </div>
                    </div>
                </div><!-- .row ends -->
            </div><!-- .col-md-8 ends -->

            <div class=\"col-xs-12 text-center cards-holder\" >
                <img class=\"cards-img\" src=\"image/catalog/credit-cards/visa.svg\" alt=\"Visa\" height=\"30\" width=\"50\"></a>
                <img class=\"cards-img\" src=\"image/catalog/credit-cards/maestro.svg\" alt=\"Mestroa\" height=\"30\" width=\"50\"></a>
                <img class=\"cards-img\" src=\"image/catalog/credit-cards/mastercard.svg\" alt=\"MasterCard\" height=\"30\" width=\"50\"></a>
                <img class=\"cards-img\" src=\"image/catalog/credit-cards/diners.svg\" alt=\"Diners\" height=\"30\" width=\"50\"></a>

                <img class=\"cards-img\" src=\"image/google_pay.svg\" alt=\"GooglePay\" height=\"30\" width=\"50\">
                <img class=\"cards-img\" src=\"image/apple_pay.svg\" alt=\"ApplePay\" height=\"30\" width=\"50\">
                <img class=\"cards-img p4 hidden-xs\" src=\"image/corvus-logo-i.svg\" alt=\"CorvusPay\" height=\"30\" width=\"114\">

            </div>
            <div class=\"clearfix\"></div>

        </div><!-- .row ends -->




    </div>
    <div class=\"continer-fluid\">
        ";
        // line 134
        if (($context["basel_copyright"] ?? null)) {
            // line 135
            echo "            <div class=\"footer-copyright\">";
            echo ($context["basel_copyright"] ?? null);
            echo "</div>
        ";
        }
        // line 137
        echo "    </div>

</div>


<link  href=\"catalog/view/javascript/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\" />
<link href=\"catalog/view/theme/basel/js/lightgallery/css/lightgallery.css\" rel=\"stylesheet\" />
<script src=\"catalog/view/theme/basel/js/jquery.matchHeight.min.js\"></script>
<script src=\"catalog/view/theme/basel/js/countdown.js\"></script>
<script src=\"catalog/view/theme/basel/js/featherlight.js\"></script>
";
        // line 147
        if (($context["view_popup"] ?? null)) {
            // line 148
            echo "    <!-- Popup -->
    <script>
        \$(document).ready(function() {
            if (\$(window).width() > ";
            // line 151
            echo ($context["popup_width_limit"] ?? null);
            echo ") {
                setTimeout(function() {
                    \$.featherlight({ajax: 'index.php?route=extension/basel/basel_features/basel_popup', variant:'popup-wrapper'});
                }, ";
            // line 154
            echo ($context["popup_delay"] ?? null);
            echo ");
            }
        });
    </script>
";
        }
        // line 159
        if (($context["sticky_columns"] ?? null)) {
            // line 160
            echo "    <!-- Sticky columns -->
    <script>
        if (\$(window).width() > 767) {
            \$('#column-left, #column-right').theiaStickySidebar({containerSelector:\$(this).closest('.row'),additionalMarginTop:";
            // line 163
            echo ($context["sticky_columns_offset"] ?? null);
            echo "});
        }
    </script>
";
        }
        // line 167
        echo "
</div><!-- .outer-container ends -->
<a class=\"scroll-to-top email primary-bg-color \" href=\"mailto:repro@repro-grav.hr\"><img src=\"image/envelope.svg\" class=\"ikona\" alt=\"Pošaljite email\"></a>
<a class=\"scroll-to-top top primary-bg-color \" onclick=\"\$('html, body').animate({scrollTop:0});\"><img src=\"image/up.svg\" class=\"ikona\" alt=\"Na vrh\"></a>
<div id=\"featherlight-holder\"></div>
</body></html>";
    }

    public function getTemplateName()
    {
        return "basel/template/common/footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  410 => 167,  403 => 163,  398 => 160,  396 => 159,  388 => 154,  382 => 151,  377 => 148,  375 => 147,  363 => 137,  357 => 135,  355 => 134,  328 => 109,  322 => 107,  319 => 106,  313 => 104,  310 => 103,  304 => 101,  301 => 100,  295 => 98,  292 => 97,  286 => 95,  283 => 94,  277 => 92,  275 => 91,  270 => 88,  261 => 84,  255 => 83,  249 => 82,  243 => 81,  237 => 80,  232 => 78,  223 => 74,  217 => 73,  211 => 72,  205 => 71,  199 => 70,  194 => 68,  191 => 67,  181 => 63,  170 => 61,  166 => 60,  161 => 58,  158 => 57,  155 => 56,  152 => 55,  130 => 38,  126 => 36,  115 => 34,  111 => 33,  108 => 32,  106 => 31,  102 => 30,  99 => 29,  92 => 25,  86 => 24,  83 => 23,  81 => 22,  78 => 21,  73 => 20,  71 => 19,  66 => 16,  60 => 13,  57 => 12,  55 => 11,  46 => 5,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/common/footer.twig", "");
    }
}
