<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200119110242 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE astronaut (id INT AUTO_INCREMENT NOT NULL, grade_id INT DEFAULT NULL, pseudo VARCHAR(255) NOT NULL, INDEX IDX_5DADB6E5FE19A1A8 (grade_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planet (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planet_astronaut (planet_id INT NOT NULL, astronaut_id INT NOT NULL, INDEX IDX_DC60E91DA25E9820 (planet_id), INDEX IDX_DC60E91DD390014D (astronaut_id), PRIMARY KEY(planet_id, astronaut_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grade (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE astronaut ADD CONSTRAINT FK_5DADB6E5FE19A1A8 FOREIGN KEY (grade_id) REFERENCES grade (id)');
        $this->addSql('ALTER TABLE planet_astronaut ADD CONSTRAINT FK_DC60E91DA25E9820 FOREIGN KEY (planet_id) REFERENCES planet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE planet_astronaut ADD CONSTRAINT FK_DC60E91DD390014D FOREIGN KEY (astronaut_id) REFERENCES astronaut (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE post');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE planet_astronaut DROP FOREIGN KEY FK_DC60E91DD390014D');
        $this->addSql('ALTER TABLE planet_astronaut DROP FOREIGN KEY FK_DC60E91DA25E9820');
        $this->addSql('ALTER TABLE astronaut DROP FOREIGN KEY FK_5DADB6E5FE19A1A8');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, text LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE astronaut');
        $this->addSql('DROP TABLE planet');
        $this->addSql('DROP TABLE planet_astronaut');
        $this->addSql('DROP TABLE grade');
    }
}
