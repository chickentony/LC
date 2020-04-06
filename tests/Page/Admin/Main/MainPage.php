<?php

declare(strict_types=1);

namespace Tests\Page\Admin\Main;

use AcceptanceTester;

class MainPage
{
    /** @var string Кнопка выхода из админки */
    public const LOGOUT_BUTTON = '//*[@title="Logout"]';

    public const LOGOTYPE_IMG = '//img[@title="My Store"]';

    public const LEFT_MENU_ITEMS_HREF = '//ul[@id="box-apps-menu"]//li//a';

    public const LEFT_MENU_SUB_ITEMS_HREF = '//ul[@id="box-apps-menu"]//li//ul//li/a';

    public const PAGE_TITLE = '//h1';

    protected $tester;

    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
    }

    public function getAllMenuItems(): array
    {
        return $this->tester->grabMultiple(self::LEFT_MENU_ITEMS_HREF);
    }

    public function getAllMenuSubItems(): ?array
    {
        return $this->tester->grabMultiple(self::LEFT_MENU_SUB_ITEMS_HREF);
    }

    public function checkTitleExistOnPage(): bool
    {
        $title = $this->tester->grabTextFrom(self::PAGE_TITLE);
        return !(strlen($title) === '');
    }

    /**
     * @throws \Exception
     * Исключить клик по первому элементу в подэлементах
     */
    public function openItemsAndSubItemsAndCheckThatPagesHasTitles(): bool
    {
        $items = $this->getAllMenuItems();
        foreach ($items as $item) {
            $this->tester->click($item);
            if ($this->checkTitleExistOnPage() === false) {
                return false;
            }
            $subItems = $this->getAllMenuSubItems();
            if (!empty($subItems)) {
                foreach ($subItems as $subItem) {
                    $this->tester->click($subItem);
                    if ($this->checkTitleExistOnPage() === false) {
                        return false;
                    }
                }
            }
        }
        return true;
    }
}
