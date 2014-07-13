SculpinDateNavigationBundle
===========================

Generate date navigation block (with pages) in Sculpin.

Installation
------------

Using composer, add the dependancy to your composer.json :

``` json
require: {
    "jbouzekri/sculpin-date-navigation-bundle": "1.*"
}
```

And run the composer update command

Enable the bundle. If you have already have an app/SculpinKernel.php, add this bundle to it otherwise create the file with the following content :

``` php
<?php

class SculpinKernel extends \Sculpin\Bundle\SculpinBundle\HttpKernel\AbstractKernel
{
    protected function getAdditionalSculpinBundles()
    {
        return array(
            'Jb\Bundle\DateNavigationBundle\JbDateNavigationBundle'
        );
    }
}
```

Then you need to add the date page html and the date navigation block html to your project :
* Copy the Resources/html/include/date_navigation.html file in the _includes folder of your source
* Copy the Resources/html/page/date.html file in the blog folder of your source (or any other html folder you use). For information, a date_paginated.html template is available for paginated date page.

Usage
-----

In a template, you can now call the following twig function :

``` twig
{{ date_navigation(page) }}
```

It will generate the date navigation html.

You can specify a custom template :

``` twig
{{ tag_cloud(page, 'my_template.html') }}
```

Configuration
-------------

``` yml
jb_date_navigation:
    permalink_year: /:year/index.html
    permalink_month: /:year/:month/index.html
```

* jb_date_navigation.permalink_year : the url mask for the date year page
* jb_date_navigation.permalink_month : the url mask for the date month page

License
-------

[MIT](LICENSE)

