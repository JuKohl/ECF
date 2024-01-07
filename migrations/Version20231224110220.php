<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231224110220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars CHANGE release_year release_year INT NOT NULL');
        $this->addSql('ALTER TABLE reviews DROP INDEX UNIQ_6970EB0FA76ED395, ADD INDEX IDX_6970EB0FA76ED395 (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars CHANGE release_year release_year DATE NOT NULL');
        $this->addSql('ALTER TABLE reviews DROP INDEX IDX_6970EB0FA76ED395, ADD UNIQUE INDEX UNIQ_6970EB0FA76ED395 (user_id)');
    }
}
