-- Table: talks

-- DROP TABLE talks;

CREATE TABLE talks
(
  id serial NOT NULL,
  user_contact_id integer NOT NULL,
  user_init_id integer NOT NULL,
  state smallint,
  created timestamp with time zone,
  modified timestamp with time zone,
  CONSTRAINT talks_pkey PRIMARY KEY (id),
  CONSTRAINT talks_user_contact_id_fkey FOREIGN KEY (user_contact_id)
      REFERENCES users (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT talks_user_init_id_fkey FOREIGN KEY (user_init_id)
      REFERENCES users (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE talks
  OWNER TO postgres;

-- Index: talks_fkindex1

-- DROP INDEX talks_fkindex1;

CREATE INDEX talks_fkindex1
  ON talks
  USING btree
  (user_contact_id);

-- Index: talks_fkindex2

-- DROP INDEX talks_fkindex2;

CREATE INDEX talks_fkindex2
  ON talks
  USING btree
  (user_init_id);


 -- Table: talkdetails

-- DROP TABLE talkdetails;

CREATE TABLE talkdetails
(
  id serial NOT NULL,
  user_rec_id integer NOT NULL,
  user_send_id integer NOT NULL,
  talk_id integer NOT NULL,
  created timestamp with time zone,
  message text,
  CONSTRAINT talkdetails_pkey PRIMARY KEY (id),
  CONSTRAINT talkdetails_talk_id_fkey FOREIGN KEY (talk_id)
      REFERENCES talks (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT talkdetails_user_rec_id_fkey FOREIGN KEY (user_rec_id)
      REFERENCES users (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT talkdetails_user_send_id_fkey FOREIGN KEY (user_send_id)
      REFERENCES users (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE talkdetails
  OWNER TO postgres;

-- Index: talkdetails_fkindex1

-- DROP INDEX talkdetails_fkindex1;

CREATE INDEX talkdetails_fkindex1
  ON talkdetails
  USING btree
  (user_rec_id);

-- Index: talkdetails_fkindex2

-- DROP INDEX talkdetails_fkindex2;

CREATE INDEX talkdetails_fkindex2
  ON talkdetails
  USING btree
  (user_send_id);

-- Index: talkdetails_fkindex3

-- DROP INDEX talkdetails_fkindex3;

CREATE INDEX talkdetails_fkindex3
  ON talkdetails
  USING btree
  (talk_id);
