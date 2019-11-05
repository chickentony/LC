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

    protected $tester;

    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
    }

    public function openCountryPage()
    {
        $this->tester->click(self::EDIT_BUTTON);
//        $editButtonsHrefs = $this->tester->grabMultiple(self::EDIT_BUTTON, 'href');
//        $i = 0;
//        while ($i <= count($editButtonsHrefs)) {
//            $i++;
//            $this->tester->click(self::EDIT_BUTTON);
//            $this->tester->click(self::CANCEL_BUTTON);
//        }
    }

    public function grabZones()
    {
        $data = $this->tester->grabMultiple('//table[@class="dataTable"]//select[@data-size="medium"]/option[@selected="selected"]');
        foreach ($data as $key => $value){
            if ($key % 2 === 0) {
                unset($data[$key]);
            }
        }
        var_dump($data);
    }


//    public function checkSort()
//    {
//        $data = $this->grabMultiple('//table[@class="dataTable"]//td//a[(text())]');
//        $sortedData = array_values($data);
//        asort($sortedData);
//        if ($sortedData === $data) {
//            return true;
//        }
//    }



}