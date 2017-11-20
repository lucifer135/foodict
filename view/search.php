<div class="ui divider"></div>
  <div class="ui grid">
    <div class="one wide column" id="side">
      <div class="ui secondary vertical fluid menu"></div>
    </div>
    <div class="fourteen wide column">
      <h2 style="margin-left: 30px;">List Perpustakaan</h2>
      <div class="ui container" style="margin-bottom: 21px;">
      <form class="ui form" method="post" action="">
        <div class="fields">
            <div class="field">
            <input placeholder="Search" type="text" name="search">
            </div>
            <div class="field">
            <input value="Search" type="submit" class="ui primary button">
            </div>
        </div>
        </form>

        <?php
          include('config/db.php');
            
          if(isset($_POST["search"])){
            $key = $_POST['search'];
            $query = mysqli_query($connection,"select distinct judul, berita, url from text where keyword='".$key."' order by jumlah desc");
            if (mysqli_num_rows($query) > 0) {
                while ($data = mysqli_fetch_assoc($query)){
                    $string = strip_tags($data['berita']);
                    if (strlen($string) > 500) {
                        
                            // truncate string
                            $stringCut = substr($string, 0, 500);
                        
                            // make sure it ends in a word so assassinate doesn't become ass...
                            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="/this/story">Read More</a>'; 
                        }

                    echo '<div class="ui card" style="width: 100%;">
                        <div class="content">
                        <a href = "'.$data['url'].'"class="header">'.$data['judul'].'</a>
                        <div class="meta"></div>
                        <div class="description">
                            <p>'.$string.'</p>
                        </div>
                        </div>
                    </div>';
                }
            }else{
                echo "<h4>Pencarian Keyword tidak ada</h4>";
            }
               
          }else{
            echo "<h4>Belum ada pencarian</h4>";
          }

          ?>
        
      </div>
    </div>
  </div>
