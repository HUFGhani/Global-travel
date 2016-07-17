
-- DROP TABLES

DROP TABLE IF EXISTS payment_details;
DROP TABLE IF EXISTS invoice;
DROP TABLE IF EXISTS booking_attractions;
DROP TABLE IF EXISTS booking;
DROP TABLE IF EXISTS customer;
DROP TABLE IF EXISTS production;
DROP TABLE IF EXISTS theatre;
DROP TABLE IF EXISTS sight_seeing;
DROP TABLE IF EXISTS theme_park;
DROP TABLE IF EXISTS attractions; 
DROP TABLE IF EXISTS employee; 
DROP TABLE IF EXISTS city;
DROP TABLE IF EXISTS country;

-- CREATE TABLES
CREATE TABLE country (
	country_id VARCHAR(3) NOT NULL,
	country_name VARCHAR(30) NOT NULL,
	country_website VARCHAR(50) NOT NULL,
	PRIMARY KEY(country_id)
);


CREATE TABLE city(
	city_id VARCHAR(3)  NOT NULL,
	city_name VARCHAR(20) NOT NULL,
	city_website VARCHAR(50) NOT NULL,
	country_id_fk VARCHAR(3) NOT NULL,
	PRIMARY KEY (city_id),
	FOREIGN KEY (country_id_fk) REFERENCES country(country_id)
);

CREATE TABLE employee(
	emp_id INT NOT NULL AUTO_INCREMENT,
	emp_forename VARCHAR(30) NOT NULL,
	emp_surname VARCHAR(30)NOT NULL,
	emp_email VARCHAR(50) NOT NULL UNIQUE,
	emp_address VARCHAR(50) NOT NULL,
	emp_town VARCHAR(20) NOT NULL,
	emp_postcode VARCHAR(8) NOT NULL,
	emp_tel VARCHAR(11), 
	emp_salary DECIMAL(7,2),
	emp_job_descript VARCHAR(30) NOT NULL,
	emp_password VARCHAR(20) NOT NULL,
	emp_hire_date DATE NOT NULL,
	mng_id INT,
	PRIMARY KEY(emp_id),
	FOREIGN KEY (mng_id) REFERENCES employee(emp_id)
);

CREATE TABLE attractions(
	attract_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	city_id_fk varchar(3) NOT NULL,
	emp_id_fk INT NOT NULL,
	description VARCHAR(600),
	attract_name VARCHAR(50) NOT NULL,
	attract_website VARCHAR(50),
	attract_phone VARCHAR(11),
	attract_extra_info VARCHAR(600),
	attract_adult_price DECIMAL (4,2) NOT NULL,
	attract_child_price DECIMAL(4,2) NOT NULL,
	attract_student_price DECIMAL (4,2) NOT NULL,
	attract_senior_price DECIMAL (4,2) NOT NULL,
	FOREIGN KEY (city_id_fk) REFERENCES city(city_id),
	FOREIGN KEY (emp_id_fk) REFERENCES employee(emp_id)
);

CREATE TABLE `theme_park` (
	`attract_id_fk` INT NOT NULL,
	`opening_time` time(6) NOT NULL,
	`close_time` time(6) NOT NULL,
	`rides_quantity` int(3) NOT NULL,
	KEY `attract_id_fk` (`attract_id_fk`),
	CONSTRAINT `theme_park_ibfk_1` FOREIGN KEY (`attract_id_fk`)
	REFERENCES `attractions` (`attract_id`)
);


CREATE TABLE `sight_seeing` (
	`attract_id_fk`INT NOT NULL,
	`ss_opening_time` time(6) NOT NULL,
	`ss_close_time` time(6) NOT NULL,
	KEY `attract_id_fk` (`attract_id_fk`),
	CONSTRAINT `sight_seeing_ibfk_1` FOREIGN KEY (`attract_id_fk`) 
	REFERENCES `attractions` (`attract_id`)
);

CREATE TABLE theatre(
	theatre_id INT  PRIMARY KEY AUTO_INCREMENT NOT NULL,
	theatre_address VARCHAR(50) NOT NULL,
	theatre_seats INT(4) NOT NULL,
	theatre_name VARCHAR(30) NOT NULL,
	theatre_postcode VARCHAR(8) NOT NULL
);


