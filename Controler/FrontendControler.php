<?php
//session_start();
//namespace OpenClassrooms\Blog\Controller;
//Chargement des classes
//use \OpenClassrooms\Blog\Model\PostManager;
//use \OpenClassrooms\Blog\Model\CommentManager;
require 'model/PostManager.php';
require_once('model/CommentManager.php');
//require_once('View/frontend/View.php');
require_once('framework/Controler.php');

Class FrontendControler extends Controler
{

    private $post;
    private $comment;

    public function __construct()
    {
        $this->post = new PostManager();
        $this->comment = new CommentManager();
    }

    public function listPosts()
    {        
        $posts = $this->post->getPosts();        
        $this->generateView(array('posts'=>$posts));
    }

    public function post()
    {
    	if ($this->request->parameterExists("id"))
    	{
	        $postId = $this->request->getParameter('id');
	        $post = $this->post->getPost($postId);
	        $comments = $this->comment->getComments($postId);
            $nb = $this->comment->countComments($postId);
	        //$view = new View('postView');
	        $this->generateView(array('post'=>$post, 'comments'=> $comments, 'nbComments' => $nb));
            //throw new Exception($nb);
	    }
	    else
	    {
	    	throw new Exception('Identifiant inconnu.');
	    }
    }

    public function addComment()
    {   
        if ($this->request->parameterExists('comment'))
        {
            $comment = $this->request->getParameter('comment');
        }
        if(!isset($_SESSION['id']))
        {
            throw new Exception('Vous devez d\'abord vous connecter avant de poster un commentaire.');
        }
        elseif(!isset($comment))
        {
            throw new Exception('Vous n\'avez pas rédigé de commentaire.');   
        }
        elseif($comment == "")
        {
            throw new Exception('Vous n\'avez pas rédigé de commentaire.');   
        }    
        else
        {   
            $postId = $this->request->getParameter('id');                        
        	$affectedLines = $this->comment->postComment($postId,$_SESSION['pseudo'],$comment,$_SESSION['id']);

        	if ($affectedLines === false)
            {
        		// Erreur gérée. Elle sera remontée jusqu'au bloc try du routeur !
                throw new Exception('Impossible d\'ajouter le commentaire !');
        	}
        	else 
            {
                $racineWeb = Configuration::get("racineWeb","/");
        		header('Location:'. $racineWeb . 'frontend/post/' . $postId);        
        	}
        }
    }

    public function comment()
    {
    	if ($this->request->parameterExists('id'))
    	{
	        $commentId = $this->request->getParameter('id');
	        $comment = $this->comment->getComment($commentId);
	        //$view = new View('commentView');
	        $this->generateView(array('comment'=> $comment));
	    }
	    else
	    {
	    	throw new Exception('Identifiant inconnu.');
	    }
    }

    public function updateComment()
    {        
    	$commentId = $this->request->getParameter('id');
    	$comment = $this->request->getParameter('comment');
        //On modifie le commentaire
        $affectedComment = $this->comment->updateComment($commentId,$comment);
        //On récupère l'id du post en lien avec le comment
        $postId = $this->comment->getCommentPost($commentId);    

        $racineWeb = Configuration::get("racineWeb","/");
		header("Location:" . $racineWeb . "frontend/post/".$postId);
    }
}
