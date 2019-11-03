<?php

namespace Tests\acceptance\Admin\Countries;

use AcceptanceTester;
use Tests\Page\Admin\Countries\CountriesPage;

class CountriesCest
{
    //ToDo: need helper for login
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/admin');
        $I->fillField('//*[@name="username"]', 'admin');
        $I->fillField('//*[@name="password"]', 'admin');
        $I->click('//*[@name="login"]');
        $I->see('You are now logged in as admin');
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
        //Получаем список стран с НЕ пустыми гео-зонами
//        $countriesWithGeoZones = $countriesPage->getCountriesWithGeoZones($countriesPage::COUNTRY_TABLE_ROW);
        //Преобразуем полученный массив со странами в массив с названиями, без лишней информации
//        $data = $countriesPage->countryNameForXpath($countriesWithGeoZones);

//        $countriesPage->openCountriesWithGeoZones($data);
    }

    /**
     * @param AcceptanceTester $I
     * @param CountriesPage $countriesPage
     * @throws \Codeception\Exception\ModuleException
     */
    public function checkGeoZonesInsideCountries(AcceptanceTester $I, CountriesPage $countriesPage)
    {
        $I->amOnPage($countriesPage::PAGE_URL);
        $I->waitTillPageLoad($countriesPage::PAGE_HEADER);
        $countriesWithGeoZones = $countriesPage->getCountriesWithGeoZones($countriesPage::COUNTRY_TABLE_ROW);
        $xPath = $countriesPage->countryNameForXpath($countriesWithGeoZones);
        $countriesPage->checkCountriesGeoZonesSort($xPath);
    }

}