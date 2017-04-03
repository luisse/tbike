DROP TABLE IF EXISTS taxsecuritys CASCADE;
DROP TABLE IF EXISTS  taxjourneys CASCADE;
DROP TABLE IF EXISTS  taxturns CASCADE;
DROP TABLE IF EXISTS  taxpanics CASCADE;
DROP TABLE IF EXISTS  taxubications CASCADE;
DROP TABLE IF EXISTS  taxownerdrivers CASCADE;
DROP TABLE IF EXISTS  taxownerscars CASCADE;
DROP TABLE IF EXISTS  taxowners CASCADE;
DROP TABLE IF EXISTS  userpeoples  CASCADE;
DROP TABLE IF EXISTS  taxorders  CASCADE;
DROP TABLE IF EXISTS  peoples CASCADE;
--DROP TABLE IF EXISTS  users;
DROP TABLE IF EXISTS  departamentos  CASCADE;
DROP TABLE IF EXISTS  localidades CASCADE;
DROP TABLE IF EXISTS  provinces CASCADE;
DROP TABLE IF EXISTS  countries CASCADE;
--DROP TABLE IF EXISTS  groups;

/***
CREATE TABLE groups (
  id SERIAL  NOT NULL ,
  name VARCHAR(50)    ,
  created TIMESTAMP    ,
  modified TIMESTAMP      ,
PRIMARY KEY(id));
***/



CREATE TABLE countries (
  id SERIAL  NOT NULL ,
  codcountrie INTEGER    ,
  name VARCHAR(50)      ,
PRIMARY KEY(id));




CREATE TABLE provinces (
  id SERIAL  NOT NULL ,
  countrie_id INTEGER   NOT NULL ,
  name VARCHAR(80)      ,
PRIMARY KEY(id)  ,
  FOREIGN KEY(countrie_id)
    REFERENCES countries(id));


CREATE INDEX provinces_FKIndex1 ON provinces (countrie_id);


CREATE INDEX IFK_Rel_14 ON provinces (countrie_id);


CREATE TABLE locations (
  id SERIAL  NOT NULL ,
  cospostal VARCHAR(8)    ,
  province_id INTEGER   NOT NULL ,
  name VARCHAR(80)      ,
PRIMARY KEY(id)  ,
  FOREIGN KEY(province_id)
    REFERENCES provinces(id));


CREATE INDEX locations_FKIndex1 ON locations (province_id);


CREATE INDEX IFK_Rel_15 ON locations (province_id);


CREATE TABLE departments (
  id SERIAL  NOT NULL ,
  location_id INTEGER   NOT NULL ,
  name VARCHAR(50)      ,
PRIMARY KEY(id)  ,
  FOREIGN KEY(location_id)
    REFERENCES locations(id));


CREATE INDEX departments_FKIndex1 ON departments (location_id);


CREATE INDEX IFK_Rel_16 ON departments (location_id);
/****
CREATE TABLE users (
  id SERIAL  NOT NULL ,
  group_id INTEGER   NOT NULL ,
  username VARCHAR(45)   NOT NULL ,
  password VARCHAR(45)   NOT NULL ,
  created TIMESTAMP    ,
  modified TIMESTAMP    ,
  state SMALLINT   NOT NULL   ,
  picture text,
  changepassword smallint,
  email character(255)
PRIMARY KEY(id)  ,
  FOREIGN KEY(group_id)
    REFERENCES groups(id));


CREATE INDEX users_FKIndex1 ON users (group_id);


CREATE INDEX IFK_Rel_02 ON users (group_id);


CREATE INDEX index_user_username
  ON users
  USING btree
  (username COLLATE pg_catalog."default",password COLLATE pg_catalog."default");

***/

/*Table for remote sessions*/
CREATE TABLE rsesions (
  id SERIAL NOT NULL,
  user_id INTEGER   NOT NULL  ,
  sessionkey VARCHAR(100)  NOT NULL  ,
  initsession TIMESTAMP  NOT NULL  ,
  endsession TIMESTAMP  NOT NULL  ,
  ipconnect INET   NOT NULL    ,
  state smallint,
PRIMARY KEY(id)  ,
  FOREIGN KEY(user_id)
    REFERENCES users(id));

