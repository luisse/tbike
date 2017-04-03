SELECT * FROM pg_settings WHERE name like '%timezone%'
select pg_timezone_names();
SET TIME ZONE 'America/Argentina/Tucuman';


SELECT
	logstates.status,
	taxownerscars.carcode,
	taxownerscars.registerpermision,
	peoples.firstname,
	peoples.secondname,
	ST_X(taxubications.gpspoint),
	ST_Y(taxubications.gpspoint)
    FROM
	logstates INNER JOIN sp_getid(now()::timestamp) ON logstates.id = sp_getid.log_id
	LEFT JOIN taxownerscars ON (taxownerscars.id = logstates.car_id)
	LEFT JOIN taxownerdrivers ON (taxownerdrivers.user_id = logstates.driver_id)
	LEFT JOIN users ON (taxownerdrivers.user_id = users.id)
	LEFT JOIN peoples ON(peoples.id = taxownerdrivers.people_id)
	LEFT JOIN taxubications ON(taxubications.taxownerscar_id = taxownerscars.id)
	LEFT JOIN radiotaxicars ON (radiotaxicars.taxownerscar_id = taxownerscars.id and radiotaxicars.state = 1)
	WHERE
	(logstates.status = 'Libre') and
	date_part('minutes',current_timestamp - taxubications.modified) < 5
	AND date_part('hours',current_timestamp - taxubications.modified) = "0"
	AND date_part('month',current_timestamp) = date_part('month',taxubications.modified)
	AND date_part('year',current_timestamp) = date_part('year',taxubications.modified)
	AND date_part('day',current_timestamp) = date_part('day',taxubications.modified)
AND users.is_test = 1
	-- AND (radiotaxicars.radiotaxi_id = p_radiotaxi_id OR p_radiotaxi_id = 0);
