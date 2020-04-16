<?php

declare(strict_types=1);

namespace Tests\_support\Commands;

use Codeception\Command\Shared\Config;
use Codeception\Command\Shared\FileSystem;
use Exception;
use \Symfony\Component\Console\Command\Command;
use \Codeception\CustomCommandInterface;
use \Symfony\Component\Console\Input\InputOption;
use \Symfony\Component\Console\Input\InputInterface;
use \Symfony\Component\Console\Output\OutputInterface;
use Tests\_support\Templates\AcceptanceTestTemplate;

class GenerateTemplate extends Command implements CustomCommandInterface
{

    use FileSystem;
    use Config;

    /**
     * returns the name of the command
     * @return string
     */
    public static function getCommandName(): string
    {
        return 'Templates:generateTemplate';
    }

    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setDefinition(array(
            new InputOption('friendly', 'f', InputOption::VALUE_NONE, 'The Message will be friendly'),

        ));

        parent::configure();
    }

    /**
     * Returns the description for the command.
     * @return string
     */
    public function getDescription(): string
    {
        return 'Generate template for test';
    }

    /**
     * Executes the current command.
     *
     * This method is not abstract because you can use this class
     * as a concrete class. In this case, instead of defining the
     * execute() method, you set the code to execute by passing
     * a Closure to the setCode() method.
     *
     * @param InputInterface $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return null|int null or 0 if everything went fine, or an error code
     *
     * @throws LogicException When this abstract method is not implemented
     *
     * @see setCode()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
//        $messageEnd = "!" . PHP_EOL;
//
//        if ($input->getOption('friendly')) {
//            $messageEnd = "," . PHP_EOL;
//            $messageEnd .= "how are you?" . PHP_EOL;
//        }
//
//        echo "Hello " . get_current_user();
//        echo $messageEnd . PHP_EOL;
//        return 0;
//        AcceptanceTestTemplate::createTest();
        if (file_exists('AcceptanceTestExampleCest.php')) {
            throw new Exception('File already created');
        }
        $this->createFile('AcceptanceTestExampleCest.php', AcceptanceTestTemplate::$test);
        echo 'ok';
        return 0;

//        var_dump(file_put_contents('LoginCest.php', $this->test));
//        return 1;
    }
}