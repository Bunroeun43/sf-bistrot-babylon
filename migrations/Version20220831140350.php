<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220831140350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formules ADD plats_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formules ADD CONSTRAINT FK_E5BA88E1AA14E1C8 FOREIGN KEY (plats_id) REFERENCES plats (id)');
        $this->addSql('CREATE INDEX IDX_E5BA88E1AA14E1C8 ON formules (plats_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formules DROP FOREIGN KEY FK_E5BA88E1AA14E1C8');
        $this->addSql('DROP INDEX IDX_E5BA88E1AA14E1C8 ON formules');
        $this->addSql('ALTER TABLE formules DROP plats_id');
    }
}
