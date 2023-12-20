<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Set default pagination views
        Blade::directive('getSpicinessLevelName', function ($level) {
            return "<?php echo getSpicinessLevelName($level); ?>";
        });

        // Define the helper function
        if (!function_exists('getSpicinessLevelName')) {
            function getSpicinessLevelName($level)
            {
                switch ($level) {
                    case 1:
                        return 'Little Spicy';
                    case 2:
                        return 'Spicy';
                    case 3:
                        return 'More Spicy';
                    case 4:
                        return 'Very Spicy';
                    case 5:
                        return 'Most Spicy';
                    default:
                        return 'Unknown Spiciness Level';
                }
            }
        }
    }
}
