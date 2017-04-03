-- Table: public.freedays

-- DROP TABLE public.freedays;

CREATE TABLE public.freedays
(
  id integer NOT NULL DEFAULT nextval('freedays_id_seq'::regclass),
  freeday date,
  CONSTRAINT pk_freedays_key PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.freedays
  OWNER TO postgres;


  -- Table: public.turns

  -- DROP TABLE public.turns;

  CREATE TABLE public.turns
  (
    id integer NOT NULL DEFAULT nextval('turns_id_seq'::regclass),
    user_id integer,
    dateturn timestamp without time zone,
    CONSTRAINT pk_turns_key PRIMARY KEY (id),
    CONSTRAINT fk_turns_key FOREIGN KEY (user_id)
        REFERENCES public.users (id) MATCH SIMPLE
        ON UPDATE NO ACTION ON DELETE NO ACTION
  )
  WITH (
    OIDS=FALSE
  );
  ALTER TABLE public.turns
    OWNER TO postgres;


    -- DROP FUNCTION public.sp_addturns(integer);

    SELECT * FROM sp_addturns(29)

    CREATE OR REPLACE FUNCTION public.sp_addturns(IN user_id integer)
      RETURNS TABLE(date_turns turns.dateturn%TYPE) AS
    $BODY$
    DECLARE
       i_id INT;
       i_day INT;
       dt_dateturn turns.dateturn%TYPE;
       dt_datelimit turns.dateturn%TYPE;
       st_datelimit varchar(20);
       d_date date;
    BEGIN

       SELECT MAX(dateturn) INTO dt_dateturn
       FROM turns;

       dt_dateturn := dt_dateturn + interval '30 minute';

       d_date := to_date(date_part('year',dt_dateturn) || '-' ||
    		 date_part('month',dt_dateturn)|| '-' ||
    		 date_part('day',dt_dateturn),'YYYY-MM-DD');

       /*Si no se encuentran datos cargados asignamos el turno a la actual fecha*/
       IF dt_dateturn IS NULL THEN
            dt_dateturn := to_timestamp(date_part('year',current_timestamp) || '-' ||
    		 date_part('month',current_timestamp)|| '-' ||
    		 date_part('day',current_timestamp)|| ' 09:00','YYYY-MM-DD HH24:MI');

       	LOOP
              dt_dateturn := to_timestamp(date_part('year',dt_dateturn) || '-' ||
    		 date_part('month',dt_dateturn)|| '-' ||
    		 date_part('day',dt_dateturn)|| ' 09:00','YYYY-MM-DD HH24:MI') + interval '1 day';

    	   d_date := to_date(date_part('year',dt_dateturn) || '-' ||
    			 date_part('month',dt_dateturn)|| '-' ||
    			 date_part('day',dt_dateturn),'YYYY-MM-DD');

             i_day = to_char(dt_dateturn,'d')::integer;
             IF i_day not in(1,7) AND not exists(SELECT 1 FROM freedays WHERE freeday = d_date) THEN
                 EXIT;
             END IF;
    	END LOOP;
       END IF;

       dt_datelimit := to_timestamp(date_part('year',dt_dateturn) || '-' ||
    		 date_part('month',dt_dateturn)|| '-' ||
    		 date_part('day',dt_dateturn)|| ' 20:30','YYYY-MM-DD HH24:MI');

       /*Si se superan los turnos por horario entonces asignamos turno para el próximo día habil*/
       IF dt_dateturn > dt_datelimit THEN
       	LOOP
    	dt_dateturn := to_timestamp(date_part('year',dt_dateturn) || '-' ||
    		 date_part('month',dt_dateturn)|| '-' ||
    		 date_part('day',dt_dateturn)|| ' 09:00','YYYY-MM-DD HH24:MI') + interval '1 day';
    	   d_date := to_date(date_part('year',dt_dateturn) || '-' ||
    			 date_part('month',dt_dateturn)|| '-' ||
    			 date_part('day',dt_dateturn),'YYYY-MM-DD');

             i_day = to_char(dt_dateturn,'d')::integer;
             IF i_day not in(1,7) AND not exists(SELECT 1 FROM freedays WHERE freeday = d_date) THEN
                 EXIT;
             END IF;
    	END LOOP;
       END IF;

       IF EXISTS(SELECT 1 FROM users WHERE id = user_id) THEN
    	   INSERT INTO turns(user_id,dateturn)
    	   VALUES(user_id,dt_dateturn);
       ELSE
    	dt_dateturn := null;
       END IF;


        RETURN QUERY
        SELECT dt_dateturn;
    END;
    $BODY$
      LANGUAGE plpgsql VOLATILE
      COST 100
      ROWS 1000;
    ALTER FUNCTION public.sp_addturns(integer)
      OWNER TO postgres;
