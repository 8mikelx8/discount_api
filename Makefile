setup: 
	sh ./setup.sh
de: 
	docker exec -it discount_api_php /bin/sh

test:
	docker exec -it discount_api_php composer test