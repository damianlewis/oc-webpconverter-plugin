<?php

namespace DamianLewis\WebpConverter;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails(): array
    {
        return [
            'name' => 'WebP Converter',
            'description' => 'Converts JPEG and PNG images in the storage folder to WebP images.',
            'author' => 'Damian Lewis',
            'icon' => 'icon-file-image-o'
        ];
    }
}
