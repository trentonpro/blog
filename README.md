1. clone project by going to the project in github, copying the link and running git clone (link)
2. download vscode with command "winget install vscode"
3. install git using "winget install git.git -i", setting it as default in terminal and vscode as primary code.
4. install php with command "winget install php.php.8.5" 
5. open terminal.
6. type "where php" into the command prompt, copy pasting the address and pasting it into file explorer to find the installation directory.
6. copy paste php-development.ini and rename the new file as php.ini
7. open the php.ini file and make sure the following extensions are enabled: pdo_sqlite, fileinfo, openssl, curl, mbstring and extension_dir = "ext"
8. install composer through getcomposer.org, downloading the installer.
9. finish installing composer with php, restart terminal and go into the projects directory with cd, running "composer install"
10. go onto bun.com and copy the powershell command to your terminal
11. after downloading, restart the terminal, go back into the blog directory and run "bun i"
12. in vscode, open the extension marketplace tab and install the laravel extension
13. run "cp .env.example .env" as it copies the example file and renames it to .env
14. after making .env, run the command "php artisan key:generate"
15. after generating the key run the command "php artisan migrate"
16. finally, run composer run dev in your terminal to start the development environment

