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
## 4. API for requesting for data from Table facilities by number_of_records & last_download_date [ Method POST ]
```
localhost/api/get_updated_facility_lists_app
```
#### Sample of Post Json
```
{
	"number_of_records":"5",
	"last_download_date":"2018-05-02"

}
```
#### Result/Output
##### If number of records in app and server is matched, Return only updated records
```
{
    "code": "200",
    "equal": 0,
    "data": [
        {
            "id": 4,
            "facility_ref_id": "F_004",
            "facility_name": "ABC",
            "Latitude": null,
            "Longitude": null
        },
        {
            "id": 5,
            "facility_ref_id": "ss",
            "facility_name": "ss",
            "Latitude": null,
            "Longitude": null
        }
        ........
        ........
    ]
}
```
##### Else returned all records in tbl order_questions
```
{
    "code": "200",
    "equal": 0,
    "data": [
        {
            "id": 1,
            "facility_ref_id": "F_001",
            "facility_name": "Daun Keo Salt Facility",
            "Latitude": "11.582855",
            "Longitude": "104.833521"
        },
        {
            "id": 2,
            "facility_ref_id": "F_002",
            "facility_name": "Village Salt Facility",
            "Latitude": "11.582855",
            "Longitude": "104.833521"
        },
        {
            "id": 3,
            "facility_ref_id": "F_003",
            "facility_name": "Kompot Salt Facility",
            "Latitude": "11.582855",
            "Longitude": "104.833521"
        },
        {
            "id": 4,
            "facility_ref_id": "F_004",
            "facility_name": "ABC",
            "Latitude": null,
            "Longitude": null
        },
        {
            "id": 5,
            "facility_ref_id": "ss",
            "facility_name": "ss",
            "Latitude": null,
            "Longitude": null
        }
        ..........
        ..........
    ]
}
```
##### Input is not in JSON format
```
{
    "code": "500",
    "message": "Receiving data is not JSON format"
}
```
##### If number_of_records or/and last_download_date is empty
```
{
    "code": "500",
    "message": "Either Number of records or Last download date is null. Those fields are required."
}
```