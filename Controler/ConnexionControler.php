<?php
//session_start();
//require_once('framework/Configuration.php');
require_once('framework/Controler.php');
require_once('model/MemberManager.php');
require_once('entity/Member.php');

class ConnexionControler extends Controler
{

	private $member;

	public function __construct()
	{
		$this->member = new MemberManager();
	}

	public function connexion()
	{
		if ($this->request->parameterExists("login") && $this->request->parameterExists("password")) {
			$pseudo = $this->request->getParameter("login");
			$password = $this->request->getParameter("password");

			$getMember = $this->member->getMember($pseudo, $password);
			//var_dump($getMember);
			if (!empty($getMember)) {
				$memberConnect = new Member($getMember);
				$isAdmin = $memberConnect->isAdmin();
				$idMember = $memberConnect->id();

				$pseudoMember = $memberConnect->pseudo();

				if (!empty($idMember) && !empty($pseudoMember)) {
					//Initialisation d'une session								
					$_SESSION['id'] = $idMember;
					$_SESSION['pseudo'] = $pseudoMember;
					$_SESSION['isAdmin'] = $isAdmin;

					$racineWeb = Configuration::get("racineWeb", "/");
					header("Location:" . $racineWeb . "index.php");
				} else {
					throw new Exception("Identifiant ou mot de passe incorrect.");
				}
			} else {
				throw new Exception("Identifiant ou mot de passe incorrect.");
			}
		} else {
			throw new Exception("Identifiant ou mot de passe incorrect.");
		}
	}

	public function inscription()
	{
		$dataNewMember['prenom'] = $this->request->getParameter('prénom');
		$dataNewMember['nom'] = $this->request->getParameter('nom');
		$dataNewMember['email'] = $this->request->getParameter('email');
		$dataNewMember['pseudo'] = $this->request->getParameter('login');
		$dataNewMember['password'] = $this->request->getParameter('password');

		$newMember = new Member($dataNewMember);

		$affectedLine = $this->member->addMember($newMember);
		/*$member = $this->member->getMember($login,$password);

		$data = $member->fetch();
		if (empty($data))
		{
			throw new Exception("");
		}
		else
		{			
			//Initialisation d'une session					
			$_SESSION['id'] = $data['id'];
			$_SESSION['pseudo'] = $data['pseudo'];							
			$member->closeCursor();			
		}*/

		if ($affectedLine === false) {
			throw new Exception('Un problème est survenu lors de votre inscription.');
		} else {
			$_SESSION['id'] = $newMember->id();
			$_SESSION['pseudo'] = $newMember->pseudo();
			$_SESSION['isAdmin'] = $newMember->isAdmin();

			$racineWeb = Configuration::get("racineWeb", "/");
			header("Location:" . $racineWeb . "index.php");
		}
	}

	public function deconnexion()
	{
		session_destroy();
		$racineWeb = Configuration::get("racineWeb", "/");
		header("Location:" . $racineWeb . "index.php");
	}
}
