<tr class="form-field form-required">
    <th scope="row">
        <?php echo $Form->label("Table", array("required" => true)); ?>
    </th>
    <td>
        <?php echo $Form->select("table_name", $table_list, "Please Select", array("required" => true)); ?>
    </td>
</tr>
<tr class="form-field form-required">
    <th scope="row">
        <?php echo $Form->label("Label", array("required" => true)); ?>
    </th>
    <td>
        <?php echo $Form->input("table_name_display", array("required" => true)); ?>
        <p class="description" id="tagline-description">This will be menu link in admin panel.</p>
    </td>
</tr>
<tr class="form-field form-required">
    <th scope="row">
        <?php echo $Form->label("Description"); ?>
    </th>
    <td>
        <?php echo $Form->input("description"); ?>
    </td>
</tr>