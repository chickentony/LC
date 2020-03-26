<?php

declare(strict_types=1);

namespace Tests\acceptance\Registration;

use AcceptanceTester;
use Tests\Page\Main\MainPage;

class RegistrationCest
{
    /** @var string Сообщение при выходе из акаунта */
    private $logoutMessage = 'You are now logged out.';

    /** @var string Название таблицы в базе данных */
    private $dbTableName = 'lc_customers';

    /**
     * @param AcceptanceTester $I
     * @param MainPage $mainPage
     * @throws \Codeception\Exception\ModuleException
     * @throws \Exception
     */
    public function newUserRegistration(AcceptanceTester $I, MainPage $mainPage): void
    {
        $I->amOnPage($mainPage::MAIN_PAGE_URL);
        $I->waitTillPageLoad($mainPage::LOGO_DIV);
        $I->click($mainPage::REGISTRATION_LINK);
        $mainPage->registrationPage->newCustomerRegistration();
        $I->waitTillPageLoad($mainPage::LOGO_DIV);
        $I->see('Your customer account has been created.');
        $mainPage->logout();
        $I->see($this->logoutMessage);
        $mainPage->login($mainPage->registrationPage->generatedEmail, '123qwe');
        $I->see('You are now logged in as Фредд Дерст.');
        $mainPage->logout();
        $I->see($this->logoutMessage);
    }

    /**
     * @param AcceptanceTester $I
     * @param MainPage $mainPage
     * @throws \Codeception\Exception\ModuleException
     * Удаляет созданного пользователя из базы после теста
     */
    public function _after(AcceptanceTester $I, MainPage $mainPage): void
    {
        $I->deleteRecordFromTable($this->dbTableName, [
            'firstname' => $mainPage->registrationPage::NEW_USER['NAME'],
            'lastname' => $mainPage->registrationPage::NEW_USER['LAST_NAME']
        ]);
    }
}
