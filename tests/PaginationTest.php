<?php

use Exception;
use Hutulia\Pagination\Pagination;
use Hutulia\Pagination\SimpleRenderer;
use PHPUnit\Framework\TestCase;

class PaginationTest extends TestCase
{
    /**
     * @testWith
     *           [0,1,1,1,true,true,0,0,0]
     *           [1,1,1,1,true,true,1,1,1]
     *           [2,1,1,2,true,false,1,1,1]
     *           [2,1,2,2,false,true,1,2,2]
     *           [3,2,1,2,true,false,2,1,2]
     *           [3,2,2,2,false,true,1,3,3]
     *           [10,1,1,10,true,false,1,1,1]
     *           [10,1,2,10,false,false,1,2,2]
     *           [10,1,10,10,false,true,1,10,10]
     *           [10,10,1,1,true,true,10,1,10]
     *           [10,3,2,4,false,false,3,4,6]
     *           [10,3,4,4,false,true,1,10,10]
     *           [11,10,2,2,false,true,1,11,11]
     *           [12,10,2,2,false,true,2,11,12]
     * @throws Exception
     */
    public function testPagination($total,
                                   $perPage,
                                   $currentPage,
                                   $totalPages,
                                   $isStartPage,
                                   $isEndPage,
                                   $totalOnCurrentPage,
                                   $start,
                                   $end
    )
    {
        $fixture = new Pagination($total, $perPage, $currentPage);
        //var_dump($fixture);
        $this->assertSame($total, $fixture->getTotal());
        $this->assertSame($perPage, $fixture->getPerPage());
        $this->assertSame($totalPages, $fixture->getTotalPages());
        $this->assertSame($currentPage, $fixture->getCurrentPage());
        $this->assertSame($isStartPage, $fixture->isStartPage());
        $this->assertSame($isEndPage, $fixture->isEndPage());
        $this->assertSame($totalOnCurrentPage, $fixture->getTotalOnCurrentPage());
        $this->assertSame($start, $fixture->getStart());
        $this->assertSame($end, $fixture->getEnd());
    }

    /**
     * @testWith [10,3,4,"10|3|4|4|0|1|1|10|10"]
     *           [12,5,2,"12|5|3|2|0|0|5|6|10"]
     *           [12,5,3,"12|5|3|3|0|1|2|11|12"]
     *
     * @throws Exception
     */
    public function testRender($total, $perPage, $currentPage, $renderedString)
    {
        $pagination           = new Pagination($total, $perPage, $currentPage);
        $renderer             = new SimpleRenderer($pagination);
        $renderVars           = $renderer->getRenderVars();
        $varNames             = array_keys($renderVars);
        $varsAsTemplateString = array_map(function ($varName) {
            return '{' . $varName . '}';
        }, $varNames);
        $template             = implode('|', $varsAsTemplateString);
        //> var_dump($testTemplate);
        //< {TOTAL}|{PER_PAGE}|{TOTAL_PAGES}|{CURRENT_PAGE}|{IS_START_PAGE}|{IS_END_PAGE}|{TOTAL_ON_CURRENT_PAGE}|{START}|{END}
        //var_dump($fixture);

        $this->assertSame($renderedString, $pagination->render($template));
    }

    public function testCreateWithIncorrectTotal()
    {
        $this->expectException(Exception::class);
        new Pagination(-1, 1, 1);
    }

    public function testCreateWithIncorrectPerPage()
    {
        $this->expectException(Exception::class);
        new Pagination(1, -1, 1);
    }

    public function testCreateWithIncorrectCurrentPage()
    {
        $this->expectException(Exception::class);
        new Pagination(1, 1, -1);
    }
}
