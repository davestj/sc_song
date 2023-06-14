# SHOUTcast Song Status

This PHP script retrieves the current song and song history from a SHOUTcast streaming server and displays it on a web page. It was developed by dstjohn (Mediacast1/Casterclub) on May 3, 2002.

## Requirements

To use this script, you need the following:

1. SHOUTcast streaming server
2. Oddcast DSP with Winamp/XMMS (recommended setup)
3. Webserver with PHP 4.x (Recommended environment: Unix with Apache 3.x)

## Usage

1. Clone or download the script to your web server.

2. Edit the `config.php` file to set the appropriate values for your SHOUTcast server. Make sure to specify the correct path to the `config.php` file in the `include` statement in the script.

3. Open the web page that contains this script in a web browser to see the current song and song history retrieved from the SHOUTcast server.

## Important Notes

- This script was developed and tested on Windows XP with Apache and PHP 4.1.2. It has also been tested on FreeBSD with Apache and PHP 4.1.2 and works fine.

- It has not been tested on IIS web servers. If you try it on an IIS server and it works, please let us know in the [Casterclub forums](http://casterclub.com/forums).

## Support

No support is provided for this script. However, you can post in the Casterclub forums for any questions or discussions related to the script.

## License

This script is provided under the MIT License.

## Author

This script was developed by dstjohn (Mediacast1/Casterclub).

---

**Note:** The script provided is written in PHP and has a few deprecated functions and potentially insecure practices. It is advisable to update and modify the script as needed to ensure security and compatibility with the latest PHP versions.
