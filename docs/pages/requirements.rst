Requirements
============

PHP
---

PHP greater than 7.1 is required for this library.

PHP Extensions
--------------

- json
- libxml
- simplexml

Packages
--------

In order to get the CAS bundle working, you will require some dependencies.

To give a maximum freedom to the users using, each required dependencies is a well
defined standardized PHP class.

+------------------+-----------+---------------------------------+------------------------+
| Dependency       | PSR       | Implementations                 | Example package        |
+==================+===========+=================================+========================+
| Logger           | `PSR-3`_  | `log-implementation`_           | `monolog/monolog`_     |
+------------------+-----------+---------------------------------+------------------------+
| Cache            | `PSR-6`_  | `cache-implementation`_         | `symfony/cache`_       |
+------------------+-----------+---------------------------------+------------------------+
| Server request   | `PSR-7`_  | `http-message-implementations`_ | `nyholm/psr7-server`_  |
+------------------+-----------+---------------------------------+------------------------+
| HTTP factories   | `PSR-17`_ | `http-factory-implementations`_ | `nyholm/psr7`_         |
+------------------+-----------+---------------------------------+------------------------+
| HTTP Client      | `PSR-18`_ | `http-client-implementations`_  | `symfony/http-client`_ |
+------------------+-----------+---------------------------------+------------------------+

You are free to use any package you want, as long as they are implementing the proper requirement.

.. _monolog/monolog: https://packagist.org/packages/monolog/monolog
.. _nyholm/psr7-server: https://packagist.org/packages/nyholm/psr7-server
.. _nyholm/psr7: https://packagist.org/packages/nyholm/psr7
.. _symfony/cache: https://packagist.org/packages/symfony/cache
.. _symfony/http-client: https://packagist.org/packages/symfony/http-client
.. _cache-implementation: https://packagist.org/providers/psr/cache-implementation
.. _http-client-implementations: https://packagist.org/providers/psr/http-client-implementation
.. _http-factory-implementations: https://packagist.org/providers/psr/http-factory-implementation
.. _http-message-implementations: https://packagist.org/providers/psr/http-message-implementation
.. _log-implementation: https://packagist.org/providers/psr/log-implementation
.. _PSR-17: https://www.php-fig.org/psr/psr-17/
.. _PSR-18: https://www.php-fig.org/psr/psr-18/
.. _PSR-3: https://www.php-fig.org/psr/psr-3/
.. _PSR-6: https://www.php-fig.org/psr/psr-6/
.. _PSR-7: https://www.php-fig.org/psr/psr-7/
