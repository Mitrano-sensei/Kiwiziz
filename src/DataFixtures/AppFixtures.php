<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Quizz;
use App\Entity\Question;
use App\Entity\Users;
use App\Entity\Answer;
use App\Entity\Session;
use App\Entity\SessionQuestion;
use App\Entity\Tag;
use App\Entity\QuestionType;    
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i <= 10; $i++){
            $user = new Users();
            $user->setUsername('user'.$i);
            $password = $this->hasher->hashPassword($user, 'pass_1234');
            $user->setPassword($password);
            $manager->persist($user);
            $this->addReference("user$i", $user);
        
        }
        $manager->flush();

        for ($i=1; $i <= 10; $i++){
            $quizz = new Quizz();
            $quizz->setTitle("Quizz n°$i");
            $quizz->setAuthor($this->getReference('user'.$i));
            $quizz->setCreated(new \DateTime());
            $manager->persist($quizz);
            $this->addReference("quizz$i", $quizz);

        }
        $manager->flush();

        for ($i=1; $i <= 10; $i++){
            $questionType = new QuestionType();
            $questionType->setLabel("QuestionType n°$i");
            $manager->persist($questionType);
            $this->addReference("questionType$i", $questionType);
        }
        $manager->flush();


        for ($i=1; $i <= 10; $i++){
            $question = new Question();
            $question->setType($this->getReference('questionType'.$i));
            $question->setText("je suis la question ? $i");
            $this->addReference("question$i", $question);
            $answer = new Answer();
            $answer->setText("Answer n°$i");
            if ($i%2 == 0) {
                $answer->setCorrect(true);
            }
            else {
                $answer->setCorrect(false);
            }
            $manager->persist($answer);
            $this->addReference("answer$i", $answer);
            $question->addAnswer($answer);
            $manager->persist($question);
            $manager->persist($question);
        }
        $manager->flush();

        // for ($i=1; $i <= 10; $i++){
        //     $answer = new Answer();
        //     $answer->setText("Answer n°$i");
        //     $answer->setQuestion($this->getReference("question$i"));
        //     if ($i%2 == 0) {
        //         $answer->setCorrect(true);
        //     }
        //     else {
        //         $answer->setCorrect(false);
        //     }
        //     $manager->persist($answer);
        //     $this->addReference("answer$i", $answer);
        // }
        // $manager->flush();


        // for ($i=1; $i <= 10; $i++){
        //     $answer = new Answer();
        //     $answer->setAnswer("Answer n°$i");
        //     $answer->setQuestion($this->getReference("question$i"));
        //     $manager->persist($answer);
        //     $this->addReference("answer$i", $answer);

        // }
        // $manager->flush();

        // for ($i=1; $i <= 10; $i++){
        //     $session = new Session();
        //     $session->setUser($this->getReference('user'));
        //     $session->setQuizz($this->getReference("quiz$i"));
        //     $session->setScore(0);
        //     $manager->persist($session);
        //     $this->addReference("session$i", $session);

        // }
        // $manager->flush();

        // for ($i=1; $i <= 10; $i++){
        //     $questionnType = new QuestionType();
        //     $questionnType->setID($this->getReference("question$i"));
        //     $manager->persist($questionnType);
        //     $this->addReference("questionnType$i", $questionnType);
        // }
        // $manager->flush();

        // //create a set of tag for each quizz
        // for ($i=1; $i <= 10; $i++){
        //     $tag = new Tag();
        //     $tag->setLabel("Tag n°$i");
        //     $manager->persist($tag);
        //     $this->addReference("tag$i", $tag);
        // }
        // $manager->flush();
        // //create sessionquestion for each session
        // for ($i=1; $i <= 10; $i++){
        //     $sessionQuestion = new SessionQuestion();
        //     $sessionQuestion->setSession($this->getReference("session$i"));
        //     $sessionQuestion->setQuestion($this->getReference("question$i"));
        //     $manager->persist($sessionQuestion);
        //     $this->addReference("sessionQuestion$i", $sessionQuestion);
        // }
        // $manager->flush();

    }
    
}
