
# Camera Overlay
This repo adds a weather overlay to a camera image.

While I am using it with a Nest camera, it can be used with any jpg image available from a public URL.

Here is an example of the latest output from my camera:

![Camera Example](https://lordcol.in/roof-camera/camera.jpg)


## Background
I have a server set to run layer.php via cron every two minutes. It will pull the latest image from Nest. Then it will overlay weather data before saving the image. From there, any service can fetch the image as frequently as desired while limiting API calls.

These are standalone PHP files that don't require anything like Composer or many other dependancies. It's barebones so that you can run this on something like a Raspberry Pi or a shared hosting server where PHP is common.


## Requirements
- PHP 7 or greater
- PHP GD 2 or greater
- Access to the Weather Underground API


## Installation
You should be able to drop this repo into any server with PHP to get things up and running quickly.

Rename env-sample.php to .env.php and fill in the values for your camera's image source and your Weather Underground API.

If you plan to upload camera images via FTP with `uploader.php`, these will need to go into this file as well.

While not a traditional .env file, I'm using this because I wanted to keep dependencies to a minimum.


## Usage
Once you have your camera and weather data credentials set up, you can run `layer.php` to create an image. If you are using a site like Windy to share your camera, running `layer.php` is all you need to do. You just have to copy/paste the location of the URL for the image being generated.

Until October 2021, Weather Underground offered a webcam service. It has since been shut down. Before then, I used `uploader.php` to send the latest image to their server via FTP. While their service has been discontinued, `uploader.php` will allow you to send your camera image to any FTP service.


## Cron Job
Unless you only want to refresh your camera and weather data manually for some reason, you will probably want to set up a CronJob to automate these updates.


## Customizing The Overlay
The PSD I used to create the overlay is in the repo. (Most people probably won't want my site and Twitter handle in their overlays!)


## Troubleshooting
If the time on the image is incorrect, `time.php` can be used to troubleshoot the time on your server.


## Future Improvements I Need/Want To Make
- Add another overlay for when the camera is under a watch or warning.
- Rather than overwriting the image with each cron job and letting a third party service create an archive, what's the best way to do that here?
