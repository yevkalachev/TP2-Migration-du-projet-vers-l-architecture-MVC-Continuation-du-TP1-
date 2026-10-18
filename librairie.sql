-- ============================================================
-- Script SQL complet - Projet Librairie (Version Finale)
-- Architecture : 4 tables (Auteur, Categorie, Livre, Livre_Categorie)
-- ============================================================

DROP DATABASE IF EXISTS librairie;
CREATE DATABASE librairie DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE librairie;

-- ------------------------------------------------------------
-- Table `auteur`
-- ------------------------------------------------------------
CREATE TABLE auteur (
    id     INT NOT NULL AUTO_INCREMENT,
    nom    VARCHAR(45) NOT NULL,
    prenom VARCHAR(45) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Table `categorie`
-- ------------------------------------------------------------
CREATE TABLE categorie (
    id  INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(45) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Table `livre` (Relation 1-N avec auteur)
-- ------------------------------------------------------------
CREATE TABLE livre (
    id        INT NOT NULL AUTO_INCREMENT,
    titre     VARCHAR(150) NOT NULL,
    annee     INT NULL,
    prix      DECIMAL(10,2) NULL,
    id_auteur INT NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_livre_auteur 
        FOREIGN KEY (id_auteur) REFERENCES auteur (id) 
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Table `livre_categorie` (Relation N-N)
-- ------------------------------------------------------------
CREATE TABLE livre_categorie (
    id_livre     INT NOT NULL,
    id_categorie INT NOT NULL,
    PRIMARY KEY (id_livre, id_categorie),
    CONSTRAINT fk_lc_livre 
        FOREIGN KEY (id_livre) REFERENCES livre (id) 
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_lc_categorie 
        FOREIGN KEY (id_categorie) REFERENCES categorie (id) 
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

INSERT INTO auteur (nom, prenom) VALUES 
('Hugo', 'Victor'),
('Camus', 'Albert'),
('Orwell', 'George'),
('Rowling', 'J.K.');


INSERT INTO categorie (nom) VALUES 
('Roman'),
('Classique'),
('Science-Fiction'),
('Fantasy');


INSERT INTO livre (titre, annee, prix, id_auteur) VALUES 
('Les Misérables', 1862, 12.50, 1),
('L''Étranger', 1942, 8.90, 2),
('1984', 1949, 10.50, 3),
('Harry Potter à l''école des sorciers', 1997, 15.90, 4),
('La Peste', 1947, 9.50, 2);


INSERT INTO livre_categorie (id_livre, id_categorie) VALUES 
(1, 1), (1, 2),  -- Les Misérables : Roman, Classique
(2, 1), (2, 2),  -- L'Étranger : Roman, Classique
(3, 1), (3, 3),  -- 1984 : Roman, Science-Fiction
(4, 4),          -- Harry Potter : Fantasy
(5, 1), (5, 2);  -- La Peste : Roman, Classique

