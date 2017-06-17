<?php
    $easy_table = EasyTable::getInstance();
        
    $selected_table_fields = $easy_table->getDBFieldList($selected_table);

    $table_relations = $easy_table->getRelationShip($selected_table);
    
    debug($_POST);
?>
<tr>
    <td>
        <table class="wp-list-table widefat fixed striped template">
            <thead>
                <tr>
                    <th>Field</th>
                    <th style="width:7%;">Required</th>
                    <th style="width:7%;">Hidden in Form</th>
                    <th style="width:7%;">Hidden in View</th>                    
                    <th style="width:7%;">Fill by User</th>
                    <th>Label</th>
                    <th>Type</th>
                    <th>Default Value</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($selected_table_fields as $field): ?>
                    <tr class="form-field form-required">
                        <th scope="row">
                            <?php echo $Form->label($field); ?>
                        </th>
                        <td>
                            <?php echo $Form->input("field_meta.$field.is_required", array("type" => "checkbox", "value" => "1")); ?>
                        </td>
                        <td>
                            <?php echo $Form->input("field_meta.$field.hidden.form", array("type" => "checkbox", "value" => "1")); ?>
                        </td>
                        <td>
                            <?php echo $Form->input("field_meta.$field.hidden.view", array("type" => "checkbox", "value" => "1")); ?>
                        </td>
                        <td>
                            <?php echo $Form->input("field_meta.$field.is_fillable", array("type" => "checkbox", "value" => "1")); ?>
                        </td>
                        <td>
                            <?php echo $Form->input("field_meta.$field.label", array("required" => true)); ?>
                        </td>
                        <td>
                            <?php echo $Form->select("field_meta.$field.type", $field_types, "Please Select", array(
                                "required" => true, 
                                "class" => "form-field-type",
                                "data-field" => $field
                            )); ?>
                        </td>
                        <td class="center">
                            <?php echo $Form->input("field_meta.$field.default_value"); ?>
                        </td>                                    
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div id="form-dropdown-options">
            <h3 style="margin: 10px 0;">
                Drop Down Options
            </h3>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th style="width:12%;">Field</th>
                        <th>Options</th>
                    </tr>
                </thead>

                <tbody class="template-container">
                    <?php 
                    foreach ($selected_table_fields as $field):
                        if (isset($_POST['data']['field_meta'][$field]["type"]) && $_POST['data']['field_meta'][$field]["type"] == "select"):
                    ?>
                        <tr id="form-dropdown-template-row-<?= $field ?>" data-field="<?= $field ?>">
                            <th scope="row"  style="vertical-align:middle">
                                <?= $field ?>
                            </th>
                            <td>
                                <div style="margin:5px 0;">
                                <?php 
                                echo $Form->input("field_meta.$field.pick_options_from_parent_table", array(
                                        "class" => "pick_options_from_parent_table",
                                        "type" => "checkbox",
                                        "value" => 1 
                                    )); 
                                ?>
                                Pick Options from Parent Table 
                                </div>

                                <table class="wp-list-table widefat striped template form-dropdown-template-table" data-template-min-row="1">
                                    <thead>
                                        <tr>
                                            <th class="center"style="width:5%">
                                                <div class="row-adder">
                                                    <i class="fa fa-plus-circle blue font-icon" aria-hidden="true"></i>
                                                </div>
                                            </th>
                                            <th>Key</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr class="template-row hidden">
                                            <td class="center">
                                                <div class="row-deleter">
                                                    <i class="fa fa-times-circle red font-icon" aria-hidden="true"></i>
                                                </div>
                                            </td>
                                            <td>
                                                <?php echo $Form->input("field_meta.$field.dropdown_options.{id}.key"); ?>
                                            </td>
                                            <td>
                                                <?php echo $Form->input("field_meta.$field.dropdown_options.{id}.value"); ?>
                                            </td>
                                        </tr>
                                        <?php if (isset($_POST['data']['field_meta'][$field]["dropdown_options"]) && $_POST['data']['field_meta'][$field]["dropdown_options"]): ?>
                                            <?php foreach($_POST['data']['field_meta'][$field]["dropdown_options"] as $k => $drop_down): 
                                                    if ($k == "{id}" || $k == "{{id}}")
                                                    {
                                                        continue;
                                                    }
                                            ?>
                                            <tr data-row-id="<?= $k ?>">
                                                <td class="center">
                                                    <div class="row-deleter">
                                                        <i class="fa fa-times-circle red font-icon" aria-hidden="true"></i>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php echo $Form->input("field_meta.$field.dropdown_options.$k.key"); ?>
                                                </td>
                                                <td>
                                                    <?php echo $Form->input("field_meta.$field.dropdown_options.$k.value"); ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </td>
