# Little Explorers — reorganized source files

This is a **structural refactor** of the uploaded archive, not a redesign. Original archive remains unchanged.

## Where to edit

- `resources/css/app.css`: CSS import entry point. Keep the order of imports.
- `resources/css/base.css`: shared layout, navigation and home/animal styles.
- `resources/css/pages/`: games hub and animal navigation.
- `resources/css/games/`: one stylesheet for each game.
- `resources/js/app.js`: Vite entry point; imports all page/game modules.
- `resources/js/pages/`: JavaScript for Animals detail and Colors page.
- `resources/js/games/`: one JS file per game.
- `resources/views/`: Blade markup, with game data left in Blade where needed.

## Test locally before replacing your project

1. Make a backup of the current working project.
2. Extract this archive into a **separate folder**.
3. Copy your own `.env` from your working project to the test copy; do not upload it.
4. In the test folder run `composer install`, `npm install`, `npm run dev` and `php artisan serve --port=8001` (use an available port).
5. Test every page and game, including sound, shape drag/drop, Memory 3D and automatic levels.
6. Only after successful testing commit changes to `feature/game-improvements`.

## Notes

- The CSS rules were moved **without deduplicating or changing their order**, to reduce visual regressions. Some older unused styles remain and can be removed later after visual tests.
- The code matches the uploaded ZIP. The archive contains **two distinct Colors views**: `resources/views/colors/index.blade.php` has the two-stage review with audio, while `resources/views/games/colors/index.blade.php` contains an older five-round game. Both were preserved as provided; confirm which route you want to use before deleting either.
- Database file and all public assets are copied as supplied. Do not publish the ZIP publicly without checking for private data in `database/database.sqlite`.
