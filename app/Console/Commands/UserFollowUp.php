<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Mail\FollowUpMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class UserFollowUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:followup';

    /**
     * The console command description.
     * mail send after 3 days user registration
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::where('created_at', '<', now()->subDays(3))->where('created_at', '>', now()->subDays(4))->get();
        if($users->count()){
            foreach ($users as $user) {
                Mail::to($user->email)->send(new FollowUpMail($user));
            }
        }
        return Command::SUCCESS;
    }
}
