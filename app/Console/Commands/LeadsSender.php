<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Modules\Lead\Constants\LeadStatus;
use Modules\Lead\Models\Lead;
use Symfony\Component\Console\Output\ConsoleOutput;

class LeadsSender extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leads:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send all Pending leads then mark them as sent.';

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
     */
    public function handle()
    {
        $out = new ConsoleOutput();

        $leads = Lead::query()->where('sent', LeadStatus::PENDING)->limit(10)->get();
        if (!$leads->count()) {
            $out->writeln("All pending leads are sent.");
        }

        /** @var Lead $lead */
        foreach ($leads as $lead){
            $out->writeln('Found a Pending Lead #'.$lead->id);


            try {
                $duplicate = Lead::query()
                    ->where('branche_id', $lead->branche_id)
                    ->where('offer_id', $lead->offer_id)
                    ->where('name', $lead->name)
                    ->where('phone', $lead->phone)
                    ->where('id', '!=',  $lead->id)
                    ->where('sent', '!=', LeadStatus::PENDING)
                    ->first();


                if ($duplicate) {
                    $lead->sent = LeadStatus::DUPLICATED;
                    $out->writeln('Duplicated Lead #'.$lead->id);
                } else {
                    $lead->sendRest();
                    $lead->sent = LeadStatus::SENT;
                    $out->writeln('Sent Lead #'.$lead->id);
                }

            } catch (Exception $exception) {
                $lead->sent = LeadStatus::ERROR;
                $lead->response = $exception->getMessage();
                $out->writeln('Error while Sending Lead #'.$lead->id);
            }

            $lead->save();

        }
    }
}
