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

/* basel/template/common/menus/mega_menu.twig */
class __TwigTemplate_016c908d7f9e20dcffd6396bc91158173048d2354ae05b8adde4780fb9fc3699 extends \Twig\Template
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
        $context["class"] = "";
        // line 2
        $context["icon_font"] = "";
        // line 3
        $context["class_link"] = "";
        // line 4
        $context["title"] = "";
        // line 5
        $context["target"] = "";
        // line 6
        $context["submenu_bg_img"] = "";
        // line 7
        $context["caret"] = "";
        // line 8
        echo "
";
        // line 9
        if (twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "icon_font", [], "any", false, false, false, 9)) {
            // line 10
            $context["icon_font"] = (("<i class=\"icon " . twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "icon_font", [], "any", false, false, false, 10)) . "\"></i>");
        }
        // line 12
        echo "
";
        // line 13
        if ((twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "description", [], "any", false, false, false, 13) != "")) {
            // line 14
            $context["class_link"] = (($context["class_link"] ?? null) . " description");
        }
        // line 16
        echo "
";
        // line 17
        if (twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "class_menu", [], "any", false, false, false, 17)) {
            // line 18
            $context["class"] = (($context["class"] ?? null) . twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "class_menu", [], "any", false, false, false, 18));
        }
        // line 20
        echo "
";
        // line 21
        if ((twig_test_iterable(twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "submenu", [], "any", false, false, false, 21)) && twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "submenu", [], "any", false, false, false, 21))) {
            // line 22
            $context["caret"] = "<i class='fa fa-angle-down'></i>";
            // line 23
            echo "  ";
            if ((twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "submenu_width", [], "any", false, false, false, 23) == "full")) {
                // line 24
                echo "\t";
                $context["class"] = (($context["class"] ?? null) . " has-sub dropdown-wrapper has-full-width");
                // line 25
                echo "\t";
                $context["is_full_width"] = true;
                // line 26
                echo "  ";
            } else {
                // line 27
                echo "\t";
                $context["class"] = (($context["class"] ?? null) . " has-sub dropdown-wrapper from-bottom");
                // line 28
                echo "\t";
                $context["is_full_width"] = false;
                // line 29
                echo "  ";
            }
        }
        // line 31
        echo "                            
";
        // line 32
        if (twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "new_window", [], "any", false, false, false, 32)) {
            // line 33
            $context["target"] = " external";
        }
        // line 35
        echo "
";
        // line 36
        if (twig_in_filter("no_image", twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "icon", [], "any", false, false, false, 36))) {
            // line 37
            $context["icon"] = "";
        } else {
            // line 39
            ob_start(function () { return ''; });
            // line 40
            echo "background-image:url('";
            echo twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "icon", [], "any", false, false, false, 40);
            echo "');
background-position:";
            // line 41
            echo twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "position", [], "any", false, false, false, 41);
            echo ";
";
            $context["submenu_bg_img"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        }
        // line 44
        echo "
<!-- Top level items -->
<li class=\"";
        // line 46
        echo ($context["class"] ?? null);
        echo "\">
<a ";
        // line 47
        if (twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "link", [], "any", false, false, false, 47)) {
            echo " href=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "link", [], "any", false, false, false, 47);
            echo "\" ";
        }
        echo " class=\"";
        echo ($context["class_link"] ?? null);
        echo " ";
        echo ($context["target"] ?? null);
        echo "\">
";
        // line 48
        echo ($context["icon_font"] ?? null);
        echo "<span class=\"top\">";
        echo (($__internal_compile_0 = twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "name", [], "any", false, false, false, 48)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[($context["lang_id"] ?? null)] ?? null) : null);
        echo "</span>";
        echo twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "description", [], "any", false, false, false, 48);
        echo ($context["caret"] ?? null);
        echo "
