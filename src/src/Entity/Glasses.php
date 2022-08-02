<?php

namespace App\Entity;

use App\Model\TimeInterface;
use App\Model\TimeTrait;
use App\Model\UserInterface;
use App\Model\UserTrait;
use App\Repository\GlassesRepository;
use Doctrine\DBAL\Types\Types;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Translatable\Translatable;

#[ORM\Entity(repositoryClass: GlassesRepository::class)]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false, hardDelete: true)]
class Glasses implements UserInterface, TimeInterface, Translatable
{
    use TimeTrait;
    use UserTrait;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Gedmo\Translatable]
    private ?string $frameMaterial = null;

    #[ORM\Column(length: 255)]
    #[Gedmo\Translatable]
    private ?string $frameForm = null;

    #[ORM\Column(length: 255)]
    #[Gedmo\Translatable]
    private ?string $frameColor = null;

    #[ORM\Column(length: 255)]
    #[Gedmo\Translatable]
    private ?string $brand = null;

    #[ORM\Column(length: 255)]
    #[Gedmo\Translatable]
    private ?string $lenzMaterial = null;

    #[ORM\Column(length: 255)]
    #[Gedmo\Translatable]
    private ?string $faceForm = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\ManyToOne(inversedBy: 'glasses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GlassesStore $glassesStore = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Gedmo\Translatable]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $model = null;

    #[Gedmo\Locale]
    private $locale;

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

    public function getCreatedBy()
    {
        // TODO: Implement getCreatedBy() method.
    }

    public function setCreatedBy($user)
    {
        // TODO: Implement setCreatedBy() method.
    }

    public function getUpdatedBy()
    {
        // TODO: Implement getUpdatedBy() method.
    }

    public function setUpdatedBy($user)
    {
        // TODO: Implement setUpdatedBy() method.
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }
}
