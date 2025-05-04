<?php
declare(strict_types=1);
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: "lms_courses")]
#[ORM\Entity()]
class Course {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank(message: "course.name.not_blank")]
    private ?string $name;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: LearningPath::class, inversedBy: "courses")]
    #[ORM\JoinTable(name: "lms_learning_path_courses")]
    #[ORM\JoinColumn(name: "course_id", referencedColumnName: "id")]
    #[ORM\InverseJoinColumn(name: "learning_path_id", referencedColumnName: "id")]
    private ArrayCollection $learningPaths;

    #[ORM\Column(type: "datetimetz_immutable", nullable: false)]
    private ?\DateTimeImmutable $createdAt;

    public function __construct() {
        $this->learningPaths = new ArrayCollection();
    }

    public function addLearningPath(LearningPath $learningPath): self {
        if (!$this->learningPaths->contains($learningPath)) {
            $this->learningPaths[] = $learningPath;
        }
        return $this;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable {
        return $this->createdAt;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function getLearningPaths(): Collection {
        return $this->learningPaths;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function removeLearningPath(LearningPath $learningPath): self {
        $this->learningPaths->removeElement($learningPath);
        return $this;
    }

    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }

    public function setDescription(?string $description): self {
        $this->description = $description;
        return $this;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self {
        $this->createdAt = $createdAt;
        return $this;
    }
}