</a>
";
        // line 50
        if ((twig_test_iterable(twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "submenu", [], "any", false, false, false, 50)) && twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "submenu", [], "any", false, false, false, 50))) {
            // line 51
            echo "<!-- Sub Menu items -->
<!-- if full width -->
";
            // line 53
            if ((twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "submenu_width", [], "any", false, false, false, 53) == "full")) {
                // line 54
                echo "<div class=\"full-width-dropdown dropdown-content sub-holder\" style=\"";
                echo ($context["submenu_bg_img"] ?? null);
                echo "\">
";
            } else {
                // line 56
                echo "<div class=\"dropdown-content sub-holder dropdown-left";
                if ((twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "submenu_width", [], "any", false, false, false, 56) < "231")) {
                    echo " narrow";
                }
                echo "\" style=\"";
                if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "submenu_width", [], "any", false, false, false, 56))) {
                    echo "width:";
                    echo twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "submenu_width", [], "any", false, false, false, 56);
                    echo "px;";
                }
                echo ($context["submenu_bg_img"] ?? null);
                echo "\">
";
            }
            // line 58
            echo "
";
            // line 59
            if ((twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "submenu_width", [], "any", false, false, false, 59) == "full")) {
                // line 60
                echo "<div class=\"container\">
";
            }
            // line 62
            echo "
<div class=\"dropdown-inner\">
<div class=\"row\">
";
            // line 65
            $context["row_fluid"] = 0;
            // line 66
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "submenu", [], "any", false, false, false, 66));
            foreach ($context['_seq'] as $context["_key"] => $context["submenu"]) {
                // line 67
                echo "
";
                // line 68
                $context["target"] = "";
                // line 69
                if (twig_get_attribute($this->env, $this->source, $context["submenu"], "new_window", [], "any", false, false, false, 69)) {
                    $context["target"] = "external";
                }
                // line 70
                echo "
";
                // line 71
                $context["icon_font"] = "";
                // line 72
                if (twig_get_attribute($this->env, $this->source, $context["submenu"], "icon_font", [], "any", false, false, false, 72)) {
                    $context["icon_font"] = (("<i class=\"" . twig_get_attribute($this->env, $this->source, $context["submenu"], "icon_font", [], "any", false, false, false, 72)) . "\"></i>");
                }
                // line 73
                echo "
";
                // line 74
                if (((($context["row_fluid"] ?? null) + twig_get_attribute($this->env, $this->source, $context["submenu"], "content_width", [], "any", false, false, false, 74)) > 12)) {
                    // line 75
                    $context["row_fluid"] = twig_get_attribute($this->env, $this->source, $context["submenu"], "content_width", [], "any", false, false, false, 75);
                    // line 76
                    echo "</div><div class=\"border\"></div><div class=\"row\">
";
                } else {
                    // line 78
                    $context["row_fluid"] = (($context["row_fluid"] ?? null) + twig_get_attribute($this->env, $this->source, $context["submenu"], "content_width", [], "any", false, false, false, 78));
                }
                // line 80
                echo "
<div class=\"col-xs-12 col-sm-";
                // line 81
                echo twig_get_attribute($this->env, $this->source, $context["submenu"], "content_width", [], "any", false, false, false, 81);
                echo " ";
                echo twig_get_attribute($this->env, $this->source, $context["submenu"], "class_menu", [], "any", false, false, false, 81);
                echo "\">
<div class=\"menu-item\">
";
                // line 83
                if (twig_get_attribute($this->env, $this->source, $context["submenu"], "show_title", [], "any", false, false, false, 83)) {
                    // line 84
                    if (twig_get_attribute($this->env, $this->source, $context["submenu"], "link", [], "any", false, false, false, 84)) {
                        // line 85
                        echo "<h4 class=\"column-title\">";
                        if (($context["icon_font"] ?? null)) {
                            echo "<span class=\"icon\">";
                            echo ($context["icon_font"] ?? null);
                            echo "</span>";
                        }
                        echo "<b><a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["submenu"], "link", [], "any", false, false, false, 85);
                        echo "\" class=\"";
                        echo ($context["target"] ?? null);
                        echo "\">";
                        echo (($__internal_compile_1 = twig_get_attribute($this->env, $this->source, $context["submenu"], "name", [], "any", false, false, false, 85)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[($context["lang_id"] ?? null)] ?? null) : null);
                        echo twig_get_attribute($this->env, $this->source, $context["submenu"], "description", [], "any", false, false, false, 85);
                        echo "</a></b></h4>
";
                    } else {
                        // line 87
                        echo "<h4 class=\"column-title\">";
                        if (($context["icon_font"] ?? null)) {
                            echo "<span class=\"icon\">";
                            echo ($context["icon_font"] ?? null);
                            echo "</span>";
                        }
                        echo "<b>";
                        echo (($__internal_compile_2 = twig_get_attribute($this->env, $this->source, $context["submenu"], "name", [], "any", false, false, false, 87)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[($context["lang_id"] ?? null)] ?? null) : null);
                        echo twig_get_attribute($this->env, $this->source, $context["submenu"], "description", [], "any", false, false, false, 87);
                        echo "</b></h4>
";
                    }
                }
                // line 90
                if ((twig_get_attribute($this->env, $this->source, $context["submenu"], "content_type", [], "any", false, false, false, 90) == "0")) {
                    // line 91
                    echo "<!-- HTML CONTENT -->
<div class=\"html hover-menu\">
";
                    // line 93
                    echo twig_get_attribute($this->env, $this->source, $context["submenu"], "html", [], "any", false, false, false, 93);
                    echo "
</div>
";
                }
                // line 96
                if ((twig_get_attribute($this->env, $this->source, $context["submenu"], "content_type", [], "any", false, false, false, 96) == "1")) {
                    // line 97
                    echo "<!-- SINGLE PRODUCT CONTENT -->
";
                    // line 98
                    if (twig_test_iterable(twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 98))) {
                        // line 99
                        echo "<div class=\"grid\">
<div class=\"single-product menu-product\">
<div class=\"image\">
<a href=\"";
                        // line 102
                        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 102), "link", [], "any", false, false, false, 102);
                        echo "\">