CREATE INDEX ind_session_key
  ON rsesions
  USING btree
  (sessionkey COLLATE pg_catalog."default");


CREATE TABLE peoples (
  id SERIAL  NOT NULL ,
  countrie_id INTEGER   NOT NULL ,
  province_id INTEGER   NOT NULL ,
  location_id INTEGER   NOT NULL ,
  department_id INTEGER   NOT NULL ,
  firstname VARCHAR(40)    ,
  secondname VARCHAR(40)    ,
  document NUMERIC(12)    ,
  address VARCHAR(80)    ,
  number INTEGER    ,
  depto INTEGER    ,
  block INTEGER    ,
  birthdate date NOT NULL, -- Fecha de nacimiento
  gender smallint,
PRIMARY KEY(id, province_id)        ,
  FOREIGN KEY(countrie_id)
    REFERENCES countries(id),
  FOREIGN KEY(province_id)
    REFERENCES provinces(id),
  FOREIGN KEY(location_id)
    REFERENCES locations(id),
  FOREIGN KEY(department_id)
    REFERENCES departments(id));


CREATE INDEX peoples_FKIndex1 ON peoples (countrie_id);
CREATE INDEX peoples_FKIndex2 ON peoples (province_id);
CREATE INDEX peoples_FKIndex3 ON peoples (location_id);
CREATE INDEX peoples_FKIndex4 ON peoples (department_id);


CREATE INDEX IFK_Rel_peoples_23 ON peoples (countrie_id);
CREATE INDEX IFK_Rel_peoples_24 ON peoples (province_id);
CREATE INDEX IFK_Rel_peoples_25 ON peoples (location_id);
CREATE INDEX IFK_Rel_peoples_26 ON peoples (department_id);


-- ------------------------------------------------------------
-- Fecha de pedido del movil
-- ------------------------------------------------------------

DROP TABLE taxorders;

CREATE TABLE taxorders (
  id SERIAL  NOT NULL ,
  date TIMESTAMP   NOT NULL ,
  user_id INTEGER   NOT NULL ,
  state SMALLINT      ,
  directiodetails VARCHAR(255) NULL,
  travelto VARCHAR(150) NULL,

PRIMARY KEY(id, date),
  FOREIGN KEY(user_id)
    REFERENCES users(id));

CREATE INDEX taxorders_FKIndex5 ON taxorders (user_id);

SELECT AddGeometryColumn('','taxorders','gpspoint',4326, 'POINT', 2);
CREATE INDEX KG_TAXORDERS ON taxorders USING GIST (gpspoint gist_geometry_ops_nd);


CREATE TABLE userpeoples (
  id SERIAL  NOT NULL ,
  peoples_province_id INTEGER   NOT NULL ,
  user_id INTEGER   NOT NULL ,
  people_id INTEGER   NOT NULL   ,
PRIMARY KEY(id)    ,
  FOREIGN KEY(people_id, peoples_province_id)
    REFERENCES peoples(id, province_id),
  FOREIGN KEY(user_id)
    REFERENCES users(id));


CREATE INDEX userpeoples_FKIndex1 ON userpeoples (people_id, peoples_province_id);
CREATE INDEX userpeoples_FKIndex2 ON userpeoples (user_id);


CREATE INDEX IFK_Rel_userpeoples21 ON userpeoples (people_id, peoples_province_id);
CREATE INDEX IFK_Rel_userpeoples22 ON userpeoples (user_id);


CREATE TABLE taxowners (
  id SERIAL   NOT NULL,
  user_id INTEGER   NOT NULL ,
  created TIMESTAMP    ,
  modified TIMESTAMP    ,
  state SMALLINT      ,
PRIMARY KEY(id)    ,
  FOREIGN KEY(user_id)
    REFERENCES users(id));


CREATE INDEX taxowners_FKIndex2 ON taxowners (user_id);
CREATE INDEX IFK_Rel_taxowners04 ON taxowners (user_id);


CREATE TABLE taxownerscars (
  id SERIAL  NOT NULL ,
  taxowner_id INTEGER   NOT NULL ,
  carcode VARCHAR(10)   NOT NULL ,
  registerpermision INTEGER   NOT NULL ,
  decreenro INTEGER   NOT NULL ,
  dateexpire DATE    ,
  dateactive DATE   NOT NULL ,
  state INTEGER    ,
  picture TEXT      ,
  descriptioncar character(100) NOT NULL,
PRIMARY KEY(id)  ,
  FOREIGN KEY(taxowner_id)
    REFERENCES taxowners(id));


