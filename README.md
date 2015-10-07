# Pinger script from https://thehawken.org/fs

## Setup
This system runs with some files in a web directory and some files outside of the web directory. You will find web/config.php.inc which has to be configured and renamed to config.php. After this, you will find offline/getservers.php and offline/fs. Both have to be configured to reflect what you decided in config.php. Afterwards, the fs script has to be added to your crontab:
```
*/5 *     * * * www-data    bash /offline/path/fs
```
This will make it run every 5 minutes.
If it doesn't work, I'm 90% sure you can blame file permissions. Make sure the user used by your webserver matches crontab, and make sure example.status is writable and accessible.

### Dependencies
* php5-cli
* web server with php
* fping
* bash


## Files

### fs
Script that is run at some interval from crontab. Fetches list of servers using getservers.php pings them with fping.
### functions.php
Functions used from index.php: gradient, parse and read the ping result file
### getservers.php
Creates a list of servers to ping, suitable for bash scripting. Limited to local invocation, but not foolproof.
### config.php
$config and $tags array that contains the configuration, and server list
### index.php
Main page, depends on tags.php and functions.php
### css/style.css
Stylesheet used to create the fancy design
