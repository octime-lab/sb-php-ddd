<?php

use Phinx\Migration\AbstractMigration;

class User extends AbstractMigration
{
    public function up(): void
    {
        $sql = <<<SQL
            CREATE TABLE "user"
            (
                id serial NOT NULL,
                username character varying(25) NOT NULL,
                password character varying(64) NOT NULL,
                email character varying(60) NOT NULL,
                is_active boolean NOT NULL DEFAULT true,
                UNIQUE (email),
                PRIMARY KEY (id)
            );
SQL;
        $this->query($sql);

//        $sql = <<<SQL
//            INSERT INTO "user" (username, password, email, is_active)
//            VALUES
//             ('admin', '$2a$08$jHZj/wJfcVKlIwr5AvR78euJxYK7Ku5kURNhNx.7.CSIJ3Pq6LEPC', 'admin@example.com', true)
//            ;
//SQL;
//        $this->query($sql);
    }

    public function down(): void
    {
        $this->table('user')->drop()->save();
    }
}
