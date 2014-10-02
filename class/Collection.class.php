<?php

class Collection
{
	private $tab;

    public function __construct()
	{
		$this->tab=array();
    }

    public function Add($unobj)
	{
		$this->tab[]=$unobj;
    }

    public function Count()
	{
		return count($this->tab);
    }

    public function getAll()
	{
    	return $this->tab;
    }

    public function getElement($i)
	{
    	return $this->tab[$i];
    }
	
	private function GetIndice($obj)
	{
		/*
		 * Algorithme de recherche séquentielle
		 */
		 $i = 1;
		 $indice = false;
		 while($i<=$this->Count() AND !$indice)
		 {
			if($this->GetElement($i)==$obj)
			{
				$indice = $i;
			}
			else
				$i++;
		 }
		 return $indice;
	}
}
?>