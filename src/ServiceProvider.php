<?php namespace GwritDevelopment\UniqueID;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->listenEvents();
    }

    /**
     * Custom Key
     */
    protected function listenEvents()
    {
        Event::listen('eloquent.creating: *', function ($event, array $models) {

            foreach ($models as $model) {
                /**
                 * @var Model $model
                 */
                if ($model instanceof GenerateKey) {

                    $model->incrementing = false;

                    $model->setAttribute($model->getKeyName(), UniqueIDGenerator::generate());
                }
            }
        });
    }
}