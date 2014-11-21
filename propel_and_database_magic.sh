DATABASE_USER="root"
DATABASE_PASSWORD=""

# this sets up the database and database user
#NOTE: the path is because this is not working for me, just use "mysql" if that works for you
/Applications/XAMPP/bin/mysql --user=$DATABASE_USER --password=$DATABASE_PASSWORD < setup_db_and_user.sql
# this build the latest SQL and addes the models to the database
./vendor/propel/propel/bin/propel sql:build
./vendor/propel/propel/bin/propel sql:insert
# this builds the PHP files for the models
./vendor/propel/propel/bin/propel model:build
