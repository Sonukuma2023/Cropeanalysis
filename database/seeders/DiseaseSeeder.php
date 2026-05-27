<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Disease;

class DiseaseSeeder extends Seeder
{
    public function run(): void
    {
        $diseases = [
            [
                'crop_name' => 'Tomato',
                'disease_name' => 'Late Blight',
                'symptoms' => 'Dark, water-soaked spots on leaves; white fuzzy growth on undersides.',
                'pesticide' => 'Chlorothalonil, Copper fungicides',
                'organic_solution' => 'Baking soda spray, Compost tea, Neem oil extract',
                'prevention' => 'Ensure good air circulation, avoid overhead watering, remove infected plants.'
            ],
            [
                'crop_name' => 'Wheat',
                'disease_name' => 'Leaf Rust',
                'symptoms' => 'Small, orange-brown pustules on leaf surfaces.',
                'pesticide' => 'Tebuconazole, Propiconazole',
                'organic_solution' => 'Sulfur dust, Neem oil extract, garlic extract spray',
                'prevention' => 'Use resistant varieties, apply fungicides early, manage crop residue.'
            ],
            [
                'crop_name' => 'Corn',
                'disease_name' => 'Northern Corn Leaf Blight',
                'symptoms' => 'Large, cigar-shaped grayish-green to tan lesions on leaves.',
                'pesticide' => 'Pyraclostrobin, Azoxystrobin',
                'organic_solution' => 'Compost tea foliar spray, Potassium bicarbonate, neem oil',
                'prevention' => 'Crop rotation, tillage to reduce residue, use resistant hybrids.'
            ],
            [
                'crop_name' => 'Potato',
                'disease_name' => 'Early Blight',
                'symptoms' => 'Dark lesions with concentric rings (bullseye pattern) on older leaves.',
                'pesticide' => 'Mancozeb, Chlorothalonil',
                'organic_solution' => 'Copper octanoate, Bacillus subtilis spray, organic compost mulch',
                'prevention' => 'Maintain proper fertility, avoid moisture stress, rotate crops.'
            ],
            [
                'crop_name' => 'Rice',
                'disease_name' => 'Rice Blast',
                'symptoms' => 'Diamond-shaped spots with gray or white centers and dark borders.',
                'pesticide' => 'Tricyclazole, Isoprothiolane',
                'organic_solution' => 'Seed treatment with Trichoderma, Silica application, spraying Pseudomonas fluorescens',
                'prevention' => 'Avoid excess nitrogen, maintain continuous flooding, use resistant varieties.'
            ]
        ];

        foreach ($diseases as $disease) {
            Disease::create($disease);
        }
    }
}
