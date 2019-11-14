## Installation

Install via composer:

```bash
$ composer require zendframework/zend-mvc-plugin-identity
```

If you are using the [zend-component-installer](https://docs.zendframework.com/zend-component-installer/),
you're done!

If not, you will need to add the component as a module to your
application. Add the entry `'Zend\Mvc\Plugin\Identity'` to
your list of modules in your application configuration (typically
one of `config/application.config.php` or `config/modules.config.php`).

## Usage

The `Identity` plugin allows retrieving the identity from the
`AuthenticationService`.

For the `Identity` plugin to work, a
`Zend\Authentication\AuthenticationService` or
`Zend\Authentication\AuthenticationServiceInterface` name or
alias must be defined and recognized by the `ServiceManager`.

`Identity` returns the identity in the `AuthenticationService`
or `null` if no identity is available.

As an example:

```php
public function testAction()
{
    if ($user = $this->identity()) {
         // someone is logged !
    } else {
         // not logged in
    }
}
```

When invoked, the `Identity` plugin will look for a service
by the name or alias `Zend\Authentication\AuthenticationService` 
in the `ServiceManager`. You can provide this service to the
`ServiceManager` in a configuration file:

```php
// In a configuration file...
use Zend\Authentication\AuthenticationService;

return [
    'service_manager' => [
        'aliases' => [
            AuthenticationService::class => 'my_auth_service',
        ],
        'invokables' => [
            'my_auth_service' => AuthenticationService::class,
        ],
    ],
];
```

If such service is not found, the plugin will look for a&nbsp;service
named `Zend\Authentication\AuthenticationServiceInterface` in
the `ServiceManager`. For example:

```php
use Zend\Authentication\AuthenticationServiceInterface;

return [
    'service_manager' => [
        'factories' => [
            AuthenticationServiceInterface::class => MyAuthenticationServiceFactory::class,
        ],
    ],
];
```

The `Identity` plugin exposes two methods:

- `setAuthenticationService(AuthenticationServiceInterface $authenticationService) : void`:
  Sets the authentication service instance to be used by the plugin.

- `getAuthenticationService() : AuthenticationServiceInterface`:
  Retrieves the current authentication service instance if any is attached.
