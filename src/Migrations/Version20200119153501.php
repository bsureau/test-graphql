<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200119153501 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE planet_astronaut');
        $this->addSql('ALTER TABLE astronaut ADD planet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE astronaut ADD CONSTRAINT FK_5DADB6E5A25E9820 FOREIGN KEY (planet_id) REFERENCES planet (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5DADB6E5A25E9820 ON astronaut (planet_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE planet_astronaut (planet_id INT NOT NULL, astronaut_id INT NOT NULL, INDEX IDX_DC60E91DA25E9820 (planet_id), INDEX IDX_DC60E91DD390014D (astronaut_id), PRIMARY KEY(planet_id, astronaut_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE planet_astronaut ADD CONSTRAINT FK_DC60E91DA25E9820 FOREIGN KEY (planet_id) REFERENCES planet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE planet_astronaut ADD CONSTRAINT FK_DC60E91DD390014D FOREIGN KEY (astronaut_id) REFERENCES astronaut (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE astronaut DROP FOREIGN KEY FK_5DADB6E5A25E9820');
        $this->addSql('DROP INDEX UNIQ_5DADB6E5A25E9820 ON astronaut');
        $this->addSql('ALTER TABLE astronaut DROP planet_id');
    }
}
