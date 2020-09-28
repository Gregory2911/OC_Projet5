<?php

require_once("framework/Manager.php");
require_once("entity/Post.php");

class PostManager extends Manager
{
    public function getPosts()
    {
        $req = 'select posts.id, posts.title, posts.châpo,posts.content, DATE_FORMAT(posts.creation_date, \'%d/%m/%Y\') AS creation_date_fr, posts.src_photo_mini, members.pseudo FROM posts left join members on members.id = posts.author_id ORDER BY creation_date DESC';
        $posts = $this->executeRequete($req);
        $postsArray = [];
        while ($data = $posts->fetch(\PDO::FETCH_ASSOC)) {
            array_push($postsArray, new Post($data));
        }
        return $postsArray;
    }

    public function getPost($postId)
    {
        $req = 'select posts.id, posts.title, posts.content, DATE_FORMAT(posts.creation_date, \'%d/%m/%Y\') AS creation_date_fr, posts.src_photo, members.pseudo FROM posts LEFT JOIN members on members.id = posts.author_id WHERE posts.id = ?';
        $post = $this->executeRequete($req, array($postId));
        $data = $post->fetch(\PDO::FETCH_ASSOC);
        return new Post($data);
    }

    public function addPost($title, $châpo, $content, $idMember)
    {
        $req = 'insert into posts(title,châpo,content,creation_date,author_id) values(?,?,?,NOW(),?)';
        $affectedLines = $this->executeRequete($req, array($title, $châpo, $content, $idMember));
        return $affectedLines;
    }

    public function addImgPost($postId, $src_photo, $src_photo_mini)
    {
        $req = 'update posts set src_photo = ? , src_photo_mini = ? where posts.id = ?';
        $affectedLines = $this->executeRequete($req, array($src_photo, $src_photo_mini, $postId));
        return $affectedLines;
    }

    public function deletePost($postId)
    {
        $req = 'delete from posts where posts.id = ?';
        $affectedLines = $this->executeRequete($req, array($postId));
        return $affectedLines;
    }

    public function updatePost($title, $châpo, $content, $postId)
    {
        $req = 'update posts set title = ?,châpo = ?, content = ? where posts.id = ?';
        $affectedLines = $this->executeRequete($req, array($title, $châpo, $content, $postId));
        return $affectedLines;
    }
}
