<?php

//namespace OpenClassrooms\Blog\Controller;
//Chargement des classes
//use \OpenClassrooms\Blog\Model\PostManager;
//use \OpenClassrooms\Blog\Model\CommentManager;
require 'model/PostManager.php';
require_once('model/CommentManager.php');
require_once('View/frontend/View.php');
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
        //$view = new View('listPostsView');
        $this->generateView(array('posts'=>$posts));
    }

    public function post()
    {
    	if ($this->request->parameterExists("id"))
    	{
	        $postId = $this->request->getParameter('id');
	        $post = $this->post->getPost($postId);
	        $comments = $this->comment->getComments($postId);
	        //$view = new View('postView');
	        $this->generateView(array('post'=>$post, 'comments'=> $comments));
	    }
	    else
	    {
	    	throw new Exception('Identifiant inconnu.');
	    }
    }

    public function addComment($postId, $author, $comment)
    {    	
    	$affectedLines = $this->comment->postComment($postId,$author,$comment);

    	if ($affectedLines === false)
        {
    		// Erreur gérée. Elle sera remontée jusqu'au bloc try du routeur !
            throw new Exception('Impossible d\'ajouter le commentaire !');
    	}
    	else {
    		header('Location: index.php?action=post&id=' . $postId);        
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