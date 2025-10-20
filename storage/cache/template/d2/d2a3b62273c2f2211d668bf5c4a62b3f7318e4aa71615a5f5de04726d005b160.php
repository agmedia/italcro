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
class __TwigTemplate_43f40b143d49ef2b679706e72ee61e38de462cd7c2f27d1237f1163415cc2cc4 extends \Twig\Template
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

    <div class=\"container\">
        ";
        // line 10
        if ((($context["footer_block_1"] ?? null) && (($context["footer_block_1"] ?? null) != "<p><br></p>"))) {
            // line 11
            echo "            <div class=\"footer-top-block\">
                ";
            // line 12
            echo ($context["footer_block_1"] ?? null);
            echo "
            </div>
        ";
        }
        // line 15
        echo "        <div class=\"row links-holder\">
            <div class=\"col-xs-12 col-sm-12\">
                <div class=\"row\">
                    ";
        // line 18
        if (($context["custom_links"] ?? null)) {
            // line 19
            echo "                        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["basel_footer_columns"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["column"]) {
                // line 20
                echo "                            <div class=\"footer-column col-xs-12 col-sm-3 eq_height\">
                                ";
                // line 21
                if (twig_get_attribute($this->env, $this->source, $context["column"], "title", [], "any", false, false, false, 21)) {
                    // line 22
                    echo "                                    <p class=\"h5\">
                                        <a  role=\"button\" data-toggle=\"collapse\" href=\"#collapse";
                    // line 23
                    echo twig_get_attribute($this->env, $this->source, $context["column"], "sort", [], "any", false, false, false, 23);
                    echo "9\" aria-expanded=\"false\" aria-controls=\"collapse";
                    echo twig_get_attribute($this->env, $this->source, $context["column"], "sort", [], "any", false, false, false, 23);
                    echo "9\">
                                            ";
                    // line 24
                    echo twig_get_attribute($this->env, $this->source, $context["column"], "title", [], "any", false, false, false, 24);
                    echo "  <b class=\"pull-right visible-xs\">+</b>
                                        </a>
                                    </p>
                                ";
                }
                // line 28
                echo "
                                <div class=\"collapse in\" id=\"collapse";
                // line 29
                echo twig_get_attribute($this->env, $this->source, $context["column"], "sort", [], "any", false, false, false, 29);
                echo "9\">
                                    ";
                // line 30
                if (twig_get_attribute($this->env, $this->source, $context["column"], "links", [], "any", true, true, false, 30)) {
                    // line 31
                    echo "                                        <ul class=\"list-unstyled\">
                                            ";
                    // line 32
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["column"], "links", [], "any", false, false, false, 32));
                    foreach ($context['_seq'] as $context["_key"] => $context["link"]) {
                        // line 33
                        echo "                                                <li><a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["link"], "target", [], "any", false, false, false, 33);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["link"], "title", [], "any", false, false, false, 33);
                        echo "</a></li>
                                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['link'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 35
                    echo "                                        </ul>
                                    ";
                }
                // line 37
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
            // line 54
            echo "                    ";
        } else {
            // line 55
            echo "                        ";
            if (($context["informations"] ?? null)) {
                // line 56
                echo "                            <div class=\"footer-column col-xs-6 col-sm-3 eq_height\">
                                <h5>";
                // line 57
                echo ($context["text_information"] ?? null);
                echo "</h5>
                                <ul class=\"list-unstyled\">
                                    ";
                // line 59
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["informations"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["information"]) {
                    // line 60
                    echo "                                        <li><a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["information"], "href", [], "any", false, false, false, 60);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["information"], "title", [], "any", false, false, false, 60);
                    echo "</a></li>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['information'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 62
                echo "                                    <li><a href=\"";
                echo ($context["contact"] ?? null);
                echo "\">";
                echo ($context["text_contact"] ?? null);
                echo "</a></li>
                                </ul>
                            </div>
                        ";
            }
            // line 66
            echo "                        <div class=\"footer-column col-xs-6 col-sm-3 eq_height\">
                            <h5>";
            // line 67
            echo ($context["text_extra"] ?? null);
            echo "</h5>
                            <ul class=\"list-unstyled\">
                                <li><a href=\"";
            // line 69
            echo ($context["manufacturer"] ?? null);
            echo "\">";
            echo ($context["text_manufacturer"] ?? null);
            echo "</a></li>
                                <li><a href=\"";
            // line 70
            echo ($context["voucher"] ?? null);
            echo "\">";
            echo ($context["text_voucher"] ?? null);
            echo "</a></li>
                                <li><a href=\"";
            // line 71
            echo ($context["affiliate"] ?? null);
            echo "\">";
            echo ($context["text_affiliate"] ?? null);
            echo "</a></li>
                                <li><a href=\"";
            // line 72
            echo ($context["special"] ?? null);
            echo "\">";
            echo ($context["text_special"] ?? null);
            echo "</a></li>
                                <li><a href=\"";
            // line 73
            echo ($context["sitemap"] ?? null);
            echo "\">";
            echo ($context["text_sitemap"] ?? null);
            echo "</a></li>
                            </ul>
                        </div>
                        <div class=\"footer-column col-xs-6 col-sm-3 eq_height\">
                            <h5>";
            // line 77
            echo ($context["text_account"] ?? null);
            echo "</h5>
                            <ul class=\"list-unstyled\">
                                <li><a href=\"";
            // line 79
            echo ($context["account"] ?? null);
            echo "\">";
            echo ($context["text_account"] ?? null);
            echo "</a></li>
                                <li><a href=\"";
            // line 80
            echo ($context["order"] ?? null);
            echo "\">";
            echo ($context["text_order"] ?? null);
            echo "</a></li>
                                <li><a href=\"";
            // line 81
            echo ($context["return"] ?? null);
            echo "\">";
            echo ($context["text_return"] ?? null);
            echo "</a></li>
                                <li class=\"is_wishlist\"><a href=\"";
            // line 82
            echo ($context["wishlist"] ?? null);
            echo "\">";
            echo ($context["text_wishlist"] ?? null);
            echo "</a></li>
                                <li><a href=\"";
            // line 83
            echo ($context["newsletter"] ?? null);
            echo "\">";
            echo ($context["text_newsletter"] ?? null);
            echo "</a></li>
                            </ul>
                        </div>
                    ";
        }
        // line 87
        echo "                    <div class=\"footer-column col-xs-12 col-sm-3 eq_height\">
                        <img class=\"skare-footer visible-xs\" src=\"image/divider-footer.svg\" alt=\"Balidoo divider\">
                        <div class=\"footer-custom-wrapper\">
                            ";
        // line 90
        if (array_key_exists("footer_block_title", $context)) {
            // line 91
            echo "                                <p class=\"h5\">";
            echo ($context["footer_block_title"] ?? null);
            echo "</p>
                            ";
        }
        // line 93
        echo "                            ";
        if ((($context["footer_block_2"] ?? null) && (($context["footer_block_2"] ?? null) != "<p><br></p>"))) {
            // line 94
            echo "                                <div class=\"custom_block\">";
            echo ($context["footer_block_2"] ?? null);
            echo "</div>
                            ";
        }
        // line 96
        echo "                            ";
        if (array_key_exists("footer_infoline_1", $context)) {
            // line 97
            echo "                                <p class=\"infoline\">";
            echo ($context["footer_infoline_1"] ?? null);
            echo "</p>
                            ";
        }
        // line 99
        echo "                            ";
        if (array_key_exists("footer_infoline_2", $context)) {
            // line 100
            echo "                                <p class=\"infoline\">";
            echo ($context["footer_infoline_2"] ?? null);
            echo "</p>
                            ";
        }
        // line 102
        echo "                            ";
        if (array_key_exists("footer_infoline_3", $context)) {
            // line 103
            echo "                                <p class=\"infoline\">";
            echo ($context["footer_infoline_3"] ?? null);
            echo "</p>
                            ";
        }
        // line 105
        echo "                            ";
        if (($context["payment_img"] ?? null)) {
            // line 106
            echo "                                <img class=\"payment_img\" src=\"";
            echo ($context["payment_img"] ?? null);
            echo "\" alt=\"\" />
                            ";
        }
        // line 108
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
        // line 133
        if (($context["basel_copyright"] ?? null)) {
            // line 134
            echo "            <div class=\"footer-copyright\">";
            echo ($context["basel_copyright"] ?? null);
            echo "</div>
        ";
        }
        // line 136
        echo "    </div>

</div>


<link  href=\"catalog/view/javascript/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\" />
<link href=\"catalog/view/theme/basel/js/lightgallery/css/lightgallery.css\" rel=\"stylesheet\" />
<script src=\"catalog/view/theme/basel/js/jquery.matchHeight.min.js\"></script>
<script src=\"catalog/view/theme/basel/js/countdown.js\"></script>
<script src=\"catalog/view/theme/basel/js/featherlight.js\"></script>
";
        // line 146
        if (($context["view_popup"] ?? null)) {
            // line 147
            echo "    <!-- Popup -->
    <script>
        \$(document).ready(function() {
            if (\$(window).width() > ";
            // line 150
            echo ($context["popup_width_limit"] ?? null);
            echo ") {
                setTimeout(function() {
                    \$.featherlight({ajax: 'index.php?route=extension/basel/basel_features/basel_popup', variant:'popup-wrapper'});
                }, ";
            // line 153
            echo ($context["popup_delay"] ?? null);
            echo ");
            }
        });
    </script>
";
        }
        // line 158
        if (($context["sticky_columns"] ?? null)) {
            // line 159
            echo "    <!-- Sticky columns -->
    <script>
        if (\$(window).width() > 767) {
            \$('#column-left, #column-right').theiaStickySidebar({containerSelector:\$(this).closest('.row'),additionalMarginTop:";
            // line 162
            echo ($context["sticky_columns_offset"] ?? null);
            echo "});
        }
    </script>
";
        }
        // line 166
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
        return array (  409 => 166,  402 => 162,  397 => 159,  395 => 158,  387 => 153,  381 => 150,  376 => 147,  374 => 146,  362 => 136,  356 => 134,  354 => 133,  327 => 108,  321 => 106,  318 => 105,  312 => 103,  309 => 102,  303 => 100,  300 => 99,  294 => 97,  291 => 96,  285 => 94,  282 => 93,  276 => 91,  274 => 90,  269 => 87,  260 => 83,  254 => 82,  248 => 81,  242 => 80,  236 => 79,  231 => 77,  222 => 73,  216 => 72,  210 => 71,  204 => 70,  198 => 69,  193 => 67,  190 => 66,  180 => 62,  169 => 60,  165 => 59,  160 => 57,  157 => 56,  154 => 55,  151 => 54,  129 => 37,  125 => 35,  114 => 33,  110 => 32,  107 => 31,  105 => 30,  101 => 29,  98 => 28,  91 => 24,  85 => 23,  82 => 22,  80 => 21,  77 => 20,  72 => 19,  70 => 18,  65 => 15,  59 => 12,  56 => 11,  54 => 10,  46 => 5,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/common/footer.twig", "");
    }
}
