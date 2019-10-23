Usage
=====

Step 1
~~~~~~

Follow the :ref:`installation` procedure.

Step 2
~~~~~~

Configure the configuration files accordingly and the security of your Symfony application.

Step 3
~~~~~~

If you try to reach a path that is protected by the firewall, you should be automatically
redirected to the CAS server login page.

Once you're authenticated, the CAS server will redirect you back to the Symfony application
and continue the authentication process.

If the credentials that you provided were valid, then you'll be authenticated.