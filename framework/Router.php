<?php

require_once 'Request.php';
require_once 'View.php';



class Router
{
	//Route une requête entrante ; exécute l'action associée
	public function routerRequest()
	{
		try
		{
			//fusion des paramètres GET et POST de la requête
			$request = new Request(array_merge($_GET, $_POST, $_FILES));

			$controler = $this->createController($request);
			$action = $this->createAction($request);

			$controler->executeAction($action);		
		}
		catch (Exception $e)
		{
			//echo 'Erreur : ' . $e->getmessage();
		    // amelioration de la présentation de l'erreur
		    $errorMessage = $e->getMessage();	    		    
		}
	}

	//Crée le contrôleur approprié en fonction de la requête reçue
	private function createController(Request $request)
	{
		$controler = "Frontend";
		if ($request->parameterExists('controler'))
		{
			$controler = $request->getParameter('controler');			
			//1ere lettre en majuscule
			$controler = ucfirst(strtolower($controler));			
		}
		//création du nom du fichier du controler
		$classControler = $controler . "Controler";
		$fileControler = "Controler/" . $classControler .".php";
		if (file_exists($fileControler))
		{
			//instanciation du controler adapté à la requête
			require($fileControler);
			$controler = new $classControler();
			$controler->setRequest($request);
			return $controler;
		}
		else
		{
			throw new Exception("Fichier " . $fileControler . " introuvable.");			
		}
	}

	//Determine l'action à exécuter en fonction de la requête reçue
	private function createAction(Request $request)
	{
		$action = "listPosts"; //action par défaut
		if ($request->parameterExists('action'))
		{
			$action = $request->getParameter('action');
		}
		return $action;
	}
}
