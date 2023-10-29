CREATE DATABASE IF NOT EXISTS flamesdb;

USE flamesdb;

CREATE TABLE IF NOT EXISTS system_user (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    birthday DATE NOT NULL,
    street_line_1 VARCHAR(255) NOT NULL,
    street_line_2 VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    state VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    date_created DATETIME NOT NULL
);

CREATE TABLE IF NOT EXISTS zodiac (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    zodiac_sign VARCHAR(255) NOT NULL UNIQUE,
    symbol VARCHAR(255) NOT NULL UNIQUE,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS zodiac_chart_array (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    aries INT(1) NOT NULL,
    leo INT(1) NOT NULL,
    sagittarius INT(1) NOT NULL,
    taurus INT(1) NOT NULL,
    virgo INT(1) NOT NULL,
    capricornus INT(1) NOT NULL,
    gemini INT(1) NOT NULL,
    libra INT(1) NOT NULL,
    aquarius INT(1) NOT NULL,
    cancer INT(1) NOT NULL,
    scorpio INT(1) NOT NULL,
    pisces INT(1) NOT NULL
);

INSERT INTO zodiac (zodiac_sign, symbol, start_date, end_date) VALUES ('Aries', 'Ram', '1000-3-21', '1000-4-19');
INSERT INTO zodiac (zodiac_sign, symbol, start_date, end_date) VALUES ('Taurus', 'Bull', '1000-4-20', '1000-5-20');
INSERT INTO zodiac (zodiac_sign, symbol, start_date, end_date) VALUES ('Gemini', 'Twins', '1000-5-21', '1000-6-21');
INSERT INTO zodiac (zodiac_sign, symbol, start_date, end_date) VALUES ('Cancer', 'Crab', '1000-6-22', '1000-7-22');
INSERT INTO zodiac (zodiac_sign, symbol, start_date, end_date) VALUES ('Leo', 'Lion', '1000-7-23', '1000-8-22');
INSERT INTO zodiac (zodiac_sign, symbol, start_date, end_date) VALUES ('Virgo', 'Virgin', '1000-8-23', '1000-9-22');
INSERT INTO zodiac (zodiac_sign, symbol, start_date, end_date) VALUES ('Libra', 'Balance', '1000-9-23', '1000-10-23');
INSERT INTO zodiac (zodiac_sign, symbol, start_date, end_date) VALUES ('Scorpio', 'Scorpion', '1000-10-24', '1000-11-21');
INSERT INTO zodiac (zodiac_sign, symbol, start_date, end_date) VALUES ('Sagittarius', 'Archer', '1000-11-22', '1000-12-21');
INSERT INTO zodiac (zodiac_sign, symbol, start_date, end_date) VALUES ('Capricornus', 'Goat', '1000-12-22', '1000-1-19');
INSERT INTO zodiac (zodiac_sign, symbol, start_date, end_date) VALUES ('Aquarius', 'Water Bearer', '1000-1-20', '1000-2-18');
INSERT INTO zodiac (zodiac_sign, symbol, start_date, end_date) VALUES ('Pisces', 'Fish', '1000-2-19', '1000-3-20');

INSERT INTO zodiac_chart_array (aries, leo, sagittarius, taurus, virgo, capricornus, gemini, libra, aquarius, cancer, scorpio, pisces) 
    VALUES (1, 1, 1, 3, 3, 3, 1, 1, 1, 3, 3, 2);
INSERT INTO zodiac_chart_array (aries, leo, sagittarius, taurus, virgo, capricornus, gemini, libra, aquarius, cancer, scorpio, pisces)
    VALUES (1, 1, 1, 3, 3, 3, 1, 1, 1, 2, 2, 2);
INSERT INTO zodiac_chart_array (aries, leo, sagittarius, taurus, virgo, capricornus, gemini, libra, aquarius, cancer, scorpio, pisces)
    VALUES (1, 1, 1, 3, 3, 3, 1, 1, 1, 2, 2, 2);
INSERT INTO zodiac_chart_array (aries, leo, sagittarius, taurus, virgo, capricornus, gemini, libra, aquarius, cancer, scorpio, pisces)
    VALUES (3, 2, 3, 1, 1, 1, 3, 2, 3, 1, 1 ,1);
INSERT INTO zodiac_chart_array (aries, leo, sagittarius, taurus, virgo, capricornus, gemini, libra, aquarius, cancer, scorpio, pisces)
    VALUES (3, 2, 3, 1, 1, 1, 3, 3, 2, 1, 1, 2);
INSERT INTO zodiac_chart_array (aries, leo, sagittarius, taurus, virgo, capricornus, gemini, libra, aquarius, cancer, scorpio, pisces)
    VALUES (3, 2, 3, 1, 1, 1, 3, 2, 3, 1, 1 ,1);
INSERT INTO zodiac_chart_array (aries, leo, sagittarius, taurus, virgo, capricornus, gemini, libra, aquarius, cancer, scorpio, pisces)
    VALUES (1, 1, 2, 3, 2, 2, 1, 1, 1, 3, 3, 3);
INSERT INTO zodiac_chart_array (aries, leo, sagittarius, taurus, virgo, capricornus, gemini, libra, aquarius, cancer, scorpio, pisces)
    VALUES (2, 1, 1, 2, 3, 3, 1, 1, 1, 3, 3, 2);
INSERT INTO zodiac_chart_array (aries, leo, sagittarius, taurus, virgo, capricornus, gemini, libra, aquarius, cancer, scorpio, pisces)
    VALUES (1, 1, 1, 3, 3, 3, 1, 1, 1, 3, 2, 2);
INSERT INTO zodiac_chart_array (aries, leo, sagittarius, taurus, virgo, capricornus, gemini, libra, aquarius, cancer, scorpio, pisces)
    VALUES (3, 2, 2, 1, 1, 1, 3, 3, 3, 1, 1, 1);
INSERT INTO zodiac_chart_array (aries, leo, sagittarius, taurus, virgo, capricornus, gemini, libra, aquarius, cancer, scorpio, pisces)
    VALUES (2, 2, 3, 1, 1, 1, 3, 3, 3, 1, 1, 1);
INSERT INTO zodiac_chart_array (aries, leo, sagittarius, taurus, virgo, capricornus, gemini, libra, aquarius, cancer, scorpio, pisces)
    VALUES (2, 2, 2, 1, 2, 1, 3, 3, 3, 1, 1, 1);

CREATE TABLE IF NOT EXISTS prospect (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    birthday DATE NOT NULL,
    zodiac_sign VARCHAR(255),
    user_id INT(11),
    FOREIGN KEY (user_id) REFERENCES system_user(id)
);