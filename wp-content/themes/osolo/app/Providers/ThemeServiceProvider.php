<?php

namespace App\Providers;

use \Log1x\SageDirectives\Util;
use Roots\Acorn\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Blade::directive('pre', function ($expression) {
            return "<?php echo '<pre>' . print_r({$expression}, true) . '</pre>'; ?>";
        });

        Blade::directive('menu', function (string|array $expression) {
            if (Util::isArray($expression)) {
                return "<?php wp_nav_menu({$expression}); ?>";
            }

            return "<?php wp_nav_menu(['theme_location' => {$expression}]); ?>";
        });
    }
}
