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
class __TwigTemplate_9cf8a886eeb67e2abfb4e79a86f6bff10257a6bc7d1b5566ebbbfc958667a11c extends \Twig\Template
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
                    echo "link cloud-zoom";
                }
                echo "\" id=\"main-image\" href=\"image/";
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
                echo "                            <ul class=\"image-additional\" style=\"display:none\">
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
        echo " </h1>
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
                        echo "
                                                                <label class=\"btn btn-outline btn-option ";
                        // line 235
                        if (twig_get_attribute($this->env, $this->source, $context["option_value"], "color", [], "any", false, false, false, 235)) {
                            echo " btn-color ";
                        }
                        echo "\">
                                                                    <input type=\"radio\" name=\"option[";
                        // line 236
                        echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 236);
                        echo "]\" value=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["option_value"], "product_option_value_id", [], "any", false, false, false, 236);
                        echo "\" data-uid=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["option_value"], "sifra", [], "any", false, false, false, 236);
                        echo "\" />

                                                                    ";
                        // line 238
                        if (twig_get_attribute($this->env, $this->source, $context["option_value"], "color", [], "any", false, false, false, 238)) {
                            // line 239
                            echo "                                                                        <span class=\"ccont\" style=\"background-color: ";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "color", [], "any", false, false, false, 239);
                            echo "\"  data-toggle=\"tooltip\" data-title=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 239);
                            if (twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 239)) {
                                echo " (";
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price_prefix", [], "any", false, false, false, 239);
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 239);
                                echo ")";
                            }
                            echo "\"
                                                                        > </span>
                                                                    ";
                        } else {
                            // line 242
                            echo "                                                                           <span class=\"name\">
                                                                          ";
                            // line 243
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 243);
                            echo "
                                                                        ";
                            // line 244
                            if (twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 244)) {
                                // line 245
                                echo "                                                                            (";
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price_prefix", [], "any", false, false, false, 245);
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 245);
                                echo ")
                                                                        ";
                            }
                            // line 247
                            echo "                                                                        </span>

                                                                    ";
                        }
                        // line 250
                        echo "                                                                </label>






                                                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 258
                    echo "                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        ";
                }
                // line 263
                echo "
                                        ";
                // line 264
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 264) == "checkbox")) {
                    // line 265
                    echo "                                            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 265)) {
                        echo " required";
                    }
                    echo " table-row\">
                                                <div class=\"table-cell checkbox-cell name\">
                                                    <label class=\"control-label\">";
                    // line 267
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 267);
                    echo "</label>
                                                </div>
                                                <div class=\"table-cell checkbox-cell\">
                                                    <div id=\"input-option";
                    // line 270
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 270);
                    echo "\">
                                                        ";
                    // line 271
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["option"], "product_option_value", [], "any", false, false, false, 271));
                    foreach ($context['_seq'] as $context["_key"] => $context["option_value"]) {
                        // line 272
                        echo "                                                            <div class=\"checkbox";
                        if (twig_get_attribute($this->env, $this->source, $context["option_value"], "image", [], "any", false, false, false, 272)) {
                            echo " has-image";
                        }
                        echo "\">
                                                                <label>
                                                                    <input type=\"checkbox\" name=\"option[";
                        // line 274
                        echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 274);
                        echo "][]\" value=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["option_value"], "product_option_value_id", [], "any", false, false, false, 274);
                        echo "\" />

\t\t\t\t";
                        // line 276
                        if ((((($__internal_compile_0 = $context["option"]) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["type"] ?? null) : null) == "checkbox") && (((twig_get_attribute($this->env, $this->source, $context["option_value"], "poip_image", [], "array", true, true, false, 276) &&  !(null === (($__internal_compile_1 = $context["option_value"]) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["poip_image"] ?? null) : null)))) ? ((($__internal_compile_2 = $context["option_value"]) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["poip_image"] ?? null) : null)) : (false)))) {
                            // line 277
                            echo "\t\t\t\t\t<img src=\"";
                            echo (($__internal_compile_3 = $context["option_value"]) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["poip_image"] ?? null) : null);
                            echo "\" alt=\"";
                            echo (($__internal_compile_4 = $context["option_value"]) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["name"] ?? null) : null);
                            echo (((($__internal_compile_5 = $context["option_value"]) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["price"] ?? null) : null)) ? (((" " . (($__internal_compile_6 = $context["option_value"]) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["price_prefix"] ?? null) : null)) . (($__internal_compile_7 = $context["option_value"]) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["price"] ?? null) : null))) : (""));
                            echo " \" class=\"img-thumbnail\" /> 
