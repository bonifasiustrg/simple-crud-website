# How to run this web project
- if using xampp, open terminal in xampp/htdocs directory
- git clone <this_github_link_project>
- open xampp app, start apache and mysql
- On phpmyadmin, create database named 'librarycrud' (the name adjusted with koneksi.php) with this table specification:

  or by using this query:
  CREATE TABLE IF NOT EXISTS book (
    Idbuku INT AUTO_INCREMENT PRIMARY KEY,
    judul TEXT,
    pengarang TEXT,
    tahun_terbit SMALLINT,
    isbn INT
  );
  
- on browser address bar, type localhost/simple-crud-website/index.php
