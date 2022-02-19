<?php

declare(strict_types=1);

namespace MeetingPlace\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220219211553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Places default places on map';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            "
                INSERT INTO `Places` (`latitude`, `longitude`, `added_from_ip`, `creation_date`, `description`, `first_image_url`, `second_image_url`, `third_image_url`, `deleted`, `groupName`) VALUES ('49.92501091657249', '18.621352678321877', 2886860801, '2022-02-19 17:03:04', 'Bardzo ładny las. Miejsce na ognisko też się znajduje. Gotowe ławki oraz WIFI.', 'https://i.gyazo.com/7a5f2bd979a51c06bd6309fe996afd7f.jpg', '', '', 0, '');
                INSERT INTO `Places` (`latitude`, `longitude`, `added_from_ip`, `creation_date`, `description`, `first_image_url`, `second_image_url`, `third_image_url`, `deleted`, `groupName`) VALUES ('49.919784876610876', '18.625576773763665', 2886860801, '2022-02-19 17:05:46', 'Dobre miejsce na ognisko. Można się dogadać z właścicielem, obok są stawy. Bardzo ciemno i głucho w nocy.', 'https://i.gyazo.com/39ee239150bc9c0f3a19d22261017bd5.jpg', 'https://i.gyazo.com/05b340beb6a55c967e1788ac510cd1dd.jpg', '', 0, '');
                INSERT INTO `Places` (`latitude`, `longitude`, `added_from_ip`, `creation_date`, `description`, `first_image_url`, `second_image_url`, `third_image_url`, `deleted`, `groupName`) VALUES ('49.94668184159103', '18.575417551931817', 2886860801, '2022-02-19 17:07:18', 'Rury. Kto ma wiedzieć ten wie. Tam gdzie zwykle.', '', '', '', 0, 'Gumisie');
        ");
    }

    public function down(Schema $schema): void
    {
    }
}
