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

/* extension/module/msmart_search/index.twig */
class __TwigTemplate_fad0551cf88b2984bfb408e46fc5737b8a2594894d7c05ab640c5beb9e66b04d extends \Twig\Template
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
        $this->loadTemplate("extension/module/msmart_search/_header.twig", "extension/module/msmart_search/index.twig", 1)->display($context);
        // line 2
        echo "
<br />

<ul class=\"nav nav-tabs\">
\t";
        // line 6
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["groups"] ?? null));
        foreach ($context['_seq'] as $context["type"] => $context["items"]) {
            echo " 
\t\t<li";
            // line 7
            echo ((($context["type"] == "products")) ? (" class=\"active\"") : (""));
            echo "><a data-toggle=\"tab\" href=\"#tab-";
            echo $context["type"];
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context, ("text_" . $context["type"]), [], "any", false, false, false, 7);
            echo "</a></li>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['type'], $context['items'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 8
        echo " 
</ul>

<div class=\"tab-content\">
\t";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["groups"] ?? null));
        foreach ($context['_seq'] as $context["type"] => $context["items"]) {
            echo " 
\t\t<div class=\"tab-pane";
            // line 13
            echo ((($context["type"] == "products")) ? (" active") : (""));
            echo "\" id=\"tab-";
            echo $context["type"];
            echo "\">
\t\t\t";
            // line 14
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["items"]);
            foreach ($context['_seq'] as $context["group"] => $context["items2"]) {
                echo " 
\t\t\t\t<h3>";
                // line 15
                echo twig_get_attribute($this->env, $this->source, $context, ("text_" . $context["group"]), [], "any", false, false, false, 15);
                echo "</h3>
\t\t\t\t<table class=\"table table-bordered table-hover table-striped\">
\t\t\t\t\t<thead>
\t\t\t\t\t\t";
                // line 18
                echo (($__internal_compile_0 = $context["items2"]) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["thead"] ?? null) : null);
                echo "
\t\t\t\t\t</thead>
\t\t\t\t\t<tbody>
\t\t\t\t\t\t";
                // line 21
                echo (($__internal_compile_1 = $context["items2"]) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["tbody"] ?? null) : null);
                echo "
