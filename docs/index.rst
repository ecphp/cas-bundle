CAS Bundle
==========

A Central Authentication Service bundle for Symfony 4.

The Central Authentication Service (CAS) is an Open-Source single sign-on protocol for the web.
Its purpose is to permit a user to access multiple applications while providing their credentials only once.
It also allows web applications to authenticate users without gaining access to a user's security credentials,
such as a password. The name CAS also refers to a software package that implements this protocol.

In order to foster a greater adoption of this bundle, it has been built
with interoperability in mind. It only uses `PHP Standards Recommendations`_ interfaces.

-  `PSR-3`_ for logging,
-  `PSR-4`_ for classes autoloading,
-  `PSR-6`_ for caching,
-  `PSR-7`_ for HTTP messages (requests, responses),
-  `PSR-12`_ for coding standards,
-  `PSR-17`_ for HTTP messages factories,
-  `PSR-18`_ for HTTP client.

.. _CAS authentication: https://en.wikipedia.org/wiki/Central_Authentication_Service
.. _PHP Standards Recommendations: https://www.php-fig.org/
.. _PSR-3: https://www.php-fig.org/psr/psr-3/
.. _PSR-4: https://www.php-fig.org/psr/psr-4/
.. _PSR-6: https://www.php-fig.org/psr/psr-6/
.. _PSR-7: https://www.php-fig.org/psr/psr-7/
.. _PSR-12: https://www.php-fig.org/psr/psr-12/
.. _PSR-17: https://www.php-fig.org/psr/psr-17/
.. _PSR-18: https://www.php-fig.org/psr/psr-18/

.. toctree::
    :hidden:

    CAS Bundle <self>

.. toctree::
   :hidden:
   :caption: Table of Contents

   Requirements <pages/requirements>
   Installation <pages/installation>
   Configuration <pages/configuration>
   Usage <pages/usage>
   Tests <pages/tests>
   Contributing <pages/contributing>
   Development <pages/development>
