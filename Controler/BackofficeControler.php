<?php

require_once('framework/Controler.php');
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('Controler/ImageControler.php');

class BackofficeControler extends Controler
{
    private $post;
    private $comment;
    private $image;

    private static $extensionImgValide = array('jpg', 'jpeg', 'png');

    public function __construct()
    {
        $this->post = new PostManager();
        $this->comment = new CommentManager();
        $this->image = new ImageControler();
        $_SESSION['admin'] = 1;
    }

    public function listPosts()
    {
        $posts = $this->post->getPosts();
        $this->generateView(array('posts' => $posts));
    }

    public function formPost()
    {
        $this->generateView(array());
    }

    public function addPost()
    {
        //enregistrement des paramètres dans des variables si ils existent
        if ($this->request->parameterExists('content')) {
            $content = $this->request->getParameter('content');
        }

        if ($this->request->parameterExists('title')) {
            $title = $this->request->getParameter('title');
        }

        if ($this->request->parameterExists('imgPost')) {
            $imgPost = $this->request->getParameter('imgPost');
        }

        //contrôle des variables
        if (!isset($content) || $content == "") {
            throw new Exception('Vous n\'avez pas rédigé de commentaire.');
        }

        if (!isset($title) || $title == "") {
            throw new Exception('Vous n\'avez pas rédigé de titre.');
        }

        if (!isset($imgPost) || $imgPost['name'] == '') {
            throw new Exception('Vous n\'avez pas rattaché d\'image à votre post.');
        } else {
            //test file supérieur à 1mo
            if ($imgPost['size'] >= 1000000) {
                throw new Exception("Le fichier est trop volumineux. Merci de choisir un fichier dont la taille ne dépasse pas 1Mo.");
            } else {
                //test file extension
                $fileInfo = pathinfo($imgPost['name']);
                $fileExtension = $fileInfo['extension'];
                if (!in_array($fileExtension, self::$extensionImgValide)) {
                    throw new Exception("Le fichier n'a pas une extension valide (jpg, jpeg, png).");
                }
            }
        }

        $affectedLines = $this->post->addPost($title, $content, $_SESSION['id']);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le post.');
        } else {
            $lastPostId = $this->post->lastInsertId();
            $fileName = "post" . $lastPostId . "." . $fileExtension;
            $newFile = mkdir('../photoPost/' . $lastPostId);

            move_uploaded_file($imgPost['tmp_name'], '../photoPost/' . $lastPostId . "/" . $fileName);

            $fileMiniName = $this->image->resizeImage($fileName, $fileExtension, $lastPostId);

            $affectedLines = $this->post->addImgPost($lastPostId, $fileName, $fileMiniName);

            $racineWeb = Configuration::get("racineWeb", "/");
            header('Location:' . $racineWeb . 'backoffice/formPost/' . $lastPostId);
        }
    }

    public function updatePost()
    {
        //enregistrement des paramètres dans des variables si ils existent
        if ($this->request->parameterExists('content')) {
            $content = $this->request->getParameter('content');
        }

        if ($this->request->parameterExists('title')) {
            $title = $this->request->getParameter('title');
        }

        if ($this->request->parameterExists('imgPost')) {
            $imgPost = $this->request->getParameter('imgPost');
        }

        if ($this->request->parameterExists('id')) {
            $postId = $this->request->getParameter('id');
        }

        //contrôle des variables
        if (!isset($postId)) {
            throw new Exception('Identifiant invalide.');
        }
        if (!isset($content) || $content == "") {
            throw new Exception('Vous n\'avez pas rédigé de commentaire.');
        } elseif ($content == "") {
            throw new Exception('Vous n\'avez pas rédigé de commentaire.');
        }

        if (!isset($title)) {
            throw new Exception('Vous n\'avez pas rédigé de titre.');
        } elseif ($title == "") {
            throw new Exception('Vous n\'avez pas rédigé de titre.');
        }

        //contrôle de l'image si modification 
        //var_dump($imgPost);
        if ($imgPost['name'] != '') {
            //test file supérieur à 1mo
            if ($imgPost['size'] >= 1000000) {
                throw new Exception("Le fichier est trop volumineux. Merci de choisir un fichier dont la taille ne dépasse pas 1Mo.");
            } else {
                //test file extension
                $fileInfo = pathinfo($imgPost['name']);
                $fileExtension = $fileInfo['extension'];
                if (!in_array($fileExtension, self::$extensionImgValide)) {
                    throw new Exception("Le fichier n'a pas une extension valide (jpg, jpeg, png).");
                }
            }
        }

        $affectedLines = $this->post->updatePost($title, $content, $postId);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le post.');
        } else if ($imgPost['name'] != '') {
            //$lastPostId = $this->post->lastInsertId();
            $fileName = "post" . $postId . "." . $fileExtension;
            $newFile = mkdir('../photoPost/' . $postId);

            move_uploaded_file($imgPost['tmp_name'], '../photoPost/' . $postId . "/" . $fileName);

            $fileMiniName = $this->image->resizeImage($fileName, $fileExtension, $postId);

            $affectedLines = $this->post->addImgPost($postId, $fileName, $fileMiniName);
        }

        $racineWeb = Configuration::get("racineWeb", "/");
        header('Location:' . $racineWeb . 'backoffice/listPosts/');
    }

    public function deletePost()
    {
        if ($this->request->parameterExists('id')) {
            $postId = $this->request->getParameter('id');
            $affectedLines = $this->post->deletePost($postId);
            if ($affectedLines == false) {
                throw new Exception("Impossible de supprimer le post");
            } else {
                $affectedLines = $this->comment->deleteComments($postId);
                $racineWeb = Configuration::get("racineWeb", "/");
                header('Location:' . $racineWeb . 'backoffice/listPosts/');
            }
        } else {
            throw new Exception("Impossible de supprimer le post");
        }
    }

    public function getComments()
    {
        $comments = $this->comment->getCommentsBackOffice();
        $this->generateView(array('comments' => $comments));
    }

    public function deleteComment()
    {
        $commentId = $this->request->getParameter('id');
        $affectedLines = $this->comment->deleteComment($commentId);

        if ($affectedLines === false) {
            // Erreur gérée. Elle sera remontée jusqu'au bloc try du routeur !
            throw new Exception('Impossible de supprimer le commentaire.');
        }

        $racineWeb = Configuration::get("racineWeb", "/");
        header('Location:' . $racineWeb . 'backoffice/getComments');
    }

    public function validateComment()
    {
        $commentId = $this->request->getParameter('id');
        $affectedLines = $this->comment->validateComment($commentId);

        if ($affectedLines === false) {
            // Erreur gérée. Elle sera remontée jusqu'au bloc try du routeur !
            throw new Exception('Impossible de valider le commentaire.');
        }

        $racineWeb = Configuration::get("racineWeb", "/");
        header('Location:' . $racineWeb . 'backoffice/getComments');
    }
}
