
INSERT INTO faculty (email,password,username,department,role,startDate)
VALUES('skdas@iitrpr.ac.in','1234','skdas','me','director','2019-11-12');

INSERT INTO faculty (email,password,username,department,role,startDate)
VALUES('deepak@iitrpr.ac.in','1234','deepak','ee','deanfaa','2019-11-12');

INSERT INTO faculty (email,password,username,department,role,startDate)
VALUES('somitra@iitrpr.ac.in','1234','somitra','cse','hod','2019-11-12');

INSERT INTO faculty (email,password,username,department,role,startDate)
VALUES('raviteja@iitrpr.ac.in','1234','raviteja','ee','hod','2019-11-12');

INSERT INTO faculty (email,password,username,department,role,startDate)
VALUES('anshu@iitrpr.ac.in','1234','anshu','me','hod','2019-11-12');

INSERT INTO faculty (email,password,username,department,role,startDate)
VALUES('kalyan@iitrpr.ac.in','1234','kalyan','cse','faculty','2019-11-12');

INSERT INTO faculty (email,password,username,department,role,startDate)
VALUES('gunturi@iitrpr.ac.in','1234','gunturi','cse','faculty','2019-11-12');

INSERT INTO faculty (email,password,username,department,role,startDate)
VALUES('abhinav@iitrpr.ac.in','1234','abhinav','cse','faculty','2019-11-12');

INSERT INTO faculty (email,password,username,department,role,startDate)
VALUES('sam@iitrpr.ac.in','1234','sam','ee','faculty','2019-11-12');

INSERT INTO faculty (email,password,username,department,role,startDate)
VALUES('reddy@iitrpr.ac.in','1234','reddy','ee','faculty','2019-11-12');

INSERT INTO faculty (email,password,username,department,role,startDate)
VALUES('dhiraj@iitrpr.ac.in','1234','dhiraj','me','faculty','2019-11-12');

INSERT INTO faculty (email,password,username,department,role,startDate)
VALUES('harpreet@iitrpr.ac.in','1234','harpreet','me','faculty','2019-11-12');


INSERT INTO hod (email,password,username,department,startDate,Fid)
VALUES('csehod@iitrpr.ac.in','1234','somitra','cse','2019-11-12','somitra@iitrpr.ac.in');

INSERT INTO hod (email,password,username,department,startDate,Fid)
VALUES('eehod@iitrpr.ac.in','1234','raviteja','ee','2019-11-12','raviteja@iitrpr.ac.in');

INSERT INTO hod (email,password,username,department,startDate,Fid)
VALUES('mehod@iitrpr.ac.in','1234','anshu','me','2019-11-12','anshu@iitrpr.ac.in');


INSERT INTO dean (email,password,username,department,startDate,Fid)
VALUES('deanfaa@iitrpr.ac.in','1234','deepak','ee','2019-11-12','deepak@iitrpr.ac.in');


INSERT INTO director (email,password,username,department,startDate,Fid)
VALUES('director@iitrpr.ac.in','1234','skdas','me','2019-11-12','skdas@iitrpr.ac.in');


INSERT INTO hierarchy (From1,To1)
VALUES('faculty','hod');
INSERT INTO hierarchy (From1,To1)
VALUES('hod','deanfaa');
INSERT INTO hierarchy (From1,To1)
VALUES('deanfaa','director');
