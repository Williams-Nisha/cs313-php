CREATE DATABASE appointments;

CREATE TABLE insurance(
    insurance_id SERIAL PRIMARY KEY NOT NULL
,   name TEXT NOT NULL
);


CREATE TABLE specialty(
    specialty_id SERIAL PRIMARY KEY NOT NULL
,   name TEXT NOT NULL
);

CREATE TABLE physician(
    physician_id SERIAL PRIMARY KEY NOT NULL
,   first_name TEXT NOT NULL
,   last_name TEXT NOT NULL
,   phone_number VARCHAR(15) NOT NULL
,   specialty_id INT REFERENCES specialty(specialty_id)
);
CREATE TABLE physician_insurance(
    physician_id INT UNIQUE REFERENCES physician(physician_id)
,   insurance_id INT UNIQUE REFERENCES insurance(insurance_id)
);

CREATE TABLE schedule(
    schedule_id SERIAL PRIMARY KEY NOT NULL
,   start_time TIMESTAMP WITHOUT TIME ZONE NOT NULL
,   end_time TIMESTAMP WITHOUT TIME ZONE NOT NULL
,   physician_id INT REFERENCES physician(physician_id)
);
CREATE TABLE patient(
    patient_id SERIAL PRIMARY KEY 
,   first_name TEXT NOT NULL
,   last_name TEXT NOT NULL
,   street_address VARCHAR(20) NOT NULL
,   phone_number VARCHAR(15) NOT NULL
,   birthdate DATE NOT NULL
,   city TEXT NOT NULL
,   notes TEXT NOT NULL
,   insurance_id INT REFERENCES insurance(insurance_id)
,   physician_id INT REFERENCES physician(physician_id)
);
CREATE TABLE appointment(
    appointment_id SERIAL PRIMARY KEY NOT NULL 
,   appointment_date TIMESTAMP WITHOUT TIME ZONE NOT NULL
,   physician_id INT REFERENCES physician(physician_id)
,   patient_id INT REFERENCES patient(patient_id)
);
/* Insertion statements*/

/*Patient table- insertion statements */
INSERT INTO patient(
    patient_id
,    first_name
,   last_name
,   street_address
,   phone_number
,   birthdate
,   city
,   notes
,   insurance_id
,   physician_id
) VALUES (
    DEFAULT
,   'Natalie'
,   'Smith'
,   '1125 Rose Lane'
,   '(521)225-1234'
,   'Jan-14-1989'
,   'Glen Harbor'
,   'Notes about Natalie Smith'
,   (SELECT insurance_id FROM insurance WHERE name='Select Health')
,   (SELECT physician_id FROM physician WHERE first_name='Mary')
);

