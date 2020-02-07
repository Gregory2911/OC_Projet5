<?php

namespace OpenClassrooms\Blog\Controller;
//Chargement des classes
//use \OpenClassrooms\Blog\Model\PostManager;
//use \OpenClassrooms\Blog\Model\CommentManager;
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

Class FrontendController
{
    public function listPosts()
    {
        $postManager = new \OpenClassrooms\Blog\Model\PostManager();
        $posts = $postManager->getPosts();

        require('view/frontend/listPostsView.php');
    }

    public function post($postId)
    {
        $postManager = new \OpenClassrooms\Blog\Model\PostManager();
        $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

        $post = $postManager->getPost($postId);
        $comments = $commentManager->getComments($postId);

        require('view/frontend/postView.php');
    }

    public function addComment($postId, $author, $comment)
    {
    	$commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    	$affectedLines = $commentManager->postComment($postId,$author,$comment);

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
        $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

        $comment = $commentManager->getComment($commentId);

        require('view/frontend/commentView.php');
    }

    public function updateComment($commentId,$comment,$postId)
    {
        //echo $commentId." ".$comment;
        $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
        $postManager = new \OpenClassrooms\Blog\Model\PostManager();
        //On modifie le commentaire
        $affectedComment = $commentManager->updateComment($commentId,$comment);
        //On récupère le post en lien avec le commentaire
        $post = $postManager->getPost($postId);
        //on raffraichit les commentaires
        $comments = $commentManager->getComments($postId);

        require('view/frontend/postView.php');
    }
}
