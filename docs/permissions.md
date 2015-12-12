# Permissions: 

We have build some permission role's into the project. These permission are implemented with middleware.You can find info about each role below:

- [Permissions overview]() 
- [Create new Permission]()

## Permissions overview.

#### leden-beheer

Has permission for: 

- Block and unblock a user. 
- Delete a user. 
- Listing view for all the user. 
- Register a new login.

### verhuur-beheer

Has permission for: 

- Can insert a new rental trough the back-end
- Can view and download the data for the rantal dates.
- Can enable or disable the rental email notifications.
- Can change the status of a rental. 
- Can delete a rental.

### media

Has permission for: 

### cloud 

Has permission for: 

- Upload files in the cloud. 
- Remove files. 
- View and download files.

## Create new permission.

```php 
<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('update-post', function ($user, $post) {
            return $user->id === $post->user_id;
        });
    }
}
```

You easily can add or change permission roles. 
