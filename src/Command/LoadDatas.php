<?php


namespace App\Command;


use App\Data\datas;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LoadDatas extends Command
{
    private $loader;

    public function __construct(datas $datas)
    {
        parent::__construct();
        $this->loader = $datas;
    }

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:load-datas')

            // the short description shown while running "php bin/console list"
            ->setDescription('Ajouter les données fixes lors de la mise en place de l\'application')

            // the full command description shown when running the command with the "--help" option
            ->setHelp('Cette commande permet d\'ajouter les données fixes lors de la mise en place de l\'application')

        ;

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->loader->load();
            echo "Vos donnés ont bien été ajoutées";
        } catch (\Exception $e) {
            echo $e;
        }
    }

}