Permissions: 
===============

We have build some permission role's into the project. You can find info about each role below:

- [Permissions overview]() 
- [Create new Permission]()

## Permissions overview.

#### leden-beheer

Has permission for: 

- Block and unblock a user. 
- Delete a user. 
- Listing view for all the user. 
- Register a new login.

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
