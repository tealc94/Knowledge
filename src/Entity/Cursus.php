<?php

namespace App\Entity;

use App\Repository\CursusRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: CursusRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
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

    #[ORM\ManyToOne(inversedBy: 'cursus', cascade: ['remove'], fetch:"EAGER")]
    private ?Themes $theme = null;

    /**
     * @var Collection<int, Lessons>
     */
    #[ORM\OneToMany(targetEntity: Lessons::class, mappedBy: 'cursus', cascade: ['remove'], fetch:"EAGER")]
    private Collection $lessons;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updated_at = null;

    #[ORM\Column(length: 255, type: 'string')]
    private ?string $fichiers = null;

    #[Vich\UploadableField(mapping: 'cursus_files', fileNameProperty: 'fichiers')]
    private ?File $fichierFile = null;

    /**
     * @var Collection<int, Purchase>
     */
    #[ORM\OneToMany(targetEntity: Purchase::class, mappedBy: 'cursus')]
    private Collection $purchases;

    public function __construct()
    {
        $this->lessons = new ArrayCollection();
        $this->created_at = new DateTime('now');
        $this->updated_at = new DateTime('now');
        $this->purchases = new ArrayCollection();
    }

    #[ORM\PreUpdate]
    public function onPreUpdate():void
    {
        $this->updated_at = new DateTime('now');
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

    public function getTheme(): ?Themes
    {
        return $this->theme;
    }

    public function setTheme(?Themes $theme): static
    {
        $this->theme = $theme;

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
            $lesson->setCursus($this);
        }

        return $this;
    }

    public function removeLesson(Lessons $lesson): static
    {
        if ($this->lessons->removeElement($lesson)) {
            // set the owning side to null (unless already changed)
            if ($lesson->getCursus() === $this) {
                $lesson->setCursus(null);
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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getFichiers(): ?string
    {
        return $this->fichiers;
    }

    public function setFichiers(string $fichiers): static
    {
        $this->fichiers = $fichiers;

        return $this;
    }  
    
    public function getFichierFile(): ?File
    {
        return $this->fichierFile;
    }

    public function setFichierFile(?File $fichierFile = null): void
    {
        $this->fichierFile = $fichierFile; 
        if(null !== $fichierFile){
            $this->updated_at = new \DateTimeImmutable();
        }        
    }

    /**
     * @return Collection<int, Purchase>
     */
    public function getPurchases(): Collection
    {
        return $this->purchases;
    }

    public function addPurchase(Purchase $purchase): static
    {
        if (!$this->purchases->contains($purchase)) {
            $this->purchases->add($purchase);
            $purchase->setCursus($this);
        }

        return $this;
    }

    public function removePurchase(Purchase $purchase): static
    {
        if ($this->purchases->removeElement($purchase)) {
            // set the owning side to null (unless already changed)
            if ($purchase->getCursus() === $this) {
                $purchase->setCursus(null);
            }
        }

        return $this;
    }
}
