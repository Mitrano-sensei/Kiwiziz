<?php

namespace App\Entity;

use App\Repository\SessionQuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionQuestionRepository::class)]
class SessionQuestion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'sessionQuestions')]
    #[ORM\JoinColumn(nullable: false)]
    #[ORM\JoinColumn(onDelete: "CASCADE")]
    private ?Session $session = null;

    #[ORM\ManyToMany(targetEntity: Answer::class, inversedBy: 'sessionQuestions')]
    private Collection $answer;

    #[ORM\ManyToOne(inversedBy: 'sessionQuestions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Question $question = null;

    public function __construct()
    {
        $this->answer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): self
    {
        $this->session = $session;

        return $this;
    }

    /**
     * @return Collection<int, Answer>
     */
    public function getAnswer(): Collection
    {
        return $this->answer;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answer->contains($answer)) {
            $this->answer->add($answer);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        $this->answer->removeElement($answer);

        return $this;
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
}
