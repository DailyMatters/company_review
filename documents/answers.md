### Answers

* How much test-coverage is desirable?

I believe that instead of chasing the 100% code coverage, code coverage should be at least enough to cover all the logical paths in the code. Also, if the project has been developed using TDD it should have a high code coverage, just because of the methodology used. 

* What parts of your example do you like the least?

There are two main things I actually don't like in my example. First, the fact that the `CompanyReview.php` class has too many responsibilities. It should be separated in at least 3 different classes. One to manage the general information fetching, one for the ratings functionality and another one for the review functionality.
The second thing I dislike about my example is the fact that it doesn't have proper code coverage.

* How would you describe your coding style? What makes your code clean? Can you point out an example?

I always try to use proper function naming so that someone can look at my code and see exactly what a function does without having to look at code. I also try to use small functions with no more than 2 levels of indentation. Ideally I like to have a proper code coverage for my code so that any change I do can be instantly tested and all functionality that was already working continues working. I would consider my code style as an ever evolving thing, always trying to get better.

* Did you use any design patterns? If so, why did you decide on that particular pattern? If not, then why not?

I didn't use any design pattern consciously, mostly because of speed. If the separation of the code into new classes happened then dependency injection comes to mind as a way to proper have a separation of concerns.

* How maintainable is your code? What makes it maintainable?

At this point, the main selling point of maintainability of my code is the fact that uses small and simple functions, with clear naming.

* What would be your preferred storage for solving a problem like this in a production environment and why? What would be the alternatives?

It depends on the amount of data we are expecting. But for a problem like this that expects a lot of data, then a non relational database would be the ideal storage method. I say this because nosql is the preferred method for highly dynamic, big datasets, as a review system can actually be.
