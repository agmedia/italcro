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

/* basel/template/product/product.twig */
class __TwigTemplate_b9e9ce1af946231466f7076e1058a6bccd4de720c1eed5bb3d59feb97caefb2c extends \Twig\Template
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
        echo ($context["header"] ?? null);
        echo "

\t\t\t";
        // line 3
        if (($context["product_disabled"] ?? null)) {
            echo "<div class=\"container\"><div class=\"alert alert-warning\" role=\"alert\">";
            echo ($context["product_disabled"] ?? null);
            echo "</div></div>";
        }
        // line 4
        echo "\t\t\t

";
        // line 6
        if ((($context["product_layout"] ?? null) != "full-width")) {
            // line 7
            echo "    <style>
        .product-page .image-area {
        ";
            // line 9
            if (((($context["product_layout"] ?? null) == "images-left") && ($context["images"] ?? null))) {
                // line 10
                echo "            width: ";
                echo ((($context["img_w"] ?? null) + ($context["img_a_w"] ?? null)) + 20);
                echo "px;
        ";
            } else {
                // line 12
                echo "            width: ";
                echo ($context["img_w"] ?? null);
                echo "px;
        ";
            }
            // line 14
            echo "        }
        .product-page .main-image {
            width:";
            // line 16
            echo ($context["img_w"] ?? null);
            echo "px;
        }
        .product-page .image-additional {
        ";
            // line 19
            if ((($context["product_layout"] ?? null) == "images-left")) {
                // line 20
                echo "            width: ";
                echo ($context["img_a_w"] ?? null);
                echo "px;
            height: ";
                // line 21
                echo ($context["img_h"] ?? null);
                echo "px;
        ";
            } else {
                // line 23
                echo "            width: ";
                echo ($context["img_w"] ?? null);
                echo "px;
        ";
            }
            // line 25
            echo "        }
        .product-page .image-additional.has-arrows {
        ";
            // line 27
            if ((($context["product_layout"] ?? null) == "images-left")) {
                // line 28
                echo "            height: ";
                echo (($context["img_h"] ?? null) - 40);
                echo "px;
        ";
            }
            // line 30
            echo "        }
        @media (min-width: 992px) and (max-width: 1199px) {
            .product-page .image-area {
            ";
            // line 33
            if ((($context["product_layout"] ?? null) == "images-left")) {
                // line 34
                echo "                width: ";
                echo (((($context["img_w"] ?? null) + ($context["img_a_w"] ?? null)) / 1.25) + 20);
                echo "px;
            ";
            } else {
                // line 36
                echo "                width: ";
                echo (($context["img_w"] ?? null) / 1.25);
                echo "px;
            ";
            }
            // line 38
            echo "            }
            .product-page .main-image {
                width:";
            // line 40
            echo (($context["img_w"] ?? null) / 1.25);
            echo "px;
            }
            .product-page .image-additional {
            ";
            // line 43
            if ((($context["product_layout"] ?? null) == "images-left")) {
                // line 44
                echo "                width: ";
                echo (($context["img_a_w"] ?? null) / 1.25);
                echo "px;
                height: ";
                // line 45
                echo (($context["img_h"] ?? null) / 1.25);
                echo "px;
            ";
            } else {
                // line 47
                echo "                width: ";
                echo (($context["img_w"] ?? null) / 1.25);
                echo "px;
            ";
            }
            // line 49
            echo "            }
        }
    </style>
";
        }
        // line 53
        echo "
<ul class=\"breadcrumb\">
    ";
        // line 55
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 56
            echo "        <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 56);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 56);
            echo "</a></li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 58
        echo "</ul>

<div class=\"container product-layout ";
        // line 60
        echo ($context["product_layout"] ?? null);
        echo "\">

    <div class=\"row\">";
        // line 62
        echo ($context["column_left"] ?? null);
        echo "
        ";
        // line 63
        if ((($context["column_left"] ?? null) && ($context["column_right"] ?? null))) {
            // line 64
            echo "            ";
            $context["class"] = "col-sm-6";
            // line 65
            echo "        ";
        } elseif ((($context["column_left"] ?? null) || ($context["column_right"] ?? null))) {
            // line 66
            echo "            ";
            $context["class"] = "col-md-9 col-sm-8";
            // line 67
            echo "        ";
        } else {
            // line 68
            echo "            ";
            $context["class"] = "col-sm-12";
            // line 69
            echo "        ";
        }
        // line 70
        echo "        <div id=\"content\" class=\"product-main no-min-height ";
        echo ($context["class"] ?? null);
        echo "\">
            ";
        // line 71
        echo ($context["content_top"] ?? null);
        echo "

            <div class=\"table product-info product-page\">

                <div class=\"table-cell left\">

                    ";
        // line 77
        if ((($context["thumb"] ?? null) || ($context["images"] ?? null))) {
            // line 78
            echo "                    <div class=\"image-area ";
            if ( !($context["hover_zoom"] ?? null)) {
                echo "hover-zoom-disabled";
            }
            echo "\" id=\"gallery\">

                        ";
            // line 80
            if (($context["thumb"] ?? null)) {
                // line 81
                echo "                            <div class=\"main-image\">

                                ";
                // line 83
                if (((($context["price"] ?? null) && ($context["special"] ?? null)) && ($context["sale_badge"] ?? null))) {
                    // line 84
                    echo "                                    <span class=\"badge sale_badge\"><i>";
                    echo ($context["sale_badge"] ?? null);
                    echo "</i></span>
                                ";
                }
                // line 86
                echo "
                                ";
                // line 87
                if (($context["is_new"] ?? null)) {
                    // line 88
                    echo "                                    <span class=\"badge new_badge\"><i>";
                    echo ($context["basel_text_new"] ?? null);
                    echo "</i></span>
                                ";
                }
                // line 90
                echo "
                                ";
                // line 91
                if (((($context["qty"] ?? null) < 1) && ($context["stock_badge_status"] ?? null))) {
                    // line 92
                    echo "                                    <span class=\"badge out_of_stock_badge\"><i>";
                    echo ($context["basel_text_out_of_stock"] ?? null);
                    echo "</i></span>
                                ";
                }
                // line 94
                echo "
                                <a class=\"";
                // line 95
                if ( !($context["images"] ?? null)) {
                    echo "link cloud-zoom";
                }
                echo " ";
                if ((($context["product_layout"] ?? null) == "full-width")) {
                    echo "link";
                } else {
                    echo "cloud-zoom";
                }
                echo "\" id=\"main-image\" href=\"";
                echo ($context["popup"] ?? null);
                echo "\" rel=\"position:'inside', showTitle: false\"><img src=\"";
                echo ($context["thumb"] ?? null);
                echo "\" style=\"\" title=\"";
                echo ($context["image_title"] ?? null);
                echo "\" alt=\"";
                echo ($context["image_alt"] ?? null);
                echo "\" /></a>
                            </div>
                        ";
            }
            // line 98
            echo "
                        ";
            // line 99
            if (($context["images"] ?? null)) {
                // line 100
                echo "                            <ul class=\"image-additional\">
                                ";
                // line 101
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["images"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
                    // line 102
                    echo "                                    <li>
                                        <a class=\"link ";
                    // line 103
                    if ((($context["product_layout"] ?? null) != "full-width")) {
                        echo "cloud-zoom-gallery locked";
                    }
                    echo "\" href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["image"], "popup", [], "any", false, false, false, 103);
                    echo "\" rel=\"useZoom: 'main-image', smallImage: '";
                    echo twig_get_attribute($this->env, $this->source, $context["image"], "thumb_lg", [], "any", false, false, false, 103);
                    echo "'\"><img src=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["image"], "thumb", [], "any", false, false, false, 103);
                    echo "\" title=\"";
                    echo ($context["image_title"] ?? null);
                    echo "\" alt=\"";
                    echo ($context["image_alt"] ?? null);
                    echo "\" /></a>
                                    </li>
                                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 106
                echo "                                ";
                if ((($context["thumb"] ?? null) && (($context["product_layout"] ?? null) != "full-width"))) {
                    // line 107
                    echo "                                    <li><a class=\"link cloud-zoom-gallery locked active\" href=\"";
                    echo ($context["popup"] ?? null);
                    echo "\" rel=\"useZoom: 'main-image', smallImage: '";
                    echo ($context["thumb"] ?? null);
                    echo "'\"><img src=\"";
                    echo ($context["thumb_sm"] ?? null);
                    echo "\" title=\"";
                    echo ($context["image_title"] ?? null);
                    echo "\" alt=\"";
                    echo ($context["image_alt"] ?? null);
                    echo "\" /></a></li>
                                ";
                }
                // line 109
                echo "                            </ul>
                        ";
            }
            // line 111
            echo "
                    </div> <!-- .table-cell.left ends -->

                </div> <!-- .image-area ends -->
                ";
        }
        // line 116
        echo "
                <div class=\"table-cell w100 right\">
                    <div class=\"inner\">

                        <div class=\"product-h1\">
                            <h1 id=\"page-title\">";
        // line 121
        echo ($context["heading_title"] ?? null);
        echo "</h1>
                        </div>

                        ";
        // line 124
        if ((($context["review_status"] ?? null) && (($context["review_qty"] ?? null) > 0))) {
            // line 125
            echo "                            <div class=\"rating\">
    <span class=\"rating_stars rating r";
            // line 126
            echo ($context["rating"] ?? null);
            echo "\">
    <i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i>
    </span>
                            </div>
                            <span class=\"review_link\">(<a class=\"hover_uline to_tabs\" onclick=\"\$('a[href=\\'#tab-review\\']').trigger('click'); return false;\">";
            // line 130
            echo ($context["reviews"] ?? null);
            echo "</a>)</span>
                        ";
        }
        // line 132
        echo "
                        ";
        // line 133
        if (($context["price"] ?? null)) {
            // line 134
            echo "                            <ul class=\"list-unstyled price\">
                                ";
            // line 135
            if ( !($context["special"] ?? null)) {
                // line 136
                echo "                                    <li><span class=\"live-price\">";
                echo ($context["price"] ?? null);
                echo " <span>   <small>";
                echo ($context["text_tax_included"] ?? null);
                echo " </small></li>
                                ";
            } else {
                // line 138
                echo "                                    <li><span class=\"price-old\">";
                echo ($context["price"] ?? null);
                echo "</span> <span class=\"live-price-new\"> ";
                echo ($context["special"] ?? null);
                echo "  </span> <small>";
                echo ($context["text_tax_included"] ?? null);
                echo " </small></li>

                                    <span id=\"special_countdown\"></span>
                                ";
            }
            // line 142
            echo "


                            </ul>





                            ";
            // line 151
            if ((($context["price"] ?? null) && ($context["tax"] ?? null))) {
                // line 152
                echo "                                <p class=\"info p-tax\"><b>";
                echo ($context["text_tax"] ?? null);
                echo "</b> <span class=\"live-price-tax\">";
                echo ($context["tax"] ?? null);
                echo "</span></p>
                            ";
            }
            // line 154
            echo "
                            ";
            // line 155
            if (($context["discounts"] ?? null)) {
                // line 156
                echo "                                <p class=\"discount\">
                                    ";
                // line 157
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["discounts"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["discount"]) {
                    // line 158
                    echo "                                        <span>";
                    echo twig_get_attribute($this->env, $this->source, $context["discount"], "quantity", [], "any", false, false, false, 158);
                    echo ($context["text_discount"] ?? null);
                    echo "<i class=\"price\">";
                    echo twig_get_attribute($this->env, $this->source, $context["discount"], "price", [], "any", false, false, false, 158);
                    echo "</i></span>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['discount'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 160
                echo "                                </p>
                            ";
            }
            // line 162
            echo "
                        ";
        }
        // line 163
        echo " <!-- if price ends -->


                        ";
        // line 166
        if ((($context["meta_description_status"] ?? null) && ($context["meta_description"] ?? null))) {
            // line 167
            echo "                            <p class=\"meta_description\">";
            echo ($context["meta_description"] ?? null);
            echo "</p>
                        ";
        }
        // line 169
        echo "

                        <div id=\"product\">

                            ";
        // line 173
        if (($context["options"] ?? null)) {
            // line 174
            echo "                                <div class=\"options\">
                                    ";
            // line 175
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["options"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                // line 176
                echo "
                                        ";
                // line 177
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 177) == "select")) {
                    // line 178
                    echo "                                            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 178)) {
                        echo " required";
                    }
                    echo " table-row\">
                                                <div class=\"table-cell name\">
                                                    <label class=\"control-label\" for=\"input-option";
                    // line 180
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 180);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 180);
                    echo "</label>
                                                </div>
                                                <div class=\"table-cell\">
                                                    <select name=\"option[";
                    // line 183
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 183);
                    echo "]\" id=\"input-option";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 183);
                    echo "\" class=\"form-control\">
                                                        <option value=\"\">";
                    // line 184
                    echo ($context["text_select"] ?? null);
                    echo "</option>
                                                        ";
                    // line 185
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["option"], "product_option_value", [], "any", false, false, false, 185));
                    foreach ($context['_seq'] as $context["_key"] => $context["option_value"]) {
                        // line 186
                        echo "                                                            <option value=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["option_value"], "product_option_value_id", [], "any", false, false, false, 186);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 186);
                        echo "
                                                                ";
                        // line 187
                        if (twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 187)) {
                            // line 188
                            echo "                                                                    (";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price_prefix", [], "any", false, false, false, 188);
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 188);
                            echo ")
                                                                ";
                        }
                        // line 190
                        echo "                                                            </option>
                                                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 192
                    echo "                                                    </select>
                                                </div>
                                            </div>
                                        ";
                }
                // line 196
                echo "
                                        ";
                // line 197
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 197) == "radio2")) {
                    // line 198
                    echo "                                            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 198)) {
                        echo " required";
                    }
                    echo " table-row\">
                                                <div class=\"table-cell radio-cell name\">
                                                    <label class=\"control-label\">";
                    // line 200
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 200);
                    echo "</label>
                                                </div>
                                                <div class=\"table-cell radio-cell\">
                                                    <div id=\"input-option";
                    // line 203
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 203);
                    echo "\">
                                                        ";
                    // line 204
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["option"], "product_option_value", [], "any", false, false, false, 204));
                    foreach ($context['_seq'] as $context["_key"] => $context["option_value"]) {
                        // line 205
                        echo "                                                            <div class=\"radio";
                        if (twig_get_attribute($this->env, $this->source, $context["option_value"], "image", [], "any", false, false, false, 205)) {
                            echo " has-image";
                        }
                        echo "\">
                                                                <label>
                                                                    <input type=\"radio\" name=\"option[";
                        // line 207
                        echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 207);
                        echo "]\" value=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["option_value"], "product_option_value_id", [], "any", false, false, false, 207);
                        echo "\" />
                                                                    ";
                        // line 208
                        if (twig_get_attribute($this->env, $this->source, $context["option_value"], "image", [], "any", false, false, false, 208)) {
                            // line 209
                            echo "                                                                        <img src=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "image", [], "any", false, false, false, 209);
                            echo "\" alt=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 209);
                            if (twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 209)) {
                                echo "(";
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price_prefix", [], "any", false, false, false, 209);
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 209);
                                echo ")";
                            }
                            echo "\" data-toggle=\"tooltip\" data-title=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 209);
                            if (twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 209)) {
                                echo " (";
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price_prefix", [], "any", false, false, false, 209);
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 209);
                                echo ")";
                            }
                            echo "\" />
                                                                    ";
                        }
                        // line 211
                        echo "                                                                    <span class=\"name\">
                                                                         ";
                        // line 212
                        echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 212);
                        echo "
                                                                        ";
                        // line 213
                        if (twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 213)) {
                            // line 214
                            echo "                                                                            (";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price_prefix", [], "any", false, false, false, 214);
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 214);
                            echo ")
                                                                        ";
                        }
                        // line 216
                        echo "                                                                    </span>
                                                                </label>
                                                            </div>
                                                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 220
                    echo "                                                    </div>
                                                </div>
                                            </div>
                                        ";
                }
                // line 224
                echo "
                                        ";
                // line 225
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 225) == "radio")) {
                    // line 226
                    echo "                                            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 226)) {
                        echo " required ";
                    }
                    echo "   mb-0 \">
                                                <div class=\"table-cell name\">
                                                    <label class=\"control-label\" for=\"input-option";
                    // line 228
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 228);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 228);
                    echo "</label>
                                                </div>
                                                <div class=\" radio-cell\">
                                                    <div id=\"input-option";
                    // line 231
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 231);
                    echo "\">
                                                        <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                                                            ";
                    // line 233
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["option"], "product_option_value", [], "any", false, false, false, 233));
                    foreach ($context['_seq'] as $context["_key"] => $context["option_value"]) {
                        // line 234
                        echo "                                                                ";
                        if (twig_get_attribute($this->env, $this->source, $context["option_value"], "color", [], "any", false, false, false, 234)) {
                            // line 235
                            echo "                                                                <label class=\"btn btn-outline  \">
                                                            ";
                        } else {
                            // line 237
                            echo "                                                                    <label class=\"btn btn-outline btn-option \">
                                                                ";
                        }
                        // line 239
                        echo "                                                                    <input type=\"radio\" name=\"option[";
                        echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 239);
                        echo "]\" value=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["option_value"], "product_option_value_id", [], "any", false, false, false, 239);
                        echo "\" data-uid=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["option_value"], "sifra", [], "any", false, false, false, 239);
                        echo "\" />

                                                                    ";
                        // line 241
                        if (twig_get_attribute($this->env, $this->source, $context["option_value"], "color", [], "any", false, false, false, 241)) {
                            // line 242
                            echo "                                                                        <span style=\"background-color:";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "color", [], "any", false, false, false, 242);
                            echo ";height:46px;width:46px\"  >";
                            if (twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 242)) {
                                echo "(";
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price_prefix", [], "any", false, false, false, 242);
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 242);
                                echo ")";
                            }
                            echo "\" data-toggle=\"tooltip\" data-title=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 242);
                            if (twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 242)) {
                                echo " (";
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price_prefix", [], "any", false, false, false, 242);
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 242);
                                echo ")";
                            }
                            echo "\"
                                                                       </span>
                                                                    ";
                        } else {
                            // line 245
                            echo "                                                                           <span class=\"name\">
                                                                          ";
                            // line 246
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 246);
                            echo "
                                                                        ";
                            // line 247
                            if (twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 247)) {
                                // line 248
                                echo "                                                                            (";
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price_prefix", [], "any", false, false, false, 248);
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 248);
                                echo ")
                                                                        ";
                            }
                            // line 250
                            echo "                                                                        </span>

                                                                    ";
                        }
                        // line 253
                        echo "                                                                </label>






                                                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 261
                    echo "                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        ";
                }
                // line 266
                echo "
                                        ";
                // line 267
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 267) == "checkbox")) {
                    // line 268
                    echo "                                            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 268)) {
                        echo " required";
                    }
                    echo " table-row\">
                                                <div class=\"table-cell checkbox-cell name\">
                                                    <label class=\"control-label\">";
                    // line 270
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 270);
                    echo "</label>
                                                </div>
                                                <div class=\"table-cell checkbox-cell\">
                                                    <div id=\"input-option";
                    // line 273
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 273);
                    echo "\">
                                                        ";
                    // line 274
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["option"], "product_option_value", [], "any", false, false, false, 274));
                    foreach ($context['_seq'] as $context["_key"] => $context["option_value"]) {
                        // line 275
                        echo "                                                            <div class=\"checkbox";
                        if (twig_get_attribute($this->env, $this->source, $context["option_value"], "image", [], "any", false, false, false, 275)) {
                            echo " has-image";
                        }
                        echo "\">
                                                                <label>
                                                                    <input type=\"checkbox\" name=\"option[";
                        // line 277
                        echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 277);
                        echo "][]\" value=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["option_value"], "product_option_value_id", [], "any", false, false, false, 277);
                        echo "\" />

