.. _development:

Development
===========

Maintainers
-----------

See the `MAINTAINERS.txt`_ file.

Documentation
-------------

Documentation can be built locally using `Sphinx`_.

To render the documentation locally do the following steps

* Go in the project root directory,
* ``docker run -it --rm -v $(pwd)/docs:/docs sphinxdoc/sphinx /bin/bash``
* ``pip install sphinx_rtd_theme``
* ``make install``

Contributors
------------

See the `Github insights page`_.

.. _MAINTAINERS.txt: https://github.com/ecphp/cas-bundle/blob/master/MAINTAINERS.txt
.. _Github insights page: https://github.com/ecphp/cas-bundle/graphs/contributors
.. _Sphinx: https://www.sphinx-doc.org/
