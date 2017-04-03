-- DROP FUNCTION public.sp_getid(timestamp without time zone);

CREATE OR REPLACE FUNCTION public.sp_getid(IN p_date timestamp without time zone)
 RETURNS TABLE(car_id integer, log_id integer) AS
$BODY$
DECLARE
i_id INT;
BEGIN
   RETURN QUERY
   SELECT logstates.car_id,MAX(id)
   FROM logstates
   WHERE created <= p_date
 AND date_part('month',p_date) = date_part('month',logstates.created)
 AND date_part('year',p_date) = date_part('year',logstates.created)
 AND date_part('day',p_date) = date_part('day',logstates.created)

   GROUP BY logstates.car_id;
END;
$BODY$
 LANGUAGE plpgsql VOLATILE
 COST 100
 ROWS 1000;
ALTER FUNCTION public.sp_getid(timestamp without time zone)
 OWNER TO postgres;
