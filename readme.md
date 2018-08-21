# Laravel Failed Job Interface

The failed job interface is a Laravel tool that gives you the possibility to inspect your failed jobs faster. This package is based on Laravel Horizon but can also be used for Beanstalkd, Redis or any other driver. Search through your failed jobs table based on the queue, tags or connection.

## Install

Add the package to your composer: 
`composer require moldersmedia/laravel-failed-jobs-interface`

After adding the package, add the service provider to your app.php file. If you have auto-discover for packages, we are good to go! Use `artisan vendor:publish` to create a config file. Open the config file and set your preferences.

#### Migrations
The package adds a `tags` field to your `failed_jobs` table. You can simply ignore it if you want to use the default QueueServiceProvider. If you would like to access tags in the application, we need to add the extra service provider from this package. Remove the line with `Illuminate\Queue\QueueServiceProvider::class` and add the line `MoldersMedia\FailedJobInterface\ServiceProviders\Illuminate\QueueServiceProvider::class` right on the same spot.

Thats it! Visit the choosen URL from the config (default is `yourdomain.com/failed-job-interface`) and the interface should be visible!

### To do
- Update interface with color scheme
- Add button to mark failed jobs as checked
- Add extra filters such as date, exception or display name
- Cleanup data, add doc blocks
- Create calculation for total kb/mb/gb are used with the cache
