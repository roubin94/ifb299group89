<?php
    session_start();

    // Page Title
    $title = "Pinelands Music Academy - Management";
    
                
    // Content
    include "header.php";
    ?>

    <html>
    <h3>Instrument</h3>
    <p><a href="InstrumentAdd.php">Add new Instrument</a><p/>
    <p><a href="">Upload an image</a><p/>
    <p><a href="InstrumentOverview.php">Instrument Overview</a><p/>
    </html>
    
<?php
    include "footer.php";
    ?>