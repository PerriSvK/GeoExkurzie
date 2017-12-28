CREATE TABLE g_users
(
    name varchar(100) PRIMARY KEY NOT NULL,
    pass text NOT NULL
);
INSERT INTO g_users (name, pass) VALUES ('admin', '56b1db8133d9eb398aabd376f07bf8ab5fc584ea0b8bd6a1770200cb613ca005');