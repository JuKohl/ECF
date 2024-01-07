<?php

namespace App\Entity;

class PropertySearch {

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minMileage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxMileage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minReleaseYear;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxReleaseYear;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minPrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxPrice;

    // Getters and Setters for each property...


    public function getMinMileage(): ?int
    {
        return $this->minMileage;
    }

    public function setMinMileage(int $minMileage): self
    {
        $this->minMileage = $minMileage;
        return $this;
    }

    public function getMaxMileage(): ?int
    {
        return $this->maxMileage;
    }

    public function setMaxMileage(int $maxMileage): self
    {
        $this->maxMileage = $maxMileage;
        return $this;
    }

    public function getMinReleaseYear(): ?int
    {
        return $this->minReleaseYear;
    }

    public function setMinReleaseYear(int $minReleaseYear): self
    {
        $this->minReleaseYear = $minReleaseYear;
        return $this;
    }

    public function getMaxReleaseYear(): ?int
    {
        return $this->maxReleaseYear;
    }

    public function setMaxReleaseYear(int $maxReleaseYear): self
    {
        $this->maxReleaseYear = $maxReleaseYear;
        return $this;
    }

    public function getMinPrice(): ?int
    {
        return $this->minPrice;
    }

    public function setMinPrice(int $minPrice): self
    {
        $this->minPrice = $minPrice;
        return $this;
    }

    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(int $maxPrice): self
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }
}