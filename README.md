
# Project Title

A brief description of what this project does and who it's for

# Hutulia/Pagination

Work with abstract pagination by php

## Table of contents
[Description](#description)

- [Quick descriptive example](#quick-descriptive-example)

- [Full descriptive example](#full-descriptive-example)

[Some implementation details](#some-implementation-details)

[Installation](#installation)

[Usage](#usage)

- [Example 1: Just work with pagination programmatically](#example-just-work-with-pagination-programmatically)

- [Example 2: Simple renderer](#example-simple-renderer)

- [Example 3: Export To Plain Object](#example-export-to-plain-object)

[Reference](#reference)

- [Pagination](#reference-pagination)

- [Properties](#reference-pagination-properties)

- [API](#reference-pagination-api)

- [SimpleRenderer API](#reference-simplerenderer-api)

- [ExporterToPlainObject API](#reference-exporter-to-plain-object-api)

<a name="description"/>

## Description
Imagine we have a set of element: `['a', 'b', 'c', 'd', 'e']`.

We need to show them all to user, but we can show max 3 at once.
 So we use pagination to determine which elements when to show.

<a name="quick-descriptive-example"/>

### Quick descriptive example

#### We have
```php
['a', 'b', 'c', 'd', 'e']
```

#### We will produce (display the set by 3 items per page)

```php
Show page: 1
a
b
c

Show page: 2
d
e
```

<a name="full-descriptive-example"/>

### Full descriptive example:

```php
<?php

use Hutulia\Pagination\Pagination;

require_once 'vendor/autoload.php';

$items       = ['a', 'b', 'c', 'd', 'e'];
$total       = count($items);
$perPage     = 3;
$currentPage = 1;
$pagination  = new Pagination($total, $perPage, $currentPage);

//var_dump($pagination);

/*
Output is simplified:

object {
  total              : 5
  perPage            : 3
  totalPages         : 2
  currentPage        : 1
  isStartPage        : true
  isEndPage          : false
  totalOnCurrentPage : 3
  start              : 1
  end                : 3
}
*/

// Now $pagination has all needed information and we can display page 1 some like this:

echo "Show page: {$pagination->getCurrentPage()}".PHP_EOL;

$i = $pagination->getStart();

while($i <= $pagination->getEnd()){
    $index = $i-1;

    echo $items[$index].PHP_EOL;

    $i++;
}

echo PHP_EOL;

// For now, we will have such output:
/*
Show page: 1
a
b
c

*/

// Now we go to next page

$currentPage = 2;
$pagination  = new Pagination($total, $perPage, $currentPage);

echo "Show page: {$pagination->getCurrentPage()}".PHP_EOL;

$i = $pagination->getStart();

while($i <= $pagination->getEnd()){
    $index = $i-1;

    echo $items[$index].PHP_EOL;

    $i++;
}

//For now, we will have total output:
/*
Show page: 1
a
b
c

Show page: 2
d
e

*/

```

<a name="some-implementation-details"/>

### Some implementation details
- The idea is to have the pagination calculations in separated unit. So that unit has just one responsibility - to calculate the pagination data. That data is abstract, so can used with any type of items
- Pagination can have no items
- Pagination always has at least 1 page (even if there is no items)
- Fields of pagination object stores the data about all the set and the current page. See reference.
- If pagination can't constructed than Exception will be thrown. For example, if we try to use currentPage that is greater than maximum available page number

<a name="installation"/>
## Installation

```bash
composer require hutulia/pagination
```

<a name="usage"/>

## Usage

<a name="example-just-work-with-pagination-programmatically"/>

### Example 1: Just work with pagination programmatically

```php
<?php

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

<a name="example-simple-renderer"/>

### Example 2: Simple renderer

Basic simple rendering functionality. See reference for more.

```php
<?php

use Hutulia\Pagination\Pagination;
use Hutulia\Pagination\SimpleRenderer;

require_once 'vendor/autoload.php';

$totalItems  = 11;
$perPage     = 3;
$currentPage = 2;
$pagination  = new Pagination($totalItems, $perPage, $currentPage);
$renderer    = new SimpleRenderer($pagination);
$template    = 'Showing {START} - {END} of {TOTAL}. Page {CURRENT_PAGE} of {TOTAL_PAGES}';

echo $renderer->render($template);
// Showing 4 - 6 of 11. Page 2 of 4
```

<a name="example-export-to-plain-object"/>

### Example 3: Export To Plain Object

```php

<?php

use Hutulia\Pagination\Pagination;
use Hutulia\Pagination\ExporterToPlainObject;

require_once 'vendor/autoload.php';

$total                 = 5;
$perPage               = 3;
$currentPage           = 1;
$pagination            = new Pagination($total, $perPage, $currentPage);
$exporterToPlainObject = new ExporterToPlainObject($pagination);

var_dump($exporterToPlainObject->export());

/*
object(stdClass)#4 (9) {
  ["total"]=>
  int(5)
  ["perPage"]=>
  int(3)
  ["totalPages"]=>
  int(2)
  ["currentPage"]=>
  int(1)
  ["isStartPage"]=>
  bool(true)
  ["isEndPage"]=>
  bool(false)
  ["totalOnCurrentPage"]=>
  int(3)
  ["start"]=>
  int(1)
  ["end"]=>
  int(3)
}
*/
```

<a name="reference"/>

## Reference

<a name="reference-pagination"/>

### Pagination

<a name="reference-pagination-properties"/>

#### Properties

| Name | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `total` | `int` | Total items in the set pagination is used for |
| `perPage` | `int` | How many items to show per page |
| `totalPages` | `int` | How many pages we need to show all items |
| `currentPage` | `int` | Current Page num (starts from 1) |
| `isStartPage` | `bool` | Is Current Page 1st page? |
| `isEndPage` | `bool` | Is Current Page the last available page? |
| `totalOnCurrentPage` | `int` | How many items are on current page |
| `start` | `int` | The total position of the first item on current page. Numbers are starting from 1 (not 0) |
| `end` | `int` | The total position of the last item on current page. Is equals to TOTAL on last page. |

<a name="reference-pagination-api"/>

#### API (public methods)
- getTotal()
- getPerPage()
- getTotalPages()
- getCurrentPage()
- isStartPage()
- isEndPage()
- getTotalOnCurrentPage()
- getStart()
- getEnd()

Used during construct but can be used after (they do not change the object)
- calcTotalPages()
- calcTotalOnCurrentPage()
- calcIsStartPage()
- calcIsEndPage()
- calcStart()
- calcEnd()

<a name="reference-simplerenderer-api"/>

### SimpleRenderer API

#### render(string $template): string

It uses a template (plain string) and vars. To use var just wrap it with curly braces.
Example: `some text {START} some other text {TOTAL} ... `.

Available vars:

| Name | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `TOTAL` | `int` | Total items in the set pagination is used for |
| `PER_PAGE` | `int` | How many items show per page |
| `TOTAL_PAGES` | `int` | How many pages we need to show all items |
| `CURRENT_PAGE` | `int` | Current Page num (starts from 1) |
| `IS_START_PAGE` | `int` | Originally - bool, converted to int. Is it 1st page now? |
| `IS_END_PAGE` | `int` | Originally - bool, converted to int. Is it the last available page? |
| `TOTAL_ON_CURRENT_PAGE` | `int` | How many items are on current page |
| `START` | `int` | The total position of the first item on current page. Numbers are starting from 1 (not 0) |
| `END` | `int` | The total position of the last item on current page. Is equals to TOTAL on last page. |

<a name="reference-exporter-to-plain-object-api"/>

### ExporterToPlainObject API

#### export(): stdClass

## License
[MIT](https://choosealicense.com/licenses/mit/)
