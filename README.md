# check-http-code
Simple script for checking http code of URL list and filter if necessary. Can be easy used for checking 404 codes for site and getting list of 404 error pages.
## Usage
### The most simplest way
1. save the list of URL to be checked as CSV and put into the main directory as "source.csv"
1. run from command line
```
php index.php
```
Than list of URLs with codes will appear in file "destination.csv"
### Modifying the configuration
All configuration is in main index.php file. Exactly what you need to modify is the filename configuration, 
so all configuration is on the top of the file.
```php
define('SOURCE_FILE', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'source.csv'); // source file with urls
define('DESTINATION_FILE', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'destination.csv'); // source file with urls
```
## Support
If you find any problem, please use issue tracker:
https://github.com/jdrda/check-http-code/issues

## Origins
This utility was created for migrating project between two systems (like Prestashop to Woocommerce). Every system has different URL generator,
so if you do not want to loose you SEO (SEM) positions, you have to redirect all old links into the new ones.

E.g.
http://oldshop.com/category-name/product-name -> http://newshop.com/product-name

If there are some similarities, so some links are the same, you save the time with comparing if some of new links
are the same as old links (you simply get the list of old links, change the domain and check if the http code is 200)

So this is gonna happen in four steps
1. Grabbing all URLs from old project, e.g. with http://www.web-site-map.com
1. Make CSV from XML sitemap with some tool like with http://www.convertcsv.com/xml-to-csv.htm
1. Save the CSV as source.csv to the root directory of this project
1. run from command line
```
php index.php
```
