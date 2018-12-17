<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181209101628 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE moviesDirector (movies_id INT NOT NULL, people_id INT NOT NULL, INDEX IDX_F6E47CC853F590A4 (movies_id), INDEX IDX_F6E47CC83147C936 (people_id), PRIMARY KEY(movies_id, people_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE moviesWriter (movies_id INT NOT NULL, people_id INT NOT NULL, INDEX IDX_E0DC0A3653F590A4 (movies_id), INDEX IDX_E0DC0A363147C936 (people_id), PRIMARY KEY(movies_id, people_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE moviesActor (movies_id INT NOT NULL, people_id INT NOT NULL, INDEX IDX_3F9774F853F590A4 (movies_id), INDEX IDX_3F9774F83147C936 (people_id), PRIMARY KEY(movies_id, people_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movies_genre (movies_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_F8B211F953F590A4 (movies_id), INDEX IDX_F8B211F94296D31F (genre_id), PRIMARY KEY(movies_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre_genre (genre_source INT NOT NULL, genre_target INT NOT NULL, INDEX IDX_3E562C3DB4394F53 (genre_source), INDEX IDX_3E562C3DADDC1FDC (genre_target), PRIMARY KEY(genre_source, genre_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE moviesDirector ADD CONSTRAINT FK_F6E47CC853F590A4 FOREIGN KEY (movies_id) REFERENCES movies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE moviesDirector ADD CONSTRAINT FK_F6E47CC83147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE moviesWriter ADD CONSTRAINT FK_E0DC0A3653F590A4 FOREIGN KEY (movies_id) REFERENCES movies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE moviesWriter ADD CONSTRAINT FK_E0DC0A363147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE moviesActor ADD CONSTRAINT FK_3F9774F853F590A4 FOREIGN KEY (movies_id) REFERENCES movies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE moviesActor ADD CONSTRAINT FK_3F9774F83147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movies_genre ADD CONSTRAINT FK_F8B211F953F590A4 FOREIGN KEY (movies_id) REFERENCES movies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movies_genre ADD CONSTRAINT FK_F8B211F94296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_genre ADD CONSTRAINT FK_3E562C3DB4394F53 FOREIGN KEY (genre_source) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_genre ADD CONSTRAINT FK_3E562C3DADDC1FDC FOREIGN KEY (genre_target) REFERENCES genre (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE moviesDirector');
        $this->addSql('DROP TABLE moviesWriter');
        $this->addSql('DROP TABLE moviesActor');
        $this->addSql('DROP TABLE movies_genre');
        $this->addSql('DROP TABLE genre_genre');
    }
}
