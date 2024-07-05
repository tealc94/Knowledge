<?php

namespace App\Entity;

use App\Repository\CursusRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CursusRepository::class)]
class Cursus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NameCursus = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $Price = null;

    #[ORM\ManyToOne(inversedBy: 'cursuses', cascade: ['remove'])]
    private ?Themes $idNameTheme = null;

    /**
     * @var Collection<int, Lessons>
     */
    #[ORM\OneToMany(targetEntity: Lessons::class, mappedBy: 'idNameCursus', cascade: ['remove'])]
    private Collection $lessons;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    public function __construct()
    {
        $this->lessons = new ArrayCollection();
        $this->created_at = new DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCursus(): ?string
    {
        return $this->NameCursus;
    }

    public function setNameCursus(string $NameCursus): static
    {
        $this->NameCursus = $NameCursus;

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

    public function getIdNameTheme(): ?Themes
    {
        return $this->idNameTheme;
    }

    public function setIdNameTheme(?Themes $idNameTheme): static
    {
        $this->idNameTheme = $idNameTheme;

        return $this;
    }

    /**
     * @return Collection<int, Lessons>
     */
    public function getLessons(): Collection
    {
        return $this->lessons;
    }

    public function addLesson(Lessons $lesson): static
    {
        if (!$this->lessons->contains($lesson)) {
            $this->lessons->add($lesson);
            $lesson->setIdNameCursus($this);
        }

        return $this;
    }

    public function removeLesson(Lessons $lesson): static
    {
        if ($this->lessons->removeElement($lesson)) {
            // set the owning side to null (unless already changed)
            if ($lesson->getIdNameCursus() === $this) {
                $lesson->setIdNameCursus(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->NameCursus ?? '';   
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }
}
