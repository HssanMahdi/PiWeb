<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210419045135 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groupe ADD id_user INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_4B98C216B3CA4B ON groupe (id_user)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C216B3CA4B');
        $this->addSql('DROP INDEX IDX_4B98C216B3CA4B ON groupe');
        $this->addSql('ALTER TABLE groupe DROP id_user');
        $this->addSql('ALTER TABLE matchevent DROP FOREIGN KEY FK_7E4CBCE60BD9AAA');
        $this->addSql('ALTER TABLE matchevent DROP FOREIGN KEY FK_7E4CBCEF9B4CB10');
    }
}
