<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\UserPassword;


/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User implements UserInterface
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
     *@Assert\NotBlank (message= "Veuillez saisir une valeur")
     *@Assert\Email(message= "Email non valide")
     * @ORM\Column(name="email", type="text", length=65535, nullable=false)
     */
    private $email;

    /**
     * @var string
     *@Assert\Length (min="8", minMessage= "Votre mdp doit faire minimum 8 caractères")
     * @ORM\Column(name="password", type="text", length=65535, nullable=false)
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password",message="Vous n'avez pas tapé le méme Mdp")
     */
    public $confirm_password;

    /**
     * @var string
     * @ORM\Column(name="type_user", type="text", length=65535, nullable=false)
     */
    private string $typeUser;

    /**
     * @var int|null
     * @ORM\Column(name="score_user", type="integer", nullable=true)
     */
    private $scoreUser;

    /**
     * @var int|null
     * @ORM\Column(name="solde", type="integer", nullable=true)
     */
    private $solde;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $activation_token;

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
    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getNomUser()
    {
        return $this->nomUser;
    }

    /**
     * @param mixed $nomUser
     */
    public function setNomUser(string $nomUser)
    {
        $this->nomUser = $nomUser;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getTypeUser()
    {
        return $this->typeUser;
    }

    /**
     * @param mixed $typeUser
     */
    public function setTypeUser(string $typeUser): void
    {
        $this->typeUser = $typeUser;
    }

    /**
     * @return int|null
     */
    public function getScoreUser(): ?int
    {
        return $this->scoreUser;
    }

    /**
     * @param int|null $scoreUser
     */
    public function setScoreUser(?int $scoreUser): void
    {
        $this->scoreUser = $scoreUser;
    }

    /**
     * @return int|null
     */
    public function getSolde(): ?int
    {
        return $this->solde;
    }

    /**
     * @param int|null $solde
     */
    public function setSolde(?int $solde): void
    {
        $this->solde = $solde;
    }

    public function getRoles()
    {
       return ['ROLE_USER'];
    }

    public function getSalt()
    {
    }

    public function getUsername()
    {
    }

    public function eraseCredentials()
    {

    }

    public function getActivationToken(): ?string
    {
        return $this->activation_token;
    }

    public function setActivationToken(?string $activation_token): self
    {
        $this->activation_token = $activation_token;

        return $this;
    }
}
