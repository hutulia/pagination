# Hutulia/Pagination

| Input | Output |Pagination object for page 1 | Pagination object for page 2 |
| :-------- | :------- | :------------------------- | :------------------------- |
| <pre>['a', 'b', 'c', 'd', 'e']</pre>|<pre>Show page: 1<br>a<br>b<br>c<br><br>Show page: 2<br>d<br>e<br><br></pre>|<pre>object {<br>  total              : 5<br>  perPage            : 3<br>  totalPages         : 2<br>  currentPage        : 1<br>  isStartPage        : true<br>  isEndPage          : false<br>  totalOnCurrentPage : 3<br>  start              : 1<br>  end                : 3<br>}</pre>|<pre>object {<br>  total              : 5<br>  perPage            : 3<br>  totalPages         : 2<br>  currentPage        : 2<br>  isStartPage        : false<br>  isEndPage          : true<br>  totalOnCurrentPage : 2<br>  start              : 4<br>  end                : 5<br>}</pre>|

<a name="table-of-contents"/>

## Table of contents

[Get Started](#get-started)

[Implementation details](#implementation-details)

[Install](#install)

[Usage](#usage)

- [Example 1: Just work with pagination programmatically](#example-just-work-with-pagination-programmatically)

- [Example 2: Render](#example-render)

- [Example 3: Export To Plain Object](#example-export-to-plain-object)

- [Example 4: Full get started example](#full-get-started-example)

[Reference](#reference)

- [Hutulia\Pagination\Pagination](#reference-pagination)

    - [Properties](#reference-pagination-properties)

    - [API](#reference-pagination-api)

- [Hutulia\Pagination\SimpleRenderer](#reference-simplerenderer)

- [Hutulia\Pagination\ExporterToPlainObject](#reference-exporter-to-plain-object)

<a name="get-started"/>

## Get Started

Work with abstract pagination by php.

The idea is to have a class (pagination) that is responsible just for calculate the pagination data. That data is abstract, so can be used with any type of items.

<a name="get-started-example"/>

##### Get started example

###### We have

```php
['a', 'b', 'c', 'd', 'e']
```

Imagine that we need to show them all to user, but we can show max 3 at once. So we use pagination to determine which elements when to show.

######  We will produce (displaying by 3 items per page)

```
Show page: 1
a
b
c

Show page: 2
d
e
```

###### And we will have objects like this (pseudocode):

```
//page 1

pagination {
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
```

```
//page 2

pagination {
  total              : 5
  perPage            : 3
  totalPages         : 2
  currentPage        : 2
  isStartPage        : false
  isEndPage          : true
  totalOnCurrentPage : 2
  start              : 4
  end                : 5
}
```

See [Full get started example](#full-get-started-example) with real working code.

<a name="implementation-details"/>

### Implementation details
- Pagination can have no items
- Pagination always has at least 1 page (even if there is no items)
- Items numbers starting from 1
- Fields of pagination object stores the data about all the set and the current page. [See Pagination Properties reference](#reference-pagination-properties).
- If pagination can't be constructed - Exception will be thrown. For example, if we try to use currentPage that is greater than maximum available page number

<a name="install"/>

## Install

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

<a name="example-render"/>

### Example 2: Render

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

//Or without SimpleRenderer - will do exactly same inside

echo $pagination->render($template);
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

//Or without Exporter - will produce the same output

//var_dump($pagination->toPlainObject());

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

<a name="full-get-started-example"/>

### Example 4: Full get started example

This is a full example of [Get Started Example](#get-started-example).

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

<a name="reference"/>

## Reference

<a name="reference-pagination"/>

### Hutulia\Pagination\Pagination

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
- render($template) : string . See [Hutulia\Pagination\SimpleRenderer reference](#reference-simplerenderer). It is used inside.
- toPlainObject() : \stdClass . See [Hutulia\Pagination\ExporterToPlainObject reference](#reference-exporter-to-plain-object). It is used inside.

Used during construct but can be used after (they do not change the object)
- calcTotalPages()
- calcTotalOnCurrentPage()
- calcIsStartPage()
- calcIsEndPage()
- calcStart()
- calcEnd()

<a name="reference-simplerenderer"/>

### Hutulia\Pagination\SimpleRenderer

#### API

##### render(string $template): string

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

<a name="reference-exporter-to-plain-object"/>

### Hutulia\Pagination\ExporterToPlainObject

#### API

##### export(): stdClass

## License
[MIT](https://choosealicense.com/licenses/mit/)
