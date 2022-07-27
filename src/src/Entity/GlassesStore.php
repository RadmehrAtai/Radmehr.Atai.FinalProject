<?php

namespace App\Entity;

use App\Repository\GlassesStoreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GlassesStoreRepository::class)]
class GlassesStore
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'glassesStores')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\OneToMany(mappedBy: 'glassesStore', targetEntity: Glasses::class, orphanRemoval: true)]
    private Collection $glasses;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    public function __construct()
    {
        $this->glasses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection<int, Glasses>
     */
    public function getGlasses(): Collection
    {
        return $this->glasses;
    }

    public function addGlass(Glasses $glass): self
    {
        if (!$this->glasses->contains($glass)) {
            $this->glasses[] = $glass;
            $glass->setGlassesStore($this);
        }

        return $this;
    }

    public function removeGlass(Glasses $glass): self
    {
        if ($this->glasses->removeElement($glass)) {
            // set the owning side to null (unless already changed)
            if ($glass->getGlassesStore() === $this) {
                $glass->setGlassesStore(null);
            }
        }

        return $this;
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}