<img src=\"";
                        // line 103
                        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 103), "image", [], "any", false, false, false, 103);
                        echo "\" alt=\"";
                        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 103), "name", [], "any", false, false, false, 103);
                        echo "\" title=\"";
                        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 103), "name", [], "any", false, false, false, 103);
                        echo "\" />
";
                        // line 104
                        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 104), "image2", [], "any", false, false, false, 104)) {
                            // line 105
                            echo "<img class=\"thumb2\" src=\"";
                            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 105), "image2", [], "any", false, false, false, 105);
                            echo "\" alt=\"";
                            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 105), "name", [], "any", false, false, false, 105);
                            echo "\" title=\"";
                            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 105), "name", [], "any", false, false, false, 105);
                            echo "\" />
";
                        }
                        // line 107
                        echo "</a>
";
                        // line 108
                        if (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 108), "price", [], "any", false, false, false, 108) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 108), "special", [], "any", false, false, false, 108)) && ($context["salebadge_status"] ?? null))) {
                            // line 109
                            echo "<div class=\"sale-counter mm id";
                            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 109), "id", [], "any", false, false, false, 109);
                            echo "\"></div>
<span class=\"badge sale_badge\"><i>";
                            // line 110
                            echo ($context["basel_text_sale"] ?? null);
                            echo "</i></span>
";
                        }
                        // line 112
                        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 112), "new_label", [], "any", false, false, false, 112)) {
                            // line 113
                            echo "<span class=\"badge new_badge\"><i>";
                            echo ($context["basel_text_new"] ?? null);
                            echo "</i></span>
";
                        }
                        // line 115
                        echo "<a class=\"img-overlay\" href=\"";
                        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 115), "link", [], "any", false, false, false, 115);
                        echo "\"></a>
<div class=\"btn-center\"><a class=\"btn btn-light-outline btn-thin btn-tiny\" onclick=\"cart.add('";
                        // line 116
                        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 116), "id", [], "any", false, false, false, 116);
                        echo "', '";
                        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 116), "minimum", [], "any", false, false, false, 116);
                        echo "');\">";
                        echo ($context["button_cart"] ?? null);
                        echo "</a></div>
