<?php

namespace Hutulia\Pagination;

use stdClass;

class ExporterToPlainObject
{
    /** @var Pagination */
    protected $pagination;

    /**
     * @param Pagination $pagination
     */
    public function __construct($pagination)
    {
        $this->pagination = $pagination;
    }

    /**
     * @return stdClass
     */
    public function export()
    {
        $value = new stdClass();

        $value->total              = $this->pagination->getTotal();
        $value->perPage            = $this->pagination->getPerPage();
        $value->totalPages         = $this->pagination->getTotalPages();
        $value->currentPage        = $this->pagination->getCurrentPage();
        $value->isStartPage        = $this->pagination->isStartPage();
        $value->isEndPage          = $this->pagination->isEndPage();
        $value->totalOnCurrentPage = $this->pagination->getTotalOnCurrentPage();
        $value->start              = $this->pagination->getStart();
        $value->end                = $this->pagination->getEnd();

        return $value;
    }
}