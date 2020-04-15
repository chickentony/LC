<?php

declare(strict_types=1);

namespace Tests\_support\Templates;

class AcceptanceTestTemplate
{
    public static $test = <<<EOF
<?php
class LoginCest 
{    
    public function _before(AcceptanceTester \$I)
    {
        \$I->amOnPage('/');
    }

    public function loginSuccessfully(AcceptanceTester \$I)
    {
        // write a positive login test 
    }
    
    public function loginWithInvalidPassword(AcceptanceTester \$I)
    {
        // write a negative login test
    }       
}
EOF;

    public static function createTest()
    {
        if (!file_exists('LoginCest.php')) {
            file_put_contents('tests/acceptance/LoginCest.php', self::$test);
        }
    }

}
