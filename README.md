# API REST for manage resource "Experiences"


## IMPORT DB
- import from PHPMyAdmin (or other) database/db_holidays.sql


## Testing with postman
The API endpoint is: http://localhost/Web2/TPE-2/api/experiencies

## LIST ALL EXERIENCES
http://localhost/Web2/TPE-2/api/experiencies

## LIST By ID
http://localhost/Web2/TPE-2/api/experiencies/52

## PAGINATION
Add query params to GET requests:

/experiencies?page=1&limit=10

## ORDER BY
Order by price desc 
http://localhost/Web2/TPE-2/api/experiencies?orderBy=price&orderBy=desc
 
Order by days asc
http://localhost/Web2/TPE-2/api/experiencies?orderBy=days&orderBy=asc


## FILTERING BY CONDITION
Add query params to GET request:

http://localhost/Web2/TPE-2/api/experiencies?filterBy=days&value=5


## Examples:

List all experiences
http://localhost/Web2/TPE-2/api/experiencies

Filter by ID
http://localhost/Web2/TPE-2/api/experiencies/52

Fulter by Condition 5 (Days)
http://localhost/Web2/TPE-2/api/experiencies?filterBy=days&value=5

Order by days desc and page 2 (limit 2 per page)
http://localhost/Web2/TPE-2/api/experiencies?orderBy=days&order=asc&page=2&limit=2

Order by price desc 
http://localhost/Web2/TPE-2/api/experiencies?orderBy=price&orderBy=desc
 
Order by days asc
http://localhost/Web2/TPE-2/api/experiencies?orderBy=days&orderBy=asc


## FILTERING BY CONDITION
Add query params to GET request:

