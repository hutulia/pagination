<?php

namespace Hutulia\Pagination;

class SimpleRenderer
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
     * @param string $template
     * @return string
     */
    public function render($template = '')
    {
        $vars = $this->getRenderVars();

        foreach ($vars as $varName => $varValue) {
            $template = str_replace('{'.$varName.'}', $varValue, $template);
        }

        return $template;
    }

    /**
     * @return array
     */
    public function getRenderVars()
    {
        return [
            'TOTAL'                 => $this->pagination->getTotal(),
            'PER_PAGE'              => $this->pagination->getPerPage(),
            'TOTAL_PAGES'           => $this->pagination->getTotalPages(),
            'CURRENT_PAGE'          => $this->pagination->getCurrentPage(),
            'IS_START_PAGE'         => (int) $this->pagination->isStartPage(),
            'IS_END_PAGE'           => (int) $this->pagination->isEndPage(),
            'TOTAL_ON_CURRENT_PAGE' => $this->pagination->getTotalOnCurrentPage(),
            'START'                 => $this->pagination->getStart(),
            'END'                   => $this->pagination->getEnd(),
        ];
    }
}