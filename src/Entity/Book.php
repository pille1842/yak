<?php

namespace App\Entity;

use App\Entity\Traits\CollectibleTrait;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     attributes={"security"="is_granted('ROLE_USER')"},
 * )
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
    use CollectibleTrait;

    /**
     * This book's unique ID.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * This book's title.
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $title;

    /**
     * This book's ISBN.
     *
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Assert\Isbn
     */
    private $isbn;

    /**
     * The collection this book belongs to.
     *
     * @ORM\ManyToOne(targetEntity=ItemCollection::class, inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     */
    private $collection;

    /**
     * The authors who wrote this book.
     *
     * @ORM\ManyToMany(targetEntity=Person::class, inversedBy="books")
     */
    private $authors;

    public function __construct()
    {
        $this->authors = new ArrayCollection();
    }

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

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(?string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getCollection(): ?ItemCollection
    {
        return $this->collection;
    }

    public function setCollection(?ItemCollection $collection): self
    {
        $this->collection = $collection;

        return $this;
    }

    /**
     * @return Collection|Person[]
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    public function addAuthor(Person $author): self
    {
        if (!$this->authors->contains($author)) {
            $this->authors[] = $author;
        }

        return $this;
    }

    public function removeAuthor(Person $author): self
    {
        $this->authors->removeElement($author);

        return $this;
    }
}
