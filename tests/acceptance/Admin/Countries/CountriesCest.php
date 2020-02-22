<?php

namespace Tests\acceptance\Admin\Countries;

use AcceptanceTester;
use Step\Acceptance\Admin;
use Tests\Page\Admin\Countries\CountriesPage;

class CountriesCest
{
    /**
     * @param Admin $admin
     * Логин в даминку
     */
    public function _before(Admin $admin)
    {
        $admin->loginAsAdmin();
    }

    /**
     * @param AcceptanceTester $I
     * @param CountriesPage $countriesPage
     * @throws \Codeception\Exception\ModuleException
     */
    public function checkCountriesSort(AcceptanceTester $I, CountriesPage $countriesPage)
    {
        $I->amOnPage($countriesPage::PAGE_URL);
        $I->waitTillPageLoad($countriesPage::PAGE_HEADER);
        $I->checkSortOnPage($countriesPage::COUNTRY_NAME_FROM_LIST);
    }

    /**
     * @param AcceptanceTester $I
     * @param CountriesPage $countriesPage
     * @throws \Codeception\Exception\ModuleException
     */
    public function checkGeoZonesSortInsideCountries(AcceptanceTester $I, CountriesPage $countriesPage)
    {
        $I->amOnPage($countriesPage::PAGE_URL);
        $I->waitTillPageLoad($countriesPage::PAGE_HEADER);
        // Получаем список стран с НЕ пустыми гео-зонами
        $countriesWithGeoZones = $countriesPage->getCountriesWithGeoZones($countriesPage::COUNTRY_TABLE_ROW);
        // Преобразуем полученный массив со странами в массив с названиями, без лишней информации
        $xPath = $countriesPage->countryNameForXpath($countriesWithGeoZones);
        $countriesPage->checkCountriesGeoZonesSort($xPath);
    }

    /**
     * @param AcceptanceTester $I
     * @param CountriesPage $countriesPage
     * @throws \Codeception\Exception\ModuleException
     * @throws \Exception
     */
    public function checkLinks(AcceptanceTester $I, CountriesPage $countriesPage)
    {
        $I->wantTo('Check that links inside country edit page opening in new browser tab');
        $I->amOnPage($countriesPage::PAGE_URL);
        $I->waitTillPageLoad($countriesPage::PAGE_HEADER);
        $countriesPage->editCountry($countriesPage::COUNTRY_LIST['Afghanistan']);
        $countriesPage->countryPage->clickOnExternalLinksAndCheckOpeningLink();
    }

}