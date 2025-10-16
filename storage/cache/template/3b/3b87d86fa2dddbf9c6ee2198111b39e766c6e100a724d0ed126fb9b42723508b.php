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

/* extension/basel/basel_layout_form.twig */
class __TwigTemplate_ea71b0ca03423e59cab2094523ad3804a591257661a28fc5f6c1831849e08b76 extends \Twig\Template
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
        <button type=\"submit\" form=\"form-layout\" data-toggle=\"tooltip\" title=\"";
        // line 6
        echo ($context["button_save"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-save\"></i></button>
        <a href=\"";
        // line 7
        echo ($context["cancel"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_cancel"] ?? null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-reply\"></i></a></div>
      <h1>";
        // line 8
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      <ul class=\"breadcrumb\">
        ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 11
            echo "        <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 11);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 11);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "      </ul>
    </div>
  </div>
  <div class=\"container-fluid\">
    ";
        // line 17
        if (($context["error_warning"] ?? null)) {
            // line 18
            echo "    <div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 22
        echo "    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-pencil\"></i> ";
        // line 24
        echo ($context["text_form"] ?? null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
        <form action=\"";
        // line 27
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-layout\" class=\"form-horizontal\">
          <div class=\"form-group required\">
            <label class=\"col-sm-2 control-label\" for=\"input-name\">";
        // line 29
        echo ($context["entry_name"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"name\" value=\"";
        // line 31
        echo ($context["name"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_name"] ?? null);
        echo "\" id=\"input-name\" class=\"form-control\" />
              ";
        // line 32
        if (($context["error_name"] ?? null)) {
            // line 33
            echo "              <div class=\"text-danger\">";
            echo ($context["error_name"] ?? null);
            echo "</div>
              ";
        }
        // line 35
        echo "            </div>
          </div>
          <table id=\"route\" class=\"table table-striped table-bordered table-hover\">
            <thead>
              <tr>
                <td class=\"text-left\">";
        // line 40
        echo ($context["entry_store"] ?? null);
        echo "</td>
                <td class=\"text-left\">";
        // line 41
        echo ($context["entry_route"] ?? null);
        echo "</td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              ";
        // line 46
        $context["route_row"] = 0;
        // line 47
        echo "              ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["layout_routes"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["layout_route"]) {
            // line 48
            echo "\t\t\t  ";
            if (((((twig_get_attribute($this->env, $this->source, $context["layout_route"], "route", [], "any", false, false, false, 48) == "product/category") || (twig_get_attribute($this->env, $this->source, $context["layout_route"], "route", [], "any", false, false, false, 48) == "product/manufacturer")) || (twig_get_attribute($this->env, $this->source, $context["layout_route"], "route", [], "any", false, false, false, 48) == "product/search")) || (twig_get_attribute($this->env, $this->source, $context["layout_route"], "route", [], "any", false, false, false, 48) == "product/special"))) {
                // line 49
                echo "\t\t\t  <style>.category_above_products {display:block !important}</style>
\t\t\t  ";
            }
            // line 51
            echo "              <tr id=\"route-row";
            echo ($context["route_row"] ?? null);
            echo "\">
                <td class=\"text-left\"><select name=\"layout_route[";
            // line 52
            echo ($context["route_row"] ?? null);
            echo "][store_id]\" class=\"form-control\">
                    <option value=\"0\">";
            // line 53
            echo ($context["text_default"] ?? null);
            echo "</option>
                    ";
            // line 54
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
                // line 55
                echo "                    ";
                if ((twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 55) == twig_get_attribute($this->env, $this->source, $context["layout_route"], "store_id", [], "any", false, false, false, 55))) {
                    // line 56
                    echo "                    <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 56);
                    echo "\" selected=\"selected\">";
                    echo twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 56);
                    echo "</option>
                    ";
                } else {
                    // line 58
                    echo "                    <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 58);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 58);
                    echo "</option>
                    ";
                }
                // line 60
                echo "                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 61
            echo "                  </select></td>
                <td class=\"text-left\"><input type=\"text\" name=\"layout_route[";
            // line 62
            echo ($context["route_row"] ?? null);
            echo "][route]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["layout_route"], "route", [], "any", false, false, false, 62);
            echo "\" placeholder=\"";
            echo ($context["entry_route"] ?? null);
            echo "\" class=\"form-control\" /></td>
                <td class=\"text-left\"><button type=\"button\" onclick=\"\$('#route-row";
            // line 63
            echo ($context["route_row"] ?? null);
            echo "').remove();\" data-toggle=\"tooltip\" title=\"";
            echo ($context["button_remove"] ?? null);
            echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>
              </tr>
              ";
            // line 65
            $context["route_row"] = (($context["route_row"] ?? null) + 1);
            // line 66
            echo "              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['layout_route'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 67
        echo "            </tbody>
            <tfoot>
              <tr>
                <td colspan=\"2\"></td>
                <td class=\"text-left\"><button type=\"button\" onclick=\"addRoute();\" data-toggle=\"tooltip\" title=\"";
        // line 71
        echo ($context["button_route_add"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus-circle\"></i></button></td>
              </tr>
            </tfoot>
          </table>
          
          ";
        // line 76
        $context["module_row"] = 1;
        // line 77
        echo "          
          <div id=\"module\" class=\"well\">
            
            <div class=\"row\">
            \t<div class=\"col-sm-12\">
              <h4>Top</h4>
              <div class=\"well well-white\">
              <div class=\"row top\">
              <div class=\"col-sm-12\">
              <table class=\"heading\" style=\"width:100%\">
                <td>";
        // line 87
        echo ($context["entry_module"] ?? null);
        echo "</td>
                <td width=\"98\">Sort order</td>
              </table>
              </div>
              ";
        // line 91
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["layout_modules"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["layout_module"]) {
            // line 92
            echo "              ";
            if ((twig_get_attribute($this->env, $this->source, $context["layout_module"], "position", [], "any", false, false, false, 92) == "top")) {
                // line 93
                echo "              <div id=\"module-row";
                echo ($context["module_row"] ?? null);
                echo "\" class=\"col-sm-12\">
              <div class=\"well module\">
                <table style=\"width:100%\">
                <td>
                <select name=\"layout_module[";
                // line 97
                echo ($context["module_row"] ?? null);
                echo "][code]\" class=\"form-control\">
                    ";
                // line 98
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["extensions"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["extension"]) {
                    // line 99
                    echo "                    ";
                    if ( !twig_get_attribute($this->env, $this->source, $context["extension"], "module", [], "any", false, false, false, 99)) {
                        // line 100
                        echo "                        ";
                        if ((twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 100) == twig_get_attribute($this->env, $this->source, $context["layout_module"], "code", [], "any", false, false, false, 100))) {
                            // line 101
                            echo "                        <option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 101);
                            echo "\" selected=\"selected\">";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 101);
                            echo "</option>
                        ";
                        } else {
                            // line 103
                            echo "                        <option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 103);
                            echo "\">";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 103);
                            echo "</option>
                        ";
                        }
                        // line 105
                        echo "                    ";
                    } else {
                        // line 106
                        echo "                    <optgroup label=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 106);
                        echo "\">
                    ";
                        // line 107
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["extension"], "module", [], "any", false, false, false, 107));
                        foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                            // line 108
                            echo "                        ";
                            if ((twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 108) == twig_get_attribute($this->env, $this->source, $context["layout_module"], "code", [], "any", false, false, false, 108))) {
                                // line 109
                                echo "                        <option value=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 109);
                                echo "\" selected=\"selected\">";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "name", [], "any", false, false, false, 109);
                                echo "</option>
                        ";
                            } else {
                                // line 111
                                echo "                        <option value=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 111);
                                echo "\">";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "name", [], "any", false, false, false, 111);
                                echo "</option>
                        ";
                            }
                            // line 113
                            echo "                    ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 114
                        echo "                    </optgroup>
                    ";
                    }
                    // line 116
                    echo "                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extension'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 117
                echo "                  </select>
                  <input type=\"hidden\" name=\"layout_module[";
                // line 118
                echo ($context["module_row"] ?? null);
                echo "][position]\" value=\"top\"  />
                 </td>
                <td width=\"50\" style=\"padding-left:10px\">
               <input type=\"text\" name=\"layout_module[";
                // line 121
                echo ($context["module_row"] ?? null);
                echo "][sort_order]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["layout_module"], "sort_order", [], "any", false, false, false, 121);
                echo "\"  class=\"form-control\" />
               </td>
               <td align=\"right\" width=\"48\">
                <button type=\"button\" onclick=\"\$('#module-row";
                // line 124
                echo ($context["module_row"] ?? null);
                echo "').remove();\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_remove"] ?? null);
                echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button>
                </td>
              </table>
              </div>
              </div>
              ";
                // line 129
                $context["module_row"] = (($context["module_row"] ?? null) + 1);
                // line 130
                echo "              ";
            }
            // line 131
            echo "\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['layout_module'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 132
        echo "              </div>
              <button type=\"button\" onclick=\"addModule('top');\" class=\"btn btn-primary btn-block\">";
        // line 133
        echo ($context["button_module_add"] ?? null);
        echo "</button>
              </div>
              </div>
            </div>

            
            
            <div class=\"row\">

            <div class=\"col-sm-3\">
            <h4>Column Left</h4>
              <div class=\"well well-white\">
              <div class=\"row column_left\">
              <div class=\"col-sm-12\">
              <table class=\"heading\" style=\"width:100%\">
                <td>";
        // line 148
        echo ($context["entry_module"] ?? null);
        echo "</td>
                <td width=\"98\">Sort order</td>
              </table>
              </div>
              ";
        // line 152
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["layout_modules"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["layout_module"]) {
            // line 153
            echo "              ";
            if ((twig_get_attribute($this->env, $this->source, $context["layout_module"], "position", [], "any", false, false, false, 153) == "column_left")) {
                // line 154
                echo "              <div id=\"module-row";
                echo ($context["module_row"] ?? null);
                echo "\" class=\"col-sm-12\">
              <div class=\"well module\">
                <table style=\"width:100%\">
                <td>
                <select name=\"layout_module[";
                // line 158
                echo ($context["module_row"] ?? null);
                echo "][code]\" class=\"form-control\">
                    ";
                // line 159
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["extensions"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["extension"]) {
                    // line 160
                    echo "                    ";
                    if ( !twig_get_attribute($this->env, $this->source, $context["extension"], "module", [], "any", false, false, false, 160)) {
                        // line 161
                        echo "                        ";
                        if ((twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 161) == twig_get_attribute($this->env, $this->source, $context["layout_module"], "code", [], "any", false, false, false, 161))) {
                            // line 162
                            echo "                        <option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 162);
                            echo "\" selected=\"selected\">";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 162);
                            echo "</option>
                        ";
                        } else {
                            // line 164
                            echo "                        <option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 164);
                            echo "\">";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 164);
                            echo "</option>
                        ";
                        }
                        // line 166
                        echo "                    ";
                    } else {
                        // line 167
                        echo "                    <optgroup label=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 167);
                        echo "\">
                    ";
                        // line 168
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["extension"], "module", [], "any", false, false, false, 168));
                        foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                            // line 169
                            echo "                        ";
                            if ((twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 169) == twig_get_attribute($this->env, $this->source, $context["layout_module"], "code", [], "any", false, false, false, 169))) {
                                // line 170
                                echo "                        <option value=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 170);
                                echo "\" selected=\"selected\">";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "name", [], "any", false, false, false, 170);
                                echo "</option>
                        ";
                            } else {
                                // line 172
                                echo "                        <option value=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 172);
                                echo "\">";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "name", [], "any", false, false, false, 172);
                                echo "</option>
                        ";
                            }
                            // line 174
                            echo "                    ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 175
                        echo "                    </optgroup>
                    ";
                    }
                    // line 177
                    echo "                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extension'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 178
                echo "                  </select>
                  <input type=\"hidden\" name=\"layout_module[";
                // line 179
                echo ($context["module_row"] ?? null);
                echo "][position]\" value=\"column_left\"  />
                 </td>
                <td width=\"50\" style=\"padding-left:10px\">
               <input type=\"text\" name=\"layout_module[";
                // line 182
                echo ($context["module_row"] ?? null);
                echo "][sort_order]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["layout_module"], "sort_order", [], "any", false, false, false, 182);
                echo "\"  class=\"form-control\" />
               </td>
               <td align=\"right\" width=\"48\">
                <button type=\"button\" onclick=\"\$('#module-row";
                // line 185
                echo ($context["module_row"] ?? null);
                echo "').remove();\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_remove"] ?? null);
                echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button>
                </td>
              </table>
              </div>
              </div>
              ";
                // line 190
                $context["module_row"] = (($context["module_row"] ?? null) + 1);
                // line 191
                echo "              ";
            }
            // line 192
            echo "\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['layout_module'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 193
        echo "              </div>
              <button type=\"button\" onclick=\"addModule('column_left');\" class=\"btn btn-primary btn-block\">";
        // line 194
        echo ($context["button_module_add"] ?? null);
        echo "</button>
              </div>
            </div>
            
            
            <div class=\"col-sm-6\">
              
