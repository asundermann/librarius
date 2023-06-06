Librarius Project
=================



Requirements
------------

- Project requires PHP 8.0


Installation
------------
Clone repository to your IDE. Then install **composer** and **npm**. 

Build
------------
We are using only one script that builds and rewrite CSS for this web application

    'npm run build'

Web Server Setup
----------------

The simplest way to get started is to start the built-in PHP server in the root directory of your project:

    php -S localhost:8000 -t www
Then visit `http://localhost:8000` in your browser to see the welcome page.

Otherwise use Apache **vhost** file:

    <VirtualHost *:80>
    DocumentRoot "/www/example2"
    ServerName www.example.org

    # Other directives here
    </VirtualHost>
And don't forget the **hosts** file in  `C:\Windows\System32\drivers\etc`


For Apache or Nginx, setup a virtual host to point to the `www/` directory of the project and you
should be ready to go.

**It is CRITICAL that whole `app/`, `config/`, `log/` and `temp/` directories are not accessible directly
via a web browser. See [security warning](https://nette.org/security-warning).**
