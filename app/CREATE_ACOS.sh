//CARGA TODOS LOS CONTROLADORES AUTOMATICAMENTE
./Console/cake AclExtras.AclExtras aco_sync
sudo sh lib/Cake/Console/cake AclExtras.AclExtras recover aro
/*Users*/
sudo sudo sh lib/Cake/Console/cake acl create aco controllers Users
sudo sh lib/Cake/Console/cake acl create aco Users index
sudo sh lib/Cake/Console/cake acl create aco Users login
sudo sh lib/Cake/Console/cake acl create aco Users view
sudo sh lib/Cake/Console/cake acl create aco Users edit
sudo sh lib/Cake/Console/cake acl create aco Users add
sudo sh lib/Cake/Console/cake acl create aco Users delete
sudo sh lib/Cake/Console/cake acl create aco Users changepassword
sudo sh lib/Cake/Console/cake acl create aco Users userajaxloginremote
sudo sh lib/Cake/Console/cake acl create aco Users logoutremote
sudo sh lib/Cake/Console/cake acl create aco Users logout
sudo sh lib/Cake/Console/cake acl create aco Users resetpassword
sudo sh lib/Cake/Console/cake acl create aco Users registeruser
sudo sh lib/Cake/Console/cake acl create aco Users ownerregister
sudo sh lib/Cake/Console/cake acl create aco Users beforeRender
sudo sh lib/Cake/Console/cake acl create aco Users usersactive
sudo sh lib/Cake/Console/cake acl create aco Users confirmarusuario
sudo sh lib/Cake/Console/cake acl create aco Users getdetailsusers
sudo sh lib/Cake/Console/cake acl create aco Users editimage
sudo sh lib/Cake/Console/cake acl create aco Users editimage
sudo sh lib/Cake/Console/cake acl create aco Users social_login
sudo sh lib/Cake/Console/cake acl create aco Users social_endpoint
sudo sh lib/Cake/Console/cake acl create aco Users socialremote
sudo sh lib/Cake/Console/cake acl create aco Users adddriver
sudo sh lib/Cake/Console/cake acl create aco Users listusers
sudo sh lib/Cake/Console/cake acl create aco Users editadmin
sudo sh lib/Cake/Console/cake acl create aco Users radiotaxi

/*Taxturns*/
sudo sh lib/Cake/Console/cake acl create aco controllers Taxturns
sudo sh lib/Cake/Console/cake acl create aco Taxturns index
sudo sh lib/Cake/Console/cake acl create aco Taxturns delete
sudo sh lib/Cake/Console/cake acl create aco Taxturns createturn
sudo sh lib/Cake/Console/cake acl create aco Taxturns endturn
sudo sh lib/Cake/Console/cake acl create aco Taxturns endturn
/*Taxsecuritys*/
sudo sh lib/Cake/Console/cake acl create aco controllers Taxsecuritys
sudo sh lib/Cake/Console/cake acl create aco Taxsecuritys addsecuritys
/*Taxorders*/
sudo sh lib/Cake/Console/cake acl create aco controllers Taxorders
sudo sh lib/Cake/Console/cake acl create aco Taxorders index
sudo sh lib/Cake/Console/cake acl create aco Taxorders delete
sudo sh lib/Cake/Console/cake acl create aco Taxorders neworder
sudo sh lib/Cake/Console/cake acl create aco Taxorders taxordercancel
sudo sh lib/Cake/Console/cake acl create aco Taxorders getorder
sudo sh lib/Cake/Console/cake acl create aco Taxorders takeorder
sudo sh lib/Cake/Console/cake acl create aco Taxorders getmyorderstate
sudo sh lib/Cake/Console/cake acl create aco Taxorders getmyorders
sudo sh lib/Cake/Console/cake acl create aco Taxorders totalorders
sudo sh lib/Cake/Console/cake acl create aco Taxorders vieworders
sudo sh lib/Cake/Console/cake acl create aco Taxorders taketax
sudo sh lib/Cake/Console/cake acl create aco Taxorders myorders
sudo sh lib/Cake/Console/cake acl create aco Taxorders taxordersview
sudo sh lib/Cake/Console/cake acl create aco Taxorders taxorderview
sudo sh lib/Cake/Console/cake acl create aco Taxorders listtaxorders
sudo sh lib/Cake/Console/cake acl create aco Taxorders listtaxorders
sudo sh lib/Cake/Console/cake acl create aco Taxorders wviewmyorders
sudo sh lib/Cake/Console/cake acl create aco Taxorders indexlisttaxorders
sudo sh lib/Cake/Console/cake acl create aco Taxorders getorders
/*Taxjourneys*/
sudo sh lib/Cake/Console/cake acl create aco controllers Taxjourneys
sudo sh lib/Cake/Console/cake acl create aco Taxjourneys delete
sudo sh lib/Cake/Console/cake acl create aco Taxjourneys initjourney
sudo sh lib/Cake/Console/cake acl create aco Taxjourneys endjourney
sudo sh lib/Cake/Console/cake acl create aco Taxjourneys endjourney
/*Taxownerscars*/
sudo sh lib/Cake/Console/cake acl create aco controllers Taxownerscars
sudo sh lib/Cake/Console/cake acl create aco Taxownerscars index
sudo sh lib/Cake/Console/cake acl create aco Taxownerscars add
sudo sh lib/Cake/Console/cake acl create aco Taxownerscars edit
sudo sh lib/Cake/Console/cake acl create aco Taxownerscars delete
sudo sh lib/Cake/Console/cake acl create aco Taxownerscars getownercars
sudo sh lib/Cake/Console/cake acl create aco Taxownerscars getcarsdrivers
sudo sh lib/Cake/Console/cake acl create aco Taxownerscars existeregistercar
sudo sh lib/Cake/Console/cake acl create aco Taxownerscars whereismycar
sudo sh lib/Cake/Console/cake acl create aco Taxownerscars whereismycarjson
sudo sh lib/Cake/Console/cake acl create aco Taxownerscars caractive
sudo sh lib/Cake/Console/cake acl create aco Taxownerscars listtaxownerscars

