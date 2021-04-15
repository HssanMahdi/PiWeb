<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actualites
 *
 * @ORM\Table(name="actualites")
 * @ORM\Entity
 */
class Actualites
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_actualites", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idActualites;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    public function getIdActualites(): ?int
    {
        return $this->idActualites;
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
