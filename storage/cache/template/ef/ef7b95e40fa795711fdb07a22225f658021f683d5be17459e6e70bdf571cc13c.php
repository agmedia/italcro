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

/* basel/template/blog/blog.twig */
class __TwigTemplate_685f458a0c3376ac706eda4a8e123122965671c2d74445e605dcd111691c56d6 extends \Twig\Template
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
<div class=\"container\">
  <ul class=\"breadcrumb\">
    ";
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 5
            echo "    <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 5);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 5);
            echo "</a></li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 7
        echo "  </ul>
  <div class=\"row\">";
        // line 8
        echo ($context["column_left"] ?? null);
        echo "
    ";
        // line 9
        if ((($context["column_left"] ?? null) && ($context["column_right"] ?? null))) {
            // line 10
            echo "    ";
            $context["class"] = "col-sm-6";
            // line 11
            echo "    ";
        } elseif ((($context["column_left"] ?? null) || ($context["column_right"] ?? null))) {
            // line 12
            echo "    ";
            $context["class"] = "col-md-9 col-sm-8";
            // line 13
            echo "    ";
        } else {
            // line 14
            echo "    ";
            $context["class"] = "col-sm-10 col-sm-offset-1";
            // line 15
            echo "    ";
        }
        // line 16
        echo "    
    <div id=\"content\" class=\"";
        // line 17
        echo ($context["class"] ?? null);
        echo "\">";
        echo ($context["content_top"] ?? null);
        echo "
    <div class=\"blog blog_post\">
    
    ";
        // line 20
        if ((($context["main_thumb"] ?? null) && ($context["blogsetting_post_thumb"] ?? null))) {
            // line 21
            echo "    <div class=\"main_thumb\">
    <img src=\"";
            // line 22
            echo ($context["main_thumb"] ?? null);
            echo "\" alt=\"";
            echo ($context["heading_title"] ?? null);
            echo "\" title=\"";
            echo ($context["heading_title"] ?? null);
            echo "\" />
    ";
            // line 23
            if (($context["post_date_added_status"] ?? null)) {
                // line 24
                echo "    <div class=\"date_added\">
    <span class=\"day\">";
                // line 25
                echo ($context["date_added_day"] ?? null);
                echo "</span>
    <b class=\"month\">";
                // line 26
                echo ($context["date_added_month"] ?? null);
                echo "</b>
    </div>
    ";
            }
            // line 29
            echo "    </div>
    ";
        }
        // line 31
        echo "    
\t<h1 id=\"page-title\" class=\"contrast-font\">";
        // line 32
        echo ($context["heading_title"] ?? null);
        echo "</h1>
\t
    <div class=\"blog_stats\">

\t</div>
    
    <div class=\"main_description\">
