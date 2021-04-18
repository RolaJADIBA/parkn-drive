<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210323170210 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cars (id INT AUTO_INCREMENT NOT NULL, mark VARCHAR(50) NOT NULL, model VARCHAR(50) NOT NULL, color VARCHAR(50) NOT NULL, gear_box VARCHAR(50) NOT NULL, mileage VARCHAR(50) NOT NULL, prodction_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_cars (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, cars_id INT DEFAULT NULL, INDEX IDX_5A4E531A67B3B43D (users_id), INDEX IDX_5A4E531A8702F506 (cars_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users_cars ADD CONSTRAINT FK_5A4E531A67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE users_cars ADD CONSTRAINT FK_5A4E531A8702F506 FOREIGN KEY (cars_id) REFERENCES cars (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users_cars DROP FOREIGN KEY FK_5A4E531A8702F506');
        $this->addSql('DROP TABLE cars');
        $this->addSql('DROP TABLE users_cars');
    }
}
