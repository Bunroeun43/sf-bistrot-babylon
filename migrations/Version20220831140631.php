<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220831140631 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formules ADD desserts_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formules ADD CONSTRAINT FK_E5BA88E1240968D6 FOREIGN KEY (desserts_id) REFERENCES desserts (id)');
        $this->addSql('CREATE INDEX IDX_E5BA88E1240968D6 ON formules (desserts_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formules DROP FOREIGN KEY FK_E5BA88E1240968D6');
        $this->addSql('DROP INDEX IDX_E5BA88E1240968D6 ON formules');
        $this->addSql('ALTER TABLE formules DROP desserts_id');
    }
}
