<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240207214403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, payment_number INT NOT NULL, payment_amount DOUBLE PRECISION NOT NULL, payment_date DATE NOT NULL, payment_status VARCHAR(255) NOT NULL, payment_method VARCHAR(255) NOT NULL, payment_default TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_order (payment_id INT NOT NULL, order_id INT NOT NULL, INDEX IDX_A260A52A4C3A3BB (payment_id), INDEX IDX_A260A52A8D9F6D38 (order_id), PRIMARY KEY(payment_id, order_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE payment_order ADD CONSTRAINT FK_A260A52A4C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE payment_order ADD CONSTRAINT FK_A260A52A8D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment_order DROP FOREIGN KEY FK_A260A52A4C3A3BB');
        $this->addSql('ALTER TABLE payment_order DROP FOREIGN KEY FK_A260A52A8D9F6D38');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE payment_order');
    }
}