\t\t\t\t\t</tbody>
\t\t\t\t</table>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['group'], $context['items2'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 25
            echo "\t\t\t<div class=\"hide\" id=\"preview-query-";
            echo $context["type"];
            echo " }\">
\t\t\t\t<strong>";
            // line 26
            echo ($context["text_preview_conditions"] ?? null);
            echo " }:</strong><br /><br />
\t\t\t\t<code style=\"padding: 3px 6px; display: block; white-space: normal;\"></code><br />
\t\t\t\t";
            // line 28
            echo ((($context["type"] == "products")) ? (($context["text_preview_conditions_guide"] ?? null)) : (""));
            echo " }}
\t\t\t</div>
\t\t</div>
\t ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['type'], $context['items'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 32
        echo "</div>

<div class=\"hide\" id=\"preview-query\">
\t<strong>";
        // line 35
        echo ($context["text_preview_conditions"] ?? null);
        echo ":</strong><br /><br />
\t<code style=\"padding: 3px 6px; display: block; white-space: normal;\"></code><br />
\t";
        // line 37
        echo ($context["text_preview_conditions_guide"] ?? null);
        echo " 
</div>

<script type=\"text/javascript\">\t
\t(function(){
\t\t\$('input[data-field]').on('change keyup', function(){
\t\t\tvar s = \$(this).val() === '',
\t\t\t\ttype = \$(this).attr('data-type');

\t\t\t\$('#status-'+type+'-'+\$(this).attr('data-field')).removeClass(s?'fa-check':'fa-remove').addClass(s?'fa-remove':'fa-check');
\t\t\t
\t\t\tpreview( type );
\t\t});
\t\t
\t\tfunction ksort(obj){
\t\t\tvar keys = Object.keys(obj).sort(), 
\t\t\t\tsortedObj = {};

\t\t\tfor(var i in keys) {
\t\t\t\tsortedObj[keys[i]] = obj[keys[i]];
\t\t\t}

\t\t\treturn sortedObj;
\t\t}
\t
\t\tfunction preview( type ) {
\t\t\tvar groups = {},
\t\t\t\tpreview = [],
\t\t\t\ti, j;
\t\t\t
\t\t\tfunction each( split ) {
\t\t\t\tsplit = split ? '1' : '0';
\t\t\t\t
\t\t\t\t\$('input[data-field][data-type=\"' + type + '\"]').each(function(){
\t\t\t\t\tvar val = \$(this).val(),
\t\t\t\t\t\tfield = \$(this).attr('data-field');

\t\t\t\t\tif( val !== '' ) {
\t\t\t\t\t\tvar phrase = [ 'search phrase' ],
\t\t\t\t\t\t\twords = [];
\t\t\t\t\t\t
\t\t\t\t\t\tif( split == '1' ) {
\t\t\t\t\t\t\tphrase = phrase[0].split(' ');
\t\t\t\t\t\t}
\t\t\t\t\t\t
\t\t\t\t\t\tfor( i = 0; i < phrase.length; i++ ) {
\t\t\t\t\t\t\twords.push( field + \" LIKE '%\" + phrase[i] + \"%'\" );
\t\t\t\t\t\t}
\t\t\t\t\t\t
\t\t\t\t\t\tif( typeof groups[split] == 'undefined' ) {
\t\t\t\t\t\t\tgroups[split] = {};
\t\t\t\t\t\t}
\t\t\t\t\t\t
\t\t\t\t\t\tif( typeof groups[split][val] == 'undefined' ) {
\t\t\t\t\t\t\tgroups[split][val] = [];
\t\t\t\t\t\t}

\t\t\t\t\t\tgroups[split][val].push( words.join( ' AND ' ) );
\t\t\t\t\t}
\t\t\t\t});
\t\t\t\t
\t\t\t\treturn each;
\t\t\t}
\t\t\t
\t\t\teach()( true );
\t\t\t
\t\t\tfor( i in groups ) {
\t\t\t\tgroups[i] = ksort( groups[i] );
\t\t\t}
\t\t\t
\t\t\tfor( i in groups['0'] ) {
\t\t\t\tpreview.push( ( preview.length + 1 ) + ') (' + groups['0'][i].join( ') OR (' ) + ')' );
\t\t\t\tpreview.push( ( preview.length + 1 ) + ') (' + groups['1'][i].join( ') OR (' ) + ')' );
\t\t\t}
\t\t\t
\t\t\t\$('#preview-query-'+type)[preview.length?'removeClass':'addClass']('hide').find('code').html( preview.join( '<br />' ) );
\t\t}
\t\t
\t\t";
        // line 115
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["groups"] ?? null));
        foreach ($context['_seq'] as $context["type"] => $context["items"]) {
            echo " 
\t\t\tpreview('";
            // line 116
            echo $context["type"];
            echo "');
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['type'], $context['items'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 117
        echo " 
\t})();
</script>

<div class=\"clearfix\"></div>

";
        // line 123
        $this->loadTemplate("extension/module/msmart_search/_footer.twig", "extension/module/msmart_search/index.twig", 123)->display($context);
    }

    public function getTemplateName()
    {
        return "extension/module/msmart_search/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  242 => 123,  234 => 117,  226 => 116,  220 => 115,  139 => 37,  134 => 35,  129 => 32,  119 => 28,  114 => 26,  109 => 25,  99 => 21,  93 => 18,  87 => 15,  81 => 14,  75 => 13,  69 => 12,  63 => 8,  51 => 7,  45 => 6,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/module/msmart_search/index.twig", "");
    }
}
