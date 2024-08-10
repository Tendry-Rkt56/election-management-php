<?php

namespace App\Controller;

use App\Manager;

class UsersController extends Controller {

    public function loginView () 
    {
        return $this->view('users.loginView');
    }

    public function login ($data = [])
    {
        $login = Manager::getManager()->getEntity('user')->login($data);
        if ($login) {
            header ('Location: /Users');
            exit();
        }
        else {
            header ('Location: /Users/loginView?error=Identifiant incorrect');
            exit();
        }
    }

    public function logout () 
    {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: /Users/loginView');
        exit();
    }

    public function index () 
    {
        return $this->view ('users.index');
    }

    public function resultForm ($data = [])
    {
        $codeBv = isset($data['codeBv']) && $data['codeBv'] !== null ? $data['codeBv'] : null;
        $provinces = Manager::getManager()->getEntity('province')->getAllProvinces();
        $bureaux = Manager::getManager()->getEntity('bureau')->getBureaux();
        $candidats = Manager::getManager()->getEntity('candidat')->getAllCandidats();
        $listesEl = Manager::getManager()->getEntity('resultat')->sumResult($codeBv);
        return $this->view ('users.resultForm', compact('provinces', 'bureaux', 'candidats', 'listesEl'));
    }

    public function insertResult ($data = [])
    {
        $insert = Manager::getManager()->getEntity('resultat')->insertResult($data);
        if ($insert['status']) {
            header('Location: /Users/success?codeBv='.$data['codeBv']);
            exit();
        }
        else{
            header ('Location: /Users/errors?error='.$insert['messages'].'&nombreVotants='.$insert['nombreVotants'].'&nombreElecteurs='.$insert['nombreElecteurs']);
            exit();
        }
    }

    public function viewResult ()
    {
        return $this->view('users.success');
    }

    public function errorResult () 
    {
        return $this->view('users.errors');
    }

    public function createView ()
    {
        return $this->view('users.create');
    }

    public function updateView ($id)
    {   
        $user = Manager::getManager()->getEntity('user')->getUser($id);
        return $this->view('users.updateProfil', compact('user'));
    }

    public function updateProfil ($id, $data = [])
    {
        $response = Manager::getManager()->getEntity('user')->update($id, $data);
        if ($response['status']) {
            $_SESSION['success'] = 'Vos informations de connexion ont bien été modifiées';
            header ('Location: /Users');
            exit();
        }
        else {
            $_SESSION['error'] = $response['message'];
            header ('Location: /Users/update/'.$_SESSION['user']['idUsers']);
            exit();
        }
    }

    public function insertDemandeAndNotif ($data = [])
    {
        $valeur = "Un nouvel utilisateur $data[nom] $data[prenom] demande une inscription avec le N° matricule $data[matricule]";
        $idNotif = Manager::getManager()->getEntity('notifications')->insertNotifications($valeur);
        $result = Manager::getManager()->getEntity('demandes')->insertDemandes($idNotif, $data);
        if ($result) {
            header ('Location: /Users/loading');
            exit();
        }
    }

}

?>