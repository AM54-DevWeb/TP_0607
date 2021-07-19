<?php

namespace Controller;

class BaseController
{

    public function afficherVue($fichier = "index", $donnees = [])
    {
        //si la classe s'appelle Controller\AccueilController
        //on enlève les 11 caractères de "Controller\" et les 10
        //caractères de fin : "Controller"
        //On obtient la chaine "Accueil" dans $dossier
        $dossier =  substr(get_class($this), 11, -10);

        include("./View/" . $dossier . "/" . $fichier . ".php");
    }
}
