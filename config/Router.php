<?php

use App\App;
use App\Controller\AdminController;
use App\Controller\CandidatsController;
use App\Controller\ErrorController;
use App\Controller\ProvincesController;
use App\Controller\ResultatsController;
use App\Controller\UsersController;
use App\Middleware\AdminMiddleware;
use App\Middleware\UsersMiddleware;

require_once '../vendor/altorouter/altorouter/AltoRouter.php';


$router = new AltoRouter();

$router->map('GET', '/', function () {
    $controller = new ErrorController();
    $controller->index();
});

// Routes pour les administrateurs
$router->map('GET', '/Admin/loginView', function () {
    AdminMiddleware::redirect();
    $controller = new AdminController();
    $controller->loginView();
});
$router->map('POST', '/Admin/login', function () {
    AdminMiddleware::redirect();
    $controller = new AdminController();
    $controller->login($_POST);
});

$router->map('GET', '/Admin/logout', function () {
    AdminMiddleware::redirect();
    $controller = new AdminController();
    $controller->logout();
});

$router->map('GET', '/Admin', function () {
    AdminMiddleware::redirect();
    $controller = new AdminController();
    $controller->index();
});
$router->map('GET', '/Admin/index', function () {
    AdminMiddleware::redirect();
    $controller = new AdminController();
    $controller->index();
});

$router->map('GET', '/Admin/candidats', function () {
    AdminMiddleware::redirect();
    $controller = new AdminController();
    $controller->candidats();
});

$router->map('GET', '/Admin/candidats/create', function () {
    AdminMiddleware::redirect();
    $controller = new AdminController();
    $controller->createCandidat();
});

$router->map('POST', '/Admin/candidats/create', function () {
    AdminMiddleware::redirect();
    $controller = new AdminController();
    $controller->storeCandidat($_POST, $_FILES);
});

$router->map('GET', '/Admin/candidats/update/[i:id]', function ($id) {
    AdminMiddleware::redirect();
    $controller = new AdminController();
    $controller->editCandidat($id);
});

$router->map('POST', '/Admin/candidats/update/[i:id]', function ($id) {
    AdminMiddleware::redirect();
    $controller = new AdminController();
    $controller->updateCandidat($id, $_POST, $_FILES);
});

$router->map('GET', '/Admin/candidats/delete', function () {
    AdminMiddleware::redirect();
    $controller = new AdminController();
    $controller->deleteCandidats();
});

$router->map('GET', '/Admin/candidat/delete/[i:id]', function ($id) {
    AdminMiddleware::redirect();
    $controller = new AdminController();
    $controller->deleteCandidat($id);
});

$router->map('GET', '/Admin/bureau', function () {
    AdminMiddleware::redirect();
    $controller = new AdminController();
    $controller->bureau($_GET);
});

$router->map('GET', '/Admin/bureau/[i:id]', function ($id) {
    $controller = new AdminController();
    $controller->bureau($_GET, $id);
});

$router->map('GET', '/Admin/createBureau', function () {
    AdminMiddleware::redirect();
    $controller = new AdminController();
    $controller->createBureau($_POST);
});

$router->map('POST', '/Admin/insertBureau', function () {
    AdminMiddleware::redirect();
    $controller = new AdminController();
    $controller->insertBureau($_POST);
});

$router->map('GET', '/Admin/bureau/edit/[i:id]', function ($id) {
    AdminMiddleware::redirect($_SERVER['REQUEST_URI']);
    $controller = new AdminController();
    $controller->editBureau($id);
});

$router->map('POST', '/Admin/update/[i:id]', function ($id) {
    AdminMiddleware::redirect();
    $controller = new AdminController();
    $controller->updateBureau($id, $_POST); 
});

$router->map('GET', '/Admin/bureau/editResult/[i:id]', function ($id) {
    AdminMiddleware::redirect();
    $controller = new AdminController();
    $controller->updateResult($id);
});

$router->map('POST', '/Admin/resultats/delete/[i:id]', function ($id) {
    AdminMiddleware::redirect();
    $controller = new AdminController();
    $controller->deleteResultats($id);
});

