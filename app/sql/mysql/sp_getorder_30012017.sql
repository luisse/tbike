-- Function: public.sp_get_orders(timestamp without time zone, timestamp without time zone)

-- DROP FUNCTION public.sp_get_orders(timestamp without time zone, timestamp without time zone);


CREATE OR REPLACE FUNCTION public.sp_get_orders(IN p_date_from timestamp without time zone, IN p_date_to timestamp without time zone)
  RETURNS TABLE(order_id integer,
		order_date timestamp without time zone,
		direccionorigen character varying,
		direcciondestino character varying,
		pasajeroid integer,
		pasajeronombre character varying,
		pasajeroapellido character varying,
		pasajerotelefono numeric,
		taxturn_id integer,
		taxistanombre character varying,
		taxistaapellido character varying,
		taxistatelefono numeric,
		order_details taxorders.order_details%TYPE,
		state_order character varying,
		state taxorders.state%TYPE,
		group_id users.group_id%TYPE,
		group_name groups.name%TYPE) AS

$BODY$
DECLARE
i_id INT;
BEGIN
    RETURN QUERY
    select
	   taxorders.id,
	   taxorders.date,
	   taxorders.directiodetails as DireccionOrigen,
	   taxorders.travelto as DireccionDestino,
	   taxorders.user_id as PasajeroId,
	   peoples.firstname as PasajeroNombre,
	   peoples.secondname as PasajeroApellido,
	   peoples.phonenumber as PasajeroTelefono,
	   taxorders.taxturn_id,
	   drivers.firstname as TaxistaNombre,
	   drivers.secondname as TaxistaApellido,
	   drivers.phonenumber as TaxistaTelefono,
	   taxorders.order_details,
	   CAST((SELECT logstates.reason FROM logstates WHERE logstates.id = (SELECT MAX(logstates.id) FROM logstates WHERE logstates.order_id = taxorders.id)) AS character varying) AS state_order,
	   taxorders.state,
	   users.group_id,
	   groups.name

	from taxorders
	left join users on users.id = taxorders.user_id
	left join groups on groups.id = users.group_id
	left join userpeoples on userpeoples.user_id = users.id
	left join peoples on peoples.id = userpeoples.people_id
	left join taxturns on taxorders.taxturn_id = taxturns.id
	left join taxownerdrivers on  taxownerdrivers.id = taxturns.taxownerdriver_id
	left join peoples as drivers on drivers.id = taxownerdrivers.people_id
	where
	date > p_date_from
	and date <= p_date_to + interval '1' day
	ORDER BY taxorders.date DESC;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION public.sp_get_orders(timestamp without time zone, timestamp without time zone)
  OWNER TO postgres;
