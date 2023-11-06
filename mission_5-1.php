<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_5-1</title>
</head>
<body>
    <?php
    //データベース接続設定
    $dsn = 'mysql:dbname=tb250396db;host=localhost';
    $user = 'tb-250396';
    $password = 'n7ekcWcaPr';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    

    //テーブル作成
    $sql = "CREATE TABLE IF NOT EXISTS tbform"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name CHAR(32),"
    . "comment TEXT,"
    . "password CHAR(32),"
    . "date CHAR(32)"
    .");";
    $stmt = $pdo->query($sql);

    /*テーブルの表示
    $sql = 'SHOW TABLES';
     $result =$pdo -> query($sql);
     foreach ($result as $row){
        echo $row[0];
        echo '<br>';
     }
     echo "<hr>"
     */

    /*テーブルの構成詳細の表示
    $sql = 'SHOW CREATE TABLE tbform';
     $result =$pdo -> query($sql);
     foreach ($result as $row){
        echo $row[1];
     }
     echo "<hr>"
     */

     //編集機能
     if(!empty($_POST["number2"])){
        $number2 = $_POST["number2"];
        $pass3=$_POST["pass3"];

        $id = $number2;
        $password = $pass3;
        $sql = 'SELECT * FROM tbform WHERE id=:id and password=:password';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':password',$password,PDO::PARAM_STR);
            $stmt->execute();
            $results =$stmt->fetchAll();
                foreach ($results as $row){
                $name2=$row['name'];
                $str2=$row['comment'];
                $pass0=$row['password'];
        }}
     ?>
     
     <form action="" method="post">
         <input type="text" name="name1"placeholder="名前" value="<?php if(!empty($name2)){echo $name2;}?>">
         <input type="text" name="str1" placeholder="コメント" value="<?php if(!empty($str2)){echo $str2;}?>">
         <input type="text" name="pass1" placeholder="パスワード" value="<?php if(!empty($pass0)){echo $pass0;}?>">
         <input type="submit" name="submit1"> <br>
         <input type="number" name="number" placeholder="削除対象番号">
         <input type="text" name="pass2" placeholder="パスワード">
         <input type="submit" name="submit2" value="削除"><br>
         <input type="number" name="number2" placeholder="編集対象番号">
         <input type="text" name="pass3" placeholder="パスワード">
         <input type="submit" name="submit3" value="編集">
         <input type="hidden" name="new"value="<?php if(!empty($number2)){echo $number2;}?>">
     </form>
     
     <?php
      //削除機能
      if(!empty($_POST["number"])){
        $pass2 = $_POST["pass2"];
        $number = $_POST["number"];

        $id = $number;
        $password = $pass2;
        $sql = 'delete from tbform where id=:id and password=:password';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->bindParam(':password',$password,PDO::PARAM_STR);
        $stmt->execute();

    //データレコードの表示
        $sql = 'SELECT * FROM tbform';
        $stmt = $pdo->query($sql);
        $results =$stmt->fetchAll();
        foreach($results as $row){
            echo $row['id'].',';
            echo $row['name'].',';
            echo $row['comment'].',';
            //echo $row['password'].',';
            echo $row['date'].'<br>';
            echo "<hr>";
        }
    }
     //入力フォーム
     if(!empty($_POST["name1"])&&!empty($_POST["str1"])){
         $name1 = $_POST["name1"];
         $str1 = $_POST["str1"];
         $pass1= $_POST["pass1"];
         $date1 = date("Y/m/d H:i:s");

     //データ入力
        $name = $name1;
        $comment = $str1;
        $password = $pass1;
        $date = $date1;
    
        //新規か編集
         if(empty($_POST["new"])){
         $sql = "INSERT INTO tbform (name,comment,password,date)VALUES(:name,:comment,:password,:date)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name',$name,PDO::PARAM_STR);
        $stmt->bindParam(':comment',$comment,PDO::PARAM_STR);
        $stmt->bindParam(':password',$password,PDO::PARAM_STR);
        $stmt->bindParam(':date',$date,PDO::PARAM_STR);
        $stmt->execute();
     
        //データレコード表示
        $sql = 'SELECT * FROM tbform';
        $stmt = $pdo->query($sql);
        $results =$stmt->fetchAll();
        foreach($results as $row){
            echo $row['id'].',';
            echo $row['name'].',';
            echo $row['comment'].',';
            //echo $row['password'].',';
            echo $row['date'].'<br>';
            echo "<hr>";
            }
        }else{
         //編集機能
        $number2=$_POST["new"];
        $id = $number2;
        $name =$name1;
        $comment =$str1;


        $sql ='UPDATE tbform SET name=:name,comment=:comment,password=:password,date=:date WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name',$name,PDO::PARAM_STR);
        $stmt->bindParam(':comment',$comment,PDO::PARAM_STR);
        $stmt->bindParam(':password',$password,PDO::PARAM_STR);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->bindParam(':date',$date,PDO::PARAM_STR);
        $stmt->execute();

        //データレコードの表示
        $sql = 'SELECT * FROM tbform';
        $stmt = $pdo->query($sql);
        $results =$stmt->fetchAll();
        foreach($results as $row){
            echo $row['id'].',';
            echo $row['name'].',';
            echo $row['comment'].',';
            //echo $row['password'].',';
            echo $row['date'].'<br>';
            echo "<hr>";
            }
        }
    }
     ?>
</body>
</html>