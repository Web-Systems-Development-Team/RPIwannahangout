RPIwannahangout
===============

Awesome app for RPI students to find people to hangout with

===============

Dependencies:
PHP 5.4.?
MySQL something
Apache2 something

(maybe some npm or bower stuff, not sure)
bootstrap 3.2.0

===============

How to set up propel and RPIWannaHangOut databases:

Edit the DATABASE_USER and DATABASE_PASSWORD variables in
database_propel_magic.sh then run it. If you're lucky it'll do everything you
need to get set up.

Set up RPIWannaHangOut database and database user
	Run this command “mysql --user=root --password=pass < setup_db_and_user.sql”
		the --user and --pass flags are only if your default user doesn’t have
		access privileges. Your root user probably should have a better password.
	OR in phpmyadmin click on the SQL tab, copy and paste the code in
	setup_db_and_user.sql, click go in the bottom right
Set up database tables
	Run this command from the root directory of the project
	“./vendor/propel/propel/bin/propel sql:insert”
	OR Run this command “mysql RPIWannaHangOut --user=root --password=pass <
	generated-sql/RPIWannaHangOut.sql”
		as above the --user and --pass flags are only if your default user
		doesn’t have access privileges. Your root user probably should have a better password.
	OR in phpmyadmin click on RPIWannaHangOut database on the left then click
	on the SQL tab, copy and paste the code in generated-sql/RPIWannaHangOut.sql,
	click go in the bottom right

================

How to set up xdebug:

Varies with platform, make sure to display_errors in php.ini is set to On not Off.