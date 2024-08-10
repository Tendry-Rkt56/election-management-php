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

    .box {
        box-shadow:0 0 5px rgba(0, 0, 0, .5);
        width:400px;
        height:280px;
        border-radius:6px;
        text-decoration:none;
        color:white;
    }

    .box-1 {
        background-color:#BE4304;
        padding:10px 10px;
    }

    .box-2 {
        background-color:#2C03A5;
    }

    .box:hover {
        text-decoration:none;
    }

    .successed {
        position:absolute;
        top:20%;
        left:50%;
        transform:translate(-50%,-50%);
    }
 
</style>
<div class="container containers">
    <?php if (isset($_SESSION['success'])): ?>
        <div class="d-flex align-items-center justify-content-center alert alert-success my-5">
            <?=$_SESSION['success']?>
        </div>
        <?php unset($_SESSION['success'])?>
    <?php endif?>
    
    <div class="d-flex align-items-center justify-content-center flex-row gap-3">
        <a href="/Users/resultForm" class="d-flex align-items-center justify-content-center flex-column gap-3 box box-1">
            <img src="/image/icon/4470310.png" alt="">
            <h3>Résultats</h3>
        </a>
        <a href="/Users/update/<?=$_SESSION['user']['idUsers']?>" class="d-flex align-items-center justify-content-center flex-column mx-5 gap-3 box box-2">
            <img src="/image/icon/11193518.png" alt="">
            <h3>Editer votre profil</h3>
        </a>
    </div>
</div>