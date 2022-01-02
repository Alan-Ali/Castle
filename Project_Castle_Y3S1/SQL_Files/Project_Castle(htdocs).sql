-- USER_ TABLE 
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

--drop table USER_;

-- ALTER�TABLE�`user`�ADD�`datatype`�VARCHAR(259)�NULL�AFTER�`password`;
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



--drop table USER_PROFILE_PIC;

SELECT * FROM USER_PROFILE_PIC ORDER BY PIC_DATE ASC;

INSERT INTO USER_PROFILE_PIC(Profile_Pic_Id, User_Id, Pic_Data_Type, Pic_Name, Pic_Directory)
VALUES('242342dd', 'W4DU1GNV_', 'PNG', 'givemeabreak', '3423/3423/sd3d/3w');


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
    Post_Views NUMBER DEFAULT(0) NOT NULL  -- ADDED
);
 ALTER TABLE POST ADD POST_VIEWS NUMBER DEFAULT(0) NOT NULL;


-- ALTER TABLE POST ADD POST_DATE NUMBER;
-- ALTER TABLE POST MODIFY POST_DATE NUMBER NOT NULL;

drop table POST;


--INSERT INTO Post(Post_Id, User_Id, Post_Date, Post_Content, Post_Content_Header, Post_Topic) 
--VALUES();
--
--CREATE TABLE POST_LIKES_();
--CREATE TABLE POST_UNLIKES_();

    CREATE TABLE Post_Status(
        Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
        FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
        User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id), -- added
        FOREIGN KEY(User_Id) REFERENCES User_(User_Id),
        Reply NUMBER(1) DEFAULT(0),
        Question NUMBER(1) DEFAULT(0),
        Answer NUMBER(1) DEFAULT(0)
    );
--User_Id VARCHAR2(256) NULL,

select * from User_;

SELECT * FROM Post WHERE  (Post_Root = '0') AND (ROWNUM <= 20) ORDER BY POST_DATE ASC;

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

--
--INSERT INTO Post_Status(Post_Id, Reply, Question, Answer)
--VALUES();


-- Constructing some data for testing purposes

-- L7CPGNT3_91548   AlanAce

-- WAVEYGLF_07581   HiMi

-- OPV3W4KX_82630   Awesome

-- KW7N0PR3_76501   Email

-- F68M9GAF_34927   CastleMan    

-- VSZWA179_63491   kaguya

-- 1/  AlanAce -> done
INSERT INTO Post(Post_Id, User_Id, Post_Date, Post_Content, Post_Content_Header, Post_Topic) 
VALUES( 'SDKFJ3AS_34233_ADKEX','L7CPGNT3_91548', SYSDATE , 'i came to this world blind about what is going on around me, 
i want to have my own path, and find the way, can someone elaborate please', 'What is a religion?', 'Religion');

INSERT INTO Post_Status(Post_Id, Reply, Question, Answer)
VALUES('SDKFJ3AS_34233_ADKEX', 0,1,0);

CREATE TABLE LIKES_SDKFJ3AS_34233_ADKEX(
    Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id) 
);

CREATE TABLE UNLIKES_SDKFJ3AS_34233_ADKEX(
    Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);


