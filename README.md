# Hutulia/Pagination

Work with abstract pagination by php

## Installation

```bash
composer require hutulia/pagination
```

## Usage

### Example 1

```php

use Hutulia\Pagination\Pagination;

require_once 'vendor/autoload.php';

$totalItems  = 11;
$perPage     = 3;
$currentPage = 2;
$pagination  = new Pagination($totalItems, $perPage, $currentPage);

$template = 'Showing {START} - {END} of {TOTAL}. Page {CURRENT_PAGE} of {TOTAL_PAGES}';

echo $pagination->render($template);
// Showing 4 - 6 of 11. Page 2 of 4
```

### Example 2

```php

use Hutulia\Pagination\Pagination;

require_once 'vendor/autoload.php';

$totalItems  = 11;
$perPage     = 3;
$currentPage = 2;
$pagination  = new Pagination($totalItems, $perPage, $currentPage);

echo $pagination->getStart();
// 4

echo $pagination->getEnd();
// 6

echo $pagination->getTotal();
// 11

echo $pagination->getCurrentPage();
// 2

echo $pagination->getTotalPages();
// 4
```

## License
[MIT](https://choosealicense.com/licenses/mit/)