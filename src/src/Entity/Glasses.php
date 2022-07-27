<?php

namespace App\Entity;

use App\Repository\GlassesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GlassesRepository::class)]
class Glasses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $frameMaterial = null;

    #[ORM\Column(length: 255)]
    private ?string $frameForm = null;

    #[ORM\Column(length: 255)]
    private ?string $frameColor = null;

    #[ORM\Column(length: 255)]
    private ?string $brand = null;

    #[ORM\Column(length: 255)]
    private ?string $lenzMaterial = null;

    #[ORM\Column(length: 255)]
    private ?string $faceForm = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\ManyToOne(inversedBy: 'glasses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GlassesStore $glassesStore = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFrameMaterial(): ?string
    {
        return $this->frameMaterial;
    }

    public function setFrameMaterial(string $frameMaterial): self
    {
        $this->frameMaterial = $frameMaterial;

        return $this;
    }

    public function getFrameForm(): ?string
    {
        return $this->frameForm;
    }

    public function setFrameForm(string $frameForm): self
    {
        $this->frameForm = $frameForm;

        return $this;
    }

    public function getFrameColor(): ?string
    {
        return $this->frameColor;
    }

    public function setFrameColor(string $frameColor): self
    {
        $this->frameColor = $frameColor;

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

    public function getLenzMaterial(): ?string
    {
        return $this->lenzMaterial;
    }

    public function setLenzMaterial(string $lenzMaterial): self
    {
        $this->lenzMaterial = $lenzMaterial;

        return $this;
    }

    public function getFaceForm(): ?string
    {
        return $this->faceForm;
    }

    public function setFaceForm(string $faceForm): self
    {
        $this->faceForm = $faceForm;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getGlassesStore(): ?GlassesStore
    {
        return $this->glassesStore;
    }

    public function setGlassesStore(?GlassesStore $glassesStore): self
    {
        $this->glassesStore = $glassesStore;

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
}
