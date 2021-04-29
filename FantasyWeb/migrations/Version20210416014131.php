<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210416014131 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matchevent CHANGE id_equipeA id_equipeA INT DEFAULT NULL, CHANGE id_equipeB id_equipeB INT DEFAULT NULL');
        $this->addSql('ALTER TABLE statistique CHANGE id_statistique id_statistique INT AUTO_INCREMENT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matchevent DROP FOREIGN KEY FK_7E4CBCE60BD9AAA');
        $this->addSql('ALTER TABLE matchevent DROP FOREIGN KEY FK_7E4CBCEF9B4CB10');
        $this->addSql('ALTER TABLE matchevent CHANGE id_equipeA id_equipeA INT NOT NULL, CHANGE id_equipeB id_equipeB INT NOT NULL');
        $this->addSql('ALTER TABLE statistique CHANGE id_statistique id_statistique INT NOT NULL');
    }
}
