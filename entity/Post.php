<?php

require_once('framework/Entity.php');

class Post extends Entity
{
    private $_id;
    private $_title;
    private $_content;
    private $_creation_date;
    private $_author_id;
    private $_src_photo;
    private $_src_photo_mini;
    private $_pseudo;

    /*-----GETTERS-----*/
    public function id()
    {
        return $this->_id;
    }

    public function title()
    {
        return $this->_title;
    }

    public function content()
    {
        return $this->_content;
    }

    public function creationDate()
    {
        return $this->_creation_date;
    }

    public function authorId()
    {
        return $this->_author_id;
    }

    public function srcPhoto()
    {
        return $this->_src_photo;
    }

    public function srcPhotoMini()
    {
        return $this->_src_photo_mini;
    }

    public function pseudo()
    {
        return $this->_pseudo;
    }


    /*---------SETTERS---------------------*/
    public function setId($id)
    {
        $this->_id = (int) $id;
    }

    public function setTitle($title)
    {
        if (is_string($title)) {
            $this->_title = $title;
        }
    }

    public function setContent($content)
    {
        if (is_string($content)) {
            $this->_content = $content;
        }
    }

    public function setCreation_Date_Fr($creationDate)
    {
        $this->_creation_date = $creationDate;
    }

    public function setAuthor_Id($authorId)
    {
        $this->_author_id = $authorId;
    }

    public function setSrc_Photo($srcPhoto)
    {
        if (is_string($srcPhoto)) {
            $this->_src_photo = $srcPhoto;
        }
    }

    public function setSrc_Photo_Mini($srcPhotoMini)
    {
        if (is_string($srcPhotoMini)) {
            $this->_src_photo_mini = $srcPhotoMini;
        }
    }

    public function setPseudo($pseudo)
    {
        if (is_string($pseudo)) {
            $this->_pseudo = $pseudo;
        }
    }
}