\t\t\t  <h4>Content Top</h4>
              <div class=\"well well-white\">
              <div class=\"row content_top\">
              <div class=\"col-sm-12\">
              <table class=\"heading\" style=\"width:100%\">
                <td>";
        // line 206
        echo ($context["entry_module"] ?? null);
        echo "</td>
                <td width=\"98\">Sort order</td>
              </table>
              </div>
              ";
        // line 210
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["layout_modules"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["layout_module"]) {
            // line 211
            echo "              ";
            if ((twig_get_attribute($this->env, $this->source, $context["layout_module"], "position", [], "any", false, false, false, 211) == "content_top")) {
                // line 212
                echo "              <div id=\"module-row";
                echo ($context["module_row"] ?? null);
                echo "\" class=\"col-sm-12\">
              <div class=\"well module\">
                <table style=\"width:100%\">
                <td>
                <select name=\"layout_module[";
                // line 216
                echo ($context["module_row"] ?? null);
                echo "][code]\" class=\"form-control\">
                    ";
                // line 217
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["extensions"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["extension"]) {
                    // line 218
                    echo "                    ";
                    if ( !twig_get_attribute($this->env, $this->source, $context["extension"], "module", [], "any", false, false, false, 218)) {
                        // line 219
                        echo "                        ";
                        if ((twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 219) == twig_get_attribute($this->env, $this->source, $context["layout_module"], "code", [], "any", false, false, false, 219))) {
                            // line 220
                            echo "                        <option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 220);
                            echo "\" selected=\"selected\">";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 220);
                            echo "</option>
                        ";
                        } else {
                            // line 222
                            echo "                        <option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 222);
                            echo "\">";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 222);
                            echo "</option>
                        ";
                        }
                        // line 224
                        echo "                    ";
                    } else {
                        // line 225
                        echo "                    <optgroup label=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 225);
                        echo "\">
                    ";
                        // line 226
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["extension"], "module", [], "any", false, false, false, 226));
                        foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                            // line 227
                            echo "                        ";
                            if ((twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 227) == twig_get_attribute($this->env, $this->source, $context["layout_module"], "code", [], "any", false, false, false, 227))) {
                                // line 228
                                echo "                        <option value=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 228);
                                echo "\" selected=\"selected\">";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "name", [], "any", false, false, false, 228);
                                echo "</option>
                        ";
                            } else {
                                // line 230
                                echo "                        <option value=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 230);
                                echo "\">";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "name", [], "any", false, false, false, 230);
                                echo "</option>
                        ";
                            }
                            // line 232
                            echo "                    ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 233
                        echo "                    </optgroup>
                    ";
                    }
                    // line 235
                    echo "                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extension'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 236
                echo "                  </select>
                  <input type=\"hidden\" name=\"layout_module[";
                // line 237
                echo ($context["module_row"] ?? null);
                echo "][position]\" value=\"content_top\"  />
                 </td>
                <td width=\"50\" style=\"padding-left:10px\">
               <input type=\"text\" name=\"layout_module[";
                // line 240
                echo ($context["module_row"] ?? null);
                echo "][sort_order]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["layout_module"], "sort_order", [], "any", false, false, false, 240);
                echo "\"  class=\"form-control\" />
               </td>
               <td align=\"right\" width=\"48\">
                <button type=\"button\" onclick=\"\$('#module-row";
                // line 243
                echo ($context["module_row"] ?? null);
                echo "').remove();\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_remove"] ?? null);
                echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button>
                </td>
              </table>
              </div>
              </div>
              ";
                // line 248
                $context["module_row"] = (($context["module_row"] ?? null) + 1);
                // line 249
                echo "              ";
            }
            // line 250
            echo "\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['layout_module'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 251
        echo "              </div>
              <button type=\"button\" onclick=\"addModule('content_top');\" class=\"btn btn-primary btn-block\">";
        // line 252
        echo ($context["button_module_add"] ?? null);
        echo "</button>
              </div>
