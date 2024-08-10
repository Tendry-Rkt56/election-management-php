<?php 
    if (session_status() == PHP_SESSION_NONE) session_start();
?>
<style>
    .containers {
        position:absolute;
        top:20%;
        left:5%;
    }

    img {
        width:50px;
        height:50px;
    }

    .title {
        border-bottom:2px solid blueviolet;
    }
</style>

<div class="container containers d-flex align-items-center justify-content-center flex-column">
    <?php if (isset($_SESSION['success'])): ?>
        <div style="width:80%; text-align:center" class="alert alert-success">
            <?=$_SESSION['success']?>
        </div>
        <?php
            unset($_SESSION['success']);
        ?>
    <?php elseif(isset($_SESSION['error'])): ?>
        <div style="width:80%; text-align:center" class="alert alert-danger">
            <?=$_SESSION['error']?>
        </div>
        <?php
            unset($_SESSION['error']);
        ?>
    <?php endif?>
    <div class="mb-5 container d-flex align-items-center justify-content-around">
        <h2><span class="title">Ca</span>ndidats</h2>
        <a href="/Admin/candidats/create" class="btn btn-secondary">Ajouter un candidat</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th></th>
                <th>N°</th>
                <th>Nom</th>
                <th>Partie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($candidats) && count($candidats) > 0): ?>
                <?php foreach($candidats as $candidat): ?>
                    <tr>
                        <td><img src="/<?=$candidat['image']?>" alt=""></td>
                        <td><?=$candidat['numero']?></td>
                        <td><?=$candidat['nom']?></td>
                        <td><?=$candidat['partie']?></td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center flex-row">
                                <a class="mx-1 btn btn-success" href="/Admin/candidats/update/<?=$candidat['numero']?>">Modifier</a>
                                <?php if (!$isResult): ?>
                                    <form action="/Admin/candidat/delete/<?=$candidat['numero']?>" method="GET">
                                        <input type="submit" value="Supprimer" class="btn btn-danger">
                                    </form>
                                <?php endif?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach?>
                <?php else: ?>
                    <tr>
                        <td style="text-align:center;" class="alert alert-danger" colspan="5">Pas encore de candidats crées</td>
                    </tr>
            <?php endif?>
        </tbody>
    </table>
    <?php if (isset($candidats) && count($candidats) > 0): ?>
    <form action="/Admin/candidats/delete">
        <input class="btn btn-danger" type="submit" value="Supprimer">
    </form>
    <?php endif?>
</div>
