UPDATE logstates SET created = now()::timestamp;
UPDATE taxubications SET modified = now()::timestamp;
UPDATE taxpanics SET datepanic = now()::timestamp, state = 1;
/*MASIVE INSERT FOR TEST PANICS*/
INSERT INTO taxpanics(taxownerdriver_id,datepanic,message,gpspoint,state)
SELECT taxownerdrivers.id,
 now()::timestamp,
 'ALARM',
 ST_GeomFromText('POINT(-26.801108 -65.235328)',4326),
 1
FROM taxownerscars
INNER JOIN taxownerdrivers ON taxownerdrivers.id = taxownerscars.id
WHERE taxownerscars.id in(SELECT DISTINCT car_id FROM logstates WHERE car_id <> 0)

-- Function: public.sp_panic_now(boolean)

-- DROP FUNCTION public.sp_panic_now(boolean);

CREATE OR REPLACE FUNCTION public.sp_panic_now(IN p_is_test boolean DEFAULT false)
  RETURNS TABLE(status character varying, carcode character varying, licencenumber integer, nombre character varying, apellido character varying,phonenumber numeric(13,0), lat double precision, lng double precision) AS
$BODY$
DECLARE
i_id INT;
BEGIN
    RETURN QUERY
  SELECT
  	DISTINCT
  	logstates.status,
  	taxownerscars.carcode,
  	taxownerscars.registerpermision,
  	peoples.firstname,
  	peoples.secondname,
  	peoples.phonenumber,
  	ST_X(taxubications.gpspoint),
  	ST_Y(taxubications.gpspoint)
  FROM
  	logstates INNER JOIN sp_getid(now()::timestamp) ON logstates.id = sp_getid.log_id
  	LEFT JOIN taxownerscars ON (taxownerscars.id = logstates.car_id)
  	LEFT JOIN taxownerdrivers ON (taxownerdrivers.user_id = logstates.driver_id)
  	LEFT JOIN users ON (taxownerdrivers.user_id = users.id)
  	LEFT JOIN peoples ON(peoples.id = taxownerdrivers.people_id)
  	LEFT JOIN taxubications ON(taxubications.taxownerscar_id = taxownerscars.id)
  	INNER JOIN taxpanics ON(taxpanics.taxownerdriver_id = taxownerdrivers.id)
	WHERE
  	date_part('minutes',current_timestamp - taxubications.modified) < 10
  	AND date_part('hours',current_timestamp - taxubications.modified) = 0
  	AND date_part('month',current_timestamp) = date_part('month',taxubications.modified)
  	AND date_part('year',current_timestamp) = date_part('year',taxubications.modified)
  	AND date_part('day',current_timestamp) = date_part('day',taxubications.modified)
  	/*TRAER DATOS DE ALARMA DE PANICO PASADO SOLO 5 MINUTOS*/
  	AND date_part('minutes',current_timestamp - taxpanics.datepanic) < 10
  	AND date_part('hours',current_timestamp - taxpanics.datepanic) = 0
  	AND date_part('month',current_timestamp) = date_part('month',taxpanics.datepanic)
  	AND date_part('year',current_timestamp) = date_part('year',taxpanics.datepanic)
  	AND date_part('day',current_timestamp) = date_part('day',taxpanics.datepanic)
	AND taxpanics.state = 1
  	AND users.is_test = p_is_test;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION public.sp_panic_now(boolean)
  OWNER TO postgres;
