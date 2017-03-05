-- Column: event_source

-- ALTER TABLE public.logstates DROP COLUMN event_source;

ALTER TABLE public.logstates ADD COLUMN event_source character varying(50);
-- Column: lat

-- ALTER TABLE public.logstates DROP COLUMN lat;

ALTER TABLE public.logstates ADD COLUMN lat real;

-- Column: lng

-- ALTER TABLE public.logstates DROP COLUMN lng;

ALTER TABLE public.logstates ADD COLUMN lng real;

-- Column: journey_id

-- ALTER TABLE public.logstates DROP COLUMN journey_id;

ALTER TABLE public.logstates ADD COLUMN journey_id integer;

-- Column: gps_time

-- ALTER TABLE public.logstates DROP COLUMN gps_time;

ALTER TABLE public.logstates ADD COLUMN gps_time timestamp without time zone;


ALTER TABLE public.taxownerscars ADD COLUMN registerpermisionorigin character varying(100);


ALTER TABLE public.users ADD COLUMN createon character varying(50);
COMMENT ON COLUMN public.users.createon IS 'usuario creado desde?';
