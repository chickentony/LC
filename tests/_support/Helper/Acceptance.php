<?php

declare(strict_types=1);

namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Codeception\Exception\ModuleException;
use Codeception\Module;
use Exception;
use Facebook\WebDriver\WebDriver;
use PHPUnit\Framework\Assert;
use PHPUnit_Framework_Assert;
use WebDriverBy;

class Acceptance extends Module
{
    /**
     * @param $element
     * @throws ModuleException
     * @throws Exception
     */
    public function waitTillPageLoad($element): void
    {
        /** @var Module\WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');
        $webDriver->waitForElementVisible($element);
    }

    /**
     * @param $elements
     * @throws ModuleException
     */
    public function checkSortOnPage($elements): void
    {
        /** @var Module\WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');
        $result = $webDriver->grabMultiple($elements);
        $sortedResult = array_values($result);
        asort($sortedResult);
        PHPUnit_Framework_Assert::assertSame($result, $sortedResult);
    }

    /**
     * @param $valuesList
     * @throws ModuleException
     */
    public function checkSort($valuesList): void
    {
        $sortedValuesList = $valuesList;
        asort($sortedValuesList);
        PHPUnit_Framework_Assert::assertSame($valuesList, $sortedValuesList);
    }

    /**
     * Поулчает указанное css свойство элекмента по его x-path
     * @param string $locator
     * @param string $cssProperty
     * @return mixed
     * @throws ModuleException
     */
    public function getCssProperty(string $locator, string $cssProperty)
    {
        /** @var Module\WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');
        return $webDriver->
        executeInSelenium(static function (WebDriver $driver) use ($locator, $cssProperty) {
            return $driver->findElement(WebDriverBy::xpath($locator))->getCSSValue($cssProperty);
        });
    }

    /**
     * @param $popupMessage
     * @throws ModuleException
     */
    public function closePopup(string $popupMessage): void
    {
        /** @var Module\WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');
        $webDriver->seeInPopup($popupMessage);
        $webDriver->acceptPopup();
    }

    /**
     * @return array
     * @throws ModuleException
     */
    public function getWindowHandles(): array
    {
        /** @var Module\WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');
        return $webDriver->webDriver->getWindowHandles();
    }

    /**
     * @param string $id
     * @throws ModuleException
     * Закрывает вкладку браузера по id
     */
    public function closeWindowById(string $id): void
    {
        /** @var Module\WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');
        $webDriver->switchToWindow($id);
        $webDriver->closeTab();
    }

    /**
     * @param string $locator
     * @return int
     * @throws ModuleException
     * Возвращает кол-во элементов на странице
     */
    public function getNumberOfElementsOnPage(string $locator): int
    {
        /** @var Module\WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');
        return count($webDriver->_findElements($locator));
    }

    /**
     * @return array
     * @throws ModuleException
     * Получает сообщения из лога бразуера
     */
    public function getBrowserLog(): array
    {
        /** @var Module\WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');
        return $webDriver->webDriver->manage()->getLog('browser');
    }

    public function changeBrowser(): void
    {
        /** @var Module\WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');
        $webDriver->_restart(['browser' => 'internet explorer']);
    }
}
