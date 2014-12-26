/*
	Table representant une huile.
*/

CREATE TABLE huiles(
	id_huile MEDIUMINT NOT NULL AUTO_INCREMENT,
	nom_huile VARCHAR(100) NOT NULL,
	nom_latin VARCHAR(100)NOT NULL,
	id_famille MEDIUMINT,
	origine_geo TEXT NOT NULL,
	conseils TEXT,
	indications TEXT,
	message_energitique TEXT,
	image TINYTEXT,
	video TINYTEXT,
	PRIMARY KEY (id_huile),
	UNIQUE KEY(nom_huile),
	FOREIGN KEY (id_famille) REFERENCES familles(id_famille)
	);

/*
	Table representant les familles des huiles essentielles.
*/
CREATE TABLE familles(
	id_famille MEDIUMINT NOT NULL AUTO_INCREMENT,
	nom_famille VARCHAR(100),
	PRIMARY KEY (id_famille),
	UNIQUE KEY(nom_famille)
	);



/*
	Table representant la liste des propriétés possibles d'une huile essentielle.
*/

CREATE TABLE proprietes(
	id_propriete MEDIUMINT NOT NULL AUTO_INCREMENT,
	nom_propriete VARCHAR(100),
	PRIMARY KEY (id_propriete),
	UNIQUE KEY(nom_propriete)
	);
INSERT INTO proprietes (nom_propriete) VALUES ('Propriete 1'),('Propriete 2'),('Propriete 3'),('Propriete 4'),('Propriete 5');
/*
	Table representant la liste des organes producteurs d'une huile essentielle.
*/

CREATE TABLE organes(
	id_organe MEDIUMINT NOT NULL AUTO_INCREMENT,
	nom_organe VARCHAR(100),
	PRIMARY KEY (id_organe),
	UNIQUE KEY(nom_organe)
	);
INSERT INTO organes (nom_organe) VALUES ('Organe 1'),('Organe 2'),('Organe 3'),('Organe 4'),('Organe 5');

/*
	Table representant les differents notations que peut avoir une propriété d'une huile essentielle, on a initialement 4 notations.
*/
CREATE TABLE notations(
	id_notation MEDIUMINT NOT NULL AUTO_INCREMENT,
	signe_notation VARCHAR(100),
	PRIMARY KEY (id_notation),
	UNIQUE KEY(signe_notation)
	);
INSERT INTO notations (signe_notation) VALUES ('+'),('++'),('+++'),('++++');

/*
	Table representant la liste des constituants possibles d'une huile essentielle.
*/

CREATE TABLE constituants(
	id_constituant MEDIUMINT NOT NULL AUTO_INCREMENT,
	nom_constituant VARCHAR(100),
	PRIMARY KEY (id_constituant),
	UNIQUE KEY(nom_constituant)
	);
INSERT INTO constituants (nom_constituant) VALUES ('Constituant 1'),('Constituant 2'),('Constituant 3'),('Constituant 4'),('Constituant 5');
/*
	Table qui representra les modes d'emploi d'une huile essentielle, cette table contiendra 3 lignes.
*/
CREATE TABLE modeEmploi(
	id_modeEmploi MEDIUMINT NOT NULL AUTO_INCREMENT,
	nom_modeEmploi VARCHAR(100),
	PRIMARY KEY (id_modeEmploi),
	UNIQUE KEY(nom_modeEmploi)
	);
INSERT INTO modeEmploi (nom_modeEmploi) VALUES ('Voie cutanée'),('Voie orale'),('En diffusion');
/*
	La table qui representera la relation "a comme propriété et tel est sa notation" entre une huile et une propriété et sa notation.
*/
CREATE TABLE huiles_proprietes(
	id_huile MEDIUMINT NOT NULL,
	id_propriete MEDIUMINT NOT NULL,
	id_notation MEDIUMINT NOT NULL,
	FOREIGN KEY (id_huile) REFERENCES huiles(id_huile),
	FOREIGN KEY (id_propriete) REFERENCES proprietes(id_propriete),
	FOREIGN KEY (id_notation) REFERENCES notations(id_notation)
	);

/*
	La table qui va representer la relation "a comme organe producteur" entre une huile de la table huiles et un organe de la table organes.
*/
CREATE TABLE huiles_organes(
	id_huile MEDIUMINT NOT NULL,
	id_organe MEDIUMINT NOT NULL,
	FOREIGN KEY (id_huile) REFERENCES huiles(id_huile),
	FOREIGN KEY (id_organe) REFERENCES organes(id_organe)
	);

/*
	La table qui va representer la relation "a comme constituant de tel pourcentage" entre une huile et un constituant.
*/
CREATE TABLE huiles_constituants(
	id_huile MEDIUMINT NOT NULL,
	id_constituant MEDIUMINT NOT NULL,
	pourcentage TINYINT NOT NULL,
	FOREIGN KEY (id_huile) REFERENCES huiles(id_huile),
	FOREIGN KEY (id_constituant) REFERENCES constituants(id_constituant)
	);

/*
	La table representant la relation "a un/de tel(s) mode d'emploi" entre une huile et un mode d'emploi.
*/

CREATE TABLE huiles_modeEmploi(
	id_huile MEDIUMINT NOT NULL,
	id_modeEmploi MEDIUMINT NOT NULL,
	FOREIGN KEY (id_huile) REFERENCES huiles(id_huile),
	FOREIGN KEY (id_modeEmploi) REFERENCES modeEmploi(id_modeEmploi)
	);
/*
	La table qui va représenter un traitement.
*/

CREATE TABLE traitements(
	id_traitement MEDIUMINT NOT NULL AUTO_INCREMENT,
	nom_traitement VARCHAR(100) NOT NULL,
	Desc_traitement TEXT NOT NULL,
	id_modalite MEDIUMINT NOT NULL,
	image TINYTEXT,
	video TINYTEXT,
	PRIMARY KEY (id_traitement),
	UNIQUE KEY(nom_traitement),
	FOREIGN KEY (id_modalite) REFERENCES modalites(id_modalite)
	);
/*
	La table de pathologies.
*/

CREATE TABLE pathologies(
	id_pathologie MEDIUMINT NOT NULL AUTO_INCREMENT,
	nom_pathologie VARCHAR(100) NOT NULL,
	UNIQUE KEY(nom_pathologie),
	PRIMARY KEY (id_pathologie)	
	);
INSERT INTO pathologies (nom_pathologie) VALUES ('Pathologie 1'),('Pathologie 2'),('Pathologie 3'),('Pathologie 4'),('Pathologie 5');
/*
	La table qui representera les modalités (3 au total).
*/
CREATE TABLE modalites(
	id_modalite MEDIUMINT NOT NULL AUTO_INCREMENT,
	nom_modalite VARCHAR(100) NOT NULL,
	UNIQUE KEY(nom_modalite),
	PRIMARY KEY (id_modalite)	
	);
INSERT INTO modalites (nom_modalite) VALUES ('Voie cutanée'),('Voie orale'),('En diffusion');
/*
	La table qui fera la relation "a comme pathologie" entre une huile et une pathologie.
*/
CREATE TABLE traitements_pathologies(
	id_traitement MEDIUMINT NOT NULL,
	id_pathologie MEDIUMINT NOT NULL,
	FOREIGN KEY (id_traitement) REFERENCES traitements(id_traitement),
	FOREIGN KEY (id_pathologie) REFERENCES pathologies(id_pathologie)
	);

