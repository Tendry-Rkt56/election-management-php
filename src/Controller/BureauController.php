<?php

namespace App\Controller;

use App\Manager;

class BureauController extends Controller
{

    public function editBureau ($id)
    {
        $bureau = Manager::getManager()->getEntity('bureau')->getBureau($id);
        return $this->view('admin.editBureau', compact('bureau', 'centres'));
    }


}

?>