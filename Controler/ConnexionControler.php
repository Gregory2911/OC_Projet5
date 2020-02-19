<?php
session_start();
require_once('framework/Configuration.php');
require_once('framework/Controler.php');
require_once('model/MemberManager.php');

class ConnexionControler extends Controler
{

	private $member;

	public function __construct()
	{
		$this->member = new MemberManager();
	}

	public function connexion()
	{
		/*if (empty($_POST['login']) || empty($_POST['password']))
		{
			header("Location: index.php");
		}*/
		if ($this->request->parameterExists("login") && $this->request->parameterExists("password"))
		{
			$pseudo = $this->request->getParameter("login");
			$password = $this->request->getParameter("password");			
			$member = $this->member->getMember($pseudo, $password);
			$data = $member->fetch();
			if (!empty($data))
			{
				//Initialisation d'une session								
				$_SESSION['id'] = $data['id'];
				$_SESSION['pseudo'] = $data['pseudo'];												
				$member->closeCursor();		
				//throw new Exception($_SESSION['pseudo']);
			}
			else
			{
				throw new Exception("Identifiant ou mot de passe incorrect.");								
			}
		}		
		$racineWeb = Configuration::get("racineWeb","/");
		header("Location:" . $racineWeb . "index.php");
	}

	public function addMember($prenom,$nom,$email,$login,$password)
	{		

		$member = $memberManager->addMember($prenom,$nom,$email,$login,$password);

		$member = $memberManager->getMember($login,$password);

		if ($member === false)
		{
			throw new Exception("");
		}
		else
		{			
			//Initialisation d'une session
			while($data = $member->fetch())
			{
				$_SESSION['id'] = $data['id'];
				$_SESSION['pseudo'] = $data['pseudo'];				
			}
			$member->closeCursor();
			listPosts();			
		}
	}

	public function deconnexion()
	{
		session_destroy();
		$racineWeb = Configuration::get("racineWeb","/");
		header("Location:" . $racineWeb . "index.php");
	}
}