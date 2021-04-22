<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank(message= "Il faut choisir un titre")
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
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @Assert\NotBlank(message= "Champs non valide")
     * @ORM\JoinColumn(name="id_equipeA", referencedColumnName="id_equipe")
     */
    private $idEquipea;

    /**
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @Assert\NotBlank(message= "Champs non valide")
     * @ORM\JoinColumn(name="id_equipeB", referencedColumnName="id_equipe")
     */
    private $idEquipeb;

    private $imageA;
    private $imageB;

    /**
     * @return string
     */
    public function getImageA()
    {
        return $this->imageA;
    }

    /**
     * @param string $imageA
     */
    public function setImageA($imageA): void
    {
        $this->imageA = $imageA;
    }

    /**
     * @return string
     */
    public function getImageB()
    {
        return $this->imageB;
    }

    /**
     * @param string $imageB
     */
    public function setImageB($imageB): void
    {
        $this->imageB = $imageB;
    }

    /**
     * @return int
     */
    public function getIdmatch(): ?int
    {
        return $this->idmatch;
    }

    /**
     * @param int|null $idmatch
     */
    public function setIdmatch(?int $idmatch): void
    {
        $this->idmatch = $idmatch;
    }

    /**
     * @return string
     */
    public function getTitre(): ?string
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
    public function getDatematch(): ?string
    {
        return $this->datematch;
    }

    /**
     * @param string $datematch
     */
    public function setDatematch(?string $datematch): void
    {
        $this->datematch = $datematch;
    }

    /**
     * @return mixed
     */
    public function getIdEquipea()
    {
        return $this->idEquipea;
    }

    /**
     * @param mixed $idEquipea
     */
    public function setIdEquipea($idEquipea): void
    {
        $this->idEquipea = $idEquipea;
    }

    /**
     * @return mixed
     */
    public function getIdEquipeb()
    {
        return $this->idEquipeb;
    }

    /**
     * @param mixed $idEquipeb
     */
    public function setIdEquipeb($idEquipeb): void
    {
        $this->idEquipeb = $idEquipeb;
    }





}
