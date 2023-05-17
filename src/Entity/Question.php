<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Quizz::class, inversedBy: 'questions')]
    private Collection $quizz;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?QuestionType $type = null;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'questions')]
    private Collection $tag;

    #[ORM\Column(length: 255)]
    private ?string $text = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: Answer::class, orphanRemoval: true)]
    #[ORM\JoinColumn(onDelete: "CASCADE")]
    private Collection $answers;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: SessionQuestion::class)]
    #[ORM\JoinColumn(onDelete: "CASCADE")]
    private Collection $sessionQuestions;

    public function __construct()
    {
        $this->quizz = new ArrayCollection();
        $this->tag = new ArrayCollection();
        $this->answers = new ArrayCollection();
        $this->sessionQuestions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Quizz>
     */
    public function getQuizz(): Collection
    {
        return $this->quizz;
    }

    public function addQuizz(Quizz $quizz): self
    {
        if (!$this->quizz->contains($quizz)) {
            $this->quizz->add($quizz);
        }

        return $this;
    }

    public function removeQuizz(Quizz $quizz): self
    {
        $this->quizz->removeElement($quizz);

        return $this;
    }

    public function getType(): ?QuestionType
    {
        return $this->type;
    }

    public function setType(?QuestionType $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tag->contains($tag)) {
            $this->tag->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tag->removeElement($tag);

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Answer>
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
            $answer->setQuestion($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getQuestion() === $this) {
                $answer->setQuestion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SessionQuestion>
     */
    public function getSessionQuestions(): Collection
    {
        return $this->sessionQuestions;
    }

    public function addSessionQuestion(SessionQuestion $sessionQuestion): self
    {
        if (!$this->sessionQuestions->contains($sessionQuestion)) {
            $this->sessionQuestions->add($sessionQuestion);
            $sessionQuestion->setQuestion($this);
        }

        return $this;
    }

    public function removeSessionQuestion(SessionQuestion $sessionQuestion): self
    {
        if ($this->sessionQuestions->removeElement($sessionQuestion)) {
            // set the owning side to null (unless already changed)
            if ($sessionQuestion->getQuestion() === $this) {
                $sessionQuestion->setQuestion(null);
            }
        }

        return $this;
    }
}
