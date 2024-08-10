<?php
    if (session_status() == PHP_SESSION_NONE) session_start();
    $uri = $_SERVER['REQUEST_URI'];
?>
<header>
    <div class="logo mx-3">
        <h3><span>Fif</span>idianana</h3>
    </div>
    <nav>
        <ul class="my-1">
            <li><a href="/Candidats" <?php if(strpos($uri, '/Candidats') !== false): ?> style="color:blue;" <?php endif ?> >Les candidats</a></li>
            <li><a href="/Resultats/general" <?php if(strpos($uri, '/Resultats') !== false): ?> style="color:blue;" <?php endif ?> >Voir les résultats</a></li>
        </ul>
    </nav>
    <div class="users d-flex align-items-center justify-content-around align-items-center flex-row">
        <?php if (isset($_SESSION['admin']['nom']) || !empty($_SESION['admin']['nom'])): ?>
            <div class="d-flex align-items-center align-items-center flex-row mx-3">
                <h3 style="font-size:19px; font-family:monospace; font-weight:bold;" class="mx-2"><?=$_SESSION['admin']['nom']?></h3>
                <h3 style="font-size:18px; font-family:monospace; font-weight:200; font-style:oblique;"><?=$_SESSION['admin']['prenom']?></h3>
            </div>
            <?php elseif (isset($_SESSION['user']['nom']) || !empty($_SESION['user']['nom'])): ?>
                <div class="d-flex align-items-center align-items-center flex-row mx-3">
                    <h3 style="font-size:19px; font-family:monospace; font-weight:bold;" class="mx-2"><?=$_SESSION['user']['nom']?></h3>
                    <h3 style="font-size:18px; font-family:monospace; font-weight:200; font-style:oblique;"><?=$_SESSION['user']['prenom']?></h3>
                </div>
        <?php endif ?>
        <?php if (isset($_SESSION['admin'])): ?>
            <form action="/Admin/logout" method="GET">
                <!-- <input type="submit" value="Se déconnecter" class="btn btn-primary"> -->
                <div id="navigation" class="d-flex align-items-center justify-content-center flex-column">
                    <div class="my-1 ligne-1" style="background:black;width:40px;height:1px;"></div>
                    <div class="my-1 ligne-2" style="background:black;width:40px;height:1px;"></div>
                    <div class="my-1 ligne-3" style="background:black;width:40px;height:1px;"></div>
                </div>
            </form>
        <?php elseif (isset($_SESSION['user'])):?>
            <form action="/Users/logout" method="GET">
                <input type="submit" value="Se déconnecter" class="btn btn-primary">
            </form>
        <?php else:?>
            <select name="connexion" class="form-control" id="header" style="width:40%">
                <option class="header-options" value="">Connexion</option>
                <option class="header-options" value="admin">En tant qu'administrateur</option>
                <option class="header-options" value="user">En tant qu'utilisateur</option>
            </select>
        <?php endif?>
    </div>
</header>