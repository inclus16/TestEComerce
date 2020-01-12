<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200111024913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE products (id SERIAL PRIMARY KEY , name VARCHAR(100), cost REAL)');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE products');
    }
}
