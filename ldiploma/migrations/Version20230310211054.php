<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230310211054 extends AbstractMigration
{

    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE application_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE garb_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE service_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tariff_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE application (id INT NOT NULL, owner_id INT DEFAULT NULL, garb_id INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, count INT DEFAULT NULL, status INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A45BDDC17E3C61F9 ON application (owner_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A45BDDC19BE8E1EF ON application (garb_id)');
        $this->addSql('CREATE TABLE application_tariff (application_id INT NOT NULL, tariff_id INT NOT NULL, PRIMARY KEY(application_id, tariff_id))');
        $this->addSql('CREATE INDEX IDX_24562CB83E030ACD ON application_tariff (application_id)');
        $this->addSql('CREATE INDEX IDX_24562CB892348FD2 ON application_tariff (tariff_id)');
        $this->addSql('CREATE TABLE garb (id INT NOT NULL, date_visit TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, tech VARCHAR(255) DEFAULT NULL, addres VARCHAR(255) DEFAULT NULL, dop_inform VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE service (id INT NOT NULL, name VARCHAR(255) NOT NULL, type INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tariff (id INT NOT NULL, service_id INT DEFAULT NULL, application_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, price INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9465207DED5CA9E6 ON tariff (service_id)');
        $this->addSql('CREATE INDEX IDX_9465207D3E030ACD ON tariff (application_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, surname VARCHAR(255) DEFAULT NULL, patronymic VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, name_org VARCHAR(255) DEFAULT NULL, type INT DEFAULT NULL, pass_serias VARCHAR(255) DEFAULT NULL, pass_number VARCHAR(255) DEFAULT NULL, index VARCHAR(255) DEFAULT NULL, locality VARCHAR(255) DEFAULT NULL, district VARCHAR(255) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, house VARCHAR(255) DEFAULT NULL, apartment VARCHAR(255) DEFAULT NULL, ur_address VARCHAR(255) DEFAULT NULL, post_address VARCHAR(255) DEFAULT NULL, pay_acc VARCHAR(255) DEFAULT NULL, inn VARCHAR(255) DEFAULT NULL, kpp VARCHAR(255) DEFAULT NULL, bik VARCHAR(255) DEFAULT NULL, trust_pers VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC17E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC19BE8E1EF FOREIGN KEY (garb_id) REFERENCES garb (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE application_tariff ADD CONSTRAINT FK_24562CB83E030ACD FOREIGN KEY (application_id) REFERENCES application (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE application_tariff ADD CONSTRAINT FK_24562CB892348FD2 FOREIGN KEY (tariff_id) REFERENCES tariff (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tariff ADD CONSTRAINT FK_9465207DED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tariff ADD CONSTRAINT FK_9465207D3E030ACD FOREIGN KEY (application_id) REFERENCES application (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql("insert into public.service (id, name, type)
values  (2, 'Виртуальная АТС', 2),
        (1, 'ТВ для сферы услуг', 2),
        (3, 'Интернет в офис', 2),
        (4, 'Wi-Fi для гостей', 2),
        (5, 'Видеонаблюдение', 2),
        (6, 'Домашний телефон', 1),
        (7, 'Домашний интернет', 1),
        (8, 'Интерактивное ТВ (+ интернет)', 1);");
        $this->addSql("insert into public.tariff (id, service_id, name, description, price, application_id)
values  (1, 1, '«Для сферы услуг» – 600 руб./мес.', 'Основной пакет (до 77 каналов)', 600, null),
        (24, 7, '«Игровой» – 950 руб./мес.', 'Безлимитный интернет (500 Мбит/с)
Игровые бонусы от VK Play, Lesta Games, Фогейм
', 950, null),
        (2, 1, '«Для сферы услуг +» – 1200 руб./мес.', 'Основной пакет (до 105 каналов)', 1200, null),
        (3, 2, '«3 рабочих места без пакета минут» – 500 руб./мес.', 'Многоканальный номер АВС
Детализация звонков
Распределение вызовов
Мобильные рабочие места
', 500, null),
        (4, 2, '«3 рабочих места и 250 минут» – 800 руб./мес.', 'Многоканальный номер АВС
Детализация звонков
Распределение вызовов
Мобильные рабочие места
', 800, null),
        (5, 2, '«5 рабочих места и 600 минут» – 1200 руб./мес.', 'Многоканальный номер АВС
Детализация звонков
Распределение вызовов
Мобильные рабочие места
', 1200, null),
        (6, 2, '«10 рабочих места и 1200 минут» – 2000 руб./мес.', 'Многоканальный номер АВС
Детализация звонков
Распределение вызовов
Мобильные рабочие места
', 2000, null),
        (7, 2, '«15 рабочих места и 3000 минут» – 5000 руб./мес.', 'Многоканальный номер АВС
Детализация звонков
Распределение вызовов
Мобильные рабочие места
Аналитика и дашборды
Запись разговоров
Виртуальный контактный центр

', 5000, null),
        (8, 3, '«До 5 рабочих мест» – 1000 руб./мес.', 'Безлимитный интернет (100 Мбит/с)
', 1000, null),
        (9, 3, '«От 6 до 20 рабочих мест» – 1500 руб./мес.', 'Безлимитный интернет (300 Мбит/с)
', 1500, null),
        (10, 3, '«Свыше 20 рабочих мест» – 2500 руб./мес.', 'Безлимитный интернет (500 Мбит/с)
', 2500, null),
        (11, 4, '«Начальный» – 700 руб./мес.', 'Авторизация
	по СМС
	по номеру 8 800
	через Госуслуги
', 700, null),
        (12, 4, '«Улучшенный» – 1600 руб./мес.', 'Авторизация
	по СМС
	по номеру 8 800
	через Госуслуги
Аренда роутера
', 1600, null),
        (13, 4, '«Расширенный» – 2700 руб./мес.', 'Авторизация
	по СМС
	по номеру 8 800
	через Госуслуги
Аренда роутера
Рекламная платформа', 2700, null),
        (14, 5, '«Просмотр видео онлайн» – 200 руб./мес.', null, 200, null),
        (15, 5, '«Хранение записей 3 суток» – 300 руб./мес.', 'Доступно к выгрузке в месяц (10 клипов)
Хранятся на сервере (5 клипов)
Неудаляемых закладок (10 минут)
', 300, null),
        (16, 5, '«Хранение записей 7 суток» – 450 руб./мес.', 'Доступно к выгрузке в месяц (20 клипов)
Хранятся на сервере (10 клипов)
Неудаляемых закладок (30 минут)
', 450, null),
        (17, 5, '«Хранение записей 14 суток» – 600 руб./мес.', 'Доступно к выгрузке в месяц (30 клипов)
Хранятся на сервере (20 клипов)
Неудаляемых закладок (60 минут)
', 600, null),
        (18, 5, '«Хранение записей 30 суток» – 900 руб./мес.', 'Доступно к выгрузке в месяц (40 клипов)
Хранятся на сервере (20 клипов)
Неудаляемых закладок (120 минут)
', 900, null),
        (19, 6, '«Безлимитный» (Безлимитные звонки на местные городские номера) – 515 руб./мес.', null, 515, null),
        (20, 6, '«Повременный» (Безлимитные звонки на местные городские номера 0.66 руб./мес.) – 209 руб./мес.', null, 209, null),
        (23, 7, '«Технологии доступа. Макси 300» – 600 руб./мес.', 'Безлимитный интернет (300 Мбит/с)

', 600, null),
        (22, 7, '«Технологии доступа. Макси 200» – 550 руб./мес.', 'Безлимитный интернет (200 Мбит/с)

', 550, null),
        (21, 7, '«Технологии доступа»– 500 руб./мес.', 'Безлимитный интернет (100 Мбит/с)
Облако Mail.ru + 8 Гб

', 500, null),
        (25, 8, '«Технологии развлечения» – 699 руб./мес.', 'Безлимитный интернет (100 Мбит/с)
Интерактивное ТВ (188 каналов)
Облако Mail.ru + 8 Гб

', 699, null),
        (26, 8, '«Технологии выгоды+» – 949 руб./мес.', 'Безлимитный интернет (100 Мбит/с)
Интерактивное ТВ (188 каналов)
Мобильная связь (50 Гб/1200 мин/500 СМС/ до 5 сим-карт)
Облако Mail.ru + 8 Гб

', 949, null),
        (27, 8, '«Комбо Игровой 4в1» – 1400 руб./мес.', 'Безлимитный интернет (500 Мбит/с)
Интерактивное ТВ (188 каналов)
Мобильная связь (50 Гб/1200 мин/500 СМС)
Игровые бонусы от VK Play, Lesta Games, Фогейм
Облако Mail.ru


', 1400, null);");

    }


    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE application_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE garb_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE service_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tariff_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE application DROP CONSTRAINT FK_A45BDDC17E3C61F9');
        $this->addSql('ALTER TABLE application DROP CONSTRAINT FK_A45BDDC19BE8E1EF');
        $this->addSql('ALTER TABLE application_tariff DROP CONSTRAINT FK_24562CB83E030ACD');
        $this->addSql('ALTER TABLE application_tariff DROP CONSTRAINT FK_24562CB892348FD2');
        $this->addSql('ALTER TABLE tariff DROP CONSTRAINT FK_9465207DED5CA9E6');
        $this->addSql('ALTER TABLE tariff DROP CONSTRAINT FK_9465207D3E030ACD');
        $this->addSql('DROP TABLE application');
        $this->addSql('DROP TABLE application_tariff');
        $this->addSql('DROP TABLE garb');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE tariff');
        $this->addSql('DROP TABLE "user"');
    }
}
