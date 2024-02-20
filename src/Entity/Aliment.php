<?php

namespace App\Entity;

use App\Repository\AlimentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich; 
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: AlimentRepository::class)]
#[Vich\Uploadable]
class Aliment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 2,
        max: 15,
        minMessage: 'le nom doit faire 2 caractères au moins',
        maxMessage: 'le nom doit faire moins de 15 caractères',
    )]
    private ?string $nom = null;

    #[ORM\Column]
    #[Assert\Range(
        min: 0.1,
        max: 100
    )]
    private ?float $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[Vich\UploadableField(mapping: 'aliment_image', fileNameProperty: 'image')]
    private ?File $imageFile = null;

    #[ORM\Column]
    private ?int $calorie = null;

    #[ORM\Column]
    private ?float $proteine = null;

    #[ORM\Column]
    private ?float $glucides = null;

    #[ORM\Column]
    private ?float $lipides = null;

    #[ORM\Column(length: 255)]
    private ?string $blamable = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated_ad = null;

    #[ORM\ManyToOne(inversedBy: 'aliments')]
    private ?Type $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getCalorie(): ?int
    {
        return $this->calorie;
    }

    public function setCalorie(int $calorie): static
    {
        $this->calorie = $calorie;

        return $this;
    }

    public function getProteine(): ?float
    {
        return $this->proteine;
    }

    public function setProteine(float $proteine): static
    {
        $this->proteine = $proteine;

        return $this;
    }

    public function getGlucides(): ?float
    {
        return $this->glucides;
    }

    public function setGlucides(float $glucides): static
    {
        $this->glucides = $glucides;

        return $this;
    }

    public function getLipides(): ?float
    {
        return $this->lipides;
    }

    public function setLipides(float $lipides): static
    {
        $this->lipides = $lipides;

        return $this;
    }

    public function getBlamable(): ?string
    {
        return $this->blamable;
    }

    public function setBlamable(string $blamable): static
    {
        $this->blamable = $blamable;

        return $this;
    }

    public function setImageFile(?File $imageFile = null): self
    {
        $this->imageFile = $imageFile;
        if($this->imageFile instanceof UploadedFile){
            $this->updated_ad = new \Datetime('now');
        }
        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getUpdatedAd(): ?\DateTimeInterface
    {
        return $this->updated_ad;
    }

    public function setUpdatedAd(?\DateTimeInterface $updated_ad): static
    {
        $this->updated_ad = $updated_ad;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): static
    {
        $this->type = $type;

        return $this;
    }
}
