<?php

class DAO_plan {

    //Permet le chargement d'un objet
    public static function LoadOne($id_plan) {
        try {
            global $connexion;

            // on récupere l'objet
            $req = $connexion->prepare('SELECT * FROM plan WHERE idPLAN = :id');
            $req->execute(array('id' => $id_plan));

            // pour chaque résultat :
            while($ligne = $req->fetchObject()) {
                //On construit l'objet avec les résultats de la requete
                $objPlan = new plan($ligne->idPlan, $ligne->name, $ligne->duration, $ligne->storageSpace, $ligne->bandwidth, $ligne->dailyTransferQuota);
            }

            // on ferme le jeu d'essai
            $req->closeCursor();

            return $objPlan;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //Permet le chargement de tous les objet
    public static function LoadAll() {
        try {
            global $connexion;
            $col_plan = new Collection();

            // on récupere tous les objets
            $req = $connexion->prepare('SELECT * FROM plan');
            $req->execute(array());

            while($ligne = $req->fetchObject()) {
                //On construit l'objet avec les résultats de la requete
                $objPlan = new plan($ligne->idPLAN, $ligne->name, $ligne->duration, $ligne->storageSpace, $ligne->bandwidth, $ligne->dailyTransferQuota);

                //On l'ajoute a la collection
                $col_plan->Add($objPlan);
            }

            // on ferme le jeu d'essai
            $req->closeCursor();

            return $col_plan;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

        //Permet le chargement de tous les objet
    public static function LoadAllWithoutAdminPlan() {
        try {
            global $connexion;
            $col_plan = new Collection();

            // on récupere tous les objets
            $req = $connexion->prepare('SELECT * FROM plan WHERE name <> :name');
            $req->execute(array('name' => 'admin'));

            while($ligne = $req->fetchObject()) {
                //On construit l'objet avec les résultats de la requete
                $objPlan = new plan($ligne->idPLAN, $ligne->name, $ligne->duration, $ligne->storageSpace, $ligne->bandwidth, $ligne->dailyTransferQuota);

                //On l'ajoute a la collection
                $col_plan->Add($objPlan);
            }

            // on ferme le jeu d'essai
            $req->closeCursor();

            return $col_plan;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //Permet de compter le nombre d'objet
    public static function Count() {
        try {
            global $connexion;

            // on récupere l'objet
            $req = $connexion->prepare('SELECT count(*) as NB FROM plan');
            $req->execute();

            // pour chaque résultat :
            while($ligne = $req->fetchObject()) {
                //On construit l'objet avec les résultats de la requete
                $nb = $ligne->NB;
            }

            // on ferme le jeu d'essai
            $req->closeCursor();

            return $nb;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //Permet de compter le nombre d'objet
    public static function nbUsersByPlan() {
        try {
            global $connexion;

            // on récupere l'objet
            $req = $connexion->prepare('SELECT p.name, count(idUser) as NBUSER FROM plan p, user u WHERE u.idPlan = p.idPlan and p.name <> :name GROUP BY p.idPlan');
            $req->execute(array('name' => 'admin'));

            $result = $req->fetchAll(PDO::FETCH_ASSOC);

            // on ferme le jeu d'essai
            $req->closeCursor();

            return $result;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //Permet de compter le nombre d'objet
    public static function nbFreeUsers() {
        try {
            global $connexion;

            // on récupere l'objet
            $req = $connexion->prepare('SELECT count(idUser) as NBFREEUSER FROM plan p, user u WHERE u.idPlan = p.idPlan and p.name = :name');
            $req->execute(array('name' => 'basic'));

            $result = $req->fetch(PDO::FETCH_ASSOC);

            // on ferme le jeu d'essai
            $req->closeCursor();

            return $result;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //Permet de compter le nombre d'objet
    public static function nbPaidUsers() {
        try {
            global $connexion;

            // on récupere l'objet
            $req = $connexion->prepare('SELECT count(idUser) as NBPAIDUSER FROM plan p, user u WHERE u.idPlan = p.idPlan and p.name <> :name and p.name <> :name2');
            $req->execute(array('name' => 'admin',
                                'name2' => 'basic'
                            ));

            $result = $req->fetch(PDO::FETCH_ASSOC);

            // on ferme le jeu d'essai
            $req->closeCursor();

            return $result;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //Ajout d'un objet dans la base de données
    public static function Insert($plan) {
        try {
            global $connexion;

            $req = $connexion->prepare('INSERT INTO plan VALUES(null, :name, :duration, :storageSpace, :bandwidth, :dailyTransferQuota)');
            $count = $req->execute(array(
                'name' => $plan->getName(),
                'duration' => $plan->getDuration(),
                'storageSpace' => $plan->getStorageSpace(),
                'bandwidth' => $plan->getBandwitdh(),
                'dailyTransferQuota' => $plan->getDailyTransferQuota()
                ));

            // on compte le nombre de ligne affectée
            if($count > 0)
                // on recupere l'id de la photo qui vient d'etre inserée et on la retourne
                return $connexion->lastInsertId();
            else
                return false;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //Modification d'un objet dans la base de données
    public static function Update($plan) {
        try {
            global $connexion;

            $req = $connexion->prepare('UPDATE plan SET name = :name, duration = :duration, storageSpace = :storageSpace, bandwidth = :bandwidth, dailyTransferQuota = :dailyTransferQuota WHERE idPlan = :idPlan');
            $req->execute(array(
                'idPlan' => $plan->getIdPlan(),
                'name' => $plan->getName(),
                'duration' => $plan->getDuration(),
                'storageSpace' => $plan->getStorageSpace(),
                'bandwidth' => $plan->getStorageSpace(),
                'dailyTransferQuota' => $plan->getDailyTransferQuota()
                ));

            // on compte le nombre de ligne affectée
            if($req->rowCount() > 0)
                return true;
            else
                return false;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //Permet de supprimer un objet
    public static function Delete($id_plan) {
        try {
            global $connexion;

            // on récupere l'objet
            $req = $connexion->prepare('DELETE FROM plan WHERE idPLAN= :id');
            $req->execute(array('id' => $id_plan));

            // on compte le nombre de ligne affectée
            if($req->rowCount() > 0)
                return true;
            else
                return false;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
}
?>