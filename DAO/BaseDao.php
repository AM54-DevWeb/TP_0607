<?php

namespace DAO;

use Connexion;

class BaseDao
{
    public function findAll()
    {
        $connexion = new Connexion();

        //ex : si la classe s'appelle "DAO\UtilisateurDao"
        //$table contiendra "utilisateur"
        $table = strtolower(substr(get_class($this), 4, -3));

        $resultat = $connexion->query("SELECT * FROM " . $table);

        $listeUtilisateur = [];

        $nomClasseModel = "Model\\" . ucfirst($table);

        //pour chaque lignes (enregistrement) de la table
        foreach ($resultat->fetchAll() as $ligneResultat) {

            //on créer une instance de la classe (ex : new Utilisateur())
            //rappel : instance = un objet créé grâce à une classe
            $model = new $nomClasseModel();

            //pour chaque index du tableau $ligneResultat 
            //(cad pour chaque colonne de la table)
            foreach ($ligneResultat as $key => $valeur) {

                //on en déduit le setter (ex : setPrenom)
                $nomSetter =  "set" . ucfirst($key);

                //si le setter existe bien (pour exclure les colonnes numerotées)
                if (method_exists($nomClasseModel, $nomSetter)) {
                    //on appel le setter avec la valeur en paramètre
                    //ex : setPrenom("franck")
                    $model->$nomSetter($valeur);
                }
            }

            $listeUtilisateur[] = $model;
        }

        return $listeUtilisateur;
    }
}
