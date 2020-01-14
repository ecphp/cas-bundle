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

    composer require ecphp/cas-bundle:^1

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

Register new firewall for CAS authentication, e.g.

.. code:: yaml

    firewalls:
        main:
            guard:
                provider: cas
                authenticators:
                    - cas.guardauthenticator

Example of configuration:

.. code:: yaml

    security:
        firewalls:
            dev:
                pattern: ^/(_(profiler|wdt)|css|images|js)/
                security: false
            main:
                anonymous: true
                provider: cas
                switch_user: true
                pattern: ^/
                guard:
                    authenticators:
                        - cas.guardauthenticator
        access_control:
            - { path: ^/api, role: ROLE_CAS_AUTHENTICATED }

This example configuration example will trigger the authentication on paths starting
with `/api`, therefore make sure that at least such paths exists.

Feel free to change these configuration to fits your need. Have a look at
`the Symfony documentation about security and Guard authentication`_.

Step 5
~~~~~~

The default configuration of this bundle comes with a configuration for authenticating with a real
CAS server setup for testing and demo purposes at `https://heroku-cas-server.herokuapp.com/cas/`_.

You should normally already be able to authenticate using the following credentials:

- User: `casuser`
- Password: `Mellon`

Modifying the configuration file is key in this bundle and requires some understanding
of the CAS protocol. See more on the dedicated :ref:`configuration` page for that.

Step 6
~~~~~~

The CAS protocol requires HTTPS on both side (client and server) in order
to communicate.

Whilst it is not possible to configure the behavior of the CAS server, it is
possible to configure the HTTP client in use in this bundle in order to relax
the requirement and to disable SSL checks when communicating from the client
to the server.

.. warning:: Keep in mind that the following is only for development setup, not for production.

On step 3, while copying the configuration files, the file `config/packages/dev/cas_framework.yaml`
is copied over. That file is useful when developing, it will disable some verifications
required when using SSL protocol.

Those particular settings are specific to the default HTTP client that is
installed, which is `symfony/http-client`_.

If you plan to change the HTTP client, those settings will most probably need
to be updated accordingly.

.. _Composer: https://getcomposer.org
.. _symfony/http-client: https://packagist.org/packages/symfony/http-client
.. _https://heroku-cas-server.herokuapp.com/cas/: https://heroku-cas-server.herokuapp.com/cas/
.. _the Symfony documentation about security and Guard authentication: https://symfony.com/doc/current/security/guard_authentication.html
