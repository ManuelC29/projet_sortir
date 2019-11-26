<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TripsRepository")
 */
class Trips implements FormTypeInterface
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

    public function __toString()
    {
        return $this->name;
    }
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
     * @ORM\OneToMany(targetEntity="App\Entity\Registrations", mappedBy="trips")
     */
    private $registration;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Participants", inversedBy="trips")
     * @ORM\JoinColumn(nullable=false)
     */
    private $organizer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cancelReason;

    

    public function __construct()
    {
        $this->registration = new ArrayCollection();
        $this->date_start = new \DateTime;
        $this->date_closing = new \DateTime;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->date_start;
    }

    public function setDateStart(?\DateTimeInterface $date_start): self
    {
        $this->date_start = $date_start;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(? int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDateClosing(): ?\DateTimeInterface
    {
        return $this->date_closing;
    }

    public function setDateClosing(?\DateTimeInterface $date_closing): self
    {
        $this->date_closing = $date_closing;

        return $this;
    }

    public function getMaxRegistration(): ?int
    {
        return $this->max_registration;
    }

    public function setMaxRegistration(?int $max_registration): self
    {
        $this->max_registration = $max_registration;

        return $this;
    }

    public function getDescriptionInfos(): ?string
    {
        return $this->description_infos;
    }

    public function setDescriptionInfos(?string $description_infos): self
    {
        $this->description_infos = $description_infos;

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

    /**
     * Builds the form.
     *
     * This method is called for each type in the hierarchy starting from the
     * top most type. Type extensions can further modify the form.
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array $options The options
     * @see FormTypeExtensionInterface::buildForm()
     *
     */public function buildForm(FormBuilderInterface $builder, array $options)
{
    // TODO: Implement buildForm() method.
}

    /**
     * Builds the form view.
     *
     * This method is called for each type in the hierarchy starting from the
     * top most type. Type extensions can further modify the view.
     *
     * A view of a form is built before the views of the child forms are built.
     * This means that you cannot access child views in this method. If you need
     * to do so, move your logic to {@link finishView()} instead.
     *
     * @param FormView $view The view
     * @param FormInterface $form The form
     * @param array $options The options
     * @see FormTypeExtensionInterface::buildView()
     *
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        // TODO: Implement buildView() method.
    }

    /**
     * Finishes the form view.
     *
     * This method gets called for each type in the hierarchy starting from the
     * top most type. Type extensions can further modify the view.
     *
     * When this method is called, views of the form's children have already
     * been built and finished and can be accessed. You should only implement
     * such logic in this method that actually accesses child views. For everything
     * else you are recommended to implement {@link buildView()} instead.
     *
     * @param FormView $view The view
     * @param FormInterface $form The form
     * @param array $options The options
     * @see FormTypeExtensionInterface::finishView()
     *
     */
    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        // TODO: Implement finishView() method.
    }

    /**
     * Configures the options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        // TODO: Implement configureOptions() method.
    }

    /**
     * Returns the prefix of the template block name for this type.
     *
     * The block prefix defaults to the underscored short class name with
     * the "Type" suffix removed (e.g. "UserProfileType" => "user_profile").
     *
     * @return string The prefix of the template block name
     */
    public function getBlockPrefix()
    {
        // TODO: Implement getBlockPrefix() method.
    }

    /**
     * Returns the name of the parent type.
     *
     * @return string|null The name of the parent type if any, null otherwise
     */
    public function getParent()
    {
        // TODO: Implement getParent() method.
    }

    public function getOrganizer(): ?Participants
    {
        return $this->organizer;
    }

    public function setOrganizer(?Participants $organizer): self
    {
        $this->organizer = $organizer;

        return $this;
    }

    public function getCancelReason(): ?string
    {
        return $this->cancelReason;
    }

    public function setCancelReason(?string $cancelReason): self
    {
        $this->cancelReason = $cancelReason;

        return $this;
    }

}
