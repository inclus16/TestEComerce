<?php


namespace App\Command\Abstractions;


use App\Repositories\Abstractions\AbstractRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class Seeder extends Command
{
    protected AbstractRepository $repository;

    public function __construct(AbstractRepository $repository, string $name = null)
    {
        parent::__construct($name);
        $this->repository = $repository;
    }

    protected abstract function generateData(): array;

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $data = $this->generateData();
        $count = count($data);
        $this->repository->addRange($data);
        $output->writeln("Successfully added generated data with count: {$count}");
        return 0;
    }
}
