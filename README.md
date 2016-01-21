# Flash #

Flash messenger that will keep messages until they are \"flushed\" - current or persistant states.

## Installation ##

Composer

```php
"require-dev": {
    "martynbiz/php-flash-message": "dev-master"
}
```

## Usage ##

Add message

```php
$flash = new \MartynBiz\FlashMessage\Flash;
$flash->addMessage('success', 'You have successfully registered');
```

Check if message exists by key

```php
$flash->has('success'); // true
$flash->has('errors'); // false
```

Flush messages

This method can be called during the same HTTP request or future request. This means
it is useful when redirecting but also forwarding to, for example, another controller
action. The contents of the container will be emptied when this method is called once.

```php
$messages = $flash->flushMessages();
```

## Using custom storage ##

It is possible to use your own storage object, as long as it implements ArrayAccess
interface. Below Zend\Storage\Container has been used:

```php
$container = new Zend\Session\Container('mycontainer');
$flash = new Flash($container);
```



TODO

* create a simple session storage as default
