<?php

namespace App\Asteroide\Traits;

use App\Models\Variant;
use Illuminate\Support\Str;

trait VariantManager
{
    use DealWithFiles;

    public function mixWithOtherGroup($product, $otherGroup, $prop, $level)
    {
        foreach ($otherGroup->props as $otherProp) {
            $variant = new Variant([
                'sku' => Str::upper((Str::random(3).'-'.Str::random(5))),
                'title' => $level === 1 ? ($prop->title.' / '.$otherProp->title) : ($otherProp->title.' / '.$prop->title),
            ]);

            $variant->forceFill([
                'first_prop' => $level === 1 ? $prop->id : $otherProp->id,
                'second_prop' => $level === 1 ? $otherProp->id : $prop->id,
            ]);

            $product->variants()->save($variant);
        }
    }

    public function constructNewVariants(\App\Models\Product $product, $prop)
    {
        if ($product->propGroups->count() > 1) {
            switch ($prop->propGroup->level) {
                case 1:
                    $otherGroup = $product->propGroups()->where('level', 2)->first();

                    $this->mixWithOtherGroup($product, $otherGroup, $prop, $prop->propGroup->level);

                    break;
                case 2:
                    $otherGroup = $product->propGroups()->where('level', 1)->first();

                    if ($prop->propGroup->props->count() === 1) {
                        foreach ($otherGroup->props as $otherProp) {
                            foreach ($otherProp->firstVariants as $variant) {
                                $variant->forceFill([
                                    'title' => $variant->title.' / '.$prop->title,
                                    'second_prop' => $prop->id,
                                ])->save();
                            }
                        }
                    } else {
                        $this->mixWithOtherGroup($product, $otherGroup, $prop, $prop->propGroup->level);
                    }

                    break;
            }
        } else {
            $product->variants()->save((new Variant([
                'title' => $prop->title,
                'sku' => Str::upper((Str::random(3).'-'.Str::random(5))),
            ]))->firstProp()->associate($prop));
        }
    }

    public function deleteVariants($prop, $level)
    {
        foreach (($level === 1 ? $prop->firstVariants : $prop->secondVariants) as $variant) {
            $this->deleteFile($variant->cover_image_path);
            $variant->delete();
        }
    }

    public function unlinkVariants($prop)
    {
        $variants = $prop->secondVariants;

        foreach ($variants as $variant) {
            $variant->forceFill([
                'title' => $variant->firstProp->title,
                'second_prop' => null,
            ])->save();
        }
    }

    public function removeOrUnlinkVariants(\App\Models\Prop $prop)
    {
        switch ($prop->propGroup->level) {
            case 1:
                if ($prop->propGroup->props->count() < 2 && $prop->propGroup->product->propGroups->count() > 1) {
                    return false;
                }

                $this->deleteVariants($prop, 1);

                break;
            case 2:
                if ($prop->propGroup->props->count() < 2) {
                    $this->unlinkVariants($prop);
                } else {
                    $this->deleteVariants($prop, 2);
                }

                break;
        }

        return true;
    }

    public function reconstructVariantTitles(\App\Models\Prop $prop)
    {
        foreach ($prop->variants as $variant) {
            $variant->title = $variant->firstProp->title.($variant->secondProp ? ' / '.$variant->secondProp->title : '');
            $variant->save();
        }
    }
}
