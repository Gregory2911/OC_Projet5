<?php

//namespace OpenClassrooms\Blog\Controller;
//Chargement des classes
//use \OpenClassrooms\Blog\Model\PostManager;
//use \OpenClassrooms\Blog\Model\CommentManager;
require 'model/PostManager.php';
require_once('model/CommentManager.php');
require_once('View/frontend/View.php');

Class FrontendController
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
        $view = new View('listPostsView');
        $view->generate(array('posts'=>$posts));
    }

    public function post($postId)
    {
        $post = $this->post->getPost($postId);
        $comments = $this->comment->getComments($postId);
        $view = new View('postView');
        $view->generate(array('post'=>$post, 'comments'=>$comments));
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

    public function comment($commentId)
    {
        $comment = $this->comment->getComment($commentId);
        $view = new View('commentView');
        $view->generate(array('comment'=> $comment));
    }

    public function updateComment($commentId,$comment,$postId)
    {        
        //On modifie le commentaire
        $affectedComment = $this->comment->updateComment($commentId,$comment);
        //On récupère le post en lien avec le commentaire
        $post = $this->post->getPost($postId);
        //on raffraichit les commentaires
        $comments = $this->comment->getComments($postId);

        $view = new View('postView');
        $view->generate(array('post' => $post, 'comments' => $comments));
    }
}
