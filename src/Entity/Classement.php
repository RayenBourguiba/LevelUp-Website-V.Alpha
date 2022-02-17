<?php

namespace App\Entity;

use App\Repository\ClassementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClassementRepository::class)
 */
class Classement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $rang;

    /**
     * @ORM\OneToOne(targetEntity=equipe::class, inversedBy="classement", cascade={"persist", "remove"})
     */
    private $equipe;

    /**
     * @ORM\ManyToOne(targetEntity=evenement::class, inversedBy="classements")
     */
    private $evenement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRang(): ?int
    {
        return $this->rang;
    }

    public function setRang(int $rang): self
    {
        $this->rang = $rang;

        return $this;
    }

    public function getEquipe(): ?equipe
    {
        return $this->equipe;
    }

    public function setEquipe(?equipe $equipe): self
    {
        $this->equipe = $equipe;

        return $this;
    }

    public function getEvenement(): ?evenement
    {
        return $this->evenement;
    }

    public function setEvenement(?evenement $evenement): self
    {
        $this->evenement = $evenement;

        return $this;
    }
}
