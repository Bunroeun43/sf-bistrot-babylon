<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220831115949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formules_plats DROP FOREIGN KEY FK_8E1A0157168F3793');
        $this->addSql('ALTER TABLE formules_plats DROP FOREIGN KEY FK_8E1A0157AA14E1C8');
        $this->addSql('DROP TABLE formules');
        $this->addSql('DROP TABLE formules_plats');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formules (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prix NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE formules_plats (formules_id INT NOT NULL, plats_id INT NOT NULL, INDEX IDX_8E1A0157168F3793 (formules_id), INDEX IDX_8E1A0157AA14E1C8 (plats_id), PRIMARY KEY(formules_id, plats_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE formules_plats ADD CONSTRAINT FK_8E1A0157168F3793 FOREIGN KEY (formules_id) REFERENCES formules (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formules_plats ADD CONSTRAINT FK_8E1A0157AA14E1C8 FOREIGN KEY (plats_id) REFERENCES plats (id) ON DELETE CASCADE');
    }
}
