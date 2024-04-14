<?php

namespace App\Http\Controllers\Dashboard\Traits;

use App\Models\Post;

trait BlogContents
{
    public function belongnsToPost()
    {
        return $this->morphModel('post') instanceof Post;
    }

    public function prepareBlockContent($request)
    {
        switch ($request->layout) {
            case 'text':
            case 'quote':
            case 'title':
                return [
                    'text' => $request->text,
                ];

            case 'image':
                return [
                    'cover_image_path' => $this->saveFile($this->blockableModel()->storagePath('content'), $request->cover),
                    'photo_info' => $request->photo_info,
                ];

            case 'link':
                return [
                    'link_text' => $request->link_text,
                    'link_button' => $request->link_button,
                    'link' => $request->link,
                ];

            case 'video':
                return [
                    'video_url' => $request->video_url,
                    'video_description' => $request->video_description,
                ];

            case 'list':

                return [
                    'items' => preg_split("/(\r\n|\n|\r)/", $request->text),
                ];

            default:
                return [];
        }
    }

    public function updateBlockContent($request, $block)
    {
        switch ($block->layout) {
            case 'text':
            case 'quote':
            case 'title':
                return [
                    'text' => $request->text,
                ];

            case 'image':
                $content = [];

                if ($request->hasFile('cover')) {
                    $this->deleteFile($block->extractContent('cover_image_path'));
                    $content['cover_image_path'] = $this->saveFile($this->blockableModel()->storagePath('content'), $request->cover);
                } else {
                    $content['cover_image_path'] = $block->extractContent('cover_image_path');
                }

                return $content + [
                    'photo_info' => $request->photo_info,
                ];

            case 'link':
                return [
                    'link_text' => $request->link_text,
                    'link_button' => $request->link_button,
                    'link' => $request->link,
                ];

            case 'video':
                return [
                    'video_url' => $request->video_url,
                    'video_description' => $request->video_description,
                ];

            case 'list':

                return [
                    'items' => preg_split("/(\r\n|\n|\r)/", $request->text),
                ];

            default:
                return [];
        }
    }
}
