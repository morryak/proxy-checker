# Proxy checker

### How to start a project
1) Open console and run
```
docker-compose up
```   
2) Enter docker container
```
docker exec -it <CONTAINER ID> bash
```

3) Install dependencies  
```
composer install
```
4) Make migration
```
php artisan migrate 
```

Project host = ```http://localhost:8000```

### adminer
 ```
http://localhost:8080

server: db
user:   root
pas:    root
```
