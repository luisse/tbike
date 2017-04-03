INSERT INTO peoples(id,countrie_id,province_id,location_id,department_id,firstname,secondname,address,number,birthdate)
VALUES(216,1,1,1,1,'NN','NN','NN',0,'01/01/1970');



DROP SEQUENCE public.peoples_id_seq;

CREATE SEQUENCE public.peoples_id_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 500
  CACHE 1;
ALTER TABLE public.peoples_id_seq;
  OWNER TO postgres;


ALTER SEQUENCE peoples_id_seq RESTART WITH 500;
