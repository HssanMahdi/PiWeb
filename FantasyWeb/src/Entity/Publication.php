<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Publication
 * @ORM\Entity(repositoryClass="App\Repository\PublicationRepository")
 * @ORM\Table(name="publication")
 * @ORM\Entity
 */
class Publication
{
    /**
     * @var int
     *
     * @ORM\Column(name="idVideo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idvideo;

    /**
     * @var string
     * @Assert\NotBlank(message= "Titre Highlights non valide")
     * @ORM\Column(name="videoName", type="text", length=65535, nullable=false)
     */
    private $videoname;

    /**
     * @var string
     *
     * @ORM\Column(name="date_pub", type="text", length=65535, nullable=false)
     */
    private $datePub;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text", length=65535, nullable=false)
     */
    private $url;

    /**
     * @return int
     */
    public function getIdvideo(): ?int
    {
        return $this->idvideo;
    }

    /**
     * @param int $idvideo
     */
    public function setIdvideo(?int $idvideo): void
    {
        $this->idvideo = $idvideo;
    }

    /**
     * @return string
     */
    public function getVideoname(): ?string
    {
        return $this->videoname;
    }

    /**
     * @param string $videoname
     */
    public function setVideoname(?string $videoname): void
    {
        $this->videoname = $videoname;
    }

    /**
     * @return string
     */
    public function getDatePub(): ?string
    {
        return $this->datePub;
    }

    /**
     * @param string $datePub
     */
    public function setDatePub(?string $datePub): void
    {
        $this->datePub = $datePub;
    }

    /**
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }




}
