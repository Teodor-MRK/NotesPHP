<?php

/******************************
 @author    Teodor Markov
 @copyright 18.11.2026 Teodor Markov
 @version   1.0.0
 *******************************/
function Title()
{
    print("\n
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
@                                              @
@ ███╗   ██╗ ██████╗ ████████╗███████╗███████╗ @
@ ████╗  ██║██╔═══██╗╚══██╔══╝██╔════╝██╔════╝ @
@ ██╔██╗ ██║██║   ██║   ██║   █████╗  ███████╗ @
@ ██║╚██╗██║██║   ██║   ██║   ██╔══╝  ╚╚══██║  @
@ ██║ ╚████║╚██████╔╝   ██║   ███████╗███████║ @
@ ╚═╝  ╚═══╝ ╚═════╝    ╚═╝   ╚══════╝╚══════╝ @
@                                              @
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
\n\n");
}
Title();
$notesfolder = "Notes/";
$txt = ".txt";
do {
    print("\n/1/ Create Note\n/2/ View Note\n/3/ Delete Note\n/4/ Infos of Note File\n/5/ Search Pattern in Note\n/6/ List Notes\n/7/ End Program \n\n");
    $menu = readline("Choose an option (1-7): ");

    switch ($menu) {
        case 1:
            $name = readline("Filename: ");
            $name = $notesfolder . $name . $txt;
            if (file_exists($name)) {
                print("\nFilename already exists! Try another Name.\n");
                break;
            } else {
                $f = fopen($name, "a");
            }
            $input = "";
            $roundcount = 1;
            while ($input !== "(exit)") {
                $input = readline("Line $roundcount [(exit) = finish]: ");
                if ($input !== "(exit)") {
                    $roundcount++;
                    fwrite($f, $input . "\n");
                }
            }
            fclose($f);
            print("\nNote created successfully!\n");
            break;

        case 2:
            $name = readline("Which File do you want to View? : ");
            $name = $notesfolder . $name . $txt;
            if (file_exists($name)) {
                print("Content:\n========================\n\n" . file_get_contents($name) . "\n========================\n");
            } else {
                print("This file does not exist!\n");
            }
            break;

        case 3:
            $name = readline("Which Note would you like to Delete? : ");
            $file = $notesfolder . $name . $txt;
            if (file_exists($file)) {
                $answer = strtolower(readline("Are you sure you want to Delete this Note? (y/n): "));
                if ($answer == "y") {
                    unlink($file);
                    print("File Deleted\n");
                }
            } else {
                print("This File does not exist!\n");
            }
            break;

        case 4:
            $name = readline("Which File do you want to look up the Infos? : ");
            $name = $notesfolder . $name . $txt;
            if (file_exists($name)) {
                print("\nBytes: " . filesize($name) . "\n");
                print("Created: " . date("d.m.Y H:i", filemtime($name)) . "\n");
                print("Characters: " . strlen($name) . "\n\n");
            } else {
                print("This File does not exist!\n");
            }
            break;

        case 5:
            $name = readline("Which File to look up for a Pattern? : ");
            $file = $notesfolder . $name . $txt;
            if (file_exists($file)) {
                $pattern = readline("What do you want to Search? (Case insensitive): ");
                $pattern = "/" . $pattern . "/i";
                $content = file_get_contents($file);
                if (preg_match_all($pattern, $content) > 0) {
                    print("\nThe Pattern is contained in the Note.\n");
                } else {
                    print("The Pattern was not found in the Note.\n");
                }
            } else {
                print("This File does not exist!\n");
            }
            break;

        case 6: //Sacnning Folder
            $folder = "Notes/";
            $files = scandir($folder, SCANDIR_SORT_DESCENDING);
            print("\n##############################\n\n");
            print_r($files);
            print("\n##############################\n");
            break;

        case 7: //Exit Program
            print("\nExiting...\n\n");
            Title();
            break;


        default:
            print("Invalid Input! Please press a Number from 1-7.\n");
            break;
    }
} while ($menu != 7);
