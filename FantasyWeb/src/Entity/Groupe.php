<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Groupe
 *
 * @ORM\Table(name="groupe", indexes={@ORM\Index(name="FK_id_user", columns={"owner"})})
 * @ORM\Entity
 */
class Groupe
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_groupe", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGroupe;

    /**
     * @var string
     * @Assert\NotBlank(message= "Le champ doit être remplit")
     * @ORM\Column(name="nom_groupe", type="text", length=65535, nullable=false)
     */
    private $nomGroupe;

    /**
     * @var int
     *
     * @ORM\Column(name="owner", type="integer", nullable=false)
     */
    private $owner;


//    /**
//     * @ORM\ManyToOne (targetEntity=User::class , inversedBy="ownedGroupe")
//     * @ORM\JoinColumn(name="owner", referencedColumnName="idUser")
//     */
//    private $user;

    /**
     * @return int
     */
    public function getIdGroupe(): ?int
    {
        return $this->idGroupe;
    }

    /**
     * @param int $idGroupe
     */
    public function setIdGroupe(int $idGroupe): void
    {
        $this->idGroupe = $idGroupe;
    }

    /**
     * @return string|null
     */
    public function getNomGroupe(): ? string
    {
        return $this->nomGroupe;
    }

    /**
     * @param string $nomGroupe
     */
    public function setNomGroupe(?string $nomGroupe): void
    {
        $this->nomGroupe = $nomGroupe;
    }



    /**
     * @return int
     */
    public function getOwner(): int
    {
        return $this->owner;
    }

    /**
     * @param int $owner
     */
    public function setOwner(int $owner): void
    {
        $this->owner = $owner;
    }




}
