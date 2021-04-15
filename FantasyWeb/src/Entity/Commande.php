<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_cmd", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCmd;

    /**
     * @var int
     *
     * @ORM\Column(name="id_User", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="adr_livraison", type="string", length=30, nullable=false)
     */
    private $adrLivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=false)
     */
    private $country;

    /**
     * @var int
     *
     * @ORM\Column(name="post_code", type="integer", nullable=false)
     */
    private $postCode;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=255, nullable=false)
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="total_price", type="float", precision=10, scale=0, nullable=false)
     */
    private $totalPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="liste_produit", type="string", length=255, nullable=false)
     */
    private $listeProduit;

    public function getIdCmd(): ?int
    {
        return $this->idCmd;
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

    public function getAdrLivraison(): ?string
    {
        return $this->adrLivraison;
    }

    public function setAdrLivraison(string $adrLivraison): self
    {
        $this->adrLivraison = $adrLivraison;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getPostCode(): ?int
    {
        return $this->postCode;
    }

    public function setPostCode(int $postCode): self
    {
        $this->postCode = $postCode;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(float $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

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

    public function getListeProduit(): ?string
    {
        return $this->listeProduit;
    }

    public function setListeProduit(string $listeProduit): self
    {
        $this->listeProduit = $listeProduit;

        return $this;
    }


}
