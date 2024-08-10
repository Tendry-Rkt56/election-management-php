<?php

namespace App\Controller;

use App\Manager;

class ResultatsController extends Controller {

    private function getProvince ($data = []) 
    {
        $resultats = Manager::getManager()->getEntity('resultat')->resultats($data);
        if (isset($resultats)) {
            $provinces = [];
            $lastProvince = null;
            foreach($resultats as $result) {
                if ($result['nomProvince'] != $lastProvince) {
                    $provinces[] = $result['nomProvince'];
                }
                $lastProvince = $result['nomProvince'];
            }
            return $provinces;
        }
        return null;
    }

    public function resultatGeneral ($data = []) 
    {
        $resultats = Manager::getManager()->getEntity('resultat')->resultats($data);
        $candidats = Manager::getManager()->getEntity('candidat')->getTotalVoie($data);
        $provinces = $this->getProvince($data);
        $totalElecteurs = $this->totalStatistique($data);
        // var_dump($resultats);
        return $this->view('resultats.general', compact('candidats', 'totalElecteurs', 'resultats', 'provinces'));
    }

    public function index ()
    {
        $provinces = Manager::getManager()->getEntity('province')->getAllProvinces();
        return $this->view('resultats.index', compact('provinces'));
    }

    /**
     * Pour le total des informations dans la liste electeurs
     * @param data array
     * @return array
     */
    private function totalStatistique ($data = [])
    {   
        $resultats = Manager::getManager()->getEntity('resultat')->resultats($data);
        $totalVotants = 0;
        $totalElecteurs = 0;
        $totalVoteNull = 0;
        $totalVoteBlanche = 0;
        if (isset($resultats) && count($resultats) !== 0) {
            for ($i = 0; $i < count($resultats); $i++) {
                $totalElecteurs += $resultats[$i]['nombreElecteurs'];
                $totalVotants += $resultats[$i]['nombresVotants'];
                $totalVoteNull += $resultats[$i]['voteNull'];
                $totalVoteBlanche += $resultats[$i]['voteBlanche'];
            }
            return [
                "totalElecteurs" => $totalElecteurs,
                "totalVotants" => $totalVotants,
                "totalVoteNull" => $totalVoteNull,
                "totalVoteBlanche" => $totalVoteBlanche,
            ];
        }
        return null;
    }
    
    /**
     * Pour l'affichaes des resultats en fonction des choix de l'user
     * @param data array
     * @return view
    */
    public function afficheResultats (array $data = [])
    {
        $resultats = Manager::getManager()->getEntity('resultat')->resultats($data);
        $voies = Manager::getManager()->getEntity('candidat')->getTotalVoie($data);
        $totalElecteurs = $this->totalStatistique($data);
        $provinces = $this->getProvince($data);
        return $this->view ('resultats.apercu', compact('resultats', 'totalElecteurs', 'voies', 'provinces'));
    }

    public function sumResult ($codeBv)
    {
        $resultats = Manager::getManager()->getEntity('resultat')->sumResult($codeBv);
    }

}

?>