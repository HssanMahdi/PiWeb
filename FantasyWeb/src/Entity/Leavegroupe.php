<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Leavegroupe
 *
 * @ORM\Table(name="leavegroupe", indexes={@ORM\Index(name="FK_id_user", columns={"id_user"}), @ORM\Index(name="FK_id_groupe", columns={"id_groupe"})})
 * @ORM\Entity(repositoryClass="App\Repository\LeavegroupeRepository")
 */
class Leavegroupe
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_leave", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLeave;

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

    public function getIdLeave(): ?int
    {
        return $this->idLeave;
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