\t";
        // line 39
        echo ($context["description"] ?? null);
        echo "
    </div>
    
    ";
        // line 42
        if (($context["tags"] ?? null)) {
            // line 43
            echo "\t<p class=\"post_tags\">
    ";
            // line 44
            echo ($context["text_tags"] ?? null);
            echo "
\t";
            // line 45
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(0, twig_length_filter($this->env, ($context["tags"] ?? null))));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 46
                echo "    ";
                if (($context["i"] < (twig_length_filter($this->env, ($context["tags"] ?? null)) - 1))) {
                    echo " 
    <a href=\"";
                    // line 47
                    echo twig_get_attribute($this->env, $this->source, (($__internal_compile_0 = ($context["tags"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[$context["i"]] ?? null) : null), "href", [], "any", false, false, false, 47);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, (($__internal_compile_1 = ($context["tags"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[$context["i"]] ?? null) : null), "tag", [], "any", false, false, false, 47);
                    echo "</a>,
    ";
                } else {
                    // line 48
                    echo " 
    <a href=\"";
                    // line 49
                    echo twig_get_attribute($this->env, $this->source, (($__internal_compile_2 = ($context["tags"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[$context["i"]] ?? null) : null), "href", [], "any", false, false, false, 49);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, (($__internal_compile_3 = ($context["tags"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[$context["i"]] ?? null) : null), "tag", [], "any", false, false, false, 49);
                    echo "</a> ";
                }
                // line 50
                echo "    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 51
            echo "\t</p>
\t";
        }
        // line 53
        echo "
        <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=61a636a5d0a9e10012e4df2d&product=sop' async='async'></script>
        <!-- ShareThis BEGIN -->
        <div class=\"sharethis-inline-share-buttons\" style=\"margin-bottom:50px\"></div>
\t
    <!-- Related Products -->
    ";
        // line 59
        if (($context["products"] ?? null)) {
            // line 60
            echo "      <h3 class=\"section-title\"><b>";
            echo ($context["text_related_products"] ?? null);
            echo "</b></h3>
        <div class=\"grid-holder grid grid";
            // line 61
            echo ($context["rel_prod_per_row"] ?? null);
            echo "\">
        ";
            // line 62
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
                // line 63
                echo "        ";
                $this->loadTemplate("basel/template/product/single_product.twig", "basel/template/blog/blog.twig", 63)->display($context);
                // line 64
                echo "        ";
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
            // line 65
            echo "      </div>
      ";
        }
        // line 67
        echo "\t <!-- Related Products End -->
     
     
     ";
        // line 70
        if (($context["related_blogs"] ?? null)) {
            // line 71
            echo "\t\t<h3 class=\"section-title\"><b>";
            echo ($context["text_related_blog"] ?? null);
            echo "</b></h3>
        <div class=\"grid-holder grid";
            // line 72
            echo ($context["rel_per_row"] ?? null);
            echo "\">
            ";
            // line 73
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["related_blogs"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["blog"]) {
                // line 74
                echo "            <div class=\"item single-blog related\">
                ";
                // line 75
                if ((twig_get_attribute($this->env, $this->source, $context["blog"], "image", [], "any", false, false, false, 75) && ($context["rel_thumb_status"] ?? null))) {
                    // line 76
                    echo "                <div class=\"banner_wrap hover-zoom hover-darken\">
\t\t\t\t<img class=\"zoom_image\" src=\"";
                    // line 77
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "image", [], "any", false, false, false, 77);
                    echo "\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "title", [], "any", false, false, false, 77);
                    echo "\" title=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "title", [], "any", false, false, false, 77);
                    echo "\" />
                <a href=\"";
                    // line 78
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "href", [], "any", false, false, false, 78);
                    echo "\" class=\"effect-holder\"></a>
                ";
                    // line 79
                    if (($context["date_added_status"] ?? null)) {
                        // line 80
                        echo "                <div class=\"date_added\">
                <span class=\"day\">";
                        // line 81
                        echo twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["blog"], "date_added_full", [], "any", false, false, false, 81), "d");
                        echo "</span>
                <b class=\"month\">";
                        // line 82
                        echo twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["blog"], "date_added_full", [], "any", false, false, false, 82), "M");
                        echo "</b>
                </div>
                ";
                    }
                    // line 85
                    echo "                ";
                    if (twig_get_attribute($this->env, $this->source, $context["blog"], "tags", [], "any", false, false, false, 85)) {
                        // line 86
                        echo "                <div class=\"tags-wrapper\">
                <div class=\"tags primary-bg-color\">
                ";
                        // line 88
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, twig_get_attribute($this->env, $this->source, $context["blog"], "tags", [], "any", false, false, false, 88), 0, 2));
                        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                            // line 89
                            echo "                <a href=\"index.php?route=extension/blog/home&tag=";
                            echo twig_trim_filter($context["tag"]);
                            echo "\">";
                            echo twig_trim_filter($context["tag"]);
                            echo "</a>
                ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 91
                        echo "                </div>
                </div>
                ";
                    }
                    // line 94
                    echo "                </div>
