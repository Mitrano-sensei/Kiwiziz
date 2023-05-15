<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnswerRepository::class)]
class Answer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'answers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Question $question = null;

    #[ORM\Column(length: 255)]
    private ?string $text = null;

    #[ORM\Column]
    private ?bool $correct = null;

    #[ORM\ManyToMany(targetEntity: SessionQuestion::class, mappedBy: 'answer')]
    private Collection $sessionQuestions;

    public function __construct()
    {
        $this->sessionQuestions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

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

    public function isCorrect(): ?bool
    {
        return $this->correct;
    }

    public function setCorrect(bool $correct): self
    {
        $this->correct = $correct;

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
            $sessionQuestion->addAnswer($this);
        }

        return $this;
    }

    public function removeSessionQuestion(SessionQuestion $sessionQuestion): self
    {
        if ($this->sessionQuestions->removeElement($sessionQuestion)) {
            $sessionQuestion->removeAnswer($this);
        }

        return $this;
    }
}
