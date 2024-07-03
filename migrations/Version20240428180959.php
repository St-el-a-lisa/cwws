<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240428180959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart_product_product (cart_product_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_7BE599ED25EE16A8 (cart_product_id), INDEX IDX_7BE599ED4584665A (product_id), PRIMARY KEY(cart_product_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart_product_product ADD CONSTRAINT FK_7BE599ED25EE16A8 FOREIGN KEY (cart_product_id) REFERENCES cart_product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_product_product ADD CONSTRAINT FK_7BE599ED4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_product_product DROP FOREIGN KEY FK_7BE599ED25EE16A8');
        $this->addSql('ALTER TABLE cart_product_product DROP FOREIGN KEY FK_7BE599ED4584665A');
        $this->addSql('DROP TABLE cart_product_product');
    }
}
