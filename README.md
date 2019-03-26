Doctissimo
==========

### Installation

This project is dockerized and the different containers are managed thanks to Docker Compose.
Therefore, after cloning this project, you only have to run the following commands:
```
# Install the dependencies (accept all the default values)
composer install

# Launch the containers
sudo docker-compose up
```

### Routes

For the user interface, two routes are available:
* GET /blog/articles => list all the articles
* GET /blog/articles/{id} => show one article

For the API, three routes are available:
* GET /api/blog/articles => give you the (id, title) of all articles
* GET /api/blog/articles/{id} => give you all the information about one article
* POST /api/blog/articles => allows you to create a new article. The fields to pass in the body are:
  * title
  * description
  
  It will send you back the newly created instance.