CREATE TABLE production(
	attract_id_ck INT NOT NULL,
	theatre_id_ck INT NOT NULL,
	rating INT(1) CHECK( rating < 5),
	duration INT(3) NOT NULL,
	start_time TIME(6) NOT NULL,
	doors_open TIME(6) NOT NULL,
	PRIMARY KEY (attract_id_ck, theatre_id_ck),
	FOREIGN KEY (theatre_id_ck) REFERENCES theatre(theatre_id)

);

CREATE TABLE customer (
	cust_id INT NOT NULL AUTO_INCREMENT,
	cust_forename VARCHAR(30) NOT NULL,
	cust_surname VARCHAR(30) NOT NULL,
	cust_title VARCHAR(4) NOT NULL,
	cust_address VARCHAR(50) NOT NULL,
	cust_postcode VARCHAR(8) NOT NULL,
	cust_tel VARCHAR(11) NOT NULL,
	cust_email VARCHAR(50) NOT NULL CHECK (cust_email LIKE '%@%.%'),
	cust_DOB DATE NOT NULL,
	cust_town VARCHAR(20) NOT NULL,
	cust_password VARCHAR(20),
	cust_join_date TIMESTAMP DEFAULT NOW(),
	PRIMARY KEY(cust_id),
	UNIQUE(cust_email)
	);


CREATE TABLE booking(
	booking_id INT NOT NULL AUTO_INCREMENT,
	booking_date DATE NOT NULL,
	booking_adults INT(3),
	booking_children INT(3),
	booking_students INT(3),
	booking_senior INT(3),
	cust_id_fk INT NOT NULL,
	PRIMARY KEY (booking_id),
	FOREIGN KEY (cust_id_fk) REFERENCES customer(cust_id)
);

CREATE TABLE booking_attractions(
	attract_id_ck INT NOT NULL,
	booking_id_ck INT NOT NULL,
	attract_date DATE NOT NULL,
	PRIMARY KEY (attract_id_ck, booking_id_ck),
	FOREIGN KEY (booking_id_ck) REFERENCES booking(booking_id),
	FOREIGN KEY (attract_id_ck) REFERENCES attractions(attract_id)
);

CREATE TABLE invoice (
	invoice_id INT  AUTO_INCREMENT,
	booking_id_fk INT NOT NULL, 
	invoice_date DATE NOT NULL,
	invoice_total DECIMAL(7,2) CHECK(invoice_total < 9999.99),
	PRIMARY KEY (invoice_id),
	FOREIGN KEY(booking_id_fk) REFERENCES booking(booking_id)
);


CREATE TABLE payment_details (
	pay_id INT PRIMARY KEY AUTO_INCREMENT,
	cust_id_fk INT, 
	invoice_id_fk INT, 
	pay_card_type VARCHAR(20) NOT NULL,
	pay_total DECIMAL(7,2)  CHECK (pay_total < 9999.99),
	pay_date date NOT NULL,
	pay_cardNo DECIMAL(16,0) NOT NULL,
	pay_issue_no INT(2),
	pay_expiry_date DATE NOT NULL,
	pay_security_code INT(3) NOT NULL,
	pay_card_holder VARCHAR(30) NOT NULL,
	FOREIGN KEY(invoice_id_fk) REFERENCES invoice(invoice_id),
	FOREIGN KEY(cust_id_fk) REFERENCES customer(cust_id)
);


-- employee insert statements.

