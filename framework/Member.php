<?php

class Member
{

	private $_id;
	private $_pseudo;
	private $_password;
	private $_isAdmin;
	private $_prenom;
	private $_nom;
	private $_email;

	public function __construct(array $data)
	{
		$this->hydrate($data);
	}

	public function hydrate(array $data)
	{
		foreach ($data as $key => $value) 
		{
			$method = 'set' . ucfirst($key);

			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
	}

	/*-----GETTERS-----*/
	public function id() 
	{
		return $this->_id; 
	}

	public function pseudo() 
	{ 
		return $this->_pseudo; 
	}

	public function password() 
	{ 
		return $this->_password; 
	}

	public function isAdmin()
	{ 		
		return $this->_isAdmin; 
	}

	public function prenom() 
	{ 
		return $this->_prenom; 
	}

	public function nom() 
	{ 
		return $this->_nom; 
	}

	public function email() 
	{ 
		return $this->_email; 
	}

	public function setId($id)
	{
		$this->_id = (int) $id;
	}

	/*---------SETTERS---------------------*/
	public function setPseudo($pseudo)
	{
		if (is_string($pseudo) && strlen($pseudo) <= 30)
		{
			$this->_pseudo = $pseudo;
		}
	}

	public function setPassword($password)
	{
		$this->_password = $password;
	}

	public function setIsAdmin($isAdmin)
	{
		$this->_isAdmin = (int) $isAdmin;
	}

	public function setPrenom($prenom)
	{
		if (is_string($prenom) && strlen($prenom) <= 50)
		{
			$this->_prenom = $prenom;
		}
	}

	public function setNom($nom)
	{
		if (is_string($nom) && strlen($nom) <= 50)
		{
			$this->_nom = $nom;
		}
	}

	public function setEmail($email)
	{
		if (is_string($email))
		{
			$this->_email = $email;
		}
	}
}