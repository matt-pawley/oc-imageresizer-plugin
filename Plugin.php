<?php namespace ToughDeveloper\ImageResizer;

use Backend;
use System\Classes\PluginBase;
use ToughDeveloper\ImageResizer\Classes\Image;

/**
 * ImageResizer Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Image Resizer',
            'description' => 'Provides Twig filter to resize images on the fly',
            'author'      => 'Tough Developer',
            'icon'        => 'icon-picture-o',
            'homepage'    => 'https://github.com/toughdeveloper/oc-imageresizer-plugin'
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'toughdeveloper.imageresizer.access_settings' => [
                'tab'   => 'Image Resizer',
                'label' => 'Manage Settings'
            ]
        ];
    }

    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'resize' => function($file_path, $width = false, $height = false, $options = []) {
                    $image = new Image($file_path);
                    return $image->resize($width, $height, $options);
                }
            ]
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Image Resizer Settings',
                'icon'        => 'icon-picture-o',
                'description' => 'Configure Image Resizer Settings',
                'class'       => 'ToughDeveloper\ImageResizer\Models\Settings',
                'order'       => 0,
                'permissions' => ['toughdeveloper.imageresizer.access_settings']
            ]
        ];
    }
}
