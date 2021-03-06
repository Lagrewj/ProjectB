/*db: lagrewj-db
pwd:  l0BejOWA5vkS30Mz 
*/

/* To DROP tables */
DROP TABLE IF EXISTS `usr_db`;
DROP TABLE IF EXISTS `bank_account`;
DROP TABLE IF EXISTS `causes`;



/* Creating User Information Table */
CREATE TABLE usr_db(
id INT(5) NOT NULL AUTO_INCREMENT,
email_address VARCHAR(50) NOT NULL,
password VARCHAR(50) NOT NULL,
first_name VARCHAR(50) NOT NULL,
last_name VARCHAR(50) NOT NULL,
credits INT(6) DEFAULT 50, 
PRIMARY KEY(id),
UNIQUE KEY(email_address)
)ENGINE=InnoDB;


/* To tie users and their skills together and hold their rating for the skill*/
CREATE TABLE causes(
id INT(5) NOT NULL AUTO_INCREMENT,
cause_name VARCHAR(50) NOT NULL,
description TEXT NOT NULL,
credits INT(6) DEFAULT 0,
goal INT(6) NOT NULL DEFAULT 10000,
PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE bank_account(
bank_account_id INT(5) NOT NULL AUTO_INCREMENT,
user_id INT(5) NOT NULL,
bank_name VARCHAR(50) NOT NULL,
account_type VARCHAR(50) NOT NULL,
bank_routing_number INT(9) NOT NULL,
bank_account_number INT(10) NOT NULL,
credits NUMERIC(10,2) NOT NULL,
PRIMARY KEY(bank_account_id),
FOREIGN KEY(user_id) REFERENCES usr_db(id),
UNIQUE KEY(user_id)
)ENGINE=InnoDB;

CREATE TABLE site_account(
user_id INT(5) NOT NULL,
bank_account_id INT(5) NOT NULL,
balance NUMERIC(10,2) NOT NULL,
PRIMARY KEY(user_id),
FOREIGN KEY(user_id) REFERENCES usr_db(id),
FOREIGN KEY(bank_account_id) REFERENCES bank_account(bank_account_id),
UNIQUE KEY(user_id)
)ENGINE=InnoDB;

CREATE TABLE donation(
transaction_id INT(10) NOT NULL,
user_id INT(5) NOT NULL,
donation_amount NUMERIC(10,2) NOT NULL,
cause_account_number INT(5) NOT NULL,
donation_time TIMESTAMP NOT NULL,
PRIMARY KEY(transaction_id),
FOREIGN KEY(user_id) REFERENCES usr_db(id),
FOREIGN KEY(cause_account_number) REFERENCES causes(id),
UNIQUE KEY(transaction_id)
)ENGINE=InnoDB;


/* Inserting dummy data for causes table */
INSERT INTO causes (cause_name, description, credits) VALUES 
('American Heart Association', 'Provides research and awareness to help fight the leading cause of death in America', '0');
INSERT INTO causes (cause_name, description, credits) VALUES 
('Helen Keller International', "Save the sight and lives of the world's most vulnerable and disadvantaged.", '0');
INSERT INTO causes (cause_name, description, credits) VALUES 
('Save the Children', 'To inspire breakthroughs in the way the world treats children, and to achieve immediate and lasting change in their lives.', '0');
INSERT INTO causes (cause_name, description, credits) VALUES 
('Environmental Defense Fund', 'To preserve the natural systems on which all life depends; guided by science and economics, finds practical and lasting solutions to the most serious environmental problems.', '0');
INSERT INTO causes (cause_name, description, credits) VALUES 
("Parkinson's Disease Foundation", "Awards grants & fellowships for research in Parkinson's disease; provides educational & advocacy programs for people with Parkinson's disease, their families and caregivers.", '0');