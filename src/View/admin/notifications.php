<style>
    .containers {
        position:absolute;
        top:20%;
        left:5%;
    }

    .form {
        height:80vh;
        width:70%;
        padding:20px 20px;
        box-shadow:0 0 10px rgba(0,0,0,0.4);
    }

    .span {
        border-bottom:2px solid blueviolet;
    }
</style>

<div class="containers container">
    <div class="container-fluid d-flex align-items-center justify-content-between" style="text-align:center;width:50%">
        <a href="/Admin/users" class="btn btn-secondary">Retour</a>
        <h2 style="font-style:normal; font-family:monospace; color:#262626"><span class="span">Noti</span>fications</h2>
    </div>
    <div class="my-5 d-flex align-items-center justify-content-center flex-column container-fluid">
        <?php if (isset($notifs)): ?>
            <?php $className = 'alert alert-success'?>
            <?php foreach($notifs as $notif): ?>
                <div class="container-fluid <?php if ($notif['isRead'] == 0):?> <?=$className?> <?php endif?> d-flex align-items-center justify-content-center flex-column">
                    <p><?=$notif['type']?></p>
                    <div class="d-flex align-items-center justify-content-center" style="text-align:center;">
                        <a href="/Admin/users/response/<?=$notif['idNotif']?>" class="btn btn-outline-primary mx-3">Accepter</a>
                        <a href="/Admin/users/reject/<?=$notif['idNotif']?>" class="btn btn-outline-danger">Rejeter</a>
                    </div>
                </div>
            <?php endforeach?>
        <?php else:?>
            <div class=" d-flex align-items-center justify-content-center flex-column alert alert-info">
                <p>Pas de nouvelles notifications disponibles</p>
            </div>
        <?php endif?>
    </div>
</div>