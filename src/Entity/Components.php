<?php

namespace App\Entity;

use App\Repository\ComponentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ComponentsRepository::class)
 */
class Components
{
    const AVAILABLE_TYPES =[
        'CPU' => 'Processeur',
        'RAM' => 'Mémoire Vive',
        'Graphic Card' => 'Carte Graphique',
        'Case' => 'Boitier',
        'Power Supply' => 'Alimentation',
        'HDD/SSD' => 'Disque Dur',
        'Motherboard' => 'Carte Mère',
        'Network Card' => 'Carte Réseau'
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min=4)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive()
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Choice(callback="getTypes")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $brand;

    /**
     * @ORM\ManyToMany(targetEntity=Computers::class, mappedBy="components")
     */
    private $computers;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    public function __construct()
    {
        $this->computers = new ArrayCollection();
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getTypes(): array
    {
        return self::AVAILABLE_TYPES;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return Collection|Computers[]
     */
    public function getComputers(): Collection
    {
        return $this->computers;
    }

    public function addComputer(Computers $computer): self
    {
        if (!$this->computers->contains($computer)) {
            $this->computers[] = $computer;
            $computer->addComponent($this);
        }

        return $this;
    }

    public function removeComputer(Computers $computer): self
    {
        if ($this->computers->removeElement($computer)) {
            $computer->removeComponent($this);
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
