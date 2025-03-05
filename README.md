# Mixtape Maker

## Project Overview
Mixtape Maker is a web-based application that allows users to create custom mixtapes from YouTube video URLs.
Users can compile a list of their favorite songs, generate a unique link for their mixtape, and share it with others.
The project is built using HTML, CSS, JavaScript, PHP, and MySQL.

## Why I Built This Project
I built Mixtape Maker to provide an easy and convenient way for users to create and share personalized music playlists. 
Many people love curating their own music selections, but existing platforms often have restrictions on sharing and customization.
This project allows anyone to compile YouTube videos into a mixtape and share it with friends using a simple, shareable link. 
It was also an opportunity for me to improve my skills in full-stack web development using PHP and MySQL while ensuring a smooth and user-friendly experience.

## Features
- Users can add YouTube video URLs to create a mixtape.
- A simple and responsive UI for easy mixtape creation.
- Users receive a unique link to share their mixtape.
- Mixtapes are stored in a database for future access.
- Generated mixtape links provide a seamless playback experience.

## Technologies Used
- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Additional**: YouTube Embed API

## Installation & Setup
### Prerequisites
- A web server with PHP (e.g., XAMPP, WAMP, or a live hosting server).
- MySQL database set up.

### Steps to Install
1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/mixtape-maker.git
   ```
2. Move the project to your web server directory (e.g., `htdocs` for XAMPP).
3. Import the `database.sql` file into your MySQL database.
4. Update the `config.php` file with your database credentials:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', 'yourpassword');
   define('DB_NAME', 'mixtape_db');
   ```
5. Start your local server and access the project via `http://localhost/mixtape-maker/`.

## Usage
1. Enter YouTube video URLs to create a mixtape.
2. Click "Generate Mixtape" to create a shareable link.
3. Copy the link and share it with friends.
4. Open the link to listen to the playlist.

## Build Process
This project was built from scratch using the following technologies:
- **Frontend**: Raw HTML, CSS for styling, and JavaScript for client-side interactions.
- **Backend**: PHP for server-side logic, handling form submissions, and database management.
- **Database**: MySQL for storing mixtape data, including video URLs and generated links.
- **No frameworks were used**, ensuring a lightweight and efficient build.

## Future Enhancements
- User authentication to save mixtapes for registered users.
- Drag-and-drop functionality for playlist sorting.
- Additional themes and customization options.

## License
This project is open-source. Feel free to modify and improve it as needed.

## Author
Created by **Estifanos.A** - Contact: estifanosamsalu833@gmail.com

