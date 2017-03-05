/*Autos asociados a radiotaxis*/
SELECT taxownerscars.carcode,taxownerscars.id,users.id
FROM users
INNER JOIN userradiotaxis ON userradiotaxis.user_id = users.id
INNER JOIN radiotaxis ON radiotaxis.id = userradiotaxis.radiotaxi_id
INNER JOIN radiotaxicars ON radiotaxicars.radiotaxi_id = radiotaxis.id
INNER JOIN taxownerscars ON radiotaxicars.taxownerscar_id = taxownerscars.id
WHERE username='testradiotaxi'


UPDATE logstates SET created = now()::timestamp;
UPDATE taxubications SET modified = now()::timestamp;
UPDATE taxpanics SET datepanic = now()::timestamp, state = 1;
SELECT * FROM groups

SELECT * FROM rsesions WHERE sessionkey = '018c7a1bf24295acbcc5382423089cb6eedc5dcf'
SELECT * FROM rsesions WHERE sessionkey = '323f1c92303e7d1a32a9f69ed56f0a616cd060ae'
SELECT * FROM rsesions WHERE sessionkey = 'b7c4e9bb24b62227d731329aed5348ccf4aa8992'
SELECT * FROM rsesions WHERE sessionkey = 'c104e43823031b857fbea07ba635db993e764a26'
SELECT * FROM rsesions WHERE sessionkey = 'd8480adf3493c2d7a780bd92cdbccbff53893687'

/*Autos asociados a un usuario*/
SELECT taxturns.id,taxownerscars.carcode, taxownerscars.id,taxturns.state
FROM users 
INNER JOIN taxownerdrivers ON(taxownerdrivers.user_id = users.id)
INNER JOIN taxturns ON (taxownerdriver_id = taxownerdrivers.id)
INNER JOIN taxownerscars ON (taxownerscars.id = taxturns.taxownerscar_id)
WHERE users.id in(54)

SELECT * FROM users WHERE username='ddriver'
UPDATE users SET group_id = 2 WHERE  username='ddriver'


SELECT DISTINCT taxturns.id,taxownerscars.id,taxturns.state,users.id,sessionkey
FROM users 
INNER JOIN taxownerdrivers ON(taxownerdrivers.user_id = users.id)
INNER JOIN taxturns ON (taxownerdriver_id = taxownerdrivers.id)
INNER JOIN taxownerscars ON (taxownerscars.id = taxturns.taxownerscar_id)
INNER JOIN rsesions ON (rsesions.user_id = users.id and rsesions.state = 1)
WHERE users.id in(54) and taxturns.state = 1



SELECT * FROM rsesions WHERE user_id = 54 and state = 1




/*Recuperar key del usuario*/
SELECT sessionkey,rsesions.state,users.id
FROM
users
LEFT JOIN rsesions ON(rsesions.user_id = users.id)
WHERE users.username='t2'




/*Determina si el usuario se encuentra asociado al radiotaxi*/
SELECT radiotaxicars.radiotaxi_id,userradiotaxis.user_id
FROM users
LEFT JOIN taxownerdrivers ON (taxownerdrivers.user_id = users.id)
LEFT JOIN taxturns On (taxturns.taxownerdriver_id = taxownerdrivers.id)
LEFT JOIN radiotaxicars ON(radiotaxicars.taxownerscar_id = taxturns.taxownerscar_id)
LEFT JOIN userradiotaxis ON(userradiotaxis.radiotaxi_id = radiotaxicars.radiotaxi_id)
 WHERE users.id = 54 and taxturns.state = 1;