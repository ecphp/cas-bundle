.. _installation:

Installation
============

This package does not yet have a Symfony Flex recipe. Installation steps must be done manually.

Step 1
~~~~~~

The easiest way to install it is through Composer_

.. code-block:: bash

    composer require drupol/cas-bundle

Step 2
~~~~~~

Make sure that the bundle is enabled in `config/bundles.php`.

You should see a line that looks like the following:

.. code-block:: php

    drupol\CasBundle\CasBundle::class => ['all' => true],

Step 3
~~~~~~

Recursively copy the content of the `Resources/config` folder in `config/` folder.

.. code-block:: bash

    cp -ar vendor/drupol/cas-bundle/Resources/config/* config/

Step 4
~~~~~~

Edit the configuration file `cas.yaml` in `config/packages` and make sure it fits your needs.

See more on the dedicated :ref:`configuration` page.

Step 5
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

Step 6
~~~~~~

The CAS protocol requires HTTPS on both side (client and server) in order
to communicate.

While it is not possible to configure the behavior of the CAS server, it is
possible to configure the HTTP client in use in this bundle in order to relax
the requirement and to disable SSL checks when communicating from the client
to the server.

.. warning:: Keep in mind that the following is only for development setup, not for production.

E.g: If you're using the default `symfony/http-client`_, you might need to add in
`config/framework.yaml`:

.. code:: yaml

    framework:
        # ... Default stuff here
        http_client:
            default_options:
                verify_peer: false
                verify_host: false

.. _Composer: https://getcomposer.org
.. _symfony/http-client: https://packagist.org/packages/symfony/http-client