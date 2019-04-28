<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Texte", cascade={"persist", "remove"})
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\OneToOne(targetEntity="Texte", cascade={"persist", "remove"})
     * @Assert\Regex(pattern="/^[a-z0-9\-]+$/", message="les-mots-doivent-etre-separés-par-tiré")
     */
    private $slug;

    /**
     * @ORM\OneToOne(targetEntity="Texte", cascade={"persist", "remove"})
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Blog", mappedBy="categories")
     */
   private $blogs;

    /**
     * Category constructor.
     */
    public function __construct()
    {
        $this->date=new \DateTime();
        $this->blogs = new ArrayCollection();

    }
	
	/**
	 * @return mixed
	 */
	public function getBlogs()
	{
		return $this->blogs;
	}
	
	/**
	 * @param mixed $blogs
	 */
	public function setBlogs($blogs): void
	{
		$this->blogs = $blogs;
	}
    
    /**
     * @return string
     */
    public function __toString() :string
    {
        return $this->name;
    }
	
	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @param mixed $id
	 */
	public function setId($id): void
	{
		$this->id = $id;
	}
	
	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * @param mixed $name
	 */
	public function setName($name): void
	{
		$this->name = $name;
	}
	
	/**
	 * @return mixed
	 */
	public function getDate()
	{
		return $this->date;
	}
	
	/**
	 * @param mixed $date
	 */
	public function setDate($date): void
	{
		$this->date = $date;
	}
	
	/**
	 * @return mixed
	 */
	public function getSlug()
	{
		return $this->slug;
	}
	
	/**
	 * @param mixed $slug
	 */
	public function setSlug($slug): void
	{
		$this->slug = $slug;
	}
	
	/**
	 * @return mixed
	 */
	public function getDescription()
	{
		return $this->description;
	}
	
	/**
	 * @param mixed $description
	 */
	public function setDescription($description): void
	{
		$this->description = $description;
	}

 
}
