# LaserLite
LaserLite is an open source version of the [markustegelane](https://markustegelane.ml) website
and also a codename for the actual website.

![Website screenshot should appear here](https://user-images.githubusercontent.com/45605071/157051273-8acb6d30-0279-4f32-bd98-6cbd7064af6e.png)

## What are the differences between LaserLite and the actual website?
* connect.php file at the root directory, in particular all of the actual passwords have been replaced with placeholders
* Blue Screen Simulator Plus online documentation and downloads are missing from this repository
* All of the downloads stored directly on the website are missing from this repository
* MySQL database is populated with actual tables used on the website, but the records themselves are missing or populated with default values

## How to setup?
To setup the website on your local network, install either LAMP, WAMP or MAMP stack, depending
on your operating system (which includes Apache2, MySQL, and PHP7.x). Then you need to add all
of the files and folders onto the webserver root directory (aka the www directory). Next, setup
MySQL with a password and username you want to use. Make sure you use a password you are
confortable storing in plain text.<br/><br/>
**IMPORTANT**: Modify the connect.php file with the username, database name and password that
match your MySQL configuration.

## File structure explained
* /.htaccess - Hidden file, redirects to special pages when certain errors occour (such as 404, 403, etc.)
* /connect.php - This file connects to the MySQL database. If a connection fails, a message is displayed
* /favicon.ico - The main favicon used by the website
* /index.php - The startup page of the website. Redirects to an appropriate page, depending on the situation.
* /maintenance.php - By default, does nothing. But if you want to mark your website as "Under maintenance", you can modify one variable here and display an "Under maintenance" screen for your visitors. You need to add/modify a cookie "cookie_ok", with value "dev" to visit the website yourself.
* /mobcheck.php - Checks if your're using a mobile device. If yes, displays a different layout.
* /mprogress.php - This file contains maintenance progress details
* /random.html - Legacy page for old links. Redirects to a random "markustegelane" video.
* /README.md - This file
* /tables.sql - Import this file into MySQL to create tables for a database you want to use
* /channel_db/ - Files for the channel database
* /*/connect.php - Gets redirected to the connect.php file in the root folder
* /channel_db/bg.png - Background image for the original alpha version of the channel database
* /channel_db/add - Page for adding a record to the channel database
* /channel_db/delete - Page for removing a recording from the channel database
* /channel_db/gallery - Page(s) for the channel gallery
* /channel_db/ideas - Page(s) for the channel idea box
* /channel_db/login - Manager login page (not used in current version)
* /channel_db/replace - Page for updating a recording in the channel database
* /channel_db/report - Page for generating a report
* /channel_db/thumbs - Thumbnails for videos
* /channel_db/gallery/logos - Channel logos for channel gallery. Each subfolder corresponds to a channel ID in the database and each image in each folder is numbered starting from one.
* /constructor - Page that is displayed for visitors when the site is under maintenance
* /dev - Page for the #markusTegelane channel
* /favicons - Other favicons for some subpages
* /markustegelane - Page that you first land on when visiting the website
* /markustegelane/common - Files in this directory are shared between multiple languages
* /markustegelane/common/config - Settings menu
* /markustegelane/common/lucky - Random page selector
* /markustegelane/common/themes - CSS stylesheets for the website
* /markustegelane/content/et-EE - Estonian pages of the website
* /markustegelane/content/en-US - English pages of the website
* /markustegelane/content/*/navbar.php - Navigation bar (language specific)
* /markustegelane/content/*/* - These are different pages on the website (language specific, can be modifying using the website itself). Commonly these are accessed from the navigation bar and can also be chosen by random page selector tool.
* /markustegelane/errors - Pages that you land on when you get a client side error (such as a 404 error)
* /markustegelane/gfx - Graphics used by the website (banner, background)
* /markustegelane/images - Other image files used by the website
* /markustegelane/images/dloads - Preview images for the downloads
* /markustegelane/images/kat - Category graphics for downloads
* /markustegelane/images/shootme - Assets for crazygame (shootme was the original codename for the game)
* /markustegelane/random - Random video selector
* /mas_db - Markus' stuff page
* /mas_db/images - Images for the Markus' stuff page (including wallpapers)
* /mas_db/toq - Table of contents of the Markus' stuff page
* /mas_db/faq - Frequently asked questions on the Markus' stuff page
* /mas_db/wallpapers - Page for managing wallpapers
* /mas_db/add - Page for adding an entry to the Markus' stuff page
* /mas_db/remove - Page for remoing and entry from the Markus' stuff page
* /plus - Old page for markustegelane+
* /x - Page for the markustegelane x channel
