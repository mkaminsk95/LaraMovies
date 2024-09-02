#!/bin/bash

# Define the directory to search
search_dir="resources"

# Use grep to search for the pattern and print matches
grep -rh --include \*.php --include \*.blade.php -o "__('.*')" ".." | sed -E "s/__\('([^']+)'\)/\1/"
