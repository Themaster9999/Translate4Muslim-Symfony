<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230411163227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE badge (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, tier VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, profile_id INT NOT NULL, request_id INT NOT NULL, comment LONGTEXT NOT NULL, INDEX IDX_9474526CCCFA12B8 (profile_id), INDEX IDX_9474526C427EB8A5 (request_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, bio LONGTEXT NOT NULL, email VARCHAR(255) NOT NULL, image_path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile_badge (profile_id INT NOT NULL, badge_id INT NOT NULL, INDEX IDX_924D7CFCCFA12B8 (profile_id), INDEX IDX_924D7CFF7A2C2FC (badge_id), PRIMARY KEY(profile_id, badge_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE request (id INT AUTO_INCREMENT NOT NULL, profile_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image_path VARCHAR(255) DEFAULT NULL, state TINYINT(1) NOT NULL, INDEX IDX_3B978F9FCCFA12B8 (profile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CCCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C427EB8A5 FOREIGN KEY (request_id) REFERENCES request (id)');
        $this->addSql('ALTER TABLE profile_badge ADD CONSTRAINT FK_924D7CFCCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profile_badge ADD CONSTRAINT FK_924D7CFF7A2C2FC FOREIGN KEY (badge_id) REFERENCES badge (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9FCCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CCCFA12B8');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C427EB8A5');
        $this->addSql('ALTER TABLE profile_badge DROP FOREIGN KEY FK_924D7CFCCFA12B8');
        $this->addSql('ALTER TABLE profile_badge DROP FOREIGN KEY FK_924D7CFF7A2C2FC');
        $this->addSql('ALTER TABLE request DROP FOREIGN KEY FK_3B978F9FCCFA12B8');
        $this->addSql('DROP TABLE badge');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE profile_badge');
        $this->addSql('DROP TABLE request');
    }
}