INSERT INTO employee(emp_forename, emp_surname, emp_email, emp_address, emp_town, emp_postcode, emp_tel, emp_salary, emp_job_descript,  emp_password, emp_hire_date, mng_id)
VALUES 
	('James', 'Smith', 'jsmith@gmail.com', '16 Holme Avenue', 'Bury', 'BL9 4JK', '07834578892', 35000.00, 'Office Manager', '1234', '2010-12-01', null),
	('Lilly', 'Hemmingway', 'lillyH@hotmail.com', '223 Tottington Road', 'Tottington', 'BL1 4JK', '07936756615', 16500.00 ,'Administrator', 'password123', '2013-01-11', 1),
	('Loala', 'Thompson', 'lola123@hotmail.com', '5 Regent Street', 'Bury', 'BL8 9OO', '07856473340', 15000.00, 'Administrator', 'anything12', '2013-01-11', 1),
	('John', 'Roberts', 'rob@aol.com', '155 Manchester Road', 'Manchester', 'M45 3AZ', '07256111238', 14500.00, 'Receptionist', 'rob22', '2011-07-18', 1),
	('Milly', 'Jones', 'mj556@googlemail.com', '4 Ashdown Drive', 'Eccles', 'M15 2HG', '07764555563', 28400.00, 'Team Leader', 'jones556', '2015-01-20', 1);


-- Insert data into customers

INSERT INTO customer (
	cust_forename, cust_surname, cust_title, cust_address, cust_postcode, cust_tel, 	cust_email, cust_DOB, cust_town, cust_password)
VALUES 
	('Joel',   'Nash',     'Mr',   '137a Manchester Road', 'M43 6EG', '07521092410', 'jnnash94@gmail.com', '1994-07-25', 'Manchester',  'joel'), 
	('Jhan',   'Alarifi',  'Miss', '51 Crescent Street',   'M82 4LS', '07183927562', 'jhan@email.com',     '1993-02-27', 'Manchester',  'jhan'),
	('Hamza',  'Ghani',    'Mr',   '28 Road Lane',         'M8 9JK',  '07312948576', 'hamza@email.com',    '1993-02-18', 'Manchester',  'hamza'),
	('Amanda', 'McIntosh', 'Miss', '9 Acer Street',        'M10 8TG', '07652758461', 'amanda@email.com',   '1990-06-18', 'Manchester',  'amanda'),
	('Glenn',  'Lewis',    'Mr',   '17 Three Butt Lane',   'M2 7TH',  '07929059090', 'glenn@email.com',    '1991-10-04', 'Manchester',  'glenn'),
	('George',  'Johnson',    'Mr',   '1 Totty Lane',   'M22 7YY',  '07865746354', 'george@email.com',    '1991-04-04', 'Tottington',  'george'),
	('Harry',   'Smith',     'Mr',   '13 Manchester Road', 'M45 6UY', '07835645765', 'smith@gmail.com', '1994-12-25', 'Manchester',  '1234'), 
	('Danny',   'Tomlinson',  'Dr', '15 The Close',   'M2 8TS', '07765321110', 'tomD@email.com',     '1991-05-27', 'Manchester',  'password'),
	('Ryan',  'Marks',    'Mr',   '28 Garsidehey Road','BL5 8JO',  '07764833902', 'ryanM@email.com',    '1994-06-18', 'Manchester',  'password123'),
	('Hannah', 'Moffit', 'Miss', '4 Allan Street', 'M13 5YZ', '07126538902', 'hannah@email.com',   '1990-03-18', 'Manchester',  'anything'),
	('Rebecca',  'Lewis',    'Ms',   '6 Langly Lane',   'M5 3TJ',  '07353621092', 'becky@email.com',    '1992-11-14', 'Manchester',  'password');


	
-- Insert data into theatre
	
INSERT INTO theatre (
	theatre_name, theatre_address, theatre_postcode, theatre_seats)
	VALUES
	('The Lowry', 'Pier 8, Salford Quays', 'M50 3AZ', 1730),
	('Palace Theatre', '97 Oxford Street',  'M1 6FT', 1400),
	('Opera House', '3 Quay St', 'M3 3HP',  1920),
	('Manchester Arena', 'New Bridge Street', 'M3', 21000),
	('The Bridgewater Hall', 'Lower Mosley Street', 'M2 3WS',  2400);


INSERT INTO country (country_id, country_name, country_website) VALUES
	( 'FRA', 'France', 'http://frenchweb.fr' ),
	( 'GER', 'Germany', 'http://www.germany.travel/en/index.html' ),
	( 'ITA', 'Italy', 'http://www.italia.it/en/home.html'),
	( 'JAP', 'Japan', 'http://www.seejapan.co.uk/jnto_consumer/index' ),
	( 'SWI', 'Switzerland', 'http://www.swissworld.org' ),
	( 'ENG', 'England', 'http://www.visitengland.com');


