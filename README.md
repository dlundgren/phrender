Phrender
========

[![Travis CI](https://secure.travis-ci.org/dlundgren/phrender.png)](https://travis-ci.org/dlundgren/phrender) [![Code Climate](https://codeclimate.com/github/dlundgren/phrender/badges/gpa.svg)](https://codeclimate.com/github/dlundgren/phrender)

Phrender is a simplistic PHP renderer that provides a no frills rendering
engine.

PSR-1 and PSR-4 compliant.

This uses the [Output Interop](https://github.com/output-interop/output-interop) specification.

Contexts
--------

The following contexts are provided for use:

* **Collection** Any number of the following
* **Any** Matches any template
* **Contains** uses `stripos` to match the template
* **Match** Uses a regex to match the template
* **Only** Will match only the specified template  

Installation
------------

Phrender can be installed using composer

`composer require dlundgren/phrender`

Basic Usage
-----------

```php
<?php

$factory = new Phrender\Template\Factory(['/path/to/views']);
$engine = new Phrender\Engine($factory, new Phrender\Context\Collection());

// index.php: <?= $this->var ?>

// output = "something"
$output = $engine->render('index', ['var' => 'something']); 

// Alternate
// output = ""
$ctxt   = new Phrender\Context\Contains('something', ['var' => 'display']);
$output = $engine->render('index', $ctxt); 
```

