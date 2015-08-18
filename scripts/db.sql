DROP DATABASE apply_gladys;

CREATE DATABASE apply_gladys;
USE apply_gladys;

CREATE TABLE fiches
(
	id int NOT NULL AUTO_INCREMENT,
	libelle varchar(50) NOT NULL,
	description varchar(255),

	PRIMARY KEY (id)
);

CREATE TABLE categories
(
	id int NOT NULL AUTO_INCREMENT,
	libelle varchar(50),

	PRIMARY KEY (id)
);

CREATE TABLE fiches_categories
(
	fiche_id int NOT NULL,
	categorie_id int NOT NULL,

	PRIMARY KEY (fiche_id, categorie_id),
	FOREIGN KEY (fiche_id) REFERENCES fiches(id),
	FOREIGN KEY (categorie_id) REFERENCES categories(id)
);

CREATE TABLE categories_categories
(
	mere_id int NOT NULL,
	fille_id int NOT NULL,

	FOREIGN KEY (mere_id) REFERENCES categories(id),
	FOREIGN KEY (fille_id) REFERENCES categories(id)
);

INSERT INTO fiches(id, libelle, description) values(1, "Lorem", "ipsum dolor sit amet");
INSERT INTO fiches(id, libelle, description) values(2, "consectetur", "adipiscing elit");
INSERT INTO fiches(id, libelle, description) values(3, "Donec eget", "tempus urna, vel gravida enim");

INSERT INTO categories(id, libelle) values(1, "Nam");
INSERT INTO categories(id, libelle) values(2, "faucibus");
INSERT INTO categories(id, libelle) values(3, "massa");
INSERT INTO categories(id, libelle) values(4, "at est");

INSERT INTO fiches_categories(fiche_id, categorie_id) values(1, 1);
INSERT INTO fiches_categories(fiche_id, categorie_id) values(1, 2);
INSERT INTO fiches_categories(fiche_id, categorie_id) values(2, 1);
INSERT INTO fiches_categories(fiche_id, categorie_id) values(2, 3);
INSERT INTO fiches_categories(fiche_id, categorie_id) values(3, 4);

INSERT INTO categories_categories(mere_id, fille_id) values(1, 2);
INSERT INTO categories_categories(mere_id, fille_id) values(1, 3);
INSERT INTO categories_categories(mere_id, fille_id) values(2, 4);