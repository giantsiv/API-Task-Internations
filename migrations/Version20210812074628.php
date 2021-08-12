<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210812074628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_grouping ADD user_id INT DEFAULT NULL, ADD group_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE app_grouping ADD CONSTRAINT FK_7AE7B5A76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE app_grouping ADD CONSTRAINT FK_7AE7B5FE54D947 FOREIGN KEY (group_id) REFERENCES app_group (id)');
        $this->addSql('CREATE INDEX IDX_7AE7B5A76ED395 ON app_grouping (user_id)');
        $this->addSql('CREATE INDEX IDX_7AE7B5FE54D947 ON app_grouping (group_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_grouping DROP FOREIGN KEY FK_7AE7B5A76ED395');
        $this->addSql('ALTER TABLE app_grouping DROP FOREIGN KEY FK_7AE7B5FE54D947');
        $this->addSql('DROP INDEX IDX_7AE7B5A76ED395 ON app_grouping');
        $this->addSql('DROP INDEX IDX_7AE7B5FE54D947 ON app_grouping');
        $this->addSql('ALTER TABLE app_grouping DROP user_id, DROP group_id');
    }
}
