<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $webPath;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $file;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $ord;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\News", inversedBy="image")
     */
    private $news;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tag", inversedBy="image")
     */
    private $tag;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="images")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="images")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Blog", inversedBy="images")
     */
    private $blog;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Work", inversedBy="images")
     */
    private $work;

    /**
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return \App\Entity\Image
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getWebPath(): ?string
    {
        return $this->webPath;
    }

    /**
     * @param string $webPath
     * @return \App\Entity\Image
     */
    public function setWebPath(string $webPath): self
    {
        $this->webPath = $webPath;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return \App\Entity\Image
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return \App\Entity\Image
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getFile(): ?string
    {
        return $this->file;
    }

    /**
     * @param string $file
     * @return \App\Entity\Image
     */
    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @return null|\DateTimeInterface
     */
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param \DateTimeInterface $date
     * @return \App\Entity\Image
     */
    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return null|int
     */
    public function getOrd(): ?int
    {
        return $this->ord;
    }

    /**
     * @param int $ord
     * @return \App\Entity\Image
     */
    public function setOrd(int $ord): self
    {
        $this->ord = $ord;

        return $this;
    }

    /**
     * @return null|\App\Entity\News
     */
    public function getNews(): ?News
    {
        return $this->news;
    }

    /**
     * @param null|\App\Entity\News $news
     * @return \App\Entity\Image
     */
    public function setNews(?News $news): self
    {
        $this->news = $news;

        return $this;
    }

    /**
     * @return null|\App\Entity\Tag
     */
    public function getTag(): ?Tag
    {
        return $this->tag;
    }

    /**
     * @param null|\App\Entity\Tag $tag
     * @return \App\Entity\Image
     */
    public function setTag(?Tag $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return null|\App\Entity\Category
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param null|\App\Entity\Category $category
     * @return \App\Entity\Image
     */
    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return null|\App\Entity\User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param null|\App\Entity\User $user
     * @return \App\Entity\Image
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return null|\App\Entity\Blog
     */
    public function getBlog(): ?Blog
    {
        return $this->blog;
    }

    /**
     * @param null|\App\Entity\Blog $blog
     * @return \App\Entity\Image
     */
    public function setBlog(?Blog $blog): self
    {
        $this->blog = $blog;

        return $this;
    }

    /**
     * @return null|\App\Entity\Work
     */
    public function getWork(): ?Work
    {
        return $this->work;
    }

    /**
     * @param null|\App\Entity\Work $work
     * @return \App\Entity\Image
     */
    public function setWork(?Work $work): self
    {
        $this->work = $work;

        return $this;
    }
}
