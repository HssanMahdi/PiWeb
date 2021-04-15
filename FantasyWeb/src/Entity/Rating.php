<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rating
 *
 * @ORM\Table(name="rating", indexes={@ORM\Index(name="FK_joueur", columns={"id_joueur"}), @ORM\Index(name="FK_rating", columns={"id_user"})})
 * @ORM\Entity(repositoryClass="App\Repository\RatingRepository")
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

    public function getIdRating(): ?int
    {
        return $this->idRating;
    }

    public function getRatingvalue(): ?float
    {
        return $this->ratingvalue;
    }

    public function setRatingvalue(float $ratingvalue): self
    {
        $this->ratingvalue = $ratingvalue;

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

    public function getIdJoueur(): ?int
    {
        return $this->idJoueur;
    }

    public function setIdJoueur(int $idJoueur): self
    {
        $this->idJoueur = $idJoueur;

        return $this;
    }


}
