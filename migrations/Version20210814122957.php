<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210814122957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_grouping (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, group_id INT DEFAULT NULL, INDEX IDX_7AE7B5A76ED395 (user_id), INDEX IDX_7AE7B5FE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_c (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E64A6DB8F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_grouping ADD CONSTRAINT FK_7AE7B5A76ED395 FOREIGN KEY (user_id) REFERENCES user_c (id)');
        $this->addSql('ALTER TABLE app_grouping ADD CONSTRAINT FK_7AE7B5FE54D947 FOREIGN KEY (group_id) REFERENCES app_group (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_grouping DROP FOREIGN KEY FK_7AE7B5FE54D947');
        $this->addSql('ALTER TABLE app_grouping DROP FOREIGN KEY FK_7AE7B5A76ED395');
        $this->addSql('DROP TABLE app_group');
        $this->addSql('DROP TABLE app_grouping');
        $this->addSql('DROP TABLE user_c');
    }
}
