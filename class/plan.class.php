<?php 

class plan {
    private $p_idPlan;
    private $p_name;
    private $p_duration;
    private $p_storageSpace;
    private $p_bandwidth;
    private $p_dailyTransferQuota;


    public function __construct($idPlan = null, $name = null, $duration = null, $storageSpace = null, $bandwidth = null, $dailyTransferQuota = null) {
        $this->p_idPlan = $idPlan;
        $this->p_name = $name;
        $this->p_duration = $duration;
		$this->p_storageSpace = $storageSpace;
		$this->p_bandwidth = $bandwidth;
		$this->p_dailyTransferQuota = $dailyTransferQuota;
    }

    // ############################## Getters ##############################
    // #####################################################################

    public function getidPlan() {
        return $this->p_idPlan;
    }

    public function getName() {
        return $this->p_name;
    }

    public function getDuration() {
        return $this->p_duration;
    }
	
	public function getStorageSpace() {
        return $this->p_storageSpace;
    }
	
	public function getBandwidth() {
        return $this->p_bandwidth;
    }
	
	public function getDailyTransferQuota() {
        return $this->p_dailyTransferQuota;
    }

    // ############################## Setters ##############################
    // #####################################################################

}

?>