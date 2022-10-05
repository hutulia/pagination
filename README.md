# Hutulia/Pagination

Work with abstract pagination by php

## Installation

```bash
composer require hutulia/pagination
```

## Usage

### Example 1: Just work with pagination programmatically

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


## Available vars for render & public methods
You can use any of these vars in template string: `{VAR_NAME}`, example: `{TOTAL}`.

Every property has its public getter: `$pagination->getPropName()`, example: `$pagination->getTotal()`.

Here is how supported render vars are created :

```
'TOTAL'                 => $this->getTotal(),
'PER_PAGE'              => $this->getPerPage(),
'TOTAL_PAGES'           => $this->getTotalPages(),
'CURRENT_PAGE'          => $this->getCurrentPage(),
'IS_START_PAGE'         => (int) $this->isStartPage(),
'IS_END_PAGE'           => (int) $this->isEndPage(),
'TOTAL_ON_CURRENT_PAGE' => $this->getTotalOnCurrentPage(),
'START'                 => $this->getStart(),
'END'                   => $this->getEnd(),
```

## License
[MIT](https://choosealicense.com/licenses/mit/)