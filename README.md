# gfmodules-mcsd-consumer-web-private

A web application to efficiently view supplier FHIR resources and manage the counter part from consumer. This application includes the following features:

- Screen to manage suppliers (add/update/delete)
- Screen to perform updates on resources and display the resource map
- Screen to view consumer resources
- Screen to compare the history of a resource

> [!IMPORTANT]
> ## Disclaimer
> 
> This project and all associated code serve solely as documentation
> and demonstration purposes to illustrate potential system
> communication patterns and architectures.
> 
> This codebase:
> 
> - Is NOT intended for production use
> - Does NOT represent a final specification
> - Should NOT be considered feature-complete or secure
> - May contain errors, omissions, or oversimplified implementations
> - Has NOT been tested or hardened for real-world scenarios
> - Is not guaranteed to follow any versioning scheme
> 
> The code examples are only meant to help understand concepts and demonstrate possibilities.
> 
> By using or referencing this code, you acknowledge that you do so at your own
> risk and that the authors assume no liability for any consequences of its use.


## Requirements

- <https://github.com/minvws/gfmodules-mcsd-update-client> running in a docker container
- Php 8.3
- [nodejs](https://nodejs.org/en/download/package-manager)

> **Note:** Nodejs needs a github read package token to install the private packages. This can be done manually or the installation script will guide you through this process as well.

## Setup & Install

1. make setup
2. make run

Or start it in a docker container (This is only possible if the .npmrc file has been created with the correct access token):

```bash
docker compose up --build --remove-orphans
```


## Run on docker
It's possible to do a standalone run of the application using docker. This docker container will have the laravel application running on an nginx webserver running on port 80.
Note that you would either set environment variables (see `.env.example`), or mount your `.env` during docker run.

Make sure you build the frontend assets locally first:

```bash
    # Build assets
    npm run build
    
    # Build docker image
    make container-build
    
    # Run container
    docker run -ti --rm -p 8201:80 --mount type=bind,source=./.env,target=/var/www/html/.env gfmodules-mcsd-consumer-web:latest
```
