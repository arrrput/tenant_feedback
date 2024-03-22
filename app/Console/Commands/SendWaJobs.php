<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendWaJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:whatsapp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notification success sending!';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
        
    }
}
