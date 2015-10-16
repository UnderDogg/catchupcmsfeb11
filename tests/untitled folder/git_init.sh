#!/bin/sh

clear

echo "----------------------------------------------------"
echo "git init and git add origin for GitHub repos"
echo "----------------------------------------------------"

for repo in Core FileX Himawari Kagi Kantoku Menus NewsDesk Origami Profiles; do
	(cd ${repo} && git init && git remote add origin https://github.com/illuminate3/${repo}.git)
	echo ${repo}
	cd ~/Sites/laravel/app/Modules/
done

echo "----------------------------------------------------"
echo "git init and git add origin for Gitlab repos"
echo "----------------------------------------------------"

for repo in Campus Gakko Setup; do
	(cd ${repo} && git init && git remote add origin git@dev.cogents.io:crichter/${repo}.git)
	echo ${repo}
	cd ~/Sites/laravel/app/Modules/
done

echo "----------------------------------------------------"
echo "done"
echo "----------------------------------------------------"