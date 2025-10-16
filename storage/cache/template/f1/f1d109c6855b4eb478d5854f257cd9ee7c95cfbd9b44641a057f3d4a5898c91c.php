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

/* extension_liveopencart/product_option_image_pro/product_page.twig */
class __TwigTemplate_eed85fe16689a6da9c4d1bf670daebef9e6b46b0d5131e8f3a93639e27268252 extends \Twig\Template
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
        echo "<script  type = \"text/javascript\" ><!--
\t(function(\$poip_custom_container, custom_setPoipProductCustomMethods){
\t\t
\t\tlet  poip_product_settings = ";
        // line 4
        echo json_encode(["product_option_ids" =>         // line 6
($context["poip_product_option_ids"] ?? null), "images" =>         // line 7
($context["poip_images"] ?? null), "images_by_povs" =>         // line 8
($context["poip_images_by_povs"] ?? null), "module_settings" =>         // line 9
($context["poip_settings"] ?? null), "options_settings" =>         // line 10
($context["poip_product_settings"] ?? null), "poip_ov" => ((        // line 11
$context["poip_ov"]) ?? (0)), "default_image_title" =>         // line 12
($context["heading_title"] ?? null)]);
        // line 14
        echo ";
\t\t
\t\tpoip_product_settings.custom_setPoipProductCustomMethods = custom_setPoipProductCustomMethods;
\t\t
\t\tif ( \$poip_custom_container ) {
\t\t\tpoip_product_settings.\$container = \$poip_custom_container;
\t\t}
\t\t
\t\tif ( typeof(poip_custom_product_settings) != 'undefined' && poip_custom_product_settings ) {
\t\t\t\$.extend(poip_product_settings, poip_custom_product_settings);
\t\t}
\t\t
\t\t";
        // line 26
        if ((($context["poip_custom_js_settings"]) ?? (false))) {
            // line 27
            echo "\t\t\tpoip_product_settings.theme_settings = ";
            echo json_encode(($context["poip_custom_js_settings"] ?? null));
            echo ";
\t\t";
        }
        // line 29
        echo "\t\t
\t\tlet initPoip = function(){
\t\t\tlet poip_product = getPoipProduct(custom_setPoipProductCustomMethods);
\t\t\tpoip_common.initObject(poip_product, poip_product_settings);
\t\t};
\t\t
\t\tlet event_id = 'poip_scripts_loaded_'+(''+Math.random(1000000,9999999)).replace('.','_')+'_'+(new Date()).getTime();
\t\t
\t\tdocument.addEventListener(event_id, function(){
\t\t\tinitPoip();
\t\t}, {once: true});
\t\t
\t\tif ( typeof(getPoipProduct) != 'undefined' ) {
\t\t\tinitPoip();
\t\t} else {
\t\t\t
\t\t\tlet poip_interval_timer = setInterval(function(){
\t\t\t\tif ( typeof(getPoipProduct) != 'undefined' && (\$('script[src*=\"theme_product.js\"]').length == 0 || typeof(setPoipProductCustomMethods) != 'undefined') ) {
\t\t\t\t\tclearInterval(poip_interval_timer);
\t\t\t\t\ttry {
\t\t\t\t\t\tdocument.dispatchEvent( new Event(event_id) );
\t\t\t\t\t} catch(e) {
\t\t\t\t\t\tconsole.debug(e); // IE
\t\t\t\t\t}
\t\t\t\t}
\t\t\t}, 50);
\t\t\t
\t\t\tdocument.addEventListener(\"DOMContentLoaded\", function(){
\t\t\t\ttry {
\t\t\t\t\tdocument.dispatchEvent( new Event(event_id) );
\t\t\t\t} catch(e) {
\t\t\t\t\tconsole.debug(e); // IE
\t\t\t\t}
\t\t\t}, {once: true});
\t\t\t

\t\t}
\t
\t\t
\t})( (typeof(\$poip_custom_container) != 'undefined' ? \$poip_custom_container : false), (typeof(custom_setPoipProductCustomMethods) != 'undefined' ? custom_setPoipProductCustomMethods : false ) );
\t
//--></script>";
    }

    public function getTemplateName()
    {
        return "extension_liveopencart/product_option_image_pro/product_page.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 29,  67 => 27,  65 => 26,  51 => 14,  49 => 12,  48 => 11,  47 => 10,  46 => 9,  45 => 8,  44 => 7,  43 => 6,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension_liveopencart/product_option_image_pro/product_page.twig", "");
    }
}
