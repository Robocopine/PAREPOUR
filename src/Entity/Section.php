<?php

namespace App\Entity;

use App\Repository\SectionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SectionRepository::class)]
class Section
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contentFr = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $contentNl = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $contentEn = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContentFr(): ?string
    {
        return $this->contentFr;
    }

    public function setContentFr(string $contentFr): static
    {
        $this->contentFr = $contentFr;

        return $this;
    }

    public function getContentNl(): ?string
    {
        return $this->contentNl;
    }

    public function setContentNl(string $contentNl): static
    {
        $this->contentNl = $contentNl;

        return $this;
    }

    public function getContentEn(): ?string
    {
        return $this->contentEn;
    }

    public function setContentEn(?string $contentEn): static
    {
        $this->contentEn = $contentEn;

        return $this;
    }
}
