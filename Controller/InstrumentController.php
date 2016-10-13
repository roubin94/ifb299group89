<script>
//Display a confirmation box when trying to delete an object
function showConfirm(number)
{
    // build the confirmation box
    var c = confirm("Are you sure you wish to delete this item?");
    
    // if true, delete item and refresh
    if(c)
        window.location = "InstrumentOverview.php?delete=" + number;
}
</script>
<?php

require ("Model/InstrumentModel.php");

//Contains non-database related function for the Instrument page
class InstrumentController {
    
    function CreateOverviewTable() {
        $result = "
            <table class='overViewTable'>
                <tr>
                    <td></td>
                    <td></td>
                    <td><b>Id</b></td>
                    <td><b>Name</b></td>
                    <td><b>Model</b></td>
                    <td><b>Type</b></td>
                    <td><b>Price</b></td>
                    <td><b>Quality</b></td>
                    <td><b>Availibility</b></td>
                </tr>";

        $instrumentArray = $this->GetInstrumentByType('%');

        foreach ($instrumentArray as $key => $value) {
            $result = $result .
                    "<tr>
                        <td><a href='InstrumentAdd.php?update=$value->number'>Update</a></td>
                        <td><a href='#' onclick='showConfirm($value->number)'>Delete</a></td>
                        <td>$value->number</td>
                        <td>$value->name</td>
                        <td>$value->Model</td>    
                        <td>$value->type</td>    
                        <td>$value->price</td> 
                        <td>$value->quality</td>
                        <td>$value->availibility</td>
                    </tr>";
        }

        $result = $result . "</table>";
        return $result;
    }
    
    function CreateInstrumentTables($types)
    {
        $instrumentModel = new InstrumentModel();
        $instrumentArray = $instrumentModel->GetInstrumentByType($types);
        $result = "";
        
        //Generate a instrumentTable for each instrumentEntity in array
        foreach ($instrumentArray as $key => $instrument) 
        {
            $result = $result .
                    "<table class = 'instrumentTable'>
                        <tr>
                            <th rowspan='8' width = '200px'><img runat = 'server' src = '$instrument->image' /></th>
                            <th width = '150px' style = 'text-align:right' >Name: </th>
                            <td>$instrument->name</td>
                        </tr>
                        <tr>
                            <th style = 'text-align:right'>Model: </th>
                            <td><a href='InstrumentHire.php?num=$instrument->number'>$instrument->Model</a></td>
                        </tr>
                        
                        <tr>
                            <th style = 'text-align:right'>Family: </th>
                            <td>$instrument->type</td>
                        </tr>
                        
                        <tr>
                            <th style = 'text-align:right'>Price per Month: </th>
                            <td>$instrument->price</td>
                        </tr>
                        
                        <tr>
                            <th style = 'text-align:right'>Quality: </th>
                            <td>$instrument->quality</td>
                        </tr>
                        
                        <tr>
                            <th style = 'text-align:right'>Availibility: </th>
                            <td>$instrument->availibility</td>
                        </tr>
                     </table>";
        }        
        return $result;
        
    }
    
    function CreateInstrumentDropdownList() {
        $instrumentModel = new InstrumentModel();
        $result = "<form action = '' method = 'post' width = '200px'>
                    Search for an instrument type: 
                    <select name = 'types' >
                        <option value = '%' >All</option>
                        " . $this->CreateOptionValues($instrumentModel->GetInstrumentTypes()) .
                "</select>
                     <input type = 'submit' value = 'Search' />
                    </form>";

        return $result;
    }

    function CreateOptionValues(array $valueArray) {
        $result = "";

        foreach ($valueArray as $value) {
            $result = $result . "<option value='$value'>$value</option>";
        }

        return $result;
    }
    
    
   function GetImages() 
    {
        //Select folder to scan
        $handle = opendir("Images/instruments");

        //Read all files and store names in array
        while ($image = readdir($handle)) {
            $images[] = $image;
        }

        closedir($handle);

        //Exclude all filenames where filename length < 3
        $imageArray = array();
        foreach ($images as $image) {
            if (strlen($image) > 2) {
                array_push($imageArray, $image);
            }
        }

        //Create <select><option> Values and return result
        $result = $this->CreateOptionValues($imageArray);
        return $result;
    }
    
    function InsertInstrument() {
        $name = $_POST["name"];
        $Model = $_POST["Model"];
        $type = $_POST["type"];
        $price = $_POST["price"];
        $image = $_POST["image"];
        $quality = $_POST["quality"];
        $availibility = $_POST["availibility"];

        $instrument = new InstrumentEntity(-1, $name, $Model,$type, $price, $image, $quality, $availibility);
        $instrumentModel = new InstrumentModel();
        $instrumentModel->InsertInstrument($instrument);
    }
    
    function UpdateInstrument($number)
    {     
        $name = $_POST["name"];
        $Model = $_POST["Model"];
        $type = $_POST["type"];
        $price = $_POST["price"];
        $image = $_POST["image"];
        $quality = $_POST["quality"];
        $availibility = $_POST["availibility"];

        $instrument = new InstrumentEntity($number, $name, $Model,$type, $price, $image, $quality, $availibility);
        $instrumentModel = new InstrumentModel();
        $instrumentModel->UpdateInstrument($number,$instrument);
    }
    
    function DeleteInstrument($number)
    {        
        $instrumentModel = new InstrumentModel();
        $instrumentModel->DeleteInstrument($number);
    }
    
    function GetInstrumentById($number)
    {
        $instrumentModel = new InstrumentModel();
        return $instrumentModel->GetInstrumentById($number);
    }
    
    function GetInstrumentByType($type)
    {
        $instrumentModel = new InstrumentModel();
        return $instrumentModel->GetInstrumentByType($type);
    }
    
    function GetInstrumentTypes()
    {
        $instrumentModel = new InstrumentModel();
        return $instrumentModel->GetInstrumentTypes();
    }
    
}

?>
