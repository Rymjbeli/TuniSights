<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230503211902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment CHANGE created_at created_at DATE DEFAULT NULL, CHANGE updated_at updated_at DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE `like` CHANGE created_at created_at DATE DEFAULT NULL, CHANGE updated_at updated_at DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE post CHANGE title title VARCHAR(100) DEFAULT NULL, CHANGE place place VARCHAR(100) DEFAULT NULL, CHANGE location location VARCHAR(100) DEFAULT NULL, CHANGE created_at created_at DATE DEFAULT NULL, CHANGE updated_at updated_at DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE gender gender VARCHAR(15) DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL, CHANGE created_at created_at DATE DEFAULT NULL, CHANGE updated_at updated_at DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment CHANGE created_at created_at DATE DEFAULT \'NULL\', CHANGE updated_at updated_at DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE `like` CHANGE created_at created_at DATE DEFAULT \'NULL\', CHANGE updated_at updated_at DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE post CHANGE title title VARCHAR(100) DEFAULT \'NULL\', CHANGE place place VARCHAR(100) DEFAULT \'NULL\', CHANGE location location VARCHAR(100) DEFAULT \'NULL\', CHANGE created_at created_at DATE DEFAULT \'NULL\', CHANGE updated_at updated_at DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE `user` CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`, CHANGE gender gender VARCHAR(15) DEFAULT \'NULL\', CHANGE image image VARCHAR(255) DEFAULT \'NULL\', CHANGE created_at created_at DATE DEFAULT \'NULL\', CHANGE updated_at updated_at DATE DEFAULT \'NULL\'');
    }
}
