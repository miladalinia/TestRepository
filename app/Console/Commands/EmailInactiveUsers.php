<?php

namespace App\Console\Commands;

use App\Notifications\NotifyInactiveUser;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redis;

class EmailInactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:inactive-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email to inactive users';

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
     * @return mixed
     */
    public function handle()
    {
        $limit = Carbon::now()->subDay(7);
        $inactive_user = User::where('last_login_at', '<', $limit)->get();
        foreach ($inactive_user as $user) {
            $user->notify(new NotifyInactiveUser());
        }

    }
}
