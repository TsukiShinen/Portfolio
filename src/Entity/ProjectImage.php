<?php

namespace App\Entity;

use App\Repository\ProjectImageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ProjectImageRepository::class)]
#[Vich\Uploadable]
class ProjectImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[Vich\UploadableField(mapping: 'project', fileNameProperty: 'image')]
    private ?File $imageFile = null;

    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'images')]
    private ?Project $project = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTime $updatedAt;

    public function __construct()
    {
        $this->setUpdatedAt(new \DateTime());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(File $imageFile): void
    {
        $this->imageFile = $imageFile;
        dump($imageFile);
        if ($imageFile instanceof UploadedFile) {
            $this->setUpdatedAt(new \DateTime());
            dump($this);
        }
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function __toString()
    {
        return $this->image;
    }
}
