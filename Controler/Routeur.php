<?php

require_once 'Controller/FrontendController.php';
require_once 'Controller/ConnexionController.php';

class Routeur 
{
	private $ctrlFrontend;
	private $ctrlConnexion;

	public function __construct()
	{
		$this->ctrlFrontend = new FrontendController();
		$this->ctrlConnexion = new ConnexionController();
	}

	//traite une requête entrante
	public function routerRequest()
	{
		try { //on essaie de faire des choses
		    if (isset($_GET['action'])) {
		        if ($_GET['action'] == 'connexion')
		        {		           		            
		            $this->ctrlConnexion->verifyMember($_POST['login']);            
		            $this->ctrlFrontend->listPosts();
		        }

		        elseif ($_GET['action'] == 'inscription')
		        {
		            if (!empty($_POST['prénom']) && !empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['login']) && !empty($_POST['password']))
		            {		               
		                $this->ctrlConnexion->addMember($_POST['prénom'],$_POST['nom'],$_POST['email'],$_POST['login'],$_POST['password']);                
		            }
		            else
		            {
		                throw new Exception('Il manque une information pour finaliser votre inscription.');
		            }
		        }

		        elseif ($_GET['action'] == 'deconnexion')
		        {
		            //session_start();		            
		            session_destroy();
		            $this->ctrlFrontend->listPosts();
		        }        

		        elseif ($_GET['action'] == 'listPosts') {		            
		            $this->ctrlFrontend->listPosts();
		        }
		        elseif ($_GET['action'] == 'post') {
		            if (isset($_GET['id']) && $_GET['id'] > 0) {		                
		                $this->ctrlFrontend->post($_GET['id']);
		            }
		            else {
		                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
		                throw new Exception('Aucun identifiant de billet envoyé');
		            }
		        }
		        elseif ($_GET['action'] == 'addComment') {
		            if (isset($_SESSION['pseudo']) && isset($_SESSION['id']))
		            {
		                if (isset($_GET['id']) && $_GET['id'] > 0) {
		                    if (!empty($_POST['comment'])) { 		                                      
		                        $this->ctrlFrontend->addComment($_GET['id'], $_SESSION['pseudo'], $_POST['comment']);
		                    }
		                    else {
		                        // Autre exception
		                        throw new Exception('Tous les champs ne sont pas remplis !');
		                    }
		                }
		                else {
		                    // Autre exception
		                    throw new Exception('Aucun identifiant de billet envoyé');
		                }
		            }
		            else
		            {
		                //Autre exception
		                throw new Exception('Vous devez d\'abord vous connectez avant de poster un commentaire.');
		            }
		        }
		        elseif ($_GET['action'] == 'modifyComment')
		        {
		            if (isset($_SESSION['pseudo']) && isset($_SESSION['id']))
		            {
		                if (isset($_GET['id']) && $_GET['id'] > 0)
		                {		                    
		                    $this->ctrlFrontend->comment($_GET['id']);
		                }
		                else
		                {
		                    throw new Exception('Aucun identifiant de commentaire envoyé');
		                }
		            }
		            else
		            {
		                //Autre exception
		                throw new Exception('Vous devez d\'abord vous connectez avant de modifier un commentaire.');
		            }
		        }
		        elseif ($_GET['action'] == 'updateComment')
		        {
		            if (isset($_GET['id']) && $_GET['id'] > 0)
		            {		                
		                $this->ctrlFrontend->updateComment($_GET['id'],$_POST['comment'],$_GET['postid']);
		            }
		        }
		    }
		    else {		        
		        $this->ctrlFrontend->listPosts();
		    }
		}

		catch(Exception $e) { // si il y a une erreur alors ...
		    echo 'Erreur : ' . $e->getmessage();
		    /* amelioration de la présentation de l'erreur
		    $errorMessage = $e->getMessage();
		    require('view/errorView.php');*/
		}
	}
}