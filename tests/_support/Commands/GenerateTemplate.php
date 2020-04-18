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
            new InputOption('acceptance', 'a', InputOption::VALUE_NONE, 'Generate acceptance test example'),
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
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        if ($input->getOption('acceptance')) {
            if (file_exists('AcceptanceTestExampleCest.php')) {
                $output->write('You already create file please check it in acceptance directory', false, 1);
                return 0;
            }
            $this->createFile(
                'tests\AcceptanceTestExampleCest.php', AcceptanceTestTemplate::ACCEPTANCE_EXAMPLE
            );
            $output->write('Example test created successfully', false, 1);
            return 1;
        }
        $output->write('Please select template by using --help command');
        return 1;
    }
}
