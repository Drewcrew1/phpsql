<?php
    include('config/db_connect.php');
    $sql = 'SELECT title, ingredients, id FROM pizzas';
    $result = mysqli_query($conn, $sql);
    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);
    mysqli_close($conn);

   //explode(',',$pizzas[0]['ingredients']);

//session_start();
//$_SESSION['name'] = $_POST['name'];
//
////get on another page
//$name = $_SESSION['name'] ?? 'guest';
//unset session var
//if($_SERVER['QUERY_STRING'] === 'noname'){
//    unset($_SESSION['name']);
//unset all session var
//session_unset();
//}

?>

<!DOCTYPE html>
<html>

<?php
include 'templates/header.php';
?>
<h4 class="center grey-text">Pizzas!</h4>
<div class="container">
    <div class="row">
        <?php foreach($pizzas as $pizza){  ?>
            <div class="col s6 md3 ">
                <div class="card z-depth-0">
                    <img src="img/pizza.svg" class="pizza">
                    <div class="card-content center">
                        <h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
                        <ul>
                            <?php foreach(explode(',',$pizza['ingredients']) as $ing){ ?>
                                <li><?php echo htmlspecialchars($ing) ?> </li>
                            <?php } ?>
                        </ul>

                    </div>
                    <div class="card-action right-align">
                        <a class="brand-text" href="details.php?id=<?php echo $pizza['id']?>">More Info</a>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>
</div>
<?php
include 'templates/footer.php';
?>

</body>
</html>
