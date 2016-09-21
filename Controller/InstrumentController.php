    <?php

require ("Model/InstrumentModel.php");

//Contains non-database related function for the Instrument page
class InstrumentController {

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
                            <td>$instrument->Model</td>
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
                     </table>";
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

        $instrument = new InstrumentEntity(-1, $name, $Model,$type, $price, $image, $quality);
        $instrumentModel = new InstrumentModel();
        $instrumentModel->InsertInstrument($instrument);
    }
    
    function UpdateInstrument($number)
    {     
    }
    
    function DeleteInstrument($number)
    {        
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
