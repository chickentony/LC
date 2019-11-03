<?php

namespace Tests\Page\Admin\GeoZones;

use AcceptanceTester;

class GeoZonesPage extends AcceptanceTester
{
    const PAGE_URL = 'admin/?app=geo_zones';

    const PAGE_HEADER = '//h1[contains(., " Geo Zones")]';

    const GEO_ZONE_NAME_FROM_TABLES = '//table[@class="dataTable"]//td//a[(text())]';

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