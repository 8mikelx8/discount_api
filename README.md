# Discount API
This is an example API with a single endpoint

## Requirements
* Docker is required to setup and run this API

## Setup
* Clone this repository
* Navigate to the root directory of this repository
* execute the setup script: `$ sh setup.sh`
* Once the setup process finishes (up to 2 minutes) the API shpuld be available in the machine's localhost on port 8080:
  * example API call: `http://localhost:8080/products?category=sandals&priceLessThan=100000`

## Usage
This API contains a single endpoint (`[GET] /products`).
This endpoint accepts 3 different query parameters:
* offset (integer): determines the initial Product to be retrieved from the database for pagination purposes
* category: allows filtering for products belonging to the provided category
* PriceLessThan (integer): Allos filtering for products than have an original price inferior to the provided value. 

## Testing
* To test this repositoy is important to have the docker up and running
* You can simply write `$ make test` from the project's root directory on your terminal.
* If make does not work you can execute `$ docker exec -it discount_api_php composer test`
