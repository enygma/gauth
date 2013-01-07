GAuth : Google Authenticator Code Generator/Validation
=========================

The `GAuth` library is designed to generate and validate codes compatible with the
Google Authenticator tools.

### Installation via Composer:

Include in your `composer.json` file:

```
{
    "require": {
        "enygma/gauth": "dev-master"
    }
}
```

Sample usage:

#### To generate a new code:

```php
<?php

require_once 'vendor/autoload.php';

// Useful for creating a new Initialization key if needed
$g = new \GAuth\Auth();
$code = $g->generateCode();
var_dump($code);

?>
```

#### To validate a code

```php
<?php

$code = 'code-inputted-from-user';

$g = new \GAuth\Auth();
$verify = $g->validateCode($code);

if ($verify == true) {
    echo 'User code verified!';
} else {
    echo 'User code invalid!';
}
?>
```

#### More info:

- [Google TOTP Two-factor Authentication for PHP](http://www.idontplaydarts.com/2011/07/google-totp-two-factor-authentication-for-php/)
- [Links to client for smartphones](http://support.google.com/accounts/bin/answer.py?hl=en&answer=1066447)