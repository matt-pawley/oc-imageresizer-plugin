<?php namespace ToughDeveloper\ImageResizer\Classes;

use ToughDeveloper\ImageResizer\Models\Settings;
use October\Rain\Database\Attach\File;

class Image
{
    /**
     * File path of image
     */
    public $filePath;

    public function __construct($filePath = false)
    {
        if ($filePath instanceof File) {
            $this->filePath = base_path() . $filePath->getPath();
            return;
        }

        $this->filePath = (file_exists($filePath))
            ? $filePath
            : base_path() . $this->parseFileName($filePath);
    }

    /**
     * Resizes an Image
     *
     * @param integer $width The target width
     * @param integer $height The target height
     * @param array   $optinons The options
     * @return string
     */
    public function resize($width = false, $height = false, $options = [])
    {
        // Default settings
        $settings = Settings::instance();

        if (!isset($options['mode'])) {
            $options['mode'] = $settings->default_mode;
        }
        if (!isset($options['offset'])) {
            $options['offset'] = $settings->default_offset;
        }
        if (!isset($options['extension'])) {
            $options['extension'] = $settings->default_extension;
        }
        if (!isset($options['quality'])) {
            $options['quality'] = $settings->default_quality;
        }
        if (!isset($options['sharpen'])) {
            $options['sharpen'] = $settings->default_sharpen;
        }

        // Not a file? Display the not found image
        if (!is_file($this->filePath)) {
            return $this->notFoundImage($width, $height);
        }

        // Create a new file
        $file = new File;

        // Set a disk name, this enables caching
        $file->disk_name = $this->diskName();

        // Set the file to be createed from another file
        $file->fromFile($this->filePath);

        // Resize it
        $thumb = $file->getThumb($width, $height, $options);

        // Return the URL
        return url('/storage/app') . $this->parseFileName($thumb);
    }

    /**
     * Creates a unique disk name for an image
     *
     * @return string
     */
    protected function parseFileName($filePath)
    {
        return str_replace([
            config('app.url'),
            'http://',
            'https://',
            'localhost',
        ], '', $filePath);
    }

    /**
     * Creates a unique disk name for an image
     *
     * @return string
     */
    protected function diskName()
    {
        return md5($this->filePath);
    }

    /**
     * Serves a not found image
     *
     * @return string
     */
    protected function notFoundImage($width, $height)
    {
        // Default settings
        $settings = Settings::instance();

        // Have we got a custom not found image? If so, serve this.
        $imagePath = ($settings->not_found_image)
            ? base_path() . config('cms.storage.media.path') . $settings->not_found_image
            : plugins_path('toughdeveloper/imageresizer/assets/default-not-found.jpg');

        // Create a new Image object to resize
        $file = new Self($imagePath);

        // Return in the specified dimensions
        return $file->resize($width, $height, [
            'mode' => 'crop'
        ]);
    }
}
