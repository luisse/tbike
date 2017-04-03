SELECT * FROM taxorders ORDER BY id desc LIMIT 10

UPDATE logstates SET created = now()::timestamp;
UPDATE taxubications SET modified = now()::timestamp;
UPDATE taxpanics SET datepanic = now()::timestamp, state = 1;




/*ORDENES TOMADAS POR TAXISTAS*/
SELECT DISTINCT date_part('day',taxorders.date)||'/'||date_part('month',taxorders.date)||'/'||date_part('year',taxorders.date) AS dateformat,
		taxownerscars.registerpermision as registerpermision,
		taxorders.state as state,
		count(*) as total
FROM users
	INNER JOIN userradiotaxis ON userradiotaxis.user_id = users.id
	INNER JOIN radiotaxis ON radiotaxis.id = userradiotaxis.radiotaxi_id
	-- INNER JOIN radiotaxicars ON radiotaxicars.radiotaxi_id = radiotaxis.id
	INNER JOIN taxorders ON taxorders.user_id = users.id
	INNER JOIN taxturns ON taxturns.id = taxorders.taxturn_id
	INNER JOIN taxownerscars ON taxownerscars.id = taxturns.taxownerscar_id
WHERE users.username = 'remismatedeluna' and
	taxorders.date >='2016-01-01 00:00:00' and 
	taxorders.date <='2016-10-25 00:00:00'
GROUP BY dateformat,taxownerscars.registerpermision, taxorders.state


SELECT * FROM users WHERE username='remismatedeluna'

SELECT * FROM sp_orders_days(258,'2016-10-27 00:00:00','2016-10-27 23:59:59')


DROP FUNCTION public.sp_orders_days(integer, timestamp without time zone,timestamp without time zone);

CREATE OR REPLACE FUNCTION public.sp_orders_days(IN p_user_id integer, IN p_date_from  timestamp without time zone, IN p_date_to  timestamp without time zone)
  RETURNS TABLE(date_order text, state smallint, total bigint) AS
$BODY$
DECLARE
i_id INT;
BEGIN
    RETURN QUERY 
	/*TOTAL PEDIDOS POR DIA*/
	SELECT DISTINCT date_part('day',taxorders.date)||'/'||date_part('month',taxorders.date)||'/'||date_part('year',taxorders.date) AS dateformat,
			taxorders.state AS state,
			count(*) AS total
	FROM users
		INNER JOIN userradiotaxis ON userradiotaxis.user_id = users.id
		INNER JOIN radiotaxis ON radiotaxis.id = userradiotaxis.radiotaxi_id
		-- INNER JOIN radiotaxicars ON radiotaxicars.radiotaxi_id = radiotaxis.id
		INNER JOIN taxorders ON taxorders.user_id = users.id
	WHERE users.id = p_user_id and
		taxorders.date >=p_date_from and 
		taxorders.date <=p_date_to
	GROUP BY dateformat, taxorders.state
	ORDER BY dateformat DESC;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION public.sp_orders_days(integer, timestamp without time zone,timestamp without time zone)
  OWNER TO postgres;



SELECT * FROM sp_orders_driver(258,'2016-01-01 00:00:00','2016-10-25 23:59:59')

DROP FUNCTION public.sp_orders_driver(integer, timestamp without time zone,timestamp without time zone);

CREATE OR REPLACE FUNCTION public.sp_orders_driver(IN p_user_id integer, IN p_date_from  timestamp without time zone, IN p_date_to  timestamp without time zone)
  RETURNS TABLE(date_order text,registerpermision integer, state smallint, total bigint) AS
$BODY$
DECLARE
i_id INT;
BEGIN
    RETURN QUERY 
	/*ORDENES TOMADAS POR TAXISTAS*/
	SELECT DISTINCT date_part('day',taxorders.date)||'/'||date_part('month',taxorders.date)||'/'||date_part('year',taxorders.date) AS dateformat,
			taxownerscars.registerpermision as registerpermision,
			taxorders.state as state,
			count(*) as total
	FROM users
		INNER JOIN userradiotaxis ON userradiotaxis.user_id = users.id
		INNER JOIN radiotaxis ON radiotaxis.id = userradiotaxis.radiotaxi_id
		-- INNER JOIN radiotaxicars ON radiotaxicars.radiotaxi_id = radiotaxis.id
		INNER JOIN taxorders ON taxorders.user_id = users.id
		INNER JOIN taxturns ON taxturns.id = taxorders.taxturn_id
		INNER JOIN taxownerscars ON taxownerscars.id = taxturns.taxownerscar_id
	WHERE users.id = p_user_id and
		taxorders.date >=p_date_from and 
		taxorders.date <=p_date_to
	GROUP BY dateformat,taxownerscars.registerpermision, taxorders.state;

END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION public.sp_orders_driver(integer, timestamp without time zone,timestamp without time zone)
  OWNER TO postgres;


