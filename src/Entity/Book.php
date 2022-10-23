<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity=category::class, inversedBy="books")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity=publisher::class, inversedBy="books")
     */
    private $publisher;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cost;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imgurl;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getCategory(): ?category
    {
        return $this->category;
    }

    public function setCategory(?category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getPublisher(): ?publisher
    {
        return $this->publisher;
    }

    public function setPublisher(?publisher $publisher): self
    {
        $this->publisher = $publisher;

        return $this;
    }

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(?float $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getImgurl(): ?string
    {
        return $this->imgurl;
    }

    public function setImgurl(?string $imgurl): self
    {
        $this->imgurl = $imgurl;

        return $this;
    }
}
