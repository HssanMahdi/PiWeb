<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statistique
 *
 * @ORM\Table(name="statistique", indexes={@ORM\Index(name="FK_id_joueur", columns={"id_joueur"}), @ORM\Index(name="FK_id_equipe", columns={"id_equipe"})})
 * @ORM\Entity
 */
class Statistique
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_statistique", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idStatistique;

    /**
     * @var int
     *
     * @ORM\Column(name="but", type="integer", nullable=false)
     */
    private $but;

    /**
     * @var int
     *
     * @ORM\Column(name="assist", type="integer", nullable=false)
     */
    private $assist;

    /**
     * @var bool
     *
     * @ORM\Column(name="clean", type="boolean", nullable=false)
     */
    private $clean;

    /**
     * @var int
     *
     * @ORM\Column(name="numbery", type="integer", nullable=false)
     */
    private $numbery;

    /**
     * @var int
     *
     * @ORM\Column(name="numberr", type="integer", nullable=false)
     */
    private $numberr;

    /**
     * @var int
     *
     * @ORM\Column(name="id_equipe", type="integer", nullable=false)
     */
    private $idEquipe;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_joueur", type="integer", nullable=true)
     */
    private $idJoueur;

    public function getIdStatistique(): ?int
    {
        return $this->idStatistique;
    }

    public function getBut(): ?int
    {
        return $this->but;
    }

    public function setBut(int $but): self
    {
        $this->but = $but;

        return $this;
    }

    public function getAssist(): ?int
    {
        return $this->assist;
    }

    public function setAssist(int $assist): self
    {
        $this->assist = $assist;

        return $this;
    }

    public function getClean(): ?bool
    {
        return $this->clean;
    }

    public function setClean(bool $clean): self
    {
        $this->clean = $clean;

        return $this;
    }

    public function getNumbery(): ?int
    {
        return $this->numbery;
    }

    public function setNumbery(int $numbery): self
    {
        $this->numbery = $numbery;

        return $this;
    }

    public function getNumberr(): ?int
    {
        return $this->numberr;
    }

    public function setNumberr(int $numberr): self
    {
        $this->numberr = $numberr;

        return $this;
    }

    public function getIdEquipe(): ?int
    {
        return $this->idEquipe;
    }

    public function setIdEquipe(int $idEquipe): self
    {
        $this->idEquipe = $idEquipe;

        return $this;
    }

    public function getIdJoueur(): ?int
    {
        return $this->idJoueur;
    }

    public function setIdJoueur(?int $idJoueur): self
    {
        $this->idJoueur = $idJoueur;

        return $this;
    }


}
