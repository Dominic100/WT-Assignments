<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = htmlspecialchars($_POST["title"]);
    $author = htmlspecialchars($_POST["author"]);
    $footer = "by " . htmlspecialchars($_POST["author"]);
    $contentP1 = htmlspecialchars($_POST["contentP1"]);
    $contentP2 = htmlspecialchars($_POST["contentP2"]);
    $contentP3 = htmlspecialchars($_POST["contentP3"]);
    $contentP4 = htmlspecialchars($_POST["contentP4"]);
    $contentP5 = htmlspecialchars($_POST["contentP5"]);

    $image_card = $_POST['image_url_card'];
    $image1 = $_POST['image_url1'];
    $image2 = $_POST['image_url2'];

    $blogContent = array(
        $contentP1,
        $contentP2,
        $contentP3,
        $contentP4,
        $contentP5
    );

    $blogImages = array(
        $image1,
        $image2
    );

    $currentDate = date("F j, Y");

    $card_blogs_json = file_get_contents("cardData.json");
    $card_blogs_array = json_decode($card_blogs_json, true);
    $blogs_json = file_get_contents("blogData.json");
    $blogs_array = json_decode($blogs_json, true);
    $last_id_value = end($blogs_array)['id'];
    $current_id_value = $last_id_value + 1;

    $last_class_value = end($card_blogs_array)['class'];

    $class_values = ["card1", "card2", "card3"];
    $current_class_index = array_search($last_class_value, $class_values);
    $next_class_index = ($current_class_index + 1) % count($class_values);
    $new_class_value = $class_values[$next_class_index];

    $new_card_post = array(
        "header" => $title,
        "body" => $image_card,
        "footer" => $footer,
        "class" => $new_class_value
    );
    $card_blogs_array[] = $new_card_post;

    $new_blog_post = array(
        "id" => $current_id_value,
        "title" => $title,
        "content" => $blogContent,
        "images" => $blogImages,
        "author" => $author,
        "date" => $currentDate
    );

    $blogs_array[] = $new_blog_post;

    $updated_card_blogs_json = json_encode($card_blogs_array, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    file_put_contents("cardData.json", $updated_card_blogs_json);

    $updated_blogs_json = json_encode($blogs_array, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    file_put_contents("blogData.json", $updated_blogs_json);

    // Redirect after successful submission
    header("Refresh: 3; URL=index.php");
    echo "Blog post submitted successfully! Redirecting...";
    exit(); // Ensure that script stops executing after redirect header
} else {
    echo "Error: Form submission method not allowed.";
}
?>
