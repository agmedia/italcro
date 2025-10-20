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

/* default/template/extension/module/tf_filter.twig */
class __TwigTemplate_aad7a51e6a61a74e5a4b36878ca2e9836a8ae9f214f0d255dd54d303b87eeeae extends \Twig\Template
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
        echo "<div id=\"tf-filter-";
        echo ($context["module_class_id"] ?? null);
        echo "\" class=\"panel tf-filter panel-default filter-container\">
  <div data-toggle=\"collapse\" href=\"#tf-filter-content-";
        // line 2
        echo ($context["module_class_id"] ?? null);
        echo "\" class=\"panel-heading";
        echo ((($context["collapsed"] ?? null)) ? (" collapsed") : (""));
        echo "\">
    <h4 class=\"panel-title\">";
        // line 3
        echo ($context["heading_title"] ?? null);
        echo "</h4>
    ";
        // line 4
        if (($context["reset_all"] ?? null)) {
            // line 5
            echo "      <span data-tf-reset=\"all\" data-toggle=\"tooltip\" title=\"";
            echo ($context["text_reset_all"] ?? null);
            echo "\" class=\"tf-filter-reset hide text-danger\"><i class=\"fa fa-times\"></i></span>
    ";
        }
        // line 7
        echo "    <i class=\"fa fa-chevron-circle-down\" aria-hidden=\"true\"></i>
  </div>
  <div id=\"tf-filter-content-";
        // line 9
        echo ($context["module_class_id"] ?? null);
        echo "\" data-tf-base-z-index=\"99\" class=\"collapse";
        echo (( !($context["collapsed"] ?? null)) ? (" in") : (""));
        echo " tf-list-filter-group row\">
    ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["filters"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["filter"]) {
            // line 11
            echo "      ";
            if (((($__internal_compile_0 = $context["filter"]) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["type"] ?? null) : null) == "price")) {
                echo " ";
                // line 12
                echo "        <div class=\"tf-filter-group ";
                echo twig_get_attribute($this->env, $this->source, $context["filter"], "type", [], "any", false, false, false, 12);
                echo " col-xs-";
                echo twig_round((12 / ($context["column_xs"] ?? null)), 0, "ceil");
                echo " col-sm-";
                echo twig_round((12 / ($context["column_sm"] ?? null)), 0, "ceil");
                echo " col-md-";
                echo twig_round((12 / ($context["column_md"] ?? null)), 0, "ceil");
                echo " col-lg-";
                echo twig_round((12 / ($context["column_lg"] ?? null)), 0, "ceil");
                echo "\">
          <div class=\"tf-filter-group-header ";
                // line 13
                echo (((($__internal_compile_1 = $context["filter"]) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["collapse"] ?? null) : null)) ? ("collapsed") : (""));
                echo "\" data-toggle=\"collapse\" href=\"#tf-filter-panel-";
                echo ($context["module_class_id"] ?? null);
                echo "-";
                echo $context["key"];
                echo "\">
            <span class=\"tf-filter-group-title\">";
                // line 14
                echo ($context["text_price"] ?? null);
                echo "</span>
            ";
                // line 15
                if (($context["reset_group"] ?? null)) {
                    // line 16
                    echo "              ";
                    if ((((($__internal_compile_2 = (($__internal_compile_3 = $context["filter"]) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["selected"] ?? null) : null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["min"] ?? null) : null) != (($__internal_compile_4 = $context["filter"]) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["min_price"] ?? null) : null)) || ((($__internal_compile_5 = (($__internal_compile_6 = $context["filter"]) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["selected"] ?? null) : null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["max"] ?? null) : null) != (($__internal_compile_7 = $context["filter"]) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["max_price"] ?? null) : null)))) {
                        // line 17
                        echo "                <a data-tf-reset=\"price\" data-toggle=\"tooltip\" title=\"";
                        echo ($context["text_reset"] ?? null);
                        echo "\" class=\"tf-filter-reset\"><i class=\"fa fa-times\"></i></a>
              ";
                    } else {
                        // line 19
                        echo "                <a data-tf-reset=\"price\" data-toggle=\"tooltip\" title=\"";
                        echo ($context["text_reset"] ?? null);
                        echo "\" class=\"tf-filter-reset hide\"><i class=\"fa fa-times\"></i></a>
              ";
                    }
                    // line 21
                    echo "            ";
                }
                // line 22
                echo "            <i class=\"fa fa-caret-up toggle-icon\"></i>
          </div>
          <div id=\"tf-filter-panel-";
                // line 24
                echo ($context["module_class_id"] ?? null);
                echo "-";
                echo $context["key"];
                echo "\" class=\"collapse ";
                echo (( !(($__internal_compile_8 = $context["filter"]) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["collapse"] ?? null) : null)) ? ("in") : (""));
                echo "\" >
            <div class=\"tf-filter-group-content\">
              <div data-role=\"rangeslider\"></div>
              <div class=\"row\">
                <div class=\"col-xs-6\"><input type=\"number\" class=\"form-control\" name=\"tf_fp[min]\" value=\"";
                // line 28
                echo (($__internal_compile_9 = (($__internal_compile_10 = $context["filter"]) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["selected"] ?? null) : null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["min"] ?? null) : null);
                echo "\" min=\"";
                echo (($__internal_compile_11 = $context["filter"]) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["min_price"] ?? null) : null);
                echo "\" max=\"";
                echo ((($__internal_compile_12 = $context["filter"]) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["max_price"] ?? null) : null) - 1);
                echo "\" /></div>
                <div class=\"col-xs-6\"><input type=\"number\" class=\"form-control\" name=\"tf_fp[max]\" value=\"";
                // line 29
                echo (($__internal_compile_13 = (($__internal_compile_14 = $context["filter"]) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["selected"] ?? null) : null)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["max"] ?? null) : null);
                echo "\" min=\"";
                echo ((($__internal_compile_15 = $context["filter"]) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["min_price"] ?? null) : null) + 1);
                echo "\" max=\"";
                echo (($__internal_compile_16 = $context["filter"]) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16["max_price"] ?? null) : null);
                echo "\" /></div>
              </div>
            </div>
          </div>
        </div>

      ";
            } elseif ((((($__internal_compile_17 =             // line 35
$context["filter"]) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["type"] ?? null) : null) == "sub_category") && (($__internal_compile_18 = $context["filter"]) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18["values"] ?? null) : null))) {
                echo " ";
                // line 36
                echo "        <div class=\"tf-filter-group ";
                echo twig_get_attribute($this->env, $this->source, $context["filter"], "type", [], "any", false, false, false, 36);
                echo " ";
                echo (((($context["hide_zero_filter"] ?? null) &&  !twig_get_attribute($this->env, $this->source, $context["filter"], "status", [], "any", false, false, false, 36))) ? ("hide") : (""));
                echo " col-xs-";
                echo twig_round((12 / ($context["column_xs"] ?? null)), 0, "ceil");
                echo " col-sm-";
                echo twig_round((12 / ($context["column_sm"] ?? null)), 0, "ceil");
                echo " col-md-";
                echo twig_round((12 / ($context["column_md"] ?? null)), 0, "ceil");
                echo " col-lg-";
                echo twig_round((12 / ($context["column_lg"] ?? null)), 0, "ceil");
                echo "\">
          <div class=\"tf-filter-group-header ";
                // line 37
                echo (((($__internal_compile_19 = $context["filter"]) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19["collapse"] ?? null) : null)) ? ("collapsed") : (""));
                echo "\" data-toggle=\"collapse\" href=\"#tf-filter-panel-";
                echo ($context["module_class_id"] ?? null);
                echo "-";
                echo $context["key"];
                echo "\">
            <span class=\"tf-filter-group-title\">";
                // line 38
                echo ($context["text_sub_category"] ?? null);
                echo "</span>
            ";
                // line 39
                if (($context["reset_group"] ?? null)) {
                    // line 40
                    echo "              ";
                    $context["total_selected"] = 0;
                    // line 41
                    echo "              ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable((($__internal_compile_20 = $context["filter"]) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20["values"] ?? null) : null));
                    foreach ($context['_seq'] as $context["_key"] => $context["sub_category"]) {
                        if ((($__internal_compile_21 = $context["sub_category"]) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21["selected"] ?? null) : null)) {
                            $context["total_selected"] = (($context["total_selected"] ?? null) + 1);
                        }
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sub_category'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 42
                    echo "              <a data-tf-reset=\"check\" data-toggle=\"tooltip\" title=\"";
                    echo ($context["text_reset"] ?? null);
                    echo "\" class=\" tf-filter-reset";
                    echo (( !($context["total_selected"] ?? null)) ? (" hide") : (""));
                    echo "\"><i class=\"fa fa-times\"></i></a>
            ";
                }
                // line 44
                echo "            <i class=\"fa fa-caret-up toggle-icon\"></i>
          </div>
          <div id=\"tf-filter-panel-";
                // line 46
                echo ($context["module_class_id"] ?? null);
                echo "-";
                echo $context["key"];
                echo "\" class=\"collapse ";
                echo (( !(($__internal_compile_22 = $context["filter"]) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22["collapse"] ?? null) : null)) ? ("in") : (""));
                echo "\" >
            ";
                // line 47
                if ((($__internal_compile_23 = $context["filter"]) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23["search"] ?? null) : null)) {
                    // line 48
                    echo "              <div class=\"tf-filter-group-search\"><i class=\"fa fa-search\"></i> <input type=\"search\" placeholder=\"";
                    echo ($context["text_search"] ?? null);
                    echo "\"/></div>
            ";
                }
                // line 50
                echo "            <div class=\"tf-filter-group-content ";
                echo ($context["overflow"] ?? null);
                echo "\">
              ";
                // line 51
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((($__internal_compile_24 = $context["filter"]) && is_array($__internal_compile_24) || $__internal_compile_24 instanceof ArrayAccess ? ($__internal_compile_24["values"] ?? null) : null));
                foreach ($context['_seq'] as $context["_key"] => $context["sub_category"]) {
                    // line 52
                    echo "                <div class=\"form-check tf-filter-value ";
                    echo (((($context["hide_zero_filter"] ?? null) &&  !twig_get_attribute($this->env, $this->source, $context["sub_category"], "status", [], "any", false, false, false, 52))) ? ("hide") : (""));
                    echo " custom-";
                    echo (($__internal_compile_25 = $context["filter"]) && is_array($__internal_compile_25) || $__internal_compile_25 instanceof ArrayAccess ? ($__internal_compile_25["input_type"] ?? null) : null);
                    echo " ";
                    echo (($__internal_compile_26 = $context["filter"]) && is_array($__internal_compile_26) || $__internal_compile_26 instanceof ArrayAccess ? ($__internal_compile_26["list_type"] ?? null) : null);
                    echo "\">
                  <label class=\"form-check-label\">
                    ";
                    // line 54
                    if ((($__internal_compile_27 = $context["sub_category"]) && is_array($__internal_compile_27) || $__internal_compile_27 instanceof ArrayAccess ? ($__internal_compile_27["selected"] ?? null) : null)) {
                        // line 55
                        echo "                      <input type=\"";
                        echo (($__internal_compile_28 = $context["filter"]) && is_array($__internal_compile_28) || $__internal_compile_28 instanceof ArrayAccess ? ($__internal_compile_28["input_type"] ?? null) : null);
                        echo "\" name=\"tf_fsc\" value=\"";
                        echo (($__internal_compile_29 = $context["sub_category"]) && is_array($__internal_compile_29) || $__internal_compile_29 instanceof ArrayAccess ? ($__internal_compile_29["category_id"] ?? null) : null);
                        echo "\" class=\"form-check-input\" checked>
                    ";
                    } else {
                        // line 57
                        echo "                      <input type=\"";
                        echo (($__internal_compile_30 = $context["filter"]) && is_array($__internal_compile_30) || $__internal_compile_30 instanceof ArrayAccess ? ($__internal_compile_30["input_type"] ?? null) : null);
                        echo "\" name=\"tf_fsc\" value=\"";
                        echo (($__internal_compile_31 = $context["sub_category"]) && is_array($__internal_compile_31) || $__internal_compile_31 instanceof ArrayAccess ? ($__internal_compile_31["category_id"] ?? null) : null);
                        echo "\" class=\"form-check-input\" ";
                        echo (( !(($__internal_compile_32 = $context["sub_category"]) && is_array($__internal_compile_32) || $__internal_compile_32 instanceof ArrayAccess ? ($__internal_compile_32["status"] ?? null) : null)) ? ("disabled") : (""));
                        echo ">
                    ";
                    }
                    // line 59
                    echo "                    ";
                    if ((((($__internal_compile_33 = $context["filter"]) && is_array($__internal_compile_33) || $__internal_compile_33 instanceof ArrayAccess ? ($__internal_compile_33["list_type"] ?? null) : null) == "image") || ((($__internal_compile_34 = $context["filter"]) && is_array($__internal_compile_34) || $__internal_compile_34 instanceof ArrayAccess ? ($__internal_compile_34["list_type"] ?? null) : null) == "both"))) {
                        // line 60
                        echo "                      <img src=\"";
                        echo (($__internal_compile_35 = $context["sub_category"]) && is_array($__internal_compile_35) || $__internal_compile_35 instanceof ArrayAccess ? ($__internal_compile_35["image"] ?? null) : null);
                        echo "\" title=\"";
                        echo (($__internal_compile_36 = $context["sub_category"]) && is_array($__internal_compile_36) || $__internal_compile_36 instanceof ArrayAccess ? ($__internal_compile_36["name"] ?? null) : null);
                        echo "\" alt=\"";
                        echo (($__internal_compile_37 = $context["sub_category"]) && is_array($__internal_compile_37) || $__internal_compile_37 instanceof ArrayAccess ? ($__internal_compile_37["name"] ?? null) : null);
                        echo "\" />
                    ";
                    } else {
                        // line 62
                        echo "                      <span class=\"checkmark fa\"></span>
                    ";
                    }
                    // line 64
                    echo "                    ";
                    if ((((($__internal_compile_38 = $context["filter"]) && is_array($__internal_compile_38) || $__internal_compile_38 instanceof ArrayAccess ? ($__internal_compile_38["list_type"] ?? null) : null) == "text") || ((($__internal_compile_39 = $context["filter"]) && is_array($__internal_compile_39) || $__internal_compile_39 instanceof ArrayAccess ? ($__internal_compile_39["list_type"] ?? null) : null) == "both"))) {
                        // line 65
                        echo "                      ";
                        echo (($__internal_compile_40 = $context["sub_category"]) && is_array($__internal_compile_40) || $__internal_compile_40 instanceof ArrayAccess ? ($__internal_compile_40["name"] ?? null) : null);
                        echo "
                    ";
                    }
                    // line 67
                    echo "                  </label>
                  ";
                    // line 68
                    if ((($context["count_product"] ?? null) && ((($__internal_compile_41 = $context["filter"]) && is_array($__internal_compile_41) || $__internal_compile_41 instanceof ArrayAccess ? ($__internal_compile_41["list_type"] ?? null) : null) != "image"))) {
                        // line 69
                        echo "                    ";
                        if ((($__internal_compile_42 = $context["sub_category"]) && is_array($__internal_compile_42) || $__internal_compile_42 instanceof ArrayAccess ? ($__internal_compile_42["total"] ?? null) : null)) {
                            // line 70
                            echo "                      <span class=\"label label-info tf-product-total\">";
                            echo (($__internal_compile_43 = $context["sub_category"]) && is_array($__internal_compile_43) || $__internal_compile_43 instanceof ArrayAccess ? ($__internal_compile_43["total"] ?? null) : null);
                            echo "</span>
                    ";
                        } else {
                            // line 72
                            echo "                      <span class=\"label label-info label-danger tf-product-total\">";
                            echo (($__internal_compile_44 = $context["sub_category"]) && is_array($__internal_compile_44) || $__internal_compile_44 instanceof ArrayAccess ? ($__internal_compile_44["total"] ?? null) : null);
                            echo "</span>
                    ";
                        }
                        // line 74
                        echo "                  ";
                    }
                    // line 75
                    echo "                </div>
              ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sub_category'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 77
                echo "              ";
                if (((($context["overflow"] ?? null) == "more") && (twig_length_filter($this->env, (($__internal_compile_45 = $context["filter"]) && is_array($__internal_compile_45) || $__internal_compile_45 instanceof ArrayAccess ? ($__internal_compile_45["values"] ?? null) : null)) >= 7))) {
                    // line 78
                    echo "                <a class=\"tf-see-more btn-link\" data-toggle=\"tf-seemore\" data-show=\"";
                    echo ($context["text_see_more"] ?? null);
                    echo "\" data-hide=\"";
                    echo ($context["text_see_less"] ?? null);
                    echo "\" href=\"#\">";
                    echo ($context["text_see_more"] ?? null);
                    echo "</a>
              ";
                }
                // line 80
                echo "            </div>
          </div>
        </div>

      ";
            } elseif ((((($__internal_compile_46 =             // line 84
$context["filter"]) && is_array($__internal_compile_46) || $__internal_compile_46 instanceof ArrayAccess ? ($__internal_compile_46["type"] ?? null) : null) == "manufacturer") && (($__internal_compile_47 = $context["filter"]) && is_array($__internal_compile_47) || $__internal_compile_47 instanceof ArrayAccess ? ($__internal_compile_47["values"] ?? null) : null))) {
                echo " ";
                // line 85
                echo "        <div class=\"tf-filter-group ";
                echo twig_get_attribute($this->env, $this->source, $context["filter"], "type", [], "any", false, false, false, 85);
                echo " ";
                echo (((($context["hide_zero_filter"] ?? null) &&  !twig_get_attribute($this->env, $this->source, $context["filter"], "status", [], "any", false, false, false, 85))) ? ("hide") : (""));
                echo " col-xs-";
                echo twig_round((12 / ($context["column_xs"] ?? null)), 0, "ceil");
                echo " col-sm-";
                echo twig_round((12 / ($context["column_sm"] ?? null)), 0, "ceil");
                echo " col-md-";
                echo twig_round((12 / ($context["column_md"] ?? null)), 0, "ceil");
                echo " col-lg-";
                echo twig_round((12 / ($context["column_lg"] ?? null)), 0, "ceil");
                echo "\">
          <div class=\"tf-filter-group-header ";
                // line 86
                echo (((($__internal_compile_48 = $context["filter"]) && is_array($__internal_compile_48) || $__internal_compile_48 instanceof ArrayAccess ? ($__internal_compile_48["collapse"] ?? null) : null)) ? ("collapsed") : (""));
                echo "\" data-toggle=\"collapse\" href=\"#tf-filter-panel-";
                echo ($context["module_class_id"] ?? null);
                echo "-";
                echo $context["key"];
                echo "\">
            <span class=\"tf-filter-group-title\">";
                // line 87
                echo ($context["text_manufacturer"] ?? null);
                echo "</span>
            ";
                // line 88
                if (($context["reset_group"] ?? null)) {
                    // line 89
                    echo "              ";
                    $context["total_selected"] = 0;
                    // line 90
                    echo "              ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable((($__internal_compile_49 = $context["filter"]) && is_array($__internal_compile_49) || $__internal_compile_49 instanceof ArrayAccess ? ($__internal_compile_49["values"] ?? null) : null));
                    foreach ($context['_seq'] as $context["_key"] => $context["manufacturer"]) {
                        if ((($__internal_compile_50 = $context["manufacturer"]) && is_array($__internal_compile_50) || $__internal_compile_50 instanceof ArrayAccess ? ($__internal_compile_50["selected"] ?? null) : null)) {
                            $context["total_selected"] = (($context["total_selected"] ?? null) + 1);
                        }
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['manufacturer'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 91
                    echo "              <a data-tf-reset=\"check\" data-toggle=\"tooltip\" title=\"";
                    echo ($context["text_reset"] ?? null);
                    echo "\" class=\" tf-filter-reset";
                    echo (( !($context["total_selected"] ?? null)) ? (" hide") : (""));
                    echo "\"><i class=\"fa fa-times\"></i></a>
            ";
                }
                // line 93
                echo "            <i class=\"fa fa-caret-up toggle-icon\"></i>
          </div>
          <div id=\"tf-filter-panel-";
                // line 95
                echo ($context["module_class_id"] ?? null);
                echo "-";
                echo $context["key"];
                echo "\" class=\"collapse ";
                echo (( !(($__internal_compile_51 = $context["filter"]) && is_array($__internal_compile_51) || $__internal_compile_51 instanceof ArrayAccess ? ($__internal_compile_51["collapse"] ?? null) : null)) ? ("in") : (""));
                echo "\" >
            ";
                // line 96
                if ((($__internal_compile_52 = $context["filter"]) && is_array($__internal_compile_52) || $__internal_compile_52 instanceof ArrayAccess ? ($__internal_compile_52["search"] ?? null) : null)) {
                    // line 97
                    echo "              <div class=\"tf-filter-group-search\"><i class=\"fa fa-search\"></i> <input type=\"search\" placeholder=\"";
                    echo ($context["text_search"] ?? null);
                    echo "\"/></div>
            ";
                }
                // line 99
                echo "            <div class=\"tf-filter-group-content ";
                echo ($context["overflow"] ?? null);
                echo "\">
              ";
                // line 100
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((($__internal_compile_53 = $context["filter"]) && is_array($__internal_compile_53) || $__internal_compile_53 instanceof ArrayAccess ? ($__internal_compile_53["values"] ?? null) : null));
                foreach ($context['_seq'] as $context["_key"] => $context["manufacturer"]) {
                    // line 101
                    echo "                <div class=\"form-check tf-filter-value ";
                    echo (((($context["hide_zero_filter"] ?? null) &&  !twig_get_attribute($this->env, $this->source, $context["manufacturer"], "status", [], "any", false, false, false, 101))) ? ("hide") : (""));
                    echo " custom-";
                    echo (($__internal_compile_54 = $context["filter"]) && is_array($__internal_compile_54) || $__internal_compile_54 instanceof ArrayAccess ? ($__internal_compile_54["input_type"] ?? null) : null);
                    echo " ";
                    echo (($__internal_compile_55 = $context["filter"]) && is_array($__internal_compile_55) || $__internal_compile_55 instanceof ArrayAccess ? ($__internal_compile_55["list_type"] ?? null) : null);
                    echo "\">
                  <label class=\"form-check-label\">
                    ";
                    // line 103
                    if ((($__internal_compile_56 = $context["manufacturer"]) && is_array($__internal_compile_56) || $__internal_compile_56 instanceof ArrayAccess ? ($__internal_compile_56["selected"] ?? null) : null)) {
                        // line 104
                        echo "                      <input type=\"";
                        echo (($__internal_compile_57 = $context["filter"]) && is_array($__internal_compile_57) || $__internal_compile_57 instanceof ArrayAccess ? ($__internal_compile_57["input_type"] ?? null) : null);
                        echo "\" name=\"tf_fm\" value=\"";
                        echo (($__internal_compile_58 = $context["manufacturer"]) && is_array($__internal_compile_58) || $__internal_compile_58 instanceof ArrayAccess ? ($__internal_compile_58["manufacturer_id"] ?? null) : null);
                        echo "\" class=\"form-check-input\" checked>
                    ";
                    } else {
                        // line 106
                        echo "                      <input type=\"";
                        echo (($__internal_compile_59 = $context["filter"]) && is_array($__internal_compile_59) || $__internal_compile_59 instanceof ArrayAccess ? ($__internal_compile_59["input_type"] ?? null) : null);
                        echo "\" name=\"tf_fm\" value=\"";
                        echo (($__internal_compile_60 = $context["manufacturer"]) && is_array($__internal_compile_60) || $__internal_compile_60 instanceof ArrayAccess ? ($__internal_compile_60["manufacturer_id"] ?? null) : null);
                        echo "\" class=\"form-check-input\" ";
                        echo (( !(($__internal_compile_61 = $context["manufacturer"]) && is_array($__internal_compile_61) || $__internal_compile_61 instanceof ArrayAccess ? ($__internal_compile_61["status"] ?? null) : null)) ? ("disabled") : (""));
                        echo ">
                    ";
                    }
                    // line 108
                    echo "                    ";
                    if ((((($__internal_compile_62 = $context["filter"]) && is_array($__internal_compile_62) || $__internal_compile_62 instanceof ArrayAccess ? ($__internal_compile_62["list_type"] ?? null) : null) == "image") || ((($__internal_compile_63 = $context["filter"]) && is_array($__internal_compile_63) || $__internal_compile_63 instanceof ArrayAccess ? ($__internal_compile_63["list_type"] ?? null) : null) == "both"))) {
                        // line 109
                        echo "                      <img src=\"";
                        echo (($__internal_compile_64 = $context["manufacturer"]) && is_array($__internal_compile_64) || $__internal_compile_64 instanceof ArrayAccess ? ($__internal_compile_64["image"] ?? null) : null);
                        echo "\" title=\"";
                        echo (($__internal_compile_65 = $context["manufacturer"]) && is_array($__internal_compile_65) || $__internal_compile_65 instanceof ArrayAccess ? ($__internal_compile_65["name"] ?? null) : null);
                        echo "\" alt=\"";
                        echo (($__internal_compile_66 = $context["manufacturer"]) && is_array($__internal_compile_66) || $__internal_compile_66 instanceof ArrayAccess ? ($__internal_compile_66["name"] ?? null) : null);
                        echo "\" />
                    ";
                    } else {
                        // line 111
                        echo "                      <span class=\"checkmark fa\"></span>
                    ";
                    }
                    // line 113
                    echo "                    ";
                    if ((((($__internal_compile_67 = $context["filter"]) && is_array($__internal_compile_67) || $__internal_compile_67 instanceof ArrayAccess ? ($__internal_compile_67["list_type"] ?? null) : null) == "text") || ((($__internal_compile_68 = $context["filter"]) && is_array($__internal_compile_68) || $__internal_compile_68 instanceof ArrayAccess ? ($__internal_compile_68["list_type"] ?? null) : null) == "both"))) {
                        // line 114
                        echo "                      ";
                        echo (($__internal_compile_69 = $context["manufacturer"]) && is_array($__internal_compile_69) || $__internal_compile_69 instanceof ArrayAccess ? ($__internal_compile_69["name"] ?? null) : null);
                        echo "
                    ";
                    }
                    // line 116
                    echo "                  </label>
                  ";
                    // line 117
                    if ((($context["count_product"] ?? null) && ((($__internal_compile_70 = $context["filter"]) && is_array($__internal_compile_70) || $__internal_compile_70 instanceof ArrayAccess ? ($__internal_compile_70["list_type"] ?? null) : null) != "image"))) {
                        // line 118
                        echo "                    ";
                        if ((($__internal_compile_71 = $context["manufacturer"]) && is_array($__internal_compile_71) || $__internal_compile_71 instanceof ArrayAccess ? ($__internal_compile_71["total"] ?? null) : null)) {
                            // line 119
                            echo "                      <span class=\"label label-info tf-product-total\">";
                            echo (($__internal_compile_72 = $context["manufacturer"]) && is_array($__internal_compile_72) || $__internal_compile_72 instanceof ArrayAccess ? ($__internal_compile_72["total"] ?? null) : null);
                            echo "</span>
                    ";
                        } else {
                            // line 121
                            echo "                      <span class=\"label label-info label-danger tf-product-total\">";
                            echo (($__internal_compile_73 = $context["manufacturer"]) && is_array($__internal_compile_73) || $__internal_compile_73 instanceof ArrayAccess ? ($__internal_compile_73["total"] ?? null) : null);
                            echo "</span>
                    ";
                        }
                        // line 123
                        echo "                  ";
                    }
                    // line 124
                    echo "                </div>
              ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['manufacturer'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 126
                echo "              ";
                if (((($context["overflow"] ?? null) == "more") && (twig_length_filter($this->env, (($__internal_compile_74 = $context["filter"]) && is_array($__internal_compile_74) || $__internal_compile_74 instanceof ArrayAccess ? ($__internal_compile_74["values"] ?? null) : null)) >= 7))) {
                    // line 127
                    echo "                <a class=\"tf-see-more btn-link\" data-toggle=\"tf-seemore\" data-show=\"";
                    echo ($context["text_see_more"] ?? null);
                    echo "\" data-hide=\"";
                    echo ($context["text_see_less"] ?? null);
                    echo "\" href=\"#\">";
                    echo ($context["text_see_more"] ?? null);
                    echo "</a>
              ";
                }
                // line 129
                echo "            </div>
          </div>
        </div>
      ";
            } elseif (((($__internal_compile_75 =             // line 132
$context["filter"]) && is_array($__internal_compile_75) || $__internal_compile_75 instanceof ArrayAccess ? ($__internal_compile_75["type"] ?? null) : null) == "search")) {
                echo " ";
                // line 133
                echo "        <div class=\"tf-filter-group ";
                echo twig_get_attribute($this->env, $this->source, $context["filter"], "type", [], "any", false, false, false, 133);
                echo " col-xs-";
                echo twig_round((12 / ($context["column_xs"] ?? null)), 0, "ceil");
                echo " col-sm-";
                echo twig_round((12 / ($context["column_sm"] ?? null)), 0, "ceil");
                echo " col-md-";
                echo twig_round((12 / ($context["column_md"] ?? null)), 0, "ceil");
                echo " col-lg-";
                echo twig_round((12 / ($context["column_lg"] ?? null)), 0, "ceil");
                echo "\">
          <div class=\"tf-filter-group-header ";
                // line 134
                echo (((($__internal_compile_76 = $context["filter"]) && is_array($__internal_compile_76) || $__internal_compile_76 instanceof ArrayAccess ? ($__internal_compile_76["collapse"] ?? null) : null)) ? ("collapsed") : (""));
                echo "\" data-toggle=\"collapse\" href=\"#tf-filter-panel-";
                echo ($context["module_class_id"] ?? null);
                echo "-";
                echo $context["key"];
                echo "\">
            <span  class=\"tf-filter-group-title\">";
                // line 135
                echo ($context["text_search"] ?? null);
                echo "</span>
            ";
                // line 136
                if (($context["reset_group"] ?? null)) {
                    // line 137
                    echo "              ";
                    if ((($__internal_compile_77 = $context["filter"]) && is_array($__internal_compile_77) || $__internal_compile_77 instanceof ArrayAccess ? ($__internal_compile_77["keyword"] ?? null) : null)) {
                        // line 138
                        echo "                <a data-tf-reset=\"text\" data-toggle=\"tooltip\" title=\"";
                        echo ($context["text_reset"] ?? null);
                        echo "\" class=\"tf-filter-reset\"><i class=\"fa fa-times\"></i></a>
              ";
                    } else {
                        // line 140
                        echo "                <a data-tf-reset=\"text\" data-toggle=\"tooltip\" title=\"";
                        echo ($context["text_reset"] ?? null);
                        echo "\" class=\"tf-filter-reset hide\"><i class=\"fa fa-times\"></i></a>
              ";
                    }
                    // line 142
                    echo "            ";
                }
                // line 143
                echo "            <i class=\"fa fa-caret-up toggle-icon\"></i>
          </div>
          <div id=\"tf-filter-panel-";
                // line 145
                echo ($context["module_class_id"] ?? null);
                echo "-";
                echo $context["key"];
                echo "\" class=\"collapse ";
                echo (( !(($__internal_compile_78 = $context["filter"]) && is_array($__internal_compile_78) || $__internal_compile_78 instanceof ArrayAccess ? ($__internal_compile_78["collapse"] ?? null) : null)) ? ("in") : (""));
                echo "\" >
            <div class=\"tf-filter-group-content\">
              <input type=\"text\" name=\"tf_fq\" value=\"";
                // line 147
                echo (($__internal_compile_79 = $context["filter"]) && is_array($__internal_compile_79) || $__internal_compile_79 instanceof ArrayAccess ? ($__internal_compile_79["keyword"] ?? null) : null);
                echo "\" placeholder=\"";
                echo ($context["text_search_placeholder"] ?? null);
                echo "\" class=\"form-control\" />
            </div>
          </div>
        </div>
      ";
            } elseif (((($__internal_compile_80 =             // line 151
$context["filter"]) && is_array($__internal_compile_80) || $__internal_compile_80 instanceof ArrayAccess ? ($__internal_compile_80["type"] ?? null) : null) == "availability")) {
                echo " ";
                // line 152
                echo "        <div class=\"tf-filter-group ";
                echo twig_get_attribute($this->env, $this->source, $context["filter"], "type", [], "any", false, false, false, 152);
                echo " col-xs-";
                echo twig_round((12 / ($context["column_xs"] ?? null)), 0, "ceil");
                echo " col-sm-";
                echo twig_round((12 / ($context["column_sm"] ?? null)), 0, "ceil");
                echo " col-md-";
                echo twig_round((12 / ($context["column_md"] ?? null)), 0, "ceil");
                echo " col-lg-";
                echo twig_round((12 / ($context["column_lg"] ?? null)), 0, "ceil");
                echo "\">
          <div class=\"tf-filter-group-header ";
                // line 153
                echo (((($__internal_compile_81 = $context["filter"]) && is_array($__internal_compile_81) || $__internal_compile_81 instanceof ArrayAccess ? ($__internal_compile_81["collapse"] ?? null) : null)) ? ("collapsed") : (""));
                echo "\" data-toggle=\"collapse\" href=\"#tf-filter-panel-";
                echo ($context["module_class_id"] ?? null);
                echo "-";
                echo $context["key"];
                echo "\">
            <span class=\"tf-filter-group-title\">";
                // line 154
                echo ($context["text_availability"] ?? null);
                echo "</span>
            ";
                // line 155
                if (($context["reset_group"] ?? null)) {
                    // line 156
                    echo "              ";
                    if (((($__internal_compile_82 = (($__internal_compile_83 = (($__internal_compile_84 = $context["filter"]) && is_array($__internal_compile_84) || $__internal_compile_84 instanceof ArrayAccess ? ($__internal_compile_84["values"] ?? null) : null)) && is_array($__internal_compile_83) || $__internal_compile_83 instanceof ArrayAccess ? ($__internal_compile_83["in_stock"] ?? null) : null)) && is_array($__internal_compile_82) || $__internal_compile_82 instanceof ArrayAccess ? ($__internal_compile_82["selected"] ?? null) : null) || (($__internal_compile_85 = (($__internal_compile_86 = (($__internal_compile_87 = $context["filter"]) && is_array($__internal_compile_87) || $__internal_compile_87 instanceof ArrayAccess ? ($__internal_compile_87["values"] ?? null) : null)) && is_array($__internal_compile_86) || $__internal_compile_86 instanceof ArrayAccess ? ($__internal_compile_86["out_of_stock"] ?? null) : null)) && is_array($__internal_compile_85) || $__internal_compile_85 instanceof ArrayAccess ? ($__internal_compile_85["selected"] ?? null) : null))) {
                        // line 157
                        echo "                <a data-tf-reset=\"check\" data-toggle=\"tooltip\" title=\"";
                        echo ($context["text_reset"] ?? null);
                        echo "\" class=\" tf-filter-reset\"><i class=\"fa fa-times\"></i></a>
              ";
                    } else {
                        // line 159
                        echo "                <a data-tf-reset=\"check\" data-toggle=\"tooltip\" title=\"";
                        echo ($context["text_reset"] ?? null);
                        echo "\" class=\" tf-filter-reset hide\"><i class=\"fa fa-times\"></i></a>
              ";
                    }
                    // line 161
                    echo "            ";
                }
                // line 162
                echo "            <i class=\"fa fa-caret-up toggle-icon\"></i>
          </div>
          <div id=\"tf-filter-panel-";
                // line 164
                echo ($context["module_class_id"] ?? null);
                echo "-";
                echo $context["key"];
                echo "\" class=\"collapse ";
                echo (( !(($__internal_compile_88 = $context["filter"]) && is_array($__internal_compile_88) || $__internal_compile_88 instanceof ArrayAccess ? ($__internal_compile_88["collapse"] ?? null) : null)) ? ("in") : (""));
                echo "\" >
            <div class=\"tf-filter-group-content\">
              <div class=\"form-check tf-filter-value custom-radio\">
                <label class=\"form-check-label\">
                  ";
                // line 168
                if ((($__internal_compile_89 = (($__internal_compile_90 = (($__internal_compile_91 = $context["filter"]) && is_array($__internal_compile_91) || $__internal_compile_91 instanceof ArrayAccess ? ($__internal_compile_91["values"] ?? null) : null)) && is_array($__internal_compile_90) || $__internal_compile_90 instanceof ArrayAccess ? ($__internal_compile_90["in_stock"] ?? null) : null)) && is_array($__internal_compile_89) || $__internal_compile_89 instanceof ArrayAccess ? ($__internal_compile_89["selected"] ?? null) : null)) {
                    // line 169
                    echo "                    <input type=\"radio\" value=\"1\" name=\"tf_fs\" class=\"form-check-input\" checked>
                  ";
                } else {
                    // line 171
                    echo "                    <input type=\"radio\" value=\"1\" name=\"tf_fs\" class=\"form-check-input\" ";
                    echo (( !(($__internal_compile_92 = (($__internal_compile_93 = (($__internal_compile_94 = $context["filter"]) && is_array($__internal_compile_94) || $__internal_compile_94 instanceof ArrayAccess ? ($__internal_compile_94["values"] ?? null) : null)) && is_array($__internal_compile_93) || $__internal_compile_93 instanceof ArrayAccess ? ($__internal_compile_93["in_stock"] ?? null) : null)) && is_array($__internal_compile_92) || $__internal_compile_92 instanceof ArrayAccess ? ($__internal_compile_92["status"] ?? null) : null)) ? ("disabled") : (""));
                    echo ">
                  ";
                }
                // line 173
                echo "                  <span class=\"checkmark fa\"></span>
                  ";
                // line 174
                echo ($context["text_in_stock"] ?? null);
                echo "
                </label>
                ";
                // line 176
                if (($context["count_product"] ?? null)) {
                    // line 177
                    echo "                  ";
                    if ((($__internal_compile_95 = (($__internal_compile_96 = (($__internal_compile_97 = $context["filter"]) && is_array($__internal_compile_97) || $__internal_compile_97 instanceof ArrayAccess ? ($__internal_compile_97["values"] ?? null) : null)) && is_array($__internal_compile_96) || $__internal_compile_96 instanceof ArrayAccess ? ($__internal_compile_96["in_stock"] ?? null) : null)) && is_array($__internal_compile_95) || $__internal_compile_95 instanceof ArrayAccess ? ($__internal_compile_95["total"] ?? null) : null)) {
                        // line 178
                        echo "                    <span class=\"label label-info tf-product-total\">";
                        echo (($__internal_compile_98 = (($__internal_compile_99 = (($__internal_compile_100 = $context["filter"]) && is_array($__internal_compile_100) || $__internal_compile_100 instanceof ArrayAccess ? ($__internal_compile_100["values"] ?? null) : null)) && is_array($__internal_compile_99) || $__internal_compile_99 instanceof ArrayAccess ? ($__internal_compile_99["in_stock"] ?? null) : null)) && is_array($__internal_compile_98) || $__internal_compile_98 instanceof ArrayAccess ? ($__internal_compile_98["total"] ?? null) : null);
                        echo "</span>
                  ";
                    } else {
                        // line 180
                        echo "                    <span class=\"label label-info label-danger tf-product-total\">";
                        echo (($__internal_compile_101 = (($__internal_compile_102 = (($__internal_compile_103 = $context["filter"]) && is_array($__internal_compile_103) || $__internal_compile_103 instanceof ArrayAccess ? ($__internal_compile_103["values"] ?? null) : null)) && is_array($__internal_compile_102) || $__internal_compile_102 instanceof ArrayAccess ? ($__internal_compile_102["in_stock"] ?? null) : null)) && is_array($__internal_compile_101) || $__internal_compile_101 instanceof ArrayAccess ? ($__internal_compile_101["total"] ?? null) : null);
                        echo "</span>
                  ";
                    }
                    // line 182
                    echo "                ";
                }
                // line 183
                echo "              </div>
              <div class=\"form-check tf-filter-value custom-radio\">
                <label class=\"form-check-label\">
                  ";
                // line 186
                if ((($__internal_compile_104 = (($__internal_compile_105 = (($__internal_compile_106 = $context["filter"]) && is_array($__internal_compile_106) || $__internal_compile_106 instanceof ArrayAccess ? ($__internal_compile_106["values"] ?? null) : null)) && is_array($__internal_compile_105) || $__internal_compile_105 instanceof ArrayAccess ? ($__internal_compile_105["out_of_stock"] ?? null) : null)) && is_array($__internal_compile_104) || $__internal_compile_104 instanceof ArrayAccess ? ($__internal_compile_104["selected"] ?? null) : null)) {
                    // line 187
                    echo "                    <input type=\"radio\" value=\"0\" name=\"tf_fs\" class=\"form-check-input\" checked>
                  ";
                } else {
                    // line 189
                    echo "                    <input type=\"radio\" value=\"0\" name=\"tf_fs\" class=\"form-check-input\" ";
                    echo (( !(($__internal_compile_107 = (($__internal_compile_108 = (($__internal_compile_109 = $context["filter"]) && is_array($__internal_compile_109) || $__internal_compile_109 instanceof ArrayAccess ? ($__internal_compile_109["values"] ?? null) : null)) && is_array($__internal_compile_108) || $__internal_compile_108 instanceof ArrayAccess ? ($__internal_compile_108["out_of_stock"] ?? null) : null)) && is_array($__internal_compile_107) || $__internal_compile_107 instanceof ArrayAccess ? ($__internal_compile_107["status"] ?? null) : null)) ? ("disabled") : (""));
                    echo ">
                  ";
                }
                // line 191
                echo "                  <span class=\"checkmark fa\"></span>
                  ";
                // line 192
                echo ($context["text_out_of_stock"] ?? null);
                echo "
                </label>
                ";
                // line 194
                if (($context["count_product"] ?? null)) {
                    // line 195
                    echo "                  ";
                    if ((($__internal_compile_110 = (($__internal_compile_111 = (($__internal_compile_112 = $context["filter"]) && is_array($__internal_compile_112) || $__internal_compile_112 instanceof ArrayAccess ? ($__internal_compile_112["values"] ?? null) : null)) && is_array($__internal_compile_111) || $__internal_compile_111 instanceof ArrayAccess ? ($__internal_compile_111["out_of_stock"] ?? null) : null)) && is_array($__internal_compile_110) || $__internal_compile_110 instanceof ArrayAccess ? ($__internal_compile_110["total"] ?? null) : null)) {
                        // line 196
                        echo "                    <span class=\"label label-info tf-product-total\">";
                        echo (($__internal_compile_113 = (($__internal_compile_114 = (($__internal_compile_115 = $context["filter"]) && is_array($__internal_compile_115) || $__internal_compile_115 instanceof ArrayAccess ? ($__internal_compile_115["values"] ?? null) : null)) && is_array($__internal_compile_114) || $__internal_compile_114 instanceof ArrayAccess ? ($__internal_compile_114["out_of_stock"] ?? null) : null)) && is_array($__internal_compile_113) || $__internal_compile_113 instanceof ArrayAccess ? ($__internal_compile_113["total"] ?? null) : null);
                        echo "</span>
                  ";
                    } else {
                        // line 198
                        echo "                    <span class=\"label label-info label-danger tf-product-total\">";
                        echo (($__internal_compile_116 = (($__internal_compile_117 = (($__internal_compile_118 = $context["filter"]) && is_array($__internal_compile_118) || $__internal_compile_118 instanceof ArrayAccess ? ($__internal_compile_118["values"] ?? null) : null)) && is_array($__internal_compile_117) || $__internal_compile_117 instanceof ArrayAccess ? ($__internal_compile_117["out_of_stock"] ?? null) : null)) && is_array($__internal_compile_116) || $__internal_compile_116 instanceof ArrayAccess ? ($__internal_compile_116["total"] ?? null) : null);
                        echo "</span>
                  ";
                    }
                    // line 200
                    echo "                ";
                }
                // line 201
                echo "              </div>
            </div>
          </div>
        </div>
      ";
            } elseif (((twig_get_attribute($this->env, $this->source,             // line 205
$context["filter"], "type", [], "any", false, false, false, 205) == "stock_status") && twig_get_attribute($this->env, $this->source, $context["filter"], "values", [], "any", false, false, false, 205))) {
                echo " ";
                // line 206
                echo "        <div class=\"tf-filter-group ";
                echo (((($context["hide_zero_filter"] ?? null) &&  !twig_get_attribute($this->env, $this->source, $context["filter"], "status", [], "any", false, false, false, 206))) ? ("hide") : (""));
                echo " ";
                echo twig_get_attribute($this->env, $this->source, $context["filter"], "type", [], "any", false, false, false, 206);
                echo " col-xs-";
                echo twig_round((12 / ($context["column_xs"] ?? null)), 0, "ceil");
                echo " col-sm-";
                echo twig_round((12 / ($context["column_sm"] ?? null)), 0, "ceil");
                echo " col-md-";
                echo twig_round((12 / ($context["column_md"] ?? null)), 0, "ceil");
                echo " col-lg-";
                echo twig_round((12 / ($context["column_lg"] ?? null)), 0, "ceil");
                echo "\">
          <div class=\"tf-filter-group-header ";
                // line 207
                echo ((twig_get_attribute($this->env, $this->source, $context["filter"], "collapse", [], "any", false, false, false, 207)) ? ("collapsed") : (""));
                echo "\" data-toggle=\"collapse\" data-target=\"#tf-filter-panel-";
                echo ($context["module_class_id"] ?? null);
                echo "-";
                echo $context["key"];
                echo "\">
            <span class=\"tf-filter-group-title\">";
                // line 208
                echo ($context["text_availability"] ?? null);
                echo "</span>
            ";
                // line 209
                if (($context["reset_group"] ?? null)) {
                    // line 210
                    echo "              ";
                    $context["total_selected"] = 0;
                    // line 211
                    echo "              ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["filter"], "values", [], "any", false, false, false, 211));
                    foreach ($context['_seq'] as $context["_key"] => $context["stock_status"]) {
                        if (twig_get_attribute($this->env, $this->source, $context["stock_status"], "selected", [], "any", false, false, false, 211)) {
                            $context["total_selected"] = (($context["total_selected"] ?? null) + 1);
                        }
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['stock_status'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 212
                    echo "              <a data-tf-reset=\"check\" data-toggle=\"tooltip\" title=\"";
                    echo ($context["text_reset"] ?? null);
                    echo "\" class=\"tf-filter-reset";
                    echo (( !($context["total_selected"] ?? null)) ? (" hide") : (""));
                    echo "\"><i class=\"fa fa-times\"></i></a>
            ";
                }
                // line 214
                echo "            <i class=\"fa fa-caret-up toggle-icon\"></i>
          </div>
          <div id=\"tf-filter-panel-";
                // line 216
                echo ($context["module_class_id"] ?? null);
                echo "-";
                echo $context["key"];
                echo "\" class=\"collapse ";
                echo (( !twig_get_attribute($this->env, $this->source, $context["filter"], "collapse", [], "any", false, false, false, 216)) ? ("in") : (""));
                echo "\" >
            <div class=\"tf-filter-group-content ";
                // line 217
                echo ($context["overflow"] ?? null);
                echo "\">
              ";
                // line 218
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["filter"], "values", [], "any", false, false, false, 218));
                foreach ($context['_seq'] as $context["_key"] => $context["stock_status"]) {
                    echo "<div class=\"form-check tf-filter-value ";
                    echo (((($context["hide_zero_filter"] ?? null) &&  !twig_get_attribute($this->env, $this->source, $context["stock_status"], "status", [], "any", false, false, false, 218))) ? ("hide") : (""));
                    echo " custom-";
                    echo (($__internal_compile_119 = $context["filter"]) && is_array($__internal_compile_119) || $__internal_compile_119 instanceof ArrayAccess ? ($__internal_compile_119["input_type"] ?? null) : null);
                    echo " ";
                    echo (($__internal_compile_120 = $context["filter"]) && is_array($__internal_compile_120) || $__internal_compile_120 instanceof ArrayAccess ? ($__internal_compile_120["list_type"] ?? null) : null);
                    echo "\">
                <label class=\"form-check-label\">
                  ";
                    // line 220
                    if (twig_get_attribute($this->env, $this->source, $context["stock_status"], "selected", [], "any", false, false, false, 220)) {
                        // line 221
                        echo "                    <input type=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["filter"], "input_type", [], "any", false, false, false, 221);
                        echo "\" name=\"tf_fss\" value=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["stock_status"], "stock_status_id", [], "any", false, false, false, 221);
                        echo "\" class=\"form-check-input\" checked>
                  ";
                    } else {
                        // line 223
                        echo "                    <input type=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["filter"], "input_type", [], "any", false, false, false, 223);
                        echo "\" name=\"tf_fss\" value=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["stock_status"], "stock_status_id", [], "any", false, false, false, 223);
                        echo "\" class=\"form-check-input\" ";
                        echo (( !(($__internal_compile_121 = $context["stock_status"]) && is_array($__internal_compile_121) || $__internal_compile_121 instanceof ArrayAccess ? ($__internal_compile_121["status"] ?? null) : null)) ? ("disabled") : (""));
                        echo ">
                  ";
                    }
                    // line 225
                    echo "                  <span class=\"checkmark fa\"></span>
                  ";
                    // line 226
                    echo twig_get_attribute($this->env, $this->source, $context["stock_status"], "name", [], "any", false, false, false, 226);
                    echo "
                </label>
                ";
                    // line 228
                    if (($context["count_product"] ?? null)) {
                        // line 229
                        echo "                  ";
                        if (twig_get_attribute($this->env, $this->source, $context["stock_status"], "total", [], "any", false, false, false, 229)) {
                            // line 230
                            echo "                    <span class=\"label label-info tf-product-total\">";
                            echo twig_get_attribute($this->env, $this->source, $context["stock_status"], "total", [], "any", false, false, false, 230);
                            echo "</span>
                  ";
                        } else {
                            // line 232
                            echo "                    <span class=\"label label-info label-danger tf-product-total\">";
                            echo twig_get_attribute($this->env, $this->source, $context["stock_status"], "total", [], "any", false, false, false, 232);
                            echo "</span>
                  ";
                        }
                        // line 234
                        echo "                ";
                    }
                    // line 235
                    echo "                </div>";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['stock_status'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 236
                echo "              ";
                if (((($context["overflow"] ?? null) == "more") && (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["filter"], "values", [], "any", false, false, false, 236)) >= 7))) {
                    // line 237
                    echo "                <a class=\"tf-see-more btn-link\" data-toggle=\"tf-seemore\" data-show=\"";
                    echo ($context["text_see_more"] ?? null);
                    echo "\" data-hide=\"";
                    echo ($context["text_see_less"] ?? null);
                    echo "\" href=\"#\">";
                    echo ($context["text_see_more"] ?? null);
                    echo "</a>
              ";
                }
                // line 239
                echo "            </div>
          </div>
        </div>
      ";
            } elseif (((($__internal_compile_122 =             // line 242
$context["filter"]) && is_array($__internal_compile_122) || $__internal_compile_122 instanceof ArrayAccess ? ($__internal_compile_122["type"] ?? null) : null) == "rating")) {
                echo " ";
                // line 243
                echo "        <div class=\"tf-filter-group ";
                echo twig_get_attribute($this->env, $this->source, $context["filter"], "type", [], "any", false, false, false, 243);
                echo " col-xs-";
                echo twig_round((12 / ($context["column_xs"] ?? null)), 0, "ceil");
                echo " col-sm-";
                echo twig_round((12 / ($context["column_sm"] ?? null)), 0, "ceil");
                echo " col-md-";
                echo twig_round((12 / ($context["column_md"] ?? null)), 0, "ceil");
                echo " col-lg-";
                echo twig_round((12 / ($context["column_lg"] ?? null)), 0, "ceil");
                echo "\">
          <div class=\"tf-filter-group-header ";
                // line 244
                echo (((($__internal_compile_123 = $context["filter"]) && is_array($__internal_compile_123) || $__internal_compile_123 instanceof ArrayAccess ? ($__internal_compile_123["collapse"] ?? null) : null)) ? ("collapsed") : (""));
                echo "\" data-toggle=\"collapse\" href=\"#tf-filter-panel-";
                echo ($context["module_class_id"] ?? null);
                echo "-";
                echo $context["key"];
                echo "\">
            <span class=\"tf-filter-group-title\">";
                // line 245
                echo ($context["text_rating"] ?? null);
                echo "</span>
            ";
                // line 246
                if (($context["reset_group"] ?? null)) {
                    // line 247
                    echo "              ";
                    $context["total_selected"] = 0;
                    // line 248
                    echo "              ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable((($__internal_compile_124 = $context["filter"]) && is_array($__internal_compile_124) || $__internal_compile_124 instanceof ArrayAccess ? ($__internal_compile_124["values"] ?? null) : null));
                    foreach ($context['_seq'] as $context["_key"] => $context["rating"]) {
                        if ((($__internal_compile_125 = $context["rating"]) && is_array($__internal_compile_125) || $__internal_compile_125 instanceof ArrayAccess ? ($__internal_compile_125["selected"] ?? null) : null)) {
                            $context["total_selected"] = (($context["total_selected"] ?? null) + 1);
                        }
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rating'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 249
                    echo "              <a data-tf-reset=\"check\" data-toggle=\"tooltip\" title=\"";
                    echo ($context["text_reset"] ?? null);
                    echo "\" class=\"tf-filter-reset";
                    echo (( !($context["total_selected"] ?? null)) ? (" hide") : (""));
                    echo "\"><i class=\"fa fa-times\"></i></a>
            ";
                }
                // line 251
                echo "            <i class=\"fa fa-caret-up toggle-icon\"></i>
          </div>
          <div id=\"tf-filter-panel-";
                // line 253
                echo ($context["module_class_id"] ?? null);
                echo "-";
                echo $context["key"];
                echo "\" class=\"collapse ";
                echo (( !(($__internal_compile_126 = $context["filter"]) && is_array($__internal_compile_126) || $__internal_compile_126 instanceof ArrayAccess ? ($__internal_compile_126["collapse"] ?? null) : null)) ? ("in") : (""));
                echo "\" >
            <div class=\"tf-filter-group-content\">
              ";
                // line 255
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((($__internal_compile_127 = $context["filter"]) && is_array($__internal_compile_127) || $__internal_compile_127 instanceof ArrayAccess ? ($__internal_compile_127["values"] ?? null) : null));
                foreach ($context['_seq'] as $context["_key"] => $context["rating"]) {
                    // line 256
                    echo "                <div class=\"form-check tf-filter-value custom-radio\">
                  <label class=\"form-check-label\">
                    ";
                    // line 258
                    if ((($__internal_compile_128 = $context["rating"]) && is_array($__internal_compile_128) || $__internal_compile_128 instanceof ArrayAccess ? ($__internal_compile_128["selected"] ?? null) : null)) {
                        // line 259
                        echo "                      <input type=\"radio\" value=\"";
                        echo (($__internal_compile_129 = $context["rating"]) && is_array($__internal_compile_129) || $__internal_compile_129 instanceof ArrayAccess ? ($__internal_compile_129["rating"] ?? null) : null);
                        echo "\" name=\"tf_fr\" class=\"form-check-input\" checked>
                    ";
                    } else {
                        // line 261
                        echo "                      <input type=\"radio\" value=\"";
                        echo (($__internal_compile_130 = $context["rating"]) && is_array($__internal_compile_130) || $__internal_compile_130 instanceof ArrayAccess ? ($__internal_compile_130["rating"] ?? null) : null);
                        echo "\" name=\"tf_fr\" class=\"form-check-input\" ";
                        echo (( !(($__internal_compile_131 = $context["rating"]) && is_array($__internal_compile_131) || $__internal_compile_131 instanceof ArrayAccess ? ($__internal_compile_131["status"] ?? null) : null)) ? ("disabled") : (""));
                        echo ">
                    ";
                    }
                    // line 263
                    echo "                    <span class=\"checkmark fa\"></span>
                    <span class=\"rating\">
                ";
                    // line 265
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(range(1, 5));
                    foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                        // line 266
                        echo "                  ";
                        if (((($__internal_compile_132 = $context["rating"]) && is_array($__internal_compile_132) || $__internal_compile_132 instanceof ArrayAccess ? ($__internal_compile_132["rating"] ?? null) : null) < $context["i"])) {
                            // line 267
                            echo "                    <span class=\"fa fa-stack\"><i class=\"fa fa-star-o fa-stack-1x\"></i></span>
                  ";
                        } else {
                            // line 269
                            echo "                    <span class=\"fa fa-stack\"><i class=\"fa fa-star fa-stack-1x\"></i><i class=\"fa fa-star-o fa-stack-1x\"></i></span>
                  ";
                        }
                        // line 271
                        echo "                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 272
                    echo "              </span>
                    ";
                    // line 273
                    echo ($context["text_and_up"] ?? null);
                    echo "
                  </label>
                  ";
                    // line 275
                    if (($context["count_product"] ?? null)) {
                        // line 276
                        echo "                    ";
                        if ((($__internal_compile_133 = $context["rating"]) && is_array($__internal_compile_133) || $__internal_compile_133 instanceof ArrayAccess ? ($__internal_compile_133["total"] ?? null) : null)) {
                            // line 277
                            echo "                      <span class=\"label label-info tf-product-total\">";
                            echo (($__internal_compile_134 = $context["rating"]) && is_array($__internal_compile_134) || $__internal_compile_134 instanceof ArrayAccess ? ($__internal_compile_134["total"] ?? null) : null);
                            echo "</span>
                    ";
                        } else {
                            // line 279
                            echo "                      <span class=\"label label-info label-danger tf-product-total\">";
                            echo (($__internal_compile_135 = $context["rating"]) && is_array($__internal_compile_135) || $__internal_compile_135 instanceof ArrayAccess ? ($__internal_compile_135["total"] ?? null) : null);
                            echo "</span>
                    ";
                        }
                        // line 281
                        echo "                  ";
                    }
                    // line 282
                    echo "                </div>
              ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rating'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 284
                echo "            </div>
          </div>
        </div>
      ";
            } elseif (((($__internal_compile_136 =             // line 287
$context["filter"]) && is_array($__internal_compile_136) || $__internal_compile_136 instanceof ArrayAccess ? ($__internal_compile_136["type"] ?? null) : null) == "discount")) {
                echo " ";
                // line 288
                echo "        <div class=\"tf-filter-group ";
                echo twig_get_attribute($this->env, $this->source, $context["filter"], "type", [], "any", false, false, false, 288);
                echo " col-xs-";
                echo twig_round((12 / ($context["column_xs"] ?? null)), 0, "ceil");
                echo " col-sm-";
                echo twig_round((12 / ($context["column_sm"] ?? null)), 0, "ceil");
                echo " col-md-";
                echo twig_round((12 / ($context["column_md"] ?? null)), 0, "ceil");
                echo " col-lg-";
                echo twig_round((12 / ($context["column_lg"] ?? null)), 0, "ceil");
                echo "\">
          <div class=\"tf-filter-group-header ";
                // line 289
                echo (((($__internal_compile_137 = $context["filter"]) && is_array($__internal_compile_137) || $__internal_compile_137 instanceof ArrayAccess ? ($__internal_compile_137["collapse"] ?? null) : null)) ? ("collapsed") : (""));
                echo "\" data-toggle=\"collapse\" href=\"#tf-filter-panel-";
                echo ($context["module_class_id"] ?? null);
                echo "-";
                echo $context["key"];
                echo "\">
            <span class=\"tf-filter-group-title\">";
                // line 290
                echo ($context["text_discount"] ?? null);
                echo "</span>
            ";
                // line 291
                if (($context["reset_group"] ?? null)) {
                    // line 292
                    echo "              ";
                    $context["total_selected"] = 0;
                    // line 293
                    echo "              ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable((($__internal_compile_138 = $context["filter"]) && is_array($__internal_compile_138) || $__internal_compile_138 instanceof ArrayAccess ? ($__internal_compile_138["values"] ?? null) : null));
                    foreach ($context['_seq'] as $context["_key"] => $context["discount"]) {
                        if ((($__internal_compile_139 = $context["discount"]) && is_array($__internal_compile_139) || $__internal_compile_139 instanceof ArrayAccess ? ($__internal_compile_139["selected"] ?? null) : null)) {
                            $context["total_selected"] = (($context["total_selected"] ?? null) + 1);
                        }
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['discount'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 294
                    echo "              <a data-tf-reset=\"check\" data-toggle=\"tooltip\" title=\"";
                    echo ($context["text_reset"] ?? null);
                    echo "\" class=\"tf-filter-reset";
                    echo (( !($context["total_selected"] ?? null)) ? (" hide") : (""));
                    echo "\"><i class=\"fa fa-times\"></i></a>
            ";
                }
                // line 296
                echo "            <i class=\"fa fa-caret-up toggle-icon\"></i>
          </div>
          <div id=\"tf-filter-panel-";
                // line 298
                echo ($context["module_class_id"] ?? null);
                echo "-";
                echo $context["key"];
                echo "\" class=\"collapse ";
                echo (( !(($__internal_compile_140 = $context["filter"]) && is_array($__internal_compile_140) || $__internal_compile_140 instanceof ArrayAccess ? ($__internal_compile_140["collapse"] ?? null) : null)) ? ("in") : (""));
                echo "\" >
            <div class=\"tf-filter-group-content\">
              ";
                // line 300
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((($__internal_compile_141 = $context["filter"]) && is_array($__internal_compile_141) || $__internal_compile_141 instanceof ArrayAccess ? ($__internal_compile_141["values"] ?? null) : null));
                foreach ($context['_seq'] as $context["_key"] => $context["discount"]) {
                    // line 301
                    echo "                <div class=\"form-check tf-filter-value custom-radio\">
                  <label class=\"form-check-label\">
                    ";
                    // line 303
                    if ((($__internal_compile_142 = $context["discount"]) && is_array($__internal_compile_142) || $__internal_compile_142 instanceof ArrayAccess ? ($__internal_compile_142["selected"] ?? null) : null)) {
                        // line 304
                        echo "                      <input type=\"radio\" value=\"";
                        echo (($__internal_compile_143 = $context["discount"]) && is_array($__internal_compile_143) || $__internal_compile_143 instanceof ArrayAccess ? ($__internal_compile_143["value"] ?? null) : null);
                        echo "\" name=\"tf_fd\" class=\"form-check-input\" checked>
                    ";
                    } else {
                        // line 306
                        echo "                      <input type=\"radio\" value=\"";
                        echo (($__internal_compile_144 = $context["discount"]) && is_array($__internal_compile_144) || $__internal_compile_144 instanceof ArrayAccess ? ($__internal_compile_144["value"] ?? null) : null);
                        echo "\" name=\"tf_fd\" class=\"form-check-input\" ";
                        echo (( !(($__internal_compile_145 = $context["discount"]) && is_array($__internal_compile_145) || $__internal_compile_145 instanceof ArrayAccess ? ($__internal_compile_145["status"] ?? null) : null)) ? ("disabled") : (""));
                        echo ">
                    ";
                    }
                    // line 308
                    echo "                    <span class=\"checkmark fa\"></span>
                    ";
                    // line 309
                    echo (($__internal_compile_146 = $context["discount"]) && is_array($__internal_compile_146) || $__internal_compile_146 instanceof ArrayAccess ? ($__internal_compile_146["name"] ?? null) : null);
                    echo "
                  </label>
                  ";
                    // line 311
                    if (($context["count_product"] ?? null)) {
                        // line 312
                        echo "                    ";
                        if ((($__internal_compile_147 = $context["discount"]) && is_array($__internal_compile_147) || $__internal_compile_147 instanceof ArrayAccess ? ($__internal_compile_147["total"] ?? null) : null)) {
                            // line 313
                            echo "                      <span class=\"label label-info tf-product-total\">";
                            echo (($__internal_compile_148 = $context["discount"]) && is_array($__internal_compile_148) || $__internal_compile_148 instanceof ArrayAccess ? ($__internal_compile_148["total"] ?? null) : null);
                            echo "</span>
                    ";
                        } else {
                            // line 315
                            echo "                      <span class=\"label label-info label-danger tf-product-total\">";
                            echo (($__internal_compile_149 = $context["discount"]) && is_array($__internal_compile_149) || $__internal_compile_149 instanceof ArrayAccess ? ($__internal_compile_149["total"] ?? null) : null);
                            echo "</span>
                    ";
                        }
                        // line 317
                        echo "                  ";
                    }
                    // line 318
                    echo "                </div>
              ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['discount'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 320
                echo "            </div>
          </div>
        </div>
      ";
            } elseif (((($__internal_compile_150 =             // line 323
$context["filter"]) && is_array($__internal_compile_150) || $__internal_compile_150 instanceof ArrayAccess ? ($__internal_compile_150["type"] ?? null) : null) == "filter")) {
                echo " ";
                // line 324
                echo "        <div class=\"tf-filter-group ";
                echo twig_get_attribute($this->env, $this->source, $context["filter"], "type", [], "any", false, false, false, 324);
                echo " ";
                echo (((($context["hide_zero_filter"] ?? null) &&  !twig_get_attribute($this->env, $this->source, $context["filter"], "status", [], "any", false, false, false, 324))) ? ("hide") : (""));
                echo " col-xs-";
                echo twig_round((12 / ($context["column_xs"] ?? null)), 0, "ceil");
                echo " col-sm-";
                echo twig_round((12 / ($context["column_sm"] ?? null)), 0, "ceil");
                echo " col-md-";
                echo twig_round((12 / ($context["column_md"] ?? null)), 0, "ceil");
                echo " col-lg-";
                echo twig_round((12 / ($context["column_lg"] ?? null)), 0, "ceil");
                echo "\">
          <div class=\"tf-filter-group-header ";
                // line 325
                echo (((($__internal_compile_151 = $context["filter"]) && is_array($__internal_compile_151) || $__internal_compile_151 instanceof ArrayAccess ? ($__internal_compile_151["collapse"] ?? null) : null)) ? ("collapsed") : (""));
                echo "\" data-toggle=\"collapse\" href=\"#tf-filter-panel-";
                echo ($context["module_class_id"] ?? null);
                echo "-";
                echo $context["key"];
                echo "\">
            <span  class=\"tf-filter-group-title\">";
                // line 326
                echo (($__internal_compile_152 = $context["filter"]) && is_array($__internal_compile_152) || $__internal_compile_152 instanceof ArrayAccess ? ($__internal_compile_152["name"] ?? null) : null);
                echo "</span>
            ";
                // line 327
                if (($context["reset_group"] ?? null)) {
                    // line 328
                    echo "              ";
                    $context["total_selected"] = 0;
                    // line 329
                    echo "              ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable((($__internal_compile_153 = $context["filter"]) && is_array($__internal_compile_153) || $__internal_compile_153 instanceof ArrayAccess ? ($__internal_compile_153["values"] ?? null) : null));
                    foreach ($context['_seq'] as $context["_key"] => $context["value"]) {
                        if ((($__internal_compile_154 = $context["value"]) && is_array($__internal_compile_154) || $__internal_compile_154 instanceof ArrayAccess ? ($__internal_compile_154["selected"] ?? null) : null)) {
                            $context["total_selected"] = (($context["total_selected"] ?? null) + 1);
                        }
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 330
                    echo "              <a data-tf-reset=\"check\" data-toggle=\"tooltip\" title=\"";
                    echo ($context["text_reset"] ?? null);
                    echo "\" class=\" tf-filter-reset";
                    echo (( !($context["total_selected"] ?? null)) ? (" hide") : (""));
                    echo "\"><i class=\"fa fa-times\"></i></a>
            ";
                }
                // line 332
                echo "            <i class=\"fa fa-caret-up toggle-icon\"></i>
          </div>
          <div id=\"tf-filter-panel-";
                // line 334
                echo ($context["module_class_id"] ?? null);
                echo "-";
                echo $context["key"];
                echo "\" class=\"collapse ";
                echo (( !(($__internal_compile_155 = $context["filter"]) && is_array($__internal_compile_155) || $__internal_compile_155 instanceof ArrayAccess ? ($__internal_compile_155["collapse"] ?? null) : null)) ? ("in") : (""));
                echo "\" >
            ";
                // line 335
                if ((($__internal_compile_156 = $context["filter"]) && is_array($__internal_compile_156) || $__internal_compile_156 instanceof ArrayAccess ? ($__internal_compile_156["search"] ?? null) : null)) {
                    // line 336
                    echo "              <div class=\"tf-filter-group-search\"><i class=\"fa fa-search\"></i> <input type=\"search\" placeholder=\"";
                    echo ($context["text_search"] ?? null);
                    echo "\"/></div>
            ";
                }
                // line 338
                echo "            <div class=\"tf-filter-group-content ";
                echo ($context["overflow"] ?? null);
                echo "\">
              ";
                // line 339
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((($__internal_compile_157 = $context["filter"]) && is_array($__internal_compile_157) || $__internal_compile_157 instanceof ArrayAccess ? ($__internal_compile_157["values"] ?? null) : null));
                foreach ($context['_seq'] as $context["_key"] => $context["value"]) {
                    // line 340
                    echo "                <div class=\"form-check tf-filter-value ";
                    echo (((($context["hide_zero_filter"] ?? null) &&  !twig_get_attribute($this->env, $this->source, $context["value"], "status", [], "any", false, false, false, 340))) ? ("hide") : (""));
                    echo " custom-checkbox\">
                  <label class=\"form-check-label\">
                    ";
                    // line 342
                    if ((($__internal_compile_158 = $context["value"]) && is_array($__internal_compile_158) || $__internal_compile_158 instanceof ArrayAccess ? ($__internal_compile_158["selected"] ?? null) : null)) {
                        // line 343
                        echo "                      <input type=\"checkbox\" name=\"tf_ff\" value=\"";
                        echo (($__internal_compile_159 = $context["value"]) && is_array($__internal_compile_159) || $__internal_compile_159 instanceof ArrayAccess ? ($__internal_compile_159["filter_id"] ?? null) : null);
                        echo "\" class=\"form-check-input\" checked>
                    ";
                    } else {
                        // line 345
                        echo "                      <input type=\"checkbox\" name=\"tf_ff\" value=\"";
                        echo (($__internal_compile_160 = $context["value"]) && is_array($__internal_compile_160) || $__internal_compile_160 instanceof ArrayAccess ? ($__internal_compile_160["filter_id"] ?? null) : null);
                        echo "\" class=\"form-check-input\" ";
                        echo (( !(($__internal_compile_161 = $context["value"]) && is_array($__internal_compile_161) || $__internal_compile_161 instanceof ArrayAccess ? ($__internal_compile_161["status"] ?? null) : null)) ? ("disabled") : (""));
                        echo ">
                    ";
                    }
                    // line 347
                    echo "                    <span class=\"checkmark fa\"></span>
                    ";
                    // line 348
                    echo (($__internal_compile_162 = $context["value"]) && is_array($__internal_compile_162) || $__internal_compile_162 instanceof ArrayAccess ? ($__internal_compile_162["name"] ?? null) : null);
                    echo "
                  </label>
                  ";
                    // line 350
                    if (($context["count_product"] ?? null)) {
                        // line 351
                        echo "                    ";
                        if ((($__internal_compile_163 = $context["value"]) && is_array($__internal_compile_163) || $__internal_compile_163 instanceof ArrayAccess ? ($__internal_compile_163["total"] ?? null) : null)) {
                            // line 352
                            echo "                      <span class=\"label label-info tf-product-total\">";
                            echo (($__internal_compile_164 = $context["value"]) && is_array($__internal_compile_164) || $__internal_compile_164 instanceof ArrayAccess ? ($__internal_compile_164["total"] ?? null) : null);
                            echo "</span>
                    ";
                        } else {
                            // line 354
                            echo "                      <span class=\"label label-info label-danger tf-product-total\">";
                            echo (($__internal_compile_165 = $context["value"]) && is_array($__internal_compile_165) || $__internal_compile_165 instanceof ArrayAccess ? ($__internal_compile_165["total"] ?? null) : null);
                            echo "</span>
                    ";
                        }
                        // line 356
                        echo "                  ";
                    }
                    // line 357
                    echo "                </div>
              ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['value'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 359
                echo "              ";
                if (((($context["overflow"] ?? null) == "more") && (twig_length_filter($this->env, (($__internal_compile_166 = $context["filter"]) && is_array($__internal_compile_166) || $__internal_compile_166 instanceof ArrayAccess ? ($__internal_compile_166["values"] ?? null) : null)) >= 7))) {
                    // line 360
                    echo "                <a class=\"tf-see-more btn-link\" data-toggle=\"tf-seemore\" data-show=\"";
                    echo ($context["text_see_more"] ?? null);
                    echo "\" data-hide=\"";
                    echo ($context["text_see_less"] ?? null);
                    echo "\" href=\"#\">";
                    echo ($context["text_see_more"] ?? null);
                    echo "</a>
              ";
                }
                // line 362
                echo "            </div>
          </div>
        </div>
      ";
            } elseif (((($__internal_compile_167 =             // line 365
$context["filter"]) && is_array($__internal_compile_167) || $__internal_compile_167 instanceof ArrayAccess ? ($__internal_compile_167["type"] ?? null) : null) == "custom")) {
                echo " ";
                // line 366
                echo "        <div class=\"tf-filter-group ";
                echo twig_get_attribute($this->env, $this->source, $context["filter"], "type", [], "any", false, false, false, 366);
                echo " ";
                echo (((($context["hide_zero_filter"] ?? null) &&  !twig_get_attribute($this->env, $this->source, $context["filter"], "status", [], "any", false, false, false, 366))) ? ("hide") : (""));
                echo " col-xs-";
                echo twig_round((12 / ($context["column_xs"] ?? null)), 0, "ceil");
                echo " col-sm-";
                echo twig_round((12 / ($context["column_sm"] ?? null)), 0, "ceil");
                echo " col-md-";
                echo twig_round((12 / ($context["column_md"] ?? null)), 0, "ceil");
                echo " col-lg-";
                echo twig_round((12 / ($context["column_lg"] ?? null)), 0, "ceil");
                echo "\">
          <div class=\"tf-filter-group-header ";
                // line 367
                echo (((($__internal_compile_168 = $context["filter"]) && is_array($__internal_compile_168) || $__internal_compile_168 instanceof ArrayAccess ? ($__internal_compile_168["collapse"] ?? null) : null)) ? ("collapsed") : (""));
                echo "\" data-toggle=\"collapse\" href=\"#tf-filter-panel-";
                echo ($context["module_class_id"] ?? null);
                echo "-";
                echo $context["key"];
                echo "\">
            <span class=\"tf-filter-group-title\">";
                // line 368
                echo (($__internal_compile_169 = $context["filter"]) && is_array($__internal_compile_169) || $__internal_compile_169 instanceof ArrayAccess ? ($__internal_compile_169["name"] ?? null) : null);
                echo "</span>
            ";
                // line 369
                if (($context["reset_group"] ?? null)) {
                    // line 370
                    echo "              ";
                    $context["total_selected"] = 0;
                    // line 371
                    echo "              ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable((($__internal_compile_170 = $context["filter"]) && is_array($__internal_compile_170) || $__internal_compile_170 instanceof ArrayAccess ? ($__internal_compile_170["values"] ?? null) : null));
                    foreach ($context['_seq'] as $context["_key"] => $context["value"]) {
                        if ((($__internal_compile_171 = $context["value"]) && is_array($__internal_compile_171) || $__internal_compile_171 instanceof ArrayAccess ? ($__internal_compile_171["selected"] ?? null) : null)) {
                            $context["total_selected"] = (($context["total_selected"] ?? null) + 1);
                        }
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 372
                    echo "              <a data-tf-reset=\"check\" data-toggle=\"tooltip\" title=\"";
                    echo ($context["text_reset"] ?? null);
                    echo "\" class=\"tf-filter-reset";
                    echo (( !($context["total_selected"] ?? null)) ? (" hide") : (""));
                    echo "\"><i class=\"fa fa-times\"></i></a>
            ";
                }
                // line 374
                echo "            <i class=\"fa fa-caret-up toggle-icon\"></i>
          </div>
          <div id=\"tf-filter-panel-";
                // line 376
                echo ($context["module_class_id"] ?? null);
                echo "-";
                echo $context["key"];
                echo "\" data-custom-filter=\"";
                echo (($__internal_compile_172 = $context["filter"]) && is_array($__internal_compile_172) || $__internal_compile_172 instanceof ArrayAccess ? ($__internal_compile_172["filter_id"] ?? null) : null);
                echo "\" class=\"collapse ";
                echo (( !(($__internal_compile_173 = $context["filter"]) && is_array($__internal_compile_173) || $__internal_compile_173 instanceof ArrayAccess ? ($__internal_compile_173["collapse"] ?? null) : null)) ? ("in") : (""));
                echo "\" >
            ";
                // line 377
                if ((($__internal_compile_174 = $context["filter"]) && is_array($__internal_compile_174) || $__internal_compile_174 instanceof ArrayAccess ? ($__internal_compile_174["search"] ?? null) : null)) {
                    // line 378
                    echo "              <div class=\"tf-filter-group-search\"><i class=\"fa fa-search\"></i> <input type=\"search\" placeholder=\"";
                    echo ($context["text_search"] ?? null);
                    echo "\"/></div>
            ";
                }
                // line 380
                echo "            <div class=\"tf-filter-group-content ";
                echo ($context["overflow"] ?? null);
                echo "\">
              ";
                // line 381
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((($__internal_compile_175 = $context["filter"]) && is_array($__internal_compile_175) || $__internal_compile_175 instanceof ArrayAccess ? ($__internal_compile_175["values"] ?? null) : null));
                foreach ($context['_seq'] as $context["_key"] => $context["value"]) {
                    // line 382
                    echo "                <div class=\"form-check tf-filter-value ";
                    echo (((($context["hide_zero_filter"] ?? null) &&  !twig_get_attribute($this->env, $this->source, $context["value"], "status", [], "any", false, false, false, 382))) ? ("hide") : (""));
                    echo " custom-";
                    echo (($__internal_compile_176 = $context["filter"]) && is_array($__internal_compile_176) || $__internal_compile_176 instanceof ArrayAccess ? ($__internal_compile_176["input_type"] ?? null) : null);
                    echo " ";
                    echo (($__internal_compile_177 = $context["filter"]) && is_array($__internal_compile_177) || $__internal_compile_177 instanceof ArrayAccess ? ($__internal_compile_177["list_type"] ?? null) : null);
                    echo "\">
                  <label class=\"form-check-label\">
                    ";
                    // line 384
                    if ((($__internal_compile_178 = $context["value"]) && is_array($__internal_compile_178) || $__internal_compile_178 instanceof ArrayAccess ? ($__internal_compile_178["selected"] ?? null) : null)) {
                        // line 385
                        echo "                      <input type=\"";
                        echo (($__internal_compile_179 = $context["filter"]) && is_array($__internal_compile_179) || $__internal_compile_179 instanceof ArrayAccess ? ($__internal_compile_179["input_type"] ?? null) : null);
                        echo "\" name=\"tf_fc";
                        echo (($__internal_compile_180 = $context["filter"]) && is_array($__internal_compile_180) || $__internal_compile_180 instanceof ArrayAccess ? ($__internal_compile_180["filter_id"] ?? null) : null);
                        echo "\" value=\"";
                        echo (($__internal_compile_181 = $context["value"]) && is_array($__internal_compile_181) || $__internal_compile_181 instanceof ArrayAccess ? ($__internal_compile_181["value_id"] ?? null) : null);
                        echo "\" class=\"form-check-input\" checked>
                    ";
                    } else {
                        // line 387
                        echo "                      <input type=\"";
                        echo (($__internal_compile_182 = $context["filter"]) && is_array($__internal_compile_182) || $__internal_compile_182 instanceof ArrayAccess ? ($__internal_compile_182["input_type"] ?? null) : null);
                        echo "\" name=\"tf_fc";
                        echo (($__internal_compile_183 = $context["filter"]) && is_array($__internal_compile_183) || $__internal_compile_183 instanceof ArrayAccess ? ($__internal_compile_183["filter_id"] ?? null) : null);
                        echo "\" value=\"";
                        echo (($__internal_compile_184 = $context["value"]) && is_array($__internal_compile_184) || $__internal_compile_184 instanceof ArrayAccess ? ($__internal_compile_184["value_id"] ?? null) : null);
                        echo "\" class=\"form-check-input\" ";
                        echo (( !(($__internal_compile_185 = $context["value"]) && is_array($__internal_compile_185) || $__internal_compile_185 instanceof ArrayAccess ? ($__internal_compile_185["status"] ?? null) : null)) ? ("disabled") : (""));
                        echo ">
                    ";
                    }
                    // line 389
                    echo "                    ";
                    if ((((($__internal_compile_186 = $context["filter"]) && is_array($__internal_compile_186) || $__internal_compile_186 instanceof ArrayAccess ? ($__internal_compile_186["list_type"] ?? null) : null) == "image") || ((($__internal_compile_187 = $context["filter"]) && is_array($__internal_compile_187) || $__internal_compile_187 instanceof ArrayAccess ? ($__internal_compile_187["list_type"] ?? null) : null) == "both"))) {
                        // line 390
                        echo "                      <img src=\"";
                        echo (($__internal_compile_188 = $context["value"]) && is_array($__internal_compile_188) || $__internal_compile_188 instanceof ArrayAccess ? ($__internal_compile_188["image"] ?? null) : null);
                        echo "\" title=\"";
                        echo (($__internal_compile_189 = $context["value"]) && is_array($__internal_compile_189) || $__internal_compile_189 instanceof ArrayAccess ? ($__internal_compile_189["name"] ?? null) : null);
                        echo "\" alt=\"";
                        echo (($__internal_compile_190 = $context["value"]) && is_array($__internal_compile_190) || $__internal_compile_190 instanceof ArrayAccess ? ($__internal_compile_190["name"] ?? null) : null);
                        echo "\" />
                    ";
                    } else {
                        // line 392
                        echo "                      <span class=\"checkmark fa\"></span>
                    ";
                    }
                    // line 394
                    echo "                    ";
                    if ((((($__internal_compile_191 = $context["filter"]) && is_array($__internal_compile_191) || $__internal_compile_191 instanceof ArrayAccess ? ($__internal_compile_191["list_type"] ?? null) : null) == "text") || ((($__internal_compile_192 = $context["filter"]) && is_array($__internal_compile_192) || $__internal_compile_192 instanceof ArrayAccess ? ($__internal_compile_192["list_type"] ?? null) : null) == "both"))) {
                        // line 395
                        echo "                      ";
                        echo (($__internal_compile_193 = $context["value"]) && is_array($__internal_compile_193) || $__internal_compile_193 instanceof ArrayAccess ? ($__internal_compile_193["name"] ?? null) : null);
                        echo "
                    ";
                    }
                    // line 397
                    echo "                  </label>
                  ";
                    // line 398
                    if ((($context["count_product"] ?? null) && ((($__internal_compile_194 = $context["filter"]) && is_array($__internal_compile_194) || $__internal_compile_194 instanceof ArrayAccess ? ($__internal_compile_194["list_type"] ?? null) : null) != "image"))) {
                        // line 399
                        echo "                    ";
                        if ((($__internal_compile_195 = $context["value"]) && is_array($__internal_compile_195) || $__internal_compile_195 instanceof ArrayAccess ? ($__internal_compile_195["total"] ?? null) : null)) {
                            // line 400
                            echo "                      <span class=\"label label-info tf-product-total\">";
                            echo (($__internal_compile_196 = $context["value"]) && is_array($__internal_compile_196) || $__internal_compile_196 instanceof ArrayAccess ? ($__internal_compile_196["total"] ?? null) : null);
                            echo "</span>
                    ";
                        } else {
                            // line 402
                            echo "                      <span class=\"label label-info label-danger tf-product-total\">";
                            echo (($__internal_compile_197 = $context["value"]) && is_array($__internal_compile_197) || $__internal_compile_197 instanceof ArrayAccess ? ($__internal_compile_197["total"] ?? null) : null);
                            echo "</span>
                    ";
                        }
                        // line 404
                        echo "                  ";
                    }
                    // line 405
                    echo "                </div>
              ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['value'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 407
                echo "              ";
                if (((($context["overflow"] ?? null) == "more") && (twig_length_filter($this->env, (($__internal_compile_198 = $context["filter"]) && is_array($__internal_compile_198) || $__internal_compile_198 instanceof ArrayAccess ? ($__internal_compile_198["values"] ?? null) : null)) >= 7))) {
                    // line 408
                    echo "                <a class=\"tf-see-more btn-link\" data-toggle=\"tf-seemore\" data-show=\"";
                    echo ($context["text_see_more"] ?? null);
                    echo "\" data-hide=\"";
                    echo ($context["text_see_less"] ?? null);
                    echo "\" href=\"#\">";
                    echo ($context["text_see_more"] ?? null);
                    echo "</a>
              ";
                }
                // line 410
                echo "            </div>
          </div>
        </div>
      ";
            }
            // line 414
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['filter'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 415
        echo "  </div>
</div>

<script type=\"text/javascript\">
  // Basel
  \$(document).ready(function() {
    \$('.filter-trigger-btn').addClass('active').html('<img src=\"image/filter.svg\" class=\"filter-icon\" alt=\"filter icon\"/>";
        // line 421
        echo ($context["heading_title"] ?? null);
        echo "');
    // Basel
    \$(\".filter-trigger-btn\").click(function(){
      \$('html').addClass('no-scroll side-filter-open');
      \$('.body-cover').addClass('active');
    });
  });
</script>


<script>
  \$(function(){
    /*if(window.innerWidth < 767){ // Collaped all panel in small device
        \$('.tf-filter .collapse.in').collapse(\"hide\");
    }*/

    // Filter
    var paginationContainer = \$('#content').children('.row').last();
    var productContainer = paginationContainer.prev();

    productContainer.css('position', 'relative');

    \$('#tf-filter-";
        // line 443
        echo ($context["module_class_id"] ?? null);
        echo "').tf_filter({
      requestURL: \"";
        // line 444
        echo ($context["requestURL"] ?? null);
        echo "\",
      searchEl: \$('.tf-filter-group-search input'),
      ajax: ";
        // line 446
        echo ((($context["ajax"] ?? null)) ? ("true") : ("false"));
        echo ",
      delay: ";
        // line 447
        echo ((($context["delay"] ?? null)) ? ("true") : ("false"));
        echo ",
      hideZeroFilter: ";
        // line 448
        echo ((($context["hide_zero_filter"] ?? null)) ? ("true") : ("false"));
        echo ",
      search_in_description: ";
        // line 449
        echo ((($context["search_in_description"] ?? null)) ? ("true") : ("false"));
        echo ",
      countProduct: ";
        // line 450
        echo ((($context["count_product"] ?? null)) ? ("true") : ("false"));
        echo ",
      sortBy: '";
        // line 451
        echo ($context["sort_by"] ?? null);
        echo "',
      onParamChange: function(param){
        \$(\"#input-limit,#input-sort\").find('option').each(function(){
          var url = \$(this).attr('value');
          \$(this).attr('value', modifyURLQuery(url, \$.extend({}, param, {page: null})));
        });
        var currency = \$('#form-currency input[name=\"redirect\"]');
        currency.val(modifyURLQuery(currency.val(), \$.extend({}, param, {tf_fp: null, page: null})));

        // Show or hide reset all button
        if(\$('.tf-filter-group [data-tf-reset]:not(.hide)').length){
          \$('[data-tf-reset=\"all\"]').removeClass('hide');
        } else {
          \$('[data-tf-reset=\"all\"]').addClass('hide');
        }
      },
      onInputChange: function(e){
        var filter_group = \$(e.target).closest('.tf-filter-group');

        var is_input_selected = false;

        // Hide Reset for Checkbox or radio
        if(filter_group.find('input[type=\"checkbox\"]:checked,input[type=\"radio\"]:checked').length){
          is_input_selected = true;
        }

        // Hide Reset for price
        if(\$(e.target).filter('[name=\"tf_fp[min]\"],[name=\"tf_fp[max]\"]').length){
          if(\$('[name=\"tf_fp[min]\"]').val() !== \$('[name=\"tf_fp[min]\"]').attr('min') || \$('[name=\"tf_fp[max]\"]').val() !== \$('[name=\"tf_fp[max]\"]').attr('max')){
            is_input_selected = true;
          }
        }

        // Hide reset for text
        if(\$(e.target).filter('[type=\"text\"]').val()){
          is_input_selected = true;
        }

        // Hide or show reset buton
        if(is_input_selected){
          filter_group.find('[data-tf-reset]').removeClass('hide');
        } else {
          filter_group.find('[data-tf-reset]').addClass('hide');
        }
      },
      onReset: function(el_reset){
        var type = \$(el_reset).data('tf-reset');

        // Reset price
        if(type === 'price' || type === 'all'){
          price_slider.slider(\"values\", [parseFloat(price_slider.slider(\"option\", 'min')), parseFloat(price_slider.slider(\"option\", 'max'))]);
        }

        // Hide reset button
        if(\$(el_reset).data('tf-reset') !== 'all'){
          \$(el_reset).addClass('hide');
        } else {
          \$('[data-tf-reset]').addClass('hide');
        }
      },
      onBeforeSend: function(){
        productContainer.append('<div class=\"tf-loader\"><img src=\"catalog/view/javascript/maza/loader.gif\" /></div>');
      },
      onResult: function(json){
        var content = \$(json['content']).find('#content');
        var products = content.children('.row').last().prev().html();
        var pagination = content.children('.row').last().html();

        // Add result products to container
        if(products){
          \$(productContainer).html(products);

          \$('#list-view.active').click();
          \$('#grid-view.active').click();
        } else {
          \$(productContainer).html(\"<div class='col-xs-12 text-center'>";
        // line 526
        echo ($context["text_no_result"] ?? null);
        echo "</div>\");
        }

        // Add pagination to container
        if(pagination){
          \$(paginationContainer).html(pagination);
        } else {
          \$(paginationContainer).empty();
        }
      }
    });

    // Price slider
    var price_slider = \$(\".tf-filter [data-role='rangeslider']\").slider({
      range: true,
      min: parseFloat(\$('[name=\"tf_fp[min]\"]').attr('min')),
      max: parseFloat(\$('[name=\"tf_fp[max]\"]').attr('max')),
      values: [parseFloat(\$('[name=\"tf_fp[min]\"]').val()), parseFloat(\$('[name=\"tf_fp[max]\"]').val())],
      slide: function( event, ui ) {
        \$('[name=\"tf_fp[min]\"]').val(ui.values[0]);
        \$('[name=\"tf_fp[max]\"]').val(ui.values[1]);
      },
      change: function( event, ui ) {
        // Hide Reset for price
        if(\$('[name=\"tf_fp[min]\"]').val() !== \$('[name=\"tf_fp[min]\"]').attr('min') || \$('[name=\"tf_fp[max]\"]').val() !== \$('[name=\"tf_fp[max]\"]').attr('max')){
          \$('[data-tf-reset=\"price\"]').removeClass('hide');
        } else {
          \$('[data-tf-reset=\"price\"]').addClass('hide');
        }

        // Trigger filter change
        \$('#tf-filter-";
        // line 557
        echo ($context["module_class_id"] ?? null);
        echo "').change();
      }
    });
    \$('[name=\"tf_fp[min]\"]').change(function(){
      price_slider.slider(\"values\", 0, \$(this).val());
    });
    \$('[name=\"tf_fp[max]\"]').change(function(){
      price_slider.slider(\"values\", 1, \$(this).val());
    });

    // Show reset all button if filter is selected
    if(\$('.tf-filter-group [data-tf-reset]:not(.hide)').length){
      \$('[data-tf-reset=\"all\"]').removeClass('hide');
    }

    // Fix z-index
    \$('.tf-filter-group .collapse').on('show.bs.collapse', function(){
      var z_index = Number(\$('#tf-filter-content-";
        // line 574
        echo ($context["module_class_id"] ?? null);
        echo "').data('tf-base-z-index')) + 1;
      \$(this).css('z-index', z_index);
      \$('#tf-filter-content-";
        // line 576
        echo ($context["module_class_id"] ?? null);
        echo "').data('tf-base-z-index', z_index);
    });
  });
</script>
<link href=\"catalog/view/theme/default/stylesheet/tf_filter.css\" rel=\"stylesheet\" media=\"screen\" />";
    }

    public function getTemplateName()
    {
        return "default/template/extension/module/tf_filter.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1760 => 576,  1755 => 574,  1735 => 557,  1701 => 526,  1623 => 451,  1619 => 450,  1615 => 449,  1611 => 448,  1607 => 447,  1603 => 446,  1598 => 444,  1594 => 443,  1569 => 421,  1561 => 415,  1555 => 414,  1549 => 410,  1539 => 408,  1536 => 407,  1529 => 405,  1526 => 404,  1520 => 402,  1514 => 400,  1511 => 399,  1509 => 398,  1506 => 397,  1500 => 395,  1497 => 394,  1493 => 392,  1483 => 390,  1480 => 389,  1468 => 387,  1458 => 385,  1456 => 384,  1446 => 382,  1442 => 381,  1437 => 380,  1431 => 378,  1429 => 377,  1419 => 376,  1415 => 374,  1407 => 372,  1395 => 371,  1392 => 370,  1390 => 369,  1386 => 368,  1378 => 367,  1363 => 366,  1360 => 365,  1355 => 362,  1345 => 360,  1342 => 359,  1335 => 357,  1332 => 356,  1326 => 354,  1320 => 352,  1317 => 351,  1315 => 350,  1310 => 348,  1307 => 347,  1299 => 345,  1293 => 343,  1291 => 342,  1285 => 340,  1281 => 339,  1276 => 338,  1270 => 336,  1268 => 335,  1260 => 334,  1256 => 332,  1248 => 330,  1236 => 329,  1233 => 328,  1231 => 327,  1227 => 326,  1219 => 325,  1204 => 324,  1201 => 323,  1196 => 320,  1189 => 318,  1186 => 317,  1180 => 315,  1174 => 313,  1171 => 312,  1169 => 311,  1164 => 309,  1161 => 308,  1153 => 306,  1147 => 304,  1145 => 303,  1141 => 301,  1137 => 300,  1128 => 298,  1124 => 296,  1116 => 294,  1104 => 293,  1101 => 292,  1099 => 291,  1095 => 290,  1087 => 289,  1074 => 288,  1071 => 287,  1066 => 284,  1059 => 282,  1056 => 281,  1050 => 279,  1044 => 277,  1041 => 276,  1039 => 275,  1034 => 273,  1031 => 272,  1025 => 271,  1021 => 269,  1017 => 267,  1014 => 266,  1010 => 265,  1006 => 263,  998 => 261,  992 => 259,  990 => 258,  986 => 256,  982 => 255,  973 => 253,  969 => 251,  961 => 249,  949 => 248,  946 => 247,  944 => 246,  940 => 245,  932 => 244,  919 => 243,  916 => 242,  911 => 239,  901 => 237,  898 => 236,  892 => 235,  889 => 234,  883 => 232,  877 => 230,  874 => 229,  872 => 228,  867 => 226,  864 => 225,  854 => 223,  846 => 221,  844 => 220,  831 => 218,  827 => 217,  819 => 216,  815 => 214,  807 => 212,  795 => 211,  792 => 210,  790 => 209,  786 => 208,  778 => 207,  763 => 206,  760 => 205,  754 => 201,  751 => 200,  745 => 198,  739 => 196,  736 => 195,  734 => 194,  729 => 192,  726 => 191,  720 => 189,  716 => 187,  714 => 186,  709 => 183,  706 => 182,  700 => 180,  694 => 178,  691 => 177,  689 => 176,  684 => 174,  681 => 173,  675 => 171,  671 => 169,  669 => 168,  658 => 164,  654 => 162,  651 => 161,  645 => 159,  639 => 157,  636 => 156,  634 => 155,  630 => 154,  622 => 153,  609 => 152,  606 => 151,  597 => 147,  588 => 145,  584 => 143,  581 => 142,  575 => 140,  569 => 138,  566 => 137,  564 => 136,  560 => 135,  552 => 134,  539 => 133,  536 => 132,  531 => 129,  521 => 127,  518 => 126,  511 => 124,  508 => 123,  502 => 121,  496 => 119,  493 => 118,  491 => 117,  488 => 116,  482 => 114,  479 => 113,  475 => 111,  465 => 109,  462 => 108,  452 => 106,  444 => 104,  442 => 103,  432 => 101,  428 => 100,  423 => 99,  417 => 97,  415 => 96,  407 => 95,  403 => 93,  395 => 91,  383 => 90,  380 => 89,  378 => 88,  374 => 87,  366 => 86,  351 => 85,  348 => 84,  342 => 80,  332 => 78,  329 => 77,  322 => 75,  319 => 74,  313 => 72,  307 => 70,  304 => 69,  302 => 68,  299 => 67,  293 => 65,  290 => 64,  286 => 62,  276 => 60,  273 => 59,  263 => 57,  255 => 55,  253 => 54,  243 => 52,  239 => 51,  234 => 50,  228 => 48,  226 => 47,  218 => 46,  214 => 44,  206 => 42,  194 => 41,  191 => 40,  189 => 39,  185 => 38,  177 => 37,  162 => 36,  159 => 35,  146 => 29,  138 => 28,  127 => 24,  123 => 22,  120 => 21,  114 => 19,  108 => 17,  105 => 16,  103 => 15,  99 => 14,  91 => 13,  78 => 12,  74 => 11,  70 => 10,  64 => 9,  60 => 7,  54 => 5,  52 => 4,  48 => 3,  42 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/extension/module/tf_filter.twig", "");
    }
}
