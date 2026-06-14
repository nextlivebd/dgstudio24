<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('frontend.*', function ($view) {
            $categories = \App\Models\ServiceCategory::with([
                'children' => function($query) {
                    $query->where('status', 1)->with(['services' => function($q) {
                        $q->where('status', 1);
                    }]);
                },
                'services' => function($query) {
                    $query->where('status', 1);
                }
            ])->whereNull('parent_id')->where('status', 1)->get();
            
            $globalCorporateOffice = \App\Models\ContactInformation::where('is_corporate', true)->first();
            $globalContactInfos = \App\Models\ContactInformation::where('is_active', true)->get();

            $view->with([
                'globalServiceCategories' => $categories,
                'globalCorporateOffice' => $globalCorporateOffice,
                'globalContactInfos' => $globalContactInfos
            ]);
        });

        view()->composer('admin.layouts.*', function ($view) {
            $unreadContactsCount = \App\Models\Contact::where('is_read', false)->count();
            $view->with('unreadContactsCount', $unreadContactsCount);
        });
    }
}
