<?php

namespace App\Http\Controllers\Dashboard;

use App\Asteroide\Traits\ControllerHelpers;
use App\Asteroide\Traits\DealWithFiles;
use App\Asteroide\Traits\MapPolymorphicModels;
use App\Asteroide\Traits\Notifications;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\Traits\BlogContents;
use App\Http\Resources\BlockResource;
use App\Models\Block;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    use MapPolymorphicModels,
        ControllerHelpers,
        Notifications,
        DealWithFiles,
        BlogContents;

    public function __construct()
    {
        $this->registerPolymorphicClasses('post');
    }

    public function blockableModel()
    {
        return $this->morphModel('post');
    }

    private function sortedBlocks()
    {
        return $this->blockableModel()->blocks->sortBy('position');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->polymorphicMapFromRequest($request);

        return BlockResource::collection($this->sortedBlocks());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->polymorphicMapFromRequest($request);

        $lastBlock = $this->blockableModel()->blocks()->orderBy('position', 'desc')->first();

        $block = new Block(
            $request->only('layout') + [
                'position' => is_null($lastBlock) ?: $lastBlock->position + 1,
            ]
        );

        if ($this->belongnsToPost()) {
            $block->fill(['content' => json_encode($this->prepareBlockContent($request))]);
        }

        $this->blockableModel()->blocks()->save($block);

        return response()->json($this->getApiNotification());
    }

    public function update(Request $request, Block $block)
    {
        $this->polymorphicMapFromRequest($request);

        if ($request->has('move_up')) {
            $prev = Block::previousTo($block)->first();

            if (! is_null($prev)) {
                $currentPos = $block->position;
                $prevPos = $prev->position;

                $block->position = $prevPos;
                $prev->position = $currentPos;

                $prev->save();
            }

            $block->save();

            return response()->json($this->getApiNotification());
        }

        if ($request->has('move_down')) {
            $next = Block::nextTo($block)->first();

            if (! is_null($next)) {
                $currentPos = $block->position;
                $nextPos = $next->position;

                $block->position = $nextPos;
                $next->position = $currentPos;

                $next->save();
            }

            $block->save();

            return response()->json($this->getApiNotification());
        }

        if ($this->belongnsToPost()) {
            $block->fill(['content' => json_encode($this->updateBlockContent($request, $block))]);
        }

        $block->save();

        return response()->json($this->getApiNotification());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(Block $block)
    {
        if ($block->is('image')) {
            $this->deleteFile($block->extractContent('cover_image_path'));
        }

        $block->delete();

        return response()->json($this->getApiNotification());
    }
}
