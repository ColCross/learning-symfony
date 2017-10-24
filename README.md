# The Dog's out of the Bag
A small **unfinished** blog template I created to learn PHP and the Symfony framework.
### Instructions for Running

The site requires a MySQL database for adding, removing, and displaying posts.
I have included in "database.txt" a sample database that can be imported into MAMP.
Once imported, the host name and user/pass may need be be changed in "app/config/parameter.yml" to match your system.

Finally, the web server is run by navigating to the root folder and executing:
```
php bin/console server:run
```
**NOTE**: It is a good idea to periodically clear the cache by stopping the server and executing:
```
php bin/console cache:clear
```
Then restart the server using the command above.
#### TODO
* Fix sticky footer
* Post archive
* Pagination
* About page