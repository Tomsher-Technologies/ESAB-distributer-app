@echo off

cd sql
@"C:\wamp64\bin\mysql\mysql8.0.27\bin\mysqldump.exe" -u root epgapp > "%1.sql"
cd ..