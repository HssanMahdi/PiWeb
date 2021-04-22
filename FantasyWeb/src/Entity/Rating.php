<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rating
 * @ORM\Entity(repositoryClass="App\Repository\RatingRepository")
 * @ORM\Table(name="rating", indexes={@ORM\Index(name="FK_joueur", columns={"id_joueur"}), @ORM\Index(name="FK_rating", columns={"id_user"})})
 * @ORM\Entity
 */
class Rating
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_rating", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRating;

    /**
     * @var float
     *
     * @ORM\Column(name="ratingValue", type="float", precision=10, scale=0, nullable=false)
     */
    private $ratingvalue;

    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var int
     *
     * @ORM\Column(name="id_joueur", type="integer", nullable=false)
     */
    private $idJoueur;

    /**
     * @return int
     */
    public function getIdRating(): int
    {
        return $this->idRating;
    }

    /**
     * @param int $idRating
     */
    public function setIdRating(?int $idRating): void
    {
        $this->idRating = $idRating;
    }

    /**
     * @return float
     */
    public function getRatingvalue(): ?float
    {
        return $this->ratingvalue;
    }

    /**
     * @param float $ratingvalue
     */
    public function setRatingvalue(?float $ratingvalue): void
    {
        $this->ratingvalue = $ratingvalue;
    }

    /**
     * @return int
     */
    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    /**
     * @param int $idUser
     */
    public function setIdUser(?int $idUser): void
    {
        $this->idUser = $idUser;
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




}
