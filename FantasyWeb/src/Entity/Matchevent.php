<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matchevent
 *
 * @ORM\Table(name="matchevent", indexes={@ORM\Index(name="FK_idA", columns={"id_equipeB"}), @ORM\Index(name="FK_id", columns={"id_equipeA"})})
 * @ORM\Entity(repositoryClass="App\Repository\MatcheventRepository")
 */
class Matchevent
{
    /**
     * @var int
     *
     * @ORM\Column(name="idMatch", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmatch;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="text", length=65535, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="dateMatch", type="text", length=65535, nullable=false)
     */
    private $datematch;

    /**
     * @var int
     *
     * @ORM\Column(name="id_equipeA", type="integer", nullable=false)
     */
    private $idEquipea;

    /**
     * @var int
     *
     * @ORM\Column(name="id_equipeB", type="integer", nullable=false)
     */
    private $idEquipeb;

    /**
     * @return int
     */
    public function getIdmatch(): int
    {
        return $this->idmatch;
    }

    /**
     * @param int $idmatch
     */
    public function setIdmatch(int $idmatch): void
    {
        $this->idmatch = $idmatch;
    }

    /**
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getDatematch(): string
    {
        return $this->datematch;
    }

    /**
     * @param string $datematch
     */
    public function setDatematch(string $datematch): void
    {
        $this->datematch = $datematch;
    }

    /**
     * @return int
     */
    public function getIdEquipea(): int
    {
        return $this->idEquipea;
    }

    /**
     * @param int $idEquipea
     */
    public function setIdEquipea(int $idEquipea): void
    {
        $this->idEquipea = $idEquipea;
    }

    /**
     * @return int
     */
    public function getIdEquipeb(): int
    {
        return $this->idEquipeb;
    }

    /**
     * @param int $idEquipeb
     */
    public function setIdEquipeb(int $idEquipeb): void
    {
        $this->idEquipeb = $idEquipeb;
    }


}
