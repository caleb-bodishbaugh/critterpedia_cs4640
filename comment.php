<?php require('connect-db.php'); ?>
<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
header('Access-Control-Max-Age: 1000');  
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');


$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$data =[];
foreach ($request as $k => $v) {
    $temp = "$k => $v";
    $data['post_'.$k] = $v;
}

if (sizeof($data) > 0)   
    try {
        global $db;
        $query = "INSERT INTO comments (Name, Email, Category, Text) VALUES (:name, :email, :cat, :txt)";
        $statement = $db->prepare($query);

        // Bind values
        $statement->bindValue(':name', $data['post_name']);
        $statement->bindValue(':email', $data['post_email']);
        $statement->bindValue(':cat', $data['post_category']);
        $statement->bindValue(':txt', $data['post_text']);

        $statement->execute();
        $statement->closeCursor();

        $current_date = date("Y-m-d");

        echo json_encode(['content'=>$data, 'response_on'=>$current_date]);
    } catch (Exception $e) {
        $error_message = $e->getMessage();
        print $error_message;
    }

else {
    print "Something went wrong";
}
?>