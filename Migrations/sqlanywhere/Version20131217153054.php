<?php

namespace Claroline\ForumBundle\Migrations\sqlanywhere;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2013/12/17 03:30:55
 */
class Version20131217153054 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE claro_forum_category (
                id INT IDENTITY NOT NULL, 
                forum_id INT DEFAULT NULL, 
                created DATETIME NOT NULL, 
                modificationDate DATETIME NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_2192ACF729CCBAD0 ON claro_forum_category (forum_id)
        ");
        $this->addSql("
            ALTER TABLE claro_forum_category 
            ADD CONSTRAINT FK_2192ACF729CCBAD0 FOREIGN KEY (forum_id) 
            REFERENCES claro_forum (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_forum_subject RENAME forum_id TO category_id
        ");
        $this->addSql("
            ALTER TABLE claro_forum_subject 
            ADD isSticked BIT NOT NULL
        ");
        $this->addSql("
            ALTER TABLE claro_forum_subject 
            DROP FOREIGN KEY FK_273AA20B29CCBAD0
        ");
        $this->addSql("
            DROP INDEX claro_forum_subject.IDX_273AA20B29CCBAD0
        ");
        $this->addSql("
            ALTER TABLE claro_forum_subject 
            ADD CONSTRAINT FK_273AA20B12469DE2 FOREIGN KEY (category_id) 
            REFERENCES claro_forum_category (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            CREATE INDEX IDX_273AA20B12469DE2 ON claro_forum_subject (category_id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE claro_forum_subject 
            DROP FOREIGN KEY FK_273AA20B12469DE2
        ");
        $this->addSql("
            DROP TABLE claro_forum_category
        ");
        $this->addSql("
            ALTER TABLE claro_forum_subject RENAME category_id TO forum_id
        ");
        $this->addSql("
            ALTER TABLE claro_forum_subject 
            DROP isSticked
        ");
        $this->addSql("
            DROP INDEX claro_forum_subject.IDX_273AA20B12469DE2
        ");
        $this->addSql("
            ALTER TABLE claro_forum_subject 
            ADD CONSTRAINT FK_273AA20B29CCBAD0 FOREIGN KEY (forum_id) 
            REFERENCES claro_forum (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            CREATE INDEX IDX_273AA20B29CCBAD0 ON claro_forum_subject (forum_id)
        ");
    }
}