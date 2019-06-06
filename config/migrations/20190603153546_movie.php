<?php

use Phinx\Migration\AbstractMigration;

class Movie extends AbstractMigration
{
    public function up(): void
    {
        $sql = <<<SQL
            CREATE TABLE movie
            (
                id serial NOT NULL,
                exploitation_visa character varying(127) NOT NULL,
                title character varying(64) NOT NULL,
                year int NOT NULL,
                UNIQUE (exploitation_visa),
                PRIMARY KEY (id)
            );
SQL;
        $this->query($sql);
    }

    public function down(): void
    {
        $this->table('movie')->drop()->save();
    }
}