CREATE INDEX taxownerscars_FKIndex1 ON taxownerscars (taxowner_id);


CREATE INDEX IFK_Rel_taxownerscars05 ON taxownerscars (taxowner_id);


CREATE TABLE taxownerdrivers (
  id SERIAL  NOT NULL ,
  people_id INTEGER   NOT NULL ,
  taxowner_id INTEGER   NOT NULL ,
  licencenumber INTEGER    ,
  picture TEXT,
  state SMALLINT      ,
  created TIMESTAMP    ,
  modified TIMESTAMP    ,
PRIMARY KEY(id)    ,
  FOREIGN KEY(people_id, peoples_province_id)
    REFERENCES peoples(id, province_id),
  FOREIGN KEY(taxowner_id)
    REFERENCES taxowners(id));


CREATE INDEX taxownerdrivers_FKIndex1 ON taxownerdrivers (people_id, peoples_province_id);
CREATE INDEX taxownerdrivers_FKIndex2 ON taxownerdrivers (taxowner_id);


CREATE INDEX IFK_Rel_taxownerdrivers06 ON taxownerdrivers (people_id, peoples_province_id);
CREATE INDEX IFK_Rel_taxownerdrivers07 ON taxownerdrivers (taxowner_id);


CREATE TABLE taxubications (
  id SERIAL  NOT NULL ,
  countrie_id INTEGER   NOT NULL ,
  province_id INTEGER   NOT NULL ,
  location_id INTEGER   NOT NULL ,
  department_id INTEGER   NOT NULL ,
  taxownerscar_id INTEGER   NOT NULL ,
  date DATE    ,
  state SMALLINT    ,
PRIMARY KEY(id)          ,
  FOREIGN KEY(taxownerscar_id)
    REFERENCES taxownerscars(id),
  FOREIGN KEY(countrie_id)
    REFERENCES countries(id),
  FOREIGN KEY(province_id)
    REFERENCES provinces(id),
  FOREIGN KEY(location_id)
    REFERENCES locations(id),
  FOREIGN KEY(department_id)
    REFERENCES departments(id));


CREATE INDEX taxubications_FKIndex1 ON taxubications (taxownerscar_id);
CREATE INDEX taxubications_FKIndex2 ON taxubications (countrie_id);
CREATE INDEX taxubications_FKIndex3 ON taxubications (province_id);
CREATE INDEX taxubications_FKIndex4 ON taxubications (location_id);
CREATE INDEX taxubications_FKIndex5 ON taxubications (department_id);


CREATE INDEX IFK_Rel_taxubications11 ON taxubications (taxownerscar_id);
CREATE INDEX IFK_Rel_taxubications17 ON taxubications (countrie_id);
CREATE INDEX IFK_Rel_taxubications18 ON taxubications (province_id);
CREATE INDEX IFK_Rel_taxubications19 ON taxubications (location_id);
CREATE INDEX IFK_Rel_taxubications20 ON taxubications (department_id);

SELECT AddGeometryColumn('','taxubications','gpspoint',4326, 'POINT', 2);
CREATE INDEX KG_TAXUBICATIONS ON taxubications USING GIST (gpspoint gist_geometry_ops_nd);


CREATE TABLE taxpanics (
  id SERIAL  NOT NULL ,
  taxownerdriver_id INTEGER   NOT NULL ,
  datepanic TIMESTAMP    ,
  message VARCHAR(255)      ,
PRIMARY KEY(id)  ,
  FOREIGN KEY(taxownerdriver_id)
    REFERENCES taxownerdrivers(id));


CREATE INDEX taxpanics_FKIndex1 ON taxpanics (taxownerdriver_id);


CREATE INDEX IFK_Rel_taxpanics13 ON taxpanics (taxownerdriver_id);

SELECT AddGeometryColumn('','taxpanics','gpspoint',4326, 'POINT', 2);
CREATE INDEX KG_TAXPANICS ON taxpanics USING GIST (gpspoint gist_geometry_ops_nd);