\t\t\t  
\t\t\t  
\t\t\t  <div class=\"category_above_products\" style=\"display:none\">
\t\t\t  <h4>Above Product List</h4>
              <div class=\"well well-white\">
              <div class=\"row cat_top\">
              <div class=\"col-sm-12\">
              <table class=\"heading\" style=\"width:100%\">
                <td>";
        // line 262
        echo ($context["entry_module"] ?? null);
        echo "</td>
                <td width=\"98\">Sort order</td>
              </table>
              </div>
              ";
        // line 266
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["layout_modules"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["layout_module"]) {
            // line 267
            echo "              ";
            if ((twig_get_attribute($this->env, $this->source, $context["layout_module"], "position", [], "any", false, false, false, 267) == "cat_top")) {
                // line 268
                echo "              <div id=\"module-row";
                echo ($context["module_row"] ?? null);
                echo "\" class=\"col-sm-12\">
              <div class=\"well module\">
                <table style=\"width:100%\">
                <td>
                <select name=\"layout_module[";
                // line 272
                echo ($context["module_row"] ?? null);
                echo "][code]\" class=\"form-control\">
                    ";
                // line 273
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["extensions"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["extension"]) {
                    // line 274
                    echo "                    ";
                    if ( !twig_get_attribute($this->env, $this->source, $context["extension"], "module", [], "any", false, false, false, 274)) {
                        // line 275
                        echo "                        ";
                        if ((twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 275) == twig_get_attribute($this->env, $this->source, $context["layout_module"], "code", [], "any", false, false, false, 275))) {
                            // line 276
                            echo "                        <option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 276);
                            echo "\" selected=\"selected\">";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 276);
                            echo "</option>
                        ";
                        } else {
                            // line 278
                            echo "                        <option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 278);
                            echo "\">";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 278);
                            echo "</option>
                        ";
                        }
                        // line 280
                        echo "                    ";
                    } else {
                        // line 281
                        echo "                    <optgroup label=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 281);
                        echo "\">
                    ";
                        // line 282
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["extension"], "module", [], "any", false, false, false, 282));
                        foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                            // line 283
                            echo "                        ";
                            if ((twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 283) == twig_get_attribute($this->env, $this->source, $context["layout_module"], "code", [], "any", false, false, false, 283))) {
                                // line 284
                                echo "                        <option value=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 284);
                                echo "\" selected=\"selected\">";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "name", [], "any", false, false, false, 284);
                                echo "</option>
                        ";
                            } else {
                                // line 286
                                echo "                        <option value=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 286);
                                echo "\">";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "name", [], "any", false, false, false, 286);
                                echo "</option>
                        ";
                            }
                            // line 288
                            echo "                    ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 289
                        echo "                    </optgroup>
                    ";
                    }
                    // line 291
                    echo "                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extension'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 292
                echo "                  </select>
                  <input type=\"hidden\" name=\"layout_module[";
                // line 293
                echo ($context["module_row"] ?? null);
                echo "][position]\" value=\"cat_top\"  />
                 </td>
                <td width=\"50\" style=\"padding-left:10px\">
               <input type=\"text\" name=\"layout_module[";
                // line 296
                echo ($context["module_row"] ?? null);
                echo "][sort_order]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["layout_module"], "sort_order", [], "any", false, false, false, 296);
                echo "\"  class=\"form-control\" />
               </td>
               <td align=\"right\" width=\"48\">
                <button type=\"button\" onclick=\"\$('#module-row";
                // line 299
                echo ($context["module_row"] ?? null);
                echo "').remove();\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_remove"] ?? null);
                echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button>
                </td>
              </table>
              </div>
              </div>
              ";
                // line 304
                $context["module_row"] = (($context["module_row"] ?? null) + 1);
                // line 305
                echo "              ";
            }
            // line 306
            echo "\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['layout_module'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 307
        echo "              </div>
              <button type=\"button\" onclick=\"addModule('cat_top');\" class=\"btn btn-primary btn-block\">";
        // line 308
        echo ($context["button_module_add"] ?? null);
        echo "</button>
              </div>
              </div>
            
            
              <h4>Content Bottom</h4>
              <div class=\"well well-white\">
              <div class=\"row content_bottom\">
              <div class=\"col-sm-12\">
              <table class=\"heading\" style=\"width:100%\">
                <td>";
        // line 318
        echo ($context["entry_module"] ?? null);
        echo "</td>
                <td width=\"98\">Sort order</td>
              </table>
              </div>
              ";
        // line 322
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["layout_modules"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["layout_module"]) {
            // line 323
            echo "              ";
            if ((twig_get_attribute($this->env, $this->source, $context["layout_module"], "position", [], "any", false, false, false, 323) == "content_bottom")) {
                // line 324
                echo "              <div id=\"module-row";
                echo ($context["module_row"] ?? null);
                echo "\" class=\"col-sm-12\">
              <div class=\"well module\">
                <table style=\"width:100%\">
                <td>
                <select name=\"layout_module[";
                // line 328
                echo ($context["module_row"] ?? null);
                echo "][code]\" class=\"form-control\">
                    ";
                // line 329
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["extensions"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["extension"]) {
                    // line 330
                    echo "                    ";
                    if ( !twig_get_attribute($this->env, $this->source, $context["extension"], "module", [], "any", false, false, false, 330)) {
                        // line 331
                        echo "                        ";
                        if ((twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 331) == twig_get_attribute($this->env, $this->source, $context["layout_module"], "code", [], "any", false, false, false, 331))) {
                            // line 332
                            echo "                        <option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 332);
                            echo "\" selected=\"selected\">";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 332);
                            echo "</option>
                        ";
                        } else {
                            // line 334
                            echo "                        <option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 334);
                            echo "\">";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 334);
                            echo "</option>
                        ";
                        }
                        // line 336
                        echo "                    ";
                    } else {
                        // line 337
                        echo "                    <optgroup label=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 337);
                        echo "\">
                    ";
                        // line 338
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["extension"], "module", [], "any", false, false, false, 338));
                        foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                            // line 339
                            echo "                        ";
                            if ((twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 339) == twig_get_attribute($this->env, $this->source, $context["layout_module"], "code", [], "any", false, false, false, 339))) {
                                // line 340
                                echo "                        <option value=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 340);
                                echo "\" selected=\"selected\">";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "name", [], "any", false, false, false, 340);
                                echo "</option>
                        ";
                            } else {
                                // line 342
                                echo "                        <option value=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 342);
                                echo "\">";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "name", [], "any", false, false, false, 342);
                                echo "</option>
                        ";
                            }
                            // line 344
                            echo "                    ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 345
                        echo "                    </optgroup>
                    ";
                    }
                    // line 347
                    echo "                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extension'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 348
                echo "                  </select>
                  <input type=\"hidden\" name=\"layout_module[";
                // line 349
                echo ($context["module_row"] ?? null);
                echo "][position]\" value=\"content_bottom\"  />
                 </td>
                <td width=\"50\" style=\"padding-left:10px\">
               <input type=\"text\" name=\"layout_module[";
                // line 352
                echo ($context["module_row"] ?? null);
                echo "][sort_order]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["layout_module"], "sort_order", [], "any", false, false, false, 352);
                echo "\"  class=\"form-control\" />
               </td>
               <td align=\"right\" width=\"48\">
                <button type=\"button\" onclick=\"\$('#module-row";
                // line 355
                echo ($context["module_row"] ?? null);
                echo "').remove();\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_remove"] ?? null);
                echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button>
                </td>
              </table>
              </div>
              </div>
              ";
                // line 360
                $context["module_row"] = (($context["module_row"] ?? null) + 1);
                // line 361
                echo "              ";
            }
            // line 362
            echo "\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['layout_module'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 363
        echo "              </div>
              <button type=\"button\" onclick=\"addModule('content_bottom');\" class=\"btn btn-primary btn-block\">";
        // line 364
        echo ($context["button_module_add"] ?? null);
        echo "</button>
              </div>
              
            </div>
            
            <div class=\"col-sm-3\">
              <h4>Column Right</h4>
              <div class=\"well well-white\">
              <div class=\"row column_right\">
              <div class=\"col-sm-12\">
              <table class=\"heading\" style=\"width:100%\">
                <td>";
        // line 375
        echo ($context["entry_module"] ?? null);
        echo "</td>
                <td width=\"98\">Sort order</td>
              </table>
              </div>
              ";
        // line 379
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["layout_modules"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["layout_module"]) {
            // line 380
            echo "              ";
            if ((twig_get_attribute($this->env, $this->source, $context["layout_module"], "position", [], "any", false, false, false, 380) == "column_right")) {
                // line 381
                echo "              <div id=\"module-row";
                echo ($context["module_row"] ?? null);
                echo "\" class=\"col-sm-12\">
              <div class=\"well module\">
                <table style=\"width:100%\">
                <td>
                <select name=\"layout_module[";
                // line 385
                echo ($context["module_row"] ?? null);
                echo "][code]\" class=\"form-control\">
                    ";
                // line 386
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["extensions"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["extension"]) {
                    // line 387
                    echo "                    ";
                    if ( !twig_get_attribute($this->env, $this->source, $context["extension"], "module", [], "any", false, false, false, 387)) {
                        // line 388
                        echo "                        ";
                        if ((twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 388) == twig_get_attribute($this->env, $this->source, $context["layout_module"], "code", [], "any", false, false, false, 388))) {
                            // line 389
                            echo "                        <option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 389);
                            echo "\" selected=\"selected\">";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 389);
                            echo "</option>
                        ";
                        } else {
                            // line 391
                            echo "                        <option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 391);
                            echo "\">";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 391);
                            echo "</option>
                        ";
                        }
                        // line 393
                        echo "                    ";
                    } else {
                        // line 394
                        echo "                    <optgroup label=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 394);
                        echo "\">
                    ";
                        // line 395
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["extension"], "module", [], "any", false, false, false, 395));
                        foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                            // line 396
                            echo "                        ";
                            if ((twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 396) == twig_get_attribute($this->env, $this->source, $context["layout_module"], "code", [], "any", false, false, false, 396))) {
                                // line 397
                                echo "                        <option value=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 397);
                                echo "\" selected=\"selected\">";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "name", [], "any", false, false, false, 397);
                                echo "</option>
                        ";
                            } else {
                                // line 399
                                echo "                        <option value=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 399);
                                echo "\">";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "name", [], "any", false, false, false, 399);
                                echo "</option>
                        ";
                            }
                            // line 401
                            echo "                    ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 402
                        echo "                    </optgroup>
                    ";
                    }
                    // line 404
                    echo "                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extension'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 405
                echo "                  </select>
                  <input type=\"hidden\" name=\"layout_module[";
                // line 406
                echo ($context["module_row"] ?? null);
                echo "][position]\" value=\"column_right\"  />
                 </td>
                <td width=\"50\" style=\"padding-left:10px\">
               <input type=\"text\" name=\"layout_module[";
                // line 409
                echo ($context["module_row"] ?? null);
                echo "][sort_order]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["layout_module"], "sort_order", [], "any", false, false, false, 409);
                echo "\"  class=\"form-control\" />
               </td>
               <td align=\"right\" width=\"48\">
                <button type=\"button\" onclick=\"\$('#module-row";
                // line 412
                echo ($context["module_row"] ?? null);
                echo "').remove();\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_remove"] ?? null);
                echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button>
                </td>
              </table>
              </div>
              </div>
              ";
                // line 417
                $context["module_row"] = (($context["module_row"] ?? null) + 1);
                // line 418
                echo "              ";
            }
            // line 419
            echo "\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['layout_module'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 420
        echo "              </div>
              <button type=\"button\" onclick=\"addModule('column_right');\" class=\"btn btn-primary btn-block\">";
        // line 421
        echo ($context["button_module_add"] ?? null);
        echo "</button>
              </div>
            </div>
            </div>
            
            <div class=\"row\">
            \t<div class=\"col-sm-12\">
              <h4>Bottom (50% width)</h4>
              <div class=\"well well-white\">
              <div class=\"row bottom_half\">
              <div class=\"col-sm-6\">
              <table class=\"heading\" style=\"width:100%\">
                <td>";
        // line 433
        echo ($context["entry_module"] ?? null);
        echo "</td>
                <td width=\"98\">Sort order</td>
              </table>
              </div>
              <div class=\"col-sm-6\">
              <table class=\"heading\" style=\"width:100%\">
                <td>";
        // line 439
        echo ($context["entry_module"] ?? null);
        echo "</td>
                <td width=\"98\">Sort order</td>
              </table>
              </div>
              ";
        // line 443
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["layout_modules"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["layout_module"]) {
            // line 444
            echo "              ";
            if ((twig_get_attribute($this->env, $this->source, $context["layout_module"], "position", [], "any", false, false, false, 444) == "bottom_half")) {
                // line 445
                echo "              <div id=\"module-row";
                echo ($context["module_row"] ?? null);
                echo "\" class=\"col-sm-6\">
              <div class=\"well module\">
                <table style=\"width:100%\">
                <td>
                <select name=\"layout_module[";
                // line 449
                echo ($context["module_row"] ?? null);
                echo "][code]\" class=\"form-control\">
                    ";
                // line 450
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["extensions"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["extension"]) {
                    // line 451
                    echo "                    ";
                    if ( !twig_get_attribute($this->env, $this->source, $context["extension"], "module", [], "any", false, false, false, 451)) {
                        // line 452
                        echo "                        ";
                        if ((twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 452) == twig_get_attribute($this->env, $this->source, $context["layout_module"], "code", [], "any", false, false, false, 452))) {
                            // line 453
                            echo "                        <option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 453);
                            echo "\" selected=\"selected\">";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 453);
                            echo "</option>
                        ";
                        } else {
                            // line 455
                            echo "                        <option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 455);
                            echo "\">";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 455);
                            echo "</option>
                        ";
                        }
                        // line 457
                        echo "                    ";
                    } else {
                        // line 458
                        echo "                    <optgroup label=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 458);
                        echo "\">
                    ";
                        // line 459
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["extension"], "module", [], "any", false, false, false, 459));
                        foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                            // line 460
                            echo "                        ";
                            if ((twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 460) == twig_get_attribute($this->env, $this->source, $context["layout_module"], "code", [], "any", false, false, false, 460))) {
                                // line 461
                                echo "                        <option value=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 461);
                                echo "\" selected=\"selected\">";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "name", [], "any", false, false, false, 461);
                                echo "</option>
                        ";
                            } else {
                                // line 463
                                echo "                        <option value=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 463);
                                echo "\">";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "name", [], "any", false, false, false, 463);
                                echo "</option>
                        ";
                            }
                            // line 465
                            echo "                    ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 466
                        echo "                    </optgroup>
                    ";
                    }
                    // line 468
                    echo "                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extension'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 469
                echo "                  </select>
                  <input type=\"hidden\" name=\"layout_module[";
                // line 470
                echo ($context["module_row"] ?? null);
                echo "][position]\" value=\"bottom_half\"  />
                 </td>
                <td width=\"50\" style=\"padding-left:10px\">
               <input type=\"text\" name=\"layout_module[";
                // line 473
                echo ($context["module_row"] ?? null);
                echo "][sort_order]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["layout_module"], "sort_order", [], "any", false, false, false, 473);
                echo "\"  class=\"form-control\" />
               </td>
               <td align=\"right\" width=\"48\">
                <button type=\"button\" onclick=\"\$('#module-row";
                // line 476
                echo ($context["module_row"] ?? null);
                echo "').remove();\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_remove"] ?? null);
                echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button>
                </td>
              </table>
              </div>
              </div>
              ";
                // line 481
                $context["module_row"] = (($context["module_row"] ?? null) + 1);
                // line 482
                echo "              ";
            }
            // line 483
            echo "\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['layout_module'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 484
        echo "              </div>
              <button type=\"button\" onclick=\"addModule('bottom_half');\" class=\"btn btn-primary btn-block\">";
        // line 485
        echo ($context["button_module_add"] ?? null);
        echo "</button>
              </div>
              </div>
            </div>
            
            
            <div class=\"row\">
             <div class=\"col-sm-12\">
              <h4>Bottom</h4>
              <div class=\"well well-white\">
              <div class=\"row bottom\">
              <div class=\"col-sm-12\">
              <table class=\"heading\" style=\"width:100%\">
                <td>";
        // line 498
        echo ($context["entry_module"] ?? null);
        echo "</td>
                <td width=\"98\">Sort order</td>
              </table>
              </div>
              ";
        // line 502
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["layout_modules"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["layout_module"]) {
            // line 503
            echo "              ";
            if ((twig_get_attribute($this->env, $this->source, $context["layout_module"], "position", [], "any", false, false, false, 503) == "bottom")) {
                // line 504
                echo "              <div id=\"module-row";
                echo ($context["module_row"] ?? null);
                echo "\" class=\"col-sm-12\">
              <div class=\"well module\">
                <table style=\"width:100%\">
                <td>
                <select name=\"layout_module[";
                // line 508
                echo ($context["module_row"] ?? null);
                echo "][code]\" class=\"form-control\">
                    ";
                // line 509
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["extensions"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["extension"]) {
                    // line 510
                    echo "                    ";
                    if ( !twig_get_attribute($this->env, $this->source, $context["extension"], "module", [], "any", false, false, false, 510)) {
                        // line 511
                        echo "                        ";
                        if ((twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 511) == twig_get_attribute($this->env, $this->source, $context["layout_module"], "code", [], "any", false, false, false, 511))) {
                            // line 512
                            echo "                        <option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 512);
                            echo "\" selected=\"selected\">";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 512);
                            echo "</option>
                        ";
                        } else {
                            // line 514
                            echo "                        <option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 514);
                            echo "\">";
                            echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 514);
                            echo "</option>
                        ";
                        }
                        // line 516
                        echo "                    ";
                    } else {
                        // line 517
                        echo "                    <optgroup label=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 517);
                        echo "\">
                    ";
                        // line 518
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["extension"], "module", [], "any", false, false, false, 518));
                        foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                            // line 519
                            echo "                        ";
                            if ((twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 519) == twig_get_attribute($this->env, $this->source, $context["layout_module"], "code", [], "any", false, false, false, 519))) {
                                // line 520
                                echo "                        <option value=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 520);
                                echo "\" selected=\"selected\">";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "name", [], "any", false, false, false, 520);
                                echo "</option>
                        ";
                            } else {
                                // line 522
                                echo "                        <option value=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 522);
                                echo "\">";
                                echo twig_get_attribute($this->env, $this->source, $context["module"], "name", [], "any", false, false, false, 522);
                                echo "</option>
                        ";
                            }
                            // line 524
                            echo "                    ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 525
                        echo "                    </optgroup>
                    ";
                    }
                    // line 527
                    echo "                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extension'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 528
                echo "                  </select>
                  <input type=\"hidden\" name=\"layout_module[";
                // line 529
                echo ($context["module_row"] ?? null);
                echo "][position]\" value=\"bottom\"  />
                 </td>
                <td width=\"50\" style=\"padding-left:10px\">
               <input type=\"text\" name=\"layout_module[";
                // line 532
                echo ($context["module_row"] ?? null);
                echo "][sort_order]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["layout_module"], "sort_order", [], "any", false, false, false, 532);
                echo "\"  class=\"form-control\" />
               </td>
               <td align=\"right\" width=\"48\">
                <button type=\"button\" onclick=\"\$('#module-row";
                // line 535
                echo ($context["module_row"] ?? null);
                echo "').remove();\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_remove"] ?? null);
                echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button>
                </td>
              </table>
              </div>
              </div>
              ";
                // line 540
                $context["module_row"] = (($context["module_row"] ?? null) + 1);
                // line 541
                echo "              ";
            }
            // line 542
            echo "\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['layout_module'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 543
        echo "              </div>
              <button type=\"button\" onclick=\"addModule('bottom');\" class=\"btn btn-primary btn-block\">";
        // line 544
        echo ($context["button_module_add"] ?? null);
        echo "</button>
              </div>
              </div>
            </div>
            
          </div>
        </form>
      </div>
    </div>
  </div>

