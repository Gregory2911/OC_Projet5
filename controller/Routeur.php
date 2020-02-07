<?php

require_once 'Controller/FrontendController.php';
require_once 'Controller/ConnexionController.php';

class Routeur 
{
	private $ctrlFontend;
	private $ctrlConnexion;

	public function __construct()
	{
		$this->ctrlFrontend = new OpenClassrooms\Blog\Controller\FrontendController();
		$this->ctrlConnexion = new OpenClassrooms\Blog\Controller\ConnexionController();
	}

	//traite une requête entrante
	public function routerRequest()
	{
		try { //on essaie de faire des choses
		    if (isset($_GET['action'])) {
		        if ($_GET['action'] == 'connexion')
		        {
		            $connexion = new ConnexionController();
		            $accueil = new OpenClassrooms\Blog\Controller\FrontendController();
		            $connexion->verifyMember($_POST['login']);            
		            $accueil->listPosts();
		        }

		        elseif ($_GET['action'] == 'inscription')
		        {
		            if (!empty($_POST['prénom']) && !empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['login']) && !empty($_POST['password']))
		            {
		                $inscription = new ConnexionController();
		                $inscription->addMember($_POST['prénom'],$_POST['nom'],$_POST['email'],$_POST['login'],$_POST['password']);                
		            }
		            else
		            {
		                throw new Exception('Il manque une information pour finaliser votre inscription.');
		            }
		        }

		        elseif ($_GET['action'] == 'deconnexion')
		        {
		            //session_start();
		            $accueil = new OpenClassrooms\Blog\Controller\FrontendController();
		            session_destroy();
		            $accueil->listPosts();
		        }        

		        elseif ($_GET['action'] == 'listPosts') {
		            $posts = new OpenClassrooms\Blog\Controller\FrontendController();
		            $posts->listPosts();            
		        }
		        elseif ($_GET['action'] == 'post') {
		            if (isset($_GET['id']) && $_GET['id'] > 0) {
		                $post = new OpenClassrooms\Blog\Controller\FrontendController();
		                $post->post($_GET['id']);
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
		                        $comment = new OpenClassrooms\Blog\Controller\FrontendController();               
		                        $comment->addComment($_GET['id'], $_SESSION['pseudo'], $_POST['comment']);
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
		                    $comment = new OpenClassrooms\Blog\Controller\FrontendController();
		                    $comment->comment($_GET['id']);
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
		                $comment = new OpenClassrooms\Blog\Controller\FrontendController();
		                $comment->updateComment($_GET['id'],$_POST['comment'],$_GET['postid']);
		            }
		        }
		    }
		    else {
		        $posts = new OpenClassrooms\Blog\Controller\FrontendController();
		        $posts->listPosts();
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