<?php
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
			if (!empty($getMember)) {
				$memberConnect = $getMember;
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

		if ($newMember->prenom() == "" || $newMember->nom() == "") {
			throw new Exception('Il manque une information importante pour finaliser votre inscription.');
		} else if ($newMember->password() == "") {
			throw new Exception('Vous n\'avez pas saisi de mot de passe.');
		} else if ($newMember->pseudo() == "") {
			throw new Exception('Vous n\'avez pas saisi de login.');
		} else if ($this->member->findSamePseudo($newMember->pseudo()) > 0) {
			throw new Exception('Le login existe déjà. Merci d\'en choisir un nouveau.');
		} else {
			$affectedLine = $this->member->addMember($newMember);

			$memberConnect = $this->member->getMember($newMember->pseudo(), $newMember->password());

			if ($affectedLine === false) {
				throw new Exception('Un problème est survenu lors de votre inscription.');
			} else {
				$_SESSION['id'] = $memberConnect->id();
				$_SESSION['pseudo'] = $memberConnect->pseudo();
				$_SESSION['isAdmin'] = $memberConnect->isAdmin();

				$racineWeb = Configuration::get("racineWeb", "/");
				header("Location:" . $racineWeb . "index.php");
			}
		}
	}

	public function deconnexion()
	{
		session_destroy();
		$racineWeb = Configuration::get("racineWeb", "/");
		header("Location:" . $racineWeb . "index.php");
	}
}
