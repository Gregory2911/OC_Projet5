<?php

//namespace OpenClassrooms\Blog\Model;

require_once("framework/Manager.php");

class MemberManager extends Manager
{
	public function getMember($pseudo, $password)
	{
		$req = 'select id, pseudo, password, isAdmin from members where pseudo = ? and password = ?';		
		$member = $this->executeRequete($req,array($pseudo, $password));		

		return $member;
	}

	public function addMember($prenom,$nom,$email,$login,$password)
	{
		$req = 'insert into members(prenom, nom, email, pseudo, password) values(?,?,?,?,?)';		
		$member = $this->executeRequete($req,array($prenom,$nom,$email,$login,$password));		

		return $member;
	}
}