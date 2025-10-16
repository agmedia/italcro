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

/* extension/basel/panel_tabs/image-sizes.twig */
class __TwigTemplate_54ef1d40c489fa4100db4894d67ed0abc22cd4db22b2785e1b9661741d20f788 extends \Twig\Template
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
        echo "<legend>Image Sizes</legend>



<legend class=\"sub\">Product Pages</legend>
            <div class=\"form-group\">
              <label class=\"col-sm-2 control-label\">Main Product Image (W x H)</label>
              <div class=\"col-sm-10\">
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[theme_default][theme_default_image_thumb_width]\" value=\"";
        // line 11
        echo ($context["theme_default_image_thumb_width"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[theme_default][theme_default_image_thumb_height]\" value=\"";
        // line 14
        echo ($context["theme_default_image_thumb_height"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                </div>
              </div>
            </div>
            
            <div class=\"form-group\">
              <label class=\"col-sm-2 control-label\">Additional Images (W x H)</label>
              <div class=\"col-sm-10\">
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[theme_default][theme_default_image_additional_width]\" value=\"";
        // line 25
        echo ($context["theme_default_image_additional_width"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[theme_default][theme_default_image_additional_height]\" value=\"";
        // line 28
        echo ($context["theme_default_image_additional_height"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                </div>
              </div>
            </div>
            
            <div class=\"form-group\">
              <label class=\"col-sm-2 control-label\">Zoom/Popup image (W x H)</label>
              <div class=\"col-sm-10\">
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[theme_default][theme_default_image_popup_width]\" value=\"";
        // line 39
        echo ($context["theme_default_image_popup_width"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[theme_default][theme_default_image_popup_height]\" value=\"";
        // line 42
        echo ($context["theme_default_image_popup_height"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                </div>
              </div>
            </div>
            
            <div class=\"form-group\">
              <label class=\"col-sm-2 control-label\">Related Products (W x H)</label>
              <div class=\"col-sm-10\">
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[theme_default][theme_default_image_related_width]\" value=\"";
        // line 53
        echo ($context["theme_default_image_related_width"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[theme_default][theme_default_image_related_height]\" value=\"";
        // line 56
        echo ($context["theme_default_image_related_height"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                </div>
              </div>
            </div>
            
            
            
            
<legend class=\"sub\">Category Pages</legend>           
            <div class=\"form-group\">
              <label class=\"col-sm-2 control-label\">Main Category Image (W x H)</label>
              <div class=\"col-sm-10\">
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[theme_default][theme_default_image_category_width]\" value=\"";
        // line 71
        echo ($context["theme_default_image_category_width"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[theme_default][theme_default_image_category_height]\" value=\"";
        // line 74
        echo ($context["theme_default_image_category_height"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                </div>
              </div>
            </div>
            
            <div class=\"form-group\">
              <label class=\"col-sm-2 control-label\">Sub-categoriy Thumbs (W x H)</label>
              <div class=\"col-sm-10\">
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[basel][subcat_image_width]\" value=\"";
        // line 85
        echo ($context["subcat_image_width"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[basel][subcat_image_height]\" value=\"";
        // line 88
        echo ($context["subcat_image_height"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                </div>
              </div>
            </div>
                        
            <div class=\"form-group\">
              <label class=\"col-sm-2 control-label\">Product Listings Images (W x H)</label>
              <div class=\"col-sm-10\">
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[theme_default][theme_default_image_product_width]\" value=\"";
        // line 99
        echo ($context["theme_default_image_product_width"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[theme_default][theme_default_image_product_height]\" value=\"";
        // line 102
        echo ($context["theme_default_image_product_height"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                </div>
              </div>
            </div>
            
            <legend class=\"sub\">Quickview Popup</legend>
            <div class=\"form-group\">
              <label class=\"col-sm-2 control-label\">Quickview Image (W x H)</label>
              <div class=\"col-sm-10\">
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[basel][quickview_popup_image_width]\" value=\"";
        // line 114
        echo ($context["quickview_popup_image_width"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[basel][quickview_popup_image_height]\" value=\"";
        // line 117
        echo ($context["quickview_popup_image_height"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                </div>
              </div>
            </div>
            
            
            
            <legend class=\"sub\">Product Comparison Pages</legend>
            
            <div class=\"form-group\">
              <label class=\"col-sm-2 control-label\">Compare Image (W x H)</label>
              <div class=\"col-sm-10\">
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[theme_default][theme_default_image_compare_width]\" value=\"";
        // line 132
        echo ($context["theme_default_image_compare_width"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[theme_default][theme_default_image_compare_height]\" value=\"";
        // line 135
        echo ($context["theme_default_image_compare_height"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                </div>
              </div>
            </div>
            
            <legend class=\"sub\">Wishlist Pages</legend>
            
            <div class=\"form-group\">
              <label class=\"col-sm-2 control-label\">Wish List Image (W x H)</label>
              <div class=\"col-sm-10\">
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[theme_default][theme_default_image_wishlist_width]\" value=\"";
        // line 148
        echo ($context["theme_default_image_wishlist_width"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[theme_default][theme_default_image_wishlist_height]\" value=\"";
        // line 151
        echo ($context["theme_default_image_wishlist_height"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                </div>
              </div>
            </div>
            
            <legend class=\"sub\">Shopping Cart Page</legend>
            
            <div class=\"form-group\">
              <label class=\"col-sm-2 control-label\">Cart Image (W x H)</label>
              <div class=\"col-sm-10\">
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[theme_default][theme_default_image_cart_width]\" value=\"";
        // line 164
        echo ($context["theme_default_image_cart_width"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[theme_default][theme_default_image_cart_height]\" value=\"";
        // line 167
        echo ($context["theme_default_image_cart_height"] ?? null);
        echo "\"  class=\"form-control\" />
                  </div>
                </div>
              </div>
            </div>
            
            <legend class=\"sub\">Contact Page</legend>
            <div class=\"form-group\">
              <label class=\"col-sm-2 control-label\">Store Image (W x H)</label>
              <div class=\"col-sm-10\">
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[theme_default][theme_default_image_location_width]\" value=\"";
        // line 179
        echo ($context["theme_default_image_location_width"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"settings[theme_default][theme_default_image_location_height]\" value=\"";
        // line 182
        echo ($context["theme_default_image_location_height"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                </div>
              </div>
            </div>";
    }

    public function getTemplateName()
    {
        return "extension/basel/panel_tabs/image-sizes.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  289 => 182,  283 => 179,  268 => 167,  262 => 164,  246 => 151,  240 => 148,  224 => 135,  218 => 132,  200 => 117,  194 => 114,  179 => 102,  173 => 99,  159 => 88,  153 => 85,  139 => 74,  133 => 71,  115 => 56,  109 => 53,  95 => 42,  89 => 39,  75 => 28,  69 => 25,  55 => 14,  49 => 11,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/basel/panel_tabs/image-sizes.twig", "/Users/tomek/Herd/reprograv/upload/admin/view/template/extension/basel/panel_tabs/image-sizes.twig");
    }
}
