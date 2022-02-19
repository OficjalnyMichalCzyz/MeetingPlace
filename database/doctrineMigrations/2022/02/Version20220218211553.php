<?php

declare(strict_types=1);

namespace MeetingPlace\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220218211553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Places ratings migration';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE Ratings(
                    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                    added_from_ip INT(12) UNSIGNED NOT NULL,
                    creation_date TIMESTAMP NOT NULL,
                    description  VARCHAR (500) COLLATE UTF8_POLISH_CI,
                    deleted boolean default false,
                    `type` int(2),
                    place_id INT(11) UNSIGNED,
                    rating_id INT(11) UNSIGNED,
                    is_comment boolean default false,
                    PRIMARY KEY (id)
                )
                COLLATE=utf8_polish_ci
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE Ratings;");
    }
}
