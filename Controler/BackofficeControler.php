<?php

require_once('framework/Controler.php');
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

class BackofficeControler extends Controler
{
	private $post;
    private $comment;

    private static $extensionImgValide = array('jpg', 'jpeg', 'png');

    public function __construct()
    {
        $this->post = new PostManager();
        $this->comment = new CommentManager();
        $_SESSION['admin'] = 1;
    }

    public function listPosts()
    {
    	$posts = $this->post->getPosts();        
        $this->generateView(array('posts'=>$posts));
    }

	public function formPost()
    {        
        //$view = new View('listPostsView');
        $this->generateView(array());
    }

	public function addPost()
	{
        //enregistrement des paramètres dans des variables si ils existent
		if ($this->request->parameterExists('content'))
        {
            $content = $this->request->getParameter('content');
        }

        if ($this->request->parameterExists('title'))
        {
            $title = $this->request->getParameter('title');
        }

        if ($this->request->parameterExists('imgPost'))
        {
            $imgPost = $this->request->getParameter('imgPost');
        }

        //contrôle des variables
        if(!isset($content))
    	{
        	throw new Exception('Vous n\'avez pas rédigé de commentaire.');   
    	}
    	elseif($content == "")
    	{
        	throw new Exception('Vous n\'avez pas rédigé de commentaire.');   
    	}                
                
        if(!isset($title))
    	{
        	throw new Exception('Vous n\'avez pas rédigé de titre.');   
    	}
    	elseif($title == "")
    	{
        	throw new Exception('Vous n\'avez pas rédigé de titre.');   
    	}                        
                    
        if(!isset($imgPost))            
        {
            throw new Exception('Vous n\'avez pas rattaché d\'image à votre post.');        
        }
        else
        {
            //test file inférieur à 1mo
            if ($imgPost['size'] >= 1000000)
            {
                throw new Exception("Le fichier est trop volumineux. Merci de choisir un fichier dont la taille ne dépasse pas 1Mo.");                
            }
            else
            {
                //test file extension
                $fileInfo = pathinfo($imgPost['name']);
                $fileExtension = $fileInfo['extension'];
                if (!in_array($fileExtension,self::$extensionImgValide))                
                {
                    throw new Exception("Le fichier n'a pas une extension valide (jpg, jpeg, png).");
                    //move_uploaded_file($imgPost['tmp_name'], '..photoPost/' . basename($imgPost['name']));
                }                
            }
        }

    	$affectedLines = $this->post->addPost($title, $content,$_SESSION['id']);

    	if ($affectedLines === false)
        {
    		// Erreur gérée. Elle sera remontée jusqu'au bloc try du routeur !
            throw new Exception('Impossible d\'ajouter le post.');
    	}
    	else 
        {
            //$racineWeb = Configuration::get("racineWeb","/");
    		//header('Location:'. $racineWeb . 'frontend/post/' . $postId);
            $lastPostId = $this->post->lastInsertId();
            $fileName = "post" . $lastPostId . "." . $fileExtension;
            
            move_uploaded_file($imgPost['tmp_name'], '../photoPost/' . $fileName);

            $affectedLines = $this->post->addImgPost($lastPostId,$fileName,$fileName);

            $racineWeb = Configuration::get("racineWeb","/");
            header('Location:'. $racineWeb . 'backoffice/formPost/' . $postId);
    	}
        
	}

	public function deletePost()
	{
		if ($this->request->parameterExists('id'))
		{
			$postId = $this->request->getParameter('id');
			$affectedLines = $this->post->deletePost($postId);
			if ($affectedLines == false)
			{
				throw new Exception("Impossible de supprimer le post");			
			}
			else
			{
				$racineWeb = Configuration::get("racineWeb","/");
	            header('Location:'. $racineWeb . 'backoffice/listPosts/');	
			}
		}
		else
		{
			throw new Exception("Impossible de supprimer le post");			
		}
	}

	public function modifyPost()
	{
		$this->generateView(array());
	}

    public function getComments()
    {
        $comments = $this->comment->getCommentsBackOffice();
        //$view = new View('listPostsView');
        $this->generateView(array('comments'=>$comments));
    }

    public function deleteComment()
    {
        $commentId = $this->request->getParameter('id');
        $affectedLines = $this->comment->deleteComment($commentId);

        if ($affectedLines === false)
        {
            // Erreur gérée. Elle sera remontée jusqu'au bloc try du routeur !
            throw new Exception('Impossible de supprimer le commentaire.');
        }

        $racineWeb = Configuration::get("racineWeb","/");
        header('Location:'. $racineWeb . 'backoffice/getComments');
    }

    public function validateComment()
    {
        $commentId = $this->request->getParameter('id');
        $affectedLines = $this->comment->validateComment($commentId);

        if ($affectedLines === false)
        {
            // Erreur gérée. Elle sera remontée jusqu'au bloc try du routeur !
            throw new Exception('Impossible de valider le commentaire.');
        }

        $racineWeb = Configuration::get("racineWeb","/");
        header('Location:'. $racineWeb . 'backoffice/getComments');
    }
}