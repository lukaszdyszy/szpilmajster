<?php

class FunctionalityException extends Exception{
	protected $status;
	public function getStatus(){return $this->status;}
}

class NotFoundException extends FunctionalityException{ // generate 404 error
	public function __construct(){
		$this->status = 404;
		$this->message = '404. Nie znaleziono.';
	}
}
class NotImplementedException extends FunctionalityException{ // funkcjonalność jeszcze niezaimplementowana
	public function __construct(){
		$this->status = 500;
		$this->message = 'Pracujemy nad tym...';
	}
}	
class InternalErrorException extends FunctionalityException{ // błąd servera
	public function __construct(){
		$this->status = 500;
		$this->message = 'Ups! Coś poszło nie tak';
	}
}

class BadRequestException extends FunctionalityException{ // błędne dane w formularzu
	public function __construct($msg){
		$this->status = 400;
		$this->message = $msg;
	}
}
class FileUploadException extends FunctionalityException{ // błąd w przesłaniu pliku
	public function __construct($status, $msg){
		$this->status = $status;
		$this->message = $msg;
	}
}

class UnauthorizedException extends FunctionalityException{ // dostęp zabroniony
	public function __construct(){
		$this->status = 403;
		$this->message = 'Brak uprawnień.';
	}
}


?>