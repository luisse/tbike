/*DETALLES DE AUTOS*/
SELECT users.id,taxowners.id,taxownerscars.carcode,descriptioncar FROM users
LEFT JOIN taxowners ON taxowners.user_id = users.id
LEFT JOIN taxownerscars ON taxownerscars.taxowner_id = taxowners.id
WHERE username='t2';
/*DETALLES DE SESION Y AUTO*/
SELECT taxownerscars.descriptioncar,taxownerdrivers.id,taxownerscars.id
FROM
users
LEFT JOIN taxownerdrivers ON taxownerdrivers.user_id = users.id
LEFT JOIN taxturns ON taxturns.taxownerdriver_id = taxownerdrivers.id and taxturns.state = 1
LEFT JOIN taxownerscars ON taxownerscars.id = taxturns.taxownerscar_id
WHERE users.username='t2'

SELECT * FROM users WHERE username='lsoppe'
UPDATE users SET is_test = true WHERE id = 75
UPDATE taxorders SET state = 2 WHERE id = 1922
SELECT * FROM taxorders ORDER BY id DESC LIMIT 10
SELECT * FROM taxowners WHERE user_id = 107
SELECT * FROM taxturns

-- Function: public.sp_get_car_for_position(double precision, double precision, integer, integer)

-- DROP FUNCTION public.sp_get_car_for_position(double precision, double precision, integer, integer);

CREATE OR REPLACE FUNCTION public.sp_get_car_for_position(IN p_lat double precision, IN p_lng double precision, IN max_ratio_km integer, IN pradiotaxi_id integer, IN p_type_car character varying)
  RETURNS TABLE(carcode character varying, id integer, distance double precision, lat double precision, lng double precision) AS
$BODY$
DECLARE
i_km INT;
BEGIN
    RETURN QUERY
	SELECT Taxownerscar.carcode AS Taxownerscar__carcode,
		Taxownerscar.id AS Taxownerscar__id,
		(ST_Distance_Sphere(gpspoint,ST_GeomFromText('POINT('||CAST(p_lat AS text)||' '||CAST(p_lng AS text)||')', 4326))/1000) AS distance,
		ST_X(Taxubication.gpspoint) AS lat,
		ST_Y(Taxubication.gpspoint) AS lng
	FROM
		logstates INNER JOIN sp_getid(now()::timestamp) ON logstates.id = sp_getid.log_id
		INNER JOIN public.taxubications AS Taxubication ON Taxubication.taxownerscar_id = logstates.car_id
		INNER JOIN public.taxownerscars AS Taxownerscar ON (Taxownerscar.id= Taxubication.taxownerscar_id)
		LEFT JOIN public.radiotaxicars AS Radiotaxicar ON (Radiotaxicar.taxownerscar_id = Taxownerscar.id)
	WHERE Taxubication.state = 1
		AND (logstates.status = 'Libre')
		AND (ST_Distance_Sphere(gpspoint,ST_GeomFromText('POINT('||CAST(p_lat AS text)||' '||CAST(p_lng AS text)||')', 4326))/1000 < max_ratio_km OR (p_lng = 0 and p_lat =0 ))
		AND date_part('minutes',current_timestamp - Taxubication.modified) < 20
		AND date_part('hours',current_timestamp - Taxubication.modified) = 0
		AND date_part('month',current_timestamp) = date_part('month',Taxubication.modified)
		AND date_part('year',current_timestamp) = date_part('year',Taxubication.modified)
		AND date_part('day',current_timestamp) = date_part('day',Taxubication.modified)
		AND (Radiotaxicar.radiotaxi_id = pradiotaxi_id OR pradiotaxi_id = 0)
		AND (Taxownerscar.descriptioncar like '%'||p_type_car||'%' OR p_type_car = '')
		ORDER BY distance DESC
		LIMIT 10;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION public.sp_get_car_for_position(double precision, double precision, integer, integer, character varying)
  OWNER TO postgres;
