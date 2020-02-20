<?php

//require_once('View/frontend/View.php');
require_once('framework/Controler.php');

class ContactControler extends Controler
{
	public function formContact()
	{
		$this->generateView(array());
	}
}