<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230505220108 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reply (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, target_id INT NOT NULL, content VARCHAR(255) NOT NULL, INDEX IDX_FDA8C6E07E3C61F9 (owner_id), INDEX IDX_FDA8C6E0158E0B66 (target_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reply ADD CONSTRAINT FK_FDA8C6E07E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE reply ADD CONSTRAINT FK_FDA8C6E0158E0B66 FOREIGN KEY (target_id) REFERENCES comment (id)');
        $this->addSql('ALTER TABLE comment ADD created_at DATE DEFAULT NULL, ADD updated_at DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE `like` ADD created_at DATE DEFAULT NULL, ADD updated_at DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL, CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', CHANGE gender gender VARCHAR(15) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reply DROP FOREIGN KEY FK_FDA8C6E07E3C61F9');
        $this->addSql('ALTER TABLE reply DROP FOREIGN KEY FK_FDA8C6E0158E0B66');
        $this->addSql('DROP TABLE reply');
        $this->addSql('ALTER TABLE comment DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE `like` DROP created_at, DROP updated_at');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP is_verified, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`, CHANGE gender gender VARCHAR(15) NOT NULL');
    }
}
