<?php

//namespace OpenClassrooms\Blog\Model;

require_once("framework/Manager.php");

class MemberManager extends Manager
{
	public function getMember($pseudo)
	{
		$req = 'select id, pseudo, password, isAdmin from members where pseudo = ?';		
		$member = $this->executeRequete($req,array($pseudo));		

		return $member;
	}

	public function addMember($prenom,$nom,$email,$login,$password)
	{
		$req = 'insert into members(prenom, nom, email, pseudo, password) values(?,?,?,?,?)';		
		$member = $this->executeRequete($req,array($prenom,$nom,$email,$login,$password));		

		return $member;
	}
}