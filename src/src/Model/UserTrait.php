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
    public function getCreatedUser(): String
    {
        return $this->createdUser;
    }

    /**
     * @param String $createdUser
     */
    public function setCreatedUser($createdUser): void
    {
        $this->createdUser = $createdUser;
    }

    /**
     * @return String
     */
    public function getUpdatedUser(): String
    {
        return $this->updatedUser;
    }

    /**
     * @param String $updatedUser
     */
    public function setUpdatedUser($updatedUser): void
    {
        $this->updatedUser = $updatedUser;
    }


}