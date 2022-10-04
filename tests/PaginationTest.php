<?php

use Exception;
use Hutulia\Pagination\Pagination;
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
     *           [10,3,2,4,false,false,3,4,6]
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