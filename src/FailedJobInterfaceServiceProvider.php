<?php namespace MoldersMedia\FailedJobInterface;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class FailedJobInterfaceServiceProvider extends ServiceProvider
{
    /**
     * 
     */
    public function register()
    {

    }

    /**
     * @param Router $router
     */
    public function boot(Router $router)
    {
        $this->loadViewsFrom(
            __DIR__ . '/../resources/views/', 'fji'
        );

        $this->mergeConfigFrom(__DIR__ . '/config/failed_job_interface.php', 'failed_job_interface');

        $this->setHorizonConfig();
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');

        $this->setRoutes($router);
    }

    /**
     *
     */
    private function setHorizonConfig()
    {
        if (is_null(config('failed_job_interface.uses_horizon'))) {
            if (class_exists('Laravel\Horizon\HorizonServiceProvider')) {
                config()->set('failed_job_interface.uses_horizon', true);
            }
        }
    }

    /**
     * @param Router $router
     */
    private function setRoutes(Router $router)
    {
        $router->group([
            'namespace'  => 'MoldersMedia\FailedJobInterface\Http\Controllers',
            'prefix'     => config('failed_job_interface.url'),
            'middleware' => config('failed_job_interface.middleware')
        ], function (Router $router) {
            $router->group(['prefix' => 'assets'], function (Router $router) {
                $router->get('css', 'AssetController@css')->name('fji.assets.css');
                $router->get('js', 'AssetController@js')->name('fji.assets.js');
            });

            $router->group(['prefix' => 'filters'], function (Router $router) {
                $router->get('get-connections', 'FilterController@getConnections')->name('fji.filters.connections');
                $router->get('get-tags', 'FilterController@getTags')->name('fji.filters.tags');
                $router->get('get-queues', 'FilterController@getQueues')->name('fji.filters.queues');
            });

            $router->get('/', 'IndexController@index');
            $router->get('get-jobs', 'IndexController@getJobs')->name('fji.get-jobs');
            $router->get('get-job', 'IndexController@getJob')->name('fji.get-job');
        });
    }
}