<?php 
    $uri = $_SERVER['REQUEST_URI'];
    $class = "actives";
?>
<div class="container-navigation">
    <div class="content d-flex align-items-center justify-content-center">
        <ul style="height:100%;" class="d-flex align-items-center justify-content-center flex-column">
            <li class="my-5 w-100">
                <a class="w-100 <?php if (strpos($uri,"/bureau") !== false): ?> btn btn-info <?php endif ?>" href="/Admin/bureau">Bureau</a>
            </li>
            <li class="my-5 w-100">
                <a class="w-100 <?php if (strpos($uri,"/candidats") !== false): ?> btn btn-info <?php endif ?>" href="/Admin/candidats">Candidats</a>
            </li>
            <li class="my-5 w-100">
                <a class="w-100 <?php if (strpos($uri,"/users") !== false):?> btn btn-info <?php endif ?>" href="/Admin/users">Utilisateurs</a>
            </li>
            <li class="my-5 w-100">
                <a class="logout btn btn-dark w-100" href="/Admin/logout">Deconnexion</a>
            </li>
        </ul>
    </div>
</div>