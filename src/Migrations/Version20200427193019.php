<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200427193019 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE wallet DROP FOREIGN KEY FK_7C68921FA76ED395');
        $this->addSql('DROP INDEX UNIQ_7C68921FA76ED395 ON wallet');
        $this->addSql('ALTER TABLE wallet CHANGE user_id user__id INT NOT NULL');
        $this->addSql('ALTER TABLE wallet ADD CONSTRAINT FK_7C68921F8D57A4BB FOREIGN KEY (user__id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7C68921F8D57A4BB ON wallet (user__id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE wallet DROP FOREIGN KEY FK_7C68921F8D57A4BB');
        $this->addSql('DROP INDEX UNIQ_7C68921F8D57A4BB ON wallet');
        $this->addSql('ALTER TABLE wallet CHANGE user__id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE wallet ADD CONSTRAINT FK_7C68921FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7C68921FA76ED395 ON wallet (user_id)');
    }
}
