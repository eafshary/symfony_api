<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250319170231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $hashedPassword = password_hash('admin', PASSWORD_BCRYPT);

        // Remove backticks and ensure correct JSON format
        $this->addSql("INSERT INTO \"user\" (email, roles, password) VALUES ('admin@example.com', '[\"ROLE_ADMIN\"]', '$hashedPassword')");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("DELETE FROM `user` WHERE email = 'admin@example.com'");
    }
}
