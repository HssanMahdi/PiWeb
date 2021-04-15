<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rateproduit
 *
 * @ORM\Table(name="rateproduit", indexes={@ORM\Index(name="FK_ppp", columns={"id_produit"})})
 * @ORM\Entity
 */
class Rateproduit
{
    /**
     * @var int
     *
     * @ORM\Column(name="idRate", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrate;

    /**
     * @var int
     *
     * @ORM\Column(name="id_produit", type="integer", nullable=false)
     */
    private $idProduit;

    /**
     * @var float
     *
     * @ORM\Column(name="rate", type="float", precision=10, scale=0, nullable=false)
     */
    private $rate;

    /**
     * @var int
     *
     * @ORM\Column(name="id_User", type="integer", nullable=false)
     */
    private $idUser;

    public function getIdrate(): ?int
    {
        return $this->idrate;
    }

    public function getIdProduit(): ?int
    {
        return $this->idProduit;
    }

    public function setIdProduit(int $idProduit): self
    {
        $this->idProduit = $idProduit;

        return $this;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(float $rate): self
    {
        $this->rate = $rate;

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
