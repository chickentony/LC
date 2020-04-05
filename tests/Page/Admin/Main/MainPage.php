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

    public function openItemsAndSubItemsAndCheckHeaders()
    {
        $items = $this->getAllMenuItems();
        foreach ($items as $item) {
            $this->tester->click($item);
            if (!empty($this->getAllMenuSubItems())) {
                $subItems = $this->getAllMenuSubItems();
                foreach ($subItems as $subItem) {
                    $this->tester->click($subItem);
                }
            }
        }
    }
}