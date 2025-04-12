# Music Showcase
Music Showcase automatically updates and displays artists' new Spotify releases daily in an engaging format with links to stream directly. It also supports featuring playlists, all pulled from Spotify's API for seamless promotion.

## Installation
To run Music Showcase locally, follow these steps:
### Prerequisites
- **Docker:** Ensure Docker is installed and running on your machine.
- **Spotify API Credentials:** You will need to create a Spotify Developer account and obtain API credentials.
### Steps
1. **Clone the Repository**
2. **Set up Environment Variables** (Ensure ```SPOTIFY_CLIENT_ID``` and ```SPOTIFY_CLIENT_SECRET``` are populated)
3. **Install Composer Dependencies:** ```composer install```
4. **Start Docker Containers:** ```./vendor/bin/sail up```
5. **Generate Application Key:** ```./vendor/bin/sail artisan key:generate```
6. **Run Database Migration:** ```./vendor/bin/sail artisan migrate```
7. **Create Storage Symlink:** ```./vendor/bin/sail artisan storage:link```
8. **Install NPM Dependencies:** ```./vendor/bin/sail npm install```
9. **Build Frontend Assets:** ```./vendor/bin/sail npm run build```
10. **Access the Application:** Music Showcase should now be accessible at 127.0.0.1

## Usage Guide
### Configuration
1. Access the Filament admin panel to configure the application.
2. Enter a single Spotify Artist ID to track releases.
3. Add unlimited Playlist IDs to showcase curated collections.
4. Use the Refresh buttons to get fresh data from Spotify.

### How It Works
- Daily scheduled jobs fetch new releases and playlists from Spotify.
- Data is stored in the database to minimize API calls and improve performance.
- Content is displayed using Livewire components with infinite scrolling.
- The application automatically handles Spotify's pagination to ensure all content is collected.

### Tips
- For best results, ensure the Laravel queue worker is running.
- Schedule the artisan command to run the jobs daily.
- Use the immediate refresh button after changing Artist or Playlist IDs.
- For a technical breakdown of this project, please refer to this [Blog Post](https://sjwatts.com/projects/music-site)

## Development Status

Music Showcase is currently in active development and is not yet a finished project. Some aspects of the project may be in an incomplete state, therefore it is not recommended to use this project in production.

## Maintainers
- **Sam Watts** - [@sjwatts119](https://github.com/sjwatts119)
