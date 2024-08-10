<?php

use App\Model\Table\BureauTable;

function Taux ($total, $voie) {
    return round(($voie * 100) / $total, 2);
} 

?>
<style>
    .containers {
        position:absolute;
        top:20%;
        left:5%;
    }

    .box {
        height:220px;
        margin:5px 10px;
        border-radius:6px;
    }

    img {
        width:50px;
        height:50px;
    }

    .container-error {
        width:40%;
        position:absolute;
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
    }

</style>

<?php if (isset($candidats) && isset($stat) && isset($bureau)): ?>

<div class="containers container">
    <div class="row d-flex align-items-center justify-content-center">
        <div style="padding:10Px 10px; box-shadow:0 0 10Px rgba(0,0,0,0.3);text-align:left" class="box box-2 col-sm-5 d-flex align-items-center justify-content-center flex-column">
            <p style="color:#262626">Fokontany: <span style="color:#1E61A5"><?=$bureau['nomFokontany']?></span></p>
            <p style="color:#262626">Centre de vote: <span style="color:#1E61A5"><?=$bureau['nomCentre']?></span></p>
            <p style="color:#262626">CodeBv: <span style="color:#1E61A5"><?=$bureau['codeBv']?></span></p>
            <p style="color:#262626">Nom du bureau: <span style="color:#1E61A5"><?=$bureau['nomBureau']?></span></p>
        </div>
        <div style="padding:10Px 10px; box-shadow:0 0 10Px rgba(0,0,0,0.3);text-align:left" class="box box-1 col-sm-6 d-flex align-items-center justify-content-center flex-column">
            <p style="color:#color">Nombre d'élécteurs inscrits: <span style="color:#1E61A5"><?=$stat['nombreElecteurs']?></span></p>
            <p style="color:#262626">Votes nulles: <span style="color:#1E61A5"><?=$stat['voteNull']. "  (".Taux($stat['nombresVotants'], $stat['voteNull'])."%)"?></span></p>
            <p style="color:#262626">Votes blanches: <span style="color:#1E61A5"><?=$stat['voteBlanche']. "  (".Taux($stat['nombresVotants'], $stat['voteBlanche'])."%)"?></span></p>
            <p style="color:#262626">Nombres de votants: <span style="color:#1E61A5"><?=$stat['nombresVotants']?></span></p>
            <p style="color:#262626">Taux de participation: 
                <span <?php if ($stat['taux'] >= 50): ?> style="color:#1E61A5" <?php else:?> style="color:red" <?php endif ?>?><?=round($stat['taux'])?>%</span>
            </p>
        </div>
    </div>
    <div class="container-fluid d-flex align-items-center justify-content-center flex-column my-5">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th></th>
                    <th>N° candidat</th>
                    <th>Nom et prénom</th>
                    <th>Partie politique</th>
                    <th>Voie obtenue</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($candidats as $candidat): ?>
                    <tr>
                        <td><img src="/image/<?=$candidat['imageCandidat']?>" alt=""></td>
                        <td style="font-weight:bold;"><?=$candidat['numeroCandidat']?></td>
                        <td><?=$candidat['nomCandidat'].' '.$candidat['prenomCandidat']?></td>
                        <td style="font-weight:bold;"><?=$candidat['partiePolitique']?></td>
                        <td style="font-weight:bold;"><?=$candidat['resultat']?></td>
                        <td style="color:blue; font-weight:bolder"><?=Taux($stat['nombresVotants'], $candidat['resultat'])."%"?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <form class="vstack my-4" action="/Admin/resultats/delete/<?=$bureau['codeBv']?>" method="POST">
            <input type="submit" class="btn btn-danger" value="Supprimer les résultats dans ce bureau">
        </form>
    </div>
</div>
<?php else: ?>
    <div class="p-4 container-error d-flex align-items-center justify-content-center container alert alert-danger flex-column">
        <p>Pas encore de résultats disponibles pour ce bureau</p>
        <a href="/Admin/bureau" class="btn btn-secondary">Retour</a>
    </div>
<?php endif?>

<!-- <?php var_dump($candidats)?> -->