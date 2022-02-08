<?php

namespace App\Entity;

use App\Repository\BiduleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BiduleRepository::class)
 */
class Bidule
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
    private $chouette;

    /**
     * @ORM\ManyToMany(targetEntity=Truc::class, inversedBy="idBidule")
     */
    private $idTruc;

    public function __construct()
    {
        $this->idTruc = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChouette(): ?int
    {
        return $this->chouette;
    }

    public function setChouette(int $chouette): self
    {
        $this->chouette = $chouette;

        return $this;
    }

    /**
     * @return Collection|Truc[]
     */
    public function getIdTruc(): Collection
    {
        return $this->idTruc;
    }

    public function addIdTruc(Truc $idTruc): self
    {
        if (!$this->idTruc->contains($idTruc)) {
            $this->idTruc[] = $idTruc;
        }

        return $this;
    }

    public function removeIdTruc(Truc $idTruc): self
    {
        $this->idTruc->removeElement($idTruc);

        return $this;
    }

    public function __toString()
    {
        return (string)$this->getChouette();
    }

}
