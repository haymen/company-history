<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221122042752 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address ADD company_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_D4E6F81979B1AD6 ON address (company_id)');
        $this->addSql('ALTER TABLE company ADD legal_status_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F873E3FEC FOREIGN KEY (legal_status_id) REFERENCES legal_status (id)');
        $this->addSql('CREATE INDEX IDX_4FBF094F873E3FEC ON company (legal_status_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81979B1AD6');
        $this->addSql('DROP INDEX IDX_D4E6F81979B1AD6 ON address');
        $this->addSql('ALTER TABLE address DROP company_id');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F873E3FEC');
        $this->addSql('DROP INDEX IDX_4FBF094F873E3FEC ON company');
        $this->addSql('ALTER TABLE company DROP legal_status_id');
    }
}
