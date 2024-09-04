<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Invoice::create([
            'user_id' => 2,
            'invoice_number' => 'INV-ABCDEF',
            'address' => 'Jl. Jalan Kemana',
            'postal_code' => '12345',
            'total_price' => 1000000,
        ]);
    }
}
