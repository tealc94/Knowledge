<?php

namespace App\Entity;

use App\Repository\LessonsRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: LessonsRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
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

    #[ORM\ManyToOne(targetEntity: Cursus::class, inversedBy: 'lessons')]
    private ?Cursus $cursus = null;

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
    #[ORM\OneToMany(targetEntity: Purchase::class, mappedBy: 'lesson')]
    private Collection $purchases;

    public function __construct()
    {
        $this->created_at = new DateTime('now');
        $this->updated_at = new DateTime('now');
        $this->purchases = new ArrayCollection();
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

    public function getCursus(): ?Cursus
    {
        return $this->cursus;
    }

    public function setCursus(?Cursus $cursus): static
    {
        $this->cursus = $cursus;

        return $this;
    }  
    
    public function __toString(): string
    {
        return $this->NameLesson ?? '';
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
            $purchase->setLesson($this);
        }

        return $this;
    }

    public function removePurchase(Purchase $purchase): static
    {
        if ($this->purchases->removeElement($purchase)) {
            // set the owning side to null (unless already changed)
            if ($purchase->getLesson() === $this) {
                $purchase->setLesson(null);
            }
        }

        return $this;
    }
}