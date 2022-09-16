<?php

namespace App\Entity;

use App\Repository\ExperienceCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExperienceCategoryRepository::class)]
class ExperienceCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Exp::class)]
    private Collection $exps;

    public function __construct()
    {
        $this->exps = new ArrayCollection();
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

    /**
     * @return Collection<int, Exp>
     */
    public function getExps(): Collection
    {
        return $this->exps;
    }

    public function addExp(Exp $exp): self
    {
        if (!$this->exps->contains($exp)) {
            $this->exps->add($exp);
            $exp->setCategory($this);
        }

        return $this;
    }

    public function removeExp(Exp $exp): self
    {
        if ($this->exps->removeElement($exp)) {
            // set the owning side to null (unless already changed)
            if ($exp->getCategory() === $this) {
                $exp->setCategory(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
