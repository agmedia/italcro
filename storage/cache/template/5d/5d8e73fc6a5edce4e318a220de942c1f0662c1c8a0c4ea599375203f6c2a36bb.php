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

/* extension/module/catalog/product_list.twig */
class __TwigTemplate_dcde1232b3477c5b301da8f751300afedaa24496fbc1a507e6587113b99e4496 extends \Twig\Template
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
        $macros["_self"] = $this->macros["_self"] = $this;
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 13
        echo ($context["header"] ?? null);
        echo "
<!-- display length configuration -->
<div class=\"modal fade\" id=\"displayLengthModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"displayLengthModalLabel\" aria-hidden=\"true\">
\t<div class=\"modal-dialog\">
\t\t<div class=\"modal-content\">
\t\t\t<div class=\"modal-header\">
\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
\t\t\t\t<h4 class=\"modal-title\" id=\"displayLengthModalLabel\">";
        // line 20
        echo ($context["text_items_per_page"] ?? null);
        echo "</h4>
\t\t\t</div>
\t\t\t<div class=\"modal-body bull5i-container\">
\t\t\t\t<div class=\"notice\">
\t\t\t\t</div>
\t\t\t\t<form method=\"post\" action=\"";
        // line 25
        echo ($context["settings"] ?? null);
        echo "\" class=\"form-horizontal ajax-form\" role=\"form\" id=\"displayLengthForm\">
