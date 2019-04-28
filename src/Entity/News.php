<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NewsRepository")
 */
class News
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

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
     * Blog constructor.
     */
    public function __construct()
    {
        $this->date=new \DateTime();
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
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
