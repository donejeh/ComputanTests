<?php

namespace App\Jobs;

use Mail;
use Throwable;
use App\Mail\sendEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $content;

    public $tries = 3; //default way

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //throw new \Exception;
    
        Mail::to($this->content['email'])->send(new SendEmail($this->content));
    }
    
    /**
     * failed
     *
     * @param  mixed $throwable
     * @return void
     */
    public function failed(Throwable $throwable){

       // dd($throwable);
       sendEmail($throwable);

    }
}
