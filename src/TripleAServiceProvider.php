<?php

namespace Laraflow\TripleA;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Laraflow\TripleA\Commands\TripleACommand;

class TripleAServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('TripleA')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_TripleA_table')
            ->hasCommand(TripleACommand::class);
    }
}
