# Leave-Management-Portal
Leave Management Portal

Problem Statement ---------------------------

Project Description:

You are expected to develop a faculty portal for an academic university. For this project, you are expected
to develop code for both the front-end UI and the back-end of the system. Given that this course focuses
on topics related to databases systems, we would expect a more thorough effort on the database part of
the project. However, there should be a bare minimum effort on front-end UI as well.

Faculty in an academic university are largely divided into two categories: (a) Faculty and (d) cross-cutting
faculty (e.g., Deans and Associate Deans etc.). People in each of these categories are formed into a
hierarchy with the Director at the top most level. And as expected, people participating in this hierarchy
(at various roles) change with time. Your design must allow for such changes and should also keep a track
of it. Following is a brief background on the hierarchy of faculty (in an IIT):

          Faculty: Faculty are divided on a departments (e.g., CS, EE, ME, Civil, etc.). Each department
          has a head-of-department (HoD) who is also one of the faculty members in the department. Each
          HoD appointment is a time bound appointment and is thus associated with a start-date and
          end-date.
          Cross-cutting Faculty: In any institute, we do have some faculty who are not associated with
          any particular department. Examples of this include, Dean Faculty Affairs, Dean Academic
          Affairs, Dean Research and Dean Student Affairs. All Deans (and Associate Deans under them)
          are faculty who have been appointed to the said post for a certain duration.
          
Concepts relevant to faculty:

          ● Personal Profile (to be implemented via a NoSQL): Each faculty has a portal for storing
          his/her academic profile (for e.g., refer: https://research.monash.edu/en/persons/abhinav-dhall). In
          this portal, a faculty would like to storing details on his/her background, publications, grants,
          awards, teaching, etc. As you can guess, not all faculty would want to update this information. So
          this information should not ideally be modeled as a relational schema. Its best to use noSQL for
          modeling such information.
          
          ● Leave applications: From time-to-time, faculty can go on a leave. Depending on the post of the
          applicant, his/her leave application would go through a specific route. For instance, leave
          application of a faculty follows the following route for approval: Faculty → HoD → Dean
          Faculty Affairs. In each stage, the person forwards with comments. Finally Dean Faculty Affairs
          approves or rejects. After approval, leave is deducted from the available leaves and an intimation
          is sent to faculty.
          
Note that leave applications of HoDs and Deans are approved by the Director. Two more
things to note here: (a) each employee have a fixed number for leaves per year (this expire at the
end of the year). (b) Sometimes, HoD, concerned head, and/or Dean FAA may redirect the
application to the employee for more comments. Note that even if the leaves for the current year
are finished, the employees may still be granted leave by borrowing some from the coming year.
In such a case, two requests are raised by the faculty. One request is for borrowing of leaves and
other is regular leave. Both of these requests are encapsulated as one request and go together and
follow the same route described previously. Once approved, an appropriate note (mentioning that
leaves have been borrowed) is attached with the approval.
Assume the following Depts in Faculty: CSE, ME and EE. Each Dept has an HoD.
Assume the following Deans: Dean Faculty Affairs, Associate Dean Faculty Affairs
Assume one Director: And everybody comes under the Director.

Portals to be implemented:

          ● Basic Employee Portals: Each of the employees would have their own personal portals. Portals
          should have the following: (a) Personal academic profile (and options to edit it), (b)Total number
          leaves available this year, (c) Status of the leave applications (including the comments added by
          various entities, (d) Options to start new leave applications, (e) Respond to comments made on
          leave applications.
          
          ● Specialized Portals: Each of the named positions such as HoD, Dean and Director would have
          specialized portals for handling the applications. Note that all the specialized portal logins must
          be tied up with an employee (implicity).
          Constraints:
          
          ● Complete Paper Trail Needs to Maintained in the system: “Who signed what and when.”
          Even if an employee leaves the institute, there should be a record on what all did he/she approve.
          Similar is the case when HoDs or Deans change. Note that all the specialized portal login must
          be tied up with an employee. For instance, if a faculty signs an application via his/her Deans
          login, then appropriate information regarding this must be stored in the database.
          
          ● Route of the leave applications should not be hard coded into your code. These things change
          with time. You can assume the presence of your DB-ADMIN who can change these routes as
          needed in the database without the need for re-compiling the code.
          
          ● An employee can launch only one leave application at a time.
          
          ● You design should have relevant security features. For instance, a faculty should not have write
          access to the field/table containing Dean’s comments (or HoD comments) on leave applications,
          he/she can only read it.
          
   Softwares required ---------------------------------------------
   1. Apache and myphpsql (I have done it using xampp)
   2. mongoDB
   
   3. set mongoDB environment.
   4. pair appropriate dll mongDB file in xampp.
   
   How to run:
   
   make a folder named project and dowload above files(git code) in it.
   Open browser and type ----- http://localhost/practice/project/.
   
   -----------------------------------------------------------------------
