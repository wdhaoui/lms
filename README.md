# LMS 

The online training that is revolutionizing the way we work.

![CI](https://github.com/wdhaoui/lms/workflows/CI/badge.svg)

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+) and git
2. Clone project `git clone https://github.com/wdhaoui/lms.git`
3. Go to project `cd lms`
4. Run `make build` to build fresh images
5. Run `make start` to set up and start a fresh Symfony project
6. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
7. Run `make stop` to stop the Docker containers.

For more commands, type `make help`

## Features

* Cours managment like this https://github.com/pixiekat/alicanto-learning-symfony-bundle/tree/main

**Enjoy!**

## Docs

1. [Options available](docs/options.md)
2. [Using Symfony Docker with an existing project](docs/existing-project.md)
3. [Support for extra services](docs/extra-services.md)
4. [Deploying in production](docs/production.md)
5. [Debugging with Xdebug](docs/xdebug.md)
6. [TLS Certificates](docs/tls.md)
7. [Using MySQL instead of PostgreSQL](docs/mysql.md)
8. [Using Alpine Linux instead of Debian](docs/alpine.md)
9. [Using a Makefile](docs/makefile.md)
10. [Updating the template](docs/updating.md)
11. [Troubleshooting](docs/troubleshooting.md)

## License

Symfony Docker is available under the MIT License.

## Credits

Created by [dhaoui walid](), co-maintained by [Saber hadda]()
