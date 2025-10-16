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

/* extension/basel/basel.twig */
class __TwigTemplate_da21572698ffe1164d212f05817c11d7bc6d27ef03f35b2d55758e62eeeb6a0e extends \Twig\Template
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
        echo ($context["column_left"] ?? null);
        echo "

<div id=\"content\">
  <div class=\"page-header\">
    <div class=\"container-fluid\">  
    
      <div class=\"pull-right\">
\t<button type=\"submit\" form=\"form-basel\" data-toggle=\"tooltip\" title=\"";
        // line 8
        echo ($context["button_save"] ?? null);
        echo "\" class=\"btn btn-primary\">Save</button>
    <a class=\"btn btn-default\" href=\"http://basel.openthemer.com/help\" target=\"_blank\" data-toggle=\"tooltip\" title=\"View Theme Documentation\">Documentation</a>
    </div>
      <h1>";
        // line 11
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      <ul class=\"breadcrumb\">
        ";
        // line 13
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 14
            echo "        <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 14);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 14);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 16
        echo "      </ul>
    </div>
  </div>
  
  <div class=\"container-fluid\">    
    ";
        // line 21
        if (($context["error_warning"] ?? null)) {
            // line 22
            echo "    <div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_permission"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 26
        echo "
    ";
        // line 27
        if (($context["success"] ?? null)) {
            // line 28
            echo "    <div class=\"alert alert-success\"><i class=\"fa fa-check-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 32
        echo "  
   <form action=\"";
        // line 33
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-basel\" class=\"form-horizontal\">
   
   <div class=\"panel-wrapper\">
   
   <div class=\"panel-left\">
   <div class=\"setting-header\">v 1.3.1.0</div>
   <ul class=\"menu list-unstyled\">
   <li class=\"active\"><a href=\"#tab-status\" data-toggle=\"tab\"><i class=\"fa fa-toggle-on\"></i> Status</a></li>
   <li><a href=\"#tab-shop\" data-toggle=\"tab\"><i class=\"fa fa-shopping-cart\"></i> Shop Settings</a></li>
   <li><a href=\"#tab-header\" data-toggle=\"tab\"><i class=\"fa fa-columns\"></i> Header</a></li>
   <li><a href=\"#tab-page-titles\" data-toggle=\"tab\"><i class=\"fa fa-chain\"></i> Breadcrumbs</a></li>
   <li><a href=\"#tab-product-pages\" data-toggle=\"tab\"><i class=\"fa fa-clone\"></i> Product Pages</a></li>
   <li><a href=\"#tab-category-pages\" data-toggle=\"tab\"><i class=\"fa fa-th\"></i> Category Pages</a></li>
   <li><a href=\"#tab-contact-page\" data-toggle=\"tab\"><i class=\"fa fa-envelope-o\"></i> Contact Page</a></li>
   <li><a href=\"#tab-footer\" data-toggle=\"tab\"><i class=\"fa fa-gears\"></i> Footer</a></li>
   <li><a href=\"#tab-notifications\" data-toggle=\"tab\"><i class=\"fa fa-comment-o\"></i> Notifications</a></li>
   <li><a href=\"#tab-styles\" data-toggle=\"tab\"><i class=\"fa fa-paint-brush\"></i> Design & Colors</a></li>
   <li><a href=\"#tab-typography\" data-toggle=\"tab\"><i class=\"fa fa-font\"></i> Typography</a></li>
   <li><a href=\"#tab-image-sizes\" data-toggle=\"tab\"><i class=\"fa fa-image\"></i> Image Sizes</a></li>
   <li><a href=\"#tab-custom-css\" data-toggle=\"tab\"><i class=\"fa fa-css3\"></i> Custom CSS</a></li>
   <li><a href=\"#tab-custom-javascript\" data-toggle=\"tab\"><i class=\"fa fa-code\"></i> Custom Javascript</a></li>
   <li><a href=\"#tab-one-click-installer\" data-toggle=\"tab\"><i class=\"fa fa-magic\"></i> One Click Installer</a></li>
   
   </ul>
   </div><!-- .panel-left ends -->
   
   <div class=\"panel-right\">
   <div class=\"store-header\">
   <div class=\"form-group\">
    <label class=\"col-sm-9 control-label\">Store to edit:</label>
        <div class=\"col-sm-3\">
            <select name=\"store_id\" class=\"form-control\">
                ";
        // line 65
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["result"]) {
            // line 66
            echo "                    ";
            if ((twig_get_attribute($this->env, $this->source, $context["result"], "store_id", [], "any", false, false, false, 66) == ($context["store_id"] ?? null))) {
                // line 67
                echo "                        <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["result"], "store_id", [], "any", false, false, false, 67);
                echo "\" selected=\"selected\">
                            ";
                // line 68
                echo twig_get_attribute($this->env, $this->source, $context["result"], "name", [], "any", false, false, false, 68);
                echo "
                        </option>
                    ";
            } else {
                // line 71
                echo "                        <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["result"], "store_id", [], "any", false, false, false, 71);
                echo "\">
                            ";
                // line 72
                echo twig_get_attribute($this->env, $this->source, $context["result"], "name", [], "any", false, false, false, 72);
                echo "
                        </option>
                    ";
            }
            // line 75
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['result'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 76
        echo "            </select>
        </div>
    </div>
   </div>
   
   
   
   <div class=\"main-content\">
   
   <div class=\"tab-content\">
   
       <div class=\"tab-pane active\" id=\"tab-status\">
       ";
        // line 88
        $this->loadTemplate("extension/basel/panel_tabs/status.twig", "extension/basel/basel.twig", 88)->display($context);
        // line 89
        echo "       </div>
       
       <div class=\"tab-pane\" id=\"tab-shop\">
       ";
        // line 92
        $this->loadTemplate("extension/basel/panel_tabs/shop.twig", "extension/basel/basel.twig", 92)->display($context);
        // line 93
        echo "       </div>
       
       <div class=\"tab-pane\" id=\"tab-header\">
       ";
        // line 96
        $this->loadTemplate("extension/basel/panel_tabs/header.twig", "extension/basel/basel.twig", 96)->display($context);
        // line 97
        echo "       </div>
       
       <div class=\"tab-pane\" id=\"tab-page-titles\">
       ";
        // line 100
        $this->loadTemplate("extension/basel/panel_tabs/page-titles.twig", "extension/basel/basel.twig", 100)->display($context);
        // line 101
        echo "       </div>
       
       <div class=\"tab-pane\" id=\"tab-product-pages\">
       ";
        // line 104
        $this->loadTemplate("extension/basel/panel_tabs/product-pages.twig", "extension/basel/basel.twig", 104)->display($context);
        // line 105
        echo "       </div>
       
       <div class=\"tab-pane\" id=\"tab-category-pages\">
       ";
        // line 108
        $this->loadTemplate("extension/basel/panel_tabs/category-pages.twig", "extension/basel/basel.twig", 108)->display($context);
        // line 109
        echo "       </div>
       
       <div class=\"tab-pane\" id=\"tab-contact-page\">
       ";
        // line 112
        $this->loadTemplate("extension/basel/panel_tabs/contact-page.twig", "extension/basel/basel.twig", 112)->display($context);
        // line 113
        echo "       </div>

       <div class=\"tab-pane\" id=\"tab-footer\">
       ";
        // line 116
        $this->loadTemplate("extension/basel/panel_tabs/footer.twig", "extension/basel/basel.twig", 116)->display($context);
        // line 117
        echo "       </div>
       
       <div class=\"tab-pane\" id=\"tab-notifications\">
       ";
        // line 120
        $this->loadTemplate("extension/basel/panel_tabs/notifications.twig", "extension/basel/basel.twig", 120)->display($context);
        // line 121
        echo "       </div>
       
       <div class=\"tab-pane\" id=\"tab-styles\">
       ";
        // line 124
        $this->loadTemplate("extension/basel/panel_tabs/styles.twig", "extension/basel/basel.twig", 124)->display($context);
        // line 125
        echo "       </div>
       
       <div class=\"tab-pane\" id=\"tab-typography\">
       ";
        // line 128
        $this->loadTemplate("extension/basel/panel_tabs/typography.twig", "extension/basel/basel.twig", 128)->display($context);
        // line 129
        echo "       </div>
       
       <div class=\"tab-pane\" id=\"tab-image-sizes\">
       ";
        // line 132
        $this->loadTemplate("extension/basel/panel_tabs/image-sizes.twig", "extension/basel/basel.twig", 132)->display($context);
        // line 133
        echo "       </div>
       
       <div class=\"tab-pane\" id=\"tab-custom-css\">
       ";
        // line 136
        $this->loadTemplate("extension/basel/panel_tabs/custom-css.twig", "extension/basel/basel.twig", 136)->display($context);
        // line 137
        echo "       </div>
       
       <div class=\"tab-pane\" id=\"tab-custom-javascript\">
       ";
        // line 140
        $this->loadTemplate("extension/basel/panel_tabs/custom-javascript.twig", "extension/basel/basel.twig", 140)->display($context);
        // line 141
        echo "       </div>
       
       <div class=\"tab-pane\" id=\"tab-one-click-installer\">
       ";
        // line 144
        $this->loadTemplate("extension/basel/panel_tabs/one-click-installer.twig", "extension/basel/basel.twig", 144)->display($context);
        // line 145
        echo "       </div>
       
    </div>
   
   </div> <!-- .main-content ends -->
    
  </div> <!-- panel-right ends -->
     
 </div>        
</form>
</div> <!-- content ends -->


<script type=\"text/javascript\"><!--
// Store selector
\$('select[name=\\'store_id\\']').on('change', function () {
    location = 'index.php?route=extension/basel/basel&user_token=";
        // line 161
        echo ($context["token"] ?? null);
        echo "&store_id=' +  encodeURIComponent(\$(this).val());
});
//--></script>
<script type=\"text/javascript\" src=\"view/javascript/summernote/summernote.js\"></script>
<link href=\"view/javascript/summernote/summernote.css\" rel=\"stylesheet\" />
<script type=\"text/javascript\" src=\"view/javascript/summernote/opencart.js\"></script>
<script type=\"text/javascript\">
// Header preview image
\$('#header-select').on('change', function() {
\$('#header-preview img').attr('src', 'view/javascript/basel/img/theme-panel/headers/' + \$(this).val() + '.png');
});
// Always open first tab
\$('.nav-tabs').each(function() {
\t\$(this).find('li:first a').tab('show');
});
// Static links on/off
\$('.links-select').on('change', function() {
if (\$(this).val() == '1') {
\t\$('#custom_links_holder').css('display', 'block');
} else {
\t\$('#custom_links_holder').css('display', 'none');
}
});
// Custom design on/off
\$('.design-select').on('change', function() {
if (\$(this).val() == '1') {
\t\$('#custom_design_holder').css('display', 'block');
} else {
\t\$('#custom_design_holder').css('display', 'none');
}
});
// Custom fonts on/off
\$('.typo-select').on('change', function() {
if (\$(this).val() == '1') {
\t\$('#basel_typo_holder').css('display', 'block');
} else {
\t\$('#basel_typo_holder').css('display', 'none');
}
});
// Custom footer links on/off
\$('.footer-custom-links-select').on('change', function() {
if (\$(this).val() == '1') {
\t\$('#custom_footer_links_holder').css('display', 'block');
} else {
\t\$('#custom_footer_links_holder').css('display', 'none');
}
});
// Custom CSS on/off
\$('.custom-css-select').on('change', function() {
if (\$(this).val() == '1') {
\t\$('#custom_css_holder').css('display', 'block');
} else {
\t\$('#custom_css_holder').css('display', 'none');
}
});
// Custom Javascript on/off
\$('.custom-js-select').on('change', function() {
if (\$(this).val() == '1') {
\t\$('#custom_js_holder').css('display', 'block');
} else {
\t\$('#custom_js_holder').css('display', 'none');
}
});
// Colorpicker 
\$('.colorfield input').colorpicker({
sliders: {
saturation: {maxLeft: 150, maxTop: 150},hue: { maxTop: 150},alpha: { maxTop: 150}}
}).on('changeColor.colorpicker', function(){
\$(this).parent().find('.input-group-addon i').css(\"background-color\", \$(this).val());
});
var enable_editor = function(area, lang_id) {
\tif ( \$('#enable-editor-' + area + '-' + lang_id + '').hasClass('active') ) {
\t\t\$('#enable-editor-' + area + '-' + lang_id + '').text('Enable HTML editor').removeClass('active');
\t\t\$('#editor-textarea-' + area + '-' + lang_id + '').summernote('destroy');
\t} else {
\t\t\$('#enable-editor-' + area + '-' + lang_id + '').text('Disable HTML editor').addClass('active');
\t\t\$('#editor-textarea-' + area + '-' + lang_id + '').summernote({
\t\t\tdisableDragAndDrop: true,
\t\t\tstyleWithSpan: false,
\t\t\theight: 260,
\t\t\temptyPara: '',
\t\t\tcodemirror: { // codemirror options
\t\t\t\tmode: 'text/html',
\t\t\t\thtmlMode: true,
\t\t\t\tlineNumbers: true,
\t\t\t\ttheme: 'monokai'
\t\t\t},\t\t\t
\t\t\tfontsize: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '24', '30', '36', '48' , '64'],
\t\t\ttoolbar: [
\t\t\t\t['style', ['style']],
\t\t\t\t['font', [ \"underline\",\"italic\", \"bold\", \"clear\"]],
\t\t\t\t['fontsize', ['fontsize']],
\t\t\t\t['color', ['color']],
\t\t\t\t['para', ['paragraph']],
\t\t\t\t['insert', ['link', 'image']],
\t\t\t\t['view', ['fullscreen', 'codeview']]
\t\t\t],
\t\t\tcallbacks: {
\t\t\t\t\tonPaste: function (e) {
\t\t\t\t\tvar bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
\t\t\t\t\te.preventDefault();
\t\t\t\t\tdocument.execCommand('insertText', false, bufferText);
\t\t\t\t\t}
            },
\t\t\tpopover: {
           \t\timage: [
\t\t\t\t\t['custom', ['imageAttributes']],
\t\t\t\t\t['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
\t\t\t\t\t['float', ['floatLeft', 'floatRight', 'floatNone']],
\t\t\t\t\t['remove', ['removeMedia']]
\t\t\t\t],
\t\t\t},
\t\t\tbuttons: {
    \t\t\timage: function() {
\t\t\t\t\tvar ui = \$.summernote.ui;
\t\t\t\t\t// create button
\t\t\t\t\tvar button = ui.button({
\t\t\t\t\t\tcontents: '<i class=\"fa fa-image\" />',
\t\t\t\t\t\ttooltip: \$.summernote.lang[\$.summernote.options.lang].image.image,
\t\t\t\t\t\tclick: function () {
\t\t\t\t\t\t\t\$('#modal-image').remove();
\t\t\t\t\t\t\t\$.ajax({
\t\t\t\t\t\t\t\turl: 'index.php?route=common/filemanager&user_token=' + getURLVar('user_token'),
\t\t\t\t\t\t\t\tdataType: 'html',
\t\t\t\t\t\t\t\tbeforeSend: function() {
\t\t\t\t\t\t\t\t\t\$('#button-image i').replaceWith('<i class=\"fa fa-circle-o-notch fa-spin\"></i>');
\t\t\t\t\t\t\t\t\t\$('#button-image').prop('disabled', true);
\t\t\t\t\t\t\t\t},
\t\t\t\t\t\t\t\tcomplete: function() {
\t\t\t\t\t\t\t\t\t\$('#button-image i').replaceWith('<i class=\"fa fa-upload\"></i>');
\t\t\t\t\t\t\t\t\t\$('#button-image').prop('disabled', false);
\t\t\t\t\t\t\t\t},
\t\t\t\t\t\t\t\tsuccess: function(html) {
\t\t\t\t\t\t\t\t\t\$('body').append('<div id=\"modal-image\" class=\"modal\">' + html + '</div>');
\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\$('#modal-image').modal('show');
\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\$('#modal-image').delegate('a.thumbnail', 'click', function(e) {
\t\t\t\t\t\t\t\t\t\te.preventDefault();
\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\$('#editor-textarea-' + area + '-' + lang_id + '').summernote('insertImage', \$(this).attr('href'));
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\$('#modal-image').modal('hide');
\t\t\t\t\t\t\t\t\t});
\t\t\t\t\t\t\t\t}});}});
\t\t\t\treturn button.render();
\t\t}}});
\t}
}
</script>
</div>
";
        // line 312
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "extension/basel/basel.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  463 => 312,  309 => 161,  291 => 145,  289 => 144,  284 => 141,  282 => 140,  277 => 137,  275 => 136,  270 => 133,  268 => 132,  263 => 129,  261 => 128,  256 => 125,  254 => 124,  249 => 121,  247 => 120,  242 => 117,  240 => 116,  235 => 113,  233 => 112,  228 => 109,  226 => 108,  221 => 105,  219 => 104,  214 => 101,  212 => 100,  207 => 97,  205 => 96,  200 => 93,  198 => 92,  193 => 89,  191 => 88,  177 => 76,  171 => 75,  165 => 72,  160 => 71,  154 => 68,  149 => 67,  146 => 66,  142 => 65,  107 => 33,  104 => 32,  96 => 28,  94 => 27,  91 => 26,  83 => 22,  81 => 21,  74 => 16,  63 => 14,  59 => 13,  54 => 11,  48 => 8,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/basel/basel.twig", "");
    }
}