\t\t\t\t";
                        // line 279
                        if ((((($__internal_compile_0 = $context["option"]) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["type"] ?? null) : null) == "checkbox") && (((twig_get_attribute($this->env, $this->source, $context["option_value"], "poip_image", [], "array", true, true, false, 279) &&  !(null === (($__internal_compile_1 = $context["option_value"]) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["poip_image"] ?? null) : null)))) ? ((($__internal_compile_2 = $context["option_value"]) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["poip_image"] ?? null) : null)) : (false)))) {
                            // line 280
                            echo "\t\t\t\t\t<img src=\"";
                            echo (($__internal_compile_3 = $context["option_value"]) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["poip_image"] ?? null) : null);
                            echo "\" alt=\"";
                            echo (($__internal_compile_4 = $context["option_value"]) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["name"] ?? null) : null);
                            echo (((($__internal_compile_5 = $context["option_value"]) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["price"] ?? null) : null)) ? (((" " . (($__internal_compile_6 = $context["option_value"]) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["price_prefix"] ?? null) : null)) . (($__internal_compile_7 = $context["option_value"]) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["price"] ?? null) : null))) : (""));
                            echo " \" class=\"img-thumbnail\" /> 
\t\t\t\t";
                        }
                        // line 282
                        echo "\t\t\t
                                                                    ";
                        // line 283
                        if (twig_get_attribute($this->env, $this->source, $context["option_value"], "image", [], "any", false, false, false, 283)) {
                            // line 284
                            echo "                                                                        <img src=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "image", [], "any", false, false, false, 284);
                            echo "\" alt=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 284);
                            if (twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 284)) {
                                echo "(";
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price_prefix", [], "any", false, false, false, 284);
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 284);
                                echo ")";
                            }
                            echo "\" data-toggle=\"tooltip\" data-title=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 284);
                            if (twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 284)) {
                                echo " (";
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price_prefix", [], "any", false, false, false, 284);
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 284);
                                echo ")";
                            }
                            echo "\" />
                                                                    ";
                        }
                        // line 286
                        echo "                                                                    <span class=\"name\">
                    ";
                        // line 287
                        echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 287);
                        echo "
                                                                        ";
                        // line 288
                        if (twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 288)) {
                            // line 289
                            echo "                                                                            (";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price_prefix", [], "any", false, false, false, 289);
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 289);
                            echo ")
                                                                        ";
                        }
                        // line 291
                        echo "                    </span>
                                                                </label>
                                                            </div>
                                                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 295
                    echo "                                                    </div>
                                                </div>
                                            </div>
                                        ";
                }
                // line 299
                echo "

                                        ";
                // line 301
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 301) == "text")) {
                    // line 302
                    echo "                                            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 302)) {
                        echo " required";
                    }
                    echo " table-row\">
                                                <div class=\"table-cell name\">
                                                    <label class=\"control-label\" for=\"input-option";
                    // line 304
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 304);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 304);
                    echo "</label>
                                                </div>
                                                <div class=\"table-cell\">
                                                    <input type=\"text\" name=\"option[";
                    // line 307
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 307);
                    echo "]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "value", [], "any", false, false, false, 307);
                    echo "\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 307);
                    echo "\" id=\"input-option";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 307);
                    echo "\" class=\"form-control\" />
                                                </div>
                                            </div>
                                        ";
                }
                // line 311
                echo "
                                        ";
                // line 312
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 312) == "textarea")) {
                    // line 313
                    echo "                                            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 313)) {
                        echo " required";
                    }
                    echo " table-row\">
                                                <div class=\"table-cell name\">
                                                    <label class=\"control-label\" for=\"input-option";
                    // line 315
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 315);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 315);
                    echo "</label>
                                                </div>
                                                <div class=\"table-cell\">
                                                    <textarea name=\"option[";
                    // line 318
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 318);
                    echo "]\" rows=\"5\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 318);
                    echo "\" id=\"input-option";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 318);
                    echo "\" class=\"form-control\">";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "value", [], "any", false, false, false, 318);
                    echo "</textarea>
                                                </div>
                                            </div>
                                        ";
                }
                // line 322
                echo "                                        ";
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 322) == "file")) {
                    // line 323
                    echo "                                            ";
                    if (($context["product_dropbox"] ?? null)) {
                        // line 324
                        echo "                                                ";
                        echo twig_get_attribute($this->env, $this->source, $context["option"], "sftool", [], "any", false, false, false, 324);
                        echo "
                                            ";
                    }
                    // line 326
                    echo "                                        ";
                }
                // line 327
                echo "
                                        ";
                // line 328
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 328) == "date")) {
                    // line 329
                    echo "                                            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 329)) {
                        echo " required";
                    }
                    echo " table-row\">
                                                <div class=\"table-cell name\">
                                                    <label class=\"control-label\" for=\"input-option";
                    // line 331
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 331);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 331);
                    echo "</label>
                                                </div>
                                                <div class=\"table-cell\">
                                                    <div class=\"input-group date\">
                                                        <input type=\"text\" name=\"option[";
                    // line 335
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 335);
                    echo "]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "value", [], "any", false, false, false, 335);
                    echo "\" data-date-format=\"YYYY-MM-DD\" id=\"input-option";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 335);
                    echo "\" class=\"form-control\" />
                                                        <span class=\"input-group-btn\">
                <button class=\"btn btn-default\" type=\"button\"><i class=\"fa fa-calendar\"></i></button>
                </span></div>
                                                </div>
                                            </div>
                                        ";
                }
                // line 342
                echo "
                                        ";
                // line 343
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 343) == "datetime")) {
                    // line 344
                    echo "                                            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 344)) {
                        echo " required";
                    }
                    echo " table-row\">
                                                <div class=\"table-cell name\">
                                                    <label class=\"control-label\" for=\"input-option";
                    // line 346
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 346);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 346);
                    echo "</label>
                                                </div>
                                                <div class=\"table-cell\">
                                                    <div class=\"input-group datetime\">
                                                        <input type=\"text\" name=\"option[";
                    // line 350
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 350);
                    echo "]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "value", [], "any", false, false, false, 350);
                    echo "\" data-date-format=\"YYYY-MM-DD HH:mm\" id=\"input-option";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 350);
                    echo "\" class=\"form-control\" />
                                                        <span class=\"input-group-btn\">
                <button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button>
                </span></div>
                                                </div>
                                            </div>
                                        ";
                }
                // line 357
                echo "
                                        ";
                // line 358
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 358) == "time")) {
                    // line 359
                    echo "                                            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 359)) {
                        echo " required";
                    }
                    echo " table-row\">
                                                <div class=\"table-cell name\">
                                                    <label class=\"control-label\" for=\"input-option";
                    // line 361
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 361);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 361);
                    echo "</label>
                                                </div>
                                                <div class=\"table-cell\">
                                                    <div class=\"input-group time\">
                                                        <input type=\"text\" name=\"option[";
                    // line 365
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 365);
                    echo "]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "value", [], "any", false, false, false, 365);
                    echo "\" data-date-format=\"HH:mm\" id=\"input-option";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 365);
                    echo "\" class=\"form-control\" />
                                                        <span class=\"input-group-btn\">
                <button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button>
                </span></div>
                                                </div>
                                            </div>
                                        ";
                }
                // line 372
                echo "
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 373
            echo " <!-- foreach option -->





                                </div>
                            ";
        }
        // line 381
        echo "


                            ";
        // line 384
        if (($context["recurrings"] ?? null)) {
            // line 385
            echo "                                <hr>
                                <h3>";
            // line 386
            echo ($context["text_payment_recurring"] ?? null);
            echo "</h3>
                                <div class=\"form-group required\">
                                    <select name=\"recurring_id\" class=\"form-control\">
                                        <option value=\"\">";
            // line 389
            echo ($context["text_select"] ?? null);
            echo "</option>
                                        ";
            // line 390
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["recurrings"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["recurring"]) {
                // line 391
                echo "                                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["recurring"], "recurring_id", [], "any", false, false, false, 391);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["recurring"], "name", [], "any", false, false, false, 391);
                echo "</option>
                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['recurring'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 393
            echo "                                    </select>
                                    <div class=\"help-block\" id=\"recurring-description\"></div>
                                </div>
                            ";
        }
        // line 397
        echo "
                            ";
        // line 398
        if (($context["is_logged"] ?? null)) {
            // line 399
            echo "                                <div class=\"form-group quantity buttons_added buy catalog_hide\">




                                    <button type=\"button\" class=\"minus\"> <i class=\"fa fa-minus-circle\" aria-hidden=\"true\"></i> </button>
                                    <input type=\"text\" step=\"";
            // line 405
            echo ($context["minimum"] ?? null);
            echo "\" min=\"";
            echo ($context["minimum"] ?? null);
            echo "\" max=\"";
            echo ($context["quantity"] ?? null);
            echo "\" id=\"input-quantity\" name=\"quantity\" value=\"";
            echo ($context["minimum"] ?? null);
            echo "\" title=\"Qty\" class=\"input-text qty text put-qty\" size=\"4\" pattern=\"\" inputmode=\"\">
                                    <button type=\"button\"  class=\"plus\"> <i class=\"fa fa-plus-circle\" aria-hidden=\"true\"></i> </button>
                                    <input type=\"hidden\" name=\"product_id\" value=\"";
            // line 407
            echo ($context["product_id"] ?? null);
            echo "\" />

                                    ";
            // line 409
            if (((($context["qty"] ?? null) < 1) && ($context["stock_badge_status"] ?? null))) {
                // line 410
                echo "                                        <!--<button type=\"button\"  style=\"height: 44px;border-radius: 0px;padding: 8px 25px;\" data-loading-text=\"";
                echo ($context["text_loading"] ?? null);
                echo "\" class=\"btn btn-primary cd-btn-add\"><span>";
                echo ($context["basel_text_out_of_stock"] ?? null);
                echo "</span></button> -->

                                        <button type=\"button\" id=\"button-cart\" data-loading-text=\"";
                // line 412
                echo ($context["text_loading"] ?? null);
                echo "\" class=\"btn btn-primary cd-btn-add\"><span> <i class=\"global-cart icon\"></i> ";
                echo ($context["button_cart"] ?? null);
                echo "</span></button>
                                    ";
            } else {
                // line 414
                echo "                                        <button type=\"button\" id=\"button-cart\" data-loading-text=\"";
                echo ($context["text_loading"] ?? null);
                echo "\" class=\"btn btn-primary cd-btn-add\"><span> <i class=\"global-cart icon\"></i> ";
                echo ($context["button_cart"] ?? null);
                echo "</span></button>
                                    ";
            }
            // line 416
            echo "


                                </div>

                            ";
        } else {
            // line 422
            echo "                                ";
            if (($context["attention"] ?? null)) {
                // line 423
                echo "                                    <div class=\"alert alert-custom\"><i class=\"fa fa-info-circle\"></i> ";
                echo ($context["attention"] ?? null);
                echo "
                                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                                    </div>
                                ";
            }
            // line 427
            echo "                            ";
        }
        // line 428
        echo "


                            ";
        // line 431
        if ((($context["minimum"] ?? null) > 1)) {
            // line 432
            echo "                                <div class=\"alert alert-sm alert-info\"><i class=\"fa fa-info-circle\"></i> ";
            echo ($context["text_minimum"] ?? null);
            echo "</div>
                            ";
        }
        // line 434
        echo "
                        </div> <!-- #product ends -->



                        <p class=\"info is_wishlist\"><a onclick=\"wishlist.add('";
        // line 439
        echo ($context["product_id"] ?? null);
        echo "');\"><i class=\"icon-heart\"></i> ";
        echo ($context["button_wishlist"] ?? null);
        echo "</a></p>
                        <p class=\"info is_compare\"><a onclick=\"compare.add('";
        // line 440
        echo ($context["product_id"] ?? null);
        echo "');\"><i class=\"icon-refresh\"></i> ";
        echo ($context["button_compare"] ?? null);
        echo "</a></p>
                        ";
        // line 441
        if (($context["question_status"] ?? null)) {
            // line 442
            echo "                            <p class=\"info is_ask\"><a class=\"to_tabs\" onclick=\"\$('a[href=\\'#tab-questions\\']').trigger('click'); return false;\"><i class=\"icon-question\"></i> ";
            echo ($context["basel_button_ask"] ?? null);
            echo "</a></p>
                        ";
        }
        // line 444
        echo "
                        <div class=\"clearfix\"></div>

                        <div class=\"info-holder\">


                            ";
        // line 450
        if ((($context["price"] ?? null) && ($context["points"] ?? null))) {
            // line 451
            echo "                                <p class=\"info\"><b>";
            echo ($context["text_points"] ?? null);
            echo "</b> ";
            echo ($context["points"] ?? null);
            echo "</p>
                            ";
        }
        // line 453
        echo "
                            <p class=\"info\"><i class=\"icon-support\"></i> ";
        // line 454
        echo ($context["text_jamstvo"] ?? null);
        echo "</p>

                            <p class=\"info\"><i class=\"icon-badge\"></i>  ";
        // line 456
        echo ($context["text_ovlasteno"] ?? null);
        echo " </p>

                            ";
        // line 458
        if ((($context["qty"] ?? null) > 0)) {
            // line 459
            echo "
                                <p class=\"info ";
            // line 460
            if ((($context["qty"] ?? null) > 0)) {
                echo "in_stock";
            }
            echo "\"><b>";
            echo ($context["text_stock"] ?? null);
            echo "</b> ";
            echo ($context["qty"] ?? null);
            echo "</p>

                            ";
        } else {
            // line 463
            echo "
                                <p class=\"info ";
            // line 464
            if ((($context["qty"] ?? null) > 0)) {
                echo "in_stock";
            }
            echo "\"><b>";
            echo ($context["text_stock"] ?? null);
            echo "</b> Po narudžbi</p>

                            ";
        }
        // line 467
        echo "
                            ";
        // line 468
        if (($context["manufacturer"] ?? null)) {
            // line 469
            echo "                                <p class=\"info\"><b>";
            echo ($context["text_manufacturer"] ?? null);
            echo "</b> <a class=\"hover_uline\" href=\"";
            echo ($context["manufacturers"] ?? null);
            echo "\">";
            echo ($context["manufacturer"] ?? null);
            echo "</a></p>
                            ";
        }
        // line 471
        echo "
                            <p class=\"info\"><b>";
        // line 472
        echo ($context["text_model"] ?? null);
        echo "</b> ";
        echo ($context["model"] ?? null);
        echo "</p>

                            ";
        // line 474
        if (($context["reward"] ?? null)) {
            // line 475
            echo "                                <p class=\"info\"><b>";
            echo ($context["text_reward"] ?? null);
            echo "</b> ";
            echo ($context["reward"] ?? null);
            echo "</p>
                            ";
        }
        // line 477
        echo "
                            ";
        // line 478
        if (($context["tags"] ?? null)) {
            // line 479
            echo "                                <p class=\"info tags\"><b>";
            echo ($context["text_tags"] ?? null);
            echo "</b> &nbsp;<span>";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["tags"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                echo "<a class=\"hover_uline\" href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["tag"], "href", [], "any", false, false, false, 479);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["tag"], "tag", [], "any", false, false, false, 479);
                echo "</a> ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo "</span></p>
                            ";
        }
        // line 481
        echo "
                            <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=61a636a5d0a9e10012e4df2d&product=sop' async='async'></script>
                            <!-- ShareThis BEGIN -->
                            <div class=\"sharethis-inline-share-buttons\"></div>
                            <!-- ShareThis END -->
                        </div> <!-- .info-holder ends -->

                    </div> <!-- .inner ends -->
                </div> <!-- .table-cell.right ends -->

            </div> <!-- .product-info ends -->

            ";
        // line 493
        if (($context["full_width_tabs"] ?? null)) {
            // line 494
            echo "        </div> <!-- main column ends -->
        ";
            // line 495
            echo ($context["column_right"] ?? null);
            echo "
    </div> <!-- .row ends -->
</div> <!-- .container ends -->
";
        }
        // line 499
        echo "
";
        // line 500
        if (($context["full_width_tabs"] ?? null)) {
            // line 501
            echo "<div class=\"outer-container product-tabs-wrapper\">
    <div class=\"container\">
        ";
        } else {
            // line 504
            echo "        <div class=\"inline-tabs\">
            ";
        }
        // line 506
        echo "
            <!-- Tabs area start -->
            <div class=\"row\">
                <div class=\"col-sm-12\">

                    <ul class=\"nav nav-tabs ";
        // line 511
        echo ($context["product_tabs_style"] ?? null);
        echo " main_tabs\">

                        <li class=\"active\"><a href=\"#tab-specification\" data-toggle=\"tab\">";
        // line 513
        echo ($context["tab_description"] ?? null);
        echo "</a></li>


                        ";
        // line 516
        if (($context["product_tabs"] ?? null)) {
            // line 517
            echo "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["product_tabs"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["tab"]) {
                // line 518
                echo "                                <li><a href=\"#custom-tab-";
                echo twig_get_attribute($this->env, $this->source, $context["tab"], "tab_id", [], "any", false, false, false, 518);
                echo "\" data-toggle=\"tab\">";
                echo twig_get_attribute($this->env, $this->source, $context["tab"], "name", [], "any", false, false, false, 518);
                echo "</a></li>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tab'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 520
            echo "                        ";
        }
        // line 521
        echo "
                        ";
        // line 522
        if (twig_get_attribute($this->env, $this->source, ($context["attachfile"] ?? null), "tab_name", [], "any", false, false, false, 522)) {
            // line 523
            echo "                            <li><a href=\"#tab-attach-document\" data-toggle=\"tab\">";
            echo twig_get_attribute($this->env, $this->source, ($context["attachfile"] ?? null), "tab_name", [], "any", false, false, false, 523);
            echo "</a></li>
                        ";
        }
        // line 525
        echo "
                        ";
        // line 526
        if (($context["review_status"] ?? null)) {
            // line 527
            echo "                            <li><a href=\"#tab-review\" data-toggle=\"tab\">";
            echo ($context["tab_review"] ?? null);
            echo "</a></li>
                        ";
        }
        // line 529
        echo "                        ";
        if (($context["question_status"] ?? null)) {
            // line 530
            echo "                            <li><a href=\"#tab-questions\" data-toggle=\"tab\">";
            echo ($context["basel_tab_questions"] ?? null);
            echo " (";
            echo ($context["questions_total"] ?? null);
            echo ")</a></li>
                        ";
        }
        // line 532
        echo "                    </ul>
                    <div class=\"tab-content\">

                        <div class=\"tab-pane active\" id=\"tab-specification\">
                            <div class=\"row\">
                                <div class=\"col-md-6\">




                                    ";
        // line 542
        if (($context["description"] ?? null)) {
            // line 543
            echo "
                                        <h2>";
            // line 544
            echo ($context["h2"] ?? null);
            echo "</h2>";
            echo ($context["description"] ?? null);
            echo "


                                    ";
        }
        // line 548
        echo "

                                </div>


                                ";
        // line 553
        if (($context["attribute_groups"] ?? null)) {
            // line 554
            echo "                                    <div class=\"col-md-6\">
                                        <table class=\"table table-striped specification\">
                                            ";
            // line 556
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["attribute_groups"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["attribute_group"]) {
                // line 557
                echo "                                                <thead>
                                                <tr>
                                                    <td colspan=\"2\">Dodatne infomacije</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                ";
                // line 563
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["attribute_group"], "attribute", [], "any", false, false, false, 563));
                foreach ($context['_seq'] as $context["_key"] => $context["attribute"]) {
                    // line 564
                    echo "                                                    <tr>
                                                        <td class=\"text-left\"><b>";
                    // line 565
                    echo twig_get_attribute($this->env, $this->source, $context["attribute"], "name", [], "any", false, false, false, 565);
                    echo "</b></td>
                                                        <td class=\"text-right\">";
                    // line 566
                    echo twig_get_attribute($this->env, $this->source, $context["attribute"], "text", [], "any", false, false, false, 566);
                    echo "</td>
                                                    </tr>
                                                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attribute'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 569
                echo "                                                </tbody>
                                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attribute_group'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 571
            echo "                                        </table>
                                    </div>
                                ";
        }
        // line 574
        echo "
                            </div>
                        </div>


                        ";
        // line 579
        if (($context["product_tabs"] ?? null)) {
            // line 580
            echo "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["product_tabs"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["tab"]) {
                // line 581
                echo "                                <div class=\"tab-pane\" id=\"custom-tab-";
                echo twig_get_attribute($this->env, $this->source, $context["tab"], "tab_id", [], "any", false, false, false, 581);
                echo "\">
                                    ";
                // line 582
                echo twig_get_attribute($this->env, $this->source, $context["tab"], "description", [], "any", false, false, false, 582);
                echo "
                                </div>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tab'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 585
            echo "                        ";
        }
        // line 586
        echo "


                        ";
        // line 589
        if (($context["question_status"] ?? null)) {
            // line 590
            echo "                            <div class=\"tab-pane\" id=\"tab-questions\">
                                ";
            // line 591
            echo ($context["product_questions"] ?? null);
            echo "
                            </div>
                        ";
        }
        // line 594
        echo "
                        ";
        // line 595
        if (($context["review_status"] ?? null)) {
            // line 596
            echo "                        <div class=\"tab-pane\" id=\"tab-review\">
                            <div class=\"row\">
                                <div class=\"col-sm-6\">
                                    <h4><b>";
            // line 599
            echo ($context["button_reviews"] ?? null);
            echo "</b></h4>

                                    <div id=\"review\">
                                        ";
            // line 602
            if (($context["seo_reviews"] ?? null)) {
                // line 603
                echo "                                            ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["seo_reviews"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["review"]) {
                    // line 604
                    echo "                                                <div class=\"table\">
                                                    <div class=\"table-cell\"><i class=\"fa fa-user\"></i></div>
                                                    <div class=\"table-cell right\">
                                                        <p class=\"author\"><b>";
                    // line 607
                    echo twig_get_attribute($this->env, $this->source, $context["review"], "author", [], "any", false, false, false, 607);
                    echo "</b>  -  ";
                    echo twig_get_attribute($this->env, $this->source, $context["review"], "date_added", [], "any", false, false, false, 607);
                    echo "
                                                            <span class=\"rating\">
\t\t<span class=\"rating_stars rating r";
                    // line 609
                    echo twig_get_attribute($this->env, $this->source, $context["review"], "rating", [], "any", false, false, false, 609);
                    echo "\">
\t\t<i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i>
\t\t</span>
\t\t</span>
                                                        </p>
                                                        ";
                    // line 614
                    echo twig_get_attribute($this->env, $this->source, $context["review"], "text", [], "any", false, false, false, 614);
                    echo "
                                                    </div>
                                                </div>
                                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['review'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 618
                echo "                                            ";
                if (($context["pagination"] ?? null)) {
                    // line 619
                    echo "                                                <div class=\"pagination-holder\">";
                    echo ($context["pagination"] ?? null);
                    echo "</div>
                                            ";
                }
                // line 621
                echo "                                        ";
            } else {
                // line 622
                echo "                                            <p>";
                echo ($context["text_no_reviews"] ?? null);
                echo "</p>
                                        ";
            }
            // line 624
            echo "                                    </div>

                                </div>
                                <div class=\"col-sm-6 right\">
                                    <form class=\"form-horizontal\" id=\"form-review\">

                                        <h4 id=\"review-notification\"><b>";
            // line 630
            echo ($context["text_write"] ?? null);
            echo "</b></h4>
                                        ";
            // line 631
            if (($context["review_guest"] ?? null)) {
                // line 632
                echo "
                                            <div class=\"form-group required\">
                                                <div class=\"col-sm-12 rating-stars\">
                                                    <label class=\"control-label\">";
                // line 635
                echo ($context["entry_rating"] ?? null);
                echo "</label>

                                                    <input type=\"radio\" value=\"1\" name=\"rating\" id=\"rating1\" />
                                                    <label for=\"rating1\"><i class=\"fa fa-star-o\"></i></label>

                                                    <input type=\"radio\" value=\"2\" name=\"rating\" id=\"rating2\" />
                                                    <label for=\"rating2\"><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i></label>

                                                    <input type=\"radio\" value=\"3\" name=\"rating\" id=\"rating3\" />
                                                    <label for=\"rating3\"><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i></label>

                                                    <input type=\"radio\" value=\"4\" name=\"rating\" id=\"rating4\" />
                                                    <label for=\"rating4\"><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i></label>

                                                    <input type=\"radio\" value=\"5\" name=\"rating\" id=\"rating5\" />
                                                    <label for=\"rating5\"><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i></label>
                                                </div>
                                            </div>

                                            <div class=\"form-group required\">
                                                <div class=\"col-sm-12\">
                                                    <label class=\"control-label\" for=\"input-name\">";
                // line 656
                echo ($context["entry_name"] ?? null);
                echo "</label>
                                                    <input type=\"text\" name=\"name\" value=\"";
                // line 657
                echo ($context["customer_name"] ?? null);
                echo "\" id=\"input-name\" class=\"form-control grey\" />
                                                </div>
                                            </div>
                                            <div class=\"form-group required\">
                                                <div class=\"col-sm-12\">
                                                    <label class=\"control-label\" for=\"input-review\">";
                // line 662
                echo ($context["entry_review"] ?? null);
                echo "</label>
                                                    <textarea name=\"text\" rows=\"5\" id=\"input-review\" class=\"form-control grey\"></textarea>
                                                    <small>";
                // line 664
                echo ($context["text_note"] ?? null);
                echo "</small>
                                                </div>
                                            </div>

                                            <div class=\"form-group required\">
                                                <div class=\"col-sm-12\">
                                                    ";
                // line 670
                echo ($context["captcha"] ?? null);
                echo "
                                                </div>
                                            </div>

                                            <div class=\"buttons clearfix\">
                                                <div class=\"text-right\">
                                                    <button type=\"button\" id=\"button-review\" data-loading-text=\"";
                // line 676
                echo ($context["text_loading"] ?? null);
                echo "\" class=\"btn btn-outline\">";
                echo ($context["button_continue"] ?? null);
                echo "</button>
                                                </div>
                                            </div>
                                        ";
            } else {
                // line 680
                echo "                                            ";
                echo ($context["text_login"] ?? null);
                echo "
                                        ";
            }
            // line 682
            echo "                                    </form>
                                </div>
                            </div>
                        </div>
                        ";
        }
        // line 686
        echo "<!-- if review-status ends -->

                    </div> <!-- .tab-content ends -->
                </div> <!-- .col-sm-12 ends -->
            </div> <!-- .row ends -->
            <!-- Tabs area ends -->

            ";
        // line 693
        if (($context["full_width_tabs"] ?? null)) {
            // line 694
            echo "        </div>
        ";
        }
        // line 696
        echo "    </div>

    <!-- Related Products -->

    ";
        // line 700
        if (($context["full_width_tabs"] ?? null)) {
            // line 701
            echo "    <div class=\"container\">
        ";
        }
        // line 703
        echo "
        ";
        // line 704
        if (($context["products"] ?? null)) {
            // line 705
            echo "            <div class=\"widget widget-related\">

                <div class=\"widget-title\">
                    <p class=\"main-title\"><span>";
            // line 708
            echo ($context["text_related"] ?? null);
            echo "</span></p>
                    <p class=\"widget-title-separator\"><i class=\"icon-line-cross\"></i></p>
                </div>

                <div class=\"grid grid-holder related carousel grid";
            // line 712
            echo ($context["basel_rel_prod_grid"] ?? null);
            echo "\">
                    ";
            // line 713
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["products"] ?? null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
                // line 714
                echo "                        ";
                $this->loadTemplate("basel/template/product/single_product.twig", "basel/template/product/product.twig", 714)->display($context);
                // line 715
                echo "                    ";
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 716
            echo "                </div>
            </div>
        ";
        }
        // line 719
        echo "
        ";
        // line 720
        echo ($context["content_bottom"] ?? null);
        echo "

        ";
        // line 722
        if (($context["full_width_tabs"] ?? null)) {
            // line 723
            echo "    </div>
    ";
        }
        // line 725
        echo "

    ";
        // line 727
        if ( !($context["full_width_tabs"] ?? null)) {
            // line 728
            echo "</div> <!-- main column ends -->
";
            // line 729
            echo ($context["column_right"] ?? null);
            echo "
    </div> <!-- .row ends -->
    </div> <!-- .container ends -->
";
        }
        // line 733
        echo "



<script src=\"catalog/view/theme/basel/js/lightgallery/js/lightgallery.min.js\"></script>
<script src=\"catalog/view/theme/basel/js/lightgallery/js/lg-zoom.min.js\"></script>
<script src=\"catalog/view/theme/basel/js/cloudzoom/cloud-zoom.1.0.2.min.js\"></script>
";
        // line 740
        if (($context["basel_price_update"] ?? null)) {
            // line 741
            echo "    <script src=\"index.php?route=extension/basel/live_options/js&product_id=";
            echo ($context["product_id"] ?? null);
            echo "\"></script>
";
        }
        // line 743
        echo "



";
        // line 747
        if (($context["products"] ?? null)) {
            // line 748
            echo "    <script><!--
        \$('.grid-holder.related').slick({
            prevArrow: \"<a class=\\\"arrow-left icon-arrow-left\\\"></a>\",
            nextArrow: \"<a class=\\\"arrow-right icon-arrow-right\\\"></a>\",
            dots:true,
            ";
            // line 753
            if ((($context["direction"] ?? null) == "rtl")) {
                // line 754
                echo "            rtl: true,
            ";
            }
            // line 756
            echo "            respondTo:'min',
            ";
            // line 757
            if ((($context["basel_rel_prod_grid"] ?? null) == "5")) {
                // line 758
                echo "            slidesToShow:5,slidesToScroll:5,responsive:[{breakpoint:1100,settings:{slidesToShow:4,slidesToScroll:4}},{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
                ";
            } elseif ((            // line 759
($context["basel_rel_prod_grid"] ?? null) == "4")) {
                // line 760
                echo "                slidesToShow:4,slidesToScroll:4,responsive:[{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
            ";
            } elseif ((            // line 761
($context["basel_rel_prod_grid"] ?? null) == "3")) {
                // line 762
                echo "            slidesToShow:3,slidesToScroll:3,responsive:[{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
            ";
            } elseif ((            // line 763
($context["basel_rel_prod_grid"] ?? null) == "2")) {
                // line 764
                echo "            slidesToShow:2,slidesToScroll:2,responsive:[
            ";
            }
            // line 766
            echo "            ";
            if (($context["items_mobile_fw"] ?? null)) {
                // line 767
                echo "            {breakpoint:320,settings:{slidesToShow:1,slidesToScroll:1}}
            ";
            }
            // line 769
            echo "        ]
        });
        \$('.product-style2 .single-product .icon').attr('data-placement', 'top');
        \$('[data-toggle=\\'tooltip\\']').tooltip({container: 'body'});
        //--></script>
";
        }
        // line 775
        echo "
";
        // line 776
        if ((($context["sale_end_date"] ?? null) && ($context["product_page_countdown"] ?? null))) {
            // line 777
            echo "    <script>
        \$(function() {
            \$('#special_countdown').countdown('";
            // line 779
            echo ($context["sale_end_date"] ?? null);
            echo "').on('update.countdown', function(event) {
                var \$this = \$(this).html(event.strftime(''
                    + '<div class=\\\"special_countdown\\\"></span><p><span class=\\\"icon-clock\\\"></span> ";
            // line 781
            echo ($context["basel_text_offer_ends"] ?? null);
            echo "</p><div>'
                    + '%D<i>";
            // line 782
            echo ($context["basel_text_days"] ?? null);
            echo "</i></div><div>'
                    + '%H <i>";
            // line 783
            echo ($context["basel_text_hours"] ?? null);
            echo "</i></div><div>'
                    + '%M <i>";
            // line 784
            echo ($context["basel_text_mins"] ?? null);
            echo "</i></div><div>'
                    + '%S <i>";
            // line 785
            echo ($context["basel_text_secs"] ?? null);
            echo "</i></div></div>'));
            });
        });
    </script>
";
        }
        // line 790
        echo "
<script><!--
    \$('select[name=\\'recurring_id\\'], input[name=\"quantity\"]').change(function(){
        \$.ajax({
            url: 'index.php?route=product/product/getRecurringDescription',
            type: 'post',
            data: \$('input[name=\\'product_id\\'], input[name=\\'quantity\\'], select[name=\\'recurring_id\\']'),
            dataType: 'json',
            beforeSend: function() {
                \$('#recurring-description').html('');
            },
            success: function(json) {
                \$('.alert-dismissible, .text-danger').remove();

                if (json['success']) {
                    \$('#recurring-description').html(json['success']);
                }
            }
        });
    });
    //--></script>



<script>
    function wcqib_refresh_quantity_increments() {
        jQuery(\"div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)\").each(function(a, b) {
            var c = jQuery(b);
            c.addClass(\"buttons_added\"), c.children().first().before('<input type=\"button\" value=\"-\" class=\"minus\" />'), c.children().last().after('<input type=\"button\" value=\"+\" class=\"plus\" />')
        })
    }
    String.prototype.getDecimals || (String.prototype.getDecimals = function() {
        var a = this,
            b = (\"\" + a).match(/(?:\\.(\\d+))?(?:[eE]([+-]?\\d+))?\$/);
        return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
    }), jQuery(document).ready(function() {
        wcqib_refresh_quantity_increments()
    }), jQuery(document).on(\"updated_wc_div\", function() {
        wcqib_refresh_quantity_increments()
    }), jQuery(document).on(\"click\", \".plus, .minus\", function() {
        var a = jQuery(this).closest(\".quantity\").find(\".qty\"),
            b = parseFloat(a.val()),
            c = parseFloat(a.attr(\"max\")),
            d = parseFloat(a.attr(\"min\")),
            e = a.attr(\"step\");
        b && \"\" !== b && \"NaN\" !== b || (b = 0), \"\" !== c && \"NaN\" !== c || (c = \"\"), \"\" !== d && \"NaN\" !== d || (d = 0), \"any\" !== e && \"\" !== e && void 0 !== e && \"NaN\" !== parseFloat(e) || (e = 1), jQuery(this).is(\".plus\") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger(\"change\")
    });
</script>

<script><!--
    \$('#button-cart').on('click', function() {
        \$.ajax({
            url: 'index.php?route=extension/basel/basel_features/add_to_cart',
            type: 'post',
            data: \$('#product input[type=\\'text\\'], #product input[type=\\'hidden\\'], #product input[type=\\'number\\'], #product input[type=\\'radio\\']:checked, #product input[type=\\'checkbox\\']:checked, #product select, #product textarea'),
            dataType: 'json',
            beforeSend: function(json) {
                \$('body').append('<span class=\"basel-spinner ajax-call\"></span>');
            },

            success: function(json) {
                \$('.alert, .text-danger').remove();
                \$('.table-cell').removeClass('has-error');

                if (json.error) {
                    \$('.basel-spinner.ajax-call').remove();
                    if (json.error.option) {
                        for (i in json.error.option) {
                            var element = \$('#input-option' + i.replace('_', '-'));

                            if (element.parent().hasClass('input-group')) {
                                element.parent().after('<div class=\"text-danger\">' + json.error.option[i] + '</div>');
                            } else {
                                element.after('<div class=\"text-danger\">' + json.error.option[i] + '</div>');
                            }
                        }
                    }

                    if (json.error.recurring) {
                        \$('select[name=\\'recurring_id\\']').after('<div class=\"text-danger\">' + json['error']['recurring'] + '</div>');
                    }

                    // Highlight any found errors
                    \$('.text-danger').parent().addClass('has-error');
                }

                if (json.success_redirect) {

                    location = json.success_redirect;

                } else if (json.success) {

                    \$('.table-cell').removeClass('has-error');
                    \$('.alert, .popup-note, .basel-spinner.ajax-call, .text-danger').remove();

                    html = '<div class=\"popup-note\">';
                    html += '<div class=\"inner\">';
                    html += '<a class=\"popup-note-close\" onclick=\"\$(this).parent().parent().remove()\">&times;</a>';
                    html += '<div class=\"table\">';
                    html += '<div class=\"table-cell v-top img\"><img src=\"' + json.image + '\" /></div>';
                    html += '<div class=\"table-cell v-top\">' + json.success + '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    \$('body').append(html);
                    setTimeout(function() {\$('.popup-note').hide();}, 8100);
                    // Need to set timeout otherwise it wont update the total
                    setTimeout(function () {
                        \$('.cart-total-items').html( json.total_items );
                        \$('.cart-total-amount').html( json.total_amount );
                    }, 100);

                    \$('#cart-content').load('index.php?route=common/cart/info #cart-content > *');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
            }
        });
    });
    //--></script>




<script><!--

    \$('button[id^=\\'button-upload\\']').on('click', function() {
        var node = this;

        \$('#form-upload').remove();

        \$('body').prepend('<form enctype=\"multipart/form-data\" id=\"form-upload\" style=\"display: none;\"><input type=\"file\" name=\"file\" /></form>');

        \$('#form-upload input[name=\\'file\\']').trigger('click');

        if (typeof timer != 'undefined') {
            clearInterval(timer);
        }

        timer = setInterval(function() {
            if (\$('#form-upload input[name=\\'file\\']').val() != '') {
                clearInterval(timer);

                \$.ajax({
                    url: 'index.php?route=tool/upload',
                    type: 'post',
                    dataType: 'json',
                    data: new FormData(\$('#form-upload')[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        \$(node).button('loading');
                    },
                    complete: function() {
                        \$(node).button('reset');
                    },
                    success: function(json) {
                        \$('.text-danger').remove();

                        if (json['error']) {
                            \$(node).parent().find('input').after('<div class=\"text-danger\">' + json['error'] + '</div>');
                        }

                        if (json['success']) {
                            alert(json['success']);

                            \$(node).parent().find('input').val(json['code']);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
                    }
                });
            }
        }, 500);
    });
    //--></script>
<script><!--
    \$('#review').delegate('.pagination a', 'click', function(e) {
        e.preventDefault();
        \$(\"html,body\").animate({scrollTop:((\$(\"#review\").offset().top)-50)},500);
        \$('#review').fadeOut(50);

        \$('#review').load(this.href);

        \$('#review').fadeIn(500);

    });


    \$('#button-review').on('click', function() {
        \$.ajax({
            url: 'index.php?route=product/product/write&product_id=";
        // line 984
        echo ($context["product_id"] ?? null);
        echo "',
            type: 'post',
            dataType: 'json',
            data: \$(\"#form-review\").serialize(),
            beforeSend: function() {
                \$('#button-review').button('loading');
            },
            complete: function() {
                \$('#button-review').button('reset');
            },
            success: function(json) {
                \$('.alert-success, .alert-danger').remove();

                if (json.error) {
                    \$('#review-notification').after('<div class=\"alert alert-sm alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> ' + json.error + '</div>');
                }

                if (json.success) {
                    \$('#review-notification').after('<div class=\"alert alert-sm alert-success\"><i class=\"fa fa-check-circle\"></i> ' + json.success + '</div>');

                    \$('input[name=\\'name\\']').val('');
                    \$('textarea[name=\\'text\\']').val('');
                    \$('input[name=\\'rating\\']:checked').prop('checked', false);
                }
            }
        });
    });

    \$(document).ready(function() {
        ";
        // line 1013
        if ((($context["product_layout"] ?? null) == "full-width")) {
            // line 1014
            echo "// Sticky information
        \$('.table-cell.right .inner').theiaStickySidebar({containerSelector:'.product-info'});
        ";
        }
        // line 1017
        echo "
// Reviews/Question scroll link
        \$(\".to_tabs\").click(function() {
            \$('html, body').animate({
                scrollTop: (\$(\".main_tabs\").offset().top - 100)
            }, 1000);
        });

// Sharing buttons
        ";
        // line 1026
        if (($context["basel_share_btn"] ?? null)) {
            // line 1027
            echo "        var share_url = encodeURIComponent(window.location.href);
        var page_title = '";
            // line 1028
            echo ($context["heading_title"] ?? null);
            echo "';
        ";
            // line 1029
            if (($context["thumb"] ?? null)) {
                // line 1030
                echo "        var thumb = '";
                echo ($context["thumb"] ?? null);
                echo "';
        ";
            }
            // line 1032
            echo "        \$('.fb_share').attr(\"href\", 'https://www.facebook.com/sharer/sharer.php?u=' + share_url + '');
        \$('.twitter_share').attr(\"href\", 'https://twitter.com/intent/tweet?source=' + share_url + '&text=' + page_title + ': ' + share_url + '');
        \$('.google_share').attr(\"href\", 'https://plus.google.com/share?url=' + share_url + '');
        \$('.pinterest_share').attr(\"href\", 'http://pinterest.com/pin/create/button/?url=' + share_url + '&media=' + thumb + '&description=' + page_title + '');
        \$('.vk_share').attr(\"href\", 'http://vkontakte.ru/share.php?url=' + share_url + '');
        ";
        }
        // line 1038
        echo "    });
    //--></script>

";
        // line 1041
        if ((($context["product_layout"] ?? null) != "full-width")) {
            // line 1042
            echo "    <script>
        \$(document).ready(function() {
            \$('.image-additional a.link').click(function (e) {
                if (\$(this).hasClass(\"locked\")) {
                    e.stopImmediatePropagation();
                }
                \$('.image-additional a.link.active').removeClass('active');
                \$(this).addClass('active')
            });

            ";
            // line 1052
            if (($context["images"] ?? null)) {
                // line 1053
                echo "            \$('.cloud-zoom-wrap').click(function (e) {
                e.preventDefault();
                \$('.image-additional a.link.active').removeClass('locked').trigger('click').addClass('locked');
            });
            ";
            } else {
                // line 1058
                echo "            \$('.cloud-zoom-wrap').click(function (e) {
                e.preventDefault();
                \$('#main-image').trigger('click');
            });
            ";
            }
            // line 1063
            echo "
            \$('.image-additional').slick({
                prevArrow: \"<a class=\\\"icon-arrow-left\\\"></a>\",
                nextArrow: \"<a class=\\\"icon-arrow-right\\\"></a>\",
                appendArrows: '.image-additional .slick-list',
                arrows:true,
                ";
            // line 1069
            if ((($context["direction"] ?? null) == "rtl")) {
                // line 1070
                echo "                rtl: true,
                ";
            }
            // line 1072
            echo "                infinite:false,
                ";
            // line 1073
            if ((($context["product_layout"] ?? null) == "images-left")) {
                // line 1074
                echo "                slidesToShow: ";
                echo twig_round((($context["img_h"] ?? null) / ($context["img_a_h"] ?? null)), 0, "floor");
                echo ",
                vertical:true,
                verticalSwiping:true,
                ";
            } else {
                // line 1078
                echo "                slidesToShow: ";
                echo twig_round((($context["img_w"] ?? null) / ($context["img_a_w"] ?? null)));
                echo ",
                ";
            }
            // line 1080
            echo "                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            vertical:false,
                            verticalSwiping:false
                        }
                    }]
            });

        });
        //--></script>
";
        }
        // line 1093
        echo "<script>
    \$(document).ready(function() {
// Image Gallery
        \$(\"#gallery\").lightGallery({
            selector: '.link',
            download:false,
            hideBarsDelay:99999
        });
    });
    //--></script>
<script>
    \$(document).ready(function() {
        \$('.option-popup-link').magnificPopup({
            type: 'image',
            gallery:{
                enabled:true
            },
            image: {
                // options for image content type
                titleSrc: 'title'
            }
            // other options
        });

    });
    //--></script>


<!-- << Product Option Image PRO module -->
\t\t\t\t";
        // line 1122
        if ((($context["poip_installed"]) ?? (false))) {
            // line 1123
            echo "\t\t\t\t\t";
            echo (($context["poip_theme_script"]) ?? (""));
            echo "
\t\t\t\t\t";
            // line 1124
            echo (($context["poip_script"]) ?? (""));
            echo "
\t\t\t\t";
        }
        // line 1126
        echo "\t\t\t\t<!-- >> Product Option Image PRO module -->
\t\t\t";
        // line 1127
        echo ($context["footer"] ?? null);
        echo "

<script>
    \$(document).ready(function(){

        var \$_GET = {};

        document.location.search.replace(/\\??(?:([^=]+)=([^&]*)&?)/g, function () {
            function decode(s) {
                return decodeURIComponent(s.split(\"+\").join(\" \"));
            }

            \$_GET[decode(arguments[1])] = decode(arguments[2]);
        });

        if(\$_GET[\"add\"] =='yes'){

            //\$('#button-cart').click();
            \$(\"#button-cart\").trigger(\"click\");

        }

    });

</script>

";
    }

    public function getTemplateName()
    {
        return "basel/template/product/product.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  2425 => 1127,  2422 => 1126,  2417 => 1124,  2412 => 1123,  2410 => 1122,  2379 => 1093,  2364 => 1080,  2358 => 1078,  2350 => 1074,  2348 => 1073,  2345 => 1072,  2341 => 1070,  2339 => 1069,  2331 => 1063,  2324 => 1058,  2317 => 1053,  2315 => 1052,  2303 => 1042,  2301 => 1041,  2296 => 1038,  2288 => 1032,  2282 => 1030,  2280 => 1029,  2276 => 1028,  2273 => 1027,  2271 => 1026,  2260 => 1017,  2255 => 1014,  2253 => 1013,  2221 => 984,  2025 => 790,  2017 => 785,  2013 => 784,  2009 => 783,  2005 => 782,  2001 => 781,  1996 => 779,  1992 => 777,  1990 => 776,  1987 => 775,  1979 => 769,  1975 => 767,  1972 => 766,  1968 => 764,  1966 => 763,  1963 => 762,  1961 => 761,  1958 => 760,  1956 => 759,  1953 => 758,  1951 => 757,  1948 => 756,  1944 => 754,  1942 => 753,  1935 => 748,  1933 => 747,  1927 => 743,  1921 => 741,  1919 => 740,  1910 => 733,  1903 => 729,  1900 => 728,  1898 => 727,  1894 => 725,  1890 => 723,  1888 => 722,  1883 => 720,  1880 => 719,  1875 => 716,  1861 => 715,  1858 => 714,  1841 => 713,  1837 => 712,  1830 => 708,  1825 => 705,  1823 => 704,  1820 => 703,  1816 => 701,  1814 => 700,  1808 => 696,  1804 => 694,  1802 => 693,  1793 => 686,  1786 => 682,  1780 => 680,  1771 => 676,  1762 => 670,  1753 => 664,  1748 => 662,  1740 => 657,  1736 => 656,  1712 => 635,  1707 => 632,  1705 => 631,  1701 => 630,  1693 => 624,  1687 => 622,  1684 => 621,  1678 => 619,  1675 => 618,  1665 => 614,  1657 => 609,  1650 => 607,  1645 => 604,  1640 => 603,  1638 => 602,  1632 => 599,  1627 => 596,  1625 => 595,  1622 => 594,  1616 => 591,  1613 => 590,  1611 => 589,  1606 => 586,  1603 => 585,  1594 => 582,  1589 => 581,  1584 => 580,  1582 => 579,  1575 => 574,  1570 => 571,  1563 => 569,  1554 => 566,  1550 => 565,  1547 => 564,  1543 => 563,  1535 => 557,  1531 => 556,  1527 => 554,  1525 => 553,  1518 => 548,  1509 => 544,  1506 => 543,  1504 => 542,  1492 => 532,  1484 => 530,  1481 => 529,  1475 => 527,  1473 => 526,  1470 => 525,  1464 => 523,  1462 => 522,  1459 => 521,  1456 => 520,  1445 => 518,  1440 => 517,  1438 => 516,  1432 => 513,  1427 => 511,  1420 => 506,  1416 => 504,  1411 => 501,  1409 => 500,  1406 => 499,  1399 => 495,  1396 => 494,  1394 => 493,  1380 => 481,  1361 => 479,  1359 => 478,  1356 => 477,  1348 => 475,  1346 => 474,  1339 => 472,  1336 => 471,  1326 => 469,  1324 => 468,  1321 => 467,  1311 => 464,  1308 => 463,  1296 => 460,  1293 => 459,  1291 => 458,  1286 => 456,  1281 => 454,  1278 => 453,  1270 => 451,  1268 => 450,  1260 => 444,  1254 => 442,  1252 => 441,  1246 => 440,  1240 => 439,  1233 => 434,  1227 => 432,  1225 => 431,  1220 => 428,  1217 => 427,  1209 => 423,  1206 => 422,  1198 => 416,  1190 => 414,  1183 => 412,  1175 => 410,  1173 => 409,  1168 => 407,  1157 => 405,  1149 => 399,  1147 => 398,  1144 => 397,  1138 => 393,  1127 => 391,  1123 => 390,  1119 => 389,  1113 => 386,  1110 => 385,  1108 => 384,  1103 => 381,  1093 => 373,  1086 => 372,  1072 => 365,  1063 => 361,  1055 => 359,  1053 => 358,  1050 => 357,  1036 => 350,  1027 => 346,  1019 => 344,  1017 => 343,  1014 => 342,  1000 => 335,  991 => 331,  983 => 329,  981 => 328,  978 => 327,  975 => 326,  969 => 324,  966 => 323,  963 => 322,  950 => 318,  942 => 315,  934 => 313,  932 => 312,  929 => 311,  916 => 307,  908 => 304,  900 => 302,  898 => 301,  894 => 299,  888 => 295,  879 => 291,  872 => 289,  870 => 288,  866 => 287,  863 => 286,  841 => 284,  839 => 283,  836 => 282,  827 => 280,  825 => 279,  818 => 277,  810 => 275,  806 => 274,  802 => 273,  796 => 270,  788 => 268,  786 => 267,  783 => 266,  776 => 261,  763 => 253,  758 => 250,  751 => 248,  749 => 247,  745 => 246,  742 => 245,  720 => 242,  718 => 241,  708 => 239,  704 => 237,  700 => 235,  697 => 234,  693 => 233,  688 => 231,  680 => 228,  672 => 226,  670 => 225,  667 => 224,  661 => 220,  652 => 216,  645 => 214,  643 => 213,  639 => 212,  636 => 211,  614 => 209,  612 => 208,  606 => 207,  598 => 205,  594 => 204,  590 => 203,  584 => 200,  576 => 198,  574 => 197,  571 => 196,  565 => 192,  558 => 190,  551 => 188,  549 => 187,  542 => 186,  538 => 185,  534 => 184,  528 => 183,  520 => 180,  512 => 178,  510 => 177,  507 => 176,  503 => 175,  500 => 174,  498 => 173,  492 => 169,  486 => 167,  484 => 166,  479 => 163,  475 => 162,  471 => 160,  459 => 158,  455 => 157,  452 => 156,  450 => 155,  447 => 154,  439 => 152,  437 => 151,  426 => 142,  414 => 138,  406 => 136,  404 => 135,  401 => 134,  399 => 133,  396 => 132,  391 => 130,  384 => 126,  381 => 125,  379 => 124,  373 => 121,  366 => 116,  359 => 111,  355 => 109,  341 => 107,  338 => 106,  317 => 103,  314 => 102,  310 => 101,  307 => 100,  305 => 99,  302 => 98,  280 => 95,  277 => 94,  271 => 92,  269 => 91,  266 => 90,  260 => 88,  258 => 87,  255 => 86,  249 => 84,  247 => 83,  243 => 81,  241 => 80,  233 => 78,  231 => 77,  222 => 71,  217 => 70,  214 => 69,  211 => 68,  208 => 67,  205 => 66,  202 => 65,  199 => 64,  197 => 63,  193 => 62,  188 => 60,  184 => 58,  173 => 56,  169 => 55,  165 => 53,  159 => 49,  153 => 47,  148 => 45,  143 => 44,  141 => 43,  135 => 40,  131 => 38,  125 => 36,  119 => 34,  117 => 33,  112 => 30,  106 => 28,  104 => 27,  100 => 25,  94 => 23,  89 => 21,  84 => 20,  82 => 19,  76 => 16,  72 => 14,  66 => 12,  60 => 10,  58 => 9,  54 => 7,  52 => 6,  48 => 4,  42 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/product/product.twig", "");
    }
}
