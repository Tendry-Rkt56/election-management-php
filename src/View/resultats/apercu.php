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
        position:absolute;
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

    .box-candidats {
        max-height:80vh;
        overflow-y:scroll;
    }

    .box-candidats::-webkit-scrollbar {
        display:none;
    }

    @media screen and (max-width:768px) {
        
    }

</style>


<div class="row containers container-fluid">
    <?php if (isset($resultats) && isset($voies)): ?>
    <div class="col-md-4 box-container">
        <div class="box p-3 d-flex flex-column" style="text-align:left;background-color:#5198F1; color:#fefefe">
            <h3 style="text-align:center;"><span style="font-weight:bolder;border-bottom:2px solid white">To</span>tal</h3>
            <p style="margin:3px 0; text-align:left">Province: 
                <?php foreach($provinces as $province):?>
                    <span style="font-weight:bolder";><?=$province?></span>
                <?php endforeach?>
            </p>
            <p style="margin:3px 0; text-align:left">Nombre total d'élécteurs: <span style="font-weight:bolder";><?=$totalElecteurs['totalElecteurs']?></span></p>
            <p style="margin:3px 0; text-align:left">Nombre total des votes nulles: <span style="font-weight:bold"><?=$totalElecteurs['totalVoteNull']. " (". Taux($totalElecteurs['totalVotants'], $totalElecteurs['totalVoteNull'])."%)"?></span></p>
            <p style="margin:3px 0; text-align:left">Nombre total des votes blanches: <span style="font-weight:bold;"><?=$totalElecteurs['totalVoteBlanche']. " (". Taux($totalElecteurs['totalVotants'], $totalElecteurs['totalVoteBlanche'])."%)"?></span></p>
            <p style="margin:3px 0; text-align:left">Nombre total des votants: <span style="color:#262626;font-weight:bolder"><?=$totalElecteurs['totalVotants']. " (". Taux($totalElecteurs['totalElecteurs'], $totalElecteurs['totalVotants'])."%)"?></span></p>
            <p style="margin:3px 0; text-align:left">Nombre de bureaux: <span style="color:#262626;font-weight:bolder"><?=" ".count($resultats)?></span></p>
        </div>
        <?php foreach ($resultats as $resultat): ?>
            <div style="padding:10Px 10px; box-shadow:0 0 10Px rgba(0,0,0,0.3);text-align:left" class="box p-3 d-flex align-items-center justify-content-center flex-column">
                <p style="color:#262626">Bureau de vote: <span style="font-weight:bolder; color:#1E61A5"><?=$resultat['nomBureau']?></span></p>  
                <p style="color:#262626">Fokontany: <span style="color:#1E61A5"><?=$resultat['nomFokontany']?></span></p>  
                <p style="color:#color">Nombre d'élécteurs inscrits: <span style="color:#1E61A5"><?=$resultat['nombreElecteurs']?></span></p>
                <p style="color:#262626">Votes nulles: <span style="color:#1E61A5"><?=$resultat['voteNull']. "  (".Taux($resultat['nombresVotants'], $resultat['voteNull'])."%)"?></span></p>
                <p style="color:#262626">Votes blanches: <span style="color:#1E61A5"><?=$resultat['voteBlanche']. "  (".Taux($resultat['nombresVotants'], $resultat['voteBlanche'])."%)"?></span></p>
                <p style="color:#262626">Nombres de votants: <span style="color:#1E61A5"><?=$resultat['nombresVotants']?></span></p>  
                <?php $taux = Taux($resultat['nombreElecteurs'], $resultat['nombresVotants'])?>
                <p style="color: #262626;">Taux de participation: 
                    <span <?php if($taux > 50): ?> style="color:#1E61A5" <?php else:?> style="color:red" <?php endif?>>
                        <?php echo $taux."%"?> 
                    </span>
                </p>
            </div>    
        <?php endforeach?>
    </div>
    <div class="col-md-8 box-candidats">
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
                <?php foreach($voies as $voie): ?>
                    <tr>
                        <td><img src="/<?=$voie['imageCandidat']?>" alt=""></td>
                        <td><?=$voie['numeroCandidat']?></td>
                        <td><?=$voie['nomCandidat'].' '.$voie['prenomCandidat']?></td>
                        <td><?=$voie['partiePolitique']?></td>
                        <td style="font-weight:bolder;"><?=$voie['total_voix']?></td>
                        <td style="font-weight:bolder;"><?=Taux($totalElecteurs['totalVotants'], $voie['total_voix'])."%"?></td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
        <div class="p-4 container-error d-flex align-items-center justify-content-center container alert alert-danger flex-column">
            <p>Pas encore de résultats disponibles pour ce bureau</p>
            <a href="/Resultats" class="btn btn-secondary">Retour</a>
        </div>
    <?php endif?>
</div>
