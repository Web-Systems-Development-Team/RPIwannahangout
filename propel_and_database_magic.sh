DATABASE_USER="root"
DATABASE_PASSWORD="powerthrill123"

# this sets up the database and database user
mysql --user=$DATABASE_USER --password=$DATABASE_PASSWORD < setup_db_and_user.sql
# this build the latest SQL and addes the models to the database
./vendor/propel/propel/bin/propel sql:build
./vendor/propel/propel/bin/propel sql:insert
# this builds the PHP files for the models
./vendor/propel/propel/bin/propel model:build
