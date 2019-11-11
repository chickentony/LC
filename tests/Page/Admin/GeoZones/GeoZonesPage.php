<?php

namespace Tests\Page\Admin\GeoZones;

use AcceptanceTester;

class GeoZonesPage
{
    public const PAGE_URL = 'admin/?app=geo_zones';

    public const PAGE_HEADER = '//h1[contains(., " Geo Zones")]';

    public const EDIT_BUTTON = '//table[@class="dataTable"]//td//a[@title="Edit"]';

    public const GEO_ZONE_NAME_FROM_TABLES = '//table[@class="dataTable"]//td//a[(text())]';

    public const CANCEL_BUTTON = '//*[@name="cancel"]';

    private $actualGeoZonesList;

    protected $tester;

    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
    }

    /**
     * @throws \Codeception\Exception\ModuleException
     */
    public function openGeoZonePage()
    {
//        $this->grabActualGeoZones();
//        var_dump($this->actualGeoZonesList);
//        foreach ($this->actualGeoZonesList as $value)
//        {
//            $this->tester->click($value);
//            $this->grabZones();
//            $this->checkGeoZonesSort();
//            $this->tester->click(self::CANCEL_BUTTON, '');
//        }
    }

    /**
     * @return string[]
     */
    public function grabZones()
    {
        //Забираем все выбранные значения из выпадающих списков
        $geoZonesTitles = $this->tester->grabMultiple('//table[@class="dataTable"]//select[@data-size="medium"]/option[@selected="selected"]');
        // Убираем лишние поля из массива с заголовками
        foreach ($geoZonesTitles as $key => $value){
            if ($key % 2 === 0) {
                unset($geoZonesTitles[$key]);
            }
        }
        return $geoZonesTitles;
    }

    /**
     * @throws \Codeception\Exception\ModuleException
     */
    public function checkGeoZonesSort()
    {
        $zones = $this->grabZones();
        $this->tester->checkSort($zones);
    }

//    public function grabActualGeoZones()
//    {
//        $zones = $this->tester->grabMultiple(self::EDIT_BUTTON, 'href');
//        $this->actualGeoZonesList = $zones;
//    }

}