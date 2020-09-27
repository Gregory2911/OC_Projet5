<?php

//namespace OpenClassrooms\Blog\Model;

require_once("framework/Manager.php");
require_once("entity/Member.php");

class MemberManager extends Manager
{
	public function getMember($pseudo, $password)
	{
		$req = 'select id, pseudo, password, isAdmin, prenom, nom, email from members where pseudo = ? and password = ?';
		$response = $this->executeRequete($req, array($pseudo, $password));
		$data = $response->fetch(\PDO::FETCH_ASSOC);
		$member = new Member($data);

		if (isset($member)) {
			return $member;
		} else {
			return null;
		}
	}

	public function addMember(Member $member)
	{
		$req = 'insert into members(prenom, nom, email, pseudo, password) values(?,?,?,?,?)';
		$affectedLine = $this->executeRequete($req, array($member->prenom(), $member->nom(), $member->email(), $member->pseudo(), $member->password()));

		return $affectedLine;
	}

	public function findSamePseudo($pseudo)
	{
		$req = 'select count(members.id) as nb from members where members.pseudo = ?';
		$response = $this->executeRequete($req, array($pseudo));
		$data = $response->fetch(\PDO::FETCH_ASSOC);
		$nb = $data['nb'];
		return $nb;
	}
}