INSERT INTO city (city_id, city_name, city_website, country_id_fk)
VALUES
	( 'PAR', 'Paris', 'http://en.parisinfo.com', 'FRA'),
	( 'BER', 'Berlin', 'http://www.visitberlin.de/en',"GER"),
	( 'ROM', 'Rome', 'http://www.rome.info', 'ITA'),
	( 'TOK', 'Tokyo', 'http://www.gotokyo.org/en/','JAP' ),
	( 'GEN', 'Geneva','http://www.ville-geneve.ch/welcome-geneva/', 'SWI'),
	( 'MAN', 'Manchester', 'http://www.visitmanchester.com', 'ENG' );



INSERT INTO attractions(
	attract_name, description, attract_website, attract_phone, attract_extra_info, attract_adult_price, attract_child_price, attract_student_price, attract_senior_price, emp_id_fk, city_id_fk)
VALUES
	('Eiffel Tower', "The Eiffel Tower, is an iron lattice tower located on the Champ de Mars in Paris. It was named after the engineer Gustave Eiffel, whose company designed and built the tower. Erected in 1889 as the entrance arch to the 1889 World's Fair, it was initially criticised by some of France's leading artists and intellectuals for its design, but has become both a global cultural icon of France and one of the most recognizable structures in the world. The tower is the tallest structure in Paris and the most-visited paid monument in the world", 'http://www.toureiffel.paris/', '33892701239', 'It’s only possible to climb to the second floor using the stairs. From the second floor, lifts take you up to the top.', 10.95, 8.12, 9.54, 10.95, 2, 'PAR' ),
	('Disney Land Paris', "Disneyland Paris, originally Euro Disney Resort, is an entertainment resort in Marne-la-Vallée, a new town located 32 km east of the centre of Paris, and is the most visited theme park in all of France and Europe.", 'www.disneylandparis.fr/', '33825300500', "Disneyland Paris encompasses 4,800 acres (19 km2)[3] and contains 2 theme parks, 7 resort hotels, 6 associated hotels, a golf course, railway station and a new town: Val d'Europe.", 31.79, 27.55, 31.79, 31.79, 2, 'PAR'), 
	('Tiergarten', 'Tiergarten in Berlin refers to the parliamentary, government and diplomatic district as well as to Berlin’s largest and most popular inner-city park. The Tiergarten (animal park) and former hunting ground is Berlin’s best known park because of its centrality it’s a favourite with locals and visitors, wonderful for a stroll, a breath of fresh air, a picnic, cycling or a jog or just kicking a ball around. Today the area includes the Regierungsviertel, Potsdamer Platz and the Kulturforum as well as the Diplomatenviertel.', 'http://www.berlin.de',null, 'This huge lush park stretches through central Berlin and provides a relaxing contrast to the bustle of the rest of the city.', 0,0,0,0, 1,'BER'),
	('Colosseum', 'The Colosseum or Coliseum, also known as the Flavian Amphitheatre is an elliptical amphitheatre in the centre of the city of Rome, Italy.', 'http://www.italyguides.it/us/roma/colosseum.htm', null, 'Audio guides, bookshop and guided tours', 8.47, 0.0, 4.94, 8.47,3,'ROM'),
	('Tokyo Disneyland', 'Tokyo Disneyland is an 115-acre theme park at the Tokyo Disney Resort in Urayasu, Chiba, Japan, near Tokyo. Its main gate is directly adjacent to both Maihama Station and Tokyo Disneyland Station.', 'http://www.tokyodisneyresort.jp/en/tdl/', '81453305211', "With only a few exceptions, Tokyo Disneyland features the same attractions found in Disneyland and Walt Disney World's Magic Kingdom", 31.79, 27.55, 31.79, 31.79, 2, 'TOK'),
	('The Lion King', 'The Lion King is a musical based on the 1994 Disney animated film of the same name with music by Elton John and lyrics by Tim Rice along with the musical score created by Hans Zimmer with choral arrangements by Lebo M. Directed by Julie Taymor, the musical features actors in animal costumes as well as giant, hollow puppets. The show is produced by Disney Theatrical.', 'www.thelionking.co.uk', '08448713000', null, 35.00, 20.00, 35.00, 35.00, 3, 'MAN'),
	('Wicked', 'Wicked: The Untold Story of the Witches of Oz is a musical with music and lyrics by Stephen Schwartz and a book by Winnie Holzman.', 'www.wickedthemusical.co.uk', null, 'First performance: June 10, 2003', 35.00, 15.00, 18.00, 35.00, 2, 'MAN');



