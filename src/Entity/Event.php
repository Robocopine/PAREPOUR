<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titleFr = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titleNl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titleEn = null;

    #[ORM\Column(length: 255)]
    private ?string $resumeFr = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $resumeNl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $resumeEn = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descriptionFr = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descriptionNl = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descriptionEn = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateTimeStart = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateTimeEnd = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleFr(): ?string
    {
        return $this->titleFr;
    }

    public function setTitleFr(string $titleFr): static
    {
        $this->titleFr = $titleFr;

        return $this;
    }

    public function getTitleNl(): ?string
    {
        return $this->titleNl;
    }

    public function setTitleNl(?string $titleNl): static
    {
        $this->titleNl = $titleNl;

        return $this;
    }

    public function getTitleEn(): ?string
    {
        return $this->titleEn;
    }

    public function setTitleEn(?string $titleEn): static
    {
        $this->titleEn = $titleEn;

        return $this;
    }

    public function getResumeFr(): ?string
    {
        return $this->resumeFr;
    }

    public function setResumeFr(string $resumeFr): static
    {
        $this->resumeFr = $resumeFr;

        return $this;
    }

    public function getResumeNl(): ?string
    {
        return $this->resumeNl;
    }

    public function setResumeNl(?string $resumeNl): static
    {
        $this->resumeNl = $resumeNl;

        return $this;
    }

    public function getResumeEn(): ?string
    {
        return $this->resumeEn;
    }

    public function setResumeEn(?string $resumeEn): static
    {
        $this->resumeEn = $resumeEn;

        return $this;
    }

    public function getDescriptionFr(): ?string
    {
        return $this->descriptionFr;
    }

    public function setDescriptionFr(string $descriptionFr): static
    {
        $this->descriptionFr = $descriptionFr;

        return $this;
    }

    public function getDescriptionNl(): ?string
    {
        return $this->descriptionNl;
    }

    public function setDescriptionNl(?string $descriptionNl): static
    {
        $this->descriptionNl = $descriptionNl;

        return $this;
    }

    public function getDescriptionEn(): ?string
    {
        return $this->descriptionEn;
    }

    public function setDescriptionEn(?string $descriptionEn): static
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    public function getDateTimeStart(): ?\DateTimeInterface
    {
        return $this->dateTimeStart;
    }

    public function setDateTimeStart(\DateTimeInterface $dateTimeStart): static
    {
        $this->dateTimeStart = $dateTimeStart;

        return $this;
    }

    public function getDateTimeEnd(): ?\DateTimeInterface
    {
        return $this->dateTimeEnd;
    }

    public function setDateTimeEnd(\DateTimeInterface $dateTimeEnd): static
    {
        $this->dateTimeEnd = $dateTimeEnd;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }
}
