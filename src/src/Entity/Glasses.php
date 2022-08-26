<?php

namespace App\Entity;

use App\Model\TimeInterface;
use App\Model\TimeTrait;
use App\Model\UserInterface;
use App\Model\UserTrait;
use App\Repository\GlassesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
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

    #[ORM\Column(length: 255), Assert\Regex(pattern: "/^[a-zA-Z]+$/"),
        Assert\NotBlank(message: 'Please enter the frame material.')]
    #[Gedmo\Translatable]
    private ?string $frameMaterial = null;

    #[ORM\Column(length: 255), Assert\Regex(pattern: "/^[a-zA-Z]+$/"),
        Assert\NotBlank(message: 'Please enter the frame form.')]
    #[Gedmo\Translatable]
    private ?string $frameForm = null;

    #[ORM\Column(length: 255), Assert\Regex(pattern: "/^[a-zA-Z]+$/"), Assert\NotBlank(message: 'Please enter tbe frame color.')]
    #[Gedmo\Translatable]
    private ?string $frameColor = null;

    #[ORM\Column(length: 255), Assert\Regex(pattern: "/^[a-zA-Z]+$/"), Assert\NotBlank(message: 'Please enter the brand')]
    #[Gedmo\Translatable]
    private ?string $brand = null;

    #[ORM\Column(length: 255), Assert\Regex(pattern: "/^[a-zA-Z]+$/"),
        Assert\NotBlank(message: 'Please enter the lenz material,')]
    #[Gedmo\Translatable]
    private ?string $lenzMaterial = null;

    #[ORM\Column(length: 255), Assert\Regex(pattern: "/^[a-zA-Z|\s\-]+$/"),
        Assert\NotBlank(message: 'Please enter the face form.')]
    #[Gedmo\Translatable]
    private ?string $faceForm = null;

    #[ORM\Column, Assert\NotBlank(message: 'Please enter the price.'),
        Assert\Positive(message: 'The {{ value }} is invalid.'), Assert\Type(type: 'float', message: 'The type is invalid.')]
    private ?float $price = null;

    #[ORM\ManyToOne(inversedBy: 'glasses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GlassesStore $glassesStore = null;

    #[ORM\Column(type: Types::TEXT), Assert\NotBlank(message: 'Please enter the description.')]
    #[Gedmo\Translatable]
    private ?string $description = null;

    #[ORM\Column(length: 255), Assert\Regex(pattern: "/^[a-zA-Z0-9|\s\-]+$/"),
        Assert\NotBlank(message: 'Please enter the model.')]
    private ?string $model = null;

    #[Gedmo\Locale]
    private $locale;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Order::class, orphanRemoval: true)]
    private Collection $orders;

    #[ORM\Column(length: 255), Assert\NotBlank(message: 'Please enter the image url.'),
        Assert\Url(message: 'The {{ value }} is invalid.')]
    private ?string $imageUrl = null;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function __toString(): string
    {
        return "{$this->brand} {$this->model}";
    }

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

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setProduct($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getProduct() === $this) {
                $order->setProduct(null);
            }
        }

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }
}
