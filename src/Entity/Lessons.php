<?php

namespace App\Entity;

use App\Repository\LessonsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LessonsRepository::class)]
class Lessons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NameLesson = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $Price = null;

    #[ORM\ManyToOne(inversedBy: 'lessons')]
    private ?Cursus $idNameCursus = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameLesson(): ?string
    {
        return $this->NameLesson;
    }

    public function setNameLesson(string $NameLesson): static
    {
        $this->NameLesson = $NameLesson;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->Price;
    }

    public function setPrice(string $Price): static
    {
        $this->Price = $Price;

        return $this;
    }

    public function getIdNameCursus(): ?Cursus
    {
        return $this->idNameCursus;
    }

    public function setIdNameCursus(?Cursus $idNameCursus): static
    {
        $this->idNameCursus = $idNameCursus;

        return $this;
    }  
    
    public function __toString(): string
    {
        return $this->NameLesson ?? '';
    }
}