\t\t\t\t";
                }
                // line 96
                echo "                <div class=\"summary\">
                <h3 class=\"blog-title\"><a href=\"";
                // line 97
                echo twig_get_attribute($this->env, $this->source, $context["blog"], "href", [], "any", false, false, false, 97);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["blog"], "title", [], "any", false, false, false, 97);
                echo "</a></h3>
                <div class=\"blog_stats\">
                ";
                // line 99
                if (($context["author_status"] ?? null)) {
                    echo "<i>";
                    echo ($context["text_posted_by"] ?? null);
                    echo ": ";
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "author", [], "any", false, false, false, 99);
                    echo "</i>";
                }
                // line 100
                echo "\t\t\t\t";
                if (($context["comments_count_status"] ?? null)) {
                    echo "<i>";
                    echo ($context["text_comments"] ?? null);
                    echo ": ";
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "comment_total", [], "any", false, false, false, 100);
                    echo "</i>";
                }
                // line 101
                echo "                ";
                if (($context["page_view_status"] ?? null)) {
                    echo "<i>";
                    echo ($context["text_read"] ?? null);
                    echo ": ";
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "count_read", [], "any", false, false, false, 101);
                    echo "</i>";
                }
                // line 102
                echo "                </div>
\t\t\t\t<p class=\"short-description\">";
                // line 103
                echo twig_get_attribute($this->env, $this->source, $context["blog"], "short_description", [], "any", false, false, false, 103);
                echo "</p>
                <a class=\"u-lined\" href=\"";
                // line 104
                echo twig_get_attribute($this->env, $this->source, $context["blog"], "href", [], "any", false, false, false, 104);
                echo "\">";
                echo ($context["text_read_more"] ?? null);
                echo "</a>
                </div>
               </div>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['blog'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 107
            echo "           
\t\t</div>
\t";
        }
        // line 110
        echo "\t <!-- Related Blog End -->
\t 

      </div>
     
      ";
        // line 115
        echo ($context["content_bottom"] ?? null);
        echo "</div>
    ";
        // line 116
        echo ($context["column_right"] ?? null);
        echo "</div>
