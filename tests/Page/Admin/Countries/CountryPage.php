<?php

namespace Tests\Page\Admin\Countries;

use AcceptanceTester;

class CountryPage
{
    /** @var string Кнопка возврата назад на страницу со списком всех стран */
    public const CANCEL_BUTTON = '//*[@name="cancel"]';

    /** @var string Строка с информацией по геозоне */
    public const GEO_ZONES_TABLE_ROW = '//table[@class="dataTable"]//td[(text())]';

    /** @var string Ссылка на вшение ресурсы */
    public const EXTERNAL_LINKS = '(//i[@class="fa fa-external-link"])[%d]';

    /** @var AcceptanceTester */
    protected $tester;

    /**
     * CountryPage constructor.
     * @param AcceptanceTester $tester
     */
    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
    }

    /**
     * @throws \Codeception\Exception\ModuleException
     * Кликает на внешнеи ссылки и проверяет что они открываются
     */
    public function clickOnExternalLinksAndCheckOpeningLink()
    {
        $linkNumber = 0;
        while ($linkNumber < 7) {
            $linkNumber++;
            $this->tester->click($this->generateXPathForExternalLink($linkNumber));
            $handles = $this->tester->getWindowHandles();
            $this->tester->assertGreaterThan(1, count($handles), 'This is link number ' . $linkNumber);
            $this->tester->closeWindowById($handles[1]);
        }
    }

    /**
     * @param $linkNumber
     * @return string
     * Генерируем x-path для внешней ссылки
     */
    private function generateXPathForExternalLink($linkNumber)
    {
        return sprintf(self::EXTERNAL_LINKS, $linkNumber);
    }
}