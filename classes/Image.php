<?php namespace ToughDeveloper\ImageResizer\Classes;

use ToughDeveloper\ImageResizer\Models\Settings;
use October\Rain\Database\Attach\File;
use Tinify\Tinify;
use Tinify\Source;
use Storage;
use Cms\Classes\MediaLibrary;

class Image
{
    /**
     * File path of image
     */
    protected $filePath;

    /**
     * Image Resizer Settings
     */
    protected $settings;

    /**
     * File Object
     */
    protected $file;

    /**
     * Thumb filename 
     */
    protected $thumbFilename;

    public function __construct($filePath = false)
    {
        // Settings are needed often, so offset to variable
        $this->settings = Settings::instance();

        // Create a new file object
        $this->file = new File;

        $this->filePath = $filePath;

        if ($filePath instanceof File) {
            $this->filePath = base_path() . $filePath->getPath();
            return;
        }

        if ($this->isLocalStorage())
        {
            $this->filePath = (file_exists($filePath))
                ? $filePath
                : base_path() . DIRECTORY_SEPARATOR . $this->parseFileName($filePath);
        }

    }

    /**
     * Resizes an Image
     *
     * @param integer $width The target width
     * @param integer $height The target height
     * @param array   $options The options
     *
     * @return string
     */
    public function resize($width = false, $height = false, $options = [])
    {
        // Parse the default settings
        $options = $this->parseDefaultSettings($options);

        // Not a file? Display the not found image
        if (!is_file($this->filePath)) {
            return $this->notFoundImage($width, $height);
        }

        // If extension is auto, set the actual extension
        if (strtolower($options['extension']) == 'auto') {
           $options['extension'] = pathinfo($this->filePath)['extension'];
        }

        // Set a disk name, this enables caching
        $this->file->disk_name = $this->diskName();

        // Set the thumbfilename to save passing variables to many functions
        $this->thumbFilename = $this->getThumbFilename($width, $height, $options);

        // If the image is cached, don't try resized it.
        if (! $this->isImageCached()) {
            // Set the file to be created from another file
            $this->file->fromFile($this->filePath);

            // Resize it
            $thumb = $this->file->getThumb($width, $height, $options);

            // Not a gif file? Compress with tinyPNG
            if ($options['extension'] != 'gif' && $this->settings->enable_tinypng)
            {
                $this->compressWithTinyPng();
            }
        }

        // Return the URL
        return $this;
    }

    public function getPublicPath($public = false)
    {
        $this->file->getPublicPath();
    }

    /**
     * Compresses a png image using tinyPNG
     * @return string
     */
    public function getCachedImagePath($public = false)
    {
        $filePath = $this->getPartitionDirectory() . $this->thumbFilename;

        if ($public === true) {
            $asMediaPath = MediaLibrary::url($filePath);    
            return str_replace('media', config('cms.storage.uploads.folder') . '/public', $asMediaPath);
        }

        return storage_path('app/' . $this->file->getStorageDirectory() . $filePath);
    }

    /**
     * Parse the file name to get a relative path for the file
     * This is mostly required for scenarios where a twig filter, e.g. theme has been applied.
     * @return string
     */
    protected function parseFileName($filePath)
    {
        return parse_url($filePath, PHP_URL_PATH);
    }

    /**
     * Works out the default settings
     * @return string
     */
    protected function parseDefaultSettings($options = [])
    {
        if (!isset($options['mode']) && $this->settings->default_mode) {
            $options['mode'] = $this->settings->default_mode;
        }
        if (!isset($options['offset']) && is_int($this->settings->default_offset_x) && is_int($this->settings->default_offset_y)) {
            $options['offset'] = [$this->settings->default_offset_x, $this->settings->default_offset_y];
        }
        if (!isset($options['extension']) && $this->settings->default_extension) {
            $options['extension'] = $this->settings->default_extension;
        }
        if (!isset($options['quality']) && is_int($this->settings->default_quality)) {
            $options['quality'] = $this->settings->default_quality;
        }
        if (!isset($options['sharpen']) && is_int($this->settings->default_sharpen)) {
            $options['sharpen'] = $this->settings->default_sharpen;
        }

        return $options;
    }

    /**
     * Creates a unique disk name for an image
     * @return string
     */
    protected function diskName()
    {
        $diskName = $this->filePath;
        
        // Ensures a unique filepath when tinypng compression is enabled
        if ($this->settings->enable_tinypng) {
            $diskName .= 'tinypng';
        }

        return md5($diskName);
    }

    /**
     * Serves a not found image
     * @return string
     */
    protected function notFoundImage($width, $height)
    {
        // Have we got a custom not found image? If so, serve this.
        $imagePath = ($this->settings->not_found_image)
            ? base_path() . config('cms.storage.media.path') . $this->settings->not_found_image
            : plugins_path('toughdeveloper/imageresizer/assets/default-not-found.jpg');

        // Create a new Image object to resize
        $file = new Self($imagePath);

        // Return in the specified dimensions
        return $file->resize($width, $height, [
            'mode' => 'crop'
        ]);
    }

    /**
     * Compresses a png image using tinyPNG
     * @return string
     */
    protected function compressWithTinyPng()
    {
        try {
            Tinify::setKey($this->settings->tinypng_developer_key);

            $filePath = $this->getCachedImagePath();
            $source = Source::fromFile($filePath);
            $source->toFile($filePath);
        }
        catch (\Exception $e) {
            // Log error - may help debug
            \Log::error('Tiny PNG compress failed', [
                'message'   => $e->getMessage(),
                'code'      => $e->getCode()
            ]);
        }

    }

    /**
     * Checks if the requested resize/compressed image is already cached
     * @return bool
     */
    protected function isImageCached()
    {
        return false;
        return is_file($this->getCachedImagePath());
    }

    /**
    * Generates a partition for the file.
    * return /ABC/DE1/234 for an name of ABCDE1234.
    * @param Attachment $attachment
    * @param string $styleName
    * @return mixed
    */
    protected function getPartitionDirectory()
    {
        return implode('/', array_slice(str_split($this->diskName(), 3), 0, 3)) . '/';
    }

    /**
     * Generates a thumbnail filename.
     * @return string
     */
    protected function getThumbFilename($width, $height, $options)
    {
        $width = (integer) $width;
        $height = (integer) $height;
        
        return 'thumb__' . $width . 'x' . $height . '_' . $options['offset'][0] . '_' . $options['offset'][1] . '_' . $options['mode'] . '.' . $options['extension'];
    }

    /**
     * Returns true if the storage engine is local.
     * @return bool
     */
    protected function isLocalStorage()
    {
        return Storage::getDefaultDriver() == 'local';
    }

    /**
     * Render an image tag
     * @return string
     */
    public function render()
    {
        return '<img src="' . $this . '" />';
    }

    /**
     * Magic method to return the file path
     * @return string
     */
    public function __toString()
    {
        return $this->getCachedImagePath(true);
    }
}
