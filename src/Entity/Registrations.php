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
     * @ORM\ManyToOne(targetEntity="App\Entity\Participants")
     */
    private $participant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trips")
     */
    private $trip;



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

    public function getTrip(): ?Trips
    {
        return $this->trip;
    }

    public function setTrip(?Trips $trip): self
    {
        $this->trip = $trip;

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

}
