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
    private ?int $idLesson = null;

    #[ORM\Column]
    private ?int $nbrLesson = null;

    #[ORM\Column(length: 50)]
    private ?string $Title = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $Price = null;

    #[ORM\ManyToOne(inversedBy: 'lessons')]
    private ?ListOfThemes $idListLesson = null;

    public function getIdLesson(): ?int
    {
        return $this->idLesson;
    }

    public function getNbrLesson(): ?int
    {
        return $this->nbrLesson;
    }

    public function setNbrLesson(int $nbrLesson): static
    {
        $this->nbrLesson = $nbrLesson;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): static
    {
        $this->Title = $Title;

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

    public function getIdListLesson(): ?ListOfThemes
    {
        return $this->idListLesson;
    }

    public function setIdListLesson(?ListOfThemes $idListLesson): static
    {
        $this->idListLesson = $idListLesson;

        return $this;
    }
}