INSERT INTO patient(
    patient_id
,    first_name
,   last_name
,   street_address
,   phone_number
,   birthdate
,   city
,   notes
,   insurance_id
,   physician_id
) VALUES (
    DEFAULT
,   'Justin'
,   'Thomas'
,   '551 Smith Ranch'
,   '(521)325-1546'
,   'March-18-1976'
,   'River Rock'
,   'Notes about Justin Thomas'
,   (SELECT insurance_id FROM insurance WHERE name='Regence Blue
Cross')
,   (SELECT physician_id FROM physician WHERE first_name='Michael')
);

INSERT INTO patient(
    patient_id
,    first_name
,   last_name
,   street_address
,   phone_number
,   birthdate
,   city
,   notes
,   insurance_id
,   physician_id
) VALUES (
    DEFAULT
,   'Amanda'
,   'Hutchins'
,   '3125 Starfish Lane'
,   '(521)325-6825'
,   'Feb-21-1973'
,   'River Rock'
,   'Notes about Amanda Hutchins'
,   (SELECT insurance_id FROM insurance WHERE name='Aetna')
,   (SELECT physician_id FROM physician WHERE first_name='Jared')
);

INSERT INTO patient(
    patient_id
,    first_name
,   last_name
,   street_address
,   phone_number
,   birthdate
,   city
,   notes
,   insurance_id
,   physician_id
) VALUES (
   DEFAULT
,   'Beth'
,   'Christensen'
,   '2148 Valley View'
,   '(521)325-7258'
,   'October-30-1996'
,   'Glen Harbor'
,   'Notes about Beth Christensen'
,   (SELECT insurance_id FROM insurance WHERE name='Aetna')
,   (SELECT physician_id FROM physician WHERE first_name='Victor')
);
/*Physician table-insertions */
INSERT INTO physician(
    physician_id 
,   first_name 
,   last_name 
,   phone_number
,   specialty_id
) VALUES (
    DEFAULT
,   'Jared'
,   'Bunch'
,   '(871)324-1521'
,   (SELECT specialty_id FROM specialty WHERE name='Cardiologist')
);

INSERT INTO physician(
    physician_id 
,   first_name 
,   last_name 
,   phone_number
,   specialty_id
) VALUES (
    DEFAULT
,   'Michael'
,   'Stewart'
,   '(871)324-5821'
,   (SELECT specialty_id FROM specialty WHERE name='Family Practice')
);

INSERT INTO physician(
    physician_id 
,   first_name 
,   last_name 
,   phone_number
,   specialty_id
) VALUES (
    DEFAULT
,   'Mary'
,   'Rosenburg'
,   '(871)324-1856'
,   (SELECT specialty_id FROM specialty WHERE name='Dietician')
);

INSERT INTO physician(
    physician_id 
,   first_name 
,   last_name 
,   phone_number
,   specialty_id
) VALUES (
    DEFAULT
,   'Victor'
,   'Stewart'
,   '(871)324-2189'
,   (SELECT specialty_id FROM specialty WHERE name='Dermatologist')
);


/*Sp*cialty table- insertions */


INSERT INTO specialty(
    specialty_id
,   name
) VALUES (
    DEFAULT
,   'Cardiologist'
);

INSERT INTO specialty(
    specialty_id
,   name
) VALUES (
    DEFAULT
,   'Family Practice'
);

INSERT INTO specialty(
    specialty_id
,   name
) VALUES (
    DEFAULT
,   'Dermatologist'
);

INSERT INTO specialty(
    specialty_id
,   name
) VALUES (
    DEFAULT
,   'Dietician'
);

/* Insert into Insurance */
INSERT INTO insurance(
    insurance_id
,   name
) VALUES (
    DEFAULT
,   'Regence Blue Cross'
);
INSERT INTO insurance(
    insurance_id
,   name
) VALUES (
    DEFAULT
,   'Select Health'
);
INSERT INTO insurance(
    insurance_id
,   name
) VALUES (
    DEFAULT
,   'Aetna'
);

/* Physician Insurance - insertions */

INSERT INTO physician_insurance(
    physician_id
,   insurance_id
) VALUES (
    (SELECT insurance_id from insurance WHERE name = 'Aetna')
,   (SELECT physician_id from physician WHERE first_name = 'Jared')


);

INSERT INTO physician_insurance(
    physician_id
,   insurance_id
) VALUES (
    (SELECT insurance_id from insurance WHERE name = 'Aetna')
,   (SELECT physician_id from physician WHERE first_name = 'Victor')
);

INSERT INTO physician_insurance(
    physician_id
,   insurance_id
) VALUES (
    (SELECT insurance_id from insurance WHERE name = 'Regence Blue Cross')
,   (SELECT physician_id from physician WHERE first_name = 'Michael')
);

INSERT INTO physician_insurance(
    physician_id
,   insurance_id
) VALUES (
    (SELECT insurance_id FROM insurance WHERE name='Select Health')
,   (SELECT physician_id FROM physician WHERE first_name='Mary')
);    
    
/*Schedule Insertions*/

INSERT INTO schedule(
    schedule_id
,   start_time
,   end_time
,   physician_id
) VALUES (
    DEFAULT
,   '2016-11-01 09:00:00'
,   '2016-11-01 17:00:00'
,   (SELECT physician_id from physician WHERE first_name = 'Michael')
);
INSERT INTO schedule(
    schedule_id
,   start_time
,   end_time
,   physician_id
) VALUES (
    DEFAULT
,   '2016-11-01 08:00:00'
,   '2016-11-01 16:00:00'
,   (SELECT physician_id from physician WHERE first_name = 'Victor')
);
INSERT INTO schedule(
    schedule_id
,   start_time
,   end_time
,   physician_id
) VALUES (
    DEFAULT
,   '2016-11-01 10:00:00'
,   '2016-11-01 18:00:00'
,   (SELECT physician_id from physician WHERE first_name = 'Jared')
);
INSERT INTO schedule(
    schedule_id
,   start_time
,   end_time
,   physician_id
) VALUES (
    DEFAULT
,   '2016-11-01 11:00:00'
,   '2016-11-01 19:00:00'
,   (SELECT physician_id from physician WHERE first_name = 'Mary')
);
/* Appointment- insertions */

INSERT INTO appointment(
    appointment_id
,   appointment_date
,   physician_id
,   patient_id
) VALUES (
    DEFAULT 
,   '2016-11-01 16:00:00'
,   (SELECT physician_id from physician WHERE first_name = 'Jared')
,   (SELECT patient_id from patient WHERE first_name = 'Amanda')
);

INSERT INTO appointment(
    appointment_id
,   appointment_date
,   physician_id
,   patient_id
) VALUES (
    DEFAULT 
,   '2016-11-01 10:00:00'
,   (SELECT physician_id from physician WHERE first_name = 'Michael')
,   (SELECT patient_id from patient WHERE first_name = 'Justin')
);
/*QUERIES for the tables */

SELECT * FROM patient;