CREATE TABLE taxturns (
  id SERIAL  NOT NULL ,
  taxownerscar_id INTEGER   NOT NULL ,
  taxownerdriver_id INTEGER   NOT NULL ,
  turninit TIMESTAMP   NOT NULL ,
  turnend TIMESTAMP    ,
  state SMALLINT   NOT NULL   ,
PRIMARY KEY(id)    ,
  FOREIGN KEY(taxownerdriver_id)
    REFERENCES taxownerdrivers(id),
  FOREIGN KEY(taxownerscar_id)
    REFERENCES taxownerscars(id));


CREATE INDEX taxturns_FKIndex1 ON taxturns (taxownerdriver_id);
CREATE INDEX taxturns_FKIndex2 ON taxturns (taxownerscar_id);


CREATE INDEX IFK_Rel_taxturns14 ON taxturns (taxownerdriver_id);
CREATE INDEX IFK_Rel_taxturns15 ON taxturns (taxownerscar_id);


CREATE TABLE taxjourneys(
  id SERIAL NOT NULL,
  taxorder_id INTEGER  NOT NULL  ,
  datejourney TIMESTAMP  NULL  ,
  created TIMESTAMP,
  modified TIMESTAMP,
PRIMARY KEY(id)    ,
  FOREIGN KEY(taxorder_id)
    REFERENCES taxorders(id));

SELECT AddGeometryColumn('','taxjourneys','initjourney',4326, 'POINT', 2);
SELECT AddGeometryColumn('','taxjourneys','endjourney',4326, 'POINT', 2);

CREATE TABLE taxturnjoursecuritys (
  id SERIAL  NOT NULL,
  taxjourney_id INTEGER NOT NULL  ,
  created  time without time zone  NULL  ,
  pictute TEXT  NULL    ,
PRIMARY KEY(id)    ,
  FOREIGN KEY(taxjourney_id)
    REFERENCES taxjourneys(id));



CREATE TABLE taxsecuritys (
  id SERIAL  NOT NULL ,
  taxjourney_id INTEGER   NOT NULL ,
  image TEXT    ,
  datesec TIMESTAMP      ,
PRIMARY KEY(id)  ,
  FOREIGN KEY(taxjourney_id)
    REFERENCES taxjourneys(id));


CREATE INDEX taxsecurytis_FKIndex1 ON taxsecuritys (taxjourney_id);


CREATE INDEX IFK_Rel_taxsecuritys10 ON taxsecuritys (taxjourney_id);

SELECT AddGeometryColumn('','taxsecuritys','gpspoint',4326, 'POINT', 2);
CREATE INDEX KG_TAXSECURITYS ON taxsecuritys USING GIST (gpspoint gist_geometry_ops_nd);


CREATE TABLE IF NOT EXISTS social_profiles (
  id SERIAL NOT NULL,
  user_id int DEFAULT NULL,
  social_network_name varchar(64) DEFAULT NULL,
  social_network_id varchar(128) DEFAULT NULL,
  email varchar(128) NOT NULL,
  display_name varchar(128) NOT NULL,
  first_name varchar(128) NOT NULL,
  last_name varchar(128) NOT NULL,
  link varchar(512) NOT NULL,
  picture varchar(512) NOT NULL,
  created timestamp with time zone NULL,
  modified timestamp with time zone NULL,
  status smallint NOT NULL DEFAULT '1',
  PRIMARY KEY(id)
);


CREATE TABLE carpreferences (
  id SERIAL NOT NULL,
  description VARCHAR(50)  NOT NULL,
  sintetico VARCHAR(10)  NOT NULL,
  lan VARCHAR(5)  NOT NULL,
  state SMALLINT UNSIGNED  NULL    ,
PRIMARY KEY(id));



CREATE TABLE userpreferences (
  id SERIAL  NOT NULL,
  user_id INTEGER NOT NULL  ,
  carpreference_id INTEGER NOT NULL,
  created timestamp with time zone NULL,
  modified timestamp with time zone NULL,
PRIMARY KEY(id),
  FOREIGN KEY(user_id)
    REFERENCES users(id),
  FOREIGN KEY(carpreference_id)
    REFERENCES carpreferences(id));


 CREATE INDEX IFK_Rel_userpreferences ON userpreferences (user_id);



