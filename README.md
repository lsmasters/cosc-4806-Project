This assignment is a continuation of Assignment 3 which is also in Github.

Assignment 4
•	Allow a logged-in user to perform CRUD
•	Create a reminder, view reminders (read), update existing reminders, and delete reminders
•	The table should be called notes with at least 3 columns. Id, user_id, subject. You may want to add more such as: created_at, completed, deleted
File structure used: 

Name	Nullability	Data Type
 id	NOT NULL	int
 user_id	NULL	int
 subject	NULL	mediumtext
 created_at	NULL	timestamp		

•	Update header to include the new item for creating reminders
•	Your Models may look very similar from student to student. Your controller as well to a certain extent. However, your views should all be unique. You need to display the notes/reminders in a user-friendly way and the user should be able to update/delete them as well. There also needs to be a way for them to create. This is all covered in the video above.
Lessons Learned:  This was perhaps the most challenging assignment so far:
1.	Make one change at a time and commit it to github. Know when to take a break and go back to your last success.
2.	Error detection can be very challenging in php.
3.	File paths and routing became a BIG issue at times.
4.	Passing variables can be challenging depending on your controller setup.
Known issues:
1.	 Routing at the end of EDIT and DELETE is a problem.  Must manually move by tab.
2.	 The user must manually move from the CREATE REMINDER page once a reminder has been created…..not sure why? 
3.	Much documentation is missing because I ran out of time.



