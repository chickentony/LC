<?php


namespace Tests\Page\Admin\Countries;


class CountryPage
{
    /** @var string Кнопка возврата назад на страницу со списком всех стран */
    public const CANCEL_BUTTON = '//*[@name="cancel"]';

    /** @var string Строка с информацией по геозоне */
    public const GEO_ZONES_TABLE_ROW = '//table[@class="dataTable"]//td[(text())]';
}