# 🐾 Little Explorers

**Little Explorers** is a colorful and interactive educational web application designed for young children to learn about animals in a simple and playful way.

The project was built with **Laravel**, **PHP**, **Blade**, **JavaScript**, and **CSS**.

## 🌟 About the Project

Little Explorers introduces children to different animals through colorful illustrations, simple descriptions, animal sounds, and friendly character voices.

Children can explore the animals individually and use the Previous and Next buttons to move through the collection.

When an animal page opens, a friendly pre-recorded voice automatically introduces the animal, making the experience more engaging for young children.

## 🐶 Animals

The application currently includes 14 animals:

- 🐶 Dog
- 🐱 Cat
- 🦁 Lion
- 🐸 Frog
- 🐘 Elephant
- 🐠 Fish
- 🐮 Cow
- 🦓 Zebra
- 🦊 Fox
- 🐷 Pig
- 🐴 Horse
- 🐵 Monkey
- 🐑 Sheep
- 🦆 Duck

Each animal has:

- A colorful illustration
- A name
- A simple child-friendly description
- A color
- A friendly character voice
- A real animal sound used in the game

## 🎨 Colors

The application also contains a Colors section designed to help young children recognize and learn basic colors.

## 🎮 Animal Game

Little Explorers includes an interactive animal game.

Children are asked to identify the correct animal and can listen to its real sound for an additional clue.

The game includes:

- Random animal questions
- Animal images
- Real animal sounds
- Correct and incorrect answer feedback
- A score system
- Multiple rounds
- A Play Again option

The game is designed to make learning feel playful and rewarding.

## 🔊 Audio

The project uses two different types of audio:

### Character Voices

Friendly pre-recorded voices introduce each animal on its individual page.

These files are stored in:

```text
public/assets/voices/
```

### Animal Sounds

Real animal sounds are used as part of the interactive game.

These files are stored in:

```text
public/assets/sounds/
```

## 🛠️ Technologies Used

- Laravel
- PHP
- Blade
- JavaScript
- HTML5
- CSS3
- SQLite
- Vite
- XAMPP
- Git / GitHub

## 📂 Main Project Structure

```text
animal-world/
├── app/
│   ├── Http/Controllers/
│   └── Models/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   └── assets/
│       ├── images/
│       ├── sounds/
│       └── voices/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
└── README.md
```

## 🚀 Running the Project Locally

Clone the repository and enter the project directory:

```bash
git clone <repository-url>
cd animal-world
```

Install the PHP dependencies:

```bash
composer install
```

Install the frontend dependencies:

```bash
npm install
```

Create the environment file:

```bash
cp .env.example .env
```

On Windows, you can also copy `.env.example` manually and rename the copy to `.env`.

Generate the Laravel application key:

```bash
php artisan key:generate
```

Create and seed the database:

```bash
php artisan migrate --seed
```

Build the frontend assets:

```bash
npm run build
```

Start the Laravel development server:

```bash
php artisan serve
```

Then open the address displayed by Laravel in your browser.

## 🎯 Project Goal

The goal of Little Explorers is to create a simple, friendly, and interactive learning environment where young children can discover animals through images, colors, sounds, repetition, and play.

## 🌱 Future Improvements

Planned improvements include:

- Displaying a smaller random selection of animals in each game round
- Additional educational games
- More animals
- Improved animations and visual feedback
- Additional learning categories
- Mobile and tablet usability improvements

## 📌 Project Status

**Little Explorers is currently under development.**

More features and improvements will be added as the project grows.
