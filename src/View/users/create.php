<?php
    if (session_status() == PHP_SESSION_NONE) session_start();
?>
<style>
    .containers {
        position:absolute;
        top:60%;
        left:50%;
        transform:translate(-50%,-50%);
    }

    .form {
        position:relative;
        height:auto;
        width:70%;
        padding:20px 20px;
        box-shadow:0 0 10px rgba(0,0,0,0.4);
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
    <form action="/Users/create" method="POST" class="form d-flex container align-items-center justify-content-center flex-column gap-5">
        
        <?php if (isset($_SESSION['error'])): ?>
            <p class="d-flex align-items-center justify-content-center flex-row gap-2 my-4">
                <?=$_SESSION['error']?>
            </p>
            <?php 
                unset($_SESSION['error']);
                session_destroy();
            ?>
        <?php endif?>

        <a href="/Users" class="home">
            <img src="/image/icon/home.png" alt="">
        </a>

        <div style="text-align:center;" class="my-4">
            <h2 style="font-style:normal; font-family:monospace; color:#262626"><span class="span">Cré</span>ation de compte</h2>
        </div>
        <div style="width:80%" class="d-flex align-items-center justify-content-center flex-row gap-2 my-2">
            <label for="nom" style="width:40%" class="fw-bold">Votre nom:</label>
            <input type="text" required name="nom" class="form-control" style="width:60%" placeholder="Votre nom...">
        </div>
        <div style="width:80%" class="d-flex align-items-center justify-content-center flex-row gap-2 my-2">
            <label for="prenom" style="width:40%" class="fw-bold">Votre prénom:</label>
            <input type="text" required name="prenom" class="form-control" style="width:60%" placeholder="exemple@gmail.com">
        </div>
        <div style="width:80%" class="d-flex align-items-center justify-content-center flex-row gap-2 my-2">
            <label for="email" style="width:40%" class="fw-bold">Votre email:</label>
            <input type="email" required name="email" class="form-control" style="width:60%" placeholder="exemple@gmail.com">
        </div>
        <div style="width:80%" class="d-flex align-items-center justify-content-center flex-row gap-2 my-2">
            <label for="matricule" style="width:40%" class="fw-bold">Votre N° matricule:</label>
            <input type="text" required name="matricule" class="form-control" style="width:60%" placeholder="exemple@gmail.com">
        </div>
        <div style="width:80%" class="d-flex align-items-center justify-content-center flex-row gap-2 mb-4">
            <label for="password" style="width:40%" class="fw-bolder">Votre mot de passe:</label>
            <input type="text" required name="password" class="form-control" style="width:60%">
        </div>
        <input type="submit" value="Créer mon compte" class="btn btn-primary">
    </form>
</div>