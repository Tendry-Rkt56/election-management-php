<?php

namespace App\Controller;

use App\Manager;

class CandidatsController extends Controller {

    public function index ()
    {
        $candidats = Manager::getManager()->getEntity('candidat')->getAllCandidats();
        return $this->view ('candidats.index',compact('candidats'));
    }


}