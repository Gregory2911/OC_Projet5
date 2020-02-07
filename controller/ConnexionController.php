<?php
session_start();

require_once('model/MemberManager.php');

class ConnexionController
{

	private $member;

	public function __construct()
	{
		$this->member = new MemberManager();
	}

	public function verifyMember($pseudo)
	{
		if (empty($_POST['login']) || empty($_POST['password']))
		{
			header("Location: index.php");
		}
		else
		{
			$pseudo = $_POST['login'];
			
			$member = $this->member->getMember($pseudo);

			if (!empty($member))
			{
				//Initialisation d'une session
				while($data = $member->fetch())
				{
					$_SESSION['id'] = $data['id'];
					$_SESSION['pseudo'] = $data['pseudo'];				
				}
				$member->closeCursor();		
			}
		}
	}

	public function addMember($prenom,$nom,$email,$login,$password)
	{		

		$member = $memberManager->addMember($prenom,$nom,$email,$login,$password);

		$member = $memberManager->getMember($login);

		if ($member === false)
		{
			throw new Exception("Prout");
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
}