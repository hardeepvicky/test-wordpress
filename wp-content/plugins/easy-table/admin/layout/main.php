<link type="text/css" rel="stylesheet" href="<?= $public_url; ?>/libs/font-awesome/css/font-awesome.min.css" />
<link type="text/css" rel="stylesheet" href="<?= $public_url; ?>/libs/bootstrap-datatable/jquery.dataTables.min.css">
<link type="text/css" rel="stylesheet" href="<?= $css_url; ?>/admin/style.css">

<script src="<?= $js_url; ?>/jquery-3.1.1.js" type="text/javascript"></script>
<script src="<?= $js_url; ?>/handlebars-v4.0.10.js" type="text/javascript"></script>
<script src="<?= $public_url; ?>/libs/bootstrap-datatable/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?= $public_url; ?>/libs/bootstrap-datatable/dataTables.bootstrap.min.js" type="text/javascript"></script>
        
<div class="easy-table">
    <?php if($Session->hasFlash("success")) : ?>
        <div class="updated notice">
            <p><?= $Session->readFlash("success") ?></p>
        </div>
    <?php endif; ?>
    
    <?php if($Session->hasFlash("faliure")) : ?>
        <div class="error notice">
            <p><?= $Session->readFlash("faliure") ?></p>
        </div>
    <?php endif; ?>

    <?php include_once $view; ?>
</div>
