<?php

function splitURL(){
	return  explode('/', trim(explode('?', $_SERVER['REQUEST_URI'])[0], '/'));
}

?>