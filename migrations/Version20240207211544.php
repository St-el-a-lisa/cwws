<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240207211544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, messaging_id INT NOT NULL, message_subject VARCHAR(255) NOT NULL, message_content LONGTEXT NOT NULL, message_status VARCHAR(255) NOT NULL, message_date DATETIME NOT NULL, INDEX IDX_B6BD307F5CA3C610 (messaging_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messaging (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, UNIQUE INDEX UNIQ_EE15BA61F624B39D (sender_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, order_time DATETIME NOT NULL, order_status VARCHAR(255) NOT NULL, order_notes VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F5CA3C610 FOREIGN KEY (messaging_id) REFERENCES messaging (id)');
        $this->addSql('ALTER TABLE messaging ADD CONSTRAINT FK_EE15BA61F624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE shipping ADD associated_order_id INT DEFAULT NULL, DROP shipping_notes');
        $this->addSql('ALTER TABLE shipping ADD CONSTRAINT FK_2D1C1724FC35A14E FOREIGN KEY (associated_order_id) REFERENCES `order` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2D1C1724FC35A14E ON shipping (associated_order_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shipping DROP FOREIGN KEY FK_2D1C1724FC35A14E');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F5CA3C610');
        $this->addSql('ALTER TABLE messaging DROP FOREIGN KEY FK_EE15BA61F624B39D');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE messaging');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP INDEX UNIQ_2D1C1724FC35A14E ON shipping');
        $this->addSql('ALTER TABLE shipping ADD shipping_notes VARCHAR(255) DEFAULT NULL, DROP associated_order_id');
    }
}
