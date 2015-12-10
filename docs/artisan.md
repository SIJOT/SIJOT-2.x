# Project artisan commands 

Laravel ships with a handy console environment. Below u find a list of all the commands but all the commands
needs a prefix called `php artisan`.

* [Commands](#project-artisan-commands)
    * [Options](#options)
    * [Application](#application)
    * [Authencation](#authencation)
    * [Cache](#cache)
    * [Config](#config)
    * [Database](#database)
    * [Debugbar](#debugbar)
    * [Event](#event)
    * [Handler](#handler)
    * [IDE Helper](#ide-helper)
    * [Key](#key)
    * [Make](#make)
    * [Migrate](#migrate)
    * [Model](#model)
    * [Queue](#queue)
    * [Routing](#routing)
    * [Schedule](#schedule)
    * [Session](#session)
    * [Vendor](#vendor)
    * [View](#view)

### Options

- `php artisan -h, --help`
    - Display this help message. 
- `php artisan -q, --quiet` 
    - Do not output any message. 
- `php artisan -V, --version`
    - Display this application version.
- `php artisan --ansi`
    - Force ANSI output.
- `php artisan --no-ansi`
    - Disable ANSI output. 
- `php artisan -n, --no-interaction`
    - Do not ask any interactive question. 
- `php artisan --env[ENV]` 
    - The environment the command should run under.
- `php artisan -v|vv|vvv, --verbose` 
    - Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug.

### View

| Command:      | Description:                        |
| ------------- | ----------------------------------- |
| `view:clear`  | Clear all compiled view files.      |