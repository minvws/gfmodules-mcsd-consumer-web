#!/bin/bash

NPMRC_FILE_NAME=".npmrc"
GITHUB_REGISTRY="//npm.pkg.github.com/:_authToken="

ask_for_token() {
    echo -e "\nYou need to add your GitHub read packages token to $1\n"
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
    fi
    return 1
}

# Check in RUNNER_TEMP directory for GitHub Actions Runner
if [ -n "$RUNNER_TEMP" ]; then
    if check_npmrc "$RUNNER_TEMP/$NPMRC_FILE_NAME"; then
        npm ci --ignore-scripts
        exit 0
    fi
fi

# Check in current working directory
if check_npmrc "$(pwd)/$NPMRC_FILE_NAME"; then
    npm ci --ignore-scripts
    exit 0
fi

# If no .npmrc file found, create one in the home directory and ask for token
echo "No .npmrc file found in the home directory, current working directory or RUNNER_TEMP directory"
echo "Creating a new .npmrc file in the home directory and asking for a token"
ask_for_token "$(pwd)/$NPMRC_FILE_NAME"

exit 1
