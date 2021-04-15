<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Equipe
 *
 * @ORM\Table(name="equipe")
 * @ORM\Entity(repositoryClass="App\Repository\EquipeRepository")
 */
class Equipe
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_equipe", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEquipe;

    /**
     * @var string
         * @Assert\NotBlank(message= "Nom équipe non valide")
     * @ORM\Column(name="nom_equipe", type="text", length=65535, nullable=false)
     */
    private $nomEquipe;

    /**
     * @var string
     * @Assert\NotBlank(message= "Logo non valide")
     * @ORM\Column(name="logo_equipe", type="text", length=65535, nullable=false)
     */
    private $logoEquipe;

    /**
     * @var string
     * @Assert\NotBlank(message= "Champ stade non valide")
     * @ORM\Column(name="stade", type="text", length=65535, nullable=false)
     */
    private $stade;

    public function getIdEquipe(): ?int
    {
        return $this->idEquipe;
    }

    public function getNomEquipe(): ?string
    {
        return $this->nomEquipe;
    }

    public function setNomEquipe(string $nomEquipe): self
    {
        $this->nomEquipe = $nomEquipe;

        return $this;
    }

    public function getLogoEquipe(): ?string
    {
        return $this->logoEquipe;
    }

    public function setLogoEquipe(string $logoEquipe): self
    {
        $this->logoEquipe = $logoEquipe;

        return $this;
    }

    public function getStade(): ?string
    {
        return $this->stade;
    }

    public function setStade(string $stade): self
    {
        $this->stade = $stade;

        return $this;
    }
    public function __toString()
    {
        return (string) $this->getNomEquipe();
    }

}
