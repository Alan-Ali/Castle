one way to run these files in local servers:
   - you must run a webserver solution like xampp, and start the apache servers.
      - download xampp here: https://www.apachefriends.org/download.html
   - the database used for this project is oracle sql, on oracle 10g express edition
      - download oracle 10g express edition here: https://www.appservgrid.com/coherence/downxe.html
      - download sql developer to manage oracle databases here: https://www.oracle.com/tools/downloads/sqldev-downloads.html 
   - put the file in htdocs of the xampp directory.(detect the location in your pc, then put it in the htdocs file)
   - open the localhost of your webBrowser.
   - open the file : Project_Castle_Y1S1/phpFiles/RegistrationPage.php. 
   - in the directory Project_Castle_Y3S1\SQL_Files\Project_Castle(htdocs).sql the (User_) table must be run 
   on the database, then after that the (user_Profile_Pic) table must be run, these tables are designed for oracle database.
   - you must also have the oracle database 10g express edition.
   - make a user named PROJECT_CASTLE and make the password the same PROJECT_CASTLE.
   - after creating the user PROJECT_CASTLE in the sql server, run the sql file in this order:
      - USER_
      - USER_PROFILE_PIC
      - USER_BACKGROUND_PIC
      - POST
      - Post_Status
      - User_Status
   
   - you must create some data in the database to be properly run, and be seen, first by creating users
     then by adding questions that is chosen by the user as topics, if the topic was out of the users interests
     it won't be seen, this will be later worked on for improvments.
     


Project Status:
   - the things that must be added for the project completion are and being set are:
      - [x] notification system
      - [ ] finishing up user interests part algorithm in the first page
      - [ ] finishing up the search algorithm and show up results
























