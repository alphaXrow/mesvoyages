<?php

namespace App\Entity;

use App\Repository\EnvironnementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnvironnementRepository::class)
 */
class Environnement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
    
    /**
     *
     * @ORM\ManyToMany(targetEntity="Environnement")
     */
    private $environnements;
    
    public function __construct()
    {
        $this->environnements = new ArrayCollection();
    }
    
    /**
     * @return Collection|Environnement[]
     */
    public function getEnvironnements(): Collection
    {
        return $this->environnements;
    }
    
    public function addEnvironnement (Environnement $environnement): self
    {
        if (!$this->environnements->contains($environnement)) {
            $this->environnements[] = $environnement;
        }
        
        return $this;
    }
    
    public function removeEnvironnement(Environnement $environnement): self
    {
        $this->environnements->removeElement($environnement);
        
        return $this;
    }
}
