<?php


namespace App\Entity;
use Doctrine\ORM\Mapping\{Entity, Table};
/**
 * @Entity
 * @Table(name="user")
 */


class AdminSysteme extends User
{
    public function getIdUser(): int
    {
        return parent::getIdUser(); // TODO: Change the autogenerated stub
    }

    public function setIdUser(int $idUser): void
    {
        parent::setIdUser($idUser); // TODO: Change the autogenerated stub
    }

    public function getNomUser()
    {
        return parent::getNomUser(); // TODO: Change the autogenerated stub
    }

    public function setNomUser(string $nomUser): void
    {
        parent::setNomUser($nomUser); // TODO: Change the autogenerated stub
    }

    public function getEmail()
    {
        return parent::getEmail(); // TODO: Change the autogenerated stub
    }

    public function setEmail(string $email): void
    {
        parent::setEmail($email); // TODO: Change the autogenerated stub
    }

    public function getPassword(): ?string
    {
        return parent::getPassword(); // TODO: Change the autogenerated stub
    }

    public function setPassword(?string $password): void
    {
        parent::setPassword($password); // TODO: Change the autogenerated stub
    }

    public function getTypeUser()
    {
        return parent::getTypeUser(); // TODO: Change the autogenerated stub
    }

    public function setTypeUser(string $typeUser): void
    {
        parent::setTypeUser($typeUser); // TODO: Change the autogenerated stub
    }

    public function getScoreUser(): ?int
    {
        return parent::getScoreUser(); // TODO: Change the autogenerated stub
    }

    public function setScoreUser(?int $scoreUser): void
    {
        parent::setScoreUser($scoreUser); // TODO: Change the autogenerated stub
    }

    public function getSolde(): ?int
    {
        return parent::getSolde(); // TODO: Change the autogenerated stub
    }

    public function setSolde(?int $solde): void
    {
        parent::setSolde($solde); // TODO: Change the autogenerated stub
    }

}