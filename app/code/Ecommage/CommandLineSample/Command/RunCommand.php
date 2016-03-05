<?php
namespace Ecommage\CommandLineSample\Command;


use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('ecommage:command');
        $this->setDescription('ecommage command line extension');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Ecommage!");
    }
}