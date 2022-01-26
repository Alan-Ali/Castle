/* all the user's personal data */
CREATE TABLE USER_(
    User_Id VARCHAR2(256) NOT NULL PRIMARY KEY, 
    User_Name VARCHAR2(256) NOT NULL,
    User_Name_Id VARCHAR2(21) NOT NULL,
    User_Password VARCHAR2(256) NOT NULL,
    User_Email VARCHAR2(256) NOT NULL,
    User_Age DATE NOT NULL,
    User_Gender VARCHAR2(21) NOT NULL,
    User_Telephone_No NUMBER(21) DEFAULT(0),
    User_Address VARCHAR2(256) NULL, 
    User_Topics VARCHAR2(4000 BYTE) NULL,
    User_Date_Created NUMBER NOT NULL,   -- added
    User_Role VARCHAR2(256) NOT NULL,
    User_Role_Confirmation NUMBER(1) DEFAULT (0),
    User_Status NUMBER(1) DEFAULT (0),
    User_Content_No NUMBER(21) DEFAULT(0),
    User_Block_Status NUMBER(1) DEFAULT (0), 
    USER_EMAIL_SHOW NUMBER(1) DEFAULT(0),
    USER_GENDER_SHOW NUMBER(1) DEFAULT(0),
    USER_AGE_SHOW NUMBER(1) DEFAULT(0),
    USER_TELEPHONE_NO_SHOW NUMBER(1) DEFAULT(0),
    USER_ADDRESS_SHOW NUMBER(1) DEFAULT(0),
    USER_DESCRIPTION VARCHAR2(4000) DEFAULT(0)
);


/* table for user's profile pic in the user's profile page */
CREATE TABLE USER_PROFILE_PIC(
    Profile_Pic_Id VARCHAR2(256) PRIMARY KEY, 
    User_Id VARCHAR2(256) NOT NULL REFERENCES USER_(User_Id),
    FOREIGN KEY(User_Id) REFERENCES USER_(User_Id),
    Pic_Data_Type VARCHAR2(21) ,
    Pic_Name VARCHAR2(256) , 
    Pic_Directory VARCHAR2(256),
    User_Pic_Number NUMBER(21) DEFAULT(0),
    Pic_Status NUMBER(1) DEFAULT(1),
    Pic_Date NUMBER NOT NULL -- added
);


/* table for user's background pic in the user's profile page*/
CREATE TABLE USER_BACKGROUND_PIC(
    Background_Pic_Id VARCHAR2(256) PRIMARY KEY, 
    User_Id VARCHAR2(256) NOT NULL REFERENCES USER_(User_Id),
    FOREIGN KEY(User_Id) REFERENCES USER_(User_Id),
    Back_Pic_Data_Type VARCHAR2(21) ,
    Back_Pic_Name VARCHAR2(256) , 
    Back_Pic_Directory VARCHAR2(256),
    Back_User_Pic_Number NUMBER(21) DEFAULT(0),
    Back_Pic_Status NUMBER(1) DEFAULT(1),
    Back_Pic_Date NUMBER NOT NULL
);


/* table for Posts made by the user*/
CREATE TABLE Post(
    Post_Id VARCHAR2(256) PRIMARY KEY,
    User_Id VARCHAR2(256) NOT NULL REFERENCES USER_(User_Id),
    FOREIGN KEY(User_Id) REFERENCES USER_(User_Id),
    Post_Parent_Id VARCHAR2(256) DEFAULT(0),
    Post_Level NUMBER(21) DEFAULT(0),
    Post_Root VARCHAR2(256) DEFAULT(0), --
    Post_Comments NUMBER(21) DEFAULT(0), 
    Post_Likes NUMBER(21) DEFAULT(0),
    Post_Unlikes NUMBER(21) DEFAULT(0),
    Post_Date NUMBER NOT NULL,
    Post_Content VARCHAR2(4000),
    Post_Content1 VARCHAR2(4000) NULL,
    Post_Content2 VARCHAR2(4000) NULL, 
    Post_Content3 VARCHAR2(4000) NULL,
    Post_Content_Header VARCHAR2(4000),
    Post_Topic VARCHAR2(256),
    Post_Sub_Topic VARCHAR2(256) NULL, --ADDED
    POST_VIEWS NUMBER DEFAULT(0) NOT NULL  -- ADDED
);




/* table for Post Status of the user */
CREATE TABLE Post_Status(
        Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
        FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
        User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id), -- added
        FOREIGN KEY(User_Id) REFERENCES User_(User_Id),
        Reply NUMBER(1) DEFAULT(0),
        Question NUMBER(1) DEFAULT(0),
        Answer NUMBER(1) DEFAULT(0)
    );



/* this table is created for collecting data depending on the users actions, which will be according to 
some functions */
CREATE TABLE USER_DATA(
            User_Id VARCHAR2(256) NOT NULL REFERENCES USER_(User_Id),
            FOREIGN KEY(User_Id) REFERENCES USER_(User_Id),
            NUM_QUESTIONS NUMBER(21) DEFAULT(0),
            NUM_ANSWERS NUMBER(21)DEFAULT(0),
            NUM_REPLIES NUMBER(21) DEFAULT(0),
            NUM_FOLLOWERS NUMBER(21) DEFAULT(0),
            NUM_FOLLOWED NUMBER(21)  DEFAULT(0),
            UPVOTES NUMBER(21) DEFAULT(0),
            DOWNVOTES NUMBER(21) DEFAULT(0)
);



/* to get all user data */
select * from User_;

