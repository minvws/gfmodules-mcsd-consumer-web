#!/bin/bash

NPMRC_FILE_NAME=".npmrc"
NPMRC_TEMPLATE_FILE_NAME=".npmrc-template"
GITHUB_REGISTRY="//npm.pkg.github.com/:_authToken="

ask_for_token() {
    echo -e "\nYou need to add your GitHub read packages token to $NPMRC_FILE_NAME\n"
    if [ -f /.dockerenv ]; then
        echo "run:  make setup  before running the container to setup package token in .npmrc"
        echo "After running make setup, you can start the container again"
        exit 1
    fi
    echo "Create a token by visiting https://github.com/settings/tokens/new?scopes=read:packages"
    echo "Copy created token and paste it below"
    echo "Please enter your GitHub read packages token: "
    read TOKEN
    if [ -z "$TOKEN" ]; then
        echo "Token is required. Exiting script."
        exit 1
    fi
    printf "\n$GITHUB_REGISTRY$TOKEN\n" >> "$1"
}

check_npmrc() {
    NPMRC_PATH="$1"
    if test -f "$NPMRC_PATH"; then
        if grep -q "$GITHUB_REGISTRY" "$NPMRC_PATH"; then
            echo ".npmrc file with GitHub registry found at $NPMRC_PATH"
            npm ci --ignore-scripts
            exit 0
        fi
        # If .npmrc file does not contain GitHub registry, ask for token
        echo ".npmrc file found at $NPMRC_PATH but does not contain GitHub registry"
        ask_for_token "$NPMRC_PATH"
        check_npmrc "$(pwd)/$NPMRC_FILE_NAME"
    else
        # If .npmrc file does not exist, copy .npmrc-template to .npmrc
        echo ".npmrc file not found at $NPMRC_PATH. Copying .npmrc-template to .npmrc"
        cp "$(pwd)/$NPMRC_TEMPLATE_FILE_NAME" "$NPMRC_PATH"
        ask_for_token "$NPMRC_PATH"
    fi
    return 1
}


# Check in current working directory
if check_npmrc "$(pwd)/$NPMRC_FILE_NAME"; then
    npm ci --ignore-scripts
    exit 0
fi

if check_npmrc "$(pwd)/$NPMRC_FILE_NAME"; then
    npm ci --ignore-scripts
    exit 0
fi

echo "Failed to setup npm. Exiting script."
exit 1
