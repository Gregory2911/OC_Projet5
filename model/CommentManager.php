<?php

//namespace OpenClassrooms\Blog\Model;

require_once("framework/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $req = 'select id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, member_id FROM comments WHERE post_id = ? and comments.isValide = 1 ORDER BY comment_date DESC';
        $comments = $this->executeRequete($req,array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment,$memberId)
    {
        $req = 'insert into comments(post_id, author, comment, comment_date,member_id) VALUES(?, ?, ?, NOW(), ?)';
        $affectedLines = $this->executeRequete($req,array($postId, $author, $comment, $memberId));

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
        $req = 'update comments set comment = ?, isValide = 0 where comments.id = ?';
        $affectedLines = $this->executeRequete($req,array($comment,$commentId));
        //echo $commentId." ".$comment;
    }

    public function getCommentPost($commentId)
    {
        $req = 'select comments.post_id from comments where comments.id = ?';
        $post = $this->executeRequete($req,array($commentId));
        $post = intval($post->fetch());
        return $post;
    }

    public function countComments($postId)
    {
        $req = 'select count(comments.id) as nbComments from comments where comments.post_id = ? and comments.isValide = 1';        
        $nb = $this->executeRequete($req, array($postId));
        //$nb = intval($nb->fetch());
        //throw new Exception($nb);
        return $nb;
    }

    public function getCommentsBackOffice()
    {
        $req = 'select comments.id, comments.author,comments.comment, comments.comment_date, comments.post_id, comments.member_id, comments.isValide, posts.title, members.pseudo from comments left join posts on posts.id = comments.post_id left join members on members.id = comments.member_id order by comment_date DESC';
        $comments = $this->executeRequete($req);
        return $comments;
    }

    public function deleteComment($commentId)
    {
        $req = 'delete from comments where comments.id = ?';
        $affectedLines = $this->executeRequete($req, array($commentId));
        return $affectedLines;
    }

    public function validateComment($commentId)
    {
        $req = 'update comments set isValide = 1 where comments.id = ?';
        $affectedLines = $this->executeRequete($req, array($commentId));
        return $affectedLines;   
    }
 }