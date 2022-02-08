<?php

namespace App\Entity;

use App\Repository\TrucRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrucRepository::class)
 */
class Truc
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $Machin;

    /**
     * @ORM\ManyToMany(targetEntity=Bidule::class, mappedBy="idTruc")
     */
    private $idBidule;

    public function __construct()
    {
        $this->idBidule = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMachin(): ?string
    {
        return $this->Machin;
    }

    public function setMachin(string $Machin): self
    {
        $this->Machin = $Machin;

        return $this;
    }

    /**
     * @return Collection|Bidule[]
     */
    public function getIdBidule(): Collection
    {
        return $this->idBidule;
    }

    public function addIdBidule(Bidule $idBidule): self
    {
        if (!$this->idBidule->contains($idBidule)) {
            $this->idBidule[] = $idBidule;
            $idBidule->addIdTruc($this);
        }

        return $this;
    }

    public function removeIdBidule(Bidule $idBidule): self
    {
        if ($this->idBidule->removeElement($idBidule)) {
            $idBidule->removeIdTruc($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getMachin();
    }
}
