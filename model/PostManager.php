<?php

//namespace OpenClassrooms\Blog\Model;

require_once("model/Manager.php");

class PostManager extends Manager
{
    public function getPosts()
    {        
        $req = 'select id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5';
        $posts = $this->executeRequete($req);
        return $posts;
    }

    public function getPost($postId)
    {
        $req = 'select id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?';
        $post = $this->executeRequete($req,array($postId));
        return $post->fetch();
    }
}