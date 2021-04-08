#!/bin/sh
set -e


(git push) || true

git pull

git add .


read -p " Enter commit message: " message
echo  " Your commit message is  $message !"

git commit -m " $message "

git push 

