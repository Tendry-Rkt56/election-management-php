<?php

namespace App\Controller;

use App\Manager;

class BureauController extends Controller {

    public function editBureau ($id)
    {
        $bureau = Manager::getManager()->getEntity('bureau')->getBureau($id);
        // $centres = App::getManager()->getEntity('centre')->getAllCentreVote();
        // var_dump($bureau,$centres);
        // die();
        return $this->view('admin.editBureau', compact('bureau', 'centres'));
    }


}

?>