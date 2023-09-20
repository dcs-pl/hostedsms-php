HostedSMS API
================

Php API Client for sending SMS messages via HostedSMS.pl SimpleApi

**[HostedSMS.pl SimpleApi documentation](https://hostedsms.pl/pl/api-sms/opis-techniczny-api/)**

## Sending SMS
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

## Install package with dependencies

`komenda dla composera by pobrać paczkę`