</div>
<script><!--
\$('#comment').delegate('.pagination a', 'click', function(e) {
  e.preventDefault();
\t\$(\"html,body\").animate({scrollTop:((\$(\"#comment\").offset().top)-50)},500);
    \$('#comment').fadeOut(50);

    \$('#comment').load(this.href);

    \$('#comment').fadeIn(500);
\t
});

\$('#comment').load('index.php?route=extension/blog/blog/comment&blog_id=";
        // line 130
        echo ($context["blog_id"] ?? null);
        echo "');
//--></script>

<script><!--

\$('#button-comment').on('click', function() {
\t\$.ajax({
\t\turl: 'index.php?route=extension/blog/blog/write&blog_id=";
        // line 137
        echo ($context["blog_id"] ?? null);
        echo "',
\t\ttype: 'post',
\t\tdataType: 'json',
\t\tdata: \$(\"#comment_form\").serialize(),
\t\t
\t\tcomplete: function() {
\t\t\t\$('#button-comment').button('reset');
\t\t\t\$('#captcha_comment').attr('src', 'index.php?route=extension/blog/blog/captcha');
\t\t\t\$('input[name=\\'captcha_comment\\']').val('');
\t\t},
\t\tsuccess: function(json) {
\t\t\t\$('.alert-success, .alert-danger').remove();
\t\t\t
\t\t\tif (json.error) {
\t\t\t\t\$('#write_response').html('<div class=\"alert alert-sm alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> ' + json.error + '</div>');
\t\t\t}
\t\t\t
\t\t\tif (json.success) {
\t\t\t\t\$('#write_response').html('<div class=\"alert alert-sm alert-success\"><i class=\"fa fa-check-circle\"></i> ' + json.success + '</div>');
\t\t\t\t
\t\t\t\t\$('input[name=\\'name\\']').val('');
\t\t\t\t\$('input[name=\\'email\\']').val('');
\t\t\t\t\$('textarea[name=\\'comment\\']').val('');
\t\t\t\t\$('input[name=\\'captcha_comment\\']').val('');
\t\t\t}
\t\t}
\t});
});    
// Sharing buttons
var share_url = encodeURIComponent(window.location.href);
var page_title = '";
        // line 167
        echo ($context["heading_title"] ?? null);
        echo "';
";
        // line 168
        if (($context["main_thumb"] ?? null)) {
            // line 169
            echo "var thumb = '";
            echo ($context["main_thumb"] ?? null);
            echo "';
";
        }
        // line 171
        echo "\$('.fb_share').attr(\"href\", 'https://www.facebook.com/sharer/sharer.php?u=' + share_url + '');
\$('.twitter_share').attr(\"href\", 'https://twitter.com/intent/tweet?source=' + share_url + '&text=' + page_title + ': ' + share_url + '');
\$('.google_share').attr(\"href\", 'https://plus.google.com/share?url=' + share_url + '');
\$('.pinterest_share').attr(\"href\", 'http://pinterest.com/pin/create/button/?url=' + share_url + '&media=' + thumb + '&description=' + page_title + '');
\$('.vk_share').attr(\"href\", 'http://vkontakte.ru/share.php?url=' + share_url + '');
</script>

<script type=\"application/ld+json\">
{
\"@context\": \"http://schema.org\",
\"@type\": \"NewsArticle\",
\"mainEntityOfPage\": {
\"@type\": \"WebPage\",
\"@id\": \"https://google.com/article\"
},
\"headline\": \"";
        // line 186
        echo ($context["heading_title"] ?? null);
        echo "\",
";
        // line 187
        if (($context["main_thumb"] ?? null)) {
            // line 188
            echo "\"image\": {
\"@type\": \"ImageObject\",
\"url\": \"";
            // line 190
            echo ($context["main_thumb"] ?? null);
            echo "\",
\"height\": ";
            // line 191
            echo ($context["img_height"] ?? null);
            echo ",
\"width\": ";
            // line 192
            echo ($context["img_width"] ?? null);
            echo "
},
";
        }
        // line 195
        echo "\"datePublished\": \"";
        echo ($context["date_added_full"] ?? null);
        echo "\",
\"dateModified\": \"";
        // line 196
        echo ($context["date_added_full"] ?? null);
        echo "\",
\"author\": {
\"@type\": \"Person\",
\"name\": \"";
        // line 199
        echo ($context["author"] ?? null);
        echo "\"
},
\"publisher\": {
\"@type\": \"Organization\",
\"name\": \"";
        // line 203
        echo ($context["store"] ?? null);
        echo "\",
";
        // line 204
        if (($context["logo"] ?? null)) {
            // line 205
            echo "\"logo\": {
\"@type\": \"ImageObject\",
\"url\": \"";
            // line 207
            echo ($context["logo"] ?? null);
            echo "\"
}
";
        }
        // line 210
        echo "},
\"description\": \"";
        // line 211
        echo ($context["short_description"] ?? null);
        echo "\"
}
</script>
";
        // line 214
        echo ($context["footer"] ?? null);
        echo " ";
    }

    public function getTemplateName()
    {
        return "basel/template/blog/blog.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  561 => 214,  555 => 211,  552 => 210,  546 => 207,  542 => 205,  540 => 204,  536 => 203,  529 => 199,  523 => 196,  518 => 195,  512 => 192,  508 => 191,  504 => 190,  500 => 188,  498 => 187,  494 => 186,  477 => 171,  471 => 169,  469 => 168,  465 => 167,  432 => 137,  422 => 130,  405 => 116,  401 => 115,  394 => 110,  389 => 107,  377 => 104,  373 => 103,  370 => 102,  361 => 101,  352 => 100,  344 => 99,  337 => 97,  334 => 96,  330 => 94,  325 => 91,  314 => 89,  310 => 88,  306 => 86,  303 => 85,  297 => 82,  293 => 81,  290 => 80,  288 => 79,  284 => 78,  276 => 77,  273 => 76,  271 => 75,  268 => 74,  264 => 73,  260 => 72,  255 => 71,  253 => 70,  248 => 67,  244 => 65,  230 => 64,  227 => 63,  210 => 62,  206 => 61,  201 => 60,  199 => 59,  191 => 53,  187 => 51,  181 => 50,  175 => 49,  172 => 48,  165 => 47,  160 => 46,  156 => 45,  152 => 44,  149 => 43,  147 => 42,  141 => 39,  131 => 32,  128 => 31,  124 => 29,  118 => 26,  114 => 25,  111 => 24,  109 => 23,  101 => 22,  98 => 21,  96 => 20,  88 => 17,  85 => 16,  82 => 15,  79 => 14,  76 => 13,  73 => 12,  70 => 11,  67 => 10,  65 => 9,  61 => 8,  58 => 7,  47 => 5,  43 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/blog/blog.twig", "");
    }
}
