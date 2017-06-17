<tr>
    <th scope="row">
        <?php echo $Form->label("Relation To Other Tables"); ?>
    </th>
    <td>
        <table class="wp-list-table widefat fixed striped template">
            <thead>
                <tr>
                    <th class="center"style="width:5%">
                        <div class="row-adder">
                            <i class="fa fa-plus-circle blue font-icon" aria-hidden="true"></i>
                        </div>
                    </th>
                    <th>Field</th>
                    <th>Relation</th>
                    <th>Table</th>
                    <th>Field</th>
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
                        <?php echo $Form->select("relation_meta.{{id}}.field", $selected_table_fields, "Please Select"); ?>
                    </td>
                    <td>
                        <?php echo $Form->select("relation_meta.{{id}}.type", $table_realtions, "Please Select"); ?>
                    </td>
                    <td>
                        <?php echo $Form->select("relation_meta.{{id}}.relation_table", $table_list, "Please Select", array("class" => "relation_table", "data-target" => "#relation_table_field-{{id}}")); ?>
                    </td>
                    <td>
                        <?php echo $Form->select("relation_meta.{{id}}.relation_table_field", array(), "Please Select", array("id" => "relation_table_field-{{id}}")); ?>
                    </td>
                </tr>
                <?php if (isset($_POST['data']['relation_meta'])): ?>
                    <?php foreach ($_POST['data']['relation_meta'] as $id => $arr) : ?>
                        <tr>
                            <td class="center">
                                <div class="row-deleter">
                                    <i class="fa fa-times-circle red font-icon" aria-hidden="true"></i>
                                </div>
                            </td>
                            <td>
                                <?php echo $Form->select("relation_meta.$id.field", $selected_table_fields, "Please Select"); ?>
                            </td>
                            <td>
                                <?php echo $Form->select("relation_meta.$id.type", $table_realtions, "Please Select"); ?>
                            </td>
                            <td>
                                <?php echo $Form->select("relation_meta.$id.relation_table", $table_list, "Please Select", array("class" => "relation_table", "data-target" => "#relation_table_field-$id")); ?>
                            </td>
                            <td>
                                <?php echo $Form->select("relation_meta.$id.relation_table_field", $table_fields[$arr['relation_table']], "Please Select", array("id" => "relation_table_field-$id")); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </td>
</tr>

<script type="text/javascript">
$(document).ready(function()
{
    var table_fields = JSON.parse('<?= json_encode($table_fields) ?>');
    
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
    
    $(".easy-table").on("change", ".relation_table", function()
    {
        var v = $(this).val();
        var html = '<option value="">Please Select</option>';
        
        if (v)
        {
            for(var i in table_fields[v])
            {
                html += '<option value="' + i + '">' + table_fields[v][i] + '</option>';
            }
        }
        
        var target = $(this).attr("data-target");
        $(target).html(html);
    });
    
});
</script>