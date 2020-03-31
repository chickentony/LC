<?php

declare(strict_types=1);

namespace Tests\Page\Admin\Catalog;

use Exception;

class ProductPage extends CatalogPage
{
    /**
     * @param $productNames
     * @throws Exception
     * ToDo: custom exception class
     */
    public function checkBrowserLogForOutput(array $productNames): void
    {
        $productLinks = $this->returnXPathForProducts($productNames);
        foreach ($productLinks as $productLink) {
            $this->openProduct($productLink);
            $browserLogs = $this->tester->getBrowserLog();
            if (!empty($browserLogs)) {
                throw new Exception('There are some output in browser log please check it');
            }
            $this->tester->moveBack();
        }
    }

    /**
     * @param string[] $productNames
     * Возвращает x-Path для ссылок на продукты
     * @return array
     */
    public function returnXPathForProducts(array $productNames): array
    {
        $result = [];
        foreach ($productNames as $name) {
            $result[$name] = sprintf(self::PRODUCT_LINK_FORMAT, $name);
        }

        return $result;
    }
}