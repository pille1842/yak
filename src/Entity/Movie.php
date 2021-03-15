<?php

namespace App\Entity;

use App\Entity\Traits\CollectibleTrait;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=MovieRepository::class)
 */
class Movie
{
    use CollectibleTrait;

    /**
     * This movie's unqiue ID.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * This movie's title.
     *
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * This movie's media type (e.g. DVD, BluRay, VHS, ...).
     *
     * @ORM\Column(type="string", length=10)
     */
    private $mediaType;

    /**
     * This movie's European Article Number (EAN).
     *
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $ean;

    /**
     * This movie's director.
     *
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="moviesdirected")
     */
    private $director;

    /**
     * The actors appearing in this movie.
     *
     * @ORM\ManyToMany(targetEntity=Person::class, inversedBy="moviesplayed")
     */
    private $actors;

    /**
     * The collection this movie belongs to.
     *
     * @ORM\ManyToOne(targetEntity=ItemCollection::class, inversedBy="movies")
     */
    private $collection;

    public function __construct()
    {
        $this->actors = new ArrayCollection();
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

    public function getMediaType(): ?string
    {
        return $this->mediaType;
    }

    public function setMediaType(string $mediaType): self
    {
        $this->mediaType = $mediaType;

        return $this;
    }

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan(?string $ean): self
    {
        $this->ean = $ean;

        return $this;
    }

    public function getDirector(): ?Person
    {
        return $this->director;
    }

    public function setDirector(?Person $director): self
    {
        $this->director = $director;

        return $this;
    }

    /**
     * @return Collection|Person[]
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(Person $actor): self
    {
        if (!$this->actors->contains($actor)) {
            $this->actors[] = $actor;
        }

        return $this;
    }

    public function removeActor(Person $actor): self
    {
        $this->actors->removeElement($actor);

        return $this;
    }

    public function getCollection(): ItemCollection
    {
        return $this->collection;
    }

    public function setCollection(ItemCollection $collection): self
    {
        $this->collection = $collection;

        return $this;
    }
}
