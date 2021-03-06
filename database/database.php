<?php
require 'config.php';

function db_connect() {

  try {
    $connectionString = 'mysql:host=' . DBHOST . ';dbname=' . DBNAME;
    $user = DBUSER;
    $pass = DBPASS;
    $pdo = new PDO($connectionString, $user, $pass);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  }
  catch (PDOException $e) {
    die($e->getMessage());
  }
}

function handleReviewSubmission() {
  global $pdo;

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    // TODO
    if(isset($_POST['reviewName']) && isset($_POST['reviewContent'])) {
      $sql = 'INSERT into review (reviewName, date, reviewContent) VALUES (:reviewName, :date, :reviewContent)';
      $statement = $pdo -> prepare($sql);
      $statement -> bindValue(':reviewName', $_POST['reviewName']);
      $statement -> bindValue(':date', date('Y-m-d'));
      $statement -> bindValue(':reviewContent', $_POST['reviewContent']);
      $statement -> execute();
    }
  }
}

function fetchProduct() {
  global $pdo;

  if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['product_id'])) {
      $product_id = $_POST['product_id'];
      $sql = "SELECT * FROM product WHERE product_id=:productId";
      $statement = $pdo->prepare($sql);
      $statement->bindValue(':productId', $product_id);
      $statement->execute();

      while ($row = $statement -> fetch()) {
        return $row;
      }
    }
  }
}


function getProducts() {
  global $pdo;
  global $products;

  $sql = 'SELECT * FROM product;';

  $result = $pdo -> query($sql);
  
  while ($row = $result -> fetch()) {
    $products[] = $row;
  }
}

function getReviews() {
  global $pdo;
  global $reviews;
  $sql = 'SELECT * FROM review ORDER BY review_id desc;';
  $result = $pdo -> query($sql);
  
  while ($row = $result -> fetch()) {
    $reviews[] = $row;
  }
}
