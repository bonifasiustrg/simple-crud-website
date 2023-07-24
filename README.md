# How to run this web project
- if using xampp, open terminal in xampp/htdocs directory
- ``` bash
  git clone <this_github_link_project>
  ```
- open xampp app, start apache and mysql
- On phpmyadmin, create database named 'librarycrud' (the name adjusted with koneksi.php) with this table specification:
  ![create_db](https://github.com/bonifasiustrg/simple-crud-website/assets/52784596/cc2975a0-8420-4685-8287-bbe4c48d2f07)
  or by using this query:
  ```
  CREATE TABLE IF NOT EXISTS book (
    Idbuku INT AUTO_INCREMENT PRIMARY KEY,
    judul TEXT,
    pengarang TEXT,
    tahun_terbit SMALLINT,
    isbn INT
  );
  ```

- on browser address bar, type localhost/simple-crud-website/index.php
![buku1](https://github.com/bonifasiustrg/simple-crud-website/assets/52784596/cc3d65b2-9bf2-4b42-8919-1d5f3adde88a)
