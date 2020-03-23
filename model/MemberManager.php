<?php

//namespace OpenClassrooms\Blog\Model;

require_once("framework/Manager.php");
require_once("framework/Member.php");

class MemberManager extends Manager
{
	public function getMember($pseudo, $password)
	{
		$req = 'select id, pseudo, password, isAdmin, prenom, nom, email from members where pseudo = ? and password = ?';		
		$response = $this->executeRequete($req,array($pseudo,$password));

		while ($data = $response->fetch()) 
		{
			$objectMember['id'] = $data['id'];
			$objectMember['pseudo'] = $data['pseudo'];
			$objectMember['password'] = $data['password'];
			$objectMember['isAdmin'] = $data['isAdmin'];
			$objectMember['prenom'] = $data['prenom'];
			$objectMember['nom'] = $data['nom'];
			$objectMember['email'] = $data['email'];
		}

		if (isset($objectMember))
		{
			return $objectMember;	
		}
		else
		{
			return null;
		}
		
	}

	public function addMember(Member $member)
	{
		$req = 'insert into members(prenom, nom, email, pseudo, password) values(?,?,?,?,?)';		
		$affectedLine = $this->executeRequete($req,array($member->prenom(),$member->nom(),$member->email(),$member->pseudo(),$member->password()));		

		return $affectedLine;
	}
}