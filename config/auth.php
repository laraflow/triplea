<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => 'App\Models\User',
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that each reset token will be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,

    /*
    |--------------------------------------------------------------------------
    | Model class is used for auth
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'model' => 'App\Models\User',

    /*
    |---------------------------------------------------------------------
    | Prefix of Admin Login Route
    |---------------------------------------------------------------------
    |
    | Adding a Prefix to Admin Login Routes  Group
    | If there are to section like frontend & backend
    | then make route separate route group
    |
    | @var string
    */

    'prefix' => '/',

    /*
    |---------------------------------------------------------------------
    | Authentication Medium
    |---------------------------------------------------------------------
    |
    | Authentication medium used to authentication
    |
    | @reference \Modules\Admin\Supports\Constant::class
    | @var string [email, username, mobile, otp]
    */

    'credential_field' => 'username',

    /*
    |---------------------------------------------------------------------
    | OTP Medium
    |---------------------------------------------------------------------
    |
    | OTP Confirmation Medium
    |
    | @reference \Modules\Admin\Supports\Constant::class
    | @var string [email, mobile]
    */

    'credential_otp_field' => 'mobile',

    /*
    |--------------------------------------------------------------------------
    | Allow Self-Register Route
    |--------------------------------------------------------------------------
    |
    | Here you may define if you want to allow anyone to self-register.
    | By default, the permission is set to true.
    |
    */

    'allow_register' => false,

    /*
    |---------------------------------------------------------------------
    | Allow Persistent Login Cookies (Remember me)
    |---------------------------------------------------------------------
    |
    | While every attempt has been made to create a very strong protection
    | with to remember me system, there are some cases (like when you
    | need extreme protection, like dealing with users financials) that
    | you might not want the extra risk associated with this cookie-based
    | solution.
    |
    | @var bool
    */

    'allow_remembering' => false,

    /*
    |---------------------------------------------------------------------
    | Minimum Password Length
    |---------------------------------------------------------------------
    |
    | The minimum length that a password must be to be accepted.
    | Recommended minimum value by NIST = 8 characters.
    |
    | @var int
    */

    'minimum_password_length' => 8,

    /*
    |---------------------------------------------------------------------
    | Self Password Reset
    |---------------------------------------------------------------------
    |
    | Allow user to reset his/her own password
    | If he/she has forgotten
    |
    | @var bool
    */

    'allow_password_reset' => true,

    /*
    |---------------------------------------------------------------------
    | View File(s) Location
    |---------------------------------------------------------------------
    |
    | If you want to use customized view just publish this view files
    | then set your new files location here. I personally don't like
    |  forcing other to make vendor folder project folder etc.
    |
    | N.B: Don't rename index, They are for advanced customization
    |
    | @var string []
    */

    'view' => [
        'login' => 'triplea::auth.login',
        'register' => 'triplea::auth.register',
        'forgot-password' => 'triplea::auth.forgot-password',
        'reset-password' => 'triplea::auth.reset-password',
        'verify-email' => 'triplea::auth.verify-email',
        'confirm-password' => 'triplea::auth.confirm-password',
        'lock-screen' => 'triplea::auth.lock-screen',
    ],

];