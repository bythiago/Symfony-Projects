Symfony Projects Edition
========================

> How to Generate Entities from an Existing Database

``` bash
php app/console doctrine:mapping:import AppBundle annotation
php app/console doctrine:generate:entities AppBundle
php app/console generate:doctrine:crud AppBundle:BlogPost
```

Enjoy!

[1]:  https://symfony.com/doc/2.8/setup.html
[6]:  https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html
[7]:  https://symfony.com/doc/2.8/doctrine.html
[8]:  https://symfony.com/doc/2.8/templating.html
[9]:  https://symfony.com/doc/2.8/security.html
[10]: https://symfony.com/doc/2.8/email.html
[11]: https://symfony.com/doc/2.8/logging.html
[12]: https://symfony.com/doc/2.8/assetic/asset_management.html
[13]: https://symfony.com/doc/current/bundles/SensioGeneratorBundle/index.html
