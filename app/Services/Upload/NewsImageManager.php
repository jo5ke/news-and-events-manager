<?php

namespace App\Services\Upload;

use App\Models\News;
use Illuminate\Http\UploadedFile;
use Illuminate\Filesystem\Filesystem;
use Intervention\Image\ImageManager;
use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Support\Str;

class NewsImageManager
{
    const IMAGE_WIDTH = 575;

    const IMAGE_HEIGHT = 325;

    /** @var \Illuminate\Filesystem\Filesystem */
    private $fs;

    /** @var \Intervention\Image\ImageManager */
    private $imageManager;

    public function __construct(Filesystem $fs, ImageManager $imageManager)
    {
        $this->fs = $fs;
        $this->imageManager = $imageManager;
    }

    /**
     * Upload image
     *
     * @param News $news
     * @param UploadedFile $file
     *
     * @return string
     */
    public function upload(News $news, UploadedFile $file)
    {
        $this->deleteOldImage($news);
        list($name, $newsImage) = $this->save($file);

        return $name;
    }

    /**
     * Upload and crop user avatar to predefined width and height.
     *
     * @param News $news
     * @param UploadedFile $file
     * @param array|null $cropPoints
     *
     * @return string Avatar file name.
     */
    public function uploadAndCropAvatar(News $news, UploadedFile $file, array $cropPoints = null)
    {
        list($name, $newsImage) = $this->save($file);

        try {
            $this->cropAndResizeImage($newsImage, $cropPoints);
            $this->deleteOldImage($news);
        } catch (\Exception $e) {
            logger("Cannot upload avatar. " . $e->getMessage());
            $this->fs->delete($this->getDestinationDirectory() . "/" . $name);

            return null;
        }

        return $name;
    }

    /**
     * Get destination directory where image should be uploaded.
     *
     * @return string
     */
    private function getDestinationDirectory()
    {
        return public_path('upload/news');
    }

    /**
     * Build image name.
     *
     * @param UploadedFile $file
     *
     * @return string
     */
    private function generateImageName(UploadedFile $file)
    {
        return sprintf("%s.%s", Str::random(), $file->getClientOriginalExtension());
    }

    /**
     * Delete old image
     *
     * @param News $news
     */
    private function deleteOldImage(News $news)
    {
        if ($news->image) {
            return;
        }

        if (file_exists(sprintf("%s/upload/news/%s", public_path(), $news->image))) {
            $this->fs->delete((sprintf("%s/upload/news/%s", public_path(), $news->image)));
        }
    }

    /**
     * Save image
     *
     * @param \Illuminate\Http\UploadedFile
     *
     * @return mixed
     */
    private function save(UploadedFile $file)
    {
        $name = $this->generateImageName($file);

        $targetFile = $file->move(
            $this->getDestinationDirectory(),
            $name
        );

        return [$name, $targetFile];
    }

    /**
     * Crop image from provided selected points and
     * resize it to predefined width and height.
     *
     * @param \Symfony\Component\HttpFoundation\File\File $avatarImage
     * @param array|null $points
     * @return \Intervention\Image\Image
     */
    private function cropAndResizeImage(File $avatarImage, array $points = null)
    {
        $image = $this->imageManager->make(
            $avatarImage->getRealPath()
        );

        if ($points) {
            // Calculate delta between two points on X axis. This
            // value will be used as width and height for cropped image.
            $size = floor($points['x2'] - $points['x1']);

            return $image->crop($size, $size, (int) $points['x1'], (int) $points['y1'])
                ->resize(self::IMAGE_WIDTH, self::IMAGE_HEIGHT)
                ->save();
        }

        // If crop points are not provided, we will just crop
        // provided image to specified width and height.
        return $image->crop(self::IMAGE_WIDTH, self::IMAGE_HEIGHT)
            ->save();
    }
}
