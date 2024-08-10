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
        border-radius:2px;
        height:60vh;
        width:70%;
        padding:20px 20px;
        box-shadow:0 0 10px rgba(0,0,0,0.4);
    }

    .span {
        border-bottom:2px solid blueviolet;
    }
</style>

<div class="containers container">
    <form autocomplete="off" action="/Admin/login" method="POST" class="form d-flex container align-items-center justify-content-center flex-column gap-5">        
        
        <div style="text-align:center;" class="my-4">
            <h2 style="font-style:normal; font-family:monospace; color:#262626"><span class="span">Con</span>nexion administrateurs</h2>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <p style="color:red" class="d-flex align-items-center justify-content-center flex-row gap-2">
                <?=$_SESSION['error']?>
            </p>
            <?php 
                unset($_SESSION['error']);
            ?>
        <?php endif?>

        <div style="width:80%" class="d-flex align-items-center justify-content-center flex-row gap-2 my-4">
            <label for="email" style="width:40%" class="fw-bold">Votre email:</label>
            <input type="email" required name="email" class="form-control" style="width:60%" placeholder="exemple@gmail.com">
        </div>
        <div style="width:80%" class="d-flex align-items-center justify-content-center flex-row gap-2 mb-4">
            <label for="password" style="width:40%" class="fw-bold">Votre mot de passe:</label>
            <input type="text" required name="password" class="form-control" style="width:60%">
        </div>
        <input type="submit" value="Se connecter" class="btn btn-primary">
    </form>
</div>