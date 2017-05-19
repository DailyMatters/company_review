### Readme

#### Currently available endpoints:

- /company/{companySlug} - View a specific company and read all their reviews.
- /avgRatings - View companies and their average ratings.
- /moreReviews/{companySlug} - Users who reviewed this company also reviewed.

#### To run the apllication:

- Use PHP inbuilt web server functionality to run the API. Navigate to the `/web` folder and run the following command. 
 
 ```bash
php -S localhost:8080

 ```

 Then access the webpage at `http://localhost:8080/avgRatings/`

 In the root directory you can use:

 ```bash
 php -S localhost:8080 -t web\
 ```
#### Testing

- To run the test suite execute the following command:
 
 ```bash
 ./vendor/phpunit/phpunit/phpunit --testdox
 ```

- To generate code coverage run one of the following commands:

 ```bash
./vendor/phpunit/phpunit/phpunit --testdox --coverage-text

./vendor/phpunit/phpunit/phpunit --testdox --coverage-html <directory>
