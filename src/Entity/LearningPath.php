<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: "lms_learning_paths")]
#[ORM\Entity()]
class LearningPath
{
    /**
     * The value for public visibility.
     */
    public const int VISIBILITY_PUBLIC = 100;

    /**
     * The value for registered user visibility.
     */
    public const int VISIBILITY_REGISTERED = 200;

    /**
     * The value for private visibility.
     */
    public const int VISIBILITY_PRIVATE = 1000;

    /**
     * An array of the available visibility options.
     */
    public const array VISIBILITY_OPTIONS = [
        self::VISIBILITY_PUBLIC => 'Public',
        self::VISIBILITY_REGISTERED => 'Registered Users',
        self::VISIBILITY_PRIVATE => 'Private',
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank(message: "learning_path.name.not_blank")]
    private ?string $name;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $objectives = null;

    #[ORM\Column(type: "smallint", length: 10, nullable: false)]
    #[Assert\Choice(choices: [self::VISIBILITY_PUBLIC, self::VISIBILITY_PRIVATE, self::VISIBILITY_REGISTERED], message: "learning_path.visibility.not_blank")]
    private ?int $visibility;

    #[ManyToMany(targetEntity: Course::class, mappedBy: "learningPaths")]
    private ArrayCollection $courses;

    #[ORM\Column(type: "datetimetz_immutable", nullable: false)]
    private ?\DateTimeImmutable $createdAt;

    public function __construct() {
        $this->setVisibility(self::VISIBILITY_PUBLIC);
        $this->courses = new ArrayCollection();
    }

    public function addCourse(Course $course): self {
        if (!$this->courses->contains($course)) {
            $this->courses[] = $course;
        }
        return $this;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getCourses(): Collection {
        return $this->courses;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function getObjectives(): ?string {
        return $this->objectives;
    }

    public function getVisibility(): ?int {
        if (!array_key_exists($this->visibility, self::VISIBILITY_OPTIONS)) {
            return (int) self::VISIBILITY_PUBLIC;
        }
        return $this->visibility;
    }

    public function getVisibilityLabel(): ?string {
        if (!array_key_exists($this->visibility, self::VISIBILITY_OPTIONS)) {
            return null;
        }
        return self::VISIBILITY_OPTIONS[$this->visibility];
    }

    public function getCreatedAt(): ?\DateTimeImmutable {
        return $this->createdAt;
    }

    public function removeCourse(Course $course): self {
        $this->courses->removeElement($course);
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

    public function setObjectives(?string $objectives): self {
        $this->objectives = $objectives;
        return $this;
    }

    public function setVisibility(int $visibility): self {
        if (!array_key_exists($visibility, self::VISIBILITY_OPTIONS)) {
            $visibility = (int) self::VISIBILITY_PUBLIC;
        }
        $this->visibility = (int) $visibility;
        return $this;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function __toString(): string {
        return $this->name;
    }
}