<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkRepository")
 * @Vich\Uploadable
 */
class Work
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
     * @ORM\OneToOne(targetEntity="Texte", cascade={"persist", "remove"})
     * @Assert\Regex(pattern="/^[a-z0-9\-]+$/", message="les-mots-doivent-etre-separés-par-tiré")
     */
    private $slug;

    /**
     * @ORM\OneToOne(targetEntity="Texte", cascade={"persist", "remove"})
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", inversedBy="works")
     */
    private $tags;
    
	/**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="works", fileNameProperty="imageName")
     *
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string|null
     */
    private $imageName;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="works")
     */
    private $client;
	

    /**
     * Work constructor.
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->date = new \DateTime();
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
	public function getTags()
         	{
         		return $this->tags;
         	}
	
	/**
	 * @param mixed $tags
	 */
	public function setTags($tags): void
         	{
         		$this->tags = $tags;
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
	 * @return File|null
	 */
	public function getImageFile(): ?File
         	{
         		return $this->imageFile;
         	}
	
	
	/**
	 * @param File|null $imageFile
	 * @return Work
	 * @throws \Exception
	 */
	public function setImageFile(?File $imageFile): void
         	{
         		$this->imageFile = $imageFile;
         		        if (null !== $imageFile) {
                     if ($this->imageFile instanceof UploadedFile) {
                         // It is required that at least one field changes if you are using doctrine
                         // otherwise the event listeners won't be called and the file is lost
                         $this->date = new \DateTimeImmutable();
                     }
         
                 }
         	}
	
	/**
	 * @return string|null
	 */
	public function getImageName(): ?string
         	{
         		return $this->imageName;
         	}
	
	/**
	 * @param string|null $imageName
	 */
	public function setImageName(?string $imageName): self
         	{
         		$this->imageName = $imageName;
         		return $this;
         	}

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): self
    {
        $this->client = $client;

        return $this;
    }
}
