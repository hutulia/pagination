<?php

namespace Hutulia\Pagination;

use Exception;

class Pagination
{
    /** @var int */
    protected $total = 0;

    /** @var int */
    protected $perPage = 10;

    /** @var int */
    protected $totalPages = 1;

    /** @var int */
    protected $currentPage = 1;

    /** @var bool */
    protected $isStartPage = false;

    /** @var bool */
    protected $isEndPage = false;

    /** @var int */
    protected $totalOnCurrentPage = 0;

    /** @var int */
    protected $start = 0;

    /** @var int */
    protected $end = 0;

    /**
     * @param int $total
     * @param int $perPage
     * @param int $currentPage
     * @throws Exception
     */
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
            ->setEnd($this->calcEnd());
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
     * @return bool
     */
    public function isStartPage(): bool
    {
        return $this->isStartPage;
    }

    /**
     * @return bool
     */
    public function isEndPage(): bool
    {
        return $this->isEndPage;
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
        if($this->total == 0){
            return 1;
        }

        return (int) ceil($this->total / $this->perPage);
    }

    /**
     * @return int
     */
    public function calcTotalOnCurrentPage()
    {
        if($this->total == 0){
            return 0;
        }

        return $this->currentPage !== $this->totalPages
            ? $this->perPage
            : ($this->perPage - $this->total % $this->perPage);
    }

    /**
     * @return bool
     */
    public function calcIsStartPage()
    {
        return $this->currentPage === 1;
    }

    /**
     * @return bool
     */
    public function calcIsEndPage()
    {
        return $this->currentPage === $this->totalPages;
    }

    /**
     * @return int
     */
    public function calcStart()
    {
        if($this->total === 0){
            return 0;
        }

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
     * @return $this
     * @throws Exception
     */
    protected function setTotal($total)
    {
        $total = (int) $total;

        if ($total < 0) {
            throw new Exception('total < 0');
        }

        $this->total = $total;

        return $this;
    }

    /**
     * @return $this
     * @throws Exception
     */
    protected function setPerPage($perPage)
    {
        $perPage = (int) $perPage;

        if ($perPage < 1) {
            throw new Exception('perPage < 1');
        }

        $this->perPage = $perPage;

        return $this;
    }

    /**
     * @param int $totalPages
     * @return $this
     * @throws Exception
     */
    protected function setTotalPages($totalPages)
    {
        $totalPages = (int) $totalPages;

        if ($totalPages < 1) {
            throw new Exception('totalPages < 1');
        }

        $this->totalPages = $totalPages;

        return $this;
    }

    /**
     * @param $currentPage
     * @return $this
     * @throws Exception
     */
    protected function setCurrentPage($currentPage)
    {
        $currentPage = (int) $currentPage;

        if ($currentPage < 1) {
            throw new Exception('currentPage < 1');
        }

        if ($currentPage > $this->totalPages) {
            throw new Exception('currentPage > totalPages');
        }

        $this->currentPage = $currentPage;

        return $this;
    }

    /**
     * @param $totalOnCurrentPage
     * @return $this
     * @throws Exception
     */
    protected function setTotalOnCurrentPage($totalOnCurrentPage)
    {
        $totalOnCurrentPage = (int) $totalOnCurrentPage;

        if ($totalOnCurrentPage < 0) {
            throw new Exception('totalOnCurrentPage < 0');
        }

        if ($totalOnCurrentPage > $this->perPage) {
            throw new Exception('totalOnCurrentPage > perPage');
        }

        $this->totalOnCurrentPage = $totalOnCurrentPage;

        return $this;
    }

    /**
     * @param $isEndPage
     * @return $this
     */
    protected function setIsEndPage($isEndPage)
    {
        $this->isEndPage = (bool) $isEndPage;

        return $this;
    }

    /**
     * @param $isStartPage
     * @return $this
     */
    protected function setIsStartPage($isStartPage)
    {
        $this->isStartPage = (bool) $isStartPage;

        return $this;
    }

    /**
     * @param $start
     * @return $this
     */
    protected function setStart($start)
    {
        $start = (int) $start;

        $this->start = $start;

        return $this;
    }

    /**
     * @param $end
     * @return $this
     */
    protected function setEnd($end)
    {
        $end = (int) $end;

        $this->end = $end;

        return $this;
    }
}