<?php

namespace App\Entity;
use App\Entity\User;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;



/**
 * Actualites
 *
 * @ORM\Table(name="actualites")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ActualiteRepository")
 *  @Vich\Uploadable
 */
class Actualites
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups("Actualites:read")
     */
    private $idActualites;



    /**
     * @ORM\Column(type="string")
     *
     * @var string|null
     */
    private $fileName;
    /**
     *
     * @Vich\UploadableField(mapping="Actualites_image", fileNameProperty="fileName")
     *
     * @var File|null
     */
    private $imageFile;



    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     * @Assert\NotBlank
     * @Groups("Actualites:read")
     */
    private $description;

    /**
     * @var string
     *@Groups("Actualites:read")
     * @ORM\Column(name="titre", type="text", length=65535, nullable=false)
     * @Assert\NotBlank
     */
    private $titre;

    /**
     * @var \DateTime
     * @Assert\NotBlank
     * @Groups("Actualites:read")
     * @ORM\Column(name="Date", type="date", nullable=false)
     */
    private $date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $update_at;

    /**
     * @ORM\OneToMany(targetEntity=ActualitesLike::class, mappedBy="actualites")
     */
    private $likes;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="actualite", orphanRemoval=true)
     */
    private $comments;

    public function __construct()
    {
        $this->likes = new ArrayCollection();
    }



    /**
     * @return int
     */
    public function getIdActualites(): ?int
    {
        return $this->idActualites;
        $this->comments = new ArrayCollection();
    }

    /**
     * @param int $idActualites
     */
    public function setIdActualites(int $idActualites): void
    {
        $this->idActualites = $idActualites;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
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


    public function getDate(): ?\DateTime
    {
        return $this->date;
    }


    public function setDate(?\DateTime $date): self
    {
        $this->date = $date;
        return $this;
    }


    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    /**
     * @param string|null $fileName
     * @return Actualites
     */
    public function setFileName(?string $fileName): self
    {
        $this->fileName = $fileName;
        return $this;

    }


    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }


    public function setImageFile(?File $imageFile): self
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->update_at = new \DateTime('now');
        }
        return $this;

    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->update_at;
    }

    public function setUpdateAt(\DateTimeInterface $update_at): self
    {
        $this->update_at = $update_at;

        return $this;
    }

    /**
     * @return Collection|ActualitesLike[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(ActualitesLike $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setActualites($this);
        }

        return $this;
    }

    public function removeLike(ActualitesLike $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getActualites() === $this) {
                $like->setActualites(null);
            }
        }

        return $this;
    }

    /**
     * @param User $user
     * @return bool|null
     */
    public  function  islikedbyUser(User $user):  bool
    {
        foreach ($this->likes as $like){
            if($like->getUser()===$user) return true;
        }
        return false;
    }
    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setActualite($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getActualite() === $this) {
                $comment->setActualite(null);
            }
        }

        return $this;
    }



}
