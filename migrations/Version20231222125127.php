<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231222125127 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cars (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, price INT NOT NULL, picture VARCHAR(255) NOT NULL, release_year INT NOT NULL, mileage INT NOT NULL, description LONGTEXT NOT NULL, technical VARCHAR(255) NOT NULL, feature VARCHAR(255) NOT NULL, equipement VARCHAR(255) NOT NULL, more_option VARCHAR(255) NOT NULL, INDEX IDX_95C71D14A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hours (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, day VARCHAR(255) NOT NULL, hour VARCHAR(255) NOT NULL, INDEX IDX_8A1ABD8DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reviews (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, rate INT NOT NULL, review LONGTEXT NOT NULL, approved TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_6970EB0FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, type VARCHAR(255) NOT NULL, price INT NOT NULL, INDEX IDX_7332E169A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE hours ADD CONSTRAINT FK_8A1ABD8DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reviews ADD CONSTRAINT FK_6970EB0FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE services ADD CONSTRAINT FK_7332E169A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14A76ED395');
        $this->addSql('ALTER TABLE hours DROP FOREIGN KEY FK_8A1ABD8DA76ED395');
        $this->addSql('ALTER TABLE reviews DROP FOREIGN KEY FK_6970EB0FA76ED395');
        $this->addSql('ALTER TABLE services DROP FOREIGN KEY FK_7332E169A76ED395');
        $this->addSql('DROP TABLE cars');
        $this->addSql('DROP TABLE hours');
        $this->addSql('DROP TABLE reviews');
        $this->addSql('DROP TABLE services');
    }
}
