## PHP QR CODE

This source is base in v1.1.4 (2010100721) of http://phpqrcode.sourceforge.net/<br>
I just modified and fixed a little bit of code.

### REQUIREMENTS

 * PHP7.2
 * PHP GD2 extension with JPEG and PNG support

## QUICK START

```composer require jysperu/php-qr-code```

```php
<?php
require_once '/path/to/vendor/autoload.php';

QRcode::png('PHP QR Code :)', 'test.png', 'L', 4, 2);
```
