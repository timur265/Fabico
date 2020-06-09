<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Product;

class ResizeImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:resize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resize image';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line('Starting resize product images...');
        $publicPath = public_path() . '/';
        $resizedImagesPath = $publicPath . 'uploads/product/catalog';
        $this->line("Resized images path: $resizedImagesPath");
        \File::makeDirectory($resizedImagesPath, $mode = 0777, true, true);
        $products = Product::all();
        foreach ($products as $product) {
            $this->line("Prociess $product->title preview image...");
            $previewImagePath = $publicPath . $product->getImage();
            $previeImageFilename = $product->preview_image;
            \Image::make($previewImagePath)->widen(1200)->save($previewImagePath);
            \Image::make($previewImagePath)->widen(300)->save($resizedImagesPath . "/$previeImageFilename");
            $product->preview_image_catalog = $previeImageFilename;
            $product->save();
            $this->info('Done!');
            $this->line("Process colors images for $product->title...");
            foreach ($product->colors as $color) {
                foreach ($color->images as $image) {
                    $imagePath = $publicPath . $image->getImage();
                    $imageFilename = $image->img;
                    \Image::make($imagePath)->widen(1200)->save($imagePath);
                    \Image::make($imagePath)->widen(300)->save($resizedImagesPath . "/$imageFilename");
                    $image->img_catalog = $imageFilename;
                    $image->save();
                }
            }
            $this->info('Done!');
        }
    }
}
