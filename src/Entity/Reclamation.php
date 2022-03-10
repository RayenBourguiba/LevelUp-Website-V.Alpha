<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;




/**
 * @ORM\Entity(repositoryClass=ReclamationRepository::class)
 */
class Reclamation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("post:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("post:read")
     */
    private $sujet;

    /**
     * @ORM\Column(type="text")
     * @Groups("post:read")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("post:read")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     * @Groups("post:read")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="reclamation")
     * @Groups("post:read")
     */
    private $User;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("post:read")
     * @Assert\Email(
     *      message= "This Email is not valid")
     */
    private $email;

    public function __construct()
    {
        $this->User = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->User;
    }

    public function addUser(User $User): self
    {
        if (!$this->User->contains($User)) {
            $this->User[] = $User;
            $User->setReclamation($this);
        }

        return $this;
    }

    public function removeUser(User $User): self
    {
        if ($this->User->removeElement($User)) {
            // set the owning side to null (unless already changed)
            if ($User->getReclamation() === $this) {
                $User->setReclamation(null);
            }
        }

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
