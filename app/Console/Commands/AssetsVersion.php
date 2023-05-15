<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AssetsVersion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assets:release';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all current assets version to bypass cache policy';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $current = (int)trim(file_get_contents(base_path('AssetsVersion')));
            if ($current === 0)
                $current = 1;
        } catch (\Exception $exception) {
            $current = 1;
        }
        $this->info('current version: ' . $current);

        $newVersion = $current + 1;
        file_put_contents(base_path('AssetsVersion'), $newVersion);
        $this->info('new version released: ' . $newVersion);

        return 0;
    }
}