\t\t\t\t\t<fieldset>
\t\t\t\t\t\t<div class=\"form-group\" data-bind=\"css: {'has-error': module_product_quick_edit_items_per_page.hasError}\">
\t\t\t\t\t\t\t<label for=\"displayLength\" class=\"col-sm-4 control-label\">";
        // line 28
        echo ($context["entry_products_per_page"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-2\">
\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control\" name=\"module_product_quick_edit_items_per_page\" id=\"displayLength\" data-bind=\"value: module_product_quick_edit_items_per_page\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-sm-offset-4 col-sm-8 error-container\" data-bind=\"visible: module_product_quick_edit_items_per_page.hasError && module_product_quick_edit_items_per_page.errorMsg\">
\t\t\t\t\t\t\t\t<span class=\"help-block error-text\" data-bind=\"text: module_product_quick_edit_items_per_page.errorMsg\"></span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<span class=\"help-block\">";
        // line 36
        echo ($context["help_items_per_page"] ?? null);
        echo "</span>
\t\t\t\t\t</fieldset>
\t\t\t\t</form>
\t\t\t</div>
\t\t\t<div class=\"modal-footer\">
\t\t\t\t<button type=\"button\" class=\"btn btn-default cancel\" data-dismiss=\"modal\"><i class=\"fa fa-times\"></i> ";
        // line 41
        echo ($context["button_close"] ?? null);
        echo "</button>
\t\t\t\t<button type=\"button\" class=\"btn btn-primary submit\" data-form=\"#displayLengthForm\" data-context=\"#displayLengthModal\" data-vm=\"displayLengthVM\" data-loading-text=\"<i class='fa fa-spinner fa-spin'></i> ";
        // line 42
        echo ($context["text_saving"] ?? null);
        echo "\"><i class=\"fa fa-save\"></i> ";
        echo ($context["button_save"] ?? null);
        echo "</button>
\t\t\t</div>
\t\t</div><!-- /.modal-content -->
\t</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- confirm deletion -->
<div class=\"modal fade\" id=\"confirmDelete\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"confirmDeleteLabel\" aria-hidden=\"true\">
\t<div class=\"modal-dialog\">
\t\t<div class=\"modal-content\">
\t\t\t<div class=\"modal-header\">
\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
\t\t\t\t<h4 class=\"modal-title\" id=\"confirmDeleteLabel\">";
        // line 54
        echo ($context["text_confirm_delete"] ?? null);
        echo "</h4>
\t\t\t</div>
\t\t\t<div class=\"modal-body\">
\t\t\t\t<p>";
        // line 57
        echo ($context["text_are_you_sure"] ?? null);
        echo "</p>
\t\t\t</div>
\t\t\t<div class=\"modal-footer\">
\t\t\t\t<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\"><i class=\"fa fa-ban\"></i> ";
        // line 60
        echo ($context["button_cancel"] ?? null);
        echo "</button>
\t\t\t\t<button type=\"button\" class=\"btn btn-danger delete\"><i class=\"fa fa-trash-o\"></i> ";
        // line 61
        echo ($context["button_delete"] ?? null);
        echo "</button>
\t\t\t</div>
\t\t</div><!-- /.modal-content -->
\t</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- column settings -->
<div class=\"modal fade\" id=\"pageColumnsModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"pageColumnsModalLabel\" aria-hidden=\"true\">
\t<div class=\"modal-dialog\">
\t\t<div class=\"modal-content\">
\t\t\t<div class=\"modal-header\">
\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
\t\t\t\t<h4 class=\"modal-title\" id=\"pageColumnsModalLabel\">";
        // line 73
        echo ($context["text_choose_columns"] ?? null);
        echo "</h4>
\t\t\t</div>
\t\t\t<div class=\"modal-body bull5i-container\">
\t\t\t\t<div class=\"bull5i-overlay fade\">
\t\t\t\t\t<div class=\"page-overlay-progress\"><i class=\"fa fa-refresh fa-spin fa-5x text-muted\"></i></div>
\t\t\t\t</div>
\t\t\t\t<div class=\"notice\">
\t\t\t\t</div>
\t\t\t\t<form method=\"post\" action=\"";
        // line 81
        echo ($context["settings"] ?? null);
        echo "\" class=\"form-horizontal ajax-form\" role=\"form\" id=\"pageColumnsModalForm\">
\t\t\t\t\t<fieldset>
\t\t\t\t\t\t<h4>";
        // line 83
        echo ($context["entry_columns"] ?? null);
        echo "</h4>
\t\t\t\t\t\t<table class=\"table table-hover table-condensed page-columns sortable\">
\t\t\t\t\t\t\t<thead>
\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t<th>#</th>
\t\t\t\t\t\t\t\t\t<th>";
        // line 88
        echo ($context["text_column"] ?? null);
        echo "</th>
\t\t\t\t\t\t\t\t\t<th class=\"text-center\">";
        // line 89
        echo ($context["text_display"] ?? null);
        echo "</th>
\t\t\t\t\t\t\t\t\t<th class=\"text-center\">";
        // line 90
        echo ($context["text_editable"] ?? null);
        echo "</th>
\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t</thead>
\t\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t\t<!-- ko foreach: product_columns -->
\t\t\t\t\t\t\t\t<tr data-bind=\"attr: {'data-id': column}, css: {'danger': !visible()}\">
\t\t\t\t\t\t\t\t\t<td><i class=\"fa fa-arrows-v\"></i></td>
\t\t\t\t\t\t\t\t\t<td><!-- ko text: name --><!-- /ko --><input data-bind=\"value: index, attr: {name:'index[columns][' + column +']'}\" type=\"hidden\" class=\"column-index\" /></td>
\t\t\t\t\t\t\t\t\t<td class=\"text-center\"><input data-bind=\"checked: visible, attr: {name:'display[columns][' + column +']'}\" type=\"checkbox\" class=\"column-display\" /></td>
\t\t\t\t\t\t\t\t\t<td class=\"text-center\"><!-- ko if: editable -->";
        // line 99
        echo ($context["text_yes"] ?? null);
        echo "<!-- /ko --><!-- ko ifnot: editable -->";
        echo ($context["text_no"] ?? null);
        echo "<!-- /ko --></td>
\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t<!-- /ko -->
\t\t\t\t\t\t\t</tbody>
\t\t\t\t\t\t</table>
\t\t\t\t\t\t<h4>";
        // line 104
        echo ($context["entry_actions"] ?? null);
        echo "</h4>
\t\t\t\t\t\t<table class=\"table table-hover table-condensed page-actions sortable\">
\t\t\t\t\t\t\t<thead>
\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t<th>#</th>
\t\t\t\t\t\t\t\t\t<th>";
        // line 109
        echo ($context["text_action"] ?? null);
        echo "</th>
\t\t\t\t\t\t\t\t\t<th class=\"text-center\">";
        // line 110
        echo ($context["text_display"] ?? null);
        echo "</th>
\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t</thead>
\t\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t\t<!-- ko foreach: product_actions -->
\t\t\t\t\t\t\t\t<tr data-bind=\"attr: {'data-id': column}, css: {'danger': !visible()}\">
\t\t\t\t\t\t\t\t\t<td><i class=\"fa fa-arrows-v\"></i></td>
\t\t\t\t\t\t\t\t\t<td><!-- ko text: name --><!-- /ko --><input data-bind=\"value: index, attr: {name:'index[actions][' + column +']'}\" type=\"hidden\" class=\"column-index\" /></td>
\t\t\t\t\t\t\t\t\t<td class=\"text-center\"><input data-bind=\"checked: visible, attr: {name:'display[actions][' + column +']'}\" type=\"checkbox\" class=\"column-display\" /></td>
\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t<!-- /ko -->
\t\t\t\t\t\t\t</tbody>
\t\t\t\t\t\t</table>
\t\t\t\t\t</fieldset>
\t\t\t\t</form>
\t\t\t</div>
\t\t\t<div class=\"modal-footer\">
\t\t\t\t<button type=\"button\" class=\"btn btn-default cancel\" data-dismiss=\"modal\"><i class=\"fa fa-times\"></i> ";
        // line 127
        echo ($context["button_close"] ?? null);
        echo "</button>
\t\t\t\t<button type=\"button\" class=\"btn btn-primary submit\" data-form=\"#pageColumnsModalForm\" data-context=\"#pageColumnsModal\" data-vm=\"pageColumnsVM\" data-loading-text=\"<i class='fa fa-spinner fa-spin'></i> ";
        // line 128
        echo ($context["text_saving"] ?? null);
        echo "\"><i class=\"fa fa-save\"></i> ";
        echo ($context["button_save"] ?? null);
        echo "</button>
\t\t\t</div>
\t\t</div><!-- /.modal-content -->
\t</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- other settings -->
<div class=\"modal fade\" id=\"otherSettingsModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"otherSettingsModalLabel\" aria-hidden=\"true\">
\t<div class=\"modal-dialog\">
\t\t<div class=\"modal-content\">
\t\t\t<div class=\"modal-header\">
\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
\t\t\t\t<h4 class=\"modal-title\" id=\"otherSettingsModalLabel\">";
        // line 140
        echo ($context["text_other_settings"] ?? null);
        echo "</h4>
\t\t\t</div>
\t\t\t<div class=\"modal-body bull5i-container\">
\t\t\t\t<div class=\"notice\">
\t\t\t\t</div>
\t\t\t\t<form method=\"post\" action=\"";
        // line 145
        echo ($context["settings"] ?? null);
        echo "\" class=\"form-horizontal ajax-form\" role=\"form\" id=\"otherSettingsForm\">
\t\t\t\t\t<fieldset>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"col-sm-4 control-label\" for=\"module_product_quick_edit_list_view_image_width\" data-bind=\"css: {'has-error': module_product_quick_edit_list_view_image_width.hasError || module_product_quick_edit_list_view_image_height.hasError}\">";
        // line 148
        echo ($context["entry_list_view_image_size"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control text-right\" name=\"module_product_quick_edit_list_view_image_width\" id=\"module_product_quick_edit_list_view_image_width\" data-bind=\"value: module_product_quick_edit_list_view_image_width, css: {'has-error': module_product_quick_edit_list_view_image_width.hasError}\">
\t\t\t\t\t\t\t\t\t<span class=\"input-group-addon\"><i class=\"fa fa-times\"></i></span>
\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control\" name=\"module_product_quick_edit_list_view_image_height\" id=\"module_product_quick_edit_list_view_image_height\" data-bind=\"value: module_product_quick_edit_list_view_image_height, css: {'has-error': module_product_quick_edit_list_view_image_height.hasError}\">
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-sm-offset-4 col-sm-8 error-container has-error\" data-bind=\"visible: module_product_quick_edit_list_view_image_width.hasError && module_product_quick_edit_list_view_image_width.errorMsg\">
\t\t\t\t\t\t\t\t<span class=\"help-block error-text\" data-bind=\"text: module_product_quick_edit_list_view_image_width.errorMsg\"></span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-sm-offset-4 col-sm-8 error-container has-error\" data-bind=\"visible: module_product_quick_edit_list_view_image_height.hasError && module_product_quick_edit_list_view_image_height.errorMsg\">
\t\t\t\t\t\t\t\t<span class=\"help-block error-text\" data-bind=\"text: module_product_quick_edit_list_view_image_height.errorMsg\"></span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label for=\"quickEditOn\" class=\"col-sm-4 control-label\">";
        // line 164
        echo ($context["entry_quick_edit_on"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-3 fc-auto-width\">
\t\t\t\t\t\t\t\t<select name=\"module_product_quick_edit_quick_edit_on\" id=\"quickEditOn\" class=\"form-control\" data-bind=\"value: module_product_quick_edit_quick_edit_on\">
\t\t\t\t\t\t\t\t\t<option value=\"click\">";
        // line 167
        echo ($context["text_single_click"] ?? null);
        echo "</option>
\t\t\t\t\t\t\t\t\t<option value=\"dblclick\">";
        // line 168
        echo ($context["text_double_click"] ?? null);
        echo "</option>
\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label for=\"priceRelativeTo\" class=\"col-sm-4 control-label\">";
        // line 173
        echo ($context["entry_price_relative_to"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-3 fc-auto-width\">
\t\t\t\t\t\t\t\t<select name=\"module_product_quick_edit_price_relative_to\" id=\"priceRelativeTo\" class=\"form-control\" data-bind=\"value: module_product_quick_edit_price_relative_to\">
\t\t\t\t\t\t\t\t\t<option value=\"previous\">";
        // line 176
        echo ($context["text_previous_value"] ?? null);
        echo "</option>
\t\t\t\t\t\t\t\t\t<option value=\"product\">";
        // line 177
        echo ($context["text_product_price"] ?? null);
        echo "</option>
\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-sm-offset-4 col-sm-8 help-container\">
\t\t\t\t\t\t\t\t<span class=\"help-block help-text\">";
        // line 181
        echo ($context["help_price_relative_to"] ?? null);
        echo "</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label for=\"serverSideCaching\" class=\"col-sm-4 control-label\">";
        // line 185
        echo ($context["entry_server_side_caching"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_server_side_caching\" id=\"serverSideCaching\" value=\"1\" data-bind=\"checked: module_product_quick_edit_server_side_caching\"> ";
        // line 188
        echo ($context["text_yes"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_server_side_caching\" id=\"serverSideCachingNo\" value=\"0\" data-bind=\"checked: module_product_quick_edit_server_side_caching\"> ";
        // line 191
        echo ($context["text_no"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-sm-offset-4 col-sm-8 help-container\">
\t\t\t\t\t\t\t\t<span class=\"help-block help-text\">";
        // line 195
        echo ($context["help_server_side_caching"] ?? null);
        echo "</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label for=\"clientSideCaching\" class=\"col-sm-4 control-label\">";
        // line 199
        echo ($context["entry_client_side_caching"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_client_side_caching\" id=\"clientSideCaching\" value=\"1\" data-bind=\"checked: module_product_quick_edit_client_side_caching\"> ";
        // line 202
        echo ($context["text_yes"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_client_side_caching\" id=\"clientSideCachingNo\" value=\"0\" data-bind=\"checked: module_product_quick_edit_client_side_caching\"> ";
        // line 205
        echo ($context["text_no"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-sm-offset-4 col-sm-8 help-container\">
\t\t\t\t\t\t\t\t<span class=\"help-block help-text\">";
        // line 209
        echo ($context["help_client_side_caching"] ?? null);
        echo "</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<!-- ko if: module_product_quick_edit_client_side_caching() == '1' -->
\t\t\t\t\t\t<div class=\"form-group\" data-bind=\"css: {'has-error': module_product_quick_edit_cache_size.hasError}\">
\t\t\t\t\t\t\t<label for=\"clientSideCacheSize\" class=\"col-sm-4 control-label\">";
        // line 214
        echo ($context["entry_client_side_cache_size"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-4\">
\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control text-right\" name=\"module_product_quick_edit_cache_size\" id=\"clientSideCacheSize\" data-bind=\"value: module_product_quick_edit_cache_size\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-sm-offset-4 col-sm-8 error-container\" data-bind=\"visible: module_product_quick_edit_cache_size.hasError && module_product_quick_edit_cache_size.errorMsg\">
\t\t\t\t\t\t\t\t<span class=\"help-block error-text\" data-bind=\"text: module_product_quick_edit_cache_size.errorMsg\"></span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-sm-offset-4 col-sm-8 help-container\">
\t\t\t\t\t\t\t\t<span class=\"help-block help-text\">";
        // line 222
        echo ($context["help_client_side_cache_size"] ?? null);
        echo "</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<input type=\"hidden\" name=\"module_product_quick_edit_cache_size\" data-bind=\"value: module_product_quick_edit_cache_size\">
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<!-- /ko -->
\t\t\t\t\t\t<!-- ko if: module_product_quick_edit_client_side_caching() != '1' -->
\t\t\t\t\t\t<input type=\"hidden\" name=\"module_product_quick_edit_cache_size\" data-bind=\"value: module_product_quick_edit_cache_size\">
\t\t\t\t\t\t<!-- /ko -->
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label for=\"alternateRowColour\" class=\"col-sm-4 control-label\">";
        // line 231
        echo ($context["entry_alternate_row_colour"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_alternate_row_colour\" id=\"alternateRowColour\" value=\"1\" data-bind=\"checked: module_product_quick_edit_alternate_row_colour\"> ";
        // line 234
        echo ($context["text_yes"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_alternate_row_colour\" id=\"alternateRowColourNo\" value=\"0\" data-bind=\"checked: module_product_quick_edit_alternate_row_colour\"> ";
        // line 237
        echo ($context["text_no"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label for=\"rowHoverHighlighting\" class=\"col-sm-4 control-label\">";
        // line 242
        echo ($context["entry_row_hover_highlighting"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_row_hover_highlighting\" id=\"rowHoverHighlighting\" value=\"1\" data-bind=\"checked: module_product_quick_edit_row_hover_highlighting\"> ";
        // line 245
        echo ($context["text_yes"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_row_hover_highlighting\" id=\"rowHoverHighlightingNo\" value=\"0\" data-bind=\"checked: module_product_quick_edit_row_hover_highlighting\"> ";
        // line 248
        echo ($context["text_no"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-sm-offset-4 col-sm-8 help-container\">
\t\t\t\t\t\t\t\t<span class=\"help-block help-text\">";
        // line 252
        echo ($context["help_row_hover_highlighting"] ?? null);
        echo "</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label for=\"highlightStatus\" class=\"col-sm-4 control-label\">";
        // line 256
        echo ($context["entry_highlight_status"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_highlight_status\" id=\"highlightStatus\" value=\"1\" data-bind=\"checked: module_product_quick_edit_highlight_status\"> ";
        // line 259
        echo ($context["text_yes"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_highlight_status\" id=\"highlightStatusNo\" value=\"0\" data-bind=\"checked: module_product_quick_edit_highlight_status\"> ";
        // line 262
        echo ($context["text_no"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-sm-offset-4 col-sm-8 help-container\">
\t\t\t\t\t\t\t\t<span class=\"help-block help-text\">";
        // line 266
        echo ($context["help_highlight_status"] ?? null);
        echo "</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label for=\"highlightFilteredColumns\" class=\"col-sm-4 control-label\">";
        // line 270
        echo ($context["entry_highlight_filtered_columns"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_highlight_filtered_columns\" id=\"highlightFilteredColumns\" value=\"1\" data-bind=\"checked: module_product_quick_edit_highlight_filtered_columns\"> ";
        // line 273
        echo ($context["text_yes"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_highlight_filtered_columns\" id=\"highlightFilteredColumnsNo\" value=\"0\" data-bind=\"checked: module_product_quick_edit_highlight_filtered_columns\"> ";
        // line 276
        echo ($context["text_no"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-sm-offset-4 col-sm-8 help-container\">
\t\t\t\t\t\t\t\t<span class=\"help-block help-text\">";
        // line 280
        echo ($context["help_highlight_filtered_columns"] ?? null);
        echo "</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label for=\"highlightActions\" class=\"col-sm-4 control-label\">";
        // line 284
        echo ($context["entry_highlight_actions"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_highlight_actions\" id=\"highlightActions\" value=\"1\" data-bind=\"checked: module_product_quick_edit_highlight_actions\"> ";
        // line 287
        echo ($context["text_yes"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_highlight_actions\" id=\"highlightActionsNo\" value=\"0\" data-bind=\"checked: module_product_quick_edit_highlight_actions\"> ";
        // line 290
        echo ($context["text_no"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-sm-offset-4 col-sm-8 help-container\">
\t\t\t\t\t\t\t\t<span class=\"help-block help-text\">";
        // line 294
        echo ($context["help_highlight_actions"] ?? null);
        echo "</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label for=\"filterSubCategory\" class=\"col-sm-4 control-label\">";
        // line 298
        echo ($context["entry_filter_sub_category"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_filter_sub_category\" id=\"filterSubCategory\" value=\"1\" data-bind=\"checked: module_product_quick_edit_filter_sub_category\"> ";
        // line 301
        echo ($context["text_yes"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_filter_sub_category\" id=\"filterSubCategoryNo\" value=\"0\" data-bind=\"checked: module_product_quick_edit_filter_sub_category\"> ";
        // line 304
        echo ($context["text_no"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-sm-offset-4 col-sm-8 help-container\">
\t\t\t\t\t\t\t\t<span class=\"help-block help-text\">";
        // line 308
        echo ($context["help_filter_sub_category"] ?? null);
        echo "</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label for=\"searchBar\" class=\"col-sm-4 control-label\">";
        // line 312
        echo ($context["entry_search_bar"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_search_bar\" id=\"searchBar\" value=\"1\" data-bind=\"checked: module_product_quick_edit_search_bar\"> ";
        // line 315
        echo ($context["text_visible"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_search_bar\" id=\"searchBarNo\" value=\"0\" data-bind=\"checked: module_product_quick_edit_search_bar\"> ";
        // line 318
        echo ($context["text_hidden"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label for=\"batchEdit\" class=\"col-sm-4 control-label\">";
        // line 323
        echo ($context["entry_batch_edit"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_batch_edit\" id=\"batchEdit\" value=\"1\" data-bind=\"checked: module_product_quick_edit_batch_edit\"> ";
        // line 326
        echo ($context["text_yes"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_batch_edit\" id=\"batchEditNo\" value=\"0\" data-bind=\"checked: module_product_quick_edit_batch_edit\"> ";
        // line 329
        echo ($context["text_no"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-sm-offset-4 col-sm-8 help-container\">
\t\t\t\t\t\t\t\t<span class=\"help-block help-text\">";
        // line 333
        echo ($context["help_batch_edit"] ?? null);
        echo "</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label for=\"showSuccessMessage\" class=\"col-sm-4 control-label\">";
        // line 337
        echo ($context["entry_show_success_message"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_show_success_message\" id=\"showSuccessMessage\" value=\"1\" data-bind=\"checked: module_product_quick_edit_show_success_message\"> ";
        // line 340
        echo ($context["text_yes"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_show_success_message\" id=\"showSuccessMessageNo\" value=\"0\" data-bind=\"checked: module_product_quick_edit_show_success_message\"> ";
        // line 343
        echo ($context["text_no"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-sm-offset-4 col-sm-8 help-container\">
\t\t\t\t\t\t\t\t<span class=\"help-block help-text\">";
        // line 347
        echo ($context["help_show_success_message"] ?? null);
        echo "</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label for=\"defaultSort\" class=\"col-sm-4 control-label\">";
        // line 351
        echo ($context["entry_default_sorting"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-3 fc-auto-width\">
\t\t\t\t\t\t\t\t<select name=\"module_product_quick_edit_default_sort\" id=\"defaultSort\" class=\"form-control\" data-bind=\"value: module_product_quick_edit_default_sort\">
\t\t\t\t\t\t\t\t\t";
        // line 354
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["sorts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["sort"]) {
            // line 355
            echo "\t\t\t\t\t\t\t\t\t<option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["sort"], "value", [], "any", false, false, false, 355);
            echo "\"";
            echo (((twig_get_attribute($this->env, $this->source, $context["sort"], "value", [], "any", false, false, false, 355) == ($context["module_product_quick_edit_default_sort"] ?? null))) ? (" selected") : (""));
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["sort"], "name", [], "any", false, false, false, 355);
            echo "</option>
\t\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sort'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 357
        echo "\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-sm-3 fc-auto-width\">
\t\t\t\t\t\t\t\t<select name=\"module_product_quick_edit_default_order\" id=\"defaultOrder\" class=\"form-control\" data-bind=\"value: module_product_quick_edit_default_order\">
\t\t\t\t\t\t\t\t\t<option value=\"ASC\"";
        // line 361
        echo ((("asc" == twig_lower_filter($this->env, ($context["module_product_quick_edit_default_order"] ?? null)))) ? (" selected") : (""));
        echo ">";
        echo ($context["text_ascending"] ?? null);
        echo "</option>
\t\t\t\t\t\t\t\t\t<option value=\"DESC\"";
        // line 362
        echo ((("desc" == twig_lower_filter($this->env, ($context["module_product_quick_edit_default_order"] ?? null)))) ? (" selected") : (""));
        echo ">";
        echo ($context["text_descending"] ?? null);
        echo "</option>
\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<!-- ko if: module_product_quick_edit_debug_mode() == '1' -->
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label for=\"debugMode\" class=\"col-sm-4 control-label\">";
        // line 368
        echo ($context["entry_debug_mode"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_debug_mode\" id=\"debugMode\" value=\"1\" data-bind=\"checked: module_product_quick_edit_debug_mode\"> ";
        // line 371
        echo ($context["text_yes"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t<label class=\"radio-inline\">
\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"module_product_quick_edit_debug_mode\" id=\"debugModeNo\" value=\"0\" data-bind=\"checked: module_product_quick_edit_debug_mode\"> ";
        // line 374
        echo ($context["text_no"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<!-- /ko -->
\t\t\t\t\t\t<!-- ko if: module_product_quick_edit_debug_mode() != '1' -->
\t\t\t\t\t\t<input type=\"hidden\" name=\"module_product_quick_edit_debug_mode\" value=\"0\" data-bind=\"checked: module_product_quick_edit_debug_mode\">
\t\t\t\t\t\t<!-- /ko -->
\t\t\t\t\t</fieldset>
\t\t\t\t</form>
\t\t\t</div>
\t\t\t<div class=\"modal-footer\">
\t\t\t\t<button type=\"button\" class=\"btn btn-default cancel\" data-dismiss=\"modal\"><i class=\"fa fa-times\"></i> ";
        // line 386
        echo ($context["button_close"] ?? null);
        echo "</button>
\t\t\t\t<button type=\"button\" class=\"btn btn-primary submit\" data-form=\"#otherSettingsForm\" data-context=\"#otherSettingsModal\" data-vm=\"otherSettingsVM\" data-loading-text=\"<i class='fa fa-spinner fa-spin'></i> ";
        // line 387
        echo ($context["text_saving"] ?? null);
        echo "\"><i class=\"fa fa-save\"></i> ";
        echo ($context["button_save"] ?? null);
        echo "</button>
\t\t\t</div>
\t\t</div><!-- /.modal-content -->
\t</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

";
        // line 393
        if ((twig_in_filter("image", ($context["columns"] ?? null)) || twig_in_filter("images", ($context["actions"] ?? null)))) {
            // line 394
            echo "<!-- image manager -->
<div class=\"modal fade\" id=\"modal-image\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"imageManagerModalLabel\" aria-hidden=\"true\">
</div><!-- /.modal -->
";
        }
        // line 398
        echo "
<!-- action menu modal -->
<div class=\"modal fade modal-60p\" id=\"actionQuickEditModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"actionQuickEditModalLabel\" aria-hidden=\"true\">
\t<div class=\"modal-dialog\">
\t\t<div class=\"modal-content\">
\t\t\t<div class=\"modal-header\">
\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
\t\t\t\t<h4 class=\"modal-title\" id=\"actionQuickEditModalLabel\"></h4>
\t\t\t</div>
\t\t\t<div class=\"modal-body bull5i-container\">
\t\t\t\t<div class=\"notice\">
\t\t\t\t</div>
\t\t\t\t<form enctype=\"multipart/form-data\" id=\"actionQuickEditForm\" onsubmit=\"return false;\">
\t\t\t\t\t<fieldset>
\t\t\t\t\t</fieldset>
\t\t\t\t</form>
\t\t\t</div>
\t\t\t<div class=\"modal-footer\">
\t\t\t\t<button type=\"button\" class=\"btn btn-default cancel\" data-dismiss=\"modal\"><i class=\"fa fa-times\"></i> ";
        // line 416
        echo ($context["button_close"] ?? null);
        echo "</button>
\t\t\t\t<button type=\"button\" class=\"btn btn-danger submit remove\" data-form=\"#actionQuickEditForm\" data-context=\"#actionQuickEditModal\" data-vm=\"actionQuickEditVM\" data-loading-text=\"<i class='fa fa-spinner fa-spin'></i> ";
        // line 417
        echo ($context["text_removing"] ?? null);
        echo "\"><i class=\"fa fa-minus-circle\"></i> ";
        echo ($context["button_remove"] ?? null);
        echo "</button>
\t\t\t\t<button type=\"button\" class=\"btn btn-success submit add\" data-form=\"#actionQuickEditForm\" data-context=\"#actionQuickEditModal\" data-vm=\"actionQuickEditVM\" data-loading-text=\"<i class='fa fa-spinner fa-spin'></i> ";
        // line 418
        echo ($context["text_adding"] ?? null);
        echo "\"><i class=\"fa fa-plus-circle\"></i> ";
        echo ($context["button_add"] ?? null);
        echo "</button>
\t\t\t\t<button type=\"button\" class=\"btn btn-primary submit\" data-form=\"#actionQuickEditForm\" data-context=\"#actionQuickEditModal\" data-vm=\"actionQuickEditVM\" data-loading-text=\"<i class='fa fa-spinner fa-spin'></i> ";
        // line 419
        echo ($context["text_saving"] ?? null);
        echo "\"><i class=\"fa fa-save\"></i> ";
        echo ($context["button_save"] ?? null);
        echo "</button>
\t\t\t</div>
\t\t</div><!-- /.modal-content -->
\t</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

";
        // line 425
        echo ($context["column_left"] ?? null);
        echo "
<div id=\"content\">
\t<div class=\"page-header\">
\t\t<div class=\"container-fluid\">
\t\t\t<div class=\"pull-right\">
\t\t\t\t<button type=\"button\" class=\"btn btn-default\" data-toggle=\"tooltip\" data-container=\"body\" data-placement=\"bottom\" title=\"";
        // line 430
        echo ($context["button_toggle_search_bar"] ?? null);
        echo "\" id=\"btn-search-bar\"><i class=\"fa fa-search-";
        echo ((($context["module_product_quick_edit_search_bar"] ?? null)) ? ("minus") : ("plus"));
        echo "\"></i></button>
\t\t\t\t<div class=\"btn-group\">
\t\t\t\t\t<button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-hover=\"tooltip\" title=\"";
        // line 432
        echo ($context["text_settings"] ?? null);
        echo "\" data-placement=\"left\" data-toggle=\"dropdown\" id=\"btn-settings\"><i class=\"fa fa-cog\"></i> <b class=\"caret\"></b></button>
\t\t\t\t\t<ul class=\"dropdown-menu\" role=\"menu\">
\t\t\t\t\t\t<li><a href=\"#\" data-toggle=\"modal\" data-target=\"#displayLengthModal\">";
        // line 434
        echo ($context["text_items_per_page"] ?? null);
        echo "</a></li>
\t\t\t\t\t\t<li><a href=\"#\" data-toggle=\"modal\" data-target=\"#pageColumnsModal\">";
        // line 435
        echo ($context["text_choose_columns"] ?? null);
        echo "</a></li>
\t\t\t\t\t\t<li class=\"divider\"></li>
\t\t\t\t\t\t<li><a href=\"#\" data-toggle=\"modal\" data-target=\"#otherSettingsModal\">";
        // line 437
        echo ($context["text_other_settings"] ?? null);
        echo "</a></li>
\t\t\t\t\t\t<li class=\"divider\"></li>
\t\t\t\t\t\t<li><a href=\"";
        // line 439
        echo ($context["clear_cache"] ?? null);
        echo "\" id=\"clearCache\">";
        echo ($context["text_clear_cache"] ?? null);
        echo "</a></li>
\t\t\t\t\t</ul>
\t\t\t\t</div>
\t\t\t\t<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"tooltip\" data-container=\"body\" data-placement=\"bottom\" title=\"";
        // line 442
        echo ($context["button_add"] ?? null);
        echo "\" data-url=\"";
        echo ($context["add"] ?? null);
        echo "\" id=\"btn-insert\" data-form=\"#pqe-list-form\" data-context=\"#content\"><i class=\"fa fa-plus\"></i></button>
\t\t\t\t<button type=\"button\" class=\"btn btn-default\" data-toggle=\"tooltip\" data-container=\"body\" data-placement=\"bottom\" title=\"";
        // line 443
        echo ($context["button_copy"] ?? null);
        echo "\" data-url=\"";
        echo ($context["copy"] ?? null);
        echo "\" id=\"btn-copy\" data-form=\"#pqe-list-form\" data-context=\"#content\" data-loading-text=\"<i class='fa fa-spinner fa-spin'></i>\" disabled><i class=\"fa fa-files-o\"></i></button>
\t\t\t\t<button type=\"button\" class=\"btn btn-danger\" data-toggle=\"tooltip\" data-container=\"body\" data-placement=\"bottom\" title=\"";
        // line 444
        echo ($context["button_delete"] ?? null);
        echo "\" data-url=\"";
        echo ($context["delete"] ?? null);
        echo "\" id=\"btn-delete\" data-form=\"#pqe-list-form\" data-context=\"#content\" data-loading-text=\"<i class='fa fa-spinner fa-spin'></i>\" disabled><i class=\"fa fa-trash-o\"></i></button>
\t\t\t</div>
\t\t\t<h1><i class=\"fa fa-cubes fa-fw ext-icon\"></i> ";
        // line 446
        echo ($context["heading_title"] ?? null);
        echo "</h1>
\t\t\t<ul class=\"breadcrumb\">
\t\t\t\t";
        // line 448
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 449
            echo "\t\t\t\t<li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 449);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 449);
            echo "</a></li>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 451
        echo "\t\t\t</ul>
\t\t</div>
\t</div>

\t<div class=\"alerts\">
\t\t<div class=\"container-fluid\" id=\"alerts\">
\t\t\t";
        // line 457
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["alerts"] ?? null));
        foreach ($context['_seq'] as $context["type"] => $context["_alerts"]) {
            // line 458
            echo "\t\t\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["_alerts"]);
            foreach ($context['_seq'] as $context["_key"] => $context["alert"]) {
                // line 459
                echo "\t\t\t\t\t";
                if ($context["alert"]) {
                    // line 460
                    echo "\t\t\t<div class=\"alert alert-";
                    if (($context["type"] == "error")) {
                        echo "danger";
                    } else {
                        echo $context["type"];
                    }
                    echo " fade in\">
\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
\t\t\t\t<i class=\"fa ";
                    // line 462
                    echo twig_call_macro($macros["_self"], "macro_alert_icon", [$context["type"]], 462, $context, $this->getSourceContext());
                    echo "\"></i>";
                    echo $context["alert"];
                    echo "
\t\t\t</div>
\t\t\t\t\t";
                }
                // line 465
                echo "\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['alert'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 466
            echo "\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['type'], $context['_alerts'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 467
        echo "\t\t</div>
\t</div>

\t<div class=\"container-fluid bull5i-content bull5i-container";
        // line 470
        echo (( !($context["module_product_quick_edit_search_bar"] ?? null)) ? (" hide") : (""));
        echo "\" id=\"search-bar\">
\t\t<div class=\"row navbar-bull5i\">
\t\t\t<div class=\"pull-right\">
\t\t\t\t<div class=\"nav navbar-nav navbar-checkbox hidden\" id=\"batch-edit-container\">
\t\t\t\t\t<div class=\"checkbox\">
\t\t\t\t\t\t<label>
\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"batch-edit\"> ";
        // line 476
        echo ($context["text_batch_edit"] ?? null);
        echo "
\t\t\t\t\t\t</label>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"nav navbar-nav navbar-form\" id=\"nav-search\">
\t\t\t\t\t<div class=\"form-group search-form\">
\t\t\t\t\t\t<label for=\"global-search\" class=\"sr-only\">";
        // line 482
        echo ($context["text_search"] ?? null);
        echo "</label>
\t\t\t\t\t\t<div class=\"search\">
\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t<input type=\"text\" name=\"search\" class=\"form-control\" placeholder=\"";
        // line 485
        echo ($context["text_search"] ?? null);
        echo "\" id=\"global-search\" value=\"";
        echo ($context["search"] ?? null);
        echo "\">
\t\t\t\t\t\t\t\t<span class=\"input-group-btn\">
\t\t\t\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-default\" data-toggle=\"tooltip\" data-container=\"body\" data-placement=\"bottom\" title=\"";
        // line 487
        echo ($context["text_search"] ?? null);
        echo "\" id=\"global-search-btn\"><i class=\"fa fa-search fa-fw\"></i></button>
\t\t\t\t\t\t\t\t\t<!-- ko if: value() != '' --><button type=\"button\" class=\"btn btn-default\" data-bind=\"tooltip: {container: 'body', placement: 'bottom'}\" title=\"";
        // line 488
        echo ($context["text_clear_search"] ?? null);
        echo "\" id=\"clear-global-search-btn\"><i class=\"fa fa-times fa-fw\"></i></button><!-- /ko -->
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>

\t<div class=\"container-fluid bull5i-content bull5i-container\">
\t\t<div id=\"dT_processing\" class=\"dataTables_processing fade\"><i class=\"fa fa-refresh fa-spin fa-5x\"></i></div>
\t\t<form method=\"post\" enctype=\"multipart/form-data\" id=\"pqe-list-form\" class=\"form-horizontal\" role=\"form\">
\t\t\t<fieldset>
\t\t\t\t<div class=\"table-responsive\">
\t\t\t\t\t<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table table-bordered table-condensed";
        // line 503
        echo ((($context["module_product_quick_edit_row_hover_highlighting"] ?? null)) ? (" table-hover") : (""));
        echo ((($context["module_product_quick_edit_alternate_row_colour"] ?? null)) ? (" table-striped") : (""));
        echo "\" id=\"dT\">
\t\t\t\t\t\t<thead>
\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t";
        // line 506
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["columns"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["col"]) {
            // line 507
            echo "\t\t\t\t\t\t\t\t\t";
            if (($context["col"] == "selector")) {
                // line 508
                echo "\t\t\t\t\t\t\t\t<th class=\"";
                echo twig_get_attribute($this->env, $this->source, (($__internal_compile_0 = ($context["column_info"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[$context["col"]] ?? null) : null), "align", [], "any", false, false, false, 508);
                echo " col_";
                echo $context["col"];
                echo "\" width=\"1\"><input type=\"checkbox\" id=\"dT-selector\" /></th>
\t\t\t\t\t\t\t\t\t";
            } elseif (twig_in_filter(            // line 509
$context["col"], [0 => "image", 1 => "id"])) {
                // line 510
                echo "\t\t\t\t\t\t\t\t<th class=\"";
                echo twig_get_attribute($this->env, $this->source, (($__internal_compile_1 = ($context["column_info"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[$context["col"]] ?? null) : null), "align", [], "any", false, false, false, 510);
                echo " col_";
                echo $context["col"];
                echo "\" width=\"1\">";
                echo twig_get_attribute($this->env, $this->source, (($__internal_compile_2 = ($context["column_info"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[$context["col"]] ?? null) : null), "name", [], "any", false, false, false, 510);
                echo "</th>
\t\t\t\t\t\t\t\t\t";
            } else {
                // line 512
                echo "\t\t\t\t\t\t\t\t<th class=\"";
                echo twig_get_attribute($this->env, $this->source, (($__internal_compile_3 = ($context["column_info"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[$context["col"]] ?? null) : null), "align", [], "any", false, false, false, 512);
                echo " col_";
                echo $context["col"];
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, (($__internal_compile_4 = ($context["column_info"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4[$context["col"]] ?? null) : null), "name", [], "any", false, false, false, 512);
                echo "</th>
\t\t\t\t\t\t\t\t\t";
            }
            // line 514
            echo "\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['col'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 515
        echo "\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t<tr class=\"filters\">
\t\t\t\t\t\t\t\t";
        // line 517
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["columns"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["col"]) {
            // line 518
            echo "\t\t\t\t\t\t\t\t\t";
            if (twig_in_filter($context["col"], [0 => "selector", 1 => "view_in_store", 2 => "gross_price"])) {
                // line 519
                echo "\t\t\t\t\t\t\t\t<th></th>
\t\t\t\t\t\t\t\t\t";
            } elseif ((            // line 520
$context["col"] == "status")) {
                // line 521
                echo "\t\t\t\t\t\t\t\t<th class=\"";
                echo twig_get_attribute($this->env, $this->source, (($__internal_compile_5 = ($context["column_info"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5[$context["col"]] ?? null) : null), "align", [], "any", false, false, false, 521);
                echo "\">
\t\t\t\t\t\t\t\t\t<select name=\"filter_";
                // line 522
                echo $context["col"];
                echo "\" class=\"form-control input-sm search_init fltr ";
                echo $context["col"];
                echo "\" data-column=\"";
                echo $context["col"];
                echo "\">
\t\t\t\t\t\t\t\t\t\t<option value=\"\" selected></option>
\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
                // line 524
                echo ($context["text_enabled"] ?? null);
                echo "</option>
\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
                // line 525
                echo ($context["text_disabled"] ?? null);
                echo "</option>
\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t</th>
\t\t\t\t\t\t\t\t\t";
            } elseif (twig_in_filter(            // line 528
$context["col"], [0 => "image", 1 => "subtract", 2 => "shipping"])) {
                // line 529
                echo "\t\t\t\t\t\t\t\t<th class=\"";
                echo twig_get_attribute($this->env, $this->source, (($__internal_compile_6 = ($context["column_info"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6[$context["col"]] ?? null) : null), "align", [], "any", false, false, false, 529);
                echo "\">
\t\t\t\t\t\t\t\t\t<select name=\"filter_";
                // line 530
                echo $context["col"];
                echo "\" class=\"form-control input-sm search_init fltr ";
                echo $context["col"];
                echo "\" data-column=\"";
                echo $context["col"];
                echo "\">
\t\t\t\t\t\t\t\t\t\t<option value=\"\" selected></option>
\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
                // line 532
                echo ($context["text_yes"] ?? null);
                echo "</option>
\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
                // line 533
                echo ($context["text_no"] ?? null);
                echo "</option>
\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t</th>
\t\t\t\t\t\t\t\t\t";
            } elseif ((            // line 536
$context["col"] == "action")) {
                // line 537
                echo "\t\t\t\t\t\t\t\t<th class=\"";
                echo twig_get_attribute($this->env, $this->source, (($__internal_compile_7 = ($context["column_info"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7[$context["col"]] ?? null) : null), "align", [], "any", false, false, false, 537);
                echo "\">
\t\t\t\t\t\t\t\t\t<div class=\"btn-group btn-group-flex\">
\t\t\t\t\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-sm btn-default\" id=\"filter\" data-toggle=\"tooltip\" data-container=\"body\" title=\"";
                // line 539
                echo ($context["text_filter"] ?? null);
                echo "\"><i class=\"fa fa-filter fa-fw\"></i></button>
\t\t\t\t\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-sm btn-default\" id=\"clear-filter\" data-toggle=\"tooltip\" data-container=\"body\" title=\"";
                // line 540
                echo ($context["text_clear_filter"] ?? null);
                echo "\"><i class=\"fa fa-times fa-fw\"></i></button>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</th>
\t\t\t\t\t\t\t\t\t";
            } elseif ((            // line 543
$context["col"] == "manufacturer")) {
                // line 544
                echo "\t\t\t\t\t\t\t\t\t";
                if (twig_in_filter($context["col"], twig_get_array_keys_filter(($context["typeahead"] ?? null)))) {
                    // line 545
                    echo "\t\t\t\t\t\t\t\t<th class=\"";
                    echo twig_get_attribute($this->env, $this->source, (($__internal_compile_8 = ($context["column_info"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8[$context["col"]] ?? null) : null), "align", [], "any", false, false, false, 545);
                    echo "\">
\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control input-sm fltr ";
                    // line 546
                    echo $context["col"];
                    echo " typeahead id_based\" placeholder=\"";
                    echo ($context["text_autocomplete"] ?? null);
                    echo "\">
\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"filter_";
                    // line 547
                    echo $context["col"];
                    echo "\" class=\"search_init fltr ";
                    echo $context["col"];
                    echo "\" data-column=\"";
                    echo $context["col"];
                    echo "\">
\t\t\t\t\t\t\t\t</th>
\t\t\t\t\t\t\t\t\t";
                } else {
                    // line 550
                    echo "\t\t\t\t\t\t\t\t<th class=\"";
                    echo twig_get_attribute($this->env, $this->source, (($__internal_compile_9 = ($context["column_info"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9[$context["col"]] ?? null) : null), "align", [], "any", false, false, false, 550);
                    echo "\">
\t\t\t\t\t\t\t\t\t<select name=\"filter_";
                    // line 551
                    echo $context["col"];
                    echo "\" class=\"form-control input-sm search_init fltr ";
                    echo $context["col"];
                    echo "\" data-column=\"";
                    echo $context["col"];
                    echo "\">
\t\t\t\t\t\t\t\t\t\t<option value=\"\" selected></option>
\t\t\t\t\t\t\t\t\t\t<option value=\"*\">";
                    // line 553
                    echo ($context["text_none"] ?? null);
                    echo "</option>
\t\t\t\t\t\t\t\t\t\t";
                    // line 554
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(($context["manufacturers"] ?? null));
                    foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
                        // line 555
                        echo "\t\t\t\t\t\t\t\t\t\t<option value=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["m"], "manufacturer_id", [], "any", false, false, false, 555);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["m"], "name", [], "any", false, false, false, 555);
                        echo "</option>
\t\t\t\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 557
                    echo "\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t</th>
\t\t\t\t\t\t\t\t\t";
                }
                // line 560
                echo "\t\t\t\t\t\t\t\t\t";
            } elseif (($context["col"] == "category")) {
                // line 561
                echo "\t\t\t\t\t\t\t\t\t";
                if (twig_in_filter($context["col"], twig_get_array_keys_filter(($context["typeahead"] ?? null)))) {
                    // line 562
                    echo "\t\t\t\t\t\t\t\t<th class=\"";
                    echo twig_get_attribute($this->env, $this->source, (($__internal_compile_10 = ($context["column_info"] ?? null)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10[$context["col"]] ?? null) : null), "align", [], "any", false, false, false, 562);
                    echo "\">
\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control input-sm fltr ";
                    // line 563
                    echo $context["col"];
                    echo " typeahead id_based\" placeholder=\"";
                    echo ($context["text_autocomplete"] ?? null);
                    echo "\">
\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"filter_";
                    // line 564
                    echo $context["col"];
                    echo "\" class=\"search_init fltr ";
                    echo $context["col"];
                    echo "\" data-column=\"";
                    echo $context["col"];
                    echo "\">
\t\t\t\t\t\t\t\t</th>
\t\t\t\t\t\t\t\t\t";
                } else {
                    // line 567
                    echo "\t\t\t\t\t\t\t\t<th class=\"";
                    echo twig_get_attribute($this->env, $this->source, (($__internal_compile_11 = ($context["column_info"] ?? null)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11[$context["col"]] ?? null) : null), "align", [], "any", false, false, false, 567);
                    echo "\">
\t\t\t\t\t\t\t\t\t<select name=\"filter_";
                    // line 568
                    echo $context["col"];
                    echo "\" class=\"form-control input-sm search_init fltr ";
                    echo $context["col"];
                    echo "\" data-column=\"";
                    echo $context["col"];
                    echo "\">
\t\t\t\t\t\t\t\t\t\t<option value=\"\" selected></option>
\t\t\t\t\t\t\t\t\t\t<option value=\"*\">";
                    // line 570
                    echo ($context["text_none"] ?? null);
                    echo "</option>
\t\t\t\t\t\t\t\t\t\t";
                    // line 571
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
                    foreach ($context['_seq'] as $context["_key"] => $context["c"]) {
                        // line 572
                        echo "\t\t\t\t\t\t\t\t\t\t<option value=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["c"], "category_id", [], "any", false, false, false, 572);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["c"], "name", [], "any", false, false, false, 572);
                        echo "</option>
\t\t\t\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['c'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 574
                    echo "\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t</th>
\t\t\t\t\t\t\t\t\t";
                }
                // line 577
                echo "\t\t\t\t\t\t\t\t\t";
            } elseif (($context["col"] == "download")) {
                // line 578
                echo "\t\t\t\t\t\t\t\t\t";
                if (twig_in_filter($context["col"], twig_get_array_keys_filter(($context["typeahead"] ?? null)))) {
                    // line 579
                    echo "\t\t\t\t\t\t\t\t<th class=\"";
                    echo twig_get_attribute($this->env, $this->source, (($__internal_compile_12 = ($context["column_info"] ?? null)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12[$context["col"]] ?? null) : null), "align", [], "any", false, false, false, 579);
                    echo "\">
\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control input-sm fltr ";
                    // line 580
                    echo $context["col"];
                    echo " typeahead id_based\" placeholder=\"";
                    echo ($context["text_autocomplete"] ?? null);
                    echo "\">
\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"filter_";
                    // line 581
                    echo $context["col"];
                    echo "\" class=\"search_init fltr ";
                    echo $context["col"];
                    echo "\" data-column=\"";
                    echo $context["col"];
                    echo "\">
\t\t\t\t\t\t\t\t</th>
\t\t\t\t\t\t\t\t\t";
                } else {
                    // line 584
                    echo "\t\t\t\t\t\t\t\t<th class=\"";
                    echo twig_get_attribute($this->env, $this->source, (($__internal_compile_13 = ($context["column_info"] ?? null)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13[$context["col"]] ?? null) : null), "align", [], "any", false, false, false, 584);
                    echo "\">
\t\t\t\t\t\t\t\t\t<select name=\"filter_";
                    // line 585
                    echo $context["col"];
                    echo "\" class=\"form-control input-sm search_init fltr ";
                    echo $context["col"];
                    echo "\" data-column=\"";
                    echo $context["col"];
                    echo "\">
\t\t\t\t\t\t\t\t\t\t<option value=\"\" selected></option>
\t\t\t\t\t\t\t\t\t\t<option value=\"*\">";
                    // line 587
                    echo ($context["text_none"] ?? null);
                    echo "</option>
\t\t\t\t\t\t\t\t\t\t";
                    // line 588
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(($context["downloads"] ?? null));
                    foreach ($context['_seq'] as $context["_key"] => $context["dl"]) {
                        // line 589
                        echo "\t\t\t\t\t\t\t\t\t\t<option value=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["dl"], "download_id", [], "any", false, false, false, 589);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["dl"], "name", [], "any", false, false, false, 589);
                        echo "</option>
\t\t\t\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['dl'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 591
                    echo "\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t</th>
\t\t\t\t\t\t\t\t\t";
                }
                // line 594
                echo "\t\t\t\t\t\t\t\t\t";
            } elseif (($context["col"] == "filter")) {
                // line 595
                echo "\t\t\t\t\t\t\t\t\t";
                if (twig_in_filter($context["col"], twig_get_array_keys_filter(($context["typeahead"] ?? null)))) {
                    // line 596
                    echo "\t\t\t\t\t\t\t\t<th class=\"";
                    echo twig_get_attribute($this->env, $this->source, (($__internal_compile_14 = ($context["column_info"] ?? null)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14[$context["col"]] ?? null) : null), "align", [], "any", false, false, false, 596);
                    echo "\">
\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control input-sm fltr ";
                    // line 597
                    echo $context["col"];
                    echo " typeahead id_based\" placeholder=\"";
                    echo ($context["text_autocomplete"] ?? null);
                    echo "\">
\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"filter_";
                    // line 598
                    echo $context["col"];
                    echo "\" class=\"search_init fltr ";
                    echo $context["col"];
                    echo "\" data-column=\"";
                    echo $context["col"];
                    echo "\">
\t\t\t\t\t\t\t\t</th>
\t\t\t\t\t\t\t\t\t";
                } else {
                    // line 601
                    echo "\t\t\t\t\t\t\t\t<th class=\"";
                    echo twig_get_attribute($this->env, $this->source, (($__internal_compile_15 = ($context["column_info"] ?? null)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15[$context["col"]] ?? null) : null), "align", [], "any", false, false, false, 601);
                    echo "\">
\t\t\t\t\t\t\t\t\t<select name=\"filter_";
                    // line 602
                    echo $context["col"];
                    echo "\" class=\"form-control input-sm search_init fltr ";
                    echo $context["col"];
                    echo "\" data-column=\"";
                    echo $context["col"];
                    echo "\">
\t\t\t\t\t\t\t\t\t\t<option value=\"\" selected></option>
\t\t\t\t\t\t\t\t\t\t<option value=\"*\">";
                    // line 604
                    echo ($context["text_none"] ?? null);
                    echo "</option>
\t\t\t\t\t\t\t\t\t\t";
                    // line 605
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(($context["filters"] ?? null));
                    foreach ($context['_seq'] as $context["_key"] => $context["fg"]) {
                        // line 606
                        echo "\t\t\t\t\t\t\t\t\t\t<optgroup label=\"";
                        echo addslashes(twig_get_attribute($this->env, $this->source, $context["fg"], "name", [], "any", false, false, false, 606));
                        echo "\">
\t\t\t\t\t\t\t\t\t\t";
                        // line 607
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["fg"], "filters", [], "any", false, false, false, 607));
                        foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
                            // line 608
                            echo "\t\t\t\t\t\t\t\t\t\t\t<option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["f"], "filter_id", [], "any", false, false, false, 608);
                            echo "\">";
                            echo twig_get_attribute($this->env, $this->source, $context["f"], "name", [], "any", false, false, false, 608);
                            echo "</option>
\t\t\t\t\t\t\t\t\t\t";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['f'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 610
                        echo "\t\t\t\t\t\t\t\t\t\t</optgroup>
\t\t\t\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['fg'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 612
                    echo "\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t</th>
\t\t\t\t\t\t\t\t\t";
                }
                // line 615
                echo "\t\t\t\t\t\t\t\t\t";
            } elseif (($context["col"] == "store")) {
                // line 616
                echo "\t\t\t\t\t\t\t\t<th class=\"";
                echo twig_get_attribute($this->env, $this->source, (($__internal_compile_16 = ($context["column_info"] ?? null)) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16[$context["col"]] ?? null) : null), "align", [], "any", false, false, false, 616);
                echo "\">
\t\t\t\t\t\t\t\t\t<select name=\"filter_";
                // line 617
                echo $context["col"];
                echo "\" class=\"form-control input-sm search_init fltr ";
                echo $context["col"];
                echo "\" data-column=\"";
                echo $context["col"];
                echo "\">
\t\t\t\t\t\t\t\t\t\t<option value=\"\" selected></option>
\t\t\t\t\t\t\t\t\t\t<option value=\"*\">";
                // line 619
                echo ($context["text_none"] ?? null);
                echo "</option>
\t\t\t\t\t\t\t\t\t\t";
                // line 620
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["s"]) {
                    // line 621
                    echo "\t\t\t\t\t\t\t\t\t\t<option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["s"], "store_id", [], "any", false, false, false, 621);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["s"], "name", [], "any", false, false, false, 621);
                    echo "</option>
\t\t\t\t\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['s'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 623
                echo "\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t</th>
\t\t\t\t\t\t\t\t\t";
            } elseif ((            // line 625
$context["col"] == "length_class")) {
                // line 626
                echo "\t\t\t\t\t\t\t\t<th class=\"";
                echo twig_get_attribute($this->env, $this->source, (($__internal_compile_17 = ($context["column_info"] ?? null)) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17[$context["col"]] ?? null) : null), "align", [], "any", false, false, false, 626);
                echo "\">
\t\t\t\t\t\t\t\t\t<select name=\"filter_";
                // line 627
                echo $context["col"];
                echo "\" class=\"form-control input-sm search_init fltr ";
                echo $context["col"];
                echo "\" data-column=\"";
                echo $context["col"];
                echo "\">
\t\t\t\t\t\t\t\t\t\t<option value=\"\" selected></option>
\t\t\t\t\t\t\t\t\t\t";
                // line 629
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["length_classes"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["lc"]) {
                    // line 630
                    echo "\t\t\t\t\t\t\t\t\t\t<option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["lc"], "length_class_id", [], "any", false, false, false, 630);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["lc"], "title", [], "any", false, false, false, 630);
                    echo "</option>
\t\t\t\t\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['lc'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 632
                echo "\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t</th>
\t\t\t\t\t\t\t\t\t";
            } elseif ((            // line 634
$context["col"] == "weight_class")) {
                // line 635
                echo "\t\t\t\t\t\t\t\t<th class=\"";
                echo twig_get_attribute($this->env, $this->source, (($__internal_compile_18 = ($context["column_info"] ?? null)) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18[$context["col"]] ?? null) : null), "align", [], "any", false, false, false, 635);
                echo "\">
\t\t\t\t\t\t\t\t\t<select name=\"filter_";
                // line 636
                echo $context["col"];
                echo "\" class=\"form-control input-sm search_init fltr ";
                echo $context["col"];
                echo "\" data-column=\"";
                echo $context["col"];
                echo "\">
\t\t\t\t\t\t\t\t\t\t<option value=\"\" selected></option>
\t\t\t\t\t\t\t\t\t\t";
                // line 638
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["weight_classes"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["wc"]) {
                    // line 639
                    echo "\t\t\t\t\t\t\t\t\t\t<option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["wc"], "weight_class_id", [], "any", false, false, false, 639);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["wc"], "title", [], "any", false, false, false, 639);
                    echo "</option>
\t\t\t\t\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['wc'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 641
                echo "\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t</th>
\t\t\t\t\t\t\t\t\t";
            } elseif ((            // line 643
$context["col"] == "stock_status")) {
                // line 644
                echo "\t\t\t\t\t\t\t\t<th class=\"";
                echo twig_get_attribute($this->env, $this->source, (($__internal_compile_19 = ($context["column_info"] ?? null)) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19[$context["col"]] ?? null) : null), "align", [], "any", false, false, false, 644);
                echo "\">
\t\t\t\t\t\t\t\t\t<select name=\"filter_";
                // line 645
                echo $context["col"];
                echo "\" class=\"form-control input-sm search_init fltr ";
                echo $context["col"];
                echo "\" data-column=\"";
                echo $context["col"];
                echo "\">
\t\t\t\t\t\t\t\t\t\t<option value=\"\" selected></option>
\t\t\t\t\t\t\t\t\t\t";
                // line 647
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["stock_statuses"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["ss"]) {
                    // line 648
                    echo "\t\t\t\t\t\t\t\t\t\t<option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["ss"], "stock_status_id", [], "any", false, false, false, 648);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["ss"], "name", [], "any", false, false, false, 648);
                    echo "</option>
\t\t\t\t\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ss'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 650
                echo "\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t</th>
\t\t\t\t\t\t\t\t\t";
            } elseif ((            // line 652
$context["col"] == "tax_class")) {
                // line 653
                echo "\t\t\t\t\t\t\t\t<th class=\"";
                echo twig_get_attribute($this->env, $this->source, (($__internal_compile_20 = ($context["column_info"] ?? null)) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20[$context["col"]] ?? null) : null), "align", [], "any", false, false, false, 653);
                echo "\">
\t\t\t\t\t\t\t\t\t<select name=\"filter_";
                // line 654
                echo $context["col"];
                echo "\" class=\"form-control input-sm search_init fltr ";
                echo $context["col"];
                echo "\" data-column=\"";
                echo $context["col"];
                echo "\">
\t\t\t\t\t\t\t\t\t\t<option value=\"\" selected></option>
\t\t\t\t\t\t\t\t\t\t<option value=\"*\">";
                // line 656
                echo ($context["text_none"] ?? null);
                echo "</option>
\t\t\t\t\t\t\t\t\t\t";
                // line 657
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["tax_classes"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["tc"]) {
                    // line 658
                    echo "\t\t\t\t\t\t\t\t\t\t<option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["tc"], "tax_class_id", [], "any", false, false, false, 658);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["tc"], "title", [], "any", false, false, false, 658);
                    echo "</option>
\t\t\t\t\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tc'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 660
                echo "\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t</th>
\t\t\t\t\t\t\t\t\t";
            } elseif ((            // line 662
$context["col"] == "price")) {
                // line 663
                echo "\t\t\t\t\t\t\t\t<th class=\"";
                echo twig_get_attribute($this->env, $this->source, (($__internal_compile_21 = ($context["column_info"] ?? null)) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21[$context["col"]] ?? null) : null), "align", [], "any", false, false, false, 663);
                echo "\">
\t\t\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"filter_";
                // line 665
                echo $context["col"];
                echo "\" class=\"form-control input-sm search_init fltr ";
                echo $context["col"];
                echo "\" id=\"filter_price\" data-column=\"";
                echo $context["col"];
                echo "\">
\t\t\t\t\t\t\t\t\t\t<input type=\"hidden\" value=\"\" id=\"filter_special_price\">
\t\t\t\t\t\t\t\t\t\t<div class=\"input-group-btn\" data-toggle=\"buttons\">
\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-default btn-sm dropdown-toggle\" data-toggle=\"dropdown\" tabindex=\"-1\">
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"caret\"></span>
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"sr-only\">";
                // line 670
                echo ($context["text_toggle_dropdown"] ?? null);
                echo "</span>
\t\t\t\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t\t\t\t\t<ul class=\"dropdown-menu text-left pull-right price\" role=\"menu\">
\t\t\t\t\t\t\t\t\t\t\t\t<li class=\"active\"><a href=\"#\" class=\"filter-special-price\" data-value=\"\" id=\"special-price-off\"><i class=\"fa fa-fw fa-check\"></i> ";
                // line 673
                echo ($context["text_special_off"] ?? null);
                echo "</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\" class=\"filter-special-price\" data-value=\"na\"><i class=\"fa fa-fw\"></i> ";
                // line 674
                echo ($context["text_special_not_available"] ?? null);
                echo "</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\" class=\"filter-special-price\" data-value=\"active\"><i class=\"fa fa-fw\"></i> ";
                // line 675
                echo ($context["text_special_active"] ?? null);
                echo "</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\" class=\"filter-special-price\" data-value=\"expired\"><i class=\"fa fa-fw\"></i> ";
                // line 676
                echo ($context["text_special_expired"] ?? null);
                echo "</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\" class=\"filter-special-price\" data-value=\"future\"><i class=\"fa fa-fw\"></i> ";
                // line 677
                echo ($context["text_special_future"] ?? null);
                echo "</a></li>
\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</th>
\t\t\t\t\t\t\t\t\t";
            } elseif (twig_in_filter(            // line 682
$context["col"], [0 => "name", 1 => "model", 2 => "sku", 3 => "upc", 4 => "ean", 5 => "jan", 6 => "isbn", 7 => "mpn", 8 => "location"])) {
                // line 683
                echo "\t\t\t\t\t\t\t\t<th class=\"";
                echo twig_get_attribute($this->env, $this->source, (($__internal_compile_22 = ($context["column_info"] ?? null)) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22[$context["col"]] ?? null) : null), "align", [], "any", false, false, false, 683);
                echo "\"><input type=\"text\" name=\"filter_";
                echo $context["col"];
                echo "\" class=\"form-control input-sm search_init fltr ";
                echo $context["col"];
                echo " typeahead\" placeholder=\"";
                echo ($context["text_autocomplete"] ?? null);
                echo "\" data-column=\"";
                echo $context["col"];
                echo "\"></th>
\t\t\t\t\t\t\t\t\t";
            } else {
                // line 685
                echo "\t\t\t\t\t\t\t\t<th class=\"";
                echo twig_get_attribute($this->env, $this->source, (($__internal_compile_23 = ($context["column_info"] ?? null)) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23[$context["col"]] ?? null) : null), "align", [], "any", false, false, false, 685);
                echo "\"><input type=\"text\" name=\"filter_";
                echo $context["col"];
                echo "\" class=\"form-control input-sm search_init fltr ";
                echo $context["col"];
                echo "\" data-column=\"";
                echo $context["col"];
                echo "\"></th>
\t\t\t\t\t\t\t\t\t";
            }
            // line 687
            echo "\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['col'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 688
        echo "\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t</thead>
\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t</tbody>
\t\t\t\t\t</table>
\t\t\t\t</div>
\t\t\t</fieldset>
\t\t</form>
\t</div>

</div>
<div class=\"row-fluid\"><div class=\"col-xs-12 text-center\"><small class=\"text-muted\" id=\"ajax-request-container\"></small></div></div>
<div class=\"row-fluid\"><div class=\"col-xs-12 text-center\"><small class=\"text-muted\">";
        // line 700
        echo ($context["text_page_created"] ?? null);
        echo "</small></div></div>
<script type=\"text/javascript\"><!--
(function(bull5i,\$,undefined){var errors=";
        // line 702
        echo json_encode(($context["errors"] ?? null));
        echo ",related=";
        echo json_encode(($context["related"] ?? null));
        echo ",active_filters=";
        echo json_encode(($context["active_filters"] ?? null));
        echo ",values={displayLengthModal:{module_product_quick_edit_items_per_page:parseInt(\"";
        echo (($context["items_per_page"] ?? null) * 1);
        echo "\")},otherSettingsModal:{module_product_quick_edit_list_view_image_width:parseInt(\"";
        echo (($context["module_product_quick_edit_list_view_image_width"] ?? null) * 1);
        echo "\"),module_product_quick_edit_list_view_image_height:parseInt(\"";
        echo (($context["module_product_quick_edit_list_view_image_height"] ?? null) * 1);
        echo "\"),module_product_quick_edit_quick_edit_on:\"";
        echo addslashes(($context["module_product_quick_edit_quick_edit_on"] ?? null));
        echo "\",module_product_quick_edit_price_relative_to:\"";
        echo addslashes(($context["module_product_quick_edit_price_relative_to"] ?? null));
        echo "\",module_product_quick_edit_server_side_caching:\"";
        echo ($context["module_product_quick_edit_server_side_caching"] ?? null);
        echo "\",module_product_quick_edit_client_side_caching:\"";
        echo ($context["module_product_quick_edit_client_side_caching"] ?? null);
        echo "\",module_product_quick_edit_cache_size:parseInt(\"";
        echo ((($context["module_product_quick_edit_cache_size"] ?? null)) ? (($context["module_product_quick_edit_cache_size"] ?? null)) : ("1000"));
        echo "\"),module_product_quick_edit_alternate_row_colour:\"";
        echo ($context["module_product_quick_edit_alternate_row_colour"] ?? null);
        echo "\",module_product_quick_edit_row_hover_highlighting:\"";
        echo ($context["module_product_quick_edit_row_hover_highlighting"] ?? null);
        echo "\",module_product_quick_edit_highlight_status:\"";
        echo ($context["module_product_quick_edit_highlight_status"] ?? null);
        echo "\",module_product_quick_edit_highlight_filtered_columns:\"";
        echo ($context["module_product_quick_edit_highlight_filtered_columns"] ?? null);
        echo "\",module_product_quick_edit_highlight_actions:\"";
        echo ($context["module_product_quick_edit_highlight_actions"] ?? null);
        echo "\",module_product_quick_edit_filter_sub_category:\"";
        echo ($context["module_product_quick_edit_filter_sub_category"] ?? null);
        echo "\",module_product_quick_edit_debug_mode:\"";
        echo (($context["module_product_quick_edit_debug_mode"] ?? null) * 1);
        echo "\",module_product_quick_edit_search_bar:\"";
        echo (($context["module_product_quick_edit_search_bar"] ?? null) * 1);
        echo "\",module_product_quick_edit_batch_edit:\"";
        echo (($context["module_product_quick_edit_batch_edit"] ?? null) * 1);
        echo "\",module_product_quick_edit_show_success_message:\"";
        echo (($context["module_product_quick_edit_show_success_message"] ?? null) * 1);
        echo "\",module_product_quick_edit_default_sort:\"";
        echo ($context["module_product_quick_edit_default_sort"] ?? null);
        echo "\",module_product_quick_edit_default_order:\"";
        echo ($context["module_product_quick_edit_default_order"] ?? null);
        echo "\"},pageColumnsModal:{product_actions:";
        echo json_encode(($context["product_actions"] ?? null));
        echo ",product_columns:";
        echo json_encode(($context["product_columns"] ?? null));
        echo "},search:{value:\"";
        echo addslashes(($context["search"] ?? null));
        echo "\"}},ta_sources=[];bull5i.user_token=\"";
        echo ($context["user_token"] ?? null);
        echo "\",bull5i.debugging=!!parseInt(\"";
        echo (($context["module_product_quick_edit_debug_mode"] ?? null) * 1);
        echo "\"),bull5i.clearCache=parseInt(\"";
        echo (($context["clear_dt_cache"] ?? null) * 1);
        echo "\"),bull5i.highlight_filtered_columns=parseInt(values.otherSettingsModal.module_product_quick_edit_highlight_filtered_columns),bull5i.texts=\$.extend({},bull5i.texts,{text_request_handled:\"";
        echo addslashes(($context["text_request_handled"] ?? null));
        echo "\",error_ajax_request:\"";
        echo addslashes(($context["error_ajax_request"] ?? null));
        echo "\",error_items_per_page:\"";
        echo addslashes(($context["error_items_per_page"] ?? null));
        echo "\",error_image_width:\"";
        echo addslashes(($context["error_image_width"] ?? null));
        echo "\",error_image_height:\"";
        echo addslashes(($context["error_image_height"] ?? null));
        echo "\",error_cache_size:\"";
        echo addslashes(($context["error_cache_size"] ?? null));
        echo "\"});var Column=function(e,i,t,a,s){this.column=e,this.index=ko.observable(i),this.name=t,this.editable=ko.observable(s),this.visible=ko.observable(a)},displayLengthModalViewModel=function(){var e=this;validate_items_per_page=function(e){isNaN(parseInt(e))||0==parseInt(e)||parseInt(e)<-1?(this.target.hasError(!0),this.target.errorMsg(this.message)):(this.target.hasError(!1),this.target.errorMsg(\"\"))},this.module_product_quick_edit_items_per_page=ko.observable(0).extend({numeric:{precision:0,context:e},validate:{message:bull5i.texts.error_items_per_page,context:e,method:validate_items_per_page}}),this.module_product_quick_edit_items_per_page.subscribe(function(e){void 0!=bull5i.dtApi&&bull5i.dtApi.page.len(parseInt(e))})};displayLengthModalViewModel.prototype=new bull5i.observable_object_methods;var otherSettingsModalViewModel=function(){var e=this;validate_image_size=function(e){isNaN(parseInt(e))||parseInt(e)<1?(this.target.hasError(!0),this.target.errorMsg(this.message)):(this.target.hasError(!1),this.target.errorMsg(\"\"))},validate_cache_size=function(e){isNaN(parseInt(e))||parseInt(e)<1||bull5i.view_models&&bull5i.view_models.displayLengthVM&&bull5i.view_models.displayLengthVM.module_product_quick_edit_items_per_page()>0&&parseInt(e)<bull5i.view_models.displayLengthVM.module_product_quick_edit_items_per_page()?(this.target.hasError(!0),this.target.errorMsg(this.message)):(this.target.hasError(!1),this.target.errorMsg(\"\"))},this.module_product_quick_edit_list_view_image_width=ko.observable(40).extend({numeric:{precision:0,context:e},validate:{message:bull5i.texts.error_image_width,context:e,method:validate_image_size}}),this.module_product_quick_edit_list_view_image_height=ko.observable(40).extend({numeric:{precision:0,context:e},validate:{message:bull5i.texts.error_image_height,context:e,method:validate_image_size}}),this.module_product_quick_edit_quick_edit_on=ko.observable(\"click\"),this.module_product_quick_edit_price_relative_to=ko.observable(\"previous\"),this.module_product_quick_edit_server_side_caching=ko.observable(\"0\"),this.module_product_quick_edit_client_side_caching=ko.observable(\"0\"),this.module_product_quick_edit_cache_size=ko.observable(0).extend({numeric:{precision:0,context:e},validate:{message:bull5i.texts.error_cache_size,context:e,method:validate_cache_size}}),this.module_product_quick_edit_alternate_row_colour=ko.observable(\"0\"),this.module_product_quick_edit_row_hover_highlighting=ko.observable(\"0\"),this.module_product_quick_edit_highlight_status=ko.observable(\"0\"),this.module_product_quick_edit_highlight_filtered_columns=ko.observable(\"0\"),this.module_product_quick_edit_highlight_actions=ko.observable(\"0\"),this.module_product_quick_edit_filter_sub_category=ko.observable(\"0\"),this.module_product_quick_edit_debug_mode=ko.observable(0),this.module_product_quick_edit_search_bar=ko.observable(\"1\"),this.module_product_quick_edit_batch_edit=ko.observable(\"0\"),this.module_product_quick_edit_show_success_message=ko.observable(\"1\"),this.module_product_quick_edit_default_sort=ko.observable(\"pd.name\"),this.module_product_quick_edit_default_order=ko.observable(\"ASC\"),this.module_product_quick_edit_list_view_image_width.subscribe(function(){void 0!=bull5i.dtApi&&bull5i.dtApi.clearPipeline()}),this.module_product_quick_edit_list_view_image_height.subscribe(function(){void 0!=bull5i.dtApi&&bull5i.dtApi.clearPipeline()}),this.module_product_quick_edit_debug_mode.subscribe(function(e){bull5i.debugging=!!parseInt(e)}),this.module_product_quick_edit_alternate_row_colour.subscribe(function(e){var i=\$(\"#dT\");parseInt(e)?i.addClass(\"table-striped\"):i.removeClass(\"table-striped\")}),this.module_product_quick_edit_row_hover_highlighting.subscribe(function(e){var i=\$(\"#dT\");parseInt(e)?i.addClass(\"table-hover\"):i.removeClass(\"table-hover\")}),this.module_product_quick_edit_search_bar.subscribe(function(s){var a=\$(\"#search-bar\"),e=\$(\"#btn-search-bar i.fa\");parseInt(s)?(a.removeClass(\"hide\"),e.removeClass(\"fa-search-plus\").addClass(\"fa-search-minus\")):(a.addClass(\"hide\"),e.removeClass(\"fa-search-minus\").addClass(\"fa-search-plus\"))}),this.module_product_quick_edit_batch_edit.subscribe(function(t){\$(\"#batch-edit\").prop(\"checked\",!!parseInt(t))}),this.module_product_quick_edit_highlight_status.subscribe(function(){void 0!=bull5i.dtApi&&bull5i.dtApi.clearPipeline()}),this.module_product_quick_edit_highlight_filtered_columns.subscribe(function(e){bull5i.highlight_filtered_columns=parseInt(e)}),this.module_product_quick_edit_highlight_actions.subscribe(function(){void 0!=bull5i.dtApi&&bull5i.dtApi.clearPipeline()}),this.module_product_quick_edit_filter_sub_category.subscribe(function(){void 0!=bull5i.dtApi&&bull5i.dtApi.clearPipeline()})};otherSettingsModalViewModel.prototype=new bull5i.observable_object_methods;var pageColumnsModalViewModel=function(){var e=this;this.product_actions=ko.observableArray([]),this.product_columns=ko.observableArray([]),e.updateValues=function(i){for(var t in e)ko.isWriteableObservable(e[t])&&i.hasOwnProperty(t)&&e[t](\$.map(i[t],function(e,i){return new Column(i,e.hasOwnProperty(\"index\")?e.index:0,e.hasOwnProperty(\"name\")?e.name:\"<unknown>\",e.hasOwnProperty(\"display\")?e.display:1,e.hasOwnProperty(\"editable\")?e.editable:1)}))}},searchViewModel=function(){var e=this;this.value=ko.observable(\"\"),e.updateValues=function(i){for(var t in e)ko.isWriteableObservable(e[t])&&i.hasOwnProperty(t)&&(\"function\"==typeof e[t].updateValues?e[t].updateValues(i[t]):e[t](i[t]))},e.setSearch=function(i){e.value(i)}};bull5i.view_models=\$.extend({},bull5i.view_models,{displayLengthVM:new displayLengthModalViewModel,otherSettingsVM:new otherSettingsModalViewModel,pageColumnsVM:new pageColumnsModalViewModel,searchVM:new searchViewModel}),bull5i.view_models.displayLengthVM.updateValues(values.displayLengthModal),bull5i.view_models.displayLengthVM.applyErrors(errors),bull5i.view_models.otherSettingsVM.updateValues(values.otherSettingsModal),bull5i.view_models.otherSettingsVM.applyErrors(errors),bull5i.view_models.pageColumnsVM.updateValues(values.pageColumnsModal),bull5i.view_models.searchVM.updateValues(values.search),ko.applyBindings(bull5i.view_models.displayLengthVM,\$(\"#displayLengthModal\")[0]),ko.applyBindings(bull5i.view_models.otherSettingsVM,\$(\"#otherSettingsModal\")[0]),ko.applyBindings(bull5i.view_models.pageColumnsVM,\$(\"#pageColumnsModal\")[0]),ko.applyBindings(bull5i.view_models.searchVM,\$(\"#nav-search\")[0]),\$(\".sortable\").sortable({containerSelector:\"table\",itemPath:\"> tbody\",itemSelector:\"tr\",placeholder:'<tr class=\"placeholder\"/>',distance:5,onDragStart:function(e){e.children().each(function(){\$(this).width(\$(this).width())}),e.addClass(\"dragged\"),\$(\"body\").addClass(\"dragging\")},onDrag:function(e,i){i.left=0,e.css(i)},onDrop:function(e,i){e.children().each(function(){\$(this).removeAttr(\"style\")}),e.removeClass(\"dragged\").removeAttr(\"style\"),\$(\"body\").removeClass(\"dragging\"),\$(\"tbody tr\",\$(i.el[0])).each(function(e){var i=ko.dataFor(this);i.index(e)})}});
";
        // line 703
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["typeahead"] ?? null));
        foreach ($context['_seq'] as $context["column"] => $context["attr"]) {
            // line 704
            if (($context["column"] == "category")) {
                // line 705
                echo "ta_sources['";
                echo $context["column"];
                echo "']=new Bloodhound({ ";
                if (twig_get_attribute($this->env, $this->source, $context["attr"], "prefetch", [], "any", false, false, false, 705)) {
                    echo "prefetch:'";
                    echo twig_get_attribute($this->env, $this->source, $context["attr"], "prefetch", [], "any", false, false, false, 705);
                    echo "',";
                }
                if (twig_get_attribute($this->env, $this->source, $context["attr"], "remote", [], "any", false, false, false, 705)) {
                    echo "remote:{url:'";
                    echo twig_get_attribute($this->env, $this->source, $context["attr"], "remote", [], "any", false, false, false, 705);
                    echo "',wildcard:'%QUERY'},";
                }
                echo "datumTokenizer:Bloodhound.tokenizers.obj.whitespace('value'),queryTokenizer:Bloodhound.tokenizers.whitespace,identify:function(obj){return obj.id},sufficient:10});ta_sources[\"";
                echo $context["column"];
                echo "\"].initialize(),\$(\".";
                echo $context["column"];
                echo ".typeahead\").typeahead({hint:!0,highlight:!0},{name:\"";
                echo $context["column"];
                echo "\",limit:10,display:'value',source:ta_sources[\"";
                echo $context["column"];
                echo "\"],templates:{notFound:['<div class=\"tt-no-suggestion\">";
                echo addslashes(($context["text_no_records_found"] ?? null));
                echo "</div>'].join(\"\\n\"),pending:['<div class=\"tt-no-suggestion\"><i class=\"fa fa-spin fa-refresh\"></i> ";
                echo addslashes(($context["text_loading_records"] ?? null));
                echo "</div>'].join('\\n'),suggestion:Handlebars.compile('";
                echo "<p><span class=\"tt-nowrap\"><span class=\"tt-secondary\">{{path}}</span>{{value}}</span></p>";
                echo "')}});
";
            } elseif ((            // line 706
$context["column"] == "filter")) {
                // line 707
                echo "ta_sources['";
                echo $context["column"];
                echo "']=new Bloodhound({ ";
                if (twig_get_attribute($this->env, $this->source, $context["attr"], "prefetch", [], "any", false, false, false, 707)) {
                    echo "prefetch:'";
                    echo twig_get_attribute($this->env, $this->source, $context["attr"], "prefetch", [], "any", false, false, false, 707);
                    echo "',";
                }
                if (twig_get_attribute($this->env, $this->source, $context["attr"], "remote", [], "any", false, false, false, 707)) {
                    echo "remote:{url:'";
                    echo twig_get_attribute($this->env, $this->source, $context["attr"], "remote", [], "any", false, false, false, 707);
                    echo "',wildcard:'%QUERY'},";
                }
                echo "datumTokenizer:Bloodhound.tokenizers.obj.whitespace('value'),queryTokenizer:Bloodhound.tokenizers.whitespace,identify:function(obj){return obj.id},sufficient:10});ta_sources[\"";
                echo $context["column"];
                echo "\"].initialize(),\$(\".";
                echo $context["column"];
                echo ".typeahead\").typeahead({hint:!0,highlight:!0},{name:\"";
                echo $context["column"];
                echo "\",limit:10,display:'value',source:ta_sources[\"";
                echo $context["column"];
                echo "\"],templates:{notFound:['<div class=\"tt-no-suggestion\">";
                echo addslashes(($context["text_no_records_found"] ?? null));
                echo "</div>'].join(\"\\n\"),pending:['<div class=\"tt-no-suggestion\"><i class=\"fa fa-spin fa-refresh\"></i> ";
                echo addslashes(($context["text_loading_records"] ?? null));
                echo "</div>'].join('\\n'),suggestion:Handlebars.compile('";
                echo "<p><span class=\"tt-nowrap\"><span class=\"tt-secondary\">{{group}}</span>{{value}}</span></p>";
                echo "')}});
";
            } elseif (twig_in_filter(            // line 708
$context["column"], [0 => "name", 1 => "model", 2 => "sku", 3 => "upc", 4 => "ean", 5 => "jan", 6 => "isbn", 7 => "mpn", 8 => "location", 9 => "download", 10 => "manufacturer"])) {
                // line 709
                echo "ta_sources['";
                echo $context["column"];
                echo "']=new Bloodhound({ ";
                if (twig_get_attribute($this->env, $this->source, $context["attr"], "prefetch", [], "any", false, false, false, 709)) {
                    echo "prefetch:'";
                    echo twig_get_attribute($this->env, $this->source, $context["attr"], "prefetch", [], "any", false, false, false, 709);
                    echo "',";
                }
                if (twig_get_attribute($this->env, $this->source, $context["attr"], "remote", [], "any", false, false, false, 709)) {
                    echo "remote:{url:'";
                    echo twig_get_attribute($this->env, $this->source, $context["attr"], "remote", [], "any", false, false, false, 709);
                    echo "',wildcard:'%QUERY'},";
                }
                echo "datumTokenizer:Bloodhound.tokenizers.obj.whitespace('value'),queryTokenizer:Bloodhound.tokenizers.whitespace,identify:function(obj){return obj.id},sufficient:10});ta_sources[\"";
                echo $context["column"];
                echo "\"].initialize(),\$(\".";
                echo $context["column"];
                echo ".typeahead\").typeahead({hint:!0,highlight:!0},{name:\"";
                echo $context["column"];
                echo "\",limit:10,display:'value',source:ta_sources[\"";
                echo $context["column"];
                echo "\"],templates:{notFound:['<div class=\"tt-no-suggestion\">";
                echo addslashes(($context["text_no_records_found"] ?? null));
                echo "</div>'].join(\"\\n\"),pending:['<div class=\"tt-no-suggestion\"><i class=\"fa fa-spin fa-refresh\"></i> ";
                echo addslashes(($context["text_loading_records"] ?? null));
                echo "</div>'].join('\\n'),suggestion:Handlebars.compile('";
                echo "<p><span class=\"tt-nowrap\">{{value}}</span></p>";
                echo "')}});
";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['column'], $context['attr'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 712
        echo "function response_handler(r,e){var e=\"undefined\"==typeof e?!0:e;return bull5i.display_alerts(r.alerts,!0),r.success?!0:r.errors&&r.errors.error?r.errors.error:(e&&\$(this).editable(\"hide\"),!1)}
function setup_editables(table){var defaultParams={ajaxOptions:{type:\"POST\",dataType:\"json\",cache:!1},type:\"text\",url:\"";
        // line 713
        echo ($context["update"] ?? null);
        echo "\",toggle:\"";
        echo ($context["module_product_quick_edit_quick_edit_on"] ?? null);
        echo "\",highlight:!1,container:\"body\",title:\"\",emptytext:\"\",pk:bull5i.get_pk_params,value:function(){return table.cell(this).data()},params:function(e){var t=\$.extend({},bull5i.get_additional_params());return t.id=e.pk.id,t.column=e.pk.column,t.old=\$.isArray(e.pk.old)&&0==e.pk.old.length?null:e.pk.old,t.value=\$.isArray(e.value)&&0==e.value.length?null:e.value,\$(\"#batch-edit\").is(\":checked\")&&\$(\"input[name*='selected']:checked\").length&&(t.ids=\$(\"input[name*='selected']:checked\").serializeObject().selected),t},success:function(e,t){var a=response_handler.call(this,e);if(!0===a){var l=table.cell(this).index().column,n=table.column(l).dataSrc();return e.value&&(t=e.value),\$.isArray(e.results.done)&&(\$.each(e.results.done,function(a,l){var u=\$(\"#p_\"+l).get(0);if(u){var r=table.row(u).data();null!=e.values?(e.values.hasOwnProperty(\"*\")&&\$.extend(r,e.values[\"*\"]),e.values.hasOwnProperty(l)&&\$.extend(r,e.values[l])):r[n]=t,\"function\"==typeof table.updatePipeline&&table.updatePipeline(table.row(u).index(),r)}}),e.results.done.length&&!1===update_related(n,e.results.done)&&table.draw(!1)),{newValue:t}}return!1===a?{newValue:\$(this).html()}:a},display:function(e,t){return\"abrakadabra\"}}
";
        // line 714
        $context["result"] = false;
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable([0 => "status_qe", 1 => "yes_no_qe", 2 => "manufac_qe", 3 => "stock_qe", 4 => "tax_cls_qe", 5 => "length_qe", 6 => "weight_qe"]);
        foreach ($context['_seq'] as $context["_key"] => $context["type"]) {
            $context["result"] = (($context["result"] ?? null) | twig_in_filter($context["type"], ($context["types"] ?? null)));
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['type'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        if (($context["result"] ?? null)) {
            echo ",selectParams={type:'select',showbuttons:!0}";
        }
        // line 715
        $context["result"] = false;
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable([0 => "cat_qe", 1 => "dl_qe", 2 => "filter_qe", 3 => "store_qe"]);
        foreach ($context['_seq'] as $context["_key"] => $context["type"]) {
            $context["result"] = (($context["result"] ?? null) | twig_in_filter($context["type"], ($context["types"] ?? null)));
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['type'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        if (($context["result"] ?? null)) {
            echo ",select2Params={type:\"select2\",select2:{multiple:!0,allowClear:!0,placeholder:\"";
            echo ($context["text_autocomplete"] ?? null);
            echo "\",searchInputPlaceholder:\"";
            echo ($context["text_autocomplete"] ?? null);
            echo "\"},viewseparator:\"<br/>\",buttons:'<button type=\"button\" class=\"btn btn-danger btn-sm editable-submit editable-remove editable-custom\" data-toggle=\"tooltip\" title=\"";
            echo ($context["button_remove"] ?? null);
            echo "\"><i class=\"fa fa-minus\"></i></button><button type=\"button\" class=\"btn btn-success btn-sm editable-submit editable-add editable-custom\" data-toggle=\"tooltip\" title=\"";
            echo ($context["button_add"] ?? null);
            echo "\"><i class=\"fa fa-plus\"></i></button><button type=\"button\" class=\"btn btn-primary btn-sm editable-submit editable-overwrite\" data-toggle=\"tooltip\" title=\"";
            echo ($context["button_save"] ?? null);
            echo "\"><i class=\"fa fa-check\"></i></button><button type=\"button\" class=\"btn btn-default btn-sm editable-cancel\" data-toggle=\"tooltip\" title=\"";
            echo ($context["button_cancel"] ?? null);
            echo "\"><i class=\"fa fa-remove\"></i></button>',savenochange:!0}";
        }
        echo ";
";
        // line 716
        if (twig_in_filter("qe", ($context["types"] ?? null))) {
            echo "\$(\"td.qe\").editable(defaultParams);";
        }
        // line 717
        if (twig_in_filter("date_qe", ($context["types"] ?? null))) {
            echo "\$(\"td.date_qe\").editable(\$.extend(!0,{},defaultParams,{type:\"combodate\",format:\"YYYY-MM-DD\",template:\"D / MMMM / YYYY\",combodate:{smartDays:!0,maxYear:";
            echo (twig_date_format_filter($this->env, "now", "Y") + 5);
            echo "}}));";
        }
        // line 718
        if (twig_in_filter("datetime_qe", ($context["types"] ?? null))) {
            echo "\$(\"td.datetime_qe\").editable(\$.extend(!0,{},defaultParams,{type:\"combodate\",format:\"YYYY-MM-DD HH:mm:ss\",template:\"D / MMM / YYYY  HH:mm:ss\",combodate:{smartDays:!0,maxYear:";
            echo (twig_date_format_filter($this->env, "now", "Y") + 5);
            echo ",minuteStep:1}}));";
        }
        // line 719
        if (twig_in_filter("status_qe", ($context["types"] ?? null))) {
            echo "\$(\"td.status_qe\").editable(\$.extend({},defaultParams,selectParams,{source:[{value:0,text:\"";
            echo addslashes(($context["text_disabled"] ?? null));
            echo "\"},{value:1,text:\"";
            echo addslashes(($context["text_enabled"] ?? null));
            echo "\"}]}));";
        }
        // line 720
        $context["multilingual_text"] = [];
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable([0 => "name_qe", 1 => "tag_qe"]);
        foreach ($context['_seq'] as $context["_key"] => $context["type"]) {
            if (twig_in_filter($context["type"], ($context["types"] ?? null))) {
                $context["multilingual_text"] = twig_array_merge(($context["multilingual_text"] ?? null), [0 => ("td." . $context["type"])]);
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['type'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 721
        if (($context["multilingual_text"] ?? null)) {
            echo "\$(\"";
            echo twig_join_filter(($context["multilingual_text"] ?? null), ",");
            echo "\").editable(\$.extend({},defaultParams,{type:\"multilingual_text\",source:\"";
            echo ($context["load"] ?? null);
            echo "\",sourceOptions:function(){var e=table.cell(this).index().row,t=table.cell(this).index().column;return{type:\"POST\",dataType:\"json\",data:{id:table.row(e).data().id,column:table.column(t).dataSrc(),ids:\$(\"#batch-edit\").is(\":checked\")&&\$(\"input[name*='selected']:checked\").length?\$(\"input[name*='selected']:checked\").serializeObject().selected:[]}}},sourceLoaded:function(e){return bull5i.display_alerts(e.alerts,!0),e.success?e.data:e.errors&&e.errors.error?e.errors.error:null},showbuttons:\"bottom\",value:null,success:function(e,t){if(result=response_handler.call(this,e,!1),!0===result){var l=table.cell(this).index().column,a=table.column(l).dataSrc();return e.value&&(t=e.value),\$.isArray(e.results.done)&&(\$.each(e.results.done,function(l,r){var s=\$(\"#p_\"+r).get(0);if(s){var n=table.row(s).data();null!=e.values?(e.values.hasOwnProperty(\"*\")&&\$.extend(!0,n,e.values[\"*\"]),e.values.hasOwnProperty(r)&&\$.extend(!0,n,e.values[r])):n[a]=t,\"function\"==typeof table.updatePipeline&&table.updatePipeline(table.row(s).index(),n)}}),e.results.done.length&&!1===update_related(a,e.results.done)&&table.draw(!1)),{newValue:t}}var r=\$(this).data(\"editable\").input.\$tpl;return r&&(r.find(\".form-group\").removeClass(\"has-error\"),r.find(\".form-group .help-block\").remove()),!1===result?e.errors&&\$.isArray(e.errors.value)&&r?(\$.each(e.errors.value,function(e,t){var l=t.lang,a=t.text;r.find('.form-group[data-lang=\"'+l+'\"]').addClass(\"has-error\").append(\$(\"<span/>\",{class:\"help-block\"}).html(a))}),!1):{newValue:\$(this).html()}:result}}));";
        }
        // line 722
        if (twig_in_filter("yes_no_qe", ($context["types"] ?? null))) {
            echo "\$(\"td.yes_no_qe\").editable(\$.extend({},defaultParams,selectParams,{source:[{value:0,text:\"";
            echo addslashes(($context["text_no"] ?? null));
            echo "\"},{value:1,text:\"";
            echo addslashes(($context["text_yes"] ?? null));
            echo "\"}]}));";
        }
        // line 723
        if (twig_in_filter("manufac_qe", ($context["types"] ?? null))) {
            echo "\$(\"td.manufac_qe\").editable(\$.extend({},defaultParams,selectParams,{ ";
            if (($context["manufacturer_select"] ?? null)) {
                echo "source:";
                echo ($context["manufacturer_select"] ?? null);
                echo ",prepend:[{value:0,text:'";
                echo addslashes(($context["text_none"] ?? null));
                echo "'}]";
            } else {
                echo "type:\"typeaheadjs\",showbuttons:!0,typeahead:{options:{hint:!0,highlight:!0},dataset:{name:\"manufacturer\",limit:10,display:'value',source:ta_sources.manufacturer,templates:{empty:['<div class=\"tt-no-suggestion\">";
                echo addslashes(($context["text_no_records_found"] ?? null));
                echo "</div>'].join(\"\\n\"),suggestion:Handlebars.compile('";
                echo "<p><span class=\"tt-nowrap\">{{value}}</span></p>";
                echo "')}}},tpl:'<input type=\"text\" placeholder=\"";
                echo ($context["text_autocomplete"] ?? null);
                echo "\">',value2input:function(t){var e=this.options.scope,a=bull5i.dtApi.cell(e).index().row,n=bull5i.dtApi.cell(e).index().column,i=bull5i.dtApi.row(a).data(),p=bull5i.dtApi.column(n).dataSrc(),l=\"\";return l=\"\"!=i[p+\"_text\"]?i[p+\"_text\"]:\"";
                echo ($context["text_none"] ?? null);
                echo "\",this.\$input.data(\"ta-selected\",{value:l,id:t}),l},input2value:function(){var t=this.\$input.data(\"ta-selected\");return\"undefined\"!=typeof t?\"*\"!=t.id?t.id:0:null}";
            }
            echo "}));";
        }
        // line 724
        if (twig_in_filter("cat_qe", ($context["types"] ?? null))) {
            echo "\$(\"td.cat_qe\").editable(\$.extend(!0,{},defaultParams,select2Params,{ ";
            if (($context["category_select"] ?? null)) {
                echo "source:";
                echo ($context["category_select"] ?? null);
                echo ",";
            } else {
                echo "select2:{minimumInputLength:1,ajax:{type:\"GET\",url:\"";
                echo ($context["filter"] ?? null);
                echo "\",dataType:\"json\",cache:!1,quietMillis:150,data:function(e){return{query:e,type:\"category\",user_token:\"";
                echo ($context["user_token"] ?? null);
                echo "\"}},results:function(e){var t=[];return \$.each(e,function(e,n){t.push({id:n.id,text:n.full_name})}),{results:t}}},initSelection:function(e,t){var n=[];\$(e.val().split(\",\")).each(function(){n.push(this)}),\$.ajax({type:\"GET\",url:\"";
                echo ($context["filter"] ?? null);
                echo "\",dataType:\"json\",data:{query:n,type:\"category\",multiple:!0,user_token:\"";
                echo ($context["user_token"] ?? null);
                echo "\"}}).done(function(e){var n=[];\$.each(e,function(e,t){n.push({id:t.id,text:t.full_name})}),t(n)})}}";
            }
            echo "}));";
        }
        // line 725
        if (twig_in_filter("dl_qe", ($context["types"] ?? null))) {
            echo "\$(\"td.dl_qe\").editable(\$.extend(!0,{},defaultParams,select2Params,{ ";
            if (($context["download_select"] ?? null)) {
                echo "source:";
                echo ($context["download_select"] ?? null);
                echo ",";
            } else {
                echo "select2:{minimumInputLength:1,ajax:{type:\"GET\",url:\"";
                echo ($context["filter"] ?? null);
                echo "\",dataType:\"json\",cache:!1,quietMillis:150,data:function(e){return{query:e,type:\"download\",user_token:\"";
                echo ($context["user_token"] ?? null);
                echo "\"}},results:function(e){var t=[];return \$.each(e,function(e,n){t.push({id:n.id,text:n.value})}),{results:t}}},initSelection:function(e,t){var n=[];\$(e.val().split(\",\")).each(function(){n.push(this)}),\$.ajax({type:\"GET\",url:\"";
                echo ($context["filter"] ?? null);
                echo "\",dataType:\"json\",data:{query:n,type:\"download\",multiple:!0,user_token:\"";
                echo ($context["user_token"] ?? null);
                echo "\"}}).done(function(e){var n=[];\$.each(e,function(e,t){n.push({id:t.id,text:t.value})}),t(n)})}}";
            }
            echo "}));";
        }
        // line 726
        if (twig_in_filter("filter_qe", ($context["types"] ?? null))) {
            echo "\$(\"td.filter_qe\").editable(\$.extend(!0,{},defaultParams,select2Params,{ ";
            if (($context["filter_select"] ?? null)) {
                echo "source:";
                echo ($context["filter_select"] ?? null);
                echo ",";
            } else {
                echo "select2:{minimumInputLength:1,ajax:{type:\"GET\",url:\"";
                echo ($context["filter"] ?? null);
                echo "\",dataType:\"json\",cache:!1,quietMillis:150,data:function(e){return{query:e,type:\"filter\",user_token:\"";
                echo ($context["user_token"] ?? null);
                echo "\"}},results:function(e){var t=[],n=[];return \$.each(e,function(e,u){var i=\$.inArray(u.group_name);-1==i&&(i=n.length,n.push(u.group_name),t[i]={text:u.group_name,children:[]}),t[i].children.push({id:u.id,text:u.value,group:u.group})}),{results:t}}},initSelection:function(e,t){var n=[];\$(e.val().split(\",\")).each(function(){n.push(this)}),\$.ajax({type:\"GET\",url:\"";
                echo ($context["filter"] ?? null);
                echo "\",dataType:\"json\",data:{query:n,type:\"filter\",multiple:!0,user_token:\"";
                echo ($context["user_token"] ?? null);
                echo "\"}}).done(function(e){var n=[];\$.each(e,function(e,t){n.push({id:t.id,text:t.full_name})}),t(n)})},formatSelection:function(e){return void 0!=e.group?e.group+e.text:e.text}}";
            }
            echo "}));";
        }
        // line 727
        if (twig_in_filter("store_qe", ($context["types"] ?? null))) {
            echo "\$(\"td.store_qe\").editable(\$.extend({},defaultParams,select2Params,{source:";
            echo ($context["store_select"] ?? null);
            echo "}));";
        }
        // line 728
        if (twig_in_filter("stock_qe", ($context["types"] ?? null))) {
            echo "\$(\"td.stock_qe\").editable(\$.extend({},defaultParams,selectParams,{source:";
            echo ($context["stock_status_select"] ?? null);
            echo "}));";
        }
        // line 729
        if (twig_in_filter("tax_cls_qe", ($context["types"] ?? null))) {
            echo "\$(\"td.tax_cls_qe\").editable(\$.extend({},defaultParams,selectParams,{source:";
            echo ($context["tax_class_select"] ?? null);
            echo "}));";
        }
        // line 730
        if (twig_in_filter("length_qe", ($context["types"] ?? null))) {
            echo "\$(\"td.length_qe\").editable(\$.extend({},defaultParams,selectParams,{source:";
            echo ($context["length_class_select"] ?? null);
            echo "}));";
        }
        // line 731
        if (twig_in_filter("weight_qe", ($context["types"] ?? null))) {
            echo "\$(\"td.weight_qe\").editable(\$.extend({},defaultParams,selectParams,{source:";
            echo ($context["weight_class_select"] ?? null);
            echo "}));";
        }
        // line 732
        if (twig_in_filter("qty_qe", ($context["types"] ?? null))) {
            echo "\$(\"td.qty_qe\").editable(\$.extend({},defaultParams));";
        }
        // line 733
        if (twig_in_filter("image_qe", ($context["types"] ?? null))) {
            echo "\$(\"td.image_qe\").editable(\$.extend(!0,{},defaultParams,{type:\"image\",noImage:\"";
            echo ($context["no_image"] ?? null);
            echo "\",clearText:\"";
            echo ($context["text_clear"] ?? null);
            echo "\",browseText:\"";
            echo ($context["text_browse"] ?? null);
            echo "\",value:function(){var e={},a=bull5i.dtApi.cell(this).data(),t=bull5i.dtApi.cell(this).index().row,i=bull5i.dtApi.row(t).data();return e.image=a,e.thumbnail=i.image_thumb,e.alt=i.image_alt,e.title=i.image_title,e},params:function(e){var a={};return a.id=e.pk.id,a.column=e.pk.column,a.old=e.pk.old,a.value=e.value,\$(\"#batch-edit\").is(\":checked\")&&\$(\"input[name*='selected']:checked\").length&&(a.ids=\$(\"input[name*='selected']:checked\").serializeObject().selected),a},chooseImage:function(e,a){var t=\"quick-edit-image\",i=\"quick-edit-thumbnail\",o=\"\",l=\$.Deferred();return \$(\"#\"+t).val(\"\"),\$.ajax({url:\"index.php?route=common/filemanager&user_token=";
            echo ($context["user_token"] ?? null);
            echo "&target=\"+encodeURIComponent(t),dataType:\"html\"}).done(function(l){\$(\"#modal-image\").append(l),\$(\"#modal-image\").modal(\"show\"),\$(\"#modal-image\").on(\"hide.bs.modal\",function(){var l=\$(\"#\"+i+\" .content-overlay\");\$(\"#\"+t).val()?(o=\$(\"#\"+t).val(),\$.ajax({url:\"index.php?route=extension/module/product_quick_edit/image&user_token=";
            echo ($context["user_token"] ?? null);
            echo "&image=\"+encodeURIComponent(o)+\"&width=";
            echo ($context["list_view_image_width"] ?? null);
            echo "&height=";
            echo ($context["list_view_image_height"] ?? null);
            echo "\",dataType:\"text\",beforeSend:function(){l&&l.addClass(\"in\")}}).done(function(t){e.image=o,e.thumbnail=t,a.call(null,e)}).always(function(){l&&l.removeClass(\"in\")})):\"function\"==typeof a&&a.call(null,null),\$(\"#modal-image\").off(\"hide.bs.modal\")}).on(\"hidden.bs.modal\",function(){\$(\"#modal-image\").empty(),\$(\"#modal-image\").off(\"hidden.bs.modal\")})}).always(function(){l.resolve()}),l.promise()}}));";
        }
        // line 734
        if (twig_in_filter("price_qe", ($context["types"] ?? null))) {
            echo "\$(\"td.price_qe\").editable(\$.extend({},defaultParams));";
        }
        // line 735
        echo "}
function show_quick_edit_modal(o,i,d){var t=\$.Deferred();\$(\"#actionQuickEditModal .modal-body form fieldset\").html(i.data),i.title&&\$(\"#actionQuickEditModal .modal-title\").html(i.title),-1!==\$.inArray(o,[\"seo_urls\",\"descriptions\"])?\$(\"#actionQuickEditModal\").find(\".modal-footer .submit.add,.modal-footer .submit.remove\").attr(\"disabled\",!0):\$(\"#actionQuickEditModal\").find(\".modal-footer .submit.add,.modal-footer .submit.remove\").attr(\"disabled\",!1),\$(\"#actionQuickEditModal\").modal(\"show\"),\$(\"#actionQuickEditModal\").on(\"click\",\".modal-footer .cancel\",function(o){t.resolve()}).on(\"click\",\".modal-footer .submit\",function(o){if(\"function\"==typeof d){\$(o.currentTarget).hasClass(\"add\")?bull5i.form_add():\$(o.currentTarget).hasClass(\"remove\")?bull5i.form_remove():bull5i.form_overwrite();\$(\"#actionQuickEditModal .modal-body form\").serializeObject();d.call(this,\$(\"#actionQuickEditModal .modal-body form\")).done(function(){t.resolve()})}else t.resolve()}),\$(\"#actionQuickEditModal\").on(\"hide.bs.modal\",function(){\$(\"#actionQuickEditModal\").off(\"hide.bs.modal\")}).on(\"hidden.bs.modal\",function(){\$(\"#actionQuickEditModal .modal-body form fieldset\").empty(),\$(\"#actionQuickEditModal .modal-body .notice\").empty(),\$(\"#actionQuickEditModal .modal-title\").empty(),\$(\"#actionQuickEditModal\").off(\"hidden.bs.modal\"),\$(\"#actionQuickEditModal\").off(\"click\",\".modal-footer .cancel\"),\$(\"#actionQuickEditModal\").off(\"click\",\".modal-footer .submit\")}),t.always(function(){\$(\"#actionQuickEditModal\").modal(\"hide\")})}function update_related(i,o){if(o&&related[i]&&related[i].length){var l={};return \$.each(related[i],function(i,t){l[t]=o}),bull5i.processing&&bull5i.processing(!0,\"related\"),\$.ajax({url:\"";
        // line 736
        echo ($context["reload"] ?? null);
        echo "\",type:\"POST\",cache:!1,dataType:\"json\",data:{data:l}}).done(function(i){i.values&&void 0!=bull5i.dtApi&&\$.each(i.values,function(i,o){var l=\$(\"#p_\"+i).get(0);if(l){var t=bull5i.dtApi.row(l).data();\$.extend(t,o),\"function\"==typeof bull5i.dtApi.updatePipeline&&bull5i.dtApi.updatePipeline(bull5i.dtApi.row(l).index(),t)}}),bull5i.display_alerts(i.alerts,!0,\$(\"#alerts\"))}).fail(\$.proxy(bull5i.ajax_fail,{alerts:\$(\"#alerts\")})).always(function(){void 0!=bull5i.dtApi&&bull5i.dtApi.draw(!1),bull5i.processing&&bull5i.processing(!1,\"related\")}),!0}return!1}
\$(function(){\$('#dT').DataTable({dom:\"t<'row-fluid'<'col-xs-6'i><'col-xs-6 text-right'p>>\",serverSide:!0,";
        // line 737
        if (($context["module_product_quick_edit_client_side_caching"] ?? null)) {
            echo "ajax:\$.fn.dataTable.pipeline({url:\"";
            echo ($context["source"] ?? null);
            echo "\",data:function(e){var a=\$(\"#filter_special_price\");e.user_token=\"";
            echo ($context["user_token"] ?? null);
            echo "\",a.length&&a.val()&&(e.filter_special_price=a.val())},pages:parseInt(\"";
            echo (((($context["module_product_quick_edit_cache_size"] ?? null) && (twig_round((($context["module_product_quick_edit_cache_size"] ?? null) / ($context["items_per_page"] ?? null)), 0, "ceil") > 0))) ? (twig_round((($context["module_product_quick_edit_cache_size"] ?? null) / ($context["items_per_page"] ?? null)), 0, "ceil")) : (1));
            echo "\")}),";
        } else {
            echo "ajax:{type:\"POST\",url:\"";
            echo ($context["source"] ?? null);
            echo "\",data:function(e){var a=\$(\"#filter_special_price\");e.user_token=\"";
            echo ($context["user_token"] ?? null);
            echo "\",a.length&&a.val()&&(e.filter_special_price=a.val())}},";
        }
        // line 738
        echo "initComplete:function(e){if(\"\"!=e.oPreviousSearch.sSearch){var a=ko.contextFor(\$(\"#global-search-btn\").get(0));\$(\"#global-search\").val(e.oPreviousSearch.sSearch),a&&a.\$root.setSearch(e.oPreviousSearch.sSearch)}for(i=0,len=e.aoColumns.length;len>i;i++)e.aoPreSearchCols[i].sSearch.length>0&&\$(\"tr.filters .fltr.\"+e.aoColumns[i].name+\":input\").not(\".typeahead\").val(e.aoPreSearchCols[i].sSearch);if(e.oLoadedState&&void 0!=e.oLoadedState.specialPrice&&\"\"!=e.oLoadedState.specialPrice&&(\$special=\$('ul.price .filter-special-price[data-value=\"'+e.oLoadedState.specialPrice+'\"]'),\$special.length&&bull5i.update_special_price_menu(\$special)),e.oLoadedState&&void 0!=e.oLoadedState.typeaheads&&void 0!=e.oLoadedState.typeaheads)for(key in e.oLoadedState.typeaheads)\$(\".fltr.typeahead.tt-input.\"+key).data(\"ta-selected\",{value:e.oLoadedState.typeaheads[key]}).data(\"ta-name\",key).typeahead(\"val\",e.oLoadedState.typeaheads[key])},stateSaveParams:function(e,a){a.specialPrice=\$(\"#filter_special_price\").length?\$(\"#filter_special_price\").val():\"\",a.typeaheads={},\$(\".fltr.typeahead.tt-input\").each(function(){var t=\$(this).typeahead(\"val\");name=e.aoColumns[\$(this).closest(\"th\").index()].name,a.typeaheads[name]=t})},stateLoadParams:function(e,a){if(\$.query.get(\"dTc\")){var t=\$.query.get(\"search\");if(void 0!=a.specialPrice&&\"\"!=a.specialPrice&&\$(\"#filter_special_price\").length&&\$(\"#filter_special_price\").val(a.specialPrice),void 0!=a.typeaheads)for(key in a.typeaheads)\$(\".fltr.typeahead.tt-input.\"+key).typeahead(\"val\",a.typeaheads[key]);t&&(a.search.search=t)}else{var s=\$.query,i=s.get(\"page\"),l=new \$.fn.dataTable.Api(e);a.search.search=s.get(\"search\"),a.start=i&&parseInt(i)?parseInt(i-1)*a.length:0;for(var o=0,d=a.columns.length;d>o;o++)try{var p=l.column(o).dataSrc(),r=s.get(\"filter_\"+p);input=\$(\"tr.filters [name=filter_\"+p+\"]:input\"),a.columns[o].search.search=r,input&&(input.hasClass(\"typeahead\")?input.typeahead(\"val\",r):input.val(r)),active_filters.hasOwnProperty(p)&&\$(\".fltr.typeahead.tt-input.\"+p).data(\"ta-selected\",{value:active_filters[p].value}).data(\"ta-name\",p).typeahead(\"val\",active_filters[p].value)}catch(h){}void 0!=a.typeaheads&&delete a.typeaheads,bull5i.clearCache=!0}},rowCallback:function(e,a){\$(e).data(\"id\",a.id)},drawCallback:function(e){var a=void 0!=bull5i.dtApi?bull5i.dtApi:new \$.fn.dataTable.Api(e);setup_editables(a),bull5i.update_nav_checkboxes(),bull5i.update_nav_controls()},language:{aria:{sortAscending:\"";
        echo addslashes(($context["text_sort_ascending"] ?? null));
        echo "\",sortDescending:\"";
        echo addslashes(($context["text_sort_descending"] ?? null));
        echo "\"},paginate:{first:\"";
        echo addslashes(($context["text_first_page"] ?? null));
        echo "\",last:\"";
        echo addslashes(($context["text_last_page"] ?? null));
        echo "\",next:\"";
        echo addslashes(($context["text_next_page"] ?? null));
        echo "\",previous:\"";
        echo addslashes(($context["text_previous_page"] ?? null));
        echo "\"},emptyTable:\"";
        echo addslashes(($context["text_empty_table"] ?? null));
        echo "\",info:\"";
        echo addslashes(($context["text_showing_info"] ?? null));
        echo "\",infoEmpty:\"";
        echo addslashes(($context["text_showing_info_empty"] ?? null));
        echo "\",infoFiltered:\"";
        echo addslashes(($context["text_showing_info_filtered"] ?? null));
        echo "\",infoPostFix:\"\",infoThousands:\" \",loadingRecords:\"";
        echo addslashes(($context["text_loading_records"] ?? null));
        echo "\",zeroRecords:\"";
        echo addslashes(($context["text_no_matching_records"] ?? null));
        echo "\"},deferRender:!0,processing:!1,stateSave:!0,autoWidth:!1,sortCellsTop:!0,pageLength:parseInt(\"";
        echo (($context["items_per_page"] ?? null) * 1);
        echo "\"),
columnDefs:[
";
        // line 740
        if (twig_in_filter("selector", ($context["columns"] ?? null))) {
            echo "{targets:[\"col_selector\"],createdCell:function(e,t,c){\$(e).html(\$(\"<input/>\",{type:\"checkbox\",name:\"selected[]\",value:c.id}))}},";
        }
        // line 741
        if (twig_in_filter("view_in_store", ($context["columns"] ?? null))) {
            echo "{targets:[\"col_view_in_store\"],createdCell:function(e,t){for(var l=\$(\"<select/>\",{\"class\":\"form-control view_in_store\"}).append(\$(\"<option/>\",{value:\"\"}).html(\"";
            echo addslashes(($context["text_select"] ?? null));
            echo "\")),o=0;o<t.length;o++)l.append(\$(\"<option/>\",{value:t[o].url}).html(t[o].name));\$(e).html(l)}},";
        }
        // line 742
        if (twig_in_filter("action", ($context["columns"] ?? null))) {
            echo "{targets:[\"col_action\"],createdCell:function(t,n,a){for(var e=\$(\"<div/>\",{\"class\":\"btn-group btn-group-flex\"}),l=0;l<n.length;l++)\$btn=n[l].url?\$(\"<a/>\",{href:n[l].url,\"class\":\"btn btn-default btn-xs\",id:n[l].action+\"-\"+a.id,title:n[l].title}):\$(\"<button/>\",{type:\"button\",\"class\":\"btn btn-default btn-xs action\",id:n[l].action+\"-\"+a.id,title:n[l].title}).data(\"column\",n[l].action),n[l].type&&(\$btn.addClass(n[l].type),\"view\"==n[l].type&&\$btn.attr(\"target\",\"_blank\")),a[n[l].action+\"_exist\"]&&\$btn.addClass(\"btn-warning\"),n[l].class&&\$btn.addClass(n[l].class),n[l].name&&\$btn.html(n[l].name),n[l].ref&&\$btn.data(\"ref\",n[l].ref),n[l].icon&&\$btn.prepend(\$(\"<i/>\",{\"class\":\"fa fa-\"+n[l].icon})),e.append(\$btn);\$(t).html(e)}},";
        }
        // line 743
        if (twig_in_filter("image", ($context["columns"] ?? null))) {
            echo "{targets:[\"col_image\"],createdCell:function(t,a,i){\$(t).html(\$(\"<img/>\",{src:i.image_thumb,alt:i.image_alt,title:i.image_title,\"class\":\"img-thumbnail\"}).data(\"id\",i.id))}},";
        }
        // line 744
        if (twig_in_filter("price", ($context["columns"] ?? null))) {
            echo "{targets:[\"col_price\"],createdCell:function(e,l,t){t.special?\$(e).html(\$(\"<s/>\").html(l)).append(\$(\"<br/>\")).append(\$(\"<span/>\",{\"class\":\"text-danger\"}).html(t.special)):\$(e).html(l)}},";
        }
        // line 745
        if (twig_in_filter("gross_price", ($context["columns"] ?? null))) {
            echo "{targets:[\"col_gross_price\"],createdCell:function(e,l,t){t.gross_special?\$(e).html(\$(\"<s/>\").html(l)).append(\$(\"<br/>\")).append(\$(\"<span/>\",{\"class\":\"text-danger\"}).html(t.gross_special)):\$(e).html(l)}},";
        }
        // line 746
        if (twig_in_filter("status", ($context["columns"] ?? null))) {
            echo "{targets:[\"col_status\"],createdCell:function(t,s,a){\$(t).html(a.status_class?\$(\"<span/>\",{\"class\":\"label label-\"+a.status_class}).html(a.status_text):a.status_text)}},";
        }
        // line 747
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable([0 => "category", 1 => "download", 2 => "filter", 3 => "store"]);
        foreach ($context['_seq'] as $context["_key"] => $context["col"]) {
            if (twig_in_filter($context["col"], ($context["columns"] ?? null))) {
                echo "{targets:[\"col_";
                echo $context["col"];
                echo "\"],createdCell:function(c,t,e){var o=[];\$.each(e.";
                echo $context["col"];
                echo "_data,function(c,t){o.push(t.text)}),\$(c).html(o.join(\"<br/>\"))}},";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['col'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 748
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable([0 => "shipping", 1 => "subtract", 2 => "stock_status", 3 => "tax_class", 4 => "length_class", 5 => "weight_class", 6 => "manufacturer", 7 => "date_added", 8 => "date_modified", 9 => "date_available"]);
        foreach ($context['_seq'] as $context["_key"] => $context["col"]) {
            if (twig_in_filter($context["col"], ($context["columns"] ?? null))) {
                echo "{targets:[\"col_";
                echo $context["col"];
                echo "\"],createdCell:function(c,e,t){\$(c).html(t.";
                echo $context["col"];
                echo "_text)}},";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['col'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 749
        if (twig_in_filter("quantity", ($context["columns"] ?? null))) {
            echo "{targets:[\"col_quantity\"],createdCell:function(t,a){var e=\$(\"<span/>\").html(a),a=parseInt(a);e.addClass(0>=a?\"label label-warning\":5>a?\"label label-danger\":\"label label-success\"),\$(t).html(e)}},";
        }
        // line 750
        echo "{orderable:!1,targets:";
        echo ($context["non_sortable_columns"] ?? null);
        echo "},{searchable:!1,targets:['col_selector','col_action']}
],order:[],columns:[";
        // line 751
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["column_classes"] ?? null));
        foreach ($context['_seq'] as $context["idx"] => $context["class"]) {
            if ($context["class"]) {
                echo "{data:\"";
                echo (($__internal_compile_24 = ($context["columns"] ?? null)) && is_array($__internal_compile_24) || $__internal_compile_24 instanceof ArrayAccess ? ($__internal_compile_24[$context["idx"]] ?? null) : null);
                echo "\",name:\"";
                echo (($__internal_compile_25 = ($context["columns"] ?? null)) && is_array($__internal_compile_25) || $__internal_compile_25 instanceof ArrayAccess ? ($__internal_compile_25[$context["idx"]] ?? null) : null);
                echo "\",className:\"";
                echo $context["class"];
                echo "\"},";
            } else {
                echo "{data:\"";
                echo (($__internal_compile_26 = ($context["columns"] ?? null)) && is_array($__internal_compile_26) || $__internal_compile_26 instanceof ArrayAccess ? ($__internal_compile_26[$context["idx"]] ?? null) : null);
                echo "\",name:\"";
                echo (($__internal_compile_27 = ($context["columns"] ?? null)) && is_array($__internal_compile_27) || $__internal_compile_27 instanceof ArrayAccess ? ($__internal_compile_27[$context["idx"]] ?? null) : null);
                echo "\"},";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['idx'], $context['class'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo "]
});
\$(\"body\").on(\"keydown\",\"#otherSettingsModal\",function(e){if(e.altKey&&e.shiftKey&&68==e.keyCode){var t=ko.dataFor(this);t.module_product_quick_edit_debug_mode(\"0\"==t.module_product_quick_edit_debug_mode()?\"1\":\"0\")}}).on(\"click\",\"td button.action\",function(e){if(null!=bull5i.dtApi){var t=\$(this).closest(\"td\").get(0),l=\$(this).data(\"column\"),a=bull5i.dtApi.cell(t).index().row,i=bull5i.dtApi.row(a).data().id;null!=i&&null!=l&&(bull5i.processing&&bull5i.processing(!0,\"action\"),\$.ajax({url:\"";
        // line 753
        echo ($context["load"] ?? null);
        echo "\",type:\"POST\",cache:!1,dataType:\"json\",data:{id:i,column:l,ids:\$(\"#batch-edit\").is(\":checked\")&&\$(\"input[name*='selected']:checked\").length?\$(\"input[name*='selected']:checked\").serializeObject().selected:[]}}).done(function(e){e.success&&show_quick_edit_modal(l,e,function(e){var t=\$.Deferred(),a=e.serializeObject(),o=\$.extend({id:i,column:l,value:\$.isEmptyObject(a)?null:a,old:\"\"},bull5i.get_additional_params()),n={self:this,dfd:t,btn:\$(this),form:e,vm:\$(this).data(\"vm\"),context:\$(\$(this).data(\"context\")),alerts:\$.merge(\$(\"#alerts\"),\$(\"div.notice\",\$(\$(this).data(\"context\"))))};return \$(\"#batch-edit\").is(\":checked\")&&\$(\"input[name*='selected']:checked\").length&&(o.ids=\$(\"input[name*='selected']:checked\").serializeObject().selected),\$.ajax({type:\"POST\",url:\"";
        echo ($context["update"] ?? null);
        echo "\",dataType:\"json\",data:o,beforeSend:function(){n.btn.button(\"loading\"),\$(\"fieldset\",n.form).attr(\"disabled\",!0)}}).done(function(e){n.vm&&e.values&&bull5i.view_models&&bull5i.view_models[n.vm]&&bull5i.view_models[n.vm].updateValues&&bull5i.view_models[n.vm].updateValues(e.values),n.vm&&bull5i.view_models&&bull5i.view_models[n.vm]&&bull5i.view_models[n.vm].applyErrors&&bull5i.view_models[n.vm].applyErrors(e.errors?e.errors:{}),e.success&&(null!=bull5i.dtApi&&null!=e.value&&e.results&&\$.isArray(e.results.done)&&(\$.each(e.results.done,function(t,a){var i=\$(\"#p_\"+a).get(0);if(i){var o=bull5i.dtApi.row(i).data();null!=e.values?(e.values.hasOwnProperty(\"*\")&&\$.extend(o,e.values[\"*\"]),e.values.hasOwnProperty(a)&&\$.extend(o,e.values[a])):o[l+\"_exist\"]=e.value,\"function\"==typeof bull5i.dtApi.updatePipeline&&bull5i.dtApi.updatePipeline(bull5i.dtApi.row(i).index(),o)}}),e.results.done.length&&!1===update_related(l,e.results.done)&&bull5i.dtApi.draw(!1)),t.resolve()),bull5i.display_alerts(e.alerts,!0,n.alerts)}).fail(\$.proxy(bull5i.ajax_fail,n)).always(function(e,t,l){n.btn.button(\"reset\"),\$(\"fieldset\",n.form).attr(\"disabled\",!1)}),t.promise()}),bull5i.display_alerts(e.alerts,!0)}).fail(\$.proxy(bull5i.ajax_fail,{alerts:\$(\"#alerts\")})).always(function(e,t,l){bull5i.processing&&bull5i.processing(!1,\"action\")}))}}),\$.extend(\$.fn.select2.defaults,{formatNoMatches:function(){return\"";
        echo addslashes(($context["text_no_matches_found"] ?? null));
        echo "\"},formatInputTooShort:function(e,t){var l=t-e.length;return\"";
        echo addslashes(($context["text_input_too_short"] ?? null));
        echo "\".replace(\"%d\",l)},formatInputTooLong:function(e,t){var l=e.length-t;return\"";
        echo addslashes(($context["text_input_too_long"] ?? null));
        echo "\".replace(\"%d\",l)},formatSelectionTooBig:function(e){return\"";
        echo addslashes(($context["text_selection_too_big"] ?? null));
        echo "\".replace(\"%d\",e)},formatLoadMore:function(e){return\"";
        echo addslashes(($context["text_loading_more_results"] ?? null));
        echo "\"},formatSearching:function(){return\"";
        echo addslashes(($context["text_searching"] ?? null));
        echo "\"}}),null!=moment&&moment.locale(\"";
        echo ($context["code"] ?? null);
        echo "\"),\$(document).on(\"click\",\"a[data-toggle='im']\",function(e){e.preventDefault(),\$(this).popover({html:!0,placement:\"right\",trigger:\"manual\",content:function(){return['<button type=\"button\" class=\"btn btn-primary btn-browse-image\" data-toggle=\"tooltip\" title=\"";
        echo ($context["text_browse"] ?? null);
        echo "\" data-loading-text=\"<i class=\\'fa fa-fw fa-spinner fa-spin\\'></i>\"><i class=\"fa fa-pencil\"></i></button>','<button type=\"button\" class=\"btn btn-danger btn-clear-image\" data-toggle=\"tooltip\" title=\"";
        echo ($context["text_clear"] ?? null);
        echo "\"><i class=\"fa fa-fw fa-ban\"></i></button>'].join(\" \")}}),\$(this).on(\"shown.bs.popover\",function(e){\$(\"[data-toggle='tooltip']\").tooltip({container:\"body\"})}).on(\"hidden.bs.popover\",function(e){\$(this).popover(\"destroy\")}),\$(this).popover(\"toggle\")});
});}(window.bull5i=window.bull5i||{},jQuery));
//--></script>
";
        // line 756
        echo ($context["footer"] ?? null);
        echo "
";
    }

    // line 1
    public function macro_alert_icon($__type__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "type" => $__type__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            ob_start(function () { return ''; });
            // line 2
            echo "\t\t";
            if ((($context["type"] ?? null) == "error")) {
                // line 3
                echo "\t\t\tfa-times-circle
\t\t";
            } elseif ((            // line 4
($context["type"] ?? null) == "warning")) {
                // line 5
                echo "\t\t\tfa-exclamation-triangle
\t\t";
            } elseif ((            // line 6
($context["type"] ?? null) == "success")) {
                // line 7
                echo "\t\t\tfa-check-circle
\t\t";
            } elseif ((            // line 8
($context["type"] ?? null) == "info")) {
                // line 9
                echo "\t\t\tfa-info-circle
\t\t";
            } else {
                // line 11
                echo "\t\t";
            }
            echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    public function getTemplateName()
    {
        return "extension/module/catalog/product_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  2272 => 11,  2268 => 9,  2266 => 8,  2263 => 7,  2261 => 6,  2258 => 5,  2256 => 4,  2253 => 3,  2250 => 2,  2236 => 1,  2230 => 756,  2204 => 753,  2178 => 751,  2173 => 750,  2169 => 749,  2154 => 748,  2139 => 747,  2135 => 746,  2131 => 745,  2127 => 744,  2123 => 743,  2119 => 742,  2113 => 741,  2109 => 740,  2079 => 738,  2063 => 737,  2059 => 736,  2056 => 735,  2052 => 734,  2034 => 733,  2030 => 732,  2024 => 731,  2018 => 730,  2012 => 729,  2006 => 728,  2000 => 727,  1980 => 726,  1960 => 725,  1940 => 724,  1918 => 723,  1910 => 722,  1902 => 721,  1890 => 720,  1882 => 719,  1876 => 718,  1870 => 717,  1866 => 716,  1839 => 715,  1826 => 714,  1820 => 713,  1817 => 712,  1782 => 709,  1780 => 708,  1750 => 707,  1748 => 706,  1718 => 705,  1716 => 704,  1712 => 703,  1640 => 702,  1635 => 700,  1621 => 688,  1615 => 687,  1603 => 685,  1589 => 683,  1587 => 682,  1579 => 677,  1575 => 676,  1571 => 675,  1567 => 674,  1563 => 673,  1557 => 670,  1545 => 665,  1539 => 663,  1537 => 662,  1533 => 660,  1522 => 658,  1518 => 657,  1514 => 656,  1505 => 654,  1500 => 653,  1498 => 652,  1494 => 650,  1483 => 648,  1479 => 647,  1470 => 645,  1465 => 644,  1463 => 643,  1459 => 641,  1448 => 639,  1444 => 638,  1435 => 636,  1430 => 635,  1428 => 634,  1424 => 632,  1413 => 630,  1409 => 629,  1400 => 627,  1395 => 626,  1393 => 625,  1389 => 623,  1378 => 621,  1374 => 620,  1370 => 619,  1361 => 617,  1356 => 616,  1353 => 615,  1348 => 612,  1341 => 610,  1330 => 608,  1326 => 607,  1321 => 606,  1317 => 605,  1313 => 604,  1304 => 602,  1299 => 601,  1289 => 598,  1283 => 597,  1278 => 596,  1275 => 595,  1272 => 594,  1267 => 591,  1256 => 589,  1252 => 588,  1248 => 587,  1239 => 585,  1234 => 584,  1224 => 581,  1218 => 580,  1213 => 579,  1210 => 578,  1207 => 577,  1202 => 574,  1191 => 572,  1187 => 571,  1183 => 570,  1174 => 568,  1169 => 567,  1159 => 564,  1153 => 563,  1148 => 562,  1145 => 561,  1142 => 560,  1137 => 557,  1126 => 555,  1122 => 554,  1118 => 553,  1109 => 551,  1104 => 550,  1094 => 547,  1088 => 546,  1083 => 545,  1080 => 544,  1078 => 543,  1072 => 540,  1068 => 539,  1062 => 537,  1060 => 536,  1054 => 533,  1050 => 532,  1041 => 530,  1036 => 529,  1034 => 528,  1028 => 525,  1024 => 524,  1015 => 522,  1010 => 521,  1008 => 520,  1005 => 519,  1002 => 518,  998 => 517,  994 => 515,  988 => 514,  978 => 512,  968 => 510,  966 => 509,  959 => 508,  956 => 507,  952 => 506,  945 => 503,  927 => 488,  923 => 487,  916 => 485,  910 => 482,  901 => 476,  892 => 470,  887 => 467,  881 => 466,  875 => 465,  867 => 462,  857 => 460,  854 => 459,  849 => 458,  845 => 457,  837 => 451,  826 => 449,  822 => 448,  817 => 446,  810 => 444,  804 => 443,  798 => 442,  790 => 439,  785 => 437,  780 => 435,  776 => 434,  771 => 432,  764 => 430,  756 => 425,  745 => 419,  739 => 418,  733 => 417,  729 => 416,  709 => 398,  703 => 394,  701 => 393,  690 => 387,  686 => 386,  671 => 374,  665 => 371,  659 => 368,  648 => 362,  642 => 361,  636 => 357,  623 => 355,  619 => 354,  613 => 351,  606 => 347,  599 => 343,  593 => 340,  587 => 337,  580 => 333,  573 => 329,  567 => 326,  561 => 323,  553 => 318,  547 => 315,  541 => 312,  534 => 308,  527 => 304,  521 => 301,  515 => 298,  508 => 294,  501 => 290,  495 => 287,  489 => 284,  482 => 280,  475 => 276,  469 => 273,  463 => 270,  456 => 266,  449 => 262,  443 => 259,  437 => 256,  430 => 252,  423 => 248,  417 => 245,  411 => 242,  403 => 237,  397 => 234,  391 => 231,  379 => 222,  368 => 214,  360 => 209,  353 => 205,  347 => 202,  341 => 199,  334 => 195,  327 => 191,  321 => 188,  315 => 185,  308 => 181,  301 => 177,  297 => 176,  291 => 173,  283 => 168,  279 => 167,  273 => 164,  254 => 148,  248 => 145,  240 => 140,  223 => 128,  219 => 127,  199 => 110,  195 => 109,  187 => 104,  177 => 99,  165 => 90,  161 => 89,  157 => 88,  149 => 83,  144 => 81,  133 => 73,  118 => 61,  114 => 60,  108 => 57,  102 => 54,  85 => 42,  81 => 41,  73 => 36,  62 => 28,  56 => 25,  48 => 20,  38 => 13,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/module/catalog/product_list.twig", "");
    }
}
