<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

# use App\Articles\ArticlesRepository;
use App\Articles\EloquentSearchRepository;
use App\Articles\ElasticsearchRepository;
use App\Articles\SearchRepository;
#
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
       
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
