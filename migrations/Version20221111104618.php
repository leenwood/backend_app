<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221111104618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE interest (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_interest (user_id INT NOT NULL, interest_id INT NOT NULL, INDEX IDX_8CB3FE67A76ED395 (user_id), INDEX IDX_8CB3FE675A95FF89 (interest_id), PRIMARY KEY(user_id, interest_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_interest ADD CONSTRAINT FK_8CB3FE67A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_interest ADD CONSTRAINT FK_8CB3FE675A95FF89 FOREIGN KEY (interest_id) REFERENCES interest (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD description LONGTEXT DEFAULT NULL, ADD work_address VARCHAR(255) DEFAULT NULL, ADD city_living VARCHAR(255) DEFAULT NULL, ADD name VARCHAR(255) DEFAULT NULL, ADD surname VARCHAR(255) DEFAULT NULL, ADD date_of_birth DATE DEFAULT NULL, ADD age INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_interest DROP FOREIGN KEY FK_8CB3FE67A76ED395');
        $this->addSql('ALTER TABLE user_interest DROP FOREIGN KEY FK_8CB3FE675A95FF89');
        $this->addSql('DROP TABLE interest');
        $this->addSql('DROP TABLE user_interest');
        $this->addSql('ALTER TABLE `user` DROP description, DROP work_address, DROP city_living, DROP name, DROP surname, DROP date_of_birth, DROP age');
    }
}