\t\t\t\t";
                        }
                        // line 279
                        echo "\t\t\t
                                                                    ";
                        // line 280
                        if (twig_get_attribute($this->env, $this->source, $context["option_value"], "image", [], "any", false, false, false, 280)) {
                            // line 281
                            echo "                                                                        <img src=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "image", [], "any", false, false, false, 281);
                            echo "\" alt=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 281);
                            if (twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 281)) {
                                echo "(";
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price_prefix", [], "any", false, false, false, 281);
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 281);
                                echo ")";
                            }
                            echo "\" data-toggle=\"tooltip\" data-title=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 281);
                            if (twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 281)) {
                                echo " (";
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price_prefix", [], "any", false, false, false, 281);
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 281);
                                echo ")";
                            }
                            echo "\" />
                                                                    ";
                        }
                        // line 283
                        echo "                                                                    <span class=\"name\">
                    ";
                        // line 284
                        echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 284);
                        echo "
                                                                        ";
                        // line 285
                        if (twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 285)) {
                            // line 286
                            echo "                                                                            (";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price_prefix", [], "any", false, false, false, 286);
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 286);
                            echo ")
                                                                        ";
                        }
                        // line 288
                        echo "                    </span>
                                                                </label>
                                                            </div>
                                                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 292
                    echo "                                                    </div>
                                                </div>
                                            </div>
                                        ";
                }
                // line 296
                echo "

                                        ";
                // line 298
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 298) == "text")) {
                    // line 299
                    echo "                                            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 299)) {
                        echo " required";
                    }
                    echo " table-row\">
                                                <div class=\"table-cell name\">
                                                    <label class=\"control-label\" for=\"input-option";
                    // line 301
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 301);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 301);
                    echo "</label>
                                                </div>
                                                <div class=\"table-cell\">
                                                    <input type=\"text\" name=\"option[";
                    // line 304
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 304);
                    echo "]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "value", [], "any", false, false, false, 304);
                    echo "\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 304);
                    echo "\" id=\"input-option";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 304);
                    echo "\" class=\"form-control\" />
                                                </div>
                                            </div>
                                        ";
                }
                // line 308
                echo "
                                        ";
                // line 309
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 309) == "textarea")) {
                    // line 310
                    echo "                                            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 310)) {
                        echo " required";
                    }
                    echo " table-row\">
                                                <div class=\"table-cell name\">
                                                    <label class=\"control-label\" for=\"input-option";
                    // line 312
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 312);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 312);
                    echo "</label>
                                                </div>
                                                <div class=\"table-cell\">
                                                    <textarea name=\"option[";
                    // line 315
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 315);
                    echo "]\" rows=\"5\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 315);
                    echo "\" id=\"input-option";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 315);
                    echo "\" class=\"form-control\">";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "value", [], "any", false, false, false, 315);
                    echo "</textarea>
                                                </div>
                                            </div>
                                        ";
                }
                // line 319
                echo "                                        ";
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 319) == "file")) {
                    // line 320
                    echo "                                            ";
                    if (($context["product_dropbox"] ?? null)) {
                        // line 321
                        echo "                                                ";
                        echo twig_get_attribute($this->env, $this->source, $context["option"], "sftool", [], "any", false, false, false, 321);
                        echo "
                                            ";
                    }
                    // line 323
                    echo "                                        ";
                }
                // line 324
                echo "
                                        ";
                // line 325
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 325) == "date")) {
                    // line 326
                    echo "                                            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 326)) {
                        echo " required";
                    }
                    echo " table-row\">
                                                <div class=\"table-cell name\">
                                                    <label class=\"control-label\" for=\"input-option";
                    // line 328
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 328);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 328);
                    echo "</label>
                                                </div>
                                                <div class=\"table-cell\">
                                                    <div class=\"input-group date\">
                                                        <input type=\"text\" name=\"option[";
                    // line 332
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 332);
                    echo "]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "value", [], "any", false, false, false, 332);
                    echo "\" data-date-format=\"YYYY-MM-DD\" id=\"input-option";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 332);
                    echo "\" class=\"form-control\" />
                                                        <span class=\"input-group-btn\">
                <button class=\"btn btn-default\" type=\"button\"><i class=\"fa fa-calendar\"></i></button>
                </span></div>
                                                </div>
                                            </div>
                                        ";
                }
                // line 339
                echo "
                                        ";
                // line 340
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 340) == "datetime")) {
                    // line 341
                    echo "                                            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 341)) {
                        echo " required";
                    }
                    echo " table-row\">
                                                <div class=\"table-cell name\">
                                                    <label class=\"control-label\" for=\"input-option";
                    // line 343
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 343);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 343);
                    echo "</label>
                                                </div>
                                                <div class=\"table-cell\">
                                                    <div class=\"input-group datetime\">
                                                        <input type=\"text\" name=\"option[";
                    // line 347
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 347);
                    echo "]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "value", [], "any", false, false, false, 347);
                    echo "\" data-date-format=\"YYYY-MM-DD HH:mm\" id=\"input-option";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 347);
                    echo "\" class=\"form-control\" />
                                                        <span class=\"input-group-btn\">
                <button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button>
                </span></div>
                                                </div>
                                            </div>
                                        ";
                }
                // line 354
                echo "
                                        ";
                // line 355
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 355) == "time")) {
                    // line 356
                    echo "                                            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 356)) {
                        echo " required";
                    }
                    echo " table-row\">
                                                <div class=\"table-cell name\">
                                                    <label class=\"control-label\" for=\"input-option";
                    // line 358
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 358);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 358);
                    echo "</label>
                                                </div>
                                                <div class=\"table-cell\">
                                                    <div class=\"input-group time\">
                                                        <input type=\"text\" name=\"option[";
                    // line 362
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 362);
                    echo "]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "value", [], "any", false, false, false, 362);
                    echo "\" data-date-format=\"HH:mm\" id=\"input-option";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 362);
                    echo "\" class=\"form-control\" />
                                                        <span class=\"input-group-btn\">
                <button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button>
                </span></div>
                                                </div>
                                            </div>
                                        ";
                }
                // line 369
                echo "
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 370
            echo " <!-- foreach option -->





                                </div>
                            ";
        }
        // line 378
        echo "


                            ";
        // line 381
        if (($context["recurrings"] ?? null)) {
            // line 382
            echo "                                <hr>
                                <h3>";
            // line 383
            echo ($context["text_payment_recurring"] ?? null);
            echo "</h3>
                                <div class=\"form-group required\">
                                    <select name=\"recurring_id\" class=\"form-control\">
                                        <option value=\"\">";
            // line 386
            echo ($context["text_select"] ?? null);
            echo "</option>
                                        ";
            // line 387
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["recurrings"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["recurring"]) {
                // line 388
                echo "                                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["recurring"], "recurring_id", [], "any", false, false, false, 388);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["recurring"], "name", [], "any", false, false, false, 388);
                echo "</option>
                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['recurring'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 390
            echo "                                    </select>
                                    <div class=\"help-block\" id=\"recurring-description\"></div>
                                </div>
                            ";
        }
        // line 394
        echo "



                                ";
        // line 398
        if (($context["attention"] ?? null)) {
            // line 399
            echo "                                    <div class=\"alert alert-custom\"><i class=\"fa fa-info-circle\"></i> ";
            echo ($context["attention"] ?? null);
            echo "
                                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                                    </div>
                                ";
        } else {
            // line 403
            echo "                                    <div class=\"form-group quantity buttons_added buy catalog_hide\">

                                        <button type=\"button\" class=\"minus\"> <i class=\"fa fa-minus-circle\" aria-hidden=\"true\"></i> </button>
                                        <input type=\"text\" step=\"";
            // line 406
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
            // line 408
            echo ($context["product_id"] ?? null);
            echo "\" />

                                        ";
            // line 410
            if (((($context["qty"] ?? null) < 1) && ($context["stock_badge_status"] ?? null))) {
                // line 411
                echo "
                                            <button type=\"button\" id=\"button-cart\" data-loading-text=\"";
                // line 412
                echo ($context["text_loading"] ?? null);
                echo "\" class=\"btn btn-primary cd-btn-add\"><span> <i class=\"global-cart icon\"></i> ";
                echo ($context["button_cart"] ?? null);
                echo "</span></button>
                                        ";
            } else {
                // line 414
                echo "                                            <button type=\"button\" id=\"button-cart\" data-loading-text=\"";
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
        }
        // line 422
        echo "




                            ";
        // line 427
        if ((($context["minimum"] ?? null) > 1)) {
            // line 428
            echo "                                <div class=\"alert alert-sm alert-info\"><i class=\"fa fa-info-circle\"></i> ";
            echo ($context["text_minimum"] ?? null);
            echo "</div>
                            ";
        }
        // line 430
        echo "
                        </div> <!-- #product ends -->



                        <p class=\"info is_wishlist\"><a onclick=\"wishlist.add('";
        // line 435
        echo ($context["product_id"] ?? null);
        echo "');\"><i class=\"icon-heart\"></i> ";
        echo ($context["button_wishlist"] ?? null);
        echo "</a></p>
                        <p class=\"info is_compare\"><a onclick=\"compare.add('";
        // line 436
        echo ($context["product_id"] ?? null);
        echo "');\"><i class=\"icon-refresh\"></i> ";
        echo ($context["button_compare"] ?? null);
        echo "</a></p>
                        ";
        // line 437
        if (($context["question_status"] ?? null)) {
            // line 438
            echo "                            <p class=\"info is_ask\"><a class=\"to_tabs\" onclick=\"\$('a[href=\\'#tab-questions\\']').trigger('click'); return false;\"><i class=\"icon-question\"></i> ";
            echo ($context["basel_button_ask"] ?? null);
            echo "</a></p>
                        ";
        }
        // line 440
        echo "
                        <div class=\"clearfix\"></div>

                        <div class=\"info-holder\">


                            ";
        // line 446
        if ((($context["price"] ?? null) && ($context["points"] ?? null))) {
            // line 447
            echo "                                <p class=\"info\"><b>";
            echo ($context["text_points"] ?? null);
            echo "</b> ";
            echo ($context["points"] ?? null);
            echo "</p>
                            ";
        }
        // line 449
        echo "
                            <p class=\"info\"><i class=\"icon-support\"></i> ";
        // line 450
        echo ($context["text_jamstvo"] ?? null);
        echo "</p>

                            <p class=\"info\"><i class=\"icon-badge\"></i>  ";
        // line 452
        echo ($context["text_ovlasteno"] ?? null);
        echo " </p>

                            ";
        // line 454
        if ((($context["qty"] ?? null) > 0)) {
            // line 455
            echo "
                                <p class=\"info ";
            // line 456
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
            // line 459
            echo "
                                <p class=\"info ";
            // line 460
            if ((($context["qty"] ?? null) > 0)) {
                echo "in_stock";
            }
            echo "\"><b>";
            echo ($context["text_stock"] ?? null);
            echo "</b> Po narudžbi</p>

                            ";
        }
        // line 463
        echo "
                            ";
        // line 464
        if (($context["manufacturer"] ?? null)) {
            // line 465
            echo "                                <p class=\"info\"><b>";
            echo ($context["text_manufacturer"] ?? null);
            echo "</b> <a class=\"hover_uline\" href=\"";
            echo ($context["manufacturers"] ?? null);
            echo "\">";
            echo ($context["manufacturer"] ?? null);
            echo "</a></p>
                            ";
        }
        // line 467
        echo "
                            <p class=\"info\"><b>";
        // line 468
        echo ($context["text_model"] ?? null);
        echo "</b> ";
        echo ($context["model"] ?? null);
        echo "</p>

                            ";
        // line 470
        if (($context["reward"] ?? null)) {
            // line 471
            echo "                                <p class=\"info\"><b>";
            echo ($context["text_reward"] ?? null);
            echo "</b> ";
            echo ($context["reward"] ?? null);
            echo "</p>
                            ";
        }
        // line 473
        echo "
                            ";
        // line 474
        if (($context["tags"] ?? null)) {
            // line 475
            echo "                                <p class=\"info tags\"><b>";
            echo ($context["text_tags"] ?? null);
            echo "</b> &nbsp;<span>";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["tags"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                echo "<a class=\"hover_uline\" href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["tag"], "href", [], "any", false, false, false, 475);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["tag"], "tag", [], "any", false, false, false, 475);
                echo "</a> ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo "</span></p>
                            ";
        }
        // line 477
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
        // line 489
        if (($context["full_width_tabs"] ?? null)) {
            // line 490
            echo "        </div> <!-- main column ends -->
        ";
            // line 491
            echo ($context["column_right"] ?? null);
            echo "
    </div> <!-- .row ends -->
</div> <!-- .container ends -->
";
        }
        // line 495
        echo "
";
        // line 496
        if (($context["full_width_tabs"] ?? null)) {
            // line 497
            echo "<div class=\"outer-container product-tabs-wrapper\">
    <div class=\"container\">
        ";
        } else {
            // line 500
            echo "        <div class=\"inline-tabs\">
            ";
        }
        // line 502
        echo "
            <!-- Tabs area start -->
            <div class=\"row\">
                <div class=\"col-sm-12\">

                    <ul class=\"nav nav-tabs ";
        // line 507
        echo ($context["product_tabs_style"] ?? null);
        echo " main_tabs\">

                        <li class=\"active\"><a href=\"#tab-specification\" data-toggle=\"tab\">";
        // line 509
        echo ($context["tab_description"] ?? null);
        echo "</a></li>


                        ";
        // line 512
        if (($context["product_tabs"] ?? null)) {
            // line 513
            echo "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["product_tabs"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["tab"]) {
                // line 514
                echo "                                <li><a href=\"#custom-tab-";
                echo twig_get_attribute($this->env, $this->source, $context["tab"], "tab_id", [], "any", false, false, false, 514);
                echo "\" data-toggle=\"tab\">";
                echo twig_get_attribute($this->env, $this->source, $context["tab"], "name", [], "any", false, false, false, 514);
                echo "</a></li>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tab'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 516
            echo "                        ";
        }
        // line 517
        echo "
                        ";
        // line 518
        if (twig_get_attribute($this->env, $this->source, ($context["attachfile"] ?? null), "tab_name", [], "any", false, false, false, 518)) {
            // line 519
            echo "                            <li><a href=\"#tab-attach-document\" data-toggle=\"tab\">";
            echo twig_get_attribute($this->env, $this->source, ($context["attachfile"] ?? null), "tab_name", [], "any", false, false, false, 519);
            echo "</a></li>
                        ";
        }
        // line 521
        echo "
                        ";
        // line 522
        if (($context["review_status"] ?? null)) {
            // line 523
            echo "                            <li><a href=\"#tab-review\" data-toggle=\"tab\">";
            echo ($context["tab_review"] ?? null);
            echo "</a></li>
                        ";
        }
        // line 525
        echo "                        ";
        if (($context["question_status"] ?? null)) {
            // line 526
            echo "                            <li><a href=\"#tab-questions\" data-toggle=\"tab\">";
            echo ($context["basel_tab_questions"] ?? null);
            echo " (";
            echo ($context["questions_total"] ?? null);
            echo ")</a></li>
                        ";
        }
        // line 528
        echo "                    </ul>
                    <div class=\"tab-content\">

                        <div class=\"tab-pane active\" id=\"tab-specification\">
                            <div class=\"row\">
                                <div class=\"col-md-6\">




                                    ";
        // line 538
        if (($context["description"] ?? null)) {
            // line 539
            echo "
                                        <h2>";
            // line 540
            echo ($context["h2"] ?? null);
            echo "</h2>";
            echo ($context["description"] ?? null);
            echo "


                                    ";
        }
        // line 544
        echo "

                                </div>


                                ";
        // line 549
        if (($context["attribute_groups"] ?? null)) {
            // line 550
            echo "                                    <div class=\"col-md-6\">
                                        <table class=\"table table-striped specification\">
                                            ";
            // line 552
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["attribute_groups"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["attribute_group"]) {
                // line 553
                echo "                                                <thead>
                                                <tr>
                                                    <td colspan=\"2\">Dodatne infomacije</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                ";
                // line 559
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["attribute_group"], "attribute", [], "any", false, false, false, 559));
                foreach ($context['_seq'] as $context["_key"] => $context["attribute"]) {
                    // line 560
                    echo "                                                    <tr>
                                                        <td class=\"text-left\"><b>";
                    // line 561
                    echo twig_get_attribute($this->env, $this->source, $context["attribute"], "name", [], "any", false, false, false, 561);
                    echo "</b></td>
                                                        <td class=\"text-right\">";
                    // line 562
                    echo twig_get_attribute($this->env, $this->source, $context["attribute"], "text", [], "any", false, false, false, 562);
                    echo "</td>
                                                    </tr>
                                                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attribute'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 565
                echo "                                                </tbody>
                                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attribute_group'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 567
            echo "                                        </table>
                                    </div>
                                ";
        }
        // line 570
        echo "
                            </div>
                        </div>


                        ";
        // line 575
        if (($context["product_tabs"] ?? null)) {
            // line 576
            echo "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["product_tabs"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["tab"]) {
                // line 577
                echo "                                <div class=\"tab-pane\" id=\"custom-tab-";
                echo twig_get_attribute($this->env, $this->source, $context["tab"], "tab_id", [], "any", false, false, false, 577);
                echo "\">
                                    ";
                // line 578
                echo twig_get_attribute($this->env, $this->source, $context["tab"], "description", [], "any", false, false, false, 578);
                echo "
                                </div>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tab'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 581
            echo "                        ";
        }
        // line 582
        echo "


                        ";
        // line 585
        if (($context["question_status"] ?? null)) {
            // line 586
            echo "                            <div class=\"tab-pane\" id=\"tab-questions\">
                                ";
            // line 587
            echo ($context["product_questions"] ?? null);
            echo "
                            </div>
                        ";
        }
        // line 590
        echo "
                        ";
        // line 591
        if (($context["review_status"] ?? null)) {
            // line 592
            echo "                        <div class=\"tab-pane\" id=\"tab-review\">
                            <div class=\"row\">
                                <div class=\"col-sm-6\">
                                    <h4><b>";
            // line 595
            echo ($context["button_reviews"] ?? null);
            echo "</b></h4>

                                    <div id=\"review\">
                                        ";
            // line 598
            if (($context["seo_reviews"] ?? null)) {
                // line 599
                echo "                                            ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["seo_reviews"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["review"]) {
                    // line 600
                    echo "                                                <div class=\"table\">
                                                    <div class=\"table-cell\"><i class=\"fa fa-user\"></i></div>
                                                    <div class=\"table-cell right\">
                                                        <p class=\"author\"><b>";
                    // line 603
                    echo twig_get_attribute($this->env, $this->source, $context["review"], "author", [], "any", false, false, false, 603);
                    echo "</b>  -  ";
                    echo twig_get_attribute($this->env, $this->source, $context["review"], "date_added", [], "any", false, false, false, 603);
                    echo "
                                                            <span class=\"rating\">
\t\t<span class=\"rating_stars rating r";
                    // line 605
                    echo twig_get_attribute($this->env, $this->source, $context["review"], "rating", [], "any", false, false, false, 605);
                    echo "\">
\t\t<i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i>
\t\t</span>
\t\t</span>
                                                        </p>
                                                        ";
                    // line 610
                    echo twig_get_attribute($this->env, $this->source, $context["review"], "text", [], "any", false, false, false, 610);
                    echo "
                                                    </div>
                                                </div>
                                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['review'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 614
                echo "                                            ";
                if (($context["pagination"] ?? null)) {
                    // line 615
                    echo "                                                <div class=\"pagination-holder\">";
                    echo ($context["pagination"] ?? null);
                    echo "</div>
                                            ";
                }
                // line 617
                echo "                                        ";
            } else {
                // line 618
                echo "                                            <p>";
                echo ($context["text_no_reviews"] ?? null);
                echo "</p>
                                        ";
            }
            // line 620
            echo "                                    </div>

                                </div>
                                <div class=\"col-sm-6 right\">
                                    <form class=\"form-horizontal\" id=\"form-review\">

                                        <h4 id=\"review-notification\"><b>";
            // line 626
            echo ($context["text_write"] ?? null);
            echo "</b></h4>
                                        ";
            // line 627
            if (($context["review_guest"] ?? null)) {
                // line 628
                echo "
                                            <div class=\"form-group required\">
                                                <div class=\"col-sm-12 rating-stars\">
                                                    <label class=\"control-label\">";
                // line 631
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
                // line 652
                echo ($context["entry_name"] ?? null);
                echo "</label>
                                                    <input type=\"text\" name=\"name\" value=\"";
                // line 653
                echo ($context["customer_name"] ?? null);
                echo "\" id=\"input-name\" class=\"form-control grey\" />
                                                </div>
                                            </div>
                                            <div class=\"form-group required\">
                                                <div class=\"col-sm-12\">
                                                    <label class=\"control-label\" for=\"input-review\">";
                // line 658
                echo ($context["entry_review"] ?? null);
                echo "</label>
                                                    <textarea name=\"text\" rows=\"5\" id=\"input-review\" class=\"form-control grey\"></textarea>
                                                    <small>";
                // line 660
                echo ($context["text_note"] ?? null);
                echo "</small>
                                                </div>
                                            </div>

                                            <div class=\"form-group required\">
                                                <div class=\"col-sm-12\">
                                                    ";
                // line 666
                echo ($context["captcha"] ?? null);
                echo "
                                                </div>
                                            </div>

                                            <div class=\"buttons clearfix\">
                                                <div class=\"text-right\">
                                                    <button type=\"button\" id=\"button-review\" data-loading-text=\"";
                // line 672
                echo ($context["text_loading"] ?? null);
                echo "\" class=\"btn btn-outline\">";
                echo ($context["button_continue"] ?? null);
                echo "</button>
                                                </div>
                                            </div>
                                        ";
            } else {
                // line 676
                echo "                                            ";
                echo ($context["text_login"] ?? null);
                echo "
                                        ";
            }
            // line 678
            echo "                                    </form>
                                </div>
                            </div>
                        </div>
                        ";
        }
        // line 682
        echo "<!-- if review-status ends -->

                    </div> <!-- .tab-content ends -->
                </div> <!-- .col-sm-12 ends -->
            </div> <!-- .row ends -->
            <!-- Tabs area ends -->

            ";
        // line 689
        if (($context["full_width_tabs"] ?? null)) {
            // line 690
            echo "        </div>
        ";
        }
        // line 692
        echo "    </div>

    <!-- Related Products -->

    ";
        // line 696
        if (($context["full_width_tabs"] ?? null)) {
            // line 697
            echo "    <div class=\"container\">
        ";
        }
        // line 699
        echo "
        ";
        // line 700
        if (($context["products"] ?? null)) {
            // line 701
            echo "            <div class=\"widget widget-related\">

                <div class=\"widget-title\">
                    <p class=\"main-title\"><span>";
            // line 704
            echo ($context["text_related"] ?? null);
            echo "</span></p>
                    <p class=\"widget-title-separator\"><i class=\"icon-line-cross\"></i></p>
                </div>

                <div class=\"grid grid-holder related carousel grid";
            // line 708
            echo ($context["basel_rel_prod_grid"] ?? null);
            echo "\">
                    ";
            // line 709
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
                // line 710
                echo "                        ";
                $this->loadTemplate("basel/template/product/single_product.twig", "basel/template/product/product.twig", 710)->display($context);
                // line 711
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
            // line 712
            echo "                </div>
            </div>
        ";
        }
        // line 715
        echo "
        ";
        // line 716
        echo ($context["content_bottom"] ?? null);
        echo "

        ";
        // line 718
        if (($context["full_width_tabs"] ?? null)) {
            // line 719
            echo "    </div>
    ";
        }
        // line 721
        echo "

    ";
        // line 723
        if ( !($context["full_width_tabs"] ?? null)) {
            // line 724
            echo "</div> <!-- main column ends -->
";
            // line 725
            echo ($context["column_right"] ?? null);
            echo "
    </div> <!-- .row ends -->
    </div> <!-- .container ends -->
";
        }
        // line 729
        echo "



<script src=\"catalog/view/theme/basel/js/lightgallery/js/lightgallery.min.js\"></script>
<script src=\"catalog/view/theme/basel/js/lightgallery/js/lg-zoom.min.js\"></script>
<script src=\"catalog/view/theme/basel/js/cloudzoom/cloud-zoom.1.0.2.min.js\"></script>
";
        // line 736
        if (($context["basel_price_update"] ?? null)) {
            // line 737
            echo "    <script src=\"index.php?route=extension/basel/live_options/js&product_id=";
            echo ($context["product_id"] ?? null);
            echo "\"></script>
";
        }
        // line 739
        echo "



";
        // line 743
        if (($context["products"] ?? null)) {
            // line 744
            echo "    <script><!--
        \$('.grid-holder.related').slick({
            prevArrow: \"<a class=\\\"arrow-left icon-arrow-left\\\"></a>\",
            nextArrow: \"<a class=\\\"arrow-right icon-arrow-right\\\"></a>\",
            dots:true,
            ";
            // line 749
            if ((($context["direction"] ?? null) == "rtl")) {
                // line 750
                echo "            rtl: true,
            ";
            }
            // line 752
            echo "            respondTo:'min',
            ";
            // line 753
            if ((($context["basel_rel_prod_grid"] ?? null) == "5")) {
                // line 754
                echo "            slidesToShow:5,slidesToScroll:5,responsive:[{breakpoint:1100,settings:{slidesToShow:4,slidesToScroll:4}},{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
                ";
            } elseif ((            // line 755
($context["basel_rel_prod_grid"] ?? null) == "4")) {
                // line 756
                echo "                slidesToShow:4,slidesToScroll:4,responsive:[{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
            ";
            } elseif ((            // line 757
($context["basel_rel_prod_grid"] ?? null) == "3")) {
                // line 758
                echo "            slidesToShow:3,slidesToScroll:3,responsive:[{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
            ";
            } elseif ((            // line 759
($context["basel_rel_prod_grid"] ?? null) == "2")) {
                // line 760
                echo "            slidesToShow:2,slidesToScroll:2,responsive:[
            ";
            }
            // line 762
            echo "            ";
            if (($context["items_mobile_fw"] ?? null)) {
                // line 763
                echo "            {breakpoint:320,settings:{slidesToShow:1,slidesToScroll:1}}
            ";
            }
            // line 765
            echo "        ]
        });
        \$('.product-style2 .single-product .icon').attr('data-placement', 'top');
        \$('[data-toggle=\\'tooltip\\']').tooltip({container: 'body'});
        //--></script>
";
        }
        // line 771
        echo "
";
        // line 772
        if ((($context["sale_end_date"] ?? null) && ($context["product_page_countdown"] ?? null))) {
            // line 773
            echo "    <script>
        \$(function() {
            \$('#special_countdown').countdown('";
            // line 775
            echo ($context["sale_end_date"] ?? null);
            echo "').on('update.countdown', function(event) {
                var \$this = \$(this).html(event.strftime(''
                    + '<div class=\\\"special_countdown\\\"></span><p><span class=\\\"icon-clock\\\"></span> ";
            // line 777
            echo ($context["basel_text_offer_ends"] ?? null);
            echo "</p><div>'
                    + '%D<i>";
            // line 778
            echo ($context["basel_text_days"] ?? null);
            echo "</i></div><div>'
                    + '%H <i>";
            // line 779
            echo ($context["basel_text_hours"] ?? null);
            echo "</i></div><div>'
                    + '%M <i>";
            // line 780
            echo ($context["basel_text_mins"] ?? null);
            echo "</i></div><div>'
                    + '%S <i>";
            // line 781
            echo ($context["basel_text_secs"] ?? null);
            echo "</i></div></div>'));
            });
        });
    </script>
";
        }
        // line 786
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
        // line 980
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
        // line 1009
        if ((($context["product_layout"] ?? null) == "full-width")) {
            // line 1010
            echo "// Sticky information
        \$('.table-cell.right .inner').theiaStickySidebar({containerSelector:'.product-info'});
        ";
        }
        // line 1013
        echo "
// Reviews/Question scroll link
        \$(\".to_tabs\").click(function() {
            \$('html, body').animate({
                scrollTop: (\$(\".main_tabs\").offset().top - 100)
            }, 1000);
        });

// Sharing buttons
        ";
        // line 1022
        if (($context["basel_share_btn"] ?? null)) {
            // line 1023
            echo "        var share_url = encodeURIComponent(window.location.href);
        var page_title = '";
            // line 1024
            echo ($context["heading_title"] ?? null);
            echo "';
        ";
            // line 1025
            if (($context["thumb"] ?? null)) {
                // line 1026
                echo "        var thumb = '";
                echo ($context["thumb"] ?? null);
                echo "';
        ";
            }
            // line 1028
            echo "        \$('.fb_share').attr(\"href\", 'https://www.facebook.com/sharer/sharer.php?u=' + share_url + '');
        \$('.twitter_share').attr(\"href\", 'https://twitter.com/intent/tweet?source=' + share_url + '&text=' + page_title + ': ' + share_url + '');
        \$('.google_share').attr(\"href\", 'https://plus.google.com/share?url=' + share_url + '');
        \$('.pinterest_share').attr(\"href\", 'http://pinterest.com/pin/create/button/?url=' + share_url + '&media=' + thumb + '&description=' + page_title + '');
        \$('.vk_share').attr(\"href\", 'http://vkontakte.ru/share.php?url=' + share_url + '');
        ";
        }
        // line 1034
        echo "    });
    //--></script>

";
        // line 1037
        if ((($context["product_layout"] ?? null) != "full-width")) {
            // line 1038
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
            // line 1048
            if (($context["images"] ?? null)) {
                // line 1049
                echo "            \$('.cloud-zoom-wrap').click(function (e) {
                e.preventDefault();
                \$('.image-additional a.link.active').removeClass('locked').trigger('click').addClass('locked');
            });
            ";
            } else {
                // line 1054
                echo "            \$('.cloud-zoom-wrap').click(function (e) {
                e.preventDefault();
                \$('#main-image').trigger('click');
            });
            ";
            }
            // line 1059
            echo "
            \$('.image-additional').slick({
                prevArrow: \"<a class=\\\"icon-arrow-left\\\"></a>\",
                nextArrow: \"<a class=\\\"icon-arrow-right\\\"></a>\",
                appendArrows: '.image-additional .slick-list',
                arrows:true,
                ";
            // line 1065
            if ((($context["direction"] ?? null) == "rtl")) {
                // line 1066
                echo "                rtl: true,
                ";
            }
            // line 1068
            echo "                infinite:false,
                ";
            // line 1069
            if ((($context["product_layout"] ?? null) == "images-left")) {
                // line 1070
                echo "                slidesToShow: ";
                echo twig_round((($context["img_h"] ?? null) / ($context["img_a_h"] ?? null)), 0, "floor");
                echo ",
                vertical:true,
                verticalSwiping:true,
                ";
            } else {
                // line 1074
                echo "                slidesToShow: ";
                echo twig_round((($context["img_w"] ?? null) / ($context["img_a_w"] ?? null)));
                echo ",
                ";
            }
            // line 1076
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
        // line 1089
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
        // line 1118
        if ((($context["poip_installed"]) ?? (false))) {
            // line 1119
            echo "\t\t\t\t\t";
            echo (($context["poip_theme_script"]) ?? (""));
            echo "
\t\t\t\t\t";
            // line 1120
            echo (($context["poip_script"]) ?? (""));
            echo "
\t\t\t\t";
        }
        // line 1122
        echo "\t\t\t\t<!-- >> Product Option Image PRO module -->
\t\t\t";
        // line 1123
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
        return array (  2406 => 1123,  2403 => 1122,  2398 => 1120,  2393 => 1119,  2391 => 1118,  2360 => 1089,  2345 => 1076,  2339 => 1074,  2331 => 1070,  2329 => 1069,  2326 => 1068,  2322 => 1066,  2320 => 1065,  2312 => 1059,  2305 => 1054,  2298 => 1049,  2296 => 1048,  2284 => 1038,  2282 => 1037,  2277 => 1034,  2269 => 1028,  2263 => 1026,  2261 => 1025,  2257 => 1024,  2254 => 1023,  2252 => 1022,  2241 => 1013,  2236 => 1010,  2234 => 1009,  2202 => 980,  2006 => 786,  1998 => 781,  1994 => 780,  1990 => 779,  1986 => 778,  1982 => 777,  1977 => 775,  1973 => 773,  1971 => 772,  1968 => 771,  1960 => 765,  1956 => 763,  1953 => 762,  1949 => 760,  1947 => 759,  1944 => 758,  1942 => 757,  1939 => 756,  1937 => 755,  1934 => 754,  1932 => 753,  1929 => 752,  1925 => 750,  1923 => 749,  1916 => 744,  1914 => 743,  1908 => 739,  1902 => 737,  1900 => 736,  1891 => 729,  1884 => 725,  1881 => 724,  1879 => 723,  1875 => 721,  1871 => 719,  1869 => 718,  1864 => 716,  1861 => 715,  1856 => 712,  1842 => 711,  1839 => 710,  1822 => 709,  1818 => 708,  1811 => 704,  1806 => 701,  1804 => 700,  1801 => 699,  1797 => 697,  1795 => 696,  1789 => 692,  1785 => 690,  1783 => 689,  1774 => 682,  1767 => 678,  1761 => 676,  1752 => 672,  1743 => 666,  1734 => 660,  1729 => 658,  1721 => 653,  1717 => 652,  1693 => 631,  1688 => 628,  1686 => 627,  1682 => 626,  1674 => 620,  1668 => 618,  1665 => 617,  1659 => 615,  1656 => 614,  1646 => 610,  1638 => 605,  1631 => 603,  1626 => 600,  1621 => 599,  1619 => 598,  1613 => 595,  1608 => 592,  1606 => 591,  1603 => 590,  1597 => 587,  1594 => 586,  1592 => 585,  1587 => 582,  1584 => 581,  1575 => 578,  1570 => 577,  1565 => 576,  1563 => 575,  1556 => 570,  1551 => 567,  1544 => 565,  1535 => 562,  1531 => 561,  1528 => 560,  1524 => 559,  1516 => 553,  1512 => 552,  1508 => 550,  1506 => 549,  1499 => 544,  1490 => 540,  1487 => 539,  1485 => 538,  1473 => 528,  1465 => 526,  1462 => 525,  1456 => 523,  1454 => 522,  1451 => 521,  1445 => 519,  1443 => 518,  1440 => 517,  1437 => 516,  1426 => 514,  1421 => 513,  1419 => 512,  1413 => 509,  1408 => 507,  1401 => 502,  1397 => 500,  1392 => 497,  1390 => 496,  1387 => 495,  1380 => 491,  1377 => 490,  1375 => 489,  1361 => 477,  1342 => 475,  1340 => 474,  1337 => 473,  1329 => 471,  1327 => 470,  1320 => 468,  1317 => 467,  1307 => 465,  1305 => 464,  1302 => 463,  1292 => 460,  1289 => 459,  1277 => 456,  1274 => 455,  1272 => 454,  1267 => 452,  1262 => 450,  1259 => 449,  1251 => 447,  1249 => 446,  1241 => 440,  1235 => 438,  1233 => 437,  1227 => 436,  1221 => 435,  1214 => 430,  1208 => 428,  1206 => 427,  1199 => 422,  1191 => 416,  1183 => 414,  1176 => 412,  1173 => 411,  1171 => 410,  1166 => 408,  1155 => 406,  1150 => 403,  1142 => 399,  1140 => 398,  1134 => 394,  1128 => 390,  1117 => 388,  1113 => 387,  1109 => 386,  1103 => 383,  1100 => 382,  1098 => 381,  1093 => 378,  1083 => 370,  1076 => 369,  1062 => 362,  1053 => 358,  1045 => 356,  1043 => 355,  1040 => 354,  1026 => 347,  1017 => 343,  1009 => 341,  1007 => 340,  1004 => 339,  990 => 332,  981 => 328,  973 => 326,  971 => 325,  968 => 324,  965 => 323,  959 => 321,  956 => 320,  953 => 319,  940 => 315,  932 => 312,  924 => 310,  922 => 309,  919 => 308,  906 => 304,  898 => 301,  890 => 299,  888 => 298,  884 => 296,  878 => 292,  869 => 288,  862 => 286,  860 => 285,  856 => 284,  853 => 283,  831 => 281,  829 => 280,  826 => 279,  817 => 277,  815 => 276,  808 => 274,  800 => 272,  796 => 271,  792 => 270,  786 => 267,  778 => 265,  776 => 264,  773 => 263,  766 => 258,  753 => 250,  748 => 247,  741 => 245,  739 => 244,  735 => 243,  732 => 242,  717 => 239,  715 => 238,  706 => 236,  700 => 235,  697 => 234,  693 => 233,  688 => 231,  680 => 228,  672 => 226,  670 => 225,  667 => 224,  661 => 220,  652 => 216,  645 => 214,  643 => 213,  639 => 212,  636 => 211,  614 => 209,  612 => 208,  606 => 207,  598 => 205,  594 => 204,  590 => 203,  584 => 200,  576 => 198,  574 => 197,  571 => 196,  565 => 192,  558 => 190,  551 => 188,  549 => 187,  542 => 186,  538 => 185,  534 => 184,  528 => 183,  520 => 180,  512 => 178,  510 => 177,  507 => 176,  503 => 175,  500 => 174,  498 => 173,  492 => 169,  486 => 167,  484 => 166,  479 => 163,  475 => 162,  471 => 160,  459 => 158,  455 => 157,  452 => 156,  450 => 155,  447 => 154,  439 => 152,  437 => 151,  426 => 142,  414 => 138,  406 => 136,  404 => 135,  401 => 134,  399 => 133,  396 => 132,  391 => 130,  384 => 126,  381 => 125,  379 => 124,  373 => 121,  366 => 116,  359 => 111,  355 => 109,  341 => 107,  338 => 106,  317 => 103,  314 => 102,  310 => 101,  307 => 100,  305 => 99,  302 => 98,  280 => 95,  277 => 94,  271 => 92,  269 => 91,  266 => 90,  260 => 88,  258 => 87,  255 => 86,  249 => 84,  247 => 83,  243 => 81,  241 => 80,  233 => 78,  231 => 77,  222 => 71,  217 => 70,  214 => 69,  211 => 68,  208 => 67,  205 => 66,  202 => 65,  199 => 64,  197 => 63,  193 => 62,  188 => 60,  184 => 58,  173 => 56,  169 => 55,  165 => 53,  159 => 49,  153 => 47,  148 => 45,  143 => 44,  141 => 43,  135 => 40,  131 => 38,  125 => 36,  119 => 34,  117 => 33,  112 => 30,  106 => 28,  104 => 27,  100 => 25,  94 => 23,  89 => 21,  84 => 20,  82 => 19,  76 => 16,  72 => 14,  66 => 12,  60 => 10,  58 => 9,  54 => 7,  52 => 6,  48 => 4,  42 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/product/product.twig", "");
    }
}
