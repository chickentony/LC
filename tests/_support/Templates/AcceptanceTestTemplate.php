<?php

declare(strict_types=1);

namespace Tests\_support\Templates;

class AcceptanceTestTemplate
{
    public const ACCEPTANCE_EXAMPLE = <<<EOF
    <?php
    
    declare(strict_types=1);
    
    namespace Tests\acceptance;
    
    use AcceptanceTester;
    
    class AcceptanceTestExampleCest 
    {    
        public function _before(AcceptanceTester \$I)
        {
            \$I->amOnPage('/');
        }
    
        public function firstTest(AcceptanceTester \$I)
        {
            // write a positive test 
        }
        
        public function secondTest(AcceptanceTester \$I)
        {
            // write a negative test
        }       
    }
    EOF;
}
