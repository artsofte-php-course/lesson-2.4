<?php 
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Project {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false, length=255)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", nullable=false, length=10)
     */
    protected $slug;
    
    public function __construct($name, $key)
    {
        $this->name = $name;
        $this->slug = $key;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSlug()
    {
        return $this->slug;
    }


    public function setName($name) 
    {
        $this->name = $name;
    }


    public function setSlug($slug) 
    {
        $this->slug = $slug;
    }


}