INSERT INTO production(doors_open, start_time, duration, rating,attract_id_ck, theatre_id_ck)
VALUES
	('17:00:00', '18:30:00', 150, 5, 6, 1),
	('17:00:00', '19:30:00', 150, 5, 7, 2);


INSERT INTO sight_seeing
	(attract_id_fk, ss_opening_time, ss_close_time)
VALUES
	(1, '09:30:00', '23:00:00'),
	(4, '08:30:00', '16:30:00'),
	(3, '00:00:00', '00:00:00');
	
INSERT INTO theme_park
	(attract_id_fk, opening_time, close_time, rides_quantity)
VALUES 
	(2, '09:00:00', '20:00:00', 61),
	(5, '09:00:00', '20:00:00', 61);

INSERT INTO booking
	(booking_date, booking_adults, booking_children, booking_students, booking_senior, cust_id_fk)
VALUES 
	('2014-1-21', 1, 1, 1, 1, 1),
	('2015-2-02', 2, 2, 0, 0, 2),
	('2015-3-02', 0, 0, 5, 0, 3),
	('2013-4-04', 1, 2, 1, 0, 4),
	('2013-4-30', 0, 0, 1, 1, 7),
	('2013-4-30', 0, 2, 1, 2, 7),
	('2013-4-30', 0, 2, 2, 2, 7);

INSERT INTO booking_attractions
	(attract_id_ck, booking_id_ck, attract_date)
VALUES 
	(1, 1, '2014-03-05'),
	(2, 2, '2015-04-15'),
	(3, 3, '2015-03-05'),
	(4, 4, '2013-05-01'),
	(5, 5, '2013-06-05'),
	(5, 6, '2013-06-05'),
	(5, 7, '2013-06-05');


	
INSERT INTO INVOICE (invoice_date, invoice_total, booking_id_fk)
VALUES 
	( '2015-03-05', 39.56, 1),
	( '2015-03-05', 118.68, 2),
	( '2015-03-05', 0.00, 3),
	( '2015-03-05', 13.41, 4),
	( '2014-03-05', 100.48, 5),
	( '2014-03-05', 108.08, 6),
	( '2014-03-05', 10.68, 7);

INSERT INTO PAYMENT_DETAILS 
	(cust_id_fk, invoice_id_fk, pay_card_type, pay_total, pay_date, pay_cardNo, pay_issue_no, pay_expiry_date, pay_security_code, pay_card_holder)
VALUES 
	(1, 1, 'VISA DELTA', 253.33, '2015-09-04', 1234567891234567, null, '2017-06-14', '000', 'MR JOEL  NASH'),
	(2, 2, 'VISA DELTA', 253.33, '2015-09-04', 1234567891234567, null, '2017-06-14', '123', 'MR GLENN G LEWIS'),
	(3, 3, 'VISA DELTA', 253.33, '2015-09-04', 1234567891234567, null, '2017-06-14', '345', 'MR GEORGE JOHNSON'),
	(4, 4, 'VISA DELTA', 253.33, '2015-09-04', 1234567891234567, null, '2017-06-14', '567', 'MR HAMZA Ghani'),
	(7, 5, 'VISA DELTA', 253.33, '2015-09-04', 1234567891230000, null, '2017-06-14', '777', 'MR HARRY SMITH'),
	(7, 6, 'VISA DELTA', 253.33, '2015-09-04', 1234567891230000, null, '2017-06-14', '777', 'MR HARRY SMITH'),
	(7, 6, 'VISA DELTA', 253.33, '2015-09-04', 1234567891230000, null, '2017-06-14', '777', 'MR HARRY SMITH');





