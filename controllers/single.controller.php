<?php
require(CONTROLLER.'controller.php');

class Single extends Controller
{
	public function index(){
		throw new NotFoundException();
	}

	// wyświetlanie pojedynczego artykułu (single/read/:id)
	public function read(){
		throw new NotImplementedException();
	}

	// dodawanie nowego artykułu (single/write)
	public function write(){
		throw new NotImplementedException();
	}

	// modyfikacja artykułu (single/edit)
	public function edit(){
		throw new NotImplementedException();
	}
}
?>