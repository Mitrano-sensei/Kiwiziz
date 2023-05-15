<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
class Session
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Quizz $quizz = null;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user = null;

    #[ORM\Column]
    private ?int $answer_correct = null;

    #[ORM\Column]
    private ?int $question_count = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $started = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $finished = null;

    #[ORM\OneToMany(mappedBy: 'session', targetEntity: SessionQuestion::class, orphanRemoval: true)]
    private Collection $sessionQuestions;

    public function __construct()
    {
        $this->sessionQuestions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuizz(): ?Quizz
    {
        return $this->quizz;
    }

    public function setQuizz(?Quizz $quizz): self
    {
        $this->quizz = $quizz;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAnswerCorrect(): ?int
    {
        return $this->answer_correct;
    }

    public function setAnswerCorrect(int $answer_correct): self
    {
        $this->answer_correct = $answer_correct;

        return $this;
    }

    public function getQuestionCount(): ?int
    {
        return $this->question_count;
    }

    public function setQuestionCount(int $question_count): self
    {
        $this->question_count = $question_count;

        return $this;
    }

    public function getStarted(): ?\DateTimeInterface
    {
        return $this->started;
    }

    public function setStarted(\DateTimeInterface $started): self
    {
        $this->started = $started;

        return $this;
    }

    public function getFinished(): ?\DateTimeInterface
    {
        return $this->finished;
    }

    public function setFinished(?\DateTimeInterface $finished): self
    {
        $this->finished = $finished;

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
            $sessionQuestion->setSession($this);
        }

        return $this;
    }

    public function removeSessionQuestion(SessionQuestion $sessionQuestion): self
    {
        if ($this->sessionQuestions->removeElement($sessionQuestion)) {
            // set the owning side to null (unless already changed)
            if ($sessionQuestion->getSession() === $this) {
                $sessionQuestion->setSession(null);
            }
        }

        return $this;
    }
}
