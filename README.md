# salt-unicef-web

# API for checking User & Role
# URL (local)
localhost/api/user_role_app?email=ac@a.com&pwd=0123

# API for Data synchronization
localhost/api/sync_data_app
# Sample of Post Json data to server for Synchronization
[
	{
		"producers" : [
					{"facility_id":"1","measurement_1":"20","measurement_2":"30"},
					{"facility_id":"1","measurement_1":"10","measurement_2":"20"}
			]
	},
	{
		"monitors" : [
					{"producer_id":"2","measurement":"20","warning" :"0"},
					{"producer_id":"2","measurement":"10","warning" :"1"}
			]
	}
]
