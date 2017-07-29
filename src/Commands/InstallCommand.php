<?php

namespace YM\Commands;

use Illuminate\Console\Command;
use Illuminate\Validation\Rules\In;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;
use YM\Commands\Traits\executeSeed;
use YM\umiAuth\umiAuthServiceProvider;
use YM\UmiServiceProvider;

class InstallCommand extends Command
{
    use executeSeed;

    protected $seederPath;

    protected $name = 'umi:install';

    public function __construct()
    {
        parent::__construct();

        $this->seederPath = __DIR__ . '/../Database/seeds/';
    }

    protected function getOptions()
    {
        return array(
            [
                'lang-zh-only', null, InputOption::VALUE_NONE, 'Only set dataBase language as Chinese', null
            ],
            [
                'lang-en-only', null, InputOption::VALUE_NONE, 'Only set database language as English', null
            ]
        );
    }

    public function fire()
    {

        if ($this->option('lang-zh-only')){
            $this->executeSeed('umi_menus_zh_seeder');
            $this->line('################################################');
            $this->line('Successful set database language as Chinese.');
            return false;
        }
        if ($this->option('lang-en-only')) {
            $this->executeSeed('umi_menus_seeder');
            $this->line('################################################');
            $this->line('Successful set database language as English.');
            return false;
        }
        $lang = $this->ask('Select database language ? 1=Chinese 2=English');
        $hasError = false;

        $this->line('################################################');
        $this->line('>>>>>>>>>>>>>GO>>>>>>>>>>>>>>');
        #publish
        $this->info('Publishing Umi config files and assets, views folder');
        $this->call('vendor:publish', ['--provider' => UmiServiceProvider::class]);
        $this->call('vendor:publish', ['--provider' => umiAuthServiceProvider::class]);
        $this->line('>>>>>>>>>>>>NEXT>>>>>>>>>>>>>');

        #database
        try {
            //migrate
            $this->info('Migrating the data tables into your application');
            $this->call('migrate');
            $this->line('>>>>>>>>>>>>NEXT>>>>>>>>>>>>>');

            //seed
            $this->info('Seeding data into database');
            $this->executeSeed('umiDatabaseSeeder');
            if ($lang == 1) {
                $this->executeSeed('umi_menus_zh_seeder');
            } else {
                $this->executeSeed('umi_menus_seeder');
            }
        } catch (\Exception $exception) {
            $hasError = $exception->getMessage();
            $this->info('Something wrong when executing the database operation');
        }

        $this->line('>>>>>>>>>>>>NEXT>>>>>>>>>>>>>');

        #auth
        $this->info('Generating auth');
        $this->call('make:auth');
        $this->line('>>>>>>>>>>>>NEXT>>>>>>>>>>>>>');

        #load composer
        $composer = $this->loadComposer();
        $this->info('Executing the dump-autoload command');
        $process = new Process($composer . ' dump-autoload');
        $int = $process->setWorkingDirectory(base_path())->run();
        if ($int === 0) {
            $this->info('composer dump-autoload successful');
        } else {
            $this->line('################################################');
            $this->info('Dump-autoload ERROR: ' . Process::$exitCodes[$int]);
        }

        #done
        $this->line('################################################');
        if ($hasError) {
            $this->info('>>>>>>>>>>>>>ERROR INFORMATION>>>>>>>>>>>>>>');
            $this->info($hasError);
        } else {
            $this->info('Congrats! UMI Admin system installed! Enjoy!');
        }
    }

    protected function loadComposer()
    {
        if (file_exists(getcwd() . '/composer.phar')) {
            return '"' . PHP_BINARY . '" ' . getcwd() . '/composer.phar';
        }
        return 'composer';
    }
}