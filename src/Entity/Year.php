<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use JMS\Serializer\Annotation as Serializer;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\YearRepository")
 * @ORM\Table(name="year")
 * @Serializer\ExclusionPolicy("none")
 */
class Year
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Exclude()
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $year;

    /**
     * @ORM\Column(type="integer", length=4)
     */
    private $circle1;

    /**
     * @ORM\Column(type="integer", length=4)
     */
    private $circle2;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Category", mappedBy="year")
     */
    private $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getCircle1(): ?int
    {
        return $this->circle1;
    }

    public function setCircle1(int $circle1): self
    {
        $this->circle1 = $circle1;

        return $this;
    }

    public function getCircle2(): ?int
    {
        return $this->circle2;
    }

    public function setCircle2(int $circle2): self
    {
        $this->circle2 = $circle2;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setYear($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
            // set the owning side to null (unless already changed)
            if ($category->getYear() === $this) {
                $category->setYear(null);
            }
        }

        return $this;
    }
}
