<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Input for Post</title>
    <link rel="stylesheet" href="<?= ROOT ?>/public/assests/css/createpost.css">
</head>

<body>
    <div class="container">
        <div class="post-form">
            <h2>Create a Post</h2>
            <form id="post-form" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="category">Select Category:</label><br>
                    <div class=flexy>
                    <input type="radio" id="plants" name="category" value="plants" required>
                    <label for="plants">Plants</label><br>
                    <input type="radio" id="seeds" name="category" value="seeds" required>
                    <label for="seeds">Seeds</label><br>
                    <input type="radio" id="stationary" name="category" value="stationary" required>
                    <label for="stationary">Stationary</label><br>
                    </div>
                </div>
                <div class="form-group">
                    <label for="image">Select Image</label>
                    <input type="file" name="filetoupload" required>
                </div>
                
                <div class="form-group">
                    <label for="amount">Enter title of Item</label>
                    <input type="text" name="title" placeholder="Enter title of Item" required>
                </div>
                <div class="form-group">
                    <label for="description">Add description:</label>
                    <textarea id="description" name="description" placeholder="Enter description for item here..." ></textarea>
                </div>
                <div class="form-group">
                    <label for="description">Gardening Tips:</label>
                    <textarea id="description" name="gardening_tips" placeholder="Enter gardening_tips for item here..." ></textarea>
                </div>
                <div class="form-group">
                    <label for="amount">Enter the amount of Item</label>
                    <input type="text" name="amount" placeholder="Enter amount of Item" required>
                </div>
                <input class="create_button" name="submit" type="submit" value="Create Post">
            </form>
        </div>
</div>
</body>

</html>
