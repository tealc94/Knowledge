<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240714074358 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lessons DROP FOREIGN KEY FK_3F4218D913877FD');
        $this->addSql('DROP INDEX IDX_3F4218D913877FD ON lessons');
        $this->addSql('ALTER TABLE lessons CHANGE id_name_cursus_id cursus_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lessons ADD CONSTRAINT FK_3F4218D940AEF4B9 FOREIGN KEY (cursus_id) REFERENCES cursus (id)');
        $this->addSql('CREATE INDEX IDX_3F4218D940AEF4B9 ON lessons (cursus_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lessons DROP FOREIGN KEY FK_3F4218D940AEF4B9');
        $this->addSql('DROP INDEX IDX_3F4218D940AEF4B9 ON lessons');
        $this->addSql('ALTER TABLE lessons CHANGE cursus_id id_name_cursus_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lessons ADD CONSTRAINT FK_3F4218D913877FD FOREIGN KEY (id_name_cursus_id) REFERENCES cursus (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3F4218D913877FD ON lessons (id_name_cursus_id)');
    }
}
