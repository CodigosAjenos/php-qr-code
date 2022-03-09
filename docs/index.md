## PHP QR CODE

It's based in http://phpqrcode.sourceforge.net/

### REQUIREMENTS

 * PHP7.2
 * PHP GD2 extension with JPEG and PNG support

## QUICK START

```php
<?php
require_once '/path/to/vendor/autoload.php';

QRcode::png('PHP QR Code :)', 'test.png', 'L', 4, 2);
```
