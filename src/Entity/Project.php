<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: ProjectImage::class, cascade: ["persist"])]
    private Collection $images;

    #[ORM\Column(length: 4096)]
    private ?string $content = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToMany(targetEntity: ProjectCategory::class, inversedBy: 'projects')]
    private Collection $category;

    #[ORM\ManyToMany(targetEntity: Skill::class, inversedBy: 'projects')]
    private Collection $relatedSkills;

    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->relatedSkills = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, ProjectCategory>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(ProjectCategory $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
        }

        return $this;
    }

    public function removeCategory(ProjectCategory $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }

    /**
     * @return Collection<int, Skill>
     */
    public function getRelatedSkills(): Collection
    {
        return $this->relatedSkills;
    }

    public function addRelatedSkill(Skill $relatedSkill): self
    {
        if (!$this->relatedSkills->contains($relatedSkill)) {
            $this->relatedSkills->add($relatedSkill);
        }

        return $this;
    }

    public function removeRelatedSkill(Skill $relatedSkill): self
    {
        $this->relatedSkills->removeElement($relatedSkill);

        return $this;
    }

    public function addImage(ProjectImage $images): self
    {
        if (!$this->images->contains($images)) {
            $this->images->add($images);
            $images->setProject($this);
        }

        return $this;
    }


    public function getImages(): Collection
    {
        return $this->images;
    }

    public function removeImage(ProjectImage $images): self
    {
        $this->images->removeElement($images);

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
