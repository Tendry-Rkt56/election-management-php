<style>
    .containers {
        position:absolute;
        top:20%;
    }

    .box {
        background-color:white;
        box-shadow:0 0 5px black;
        padding:10px;
        height:350Px;
        margin:10px;
    }

    .box img {
        width:50%;
        height:50%;
    }

    .box .candidat-info {
        height:50%;
    }

    .box .candidat-info h2{
        color:#262626;
        font-size:19px;
        font-weight:550;
    }

    .box .candidat-info h3 {
        font-size:18px;
        font-family:monospace;
        font-style:italic;
        margin:6px 0;
    }
    
    .box .candidat-info span {
        color:#262626;
        font-family: monospace;
        font-weight:bolder;
    }

    .formResult {
        visibility:visible;
    }

    #formResult {
        visibility:hidden;
    }

</style>
<?php $codeBv = null; ?>
<?php $codeBV = null; ?>
<div class="container containers">
    <h2 style="text-align:center;">Séléctionner un codeBV ou un bureau de vote:</h2>
    <form action="" class="vstack" method="GET">
        <div class="d-flex align-items-center justify-content-center flex-row">
            <select name="codeBv" class="mx-4 form-control" id="">
                <option value="">Séléctionner un codeBV</option>
                <?php $codeBv = $_GET['codeBv'] == null ? null : $_GET['codeBv'];?>
                <?php $codeBV = $_GET['nomBureau'] == null ? null : $_GET['nomBureau'];?>
                <?php foreach($bureaux as $bureau): ?>
                    <option <?php if ($codeBV == $bureau['codeBv']) :?> selected <?php endif ?> value="<?=$bureau['codeBv']?>"<?php if ($codeBv == $bureau['codeBv']) :?> selected <?php endif ?>><?=$bureau['codeBv']?></option>
                <?php endforeach ?>
            </select>

            <select name="nomBureau" class="mx-4 form-control" id="">
                <option value="">Séléctionner le nom du bureau</option>
                <?php foreach($bureaux as $bureau): ?>
                    <option <?php if ($codeBV == $bureau['codeBv']) :?> selected <?php endif ?> <?php if ($codeBv == $bureau['codeBv']) :?> selected <?php endif ?> value="<?=$bureau['codeBv']?>"><?=$bureau['nomBureau']?></option>
                <?php endforeach ?>
            </select>
            <input type="submit" class="btn btn-secondary my-5" value="Séléctionner">
        </div>            
    </form>

    <form action="/Users/result" id="formResult" class="container-fluid vtsack d-flex align-items-center justify-content-center flex-column" method="POST">
        <?php if (isset($codeBv) && $codeBv !== null): ?>
            <input type="hidden" id="codeBv" name="codeBv" value="<?=$codeBv?>">
            <div class=" ml-5 row container-fluid d-flex align-items-center justify-content-center">
                <div class="col-sm-6 d-flex align-items-center justify-content-center flex-column my-3">
                    <div style="width:100%;" class="my-1 d-flex align-items-center justify-content-center flex-row mx-1">
                        <label style="width:40%" for="nombreVotants">Nombre de votants:</label>
                        <input style="width:60%" type="number" class="form-control" name="nombreVotants" id="nombreVotants" placeholder="Nombre de votants...">
                    </div>
                    <div style="width:100%;" class="my-1 d-flex align-items-center justify-content-center flex-row mx-1">
                        <label style="width:40%" for="voieNull">Nombre de voie nulle:</label>
                        <input style="width:60%" type="number" class="form-control" name="voieNull" id="voieNull" placeholder="Nombre de voie nulle...">
                    </div>
                    <div style="width:100%;" class="my-1 d-flex align-items-center justify-content-center flex-row mx-1">
                        <label style="width:40%" for="voieBlanche">Nombre voie blanche:</label>
                        <input style="width:60%" type="number" class="form-control" name="voieBlanche" id="voieBlanche" placeholder="Nombre de voie blanche...">
                    </div>
                </div>
                <div class="col-sm-6">
                    <p style="font-size:20px; font-weight:400">Nom du bureau:  <span style="color:red; font-weight:bolder"><?=$listesEl['nomBureau']?></span></p>
                    <p style="font-size:20px; font-weight:400">Nombre d'élécteurs:  <span style="color:red; font-weight:bolder"><?=$listesEl['nombreElecteurs']?></span></p>
                </div>
            </div>
        <?php endif?>

        <div class="my-3 row" style="width:100%; text-align:center;position:relative; left:10%">
            <?php foreach($candidats as $candidat): ?>
                <div class="box d-flex align-items-center justify-content-center flex-column col-md-3">
                    <img src="/<?=$candidat['image']?>" alt="">
                    <div class="d-flex align-items-center justify-content-center flex-column candidat-info">
                        <h2 style="font-family:monospace;"><?=$candidat['nom']?></h3>
                        <h3>Numero: <span><?=$candidat['numero']?></span></h3>
                        <h3>Partie: <span><?=$candidat['partie']?></span></h3>
                        <input type="number" class="candidats form-control candidat-<?=$candidat['numero']?>" required name="resultat-<?=$candidat['numero']?>" placeholder="Voie obtenue...">
                        <input type="hidden" name="numeroCandidat-<?=$candidat['numero']?>" value="<?=$candidat['numero']?>">
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <input type="submit" value="Valider" class="btn btn-primary" style="width:50%">
    </form>
</div>