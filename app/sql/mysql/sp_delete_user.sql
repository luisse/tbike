-- DROP FUNCTION public.sp_delete_user(integer);
SELECT * FROM social_profiles
SELECT * FROM sp_delete_user(113)


CREATE OR REPLACE FUNCTION public.sp_delete_user(IN p_user_id integer)
  RETURNS TABLE(carcode character varying) AS
$BODY$
DECLARE
li_people_id peoples.id%TYPE;
BEGIN
    /*
    * FUNCTION: delete user not drivers!!!!
    */
    SELECT id INTO li_people_id FROM userpeoples WHERE user_id = p_user_id;
    IF li_people_id IS NULL OR li_people_id IS NULL THEN
	RETURN QUERY
		SELECT CAST ('User people id not exists!!!!' AS character varying);
    ELSE
	    DELETE FROM taxorders WHERE user_id = p_user_id;
	    DELETE FROM ratings WHERE user_id = p_user_id;
	    DELETE FROM social_profiles WHERE user_id = p_user_id;
	    DELETE FROM rsesions WHERE user_id = p_user_id;
	    DELETE FROM userfavplaces WHERE user_id = p_user_id;
	    DELETE FROM userpreferences WHERE user_id = p_user_id;

	    DELETE FROM userpeoples WHERE  user_id = p_user_id;
	    DELETE FROM peoples WHERE id = li_people_id;
	    DELETE FROM users WHERE id = p_user_id;

	    RETURN QUERY
		SELECT CAST ('User is delete!!!!' AS character varying);
    END IF;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION public.sp_delete_user(integer)
  OWNER TO postgres;
