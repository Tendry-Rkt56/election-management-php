<style>
    .containers {
        position:absolute;
        top:50%;
        transform:translate(-50%,-50%);
        left:50%;
    }
</style>


<div class="containers container">
    <?php if ($response['status'] && $create): ?>
        <div class="alert alert-success d-flex align-items-center justify-content-center">
            <p>Vous avez approuvé la demande de cette personne et son compte a été automatiquement créee</p>
        </div>
    <?php else: ?>
        <div class="alert alert-danger d-flex align-items-center justify-content-center">
            <p><?=$response['valeur']?></p>
        </div>
    <?php endif?>
</div>