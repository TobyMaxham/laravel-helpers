# TobyMaxham Laravel Helpers

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tobymaxham/laravel-helper.svg?style=flat-square)](https://packagist.org/packages/tobymaxham/laravel-helper)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Quality Score](https://img.shields.io/scrutinizer/g/TobyMaxham/laravel-helpers.svg?style=flat-square)](https://scrutinizer-ci.com/g/TobyMaxham/laravel-helpers)
[![StyleCI](https://styleci.io/repos/143056829/shield?branch=master)](https://styleci.io/repos/143056829)
[![Total Downloads](https://img.shields.io/packagist/dt/tobymaxham/laravel-helper.svg?style=flat-square)](https://packagist.org/packages/tobymaxham/laravel-helper)

## Installation

You can install this package via composer:

```bash
composer require tobymaxham/laravel-helper
```

## Model Logging

### Track User changes

Track if user created, updated or deleted a `Model`. You have to add these attributes to you database table.
By default the fields `created_by`, `updated_by` and `deleted_by` fields will be used.

```php
namespace App;

use TobyMaxham\Helper\Models\Logs\ChangeByUser;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use ChangeByUser;
}
```

You could also turn off tracking by returning `false` to the attribute fetching methods:
```php
public function getCreatedByColumn()
{
    return false;
}
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.