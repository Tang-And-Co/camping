CREATE TABLE image (
    id INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    url VARCHAR(512) NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO image (nom, url) VALUES ("logo", "img/logo.png");
INSERT INTO image (nom, url) VALUES ("gerante", "img/gerante.png");
INSERT INTO image (nom, url) VALUES ("tente1", "https://www.lesoleilfruite.com/ressources/medias/240-editeur_page_bloc_element-emplacement-tente-caravane-1600x851.jpg");
INSERT INTO image (nom, url) VALUES ("camping-car1", "https://www.lapascalinette.fr/wp-content/uploads/2023/07/Emplacement-CONFORT-standard-camping-pascalinette-1920x1080.jpg");
INSERT INTO image (nom, url) VALUES ("bungalow1", "https://www.green-resort.com/wp-content/uploads/2019/12/Sans-titre-5.jpg");

-- INSERT INTO image (nom, url) VALUES ("", "");
