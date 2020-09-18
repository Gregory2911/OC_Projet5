<?php

require_once('framework/Entity.php');

class Comment extends Entity
{
    private $_id;
    private $_content;
    private $_commentDate;
    private $_postId;
    private $_memberId;
    private $_isValide;
    private $_author;
    private $_pseudo;
    private $_postTitle;


    /*-----GETTERS-----*/
    public function id()
    {
        return $this->_id;
    }

    public function content()
    {
        return $this->_content;
    }

    public function commentDate()
    {
        return $this->_commentDate;
    }

    public function postId()
    {
        return $this->_postId;
    }

    public function memberId()
    {
        return $this->_memberId;
    }

    public function isValide()
    {
        return $this->_isValide;
    }

    public function author()
    {
        return $this->_author;
    }

    public function pseudo()
    {
        return $this->_pseudo;
    }

    public function postTitle()
    {
        return $this->_postTitle;
    }

    /*---------SETTERS---------------------*/
    public function setId($id)
    {
        $this->_id = (int) $id;
    }

    public function setComment($comment)
    {
        if (is_string($comment)) {
            $this->_content = $comment;
        }
    }

    public function setComment_date_fr($commentDate)
    {
        $this->_commentDate = $commentDate;
    }

    public function setPost_id($postId)
    {
        $this->_postId = (int) $postId;
    }

    public function setMember_id($memberId)
    {
        $this->_memberId = (int) $memberId;
    }

    public function setisValide($isValide)
    {
        $this->_isValide = $isValide;
    }

    public function setAuthor($author)
    {
        if (is_string($author)) {
            $this->_author = $author;
        }
    }

    public function setPseudo($pseudo)
    {
        if (is_string($pseudo)) {
            $this->_pseudo = $pseudo;
        }
    }

    public function setTitle($postTitle)
    {
        if (is_string($postTitle)) {
            $this->_postTitle = $postTitle;
        }
    }
}
