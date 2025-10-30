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

/* mpgdpr/mpgdpr.twig */
class __TwigTemplate_f1cb151dd1212cc5aadee439d3d176f0c1e472852b5167ea9f1d08c0d1c43b15 extends \Twig\Template
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
<div id=\"content\" class=\"mp-content\">
  <div class=\"page-header\">
    <div class=\"container-fluid\">
      <div class=\"pull-right\">
        <button type=\"submit\" form=\"form-gdpr\" data-toggle=\"tooltip\" title=\"";
        // line 6
        echo ($context["button_save"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-refresh\"></i> ";
        echo ($context["button_save"] ?? null);
        echo "</button>
      </div>
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
        if (($context["success"] ?? null)) {
            // line 18
            echo "    <div class=\"alert alert-success\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 22
        echo "    ";
        if (($context["error_warning"] ?? null)) {
            // line 23
            echo "    <div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 27
        echo "    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-pencil\"></i> ";
        // line 29
        echo ($context["text_edit"] ?? null);
        echo "</h3>

        <div class=\"pull-right\">
          <span>";
        // line 32
        echo ($context["text_store"] ?? null);
        echo "</span>
          <button type=\"button\" data-toggle=\"dropdown\" class=\"btn btn-default btn-xs dropdown-toggle\"><span>";
        // line 33
        echo ($context["store_name"] ?? null);
        echo " &nbsp; &nbsp; </span> <i class=\"fa fa-angle-down\"></i></button>
          <ul class=\"dropdown-menu pull-right\">
            ";
        // line 35
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 36
            echo "            <li><a href=\"index.php?route=mpgdpr/mpgdpr&";
            echo ($context["var_token"] ?? null);
            echo "=";
            echo ($context["token"] ?? null);
            echo "&store_id=";
            echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 36);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 36);
            echo "</a></li>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 38
        echo "          </ul>
        </div><div class=\"cleafix\"></div>
      </div>
      <div class=\"panel-body\">
        <form action=\"";
        // line 42
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-gdpr\" class=\"form-horizontal\">
          <ul class=\"nav nav-tabs\">
            <li class=\"active\"><a href=\"#tab-general\" data-toggle=\"tab\"><i class=\"fa fa-cogs\"></i> <span>";
        // line 44
        echo ($context["tab_general"] ?? null);
        echo "</span></a></li>
            <li><a href=\"#tab-other\" data-toggle=\"tab\"><i class=\"fa fa-server\"></i> <span>";
        // line 45
        echo ($context["tab_other"] ?? null);
        echo "</span></a></li>
            <li><a href=\"#tab-cookieconsent\" data-toggle=\"tab\"><i class=\"fa fa-save\"></i> <span>";
        // line 46
        echo ($context["tab_cookieconsent"] ?? null);
        echo "</span></a></li>
            <li><a href=\"#tab-support\" data-toggle=\"tab\"><i class=\"fa fa-thumbs-up\" aria-hidden=\"true\"></i> ";
        // line 47
        echo ($context["tab_modulepoints"] ?? null);
        echo "</a></li>
          </ul>
          <div class=\"tab-content\">
            <div class=\"tab-pane active\" id=\"tab-general\"> 
              <div class=\"row\">
                <div class=\"col-sm-3\">
                  <ul class=\"nav nav-pills nav-stacked ostab\">
                    <li class=\"active\"><a href=\"#tab-enable\" data-toggle=\"tab\"><i class=\"fa fa-cog\"></i> <span>";
        // line 54
        echo ($context["tab_settings"] ?? null);
        echo "</span></a></li>
                    <li><a href=\"#tab-captcha\" data-toggle=\"tab\"><i class=\"fa fa-shield\"></i> <span>";
        // line 55
        echo ($context["legend_captcha"] ?? null);
        echo "</span></a></li>
                    <li><a href=\"#tab-requesttime\" data-toggle=\"tab\"><i class=\"fa fa-desktop\"></i> <span>";
        // line 56
        echo ($context["legend_requesttimeout"] ?? null);
        echo "</span></a></li>
                    <li><a href=\"#tab-upload\" data-toggle=\"tab\"><i class=\"fa fa-file-o\"></i> <span>";
        // line 57
        echo ($context["legend_upload"] ?? null);
        echo "</span></a></li>
                  </ul>
                </div>
                <div class=\"col-sm-8\">
                  <div class=\"tab-content\">
                    <div class=\"tab-pane active\" id=\"tab-enable\">
                      <div class=\"form-group mp-buttons\">
                        <label class=\"col-sm-2 control-label\" for=\"input-status\">";
        // line 64
        echo ($context["entry_status"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <div class=\"btn-group btn-group-justified\" data-toggle=\"buttons\">
                            <label class=\"btn btn-primary ";
        // line 67
        if (($context["mpgdpr_status"] ?? null)) {
            echo "active";
        }
        echo "\">
                              <input type=\"radio\" name=\"mpgdpr_status\" value=\"1\" ";
        // line 68
        if (($context["mpgdpr_status"] ?? null)) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 69
        echo ($context["text_enabled"] ?? null);
        echo "
                           </label>
                            <label class=\"btn btn-primary ";
        // line 71
        if ( !($context["mpgdpr_status"] ?? null)) {
            echo "active";
        }
        echo "\">
                              <input type=\"radio\" name=\"mpgdpr_status\" value=\"0\" ";
        // line 72
        if ( !($context["mpgdpr_status"] ?? null)) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 73
        echo ($context["text_disabled"] ?? null);
        echo "
                            </label>
                          </div>
                          <span class=\"help\">";
        // line 76
        echo ($context["help_status"] ?? null);
        echo "</span> 
                        </div>
                      </div>
                      <div class=\"form-group mp-buttons\">
                        <label class=\"col-sm-2 control-label\" for=\"input-hasright_todelete\">";
        // line 80
        echo ($context["entry_hasright_todelete"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <div class=\"btn-group btn-group-justified\" data-toggle=\"buttons\">
                            <label class=\"btn btn-primary ";
        // line 83
        if (($context["mpgdpr_hasright_todelete"] ?? null)) {
            echo "active";
        }
        echo "\">
                              <input type=\"radio\" name=\"mpgdpr_hasright_todelete\" value=\"1\" ";
        // line 84
        if (($context["mpgdpr_hasright_todelete"] ?? null)) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 85
        echo ($context["text_yes"] ?? null);
        echo "
                           </label>
                            <label class=\"btn btn-primary ";
        // line 87
        if ( !($context["mpgdpr_hasright_todelete"] ?? null)) {
            echo "active";
        }
        echo "\">
                              <input type=\"radio\" name=\"mpgdpr_hasright_todelete\" value=\"0\" ";
        // line 88
        if ( !($context["mpgdpr_hasright_todelete"] ?? null)) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 89
        echo ($context["text_no"] ?? null);
        echo "
                            </label>
                          </div>
                          <span class=\"help\">";
        // line 92
        echo ($context["help_hasright_todelete"] ?? null);
        echo "</span>
                        </div>
                      </div>
                      <div class=\"form-group\">
                        <label class=\"col-sm-2 control-label\" for=\"input-maxrequests\">";
        // line 96
        echo ($context["entry_maxrequests"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <input type=\"text\" name=\"mpgdpr_maxrequests\" value=\"";
        // line 98
        echo ($context["mpgdpr_maxrequests"] ?? null);
        echo "\" class=\"form-control\" />

                          <span class=\"help\">";
        // line 100
        echo ($context["help_maxrequests"] ?? null);
        echo "</span>
                        </div>
                      </div>
                      ";
        // line 112
        echo "                      <div class=\"form-group mp-buttons\">
                        <label class=\"col-sm-2 control-label\" for=\"input-login_gdprforms\">";
        // line 113
        echo ($context["entry_login_gdprforms"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <div class=\"btn-group btn-group-justified\" data-toggle=\"buttons\">
                            <label class=\"btn btn-primary ";
        // line 116
        if (($context["mpgdpr_login_gdprforms"] ?? null)) {
            echo "active";
        }
        echo "\">
                              <input type=\"radio\" name=\"mpgdpr_login_gdprforms\" value=\"1\" ";
        // line 117
        if (($context["mpgdpr_login_gdprforms"] ?? null)) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 118
        echo ($context["text_yes"] ?? null);
        echo "
                           </label>
                            <label class=\"btn btn-primary ";
        // line 120
        if ( !($context["mpgdpr_login_gdprforms"] ?? null)) {
            echo "active";
        }
        echo "\">
                              <input type=\"radio\" name=\"mpgdpr_login_gdprforms\" value=\"0\" ";
        // line 121
        if ( !($context["mpgdpr_login_gdprforms"] ?? null)) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 122
        echo ($context["text_no"] ?? null);
        echo "
                            </label>
                          </div>
                          <span class=\"help\">";
        // line 125
        echo ($context["help_login_gdprforms"] ?? null);
        echo "</span>
                        </div>
                      </div>
                      <h4 class=\"subtitle\"><i class=\"fa fa-exclamation-triangle\"></i> <small>";
        // line 128
        echo ($context["text_acceptpolicy_gdpr"] ?? null);
        echo "</small></h4>
                      <div class=\"form-group mp-buttons\">
                        <label class=\"col-sm-2 control-label\" for=\"input-acceptpolicy_customer\">";
        // line 130
        echo ($context["entry_acceptpolicy_customer"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <div class=\"btn-group btn-group-justified\" data-toggle=\"buttons\">
                            <label class=\"btn btn-primary ";
        // line 133
        if (($context["mpgdpr_acceptpolicy_customer"] ?? null)) {
            echo "active";
        }
        echo "\">
                              <input type=\"radio\" name=\"mpgdpr_acceptpolicy_customer\" value=\"1\" ";
        // line 134
        if (($context["mpgdpr_acceptpolicy_customer"] ?? null)) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 135
        echo ($context["text_yes"] ?? null);
        echo "
                           </label>
                            <label class=\"btn btn-primary ";
        // line 137
        if ( !($context["mpgdpr_acceptpolicy_customer"] ?? null)) {
            echo "active";
        }
        echo "\">
                              <input type=\"radio\" name=\"mpgdpr_acceptpolicy_customer\" value=\"0\" ";
        // line 138
        if ( !($context["mpgdpr_acceptpolicy_customer"] ?? null)) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 139
        echo ($context["text_no"] ?? null);
        echo "
                            </label>
                          </div>
                          <span class=\"help\">";
        // line 142
        echo ($context["help_acceptpolicy_customer"] ?? null);
        echo "</span>
                        </div>
                      </div>
                      <div class=\"form-group required\">
                        <label class=\"col-sm-2 control-label\" for=\"input-policy_customer\">";
        // line 146
        echo ($context["entry_policy_customer"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <select name=\"mpgdpr_policy_customer\" id=\"input-policy_customer\" class=\"form-control\">
                            <option value=\"0\">";
        // line 149
        echo ($context["text_default_page"] ?? null);
        echo "</option>
                            ";
        // line 150
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["information_pages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["information_page"]) {
            // line 151
            echo "                            <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["information_page"], "information_id", [], "any", false, false, false, 151);
            echo "\" ";
            if ((($context["mpgdpr_policy_customer"] ?? null) == twig_get_attribute($this->env, $this->source, $context["information_page"], "information_id", [], "any", false, false, false, 151))) {
                echo "selected=\"selected\"";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["information_page"], "title", [], "any", false, false, false, 151);
            echo "</option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['information_page'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 153
        echo "                          </select>
                          <span class=\"help\">";
        // line 154
        echo ($context["help_policy_customer"] ?? null);
        echo "</span>
                        </div>
                      </div>
                      <h4 class=\"subtitle\"><i class=\"fa fa-exclamation-triangle\"></i>  <small>";
        // line 157
        echo ($context["text_acceptpolicy_gdpr"] ?? null);
        echo "</small></h4>
                      <div class=\"form-group mp-buttons\">
                        <label class=\"col-sm-2 control-label\" for=\"input-acceptpolicy_contactus\">";
        // line 159
        echo ($context["entry_acceptpolicy_contactus"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <div class=\"btn-group btn-group-justified\" data-toggle=\"buttons\">
                            <label class=\"btn btn-primary ";
        // line 162
        if (($context["mpgdpr_acceptpolicy_contactus"] ?? null)) {
            echo "active";
        }
        echo "\">
                              <input type=\"radio\" name=\"mpgdpr_acceptpolicy_contactus\" value=\"1\" ";
        // line 163
        if (($context["mpgdpr_acceptpolicy_contactus"] ?? null)) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 164
        echo ($context["text_yes"] ?? null);
        echo "
                           </label>
                            <label class=\"btn btn-primary ";
        // line 166
        if ( !($context["mpgdpr_acceptpolicy_contactus"] ?? null)) {
            echo "active";
        }
        echo "\">
                              <input type=\"radio\" name=\"mpgdpr_acceptpolicy_contactus\" value=\"0\" ";
        // line 167
        if ( !($context["mpgdpr_acceptpolicy_contactus"] ?? null)) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 168
        echo ($context["text_no"] ?? null);
        echo "
                            </label>
                          </div>
                          <span class=\"help\">";
        // line 171
        echo ($context["help_acceptpolicy_contactus"] ?? null);
        echo "</span>
                        </div>
                      </div>
                      <div class=\"form-group required\">
                        <label class=\"col-sm-2 control-label\" for=\"input-policy_contactus\">";
        // line 175
        echo ($context["entry_policy_contactus"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <select name=\"mpgdpr_policy_contactus\" id=\"input-policy_contactus\" class=\"form-control\">
                            <option value=\"0\">";
        // line 178
        echo ($context["text_none"] ?? null);
        echo "</option>
                            ";
        // line 179
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["information_pages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["information_page"]) {
            // line 180
            echo "                            <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["information_page"], "information_id", [], "any", false, false, false, 180);
            echo "\" ";
            if ((($context["mpgdpr_policy_contactus"] ?? null) == twig_get_attribute($this->env, $this->source, $context["information_page"], "information_id", [], "any", false, false, false, 180))) {
                echo "selected=\"selected\"";
            }
            echo " >";
            echo twig_get_attribute($this->env, $this->source, $context["information_page"], "title", [], "any", false, false, false, 180);
            echo "</option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['information_page'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 182
        echo "                          </select>
                          <span class=\"help\">";
        // line 183
        echo ($context["help_policy_contactus"] ?? null);
        echo "</span>
                        </div>
                      </div>
                      <h4 class=\"subtitle\"><i class=\"fa fa-exclamation-triangle\"></i>  <small>";
        // line 186
        echo ($context["text_acceptpolicy_gdpr"] ?? null);
        echo "</small></h4>
                      <div class=\"form-group mp-buttons\">
                        <label class=\"col-sm-2 control-label\" for=\"input-acceptpolicy_checkout\">";
        // line 188
        echo ($context["entry_acceptpolicy_checkout"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <div class=\"btn-group btn-group-justified\" data-toggle=\"buttons\">
                            <label class=\"btn btn-primary ";
        // line 191
        if (($context["mpgdpr_acceptpolicy_checkout"] ?? null)) {
            echo "active";
        }
        echo "\">
                              <input type=\"radio\" name=\"mpgdpr_acceptpolicy_checkout\" value=\"1\" ";
        // line 192
        if (($context["mpgdpr_acceptpolicy_checkout"] ?? null)) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 193
        echo ($context["text_yes"] ?? null);
        echo "
                           </label>
                            <label class=\"btn btn-primary ";
        // line 195
        if ( !($context["mpgdpr_acceptpolicy_checkout"] ?? null)) {
            echo "active";
        }
        echo "\">
                              <input type=\"radio\" name=\"mpgdpr_acceptpolicy_checkout\" value=\"0\" ";
        // line 196
        if ( !($context["mpgdpr_acceptpolicy_checkout"] ?? null)) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 197
        echo ($context["text_no"] ?? null);
        echo "
                            </label>
                          </div>
                          <span class=\"help\">";
        // line 200
        echo ($context["help_acceptpolicy_checkout"] ?? null);
        echo "</span>
                        </div>
                      </div>
                      <div class=\"form-group required\">
                        <label class=\"col-sm-2 control-label\" for=\"input-policy_checkout\">";
        // line 204
        echo ($context["entry_policy_checkout"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <select name=\"mpgdpr_policy_checkout\" id=\"input-policy_checkout\" class=\"form-control\">
                            <option value=\"0\">";
        // line 207
        echo ($context["text_default_page"] ?? null);
        echo "</option>
                            ";
        // line 208
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["information_pages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["information_page"]) {
            // line 209
            echo "                            <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["information_page"], "information_id", [], "any", false, false, false, 209);
            echo "\" ";
            if ((($context["mpgdpr_policy_checkout"] ?? null) == twig_get_attribute($this->env, $this->source, $context["information_page"], "information_id", [], "any", false, false, false, 209))) {
                echo "selected=\"selected\"";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["information_page"], "title", [], "any", false, false, false, 209);
            echo "</option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['information_page'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 211
        echo "                          </select>
                          <span class=\"help\">";
        // line 212
        echo ($context["help_policy_checkout"] ?? null);
        echo "</span>
                        </div>
                      </div>
                    </div>
                    <div class=\"tab-pane\" id=\"tab-captcha\">  
                      <div class=\"form-group mp-buttons\">
                        <label class=\"col-sm-2 control-label\" for=\"input-captcha_gdprforms\">";
        // line 218
        echo ($context["entry_captcha_gdprforms"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <div class=\"btn-group btn-group-justified\" data-toggle=\"buttons\">
                            <label class=\"btn btn-primary ";
        // line 221
        if (($context["mpgdpr_captcha_gdprforms"] ?? null)) {
            echo "active";
        }
        echo "\">
                              <input type=\"radio\" name=\"mpgdpr_captcha_gdprforms\" value=\"1\" ";
        // line 222
        if (($context["mpgdpr_captcha_gdprforms"] ?? null)) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 223
        echo ($context["text_yes"] ?? null);
        echo "
                           </label>
                            <label class=\"btn btn-primary ";
        // line 225
        if ( !($context["mpgdpr_captcha_gdprforms"] ?? null)) {
            echo "active";
        }
        echo "\">
                              <input type=\"radio\" name=\"mpgdpr_captcha_gdprforms\" value=\"0\" ";
        // line 226
        if ( !($context["mpgdpr_captcha_gdprforms"] ?? null)) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 227
        echo ($context["text_no"] ?? null);
        echo "
                            </label>
                          </div>
                          <span class=\"help\">";
        // line 230
        echo ($context["help_captcha_gdprforms"] ?? null);
        echo "</span>
                        </div>
                      </div>
                      <div class=\"form-group\">
                        <label class=\"col-sm-2 control-label\">";
        // line 234
        echo ($context["entry_captcha"] ?? null);
        echo "</label>
                        <div class=\"col-sm-5\">
                          <select name=\"mpgdpr_captcha\" id=\"input-captcha\" class=\"form-control\">
                            <option value=\"\">";
        // line 237
        echo ($context["text_none"] ?? null);
        echo "</option>
                            ";
        // line 238
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["captchas"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["captcha"]) {
            // line 239
            echo "                            ";
            if ((twig_get_attribute($this->env, $this->source, $context["captcha"], "value", [], "any", false, false, false, 239) == ($context["mpgdpr_captcha"] ?? null))) {
                // line 240
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["captcha"], "value", [], "any", false, false, false, 240);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["captcha"], "text", [], "any", false, false, false, 240);
                echo "</option>
                            ";
            } else {
                // line 242
                echo "                            <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["captcha"], "value", [], "any", false, false, false, 242);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["captcha"], "text", [], "any", false, false, false, 242);
                echo "</option>
                            ";
            }
            // line 244
            echo "                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['captcha'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 245
        echo "                          </select>
                          <span class=\"help\">";
        // line 246
        echo ($context["help_captcha"] ?? null);
        echo "</span>
                        </div>
                      </div>
                    </div> 
                    <div class=\"tab-pane\" id=\"tab-requesttime\"> 
                      <div class=\"form-group required\">
                        <label class=\"col-sm-2 control-label\" for=\"input-requestget_personaldata\">";
        // line 252
        echo ($context["entry_requestget_personaldata"] ?? null);
        echo "</label>
                        <div class=\"col-sm-5\">
                          <input type=\"number\" name=\"mpgdpr_timeout[requestget_personaldata]\" value=\"";
        // line 254
        echo ((twig_get_attribute($this->env, $this->source, ($context["mpgdpr_timeout"] ?? null), "requestget_personaldata", [], "any", false, false, false, 254)) ? (twig_get_attribute($this->env, $this->source, ($context["mpgdpr_timeout"] ?? null), "requestget_personaldata", [], "any", false, false, false, 254)) : (2));
        echo "\" placeholder=\"";
        echo ($context["entry_requestget_personaldata"] ?? null);
        echo "\" id=\"input-requestget_personaldata\" class=\"form-control\" />
                          <span class=\"help\">";
        // line 255
        echo ($context["help_requestget_personaldata"] ?? null);
        echo "</span>
                        </div>
                      </div>
                      <div class=\"form-group required\">
                        <label class=\"col-sm-2 control-label\" for=\"input-requestdelete_personaldata\">";
        // line 259
        echo ($context["entry_requestdelete_personaldata"] ?? null);
        echo "</label>
                        <div class=\"col-sm-5\">
                          <input type=\"number\" name=\"mpgdpr_timeout[requestdelete_personaldata]\" value=\"";
        // line 261
        echo ((twig_get_attribute($this->env, $this->source, ($context["mpgdpr_timeout"] ?? null), "requestdelete_personaldata", [], "any", false, false, false, 261)) ? (twig_get_attribute($this->env, $this->source, ($context["mpgdpr_timeout"] ?? null), "requestdelete_personaldata", [], "any", false, false, false, 261)) : (2));
        echo "\" placeholder=\"";
        echo ($context["entry_requestdelete_personaldata"] ?? null);
        echo "\" id=\"input-requestdelete_personaldata\" class=\"form-control\" />
                          <span class=\"help\">";
        // line 262
        echo ($context["help_requestdelete_personaldata"] ?? null);
        echo "</span>
                        </div>
                      </div>
                    </div>
                    <div class=\"tab-pane\" id=\"tab-upload\">
                      <div class=\"form-group\">
                        <label class=\"col-sm-2 control-label\" for=\"input-file-ext-allowed\">";
        // line 268
        echo ($context["entry_file_ext_allowed"] ?? null);
        echo "</label>
                        <div class=\"col-sm-5\">
                          <textarea name=\"mpgdpr_file_ext_allowed\" rows=\"5\" placeholder=\"";
        // line 270
        echo ($context["entry_file_ext_allowed"] ?? null);
        echo "\" id=\"input-file-ext-allowed\" class=\"form-control\">";
        echo ($context["mpgdpr_file_ext_allowed"] ?? null);
        echo "</textarea>
                          <span class=\"help\">";
        // line 271
        echo ($context["help_file_ext_allowed"] ?? null);
        echo "</span>
                        </div>
                      </div>
                      <div class=\"form-group\">
                        <label class=\"col-sm-2 control-label\" for=\"input-file-mime-allowed\">";
        // line 275
        echo ($context["entry_file_mime_allowed"] ?? null);
        echo "</label>
                        <div class=\"col-sm-5\">
                          <textarea name=\"mpgdpr_file_mime_allowed\" rows=\"5\" placeholder=\"";
        // line 277
        echo ($context["entry_file_mime_allowed"] ?? null);
        echo "\" id=\"input-file-mime-allowed\" class=\"form-control\">";
        echo ($context["mpgdpr_file_mime_allowed"] ?? null);
        echo "</textarea>
                          <span class=\"help\">";
        // line 278
        echo ($context["help_file_mime_allowed"] ?? null);
        echo "</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-other\">
              <h4 class=\"subtitle\"><i class=\"fa fa-exclamation-triangle\"></i>  ";
        // line 287
        echo ($context["text_access_personaldata"] ?? null);
        echo " <br/><small>";
        echo ($context["help_access_personaldata"] ?? null);
        echo "</small></h4>
                
              <ul class=\"nav nav-tabs\" id=\"languageother\">
                ";
        // line 290
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 291
            echo "                <li><a href=\"#languageother";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 291);
            echo "\" data-toggle=\"tab\"><img src=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "flag", [], "any", false, false, false, 291);
            echo "\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 291);
            echo "\" /> ";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 291);
            echo "</a></li>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 293
        echo "              </ul>
              <div class=\"tab-content\">
                ";
        // line 295
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 296
            echo "                <div class=\"tab-pane\" id=\"languageother";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 296);
            echo "\">
                  <div class=\"form-group\">
                    <label class=\"col-sm-2 control-label\">";
            // line 298
            echo ($context["entry_locationservices"] ?? null);
            echo "</label>
                    <div class=\"col-sm-6\">
                      <textarea name=\"mpgdpr_services[";
            // line 300
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 300);
            echo "][locationservices]\" id=\"input-locationservices";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 300);
            echo "\" class=\"form-control\" cols=\"10\">";
            echo (((($__internal_compile_0 = ($context["mpgdpr_services"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 300)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_1 = ($context["mpgdpr_services"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 300)] ?? null) : null), "locationservices", [], "any", false, false, false, 300)) : (""));
            echo "</textarea>
                      <span class=\"help\">";
            // line 301
            echo ($context["help_locationservices"] ?? null);
            echo "</span>
                    </div>
                  </div>
                  <div class=\"form-group\">
                    <label class=\"col-sm-2 control-label\">";
            // line 305
            echo ($context["entry_otherservices"] ?? null);
            echo "</label>
                    <div class=\"col-sm-6\">
                      <textarea name=\"mpgdpr_services[";
            // line 307
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 307);
            echo "][otherservices]\" id=\"input-otherservices";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 307);
            echo "\" class=\"form-control\" cols=\"10\">";
            echo (((($__internal_compile_2 = ($context["mpgdpr_services"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 307)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_3 = ($context["mpgdpr_services"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 307)] ?? null) : null), "otherservices", [], "any", false, false, false, 307)) : (""));
            echo "</textarea>
                      <span class=\"help\">";
            // line 308
            echo ($context["help_otherservices"] ?? null);
            echo "</span>
                    </div>
                  </div>
                </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 313
        echo "              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-cookieconsent\">
              <div class=\"row\">
                <div class=\"col-sm-2\">
                  <ul class=\"nav nav-pills nav-stacked ostab\">
                    <li class=\"active\"><a href=\"#tab-cgeneral\" data-toggle=\"tab\"><i class=\"fa fa-cogs\"></i> <span>";
        // line 319
        echo ($context["legend_general"] ?? null);
        echo "</span></a></li>
                    <li><a href=\"#tab-cookiemanager\" data-toggle=\"tab\"><i class=\"fa fa-stack-overflow\"></i> <span>";
        // line 320
        echo ($context["legend_cookiemanager"] ?? null);
        echo "</span></a></li>
                    <li><a href=\"#tab-language\" data-toggle=\"tab\"><i class=\"fa fa-language\"></i> <span>";
        // line 321
        echo ($context["legend_language"] ?? null);
        echo "</span></a></li>
                  </ul>    
                </div>
                <div class=\"col-sm-8\">
                  <div class=\"tab-content\">
                    <div class=\"tab-pane active\" id=\"tab-cgeneral\">
                      <div class=\"form-group required mp-buttons\">
                        <label class=\"col-sm-2 control-label\" for=\"input-cbstatus\">";
        // line 328
        echo ($context["entry_cbstatus"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <div class=\"btn-group btn-group-justified\" data-toggle=\"buttons\">
                            <label class=\"btn btn-primary ";
        // line 331
        if (($context["mpgdpr_cbstatus"] ?? null)) {
            echo "active";
        }
        echo "\">
                              <input type=\"radio\" name=\"mpgdpr_cbstatus\" value=\"1\" ";
        // line 332
        if (($context["mpgdpr_cbstatus"] ?? null)) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 333
        echo ($context["text_enabled"] ?? null);
        echo "
                           </label>
                            <label class=\"btn btn-primary ";
        // line 335
        if ( !($context["mpgdpr_cbstatus"] ?? null)) {
            echo "active";
        }
        echo "\">
                              <input type=\"radio\" name=\"mpgdpr_cbstatus\" value=\"0\" ";
        // line 336
        if ( !($context["mpgdpr_cbstatus"] ?? null)) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 337
        echo ($context["text_disabled"] ?? null);
        echo "
                            </label>
                          </div>
                          <span class=\"help\">";
        // line 340
        echo ($context["help_cbstatus"] ?? null);
        echo "</span>
                        </div>
                      </div>
                      <div class=\"form-group required mp-buttons\">
                        <label class=\"col-sm-2 control-label\" for=\"input-cbpolicy\">";
        // line 344
        echo ($context["entry_cbpolicy"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <div class=\"btn-group btn-group-justified\" data-toggle=\"buttons\">
                            <label class=\"btn btn-primary ";
        // line 347
        if (($context["mpgdpr_cbpolicy"] ?? null)) {
            echo "active";
        }
        echo "\">
                              <input type=\"radio\" name=\"mpgdpr_cbpolicy\" value=\"1\" ";
        // line 348
        if (($context["mpgdpr_cbpolicy"] ?? null)) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 349
        echo ($context["text_enabled"] ?? null);
        echo "
                           </label>
                            <label class=\"btn btn-primary ";
        // line 351
        if ( !($context["mpgdpr_cbpolicy"] ?? null)) {
            echo "active";
        }
        echo "\">
                              <input type=\"radio\" name=\"mpgdpr_cbpolicy\" value=\"0\" ";
        // line 352
        if ( !($context["mpgdpr_cbpolicy"] ?? null)) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 353
        echo ($context["text_disabled"] ?? null);
        echo "
                            </label>
                          </div>
                          <span class=\"help\">";
        // line 356
        echo ($context["help_cbpolicy"] ?? null);
        echo "</span>
                        </div>
                      </div>
                      <div class=\"form-group required\">
                        <label class=\"col-sm-2 control-label\" for=\"input-cbpolicy_page\">";
        // line 360
        echo ($context["entry_cbpolicy_page"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <select name=\"mpgdpr_cbpolicy_page\" id=\"input-cbpolicy_page\" class=\"form-control\">
                            <option value=\"0\">";
        // line 363
        echo ($context["text_default_page"] ?? null);
        echo "</option>
                            ";
        // line 364
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["information_pages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["information_page"]) {
            // line 365
            echo "                            <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["information_page"], "information_id", [], "any", false, false, false, 365);
            echo "\" ";
            if ((($context["mpgdpr_cbpolicy_page"] ?? null) == twig_get_attribute($this->env, $this->source, $context["information_page"], "information_id", [], "any", false, false, false, 365))) {
                echo "selected=\"selected\"";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["information_page"], "title", [], "any", false, false, false, 365);
            echo "</option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['information_page'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 367
        echo "                          </select>
                          <span class=\"help\">";
        // line 368
        echo ($context["help_cbpolicy_page"] ?? null);
        echo "</span>
                        </div>
                      </div>
                      <div class=\"form-group required mp-buttons\">
                        <label class=\"col-sm-2 control-label\" for=\"input-cbpptrack\">";
        // line 372
        echo ($context["entry_cbpptrack"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <div class=\"btn-group btn-group-justified\" data-toggle=\"buttons\">
                            <label class=\"btn btn-primary ";
        // line 375
        if (($context["mpgdpr_cbpptrack"] ?? null)) {
            echo "active";
        }
        echo "\">
                              <input type=\"radio\" name=\"mpgdpr_cbpptrack\" value=\"1\" ";
        // line 376
        if (($context["mpgdpr_cbpptrack"] ?? null)) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 377
        echo ($context["text_enabled"] ?? null);
        echo "
                           </label>
                            <label class=\"btn btn-primary ";
        // line 379
        if ( !($context["mpgdpr_cbpptrack"] ?? null)) {
            echo "active";
        }
        echo "\">
                              <input type=\"radio\" name=\"mpgdpr_cbpptrack\" value=\"0\" ";
        // line 380
        if ( !($context["mpgdpr_cbpptrack"] ?? null)) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 381
        echo ($context["text_disabled"] ?? null);
        echo "
                            </label>
                          </div>
                          <span class=\"help\">";
        // line 384
        echo ($context["help_cbpptrack"] ?? null);
        echo "</span>
                        </div>
                      </div>
                      <div class=\"form-group required\">
                        <label class=\"col-sm-2 control-label\" for=\"input-cbinitial\">";
        // line 388
        echo ($context["entry_cbinitial"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <select name=\"mpgdpr_cbinitial\" id=\"input-cbinitial\" class=\"form-control\">
                            ";
        // line 391
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["cbinitials"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["cbinitial"]) {
            // line 392
            echo "                            <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["cbinitial"], "value", [], "any", false, false, false, 392);
            echo "\" ";
            if ((($context["mpgdpr_cbinitial"] ?? null) == twig_get_attribute($this->env, $this->source, $context["cbinitial"], "value", [], "any", false, false, false, 392))) {
                echo "selected=\"selected\"";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["cbinitial"], "text", [], "any", false, false, false, 392);
            echo "</option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cbinitial'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 394
        echo "                          </select>
                          <span class=\"help\">";
        // line 395
        echo ($context["help_cbinitial"] ?? null);
        echo "</span>
                        </div>
                      </div>
                      <div class=\"form-group required\">
                        <label class=\"col-sm-2 control-label\" for=\"input-cbaction_close\">";
        // line 399
        echo ($context["entry_cbaction_close"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <select name=\"mpgdpr_cbaction_close\" id=\"input-cbaction_close\" class=\"form-control\">
                            ";
        // line 402
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["cbactions_close"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["cbaction_close"]) {
            // line 403
            echo "                            <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["cbaction_close"], "value", [], "any", false, false, false, 403);
            echo "\" ";
            if ((($context["mpgdpr_cbaction_close"] ?? null) == twig_get_attribute($this->env, $this->source, $context["cbaction_close"], "value", [], "any", false, false, false, 403))) {
                echo "selected=\"selected\"";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["cbaction_close"], "text", [], "any", false, false, false, 403);
            echo "</option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cbaction_close'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 405
        echo "                          </select>
                          <span class=\"help\">";
        // line 406
        echo ($context["help_cbaction_close"] ?? null);
        echo "</span>
                        </div>
                      </div>
                      <div class=\"form-group required mp-buttons\">
                        <label class=\"col-sm-2 control-label\" for=\"input-cbshowagain\">";
        // line 410
        echo ($context["entry_cbshowagain"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <div class=\"btn-group btn-group-justified\" data-toggle=\"buttons\">
                            <label class=\"btn btn-primary ";
        // line 413
        if (($context["mpgdpr_cbshowagain"] ?? null)) {
            echo "active";
        }
        echo "\">
                              <input type=\"radio\" name=\"mpgdpr_cbshowagain\" value=\"1\" ";
        // line 414
        if (($context["mpgdpr_cbshowagain"] ?? null)) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 415
        echo ($context["text_enabled"] ?? null);
        echo "
                           </label>
                            <label class=\"btn btn-primary ";
        // line 417
        if ( !($context["mpgdpr_cbshowagain"] ?? null)) {
            echo "active";
        }
        echo "\">
                              <input type=\"radio\" name=\"mpgdpr_cbshowagain\" value=\"0\" ";
        // line 418
        if ( !($context["mpgdpr_cbshowagain"] ?? null)) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 419
        echo ($context["text_disabled"] ?? null);
        echo "
                            </label>
                          </div>
                          <span class=\"help\">";
        // line 422
        echo ($context["help_cbshowagain"] ?? null);
        echo "</span>
                        </div>
                      </div>
                    </div>
                    <div class=\"tab-pane\" id=\"tab-cookiemanager\"> 
                      <div class=\"form-group required\">
                        <label class=\"col-sm-2 control-label\" for=\"input-cookie_stricklyrequired\">";
        // line 428
        echo ($context["entry_cookie_stricklyrequired"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <textarea rows=\"7\" name=\"mpgdpr_cookie_stricklyrequired\" id=\"input-cookie_stricklyrequired\" class=\"form-control\">";
        // line 430
        echo ($context["mpgdpr_cookie_stricklyrequired"] ?? null);
        echo "</textarea>
                          <span class=\"help\">";
        // line 431
        echo ($context["help_cookie_stricklyrequired"] ?? null);
        echo "</span>
                        </div>
                      </div>
                      <div class=\"form-group required\">
                        <label class=\"col-sm-2 control-label\" for=\"input-cookie_analytics\">";
        // line 435
        echo ($context["entry_cookie_analytics"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <textarea rows=\"7\" name=\"mpgdpr_cookie_analytics\" id=\"input-cookie_analytics\" class=\"form-control\">";
        // line 437
        echo ($context["mpgdpr_cookie_analytics"] ?? null);
        echo "</textarea>
                          <span class=\"help\">";
        // line 438
        echo ($context["help_cookie_analytics"] ?? null);
        echo "</span>
                        </div>
                      </div>
                      <div class=\"form-group required\">
                        <label class=\"col-sm-2 control-label\" for=\"input-cookie_marketing\">";
        // line 442
        echo ($context["entry_cookie_marketing"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <textarea rows=\"7\" name=\"mpgdpr_cookie_marketing\" id=\"input-cookie_marketing\" class=\"form-control\">";
        // line 444
        echo ($context["mpgdpr_cookie_marketing"] ?? null);
        echo "</textarea>
                          <span class=\"help\">";
        // line 445
        echo ($context["help_cookie_marketing"] ?? null);
        echo "</span>
                        </div>
                      </div>
                      <div class=\"form-group required\">
                        <label class=\"col-sm-2 control-label\" for=\"input-cookie_domain\">";
        // line 449
        echo ($context["entry_cookie_domain"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <textarea rows=\"7\" name=\"mpgdpr_cookie_domain\" id=\"input-cookie_domain\" class=\"form-control\">";
        // line 451
        echo ($context["mpgdpr_cookie_domain"] ?? null);
        echo "</textarea>
                          <span class=\"help\">";
        // line 452
        echo ($context["help_cookie_domain"] ?? null);
        echo "</span>
                        </div>
                      </div>
                    </div>
                    <div class=\"tab-pane\" id=\"tab-language\">
                      <div class=\"form-group required\" style=\"padding-top: 0;\">
                        <h4 class=\"subtitle\"><i class=\"fa fa-exclamation-triangle\"></i>  ";
        // line 458
        echo ($context["entry_cookielanguage"] ?? null);
        echo " <br/> <small>";
        echo ($context["help_cookielanguage"] ?? null);
        echo "</small></h4>
                        <div class=\"col-sm-12\">
                          <ul class=\"nav nav-tabs\" id=\"cookielanguage\">
                          ";
        // line 461
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 462
            echo "                          <li><a href=\"#cookielanguage";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 462);
            echo "\" data-toggle=\"tab\"><img src=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "flag", [], "any", false, false, false, 462);
            echo "\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 462);
            echo "\" /> ";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 462);
            echo "</a></li>
                          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 464
        echo "                          </ul>
                          <div class=\"tab-content\">
                            ";
        // line 466
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 467
            echo "                            <div class=\"tab-pane\" id=\"cookielanguage";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 467);
            echo "\">
                              <div class=\"form-group required\">
                                <label class=\"col-sm-2 control-label\" for=\"input-cookietext_msg";
            // line 469
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 469);
            echo "\">";
            echo ($context["entry_cookietext_msg"] ?? null);
            echo " </label>
                                <div class=\"col-sm-5\">
                                  <textarea rows=\"4\" name=\"mpgdpr_cookielang[";
            // line 471
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 471);
            echo "][msg]\" id=\"input-cookietext_msg";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 471);
            echo "\" class=\"form-control\">";
            echo (((($__internal_compile_4 = ($context["mpgdpr_cookielang"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 471)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_5 = ($context["mpgdpr_cookielang"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 471)] ?? null) : null), "msg", [], "any", false, false, false, 471)) : (""));
            echo "</textarea>
                                  <span class=\"help\">";
            // line 472
            echo ($context["help_cookietext_msg"] ?? null);
            echo "</span>
                                </div>
                              </div>
                              <div class=\"form-group required\">
                                <label class=\"col-sm-2 control-label\" for=\"input-cookietext_policy";
            // line 476
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 476);
            echo "\">";
            echo ($context["entry_cookietext_policy"] ?? null);
            echo " </label>
                                <div class=\"col-sm-5\">
                                  <input type=\"text\" name=\"mpgdpr_cookielang[";
            // line 478
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 478);
            echo "][text_policy]\" id=\"input-cookietext_policy";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 478);
            echo "\" class=\"form-control\" value=\"";
            echo (((($__internal_compile_6 = ($context["mpgdpr_cookielang"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 478)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_7 = ($context["mpgdpr_cookielang"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 478)] ?? null) : null), "text_policy", [], "any", false, false, false, 478)) : (""));
            echo "\" />
                                  <span class=\"help\">";
            // line 479
            echo ($context["help_cookietext_policy"] ?? null);
            echo "</span>
                                </div>
                              </div>
                              <div class=\"form-group required\">
                                <label class=\"col-sm-2 control-label\" for=\"input-cookiebtn_accept";
            // line 483
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 483);
            echo "\">";
            echo ($context["entry_cookiebtn_accept"] ?? null);
            echo " </label>
                                <div class=\"col-sm-5\">
                                  <input type=\"text\" name=\"mpgdpr_cookielang[";
            // line 485
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 485);
            echo "][btn_accept]\" id=\"input-cookiebtn_accept";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 485);
            echo "\" class=\"form-control\" value=\"";
            echo (((($__internal_compile_8 = ($context["mpgdpr_cookielang"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 485)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_9 = ($context["mpgdpr_cookielang"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 485)] ?? null) : null), "btn_accept", [], "any", false, false, false, 485)) : (""));
            echo "\" />
                                  <span class=\"help\">";
            // line 486
            echo ($context["help_cookiebtn_accept"] ?? null);
            echo "</span>
                                </div>
                              </div>
                              <div class=\"form-group required\">
                                <label class=\"col-sm-2 control-label\" for=\"input-cookiebtn_deny";
            // line 490
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 490);
            echo "\">";
            echo ($context["entry_cookiebtn_deny"] ?? null);
            echo " </label>
                                <div class=\"col-sm-5\">
                                  <input type=\"text\" name=\"mpgdpr_cookielang[";
            // line 492
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 492);
            echo "][btn_deny]\" id=\"input-cookiebtn_deny";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 492);
            echo "\" class=\"form-control\" value=\"";
            echo (((($__internal_compile_10 = ($context["mpgdpr_cookielang"] ?? null)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 492)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_11 = ($context["mpgdpr_cookielang"] ?? null)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 492)] ?? null) : null), "btn_deny", [], "any", false, false, false, 492)) : (""));
            echo "\" />
                                  <span class=\"help\">";
            // line 493
            echo ($context["help_cookiebtn_deny"] ?? null);
            echo "</span>
                                </div>
                              </div>
                              <div class=\"form-group required\">
                                <label class=\"col-sm-2 control-label\" for=\"input-cookiebtn_prefrence";
            // line 497
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 497);
            echo "\">";
            echo ($context["entry_cookiebtn_prefrence"] ?? null);
            echo " </label>
                                <div class=\"col-sm-5\">
                                  <input type=\"text\" name=\"mpgdpr_cookielang[";
            // line 499
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 499);
            echo "][btn_prefrence]\" id=\"input-cookiebtn_prefrence";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 499);
            echo "\" class=\"form-control\" value=\"";
            echo (((($__internal_compile_12 = ($context["mpgdpr_cookielang"] ?? null)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 499)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_13 = ($context["mpgdpr_cookielang"] ?? null)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 499)] ?? null) : null), "btn_prefrence", [], "any", false, false, false, 499)) : (""));
            echo "\" />
                                  <span class=\"help\">";
            // line 500
            echo ($context["help_cookiebtn_prefrence"] ?? null);
            echo "</span>
                                </div>
                              </div>
                              <div class=\"form-group required\">
                                <label class=\"col-sm-2 control-label\" for=\"input-cookiebtn_showagain";
            // line 504
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 504);
            echo "\">";
            echo ($context["entry_cookiebtn_showagain"] ?? null);
            echo " </label>
                                <div class=\"col-sm-5\">
                                  <input type=\"text\" name=\"mpgdpr_cookielang[";
            // line 506
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 506);
            echo "][btn_showagain]\" id=\"input-cookiebtn_showagain";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 506);
            echo "\" class=\"form-control\" value=\"";
            echo (((($__internal_compile_14 = ($context["mpgdpr_cookielang"] ?? null)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 506)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_15 = ($context["mpgdpr_cookielang"] ?? null)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 506)] ?? null) : null), "btn_showagain", [], "any", false, false, false, 506)) : (""));
            echo "\" />
                                  <span class=\"help\">";
            // line 507
            echo ($context["help_cookiebtn_showagain"] ?? null);
            echo "</span>
                                </div>
                              </div>
                            </div>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 512
        echo "                          </div>
                        </div>
                      </div>
                      <div class=\"form-group required\">
                        <label class=\"col-sm-2 control-label\" for=\"input-cbposition\">";
        // line 516
        echo ($context["entry_cbposition"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <select name=\"mpgdpr_cbposition\" id=\"input-cbposition\" class=\"form-control\">
                            ";
        // line 519
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["cbpositions"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["cbposition"]) {
            // line 520
            echo "                            <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["cbposition"], "value", [], "any", false, false, false, 520);
            echo "\" ";
            if ((($context["mpgdpr_cbposition"] ?? null) == twig_get_attribute($this->env, $this->source, $context["cbposition"], "value", [], "any", false, false, false, 520))) {
                echo "selected=\"selected\"";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["cbposition"], "text", [], "any", false, false, false, 520);
            echo "</option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cbposition'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 522
        echo "                          </select>
                          <span class=\"help\">";
        // line 523
        echo ($context["help_cbposition"] ?? null);
        echo "</span>
                        </div>
                      </div>
                      <div class=\"form-group required\">
                        <h4 class=\"subtitle\"><i class=\"fa fa-exclamation-triangle\"></i>  ";
        // line 527
        echo ($context["entry_cbcolors"] ?? null);
        echo " <br/> <small>";
        echo ($context["help_cbcolors"] ?? null);
        echo "</small></h4>
                        <div class=\"col-sm-12\">
                          <div class=\"form-group required\">
                            <label class=\"col-sm-2 control-label\" for=\"input-cbbox_bg\">";
        // line 530
        echo ($context["entry_cbboxbg"] ?? null);
        echo "</label>
                            <div class=\"col-sm-5\">
                               <div class=\"colorpicker colorpicker-component input-group\">
                                <span class=\"input-group-addon\"><i></i></span>
                                <input type=\"text\" name=\"mpgdpr_cbcolor[box_bg]\" value=\"";
        // line 534
        echo ((twig_get_attribute($this->env, $this->source, ($context["mpgdpr_cbcolor"] ?? null), "box_bg", [], "any", false, false, false, 534)) ? (twig_get_attribute($this->env, $this->source, ($context["mpgdpr_cbcolor"] ?? null), "box_bg", [], "any", false, false, false, 534)) : (""));
        echo "\" placeholder=\"";
        echo ($context["entry_cbboxbg"] ?? null);
        echo "\" id=\"input-cbbox_bg\" class=\"form-control\" />
                              </div>
                            </div>
                          </div>
                          <div class=\"form-group required\">
                            <label class=\"col-sm-2 control-label\" for=\"input-cbbox_text\">";
        // line 539
        echo ($context["entry_cbboxtext"] ?? null);
        echo "</label>
                            <div class=\"col-sm-5\">
                               <div class=\"colorpicker colorpicker-component input-group\">
                                <span class=\"input-group-addon\"><i></i></span>
                                <input type=\"text\" name=\"mpgdpr_cbcolor[box_text]\" value=\"";
        // line 543
        echo ((twig_get_attribute($this->env, $this->source, ($context["mpgdpr_cbcolor"] ?? null), "box_text", [], "any", false, false, false, 543)) ? (twig_get_attribute($this->env, $this->source, ($context["mpgdpr_cbcolor"] ?? null), "box_text", [], "any", false, false, false, 543)) : (""));
        echo "\" placeholder=\"";
        echo ($context["entry_cbboxtext"] ?? null);
        echo "\" id=\"input-cbbox_text\" class=\"form-control\" />
                              </div>
                            </div>
                          </div>
                          <div class=\"form-group required\">
                            <label class=\"col-sm-2 control-label\" for=\"input-cbbtn_bg\">";
        // line 548
        echo ($context["entry_cbbtnbg"] ?? null);
        echo "</label>
                            <div class=\"col-sm-5\">
                               <div class=\"colorpicker colorpicker-component input-group\">
                                <span class=\"input-group-addon\"><i></i></span>
                                <input type=\"text\" name=\"mpgdpr_cbcolor[btn_bg]\" value=\"";
        // line 552
        echo ((twig_get_attribute($this->env, $this->source, ($context["mpgdpr_cbcolor"] ?? null), "btn_bg", [], "any", false, false, false, 552)) ? (twig_get_attribute($this->env, $this->source, ($context["mpgdpr_cbcolor"] ?? null), "btn_bg", [], "any", false, false, false, 552)) : (""));
        echo "\" placeholder=\"";
        echo ($context["entry_cbbtnbg"] ?? null);
        echo "\" id=\"input-cbbtn_bg\" class=\"form-control\" />
                              </div>
                            </div>
                          </div>
                          <div class=\"form-group required\">
                            <label class=\"col-sm-2 control-label\" for=\"input-cbbtn_text\">";
        // line 557
        echo ($context["entry_cbbtntext"] ?? null);
        echo "</label>
                            <div class=\"col-sm-5\">
                               <div class=\"colorpicker colorpicker-component input-group\">
                                <span class=\"input-group-addon\"><i></i></span>
                                <input type=\"text\" name=\"mpgdpr_cbcolor[btn_text]\" value=\"";
        // line 561
        echo ((twig_get_attribute($this->env, $this->source, ($context["mpgdpr_cbcolor"] ?? null), "btn_text", [], "any", false, false, false, 561)) ? (twig_get_attribute($this->env, $this->source, ($context["mpgdpr_cbcolor"] ?? null), "btn_text", [], "any", false, false, false, 561)) : (""));
        echo "\" placeholder=\"";
        echo ($context["entry_cbbtntext"] ?? null);
        echo "\" id=\"input-cbbtn_text\" class=\"form-control\" />
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=\"form-group required\">
                        <label class=\"col-sm-2 control-label\" for=\"input-cbcss\">";
        // line 568
        echo ($context["entry_cbcss"] ?? null);
        echo " </label>
                        <div class=\"col-sm-5\">
                          <textarea rows=\"5\" name=\"mpgdpr_cbcss\" id=\"input-cbcss\" class=\"form-control\">";
        // line 570
        echo ($context["mpgdpr_cbcss"] ?? null);
        echo "</textarea>
                          <span class=\"help\">";
        // line 571
        echo ($context["help_cbcss"] ?? null);
        echo "</span>
                        </div>
                      </div>
                    </div>
                    <a target=\"_blank\" href=\"https://cookieconsent.insites.com/\">* Cookie Conset js library Originally developed by insite :)</a>
                  </div>
                </div>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-support\">
              <fieldset>
                <div class=\"form-group\">
                  <div class=\"col-md-12 col-xs-12\">
                    <h4 class=\"text-mpsuccess text-center\"><i class=\"fa fa-thumbs-up\" aria-hidden=\"true\"></i> Thanks For Choosing Our Extension</h4>
                     <ul class=\"list-group\">
                      <li class=\"list-group-item clearfix\">Installed Version <span class=\"badge\"><i class=\"fa fa-gg\" aria-hidden=\"true\"></i> V.1.0</span></li>
                    </ul>
                    <h4 class=\"text-mpsuccess text-center\"><i class=\"fa fa-phone\" aria-hidden=\"true\"></i> Please Contact Us In Case Any Issue OR Give Feedback!</h4>
                    <ul class=\"list-group\">
                      <li class=\"list-group-item clearfix\">support@modulepoints.com <span class=\"badge\"><a href=\"mailto:support@modulepoints.com?Subject=Request Support: GDPR\"><i class=\"fa fa-envelope\"></i> Contact Us</a></span></li> 
                    </ul>
                  </div>
                </div>
              </fieldset>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type=\"text/javascript\"><!--
\$(function() { \$('.colorpicker').colorpicker(); });
\$('.nav-tabs').each(function() {
  \$(this).find('a:first').tab('show');
});
//--></script>
</div>
";
        // line 608
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "mpgdpr/mpgdpr.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1634 => 608,  1594 => 571,  1590 => 570,  1585 => 568,  1573 => 561,  1566 => 557,  1556 => 552,  1549 => 548,  1539 => 543,  1532 => 539,  1522 => 534,  1515 => 530,  1507 => 527,  1500 => 523,  1497 => 522,  1482 => 520,  1478 => 519,  1472 => 516,  1466 => 512,  1455 => 507,  1447 => 506,  1440 => 504,  1433 => 500,  1425 => 499,  1418 => 497,  1411 => 493,  1403 => 492,  1396 => 490,  1389 => 486,  1381 => 485,  1374 => 483,  1367 => 479,  1359 => 478,  1352 => 476,  1345 => 472,  1337 => 471,  1330 => 469,  1324 => 467,  1320 => 466,  1316 => 464,  1301 => 462,  1297 => 461,  1289 => 458,  1280 => 452,  1276 => 451,  1271 => 449,  1264 => 445,  1260 => 444,  1255 => 442,  1248 => 438,  1244 => 437,  1239 => 435,  1232 => 431,  1228 => 430,  1223 => 428,  1214 => 422,  1208 => 419,  1202 => 418,  1196 => 417,  1191 => 415,  1185 => 414,  1179 => 413,  1173 => 410,  1166 => 406,  1163 => 405,  1148 => 403,  1144 => 402,  1138 => 399,  1131 => 395,  1128 => 394,  1113 => 392,  1109 => 391,  1103 => 388,  1096 => 384,  1090 => 381,  1084 => 380,  1078 => 379,  1073 => 377,  1067 => 376,  1061 => 375,  1055 => 372,  1048 => 368,  1045 => 367,  1030 => 365,  1026 => 364,  1022 => 363,  1016 => 360,  1009 => 356,  1003 => 353,  997 => 352,  991 => 351,  986 => 349,  980 => 348,  974 => 347,  968 => 344,  961 => 340,  955 => 337,  949 => 336,  943 => 335,  938 => 333,  932 => 332,  926 => 331,  920 => 328,  910 => 321,  906 => 320,  902 => 319,  894 => 313,  883 => 308,  875 => 307,  870 => 305,  863 => 301,  855 => 300,  850 => 298,  844 => 296,  840 => 295,  836 => 293,  821 => 291,  817 => 290,  809 => 287,  797 => 278,  791 => 277,  786 => 275,  779 => 271,  773 => 270,  768 => 268,  759 => 262,  753 => 261,  748 => 259,  741 => 255,  735 => 254,  730 => 252,  721 => 246,  718 => 245,  712 => 244,  704 => 242,  696 => 240,  693 => 239,  689 => 238,  685 => 237,  679 => 234,  672 => 230,  666 => 227,  660 => 226,  654 => 225,  649 => 223,  643 => 222,  637 => 221,  631 => 218,  622 => 212,  619 => 211,  604 => 209,  600 => 208,  596 => 207,  590 => 204,  583 => 200,  577 => 197,  571 => 196,  565 => 195,  560 => 193,  554 => 192,  548 => 191,  542 => 188,  537 => 186,  531 => 183,  528 => 182,  513 => 180,  509 => 179,  505 => 178,  499 => 175,  492 => 171,  486 => 168,  480 => 167,  474 => 166,  469 => 164,  463 => 163,  457 => 162,  451 => 159,  446 => 157,  440 => 154,  437 => 153,  422 => 151,  418 => 150,  414 => 149,  408 => 146,  401 => 142,  395 => 139,  389 => 138,  383 => 137,  378 => 135,  372 => 134,  366 => 133,  360 => 130,  355 => 128,  349 => 125,  343 => 122,  337 => 121,  331 => 120,  326 => 118,  320 => 117,  314 => 116,  308 => 113,  305 => 112,  299 => 100,  294 => 98,  289 => 96,  282 => 92,  276 => 89,  270 => 88,  264 => 87,  259 => 85,  253 => 84,  247 => 83,  241 => 80,  234 => 76,  228 => 73,  222 => 72,  216 => 71,  211 => 69,  205 => 68,  199 => 67,  193 => 64,  183 => 57,  179 => 56,  175 => 55,  171 => 54,  161 => 47,  157 => 46,  153 => 45,  149 => 44,  144 => 42,  138 => 38,  123 => 36,  119 => 35,  114 => 33,  110 => 32,  104 => 29,  100 => 27,  92 => 23,  89 => 22,  81 => 18,  79 => 17,  73 => 13,  62 => 11,  58 => 10,  53 => 8,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "mpgdpr/mpgdpr.twig", "");
    }
}
