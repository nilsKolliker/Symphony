<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="suppliers")
 */
class Suppliers{
    /** * @ORM\Column(name="SupplierId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    public function getId(): ?int
    { 
        return $this->id;
    }
    /**
     * @ORM\Column(name="CompanyName", type="string", length=40)
     */
    private $name;
    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
}