<?php namespace ToughDeveloper\ImageResizer;

use System\Classes\PluginBase;
use ToughDeveloper\ImageResizer\Classes\Image;
use Validator;

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

    public function boot(){
        Validator::extend('valid_tinypng_key', function($attribute, $value, $parameters) {
            try {
                \Tinify\setKey($value);
                \Tinify\validate();
            } catch(\Tinify\Exception $e) {
                return false;
            }

            return true;
        });
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

    public function registerListColumnTypes()
    {
        return [
            'thumb' => [$this, 'evalThumbListColumn'],
        ];
    }

    public function evalThumbListColumn($value, $column, $record)
    {
        $config = $column->config;

        // Get config options with defaults
        $width = isset($config['width']) ? $config['width'] : 50;
        $height = isset($config['height']) ? $config['height'] : 50;
        $options = isset($config['options']) ? $config['options'] : [];

        // attachMany relation?
        if (isset($record['attachMany'][$column->columnName]))
        {
            $file = $value->first();
        }
        // attachOne relation?
        else if (isset($record['attachOne'][$column->columnName]))
        {
            $file = $value;
        }
        // Mediafinder
        else
        {
            $file = storage_path() . '/app/media' . $value;
        }

        $image = new Image($file);
        return $image->resize($width, $height, $options)->render();
    }
}
