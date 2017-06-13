<div class="easy-table">
    <h1>
        Easy Tables Summary
    </h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Table</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; foreach($records as $record): $i++; ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $record["table_name_display"] ?></td>
                <td><?= $record["description"] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function() 
    {
        $('.table-bordered').DataTable({
            "order": [[ 0, "desc" ]],
            "pageLength": 50
        });
    });
</script>