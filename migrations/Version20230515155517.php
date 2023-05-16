<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230515155517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E853CD175');
        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, question_id INT NOT NULL, text VARCHAR(255) NOT NULL, correct TINYINT(1) NOT NULL, INDEX IDX_DADD4A251E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question_quizz (question_id INT NOT NULL, quizz_id INT NOT NULL, INDEX IDX_4C9C86391E27F6BF (question_id), INDEX IDX_4C9C8639BA934BCD (quizz_id), PRIMARY KEY(question_id, quizz_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question_tag (question_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_339D56FB1E27F6BF (question_id), INDEX IDX_339D56FBBAD26311 (tag_id), PRIMARY KEY(question_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question_type (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizz (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, title VARCHAR(255) NOT NULL, created DATETIME NOT NULL, INDEX IDX_7C77973DF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, quizz_id INT NOT NULL, user_id INT NOT NULL, answer_correct INT NOT NULL, question_count INT NOT NULL, started DATETIME NOT NULL, finished DATETIME DEFAULT NULL, INDEX IDX_D044D5D4BA934BCD (quizz_id), INDEX IDX_D044D5D4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session_question (id INT AUTO_INCREMENT NOT NULL, session_id INT NOT NULL, question_id INT NOT NULL, INDEX IDX_3D5B2926613FECDF (session_id), INDEX IDX_3D5B29261E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session_question_answer (session_question_id INT NOT NULL, answer_id INT NOT NULL, INDEX IDX_E2A22B58E27EE8C8 (session_question_id), INDEX IDX_E2A22B58AA334807 (answer_id), PRIMARY KEY(session_question_id, answer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE question_quizz ADD CONSTRAINT FK_4C9C86391E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question_quizz ADD CONSTRAINT FK_4C9C8639BA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question_tag ADD CONSTRAINT FK_339D56FB1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question_tag ADD CONSTRAINT FK_339D56FBBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quizz ADD CONSTRAINT FK_7C77973DF675F31B FOREIGN KEY (author_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4BA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE session_question ADD CONSTRAINT FK_3D5B2926613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE session_question ADD CONSTRAINT FK_3D5B29261E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE session_question_answer ADD CONSTRAINT FK_E2A22B58E27EE8C8 FOREIGN KEY (session_question_id) REFERENCES session_question (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session_question_answer ADD CONSTRAINT FK_E2A22B58AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA9261220EA6');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_32993751853CD175');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_3299375199E6F5DF');
        $this->addSql('DROP TABLE quiz');
        $this->addSql('DROP TABLE score');
        $this->addSql('DROP INDEX IDX_B6F7494E853CD175 ON question');
        $this->addSql('ALTER TABLE question ADD text VARCHAR(255) NOT NULL, ADD image VARCHAR(255) DEFAULT NULL, DROP question, DROP good_answer, DROP bad_answer1, DROP bad_answer2, DROP bad_answer3, CHANGE quiz_id type_id INT NOT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EC54C8C93 FOREIGN KEY (type_id) REFERENCES question_type (id)');
        $this->addSql('CREATE INDEX IDX_B6F7494EC54C8C93 ON question (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EC54C8C93');
        $this->addSql('CREATE TABLE quiz (id INT AUTO_INCREMENT NOT NULL, creator_id INT DEFAULT NULL, theme VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date DATE NOT NULL, INDEX IDX_A412FA9261220EA6 (creator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE score (id INT AUTO_INCREMENT NOT NULL, player_id INT NOT NULL, quiz_id INT NOT NULL, points INT NOT NULL, date DATE NOT NULL, INDEX IDX_3299375199E6F5DF (player_id), INDEX IDX_32993751853CD175 (quiz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA9261220EA6 FOREIGN KEY (creator_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_3299375199E6F5DF FOREIGN KEY (player_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE question_quizz DROP FOREIGN KEY FK_4C9C86391E27F6BF');
        $this->addSql('ALTER TABLE question_quizz DROP FOREIGN KEY FK_4C9C8639BA934BCD');
        $this->addSql('ALTER TABLE question_tag DROP FOREIGN KEY FK_339D56FB1E27F6BF');
        $this->addSql('ALTER TABLE question_tag DROP FOREIGN KEY FK_339D56FBBAD26311');
        $this->addSql('ALTER TABLE quizz DROP FOREIGN KEY FK_7C77973DF675F31B');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4BA934BCD');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4A76ED395');
        $this->addSql('ALTER TABLE session_question DROP FOREIGN KEY FK_3D5B2926613FECDF');
        $this->addSql('ALTER TABLE session_question DROP FOREIGN KEY FK_3D5B29261E27F6BF');
        $this->addSql('ALTER TABLE session_question_answer DROP FOREIGN KEY FK_E2A22B58E27EE8C8');
        $this->addSql('ALTER TABLE session_question_answer DROP FOREIGN KEY FK_E2A22B58AA334807');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE question_quizz');
        $this->addSql('DROP TABLE question_tag');
        $this->addSql('DROP TABLE question_type');
        $this->addSql('DROP TABLE quizz');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE session_question');
        $this->addSql('DROP TABLE session_question_answer');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP INDEX IDX_B6F7494EC54C8C93 ON question');
        $this->addSql('ALTER TABLE question ADD good_answer VARCHAR(255) NOT NULL, ADD bad_answer1 VARCHAR(255) NOT NULL, ADD bad_answer2 VARCHAR(255) NOT NULL, ADD bad_answer3 VARCHAR(255) NOT NULL, DROP image, CHANGE type_id quiz_id INT NOT NULL, CHANGE text question VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B6F7494E853CD175 ON question (quiz_id)');
    }
}
