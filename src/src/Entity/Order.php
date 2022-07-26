<?php

namespace App\Entity;

use App\Model\TimeInterface;
use App\Model\TimeTrait;
use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false, hardDelete: true)]
class Order implements TimeInterface
{
    use TimeTrait;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?User $buyer = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private ?float $totalCost = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Glasses $product = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBuyer(): ?User
    {
        return $this->buyer;
    }

    public function setBuyer(?User $buyer): self
    {
        $this->buyer = $buyer;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTotalCost(): ?float
    {
        return $this->totalCost;
    }

    public function setTotalCost(float $totalCost): self
    {
        $this->totalCost = $totalCost;

        return $this;
    }

    public function getProduct(): ?Glasses
    {
        return $this->product;
    }

    public function setProduct(?Glasses $product): self
    {
        $this->product = $product;

        return $this;
    }
}
