<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241211132306 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id SERIAL NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE article (id SERIAL NOT NULL, title VARCHAR(255) NOT NULL, body VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE game (id SERIAL NOT NULL, team_one_id INT NOT NULL, team_two_id INT NOT NULL, score_one INT NOT NULL, score_two INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_232B318C8D8189CA ON game (team_one_id)');
        $this->addSql('CREATE INDEX IDX_232B318CE6DD6E05 ON game (team_two_id)');
        $this->addSql('CREATE TABLE incident (id SERIAL NOT NULL, type VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE player (id SERIAL NOT NULL, team_id INT DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_98197A65296CD8AE ON player (team_id)');
        $this->addSql('CREATE TABLE player_incident (player_id INT NOT NULL, incident_id INT NOT NULL, PRIMARY KEY(player_id, incident_id))');
        $this->addSql('CREATE INDEX IDX_3BD4E0FA99E6F5DF ON player_incident (player_id)');
        $this->addSql('CREATE INDEX IDX_3BD4E0FA59E53FB9 ON player_incident (incident_id)');
        $this->addSql('CREATE TABLE team (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, wins INT NOT NULL, loses INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C8D8189CA FOREIGN KEY (team_one_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CE6DD6E05 FOREIGN KEY (team_two_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player_incident ADD CONSTRAINT FK_3BD4E0FA99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player_incident ADD CONSTRAINT FK_3BD4E0FA59E53FB9 FOREIGN KEY (incident_id) REFERENCES incident (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318C8D8189CA');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318CE6DD6E05');
        $this->addSql('ALTER TABLE player DROP CONSTRAINT FK_98197A65296CD8AE');
        $this->addSql('ALTER TABLE player_incident DROP CONSTRAINT FK_3BD4E0FA99E6F5DF');
        $this->addSql('ALTER TABLE player_incident DROP CONSTRAINT FK_3BD4E0FA59E53FB9');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE incident');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE player_incident');
        $this->addSql('DROP TABLE team');
    }
}