/*Taxownerdrivers*/
sudo sh lib/Cake/Console/cake acl create aco controllers Taxownerdrivers
sudo sh lib/Cake/Console/cake acl create aco Taxownerdrivers index
sudo sh lib/Cake/Console/cake acl create aco Taxownerdrivers add
sudo sh lib/Cake/Console/cake acl create aco Taxownerdrivers edit
sudo sh lib/Cake/Console/cake acl create aco Taxownerdrivers delete
sudo sh lib/Cake/Console/cake acl create aco Taxownerdrivers mostrarimagenthumbs
sudo sh lib/Cake/Console/cake acl create aco Taxownerdrivers listtaxownerdrivers
sudo sh lib/Cake/Console/cake acl create aco Taxownerdrivers setworkstate
setworkstate
/*Faultcars*/
sudo sh lib/Cake/Console/cake acl create aco controllers Faultcars
sudo sh lib/Cake/Console/cake acl create aco Faultcars index
sudo sh lib/Cake/Console/cake acl create aco Faultcars listfaultcars
sudo sh lib/Cake/Console/cake acl create aco Faultcars addfualtcars
sudo sh lib/Cake/Console/cake acl create aco Faultcars faultcarschangedstate
sudo sh lib/Cake/Console/cake acl create aco Faultcars faultcarschangedstatenj
sudo sh lib/Cake/Console/cake acl create aco Faultcars deletefaultcars
sudo sh lib/Cake/Console/cake acl create aco Faultcars getubicationmaps
/*Taxubications*/
sudo sh lib/Cake/Console/cake acl create aco controllers Taxubications
sudo sh lib/Cake/Console/cake acl create aco Taxubications getubicationnt
/*Favcars*/
sudo sh lib/Cake/Console/cake acl create aco controllers Favcars
sudo sh lib/Cake/Console/cake acl create aco Favcars index
sudo sh lib/Cake/Console/cake acl create aco Favcars add
sudo sh lib/Cake/Console/cake acl create aco Favcars delete
sudo sh lib/Cake/Console/cake acl create aco Favcars favgetpost
sudo sh lib/Cake/Console/cake acl create aco Favcars listfavcars
/*Talks*/
sudo sh lib/Cake/Console/cake acl create aco controllers Talks
sudo sh lib/Cake/Console/cake acl create aco Talks inittalk
sudo sh lib/Cake/Console/cake acl create aco Talks accepttalk
sudo sh lib/Cake/Console/cake acl create aco Talks sendmsg
/*Kpies*/
sudo sh lib/Cake/Console/cake acl create aco controllers Kpies
sudo sh lib/Cake/Console/cake acl create aco Kpies kpies
sudo sh lib/Cake/Console/cake acl create aco Kpies kpies_count
sudo sh lib/Cake/Console/cake acl create aco Kpies getorders
/*Mains*/
sudo sh lib/Cake/Console/cake acl create aco controllers Mains
sudo sh lib/Cake/Console/cake acl create aco Mains dashboard
sudo sh lib/Cake/Console/cake acl create aco Mains index
sudo sh lib/Cake/Console/cake acl create aco Mains index
sudo sh lib/Cake/Console/cake acl create aco Mains showalldriversonmap
sudo sh lib/Cake/Console/cake acl create aco Mains vieworders
sudo sh lib/Cake/Console/cake acl create aco Mains sendmsgactivecar
sudo sh lib/Cake/Console/cake acl create aco Mains policiamonitor
/*Groups*/
sudo sh lib/Cake/Console/cake acl create aco controllers Groups
sudo sh lib/Cake/Console/cake acl create aco Groups index
sudo sh lib/Cake/Console/cake acl create aco Groups add
/*radiotaxicars*/
sudo sh lib/Cake/Console/cake acl create aco controllers Radiotaxicars
sudo sh lib/Cake/Console/cake acl create aco Radiotaxicars index
sudo sh lib/Cake/Console/cake acl create aco Radiotaxicars add
sudo sh lib/Cake/Console/cake acl create aco Radiotaxicars delete
sudo sh lib/Cake/Console/cake acl create aco Radiotaxicars listcars
sudo sh lib/Cake/Console/cake acl create aco Radiotaxicars getcars
sudo sh lib/Cake/Console/cake acl create aco Radiotaxicars exists
sudo sh lib/Cake/Console/cake acl create aco Radiotaxicars changestate
sudo sh lib/Cake/Console/cake acl create aco Radiotaxicars getcars
/*Radiotaxis*/
sudo sh lib/Cake/Console/cake acl create aco controllers Radiotaxis
sudo sh lib/Cake/Console/cake acl create aco Radiotaxis charts
sudo sh lib/Cake/Console/cake acl create aco Radiotaxis orders
sudo sh lib/Cake/Console/cake acl create aco Radiotaxis get_data_to_chart



CREATE SEQUENCE public.radiotaxicars_id_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE public.radiotaxicars_id_seq
  OWNER TO postgres;
