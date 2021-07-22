<?php

namespace App\Entity;

use App\Repository\CarsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarsRepository::class)
 */
class Cars
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $registration_number;

    /**
     * @ORM\Column(type="integer")
     */
    private $km;

    /**
     * @ORM\Column(type="boolean", nullable=true) 
     */
    private $featured_car;

    /**
     * @ORM\ManyToOne(targetEntity=CarBrand::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

    /**
     * @ORM\ManyToOne(targetEntity=CarColor::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity=Booking::class, mappedBy="car", orphanRemoval=true)
     */
    private $bookings;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegistrationNumber(): ?string
    {
        return $this->registration_number;
    }

    public function setRegistrationNumber(string $registration_number): self
    {
        $this->registration_number = $registration_number;

        return $this;
    }

    public function getKm(): ?int
    {
        return $this->km;
    }

    public function setKm(int $km): self
    {
        $this->km = $km;

        return $this;
    }

    public function getFeaturedCar(): ?bool
    {
        return $this->featured_car;
    }

    public function setFeaturedCar(?bool $featured_car): self
    {
        $this->featured_car = $featured_car;

        return $this;
    }

    public function getBrand(): ?CarBrand
    {
        return $this->brand;
    }

    public function setBrand(?CarBrand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getColor(): ?CarColor
    {
        return $this->color;
    }

    public function setColor(?CarColor $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setCar($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getCar() === $this) {
                $booking->setCar(null);
            }
        }

        return $this;
    }
}
