<?php
include('config/db_connect.php');

$title = $email = $ingredients = '';
$errors = array('email' => '', 'title' => '', 'ingredients' => '');

if(isset($_POST['submit'])){
//    echo htmlspecialchars($_POST['email']);
//    echo htmlspecialchars($_POST['title'];)
//    echo htmlspecialchars($_POST['ingredients']);
    if(empty($_POST['email'])){
        $errors['email'] = 'An email is required<br/>';
    }else{
       $email = $_POST['email'];
       if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'email must be a valid email address';
       }
    }
    if(empty($_POST['title'])){
        $errors['title'] = 'An title is required<br/>';
    }else{
       $title = $_POST['title'];
       if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
           $errors['title'] = 'Title must be letters and spaces only';
       }

    }
    if(empty($_POST['ingredients'])){
        $errors['ingredients'] = 'An ingredient is required<br/>';
    }else{
        $ingredients = $_POST['ingredients'];
        if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
            $errors['ingredients'] = 'Ingredients must be letters and spaces only and a comma separated list';
        }
    }
    if(array_filter($errors)){
        //echo 'There are errors in the form';

    }else{
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        $sql = "INSERT INTO pizzas(title, email, ingredients) VALUES('$title','$email','$ingredients')";
       if(mysqli_query($conn, $sql)){
           header('Location: index.php');
       }else {
           echo 'query error: '. mysqli_error($conn);
       }

    }
}

?>

<!DOCTYPE html>
<html>

<?php
include 'templates/header.php';
?>

<section class="container grey-text">
    <h4 class="center">Add A Pizza</h4>
    <form class="white" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <label>Your Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
        <div class="red-text"><?php echo $errors['email']; ?></div>
        <label>Pizza Name:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
        <div class="red-text"><?php echo $errors['title']; ?></div>
        <label>Ingredients (comma separated):</label>
        <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
        <div class="red-text"><?php echo $errors['ingredients']; ?></div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>



<?php
include 'templates/footer.php';
?>

</body>
</html>
