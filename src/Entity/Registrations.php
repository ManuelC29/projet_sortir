<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegistrationsRepository")
 */
class Registrations
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateRegistration;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Participants", inversedBy="registrations")
     */
    private $participant;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trips", inversedBy="registration")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trips;

    public function __construct()
    {
        $this->dateRegistration = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateRegistration(): ?\DateTimeInterface
    {
        return $this->dateRegistration;
    }

    public function setDateRegistration(\DateTimeInterface $dateRegistration): self
    {
        $this->dateRegistration = $dateRegistration;

        return $this;
    }

    public function getParticipant(): ?Participants
    {
        return $this->participant;
    }

    public function setParticipant(?Participants $participant): self
    {
        $this->participant = $participant;

        return $this;
    }


    public function setRegistration(Participants $param)
    {
        //TODO
    }

    public function getRegistration()
    {
        //TODO
    }

    public function getTrips(): ?Trips
    {
        return $this->trips;
    }

    public function setTrips(?Trips $trips): self
    {
        $this->trips = $trips;

        return $this;
    }

}