<div class=\"icons-wrapper\">
<a class=\"icon is-cart\" data-toggle=\"tooltip\" data-placement=\"left\" data-title=\"";
                        // line 118
                        echo ($context["button_cart"] ?? null);
                        echo "\" onclick=\"cart.add('";
                        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 118), "id", [], "any", false, false, false, 118);
                        echo "', '";
                        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 118), "minimum", [], "any", false, false, false, 118);
                        echo "');\"><span class=\"global-cart\"></span></a>
<a class=\"icon is_wishlist\" data-toggle=\"tooltip\" data-placement=\"left\" data-title=\"";
                        // line 119
                        echo ($context["button_wishlist"] ?? null);
                        echo "\" onclick=\"wishlist.add('";
                        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 119), "id", [], "any", false, false, false, 119);
                        echo "');\"><span class=\"icon-heart\"></span></a>
<a class=\"icon is_compare\" onclick=\"compare.add('";
                        // line 120
                        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 120), "id", [], "any", false, false, false, 120);
                        echo "');\" data-toggle=\"tooltip\" data-placement=\"left\" data-title=\"";
                        echo ($context["button_compare"] ?? null);
                        echo "\"><span class=\"icon-refresh\"></span></a>
<a class=\"icon is_quickview hidden-xs\" onclick=\"quickview('";
                        // line 121
                        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 121), "id", [], "any", false, false, false, 121);
                        echo "');\" data-toggle=\"tooltip\" data-placement=\"left\" data-title=\"";
                        echo ($context["basel_button_quickview"] ?? null);
                        echo "\"><span class=\"icon-magnifier-add\"></span></a>
</div>
</div>
<div class=\"caption\">
<a class=\"product-name\" href=\"";
                        // line 125
                        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 125), "link", [], "any", false, false, false, 125);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 125), "name", [], "any", false, false, false, 125);
                        echo "</a>
";
                        // line 126
                        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 126), "rating", [], "any", false, false, false, 126)) {
                            echo "      
<div class=\"rating\">
<span class=\"rating_stars rating r";
                            // line 128
                            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 128), "rating", [], "any", false, false, false, 128);
                            echo "\">
<i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i>
</span>
</div>
";
                        }
                        // line 133
                        echo "<div class=\"price-wrapper\">
";
                        // line 134
                        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 134), "price", [], "any", false, false, false, 134)) {
                            // line 135
                            echo "<div class=\"price\">
";
                            // line 136
                            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 136), "special", [], "any", false, false, false, 136)) {
                                // line 137
                                echo "<span class=\"price-old\">
";
                                // line 138
                                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 138), "price", [], "any", false, false, false, 138);
                                echo "</span><span class=\"price-new\">";
                                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 138), "special", [], "any", false, false, false, 138);
                                echo "
</span>
";
                            } else {
                                // line 141
                                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 141), "price", [], "any", false, false, false, 141);
                                echo "
";
                            }
                            // line 143
                            echo "</div>
";
                        }
                        // line 145
                        echo "<a class=\"btn btn-outline btn-tiny catalog_hide\" onclick=\"cart.add('";
                        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 145), "id", [], "any", false, false, false, 145);
                        echo "', '";
                        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 145), "minimum", [], "any", false, false, false, 145);
                        echo "');\"><span class=\"global-cart\"></span>";
                        echo ($context["button_cart"] ?? null);
                        echo "</a>
</div>
</div>
";
                        // line 148
                        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 148), "sale_end_date", [], "any", false, false, false, 148) && ($context["countdown_status"] ?? null))) {
                            // line 149
                            echo "<script>
\$(function() {
\$(\".sale-counter.mm.id";
                            // line 151
                            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 151), "id", [], "any", false, false, false, 151);
                            echo "\").countdown({
date: \"";
                            // line 152
                            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "product", [], "any", false, false, false, 152), "sale_end_date", [], "any", false, false, false, 152);
                            echo "\",
