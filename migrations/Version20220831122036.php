<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220831122036 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formules ADD entrees_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formules ADD CONSTRAINT FK_E5BA88E1FA69D698 FOREIGN KEY (entrees_id) REFERENCES entrees (id)');
        $this->addSql('CREATE INDEX IDX_E5BA88E1FA69D698 ON formules (entrees_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formules DROP FOREIGN KEY FK_E5BA88E1FA69D698');
        $this->addSql('DROP INDEX IDX_E5BA88E1FA69D698 ON formules');
        $this->addSql('ALTER TABLE formules DROP entrees_id');
    }
}