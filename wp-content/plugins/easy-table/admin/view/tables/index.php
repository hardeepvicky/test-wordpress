<h1>
    <div style="float:left; width : 50%;">
        <?= easy_table_get_label($select_table) ?> Summary
    </div>
    <div style="float:right; width : 50%; text-align: right">
        <a class="button" href="<?= \EasyTable\Config::plugin_admin_url(array("page" => \EasyTable\Config::SLUG . "-" . $select_table, "action" => "form")) ?>">
            Add New Record
        </a>
    </div>
    <div style="clear:both"></div>
</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <?php foreach($fields as $field => $meta) : ?>
                <th><?= $meta["label"] ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0; foreach($records as $record): $i++; ?>
        <tr class="center">
            <?php foreach($fields as $field => $meta) : ?>
                <td>
                    <?php 
                        switch($meta['type'])
                        {
                            case "select" : 
                                if (isset($meta["select"]['options']) 
                                    && isset($record[$field]) 
                                    && isset($meta["select"]['options'][$record[$field]]) 
                                    )
                                {
                                    echo $meta["select"]['options'][$record[$field]];
                                }                                
                            break;
                            
                            case "checkbox":
                                if (isset($record[$field]))
                                {
                                    echo $record[$field] ? "Yes" : "No";
                                }
                                else
                                {
                                    echo "";
                                }
                                break;
                                
                            default:
                                if (isset($record[$field])) 
                                {
                                    echo $record[$field];
                                }
                                break;
                        }
                    ?>
                </td>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() 
    {
        $('.easy-table .table-bordered').DataTable({
            "order": [[ 0, "desc" ]],
            "pageLength": 50
        });
    });
</script>