<?php

function Taux ($total, $voie) {
    return round(($voie * 100) / $total, 2);
} 

?>
<style>
    .containers {
        position:absolute;
        top:15%;
        left:0%;
    }

    .box {
        width:30%;
        height:auto;
        margin:5px 5px;
        border-radius:6px;
    }

    img {
        width:50px;
        height:50px;
    }

    .container-error {
        width:40%;
        position:fixed;
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
    }

    .box-container {
        max-height:80vh;
        overflow-y:scroll;
    }

    .box-container::-webkit-scrollbar {
        display:none;
    }

    .box-candidat {
        width:70%
    }

    .box-candidats::-webkit-scrollbar {
        display:none;
    }

    @media screen and (max-width:768px) {
        
    }

</style>


<div class="containers container-fluid ">
    <?php if (isset($candidats) && isset($totalElecteurs) && isset($resultats)): ?>
    <div class="d-flex align-items-center justify-content-center flex-row">
        <div class="box p-3 d-flex align-items-start justify-content-center flex-column" style="text-align:left;">
            <h3 style="text-align:center;"><span style="font-weight:bolder;border-bottom:2px solid white">To</span>tal</h3>
            <p style="margin:3px 0; text-align:left">Province:
                <?php foreach ($provinces as $province): ?>
                    <span style="font-weight:bolder";><?=$province?></span>
                <?php endforeach?>
            </p>
            <p style="margin:3px 0; text-align:left">Nombre total d'élécteurs: <span style="font-weight:bolder";><?=$totalElecteurs['totalElecteurs']?></span></p>
            <p style="margin:3px 0; text-align:left">Nombre total des votes nulles: <span style="font-weight:bold"><?=$totalElecteurs['totalVoteNull']. " (". Taux($totalElecteurs['totalVotants'], $totalElecteurs['totalVoteNull'])."%)"?></span></p>
            <p style="margin:3px 0; text-align:left">Nombre total des votes blanches: <span style="font-weight:bold;"><?=$totalElecteurs['totalVoteBlanche']. " (". Taux($totalElecteurs['totalVotants'], $totalElecteurs['totalVoteBlanche'])."%)"?></span></p>
            <p style="margin:3px 0; text-align:left">Nombre total des votants: <span style="color:#262626;font-weight:bolder"><?=$totalElecteurs['totalVotants']. " (". Taux($totalElecteurs['totalElecteurs'], $totalElecteurs['totalVotants'])."%)"?></span></p>
            <p style="margin:3px 0; text-align:left">Nombre de bureaux: <span style="color:#262626;font-weight:bolder"><?=" ".count($resultats)?></span></p>
            <a href="/Resultats" class="btn btn-primary my-5">Voir des resultats spécifiques</a>
        </div>
        <div class="box-candidat">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>N° candidat</th>
                        <th>Nom et prénom</th>
                        <th>Partie politique</th>
                        <th>Voie obtenue</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($candidats as $candidat): ?>
                        <tr>
                            <td><img src="/<?=$candidat['imageCandidat']?>" alt=""></td>
                            <td><?=$candidat['numeroCandidat']?></td>
                            <td><?=$candidat['nomCandidat'].' '.$candidat['prenomCandidat']?></td>
                            <td><?=$candidat['partiePolitique']?></td>
                            <td style="font-weight:bolder;"><?=$candidat['total_voix']?></td>
                            <td style="font-weight:bolder;"><?=Taux($totalElecteurs['totalVotants'], $candidat['total_voix'])."%"?></td>
                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
    </div>
    <?php else: ?>
        <div class="p-4 container-error d-flex align-items-center justify-content-center container alert alert-danger flex-column">
            <p>Pas encore de résultats disponibles pour ce bureau</p>
            <a href="/Resultats" class="btn btn-secondary">Retour</a>
        </div>
    <?php endif?>
</div>