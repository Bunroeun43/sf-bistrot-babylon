<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220831171839 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entrees DROP FOREIGN KEY FK_24E24AA1BCF5E72D');
        $this->addSql('DROP INDEX IDX_24E24AA1BCF5E72D ON entrees');
        $this->addSql('ALTER TABLE entrees DROP categorie_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entrees ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entrees ADD CONSTRAINT FK_24E24AA1BCF5E72D FOREIGN KEY (categorie_id) REFERENCES plats_categories (id)');
        $this->addSql('CREATE INDEX IDX_24E24AA1BCF5E72D ON entrees (categorie_id)');
    }
}
