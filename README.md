GAuth : Google Authenticator Code Generator/Validation
=========================

The `GAuth` library is designed to generate and validate codes compatible with the
Google Authenticator tools.

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