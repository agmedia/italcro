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

/* extension/module/basel_megamenu.twig */
class __TwigTemplate_31bd1222e4726ba9b6f3b47f097046146f68bfaf8723d0806193849cda4203ae extends \Twig\Template
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
    <a href=\"";
        // line 7
        echo ($context["cancel"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"Cancel\" class=\"btn btn-default\"><i class=\"fa fa-reply\"></i></a>
\t</div>

    <h1>";
        // line 10
        echo ($context["heading_title"] ?? null);
        echo "</h1>
    <ul class=\"breadcrumb\">
    ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 13
            echo "    <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 13);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 13);
            echo "</a></li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "    </ul>
    </div>
    </div>
    <div class=\"container-fluid\" id=\"megamenu\">
        
        ";
        // line 20
        if (($context["error_warning"] ?? null)) {
            // line 21
            echo "        <div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
        </div>
        ";
        }
        // line 25
        echo "        
        ";
        // line 26
        if (($context["success"] ?? null)) {
            // line 27
            echo "        <div class=\"alert alert-success\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
        </div>
        ";
        }
        // line 31
        echo "        
        <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-bars\"></i> ";
        // line 34
        echo ($context["text_edit"] ?? null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
    \t<form action=\"";
        // line 37
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form\">
        
        <div id=\"content\">
            <div class=\"row\">
                <div class=\"background clearfix\">
                    ";
        // line 42
        if (($context["moduleid"] ?? null)) {
            // line 43
            echo "                    <div class=\"left col-md-5 col-xs-12 col-sm-6 \">
                        ";
            // line 44
            echo ($context["nestable_list"] ?? null);
            echo "
                        <div class=\"well\">
                        <div class=\"row\">
                        <div class=\"col-sm-6\">
                        <a id=\"nestable-menu\">
                        <button type=\"button\" data-action=\"expand-all\" class=\"btn btn-link\">";
            // line 49
            echo ($context["text_expand_all"] ?? null);
            echo "</button>
                        <button type=\"button\" data-action=\"collapse-all\" class=\"btn btn-link\">";
            // line 50
            echo ($context["text_collapse_all"] ?? null);
            echo "</button>
                        </a>
                        </div>
                        <div class=\"col-sm-6 text-right\">
                        <a href=\"";
            // line 54
            echo ($context["action"] ?? null);
            echo "&action=create\" class=\"btn btn-sm btn-primary\" ><i class=\"fa fa-plus\"></i>&nbsp; ";
            echo ($context["text_creat_new_item"] ?? null);
            echo "</a>
                        </div>
                        </div>
                        <div class=\"time\">
                        <div id='sortDBfeedback'></div>
                        </div>
                        </div>
                    </div>
                    ";
        }
        // line 63
        echo "                    
                    ";
        // line 64
        if (((($context["action_type"] ?? null) == "create") || (($context["action_type"] ?? null) == "edit"))) {
            // line 65
            echo "                    <div class=\"right col-md-7 col-xs-12 col-sm-6\">
                    
                    <h2>
                    <div class=\"buttons pull-right\">
                                    <button type=\"submit\" name=\"button-back\" class=\"btn btn-default\" value=\"\" title=\"Configuration\">Cancel</button>
                                    ";
            // line 70
            if ((($context["action_type"] ?? null) == "create")) {
                // line 71
                echo "                                    <button type=\"submit\" name=\"button-create\" class=\"btn btn-primary\" value=\"\">Save</button>
                                    ";
            } elseif ((            // line 72
($context["action_type"] ?? null) == "edit")) {
                // line 73
                echo "                                    <button type=\"submit\" name=\"button-edit\" class=\"btn btn-primary\" value=\"\">Save</button>
                                    ";
            } else {
                // line 75
                echo "                                    <button type=\"submit\" name=\"button-save\" class=\"btn btn-primary\" value=\"\">Save</button>
                                   ";
            }
            // line 77
            echo "                            </div>
                    
                    \t\t";
            // line 79
            if ((($context["action_type"] ?? null) == "edit")) {
                // line 80
                echo "                            ";
                echo ($context["text_edit_item"] ?? null);
                echo ($context["edit"] ?? null);
                echo ")
                            <input type=\"hidden\" name=\"id\" value=\"";
                // line 81
                echo ($context["edit"] ?? null);
                echo "\" />
                            ";
            } else {
                // line 83
                echo "                            ";
                echo ($context["text_creat_new_item"] ?? null);
                echo "
                            ";
            }
            // line 85
            echo "                    \t\t</h2>
                            <input type=\"hidden\" name=\"status\" value=\"";
            // line 86
            echo ($context["status"] ?? null);
            echo "\">
                            
                            <div class=\"input clearfix\">
                                    <p>";
            // line 89
            echo ($context["text_name"] ?? null);
            echo "<span style=\"color:#F30\">*</span></p>
                                    ";
            // line 90
            $context["i"] = 0;
            // line 91
            echo "\t\t\t\t\t\t\t\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 92
                echo "                                    ";
                $context["i"] = (($context["i"] ?? null) + 1);
                // line 93
                echo "                                         <input type=\"text\" name=\"name[";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 93);
                echo "]\" placeholder=\"";
                echo ($context["entry_description_name"] ?? null);
                echo "\" id=\"input-head-name-";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 93);
                echo "\" value=\"";
                echo (((($__internal_compile_0 = ($context["name"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 93)] ?? null) : null)) ? ((($__internal_compile_1 = ($context["name"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 93)] ?? null) : null)) : (""));
                echo "\" class=\"form-control";
                if ((($context["i"] ?? null) > 1)) {
                    echo " hide";
                } else {
                    echo " first-name";
                }
                echo "\" />
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 95
            echo "                                    <select  class=\"form-control lang-select\" id=\"language\">
                                    
                                    ";
            // line 97
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 98
                echo "                                    <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 98);
                echo "\"><img src=\"language/";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 98);
                echo "/";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 98);
                echo ".png\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 98);
                echo "\" /> ";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 98);
                echo "</option>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 100
            echo "                                    </select>
                            </div>
                            
                            
                            
                            
                            <div class=\"input clearfix\">
                            <p>";
            // line 107
            echo ($context["text_class_menu"] ?? null);
            echo "</p>
                                    <div class=\"list-language\">
                                            <input type=\"text\" class=\"form-control\" name=\"class_menu\" value=\"";
            // line 109
            echo ($context["class_menu"] ?? null);
            echo "\">
                                    </div>
                            </div>
                            
                            <div class=\"input clearfix\">
                            <p>";
            // line 114
            echo ($context["entry_display_mobile_module"] ?? null);
            echo "</p>
                            <select name=\"disp_mobile_item\" class=\"form-control\">
                                ";
            // line 116
            if (($context["disp_mobile_item"] ?? null)) {
                // line 117
                echo "                                <option value=\"1\" selected=\"selected\">";
                echo ($context["text_yes"] ?? null);
                echo "</option>
                                <option value=\"0\">";
                // line 118
                echo ($context["text_no"] ?? null);
                echo "</option>
                                ";
            } else {
                // line 120
                echo "                                <option value=\"1\">";
                echo ($context["text_yes"] ?? null);
                echo "</option>
                                <option value=\"0\" selected=\"selected\">";
                // line 121
                echo ($context["text_no"] ?? null);
                echo "</option>
                                ";
            }
            // line 123
            echo "                            </select>
                        \t</div>
                            
                            <div class=\"input clearfix\">
                            <p>Link Target</p>
                            <input type=\"text\" class=\"form-control\" value=\"";
            // line 128
            echo ($context["link"] ?? null);
            echo "\" name=\"link\">
                            </div>
                           
                            
                            <div class=\"input clearfix\">
                                    <p>";
            // line 133
            echo ($context["text_link_in_new_window"] ?? null);
            echo "</p>
                                    <select class=\"form-control\" name=\"new_window\">
                                            ";
            // line 135
            if ((($context["new_window"] ?? null) == 1)) {
                // line 136
                echo "                                            <option value=\"0\">";
                echo ($context["text_disabled"] ?? null);
                echo "</option>
                                            <option value=\"1\" selected=\"selected\">";
                // line 137
                echo ($context["text_enabled"] ?? null);
                echo "</option>
                                            ";
            } else {
                // line 139
                echo "                                            <option value=\"0\" selected=\"selected\">";
                echo ($context["text_disabled"] ?? null);
                echo "</option>
                                            <option value=\"1\">";
                // line 140
                echo ($context["text_enabled"] ?? null);
                echo "</option>
                                            ";
            }
            // line 142
            echo "                                    </select>
                            </div>
                            
                            <div class=\"input clearfix\">
                                    <p>";
            // line 146
            echo ($context["text_icon_font"] ?? null);
            echo "</p>
                                    <div class=\"list-language\">
                                    <input type=\"text\" class=\"form-control\" name=\"icon_font\" value=\"";
            // line 148
            echo ($context["icon_font"] ?? null);
            echo "\">
                                    </div>
                                    <span class=\"helper\">Example: <i>fa fa-desktop</i> or <i>icon-heart</i> &nbsp;-&nbsp; 
                                    <a href=\"http://fontawesome.io/cheatsheet/\" target=\"_blank\">FontAwesome Icons</a> &nbsp;|&nbsp; 
                                    <a class=\"icon_list\">Basel Icons</a>
                                    </span>
                            </div>
                            
                            
                            <div class=\"input clearfix\">
                                <p>";
            // line 158
            echo ($context["text_label"] ?? null);
            echo "</p>
                                ";
            // line 159
            $context["i"] = 0;
            // line 160
            echo "                                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 161
                echo "                                ";
                $context["i"] = (($context["i"] ?? null) + 1);
                // line 162
                echo "                                <input type=\"text\" name=\"description[";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 162);
                echo "]\" placeholder=\"";
                echo ($context["text_label"] ?? null);
                echo "\" id=\"input-head-des-";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 162);
                echo "\" value=\"";
                echo (((($__internal_compile_2 = ($context["description"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 162)] ?? null) : null)) ? ((($__internal_compile_3 = ($context["description"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 162)] ?? null) : null)) : (""));
                echo "\" class=\"form-control";
                if ((($context["i"] ?? null) > 1)) {
                    echo " hide";
                } else {
                    echo " first-name";
                }
                echo "\" /> 
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 164
            echo "                                <select  class=\"form-control lang-select\" id=\"des_language\">
                                ";
            // line 165
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 166
                echo "                                <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 166);
                echo "\"><img src=\"language/";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 166);
                echo "/";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 166);
                echo ".png\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 166);
                echo "\" /> ";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 166);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 168
            echo "                                </select>
                                <span class=\"helper\">Example:<br /><i>&lt;i class=&quot;menu-tag sale&quot;&gt;SALE&lt;/i&gt;<br />&lt;i class=&quot;menu-tag new&quot;&gt;NEW&lt;/i&gt;</i></span>
                            </div>

                            <input type=\"hidden\" name=\"item_type\" id=\"item_type\" value=\"";
            // line 172
            echo ($context["item_type"] ?? null);
            echo "\">

                            ";
            // line 174
            if (($context["item_type"] ?? null)) {
                // line 175
                echo "                            <h4 class=\"button_parent_config active\">";
                echo ($context["text_parent_config"] ?? null);
                echo "</h4>
                            <span class=\"h4_helper\">(";
                // line 176
                echo ($context["text_parent_item"] ?? null);
                echo ")</span>
                            <div id=\"text_parent_config\" class=\"collapse in\" aria-expanded=\"true\">
                            ";
            } else {
                // line 179
                echo "                            <h4 class=\"button_parent_config\">";
                echo ($context["text_parent_config"] ?? null);
                echo "</h4>
                            <span class=\"h4_helper\">(";
                // line 180
                echo ($context["text_parent_item"] ?? null);
                echo ")</span>
                            <div id=\"text_parent_config\" class=\"collapse\">
                            ";
            }
            // line 183
            echo "                            
                            <div class=\"input clearfix\">
                            <p>";
            // line 185
            echo ($context["text_submenu_width"] ?? null);
            echo "</p>
                            <input type=\"text\" class=\"form-control\" name=\"submenu_width\" value=\"";
            // line 186
            echo ($context["submenu_width"] ?? null);
            echo "\">
