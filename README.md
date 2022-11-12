# API REST for manage resource "Experiences"

## AUTHENTICATION 
Not available yet.

## IMPORT DB
Import from PHPMyAdmin (or other) database/db_holidays.sql

## Testing with postman
The API endpoint is: http://localhost/Web2/TPE-2/api/experiencies


# API Methods
This API is based on RESTFUL principles and uses HTTP methods (GET) to access resources, (POST and PUT) to add or update data and (DELETE) to delete. The transfer format supported by the API to send and receive responses is JSON.

# Request	           Método	                Endpoint	                             Status
Get experiences 	    GET	        http://localhost/Web2/TPE-2/api/experiencies/	      200
Get experience by ID    GET	        http://localhost/Web2/TPE-2/api/experiencies/:ID	  200
Create experience       POST	    http://localhost/Web2/TPE-2/api/experiencies/	      201
Update experience	    PUT	        http://localhost/Web2/TPE-2/api/experiencies/:ID	  200
Delete experience	    DELETE	    http://localhost/Web2/TPE-2/api/experiencies/:ID	  200

## GET all experiences
http://localhost/Web2/TPE-2/api/experiencies

## GET an experience By ID
http://localhost/Web2/TPE-2/api/experiencies/:ID

## POST an experience (create)
http://localhost/Web2/TPE-2/api/experiencies

This request allows you to create a new product and save it in the database. To send it, use JSON in the body of the request.
Example:

BODY
   {
        "place": "Philippines",
        "days": 25,
        "price": 1200,
        "description": "Enjoy 25 incredible days!!",
        "boat_id": 35
    }

## PUT an experience (update)
http://localhost/Web2/TPE-2/api/experiencies/:ID
This request updates a product (ID) that already exists. To update it, use JSON in the body of the request. In the example below, the price of the previous experience is updated.

BODY
   {
        "place": "Philippines",
        "days": 25,
        "price": 50000,
        "description": "Enjoy 25 incredible days!!",
        "boat_id": 35
    }


## PARAMS

# Default params
In the event that some query parameters are omitted, GET requests will return the established default values.
They are page 1, limit 30, sorted by exp_id in ascending order. 

# Pagination
You will be able to paginate the results by adding the limit and page query params to the GET requests:
The following example, it returns page 1 with 10 experiences:

Page 1 - limit 10
/experiencies?page=1&limit=10

# Order
The results can be sorted by adding the orderBy (column to sort by) and order (asc or desc) params to the GET requests:
Examples: 

Order by price desc 
/experiencies?orderBy=price&orderBy=desc
 
Order by days asc
/experiencies?orderBy=days&orderBy=asc

# Filter by condition
Results can be returned filtered by column by adding filtercolumn (field to filter) and filtervalue (column value) query parameters to the GET request.
Examples: 

Filter by column "days" = 16
/experiencies?columnBy=days&filtervalue=16


# Errors
Specific API errors and error response messages are listed below.

Status      Error Code                              Message (example)
 400      "Bad request"                         Missing properties in PUT request
 404      "Not found"                           The experience id= xxx does not exist
 500      "Internal Server Error"               Internal Server Error


## USE EXAMPLES:

List all experiences
http://localhost/Web2/TPE-2/api/experiencies

Filter by ID
http://localhost/Web2/TPE-2/api/experiencies/52

Order by price desc 
http://localhost/Web2/TPE-2/api/experiencies?orderBy=price&order=desc
 
Order by days asc
http://localhost/Web2/TPE-2/api/experiencies?orderBy=days&order=asc

Filter by column "days" with value "16" 
http://localhost/Web2/TPE-2/api/experiencies?filtercolumn=days&filtervalue=16

Order by days desc and page 2 (limit 3 per page)
http://localhost/Web2/TPE-2/api/experiencies?orderBy=days&order=asc&page=2&limit=3

Filter by column "days" with value "16" orderBy exp_id desc - page 1 limit 3 
http://localhost/Web2/TPE-2/api/experiencies?filtercolumn=days&filtervalue=16&orderBy=exp_id&order=desc&page=1&limit=3


