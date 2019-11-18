<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Facebook\WebDriver\WebDriver;
use PHPUnit\Framework\Assert;

class Acceptance extends \Codeception\Module
{
    /**
     * @param $element
     * @throws \Codeception\Exception\ModuleException
     * @throws \Exception
     */
    public function waitTillPageLoad($element)
    {
        /** @var \Codeception\Module\WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');
        $webDriver->waitForElementVisible($element);
    }

    /**
     * @param $elements
     * @throws \Codeception\Exception\ModuleException
     */
    public function checkSortOnPage($elements)
    {
        /** @var \Codeception\Module\WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');
        $result = $webDriver->grabMultiple($elements);
        $sortedResult = array_values($result);
        asort($sortedResult);
        \PHPUnit_Framework_Assert::assertTrue($result === $sortedResult);
    }

    /**
     * @param $valuesList
     * @throws \Codeception\Exception\ModuleException
     */
    public function checkSort($valuesList)
    {
        $sortedValuesList = $valuesList;
        asort($sortedValuesList);
        \PHPUnit_Framework_Assert::assertTrue($valuesList === $sortedValuesList);
    }

    public function getFont()
    {
        /** @var \Codeception\Module\WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');
        $result = $webDriver->executeInSelenium(function (\Facebook\WebDriver\WebDriver $driver){
            return $driver->findElement(\WebDriverBy::xpath('//*[@class="regular-price"]'))->getCSSValue('font-size');
        });
        return $result;
    }

}
