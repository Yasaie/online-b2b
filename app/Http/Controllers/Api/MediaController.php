<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;
use Spatie\MediaLibrary\Models\Media;

class MediaController extends ApiController
{
    /**
     * @package upload
     * @author  Payam Yasaie <payam@yasaie.ir>
     *
     */
    public function store()
    {
        try {
            return \Auth::user()->addMediaFromRequest('file')
                ->toMediaCollection('draft')->id;
        } catch (DiskDoesNotExist $e) {
            return ['message' => $e->getMessage()];
        } catch (FileDoesNotExist $e) {
            return ['message' => $e->getMessage()];
        } catch (FileIsTooBig $e) {
            return ['message' => $e->getMessage()];
        }
    }

    /**
     * @author  Payam Yasaie <payam@yasaie.ir>
     * @since   2019-11-17
     *
     * @param null $id
     *
     * @return array|int
     */
    public function destroy($id = null)
    {
        if ($id) {
            /** @var \Eloquent $media */
            $media = new Media();
            try {
                return $media->find($id)->delete() ? 1 : 0;
            } catch (\Exception $e) {
                return ['message' => $e->getMessage()];
            }
        }
        return 0;
    }
}