CREATE TABLE userfavplaces(
   id SERIAL  NOT NULL ,
   user_id INTEGER   NOT NULL ,
  detalle VARCHAR(100) NOT NULL,
  state SMALLINT   NULL,
  PRIMARY KEY(id)  ,
  FOREIGN KEY(user_id)
  REFERENCES users(id));

CREATE INDEX userfavplaces_FKIndex1 ON userfavplaces (user_id);

SELECT AddGeometryColumn('','userfavplaces','gpspoint',4326, 'POINT', 2);
CREATE INDEX KG_userfavplaces ON userfavplaces USING GIST (gpspoint gist_geometry_ops_nd);



CREATE TABLE favcars (
 id SERIAL NOT NULL,
 user_id INTEGER  NOT NULL  ,
 taxownerscar_id INTEGER  NOT NULL  ,
 created timestamp with time zone NULL,
 modified timestamp with time zone NULL,
PRIMARY KEY(id)  ,
FOREIGN KEY(user_id)
REFERENCES users(id),
FOREIGN KEY(taxownerscar_id)
REFERENCES taxownerscars(id)
);


CREATE INDEX favcars_FKIndex1 ON favcars(user_id);
CREATE INDEX  favcars_FKIndex2 ON favcars(taxownerscar_id);



CREATE TABLE faultcars (
  id SERIAL NOT NULL,
  taxownerscar_id INTEGER NOT NULL  ,
  user_id INTEGER NOT NULL,
  details TEXT  NULL  ,
  created  timestamp with time zone NULL,
  modified  timestamp with time zone NULL,
  state SMALLINT  NULL    ,
  PRIMARY KEY(id)  ,
  FOREIGN KEY(taxownerscar_id)
  REFERENCES taxownerscars(id),
  FOREIGN KEY(user_id)
  REFERENCES users(id));

CREATE INDEX faultcars_FXIndex1 ON faultcars(taxownerscar_id);
CREATE INDEX faultcars_FXIndex2 ON faultcars(user_id);

SELECT AddGeometryColumn('','faultcars','gpspoint',4326, 'POINT', 2);
CREATE INDEX KG_faultcars ON faultcars USING GIST (gpspoint gist_geometry_ops_nd);


CREATE TABLE ratings (
  id SERIAL  NOT NULL,
  user_id INTEGER NOT NULL  ,
  created timestamp with time zone NULL,
  value SMALLINT NULL  ,
  typeranking SMALLINT  NULL    ,
PRIMARY KEY(id),
FOREIGN KEY(user_id)
REFERENCES users(id));
CREATE INDEX ratings_FKIndex1 ON favcars(user_id);

/*TABLES OF TALKS*/
CREATE TABLE talks (
  id SERIAL  NOT NULL,
  user_contact_id INTEGER NOT NULL  ,
  user_init_id INTEGER NOT NULL  ,
  state SMALLINT  NULL  ,
  created  timestamp with time zone NULL,
  modified  timestamp with time zone NULL,
PRIMARY KEY(id)  ,
FOREIGN KEY(user_contact_id)
REFERENCES users(id),
FOREIGN KEY(user_init_id)
REFERENCES users(id));
CREATE INDEX talks_FKindex1 ON talks(user_contact_id);
CREATE INDEX talks_FKindex2 ON talks(user_init_id);

CREATE TABLE talkdetails (
  id SERIAL  NOT NULL,
  user_rec_id INTEGER NOT NULL  ,
  user_send_id INTEGER NOT NULL  ,
  talk_id INTEGER  NOT NULL  ,
  created  timestamp with time zone NULL,
  message TEXT  NULL    ,
  PRIMARY KEY(id)  ,
  FOREIGN KEY(talk_id)
  REFERENCES talks(id),
  FOREIGN KEY(user_rec_id)
  REFERENCES users(id),
  FOREIGN KEY(user_send_id)
  REFERENCES users(id));

  CREATE INDEX talkdetails_FKindex1 ON talkdetails(user_rec_id);
  CREATE INDEX talkdetails_FKindex2 ON talkdetails(user_send_id);
  CREATE INDEX talkdetails_FKindex3 ON talkdetails(talk_id);


-- INDEX FOR DATABASE PERFOMANCE

  DROP INDEX INDEX_RSESION_USER
  CREATE INDEX INDEX_RSESION_USER ON rsesions(user_id)
