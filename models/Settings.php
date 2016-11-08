<?php namespace ToughDeveloper\ImageResizer\Models;

use Model;

/**
 * Settings Model
 */
class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'toughdeveloper_imageresizer_settings';

    public $settingsFields = 'fields.yaml';
}