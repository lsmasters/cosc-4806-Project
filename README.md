REQUIREMENT
•	Connect to OMDB: this part when fairly seamlessly following your video.
•	Allow someone (who doesn’t need to be logged in but it is okay if they are) to search for a movie and display all the relevant information in a nice view.  Movie Ratings appears in the header for the login page so people who are not logged in can access the movie reviews portion of the site with limited options in the header.  Non-logged in people are identitied as user 0.
•	Allow the user to give a rating
o	Keep track of this in a DB:  movies table structure
o	 
o	 
o	Display ratings to users (4/5 for example):  My ratings were out of 10 similar to omdb.
•	Allow the users to “get a review”
o	This review should be AI-generated.  Gemini was the AI engine used to generate five different reviews in five voices.  The user gets to select one of the reviews by selecting a radio button.
o	
Lessons Learned:  This was challenging because of all the small pieces/requirements:
1.	Make one change at a time and commit it to github. Know when to take a break and go back to your last success.
2.	Error detection can be very challenging in php.  My techniques improved as I progressed through the project but it was very frustrating at times.
3.	File paths and routing became a BIG issue at times. Variables were sometimes an issue between model and view.  The use of echo was very useful in debugging.

Known issues:
1.	 Much documentation is missing because I ran out of time.
2.	 Look/feel on different sized devices not handled at all because of time constraints.
3.	The site could be a lot more creative!
Future Improvements (time permitting):
1.	 It would be interesting to visit other sites besides omdb and compare reviews/ratings on the same movie.
2.	 Currently, show my reviews shows all the reviews of the users.  I would just show other user reviews of just the movie your are interested in, not all…..an easy fix.
3.	It would also be interesting to check with outher AI sites to generate the reviews.
4.	I would also add an EDIT button to the suggested review so I could personalize it.
5.	I would use the critic’s name for the review.  I used the user number for anonymity in this version.
6.	Add full CRUD function to the administrator for the movies table in the database.
7.	I would allow the user to select or input the voice used in the review. 
