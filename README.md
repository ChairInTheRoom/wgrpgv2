wgrpg
=====

Instructions
=====

Download the files in this repository in a zip file.

![alt text](Images/downloadcode.PNG)

![alt text](Images/zip1.PNG)

Unzip them.

![alt text](Images/zip2.PNG)
![alt text](Images/zip3.PNG)

Rename the unzipped folder for convenience.

![alt text](Images/zip4.PNG)

Download XAMPP from [here](https://www.apachefriends.org/download.html). Double click the file to install it. The specific location isn't important, but you'll need to remember where you installed it.

These are the options needed to run the game.

![alt text](Images/xamppoptions.PNG)

Uncheck Bitnami, that's not needed.

Now that XAMPP is installed, copy the wgrpg folder into the htdocs folder inside the folder you installed XAMPP into.

![alt text](Images/copy1.PNG)
![alt text](Images/copy2.PNG)
![alt text](Images/copy3.PNG)

Now in your browser, go to localhost/phpmyadmin. Create a new database.

![alt text](Images/sqlimport1.PNG)

Name the new database wgrpg, and click create.

![alt text](Images/sqlimport3.PNG)

Click import.

![alt text](Images/sqlimport4.PNG)

Click browse, and navigate to your XAMPP install folder, then htdocs\wgrpg\SQL. Select the dbwgrpg.sql file, then click Go.

![alt text](Images/sqlimport5.PNG)
![alt text](Images/sqlimport6.PNG)

Once it's done importing, navigate to localhost/wgrpg and register an account. If everything was done correctly, the game will be ready to play.