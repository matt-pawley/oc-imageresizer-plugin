<?php namespace ToughDeveloper\ImageResizer\Classes;

use ToughDeveloper\ImageResizer\Models\Settings;
use October\Rain\Database\Attach\File;
use Tinify\Tinify;
use Tinify\Source;

class Image
{
    use RemoteImageTrait;

    /**
     * Original path of image
     */
    protected $originalFilePath;

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
     * Options Array
     */
    protected $options;

    /**
     * Thumb filename
     */
    protected $thumbFilename;

    public function __construct($filePath = false)
    {
        $this->originalFilePath = $filePath;

        // Settings are needed often, so offset to variable
        $this->settings = Settings::instance();

        // Create a new file object
        $this->file = new File;

        if ($filePath instanceof File) {
            $this->filePath = $filePath->getLocalPath();
            $this->file->file_name = $filePath;
            return;
        }

        // If file path is a remote image, download and use as local file
        if ($this->isRemoteFile($filePath)) {
            $filePath = $this->getRemoteFile($filePath);
        }

        $this->file->file_name = $filePath;

        $this->filePath = (file_exists($filePath))
            ? $filePath
            : $this->parseFileName($filePath);
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
        $this->options = $this->parseDefaultSettings($options);

        // Not a file? Display the not found image
        if (!is_file($this->filePath)) {
            return $this->notFoundImage($width, $height);
        }
    
        // Not a supported extension? Return the image
        if (!$this->hasSupportedExtension()) {
            return $this;
        }

        // If extension is auto, set the actual extension
        if (strtolower($this->options['extension']) == 'auto') {
           $this->options['extension'] = $this->file->getExtension();
        }

        // Set a disk name, this enables caching
        $this->file->disk_name = $this->cacheKey();

        // Set the thumbfilename to save passing variables to many functions
        $this->thumbFilename = $this->getThumbFilename($width, $height);

        // If the image is cached, don't try resized it.
        if (! $this->isImageCached()) {
            // Set the file to be created from another file
            $this->file->fromFile($this->filePath);

            // Resize it
            $thumb = $this->file->getThumb($width, $height, $this->options);

            // Not a gif file? Compress with tinyPNG
            if ($this->isCompressionEnabled()) {
                $this->compressWithTinyPng();
            }

            // Touch the cached image with the original mtime to align them
            touch($this->getCachedImagePath(), filemtime($this->filePath));
            
            $this->deleteTempFile();
        }

        // Return the URL
        return $this;
    }

    /**
     * Gets the path for the thumbnail
     * @return string
     */
    public function getCachedImagePath($public = false)
    {
        // Not a support file extension? Just return the original image
        if (!$this->hasSupportedExtension()) {
            return ($public === true)
                ? url(str_replace(base_path() . '/', '', $this->filePath))
                : $this->filePath;
        }

        $filePath = $this->file->getStorageDirectory() . $this->getPartitionDirectory() . $this->thumbFilename;

        if ($public === true) {
            return url('/storage/app/' . $filePath);
        }

        return storage_path('app/' . $filePath);
    }

    protected function deleteTempFile()
    {
        $path = storage_path('app/' . $this->file->getStorageDirectory() . $this->getPartitionDirectory() . $this->file->disk_name);
        if (file_exists($path)) {
            unlink($path);
        }
    }

    /**
     * Parse the file name to get a relative path for the file
     * This is mostly required for scenarios where a twig filter, e.g. theme has been applied.
     * @return string
     */
    protected function parseFileName($filePath)
    {
        $path = urldecode(parse_url($filePath, PHP_URL_PATH));

        // Create array of commonly used folders
        // These will be used to try capture the actual file path to an image without the sub-directory path
        $folders = [
            config('cms.themesPath'),
            config('cms.pluginsPath'),
            config('cms.storage.uploads.path'),
            config('cms.storage.media.path')
        ];

        foreach($folders as $folder)
        {
            if (str_contains($path, $folder))
            {
                $paths = explode($folder, $path, 2);
                return base_path($folder . end($paths));
            }
        }

        return base_path($path);
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
        if (!isset($options['compress'])) {
            $options['compress'] = true;
        }

        return $options;
    }

    /**
     * Creates a unique disk name for an image
     * @return string
     */
    protected function cacheKey()
    {
        $diskName = $this->originalFilePath;

        // Ensures a unique filepath when tinypng compression is enabled
        if ($this->isCompressionEnabled()) {
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
        if ($this->settings->not_found_image) {
            $imagePath = base_path() . config('cms.storage.media.path') . $this->settings->not_found_image;
        }

        // If we do not have an existing custom not found image, use the default from this plugin
        if (!isset($imagePath) || !file_exists($imagePath)) {
            $imagePath = plugins_path('toughdeveloper/imageresizer/assets/default-not-found.jpg');
        }

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
     * Checks if the requested resize/compressed image is already cached.
     * Removes the cached image if the original image has a different mtime.
     *
     * @return bool
     */
    protected function isImageCached()
    {
        // if there is no cached image return false
        if (!is_file($cached_img = $this->getCachedImagePath())) {
            return false;
        }

        // if cached image mtime match, the image is already cached
        if (filemtime($this->filePath) === filemtime($cached_img)) {
            return true;
        }

        // delete older cached file
        unlink($cached_img);

        // generate new cache file
        return false;
    }

    /**
     * Checks if image compression is enabled for this image.
     * @return bool
     */
    protected function isCompressionEnabled()
    {
        return ($this->options['extension'] != 'gif' && $this->settings->enable_tinypng && $this->options['compress']);
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
        return implode('/', array_slice(str_split($this->cacheKey(), 3), 0, 3)) . '/';
    }

    /**
     * Generates a thumbnail filename.
     * @return string
     */
    protected function getThumbFilename($width, $height)
    {
        $width = (integer) $width;
        $height = (integer) $height;

        return 'thumb__' . $width . '_' . $height . '_' . $this->options['offset'][0] . '_' . $this->options['offset'][1] . '_' . $this->options['mode'] . '.' . $this->options['extension'];
    }

    /**
     * Checks if it is a resizable file extension
     * @return boolean
     */
    protected function hasSupportedExtension()
    {
        return in_array($this->file->getExtension(), File::$imageExtensions);
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
