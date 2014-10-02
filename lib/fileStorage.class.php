<?php
class fileStorage {

	public function is_dir($file) {
		return is_dir($file);
	}

	public function file_exists($file) {
		return file_exists($file);
	}

	public function scandir($file) {
		return scandir($file);
	}

	public function filesize($file) {
		return filesize($file);
	}

	public function deleteFile($file){
		return unlink($file);
	}

	public function deleteDirectory($dirname){
		$files = scandir($dirname);
		if (count($files) > 2) {
			foreach( $files as $file ) {
				if ($file == '.' || $file == '..') {
					continue;
				}
				if (is_dir($dirname.'/'.$file)) {
					$this->deleteDirectory($dirname.'/'.$file);
				} else {
					unlink($dirname.'/'.$file);
				}
			}
		}
		return rmdir($dirname);
	}

	public function makeDirectory($dirname){
		return mkdir($dirname);
	}

	public function makeFile($filename){
		if ($handle = fopen($filename, 'w')) {
			fclose($handle);
			return true;
		}
		return false;
	}

	public function filemtime ($filename) {
		return filemtime($filename);
	}

	public function copyFile ($from, $to) {
		return copy($from, $to);
	}

	public function copyDir ($src, $dst) {
		$dir = opendir($src);
		$result = mkdir($dst);
		while(false !== ( $file = readdir($dir)) ) {
			if (( $file != '.' ) && ( $file != '..' )) {
				if ( is_dir($src . '/' . $file) ) {
					$this->copyDir($src . '/' . $file, $dst . '/' . $file);
				}
				else {
					copy($src . '/' . $file,$dst . '/' . $file);
				}
			}
		}
		closedir($dir);
		return $result;
	}

	public function renameItem ($from, $to) {
		return rename($from, $to);
	}

	public function readFile($filename){
		return file_get_contents($filename);
	}

	public function writefile($filename, $content){
		return file_put_contents($filename, $content);
	}

	public function move_uploaded_file ($from, $to) {
		return move_uploaded_file($from, $to);
	}
}
?>