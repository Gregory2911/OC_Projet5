<?php

//require_once('View/frontend/View.php');
require_once('framework/Controler.php');

class ContactControler extends Controler
{
	public function formContact()
	{
		$this->generateView(array());		
	}

	public function sendEmail()
	{
		//On vérifie les champs
		$errors = $this->verifyContact();
		if (!empty($errors))
		{
			$message = implode("<br/>",$errors);
			throw new Exception($message);			
		}

		//Si tout est ok on envoi le message
		$headers = 'FROM: ' . $this->request->getParameter('email');
		$message = $this->request->getParameter('message');
		
		$Ok = mail('agnan.gregory@orange.fr', 'Nouvelle demande via le formulaire de contact du blog', $message, $headers);

		if ($Ok == false)
		{
			throw new Exception("error");
			
		}

		$racineWeb = Configuration::get("racineWeb","/");
        header('Location:'. $racineWeb . 'contact/formContact');        
	}

	private function verifyContact()
	{
		$errors = array();

		if (!$this->request->parameterExists('name') || ($this->request->getParameter('name') == ""))
		{
			$errors['name'] = "Vous devez renseigner votre nom.";
		}

		if (!$this->request->parameterExists('message') || ($this->request->getParameter('message') == ""))
		{
			$errors['message'] = "Vous n'avez pas écrit de message.";
		}

		if (!$this->request->parameterExists('email') || ($this->request->getParameter('email') == ""))
		{
			$errors['email'] = "L'adresse email n'est pas valide.";
		}

		return $errors;
	}
}