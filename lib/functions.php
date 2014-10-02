<?php

function Validates($data, $validate){
	$errors = array();
	foreach($validate as $k=>$v){
	    if(!isset($data->$k)){
	    	$errors[$k] = $v['message'];
	    }
	    else {
	    	if($v['rule'] == 'notEmpty'){
		    	if(empty($data->$k)){
		        	$errors[$k] = $v['message'];
		   		}
	      	}
	      	elseif($v['rule'] == 'confirmMdp') {
				if($data->$k != $_POST['password2']){
	        		$errors[$k] = $v['message'];
	        	}
			} 
	    	elseif(!preg_match('/^'.$v['rule'].'$/',$data->$k)) {
	        	$errors[$k] = $v['message'];
	    	}
	    }
	}
	if(empty($errors)){
		return true;
	}
	else {
		return $errors;
	}
}

/*
* Permet d'afficher des messages d'informations.
*/
function setFlash($message, $type = 'success'){
	$_SESSION['flash'] = array(
		'message' => $message,
		'type' => $type
	);
}

/*
* Création du message d'informations
*/
function flash(){
    if(isset($_SESSION['flash']['message'])){
		$html = '<div class="alert alert-'.$_SESSION['flash']['type'].'">'.$_SESSION['flash']['message'].'</div>';
		$_SESSION['flash']= array();
		return $html;
    }
}

/* JJ/MM/AAA => AAAA-MM-JJ */
function ConvertirDate($date){
	$annee = substr($date, 6, 4); 
	$mois = substr($date, 3, 2); 
	$jour = substr($date, 0, 2);  
	$date = $annee.'-'.$mois.'-'.$jour;
	return $date;
}

/* AAAA-MM-JJ => JJ, MM, AAAA */
function DateToDatepicker($date){
	$annee = substr($date, 0, 4); 
	$mois = substr($date, 5, 2); 
	$jour = substr($date, 8, 2);  
	$date = $jour.', '.$mois.', '.$annee;
	return $date;
}

/* AAAA-MM-JJ => JJ, MM, AAAA */
function DateToFRDate($date){
	$annee = substr($date, 0, 4); 
	$mois = substr($date, 5, 2); 
	$jour = substr($date, 8, 2);  
	$date = $jour.'/'.$mois.'/'.$annee;
	return $date;
}

//Change le format bytes -> MB, GB ...
function sizeFormat($bytes){ 
	$kb = 1024;
	$mb = $kb * 1024;
	$gb = $mb * 1024;
	$tb = $gb * 1024;

	if (($bytes >= 0) && ($bytes < $kb)) {
		return $bytes . ' B';

	} elseif (($bytes >= $kb) && ($bytes < $mb)) {
		return ceil($bytes / $kb) . ' KB';

	} elseif (($bytes >= $mb) && ($bytes < $gb)) {
		return ceil($bytes / $mb) . ' MB';

	} elseif (($bytes >= $gb) && ($bytes < $tb)) {
		return ceil($bytes / $gb) . ' GB';

	} elseif ($bytes >= $tb) {
		return ceil($bytes / $tb) . ' TB';
	} else {
		return $bytes . ' B';
	}
}

//Retourne le stockage total en Byte d'un dossier
function dirsize($dir)
    {
      @$dh = opendir($dir);
      $size = 0;
      while ($file = @readdir($dh))
      {
        if ($file != "." and $file != "..") 
        {
          $path = $dir."/".$file;
          if (is_dir($path))
          {
            $size += dirsize($path); // recursive in sub-folders
          }
          elseif (is_file($path))
          {
            $size += filesize($path); // add file
          }
        }
      }
      @closedir($dh);
      //$size = floor($Size / 1000000) + ' MB';
      return $size;
    }

?>