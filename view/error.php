<?php
ob_start();
?>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <?php
            if (!empty($error)) {
                ?>
                <div class="container alerte alert-warning">Erreur
                    <?= $error ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$racineWeb = Configuration::get("racineWeb","/");
require 'view/template.php';
?>