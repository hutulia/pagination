<?php

use Exception;
use Hutulia\Pagination\ExporterToPlainObject;
use Hutulia\Pagination\Pagination;
use PHPUnit\Framework\TestCase;

class ExporterToPlainObjectTest extends TestCase
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
    public function testExport(
        $total,
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
        $pagination    = new Pagination($total, $perPage, $currentPage);
        $exporter      = new ExporterToPlainObject($pagination);
        $expectedValue = new stdClass();

        $expectedValue->total              = $total;
        $expectedValue->perPage            = $perPage;
        $expectedValue->currentPage        = $currentPage;
        $expectedValue->totalPages         = $totalPages;
        $expectedValue->isStartPage        = $isStartPage;
        $expectedValue->isEndPage          = $isEndPage;
        $expectedValue->totalOnCurrentPage = $totalOnCurrentPage;
        $expectedValue->start              = $start;
        $expectedValue->end                = $end;

        $this->assertEquals($expectedValue, $exporter->export());
    }
}
