<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240428183236 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_product_product ADD product_id INT NOT NULL, ADD PRIMARY KEY (cart_product_id, product_id)');
        $this->addSql('ALTER TABLE cart_product_product ADD CONSTRAINT FK_7BE599ED4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_7BE599ED4584665A ON cart_product_product (product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_product_product DROP FOREIGN KEY FK_7BE599ED4584665A');
        $this->addSql('DROP INDEX IDX_7BE599ED4584665A ON cart_product_product');
        $this->addSql('DROP INDEX `primary` ON cart_product_product');
        $this->addSql('ALTER TABLE cart_product_product DROP product_id');
    }
}
