CREATE TABLE zajazdy
(
    hash varchar(5) PRIMARY KEY NOT NULL,
    meno varchar(50) NOT NULL,
    cena int(6) NOT NULL,
    od datetime,
    do datetime NOT NULL,
    doprava int(4) NOT NULL,
    popis mediumtext NOT NULL,
    kapacita int(3) NOT NULL,
    ubytovanie varchar(255) NOT NULL,
    trvanie int(3) NOT NULL,
    lokacia varchar(150) NOT NULL
);
INSERT INTO zajazdy (hash, meno, cena, od, do, doprava, popis, kapacita, ubytovanie, trvanie, lokacia) VALUES ('00000', 'HAhaHAha', 666, '2017-12-06 18:23:15', '2017-12-13 15:23:32', 0, 'GeoExkurzie', 66, 'Bus', 6, 'Cesta');
INSERT INTO zajazdy (hash, meno, cena, od, do, doprava, popis, kapacita, ubytovanie, trvanie, lokacia) VALUES ('hdhas', 'Ksfasffaa', 1041, '2017-12-07 15:00:00', '2017-12-28 11:00:00', 0, 'ôsjfkôalhfsf hsjghsjdgsdhjgkjsahgsjkdgk jjdsgshj jdg ds ghjds hgjds jhsdgksga had', 21, 'niekde', 5, 'Tam');