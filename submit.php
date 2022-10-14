<!DOCTYPE html>
<html>

<head>
  <title>Submit Form</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" 
  integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" 
  crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="main-block">
    <div class="left-part">
      <i class="fas fa-graduation-cap"></i>

    </div>
    <form action="script.php" method="POST" enctype="multipart/form-data" >
    
      <div class="title">
        <i class="fas fa-pencil-alt"></i>
        <h2>submit form</h2>
      </div>
      <div class="info">
        <input class="fname" type="text" name="name" placeholder="Organization Name" required>
        <!-- <label >Parent Name: </label>
        <label style="color: wheat;" >Qualven </label> -->
        <div>

          <label for="head">choose a color : </label>
          <input  style="height: 40px;" type="color" name="theme" value="#ff0000" required><br><br>
          
        </div>
        <label for="head">choose an image : </label>
        <input  type="file" name="file"  accept="image/*" required>
        <!-- <label for="head">choose a backup file : </label>
        <input  type="file" id="img" name="backup" accept=".sql"> -->
        <input type="date" name="date">

      </div>
      <div class="checkbox">
        <input type="checkbox" name="checkbox"><span>agree</span>
      </div>
      <button type="submit" name="submit">Submit</button>
    </form>
  </div>
</body>

</html>