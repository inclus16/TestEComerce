<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200112031503 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE orders (id SERIAL PRIMARY KEY , status_id INT REFERENCES order_statuses(id))');
        $this->addSql('CREATE TABLE order_products (id SERIAL PRIMARY KEY, order_id INT REFERENCES orders(id)
                            ON DELETE CASCADE, product_id INT REFERENCES products(id) ON DELETE CASCADE )');

    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE orders CASCADE');

    }
}
