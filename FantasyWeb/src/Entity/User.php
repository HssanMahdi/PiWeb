<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\UserPassword;

/**
 * AdherentType
 *
 * @ORM\Table(name="user")
* @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUser;

    /**
     * @var string
     * @Assert\NotBlank(message= "Champ non valide")
     * @ORM\Column(name="nom_user", type="text", length=65535, nullable=false)
     */
    private $nomUser;

    /**
     * @var string
     * *@Assert\NotBlank (message= "L'email est requis")
     *@Assert\Email(message= "Email '{{ valeur }}'non valide")
     * @ORM\Column(name="email", type="text", length=65535, nullable=false)
     */
    private $email;

    /**
     * @var string|null
     *@Assert\NotBlank (message= "Mot de passe non valide")
     * @ORM\Column(name="password", type="text", length=65535, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="type_user", type="text", length=65535, nullable=false)
     */
    private $typeUser;


    public function getIdUser(): ?int
    {
        return $this->idUser;
    }
    public function setIdUser(string $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }


    public function getNomUser(): ?string
    {
        return $this->nomUser;
    }

    public function setNomUser(string $nomUser): self
    {
        $this->nomUser = $nomUser;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getTypeUser(): ?string
    {
        return $this->typeUser;
    }

    public function setTypeUser(string $typeUser): self
    {
        $this->typeUser = $typeUser;

        return $this;
    }




}
