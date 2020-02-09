<?php

namespace Tests\Page\Admin\Catalog;

use Exception;

class ProductPage extends CatalogPage
{
    /**
     * @param $productLinks
     * @throws Exception
     */
    public function checkBrowserLog(array $productLinks)
    {
        $browserLogs = [];
        foreach ($productLinks as $productLink) {
            $this->openProduct($productLink);
            $browserLogs = $this->tester->getBrowserLog();
            if (!empty($browserLogs)) {
                throw new Exception('There are js errors in browser log');
            }
            $this->tester->moveBack();
        }
    }
}