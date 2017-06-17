<script src="<?= $js_url; ?>/jquery-extend.js" type="text/javascript"></script>

<?php
    $easy_table = EasyTable::getInstance();
?>
<h1>
    Easy Tables Form <?= $selected_table ? "(" . $easy_table->getLabel($selected_table) . ")" : "" ?> 
</h1>
<h3><?= $steps[$step] ?></h3>

<?php if (empty($table_list)) : ?>
    <div class="update-nag">
        Please create tables with prefix <b>easy_table</b> in phpmyadmin. Then link those table with easy table plugin by add in form.
    </div>
<?php endif; ?>

<form method="POST">
    <table class="form-table">
        <?php 
            echo $Form->input("id", array("type" => "hidden", "value" => $id ));
            echo $Form->input("step", array("type" => "hidden", "value" => $step ));
            require_once dirname(__FILE__) . "/step" . ($step + 1) . ".php";
        ?>
    </table>
    <p class="submit">
        <input class="button button-primary" value="Submit" type="submit">
    </p>
</form>