$router->map('GET', '/Admin/users', function () {
    AdminMiddleware::redirect();
    $controller = new AdminController();
    $controller->adminUsers($_GET);
});

$router->map('GET', '/Admin/users/delete/[i:id]', function ($id) {
    AdminMiddleware::redirect();
    $controller = new AdminController();
    $controller->deleteUsers($id);
});

$router->map('GET', '/Admin/notifications', function () {
    AdminMiddleware::redirect();
    $controller = new AdminController();
    $controller->notifications();
});

$router->map('GET', '/Admin/users/response/[i:id]', function ($id) {
    AdminMiddleware::redirect();
    $controller = new AdminController();
    $controller->responseUsers($id);
});

$router->map('GET', '/Admin/users/reject/[i:id]', function ($id) {
    AdminMiddleware::redirect();
    $controller = new AdminController();
    $controller->deleteNotification($id);
});

// Routes pour les administrateurs

//Routes pour l'affichage des resultats
$router->map('GET', '/Resultats', function () {
    $controller = new ResultatsController();
    $controller->index();
});

$router->map('GET', '/Resultats/general', function () {
    $controller = new ResultatsController();
    $controller->resultatGeneral($_GET);
});

$router->map('GET', '/Resultats/apercu', function () {
    $controller = new ResultatsController();
    $controller->afficheResultats($_GET);
});

$router->map('GET', '/Resultats/sumResultats', function () {
    $controller = new ResultatsController();
    $controller->sumResult(110103060103);
});
//Routes pour l'affichage des resultats

//Routes pour l'affichage des candidats
$router->map('GET', '/Candidats', function () {
    $controller = new CandidatsController();
    $controller->index();
});

//Routes pour l'affichage des candidats

//Routes pour les utilisateurs
$router->map('GET', '/Users/loginView', function () {
    UsersMiddleware::redirect();
    $controller = new UsersController();
    $controller->loginView();
});

$router->map('POST', '/Users/login', function () {
    UsersMiddleware::redirect();
    $controller = new UsersController();
    $controller->login($_POST);
});

$router->map('GET', '/Users', function () {
    UsersMiddleware::redirect();
    $controller = new UsersController();
    $controller->index();
});

$router->map('GET', '/Users/update/[i:id]', function ($id) {
    UsersMiddleware::redirect();
    $controller = new UsersController();
    $controller->updateView($id);
});
$router->map('POST', '/Users/updated/[i:id]', function ($id) {
    UsersMiddleware::redirect();
    $controller = new UsersController();
    $controller->updateProfil($id, $_POST);
});

$router->map('GET', '/Users/logout', function () {
    UsersMiddleware::redirect();
    $controller = new UsersController();
    $controller->logout();
});

$router->map('GET', '/Users/resultForm', function () {
    UsersMiddleware::redirect();
    $controller = new UsersController();
    $controller->resultForm($_GET);
});
$router->map('POST', '/Users/result', function () {
    UsersMiddleware::redirect();
    $controller = new UsersController();
    $controller->insertResult($_POST);
});
$router->map('GET', '/Users/success', function () {
    UsersMiddleware::redirect();
    $controller = new UsersController();
    $controller->viewResult($_GET);
});
$router->map('GET', '/Users/errors', function () {
    UsersMiddleware::redirect();
    $controller = new UsersController();
    $controller->errorResult();
});

$router->map('GET', '/Users/createView', function () {
    $controller = new UsersController();
    $controller->createView();
});

$router->map('POST', '/Users/create', function () {
    $controller = new UsersController();
    $controller->insertDemandeAndNotif($_POST);
});
//Routes pour les utilisateurs

$router->map('GET', '/[*]', function () {
    header('Location: /404.php');
    exit();
});

$match = $router->match();

if ($match !== null) {
    if (is_callable($match['target'])){
        call_user_func_array($match['target'], $match['params']);
    }
}
elseif ($match == null){
}

?>