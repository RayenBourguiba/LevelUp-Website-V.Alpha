<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $organisateur;

    /**
     * @ORM\ManyToMany(targetEntity=Equipe::class, inversedBy="evenements")
     */
    private $equipes;

    /**
     * @ORM\OneToMany(targetEntity=Classement::class, mappedBy="evenement")
     */
    private $classements;


    /**
     *
     * @ORM\Column(name="image", type="string", length=500, nullable=false)
     */
    private $image;


    private $file;


    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }


    public function __construct()
    {
        $this->equipes = new ArrayCollection();
        $this->classements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getOrganisateur(): ?string
    {
        return $this->organisateur;
    }

    public function setOrganisateur(string $organisateur): self
    {
        $this->organisateur = $organisateur;

        return $this;
    }

    /**
     * @return Collection|equipe[]
     */
    public function getEquipes(): Collection
    {
        return $this->equipes;
    }

    public function addEquipe(equipe $equipe): self
    {
        if (!$this->equipes->contains($equipe)) {
            $this->equipes[] = $equipe;
        }

        return $this;
    }

    public function removeEquipe(equipe $equipe): self
    {
        $this->equipes->removeElement($equipe);

        return $this;
    }

    /**
     * @return Collection|Classement[]
     */
    public function getClassements(): Collection
    {
        return $this->classements;
    }

    public function addClassement(Classement $classement): self
    {
        if (!$this->classements->contains($classement)) {
            $this->classements[] = $classement;
            $classement->setEvenement($this);
        }

        return $this;
    }

    public function removeClassement(Classement $classement): self
    {
        if ($this->classements->removeElement($classement)) {
            // set the owning side to null (unless already changed)
            if ($classement->getEvenement() === $this) {
                $classement->setEvenement(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;
    }

    public function getUploadDir()
    {
        return 'assets';
    }

    public function getAbsolutRoot()
    {
        return $this->getUploadRoot().$this->image ;
    }

    public function getWebPath()
    {
        return $this->getUploadDir().'/'.$this->image;
    }

    public function getUploadRoot()
    {
        return __DIR__.'/../../'.$this->getUploadDir().'/';
    }

    public function upload()
    {
        if($this->file === null){
            return;

        }
        $this->image = $this->file->getClientOriginalName();

        if(!is_dir($this->getUploadRoot()))
        {
            mkdir($this->getUploadRoot(),'0777',true);
        }

        $this->file->move($this->getUploadRoot(),$this->image);
        unset($this->file);
    }

}
