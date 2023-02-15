<?php
use App\Mail\ExceptionOccured;
use Illuminate\Support\Facades\Log;


/**
 * sendEmail
 *
 * @param  mixed $exception
 * @return void
 */
function sendEmail(Throwable $exception)
{
    try {

        $content['message'] = $exception->getMessage();
        $content['file'] = $exception->getFile();
        $content['line'] = $exception->getLine();
        $content['trace'] = $exception->getTrace();

        $content['url'] = request()->url();
        $content['body'] = request()->all();
        $content['ip'] = request()->ip();

        Mail::to('tech@computan.com')->send(new ExceptionOccured($content));
         //Mail::to('filtukegna@gufum.com')->send(new ExceptionOccured($content));

    } catch (Throwable $exception) {
        Log::error($exception);
    }
}
