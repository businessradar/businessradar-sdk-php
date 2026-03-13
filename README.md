# Business Radar PHP API library

The Business Radar PHP library provides convenient access to the Business Radar REST API from any PHP 8.1.0+ application.

## Documentation

The REST API documentation can be found on [api.businessradar.com](https://api.businessradar.com/ext/v3/).

Reach out to support@businessradar.com for any technical questions/suggestions.

## Installation

<!-- x-release-please-start-version -->

```
composer require "businessradar/businessradar 0.4.0"
```

<!-- x-release-please-end -->

## Usage

This library uses named parameters to specify optional arguments.
Parameters with a default value must be set by name.

```php
<?php

use Businessradar\Client;

$client = new Client(apiKey: getenv('BUSINESSRADAR_API_KEY') ?: 'My API Key');

$page = $client->news->articles->list();

var_dump($page->external_id);
```

### Value Objects

It is recommended to use the static `with` constructor `PortfolioCompanyDetailRequest::with(externalID: '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e', ...)`
and named parameters to initialize value objects.

However, builders are also provided `(new PortfolioCompanyDetailRequest)->withExternalID('182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e')`.

### Pagination

List methods in the Business Radar API are paginated.

This library provides auto-paginating iterators with each list response, so you do not have to request successive pages manually:

```php
<?php

use Businessradar\Client;

$client = new Client(apiKey: getenv('BUSINESSRADAR_API_KEY') ?: 'My API Key');

$page = $client->news->articles->list(nextKey: '24345');

var_dump($page);

// fetch items from the current page
foreach ($page->getItems() as $item) {
  var_dump($item->external_id);
}
// make additional network requests to fetch items from all pages, including and after the current page
foreach ($page->pagingEachItem() as $item) {
  var_dump($item->external_id);
}
```

### Handling errors

When the library is unable to connect to the API, or if the API returns a non-success status code (i.e., 4xx or 5xx response), a subclass of `Businessradar\Core\Exceptions\APIException` will be thrown:

```php
<?php

use Businessradar\Core\Exceptions\APIConnectionException;
use Businessradar\Core\Exceptions\RateLimitException;
use Businessradar\Core\Exceptions\APIStatusException;

try {
  $page = $client->news->articles->list();
} catch (APIConnectionException $e) {
  echo "The server could not be reached", PHP_EOL;
  var_dump($e->getPrevious());
} catch (RateLimitException $e) {
  echo "A 429 status code was received; we should back off a bit.", PHP_EOL;
} catch (APIStatusException $e) {
  echo "Another non-200-range status code was received", PHP_EOL;
  echo $e->getMessage();
}
```

Error codes are as follows:

| Cause            | Error Type                     |
| ---------------- | ------------------------------ |
| HTTP 400         | `BadRequestException`          |
| HTTP 401         | `AuthenticationException`      |
| HTTP 403         | `PermissionDeniedException`    |
| HTTP 404         | `NotFoundException`            |
| HTTP 409         | `ConflictException`            |
| HTTP 422         | `UnprocessableEntityException` |
| HTTP 429         | `RateLimitException`           |
| HTTP >= 500      | `InternalServerException`      |
| Other HTTP error | `APIStatusException`           |
| Timeout          | `APITimeoutException`          |
| Network error    | `APIConnectionException`       |

### Retries

Certain errors will be automatically retried 2 times by default, with a short exponential backoff.

Connection errors (for example, due to a network connectivity problem), 408 Request Timeout, 409 Conflict, 429 Rate Limit, >=500 Internal errors, and timeouts will all be retried by default.

You can use the `maxRetries` option to configure or disable this:

```php
<?php

use Businessradar\Client;

// Configure the default for all requests:
$client = new Client(requestOptions: ['maxRetries' => 0]);

// Or, configure per-request:
$result = $client->news->articles->list(requestOptions: ['maxRetries' => 5]);
```

## Advanced concepts

### Making custom or undocumented requests

#### Undocumented properties

You can send undocumented parameters to any endpoint, and read undocumented response properties, like so:

Note: the `extra*` parameters of the same name overrides the documented parameters.

```php
<?php

$page = $client->news->articles->list(
  requestOptions: [
    'extraQueryParams' => ['my_query_parameter' => 'value'],
    'extraBodyParams' => ['my_body_parameter' => 'value'],
    'extraHeaders' => ['my-header' => 'value'],
  ],
);
```

#### Undocumented request params

If you want to explicitly send an extra param, you can do so with the `extra_query`, `extra_body`, and `extra_headers` under the `request_options:` parameter when making a request, as seen in the examples above.

#### Undocumented endpoints

To make requests to undocumented endpoints while retaining the benefit of auth, retries, and so on, you can make requests using `client.request`, like so:

```php
<?php

$response = $client->request(
  method: "post",
  path: '/undocumented/endpoint',
  query: ['dog' => 'woof'],
  headers: ['useful-header' => 'interesting-value'],
  body: ['hello' => 'world']
);
```

## Versioning

This package follows [SemVer](https://semver.org/spec/v2.0.0.html) conventions. As the library is in initial development and has a major version of `0`, APIs may change at any time.

This package considers improvements to the (non-runtime) PHPDoc type definitions to be non-breaking changes.

## Requirements

PHP 8.1.0 or higher.

## Contributing

See [the contributing documentation](https://github.com/businessradar/businessradar-sdk-php/tree/main/CONTRIBUTING.md).
