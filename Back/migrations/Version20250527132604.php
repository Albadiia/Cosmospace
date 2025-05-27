<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250527132604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE movie_info ADD budget INT NOT NULL, ADD revenue INT NOT NULL, ADD genre LONGTEXT NOT NULL COMMENT '(DC2Type:array)', ADD production_company LONGTEXT NOT NULL COMMENT '(DC2Type:array)', ADD production_country LONGTEXT NOT NULL COMMENT '(DC2Type:array)'
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE movie_info DROP budget, DROP revenue, DROP genre, DROP production_company, DROP production_country
        SQL);
    }
}
