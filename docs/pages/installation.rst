.. _installation:

Installation
============

This package does not yet have a Symfony Flex recipe. Installation steps must be done manually.

Default configuration files will be copied in the `dev` environment except for the file defining
the services.

Step 1
~~~~~~

The easiest way to install it is through Composer_

.. code-block:: bash

    composer require ecphp/cas-bundle

Step 2
~~~~~~

Make sure that the bundle is enabled in `config/bundles.php`.

You should see a line that looks like the following:

.. code-block:: php

    EcPhp\CasBundle\CasBundle::class => ['all' => true],

Step 3
~~~~~~

Recursively copy the content of the `Resources/config` folder in `config/` folder.

.. code-block:: bash

    cp -ar vendor/ecphp/cas-bundle/Resources/config/* config/

Step 4
~~~~~~

This is the crucial part of your application's security configuration.

Edit the security settings of your application by edition the file `config/packages/security.yaml`.

.. code-block:: yaml

    security:
        firewalls:
            main:
                anonymous: ~
                guard:
                    provider: cas
                    authenticators:
                        - cas.guardauthenticator

        access_control:
            - { path: ^/api, role: ROLE_CAS_AUTHENTICATED }
            - { path: ^/admin, role: ROLE_CAS_AUTHENTICATED }

This configuration example will trigger the authentication on paths starting
with `/api` or `/admin`, therefore make sure that at least such paths exists.

Feel free to change these configuration to fits your need. Have a look at
`the Symfony documentation about security and Guard authentication`_.

Step 5
~~~~~~

The CAS protocol requires HTTPS on both side (client and server) in order
to communicate.

Whilst it is not possible to configure the behavior of the CAS server, it is
possible to configure the HTTP client in use in this bundle in order to relax
the requirement and to disable SSL checks when communicating from the client
to the server.

.. warning:: Keep in mind that the following is only for development setup, not for production.

On step 3, while copying the configuration files, the file ``config/packages/dev/cas_framework.yaml``
is copied over. That file is useful when developing, it will disable some verifications
required when using SSL protocol.

Those particular settings are specific to the default HTTP client that is
installed, which is `symfony/http-client`_.

The ``User-Agent`` HTTP header used on the ``dev`` environment is ``SymfonyCasBundle``.
Feel free to customize it or remove it when switching to another environment.

If you plan to change the HTTP client, those settings will most probably need
to be updated accordingly.

Step 6
~~~~~~

The default configuration of this bundle comes with a configuration for authenticating with a real
CAS server setup for testing and demo purposes at `https://casserver.herokuapp.com/cas/`_.

.. warning:: It is important to note that this is the Apereo official public demo cas server, used by the project for
             basic showcases. They may go up and down as the project needs without notice, see `this page`_ for further
             information.

The credentials to use for authentication are the following:

- User: ``casuser``
- Password: ``Mellon``

Modifying the configuration file is key in this bundle and requires some understanding
of the CAS protocol. See more on the dedicated :ref:`configuration` page for that.

The aforementioned server provided by `Apereo`_ does not support Proxy authentication.

If you need a server with `Proxy authentication`_, edit the ``cas_bundle.yaml`` and replace
``https://casserver.herokuapp.com/cas/`` with ``https://heroku-cas-server.herokuapp.com/cas/``.
Make sure to enable the property ``pgtUrl`` which is by default in comment.
The `source`_ of that server are hosted on Github.

If you prefer using a local CAS server, you can choose to build your own using the tool you prefer.
The quickest solution for a working CAS server on any platform is this `Docker project`_.

.. _Composer: https://getcomposer.org
.. _symfony/http-client: https://packagist.org/packages/symfony/http-client
.. _https://heroku-cas-server.herokuapp.com/cas/: https://heroku-cas-server.herokuapp.com/cas/
.. _the Symfony documentation about security and Guard authentication: https://symfony.com/doc/current/security/guard_authentication.html
.. _this page: https://apereo.github.io/cas/6.1.x/index.html#demos
.. _Proxy authentication: https://apereo.github.io/cas/6.1.x/installation/Configuring-Proxy-Authentication.html#proxy-authentication
.. _source: https://github.com/drupol/heroku-cas-server
.. _Docker project: https://github.com/crpeck/cas-overlay-docker
.. _Apereo: https://www.apereo.org/
.. _https://casserver.herokuapp.com/cas/: https://casserver.herokuapp.com/cas/
