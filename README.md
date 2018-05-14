# salt-unicef-web

## 1. API for checking User & Role : [ Method Get ]
```
localhost/api/user_role_app?email=ac@a.com&pwd=0123
```
#### Result/Output
##### Correct Email and Password
```
{   
    "data":{
        "message":"Ok",
        "user":{
            "id":10,
            "name":"admin",
            "email":"admin@a.com",
            "role":1,
            "facility_id":null
        }
    }
}
```
##### User doesn't exist
```
{
    "data":{"message":"User doesn't exist"}
}
```
##### Incorrect password
```
{
    "data":{"message":"Incorrect password"}
}
```

## 2. API for Data synchronization : [ Method Get ]
```
localhost/api/sync_data_app
```
#### Sample of Post Json data to server for Synchronization
```
[
	{
		"producer_measurements" : [
					{"user_id":"2","facility_id":"1","date_of_data":"2018-04-05 10:30:31","quantity_salt_processed":50,"quantity_potassium_iodate": 11,"stock_potassium":2,"measurement_1":"50","measurement_2":"30"},
					{"user_id":"2","facility_id":"1","date_of_data":"2018-04-05 10:30:31","quantity_salt_processed":30,"quantity_potassium_iodate": 31,"stock_potassium":2,"measurement_1":"30","measurement_2":"10"}
			]
	},
	{
		"monitor_measurements" : [
					{"monitor_id":"3","facility_id":"1","at_producer_site":"1","location":"","latitude":"","longitude":"","measurement":"30","warning" :"1", "date_of_visit":"2018-04-05 10:30:31","date_of_follow_up":""},
					{"monitor_id":"3","facility_id":"1","at_producer_site":"0","location":"Rousey Keo, PP","latitude":"","longitude":"","measurement":"60","warning" :"1", "date_of_visit":"2018-04-05 10:30:31","date_of_follow_up":""}
			]
	}
]
```
#### Result/Output
##### Successfully Inserted data
```
{
    "code":"200",
    "message":"Ok"
}
```
##### Error while insertion
```
{
    "code":"500",
    "message":"SQLSTATE[42S02]: Base table or view not found: 1146 Table 'salt.producers' doesn't exist (SQL: insert into `producers` (`facility_id`, `measurement_1`, `measurement_2`) values (1, 20, 30))"
}
```
## 3. API for Get list of facilities: [ Method Get ]
```
localhost/api/list_facilities_app
```
#### Result/Output
##### Successfully Inserted data
```
{
    "facilities":[
            {"id":1,"facility_ref_id":"F_001","facility_name":"Daun Keo Salt Facility"},
            {"id":2,"facility_ref_id":"F_002","facility_name":"Village Salt Facility"},
            {"id":3,"facility_ref_id":"F_003","facility_name":"Kompot Salt Facility"}
        ]
}
```