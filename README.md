HostedSMS API
================

PHP API Client for sending SMS messages via HostedSMS.pl SimpleApi

**[HostedSMS.pl SimpleApi documentation](https://hostedsms.pl/pl/api-sms/opis-techniczny-api/)**

### Sending SMS
```php
    $hostedSmsApi = new HostedSmsApi();

    $response = $hostedSmsApi->sendSimpleSms(
			$userEmail,
			$password,
			$sender,
			$phone,
			$message
		);
```
### Requirements
php >= wstawić wersję  
composer (https://getcomposer.org/)

### Install package with dependencies

`composer require simpleapi/php-client`