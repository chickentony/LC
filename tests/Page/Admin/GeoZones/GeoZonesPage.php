<?php

namespace Tests\Page\Admin\GeoZones;

use AcceptanceTester;

class GeoZonesPage
{
    /** @var string URL страницы со списком геозон */
    public const PAGE_URL = 'admin/?app=geo_zones';

    /** @var string Заголовок страницы геозон */
    public const PAGE_HEADER = '//h1[contains(., " Geo Zones")]';

    public const SELECTED_ITEM_IN_DROPDOWN = '//table[@class="dataTable"]//select[@data-size="medium"]/option[@selected="selected"]';

    /** @var string Название геозоны */
    public const GEO_ZONE_NAME_FROM_TABLES = '//table[@class="dataTable"]//td//a[(text())]';

    /** @var string Кнопка отмены */
    public const CANCEL_BUTTON = '//*[@name="cancel"]';

    /**@var AcceptanceTester */
    protected $tester;

    /**
     * GeoZonesPage constructor.
     * @param AcceptanceTester $tester
     */
    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
    }

    /**
     * @throws \Codeception\Exception\ModuleException
     */
    public function openGeoZonePageAndCheckSort()
    {
        foreach ($this->grabActualGeoZones() as $value) {
            $this->tester->click($value);
            //ToDo: Сделать проверку на страницу без геозон
            $this->checkGeoZonesSort();
            $this->tester->click(self::CANCEL_BUTTON);
        }
    }

    /**
     * @return string[]
     * Получает все выбранные элементы из выпадающих списков и оставляет только нужные нам
     */
    private function grabZones()
    {
        //Забираем все выбранные значения из выпадающих списков
        $geoZonesTitles = $this->tester->grabMultiple(self::SELECTED_ITEM_IN_DROPDOWN);
        // Убираем лишние поля из массива с заголовками
        //ToDo: добавить нормальное название переменных для услвоия
        foreach ($geoZonesTitles as $key => $value) {
            if ($key % 2 === 0) {
                unset($geoZonesTitles[$key]);
            }
        }
        return $geoZonesTitles;
    }

    /**
     * @throws \Codeception\Exception\ModuleException
     * Проверяет сортировку геозон
     */
    private function checkGeoZonesSort()
    {
        $zones = $this->grabZones();
        $this->tester->checkSort($zones);
    }

    /** Возвращаем массив с геозонами */
    private function grabActualGeoZones()
    {
        return $this->tester->grabMultiple(self::GEO_ZONE_NAME_FROM_TABLES);
    }

}