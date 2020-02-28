<?php

//namespace OpenClassrooms\Blog\Model;

require_once("framework/Manager.php");

class PostManager extends Manager
{
    public function getPosts()
    {        
        $req = 'select id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, src_photo_mini FROM posts ORDER BY creation_date DESC LIMIT 0, 5';
        $posts = $this->executeRequete($req);
        return $posts;
    }

    public function getPost($postId)
    {
        $req = 'select id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, src_photo FROM posts WHERE id = ?';
        $post = $this->executeRequete($req,array($postId));
        return $post->fetch();
    }

    public function addPost($title, $content, $idMember)
    {
        $req = 'insert into posts(title,content,creation_date,author_id) values(?,?,NOW(),?)';
        $affectedLines = $this->executeRequete($req,array($title,$content,$idMember));
        return $affectedLines;
    }

    public function addImgPost($postId, $src_photo, $src_photo_mini)
    {
        $req = 'update posts set src_photo = ? , src_photo_mini = ? where posts.id = ?';
        $affectedLines = $this->executeRequete($req,array($src_photo,$src_photo_mini,$postId));
        return $affectedLines;        
    }
}