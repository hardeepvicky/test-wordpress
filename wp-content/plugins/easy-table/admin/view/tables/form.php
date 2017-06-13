<div class="easy-table">
    <h1>
        Easy Tables Form
    </h1>
    <form method="POST">
        <table class="form-table">
            <tr class="form-field form-required">
                <th scope="row">
                    <?php $attrs = array("required");
                        echo $Form->label("Table", $attrs);
                    ?>
                </th>
                <td>
                    <?php echo $Form->input("table", $attrs); ?>
                </td>
            </tr>
        </table>
    </form>
</div>