-- Function: public.sp_get_car_for_position(double precision, double precision, integer, integer)

DROP FUNCTION public.sp_get_car_for_position(double precision, double precision, integer, integer);

CREATE OR REPLACE FUNCTION public.sp_get_car_for_position(IN p_lat double precision, IN p_lng double precision, IN max_ratio_km integer, IN radiotaxi_id integer)
  RETURNS TABLE(carcode character varying, id integer, distance double precision, lat double precision, lng double precision) AS
$BODY$
DECLARE
i_km INT;
BEGIN
/*TEST*/
    i_km=5;
    RETURN QUERY
	SELECT Taxownerscar.carcode AS Taxownerscar__carcode,
		Taxownerscar.id AS Taxownerscar__id,
		(ST_Distance_Sphere(gpspoint,ST_GeomFromText('POINT('||CAST(p_lat AS text)||' '||CAST(p_lng AS text)||')', 4326))/1000) AS distance,
		ST_X(Taxubication.gpspoint) AS lat,
		ST_Y(Taxubication.gpspoint) AS lng
	FROM public.taxubications AS Taxubication
		INNER JOIN public.taxownerscars AS Taxownerscar ON (Taxownerscar.id= Taxubication.taxownerscar_id)
	WHERE Taxubication.state = 1
		AND ST_Distance_Sphere(gpspoint,ST_GeomFromText('POINT('||CAST(p_lat AS text)||' '||CAST(p_lng AS text)||')', 4326))/1000 < max_ratio_km
		AND date_part('minutes',current_timestamp - Taxubication.modified) < 20
		AND date_part('hours',current_timestamp - Taxubication.modified) = 0
		AND date_part('month',current_timestamp) = date_part('month',Taxubication.modified)
		AND date_part('year',current_timestamp) = date_part('year',Taxubication.modified)
		AND date_part('day',current_timestamp) = date_part('day',Taxubication.modified)
		AND radiotaxi_id = 0
		ORDER BY distance DESC
		LIMIT 10;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION public.sp_get_car_for_position(double precision, double precision, integer, integer)
  OWNER TO postgres;
