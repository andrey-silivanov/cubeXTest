<?php
declare(strict_types = 1);

namespace App\Console\Commands\Make;

use Illuminate\Foundation\Console\ModelMakeCommand;

/**
 * Class ModelCommand
 * @package App\Console\Commands\Make
 */
class ModelCommand extends ModelMakeCommand
{
    /**
     * @return string
     */
    protected function getStub(): string
    {
        return app_path('Console/stubs/model.stub');
    }
}
