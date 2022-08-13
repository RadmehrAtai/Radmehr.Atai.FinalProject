<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

trait UserTrait
{
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $createdBy;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $updatedBy;

    /**
     * @return String
     */
    public function getCreatedBy(): mixed
    {
        return $this->createdBy;
    }

    /**
     * @param String $createdBy
     */
    public function setCreatedBy($createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return String
     */
    public function getUpdatedBy(): mixed
    {
        return $this->updatedBy;
    }

    /**
     * @param String $updatedBy
     */
    public function setUpdatedBy($updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }


}