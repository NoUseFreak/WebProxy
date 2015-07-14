Clastic Standard Edition
========================

Welcome to the Clastic Standard Edition - a fully-functional Clastic
application that you can use as the skeleton for your new applications.

This document contains information on how to download, install, and start
using Clastic.

1) Installing the Standard Edition
----------------------------------

As Clastic uses [Composer][1] to manage its dependencies, the recommended way
to create a new project is to use it.

If you don't have Composer yet, download it following the instructions on
http://getcomposer.org/ or just run the following command:

    sudo curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin/ --filename=composer

Then, use the `create-project` command to generate a new Clastic application:

    composer create-project clastic/standard-edition path/to/install -s dev

Composer will install Clastic and all its dependencies under the
`path/to/install` directory.

2) Checking your System Configuration
-------------------------------------

Before starting coding, make sure that your local system is properly
configured for Clastic.

Execute the `check.php` script from the command line:

    php app/check.php

The script returns a status code of `0` if all mandatory requirements are met,
`1` otherwise.

Access the `config.php` script from a browser:

    http://localhost/path-to-project/web/config.php

If you get any warnings or recommendations, fix them before moving on.

3) Browsing the Demo Application
--------------------------------

Congratulations! You're now ready to use Clastic.

Run the internal server:

   app/console server:run

You can access your freshly installed backend at

    http://127.0.0.1:8000/admin/

4) Getting started with Clastic
-------------------------------

TODO

Enjoy!

[1]:  http://getcomposer.org/
