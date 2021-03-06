DROP TABLE director;
DROP TABLE associatedean;
DROP TABLE dean;
DROP TABLE hod;
DROP TABLE LeaveApplication;
DROP TABLE leave_record;
DROP TABLE hierarchy;
DROP TABLE faculty;
DROP TABLE admin_db;

CREATE TABLE faculty(
    email VARCHAR(50) NOT NULL PRIMARY KEY,
    password VARCHAR(50) NOT NULL,
    username VARCHAR(30) NOT NULL,
    department VARCHAR(30),
    role VARCHAR(30),
    startDate DATE NOT NULL
);

CREATE TABLE director(
    email VARCHAR(50) NOT NULL PRIMARY KEY,
    password VARCHAR(50) NOT NULL,
    username VARCHAR(30) NOT NULL,
    department VARCHAR(30),
    startDate DATE NOT NULL,
    Fid VARCHAR(50) NOT NULL,
    FOREIGN KEY (Fid) REFERENCES faculty(email)
);

CREATE TABLE hod(
    email VARCHAR(50) NOT NULL PRIMARY KEY,
    password VARCHAR(50) NOT NULL,
    username VARCHAR(30) NOT NULL,
    department VARCHAR(30),
    startDate DATE NOT NULL,
    Fid VARCHAR(50) NOT NULL,
    FOREIGN KEY (Fid) REFERENCES faculty(email)
);

CREATE TABLE associatedean(
    email VARCHAR(50) NOT NULL PRIMARY KEY,
    password VARCHAR(50) NOT NULL,
    username VARCHAR(30) NOT NULL,
    department VARCHAR(30),
    startDate DATE NOT NULL,
    Fid VARCHAR(50) NOT NULL,
    FOREIGN KEY (Fid) REFERENCES faculty(email)
);

CREATE TABLE dean(
    email VARCHAR(50) NOT NULL PRIMARY KEY,
    password VARCHAR(50) NOT NULL,
    username VARCHAR(30) NOT NULL,
    department VARCHAR(30),
    startDate DATE NOT NULL,
    Fid VARCHAR(50) NOT NULL,
    FOREIGN KEY (Fid) REFERENCES faculty(email)
);

CREATE TABLE hierarchy(
    From1 VARCHAR(50) NOT NULL PRIMARY KEY,
    To1 VARCHAR(50) NOT NULL
);



CREATE TABLE LeaveApplication(
    Ltype VARCHAR(30),
    startDate DATE NOT NULL,
    endDate DATE,
    LeaveId INTEGER PRIMARY KEY,
    Fid VARCHAR(50) NOT NULL,
    FOREIGN KEY (Fid) REFERENCES faculty(email)
);

CREATE TABLE PastRecord(  
    leaveType VARCHAR(50) NOT NULL,
    appovalDate datetime NOT NULL,
    Fid VARCHAR(50) NOT NULL,
    startDate DATE NOT NULL,
    endDate DATE NOT NULL,
    Lid INTEGER NOT NULL,
    FOREIGN KEY (Fid) REFERENCES faculty(email)
);

CREATE TABLE LeaveRecord(
    leavesAvailable INTEGER,
    CurrentStatus VARCHAR(50) NOT NULL,
    -- not_applied
    -- applied
    -- approved_by_HOD
    -- commented_by_HOD
    -- not_approved
    -- approved
    Fid VARCHAR(50) NOT NULL,
    FOREIGN KEY (Fid) REFERENCES faculty(email)
);

CREATE TABLE OLD_faculty(  
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL PRIMARY KEY,
    startDate DATE NOT NULL,
    endDate DATE NOT NULL,
    department VARCHAR(50) NOT NULL
);

CREATE TABLE OLD_HOD(  
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL PRIMARY KEY,
    startDate DATE NOT NULL,
    endDate DATE NOT NULL,
    department VARCHAR(50) NOT NULL
);

CREATE TABLE OLD_Associatedean(  
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL PRIMARY KEY,
    startDate DATE NOT NULL,
    endDate DATE NOT NULL
);

CREATE TABLE OLD_dean(  
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL PRIMARY KEY,
    startDate DATE NOT NULL,
    endDate DATE NOT NULL
);

CREATE TABLE OLD_director(  
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL PRIMARY KEY,
    startDate DATE NOT NULL,
    endDate DATE NOT NULL
);

CREATE TABLE admin_db(  
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL PRIMARY KEY,
    password VARCHAR(50) NOT NULL
);