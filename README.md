# Store

This is a simple store web-app.
With this app you can log in as admin and create new categories, and for each category create new products

Then customers can register and log in and buy the items created by the admin.

### Installation Instructions ###

- Download the repository as ZIP and unzip the files in the root of your web server (I used XAMPP and the files were inside the htdocs folder)
- Create a new database and import `store.sql` file to the database (located in `/database`)
- You can now log in as admin with user name and password `admin` (already in the admin table)
- If you want to create a new admin, you have to manually do it in the database, and you should use the `create_password_hash.php` file to create the password hash
(Change the `$password` variable in the file then run the script and copy the generated hash to the password field of the admin table)
- Register a new user, and log in to see and buy the products created by the admin
