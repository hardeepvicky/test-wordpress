<h1>
    <?= easy_table_get_label($select_table) ?>
    <?php if (isset($id) && $id) : ?>
        (Edit)
    <?php else : ?>
        (Add New)
    <?php endif; ?>
</h1>

<form method="POST">
    <table class="form-table">
        <?php foreach($fields as $field => $meta): ?>
            <tr class="form-field form-required">
                <?php if (isset($meta['hidden']["form"]) && $meta['hidden']["form"]) : ?>
                    <?php echo $Form->input($select_table . "." . $field, array("type" => "hidden"));?>
                <?php else : ?>
                <th scope="row">
                    <?php
                        $attr = array();
                        if (isset($meta['is_required']) && $meta['is_required'])
                        {
                            $attr['required'] = true;
                        }
                    ?>
                    <?php echo $Form->label($meta['label'], $attr);?>
                </th>
                <td>
                    <?php
                        $attr = array();
                        if (isset($meta['is_required']) && $meta['is_required'])
                        {
                            $attr['required'] = true;
                        }
                        
                        if (!isset($meta['is_fillable']) || !$meta['is_fillable'])
                        {
                            $attr['readonly'] = true;
                            $attr['disabled'] = true;
                        }
                        
                        if ($meta['type'] == "text")
                        {
                            echo $Form->input($select_table . "." . $field, $attr);
                        }
                        else if ($meta['type'] == "select")
                        {
                            if (!isset($meta["select"]['options']))
                            {
                                $meta["select"]['options'] = array();
                            }
                            
                            echo $Form->select($select_table . "." . $field, $meta["select"]['options'], "Please Select", $attr);
                        }
                    ?>
                </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>
    <p class="submit">
        <input class="button button-primary" value="Submit" type="submit">
    </p>
</form>