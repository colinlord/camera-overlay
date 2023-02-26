
# Camera Overlay
This repo adds a weather overlay to a camera image.

While I am using it with a Nest camera, it can be used with any jpg image available from a public URL.

Here is an example of the output from my camera using this repo:

![Camera Example](https://lordcol.in/roof-camera/camera.jpg)


## Background
I have a server set to run layer.php via cron every minute. It will pull the latest image from Nest. Then it will overlay weather data before saving the image. From there, any service can fetch the image as frequently as desired while limiting API calls to the original call that creates the image.

These are standalone PHP files that don't require anything like Composer or many other dependancies. It's barebones so that you can run this on something like a Raspberry Pi or a shared hosting server where PHP is common.


## Requirements
- PHP 7 or greater
- PHP GD 2 or greater
- Access to the Weather Underground API


## Installation
You should be able to drop this repo into any server with PHP to get things up and running quickly.

Rename `env-sample.php` to `.env.php` and fill in the values for your camera's image source and your Weather Underground API.

If you plan to upload camera images via FTP with `uploader.php`, these will need to go into this file as well.

While not a traditional .env file, I'm using this because I wanted to keep dependencies to a minimum.


## Cron Job
Once you have your camera and weather data credentials set up, you can run `layer.php` to create an image. It will save the image to the same directory as the script.

Unless you only want to refresh your camera and weather data manually for some reason, you will probably want to set up a Cron Job to automate `layer.php` to run regularly. This is highly dependent on your server, but here is an example of what I use to refresh the image every minute:

`*/1 * * * * /usr/bin/php /var/www/html/layer.php`


## Usage
The simplest way to see the image is on your own server. The included `index.html` file is an example that displays the image on a web page.

A third-party service where you can share your webcam for free is Windy. Here's a link to my [my camera](https://www.windy.com/-Webcams/United-States/Tennessee/Spring-Hill/Thompson's-Station/webcams/1605233407?35.778,-88.531,8).

Another way to use this repo is to hook it into Twitter's API directly or through a service like IFTTT. I have an automated Twitter account that tweets the latest image at the top of each hour. You can follow it here: [@ThompsonsStnCam](https://twitter.com/thompsonsstncam/status/1629919088905519108?s=61&t=pX9iRPLafqP19eE88ko_Pg)

Until October 2021, Weather Underground offered a webcam service. It has since been shut down. Before then, I used `uploader.php` to send the latest image to their server via FTP. While their service has been discontinued, `uploader.php` will allow you to send your camera image to any FTP service.

If you end up using this repo to serve a camera with weather data somewhere, I'd love to see how and where you use it. Please reach out and let me know! My contact info is in my GitHub profile or on [my website](https://colinlord.com/).


## Customizing The Overlay
The PSD I used to create the overlay is in the repo. (Most people probably won't want my site and Twitter handle in their overlays!)


## Troubleshooting
If the time on the image is incorrect, `time.php` can be used to troubleshoot the time on your server.


## Future Improvements I Need/Want To Make
- Add another overlay for when the camera is under a watch or warning. The National Weather Service has an API for this, but I haven't had time to implement it yet.
- Rather than overwriting the image with each cron job and letting a third party service create an archive, what's the best way to do that here? It would require a good bit of storage space, but it would be nice to have a history of images.
