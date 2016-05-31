*****************************************
Author: Ryan Huff
Email: ryan@ryanthomashuff.com
Web: http://ryanthomashuff.com
*****************************************

REQUIRMENTS:

- PHP 5+
- Apache2
- SimpleXML (needs to be compiled into PHP: http://php.net/manual/en/book.simplexml.php)
- Web app has to be able to communicate with the publisher node of your CUCM cluster
- Cisco Unified Communications Manager 7.x+


INSTRUCTIONS:

- There are 3 files; functions.class.php, index.php, styles.css
- Put all 3 files in your web directory
- Open the functions.class.php file with a text editor and adjust the following variables at the top of the file:
    //CHANGE THIS ADDRESS TO THE ADDRESS OF THE CUCM PUBLISHER
    var $siteIPAddress = "XXX.XXX.XXX.XXX";
    
    //CHANGE THIS TO WHATEVER YOU WANT TO NAME THE APPLICATION
    var $appName = "The XYZ Company's corporate phone directory.";
    
    //CHANGE THIS TO THE NAME OF THE COMPANY THAT THE APPLICATION IS FOR
    var $companyName = "XYZ Company";
