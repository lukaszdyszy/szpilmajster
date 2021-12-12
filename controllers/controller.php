<?php

abstract class Controller
{
	private $view;
	protected $params;
	protected $data = array();
	protected $header = array();

	public function __construct($params){
		$this->params = $params;
	}

	abstract public function index();

	protected function loadView($viewName){
		if(file_exists(VIEW.$viewName.'.php')){
			$this->view = VIEW.$viewName.'.php';
		} else {
			throw new Exception('Widok nie istnieje');
		}
	}

	protected function loadModel($modelName)
	{
		global $db;
		$modelName = strtolower($modelName);
		if(file_exists(MODEL.$modelName.'.model.php')){
			include(MODEL.$modelName.'.model.php');
			$modelName = ucwords($modelName);
			return new $modelName($db);
		} else {
			throw new Exception('Model nie istnieje');
		}
	}

	protected function render(){
		$data = $this->data;
		include($this->view);
	}

	public function __call($method, $params){
		throw new NotFoundException();
	}
}


?>