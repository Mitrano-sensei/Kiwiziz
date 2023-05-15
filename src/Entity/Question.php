<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $question = null;

    #[ORM\Column(length: 255)]
    private ?string $goodAnswer = null;

    #[ORM\Column(length: 255)]
    private ?string $badAnswer1 = null;

    #[ORM\Column(length: 255)]
    private ?string $badAnswer2 = null;

    #[ORM\Column(length: 255)]
    private ?string $badAnswer3 = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Quiz $quiz = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getGoodAnswer(): ?string
    {
        return $this->goodAnswer;
    }

    public function setGoodAnswer(string $goodAnswer): self
    {
        $this->goodAnswer = $goodAnswer;

        return $this;
    }

    public function getBadAnswer1(): ?string
    {
        return $this->badAnswer1;
    }

    public function setBadAnswer1(string $badAnswer1): self
    {
        $this->badAnswer1 = $badAnswer1;

        return $this;
    }

    public function getBadAnswer2(): ?string
    {
        return $this->badAnswer2;
    }

    public function setBadAnswer2(string $badAnswer2): self
    {
        $this->badAnswer2 = $badAnswer2;

        return $this;
    }

    public function getBadAnswer3(): ?string
    {
        return $this->badAnswer3;
    }

    public function setBadAnswer3(string $badAnswer3): self
    {
        $this->badAnswer3 = $badAnswer3;

        return $this;
    }

    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(?Quiz $quiz): self
    {
        $this->quiz = $quiz;

        return $this;
    }
}
