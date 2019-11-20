<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TripsRepository")
 */
class Trips
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_start;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_closing;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_registration;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description_infos;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Participants")
     * @ORM\Column(type="string", length=255)
     */
    private $organizer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Status")
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Places")
     * @ORM\JoinColumn(nullable=false)
     */
    private $place;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Participants")
     */
    private $participant;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Registrations", mappedBy="trips")
     */
    private $registration;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->registration = new ArrayCollection();
        $this->date_start = new \DateTime;
        $this->date_closing = new \DateTime;
        $this->organizer = $tokenStorage->getToken()->getUser();
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

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->date_start;
    }

    public function setDateStart(\DateTimeInterface $date_start): self
    {
        $this->date_start = $date_start;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration($duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDateClosing(): ?\DateTimeInterface
    {
        return $this->date_closing;
    }

    public function setDateClosing(\DateTimeInterface $date_closing): self
    {
        $this->date_closing = $date_closing;

        return $this;
    }

    public function getMaxRegistration(): ?int
    {
        return $this->max_registration;
    }

    public function setMaxRegistration(int $max_registration): self
    {
        $this->max_registration = $max_registration;

        return $this;
    }

    public function getDescriptionInfos(): ?string
    {
        return $this->description_infos;
    }

    public function setDescriptionInfos(string $description_infos): self
    {
        $this->description_infos = $description_infos;

        return $this;
    }

    public function getOrganizer(): ?string
    {
        return $this->organizer;
    }

    public function setOrganizer(string $organizer): self
    {
        $this->organizer = $organizer;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPlace(): ?Places
    {
        return $this->place;
    }

    public function setPlace(?Places $place): self
    {
        $this->place = $place;

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

    /**
     * @return Collection|Registrations[]
     */
    public function getRegistration(): Collection
    {
        return $this->registration;
    }

    public function addRegistration(Registrations $registration): self
    {
        if (!$this->registration->contains($registration)) {
            $this->registration[] = $registration;
            $registration->setTrips($this);
        }

        return $this;
    }

    public function removeRegistration(Registrations $registration): self
    {
        if ($this->registration->contains($registration)) {
            $this->registration->removeElement($registration);
            // set the owning side to null (unless already changed)
            if ($registration->getTrips() === $this) {
                $registration->setTrips(null);
            }
        }

        return $this;
    }
}
