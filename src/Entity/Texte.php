<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TexteRepository")
 */
class Texte
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $en;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $fr;


    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->fr;
    }


    /**
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @param string $locale
     * @return null|string
     */
    public function getContent(string $locale='fr'): ?string
    {
        switch ($locale){
            case 'fr':return $this->fr;break;
            case 'en':return $this->en;break;
            default:return $this->fr;break;
        }
    }

    /**
     * @return null|string
     */
    public function getEn(): ?string
    {
        return $this->en;
    }

    /**
     * @param string $en
     * @return \App\Entity\Texte
     */
    public function setEn(string $en): self
    {
        $this->en = $en;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getFr(): ?string
    {
        return $this->fr;
    }

    /**
     * @param null|string $fr
     * @return \App\Entity\Texte
     */
    public function setFr(?string $fr): self
    {
        $this->fr = $fr;

        return $this;
    }
}