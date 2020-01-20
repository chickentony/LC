<?php

namespace Tests\Page\Admin\Countries;

use AcceptanceTester;

class CountryPage
{
    /** @var string Кнопка возврата назад на страницу со списком всех стран */
    public const CANCEL_BUTTON = '//*[@name="cancel"]';

    /** @var string Строка с информацией по геозоне */
    public const GEO_ZONES_TABLE_ROW = '//table[@class="dataTable"]//td[(text())]';

    public const EXTERNAL_LINKS = '//*[@class="fa fa-external-link"]';

    protected $tester;

    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
    }
}