-- 2/ HiMi -> done
INSERT INTO Post(Post_Id, User_Id, Post_Date, Post_Content, Post_Content_Header, Post_Topic) 
VALUES('XCKFJ3AS_34233_ASKED', 'WAVEYGLF_07581', SYSDATE , 'as you can see technology suddenly exploded and become part of our every day lives,
what was the reason that made it reach this caliber, i would appreciate a good answer.', 'why technology grows so fast?', 'Technology');

INSERT INTO Post_Status(Post_Id, Reply, Question, Answer)
VALUES( 'XCKFJ3AS_34233_ASKED',0,1,0);

CREATE TABLE LIKES_XCKFJ3AS_34233_ASKED(
    Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);

CREATE TABLE UNLIKES_XCKFJ3AS_34233_ASKED(
     Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);

-- 3/ Awesome -> done
INSERT INTO Post(Post_Id, User_Id, Post_Date, Post_Content, Post_Content_Header, Post_Topic) 
VALUES('SDKFJ3AS_33413_ADKEX','OPV3W4KX_82630', SYSDATE , 'i really can not get my mind around social media
anymore, it became so complex, that it is purpose just dimnished in my view. can someone elaborate and answer please, thanks.', 'what is the real purpose of social media?', 'Social Media');

INSERT INTO Post_Status(Post_Id, Reply, Question, Answer)
VALUES('SDKFJ3AS_33413_ADKEX',0,1,0);

CREATE TABLE LIKES_SDKFJ3AS_33413_ADKEX(
   Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);

CREATE TABLE UNLIKES_SDKFJ3AS_33413_ADKEX(
     Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);


-- 4/  Email -> done
INSERT INTO Post(Post_Id, User_Id, Post_Date, Post_Content, Post_Content_Header, Post_Topic) 
VALUES('LKKFJ3AS_34233_QWKYX', 'KW7N0PR3_76501', SYSDATE , 'i was thinking if the best possible music can be found 
like making it loved by everyone, and last forever, is there any type like that, i would like a beautiful answr, thanks.', 'what could be the best possible music?', 'Music');

INSERT INTO Post_Status(Post_Id, Reply, Question, Answer)
VALUES('LKKFJ3AS_34233_QWKYX',0,1,0);

CREATE TABLE LIKES_LKKFJ3AS_34233_QWKYX(
     Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);

CREATE TABLE UNLIKES_LKKFJ3AS_34233_QWKYX(
     Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);


-- 5/ CastleMan -> done
INSERT INTO Post(Post_Id, User_Id, Post_Date, Post_Content, Post_Content_Header, Post_Topic) 
VALUES('SDKDJ3AS_48345_ADKEX', 'F68M9GAF_34927', SYSDATE , 'i was thnking since there are too many online courses outthere we may not need this 
sort of education we have anymore, since we can get the courses we want online, just saying', 'is education worth it anymore?', 'Education');

INSERT INTO Post_Status(Post_Id, Reply, Question, Answer)
VALUES('SDKDJ3AS_48345_ADKEX',0,1,0);

CREATE TABLE LIKES_SDKDJ3AS_48345_ADKEX(
  Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);

CREATE TABLE UNLIKES_SDKDJ3AS_48345_ADKEX(
    Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);

-- 6/ kaguya -> done
INSERT INTO Post(Post_Id, User_Id, Post_Date, Post_Content, Post_Content_Header, Post_Topic) 
VALUES('CVXFJ3AS_34233_SDMEX', 'VSZWA179_63491', SYSDATE , 'we see too many cars every day, but what is the best car
made yet in human history, like a good answer please.', 'what is the best car yet?', 'Cars');

INSERT INTO Post_Status(Post_Id, Reply, Question, Answer)
VALUES('CVXFJ3AS_34233_SDMEX',0,1,0);


CREATE TABLE LIKES_CVXFJ3AS_34233_SDMEX(
   Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);

CREATE TABLE UNLIKES_CVXFJ3AS_34233_SDMEX(
  Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);



-- 7/ AlanAce -> done
INSERT INTO Post(Post_Id, User_Id, Post_Date, Post_Content, Post_Content_Header, Post_Topic) 
VALUES('SDKFJ932_14233_ADKEX', 'L7CPGNT3_91548', SYSDATE , 'what is the best diet or way of living to keep my body healthy and
keep in tact, thanks.', 'how can keep my body health stable?', 'Health');

INSERT INTO Post_Status(Post_Id, Reply, Question, Answer)
VALUES('SDKFJ932_14233_ADKEX',0,1,0);

CREATE TABLE LIKES_SDKFJ932_14233_ADKEX(
  Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);


CREATE TABLE UNLIKES_SDKFJ932_14233_ADKEX(
    Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);



-- 8/ HiMi -> done
INSERT INTO Post(Post_Id, User_Id, Post_Date, Post_Content, Post_Content_Header, Post_Topic) 
VALUES('VBKFJ3AS_34233_LLIOW', 'WAVEYGLF_07581' , SYSDATE , 'i want to scare myself to death,
i did not look at a scary movie since along time, and i want to start with a dangerous one.', 'what is the scariest movie yet?', 'Movies');

INSERT INTO Post_Status(Post_Id, Reply, Question, Answer)
VALUES('VBKFJ3AS_34233_LLIOW',0,1,0);

CREATE TABLE LIKES_VBKFJ3AS_34233_LLIOW(
      Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);

CREATE TABLE UNLIKES_VBKFJ3AS_34233_LLIOW(
     Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);


-- 9/ Awesome -> done
INSERT INTO Post(Post_Id, User_Id, Post_Date, Post_Content, Post_Content_Header, Post_Topic) 
VALUES('VBKFJ3AS_34233_LLLX3', 'OPV3W4KX_82630', SYSDATE , 'it bugs me alot that madara lost after that caliber of his, he literally 
wooped all the kages without even moving himself and played with them like dolls, what is a good explanation for that.', 'why madara lost?', 'Anime');

INSERT INTO Post_Status(Post_Id, Reply, Question, Answer)
VALUES('VBKFJ3AS_34233_LLLX3',0,1,0);

CREATE TABLE LIKES_VBKFJ3AS_34233_LLLX3(
  Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);

CREATE TABLE UNLIKES_VBKFJ3AS_34233_LLLX3(
   Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);


-- 10/ Email -> done
INSERT INTO Post(Post_Id, User_Id, Post_Date, Post_Content, Post_Content_Header, Post_Topic) 
VALUES('VBPOI3AS_34533_LLIOW', 'KW7N0PR3_76501' , SYSDATE , 'i think it is time for this old guies to leave the
stage of football, i mean new era of players will come soon right?', 'when will ronaldo leave the stage?', 'Sports');

INSERT INTO Post_Status(Post_Id, Reply, Question, Answer)
VALUES('VBPOI3AS_34533_LLIOW', 0,1,0);

CREATE TABLE LIKES_VBPOI3AS_34533_LLIOW(
     Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);

CREATE TABLE UNLIKES_VBPOI3AS_34533_LLIOW(
  Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);


-- 11/ CastleMan -> done
INSERT INTO Post(Post_Id, User_Id, Post_Date, Post_Content, Post_Content_Header, Post_Topic) 
VALUES('VBKF34AS_34233_RTWEW', 'F68M9GAF_34927', SYSDATE , 'i am asking why youngsters are so unappreciative while they live 
in an era where everything is much easier for them, this is a very ugly thing in my opinion.', 'what is wrong with youngsters these days?', 'Social Issues');

INSERT INTO Post_Status(Post_Id, Reply, Question, Answer)
VALUES('VBKF34AS_34233_RTWEW', 0,1,0);

CREATE TABLE LIKES_VBKF34AS_34233_RTWEW(
     Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);

CREATE TABLE UNLIKES_VBKF34AS_34233_RTWEW(
     Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);


-- 12/ kaguya -> done
INSERT INTO Post(Post_Id, User_Id, Post_Date, Post_Content, Post_Content_Header, Post_Topic) 
VALUES('VBKFJ3AS_34233_ZDAEW', 'VSZWA179_63491', SYSDATE , 'I want to understand why trump is so hated, like you are telling me
there was not a worse president than him before, thanks for the answers', 'why trump was so hated?', 'Politics');

INSERT INTO Post_Status(Post_Id, Reply, Question, Answer)
VALUES('VBKFJ3AS_34233_ZDAEW',0,1,0);

CREATE TABLE LIKES_VBKFJ3AS_34233_ZDAEW(
      Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);

CREATE TABLE UNLIKES_VBKFJ3AS_34233_ZDAEW(
    Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);



-- 13/ AlanAce -> done
INSERT INTO Post(Post_Id, User_Id, Post_Date, Post_Content, Post_Content_Header, Post_Topic) 
VALUES('VBKFJ3AS_15675_LLIOW', 'L7CPGNT3_91548', SYSDATE , 'i heard that too many data are faked concerning the 
global warming, and even a billionaire like don penna was going crazy about it saying it is all bollocks. thanks for
your kind answers �?', 'is global warming really a think?', 'Environment');

INSERT INTO Post_Status(Post_Id, Reply, Question, Answer)
VALUES('VBKFJ3AS_15675_LLIOW',0,1,0);

CREATE TABLE LIKES_VBKFJ3AS_15675_LLIOW(
    Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);

CREATE TABLE UNLIKES_VBKFJ3AS_15675_LLIOW(
       Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);



-- 14/ HiMi -> done
INSERT INTO Post(Post_Id, User_Id, Post_Date, Post_Content, Post_Content_Header, Post_Topic) 
VALUES('VBSDFG2S_34233_LFGHW', 'WAVEYGLF_07581', SYSDATE , 'why i hear rumors like hitlers did not die and 
and crazy talk like that? i belive this is all new age propaganda.', 'is hitler really dead?', 'History');

INSERT INTO Post_Status(Post_Id, Reply, Question, Answer)
VALUES('VBSDFG2S_34233_LFGHW',0,1,0);

CREATE TABLE LIKES_VBSDFG2S_34233_LFGHW(
    Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);

CREATE TABLE UNLIKES_VBSDFG2S_34233_LFGHW(
     Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);

-- 15/ Awesome -> done
INSERT INTO Post(Post_Id, User_Id, Post_Date, Post_Content, Post_Content_Header, Post_Topic) 
VALUES('VBKFGDAS_34453_LFGOW', 'OPV3W4KX_82630' , SYSDATE , 'we hear too much about how science improved our lives, but
what is the most advanced way that science presents itself? thanks for yor kind answers.', 'what is the top notch science we reached till now?', 'Science');

INSERT INTO Post_Status(Post_Id, Reply, Question, Answer)
VALUES('VBKFGDAS_34453_LFGOW',0,1,0);

CREATE TABLE LIKES_VBKFGDAS_34453_LFGOW(
     Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);

CREATE TABLE UNLIKES_VBKFGDAS_34453_LFGOW(
     Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);


-- 16/ Email
INSERT INTO Post(Post_Id, User_Id, Post_Date, Post_Content, Post_Content_Header, Post_Topic) 
VALUES('BVKFJ3AS_34233_DFAXC','KW7N0PR3_76501', SYSDATE , 'is there a relationship that you were envieng in your life that you were 
literally wishing for that life. thanks for your kind answers', 'what is the most beautiful relationship you witnessed?', 'Relationships');

INSERT INTO Post_Status(Post_Id, Reply, Question, Answer)
VALUES('BVKFJ3AS_34233_DFAXC',0,1,0);

CREATE TABLE LIKES_BVKFJ3AS_34233_DFAXC(
     Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);

CREATE TABLE UNLIKES_BVKFJ3AS_34233_DFAXC(
     Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id)
);


SELECT MAX(POST_COMMENTS) FROM Post WHERE  Post_Level = 1 AND Post_Parent_Id = 'SDKFJ3AS_34233_ADKEX';
























