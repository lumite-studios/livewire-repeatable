<?php
namespace LumiteStudios\LivewireRepeatable;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->loadViewsFrom(__DIR__.'/../resources/views', 'livewire-repeatable');
		Livewire::component('repeatable-component', RepeatableComponent::class);
		Livewire::component('repeatable-view-component', RepeatableViewComponent::class);
	}
}
