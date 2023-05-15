<?php

namespace App\Providers;

use App\Services\SettingsServices;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Faker\Generator as FakerGenerator;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\Facades\View;
use Modules\Lead\Models\Lead;
use Modules\Doctor\Models\Doctor;
use Modules\Branche\Models\Branche;
use Modules\Specificity\Models\Specificity;
use Modules\Booking\Models\Booking;
use Modules\Offer\Models\OfferBooking;
use Modules\Service\Models\Service;
use App\Constants\Statuses;
use URL;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }

        try {
            //count numbers
            $countleads = Booking::count() ?? 0;
            View::share('countleads', $countleads);

            $countleadsoffer = OfferBooking::count() ?? 0;
            View::share('countleadsoffer', $countleadsoffer);

            $countdoctors = Doctor::count() ?? 0;
            View::share('countdoctors', $countdoctors);

            $countbranches = Branche::count() ?? 0;
            View::share('countbranches', $countbranches);

            $countspecifi = Specificity::count() ?? 0;
            View::share('countspecifi', $countspecifi);

            $servicesmanu = Service::with('translations')->where('status', Statuses::ACTIVE)->whereIn('type_of_place',[1,3])->get();
            View::share('servicesmanu', $servicesmanu);

            $settings = app(SettingsServices::class)->list();
            View::share('settings', $settings);

        } catch (\Exception $exception) {

        }

    }
}
