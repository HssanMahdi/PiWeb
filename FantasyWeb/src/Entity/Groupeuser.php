<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groupeuser
 *
 * @ORM\Table(name="groupeuser", indexes={@ORM\Index(name="FK_id_groupe", columns={"id_groupe"}), @ORM\Index(name="FK_id_user", columns={"id_user"})})
 * @ORM\Entity(repositoryClass="App\Repository\GroupeuserRepository")
 */
class Groupeuser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_groupeuser", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGroupeuser;

    /**
     * @var int
     *
     * @ORM\Column(name="id_groupe", type="integer", nullable=false)
     */
    private $idGroupe;

    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $idUser;

    public function getIdGroupeuser(): ?int
    {
        return $this->idGroupeuser;
    }

    public function getIdGroupe(): ?int
    {
        return $this->idGroupe;
    }

    public function setIdGroupe(int $idGroupe): self
    {
        $this->idGroupe = $idGroupe;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }


}
