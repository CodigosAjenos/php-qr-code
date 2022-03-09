## PHP QR CODE

This source is base in v1.1.4 (2010100721) of [phpqrcode.sourceforge.net](http://phpqrcode.sourceforge.net/) <br>
I just modified and fixed a little bit of code.

### REQUIREMENTS

 * PHP7.2
 * PHP GD2 extension with JPEG and PNG support

## QUICK START WIDTH COMPOSER

```composer require jysperu/php-qr-code```

```php
<?php
require_once '/path/to/vendor/autoload.php';
```

## QUICK START WIDTHOUT COMPOSER

```php
<?php
spl_autoload_register(function ($class) {
    static $dir = '/path/to/src';
    static $spc = '\\';

    $class = trim($class, $spc);
    $parts = explode($spc, $class);
    $base  = array_shift($parts);

    if ($base <> 'QRcode' or count($parts) === 0) return;

    $parts = implode(DIRECTORY_SEPARATOR, $parts);
    $file = $dir . DIRECTORY_SEPARATOR . $parts . '.php';

    if (file_exists($file))
        require_once $file;
});
```

## EXAMPLES

#### Saving PNG image

```php
use QRcode\QRcode;
use QRcode\QRstr;

$data = 'Hello World!';
$dest = __DIR__ . '/qr.png';

QRcode :: png ($data, $dest, QRstr :: QR_ECLEVEL_L, 4, 2);
## Expected: New file
```

#### Saving WEBP image

```php
use QRcode\QRcode;
use QRcode\QRstr;

$data = 'Hello World!';
$dest = __DIR__ . '/qr.webp';

QRcode :: webp ($data, $dest, QRstr :: QR_ECLEVEL_L, 4, 2);
## Expected: New file
```

#### Printing PNG image

```php
use QRcode\QRcode;
use QRcode\QRstr;

$data = 'Hello World!';

QRcode :: png ($data, FALSE, QRstr :: QR_ECLEVEL_L, 4, 2);
## Expected: Header: Content-type: image/png
```

#### Printing WEBP image

```php
use QRcode\QRcode;
use QRcode\QRstr;

$data = 'Hello World!';

QRcode :: webp ($data, FALSE, QRstr :: QR_ECLEVEL_L, 4, 2);
## Expected: Header: Content-type: image/webp
```

#### Getting PNG image data

```php
use QRcode\QRcode;
use QRcode\QRstr;

$data = 'Hello World!';

$base64_data = QRcode :: base64_png ($data, QRstr :: QR_ECLEVEL_L, 4, 2);
## Expected: $base64_data = data:image/png;base64,....
```

#### Getting WEBP image data

```php
use QRcode\QRcode;
use QRcode\QRstr;

$data = 'Hello World!';

$base64_data = QRcode :: base64_webp ($data, QRstr :: QR_ECLEVEL_L, 4, 2);
## Expected: $base64_data = data:image/webp;base64,....
```
