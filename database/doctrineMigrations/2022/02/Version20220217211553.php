<?php

declare(strict_types=1);

namespace MeetingPlace\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220217211553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Places table migration';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE Places(
                    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                    latitude VARCHAR (25) COLLATE UTF8_POLISH_CI,
                    longitude VARCHAR (25) COLLATE UTF8_POLISH_CI,
                    added_from_ip INT(12) UNSIGNED NOT NULL,
                    creation_date TIMESTAMP NOT NULL,
                    description  VARCHAR (1000) COLLATE UTF8_POLISH_CI,
                    first_image_url VARCHAR (200) COLLATE UTF8_POLISH_CI,
                    second_image_url VARCHAR (200) COLLATE UTF8_POLISH_CI,
                    third_image_url  VARCHAR (200) COLLATE UTF8_POLISH_CI,
                    deleted boolean default false,
                    groupName VARCHAR (100) COLLATE UTF8_POLISH_CI,
                    PRIMARY KEY (id)
                )
                COLLATE=utf8_polish_ci
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE Places;");
    }
}
