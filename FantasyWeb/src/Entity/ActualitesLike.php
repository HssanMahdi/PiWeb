<?php

namespace App\Entity;

use App\Repository\ActualitesLikeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActualitesLikeRepository::class)
 */
class ActualitesLike
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Actualites::class, inversedBy="likes")
     */
    private $actualites;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActualites(): ?Actualites
    {
        return $this->actualites;
    }

    public function setActualites(?Actualites $actualites): self
    {
        $this->actualites = $actualites;

        return $this;
    }

}
