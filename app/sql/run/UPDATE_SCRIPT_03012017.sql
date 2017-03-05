
/*INSERT GROUP AND AROS*/
INSERT INTO groups(name,created,modified) VALUES('Extuser','2017-01-03 14:51:15','2017-01-03 14:51:15');
INSERT INTO aros(model,foreign_key,lft,rght) VALUES('Group',7,12,13);
/*CREATE USER*/
INSERT INTO public.users(
            group_id, username, password, created, modified, state, picture, 
            changepassword, email, createon, is_test)
VALUES ('7','remote_app','bacb7225cfbce6520fc6953dcd7c1ac754732358','2017-01-03 14:51:15','2017-01-03 14:51:15',1,'',0,'remote_app@test.com','',false);
