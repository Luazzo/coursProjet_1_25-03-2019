<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlogRepository")
 * @Vich\Uploadable
 */
class Blog
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
    private $title;

    /**
     * @ORM\OneToOne(targetEntity="Texte", cascade={"persist", "remove"})
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="Texte", cascade={"persist", "remove"})
     */
    private $suiteText;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", inversedBy="blogs")
     */
    private $categories;
    
	/**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="blogs", fileNameProperty="imageName")
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
     * Blog constructor.
     */
    public function __construct()
    {
        $this->comments = rand(2,45);
        $this->date=new \DateTime();
        $this->categories = new ArrayCollection();
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
	public function getSuiteText()
	{
		return $this->suiteText;
	}
	
	/**
	 * @param mixed $suiteText
	 */
	public function setSuiteText($suiteText): void
	{
		$this->suiteText = $suiteText;
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
	public function getComments()
	{
		return $this->comments;
	}
	
	/**
	 * @param mixed $comments
	 */
	public function setComments($comments): void
	{
		$this->comments = $comments;
	}
	
	/**
	 * @return mixed
	 */
	public function getCategories()
	{
		return $this->categories;
	}
	
	/**
	 * @param mixed $categories
	 */
	public function setCategories($categories): void
	{
		$this->categories = $categories;
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
	 * @return Blog
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
}
