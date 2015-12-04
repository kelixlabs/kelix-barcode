<?php namespace Kelixlabs\KelixBarcode;

use Illuminate\Support\ServiceProvider;

class KelixBarcodeServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('kelixlabs/kelix-barcode');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['DNS1D'] = $this->app->share(function ($app) {
            return new DNS1D;
        });
        $this->app['DNS2D'] = $this->app->share(function ($app) {
            return new DNS2D;
        });

        //
        // Shortcut so developers don't need to add an Alias in app/config/app.php
        $this->app->booting(function () {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('DNS1D', 'Kelixlabs\KelixBarcode\Facades\DNS1DFacade');
        });

        $this->app->booting(function () {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('DNS2D', 'Kelixlabs\KelixBarcode\Facades\DNS2DFacade');
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array("DNS1D", "DNS2D");
	}

}
