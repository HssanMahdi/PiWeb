<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups ;

/**
 * Produit
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 * @ORM\Table(name="produit", indexes={@ORM\Index(name="FK_categorie", columns={"id_categorie"})})

 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_produit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups("posts:read")
     */
    private $idProduit;

    /**
     * @var int*
     * @ORM\Column(name="id_categorie", type="integer", nullable=false)
     * @Groups("posts:read")
     */
    private $idCategorie;


    /**
     * @var string
     *
     * @ORM\Column(name="nom_produit", type="string", length=255, nullable=false)
     * @Groups("posts:read")
     */
    private $nomProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_categorie", type="string", length=255, nullable=false)
     * @Groups("posts:read")
     */
    private $nomCategorie;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_unitaire", type="float", precision=10, scale=0, nullable=false)
     * @Groups("posts:read")
     */
    private $prixUnitaire;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     * @Groups("posts:read")
     */
    private $quantite;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     * @Groups("posts:read")
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     * @Groups("posts:read")
     */
    private $description;


    public function getIdProduit(): ?int
    {
        return $this->idProduit;
    }

    public function getIdCategorie(): ?int
    {
        return $this->idCategorie;
    }

    public function setIdCategorie(int $idCategorie): self
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }

    public function getNomProduit(): ?string
    {
        return $this->nomProduit;
    }

    public function setNomProduit(string $nomProduit): self
    {
        $this->nomProduit = $nomProduit;

        return $this;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nomCategorie;
    }

    public function setNomCategorie(string $nomCategorie): self
    {
        $this->nomCategorie = $nomCategorie;

        return $this;
    }

    public function getPrixUnitaire(): ?float
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(float $prixUnitaire): self
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
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
