<?php

namespace Hutulia\Pagination;

class Pagination
{
    /** @var int */
    protected $total = 0;

    protected $perPage = 10;

    protected $totalPages = 1;

    protected $currentPage = 1;

    protected $isStartPage = false;

    protected $isEndPage = false;

    protected $totalOnCurrentPage = 0;

    protected $start = 0;

    protected $end = 0;

    public function __construct($total = 0, $perPage = 10, $currentPage = 1)
    {
        $this->setTotal($total)
            ->setPerPage($perPage)
            ->setTotalPages($this->calcTotalPages())
            ->setCurrentPage($currentPage)
            ->setIsStartPage($this->calcIsStartPage())
            ->setIsEndPage($this->calcIsEndPage())
            ->setTotalOnCurrentPage($this->calcTotalOnCurrentPage())
            ->setStart($this->calcStart())
            ->setEnd($this->calcEnd())
        ;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @return int
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @return int
     */
    public function getTotalPages()
    {
        return $this->totalPages;
    }

    /**
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @return int
     */
    public function getTotalOnCurrentPage()
    {
        return $this->totalOnCurrentPage;
    }

    /**
     * @return int
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @return int
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @return int
     */
    public function calcTotalPages()
    {
        return ceil($this->totalPages/$this->perPage);
    }

    /**
     * @return int
     */
    public function calcTotalOnCurrentPage()
    {
        return $this->currentPage !== $this->totalPages ? $this->perPage : ($this->total % $this->perPage);
    }

    /**
     * @return bool
     */
    public function calcIsEndPage()
    {
        return $this->currentPage === $this->totalPages;
    }

    /**
     * @return bool
     */
    public function calcIsStartPage()
    {
        return $this->currentPage === 1;
    }

    /**
     * @return int
     */
    public function calcStart()
    {
        return ($this->currentPage - 1) * $this->perPage + 1;
    }

    /**
     * @return int
     */
    public function calcEnd()
    {
        return ($this->currentPage - 1) * $this->perPage + $this->totalOnCurrentPage;
    }

    /**
     * @param $total
     * @return $this
     */
    protected function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @param int $perPage
     * @return $this
     */
    protected function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        return $this;
    }

    /**
     * @param $totalPages
     * @return $this
     */
    protected function setTotalPages($totalPages)
    {
        $this->totalPages = $totalPages;
        return $this;
    }

    /**
     * @param int $currentPage
     * @return $this
     */
    protected function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
        return $this;
    }

    /**
     * @param $totalOnCurrentPage
     * @return $this
     */
    protected function setTotalOnCurrentPage($totalOnCurrentPage)
    {
        $this->totalOnCurrentPage = $totalOnCurrentPage;
        return $this;
    }

    /**
     * @param $isEndPage
     * @return $this
     */
    protected function setIsEndPage($isEndPage)
    {
        $this->isEndPage = $isEndPage;
        return $this;
    }

    /**
     * @param $isStartPage
     * @return $this
     */
    protected function setIsStartPage($isStartPage)
    {
        $this->isStartPage = $isStartPage;
        return $this;
    }

    /**
     * @param $start
     * @return $this
     */
    protected function setStart($start)
    {
        $this->start = $start;
        return $this;
    }

    /**
     * @param $end
     * @return $this
     */
    protected function setEnd($end)
    {
        $this->end = $end;
        return $this;
    }
}