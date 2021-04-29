<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statistique
 *
 * @ORM\Table(name="statistique", indexes={@ORM\Index(name="FK_id_joueur", columns={"id_joueur"})}))
 *  @ORM\Entity(repositoryClass="App\Repository\StatistiqueRepository")
 * @ORM\Entity
 */
class Statistique
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
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
     * @var int
     *
     * @ORM\Column(name="clean", type="integer", nullable=false)
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
     * @ORM\ManyToOne(targetEntity=Joueur::class)

     * @ORM\JoinColumn(name="id_joueur", referencedColumnName="id_joueur")
     */
    private $idJoueur;

    /**
     * @return mixed
     */
    public function getIdJoueur()
    {
        return $this->idJoueur;
    }

    /**
     * @param mixed $idJoueur

     */
    public function setIdJoueur($idJoueur):void
    {
        $this->idJoueur = $idJoueur;

    }


    /**
     * @return int
     */
    public function getIdStatistique():? int
    {
        return $this->idStatistique;
    }

    /**
     * @param int $idStatistique
     */
    public function setIdStatistique(int $idStatistique): void
    {
        $this->idStatistique = $idStatistique;
    }

    /**
     * @return int
     */
    public function getBut(): ?int
    {
        return $this->but;
    }

    /**
     * @param int $but
     */
    public function setBut(int $but): void
    {
        $this->but = $but;
    }

    /**
     * @return int
     */
    public function getAssist(): ?int
    {
        return $this->assist;
    }

    /**
     * @param int $assist
     */
    public function setAssist(int $assist): void
    {
        $this->assist = $assist;
    }

    /**
     * @return int
     */
    public function getClean(): ?int
    {
        return $this->clean;
    }

    /**
     * @param int $clean
     */
    public function setClean(int $clean): void
    {
        $this->clean = $clean;
    }

    /**
     * @return int
     */
    public function getNumbery():? int
    {
        return $this->numbery;
    }

    /**
     * @param int $numbery
     */
    public function setNumbery(int $numbery): void
    {
        $this->numbery = $numbery;
    }

    /**
     * @return int
     */
    public function getNumberr():? int
    {
        return $this->numberr;
    }

    /**
     * @param int $numberr
     */
    public function setNumberr(int $numberr): void
    {
        $this->numberr = $numberr;
    }




}
