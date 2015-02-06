<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150206153751 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_tl_group DROP FOREIGN KEY FK_B7998B68FE54D947');
        $this->addSql('CREATE TABLE wall (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, wall_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, INDEX IDX_B6BD307FC33923F1 (wall_id), INDEX IDX_B6BD307F727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FC33923F1 FOREIGN KEY (wall_id) REFERENCES wall (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F727ACA70 FOREIGN KEY (parent_id) REFERENCES message (id)');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('DROP TABLE user_tl_group');
        $this->addSql('ALTER TABLE user ADD wall_id INT DEFAULT NULL, ADD location VARCHAR(255) NOT NULL, ADD location_display TINYINT(1) NOT NULL, ADD website VARCHAR(255) NOT NULL, ADD website_display TINYINT(1) NOT NULL, CHANGE society organization VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C33923F1 FOREIGN KEY (wall_id) REFERENCES wall (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649C33923F1 ON user (wall_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C33923F1');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FC33923F1');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F727ACA70');
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_6DC044C55E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_tl_group (user_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_B7998B68A76ED395 (user_id), INDEX IDX_B7998B68FE54D947 (group_id), PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_tl_group ADD CONSTRAINT FK_B7998B68FE54D947 FOREIGN KEY (group_id) REFERENCES `group` (id)');
        $this->addSql('ALTER TABLE user_tl_group ADD CONSTRAINT FK_B7998B68A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE wall');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP INDEX UNIQ_8D93D649C33923F1 ON user');
        $this->addSql('ALTER TABLE user ADD society VARCHAR(255) NOT NULL, DROP wall_id, DROP organization, DROP location, DROP location_display, DROP website, DROP website_display');
    }
}
