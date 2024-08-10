<div class="my-5 container d-flex align-items-center justify-content-center flex-column containers" id="containers">
    <form action="/Resultats/apercu" class="vstack gap-2 row d-flex align-items-center justify-content-center" id="form">
        <div class="col-md-6 d-flex align-items-center justify-content-center flex-row my-2">
            <label for="provinces" style="font-weight:bolder; width:20%" class="mx-3 fw-bolder">Provinces</label>
            <select name="provinces" id="provinces" class="form-control" style="width:80%">
                <option value="">Séléctionner une province</option>
                <?php foreach ($provinces as $province): ?>
                    <option style="font-weight:bolder" class="form-control" value="<?=$province['idProvince']?>"><?=$province['nomProvince']?></option>    
                <?php endforeach ?>    
            </select>
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-center flex-row my-2">
            <label for="regions" style="font-weight:bolder; width:20%" class="mx-3 fw-bolder">Régions</label>
            <select name="regions" id="regions" class="form-control" style="width:80%">
                <option value="">Séléctionner une province avant</option>    
            </select>
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-center flex-row my-2">
            <label for="districts" style="font-weight:bolder; width:20%" class="mx-3 fw-bolder">Districts</label>
            <select name="districts" id="districts" class="form-control"  style="width:80%">
                <option value="">Séléctionner une région avant</option>    
            </select>
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-center flex-row my-2">
            <label for="communes" style="font-weight:bolder; width:20%" class="mx-3 fw-bolder">Communes</label>
            <select name="communes" id="communes" class="form-control" style="width:80%">
                <option value="">Séléctionner une district avant</option>    
            </select>
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-center flex-row my-2">
            <label for="fokontany" style="font-weight:bolder; width:20%" class="mx-3 fw-bolder">Fokontany</label>
            <select name="fokontany" id="fokontany" class="form-control" style="width:80%">
                <option value="">Séléctionner une commune avant</option>    
            </select>
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-center flex-row my-2">
            <label for="centrevotes" style="font-weight:bolder; width:20%" class="mx-3 fw-bolder">Centre de votes</label>
            <select name="centrevotes" id="centrevotes" class="form-control" style="width:80%">
                <option value="">Séléctionner le fokontany avant</option>    
            </select>
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-center flex-row my-2">
            <label for="bureaudevotes" style="font-weight:bolder; width:30%" class="mx-3 fw-bolder">Bureau de votes</label>
            <select name="bureaudevotes" id="bureaudevotes" class="form-control" style="width:70%">
                <option value="">Séléctionner le centre de vote avant</option>    
            </select>
        </div>
        <input type="submit" value="Aperçu" class="btn btn-primary hidden" id='hidden'>
    </form>
</div>