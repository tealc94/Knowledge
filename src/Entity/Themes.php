<?php

namespace App\Entity;

use App\Repository\ThemesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\Entity(repositoryClass: ThemesRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Themes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NameTheme = null;

    /**
     * @var Collection<int, Cursus>
     */
    #[ORM\OneToMany(targetEntity: Cursus::class, mappedBy: 'theme')]
    private Collection $cursuses;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updated_at = null;
 
    public function __construct()
    {
        $this->cursuses = new ArrayCollection();
        $this->created_at = new DateTime('now');
        $this->updated_at = new DateTime('now');
    }

    #[ORM\PreUpdate]
    public function onPreUpdate(): void
    {
        $this->updated_at = new DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameTheme(): ?string
    {
        return $this->NameTheme;
    }

    public function setNameTheme(string $NameTheme): static
    {
        $this->NameTheme = $NameTheme;

        return $this;
    }

    /**
     * @return Collection<int, Cursus>
     */
    public function getCursuses(): Collection
    {
        return $this->cursuses;
    }

    public function addCursus(Cursus $cursus): static
    {
        if (!$this->cursuses->contains($cursus)) {
            $this->cursuses->add($cursus);
            $cursus->setTheme($this);
        }

        return $this;
    }

    public function removeCursus(Cursus $cursus): static
    {
        if ($this->cursuses->removeElement($cursus)) {
            // set the owning side to null (unless already changed)
            if ($cursus->getTheme() === $this) {
                $cursus->setTheme(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->NameTheme ?? '';   
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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }    
}
