<?php
namespace App\Providers;
use App\Utils\Util;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        \Response::macro('protobuf', function (array $models, int $status = 200) {
            $packed = Util::serialize($models);
            return response($packed, $status)->header('Content-Type', 'application/octet-stream');
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