\t\t\t\t\t\t\t<span class=\"helper\">Enter: <b>full</b> to cteate a full width drop down</span>
                            </div>
                            
                            <div class=\"input clearfix\">
                            <p>Background Image</p>
                            <a href=\"\" id=\"thumb-image\" data-toggle=\"image\" class=\"img-thumbnail\"><img src=\"";
            // line 192
            echo ($context["src_icon"] ?? null);
            echo "\" alt=\"\" title=\"\" data-placeholder=\"";
            echo ($context["placeholder"] ?? null);
            echo "\"  /></a>
                            <input type=\"hidden\" name=\"icon\" value=\"";
            // line 193
            echo ($context["icon"] ?? null);
            echo "\" id=\"input-image\" />
                            </div>
                            

                            <div class=\"input clearfix\">
                                    <p>";
            // line 198
            echo ($context["text_position"] ?? null);
            echo "</p>
                                    <select name=\"position\" class=\"form-control\">
                                    ";
            // line 200
            if ((($context["position"] ?? null) == "left top")) {
                // line 201
                echo "                                    <option value=\"left top\" selected=\"selected\">left top</option>
                                    ";
            } else {
                // line 203
                echo "                                    <option value=\"left top\">left top</option>
                                    ";
            }
            // line 205
            echo "                                    ";
            if ((($context["position"] ?? null) == "left center")) {
                // line 206
                echo "                                    <option value=\"left center\" selected=\"selected\">left center</option>
                                    ";
            } else {
                // line 208
                echo "                                    <option value=\"left center\">left center</option>
                                    ";
            }
            // line 210
            echo "                                    ";
            if ((($context["position"] ?? null) == "left bottom")) {
                // line 211
                echo "                                    <option value=\"left bottom\" selected=\"selected\">left bottom</option>
                                    ";
            } else {
                // line 213
                echo "                                    <option value=\"left bottom\">left bottom</option>
                                    ";
            }
            // line 215
            echo "                                    ";
            if ((($context["position"] ?? null) == "right top")) {
                // line 216
                echo "                                    <option value=\"right top\" selected=\"selected\">right top</option>
                                    ";
            } else {
                // line 218
                echo "                                    <option value=\"right top\">right top</option>
                                    ";
            }
            // line 220
            echo "                                    ";
            if ((($context["position"] ?? null) == "right center")) {
                // line 221
                echo "                                    <option value=\"right center\" selected=\"selected\">right center</option>
                                    ";
            } else {
                // line 223
                echo "                                    <option value=\"right center\">right center</option>
                                    ";
            }
            // line 225
            echo "                                    ";
            if ((($context["position"] ?? null) == "right bottom")) {
                // line 226
                echo "                                    <option value=\"right bottom\" selected=\"selected\">right bottom</option>
                                    ";
            } else {
                // line 228
                echo "                                    <option value=\"right bottom\">right bottom</option>
                                    ";
            }
            // line 230
            echo "                                    ";
            if ((($context["position"] ?? null) == "center top")) {
                // line 231
                echo "                                    <option value=\"center top\" selected=\"selected\">center top</option>
                                    ";
            } else {
                // line 233
                echo "                                    <option value=\"center top\">center top</option>
                                    ";
            }
            // line 235
            echo "                                    ";
            if ((($context["position"] ?? null) == "center center")) {
                // line 236
                echo "                                    <option value=\"center center\" selected=\"selected\">center center</option>
                                    ";
            } else {
                // line 238
                echo "                                    <option value=\"center center\">center center</option>
                                    ";
            }
            // line 240
            echo "                                    ";
            if ((($context["position"] ?? null) == "center bottom")) {
                // line 241
                echo "                                    <option value=\"center bottom\" selected=\"selected\">center bottom</option>
                                    ";
            } else {
                // line 243
                echo "                                    <option value=\"center bottom\">center bottom</option>
                                    ";
            }
            // line 245
            echo "                                    </select>
                            </div>

                            </div>
                            
                            ";
            // line 250
            if (($context["item_type"] ?? null)) {
                // line 251
                echo "                                <h4 class=\"button_content_config\">";
                echo ($context["text_content_config"] ?? null);
                echo "</h4>
                                <span class=\"h4_helper\">(";
                // line 252
                echo ($context["text_content_item"] ?? null);
                echo ")</span>
                                <div id=\"text_content_config\" class=\"collapse\">
                            ";
            } else {
                // line 255
                echo "                                <h4 class=\"button_content_config active\">";
                echo ($context["text_content_config"] ?? null);
                echo "</h4>
                                <span class=\"h4_helper\">(";
                // line 256
                echo ($context["text_content_item"] ?? null);
                echo ")</span>
                                <div id=\"text_content_config\" class=\"collapse in\" aria-expanded=\"true\">
                            ";
            }
            // line 259
            echo "                            
                            <div class=\"input clearfix\">
                            <p>Show Item Name</p>
                            <div class=\"list-language\">
                                <select name=\"show_title\" class=\"form-control\">
                                ";
            // line 264
            if (($context["show_title"] ?? null)) {
                // line 265
                echo "                                <option value=\"1\" selected=\"selected\">";
                echo ($context["text_yes"] ?? null);
                echo "</option>
                                <option value=\"0\">";
                // line 266
                echo ($context["text_no"] ?? null);
                echo "</option>
                                ";
            } else {
                // line 268
                echo "                                <option value=\"1\">";
                echo ($context["text_yes"] ?? null);
                echo "</option>
                                <option value=\"0\" selected=\"selected\">";
                // line 269
                echo ($context["text_no"] ?? null);
                echo "</option>
                                ";
            }
            // line 271
            echo "                            </select>
                            </div>
                            </div>
                        
                            <div class=\"input clearfix\">
                            <p>";
            // line 276
            echo ($context["text_content_width"] ?? null);
            echo "</p>
                            <select name=\"content_width\" class=\"form-control\">
                            ";
            // line 278
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(1, 12));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 279
                echo "\t\t\t\t\t\t\t<option value=\"";
                echo $context["i"];
                echo "\" ";
                if (($context["i"] == ($context["content_width"] ?? null))) {
                    echo " ";
                    echo "selected=\"selected\"";
                    echo " ";
                }
                echo ">";
                echo $context["i"];
                echo "/12</option>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 281
            echo "                            </select>
                            </div>                           
                            
                            <div class=\"input clearfix\">
                            <p>";
            // line 285
            echo ($context["text_content_type"] ?? null);
            echo "</p>
                            <select name=\"content_type\" class=\"form-control\">
                                    ";
            // line 287
            if ((($context["content_type"] ?? null) != 0)) {
                // line 288
                echo "                                    <option value=\"0\">HTML</option>
                                    ";
            } else {
                // line 290
                echo "                                    <option value=\"0\" selected=\"selected\">HTML</option>
                                    ";
            }
            // line 292
            echo "                                    ";
            if ((($context["content_type"] ?? null) != 1)) {
                // line 293
                echo "                                    <option value=\"1\">Product</option>
                                    ";
            } else {
                // line 295
                echo "                                    <option value=\"1\" selected=\"selected\">Product</option>
                                    ";
            }
            // line 297
            echo "                                    ";
            if ((($context["content_type"] ?? null) != 2)) {
                // line 298
                echo "                                    <option value=\"2\">Categories</option>
                                    ";
            } else {
                // line 300
                echo "                                    <option value=\"2\" selected=\"selected\">Categories</option>
                                    ";
            }
            // line 302
            echo "                                    ";
            if ((($context["content_type"] ?? null) != 4)) {
                // line 303
                echo "                                    <option value=\"4\">Image</option>
                                    ";
            } else {
                // line 305
                echo "                                    <option value=\"4\" selected=\"selected\">Image</option>
                                    ";
            }
            // line 307
            echo "                            </select>
                            </div>
                            
                    <!-------------- HTML ---------------->
                    <!------------------------------------>
                    
                    <div id=\"content_type0\"";
            // line 313
            if ((($context["content_type"] ?? null) != 0)) {
                echo " style=\"display:none\"";
            }
            echo " class=\"content_type content_type_html\">
                    <legend>HTML</legend>
                    <div class=\"tab-pane\">
                    <ul id=\"language\" class=\"nav nav-tabs\">
                    ";
            // line 317
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 318
                echo "                    <li>
                    <a data-toggle=\"tab\" href=\"#content_html_";
                // line 319
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 319);
                echo "\">
                    <img src=\"language/";
                // line 320
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 320);
                echo "/";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 320);
                echo ".png\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 320);
                echo "\" /> ";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 320);
                echo "
                    </a>
                    </li>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 324
            echo "                    </ul>
                    <div class=\"tab-content\">
                    ";
            // line 326
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 327
                echo "                    ";
                $context["lang_id"] = twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 327);
                // line 328
                echo "                    <div id=\"content_html_";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 328);
                echo "\" class=\"content_html tab-pane\">
                    <textarea name=\"content[html][text][";
                // line 329
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 329);
                echo "]\" id=\"content_html_text_";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 329);
                echo "\" class=\"form-control content-block\">";
                echo (((($__internal_compile_4 = (($__internal_compile_5 = (($__internal_compile_6 = ($context["content"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["html"] ?? null) : null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["text"] ?? null) : null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4[($context["lang_id"] ?? null)] ?? null) : null)) ? ((($__internal_compile_7 = (($__internal_compile_8 = (($__internal_compile_9 = ($context["content"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["html"] ?? null) : null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["text"] ?? null) : null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7[($context["lang_id"] ?? null)] ?? null) : null)) : (""));
                echo "</textarea>

                    <a onclick=\"enable_editor('#content_html_text_";
                // line 331
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 331);
                echo "');\">Enable HTML Editor</a>
                    </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 334
            echo "                    </div>
                    </div>
                    </div>

                    <!------------- Product -------------->
                    <!------------------------------------>
                    
                    <div id=\"content_type1\" ";
            // line 341
            if ((($context["content_type"] ?? null) != 1)) {
                echo " ";
                echo "style=\"display:none\"";
                echo " ";
            }
            echo " class=\"content_type\">
                    <legend>Product</legend>
                    <div class=\"input clearfix\">
                    <p>Product:<br><span style=\"font-size:11px;color:#808080\">(Autocomplete)</span></p>
                    <input type=\"hidden\" name=\"content[product][id]\" value=\"";
            // line 345
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "product", [], "any", false, false, false, 345), "id", [], "any", false, false, false, 345);
            echo "\" />
\t\t\t\t\t<input type=\"text\" id=\"product_autocomplete\" name=\"content[product][name]\" value=\"";
            // line 346
            echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "product", [], "any", false, false, false, 346), "name", [], "any", false, false, false, 346)) ? (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "product", [], "any", false, false, false, 346), "name", [], "any", false, false, false, 346)) : (""));
            echo "\">
                    </div>
                    
                    <div class=\"input clearfix\">
                    <p>Image Width (px)</p>
                    <input type=\"text\" class=\"form-control\" name=\"content[product][img_w]\" value=\"";
            // line 351
            echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "product", [], "any", false, false, false, 351), "img_w", [], "any", false, false, false, 351)) ? (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "product", [], "any", false, false, false, 351), "img_w", [], "any", false, false, false, 351)) : ("262"));
            echo "\">
                    </div>
                    
                    <div class=\"input clearfix\">
                    <p>Image Height (px)</p>
                    <input type=\"text\" class=\"form-control\" name=\"content[product][img_h]\" value=\"";
            // line 356
            echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "product", [], "any", false, false, false, 356), "img_h", [], "any", false, false, false, 356)) ? (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "product", [], "any", false, false, false, 356), "img_h", [], "any", false, false, false, 356)) : ("262"));
            echo "\">
                    </div>
                    
                    </div>
                    
                    
                    <!-------------- Image --------------->
                    <!------------------------------------>
                    <div id=\"content_type4\" ";
            // line 364
            if ((($context["content_type"] ?? null) != 4)) {
                echo " ";
                echo "style=\"display:none\"";
                echo " ";
            }
            echo " class=\"content_type\">
                    <legend>Image</legend>
                    <div class=\"input clearfix\">
                    <p>Image:</p>
                    <a href=\"\" id=\"thumb-image-content\" data-toggle=\"image\" class=\"img-thumbnail\"><img src=\"";
            // line 368
            echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "image", [], "any", false, false, false, 368), "image_link", [], "any", false, false, false, 368)) ? (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "image", [], "any", false, false, false, 368), "image_link", [], "any", false, false, false, 368)) : (($context["src_image_default"] ?? null)));
            echo "\" alt=\"\" title=\"\" data-placeholder=\"";
            echo ($context["placeholder"] ?? null);
            echo "\"  /></a>
                    <input type=\"hidden\" name=\"content[image][link]\" value=\"";
            // line 369
            echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "image", [], "any", false, false, false, 369), "link", [], "any", false, false, false, 369)) ? (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "image", [], "any", false, false, false, 369), "link", [], "any", false, false, false, 369)) : (($context["image_default"] ?? null)));
            echo "\" id=\"input-image-content\" />
                    </div>
                    </div>
                    
                    
                    <!----------- Categories ------------->
                    <!------------------------------------>
                    <div id=\"content_type2\" ";
            // line 376
            if ((($context["content_type"] ?? null) != 2)) {
                echo " ";
                echo "style=\"display:none\"";
                echo " ";
            }
            echo " class=\"content_type\">
                    <legend>Categories</legend>
                    <div class=\"input clearfix\">
                    <p>Add categories<br><span style=\"font-size:11px;color:#808080\">(Autocomplete)</span></p>
                    <input type=\"text\" id=\"categories_autocomplete\" class=\"form-control\" value=\"\">
                    </div>
                    <div class=\"input clearfix\">
                    <p>Sort categories</p>
                    <div class=\"cf nestable-lists\">
                        <div class=\"dd\" id=\"sort_categories\">
                            <ol class=\"dd-list\">
                                ";
            // line 387
            echo ($context["list_categories"] ?? null);
            echo "
                            </ol>
                        </div>
                        <input type=\"hidden\" id=\"sort_categories_data\" name=\"content[categories][categories]\" value=\"";
            // line 390
            echo ((twig_test_iterable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "categories", [], "any", false, false, false, 390), "categories", [], "any", false, false, false, 390))) ? ("") : (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "categories", [], "any", false, false, false, 390), "categories", [], "any", false, false, false, 390)));
            echo "\" />
                    </div>
                </div>
                
                <div class=\"input clearfix\">
                    <p>Columns</p>
                    <select name=\"content[categories][columns]\" class=\"form-control\">
                        ";
            // line 397
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "categories", [], "any", false, false, false, 397), "columns", [], "any", false, false, false, 397) != 1)) {
                // line 398
                echo "                            <option value=\"1\">1</option>
                        ";
            } else {
                // line 400
                echo "                            <option value=\"1\" selected=\"selected\">1</option>
                        ";
            }
            // line 402
            echo "
                        ";
            // line 403
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "categories", [], "any", false, false, false, 403), "columns", [], "any", false, false, false, 403) != 2)) {
                // line 404
                echo "                            <option value=\"2\">2</option>
                        ";
            } else {
                // line 406
                echo "                            <option value=\"2\" selected=\"selected\">2</option>
                        ";
            }
            // line 408
            echo "
                        ";
            // line 409
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "categories", [], "any", false, false, false, 409), "columns", [], "any", false, false, false, 409) != 3)) {
                // line 410
                echo "                            <option value=\"3\">3</option>
                        ";
            } else {
                // line 412
                echo "                        <option value=\"3\" selected=\"selected\">3</option>
                        ";
            }
            // line 414
            echo "
                        ";
            // line 415
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "categories", [], "any", false, false, false, 415), "columns", [], "any", false, false, false, 415) != 4)) {
                // line 416
                echo "                            <option value=\"4\">4</option>
                        ";
            } else {
                // line 418
                echo "                            <option value=\"4\" selected=\"selected\">4</option>
                        ";
            }
            // line 420
            echo "
                        ";
            // line 421
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "categories", [], "any", false, false, false, 421), "columns", [], "any", false, false, false, 421) != 5)) {
                // line 422
                echo "                            <option value=\"5\">5</option>
                        ";
            } else {
                // line 424
                echo "                            <option value=\"5\" selected=\"selected\">5</option>
                        ";
            }
            // line 426
            echo "
                        ";
            // line 427
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "categories", [], "any", false, false, false, 427), "columns", [], "any", false, false, false, 427) != 6)) {
                // line 428
                echo "                            <option value=\"6\">6</option>
                        ";
            } else {
                // line 430
                echo "                            <option value=\"6\" selected=\"selected\">6</option>
                        ";
            }
            // line 432
            echo "                    </select>
                </div>

                <div class=\"input clearfix\" id=\"submenu-type\">
                    <p>Submenu type</p>
                    <select name=\"content[categories][submenu]\" class=\"form-control\">
                        ";
            // line 438
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "categories", [], "any", false, false, false, 438), "submenu", [], "any", false, false, false, 438) != 1)) {
                // line 439
                echo "                            <option value=\"1\">Hover</option>
                        ";
            } else {
                // line 441
                echo "                            <option value=\"1\" selected=\"selected\">Hover</option>
                        ";
            }
            // line 443
            echo "
                        ";
            // line 444
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "categories", [], "any", false, false, false, 444), "submenu", [], "any", false, false, false, 444) != 2)) {
                // line 445
                echo "                            <option value=\"2\">Visible</option>
                        ";
            } else {
                // line 447
                echo "                            <option value=\"2\" selected=\"selected\">Visible</option>
                        ";
            }
            // line 449
            echo "                    </select>
                </div>

                <div class=\"input clearfix\" ";
            // line 452
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "categories", [], "any", false, false, false, 452), "submenu", [], "any", false, false, false, 452) != 2)) {
                echo " ";
                echo "style=\"display:none\"";
                echo " ";
            }
            echo " id=\"submenu-columns\">
                    <p>Submenu columns</p>
                    <select name=\"content[categories][submenu_columns]\" class=\"form-control\">
                        ";
            // line 455
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "categories", [], "any", false, false, false, 455), "submenu_columns", [], "any", false, false, false, 455) != 1)) {
                // line 456
                echo "                            <option value=\"1\">1</option>
                        ";
            } else {
                // line 458
                echo "                            <option value=\"1\" selected=\"selected\">1</option>
                        ";
            }
            // line 460
            echo "
                        ";
            // line 461
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "categories", [], "any", false, false, false, 461), "submenu_columns", [], "any", false, false, false, 461) != 2)) {
                // line 462
                echo "                            <option value=\"2\">2</option>
                        ";
            } else {
                // line 464
                echo "                            <option value=\"2\" selected=\"selected\">2</option>
                        ";
            }
            // line 466
            echo "
                        ";
            // line 467
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "categories", [], "any", false, false, false, 467), "submenu_columns", [], "any", false, false, false, 467) != 3)) {
                // line 468
                echo "                            <option value=\"3\">3</option>
                        ";
            } else {
                // line 470
                echo "                            <option value=\"3\" selected=\"selected\">3</option>
                        ";
            }
            // line 472
            echo "
                        ";
            // line 473
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "categories", [], "any", false, false, false, 473), "submenu_columns", [], "any", false, false, false, 473) != 4)) {
                // line 474
                echo "                            <option value=\"4\">4</option>
                        ";
            } else {
                // line 476
                echo "                            <option value=\"4\" selected=\"selected\">4</option>
                        ";
            }
            // line 478
            echo "
                        ";
            // line 479
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "categories", [], "any", false, false, false, 479), "submenu_columns", [], "any", false, false, false, 479) != 5)) {
                // line 480
                echo "                            <option value=\"5\">5</option>
                        ";
            } else {
                // line 482
                echo "                            <option value=\"5\" selected=\"selected\">5</option>
                        ";
            }
            // line 484
            echo "
                        ";
            // line 485
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "categories", [], "any", false, false, false, 485), "submenu_columns", [], "any", false, false, false, 485) != 6)) {
                // line 486
                echo "                            <option value=\"6\">6</option>
                        ";
            } else {
                // line 488
                echo "                            <option value=\"6\" selected=\"selected\">6</option>
                        ";
            }
            // line 490
            echo "                    </select>
                    </div>
                    </div>
                    </div>
                    </div>
                    
                    ";
        } else {
            // line 497
            echo "                    
                    <div class=\"right col-md-7 col-xs-12 col-sm-6\">
                    <h2>";
            // line 499
            echo ($context["text_basic_configuration"] ?? null);
            echo "
                    <div class=\"buttons pull-right\">
                    <button type=\"submit\" name=\"button-save\" class=\"btn btn-primary\" value=\"\" title=\"Save\">Save</button>
                    </div>
                    </h2>

                    <input type=\"hidden\" name=\"moduleid\" value=\"";
            // line 505
            echo ((($context["moduleid"] ?? null)) ? (($context["moduleid"] ?? null)) : (""));
            echo "\" />
                    
                    
                    ";
            // line 508
            if ( !($context["module_id"] ?? null)) {
                // line 509
                echo "                        <div class=\"input clearfix\">
                                <p>Clone Items From Existing Module</p>
                                <select name=\"import_module\" class=\"form-control\">
                                        ";
                // line 512
                if (($context["modules"] ?? null)) {
                    // line 513
                    echo "                                            ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(($context["modules"] ?? null));
                    foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                        // line 514
                        echo "                                             <option value=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["module"], "module_id", [], "any", false, false, false, 514);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["module"], "name", [], "any", false, false, false, 514);
                        echo "</option>
                                             ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 516
                    echo "                                             <option value=\"0\">Create new empty menu</option>
                                        ";
                } else {
                    // line 518
                    echo "                                        <option value=\"0\">No existing modules found</option>
                                        ";
                }
                // line 520
                echo "                                </select>
                        </div>
                    ";
            }
            // line 523
            echo "                    
                    
                    <div class=\"input clearfix\">
                            <p>Module Name</p>
                            <input type=\"text\" name=\"name\" value=\"";
            // line 527
            echo ($context["name"] ?? null);
            echo "\"  id=\"input-name\" class=\"form-control\" />
                    
                    </div>
                    
                    <div class=\"input clearfix\">
                            <p>";
            // line 532
            echo ($context["text_status"] ?? null);
            echo "</p>
                            <select name=\"status\" class=\"form-control\">
                                    ";
            // line 534
            if (($context["status"] ?? null)) {
                // line 535
                echo "                                    <option value=\"1\" selected=\"selected\">";
                echo ($context["text_enabled"] ?? null);
                echo "</option>
                                    <option value=\"0\">";
                // line 536
                echo ($context["text_disabled"] ?? null);
                echo "</option>
                                    ";
            } else {
                // line 538
                echo "                                    <option value=\"1\">";
                echo ($context["text_enabled"] ?? null);
                echo "</option>
                                    <option value=\"0\" selected=\"selected\">";
                // line 539
                echo ($context["text_disabled"] ?? null);
                echo "</option>
                                    ";
            }
            // line 541
            echo "                            </select>
                    </div>

</div>
";
        }
        // line 546
        echo "</div>
