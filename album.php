<?php include("resources/header.php");
    //  take the id from the url, go to mysql and find the album
    if ( isset($_GET['id'] ) ){
        $albumId = $_GET['id'];
    } else {
        header("Location: index.php");
    }

    $album = new Album($con, $albumId);
    
    $artist =  $album->getArtist();

    // echo $album->getTitle();
    // echo "<br>";
    // echo $artist->getName();  
?>

<div class="entityInfo">

    <div class="leftSection">
        <img src="<?php echo $album->getArtworkPath(); ?>" alt="album-image">
    </div>

    <div class="rightSection">
        <h2>
            <?php echo $album->getTitle(); ?>
        </h2>
        <p>By <?php echo $artist->getName(); ?></p>
        <p> <?php $songNum = $album->getSongNum();
                echo $songNum > 1 ? $songNum . " songs" : $songNum . " song";
            ?> 
        </p>
    </div>
</div>

<div class="trackListContainer">
    <ul class="trackList">
        <?php 
            $songIdArray = $album->getSongIds();
            $i = 1;
            foreach($songIdArray as $songId){
                // echo $songId;
                $albumSong = new Song($con, $songId);
                $albumArtist = $albumSong->getArtist();
                echo "<li class='tracklistRow'>
                    <div class='trackCount'> 
                        <img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
                        <span class='trackNumber'>$i</span>
                    </div>

                    <div class='trackInfo'>
                        <span class='trackName'>" . $albumSong->getTitle() . "</span> 
                        <span class='artistName'> " . $albumArtist->getName() . "</span>
                    </div>

                    <div class='trackOptions'>
                        <input type='hidden' class='songId' value='" . $albumSong->getId() . "'>
                        <img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
                    </div>

                    <div class='trackDuration'>
                        <span class='duration'>" . $albumSong->getDuration() . "</span>
                    </div>
                </li>";

                $i++;
            }
        ?>
        <script>
			var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
			tempPlaylist = JSON.parse(tempSongIds);
		</script>
    </ul>
</div>
  
<nav class="optionsMenu">
	<input type="hidden" class="songId">
	<?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>