<h1>
    Easy Tables Summary
</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Table</th>
            <th>Display Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0; foreach($records as $record): $i++; ?>
        <tr class="center">
            <td><?= $i; ?></td>                                
            <td><?= $record["table_name"] ?></td>
            <td><?= $record["table_name_display"] ?></td>
            <td><?= $record["description"] ?></td>
            <td>
                <?php if ($record['is_completed']): ?>
                    <a href="#">Create new Interface</a>
                <?php endif; ?>
                    <a href="<?= \EasyTable\Config::plugin_admin_url(array("page" => \EasyTable\Config::SLUG . "-easy-tables-form", "id" => $record['id'])) ?>">Edit</a>
            </td>
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