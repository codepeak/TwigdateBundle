Twigdate Bundle
===============

This bundle adds support to nicer dates in Twig-templates.

Installation
------------

1. Add this to your composer file:

```"codepeak/twigdate-bundle": "dev-master"```

2. Install the bundle and add this to your __AppKernel.php__

```$bundles[] = new Codepeak\TwigdateBundle\CodepeakTwigdateBundle();```

3. Use in your templates

```
{{ dateTimeObject|nicedate }} // Outputs nicer dates, like "34 seconds ago" or "less than an hour"
```

Changelog
---------

2013-06-09 Initial version of the bundle.

License
-------

This bundle is under the MIT license. See the complete license in LICENSE file.

Reporting an issue
------------------

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/codepeak/TwigdateBundle/issues).
