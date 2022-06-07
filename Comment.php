<?php

class Comment
{
    public $user = null;
    public $text = null;
     

    public function __construct($user = null, $text = null)
    {
        $this->user = $user;
        $this->text = $text;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function addText( $text)
    {
        $this->text = $text;
    }
     
}