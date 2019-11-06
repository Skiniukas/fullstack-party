# Great task for Great Fullstack Developer

If you found this task it means we are looking for you!

> Note: To clone this repository you will need [GIT-LFS](https://git-lfs.github.com/)

## Few simple steps

1. Fork this repo
2. Do your best
3. Prepare pull request and let us know that you are done

## Few simple requirements

- Design should be recreated as closely as possible.
- Design must be responsive. Because we live in our smartphones and we will check with them for sure.
- Use GitHub V3 REST API to receive data. [Docs here](https://developer.github.com/v3/)
- Use popular PHP framework (SlimPHP, Lumen, Symfony, Laravel, Zend or any other)
- Use AngularJS or ReactJS.
- Use CSS preprocessor (SCSS preferred).
- Browser support must be great. All modern browsers plus IE9 and above.
- Use a Javascript task-runner. Gulp, Webpack or Grunt - it doesn't matter.
- Do not commit the build, because we are building things on deployment.

## Few tips

- Structure! WE LOVE STRUCTURE!
- Maybe You have an idea how it should interact with users? Do it! Its on you!
- Have fun!

==========

Please enter Github credentials in the .env file

```
# https://github.com/settings/developers
OAUTH_GITHUB_CLIENT_ID={oauth_github_client_id}
OAUTH_GITHUB_CLIENT_SECRET={oauth_github_client_secret}

# https://github.com/settings/tokens
GITHUB_USER_TOKEN={github_user_token}
```

Run project with Docker
```
docker-compose up
```

Initialize project structure, composer, create DB structures, ...
```
$ sh init.sh
```

#### Accessing the project

```
http://localhost:8082/
```

Run tests
```
docker exec -it sf_php /bin/bash -c 'cd sf; php bin/phpunit'
```