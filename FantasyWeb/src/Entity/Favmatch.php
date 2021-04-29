<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Favmatch
 *
 * @ORM\Table(name="favmatch", indexes={@ORM\Index(name="FK_id_user", columns={"id_user"}), @ORM\Index(name="FK_idMatch", columns={"idMatch"})})
 * @ORM\Entity
 */
class Favmatch
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_favmatch", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFavmatch;

    /**
     * @var int
     *
     * @ORM\Column(name="idMatch", type="integer", nullable=false)
     */
    private $idmatch;

    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @return int
     */
    public function getIdFavmatch(): int
    {
        return $this->idFavmatch;
    }

    /**
     * @param int $idFavmatch
     */
    public function setIdFavmatch(int $idFavmatch): void
    {
        $this->idFavmatch = $idFavmatch;
    }

    /**
     * @return int
     */
    public function getIdmatch(): int
    {
        return $this->idmatch;
    }

    /**
     * @param int $idmatch
     */
    public function setIdmatch(int $idmatch): void
    {
        $this->idmatch = $idmatch;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    /**
     * @param int $idUser
     */
    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }


}
