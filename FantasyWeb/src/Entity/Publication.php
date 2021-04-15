<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publication
 *
 * @ORM\Table(name="publication")
 * @ORM\Entity(repositoryClass="App\Repository\PublicationRepository")
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
     *
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

    public function getIdvideo(): ?int
    {
        return $this->idvideo;
    }

    public function getVideoname(): ?string
    {
        return $this->videoname;
    }

    public function setVideoname(string $videoname): self
    {
        $this->videoname = $videoname;

        return $this;
    }

    public function getDatePub(): ?string
    {
        return $this->datePub;
    }

    public function setDatePub(string $datePub): self
    {
        $this->datePub = $datePub;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }


}
