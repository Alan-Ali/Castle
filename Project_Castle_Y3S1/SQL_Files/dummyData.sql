


----------------------------------------------NOTE-START----------------------------------------------------------
-- Constructing some manual data for testing purposes
-- 1- the user data will be created when you create the user at the registration page
--    of the website

-- 2- the dummy data here is for the posts, which each post, UNLIKE and LIKE TABLES will be created
--    so becareful when filling them up

-- 3-  write the user id, so you can choose who the dummy data belongs too

-- 4- and write the user name to distinguish the username and code

-- 5- replace the data in the below queries, with suitable data especially user id must be from random 
--    id generators that are placed in the sql database, other are randomly put by you, but don't forget to 
--    match it with the right data type

-- examples to be written before putting the data: 
    -- L7CPGNT3_91548   AlanAce

    -- WAVEYGLF_07581   HiMi

    -- OPV3W4KX_82630   Awesome

    -- KW7N0PR3_76501   Email

    -- F68M9GAF_34927   CastleMan    

    -- VSZWA179_63491   kaguya


-- NOTE: now that the DATE VALUES must be in seconds, meaning the seconds will be turned to the currrent date 
-- in php or js if needed.
        -- eg: 
            -- 1641295647912 this will be tured into 4/1/2022, it's counted since epoch time

---------------------------------------------NOTE-END---------------------------------------------------------- 




-- 1/  AlanAce -> done
INSERT INTO Post(Post_Id, User_Id, Post_Date, Post_Content, Post_Content_Header, Post_Topic) 
VALUES( 'SDKFJ3AS_34233_ADKEX','L7CPGNT3_91548', 1641295647912 , 'i came to this world blind about what is going on around me, 
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
VALUES('XCKFJ3AS_34233_ASKED', 'WAVEYGLF_07581', 1641295647912 , 'as you can see technology suddenly exploded and become part of our every day lives,
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
VALUES('SDKFJ3AS_33413_ADKEX','OPV3W4KX_82630', 1641295647912 , 'i really can not get my mind around social media
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
VALUES('LKKFJ3AS_34233_QWKYX', 'KW7N0PR3_76501', 1641295647912 , 'i was thinking if the best possible music can be found 
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
VALUES('SDKDJ3AS_48345_ADKEX', 'F68M9GAF_34927', 1641295647912 , 'i was thnking since there are too many online courses outthere we may not need this 
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
VALUES('CVXFJ3AS_34233_SDMEX', 'VSZWA179_63491', 1641295647912 , 'we see too many cars every day, but what is the best car
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
VALUES('SDKFJ932_14233_ADKEX', 'L7CPGNT3_91548', 1641295647912 , 'what is the best diet or way of living to keep my body healthy and
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
VALUES('VBKFJ3AS_34233_LLIOW', 'WAVEYGLF_07581' , 1641295647912 , 'i want to scare myself to death,
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
VALUES('VBKFJ3AS_34233_LLLX3', 'OPV3W4KX_82630', 1641295647912 , 'it bugs me alot that madara lost after that caliber of his, he literally 
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
VALUES('VBPOI3AS_34533_LLIOW', 'KW7N0PR3_76501' , 1641295647912 , 'i think it is time for this old guies to leave the
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
VALUES('VBKF34AS_34233_RTWEW', 'F68M9GAF_34927', 1641295647912 , 'i am asking why youngsters are so unappreciative while they live 
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
VALUES('VBKFJ3AS_34233_ZDAEW', 'VSZWA179_63491', 1641295647912 , 'I want to understand why trump is so hated, like you are telling me
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
VALUES('VBKFJ3AS_15675_LLIOW', 'L7CPGNT3_91548', 1641295647912 , 'i heard that too many data are faked concerning the 
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
VALUES('VBSDFG2S_34233_LFGHW', 'WAVEYGLF_07581', 1641295647912 , 'why i hear rumors like hitlers did not die and 
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
VALUES('VBKFGDAS_34453_LFGOW', 'OPV3W4KX_82630' , 1641295647912 , 'we hear too much about how science improved our lives, but
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
VALUES('BVKFJ3AS_34233_DFAXC','KW7N0PR3_76501', 1641295647912 , 'is there a relationship that you were envieng in your life that you were 
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