</tr>


<script id="form-dropdown-template" type="text/x-handlebars-template">
    <tr id="form-dropdown-template-row-{{field}}" data-field="{{field}}">
        <th scope="row"  style="vertical-align:middle">
            {{field}}
        </th>
        <td>
            <div style="margin:5px 0;">
            <?php 
            echo $Form->input("field_meta.{{field}}.pick_options_from_parent_table", array(
                "class" => "pick_options_from_parent_table",
                "type" => "checkbox",
                "value" => 1 
                )); 
            ?>
            Pick Options from Parent Table 
            </div>
            
            <table class="wp-list-table widefat striped template form-dropdown-template-table" data-template-min-row="1">
                <thead>
                    <tr>
                        <th class="center"style="width:5%">
                            <div class="row-adder">
                                <i class="fa fa-plus-circle blue font-icon" aria-hidden="true"></i>
                            </div>
                        </th>
                        <th>Key</th>
                        <th>Value</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="template-row hidden">
                        <td class="center">
                            <div class="row-deleter">
                                <i class="fa fa-times-circle red font-icon" aria-hidden="true"></i>
                            </div>
                        </td>
                        <td>
                            <?php echo $Form->input("field_meta.{{field}}.dropdown_options.{id}.key"); ?>
                        </td>
                        <td>
                            <?php echo $Form->input("field_meta.{{field}}.dropdown_options.{id}.value"); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
</script>

<script type="text/javascript">
$(document).ready(function()
{
    var table_relations = JSON.parse('<?= json_encode($table_relations) ?>');
    console.log(table_relations);
    
    $(".easy-table table.template").tableTemplate({
        beforeRowAdd : function ()
        {
            return true;
        },
        onRowAdd : function (tr)
        {
        },
        beforeRowDel : function ()
        {
            return true;
        },
        onRowDel : function ()
        {
        }
    });
    
    $(".easy-table").on("change", ".form-field-type", function()
    {
        var field = $(this).attr("data-field");
        var v = $(this).val();
        
        var target_tbody = $(".easy-table  #form-dropdown-options tbody.template-container");
        var target_tr = $(target_tbody).find("tr#form-dropdown-template-row-" + field);
        if ($(target_tr).length > 0)
        {
            if (jQuery.type(table_relations["parent"][field]) == "undefined")
            {
                $(target_tr).find(".pick_options_from_parent_table").prop("checked", false).parent().hide();
            }
        
            if (v == "select")
            {
                $(target_tr).show();
            }
            else
            {
                $(target_tr).hide();
            }
            return;
        }
        
        if (v != "select")
        {
            return;
        }
        
        var source   = $(".easy-table script#form-dropdown-template").html();
        var template = Handlebars.compile(source);
        
        var context = {field : field};
        var html    = template(context);
        
        target_tbody.append(html);
        
        target_tr = $(target_tbody).find("tr#form-dropdown-template-row-" + field);
        
        if (jQuery.type(table_relations["parent"][field]) == "undefined")
        {
            $(target_tr).find(".pick_options_from_parent_table").prop("checked", false).parent().hide();
        }
        
        $(target_tr).find(".template").tableTemplate({
            placeholder : {
                id : "{id}",
                i : "{i}",
            },
            beforeRowAdd : function ()
            {
                return true;
            },
            onRowAdd : function (tr)
            {
            },
            beforeRowDel : function ()
            {
                return true;
            },
            onRowDel : function ()
            {
            }
        });
    });
    
    $(".easy-table").on("change", "#form-dropdown-options .pick_options_from_parent_table", function()
    {
        var obj = $(this).closest("td").find(".form-dropdown-template-table");
        
        if (this.checked)
        {
            obj.hide();
        }
        else
        {
            obj.show();
        }
    });
    
    $(".easy-table #form-dropdown-options .pick_options_from_parent_table").trigger("change");
    $(".easy-table .form-field-type").trigger("change");
});
</script>