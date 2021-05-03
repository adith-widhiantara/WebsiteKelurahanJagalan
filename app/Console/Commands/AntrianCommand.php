<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\Antrian\NomorAntrian;

class AntrianCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'antrian:set';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set Antrian Data Into Expired Data';

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
        $expiredData = NomorAntrian::query()
            ->whereDate('created_at', Carbon::today())
            ->where('status', 0)
            ->get();

        foreach ($expiredData as $expired) {
            $expired->update([
                'status' => 4
            ]);
        }

        $unfinishedData = NomorAntrian::query()
            ->whereDate('created_at', Carbon::today())
            ->where('status', 1)
            ->get();

        foreach ($unfinishedData as $unfinished) {
            $unfinished->update([
                'status' => 2
            ]);
        }
    }
}
