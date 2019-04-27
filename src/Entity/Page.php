<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PageRepository")
 */
class Page
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
     * @ORM\OneToOne(targetEntity="App\Entity\Texte", cascade={"persist", "remove"})
     * @Assert\Regex(pattern="/^[a-z0-9\-]+$/", message="les-mots-doivent-etre-separés-par-tiré")
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Texte", cascade={"persist", "remove"})
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="Texte", cascade={"persist", "remove"})
     */
    private $title;

    /**
     * @ORM\OneToOne(targetEntity="Texte", cascade={"persist", "remove"})
     */
    private $subtitle;
    
    /**
     * @ORM\OneToOne(targetEntity="Texte", cascade={"persist", "remove"})
     */
    private $textLead;

    /**
     * @ORM\OneToOne(targetEntity="Texte", cascade={"persist", "remove"})
     */
    private $content;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tri;
    
    
    /**
     * Blog constructor.
     */
    public function __construct()
    {
        $this->date=new \DateTime();
    }
    
    /**
     * @return mixed
     */
    public function __toString()  : string
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
	
	/**
	 * @return mixed
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * @param mixed $title
	 */
	public function setTitle($title): void
	{
		$this->title = $title;
	}
	
	/**
	 * @return mixed
	 */
	public function getSubtitle()
	{
		return $this->subtitle;
	}
	
	/**
	 * @param mixed $subtitle
	 */
	public function setSubtitle($subtitle): void
	{
		$this->subtitle = $subtitle;
	}
	
	/**
	 * @return mixed
	 */
	public function getTextLead()
	{
		return $this->textLead;
	}
	
	/**
	 * @param mixed $textLead
	 */
	public function setTextLead($textLead): void
	{
		$this->textLead = $textLead;
	}
	
	/**
	 * @return mixed
	 */
	public function getContent()
	{
		return $this->content;
	}
	
	/**
	 * @param mixed $content
	 */
	public function setContent($content): void
	{
		$this->content = $content;
	}
	
	/**
	 * @return mixed
	 */
	public function getTri()
	{
		return $this->tri;
	}
	
	/**
	 * @param mixed $tri
	 */
	public function setTri($tri): void
	{
		$this->tri = $tri;
	}
	

}
