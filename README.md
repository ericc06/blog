# blog

Installation instructions:
=========================

Go to the root directory of the web site, and then type:

git init
git clone https://github.com/ericc06/blog.git
mv blog/* .
rm -rf blog


Create a database with the name you want, the manner you prefer (cPanel, command line...)


Execute the SQL installation script "blog.sql". For example (replace <db-name> with the name of the database you created):

mysql -u <username> -p<password> <db-name> < blog.sql


Edit the "config.php" file and enter:
- your database connection parameters.
- your contact form details (email address and email subject).


You're done!

