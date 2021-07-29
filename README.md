# Proxy checker

## How to start a project
1) docker-compose up -d
2) composer install

project host = ```http://localhost:8000```

## adminer
adminer = ```http://localhost:8080```

```
server: db
user:   root
pas:    root
```

// написать вручную вход в контейнер и запуск миграции


1) В комадной строке узнать название контейнера через
```
docker ps
```

2) Заходим в контейнер 
```
docker exec -it <CONTAINER ID> bash
```

3) Start migration
```
php artisan migrate 
```
