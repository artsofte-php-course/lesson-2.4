<?php 
namespace App\Entity;

class Project {


    protected $id;

    protected $name;

    protected $key;
    
    public function __construct($id, $name, $key)
    {
        $this->id = $id;
        $this->name = $name;
        $this->key = $key;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getKey()
    {
        return $this->key;
    }



}