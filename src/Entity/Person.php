<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PersonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PersonRepository::class)
 */
class Person
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $referenceUrl;

    /**
     * @ORM\ManyToMany(targetEntity=Book::class, mappedBy="authors")
     */
    private $books;

    /**
     * @ORM\OneToMany(targetEntity=Movie::class, mappedBy="director")
     */
    private $moviesdirected;

    /**
     * @ORM\ManyToMany(targetEntity=Movie::class, mappedBy="actors")
     */
    private $moviesplayed;

    public function __construct()
    {
        $this->books = new ArrayCollection();
        $this->moviesdirected = new ArrayCollection();
        $this->moviesplayed = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getReferenceUrl(): ?string
    {
        return $this->referenceUrl;
    }

    public function setReferenceUrl(?string $referenceUrl): self
    {
        $this->referenceUrl = $referenceUrl;

        return $this;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->addAuthor($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->books->removeElement($book)) {
            $book->removeAuthor($this);
        }

        return $this;
    }

    /**
     * @return Collection|Movie[]
     */
    public function getMoviesdirected(): Collection
    {
        return $this->moviesdirected;
    }

    public function addMoviesdirected(Movie $moviesdirected): self
    {
        if (!$this->moviesdirected->contains($moviesdirected)) {
            $this->moviesdirected[] = $moviesdirected;
            $moviesdirected->setDirector($this);
        }

        return $this;
    }

    public function removeMoviesdirected(Movie $moviesdirected): self
    {
        if ($this->moviesdirected->removeElement($moviesdirected)) {
            // set the owning side to null (unless already changed)
            if ($moviesdirected->getDirector() === $this) {
                $moviesdirected->setDirector(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Movie[]
     */
    public function getMoviesplayed(): Collection
    {
        return $this->moviesplayed;
    }

    public function addMoviesplayed(Movie $moviesplayed): self
    {
        if (!$this->moviesplayed->contains($moviesplayed)) {
            $this->moviesplayed[] = $moviesplayed;
            $moviesplayed->addActor($this);
        }

        return $this;
    }

    public function removeMoviesplayed(Movie $moviesplayed): self
    {
        if ($this->moviesplayed->removeElement($moviesplayed)) {
            $moviesplayed->removeActor($this);
        }

        return $this;
    }
}
