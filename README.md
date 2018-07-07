Porn Terminal
=============

> Show random porn in your terminal.

[![Build Status](https://img.shields.io/travis/redaxmedia/porn-terminal.svg)](https://travis-ci.org/redaxmedia/porn-terminal)
[![Packagist Version](https://img.shields.io/packagist/v/redaxmedia/porn-terminal.svg)](https://packagist.org/packages/redaxmedia/porn-terminal)
[![License](https://img.shields.io/packagist/l/redaxmedia/porn-terminal.svg)](https://packagist.org/packages/redaxmedia/porn-terminal)


Preview
-------

![Terminal Session](https://cdn.rawgit.com/redaxmedia/media/master/porn-terminal/terminal-session.svg)


Installation
------------

```
composer require redaxmedia/porn-terminal
```


Usage
-----

```
bin/porn-terminal [options]


-D/--image-dither
     Dither of the image.


-E/--api-endpoint <argument>
     Required. API endpoint: actors, channels, dvds, videos


-G/--image-grayscale
     Grayscale of the image.


-I/--image-invert
     Invert the image.


-M/--image-metadata
     Metadata of the image.


-O/--open-browser
     Open URL in browser.


-P/--api-provider <argument>
     Required. API provider: porn.com, pornhub.com, redtube.com, tube8.com, youporn.com


-Q/--api-query <argument>
     API query.


-R/--image-resize <argument>
     Resize the image.


-T/--api-timeout <argument>
     API timeout.


-W/--image-weight <argument>
     Weight of the image.


--help
     Show the help page for this command.
```


Examples
--------

Show actors by rating:

```
bin/porn-terminal --api-provider porn.com --api-endpoint actors --api-query order=rating
```

Show dvds by views:

```
bin/porn-terminal --api-provider porn.com --api-endpoint dvds --api-query order=views
```

Show videos from pornhub.com:

```
bin/porn-terminal --api-provider pornhub.com
```

Show videos from youporn.com:

```
bin/porn-terminal --api-provider youporn.com
```
