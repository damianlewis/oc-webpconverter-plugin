<?php

namespace DamianLewis\WebpConverter;

use Storage;
use System\Classes\PluginBase;
use System\Models\File;

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

    public function boot(): void
    {
        File::extend(function (File $model) {
            $model->bindEvent('model.afterDelete', function () use ($model) {
                if ($model->isImage()) {
                    $this->deleteWebpFile($model);
                }
            });
        });
    }

    protected function deleteWebpFile(File $model): void
    {
        $filePath = $model->getDiskPath($model->disk_name) . '.webp';

        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
    }
}
