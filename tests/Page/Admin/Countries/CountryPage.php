<?php

namespace Tests\Page\Admin\Countries;

use AcceptanceTester;

class CountryPage
{
    /** @var string Кнопка возврата назад на страницу со списком всех стран */
    public const CANCEL_BUTTON = '//*[@name="cancel"]';

    /** @var string Строка с информацией по геозоне */
    public const GEO_ZONES_TABLE_ROW = '//table[@class="dataTable"]//td[(text())]';

    public const EXTERNAL_LINKS = '(//i[@class="fa fa-external-link"])[%d]';

    protected $tester;

    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
    }

    public function clickOnExternalLinks()
    {
        $count = 0;
        $this->tester->click($this->generateXPathForExternalLink(3));
        $handles = $this->tester->getWindowHandles();
        $this->tester->assertGreaterThan(1, count($handles), 'todo loop');
        $this->tester->closeWindowById($handles[1]);
    }

    private function generateXPathForExternalLink($linkNumber)
    {
        return sprintf(self::EXTERNAL_LINKS, $linkNumber);
    }
}