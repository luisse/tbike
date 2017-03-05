-- Function: public.sp_driver_kpi_now(character varying, boolean, integer)

-- DROP FUNCTION public.sp_driver_kpi_now(character varying, boolean, integer);

CREATE OR REPLACE FUNCTION public.sp_driver_kpi_now(IN p_state character varying, IN p_is_test boolean DEFAULT false, IN p_radiotaxi_id integer DEFAULT 0)
  RETURNS TABLE(status character varying,
		carcode character varying,
		licencenumber integer,
		nombre character varying,
		apellido character varying,
		lat double precision,
		lng double precision,
		phonenumber peoples.phonenumber%TYPE) AS
$BODY$
DECLARE
i_id INT;
BEGIN
    RETURN QUERY
    SELECT
	logstates.status,
	taxownerscars.carcode,
	taxownerscars.registerpermision,
	peoples.firstname,
	peoples.secondname,
	ST_X(taxubications.gpspoint),
	ST_Y(taxubications.gpspoint),
	peoples.phonenumber
    FROM
	logstates INNER JOIN sp_getid(now()::timestamp) ON logstates.id = sp_getid.log_id
	LEFT JOIN taxownerscars ON (taxownerscars.id = logstates.car_id)
	LEFT JOIN taxownerdrivers ON (taxownerdrivers.user_id = logstates.driver_id)
	LEFT JOIN users ON (taxownerdrivers.user_id = users.id)
	LEFT JOIN peoples ON(peoples.id = taxownerdrivers.people_id)
	LEFT JOIN taxubications ON(taxubications.taxownerscar_id = taxownerscars.id)
	LEFT JOIN radiotaxicars ON (radiotaxicars.taxownerscar_id = taxownerscars.id and radiotaxicars.state = 1)
	WHERE
	(logstates.status = p_state) and
	date_part('minutes',current_timestamp - taxubications.modified) < 5
	AND date_part('hours',current_timestamp - taxubications.modified) = 0
	AND date_part('month',current_timestamp) = date_part('month',taxubications.modified)
	AND date_part('year',current_timestamp) = date_part('year',taxubications.modified)
	AND date_part('day',current_timestamp) = date_part('day',taxubications.modified)
	AND users.is_test = p_is_test
	AND (radiotaxicars.radiotaxi_id = p_radiotaxi_id OR p_radiotaxi_id = 0);
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION public.sp_driver_kpi_now(character varying, boolean, integer)
  OWNER TO postgres;
