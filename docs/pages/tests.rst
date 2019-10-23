Tests, code quality and code style
==================================

The code style is based on `PSR-12`_ plus a set of custom rules.
Find more about the code style in use in the package `drupol/php-conventions`_.

A PHP quality tool, Grumphp_, is used to orchestrate all these tasks at each commit
on the local machine, but also on the continuous integration tools (Travis, Github actions)

To run the whole tests tasks locally, do

.. code-block:: bash

    composer grumphp

or

.. code-block:: bash

    ./vendor/bin/grumphp run

Here's an example of output that shows all the tasks that are setup in Grumphp and that
will check your code

.. code-block:: bash

    ./vendor/bin/grumphp run
    GrumPHP is sniffing your code!
    Running task  1/10: Composer... ✔
    Running task  2/10: ComposerNormalize... ✔
    Running task  3/10: YamlLint... ✔
    Running task  4/10: JsonLint... ✔
    Running task  5/10: PhpLint... ✔
    Running task  6/10: TwigCs... ✔
    Running task  7/10: PhpCsAutoFixerV2... ✔
    Running task  8/10: PhpCsFixerV2... ✔
    Running task  9/10: Phpcs... ✔
    Running task 10/10: PhpStan... ✔

.. _PSR-12: https://www.php-fig.org/psr/psr-12/
.. _drupol/php-conventions: https://github.com/drupol/php-conventions
.. _Travis CI: https://travis-ci.org/drupol/cas-bundle/builds
.. _Github Actions: https://github.com/drupol/cas-bundle/actions
.. _PHPSpec: http://www.phpspec.net/
.. _PHPInfection: https://github.com/infection/infection
.. _Grumphp: https://github.com/phpro/grumphp