<?php

abstract class Model
{
	public $db;
	
	public function __construct($conn){
		$this->db = $conn;
	}
}

?>