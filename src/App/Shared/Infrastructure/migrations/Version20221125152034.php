<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221125152034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $legalStatus = [
            "Entrepreneur individuel",
            "Groupement de droit privé non doté de la personnalité morale",
            "Indivision",
            "Indivision entre personnes physiques",
            "Indivision avec personne morale",
        ];
        $this->addSql('INSERT INTO legal_status(`name`) values ("'.join('"),("', $legalStatus).'")');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
