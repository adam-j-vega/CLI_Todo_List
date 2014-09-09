<?php

$items = array();

function list_items($list) 
{
 	$result = '';
 	foreach($list as $key => $value) 
    {
 		$result .= "[" . ($key + 1) . "] $value\n";
	}
	return $result;
}

function get_input($upper = FALSE) 
{
 	
	$input = trim(fgets(STDIN));

 	if ($upper == TRUE) 
    {
 		return strtoupper($input);
 	}

 	else 
    {
 		return $input;
 	}

 	//$result = trim(fgets(STDIN));
 	//return $upper ? strtoupper($result) : $result;
}

function sort_menu($items) 
{
	//$sort_input=get_input($upper = TRUE);
	$sort_input = 'A';
	switch($sort_input) 
    {
		case 'A':
			asort($items);
			break;
		case 'R':
			arsort($items);
			break;
		case 'V':
			rsort($items);
			break;
		case 'F':
			array_shift($items);
			break;
		case 'L':
			array_pop($items);
			break;
		case 'B';
			array_unshift($items);
			break;
		case 'E';
			array_push($items);
			break;
	}
	return $items;
}
function path_to_file($path_input) 
{
    $handle=fopen($path_input, 'r');
    $content=trim(fread($handle, filesize($path_input)));
    fclose($handle);
    $items=explode("\n", $content);
    return $items;   
}
function save_file($file_name,$items) 
{
        $handle= fopen($file_name, 'a');
        foreach ($items as $array)
        {
        fwrite($handle, PHP_EOL . $array);
        }
    }
function file_to_path($file_to_path,$items) 
{
    $file_name= $file_to_path;

    $file_exists_test=file_exists($file_name);
    if($file_exists_test)
    {
        echo "File already exists. Overwrite? (Y)es or (N)o?";
        $query=get_input();
        if ($query=='Y') 
        {
            $file_name = $file_to_path;
            save_file($file_name,$items);
        } else 
        {
        return;
        }         
    } else 
    {
        $file_name= $file_to_path;
        save_file($file_name,$items);
    }
}




do {
 	echo list_items($items);

    echo '(N)ew item, (R)emove item, (Q)uit , (S)ort, (O)pen, s(A)ve: " ';

    $input = get_input(TRUE);

    if ($input == 'N') 
    {

    	// Prompt User
        echo 'Enter item: ';

        // Capture input for item 
        $item = get_input();

        // Make a decision where to place
        echo 'Would you like to add the item to the (B)eginning or the (E)nd of the list?';
        $choice = get_input(TRUE);

        	if ($choice == 'B') 
            {
        		array_unshift($items,$item);
        	}

        	elseif ($choice == 'E') 
            {
        		array_push($items,$item);
        	}

        	else 
            {
        		// Add to existing list of items
        		$items[] = $item;
        	}
        
        // Sort list after adding item
        $items = sort_menu($items);
    } elseif ($input == 'R') 
    {

        echo 'Enter item number to remove: ';

        $key = get_input();

        unset($items[$key - 1]);
    } elseif ($input == 'S') 
    {
    	echo '(A)-Z, (Z)-A, (O)rder entered, (R)everse order entered: ' . PHP_EOL;

    	$items = sort_menu($items);
    } elseif ($input ==  'F') 
    {
    	array_shift($items);
    } elseif ($input == 'L') 
    {
    	array_pop($items);
    } elseif ($input == 'O') 
    {
        echo 'Specify a path to open';
        $pathToFile = get_input();

        $items=path_to_file($pathToFile);

    } elseif ($input == 'A') 
    {
        echo 'Specify a path to save';
        $file_to_path = get_input();

        file_to_path($file_to_path,$items);

    }
} while ($input != 'Q');
echo "Goodbye!\n";
exit(0);

?>


