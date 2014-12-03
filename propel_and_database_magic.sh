DATABASE_USER="root"
DATABASE_PASSWORD="pass"

# this sets up the database and database user
#NOTE: the path is because this is not working for me, just use "mysql" if that works for you
# /Applications/XAMPP/bin/mysql
mysql --user=$DATABASE_USER --password=$DATABASE_PASSWORD < setup_db_and_user.sql
# this build the latest SQL and addes the models to the database
sudo rm -f generated-sql/sqldb.map
./vendor/propel/propel/bin/propel sql:build
./vendor/propel/propel/bin/propel sql:insert
# this builds the PHP files for the models
./vendor/propel/propel/bin/propel model:build
mysql --user=$DATABASE_USER --password=$DATABASE_PASSWORD < sample_data.sql

# mysql --user=root --password=pass < setup_db_and_user.sql
# ./vendor/propel/propel/bin/propel sql:insert
# mysql --user=root --password=pass < sample_data.sql