render: function(data) {
\$(this.el).html(
\"<div>\" + 
data.days + \"<i>";
                            // line 156
                            echo ($context["basel_text_days"] ?? null);
                            echo "</i></div><div>\" + 
data.hours + \" <i>";
                            // line 157
                            echo ($context["basel_text_hours"] ?? null);
                            echo "</i></div><div>\" + 
data.min + \" <i>";
                            // line 158
                            echo ($context["basel_text_mins"] ?? null);
                            echo "</i></div><div>\" + 
data.sec + \" <i>";
                            // line 159
                            echo ($context["basel_text_secs"] ?? null);
                            echo "</i></div>\");
} 
}); 
});
</script>
";
                        }
                        // line 165
                        echo "</div>
</div>
";
                    }
                }
                // line 169
                if ((twig_get_attribute($this->env, $this->source, $context["submenu"], "content_type", [], "any", false, false, false, 169) == "2")) {
                    // line 170
                    echo "<!-- CATEGORIES CONTENT -->
<div class=\"categories\">
";
                    // line 172
                    echo twig_get_attribute($this->env, $this->source, $context["submenu"], "categories", [], "any", false, false, false, 172);
                    echo "
</div>
";
                }
                // line 175
                if ((twig_get_attribute($this->env, $this->source, $context["submenu"], "content_type", [], "any", false, false, false, 175) == "4")) {
                    // line 176
                    echo "<!-- BANNER CONTENT -->
<div class=\"link\">
";
                    // line 178
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["submenu"], "images", [], "any", false, false, false, 178), "link", [], "any", false, false, false, 178);
                    echo "
</div>
";
                }
                // line 181
                echo "</div>
</div>
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['submenu'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 184
            echo "</div> <!-- row -->
</div>

";
            // line 187
            if ((twig_get_attribute($this->env, $this->source, ($context["row"] ?? null), "submenu_width", [], "any", false, false, false, 187) == "full")) {
                // line 188
                echo "</div>
";
            }
            // line 190
            echo "
</div>
";
        }
        // line 193
        echo "</li>";
    }

    public function getTemplateName()
    {
        return "basel/template/common/menus/mega_menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  555 => 193,  550 => 190,  546 => 188,  544 => 187,  539 => 184,  531 => 181,  525 => 178,  521 => 176,  519 => 175,  513 => 172,  509 => 170,  507 => 169,  501 => 165,  492 => 159,  488 => 158,  484 => 157,  480 => 156,  473 => 152,  469 => 151,  465 => 149,  463 => 148,  452 => 145,  448 => 143,  443 => 141,  435 => 138,  432 => 137,  430 => 136,  427 => 135,  425 => 134,  422 => 133,  414 => 128,  409 => 126,  403 => 125,  394 => 121,  388 => 120,  382 => 119,  374 => 118,  365 => 116,  360 => 115,  354 => 113,  352 => 112,  347 => 110,  342 => 109,  340 => 108,  337 => 107,  327 => 105,  325 => 104,  317 => 103,  313 => 102,  308 => 99,  306 => 98,  303 => 97,  301 => 96,  295 => 93,  291 => 91,  289 => 90,  275 => 87,  258 => 85,  256 => 84,  254 => 83,  247 => 81,  244 => 80,  241 => 78,  237 => 76,  235 => 75,  233 => 74,  230 => 73,  226 => 72,  224 => 71,  221 => 70,  217 => 69,  215 => 68,  212 => 67,  208 => 66,  206 => 65,  201 => 62,  197 => 60,  195 => 59,  192 => 58,  177 => 56,  171 => 54,  169 => 53,  165 => 51,  163 => 50,  153 => 48,  141 => 47,  137 => 46,  133 => 44,  127 => 41,  122 => 40,  120 => 39,  117 => 37,  115 => 36,  112 => 35,  109 => 33,  107 => 32,  104 => 31,  100 => 29,  97 => 28,  94 => 27,  91 => 26,  88 => 25,  85 => 24,  82 => 23,  80 => 22,  78 => 21,  75 => 20,  72 => 18,  70 => 17,  67 => 16,  64 => 14,  62 => 13,  59 => 12,  56 => 10,  54 => 9,  51 => 8,  49 => 7,  47 => 6,  45 => 5,  43 => 4,  41 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/common/menus/mega_menu.twig", "/Users/tomek/Herd/reprograv/upload/catalog/view/theme/basel/template/common/menus/mega_menu.twig");
    }
}
