
# Camera Overlay
This repo can be used to create automated time-lapses with a weather data overlay on third-party sites like Weather Underground or Windy.

While I am using it with a Nest camera, it can be used with any public image source. 

Here is an example of the latest output from my camera:

![Camera Example](https://pi.lordcol.in/roof-camera/images/roof.jpg)


## Background
I have a server set to run layer.php via cron every two minutes. It will pull the latest image from Nest and then overlay weather data before saving the image. From there, Windy and Weather Underground can fetch the image as frequently as they desire to create a time-lapse.

These are standalone PHP files that don't require anything like Composer. It's built intentionally very basic to easily run this on something like a Raspberry Pi or a shared hosting server where PHP is common.


## Requirements
- PHP 7 or greater
- PHP GD 2 or greater
- Access to the Dark Sky API


## Installation
You should be able to drop this repo into any server with PHP to get things up and running quickly. Your camera URL and API keys will go into `.env.php`, which will need to be created in the root folder. If you are planning to upload camera images via FTP, these will need to go into this file as well.

```php
  $_ENV['FTP_USER_NAME'] = '';
  $_ENV['FTP_USER_PASS'] = '';
  $_ENV['API_KEY'] = '';
  $_ENV['NEST_CAMERA'] = '';
```
While not a traditional .env file, I'm using this because I wanted to keep dependencies to a minimum.

Once you have your camera and weather data set up, you should be able to run `layer.php` to create an image and `uploader.php` to send that file off to a site like Weather Underground via FTP.

You'll then want to set a CronJob to run on your server to refresh the image. Dark Sky's API allows for 1000 calls per day which means you can run `layer.php` every two minutes.

## Customizing The Overlay
The PSD I used to create the overlay is in the repo. Most people probably won't want my site and Twitter handle in their overlays.

## Future Improvements I Need To Make

- Dark Sky is retiring their API at the end of 2022. I will need to pull from a different source before then.