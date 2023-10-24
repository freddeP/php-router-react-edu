<?php

class Quote{

public $title;
public $author;
public $id;

public function __construct(string $title, string $author){

    $this->title = $title;
    $this->author = $author;
    $this->id = uniqid(true);
}



}