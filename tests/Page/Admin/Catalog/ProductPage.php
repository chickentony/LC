<?php

namespace Tests\Page\Admin\Catalog;

use AcceptanceTester;

class ProductPage
{

    protected $tester;

    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
    }

    public function getBrowserLog()
    {
        return $this->tester->getBrowserLog();
    }

}