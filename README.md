# salt-unicef-web

# API for checking User & Role : [ Method Get ]
# URL (local)
localhost/api/user_role_app?email=ac@a.com&pwd=0123

# Return value 
1. {"data":{"message":"Ok","user":{"id":10,"name":"admin","email":"admin@a.com","role":1,"facility_id":null}}}

2. {"data":{"message":"User doesn't exist"}}

3. {"data":{"message":"Incorrect password"}}


# URL (local) API for Data synchronization : [ Method Get ]
localhost/api/sync_data_app

# Sample of Post Json data to server for Synchronization
[
	{
		"producer_measurements" : [
					{"facility_id":"1","date_of_data":"2018-04-05 10:30:31","quantity_salt_processed":10,"quantity_potassium_iodate": 11,"stock_potassium":2,"measurement_1":"20","measurement_2":"30"},
					{"facility_id":"1","date_of_data":"2018-04-05 10:30:31","quantity_salt_processed":10,"quantity_potassium_iodate": 11,"stock_potassium":2,"measurement_1":"10","measurement_2":"20"}
			]
	},
	{
		"monitor_measurements" : [
					{"facility_id":"2","at_producer_site":"1","location":"","latitude":"","longitude":"","measurement":"20","warning" :"0", "date_of_visit":"2018-04-05 10:30:31","date_of_follow_up":""},
					{"facility_id":"2","at_producer_site":"0","location":"Rousey Keo, PP","latitude":"","longitude":"","measurement":"20","warning" :"0", "date_of_visit":"2018-04-05 10:30:31","date_of_follow_up":""}
			]
	}
]


# Return value
1. {"code":"200","message":"Ok"}

2. Error 
{"code":"500","message":"SQLSTATE[42S02]: Base table or view not found: 1146 Table 'salt.producers' doesn't exist (SQL: insert into `producers` (`facility_id`, `measurement_1`, `measurement_2`) values (1, 20, 30))"}

# URL (local) API for Get list of facilities: [ Method Get ]
localhost/api/list_facilities_app

# Return value
{"facilities":[{"id":1,"facility_ref_id":"F_001","facility_name":"Daun Keo Salt Facility"},{"id":2,"facility_ref_id":"F_002","facility_name":"Village Salt Facility"},{"id":3,"facility_ref_id":"F_003","facility_name":"Kompot Salt Facility"}]}