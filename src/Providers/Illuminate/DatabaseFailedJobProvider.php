<?php namespace MoldersMedia\FailedJobInterface\Providers\Illuminate;

use Carbon\Carbon;
use Illuminate\Queue\Failed\DatabaseFailedJobProvider as IlluminateDatabaseFailedJobProvider;

class DatabaseFailedJobProvider extends IlluminateDatabaseFailedJobProvider
{
    public function log($connection, $queue, $payload, $exception)
    {
        $failed_at = Carbon::now();

        $exception = (string)$exception;

        $encodedPayload = json_decode($payload);

        if ($encodedPayload && $encodedPayload->tags) {
            $tags = json_encode($encodedPayload->tags);
        }

        return $this->getTable()->insertGetId(compact(
            'connection', 'queue', 'payload', 'exception', 'failed_at', 'tags'
        ));
    }
}