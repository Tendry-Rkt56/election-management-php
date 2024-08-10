<?php 
    if (session_status() == PHP_SESSION_NONE) session_start();
?>
<style>
    .containers {
        position:absolute;
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
    }

    .form {
        position:relative;
        height:auto;
        width:100%;
        padding:20px 20px;
        box-shadow:0 0 10px rgba(0,0,0,0.4);
        border-radius:6px;
    }

    .form .home {
        position:absolute;
        top:2%;
        left:2%;
    }

    .form .home img {
        width:20px;
        height:20px;
    }

    .span {
        border-bottom:2px solid blueviolet;
    }
</style>

<div class="containers container">
    <form action="/Users/updated/<?=$_SESSION['user']['idUsers']?>" method="POST" class="form d-flex container align-items-center justify-content-center flex-column gap-5">
        
        <div style="text-align:center;" class="my-4">
            <h2 style="font-style:normal; font-family:monospace; color:#262626"><span class="span">Mod</span>ifier vos informations</h2>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <p style="color:red" class="d-flex align-items-center justify-content-center flex-row gap-2">
                <?=$_SESSION['error']?>
            </p>
            <?php 
                unset($_SESSION['error']);
            ?>
        <?php endif?>

        <a href="/Users" class="home">
            <img src="/image/icon/home.png" alt="">
        </a>

        <div class="row container-fluid">
            <div style="width:80%" class="col-md-6 d-flex align-items-center justify-content-center flex-row gap-2 my-2">
                <label for="email" style="width:40%;font-weight:bolder" class="fw-bold">Votre nom:</label>
                <input type="text" required name="nom" class="form-control" value="<?=$user['nom']?>" style="width:60%" placeholder="Nom...">
            </div>
            <div style="width:80%" class="col-md-6 d-flex align-items-center justify-content-center flex-row gap-2 my-2">
                <label for="email" style="width:40%;font-weight:bolder" class="fw-bold">Votre prénom:</label>
                <input type="text" required name="prenom" class="form-control" value="<?=$user['prenom']?>" style="width:60%" placeholder="Prénom...">
            </div>
        </div>

        <div class="row container-fluid">
            <div style="width:80%" class="col-md-6 d-flex align-items-center justify-content-center flex-row gap-2 my-2">
                <label for="email" style="width:40%;font-weight:bolder" class="fw-bold">Votre email:</label>
                <input type="email" required name="email" class="form-control" value="<?=$user['email']?>" style="width:60%" placeholder="exemple@gmail.com">
            </div>
            <div style="width:80%" class="col-md-6 d-flex align-items-center justify-content-center flex-row gap-2 my-2">
                <label for="password" style="width:40%;font-weight:bolder" class="fw-bold">Mot de passe actuel:</label>
                <input type="text" required name="password" class="form-control" style="width:60%">
            </div>
        </div>

        <div class="row container-fluid">
            <div style="width:80%" class="col-md-6 d-flex align-items-center justify-content-center flex-row gap-2 my-2">
                <label for="newpassword" style="width:40%;font-weight:bolder" class="fw-bold">Nouveau mot de passe:</label>
                <input type="text" required name="newpassword" class="form-control" style="width:60%">
            </div>
            <div style="width:80%" class="col-md-6 d-flex align-items-center justify-content-center flex-row gap-2 my-2">
                <label for="confirm" style="width:40%;font-weight:bolder" class="fw-bold">Confirmer:</label>
                <input type="text" required name="confirm" class="form-control" style="width:60%">
            </div>
        </div>
        <input type="submit" value="Modifier" class="btn btn-primary my-4">
    </form>
</div>