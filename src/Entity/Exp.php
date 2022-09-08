<?php

namespace App\Entity;

use App\Repository\ExpRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExpRepository::class)]
class Exp
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 4096)]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'exps')]
    private ?ExperienceCategory $category = null;

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

    public function getCategory(): ?ExperienceCategory
    {
        return $this->category;
    }

    public function setCategory(?ExperienceCategory $category): self
    {
        $this->category = $category;

        return $this;
    }
}
