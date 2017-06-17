<tr class="form-field form-required">
    <th scope="row">
        <?php echo $Form->label("List Key Field", array("required" => true)); ?>
    </th>
    <td>
        <?php echo $Form->select("general_meta.field.list_key_field", $selected_table_fields, "Please Select", array("required" => true)); ?>
    </td>
    <td>
        To Override this add hook function
    </td>
</tr>
<tr>
    <th scope="row">
        <?php echo $Form->label("List Value Field", array("required" => true)); ?>
    </th>
    <td>
        <?php echo $Form->select("general_meta.field.list_value_field", $selected_table_fields, "Please Select", array("required" => true)); ?>
    </td>
</tr>