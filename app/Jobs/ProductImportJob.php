<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Events\SucceessNotification;

class ProductImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filerows;

    public function __construct($filerows)
    {
        $this->filerows = $filerows;
    }


    public function handle()
    {
        $img = "products/default_image.png";
        
        $chunk = [];
$count = 0;
        foreach($this->filerows as $row)
        {
         if($count != 0){
            [$name, $description, $price, $image, $category, $stock] = $row;

            $chunk[] =[
                'name' => $name,
                'description' => $description,
                'price' => (float)$price,
                'category' => $category,
                'stock' => (int)$stock,
                'image' => !empty($image) ? $image : $img,
                'created_at' => now(),
                'updated_at' => now()
            ];

            if(count($chunk) >= 500){
                DB::table('products')->insert($chunk);
                $chunk = [];
            }

            
         }
          $count++;  
        }

        if(!empty($chunk)){
        DB::table('products')->insert($chunk);
        }

        event(new SucceessNotification("Products imported successfully!"));

    }
}
