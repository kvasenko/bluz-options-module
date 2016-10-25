<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Migration for options module
 */
class Version20161025094951 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('CREATE TABLE options (namespace VARCHAR(64) DEFAULT \'default\' NOT NULL,`key` VARCHAR(255) NOT NULL,value LONGTEXT NOT NULL,description LONGTEXT,created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,updated TIMESTAMP NOT NULL,CONSTRAINT options_key_namespace_pk PRIMARY KEY (`key`, namespace));');
        $this->addSql('INSERT INTO `acl_privileges` (`roleId`, `module`, `privilege`) VALUES (2,\'options\',\'Management\');');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('DELETE FROM `acl_privileges` WHERE module=\'options\'');
        $this->addSql('DROP TABLE options');
    }
}
