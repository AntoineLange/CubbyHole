<?php 

class user {
    private $p_idUser;
    private $p_pseudo;
    private $p_password;
    private $p_email;
    private $p_registrationDate;
	private $p_idPlan;


    public function __construct($idUser = null, $pseudo = null, $password = null, $email = null, $registrationDate = null, $idPlan = null) {
        $this->p_idUser = $idUser;
        $this->p_pseudo = $pseudo;
        $this->p_password = $password;
		$this->p_email = $email;
		$this->p_registrationDate = $registrationDate;
		$this->p_idPlan = $idPlan;
    }

    // ############################## Getters ##############################
    // #####################################################################

    public function getIdUser() {
        return $this->p_idUser;
    }

    public function getPseudo() {
        return $this->p_pseudo;
    }

    public function getPassword() {
        return $this->p_password;
    }
	
	public function getEmail() {
        return $this->p_email;
    }
	
	public function getRegistrationDate() {
        return $this->p_registrationDate;
    }
	
	public function getIdPlan() {
        return $this->p_idPlan;
    }

    // ############################## Setters ##############################
    // #####################################################################

}

?>