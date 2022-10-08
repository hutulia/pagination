<?php

use Hutulia\Pagination\Pagination;
use Hutulia\Pagination\SimpleRenderer;
use PHPUnit\Framework\TestCase;

class SimpleRendererTest extends TestCase
{
    /**
     * @testWith [10,3,4,"10|3|4|4|0|1|1|10|10"]
     *           [12,5,2,"12|5|3|2|0|0|5|6|10"]
     *           [12,5,3,"12|5|3|3|0|1|2|11|12"]
     *
     * @throws \Exception
     */
    public function testRendering($total, $perPage, $currentPage, $renderedString)
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

        $this->assertSame($renderedString, $renderer->render($template));
    }
}
