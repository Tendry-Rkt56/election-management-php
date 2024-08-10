<style>
    .containers {
        position:absolute;
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
    }
</style>

<?php var_dump($delete)?>
<?php if ($delete): ?>
<div class="containers container">
    <p>Vous avez rejeté la demande de cette personne et cette notification ainsi que sa demande sera automatiquement supprimée</p>
</div>
<?php endif?>