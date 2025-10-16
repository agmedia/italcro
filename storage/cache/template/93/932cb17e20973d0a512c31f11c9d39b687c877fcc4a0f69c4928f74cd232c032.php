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
class __TwigTemplate_960bef69b643606983500d067463655a1ec975fec75c2da9b67ca327f8774d79 extends \Twig\Template
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
        echo "  ";
        echo ($context["is_logged"] ?? null);
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
        // line 395
        if (($context["is_logged"] ?? null)) {
            // line 396
            echo "                                <div class=\"form-group quantity buttons_added buy catalog_hide\">

                                    <button type=\"button\" class=\"minus\"> <i class=\"fa fa-minus-circle\" aria-hidden=\"true\"></i> </button>
                                    <input type=\"text\" step=\"";
            // line 399
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
            // line 401
            echo ($context["product_id"] ?? null);
            echo "\" />

                                    ";
            // line 403
            if (((($context["qty"] ?? null) < 1) && ($context["stock_badge_status"] ?? null))) {
                // line 404
                echo "
                                        <button type=\"button\" id=\"button-cart\" data-loading-text=\"";
                // line 405
                echo ($context["text_loading"] ?? null);
                echo "\" class=\"btn btn-primary cd-btn-add\"><span> <i class=\"global-cart icon\"></i> ";
                echo ($context["button_cart"] ?? null);
                echo "</span></button>
                                    ";
            } else {
                // line 407
                echo "                                        <button type=\"button\" id=\"button-cart\" data-loading-text=\"";
                echo ($context["text_loading"] ?? null);
                echo "\" class=\"btn btn-primary cd-btn-add\"><span> <i class=\"global-cart icon\"></i> ";
                echo ($context["button_cart"] ?? null);
                echo "</span></button>
                                    ";
            }
            // line 409
            echo "


                                </div>

                            ";
        } else {
            // line 415
            echo "                                ";
            if (($context["attention"] ?? null)) {
                // line 416
                echo "                                    <div class=\"alert alert-custom\"><i class=\"fa fa-info-circle\"></i> ";
                echo ($context["attention"] ?? null);
                echo "
                                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                                    </div>
                                ";
            }
            // line 420
            echo "                            ";
        }
        // line 421
        echo "



                            ";
        // line 425
        if ((($context["minimum"] ?? null) > 1)) {
            // line 426
            echo "                                <div class=\"alert alert-sm alert-info\"><i class=\"fa fa-info-circle\"></i> ";
            echo ($context["text_minimum"] ?? null);
            echo "</div>
                            ";
        }
        // line 428
        echo "
                        </div> <!-- #product ends -->



                        <p class=\"info is_wishlist\"><a onclick=\"wishlist.add('";
        // line 433
        echo ($context["product_id"] ?? null);
        echo "');\"><i class=\"icon-heart\"></i> ";
        echo ($context["button_wishlist"] ?? null);
        echo "</a></p>
                        <p class=\"info is_compare\"><a onclick=\"compare.add('";
        // line 434
        echo ($context["product_id"] ?? null);
        echo "');\"><i class=\"icon-refresh\"></i> ";
        echo ($context["button_compare"] ?? null);
        echo "</a></p>
                        ";
        // line 435
        if (($context["question_status"] ?? null)) {
            // line 436
            echo "                            <p class=\"info is_ask\"><a class=\"to_tabs\" onclick=\"\$('a[href=\\'#tab-questions\\']').trigger('click'); return false;\"><i class=\"icon-question\"></i> ";
            echo ($context["basel_button_ask"] ?? null);
            echo "</a></p>
                        ";
        }
        // line 438
        echo "
                        <div class=\"clearfix\"></div>

                        <div class=\"info-holder\">


                            ";
        // line 444
        if ((($context["price"] ?? null) && ($context["points"] ?? null))) {
            // line 445
            echo "                                <p class=\"info\"><b>";
            echo ($context["text_points"] ?? null);
            echo "</b> ";
            echo ($context["points"] ?? null);
            echo "</p>
                            ";
        }
        // line 447
        echo "
                            <p class=\"info\"><i class=\"icon-support\"></i> ";
        // line 448
        echo ($context["text_jamstvo"] ?? null);
        echo "</p>

                            <p class=\"info\"><i class=\"icon-badge\"></i>  ";
        // line 450
        echo ($context["text_ovlasteno"] ?? null);
        echo " </p>

                            ";
        // line 452
        if ((($context["qty"] ?? null) > 0)) {
            // line 453
            echo "
                                <p class=\"info ";
            // line 454
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
            // line 457
            echo "
                                <p class=\"info ";
            // line 458
            if ((($context["qty"] ?? null) > 0)) {
                echo "in_stock";
            }
            echo "\"><b>";
            echo ($context["text_stock"] ?? null);
            echo "</b> Po narudžbi</p>

                            ";
        }
        // line 461
        echo "
                            ";
        // line 462
        if (($context["manufacturer"] ?? null)) {
            // line 463
            echo "                                <p class=\"info\"><b>";
            echo ($context["text_manufacturer"] ?? null);
            echo "</b> <a class=\"hover_uline\" href=\"";
            echo ($context["manufacturers"] ?? null);
            echo "\">";
            echo ($context["manufacturer"] ?? null);
            echo "</a></p>
                            ";
        }
        // line 465
        echo "
                            <p class=\"info\"><b>";
        // line 466
        echo ($context["text_model"] ?? null);
        echo "</b> ";
        echo ($context["model"] ?? null);
        echo "</p>

                            ";
        // line 468
        if (($context["reward"] ?? null)) {
            // line 469
            echo "                                <p class=\"info\"><b>";
            echo ($context["text_reward"] ?? null);
            echo "</b> ";
            echo ($context["reward"] ?? null);
            echo "</p>
                            ";
        }
        // line 471
        echo "
                            ";
        // line 472
        if (($context["tags"] ?? null)) {
            // line 473
            echo "                                <p class=\"info tags\"><b>";
            echo ($context["text_tags"] ?? null);
            echo "</b> &nbsp;<span>";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["tags"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                echo "<a class=\"hover_uline\" href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["tag"], "href", [], "any", false, false, false, 473);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["tag"], "tag", [], "any", false, false, false, 473);
                echo "</a> ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo "</span></p>
                            ";
        }
        // line 475
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
        // line 487
        if (($context["full_width_tabs"] ?? null)) {
            // line 488
            echo "        </div> <!-- main column ends -->
        ";
            // line 489
            echo ($context["column_right"] ?? null);
            echo "
    </div> <!-- .row ends -->
</div> <!-- .container ends -->
";
        }
        // line 493
        echo "
";
        // line 494
        if (($context["full_width_tabs"] ?? null)) {
            // line 495
            echo "<div class=\"outer-container product-tabs-wrapper\">
    <div class=\"container\">
        ";
        } else {
            // line 498
            echo "        <div class=\"inline-tabs\">
            ";
        }
        // line 500
        echo "
            <!-- Tabs area start -->
            <div class=\"row\">
                <div class=\"col-sm-12\">

                    <ul class=\"nav nav-tabs ";
        // line 505
        echo ($context["product_tabs_style"] ?? null);
        echo " main_tabs\">

                        <li class=\"active\"><a href=\"#tab-specification\" data-toggle=\"tab\">";
        // line 507
        echo ($context["tab_description"] ?? null);
        echo "</a></li>


                        ";
        // line 510
        if (($context["product_tabs"] ?? null)) {
            // line 511
            echo "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["product_tabs"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["tab"]) {
                // line 512
                echo "                                <li><a href=\"#custom-tab-";
                echo twig_get_attribute($this->env, $this->source, $context["tab"], "tab_id", [], "any", false, false, false, 512);
                echo "\" data-toggle=\"tab\">";
                echo twig_get_attribute($this->env, $this->source, $context["tab"], "name", [], "any", false, false, false, 512);
                echo "</a></li>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tab'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 514
            echo "                        ";
        }
        // line 515
        echo "
                        ";
        // line 516
        if (twig_get_attribute($this->env, $this->source, ($context["attachfile"] ?? null), "tab_name", [], "any", false, false, false, 516)) {
            // line 517
            echo "                            <li><a href=\"#tab-attach-document\" data-toggle=\"tab\">";
            echo twig_get_attribute($this->env, $this->source, ($context["attachfile"] ?? null), "tab_name", [], "any", false, false, false, 517);
            echo "</a></li>
                        ";
        }
        // line 519
        echo "
                        ";
        // line 520
        if (($context["review_status"] ?? null)) {
            // line 521
            echo "                            <li><a href=\"#tab-review\" data-toggle=\"tab\">";
            echo ($context["tab_review"] ?? null);
            echo "</a></li>
                        ";
        }
        // line 523
        echo "                        ";
        if (($context["question_status"] ?? null)) {
            // line 524
            echo "                            <li><a href=\"#tab-questions\" data-toggle=\"tab\">";
            echo ($context["basel_tab_questions"] ?? null);
            echo " (";
            echo ($context["questions_total"] ?? null);
            echo ")</a></li>
                        ";
        }
        // line 526
        echo "                    </ul>
                    <div class=\"tab-content\">

                        <div class=\"tab-pane active\" id=\"tab-specification\">
                            <div class=\"row\">
                                <div class=\"col-md-6\">




                                    ";
        // line 536
        if (($context["description"] ?? null)) {
            // line 537
            echo "
                                        <h2>";
            // line 538
            echo ($context["h2"] ?? null);
            echo "</h2>";
            echo ($context["description"] ?? null);
            echo "


                                    ";
        }
        // line 542
        echo "

                                </div>


                                ";
        // line 547
        if (($context["attribute_groups"] ?? null)) {
            // line 548
            echo "                                    <div class=\"col-md-6\">
                                        <table class=\"table table-striped specification\">
                                            ";
            // line 550
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["attribute_groups"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["attribute_group"]) {
                // line 551
                echo "                                                <thead>
                                                <tr>
                                                    <td colspan=\"2\">Dodatne infomacije</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                ";
                // line 557
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["attribute_group"], "attribute", [], "any", false, false, false, 557));
                foreach ($context['_seq'] as $context["_key"] => $context["attribute"]) {
                    // line 558
                    echo "                                                    <tr>
                                                        <td class=\"text-left\"><b>";
                    // line 559
                    echo twig_get_attribute($this->env, $this->source, $context["attribute"], "name", [], "any", false, false, false, 559);
                    echo "</b></td>
                                                        <td class=\"text-right\">";
                    // line 560
                    echo twig_get_attribute($this->env, $this->source, $context["attribute"], "text", [], "any", false, false, false, 560);
                    echo "</td>
                                                    </tr>
                                                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attribute'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 563
                echo "                                                </tbody>
                                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attribute_group'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 565
            echo "                                        </table>
                                    </div>
                                ";
        }
        // line 568
        echo "
                            </div>
                        </div>


                        ";
        // line 573
        if (($context["product_tabs"] ?? null)) {
            // line 574
            echo "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["product_tabs"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["tab"]) {
                // line 575
                echo "                                <div class=\"tab-pane\" id=\"custom-tab-";
                echo twig_get_attribute($this->env, $this->source, $context["tab"], "tab_id", [], "any", false, false, false, 575);
                echo "\">
                                    ";
                // line 576
                echo twig_get_attribute($this->env, $this->source, $context["tab"], "description", [], "any", false, false, false, 576);
                echo "
                                </div>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tab'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 579
            echo "                        ";
        }
        // line 580
        echo "


                        ";
        // line 583
        if (($context["question_status"] ?? null)) {
            // line 584
            echo "                            <div class=\"tab-pane\" id=\"tab-questions\">
                                ";
            // line 585
            echo ($context["product_questions"] ?? null);
            echo "
                            </div>
                        ";
        }
        // line 588
        echo "
                        ";
        // line 589
        if (($context["review_status"] ?? null)) {
            // line 590
            echo "                        <div class=\"tab-pane\" id=\"tab-review\">
                            <div class=\"row\">
                                <div class=\"col-sm-6\">
                                    <h4><b>";
            // line 593
            echo ($context["button_reviews"] ?? null);
            echo "</b></h4>

                                    <div id=\"review\">
                                        ";
            // line 596
            if (($context["seo_reviews"] ?? null)) {
                // line 597
                echo "                                            ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["seo_reviews"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["review"]) {
                    // line 598
                    echo "                                                <div class=\"table\">
                                                    <div class=\"table-cell\"><i class=\"fa fa-user\"></i></div>
                                                    <div class=\"table-cell right\">
                                                        <p class=\"author\"><b>";
                    // line 601
                    echo twig_get_attribute($this->env, $this->source, $context["review"], "author", [], "any", false, false, false, 601);
                    echo "</b>  -  ";
                    echo twig_get_attribute($this->env, $this->source, $context["review"], "date_added", [], "any", false, false, false, 601);
                    echo "
                                                            <span class=\"rating\">
\t\t<span class=\"rating_stars rating r";
                    // line 603
                    echo twig_get_attribute($this->env, $this->source, $context["review"], "rating", [], "any", false, false, false, 603);
                    echo "\">
\t\t<i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i>
\t\t</span>
\t\t</span>
                                                        </p>
                                                        ";
                    // line 608
                    echo twig_get_attribute($this->env, $this->source, $context["review"], "text", [], "any", false, false, false, 608);
                    echo "
                                                    </div>
                                                </div>
                                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['review'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 612
                echo "                                            ";
                if (($context["pagination"] ?? null)) {
                    // line 613
                    echo "                                                <div class=\"pagination-holder\">";
                    echo ($context["pagination"] ?? null);
                    echo "</div>
                                            ";
                }
                // line 615
                echo "                                        ";
            } else {
                // line 616
                echo "                                            <p>";
                echo ($context["text_no_reviews"] ?? null);
                echo "</p>
                                        ";
            }
            // line 618
            echo "                                    </div>

                                </div>
                                <div class=\"col-sm-6 right\">
                                    <form class=\"form-horizontal\" id=\"form-review\">

                                        <h4 id=\"review-notification\"><b>";
            // line 624
            echo ($context["text_write"] ?? null);
            echo "</b></h4>
                                        ";
            // line 625
            if (($context["review_guest"] ?? null)) {
                // line 626
                echo "
                                            <div class=\"form-group required\">
                                                <div class=\"col-sm-12 rating-stars\">
                                                    <label class=\"control-label\">";
                // line 629
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
                // line 650
                echo ($context["entry_name"] ?? null);
                echo "</label>
                                                    <input type=\"text\" name=\"name\" value=\"";
                // line 651
                echo ($context["customer_name"] ?? null);
                echo "\" id=\"input-name\" class=\"form-control grey\" />
                                                </div>
                                            </div>
                                            <div class=\"form-group required\">
                                                <div class=\"col-sm-12\">
                                                    <label class=\"control-label\" for=\"input-review\">";
                // line 656
                echo ($context["entry_review"] ?? null);
                echo "</label>
                                                    <textarea name=\"text\" rows=\"5\" id=\"input-review\" class=\"form-control grey\"></textarea>
                                                    <small>";
                // line 658
                echo ($context["text_note"] ?? null);
                echo "</small>
                                                </div>
                                            </div>

                                            <div class=\"form-group required\">
                                                <div class=\"col-sm-12\">
                                                    ";
                // line 664
                echo ($context["captcha"] ?? null);
                echo "
                                                </div>
                                            </div>

                                            <div class=\"buttons clearfix\">
                                                <div class=\"text-right\">
                                                    <button type=\"button\" id=\"button-review\" data-loading-text=\"";
                // line 670
                echo ($context["text_loading"] ?? null);
                echo "\" class=\"btn btn-outline\">";
                echo ($context["button_continue"] ?? null);
                echo "</button>
                                                </div>
                                            </div>
                                        ";
            } else {
                // line 674
                echo "                                            ";
                echo ($context["text_login"] ?? null);
                echo "
                                        ";
            }
            // line 676
            echo "                                    </form>
                                </div>
                            </div>
                        </div>
                        ";
        }
        // line 680
        echo "<!-- if review-status ends -->

                    </div> <!-- .tab-content ends -->
                </div> <!-- .col-sm-12 ends -->
            </div> <!-- .row ends -->
            <!-- Tabs area ends -->

            ";
        // line 687
        if (($context["full_width_tabs"] ?? null)) {
            // line 688
            echo "        </div>
        ";
        }
        // line 690
        echo "    </div>

    <!-- Related Products -->

    ";
        // line 694
        if (($context["full_width_tabs"] ?? null)) {
            // line 695
            echo "    <div class=\"container\">
        ";
        }
        // line 697
        echo "
        ";
        // line 698
        if (($context["products"] ?? null)) {
            // line 699
            echo "            <div class=\"widget widget-related\">

                <div class=\"widget-title\">
                    <p class=\"main-title\"><span>";
            // line 702
            echo ($context["text_related"] ?? null);
            echo "</span></p>
                    <p class=\"widget-title-separator\"><i class=\"icon-line-cross\"></i></p>
                </div>

                <div class=\"grid grid-holder related carousel grid";
            // line 706
            echo ($context["basel_rel_prod_grid"] ?? null);
            echo "\">
                    ";
            // line 707
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
                // line 708
                echo "                        ";
                $this->loadTemplate("basel/template/product/single_product.twig", "basel/template/product/product.twig", 708)->display($context);
                // line 709
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
            // line 710
            echo "                </div>
            </div>
        ";
        }
        // line 713
        echo "
        ";
        // line 714
        echo ($context["content_bottom"] ?? null);
        echo "

        ";
        // line 716
        if (($context["full_width_tabs"] ?? null)) {
            // line 717
            echo "    </div>
    ";
        }
        // line 719
        echo "

    ";
        // line 721
        if ( !($context["full_width_tabs"] ?? null)) {
            // line 722
            echo "</div> <!-- main column ends -->
";
            // line 723
            echo ($context["column_right"] ?? null);
            echo "
    </div> <!-- .row ends -->
    </div> <!-- .container ends -->
";
        }
        // line 727
        echo "



<script src=\"catalog/view/theme/basel/js/lightgallery/js/lightgallery.min.js\"></script>
<script src=\"catalog/view/theme/basel/js/lightgallery/js/lg-zoom.min.js\"></script>
<script src=\"catalog/view/theme/basel/js/cloudzoom/cloud-zoom.1.0.2.min.js\"></script>
";
        // line 734
        if (($context["basel_price_update"] ?? null)) {
            // line 735
            echo "    <script src=\"index.php?route=extension/basel/live_options/js&product_id=";
            echo ($context["product_id"] ?? null);
            echo "\"></script>
";
        }
        // line 737
        echo "



";
        // line 741
        if (($context["products"] ?? null)) {
            // line 742
            echo "    <script><!--
        \$('.grid-holder.related').slick({
            prevArrow: \"<a class=\\\"arrow-left icon-arrow-left\\\"></a>\",
            nextArrow: \"<a class=\\\"arrow-right icon-arrow-right\\\"></a>\",
            dots:true,
            ";
            // line 747
            if ((($context["direction"] ?? null) == "rtl")) {
                // line 748
                echo "            rtl: true,
            ";
            }
            // line 750
            echo "            respondTo:'min',
            ";
            // line 751
            if ((($context["basel_rel_prod_grid"] ?? null) == "5")) {
                // line 752
                echo "            slidesToShow:5,slidesToScroll:5,responsive:[{breakpoint:1100,settings:{slidesToShow:4,slidesToScroll:4}},{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
                ";
            } elseif ((            // line 753
($context["basel_rel_prod_grid"] ?? null) == "4")) {
                // line 754
                echo "                slidesToShow:4,slidesToScroll:4,responsive:[{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
            ";
            } elseif ((            // line 755
($context["basel_rel_prod_grid"] ?? null) == "3")) {
                // line 756
                echo "            slidesToShow:3,slidesToScroll:3,responsive:[{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
            ";
            } elseif ((            // line 757
($context["basel_rel_prod_grid"] ?? null) == "2")) {
                // line 758
                echo "            slidesToShow:2,slidesToScroll:2,responsive:[
            ";
            }
            // line 760
            echo "            ";
            if (($context["items_mobile_fw"] ?? null)) {
                // line 761
                echo "            {breakpoint:320,settings:{slidesToShow:1,slidesToScroll:1}}
            ";
            }
            // line 763
            echo "        ]
        });
        \$('.product-style2 .single-product .icon').attr('data-placement', 'top');
        \$('[data-toggle=\\'tooltip\\']').tooltip({container: 'body'});
        //--></script>
";
        }
        // line 769
        echo "
";
        // line 770
        if ((($context["sale_end_date"] ?? null) && ($context["product_page_countdown"] ?? null))) {
            // line 771
            echo "    <script>
        \$(function() {
            \$('#special_countdown').countdown('";
            // line 773
            echo ($context["sale_end_date"] ?? null);
            echo "').on('update.countdown', function(event) {
                var \$this = \$(this).html(event.strftime(''
                    + '<div class=\\\"special_countdown\\\"></span><p><span class=\\\"icon-clock\\\"></span> ";
            // line 775
            echo ($context["basel_text_offer_ends"] ?? null);
            echo "</p><div>'
                    + '%D<i>";
            // line 776
            echo ($context["basel_text_days"] ?? null);
            echo "</i></div><div>'
                    + '%H <i>";
            // line 777
            echo ($context["basel_text_hours"] ?? null);
            echo "</i></div><div>'
                    + '%M <i>";
            // line 778
            echo ($context["basel_text_mins"] ?? null);
            echo "</i></div><div>'
                    + '%S <i>";
            // line 779
            echo ($context["basel_text_secs"] ?? null);
            echo "</i></div></div>'));
            });
        });
    </script>
";
        }
        // line 784
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
        // line 978
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
        // line 1007
        if ((($context["product_layout"] ?? null) == "full-width")) {
            // line 1008
            echo "// Sticky information
        \$('.table-cell.right .inner').theiaStickySidebar({containerSelector:'.product-info'});
        ";
        }
        // line 1011
        echo "
// Reviews/Question scroll link
        \$(\".to_tabs\").click(function() {
            \$('html, body').animate({
                scrollTop: (\$(\".main_tabs\").offset().top - 100)
            }, 1000);
        });

// Sharing buttons
        ";
        // line 1020
        if (($context["basel_share_btn"] ?? null)) {
            // line 1021
            echo "        var share_url = encodeURIComponent(window.location.href);
        var page_title = '";
            // line 1022
            echo ($context["heading_title"] ?? null);
            echo "';
        ";
            // line 1023
            if (($context["thumb"] ?? null)) {
                // line 1024
                echo "        var thumb = '";
                echo ($context["thumb"] ?? null);
                echo "';
        ";
            }
            // line 1026
            echo "        \$('.fb_share').attr(\"href\", 'https://www.facebook.com/sharer/sharer.php?u=' + share_url + '');
        \$('.twitter_share').attr(\"href\", 'https://twitter.com/intent/tweet?source=' + share_url + '&text=' + page_title + ': ' + share_url + '');
        \$('.google_share').attr(\"href\", 'https://plus.google.com/share?url=' + share_url + '');
        \$('.pinterest_share').attr(\"href\", 'http://pinterest.com/pin/create/button/?url=' + share_url + '&media=' + thumb + '&description=' + page_title + '');
        \$('.vk_share').attr(\"href\", 'http://vkontakte.ru/share.php?url=' + share_url + '');
        ";
        }
        // line 1032
        echo "    });
    //--></script>

";
        // line 1035
        if ((($context["product_layout"] ?? null) != "full-width")) {
            // line 1036
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
            // line 1046
            if (($context["images"] ?? null)) {
                // line 1047
                echo "            \$('.cloud-zoom-wrap').click(function (e) {
                e.preventDefault();
                \$('.image-additional a.link.active').removeClass('locked').trigger('click').addClass('locked');
            });
            ";
            } else {
                // line 1052
                echo "            \$('.cloud-zoom-wrap').click(function (e) {
                e.preventDefault();
                \$('#main-image').trigger('click');
            });
            ";
            }
            // line 1057
            echo "
            \$('.image-additional').slick({
                prevArrow: \"<a class=\\\"icon-arrow-left\\\"></a>\",
                nextArrow: \"<a class=\\\"icon-arrow-right\\\"></a>\",
                appendArrows: '.image-additional .slick-list',
                arrows:true,
                ";
            // line 1063
            if ((($context["direction"] ?? null) == "rtl")) {
                // line 1064
                echo "                rtl: true,
                ";
            }
            // line 1066
            echo "                infinite:false,
                ";
            // line 1067
            if ((($context["product_layout"] ?? null) == "images-left")) {
                // line 1068
                echo "                slidesToShow: ";
                echo twig_round((($context["img_h"] ?? null) / ($context["img_a_h"] ?? null)), 0, "floor");
                echo ",
                vertical:true,
                verticalSwiping:true,
                ";
            } else {
                // line 1072
                echo "                slidesToShow: ";
                echo twig_round((($context["img_w"] ?? null) / ($context["img_a_w"] ?? null)));
                echo ",
                ";
            }
            // line 1074
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
        // line 1087
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
        // line 1116
        if ((($context["poip_installed"]) ?? (false))) {
            // line 1117
            echo "\t\t\t\t\t";
            echo (($context["poip_theme_script"]) ?? (""));
            echo "
\t\t\t\t\t";
            // line 1118
            echo (($context["poip_script"]) ?? (""));
            echo "
\t\t\t\t";
        }
        // line 1120
        echo "\t\t\t\t<!-- >> Product Option Image PRO module -->
\t\t\t";
        // line 1121
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
        return array (  2410 => 1121,  2407 => 1120,  2402 => 1118,  2397 => 1117,  2395 => 1116,  2364 => 1087,  2349 => 1074,  2343 => 1072,  2335 => 1068,  2333 => 1067,  2330 => 1066,  2326 => 1064,  2324 => 1063,  2316 => 1057,  2309 => 1052,  2302 => 1047,  2300 => 1046,  2288 => 1036,  2286 => 1035,  2281 => 1032,  2273 => 1026,  2267 => 1024,  2265 => 1023,  2261 => 1022,  2258 => 1021,  2256 => 1020,  2245 => 1011,  2240 => 1008,  2238 => 1007,  2206 => 978,  2010 => 784,  2002 => 779,  1998 => 778,  1994 => 777,  1990 => 776,  1986 => 775,  1981 => 773,  1977 => 771,  1975 => 770,  1972 => 769,  1964 => 763,  1960 => 761,  1957 => 760,  1953 => 758,  1951 => 757,  1948 => 756,  1946 => 755,  1943 => 754,  1941 => 753,  1938 => 752,  1936 => 751,  1933 => 750,  1929 => 748,  1927 => 747,  1920 => 742,  1918 => 741,  1912 => 737,  1906 => 735,  1904 => 734,  1895 => 727,  1888 => 723,  1885 => 722,  1883 => 721,  1879 => 719,  1875 => 717,  1873 => 716,  1868 => 714,  1865 => 713,  1860 => 710,  1846 => 709,  1843 => 708,  1826 => 707,  1822 => 706,  1815 => 702,  1810 => 699,  1808 => 698,  1805 => 697,  1801 => 695,  1799 => 694,  1793 => 690,  1789 => 688,  1787 => 687,  1778 => 680,  1771 => 676,  1765 => 674,  1756 => 670,  1747 => 664,  1738 => 658,  1733 => 656,  1725 => 651,  1721 => 650,  1697 => 629,  1692 => 626,  1690 => 625,  1686 => 624,  1678 => 618,  1672 => 616,  1669 => 615,  1663 => 613,  1660 => 612,  1650 => 608,  1642 => 603,  1635 => 601,  1630 => 598,  1625 => 597,  1623 => 596,  1617 => 593,  1612 => 590,  1610 => 589,  1607 => 588,  1601 => 585,  1598 => 584,  1596 => 583,  1591 => 580,  1588 => 579,  1579 => 576,  1574 => 575,  1569 => 574,  1567 => 573,  1560 => 568,  1555 => 565,  1548 => 563,  1539 => 560,  1535 => 559,  1532 => 558,  1528 => 557,  1520 => 551,  1516 => 550,  1512 => 548,  1510 => 547,  1503 => 542,  1494 => 538,  1491 => 537,  1489 => 536,  1477 => 526,  1469 => 524,  1466 => 523,  1460 => 521,  1458 => 520,  1455 => 519,  1449 => 517,  1447 => 516,  1444 => 515,  1441 => 514,  1430 => 512,  1425 => 511,  1423 => 510,  1417 => 507,  1412 => 505,  1405 => 500,  1401 => 498,  1396 => 495,  1394 => 494,  1391 => 493,  1384 => 489,  1381 => 488,  1379 => 487,  1365 => 475,  1346 => 473,  1344 => 472,  1341 => 471,  1333 => 469,  1331 => 468,  1324 => 466,  1321 => 465,  1311 => 463,  1309 => 462,  1306 => 461,  1296 => 458,  1293 => 457,  1281 => 454,  1278 => 453,  1276 => 452,  1271 => 450,  1266 => 448,  1263 => 447,  1255 => 445,  1253 => 444,  1245 => 438,  1239 => 436,  1237 => 435,  1231 => 434,  1225 => 433,  1218 => 428,  1212 => 426,  1210 => 425,  1204 => 421,  1201 => 420,  1193 => 416,  1190 => 415,  1182 => 409,  1174 => 407,  1167 => 405,  1164 => 404,  1162 => 403,  1157 => 401,  1146 => 399,  1141 => 396,  1139 => 395,  1136 => 394,  1130 => 390,  1119 => 388,  1115 => 387,  1111 => 386,  1105 => 383,  1102 => 382,  1100 => 381,  1095 => 378,  1085 => 370,  1078 => 369,  1064 => 362,  1055 => 358,  1047 => 356,  1045 => 355,  1042 => 354,  1028 => 347,  1019 => 343,  1011 => 341,  1009 => 340,  1006 => 339,  992 => 332,  983 => 328,  975 => 326,  973 => 325,  970 => 324,  967 => 323,  961 => 321,  958 => 320,  955 => 319,  942 => 315,  934 => 312,  926 => 310,  924 => 309,  921 => 308,  908 => 304,  900 => 301,  892 => 299,  890 => 298,  886 => 296,  880 => 292,  871 => 288,  864 => 286,  862 => 285,  858 => 284,  855 => 283,  833 => 281,  831 => 280,  828 => 279,  819 => 277,  817 => 276,  810 => 274,  802 => 272,  798 => 271,  794 => 270,  788 => 267,  780 => 265,  778 => 264,  775 => 263,  768 => 258,  755 => 250,  750 => 247,  743 => 245,  741 => 244,  737 => 243,  734 => 242,  719 => 239,  717 => 238,  708 => 236,  702 => 235,  699 => 234,  695 => 233,  690 => 231,  682 => 228,  674 => 226,  672 => 225,  669 => 224,  663 => 220,  654 => 216,  647 => 214,  645 => 213,  641 => 212,  638 => 211,  616 => 209,  614 => 208,  608 => 207,  600 => 205,  596 => 204,  592 => 203,  586 => 200,  578 => 198,  576 => 197,  573 => 196,  567 => 192,  560 => 190,  553 => 188,  551 => 187,  544 => 186,  540 => 185,  536 => 184,  530 => 183,  522 => 180,  514 => 178,  512 => 177,  509 => 176,  505 => 175,  502 => 174,  500 => 173,  494 => 169,  488 => 167,  486 => 166,  481 => 163,  477 => 162,  473 => 160,  461 => 158,  457 => 157,  454 => 156,  452 => 155,  449 => 154,  441 => 152,  439 => 151,  428 => 142,  416 => 138,  408 => 136,  406 => 135,  403 => 134,  401 => 133,  398 => 132,  393 => 130,  386 => 126,  383 => 125,  381 => 124,  373 => 121,  366 => 116,  359 => 111,  355 => 109,  341 => 107,  338 => 106,  317 => 103,  314 => 102,  310 => 101,  307 => 100,  305 => 99,  302 => 98,  280 => 95,  277 => 94,  271 => 92,  269 => 91,  266 => 90,  260 => 88,  258 => 87,  255 => 86,  249 => 84,  247 => 83,  243 => 81,  241 => 80,  233 => 78,  231 => 77,  222 => 71,  217 => 70,  214 => 69,  211 => 68,  208 => 67,  205 => 66,  202 => 65,  199 => 64,  197 => 63,  193 => 62,  188 => 60,  184 => 58,  173 => 56,  169 => 55,  165 => 53,  159 => 49,  153 => 47,  148 => 45,  143 => 44,  141 => 43,  135 => 40,  131 => 38,  125 => 36,  119 => 34,  117 => 33,  112 => 30,  106 => 28,  104 => 27,  100 => 25,  94 => 23,  89 => 21,  84 => 20,  82 => 19,  76 => 16,  72 => 14,  66 => 12,  60 => 10,  58 => 9,  54 => 7,  52 => 6,  48 => 4,  42 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/product/product.twig", "");
    }
}
