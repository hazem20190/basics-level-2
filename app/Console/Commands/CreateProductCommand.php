<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class CreateProductCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:product {name} {--price=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Anew Product Command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $price = $this->option('price');
        $product = Product::updateOrCreate(
            [
                ['name' => $name],
                ['price' => $price ?: rand(500, 1000)]
            ]
        );
        if ($product) {
            $this->info('the product create successfully');
        } else {
            $this->error('the product not created');
        }
    }
}
