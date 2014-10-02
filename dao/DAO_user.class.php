<?php

class DAO_user {

    //Permet le chargement d'un objet
    public static function LoadOne($id_user) {
        try {
            global $connexion;

            // on récupere l'objet
            $req = $connexion->prepare('SELECT * FROM user WHERE idUSER = :id');
            $req->execute(array('id' => $id_user));

            // pour chaque résultat :
            while($ligne = $req->fetchObject()) {
                //On construit l'objet avec les résultats de la requete
                $objUser = new user($ligne->idUSER, $ligne->pseudo, $ligne->password, $ligne->email, $ligne->registrationDate, $ligne->idPLAN);
            }

            // on ferme le jeu d'essai
            $req->closeCursor();

            return $objUser;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //Permet le chargement d'un objet
    public static function LoadByPseudo($pseudo_user) {
        try {
            global $connexion;

            // on récupere l'objet
            $req = $connexion->prepare('SELECT * FROM user WHERE pseudo = :pseudo');
            $req->execute(array('pseudo' => $pseudo_user));

            // pour chaque résultat :
            while($ligne = $req->fetchObject()) {
                //On construit l'objet avec les résultats de la requete
                $objUser = new user($ligne->idUSER, $ligne->pseudo, $ligne->password, $ligne->email, $ligne->registrationDate, $ligne->idPLAN);
            }

            // on ferme le jeu d'essai
            $req->closeCursor();

            return $objUser;
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
            $col_user = new Collection();

            // on récupere tous les objets
            $req = $connexion->prepare('SELECT * FROM user');
            $req->execute(array());

            while($ligne = $req->fetchObject()) {
                //On construit l'objet avec les résultats de la requete
                $objUser = new user($ligne->idUSER, $ligne->pseudo, $ligne->password, $ligne->email, $ligne->registrationDate, $ligne->idPLAN);

                //On l'ajoute a la collection
                $col_user->Add($objUser);
            }

            // on ferme le jeu d'essai
            $req->closeCursor();

            return $col_user;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
	
	//Permet le chargement de tous les objet
    /*public static function Rechercher($chaine) {
        try {
            global $connexion;
            $col_user = new Collection();

            // on récupere tous les objets
            $req = $connexion->prepare("SELECT * FROM user WHERE firstname like '%:chaine%' or lastname like '%:chaine%'");
            $req->execute(array(':chaine' => $chaine));

            while($ligne = $req->fetchObject()) {
                //On construit l'objet avec les résultats de la requete
            	$objUser = new user($ligne->idUser, $ligne->pseudo, $ligne->password, $ligne->email, $ligne->registrationDate, $ligne->idPlan);
                //On l'ajoute a la collection
                $col_user->Add($objUser);
            }

            // on ferme le jeu d'essai
            $req->closeCursor();

            return $col_user;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }*/

    //Permet de compter le nombre d'objet
    public static function Count() {
        try {
            global $connexion;

            // on récupere l'objet
            $req = $connexion->prepare('SELECT count(*) as NB FROM user');
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
    public static function CountByDate() {
        try {
            global $connexion;

            // on récupere l'objet
            $req = $connexion->prepare("SELECT DATE_FORMAT( registrationDate,  '%Y' ) AS  'year', DATE_FORMAT( registrationDate,  '%m' ) AS  'month', COUNT( idUser ) AS  'total' FROM user GROUP BY DATE_FORMAT( registrationDate,  '%Y%m' )");
            $req->execute();

            $result = $req->fetchAll(PDO::FETCH_ASSOC);

            // on ferme le jeu d'essai
            $req->closeCursor();

            return $result;

            return $nb;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    //Ajout d'un objet dans la base de données
    public static function Insert($user) {
        try {
            global $connexion;

            $req = $connexion->prepare('INSERT INTO user VALUES(null, :pseudo, :password, :email, :registrationDate, :idPlan)');
            $count = $req->execute(array(
                'pseudo' => $user->getPseudo(),
                'password' => $user->getPassword(),
                'email' => $user->getEmail(),
                'registrationDate' => $user->getRegistrationDate(),
                'idPlan' => $user->getIdPlan()
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
    public static function Update($user) {
        try {
            global $connexion;

            $req = $connexion->prepare('UPDATE user SET pseudo = :pseudo, password = :password, email = :email, registrationDate = :registrationDate, idPLAN = :idPlan where user.idUSER = :idUser');
            $req->execute(array(
                'idUser' => $user->getIdUser(),
                'pseudo' => $user->getPseudo(),
                'password' => $user->getPassword(),
                'email' => $user->getEmail(),
                'registrationDate' => $user->getRegistrationDate(),
                'idPlan' => $user->getIdPlan()
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
    public static function Delete($id_user) {
        try {
            global $connexion;

            // on récupere l'objet
            $req = $connexion->prepare('DELETE FROM user WHERE idUSER= :id');
            $req->execute(array('id' => $id_user));

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