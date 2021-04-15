<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formjoueur
 *
 * @ORM\Table(name="formjoueur", indexes={@ORM\Index(name="fk_id_joueur", columns={"id_joueur"}), @ORM\Index(name="fk_id_formation", columns={"id_formation"})})
 * @ORM\Entity(repositoryClass="App\Repository\FormjoueurRepository")
 */
class Formjoueur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_formjoueur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFormjoueur;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_formation", type="integer", nullable=true)
     */
    private $idFormation;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_joueur", type="integer", nullable=true)
     */
    private $idJoueur;

    public function getIdFormjoueur(): ?int
    {
        return $this->idFormjoueur;
    }

    public function getIdFormation(): ?int
    {
        return $this->idFormation;
    }

    public function setIdFormation(?int $idFormation): self
    {
        $this->idFormation = $idFormation;

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
