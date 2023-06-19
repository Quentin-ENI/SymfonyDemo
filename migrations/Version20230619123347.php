<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230619123347 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pen (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, number INT NOT NULL, surface NUMERIC(8, 2) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal ADD pen_id INT NOT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FA9CBC84D FOREIGN KEY (pen_id) REFERENCES pen (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231FA9CBC84D ON animal (pen_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FA9CBC84D');
        $this->addSql('DROP TABLE pen');
        $this->addSql('DROP INDEX IDX_6AAB231FA9CBC84D ON animal');
        $this->addSql('ALTER TABLE animal DROP pen_id');
    }
}
