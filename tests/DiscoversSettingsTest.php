<?php

namespace Spatie\LaravelSettings\Tests;

use Spatie\LaravelSettings\Tests\TestClasses\DummySettingsWithDefaultValue;
use function PHPUnit\Framework\assertEqualsCanonicalizing;
use Spatie\LaravelSettings\Support\Composer;
use Spatie\LaravelSettings\Support\DiscoverSettings;
use Spatie\LaravelSettings\Tests\TestClasses\DummyEncryptedSettings;
use Spatie\LaravelSettings\Tests\TestClasses\DummySettings;
use Spatie\LaravelSettings\Tests\TestClasses\DummySettingsWithCast;
use Spatie\LaravelSettings\Tests\TestClasses\DummySettingsWithImportedType;
use Spatie\LaravelSettings\Tests\TestClasses\DummySettingsWithRepository;

use Spatie\LaravelSettings\Tests\TestClasses\DummySimpleSettings;

it('can get all classes that are settings', function () {
    $pathToComposerJson = __DIR__.'/../composer.json';

    $discovered = (new DiscoverSettings())
        ->within([__DIR__.'/TestClasses'])
        ->useBasePath(realpath(__DIR__.'/../'))
        ->useRootNamespace('Spatie\LaravelSettings\\')
        ->ignoringFiles(Composer::getAutoloadedFiles($pathToComposerJson))
        ->discover();

    assertEqualsCanonicalizing([
        DummySimpleSettings::class,
        DummySettings::class,
        DummyEncryptedSettings::class,
        DummySettingsWithDefaultValue::class,
        DummySettingsWithImportedType::class,
        DummySettingsWithCast::class,
        DummySettingsWithRepository::class,
    ], $discovered);
});
