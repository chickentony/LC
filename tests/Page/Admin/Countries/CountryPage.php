<?php

namespace Tests\Page\Admin\Countries;

use AcceptanceTester;

class CountryPage
{
    /** @var int Число ссылок на странице */
    private int $numberOfLinks;

    /** @var string Кнопка возврата назад на страницу со списком всех стран */
    public const CANCEL_BUTTON = '//*[@name="cancel"]';

    /** @var string Строка с информацией по геозоне */
    public const GEO_ZONES_TABLE_ROW = '//table[@class="dataTable"]//td[(text())]';

    /** @var string Формат для ссылок на вшение ресурсы */
    public const EXTERNAL_LINK_FORMAT = '(//i[@class="fa fa-external-link"])[%d]';

    /** @var string Ссылка на вшение ресурсы */
    public const EXTERNAL_LINK = '//i[@class="fa fa-external-link"]';

    /** @var AcceptanceTester */
    protected AcceptanceTester $tester;

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
        $currentLink = 0;
        $this->getNumberOfLinksOnPage();
        while ($currentLink < $this->numberOfLinks) {
            $currentLink++;
            $this->tester->click($this->generateXPathForExternalLink($currentLink));
            $handles = $this->tester->getWindowHandles();
            $this->tester->assertGreaterThan(1, count($handles), 'This is link number ' . $currentLink);
            $this->tester->closeWindowById($handles[1]);
        }
    }

    /**
     * @param $linkNumber
     * @return string
     * Генерирует x-path для внешней ссылки
     */
    private function generateXPathForExternalLink($linkNumber)
    {
        return sprintf(self::EXTERNAL_LINK_FORMAT, $linkNumber);
    }

    /** Получает кол-во элементов на странице */
    private function getNumberOfLinksOnPage()
    {
        $this->numberOfLinks = $this->tester->getNumberOfElementsOnPage(self::EXTERNAL_LINK);
    }
}