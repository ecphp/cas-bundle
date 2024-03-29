.. _installation:

Installation
============

This package has `a Symfony Flex recipe`_ that will install configuration files for you.

Default configuration files will be copied in the `dev` environment.

Step 1
~~~~~~

The recommended way to install it is with Composer_ :

.. code-block:: bash

    composer require ecphp/cas-bundle

.. warning:: If you use `API Platform`_ and Symfony < 5.2, then it's possible that some URLs contains parameters with
   a dot inside. By default, Symfony mangles url parameters having dot with an underscore, which can lead in huge
   inconsistencies if you heavily rely on query parameters like in API Platform.

   In order to fix that issue, the optional package `loophp/unaltered-psr-http-message-bridge-bundle`_ can be installed.

   .. code-block:: bash

      composer require loophp/unaltered-psr-http-message-bridge-bundle

Step 2
~~~~~~

This is the crucial part of your application's security.

Edit the security settings of your application, usually in `config/packages/security.yaml`,
as such:

.. code-block:: yaml

    security:
        enable_authenticator_manager: true

        firewalls:
            dev:
                pattern: ^/(_(profiler|wdt)|css|images|js)/
                security: false
            # this firewall is going to require to login for the /secured path
            secured:
                provider: cas
                pattern: ^/secured
                custom_authenticator: EcPhp\CasBundle\Security\CasAuthenticator
                form_login:
                    check_path: cas_bundle_login
                    login_path: cas_bundle_login
                entry_point: EcPhp\CasBundle\Security\CasAuthenticator
            main:
                # lazy: true
                provider: users_in_memory

                # activate different ways to authenticate
                # https://symfony.com/doc/current/security.html#firewalls-authentication

                # https://symfony.com/doc/current/security/impersonating_user.html
                # switch_user: true

        # Easy way to control access for large sections of your site
        # Note: Only the *first* access control that matches will be used
        access_control:
            # in case you want to put the entire application behind a secured firewall, you'll need
            # to give public assess to the login area of the cas bundle like below
            - { path: ^/cas, roles: PUBLIC_ACCESS }
            - { path: ^/secured, roles: ROLE_CAS_AUTHENTICATED }

This configuration example will trigger the authentication on paths starting
with `/secured`, therefore make sure that at least such paths exists.

Feel free to change these configuration to fits your need. Have a look at
`the Symfony documentation about security`_.

Step 3
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

Step 4
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

If you prefer using a local CAS server, you can choose to build your own using the tool you prefer.
The quickest solution for a working CAS server on any platform is this `Docker project`_.

.. _a Symfony Flex recipe: https://github.com/symfony/recipes-contrib/blob/master/ecphp/cas-bundle/2.0/manifest.json
.. _Composer: https://getcomposer.org
.. _symfony/http-client: https://packagist.org/packages/symfony/http-client
.. _the Symfony documentation about security: https://symfony.com/doc/current/security.html
.. _this page: https://apereo.github.io/cas/6.1.x/index.html#demos
.. _Proxy authentication: https://apereo.github.io/cas/6.1.x/installation/Configuring-Proxy-Authentication.html#proxy-authentication
.. _source: https://github.com/drupol/heroku-cas-server
.. _Docker project: https://github.com/crpeck/cas-overlay-docker
.. _Apereo: https://www.apereo.org/
.. _https://casserver.herokuapp.com/cas/: https://casserver.herokuapp.com/cas/
.. _loophp/unaltered-psr-http-message-bridge-bundle: https://github.com/loophp/unaltered-psr-http-message-bridge-bundle
.. _API Platform: https://api-platform.com/
