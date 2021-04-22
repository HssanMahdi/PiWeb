<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Joueur
 * @ORM\Entity(repositoryClass="App\Repository\JoueurRepository")
 * @ORM\Table(name="joueur", indexes={@ORM\Index(name="FK_id_equipe", columns={"id_equipe"})})
 * @ORM\Entity
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
     * @Assert\NotBlank(message= "Nom non valide")
     * @ORM\Column(name="nom_joueur", type="text", length=65535, nullable=false)
     */
    private $nomJoueur;

    /**
     * @var string
     * @Assert\NotBlank(message= "Prenom non valide")
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
     *
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
     * @ORM\ManyToOne(targetEntity=Equipe::class)
     * @Assert\NotBlank(message="Prix non valide")
     * @ORM\JoinColumn(name="id_equipe", referencedColumnName="id_equipe")
     */
    private $idEquipe;

    private $rating;
    protected $captchaCode;

    /**
     * @return mixed
     */
    public function getCaptchaCode()
    {
        return $this->captchaCode;
    }

    /**
     * @param mixed $captchaCode
     */
    public function setCaptchaCode($captchaCode): void
    {
        $this->captchaCode = $captchaCode;
    }


    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating): void
    {
        $this->rating = $rating;
    }


    /**
     * @return int
     */
    public function getIdJoueur(): ?int
    {
        return $this->idJoueur;
    }

    /**
     * @param int $idJoueur
     */
    public function setIdJoueur(?int $idJoueur): void
    {
        $this->idJoueur = $idJoueur;
    }

    /**
     * @return string
     */
    public function getNomJoueur(): ?string
    {
        return $this->nomJoueur;
    }

    /**
     * @param string $nomJoueur
     */
    public function setNomJoueur(?string $nomJoueur): void
    {
        $this->nomJoueur = $nomJoueur;
    }

    /**
     * @return string
     */
    public function getPrenomJoueur(): ?string
    {
        return $this->prenomJoueur;
    }

    /**
     * @param string $prenomJoueur
     */
    public function setPrenomJoueur(?string $prenomJoueur): void
    {
        $this->prenomJoueur = $prenomJoueur;
    }

    /**
     * @return string
     */
    public function getPosition(): ?string
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition(?string $position): void
    {
        $this->position = $position;
    }

    /**
     * @return int|null
     */
    public function getScoreJoueur(): ?int
    {
        return $this->scoreJoueur;
    }

    /**
     * @param int|null $scoreJoueur
     */
    public function setScoreJoueur(?int $scoreJoueur): void
    {
        $this->scoreJoueur = $scoreJoueur;
    }

    /**
     * @return string|null
     */
    public function getLogoJoueur(): ?string
    {
        return $this->logoJoueur;
    }

    /**
     * @param string|null $logoJoueur
     */
    public function setLogoJoueur(?string $logoJoueur): void
    {
        $this->logoJoueur = $logoJoueur;
    }

    /**
     * @return int|null
     */
    public function getPrixJoueur(): ?int
    {
        return $this->prixJoueur;
    }

    /**
     * @param int|null $prixJoueur
     */
    public function setPrixJoueur(?int $prixJoueur): void
    {
        $this->prixJoueur = $prixJoueur;
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
    public function setIdEquipe( $idEquipe): void
    {
        $this->idEquipe = $idEquipe;
    }


}
