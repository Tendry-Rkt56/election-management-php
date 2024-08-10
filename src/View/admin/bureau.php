<style>
    .containers {
        position:absolute;
        top:10%;
        left:6%;    
    }
</style>
<div class="container containers">

    <div class="container-fluid d-flex align-items-center justify-content-center flex-column">
        <?php if (isset($_GET['delete'])): ?>
            <div class="container-sm alert alert-danger mt-5">
                <?=$_GET['delete']?>
            </div>
        <?php endif?>
        <?php if (isset($_GET['update'])): ?>
            <div class="container-sm alert alert-info mt-5">
                <?=$_GET['update']?>
            </div>
        <?php endif?>
        <?php if (isset($_GET['success'])): ?>
            <div class="container-sm alert alert-info mt-5">
                <?=$_GET['success']?>
            </div>
        <?php endif?>
        <div class="container d-flex align-items-center justify-content-center flex-row">
            <form style="width:80%" action="" class="my-5 container d-flex align-items-center justify-content-center flex-row" method="GET">
                <div class="d-flex align-items-center justify-content-center flex-row mx-5" style="width:80%">
                    <label for="centre" class="" style="font-weight:bold; width:30%">Centre associée:</label>
                    <select name="centre"  class="form-control" id="centre" style="width:70%">
                        <?php $centreID = $_GET['centre'] == null ? null : $_GET['centre']?>
                        <option <?php if ($centreID == -1): ?> selected <?php endif?> value="-1">Tous</option>
                        <?php foreach($centres as $centre): ?>
                            <option <?php if ($centre['idCentre'] == $centreID) :?> selected <?php endif ?> value="<?=$centre['idCentre']?>"><?=$centre['nomCentre']?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <input type="submit" class="btn btn-primary" value="Séléctionner">
            </form>
            <div class="mx-5" style="width:20%">
                <a href="/Admin/createBureau" class="btn btn-secondary">Ajouter un bureau de votes</a>
            </div>
        </div>
    </div>

    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nom du bureau</th>
                <th>Centre associée</th>
                <th>Code BV</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($bureaux)): ?>
                <?php foreach($bureaux as $bureau): ?>
                    <tr>
                        <td><?=$bureau['nomBureau']?></td>
                        <td><?=$bureau['nomCentre']?></td>
                        <td><?=$bureau['codeBv']?></td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center flex-row">
                                <a class="btn btn-success mx-1" href="/Admin/bureau/edit/<?=$bureau['codeBv']?>">Modifier</a>
                                <a class="btn btn-primary mr-1" href="/Admin/bureau/editResult/<?=$bureau['codeBv']?>">Voir les resultats</a>
                                <form method="POST" action="/Admin/bureau/delete/<?=$bureau['codeBv']?>">
                                    <input type="submit" class="btn btn-danger" value="Supprimer">
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach?>
            <?php else:?>
                <tr>
                    <td colspan="4"  style="text-align:center;" class="alert alert-danger">Pas encore de bureaux associé à ce centre de vote</td>
                </tr>
            <?php endif?>
        </tbody>
    </table>

    <div class="container my-4">
        <?php for ($i = 1; $i <= $maxPages; $i++): ?>
            <?php $class = $i == $page ? 'btn-primary' : 'btn-outline-primary'?>
            <a class="btn btn-sm <?=$class?>" href="/Admin/bureau/<?=$i?>"><?=$i?></a>
        <?php endfor ?>
    </div>
</div>