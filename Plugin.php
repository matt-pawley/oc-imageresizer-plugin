<?php namespace ToughDeveloper\ImageResizer;

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
            'name'        => 'toughdeveloper.imageresizer::lang.plugin.name',
            'description' => 'toughdeveloper.imageresizer::lang.plugin.description',
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
                'tab'   => 'toughdeveloper.imageresizer::lang.permission.tab',
                'label' => 'toughdeveloper.imageresizer::lang.permission.label'
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
                'label'       => 'toughdeveloper.imageresizer::lang.settings.label',
                'icon'        => 'icon-picture-o',
                'description' => 'toughdeveloper.imageresizer::lang.settings.description',
                'class'       => 'ToughDeveloper\ImageResizer\Models\Settings',
                'order'       => 0,
                'permissions' => ['toughdeveloper.imageresizer.access_settings']
            ]
        ];
    }
}
