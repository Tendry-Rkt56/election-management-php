<style>
    .containers {
        position:absolute;
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
    }
</style>
<div class="container containers">
    <form action="/Admin/insertBureau" method="POST" class="form d-flex container-sm align-items-center justify-content-center flex-column gap-5">
        <div style="width:60%" class="d-flex align-items-center justify-content-center flex-row gap-2 my-3">
            <label for="nomBureau" style="width:40%" class="fw-bold">Nom du bureau:</label>
            <input type="text" required name="nomBureau" class="form-control" style="width:60%" placeholder="Nom du bureau...">
        </div>
        <div style="width:60%" class="d-flex align-items-center justify-content-center flex-row gap-2 mb-3">
            <label for="codeBv" style="width:40%" class="fw-bold">CodeBV:</label>
            <input type="number" required name="codeBv" class="form-control" style="width:60%" placeholder="CodeBV...">
        </div>
        <div style="width:60%" class="d-flex align-items-center justify-content-center flex-row gap-2 mb-4">
            <label for="idCentre" style="width:40%" class="fw-bold">Centre associée:</label>
            <select type="number" required name="idCentre" class="form-control" style="width:60%">
                <?php foreach($centres as $centre): ?>
                    <option value="<?=$centre['idCentre']?>"><?=$centre['nomCentre']?></option>
                <?php endforeach?>
            </select>
        </div>
        <input type="submit" style="width:20%;" value="Ajouter" class="btn btn-primary">
    </form>
</div>