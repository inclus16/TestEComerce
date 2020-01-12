<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200112030507 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE order_statuses (id SMALLINT PRIMARY KEY, name VARCHAR(15))');
        $this->addSql('INSERT INTO order_statuses (id,name) VALUES (1,\'новый\'),(2,\'оплачено\')');

    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE order_statuses');
    }
}
