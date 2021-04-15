<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Joueur
 *
 * @ORM\Table(name="joueur", indexes={@ORM\Index(name="fk_id_equipe", columns={"id_equipe"})})
 * @ORM\Entity(repositoryClass="App\Repository\JoueurRepository")
 */
class Joueur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_joueur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idJoueur;

    /**
     * @var string
     * @Assert\NotBlank(message= "Nom joueur non valide")
     * @ORM\Column(name="nom_joueur", type="text", length=65535, nullable=false)
     */
    private $nomJoueur;

    /**
     * @var string
     * @Assert\NotBlank(message= "Prenom joueur non valide")
     * @ORM\Column(name="prenom_joueur", type="text", length=65535, nullable=false)
     */
    private $prenomJoueur;

    /**
     * @var string
     * @Assert\NotBlank(message= "Position non valide")
     * @ORM\Column(name="position", type="text", length=65535, nullable=false)
     */
    private $position;

    /**
     * @var int|null
     * @Assert\NotBlank(message= "Score non valide")
     * @ORM\Column(name="score_joueur", type="integer", nullable=true)
     */
    private $scoreJoueur;

    /**
     * @var string|null
     * @Assert\NotBlank(message= "Logo non valide")
     * @ORM\Column(name="logo_joueur", type="text", length=65535, nullable=true)
     */
    private $logoJoueur;

    /**
     * @var int|null
     * @Assert\NotBlank(message= "Prix non valide")
     * @ORM\Column(name="prix_joueur", type="integer", nullable=true)
     */
    private $prixJoueur;


    /**
     * @Assert\NotBlank(message= "Champ non valide")
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @ORM\JoinColumn(name="id_equipe", referencedColumnName="id_equipe")
     */
    private $idEquipe;

    public function getIdJoueur(): ?int
    {
        return $this->idJoueur;
    }

    public function getNomJoueur(): ?string
    {
        return $this->nomJoueur;
    }

    public function setNomJoueur(string $nomJoueur): self
    {
        $this->nomJoueur = $nomJoueur;

        return $this;
    }

    public function getPrenomJoueur(): ?string
    {
        return $this->prenomJoueur;
    }

    public function setPrenomJoueur(string $prenomJoueur): self
    {
        $this->prenomJoueur = $prenomJoueur;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getScoreJoueur(): ?int
    {
        return $this->scoreJoueur;
    }

    public function setScoreJoueur(?int $scoreJoueur): self
    {
        $this->scoreJoueur = $scoreJoueur;

        return $this;
    }

    public function getLogoJoueur(): ?string
    {
        return $this->logoJoueur;
    }

    public function setLogoJoueur(?string $logoJoueur): self
    {
        $this->logoJoueur = $logoJoueur;

        return $this;
    }

    public function getPrixJoueur(): ?int
    {
        return $this->prixJoueur;
    }

    public function setPrixJoueur(?int $prixJoueur): self
    {
        $this->prixJoueur = $prixJoueur;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdEquipe()
    {
        return $this->idEquipe;
    }

    /**
     * @param mixed $idEquipe
     */
    public function setIdEquipe($idEquipe): void
    {
        $this->idEquipe = $idEquipe;
    }




}
