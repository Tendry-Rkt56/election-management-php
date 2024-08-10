<?php

namespace App\Controller;

use App\Manager;

class AdminController extends Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function index ()
    {
        return $this->view('admin.index');        
    }

    public function loginView () 
    {
        return $this->view('admin.loginView');
    }

    public function login ($data = [])
    {
        if (Manager::getManager()->getEntity('admin')->doLogin($data)) {
            header ('Location: /Admin');
            exit();
        }
        header('Location: /Admin/loginView?error=Identifiant incorrect');
        exit();
    }

    public function logout () 
    {
        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
            session_destroy();
            header('Location: /Admin/loginView');
        }
    }

    public function createCandidat () 
    {
        return $this->view('admin.createCandidat');
    }

    public function storeCandidat ($data = [], $files = []) 
    {
        $response = Manager::getManager()->getEntity('candidat')->create($data, $files);
        if ($response['status']) {
            $_SESSION['success'] = 'Nouveau candidat crée';
            header('Location: /Admin/candidats');
            exit();
        }
        else {
            $_SESSION['error'] = $response['message'];
            header('Location: /Admin/candidats');
            exit();
        }
    }

    public function candidats ()
    {
        $candidats = Manager::getManager()->getEntity('candidat')->getAllCandidats();
        $isResult = Manager::getManager()->getEntity('candidat')->isResult();
        return $this->view('admin.candidats', compact('candidats','isResult'));
    }

    public function editCandidat ($id) 
    {
        $candidat = Manager::getManager()->getEntity('candidat')->edit($id);
        return $this->view('admin.updateCandidat', compact('candidat'));
    }

    public function updateCandidat ($id, $data = [], $files = []) 
    {
        $update = Manager::getManager()->getEntity('candidat')->update($id,$data, $files);
        if ($update['status']) {
            $_SESSION['success'] = 'Candidat mis à jour';
            header('Location: /Admin/candidats');
            exit();
        }
        else {
            $_SESSION['error'] = $update['message'];
            header('Location: /Admin/candidats');
            exit();
        }
    }

    public function deleteCandidats ()
    {
        $deleteCandidats = Manager::getManager()->getEntity('candidat')->deleteCandidats();
        $deleteResultats = Manager::getManager()->getEntity('candidat')->deleteAllResults(); 
        if ($deleteCandidats && $deleteResultats) {
            header('Location: /Admin/index');
            exit();
        }
        else{
            header('Location: /Admin/candidats');
            exit();
        }
    }

    public function deleteCandidat ($id) 
    {
        $delete = Manager::getManager()->getEntity('candidat')->deleteCandidat($id);
        // var_dump($delete);
        // die();
        if ($delete) {
            $_SESSION['error'] = "Candidat N° $id supprimé";
            header('Location: /Admin/candidats');
            exit();
        }
    }

    public function bureau ($data = [], int $page = 1) 
    {
        $limit = 7;
        $count = Manager::getManager()->getEntity('bureau')->countBureau();
        $maxPages = ceil($count / $limit);
        $bureaux = Manager::getManager()->getEntity('bureau')->getAllBureau($limit, $page, $data);
        $centres = Manager::getManager()->getEntity('bureau')->getAllCentre();
        $this->view('admin.bureau', [
            'bureaux' => $bureaux,
            'centres' => $centres,
            'page' => $page,
            'maxPages' => $maxPages,
        ]);
        // var_dump($bureaux);
    }

    public function createBureau () 
    {
        $centres = Manager::getManager()->getEntity('centre')->getAllCentreVote();
        return $this->view('admin.createBureau', compact('centres'));
    }

    public function insertBureau ($data = [])
    {
        $isInsert = Manager::getManager()->getEntity('bureau')->create($data);
        if ($isInsert) {
            header ('Location: /Admin/bureau');
            exit();
        }
        else {
            header ('Location: /Admin/createBureau?error=Veillez remplir tous les champs');
        }
    }

    public function editBureau ($id) 
    {
        $bureau = Manager::getManager()->getEntity('bureau')->getBureau($id);
        $centres = Manager::getManager()->getEntity('centre')->getAllCentreVote();
        return $this->view('admin.editBureau', compact('bureau','centres'));
    }

    public function updateBureau ($id, $data = [])
    {
        $bureau = Manager::getManager()->getEntity('bureau')->updateBureau($id, $data);
        if ($bureau) {
            header ('Location: /Admin/bureau?success=Bureau de votes modifiée');
        }
    }


    public function updateResult ($codeBv)
    {
        $results = Manager::getManager()->getEntity('resultat')->getAllResults($codeBv);
        $stat =  Manager::getManager()->getEntity('resultat')->getStatElecteurs($codeBv);
        $bureau = Manager::getManager()->getEntity('bureau')->getBureauAndCentre($codeBv);
        $candidats = Manager::getManager()->getEntity('candidat')->getResultCandidats($codeBv);
        return $this->view('admin.updateResult', compact('results', 'stat', 'bureau', 'candidats'));
    } 

    public function deleteResultats ($codeBv) 
    {
        if (Manager::getManager()->getEntity('resultat')->deleteResultats($codeBv)) {
            header ("Location: /Admin/bureau?delete=Le resultat dans le bureau avec le codeBv $codeBv a été supprimée");
            exit();
        }
        else {
            header ('Location: /Admin/bureau');
            exit();
        }
    }

    public function adminUsers ($data = []) 
    {
        $users = Manager::getManager()->getEntity('user')->getAllUsers($data);
        $unReadNotif = Manager::getManager()->getEntity('notification')->getUnReadNotif();
        return $this->view('admin.users', compact('users', 'unReadNotif'));
    }

    public function deleteUsers ($id)
    {
        if (Manager::getManager()->getEntity('user')->deleteUsers($id)) {
            header('Location: /Admin/users?delete=Utilisateur supprimée');
            exit();
        }
        else {
            header('Location:/Admin/users');
            exit();
        }
    }

    public function notifications ()
    {
        $notifs = Manager::getManager()->getEntity('notification')->getUnReadNotif();
        return $this->view('admin.notifications', compact('notifs'));
    }
    
    public function responseUsers ($id)
    {
        $response = Manager::getManager()->getEntity('notification')->getNotificationAndDemande($id);
        Manager::getManager()->getEntity('notification')->updateNotif($id);
        if ($response['status']) {
            $create = Manager::getManager()->getEntity('user')->insertUsers($id);
        }
        return $this->view('admin.reponse', compact('response','create'));
    }

    public function deleteNotification ($id) 
    {
        $delete = Manager::getManager()->getEntity('notification')->deleteNotification($id);
        Manager::getManager()->getEntity('notification')->updateNotif($id);
        return $this->view('admin.reject', compact('delete'));
    }

    
}

?>