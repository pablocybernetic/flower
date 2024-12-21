<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Abouts;

class AboutsSeeder extends Seeder
{
    public function run()
    {
        Abouts::create([
            'title' => 'About Us',
            'subtitle' => 'Bringing Nature Closer to You',
            'description' => 'Welcome to our online plant haven! We are passionate about making greenery accessible to everyone...',
            'features' => [
                'Sustainable Products',
                'Fast Delivery',
                'Customer Care',
                'Expert Guidance'
            ],
            'image1' => 'https://www.bootdey.com/image/241x362/98FB98/000000',
            'image2' => 'https://www.bootdey.com/image/337x450/7CFC00/000000',
            'image3' => 'https://www.bootdey.com/image/600x401/66CDAA/000000',
        ]);
    }
}
