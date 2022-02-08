<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220207140509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bidule (id INT AUTO_INCREMENT NOT NULL, chouette INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bidule_truc (bidule_id INT NOT NULL, truc_id INT NOT NULL, INDEX IDX_30452835B61473C7 (bidule_id), INDEX IDX_304528354200ACFC (truc_id), PRIMARY KEY(bidule_id, truc_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE truc (id INT AUTO_INCREMENT NOT NULL, machin VARCHAR(12) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bidule_truc ADD CONSTRAINT FK_30452835B61473C7 FOREIGN KEY (bidule_id) REFERENCES bidule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bidule_truc ADD CONSTRAINT FK_304528354200ACFC FOREIGN KEY (truc_id) REFERENCES truc (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bidule_truc DROP FOREIGN KEY FK_30452835B61473C7');
        $this->addSql('ALTER TABLE bidule_truc DROP FOREIGN KEY FK_304528354200ACFC');
        $this->addSql('DROP TABLE bidule');
        $this->addSql('DROP TABLE bidule_truc');
        $this->addSql('DROP TABLE truc');
    }
}
