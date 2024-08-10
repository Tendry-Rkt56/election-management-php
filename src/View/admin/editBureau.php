<style>
    .containers {
        position:absolute;
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
    }
    .hidden {
        visibility:hidden;
        transition:.4s;
    }
    .visible {
        visibility:visible;
        transition:.4s;
    }

    .form {
        box-shadow:0 0 10px rgba(0,0,0,0.4);
        padding:30px 30px;
    }

</style>

<!-- <?php var_dump($bureau)?> -->

<div class="container d-flex align-items-center justify-content-center flex-column containers" id="containers">
    <form action="/Admin/update/<?=$bureau['codeBv']?>" method="POST" class="container-fluid form vstack gap-2" style="text-align:center;" id="form">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-6 d-flex align-items-center justify-content-center flex-row my-4">
                <label for="nomBureau" style="font-weight:bolder; width:30%" class="mx-3 fw-bolder">Nom du bureau</label>
                <input type="text" name="nomBureau" id="nomBureau" class="form-control" style="width:70%;" placeholder="Nom du bureau" value="<?=$bureau['nomBureau']?>">
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center flex-row my-2">
                <label for="codeBv" style="font-weight:bolder; width:20%" class="mx-3 fw-bolder">CodeBV:</label>
                <input type="number" class="form-control" name="codeBv" style="width:80%" placeholder="CodeBV..." value="<?=$bureau['codeBv']?>">
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center flex-row my-2">
                <label for="centre" style="font-weight:bolder; width:30%" class="mx-3 fw-bolder">Centre de vote:</label>
                <select name="centre" id="centre" class="form-control" style="width:70%">
                    <?php foreach($centres as $centre): ?>
                        <option 
                            <?php if ($centre['idCentre'] == $bureau['idCentre']) :?> selected <?php endif ?> 
                            value="<?=$centre['idCentre']?>"><?=$centre['nomCentre']?>
                        </option>
                    <?php endforeach?>
                </select>
            </div>
        </div>
        <input type="submit" value="Modifier" style="text-align:center" class="my-4 btn btn-primary">
        
        <!-- <div class="col-md-6 d-flex align-items-center justify-content-center flex-row my-2">
            <label for="communes" style="font-weight:bolder; width:20%" class="mx-3 fw-bolder">Communes</label>
            <select name="communes" id="communes" class="form-control" style="width:80%">
                <option value="">Séléctionner une district avant</option>    
            </select>
        </div> -->
    </form>
</div>