<script type=\"text/javascript\"><!--
var route_row = ";
        // line 556
        echo ($context["route_row"] ?? null);
        echo ";

function addRoute() {
\thtml  = '<tr id=\"route-row' + route_row + '\">';
\thtml += '  <td class=\"text-left\"><select name=\"layout_route[' + route_row + '][store_id]\" class=\"form-control\">';
\thtml += '  <option value=\"0\">";
        // line 561
        echo ($context["text_default"] ?? null);
        echo "</option>';
\t";
        // line 562
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 563
            echo "\thtml += '<option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 563);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 563), "js");
            echo "</option>';
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 565
        echo "\thtml += '  </select></td>';
\thtml += '  <td class=\"text-left\"><input type=\"text\" name=\"layout_route[' + route_row + '][route]\" value=\"\" placeholder=\"";
        // line 566
        echo ($context["entry_route"] ?? null);
        echo "\" class=\"form-control\" /></td>';
\thtml += '  <td class=\"text-left\"><button type=\"button\" onclick=\"\$(\\'#route-row' + route_row + '\\').remove();\" data-toggle=\"tooltip\" title=\"";
        // line 567
        echo ($context["button_remove"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>';
\thtml += '</tr>';
\t\$('#route tbody').append(html);
\troute_row++;\t
}

var module_row = ";
        // line 573
        echo ($context["module_row"] ?? null);
        echo ";
function addModule(position) {
\tif (position == 'bottom_half') {
\thtml  = '<div id=\"module-row' + module_row + '\" class=\"col-sm-6\">';
\t} else {
\thtml  = '<div id=\"module-row' + module_row + '\" class=\"col-sm-12\">';\t
\t}
\thtml += '<div class=\"well module\">';
\thtml += '<table style=\"width:100%\">';
\thtml += '  <td><select name=\"layout_module[' + module_row + '][code]\" class=\"form-control\">';
\t";
        // line 583
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["extensions"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["extension"]) {
            echo "    
\t";
            // line 584
            if ( !twig_get_attribute($this->env, $this->source, $context["extension"], "module", [], "any", false, false, false, 584)) {
                // line 585
                echo "\thtml += '    <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["extension"], "code", [], "any", false, false, false, 585);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 585), "js");
                echo "</option>';
\t";
            } else {
                // line 587
                echo "\thtml += '    <optgroup label=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 587), "js");
                echo "\">';
\t";
                // line 588
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["extension"], "module", [], "any", false, false, false, 588));
                foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                    // line 589
                    echo "\thtml += '      <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["module"], "code", [], "any", false, false, false, 589);
                    echo "\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["module"], "name", [], "any", false, false, false, 589), "js");
                    echo "</option>';
\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 591
                echo "\thtml += '    </optgroup>';
\t";
            }
            // line 593
            echo "\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extension'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 594
        echo "    html += '</select><input type=\"hidden\" name=\"layout_module[' + module_row + '][position]\" value=\"' + position + '\" /></td>';
\thtml += '<td width=\"50\" style=\"padding-left:10px\">';
\thtml += '<input type=\"text\" name=\"layout_module[' + module_row + '][sort_order]\" value=\"\"  class=\"form-control\" />';
\thtml += '</td>';
\thtml += '<td align=\"right\" width=\"48\">';
\thtml += '<button type=\"button\" onclick=\"\$(\\'#module-row' + module_row + '\\').remove();\" data-toggle=\"tooltip\" title=\"";
        // line 599
        echo ($context["button_remove"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button>';
\thtml += '</td>';
\thtml += '</table>';
\thtml += '</div>';
\thtml += '</div>';
\t\$('.row.' + position).append(html);
\tmodule_row++;
}

//--></script>
<style>
.well h4 {
\tfont-size:16px;
}
.well-white {
\tbackground:#ffffff;
\tpadding:15px;
}
.well-white .well.module {
\tmargin-bottom:10px;
\tpadding:8px;
}
.well-white .heading {
\tfont-size:11px;
\tborder-bottom:1px solid #eeeeee;
\tmargin-bottom:10px;
\tfont-weight:bold;
}
.well-white .heading td {
\tpadding-bottom:3px;
}
</style>
</div>
";
        // line 632
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "extension/basel/basel_layout_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1648 => 632,  1612 => 599,  1605 => 594,  1599 => 593,  1595 => 591,  1584 => 589,  1580 => 588,  1575 => 587,  1567 => 585,  1565 => 584,  1559 => 583,  1546 => 573,  1537 => 567,  1533 => 566,  1530 => 565,  1519 => 563,  1515 => 562,  1511 => 561,  1503 => 556,  1488 => 544,  1485 => 543,  1479 => 542,  1476 => 541,  1474 => 540,  1464 => 535,  1456 => 532,  1450 => 529,  1447 => 528,  1441 => 527,  1437 => 525,  1431 => 524,  1423 => 522,  1415 => 520,  1412 => 519,  1408 => 518,  1403 => 517,  1400 => 516,  1392 => 514,  1384 => 512,  1381 => 511,  1378 => 510,  1374 => 509,  1370 => 508,  1362 => 504,  1359 => 503,  1355 => 502,  1348 => 498,  1332 => 485,  1329 => 484,  1323 => 483,  1320 => 482,  1318 => 481,  1308 => 476,  1300 => 473,  1294 => 470,  1291 => 469,  1285 => 468,  1281 => 466,  1275 => 465,  1267 => 463,  1259 => 461,  1256 => 460,  1252 => 459,  1247 => 458,  1244 => 457,  1236 => 455,  1228 => 453,  1225 => 452,  1222 => 451,  1218 => 450,  1214 => 449,  1206 => 445,  1203 => 444,  1199 => 443,  1192 => 439,  1183 => 433,  1168 => 421,  1165 => 420,  1159 => 419,  1156 => 418,  1154 => 417,  1144 => 412,  1136 => 409,  1130 => 406,  1127 => 405,  1121 => 404,  1117 => 402,  1111 => 401,  1103 => 399,  1095 => 397,  1092 => 396,  1088 => 395,  1083 => 394,  1080 => 393,  1072 => 391,  1064 => 389,  1061 => 388,  1058 => 387,  1054 => 386,  1050 => 385,  1042 => 381,  1039 => 380,  1035 => 379,  1028 => 375,  1014 => 364,  1011 => 363,  1005 => 362,  1002 => 361,  1000 => 360,  990 => 355,  982 => 352,  976 => 349,  973 => 348,  967 => 347,  963 => 345,  957 => 344,  949 => 342,  941 => 340,  938 => 339,  934 => 338,  929 => 337,  926 => 336,  918 => 334,  910 => 332,  907 => 331,  904 => 330,  900 => 329,  896 => 328,  888 => 324,  885 => 323,  881 => 322,  874 => 318,  861 => 308,  858 => 307,  852 => 306,  849 => 305,  847 => 304,  837 => 299,  829 => 296,  823 => 293,  820 => 292,  814 => 291,  810 => 289,  804 => 288,  796 => 286,  788 => 284,  785 => 283,  781 => 282,  776 => 281,  773 => 280,  765 => 278,  757 => 276,  754 => 275,  751 => 274,  747 => 273,  743 => 272,  735 => 268,  732 => 267,  728 => 266,  721 => 262,  708 => 252,  705 => 251,  699 => 250,  696 => 249,  694 => 248,  684 => 243,  676 => 240,  670 => 237,  667 => 236,  661 => 235,  657 => 233,  651 => 232,  643 => 230,  635 => 228,  632 => 227,  628 => 226,  623 => 225,  620 => 224,  612 => 222,  604 => 220,  601 => 219,  598 => 218,  594 => 217,  590 => 216,  582 => 212,  579 => 211,  575 => 210,  568 => 206,  553 => 194,  550 => 193,  544 => 192,  541 => 191,  539 => 190,  529 => 185,  521 => 182,  515 => 179,  512 => 178,  506 => 177,  502 => 175,  496 => 174,  488 => 172,  480 => 170,  477 => 169,  473 => 168,  468 => 167,  465 => 166,  457 => 164,  449 => 162,  446 => 161,  443 => 160,  439 => 159,  435 => 158,  427 => 154,  424 => 153,  420 => 152,  413 => 148,  395 => 133,  392 => 132,  386 => 131,  383 => 130,  381 => 129,  371 => 124,  363 => 121,  357 => 118,  354 => 117,  348 => 116,  344 => 114,  338 => 113,  330 => 111,  322 => 109,  319 => 108,  315 => 107,  310 => 106,  307 => 105,  299 => 103,  291 => 101,  288 => 100,  285 => 99,  281 => 98,  277 => 97,  269 => 93,  266 => 92,  262 => 91,  255 => 87,  243 => 77,  241 => 76,  233 => 71,  227 => 67,  221 => 66,  219 => 65,  212 => 63,  204 => 62,  201 => 61,  195 => 60,  187 => 58,  179 => 56,  176 => 55,  172 => 54,  168 => 53,  164 => 52,  159 => 51,  155 => 49,  152 => 48,  147 => 47,  145 => 46,  137 => 41,  133 => 40,  126 => 35,  120 => 33,  118 => 32,  112 => 31,  107 => 29,  102 => 27,  96 => 24,  92 => 22,  84 => 18,  82 => 17,  76 => 13,  65 => 11,  61 => 10,  56 => 8,  50 => 7,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/basel/basel_layout_form.twig", "");
    }
}
