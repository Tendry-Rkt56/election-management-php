<style>
    .containers {
        position:absolute;
        top:15%;
        left:5%;
    }

    .content {
        height:80vh;
        box-shadow:0 0 10px rgba(0,0,0,0.4);
    }

    .box-image {
        width:50%;
        height:100%;
    }

    .box-image img {
        width:100%;
        height:100%;
    }

    .form {
        width:50%;
        height:100%;
    }
</style>

<div class="container containers">
    <div class="content container-fluid d-flex align-items-center justify-content-center flex-row">
        <div class="box-image">
            <img src="/<?=$candidat['imageCandidat']?>" alt="">
        </div>
        <form method="POST" enctype="multipart/form-data" class="form vstack d-flex align-items-center justify-content-center flex-column">
            <div class="mb-3 d-flex align-items-center justify-content-center flex-row" style="width:80%">
                <label for="" style="width:30%;font-weight:bolder">Nom:</label>
                <input style="width:70%;" type="text" name="nom" class="form-control" value="<?=$candidat['nomCandidat']?>">
            </div>
            <div class="mb-3 d-flex align-items-center justify-content-center flex-row" style="width:80%">
                <label for="" style="width:30%;font-weight:bolder">Prénom:</label>
                <input style="width:70%;" type="text" name="prenom" class="form-control" value="<?=$candidat['prenomCandidat']?>">
            </div>
            <div class="mb-3 d-flex align-items-center justify-content-center flex-row"  style="width:80%">
                <label for="" style="width:30%;font-weight:bolder">Numéro:</label>
                <input style="width:70%;" type="number" name="numero" class="form-control" value="<?=$candidat['numeroCandidat']?>">
            </div>
            <div class="mb-3 d-flex align-items-center justify-content-center flex-row" style="width:80%">
                <label for="" style="width:30%;font-weight:bolder">Partie:</label>
                <input style="width:70%;" type="text" name="partie" class="form-control" value="<?=$candidat['partiePolitique']?>">
            </div>
            <div class="mb-3 d-flex align-items-center justify-content-center flex-row" style="width:80%">
                <label for="" style="width:30%;font-weight:bolder">Image:</label>
                <input style="width:70%;" type="file" name="image" class="form-control">
            </div>
            <input type="submit" value="Modifier" class="my-3 btn btn-primary">
        </form>
    </div>
</div>