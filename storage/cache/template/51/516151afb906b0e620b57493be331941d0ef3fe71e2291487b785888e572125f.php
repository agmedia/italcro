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

/* basel/template/extension/module/content_widgets/map.twig */
class __TwigTemplate_67f346d9982ed7190e6908f68ad034f3d25bd82d207cb657f7de01bdd865b9ef extends \Twig\Template
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
        echo "<div id=\"gmap\" class=\"map-widget\"></div>
<script>
\$(document).ready(function() {
new Maplace({
\tlocations: [
\t\t{
\t\tlat: ";
        // line 7
        echo ($context["basel_map_lat"] ?? null);
        echo ",
\t\tlon: ";
        // line 8
        echo ($context["basel_map_lon"] ?? null);
        echo ",
\t\t}
\t],
\tcontrols_on_map: true,
\tstart: 1,
\tmap_options: {
\t\tzoom: 15,
\t\tscrollwheel: false}
}).Load(); 
});
</script>";
    }

    public function getTemplateName()
    {
        return "basel/template/extension/module/content_widgets/map.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 8,  45 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/extension/module/content_widgets/map.twig", "");
    }
}
