<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ItemCollectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ItemCollectionRepository::class)
 */
class ItemCollection
{
    /**
     * This collection's unique ID.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * A name for this collection.
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * A detailed description of this collection.
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * Can this collection be viewed by anyone?
     *
     * @ORM\Column(type="boolean")
     */
    private $isPublic;

    /**
     * The owner(s) of this collection.
     *
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="collections")
     */
    private $owners;

    /**
     * All the books that belong to this collection.
     *
     * @ORM\OneToMany(targetEntity=Book::class, mappedBy="collection", orphanRemoval=true)
     */
    private $books;

    /**
     * All the movies that belong to this collection.
     *
     * @ORM\OneToMany(targetEntity=Movie::class, mappedBy="collection")
     */
    private $movies;

    public function __construct()
    {
        $this->owners = new ArrayCollection();
        $this->books = new ArrayCollection();
        $this->movies = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIsPublic(): ?bool
    {
        return $this->isPublic;
    }

    public function setIsPublic(bool $isPublic): self
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getOwners(): Collection
    {
        return $this->owners;
    }

    public function addOwner(User $owner): self
    {
        if (!$this->owners->contains($owner)) {
            $this->owners[] = $owner;
        }

        return $this;
    }

    public function removeOwner(User $owner): self
    {
        $this->owners->removeElement($owner);

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
            $book->setCollection($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->books->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getCollection() === $this) {
                $book->setCollection(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Movie[]
     */
    public function getMovies(): Collection
    {
        return $this->movies;
    }

    public function addMovie(Movie $movie): self
    {
        if (!$this->movies->contains($movie)) {
            $this->movies[] = $movie;
            $movie->setCollection($this);
        }

        return $this;
    }

    public function removeMovie(Movie $movie): self
    {
        if ($this->movies->removeElement($movie)) {
            // set the owning side to null (unless already changed)
            if ($movie->getCollection() === $this) {
                $movie->setCollection(null);
            }
        }

        return $this;
    }
}
