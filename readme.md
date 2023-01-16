
# Camera Overlay
This repo can be used to create automated time-lapses with a weather data overlay on third-party sites like Windy.

While I am using it with a Nest camera, it can be used with any public image source.

Here is an example of the latest output from my camera:

![Camera Example](https://lordcol.in/roof-camera/camera.jpg)


## Background
I have a server set to run layer.php via cron every two minutes. It will pull the latest image from Nest and then overlay weather data before saving the image. From there, Windy and Weather Underground can fetch the image as frequently as they desire to create a time-lapse.

These are standalone PHP files that don't require anything like Composer. It's built intentionally very basic to easily run this on something like a Raspberry Pi or a shared hosting server where PHP is common.


## Requirements
- PHP 7 or greater
- PHP GD 2 or greater
- Access to the Dark Sky API


## Installation
You should be able to drop this repo into any server with PHP to get things up and running quickly. Your camera URL and API keys will go into `.env.php`, which will need to be created in the root folder. If you are planning to upload camera images via FTP with `uploader.php`, these will need to go into this file as well.

```php
  $_ENV['FTP_USER_NAME'] = '';
  $_ENV['FTP_USER_PASS'] = '';
  $_ENV['API_KEY'] = '';
  $_ENV['NEST_CAMERA'] = '';
```
While not a traditional .env file, I'm using this because I wanted to keep dependencies to a minimum.

## Usage
Once you have your camera and weather data credentials set up, you can run `layer.php` to create an image. If you are using a site like Windy to share your camera, running `layer.php` is all you need to do. You just have to copy/paste the location of the URL for the image being generated.

Until October 2021, Weather Underground offered a webcam service. It has since been shut down. Before then, I used `uploader.php` to send the latest image to their server via FTP. While their service has been discontinued, `uploader.php` will allow you to send your camera image to any FTP service.

## CronJob
Unless you only want to refresh your camera and weather data manually for some reason, you will probably want to set up a CronJob to automate these updates.

Dark Sky's API allows for 1000 calls per day which means you can run `layer.php` every two minutes.

## Customizing The Overlay
The PSD I used to create the overlay is in the repo. (Most people probably won't want my site and Twitter handle in their overlays!)

## Troubleshooting
I created a `weather.php` file that directly pings the Dark Sky API to verify that weather data is being pulled correctly independent of the overlay process.

If the time on the image is incorrect, `time.php` can be used to troubleshoot the time on your server.

## Future Improvements I Need/Want To Make
- Dark Sky is retiring their API at the end of 2022. I will need to pull from a different source before then.
- Add another overlay for when the camera is under a watch or warning.
- Will this work with the newest generation of Nest cameras now that Google seems to be migrating away from the original Nest platform?
- Rather than overwriting the image with each cron job and letting a third party service create an archive, what's the best way to do that here?
