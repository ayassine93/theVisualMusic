Project Description:
--------------------

This started as a simple university project of where I was required to create
an arbitrary website that enables users to upload a video. I expanded on this
project by making this a music-uploading service (currently only run on localhost).

Users can upload videos by selecting a .mp4 file, naming the artist and
song/content, and selecting a category. Once the file is verified and uploaded,
it can be found in the ascribed category section. The video can also be found
via search by keyword or by artist name.

This project is run on a localhost using an Apache server from the software
XAMPP. A local DB (Database) and table were created specifically for this project.
Therefore, it will not run unlessa DB is created, the lines on the SQL connection
and table modifications are modified in the PHP code. Also, the project has to use
some sort of host, just like I used Apache.


Development Details:
--------------------

- For the presentation of the website and it's content, HTML and CSS were used.
- PHP was used for the back-end development, i.e. file uploading, SQL connection,
search engine, etc...
- MySQL was used to create a database to store the uploaded video content. A table
within the database was created using the following code:
--------------------------------------
CREATE TABLE Videos
(

ID int AUTO_INCREMENT PRIMARY KEY,

artist varchar(40),

song varchar(40),

url varchar(200),

category varchar (15)

);  
--------------------------------------