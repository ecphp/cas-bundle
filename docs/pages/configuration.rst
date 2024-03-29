.. _configuration:

Configuration
=============

Hereunder an example of configuration for CAS Bundle.

.. tip:: Based on this configuration, the behavior of the bundle can change.

.. code:: yaml

   base_url: https://casserver.herokuapp.com/cas
   protocol:
     login:
       path: /login
       allowed_parameters:
         - service
         - renew
         - gateway
       default_parameters:
         service: https://my-app/homepage
     serviceValidate:
       path: /p3/serviceValidate
       allowed_parameters:
         - format
         - pgtUrl
         - service
         - ticket
       default_parameters:
         format: JSON
         pgtUrl: https://my-app/casProxyCallback
     logout:
       path: /logout
       allowed_parameters:
         - service
       default_parameters:
         service: https://my-app/homepage
     proxy:
       path: /proxy
       allowed_parameters:
         - targetService
         - pgt
     proxyValidate:
       path: /proxyValidate
       allowed_parameters:
         - format
         - pgtUrl
         - service
         - ticket
       default_parameters:
         format: JSON
         pgtUrl: https://my-app/casProxyCallback