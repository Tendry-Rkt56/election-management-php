<style>
    .containers {
        position:absolute;
        top:10%;
        left:6%;    
    }

    .notif {
        position:relative;
    }

    .notif p {
        position:absolute;
        top:-20%;
        right:35%;
        background-color:red;
        color:white;
        font-size:10px;
        padding:5px 10px;
        border-radius:50%;
    }
</style>
<div class="container containers">

    <div class="container-fluid d-flex align-items-center justify-content-center flex-column">
        <div class="container d-flex align-items-center justify-content-center flex-row">
            <form style="width:80%" action="" class="my-5 container d-flex align-items-center justify-content-center flex-row" method="GET">
                <div class="d-flex align-items-center justify-content-center flex-row mx-5" style="width:80%">
                    <label for="" class="" style="font-weight:bold; width:40%">Rechercher:</label>
                    <input type="text" name="valeur" id="valeur" style="width:60%" placeholder="Rechercher..." class="form-control">
                </div>
                <input type="submit" class="btn btn-primary" value="Séléctionner">
            </form>
            <div class="notif mx-5" style="width:20%">
                <a href="/Admin/notifications" class="btn btn-secondary">Notifications</a>
                <?php if (isset($unReadNotif)): ?>
                    <p><?=count($unReadNotif)?></p>
                <?php endif?>
            </div>
        </div>
    </div>

    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>N° matricule</th>
                <th>Nom et prénom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($users)): ?>
                <?php foreach($users as $user):?>
                    <tr>
                        <td style="font-weight:bold;"><?=$user['matricule']?></td>
                        <td><?=$user['nom']. ' '.$user['prenom']?></td>
                        <td><?=$user['email']?></td>
                        <td>
                            <form action="/Admin/users/delete/<?=$user['idUsers']?>">
                                <input type="submit" value="Supprimer" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                <?php endforeach?>
            <?php endif?>
        </tbody>
    </table>
</div>