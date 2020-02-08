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

    /**
     * Поулчает указанное css свойство элекмента по его x-path
     * @param string $locator
     * @param string $cssProperty
     * @return mixed
     * @throws \Codeception\Exception\ModuleException
     */
    public function getCssProperty(string $locator, string $cssProperty)
    {
        /** @var \Codeception\Module\WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');
        $result = $webDriver->
        executeInSelenium(function (\Facebook\WebDriver\WebDriver $driver) use ($locator, $cssProperty) {
            return $driver->findElement(\WebDriverBy::xpath($locator))->getCSSValue($cssProperty);
        });

        return $result;
    }

    /**
     * @param $popupMessage
     * @throws \Codeception\Exception\ModuleException
     */
    public function closePopup(string $popupMessage)
    {
        /** @var \Codeception\Module\WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');
        $webDriver->seeInPopup($popupMessage);
        $webDriver->acceptPopup();
    }

    /**
     * @return array
     * @throws \Codeception\Exception\ModuleException
     */
    public function getWindowHandles(): array
    {
        /** @var \Codeception\Module\WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');
        return $webDriver->webDriver->getWindowHandles();
    }

    /**
     * @param string $id
     * @throws \Codeception\Exception\ModuleException
     * Закрывает вкладку браузера по id
     */
    public function closeWindowById(string $id)
    {
        /** @var \Codeception\Module\WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');
        $webDriver->switchToWindow($id);
        $webDriver->closeTab();
    }

    /**
     * @param string $locator
     * @return int
     * @throws \Codeception\Exception\ModuleException
     * Возвращает кол-во элементов на странице
     */
    public function getNumberOfElementsOnPage(string $locator)
    {
        /** @var \Codeception\Module\WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');

        return count($webDriver->_findElements($locator));
    }

    public function getBrowserLog()
    {
        /** @var \Codeception\Module\WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');

        return $webDriver->webDriver->manage()->getLog('browser');
    }

}
