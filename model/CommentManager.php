<?php

//namespace OpenClassrooms\Blog\Model;

require_once("framework/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $req = 'select id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC';
        $comments = $this->executeRequete($req,array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment)
    {
        $req = 'insert into comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())';
        $affectedLines = $this->executeRequete($req,array($postId, $author, $comment));

        return $affectedLines;
    }

    public function getComment($commentId)
    {
        $req = 'select comments.id, comments.author, comments.comment, DATE_FORMAT(comment_date,\'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, post_id FROM comments left join posts on posts.id = comments.post_id where comments.id = ?';
        $comment = $this->executeRequete($req,array($commentId));

        return $comment;
    }

    public function updateComment($commentId, $comment)
    {
        $req = 'update comments set comment = ? where comments.id = ?';
        $affectedLines = $this->executeRequete($req,array($comment,$commentId));
        //echo $commentId." ".$comment;
    }
 }