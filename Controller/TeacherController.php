<?php

require ("Model/TeacherModel.php");

//Contains non-database related function for the Teacher page
class TeacherController {

    function CreateTeacherDropdownList() {
        $teacherModel = new TeacherModel();
        $result = "<form action = '' method = 'post' width = '200px'>
                    Search for an instrument type: 
                    <select name = 'types' >
                        <option value = '%' >All</option>
                        " . $this->CreateOptionValues($teacherModel->GetTeacherTypes()) .
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
    
    function CreateTeacherTables($types)
    {
        $teacherModel = new TeacherModel();
        $teacherArray = $teacherModel->GetTeacherByType($types);
        $result = "";
        
        //Generate a teacherTable for each teacherEntity in array
        foreach ($teacherArray as $key => $teacher) 
        {
            $result = $result .
                    "<table class = 'teacherTable'>
                        <tr>
                            <th rowspan='8' width = '200px'><img runat = 'server' src = '$teacher->image' /></th>
                            <th width = '150px' style = 'text-align:right' >Name: </th>
                            <td>$teacher->name</td>
                        </tr>
                        
                        <tr>
                            <th style = 'text-align:right'>Gender: </th>
                            <td>$teacher->gender</td>
                        </tr>
                        
                        <tr>
                            <th style = 'text-align:right'>Age: </th>
                            <td>$teacher->age</td>
                        </tr>
                        
                        <tr>
                            <th style = 'text-align:right'>Language: </th>
                            <td>$teacher->language</td>
                        </tr>
                        
                        <tr>
                            <th style = 'text-align:right'>Type: </th>
                            <td>$teacher->type</td>
                        </tr>
                        
                        <tr>
                            <th style = 'text-align:right'>Instrument: </th>
                            <td>$teacher->instrument</td>
                        </tr>
                        
                        <tr>
                            <th style = 'text-align:right'>Email: </th>
                            <td>$teacher->email</td>
                        </tr>
                        
                        <tr>
                            <th style = 'text-align:right'>Availability: </th>
                            <td>$teacher->availability</td>
                        </tr>                    
                     </table>";
        }        
        return $result;
        
    }

}

?>
