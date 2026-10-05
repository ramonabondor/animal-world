<?php

namespace Database\Seeders;

use App\Models\Animal;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    public function run(): void
{
    Animal::query()->delete();

    Animal::create([
        'name' => 'Dog',
        'emoji' => '🐶',
        'color' => 'Brown',
        'description' => 'Hi! I am a dog! Woof woof! I am friendly, playful, and I love to run and play!',
        'image' => 'dog.jpg',
        'sound' => 'dog.mp3',
    ]);

    Animal::create([
        'name' => 'Cat',
        'emoji' => '🐱',
        'color' => 'Orange',
        'description' => 'Hi! I am a cat! Meow meow! I am soft and cuddly, and I love to play!',
        'image' => 'cat.jpg',
        'sound' => 'cat.mp3',
    ]);

    Animal::create([
        'name' => 'Lion',
        'emoji' => '🦁',
        'color' => 'Yellow',
        'description' => 'Hi! I am a lion! Roar! I am big and strong, and I have a beautiful mane!',
        'image' => 'lion.jpg',
        'sound' => 'lion.mp3',
    ]);

    Animal::create([
        'name' => 'Frog',
        'emoji' => '🐸',
        'color' => 'Green',
        'description' => 'Hi! I am a frog! Ribbit ribbit! I am green, and I love to jump and splash!',
        'image' => 'frog.jpg',
        'sound' => 'frog.mp3',
    ]);

    Animal::create([
        'name' => 'Elephant',
        'emoji' => '🐘',
        'color' => 'Grey',
        'description' => 'Hi! I am an elephant! I am big and gentle, and I have a very long trunk!',
        'image' => 'elephant.jpg',
        'sound' => 'elephant.mp3',
    ]);

    Animal::create([
        'name' => 'Fish',
        'emoji' => '🐠',
        'color' => 'Orange',
        'description' => 'Hi! I am a fish! I live in the water, and I love to swim, swim, swim!',
        'image' => 'fish.jpg',
        'sound' => 'fish.mp3',
    ]);

    Animal::create([
        'name' => 'Cow',
        'emoji' => '🐮',
        'color' => 'Black and White',
        'description' => 'Hi! I am a cow! Moo moo! I live on a farm, and I love to eat green grass!',
        'image' => 'cow.jpg',
        'sound' => 'cow.mp3',
    ]);

    Animal::create([
        'name' => 'Zebra',
        'emoji' => '🦓',
        'color' => 'Black and White',
        'description' => 'Hi! I am a zebra! Look at my beautiful black and white stripes! I love to run!',
        'image' => 'zebra.jpg',
        'sound' => 'zebra.mp3',
    ]);

    Animal::create([
        'name' => 'Fox',
        'emoji' => '🦊',
        'color' => 'Orange',
        'description' => 'Hi! I am a fox! I am fluffy and clever, and I have a beautiful orange tail!',
        'image' => 'fox.jpg',
        'sound' => 'fox.mp3',
    ]);

    Animal::create([
        'name' => 'Pig',
        'emoji' => '🐷',
        'color' => 'Pink',
        'description' => 'Hi! I am a pig! Oink oink! I am pink, friendly, and very smart!',
        'image' => 'pig.jpg',
        'sound' => 'pig.mp3',
    ]);

    Animal::create([
        'name' => 'Horse',
        'emoji' => '🐴',
        'color' => 'Brown',
        'description' => 'Hi! I am a horse! Neigh! I am strong, and I love to run really fast!',
        'image' => 'horse.jpg',
        'sound' => 'horse.mp3',
    ]);

    Animal::create([
        'name' => 'Monkey',
        'emoji' => '🐵',
        'color' => 'Brown',
        'description' => 'Hi! I am a monkey! I love to climb, jump, and play in the trees!',
        'image' => 'monkey.jpg',
        'sound' => 'monkey.mp3',
    ]);

    Animal::create([
        'name' => 'Sheep',
        'emoji' => '🐑',
        'color' => 'White',
        'description' => 'Hi! I am a sheep! Baa baa! I am fluffy and soft, and I have lots of wool!',
        'image' => 'sheep.jpg',
        'sound' => 'sheep.mp3',
    ]);

    Animal::create([
        'name' => 'Duck',
        'emoji' => '🦆',
        'color' => 'Green',
        'description' => 'Hi! I am a duck! Quack quack! I love to swim and splash in the water!',
        'image' => 'duck.jpg',
        'sound' => 'duck.mp3',
    ]);
}
}
