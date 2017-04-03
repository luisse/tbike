-- Column: workstate

-- ALTER TABLE taxownerscars DROP COLUMN workstate;

ALTER TABLE taxownerscars ADD COLUMN workstate character varying(50);
//

CREATE TABLE logstates
(
  id serial NOT NULL,
  taxownerdriver_id integer,
  created timestamp without time zone,
  workstate character varying(50),
  CONSTRAINT "PK_ID" PRIMARY KEY (id),
  CONSTRAINT "FK_LOGSTATE" FOREIGN KEY (taxownerdriver_id)
      REFERENCES taxownerdrivers (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE logstates
  OWNER TO postgres;
--view


  -- View: geography_columns

-- DROP VIEW geography_columns;

CREATE OR REPLACE VIEW VWLOG AS
SELECT
  taxownerscars.carcode,
  users.username,
  logstates.created,
  peoples.firstname,
  peoples.secondname
FROM
  public.logstates LEFT JOIN public.taxownerscars ON(logstates.car_id = taxownerscars.id)
  LEFT JOIN public.users ON( logstates.driver_id = users.id)
  LEFT JOIN public.userpeoples ON( users.id = userpeoples.user_id)
  LEFT JOIN public.peoples ON(userpeoples.people_id = peoples.id);
ALTER TABLE VWLOG
  OWNER TO postgres;
GRANT ALL ON TABLE VWLOG TO postgres;
GRANT SELECT ON TABLE geography_columns TO public;