</div>
</div>
<!-- End Content -->
</form>
</div>
</div>
</div>
<script type=\"text/javascript\">
\$('#language a:first').tab('show');
if(\$(\"input[name='use_cache']:radio:checked\").val() == '0')
{
        \$('#input-cache_time_form').hide();
}else
{
        \$('#input-cache_time_form').show();
}
\$(\"input[name='use_cache']\").change(function(){
        val = \$(this).val();
        if(val ==0)
        {
                \$('#input-cache_time_form').hide();
        }else
        {
                \$('#input-cache_time_form').show();
        }
});
\$(document).ready(function() {
        \$(\".button_parent_config\").click(function(){
            if(\$(this).hasClass('active')) {
\t\t\t}
\t\t\telse
                \$(this).addClass('active'),
            \t\$(\"#text_parent_config\").collapse('show'),
\t\t\t\t\$(\"#text_content_config\").collapse('hide'),
\t\t\t\t\$(\".button_content_config\").removeClass('active'),
\t\t\t\t\$(\"#item_type\").val('1');
        });

        \$(\".button_content_config\").click(function(){
            if(\$(this).hasClass('active')) {
\t\t\t} else
                \$(this).addClass('active');
            \t\$(\"#text_parent_config\").collapse('hide'),
\t\t\t\t\$(\"#text_content_config\").collapse('show'),
\t\t\t\t\$(\".button_parent_config\").removeClass('active'),
\t\t\t\t\$(\"#item_type\").val('0');
        });

        \$('#nestable-menu').on('click', function(e)
        {
            var target = \$(e.target),
                    action = target.data('action');
            if (action === 'expand-all') {
                    \$('.dd').nestable('expandAll');
            }
            if (action === 'collapse-all') {
                    \$('.dd').nestable('collapseAll');
            }
        });

        \$('#language').change(function(){
            var that = \$(this), opt_select = \$('option:selected', that).val() , _input = \$('#input-head-name-'+opt_select);
            \$('[id^=\"input-head-name-\"]').addClass('hide');
            _input.removeClass('hide');
        });

        \$('#head_name_language').change(function(){
            var that = \$(this), opt_select = \$('option:selected', that).val() , _input = \$('#input-headname-'+opt_select);
            \$('[id^=\"input-headname-\"]').addClass('hide');
            _input.removeClass('hide');
        });

        \$('#des_language').change(function(){
            var that = \$(this), opt_select = \$('option:selected', that).val() , _input = \$('#input-head-des-'+opt_select);
            \$('[id^=\"input-head-des-\"]').addClass('hide');
            _input.removeClass('hide');
        });

        \$('#navigation_language').change(function(){
            var that = \$(this), opt_select = \$('option:selected', that).val() , _input = \$('#input-text-navigation-'+opt_select);
            \$('[id^=\"input-text-navigation-\"]').addClass('hide');
            _input.removeClass('hide');
        });

        \$('#home_text_language').change(function(){
            var that = \$(this), opt_select = \$('option:selected', that).val() , _input = \$('#input-home-text-'+opt_select);
            \$('[id^=\"input-home-text-\"]').addClass('hide');
            _input.removeClass('hide');
        });

        \$(\"select[name=content_type]\").change(function () {
                \$(\"select[name=content_type] option:selected\").each(function() {
                        \$(\".content_type\").hide();
                        \$(\"#content_type\" + \$(this).val()).show();
                });
        });
        \$(\"#submenu-type\").change(function () {
                \$(\"#submenu-type option:selected\").each(function() {
                        if(\$(this).val() == 2) {
                                \$(\"#submenu-columns\").show();
                        } else {
                                \$(\"#submenu-columns\").hide();
                        }
                });
        });
\t\t\$(\"#orientation_select\").change(function () {
                \$(\"#orientation_select option:selected\").each(function() {
                        if(\$(this).val() == 1) {
                                \$(\"#orientation_limit\").show();
                        } else {
                                \$(\"#orientation_limit\").hide();
                        }
                });
        });
        \$('li','.content_type_html').first().addClass('active');
        \$('.tab-pane','.content_type_html .tab-content').first().addClass('active');
        

        \$('#product_autocomplete').autocomplete({
                delay: 500,
                source: function(request, response) {
                        \$.ajax({
\t\t\t\t\t\t\t\turl: 'index.php?route=catalog/product/autocomplete&user_token=";
        // line 669
        echo ($context["user_token"] ?? null);
        echo "&filter_name=' + encodeURIComponent(request) ,
                                dataType: 'json',
                                success: function(json) {
                                        json.unshift({
                                                'product_id':  0,
                                                'name':  'None'
                                        });
                                        response(\$.map(json, function(item) {
                                                return {
                                                 label: item.name,
                                                 value: item.product_id
                                                }
                                        }));
                                }
                        });
                },
                
                select: function(event) {

                        \$('#product_autocomplete').val(event.label);
                        \$('input[name=\\'content[product][id]\\']').val(event.value);
                        return false;
                },
                focus: function(event) {
                        return false;
                }
        });


        \$('#categories_autocomplete').autocomplete({
                delay: 500,
                source: function(request, response) {
                        \$.ajax({
\t\t\t\t\t\t\t\turl: 'index.php?route=catalog/category/autocomplete&user_token=";
        // line 702
        echo ($context["user_token"] ?? null);
        echo "&filter_name=' +  request,
                                dataType: 'json',
                                success: function(json) {
                                        json.unshift({
                                                'category_id':  0,
                                                'name':  'None'
                                        });
                                        response(\$.map(json, function(item) {
                                                return {
                                                        label: item.name,
                                                        value: item.category_id
                                                }
                                        }));
                                }
                        });
                },
                select: function(event) {
                if(event.value > 0) {
                    \$(\"#sort_categories > .dd-list\").append('<li class=\"dd-item\" data-id=\"' + event.value + '\" data-name=\"' + event.label + '\"><a class=\"fa fa-times\"></a><div class=\"dd-handle\">' + event.label + '</div></li>');
                }
                updateOutput2(\$('#sort_categories').data('output', \$('#sort_categories_data')));
\t\t\t\t\$( \"#sort_categories .fa-times\" ).on( \"click\", function() {
\t\t\t\t\t\$(this).parent().remove();
\t\t\t\t\tupdateOutput2(\$('#sort_categories').data('output', \$('#sort_categories_data')));
\t\t\t\t});
                return false;
            },
            focus: function(event) {
                return false;
            }
        });

        function lagXHRobjekt() {
                var XHRobjekt = null;

                try {
                        ajaxRequest = new XMLHttpRequest(); // Firefox, Opera, ...
                } catch(err1) {
                        try {
                                ajaxRequest = new ActiveXObject(\"Microsoft.XMLHTTP\"); // Noen IE v.
                        } catch(err2) {
                                try {
                                        ajaxRequest = new ActiveXObject(\"Msxml2.XMLHTTP\"); // Noen IE v.
                                } catch(err3) {
                                        ajaxRequest = false;
                                }
                        }
                }
                return ajaxRequest;
        }


        function menu_updatesort(jsonstring) {
                mittXHRobjekt = lagXHRobjekt();

                if (mittXHRobjekt) {
                        mittXHRobjekt.onreadystatechange = function() {
                                if(ajaxRequest.readyState == 4){
                                        var ajaxDisplay = document.getElementById('sortDBfeedback');
                                        ajaxDisplay.innerHTML = ajaxRequest.responseText;
                                }
                        }
\t\t\t\t\t\tajaxRequest.open(\"GET\", \"index.php?route=extension/module/basel_megamenu&user_token=";
        // line 764
        echo ($context["user_token"] ?? null);
        echo "&jsonstring=\" + encodeURIComponent(jsonstring), true);
                                
                        ajaxRequest.setRequestHeader(\"Content-Type\", \"application/json\");
                        ajaxRequest.send(null);
                }
        }

        var updateOutput = function(e)
        {
                var list   = e.length ? e : \$(e.target),
                        output = list.data('output');

                if (window.JSON) {
                        menu_updatesort(window.JSON.stringify(list.nestable('serialize')));
                } else {
                        alert('JSON browser support required for this demo.');
                }
        };

        \$('#nestable').nestable({
                group: 1,
                maxDepth: 2
        }).on('change', updateOutput);

        updateOutput(\$('#nestable').data('output', \$('#nestable-output')));

        var updateOutput2 = function(e)
        {
                var list   = e.length ? e : \$(e.target),
                        output = list.data('output');
                if (window.JSON && typeof(output)!= 'undefined' ) {
                        output.val(window.JSON.stringify(list.nestable('serialize')));
                }
        };
        \$('#sort_categories').nestable({
               group: 1,
                maxDepth: 3
        }).on('change', updateOutput2);

                updateOutput2(\$('#sort_categories').data('output', \$('#sort_categories_data')));

       \$( \"#sort_categories .fa-times\" ).on( \"click\", function() {
               \$(this).parent().remove();
               updateOutput2(\$('#sort_categories').data('output', \$('#sort_categories_data')));
       });
        
\t\t
\t\t\$(document).delegate('.icon_list', 'click', function(e) {
\te.preventDefault();
\t\$.ajax({
\t\ttype: 'get',
\t\tdataType: 'html',
\t\tsuccess: function(data) {
\t\t\thtml  = '<div id=\"modal-icons\" class=\"modal content\">';
\t\t\thtml += '  <div class=\"modal-dialog\">';
\t\t\thtml += '    <div class=\"modal-content\">';
\t\t\thtml += '      <div class=\"modal-header\">';
\t\t\thtml += '        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>';
\t\t\thtml += '        <h4 class=\"modal-title\">Icon List Preview</h4>';
\t\t\thtml += '      </div>';
\t\t\thtml += '      <div class=\"modal-body\"><iframe src=\"view/javascript/basel/icons_list/icon_list.html\" width=\"1240\" height=\"560\" frameborder=\"0\" allowtransparency=\"true\"></iframe></div>';
\t\t\thtml += '    </div';
\t\t\thtml += '  </div>';
\t\t\thtml += '</div>';
\t\t\t\$('body').append(html);
\t\t\t\$('#modal-icons').modal('show');
\t\t}
\t});
});

        
});
</script>
<script type=\"text/javascript\">
function enable_editor(textarea) {
\t\$(textarea).summernote({
\t\t\tdisableDragAndDrop: true,
\t\t\temptyPara: '',
\t\t\theight: 300,
\t\t\tcodemirror: { // codemirror options
\t\t\t\tmode: 'text/html',
\t\t\t\thtmlMode: true,
\t\t\t\tlineNumbers: true,
\t\t\t\ttheme: 'monokai'
\t\t\t},\t\t\t
\t\t\tfontsize: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '24', '30', '36', '48' , '64'],
\t\t\ttoolbar: [
\t\t\t\t['style', ['style']],
\t\t\t\t['font', ['bold', 'underline','italic', 'clear']],
\t\t\t\t['fontname', ['fontname']],
\t\t\t\t['color', ['color']],
\t\t\t\t['para', ['ul', 'paragraph']],
\t\t\t\t['table', ['table']],
\t\t\t\t['insert', ['link', 'image', 'video']],
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
\t\t\t\t\t\t\t\t\t\t\$(textarea).summernote('insertImage', \$(this).attr('href'));
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\$('#modal-image').modal('hide');
\t\t\t\t\t\t\t\t\t});
\t\t\t\t\t\t\t\t}});}});
\t\t\t\treturn button.render();
\t\t}}});
}
</script>
<link href=\"view/javascript/codemirror/lib/codemirror.css\" rel=\"stylesheet\" />
<link href=\"view/javascript/codemirror/theme/monokai.css\" rel=\"stylesheet\" />
<script type=\"text/javascript\" src=\"view/javascript/codemirror/lib/codemirror.js\"></script> 
<script type=\"text/javascript\" src=\"view/javascript/codemirror/lib/xml.js\"></script> 
<script type=\"text/javascript\" src=\"view/javascript/codemirror/lib/formatting.js\"></script> 
<script type=\"text/javascript\" src=\"view/javascript/summernote/summernote.js\"></script>
<link href=\"view/javascript/summernote/summernote.css\" rel=\"stylesheet\" />
<script type=\"text/javascript\" src=\"view/javascript/summernote/summernote-image-attributes.js\"></script>
<script type=\"text/javascript\" src=\"view/javascript/summernote/opencart.js\"></script>
";
        // line 921
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "extension/module/basel_megamenu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1655 => 921,  1495 => 764,  1430 => 702,  1394 => 669,  1269 => 546,  1262 => 541,  1257 => 539,  1252 => 538,  1247 => 536,  1242 => 535,  1240 => 534,  1235 => 532,  1227 => 527,  1221 => 523,  1216 => 520,  1212 => 518,  1208 => 516,  1197 => 514,  1192 => 513,  1190 => 512,  1185 => 509,  1183 => 508,  1177 => 505,  1168 => 499,  1164 => 497,  1155 => 490,  1151 => 488,  1147 => 486,  1145 => 485,  1142 => 484,  1138 => 482,  1134 => 480,  1132 => 479,  1129 => 478,  1125 => 476,  1121 => 474,  1119 => 473,  1116 => 472,  1112 => 470,  1108 => 468,  1106 => 467,  1103 => 466,  1099 => 464,  1095 => 462,  1093 => 461,  1090 => 460,  1086 => 458,  1082 => 456,  1080 => 455,  1070 => 452,  1065 => 449,  1061 => 447,  1057 => 445,  1055 => 444,  1052 => 443,  1048 => 441,  1044 => 439,  1042 => 438,  1034 => 432,  1030 => 430,  1026 => 428,  1024 => 427,  1021 => 426,  1017 => 424,  1013 => 422,  1011 => 421,  1008 => 420,  1004 => 418,  1000 => 416,  998 => 415,  995 => 414,  991 => 412,  987 => 410,  985 => 409,  982 => 408,  978 => 406,  974 => 404,  972 => 403,  969 => 402,  965 => 400,  961 => 398,  959 => 397,  949 => 390,  943 => 387,  925 => 376,  915 => 369,  909 => 368,  898 => 364,  887 => 356,  879 => 351,  871 => 346,  867 => 345,  856 => 341,  847 => 334,  838 => 331,  829 => 329,  824 => 328,  821 => 327,  817 => 326,  813 => 324,  797 => 320,  793 => 319,  790 => 318,  786 => 317,  777 => 313,  769 => 307,  765 => 305,  761 => 303,  758 => 302,  754 => 300,  750 => 298,  747 => 297,  743 => 295,  739 => 293,  736 => 292,  732 => 290,  728 => 288,  726 => 287,  721 => 285,  715 => 281,  698 => 279,  694 => 278,  689 => 276,  682 => 271,  677 => 269,  672 => 268,  667 => 266,  662 => 265,  660 => 264,  653 => 259,  647 => 256,  642 => 255,  636 => 252,  631 => 251,  629 => 250,  622 => 245,  618 => 243,  614 => 241,  611 => 240,  607 => 238,  603 => 236,  600 => 235,  596 => 233,  592 => 231,  589 => 230,  585 => 228,  581 => 226,  578 => 225,  574 => 223,  570 => 221,  567 => 220,  563 => 218,  559 => 216,  556 => 215,  552 => 213,  548 => 211,  545 => 210,  541 => 208,  537 => 206,  534 => 205,  530 => 203,  526 => 201,  524 => 200,  519 => 198,  511 => 193,  505 => 192,  496 => 186,  492 => 185,  488 => 183,  482 => 180,  477 => 179,  471 => 176,  466 => 175,  464 => 174,  459 => 172,  453 => 168,  436 => 166,  432 => 165,  429 => 164,  408 => 162,  405 => 161,  400 => 160,  398 => 159,  394 => 158,  381 => 148,  376 => 146,  370 => 142,  365 => 140,  360 => 139,  355 => 137,  350 => 136,  348 => 135,  343 => 133,  335 => 128,  328 => 123,  323 => 121,  318 => 120,  313 => 118,  308 => 117,  306 => 116,  301 => 114,  293 => 109,  288 => 107,  279 => 100,  262 => 98,  258 => 97,  254 => 95,  233 => 93,  230 => 92,  225 => 91,  223 => 90,  219 => 89,  213 => 86,  210 => 85,  204 => 83,  199 => 81,  193 => 80,  191 => 79,  187 => 77,  183 => 75,  179 => 73,  177 => 72,  174 => 71,  172 => 70,  165 => 65,  163 => 64,  160 => 63,  146 => 54,  139 => 50,  135 => 49,  127 => 44,  124 => 43,  122 => 42,  114 => 37,  108 => 34,  103 => 31,  95 => 27,  93 => 26,  90 => 25,  82 => 21,  80 => 20,  73 => 15,  62 => 13,  58 => 12,  53 => 10,  47 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/module/basel_megamenu.twig", "");
    }
}
