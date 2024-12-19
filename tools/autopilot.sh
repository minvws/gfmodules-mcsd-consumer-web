#!/usr/bin/env bash

set -e

echo "📖 This script will help you running the MCSD app. It will try to setup everything"
echo "with default values so you can run it directly."

# Check if prerequisites, docker, php, npm are installed
if ! command -v docker &> /dev/null ; then
    echo "⚠️ Docker is not installed. Please install it before running this script."
    exit;
fi
if ! command -v php &> /dev/null ; then
    echo "⚠️ PHP is not installed. Please install it before running this script."
    exit;
fi
if ! command -v npm &> /dev/null ; then
    echo "⚠️ NPM is not installed. Please install it before running this script."
    exit;
fi


# Check if we already are configured
if [ -e .autopilot ] ; then
    echo "⚠️ It seems that you already ran this script. If you want to run it again, please remove the .autopilot file."
    exit;
fi

# Create the configuration file
echo "➡️ Creating the configuration file"
make setup

make run

# Create the .autopilot file
touch .autopilot

echo "🏁 Autopilot completed. You should be able to go to your web browser and access the application at http://localhost:8510"
