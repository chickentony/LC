<?php

declare(strict_types=1);

namespace Tests\Page\Admin\Countries;

use AcceptanceTester;

class CountriesPage
{
    /**
     * @var $geoZonesTitles
     * Массив заголовков геозон
     */
    public $geoZonesTitles;

    /** @var CountryPage
     * Страница одной страны
     */
    public $countryPage;

    /** @var AcceptanceTester */
    protected $tester;

    /**
     * CountriesPage constructor.
     * @param AcceptanceTester $tester
     */
    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
        $this->countryPage = new CountryPage($tester);
    }

    /** @var string Название страны из списка всех стран */
    public const COUNTRY_NAME_FROM_LIST = '//table[@class="dataTable"]//td//a[(text())]';

    /** @var string Строка с данными по стране */
    public const COUNTRY_TABLE_ROW = '//table[@class="dataTable"]//tr[@class="row"]';

    /** @var string URL страницы */
    public const PAGE_URL = 'admin/?app=countries';

    /** @var string Заголовок страницы со странами */
    public const PAGE_HEADER = '//h1[contains(., "Countries")]';

    /** @var array Массив со странами */
    public const COUNTRY_LIST = [
        'Afghanistan' => '//table[@class="dataTable"]//td//a[text()="Afghanistan"]'
    ];

    /**
     * @param $element
     * @return array
     * Метод получает список стран, с гео-зонами > 0
     */
    public function getCountriesWithGeoZones($element): array
    {
        $countriesList = $this->tester->grabMultiple($element);
        $result = [];
        foreach ($countriesList as $key => $value) {
            $countriesAsString = explode(' ', $value);
            if (end($countriesAsString) !== '0') {
                $result[] = implode($countriesAsString);
            }
        }
        return $result;
    }

    /**
     * @param $countriesList
     * @return array
     * Метод собирает массив из щаголовков стран, для последующего использования их в x-path
     */
    public function countryNameForXpath(array $countriesList): array
    {
        $result = [];
        foreach ($countriesList as $value) {
            $countriesWithoutNumbers = preg_replace('/\d+/', '', $value);
            $countriesWithoutCode = substr($countriesWithoutNumbers, 2);
            $result[] = preg_replace('/([a-z])([A-Z])/', '$1 $2', $countriesWithoutCode);
        }
        return $result;
    }

    /**
     * @param $countryWithGeoZonesXPath
     * @throws \Codeception\Exception\ModuleException
     */
    public function checkCountriesGeoZonesSort(array $countryWithGeoZonesXPath): void
    {
        foreach ($countryWithGeoZonesXPath as $value) {
            $str = "\"{$value}\"";
            //Кликаем на страну у которой есть хотя бы одна гео-зона
            $this->tester->click("//table[@class=\"dataTable\"]//a[contains(.,{$str})]");
            //Вытаскиваем всю информацию из строк с зонами
            $geoZonesList = $this->tester->grabMultiple($this->countryPage::GEO_ZONES_TABLE_ROW);
            //Убираем лишнее элементы из массива с гео-зонами
            $this->prepareCountriesGeoZonesArray($geoZonesList);
            //Проверям сортировку
            $this->tester->checkSort($this->geoZonesTitles);
            $this->tester->click($this->countryPage::CANCEL_BUTTON);
        }
    }

    /**
     * @param $geoZones
     * Убирает из массива с гео-зонами лишнюю информацию (коды зон и их абривиатуры)
     */
    private function prepareCountriesGeoZonesArray(array $geoZones): void
    {
        foreach ($geoZones as $key => $value) {
            if (strlen($value) < 4) {
                unset($geoZones[$key]);
            }
        }
        $this->geoZonesTitles = $geoZones;
    }

    /**
     * @param string $countryName
     * @throws \Exception
     * Открывает страницу редактирования страны
     */
    public function editCountry(string $countryName): void
    {
        $this->tester->waitForElementVisible($countryName);
        $this->tester->click($countryName);
    }

}