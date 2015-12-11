# Project artisan commands 

Laravel ships with a handy console environment. Below u find a list of all the commands but all the commands
needs a prefix called `php artisan`.

* [Commands](#project-artisan-commands)
    * [Options](#options)
    * [General Commands](#general-commands)
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

| Option:                | Description:                                                                                        |
| ---------------------- | --------------------------------------------------------------------------------------------------- |
| `-h, --help`           | Display this help message.                                                                          |
|`-q, --quiet`           | Do not output any message.                                                                          |
| `-V, --version`        | Display this application version.                                                                   |
| `--ansi`               | Force ANSI output.                                                                                  |
| `--no-ansi`            | Disable ANSI output.                                                                                |
| `-n, --no-interaction` | Do not ask any interactive question.                                                                |
| `--env[ENV]`           | The environment the command should run under.                                                       |
| `-v|vv|vvv, --verbose` | Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug. |

### General commands 

| Command:         | Description:                                         |
| ---------------- | ---------------------------------------------------- |
| `clear-compiled` | Remove the compiled class file.                      |
| `down`           | Put the application into maintenance mode.           |
| `env`            | Display the current framework environment.           |
| `help`           | Displays help for a command.                         |
| `inspire`        | Display an inspiring quote.                          |
| `list`           | Lists commands.                                      |
| `migrate`        | Run the database migrations.                         |
| `optimize`       | Optimize the framework for better performance.       |
| `serve`          | Serve tge application on the PHP development server. |
| `tinker`         | Interact with your application.                      |
| `up`             | Bring the application out of maintenance mode.       |

### Application

| Command:   | Description:                   |
| ---------- | ------------------------------ |
| `app:name` | Set the application namespace. |

### Authencation 

| Command:            | Description:                         |
| ------------------- | ------------------------------------ |
| `auth:clear-resets` | Flush expired password reset tokens. |

### Cache 

| Command:      | Description:                                     |
| ------------- | ------------------------------------------------ |
| `cache:clear` | Flush the application cache.                     |
| `cache:table` | Create a migration for teh cache database table. |

### Config

| Command:       | Description:                                           |
| -------------- | ------------------------------------------------------ |
| `config:cache` | Create a cache file or faster configuration loading.   |
| `config:clear` | Remove the configuration cache file.                   |

### Debugbar

| Command:          | Description:                |
| ----------------- | ----------------------------|
| `debugbar:clear`  | Clear the debugbar storage. |

### Database

| Command:  | Description:                    |
| --------- | ------------------------------- |
| `db:seed` | Seed the database with records. |

    
### Event 

| Command:          | Description:                                                     |
| ----------------- | ---------------------------------------------------------------- |
| `event:generate`  | Generate the missing events ans listeners based on registration. |
| `event:scan`      | Scan a directory for event annotations.                          |

### Handler

| Command:          | Description:                        |
| ----------------- | ----------------------------------- |
| `handler:command` | Create a new command handler class. |
| `handler:event`   | Create a new event handler class.   |

### Ide-helper

| Command:              | Description:                        |
| --------------------- | ----------------------------------- |
| `ide-helper:generate` | Generate a new IDE Helper file.     |
| `ide-helper:meta`     | Generate metadata for PhpStorm.     |
| `ide-helper:models`   | Generate autocompletion for models. |

### Key 

| Command:       | Description:             |
| -------------- | ------------------------ |
| `key:generate` | Set the application key. |

### Make

| Command:          | Description:                            |
| ----------------- | --------------------------------------- |
| `make:command`    | Create a new command class.             |
| `make:console`    | Create a new Artisan command.           |
| `make:controller` | Create a new resource controller class. |
| `make:event`      | Create a new event class.               |
| `make:job`        | Create a new job class.                 |
| `make:listener`   | Create a new event listener class.      |
| `make:middleware` | Create a new middleware class.          |
| `make:migration`  | Create a new migration file.            |
| `make:model`      | Create a new Eloquent model class.      |
| `make:policy`     | Create a new policy class.              |
| `make:provider`   | Create a new service provider class.    |
| `make:request`    | Create a new form request class.        |
| `make:seeder`     | Create a new seeder class.              |
| `make:test`       | Create a new test class.                |

### Migrate

| Command:           | Description:                          |
| ------------------ | ------------------------------------- |
| `migrate:install`  | Create the migration repository.      |
| `migrate:refresh`  | Reset and re-run all migrations.      |
| `migrate:reset`    | Rollback all database migrations.     |
| `migrate:rollback` | Rollback the last database migration. |
| `migrate:status`   | Show the status of each migration.    |

### Model

| Command:              | Description:                            |
| --------------------- | --------------------------------------- |
| `model:scan`          | Scan a directory for model annotations. |

### Queue 

| Command:              | Description:                                                  |
| --------------------- | ------------------------------------------------------------- |
| `queue:failed`        | List all of the failed queue jobs.                            |
| `queue:failed-jobs`   | Create a migration for the failed queue jobs database table.  |
| `queue:flush`         | Flush all of the failed queue jobs.                           |
| `queue:forget`        | Delete a failed queue job.                                    |
| `queue:listen`        | Listen to a given queue.                                      |
| `queue:restart`       | Restart queue worker daemons after their current job.         |
| `queue:retry`         | Retry a failed queue job.                                     |
| `queue:subscribe`     | Subscribe a URL to an Iron.io push queue.                     |
| `queue:table`         | Create a migration for the queue jobs database table.         |
| `queue:work`          | Process the next job on a queue.                              |

### Routing 

| Command:      | Description:                                             |
| ------------- | -------------------------------------------------------- |
| `route:cache` | Create a route cache file for faster route registration. |
| `route:clear` | Remove the route cache file.                             |
| `route:list`  | List all registered routes.                              |
| `route:scan`  | Scan a directory for controller annotations.             |

### Schedule 

| Command:       | Description:                |
| -------------- | --------------------------- |
| `schedule:run` | Run the scheduled commands. |

### Session

| Command:        | Description:                                       |
| --------------- | -------------------------------------------------- |
| `session:table` | Create a migration for the session database table. |

### Vendor

| Command:          | Description:                                         |
| ----------------- | ---------------------------------------------------- |
| `vendor:publish`  | Publish any publishable assets from vendor packages. |

### View

| Command:      | Description:                        |
| ------------- | ----------------------------------- |
| `view:clear`  | Clear all compiled view files.      |