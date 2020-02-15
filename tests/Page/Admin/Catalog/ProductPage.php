<?php

namespace Tests\Page\Admin\Catalog;

use Exception;

class ProductPage extends CatalogPage
{
    /**
     * @param $productLinks
     * @throws Exception
     * ToDo: custom exception class
     */
    public function checkBrowserLogForOutput(array $productLinks)
    {
        foreach ($productLinks as $productLink) {
            $this->openProduct($productLink);
            $browserLogs = $this->tester->getBrowserLog();
            if (!empty($browserLogs)) {
                throw new Exception('There are some output in browser log please check it');
            }
            $this->tester->moveBack();
        }
    }
}