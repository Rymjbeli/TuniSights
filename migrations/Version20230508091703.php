<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230508091703 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD created_at DATE DEFAULT NULL, ADD updated_at DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE `like` ADD created_at DATE DEFAULT NULL, ADD updated_at DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD created_at DATE DEFAULT NULL, ADD updated_at DATE DEFAULT NULL, CHANGE title title VARCHAR(100) DEFAULT NULL, CHANGE place place VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL, ADD created_at DATE DEFAULT NULL, ADD updated_at DATE DEFAULT NULL, CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', CHANGE gender gender VARCHAR(15) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE `like` DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE post DROP created_at, DROP updated_at, CHANGE title title VARCHAR(100) NOT NULL, CHANGE place place VARCHAR(100) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP is_verified, DROP created_at, DROP updated_at, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`, CHANGE gender gender VARCHAR(15) NOT NULL');
    }
}
