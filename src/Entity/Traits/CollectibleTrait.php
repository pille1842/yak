<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A trait to be used with all items that are collectible, i.e. can be part of a collection.
 */
trait CollectibleTrait
{
    /**
     * A description of this item's contents.
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * This item's Amazon Standard Identification Number (ASIN).
     *
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Assert\Length(
     *     min=10,
     *     max=10
     * )
     */
    private $asin;

    /**
     * A rating of this item (between 0 and 5).
     *
     * @ORM\Column(type="smallint", nullable=true)
     * @Assert\Type("integer")
     * @Assert\Range(
     *     min=0,
     *     max=5
     * )
     */
    private $rating;

    /**
     * A personal review of this item.
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $review;

    /**
     * This item's current location.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * Whether this item has been rented, e.g. from a store or from a friend.
     *
     * @ORM\Column(type="boolean")
     * @Assert\Type("bool")
     */
    private $isRented;

    /**
     * If this item is rented, the name of the original owner.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $originalOwner;

    /**
     * If this item has been lent to another person, that person's name.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $isLentTo;

    /**
     * If this item has been rented, the date by which it needs to be returned.
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $returnUntil;

    /**
     * If this item has been rented, the date at which this item has been rented.
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $rentedAt;

    /**
     * If this item has been lent to another person, the date at which it was lent.
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $lentAt;

    /**
     * The date and time at which this item was added to the collection.
     *
     * @ORM\Column(type="datetime")
     */
    private $addedAt;

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAsin(): ?string
    {
        return $this->asin;
    }

    public function setAsin(?string $asin): self
    {
        $this->asin = $asin;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getReview(): ?string
    {
        return $this->review;
    }

    public function setReview(?string $review): self
    {
        $this->review = $review;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getIsRented(): bool
    {
        return $this->isRented;
    }

    public function setIsRented(bool $isRented): self
    {
        $this->isRented = $isRented;

        return $this;
    }

    public function getOriginalOwner(): ?string
    {
        return $this->originalOwner;
    }

    public function setOriginalOwner(?string $originalOwner): self
    {
        $this->originalOwner = $originalOwner;

        return $this;
    }

    public function getIsLentTo(): ?string
    {
        return $this->isLentTo;
    }

    public function setIsLentTo(?string $isLentTo): self
    {
        $this->isLentTo = $isLentTo;

        return $this;
    }

    public function getReturnUntil(): ?\DateTimeInterface
    {
        return $this->returnUntil;
    }

    public function setReturnUntil(?\DateTimeInterface $returnUntil): self
    {
        $this->returnUntil = $returnUntil;

        return $this;
    }

    public function getRentedAt(): ?\DateTimeInterface
    {
        return $this->rentedAt;
    }

    public function setRentedAt(?\DateTimeInterface $rentedAt): self
    {
        $this->rentedAt = $rentedAt;

        return $this;
    }

    public function getLentAt(): ?\DateTimeInterface
    {
        return $this->lentAt;
    }

    public function setLentAt(?\DateTimeInterface $lentAt): self
    {
        $this->lentAt = $lentAt;

        return $this;
    }

    public function getAddedAt(): \DateTimeInterface
    {
        return $this->addedAt;
    }

    public function setAddedAt(\DateTimeInterface $addedAt): self
    {
        $this->addedAt = $addedAt;

        return $this;
    }
}
