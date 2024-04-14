<?php

namespace App\Asteroide\Traits;

use Illuminate\Support\Str;

trait MapPolymorphicModels
{
    public $availablePolymorphicClasses;

    public $polymorphicModels;

    public $accessors;

    public function registerPolymorphicClasses(...$accessors)
    {
        $this->polymorphicModels = collect();
        $this->availablePolymorphicClasses = collect();
        $this->accessors = collect($accessors);

        foreach ($accessors as $accessor) {
            $this->availablePolymorphicClasses = $this->availablePolymorphicClasses->merge([$accessor => '\App\Models\\'.Str::ucfirst($accessor)]);
        }
    }

    protected function polymorphicMapFromRequest($request)
    {
        foreach ($this->accessors as $accessor) {
            $modelId = optional($request)->{$accessor};

            if (filled($modelId) && is_numeric($modelId)) {
                $this->polymorphicModels = $this->polymorphicModels->merge([
                    $accessor => ($this->availablePolymorphicClasses->get($accessor))::find($modelId),
                ]);
            }
        }
    }

    public function morphModel($accessor)
    {
        return $this->polymorphicModels->get($accessor);
    }
}
