PHPunit. 
=============================

This repository has some PHPunit tests embedded. 
U simply can run it with the terminal commando `phpunit` if phpunit is gobally installed.

## Installing PHPunit.

They distribute a PHP Archiece (PHAR) that has all required (as well as some optional) dependencies of PHPunit
bundled in a single file. 

```bash
$ wget https://phar.phpunit.de/phpunit.phar

$ chmod +x phpunit.phar

$ mv phpunit.phar /usr/local/bin/phpunit
```

You can also immediatly use the PHAR after you have downloadd it, of course:

```bash
php phpunit.phar
```

## Testing groups.

You can also test everything with specif groups. 

### Example command: 

```bash
$ php phpunit.phar

$ phpunit --group {group name}
```

### Groups and ther desciption. 

| Group:              | Description:                              |
| :------------------ | :---------------------------------------- |
| `all`               | Run all the tests.                        |
| `rental`            | Run all the tests for the rental system.  |
| `backend`           | Run all the tests for the backend system. |
| `database`          | Run all the database tests.               |
