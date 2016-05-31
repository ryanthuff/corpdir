<?php

class functions {
    
    //CHANGE THIS ADDRESS TO THE ADDRESS OF THE CUCM PUBLISHER
    var $siteIPAddress = "XXX.XXX.XXX.XXX";
    
    //CHANGE THIS TO WHATEVER YOU WANT TO NAME THE APPLICATION
    var $appName = "The XYZ Company's corporate phone directory.";
    
    //CHANGE THIS TO THE NAME OF THE COMPANY THAT THE APPLICATION IS FOR
    var $companyName = "XYZ Company";
    
    //DONT TOUCH
    var $readResult = NULL;
    var $bypass = FALSE;
      
    function router() {
        if (isset($_GET['guid']) && !empty($_GET['guid']) && ctype_digit($_GET['guid'])) {
            switch ($_GET['guid']) {
                case 238523946387438737834:
                    $this->viewPhoneBook();
                    $this->bypass = TRUE;
                    break;
                case 892382932266243634636;
                    $this->lookUp();
                    $this->bypass = TRUE;
                    break;
            }
        }

    }
    
    function resultsParser($resultset) {
        $fetchXmlResult = file_get_contents($resultset);
        $this->readResult = new SimpleXMLElement($fetchXmlResult); 

    }
    
    function lookUp() {
        if (isset($_POST) && isset($_POST['btnSubmit'])) {
            unset($_POST['btnSubmit']);
            $this->resultsParser("https://" . $this->siteIPAddress . ":8443/ccmcip/xmldirectorylist.jsp?l=" . $_POST['ln'] . "&f=" . $_POST['fn'] . "&n=" . $_POST['tn']);
            echo '<a href="/?guid=892382932266243634636">[Go Back]</a><table><tbody><th class="view">First Name</th><th class="view">Last Name</th><th class="view">Phone Number</th>';
            foreach ($this->readResult->{'DirectoryEntry'} as $user) {
                $fn = explode(', ',  $user->{'Name'}); //LAST NAME IS 0 and FIRST NAME IS 1
                echo '<tr class="view"><td class="view">' . $fn[1] . '</td><td class="view">' . $fn[0] . '</td><td class="view">' . $user->{'Telephone'} . '</td></tr>';
            }        
            echo '</tbody></table>';
            $this->bypass = TRUE;
            
        }
        if (!$this->bypass) {
            echo "
            <a href='/'>[Go Back]</a><br/><br/>
            <span class='titletext'>Use the fields below to search for a user in the phone book.</span><br /><br />
            <form action='/?guid=892382932266243634636' method='post' style='margin:0px;'>
            <table width='100%'>
            <tbody>
            <tr>
            <td class='lookup'>First Name:</td><td><input type='text' name='fn'></td>
            <td class='lookup'>Last Name:</td><td><input type='text' name='ln'></td>
            <td class='lookup'>Phone Number:</td><td><input type='text' name='tn'></td>
            <td><input type='submit' name='btnSubmit' value='Search'>
            </tr>
            </table>
            </form>
            <br />";
        }
        
    }
            
    function viewPhoneBook() {
        echo $this->resultsParser("https://" . $this->siteIPAddress . ":8443/ccmcip/xmldirectorylist.jsp");
        echo '<a href="/">[Go Back]</a><table><tbody><th class="view">First Name</th><th class="view">Last Name</th><th class="view">Phone Number</th>';
        foreach ($this->readResult->{'DirectoryEntry'} as $user) {
            $fn = explode(', ',  $user->{'Name'}); //LAST NAME IS 0 and FIRST NAME IS 1
            echo '<tr class="view"><td class="view">' . $fn[1] . '</td><td class="view">' . $fn[0] . '</td><td class="view">' . $user->{'Telephone'} . '</td></tr>';
        }        
        echo '</tbody></table>';
        
    }
    
}

?>