<?php
// src/Command/UpdateDataCommand.php
namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// the name of the command is what users type after "php bin/console"
#[AsCommand(
    name: 'app:update-aliment',
    description: 'Update table aliment',
    hidden : false,
    aliases : ['app:add-aliment']
    )]
class UpdateDataCommand extends Command
{
    // ...
protected function execute(InputInterface $input, OutputInterface $output): int
{
    // outputs multiple lines to the console (adding "\n" at the end of each line)
    dd($input);
    $output->writeln([
        'Update table aliment',
        '============',
        '',
    ]);

    // the value returned by someMethod() can be an iterator (https://php.net/iterator)
    // that generates and returns the messages with the 'yield' PHP keyword
    //$output->writeln($this->someMethod());

    // outputs a message followed by a "\n"
    $output->writeln('Mah test!');

    // outputs a message without adding a "\n" at the end of the line
    $output->write('You are about to ');
    $output->write('update a table.');

    return Command::SUCCESS;
}

    protected function configure(): void
    {
        $this
            // the command description shown when running "php bin/console list"
            ->setDescription('Update la table aliment.')
            // the command help shown when running the command with the "--help" option
            ->setHelp('This command allows you to update table aliment...')
        ;
    }
}