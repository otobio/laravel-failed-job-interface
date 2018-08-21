<?php namespace MoldersMedia\FailedJobInterface\ServiceProviders\Illuminate;

use Illuminate\Queue\QueueServiceProvider as IlluminateServiceProvider;
use MoldersMedia\FailedJobInterface\Providers\Illuminate\DatabaseFailedJobProvider;

class QueueServiceProvider extends IlluminateServiceProvider
{
    /**
     * Create a new database failed job provider.
     *
     * @param  array $config
     * @return \Illuminate\Queue\Failed\DatabaseFailedJobProvider
     */
    protected function databaseFailedJobProvider($config)
    {
        return new DatabaseFailedJobProvider(
            $this->app['db'], $config['database'], $config['table']
        );
    }
}
