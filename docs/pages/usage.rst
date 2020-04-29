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

Once setup, if you try to reach a path that is protected by the firewall, you will be automatically
redirected to the CAS server login page.

If you try to reach a path using Ajax (`X-Requested-With: XMLHttpRequest`), there won't be any redirection but
an error **401** (`Unauthorized`).

Once authenticated on the CAS server, you will be redirected back to the Symfony application and continue the
authentication process.
